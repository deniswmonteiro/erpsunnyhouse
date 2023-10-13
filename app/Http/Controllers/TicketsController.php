<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use App\Models\TicketCommentResponsible;
use App\Models\TicketLog;
use App\Models\TicketResponsible;
use App\Models\User;
use App\Mail\TicketResponsibleMail;

class TicketsController extends Controller
{
    // Ticket types
    public static $TYPE_GENERATION = 'GERAÇÃO';
    public static $TYPE_CONCESSIONAIRE = 'CONCESSIONÁRIA';
    public static $TYPE_MAINTENANCE = 'MANUTENÇÃO';
    public static $TYPE_CLEANING = 'LIMPEZA';
    public static $TYPE_COMMERCIAL = 'COMERCIAL';
    public static $TYPE_COMMISSIONING = 'COMISSIONAMENTO';
    public static $TYPE_VISIT = 'VISITA';
    public static $TYPE_REPORTS = 'RELATÓRIOS';
    
    // Ticket status
    public static $STATUS_OPEN = 'ABERTO';
    public static $STATUS_IN_PROGRESS = 'EM_ANDAMENTO';
    public static $STATUS_ON_HOLD = 'EM_ESPERA';
    public static $STATUS_CONCLUDED = 'CONCLUÍDO';
    public static $STATUS_CANCELED = 'CANCELADO';
    
    // Ticket field
    public static $FIELD_TITLE = 'TÍTULO';
    public static $FIELD_STATUS = 'STATUS';
    public static $FIELD_DESCRIPTION = 'DESCRIÇÃO';
    public static $FIELD_DEADLINE = 'PRAZO';
    public static $FIELD_RESPONSIBLES = 'RESPONSÁVEIS';

    public function __construct()
    {
        $this->middleware('auth.not_engineering')->only([
            'store',
            'udpate',
            'destroy',
            'sendTicketResponsibleMail',
            'storeTicketLog',
            'destroyTicketFile',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user() == null) return redirect('/');

        $tickets = Ticket::orderBy('created_at', 'desc')->get();

        // Contracts
        $contracts = Contract::orderBy('contract_date', 'desc')->get();
        $arr_contracts = [];

        foreach ($contracts as $contract) {
            $generator_power = $contract->type == 1 ?
                number_format($contract->getGeneratorPowerValue() / 1000, 2, ',', '.') :
                null;

            if ($contract->client->is_corporate) {
                array_push($arr_contracts, [
                    'contract_id' => encrypt($contract->id),
                    'client' => $contract->client->corporate_name,
                    'generator_power' => $generator_power
                ]);
            }
            
            else {
                array_push($arr_contracts, [
                    'contract_id' => encrypt($contract->id),
                    'client' => $contract->client->name,
                    'generator_power' => $generator_power
                ]);
            }
        }

        // Clients
        $clients = Client::orderBy('created_at', 'desc')->get();
        $arr_clients = [];

        foreach ($clients as $client) {
            if ($client->is_corporate) {
                array_push($arr_clients, [
                    'client_id' => encrypt($client->id),
                    'client' => $client->corporate_name
                ]);
            }
            
            else {
                array_push($arr_clients, [
                    'client_id' => encrypt($client->id),
                    'client' => $contract->client->name
                ]);
            }
        }

        // Show tickets according with user
        $arr_tickets = [];

        foreach ($tickets as $key => $ticket) {
            if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3) {
                array_push($arr_tickets, $ticket);
            }

            else {
                foreach ($ticket->responsible as $responsible) {
                    if ($responsible->user->id == Auth::user()->id) {
                        array_push($arr_tickets, $ticket);
                    }
                }
            }
        }

        // Selected tickets to be shown
        $arr_tickets_user = [];
        $arr_tickets_open = [];
        $arr_tickets_inprogress = [];
        $arr_tickets_overdue = [];
        $arr_tickets_concluded = [];

        if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3) {
            // User tickets
            foreach ($arr_tickets as $ticket) {
                foreach ($ticket->responsible as $responsible) {
                    if ($responsible->user->id == Auth::user()->id) {
                        array_push($arr_tickets_user, $ticket);
                    }
                }
            }

            // Ticket with status 'ABERTO'
            foreach ($arr_tickets as $ticket) {
                if ($ticket->status == TicketsController::$STATUS_OPEN) {
                    array_push($arr_tickets_open, $ticket);
                }
            }

            // Ticket with status 'EM_ANDAMENTO'
            foreach ($arr_tickets as $ticket) {
                if ($ticket->status == TicketsController::$STATUS_IN_PROGRESS) {
                    array_push($arr_tickets_inprogress, $ticket);
                }
            }

            // Overdue tickets
            foreach ($arr_tickets as $ticket) {
                if ($ticket->deadline != null && $ticket->deadline < date('Y-m-d') && $ticket->status != 'CONCLUÍDO') {
                    array_push($arr_tickets_overdue, $ticket);
                }
            }

            // Ticket with status 'CONCLUÍDO'
            foreach ($arr_tickets as $ticket) {
                if ($ticket->status == TicketsController::$STATUS_CONCLUDED) {
                    array_push($arr_tickets_concluded, $ticket);
                }
            }
        }

