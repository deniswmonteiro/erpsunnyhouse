<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientContractAccount;
use App\Models\SellerTeam;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.not_engineering')->except([
            'fileView',
            'get_contract_bill',
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Auth::user() == null) return redirect('/');

        $clients = Client::orderBy('name', 'asc')->get();

        return view('clients.list', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Auth::user() == null) return redirect('/');

        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::user() == null) return redirect('/');

        $data = $request->all();

        $customMessages = [
            'required' => 'Preencha o campo :attribute',
            'regex' =>  'Preencha o campo :attribute corretamente',
            'string' =>  'O campo :attribute selecionado é inválido',
            'file' => 'O campo :attribute permite somente arquivos',
            'mimes' => 'O :attribute deve ser no formato :values.',
            'min' => 'Mínimo de :min caractere(s)',
            'max' => [
                'file' => 'O :attribute não pode ser maior do que 10 MB.',
            ],
        ];

        $attributes = [
            'client-corporatename' => 'Razão Social',
            'client-corporatecnpj' => 'CNPJ',
            'client-name' => 'Nome',
            'client-birth' => 'Data de Nascimento',
            'client-cpf' => 'CPF',
            'client-email' => 'Email',
            'client-phone' => 'Telefone',
            'file-cnh' => 'CNH',
            'file-procuration' => 'Procuração',
            'file-cnpj' => 'CNPJ',
            'file-socialcontract' => 'Contrato Social',
            'client-cep' => 'CEP',
            'client-address' => 'Endereço',
            'client-number' => 'Número',
            'client-neighborhood' => 'Bairro',
            'client-city' => 'Cidade',
            'client-state' => 'Estado',
            'client-login' => 'Login',
            'client-password' => 'Senha',
        ];

        $validator = Validator::make($data, [
            'client-corporatename' => [
                'nullable', Rule::requiredIf($request->request->has('chk-change-client-type')),
            ],
            'client-corporatecnpj' => [
                'nullable', Rule::requiredIf($request->request->has('chk-change-client-type')),
            ],
            'client-name' => [
                'required', 'string', 'min:5', 'max:255',
            ],
            'client-birth' => [
                'required', 'date', 'date_format:Y-m-d'
            ],
            'client-cpf' => [
                'required', 'string',
            ],
            'client-email' => [
                'required', 'string', 'email', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/',
            ],
            'client-phone' => [
                'required', 'string', function ($attribute, $value, $fail) {
                    phoneIsValid($attribute, $value, $fail);
                }
            ],
            'file-cnh' => [
                'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
            ],
            'file-procuration' => [
                'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
            ],
            'file-cnpj' => [
                'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
            ],
            'file-socialcontract' => [
                'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
            ],
            'client-cep' => [
                'required', 'string'
            ],
            'client-address' => [
                'required', 'string'
            ],
            'client-number' => [
                'required', 'string'
            ],
            'client-neighborhood' => [
                'required', 'string'
            ],
            'client-city' => [
                'required', 'string'
            ],
            'client-state' => [
                'required', 'string'
            ],
            'client-login' => [
                'nullable', Rule::requiredIf($request->request->has('chk-add-credentials')),
            ],
            'client-password' => [
                'nullable', Rule::requiredIf($request->request->has('chk-add-credentials')),
            ],
        ], $customMessages, $attributes);

        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->getMessages() as $error) {
                return back()->withInput()->with('error', $error[0]);
            }
        }

        else {
            // Corporate Client
            if ($request->request->has('chk-change-client-type')) {
                $client_corporate_name = $data['client-corporatename'];
                $client_corporate_cnpj = $data['client-corporatecnpj'];
                $is_corporate = true;
            }
            
            else {
                $client_corporate_name = null;
                $client_corporate_cnpj = null;
                $is_corporate = false;
            }

            // CNH
            if (array_key_exists('file-cnh', $request->file())) {
                $cnh_info = self::fileUpload($request->file()['file-cnh'], 'cnh');
                $cnh_name = $cnh_info[0];
                $cnh_path = $cnh_info[1];
            }

            else {
                $cnh_name = null;
                $cnh_path = null;
            }

            // Procuration
            if (array_key_exists('file-procuration', $request->file())) {
                $procuration_info = self::fileUpload($request->file()['file-procuration'], 'procuration');
                $procuration_name = $procuration_info[0];
                $procuration_path = $procuration_info[1];
            }

            else {
                $procuration_name = null;
                $procuration_path = null;
            }

            if ($request->request->has('chk-change-client-type')) {
                // CNPJ
                if (array_key_exists('file-cnpj', $request->file())) {
                    $cnpj_info = self::fileUpload($request->file()['file-cnpj'], 'cnpj');
                    $cnpj_name = $cnpj_info[0];
                    $cnpj_path = $cnpj_info[1];
                }

                else {
                    $cnpj_name = null;
                    $cnpj_path = null;
                }

                // Social Contract
                if (array_key_exists('file-socialcontract', $request->file())) {
                    $social_contract_info = self::fileUpload($request->file()['file-socialcontract'], 'social_contract');
                    $social_contract_name = $social_contract_info[0];
                    $social_contract_path = $social_contract_info[1];
                }

                else {
                    $social_contract_name = null;
                    $social_contract_path = null;
                }
            }

            else {
                $cnpj_name = null;
                $cnpj_path = null;
                $social_contract_name = null;
                $social_contract_path = null;
            }

            $client_name = ucwords(mb_strtolower($data['client-name'], 'UTF-8'));
            $client_complement = ($data['client-complement'] != null) ?
                ucwords(mb_strtolower($data['client-complement'], 'UTF-8')) :
                null;
            $client_state = mb_strtoupper($data['client-state'], 'UTF-8');

            // Credentials
            if ($request->request->has('chk-add-credentials')) {
                $client_login = preg_replace('/[^0-9]/', '', $data['client-login']);
                $client_password = $data['client-password'];
            }
            
            else {
                $client_login = null;
                $client_password = null;
            }

            Client::create([
                'is_corporate' => $is_corporate,
                'corporate_name' => $client_corporate_name,
                'cnpj' => $client_corporate_cnpj,
                'name' => $client_name,
                'birth_date' => $data['client-birth'],
                'cpf' => $data['client-cpf'],
                'email' => $data['client-email'],
                'phone' => $data['client-phone'],
                'file_cnh_name' => $cnh_name,
                'file_cnh_path' => $cnh_path,
                'file_procuration_name' => $procuration_name,
                'file_procuration_path' => $procuration_path,
                'file_cnpj_name' => $cnpj_name,
                'file_cnpj_path' => $cnpj_path,
                'file_social_contract_name' => $social_contract_name,
                'file_social_contract_path' => $social_contract_path,
                'address_cep' => $data['client-cep'],
                'address' => $data['client-address'],
                'address_number' => $data['client-number'],
                'address_complement' => $client_complement,
                'address_neighborhood' => $data['client-neighborhood'],
                'address_city' => $data['client-city'],
                'address_state' => $client_state,
                'login' => $client_login,
                'password' => $client_password
            ]);

            return redirect('/clients')->with('success', 'Cliente cadastrado com sucesso.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        if (Auth::user() == null) return redirect('/');
        
        try {
            $id = decrypt($id);
        } catch (Exception $e) {
            return redirect('/login');
        }

        $client = Client::find($id);
        $client_has_credentials = $client->login != null || $client->password != null;
        $is_corporate_client = ($client->is_corporate) ? true : false;

        return view('clients.edit', [
            'client' => $client,
            'client_has_credentials' => $client_has_credentials,
            'is_corporate_client' => $is_corporate_client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (Auth::user() == null) return redirect('/');
        
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/login');
        }
        
        $data = $request->all();
        $client = Client::all()->where('id', $id)->first();

        if($client->exists()) {
            $customMessages = [
                'required' => 'Preencha o campo :attribute',
                'regex' =>  'Preencha o campo :attribute corretamente',
                'string' =>  'O campo :attribute permite somente valores alfanuméricos',
                'min' => 'O campo :attribute deve conter no mínimo :min caractere(s)',
                'max' => [
                    'file' => 'O arquivo :attribute não pode ser maior do que 2 MB.',
                ],
            ];
    
            $attributes = [
                'client-corporatename' => 'Razão Social',
                'client-corporatecnpj' => 'CNPJ',
                'client-name' => 'Nome',
                'client-birth' => 'Data de Nascimento',
                'client-cpf' => 'CPF',
                'client-email' => 'Email',
                'client-phone' => 'Telefone',
                'client-cep' => 'CEP',
                'client-address' => 'Endereço',
                'client-number' => 'Número',
                'client-state' => 'Estado',
                'client-city' => 'Cidade',
                'client-neighborhood' => 'Bairro',
                'client-complement' => 'Complemento',
                'client-login' => 'Login',
                'client-password' => 'Senha'
            ];
    
            $validator = Validator::make($data, [
                'client-corporatename' => [
                    Rule::requiredIf($request->request->has('chk-change-client-type'))
                ],
                'client-corporatecnpj' => [
                    Rule::requiredIf($request->request->has('chk-change-client-type'))
                ],
                'client-name' => [
                    'required', 'string', 'min:5', 'max:255'
                ],
                'client-birth' => [
                    'required', 'date', 'date_format:Y-m-d'
                ],
                'client-cpf' => [
                    'required', 'string'
                ],
                'client-email' => [
                    'required', 'string', 'email', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/',
                ],
                'client-phone' => [
                    'required', 'string', function ($attribute, $value, $fail) {
                        phoneIsValid($attribute, $value, $fail);
                    }
                ],
                'client-cep' => [
                    'required', 'string'
                ],
                'client-address' => [
                    'required', 'string'
                ],
                'client-number' => [
                    'required', 'string',
                ],
                'client-neighborhood' => [
                    'required', 'string'
                ],
                'client-city' => [
                    'required', 'string'
                ],
                'client-state' => [
                    'required', 'string'
                ],
                'client-login' => [
                    Rule::requiredIf($request->request->has('chk-add-credentials')),
                ],
                'client-password' => [
                    Rule::requiredIf($request->request->has('chk-add-credentials') && $request->request->has('chk-change-password')),
                ],
            ], $customMessages, $attributes);

            if ($validator->fails()) {
                foreach($validator->getMessageBag()->getMessages() as $error) {
                    return back()->withInput()->with('error', $error[0]);
                };    
            }
    
            else {
                // Corporate Client
                if ($request->request->has('chk-change-client-type')) {
                    $is_corporate = true;
                    $client_corporate_name = $data['client-corporatename'];
                    $client_corporate_cnpj = $data['client-corporatecnpj'];
                }
                
                else {
                    $is_corporate = false;
                    $client_corporate_name = null;
                    $client_corporate_cnpj = null;
                }

                $client_name = ucwords(mb_strtolower($data['client-name'], 'UTF-8'));
                $client_complement = ($data['client-complement'] != null) ?
                    $data['client-complement'] :
                    null;
                $client_state = mb_strtoupper($data['client-state'], 'UTF-8');

                // Credentials
                if ($request->request->has('chk-add-credentials')) {
                    $client_login = preg_replace('/[^0-9]/', '', $data['client-login']);

                    if ($request->request->has('chk-change-password')) $client_password = $data['client-password'];
                    else $client_password = null;
                }
                
                else {
                    $client_login = null;
                    $client_password = null;
                }

                $arr_client_data = [
                    'is_corporate' => $is_corporate,
                    'corporate_name' => $client_corporate_name,
                    'cnpj' => $client_corporate_cnpj,
                    'name' => $client_name,
                    'birth_date' => $data['client-birth'],
                    'cpf' => $data['client-cpf'],
                    'email' => $data['client-email'],
                    'phone' => $data['client-phone'],
                    'address_cep' => $data['client-cep'],
                    'address' => $data['client-address'],
                    'address_number' => $data['client-number'],
                    'address_complement' => $client_complement,
                    'address_neighborhood' => $data['client-neighborhood'],
                    'address_city' => $data['client-city'],
                    'address_state' => $client_state,
                    'login' => $client_login,
                ];

                if ($request->request->has('chk-change-password')) {
                    $arr_client_data += ['password' => $client_password];
                }
                
                $client->update($arr_client_data);

                return redirect()->route('clients_index')->with('success', 'Cliente atualizado com sucesso.');
            }
        }
                
        else return back()->withInput()->with('error', 'Cliente não encontrado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $id = decrypt($id);
            $id = intval($id);
        } catch (Exception $e) {
            return redirect('/');
        }

        $client = Client::find($id);

        if($client != null) {
            $contracts = [];
            $client_contracts = Contract::where('client_id', $client->id)->get();

            foreach($client_contracts as $contract) {
                array_push($contracts, $contract);
            }
            
            if(empty($contracts)) {
                $client->delete();
                return back()->withInput()->with('success', 'Cliente deletado(a) com sucesso.');
            }
    
            else {
                return view('clients.listClientContracts', [
                    'client' => $client,
                    'contracts' => $contracts
                ]);
            }
        }
        
        else return redirect('/');

    }

    public function destroyClientBill($id) {
        try {
            $id = decrypt($id);
            $id = intval($id);
        } catch (Exception $e) {
            return redirect('/');
        }

        $request = Request::capture();
        $data = $request->all();
        $client_data = json_decode($data['contract-accounts']);
        $client = Client::all()->where('login', $client_data->login);
        
        $contract_account_bill = ClientContractAccount::findOrFail($id);

        $all_files = Storage::allFiles('files');
        $bill_contract_accounts = [];

        if ($contract_account_bill != null) {
            foreach ($all_files as $file) {
                $arr_file_infos = explode('_', $file);
                $arr_account_month = $arr_file_infos[1] . '_' . explode('.', $arr_file_infos[3])[0] . '-' . $arr_file_infos[2];
                array_push($bill_contract_accounts, $arr_account_month);
            }

            $bill_path = substr($contract_account_bill->file_bill_path, 6);

            if (Storage::disk('files')->exists($bill_path)) {
                Storage::delete('files' . '/' . $bill_path);
            }

            $contract_account_bill->delete();

            return view('clients.contractAccounts', [
                'client' => $client,
                'client_data' => $client_data,
                'bill_contract_accounts' => $bill_contract_accounts,
            ]);
        }
        
        else {
            return view('clients.contractAccounts', [
                'client' => $client,
                'client_data' => $client_data,
                'bill_contract_accounts' => $bill_contract_accounts,
            ]);
        }
    }

    public function updateclientDocuments(Request $request, $type, $id) 
    {
        try {
            $id = decrypt($id);
            $type = decrypt($type);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Cliente não encontrado.');
        }

        $data = $request->all();
        $client = Client::all()->where('id', $id)->first();

        if ($client->exists()) {
            $customMessages = [
                'required' => 'Preencha o campo :attribute',
                'file' => 'O campo :attribute permite somente arquivos',
                'mimes' => 'O arquivo :attribute deve ser nos formatos :values.',
                'max' => [
                    'file' => 'O arquivo :attribute não pode ser maior do que 2 MB.',
                ],
            ];

            switch ($type) {
                // CNH
                case 'cnh':
                    $attribute = ['file-cnh' => 'CNH'];
        
                    $validator = Validator::make($data, [
                        'file-cnh' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if (array_key_exists('file-cnh', $request->file())) {
                            $cnh_info = self::fileUpload($request->file()['file-cnh'], 'cnh');
                            $cnh_name = $cnh_info[0];
                            $cnh_path = $cnh_info[1];

                            self::destroyDocument($client->file_cnh_path);
                        }
    
                        else {
                            $cnh_name = $client->file_cnh_name;
                            $cnh_path = $client->file_cnh_path;
                        }
    
                        $client->file_cnh_name = $cnh_name;
                        $client->file_cnh_path = $cnh_path;
                        $client->save();
    
                        return redirect()->route('clients_edit', [
                            'id' => encrypt($client->id)
                        ])->with('success', 'Documento atualizado com sucesso.');
                    }
        
                    break;

                // Procuration
                case 'procuration':
                    $attribute = ['file-procuration' => 'Procuração'];
        
                    $validator = Validator::make($data, [
                        'file-procuration' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if (array_key_exists('file-procuration', $request->file())) {
                            $procuration_info = self::fileUpload($request->file()['file-procuration'], 'procuration');
                            $procuration_name = $procuration_info[0];
                            $procuration_path = $procuration_info[1];

                            self::destroyDocument($client->file_procuration_path);
                        }
    
                        else {
                            $procuration_name = $client->file_procuration_name;
                            $procuration_path = $client->file_procuration_path;
                        }
    
                        $client->file_procuration_name = $procuration_name;
                        $client->file_procuration_path = $procuration_path;
                        $client->save();
    
                        return redirect()->route('clients_edit', [
                            'id' => encrypt($client->id)
                        ])->with('success', 'Documento atualizado com sucesso.');
                    }
        
                    break;

                // CNPJ
                case 'cnpj':
                    $attribute = ['file-cnpj' => 'CNPJ'];
        
                    $validator = Validator::make($data, [
                        'file-cnpj' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if ($client->is_corporate) {
                            if (array_key_exists('file-cnpj', $request->file())) {
                                $cnpj_info = self::fileUpload($request->file()['file-cnpj'], 'cnpj');
                                $cnpj_name = $cnpj_info[0];
                                $cnpj_path = $cnpj_info[1];

                                self::destroyDocument($client->file_cnpj_path);
                            }
        
                            else {
                                $cnpj_name = $client->file_cnpj_name;
                                $cnpj_path = $client->file_cnpj_path;
                            }
        
                            $client->file_cnpj_name = $cnpj_name;
                            $client->file_cnpj_path = $cnpj_path;
                            $client->save();
        
                            return redirect()->route('clients_edit', [
                                'id' => encrypt($client->id)
                            ])->with('success', 'Documento atualizado com sucesso.');
                        }

                        else {
                            $cnpj_name = null;
                            $cnpj_path = null;

                            $client->file_cnpj_name = $cnpj_name;
                            $client->file_cnpj_path = $cnpj_path;
                            $client->save();

                            return redirect()->route('clients_edit', [
                                'id' => encrypt($client->id)
                            ])->with('warning', 'Documento não atualizado.');
                        }
                    }
        
                    break;

                // Social Contract
                case 'socialcontract':
                    $attribute = ['file-socialcontract' => 'Contrato Social'];
        
                    $validator = Validator::make($data, [
                        'file-socialcontract' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if ($client->is_corporate) {
                            if (array_key_exists('file-socialcontract', $request->file())) {
                                $social_contract_info = self::fileUpload($request->file()['file-socialcontract'], 'social_contract');
                                $social_contract_name = $social_contract_info[0];
                                $social_contract_path = $social_contract_info[1];

                                self::destroyDocument($client->file_social_contract_path);
                            }
        
                            else {
                                $social_contract_name = $client->file_social_contract_name;
                                $social_contract_path = $client->file_social_contract_path;
                            }
        
                            $client->file_social_contract_name = $social_contract_name;
                            $client->file_social_contract_path = $social_contract_path;
                            $client->save();
        
                            return redirect()->route('clients_edit', [
                                'id' => encrypt($client->id)
                            ])->with('success', 'Documento atualizado com sucesso.');
                        }

                        else {
                            $social_contract_name = null;
                            $social_contract_path = null;

                            $client->file_social_contract_name = $social_contract_name;
                            $client->file_social_contract_path = $social_contract_path;
                            $client->save();

                            return redirect()->route('clients_edit', [
                                'id' => encrypt($client->id)
                            ])->with('warning', 'Documento não atualizado.');
                        }
                    }
        
                    break;
            }
        }

        else return back()->withInput()->with('error', 'Cliente não encontrado.');
    }

    public static function destroyDocument($request) {
        $file_path = substr($request, 8);

        if (Storage::disk('client')->exists($file_path)) {
            Storage::delete('client' . '/' . $file_path);
        }
    }

    /** Upload files to Storage */
    public static function fileUpload($req, $type)
    {
        $file_name = time() . '_' . $req->getClientOriginalName();
        $path = $req->storeAs($type, $file_name, 'client');
        $file_path = 'storage/' . $path;
        
        return [$file_name, $file_path];
    }

    /** View file save in Storage */
    public function fileView($type, $id)
    {
        try {
            $id = decrypt($id);
            $type = decrypt($type);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocorreu um erro ao visualizar o arquivo.');
        }

        $file_type = 'file_' . $type . '_path';
        $file = Client::where('id', $id)->get($file_type)->first();

        if ($file !== null) {
            if (Storage::disk('client')->exists(substr($file->$file_type, 8))) {
                $file_name = explode('/', $file->$file_type)[2];
                $file_path = 'client/' . $type . '/' . $file_name;

                return Storage::response($file_path);
            }

            else return back()->withInput()->with('error', 'Arquivo não encontrado.');
        }

        else return back()->withInput()->with('error', 'O contrato não possui este arquivo salvo.');
    }

    public function printPowerOfAttorney($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $client = Client::find($id);
        $date = date('YmdHis');
        $name = $client->is_corporate ? explode(' ', $client->corporate_name)[0] : explode(' ', $client->name)[0];
        $title = $name . '_' . $date;
        $text_font = 16.5;
        $line_height = 2;

        // share data to view
        view()->share('client', $client);;
        view()->share('title', $title);;
        view()->share('text_font', $text_font);;
        view()->share('line_height', $line_height);;

        $title = $name . '_power_of_attorney_' . $date;

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $day = strftime('%d', strtotime('today'));
        $month = utf8_encode(strftime('%B', strtotime('today')));
        $year = strftime('%Y', strtotime('today'));

        switch ($month) {
            case 'January':
                $month = 'Janeiro';
                break;

            case 'February':
                $month = 'Fevereiro';
                break;

            case 'March':
                $month = 'Março';
                break;

            case 'April':
                $month = 'Abril';
                break;

            case 'May':
                $month = 'Maio';
                break;

            case 'June':
                $month = 'Junho';
                break;

            case 'July':
                $month = 'Julho';
                break;

            case 'August':
                $month = 'Agosto';
                break;

            case 'September':
                $month = 'Setembro';
                break;

            case 'October':
                $month = 'Outubro';
                break;

            case 'November':
                $month = 'Novembro';
                break;

            case 'December':
                $month = 'Dezembro';
                break;
        }

        return view('clients.printPowerOfAttorney', [
            'client' => $client,
            'title' => $title,
            'text_font' => $text_font,
            'day' => $day,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function validate_email()
    {
        $request = Request::capture();
        $data = $request->all();
        $email = $data['email'];
        $name = $data['name'];
        $name = ucwords(mb_strtolower($name, 'UTF-8'));

        // $client_email = Client::where('email', $email)->first();
        $client_name = Client::where('name', $name)->first();

        // $status_email = ($client_email) ? true : false;
        $status_name = ($client_name) ? true : false;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        return response()->json(['exist_name' => $status_name, 'validated_fail' => $validator->fails()]);
    }

    //update client exist
    public function validate_email_client()
    {
        $request = Request::capture();
        $data = $request->all();
        $email = $data['email'];
        $id = $data['client'];
        $name = $data['name'];
        $name = ucwords(mb_strtolower($name, 'UTF-8'));

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/clients')->withInput()
                ->with('error', 'Ocorreu um erro ao atualizar o cliente.');
        }

        $client_id = Client::where('email', $email)->where('id', '!=', $id)->first();
        $client_name = Client::where('name', $name)->where('id', '!=', $id)->first();

        // $status_email = ($client_id) ? true : false;
        $status_name = ($client_name) ? true : false;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'client' => 'required',
        ]);

        return response()->json(['exist_name' => $status_name, 'validated_fail' => $validator->fails()]);
    }

    public function store_client_ajax()
    {
        $request = Request::capture();
        $data = $request->all();

        $customMessages = [
            'required' => 'Preencha o campo :attribute',
            'regex' =>  'Preencha o campo :attribute corretamente',
            'string' =>  'O campo :attribute selecionado é inválido',
            'file' => 'O campo :attribute permite somente arquivos',
            'mimes' => 'O :attribute deve ser no formato :values.',
            'min' => 'Mínimo de :min caractere(s)',
            'max' => [
                'file' => 'O :attribute não pode ser maior do que 10 MB.',
            ],
        ];

        $attributes = [
            'client-corporatename' => 'Razão Social',
            'client-corporatecnpj' => 'CNPJ',
            'client-name' => 'Nome',
            'client-birth' => 'Data de Nascimento',
            'client-cpf' => 'CPF',
            'client-email' => 'Email',
            'client-phone' => 'Telefone',
            'file-cnh' => 'CNH',
            'file-procuration' => 'Procuração',
            'file-cnpj' => 'CNPJ',
            'file-socialcontract' => 'Contrato Social',
            'client-cep' => 'CEP',
            'client-address' => 'Endereço',
            'client-number' => 'Número',
            'client-neighborhood' => 'Bairro',
            'client-city' => 'Cidade',
            'client-state' => 'Estado',
            'client-login' => 'Login',
            'client-password' => 'Senha',
        ];

        $validator = Validator::make($data, [
            'client-corporatename' => [
                'nullable', Rule::requiredIf($request->request->has('chk-change-client-type')),
            ],
            'client-corporatecnpj' => [
                'nullable', Rule::requiredIf($request->request->has('chk-change-client-type')),
            ],
            'client-name' => [
                'required', 'string', 'min:5', 'max:255',
            ],
            'client-birth' => [
                'required', 'date', 'date_format:Y-m-d'
            ],
            'client-cpf' => [
                'required', 'string',
            ],
            'client-email' => [
                'required', 'string', 'email', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/',
            ],
            'client-phone' => [
                'required', 'string', function ($attribute, $value, $fail) {
                    phoneIsValid($attribute, $value, $fail);
                }
            ],
            'file-cnh' => [
                'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
            ],
            'file-procuration' => [
                'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
            ],
            'file-cnpj' => [
                'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
            ],
            'file-socialcontract' => [
                'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
            ],
            'client-cep' => [
                'required', 'string'
            ],
            'client-address' => [
                'required', 'string'
            ],
            'client-number' => [
                'required', 'string'
            ],
            'client-neighborhood' => [
                'required', 'string'
            ],
            'client-city' => [
                'required', 'string'
            ],
            'client-state' => [
                'required', 'string'
            ],
            'client-login' => [
                'nullable', Rule::requiredIf($request->request->has('chk-add-credentials')),
            ],
            'client-password' => [
                'nullable', Rule::requiredIf($request->request->has('chk-add-credentials')),
            ],
        ], $customMessages, $attributes);

        if ($validator->fails()) {
            $errors = [];

            foreach ($validator->getMessageBag()->getMessages() as $error) {
                array_push($errors, $error[0]);
            }

            return response()->json([
                'status' => false,
                'message' => $errors,
            ]);
        }

        else {
            // Corporate Client
            if ($request->request->has('chk-change-client-type')) {
                $is_corporate = true;
                $client_corporate_name = $data['client-corporatename'];
                $client_corporate_cnpj = $data['client-corporatecnpj'];
            }
            
            else {
                $is_corporate = false;
                $client_corporate_name = null;
                $client_corporate_cnpj = null;
            }

            // CNH
            if (array_key_exists('file-cnh', $request->file())) {
                $cnh_info = self::fileUpload($request->file()['file-cnh'], 'cnh');
                $cnh_name = $cnh_info[0];
                $cnh_path = $cnh_info[1];
            }

            else {
                $cnh_name = null;
                $cnh_path = null;
            }

            // Procuration
            if (array_key_exists('file-procuration', $request->file())) {
                $procuration_info = self::fileUpload($request->file()['file-procuration'], 'procuration');
                $procuration_name = $procuration_info[0];
                $procuration_path = $procuration_info[1];
            }

            else {
                $procuration_name = null;
                $procuration_path = null;
            }

            if ($request->request->has('chk-change-client-type')) {
                // CNPJ
                if (array_key_exists('file-cnpj', $request->file())) {
                    $cnpj_info = self::fileUpload($request->file()['file-cnpj'], 'cnpj');
                    $cnpj_name = $cnpj_info[0];
                    $cnpj_path = $cnpj_info[1];
                }

                else {
                    $cnpj_name = null;
                    $cnpj_path = null;
                }

                // Social Contract
                if (array_key_exists('file-socialcontract', $request->file())) {
                    $social_contract_info = self::fileUpload($request->file()['file-socialcontract'], 'social_contract');
                    $social_contract_name = $social_contract_info[0];
                    $social_contract_path = $social_contract_info[1];
                }

                else {
                    $social_contract_name = null;
                    $social_contract_path = null;
                }
            }

            else {
                $cnpj_name = null;
                $cnpj_path = null;
                $social_contract_name = null;
                $social_contract_path = null;
            }

            $client_name = ucwords(mb_strtolower($data['client-name'], 'UTF-8'));
            $client_complement = ($data['client-complement'] != null) ?
                ucwords(mb_strtolower($data['client-complement'], 'UTF-8')) :
                null;
            $client_state = mb_strtoupper($data['client-state'], 'UTF-8');

            // Credentials
            if ($request->request->has('chk-add-credentials')) {
                $client_login = preg_replace('/[^0-9]/', '', $data['client-login']);
                $client_password = $data['client-password'];
            }
            
            else {
                $client_login = null;
                $client_password = null;
            }

            $client = Client::create([
                'is_corporate' => $is_corporate,
                'corporate_name' => $client_corporate_name,
                'cnpj' => $client_corporate_cnpj,
                'name' => $client_name,
                'birth_date' => $data['client-birth'],
                'cpf' => $data['client-cpf'],
                'email' => $data['client-email'],
                'phone' => $data['client-phone'],
                'file_cnh_name' => $cnh_name,
                'file_cnh_path' => $cnh_path,
                'file_procuration_name' => $procuration_name,
                'file_procuration_path' => $procuration_path,
                'file_cnpj_name' => $cnpj_name,
                'file_cnpj_path' => $cnpj_path,
                'file_social_contract_name' => $social_contract_name,
                'file_social_contract_path' => $social_contract_path,
                'address_cep' => $data['client-cep'],
                'address' => $data['client-address'],
                'address_number' => $data['client-number'],
                'address_complement' => $client_complement,
                'address_neighborhood' => $data['client-neighborhood'],
                'address_city' => $data['client-city'],
                'address_state' => $client_state,
                'login' => $client_login,
                'password' => $client_password
            ]);

            $clients = Client::all();
            $clients_names = [];

            foreach ($clients as $client) {
                if ($client->is_corporate) {
                    array_push($clients_names, [
                        $client->corporate_name,
                        $client->is_corporate
                    ]);
                }

                else {
                    array_push($clients_names, [
                        $client->name,
                        $client->is_corporate
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => ['Cliente salvo com sucesso'],
                'clients_names' => $clients_names,
                'client_name' => $client->name
            ]);
        }
    }

    public function exist_name_client()
    {
        $request = Request::capture();
        $data = $request->all();
        $name = $data['name'];
        $exist_user = Client::where('name', $name)->orWhere('corporate_name', $name)->first();

        if ($exist_user) return response()->json(['status' => true]);
        else return response()->json(['status' => false]);
    }

    public function get_contract_accounts()
    {
        if (Auth::user() == null) return redirect('/');
        
        $request = Request::capture();
        $data = $request->all();
        $client_data = json_decode($data['contract-accounts']);
        $client = Client::all()->where('login', $client_data->login);
        
        $all_files = Storage::allFiles('files');
        $bill_contract_accounts = [];

        foreach ($all_files as $file) {
            $arr_file_infos = explode('_', $file);
            $arr_account_month = $arr_file_infos[1] . '_' . explode('.', $arr_file_infos[3])[0] . '-' . $arr_file_infos[2];
            array_push($bill_contract_accounts, $arr_account_month);
        }

        return view('clients.contractAccounts', [
            'client' => $client,
            'client_data' => $client_data,
            'bill_contract_accounts' => $bill_contract_accounts,
        ]);
    }

    public function get_contract_bill($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocorreu um erro ao visualizar a fatura.');
        }

        $request = Request::capture();
        $data = $request->all();
        $bill_data = (array) json_decode($data['contract-account']);
       
        $file_name = preg_match('/|/', $bill_data[0]->fileName) ? 
            str_replace('|', '_', $bill_data[0]->fileName) : 
            $bill_data[0]->fileName;

        $client_login = explode('_', $bill_data[0]->fileName);
        $client = Client::all()->where('login', $client_login[0])->first();

        $client_address = mb_convert_case($bill_data[0]->address, MB_CASE_TITLE, 'UTF-8');
        $client_neighborhood = mb_convert_case($bill_data[0]->neighborhood, MB_CASE_TITLE, 'UTF-8');
        $client_city = mb_convert_case($bill_data[0]->city, MB_CASE_TITLE, 'UTF-8');
        $client_installation_number = mb_convert_case($bill_data[0]->address, MB_CASE_TITLE, 'UTF-8');

        if ($client->exists()) {
            if (Storage::disk('files')->exists($client_login[0] . '/' . $file_name)) {
                $file_path = 'files/' . $client_login[0] . '/' . $file_name;
                $bill_saved = ClientContractAccount::all()->where('file_bill_name', $file_name)->first();

                if ($bill_saved == null){
                    ClientContractAccount::create([
                        'client_id' => $client->id,
                        'contract_account_number' => $bill_data[0]->contract_account_number,
                        'address' => $client_address,
                        'neighborhood' => $client_neighborhood,
                        'city' => $client_city,
                        'installation_number' => $client_installation_number,
                        'account_month' => date('Y-m-d', strtotime($bill_data[0]->account_month)),
                        'file_bill_name' => $file_name,
                        'file_bill_path' => $file_path
                    ]);
                }

                return Storage::response($file_path);
            }
    
            else return back()->withInput()->with('error', 'Não há fatura para o mês selecionado.');
        }

        else return back()->withInput()->with('error', 'Cliente não encontrado.');
    }
}