        return view('tickets.list', [
            'arr_tickets_user' => $arr_tickets_user,
            'arr_tickets_open' => $arr_tickets_open,
            'arr_tickets_inprogress' => $arr_tickets_inprogress,
            'arr_tickets_overdue' => $arr_tickets_overdue,
            'arr_tickets_concluded' => $arr_tickets_concluded,
            'tickets' => $arr_tickets,
            'contracts' => $arr_contracts,
            'clients' => $arr_clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $ticket_contract_id_data = $data['ticket-contract-id'];

        try {
            $type = decrypt($data['ticket-type']);
            $id = $ticket_contract_id_data == null ?
                decrypt($data['ticket-client-id']) :
                decrypt($data['ticket-contract-id']);
        } catch (\Exception $e) {
            return redirect('/');
        }

        // Ticket from Client or Contract
        if ($ticket_contract_id_data == null) {
            $contract_client = Client::findOrFail($id);
            $is_contract = false;
        }

        else {
            $contract_client = Contract::findOrFail($id);
            $is_contract = true;
        }

        // If contract or client exists
        if ($contract_client->exists()) {
            // Validate data
            $custom_messages = [
                'required' => 'Preencha o campo :attribute.',
                'string' =>  'O campo :attribute selecionado é inválido.',
                'min' => [
                    'string' => ':attribute com no mínimo :min caractere(s).',
                ],
            ];

            $attributes = [
                'ticket-title' => 'Título',
                'ticket-contract' => 'Contrato',
                'ticket-client' => 'Cliente',
                'ticket-type' => 'Tipo',
                'ticket-deadline' => 'Prazo',
            ];

            $validator = Validator::make($data, [
                'ticket-title' => [
                    'required', 'string', 'min:2',
                ],
                'ticket-contract' => [
                    Rule::requiredIf($ticket_contract_id_data != null),
                ],
                'ticket-client' => [
                    Rule::requiredIf($ticket_contract_id_data == null),
                ],
                'ticket-type' => [
                    'required', 'string',
                ],
                'ticket-deadline' => [
                    'nullable', Rule::requiredIf($data['ticket-deadline'] != null), 'date', 'date_format:Y-m-d'
                ],
            ], $custom_messages, $attributes);

            if ($validator->fails()) {
                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    return back()->withInput($data)->with('error', $error[0]);
                }
            }

            else {
                $title = ucwords(mb_strtolower($data['ticket-title'], 'UTF-8'));
                $client = $data['ticket-contract'];
                $type = decrypt($data['ticket-type']);
                
                switch ($type) {
                    case 'GENERATION':
                        $contract_type = TicketsController::$TYPE_GENERATION;
                        break;

                    case 'CONCESSIONAIRE':
                        $contract_type = TicketsController::$TYPE_CONCESSIONAIRE;
                        break;

                    case 'MAINTENANCE':
                        $contract_type = TicketsController::$TYPE_MAINTENANCE;
                        break;

                    case 'CLEANING':
                        $contract_type = TicketsController::$TYPE_CLEANING;
                        break;

                    case 'COMMERCIAL':
                        $contract_type = TicketsController::$TYPE_COMMERCIAL;
                        break;

                    case 'COMMISSIONING':
                        $contract_type = TicketsController::$TYPE_COMMISSIONING;
                        break;
                    
                    case 'VISIT':
                        $contract_type = TicketsController::$TYPE_VISIT;
                        break;

                    case 'REPORTS':
                        $contract_type = TicketsController::$TYPE_REPORTS;
                        break;
                }

                // Create ticket
                Ticket::create([
                    'contract_client_id' => $contract_client->id,
                    'title' => $title,
                    'status' => TicketsController::$STATUS_OPEN,
                    'type' => strtoupper($contract_type),
                    'deadline' => $data['ticket-deadline'],
                    'requester' => Auth::user()->name,
                    'is_contract' => $is_contract
                ]);

                return redirect()->route('tickets_index')->with('success', 'Ticket salvo com sucesso.');
            }
        }

        else return back()->with('error', 'Contrato não encontrado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $ticket = Ticket::find($id);

        // Users
        $users = User::orderBy('name', 'asc')->get();

        // Ticket attachments
        $attachments = TicketAttachment::all();
        $arr_attachments = [];

        foreach($attachments as $attachment) {
            array_push($arr_attachments, [
                'id' => encrypt($attachment->id),
            ]);
        }

        return view('tickets.edit', [
            'ticket' => $ticket,
            'ticket_title' => $ticket->title,
            'ticket_description' => $ticket->description,
            'ticket_deadline' => $ticket->deadline,
            'users' => $users,
            'attachments' => $arr_attachments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $ticket_id = decrypt($data['ticket']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ticket não encontrado.',
            ]);
        }

        $ticket = Ticket::all()->where('id', $ticket_id)->first();
        
        if ($ticket != null) {
            $type = $data['type'];
            $user_id = Auth::user()->id;
            $user = User::all()->where('id', $user_id)->first();

            // Validate data
            $custom_messages = [
                'required' => 'Preencha o campo :attribute.',
                'string' =>  'O campo :attribute selecionado é inválido.',
                'min' => [
                    'string' => ':attribute com no mínimo :min caracteres.',
                ]
            ];

            switch ($type) {
                // Update ticket title
                case 'title':
                    $attributes = [
                        'field' => 'Título',
                    ];

                    $validator = Validator::make($data, [
                        'field' => [
                            'required', 'string', 'min:2',
                        ],
                    ], $custom_messages, $attributes);

                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return response()->json([
                                'status' => false,
                                'message' => $error[0],
                                'data' => []
                            ]);
                        }
                    }

                    else {
                        $field = TicketsController::$FIELD_TITLE;
                        $old_title = $ticket->title;
                        $new_title = ucwords(mb_strtolower($data['field'], 'UTF-8'));
                        $ticket_log = self::storeTicketLog($ticket_id, $user_id, $field, $old_title, $new_title);

                        // Update title
                        $ticket->title = $new_title;
                        $ticket->save();
                        
                        return response()->json([
                            'status' => true,
                            'type' => $type,
                            'message' => 'Título atualizado com sucesso.',
                            'ticket_data' => $ticket->title,
                            'ticket_log' => [
                                'user' => $user->name,
                                'message' => $ticket_log->message,
                                'old_value' => $ticket_log->old_value,
                                'new_value' => $ticket_log->new_value,
                                'created_at' => date('d/m/Y - H:i:s', strToTime($ticket_log->created_at))
                            ]
                        ]);
                    }

                    break;

                // Update ticket status
                case 'status':
                    $attributes = [
                        'field' => 'Status',
                    ];

                    $validator = Validator::make($data, [
                        'field' => [
                            'required', 'string',
                        ],
                    ], $custom_messages, $attributes);

                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return response()->json([
                                'status' => false,
                                'message' => $error[0],
                                'data' => []
                            ]);
                        }
                    }

                    else {
                        $field = TicketsController::$FIELD_STATUS;
                        $ticket_status = $ticket->status;
                        $data_status = decrypt($data['field']);

                        switch ($data_status) {
                            case TicketsController::$STATUS_OPEN:
                                $old_status = ucwords(mb_strtolower(str_replace('_', ' ', $ticket_status), 'UTF-8'));
                                $new_status = ucwords(mb_strtolower(str_replace('_', ' ', TicketsController::$STATUS_OPEN), 'UTF-8'));
                                break;

                            case TicketsController::$STATUS_IN_PROGRESS:
                                $old_status = ucwords(mb_strtolower(str_replace('_', ' ', $ticket_status), 'UTF-8'));
                                $new_status = ucwords(mb_strtolower(str_replace('_', ' ', TicketsController::$STATUS_IN_PROGRESS), 'UTF-8'));
                                break;

                            case TicketsController::$STATUS_ON_HOLD:
                                $old_status = ucwords(mb_strtolower(str_replace('_', ' ', $ticket_status), 'UTF-8'));
                                $new_status = ucwords(mb_strtolower(str_replace('_', ' ', TicketsController::$STATUS_ON_HOLD), 'UTF-8'));
                                break;

                            case TicketsController::$STATUS_CONCLUDED:
                                $old_status = ucwords(mb_strtolower(str_replace('_', ' ', $ticket_status), 'UTF-8'));
                                $new_status = ucwords(mb_strtolower(str_replace('_', ' ', TicketsController::$STATUS_CONCLUDED), 'UTF-8'));
                                break;

                            case TicketsController::$STATUS_CANCELED:
                                $old_status = ucwords(mb_strtolower(str_replace('_', ' ', $ticket_status), 'UTF-8'));
                                $new_status = ucwords(mb_strtolower(str_replace('_', ' ', TicketsController::$STATUS_CANCELED), 'UTF-8'));
                                break;
                        }

                        $ticket_log = self::storeTicketLog($ticket_id, $user_id, $field, $old_status, $new_status);

                        // Update status
                        $ticket->status = $data_status;
                        $ticket->save();
                        
                        return response()->json([
                            'status' => true,
                            'type' => $type,
                            'message' => 'Status atualizado com sucesso.',
                            'ticket_data' => $ticket->status,
                            'ticket_log' => [
                                'user' => $user->name,
                                'message' => $ticket_log->message,
                                'old_value' => $ticket_log->old_value,
                                'new_value' => $ticket_log->new_value,
                                'created_at' => date('d/m/Y - H:i:s', strToTime($ticket_log->created_at))
                            ]
                        ]);
                    }

                    break;

                // Update ticket description
                case 'description':
                    $attributes = [
                        'field' => 'Descrição',
                    ];

                    $validator = Validator::make($data, [
                        'field' => [
                            'required', 'string', 'min:2',
                        ],
                    ], $custom_messages, $attributes);

                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return response()->json([
                                'status' => false,
                                'message' => $error[0],
                                'data' => []
                            ]);
                        }
                    }

                    else {
                        $field = TicketsController::$FIELD_DESCRIPTION;
                        $old_description = $ticket->description;
                        $new_description = ucwords(mb_strtolower($data['field'], 'UTF-8'));
                        $ticket_log = self::storeTicketLog($ticket_id, $user_id, $field, $old_description, $new_description);

                        // Update description
                        $ticket->description = $new_description;
                        $ticket->save();

                        // Message
                        if ($ticket_log['old_value'] == null) $message = 'Descrição adicionada com sucesso.';
                        else $message = 'Descrição atualizada com sucesso.';
                        
                        return response()->json([
                            'status' => true,
                            'type' => $type,
                            'message' => $message,
                            'ticket_data' => $ticket->description,
                            'ticket_log' => [
                                'user' => $user->name,
                                'message' => $ticket_log->message,
                                'old_value' => $ticket_log->old_value,
                                'new_value' => $ticket_log->new_value,
                                'created_at' => date('d/m/Y - H:i:s', strToTime($ticket_log->created_at))
                            ]
                        ]);
                    }

                    break;

                // Update ticket deadline
                case 'deadline':
                    $attributes = [
                        'field' => 'Prazo',
                    ];

                    $validator = Validator::make($data, [
                        'field' => [
                            'required', 'date', 'date_format: "Y-m-d"'
                        ],
                    ], $custom_messages, $attributes);
                    
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return response()->json([
                                'status' => false,
                                'message' => $error[0],
                                'data' => []
                            ]);
                        }
                    }

                    else {
                        $field = TicketsController::$FIELD_DEADLINE;
                        $old_deadline = $ticket->deadline;
                        $new_deadline = $data['field'];
                        $ticket_log = self::storeTicketLog($ticket_id, $user_id, $field, $old_deadline, $new_deadline);

                        // Update deadline
                        $ticket->deadline = $new_deadline;
                        $ticket->save();

                        // Message
                        if ($ticket_log['old_value'] == null) $message = 'Prazo adicionado com sucesso.';
                        else $message = 'Prazo atualizado com sucesso.';
                        
                        return response()->json([
                            'status' => true,
                            'type' => $type,
                            'message' => $message,
                            'ticket_data' => $ticket->deadline,
                            'ticket_log' => [
                                'user' => $user->name,
                                'message' => $ticket_log->message,
                                'old_value' => $ticket_log->old_value,
                                'new_value' => $ticket_log->new_value,
                                'created_at' => date('d/m/Y - H:i:s', strToTime($ticket_log->created_at))
                            ]
                        ]);
                    }

                    break;

                // Update ticket responsible
                case 'responsibles':
                    $attributes = [
                        'field' => 'Responsáveis',
                    ];

                    $validator = Validator::make($data, [
                        'field' => [
                            'required', 'array'
                        ],
                    ], $custom_messages, $attributes);
                    
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return response()->json([
                                'status' => false,
                                'message' => $error[0],
                                'comment_data' => []
                            ]);
                        }
                    }

                    else {
                        $field = TicketsController::$FIELD_RESPONSIBLES;
                        $old_responsibles = $ticket->responsible;
                        $responsible_data = [];
                        $arr_old_users = [];
                        $arr_new_users = [];

                        // If exists old responsibles
                        if (count($old_responsibles) > 0) {
                            foreach($old_responsibles as $old_users) {
                                $old_user_id = $old_users->user_id;
                                $old_user = User::all()->where('id', $old_user_id)->first();

                                // Create an array with old users name
                                array_push($arr_old_users, ucwords(mb_strtolower($old_user->name, 'UTF-8')));
                            }
                        }

                        // Responsibles sent by view
                        foreach ($data['field'] as $data_field) {
                            $new_user_id = decrypt($data_field);
                            $new_user = User::all()->where('id', $new_user_id)->first();

                            if ($new_user != null) {
                                // If exists old responsibles
                                if (count($old_responsibles) > 0) {
                                    foreach ($old_responsibles as $responsible) {
                                        $responsible->delete();  // Delete them all
                                    }
                                }
                                
                                // Create an array with new users name
                                array_push($arr_new_users, ucwords(mb_strtolower($new_user->name, 'UTF-8')));
                                
                                // Create an array with new users name and cellphone
                                $new_user_cellphone = $new_user->cellphone != null ? 
                                    preg_replace('/[^0-9]/', '', $new_user->cellphone) :
                                    null;

                                array_push($responsible_data, [
                                    'name' => ucwords(mb_strtolower($new_user->name, 'UTF-8')),
                                    'cellphone' => $new_user_cellphone
                                ]);
                                
                                // Create ticket responsible
                                TicketResponsible::create([
                                    'ticket_id' => $ticket_id,
                                    'user_id' => $new_user->id,
                                ]);

                                // Send email with information
                                self::sendTicketResponsibleMail($new_user, $data['url']);
                            }
                            
                            else {
                                return response()->json([
                                    'status' => false,
                                    'message' => 'Usuário não encontrado.',
                                ]);
                            }
                        }
                        
                        $ticket_log = self::storeTicketLog($ticket_id, $user_id, $field, $arr_old_users, $arr_new_users);

                        // Message
                        if (count($old_responsibles) == 0) $message = 'Responsável adicionado com sucesso.';
                        else $message = 'Responsável atualizado com sucesso.';
                        
                        return response()->json([
                            'status' => true,
                            'type' => $type,
                            'message' => $message,
                            'responsible_data' => $responsible_data,
                            'ticket_log' => [
                                'user' => $user->name,
                                'message' => $ticket_log->message,
                                'old_value' => $ticket_log->old_value,
                                'new_value' => $ticket_log->new_value,
                                'created_at' => date('d/m/Y - H:i:s', strToTime($ticket_log->created_at))
                            ]
                        ]);
                    }

                    break;
            }
        }

        else {
            return response()->json([
                'status' => false,
                'message' => 'Ticket não encontrado.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $ticket = Ticket::find($id);

        if ($ticket != null) {
            // Delete ticket responsible
            foreach ($ticket->responsible as $responsible) {
                $responsible->delete();
            }

            // Delete ticket attachment
            foreach ($ticket->attachment as $attachment) {
                TicketsController::destroyTicketFile($attachment->file_ticket_attachment_path);
                $attachment->delete();
            }

            // Delete ticket comment
            foreach ($ticket->comment as $comment) {
                $comment->delete();
                
                // Delete ticket comment responsible
                foreach ($comment->ticketCommentResponsible as $comment_responsible) {
                    $comment_responsible->delete();
                }
            }

            // Delete ticket comment
            foreach ($ticket->comment as $comment) {
                $comment->delete();
            }

            // Delete ticket log
            foreach ($ticket->log as $log) {
                $log->delete();
            }

            // Delete ticket
            $ticket->delete();

            return redirect()
                ->route('tickets_index')
                ->withInput()
                ->with('success', 'O Ticket foi deletado do sistema com sucesso.');
        }
        
        else return redirect('/');
    }

    /** Store a newly created ticket comment in storage */
    public function storeTicketCommentFetch()
    {
        date_default_timezone_set('America/Belem');

        $request = Request::capture();
        $data = $request->all();

        $comment_responsibles = [];
        $responsibles_data = [];

        try {
            $ticket_id = decrypt($data['ticket']);

            if ($data['comment-responsible'] != null) {
                foreach ($data['comment-responsible'] as $responsible) {
                    array_push($comment_responsibles, decrypt($responsible));
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Preencha os campos.',
                'comment_data' => []
            ]);
        }

        // Responsible data
        if (count($comment_responsibles) > 0) {
            foreach ($comment_responsibles as $responsible) {
                $user = User::all()->where('id', $responsible)->first();
                $user_cellphone = $user->cellphone != null ? 
                    preg_replace('/[^0-9]/', '', $user->cellphone) :
                    null;

                array_push($responsibles_data, [
                    'name' => $user->name,
                    'cellphone' => $user_cellphone
                ]);

                if ($user == null) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Usuário não encontrado.',
                        'comment_data' => []
                    ]);
                }
            }
        }

        else $responsibles_data = null;

        $ticket = Ticket::all()->where('id', $ticket_id)->first();

        if ($ticket != null) {
            // Validate data
            $custom_messages = [
                'required' => 'Preencha o campo :attribute.',
                'string' =>  'O campo :attribute selecionado é inválido.',
                'min' => [
                    'string' => ':attribute com no mínimo :min caracteres.',
                ],
                'max' => [
                    'string' => ':attribute com no máximo :max caracteres.',
                ],
            ];

            $attributes = [
                'comment-text' => 'Comentário',
            ];

            $validator = Validator::make($data, [
                'comment-text' => [
                    'required', 'string', 'min:5', 'max:250'
                ],
            ], $custom_messages, $attributes);

            if ($validator->fails()) {
                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    return response()->json([
                        'status' => false,
                        'message' => $error[0],
                        'comment_data' => []
                    ]);
                }
            }

            else {
                $comment = ucfirst($data['comment-text']);

                // Create ticket comment
                $ticket_comment = TicketComment::create([
                    'ticket_id' => $ticket->id,
                    'comment_author' => Auth::user()->name,
                    'comment_text' => $comment,
                    'comment_date' => date('Y-m-d H:i:s'),
                ]);

                // Create ticket comment responsible
                if ($responsibles_data != null) {
                    foreach ($comment_responsibles as $responsible) {
                        TicketCommentResponsible::create([
                            'ticket_comment_id' => $ticket_comment->id,
                            'user_id' => $responsible,
                        ]);
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Comentário adicionado',
                    'comment_data' => [
                        'author' => $ticket_comment->comment_author,
                        'responsibles_data' => $responsibles_data,
                        'comment' => $ticket_comment->comment_text,
                        'date' => $ticket_comment ->comment_date,
                    ]
                ]);
            }
        }

        else {
            return response()->json([
                'status' => false,
                'message' => 'Ticket não encontrado.',
                'comment_data' => []
            ]);
        }
    }

    /** Send email when a ticket responsible is selected */
    public static function sendTicketResponsibleMail($user, $url)
    {
        $user_name = $user->name;
        $user_email = $user->email;

        $maildata = [
            'user_name' => $user_name,
            'url' => $url
        ];
        
        Mail::to($user_email)->send(new TicketResponsibleMail($maildata));
    }

    /** Store a newly created ticket attachment in storage */
    public function storeTicketAttachmentFetch()
    {
        date_default_timezone_set('America/Belem');

        $request = Request::capture();
        $data = $request->all();

        try {
            $ticket_id = decrypt($data['ticket']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ticket não encontrado.',
                'comment_data' => []
            ]);
        }

        $ticket = Ticket::all()->where('id', $ticket_id)->first();

        if ($ticket != null) {
            // Validate data
            $custom_messages = [
                'required' => 'Preencha o campo :attribute',
                'file' => 'O campo :attribute permite somente arquivos',
                'mimes' => 'O arquivo :attribute deve ser no formato :values.',
                'max' => [
                    'file' => 'O arquivo :attribute não pode ser maior do que 10 MB.',
                ],
            ];

            $attributes = [
                'ticket-attachment' => 'Anexo',
            ];

            $validator = Validator::make($data, [
                'ticket-attachment' => [
                    'required', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                ],
            ], $custom_messages, $attributes);
            
            if ($validator->fails()) {
                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    return response()->json([
                        'status' => false,
                        'message' => $error[0],
                        'attachment_data' => []
                    ]);
                }
            }

            else {
                $attachment_info = self::storeTicketFile($request->file()['ticket-attachment']);
                $attachment_name = $attachment_info[0];
                $attachment_path = $attachment_info[1];

                // Create ticket attachment
                $ticket_attachment = TicketAttachment::create([
                    'ticket_id' => $ticket->id,
                    'author' => Auth::user()->name,
                    'file_ticket_attachment_name' => $attachment_name,
                    'file_ticket_attachment_path' => $attachment_path,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Anexo adicionado',
                    'attachment_data' => [
                        'author' => $ticket_attachment->author,
                        'attachment_name' => $attachment_name,
                        'attachment_path' => $attachment_path,
                        'attachment_url' => route('ticket_file_view', ['id' => encrypt($ticket_attachment->id)]),
                        'created_at' => date('d/m/Y - H:i:s', strToTime($ticket_attachment->created_at)),
                    ]
                ]);
            }
        }

        else {
            return response()->json([
                'status' => false,
                'message' => 'Ticket não encontrado.',
                'attachment_data' => []
            ]);
        }
    }

    /** Store a ticket log in storage */
    public static function storeTicketLog($ticket_id, $user_id, $field, $old_value, $new_value)
    {
        date_default_timezone_set('America/Belem');

        switch ($field) {
            case TicketsController::$FIELD_TITLE:
                $message = 'Título atualizado';
                break;

            case TicketsController::$FIELD_STATUS:
                $message = 'Status atualizado';
                break;

            case TicketsController::$FIELD_DESCRIPTION:
                if ($old_value == null) $message = 'Descrição adicionada';
                else $message = 'Descrição atualizada';

                break;

            case TicketsController::$FIELD_DEADLINE:
                if ($old_value == null) $message = 'Prazo adicionado';
                else $message = 'Prazo atualizado';

                break;

            case TicketsController::$FIELD_RESPONSIBLES:
                if (count($old_value) == 0) $message = 'Responsável adicionado';
                else $message = 'Responsável atualizado';

                break;
        }

        // Create ticket log
        $ticket_log = TicketLog::create([
            'ticket_id' => $ticket_id,
            'user_id' => $user_id,
            'field' => $field,
            'old_value' => $old_value,
            'new_value' => $new_value,
            'message' => $message,
        ]);

        return $ticket_log;
    }

    /** Upload a ticket file to storage */
    public static function storeTicketFile($req)
    {
        $file_name = intval(microtime(true) * 1000) . '_' . $req->getClientOriginalName();
        $path = $req->storeAs('attachments', $file_name, 'ticket');
        $file_path = 'storage/' . $path;

        return [$file_name, $file_path];
    }

    /** View a ticket file from storage */
    public function showTicketFile($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocorreu um erro ao visualizar o anexo.');
        }

        $file = TicketAttachment::where('id', $id)->first();

        if ($file->file_ticket_attachment_path != null) {
            if (Storage::disk('ticket')->exists(substr($file->file_ticket_attachment_path, 8))) {
                $file_name = $file->file_ticket_attachment_name;
                $file_path = 'ticket/attachments/' . $file_name;
            
                return Storage::response($file_path);
            }

            else return back()->withInput()->with('error', 'Anexo não encontrado.');
        }

        else return back()->withInput()->with('error', 'O anexo não existe.');
    }

    /** Remove the specified file from storage.  */
    public static function destroyTicketFile($request)
    {
        $file_path = substr($request, 8);
        Storage::delete('ticket/' . $file_path);
    }
}
