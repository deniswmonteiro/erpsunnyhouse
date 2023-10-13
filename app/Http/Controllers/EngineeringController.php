<?php

namespace App\Http\Controllers;

use App\Mail\EngineeringProjectMail;
use App\Models\BeneficiaryEffectiveDate;
use App\Models\Client;
use App\Models\Contract;
use App\Models\EngineeringBeneficiary;
use App\Models\EngineeringDocumentAccessRequestForm;
use App\Models\EngineeringDocumentAneel;
use App\Models\EngineeringDocumentArt;
use App\Models\EngineeringDocumentDataSheetCertificates;
use App\Models\EngineeringDocumentDescriptiveMemorial;
use App\Models\EngineeringDocumentElectricalProject;
use App\Models\EngineeringDocumentRequestAboveSeventyFive;
use App\Models\EngineeringDocumentRequestAboveTenUpToSeventyFive;
use App\Models\EngineeringDocumentRequestUpToTen;
use App\Models\EngineeringGenerator;
use App\Models\EngineeringGeneratorDocuments;
use App\Models\EngineeringGeneratorDocumentsNewFile;
use App\Models\EngineeringGeneratorEquipments;
use App\Models\EngineeringGeneratorImages;
use App\Models\EngineeringProject;
use App\Models\EquipmentGenerator;
use App\Models\EquipmentSolarInverter;
use App\Models\ProtocolFeedbackIssued;
use App\Models\ProtocolHomologated;
use App\Models\ProtocolProjectSubmission;
use App\Models\ProtocolProvisionalRequest;
use App\Models\ProtocolRequestFeedback;
use App\Models\ProtocolSurvey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EngineeringController extends Controller
{
    public static $ACTIVE = 'ATIVO';
    public static $SUBJECT = 'SUBMETIDO';
    public static $PROTOCOLED = 'PROTOCOLADO';
    public static $ISSUED = 'PARECER_EMITIDO';
    public static $PROVISIONAL = 'VISTORIA_PROVISORIA';
    public static $SURVEY = 'VISTORIA';
    public static $HOMOLOGATED = 'HOMOLOGADO';
    public static $CONCLUDED = 'CONCLUÍDO';

    public function __construct()
    {
        $this->middleware('auth.not_engineering')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user() == null) return redirect('/');

        $first_day = date('Y-01-01');
        $last_day = date('Y-12-31');

        $projects_years = EngineeringProject::all('created_at');
        $arr_years = [];

        foreach($projects_years as $project) {
            array_push($arr_years, explode('-', $project->created_at->toDateString())[0]);
        }

        $years = array_unique($arr_years);

        $projects = EngineeringProject::whereBetween('created_at', [$first_day, $last_day])
            ->orderBy('created_at', 'desc')
            ->get();

        $search_year = date('Y');

        return view('engineering.list', [
            'projects' => $projects,
            'years' => $years,
            'search_year' => $search_year
        ]);
    }

    public function search(Request $request)
    {
        $search_year = $request->input('engineering-project-search');

        $first_day = date("$search_year-01-01");
        $last_day = date("$search_year-12-31");

        $projects = EngineeringProject::whereBetween('created_at', [$first_day, $last_day])
            ->orderBy('created_at', 'desc')
            ->get();

        $projects_years = EngineeringProject::all('created_at');
        $arr_years = [];

        foreach($projects_years as $project) {
            array_push($arr_years, explode('-', $project->created_at->toDateString())[0]);
        }

        $years = array_unique($arr_years);

        return view('engineering.list', [
            'projects' => $projects,
            'years' => $years,
            'search_year' => $search_year
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $contract = Contract::find($id);

        $clients = Client::orderBy('name', 'ASC')->get();
        $clients_names = [];

        foreach ($clients as $client) {
            if ($client->is_corporate) array_push($clients_names, $client->corporate_name);
            else array_push($clients_names, $client->name);
        }

        /** Equipments */
        $equipments_generator = EquipmentGenerator::all();
        $equipments_solar_inverter = EquipmentSolarInverter::all();
        $equipments = [];

        foreach ($equipments_generator as $generator) {
            $text = 'Módulo Solar ' . $generator->producer . ' - ' . $generator->module . ' - ' . $generator->technology . ' - ' . str_replace('.', ',', $generator->power) . ' W';

            foreach ($contract->contractsProducts() as $product) {
                if ($product->name == $text) {
                    array_push($equipments, [
                        'id' => encrypt($generator->id),
                        'name' => $product->name,
                        'type' => encrypt('GENERATOR'),
                        'category' => 'generator',
                        'power' => $generator->power,
                        'quantity' => $product->quantity,
                        'datasheet_path' => $generator->datasheet_path,
                    ]);
                }
            }
        }

        foreach ($equipments_solar_inverter as $inverter) {
            $text = 'Inversor ' . $inverter->producer . ' - ' . str_replace('.', ',', $inverter->power) . ' kW - ' . $inverter->mppt . ' MPPT - ' . $inverter->voltage . ' V';

            foreach ($contract->contractsProducts() as $product) {
                if ($product->name == $text) {
                    array_push($equipments, [
                        'id' => encrypt($inverter->id),
                        'name' => $product->name,
                        'type' => encrypt('SOLAR_INVERTER'),
                        'category' => 'inverter',
                        'power' => $inverter->power,
                        'quantity' => $product->quantity,
                        'datasheet_path' => $inverter->datasheet_path,
                    ]);
                }
            }
        }

        return view('engineering.create', [
            'contract' => $contract,
            'clients' => $clients_names,
            'login' => $contract->client->login,
            'password' => $contract->client->password,
            'equipments' => $equipments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $data = $request->all();
        $contract = Contract::all()->where('id', $id)->first();

        if ($contract->exists()) {
            // Project observation
            if ($data['project-observation'] != null) {
                $observation = str_replace("\r\n",'<br>', addslashes(htmlspecialchars(trim($data['project-observation']))));
            }
            
            else $observation = null;

            // Create project
            $project_info = EngineeringProject::create([
                'contract_id' => $id,
                'observation' => $observation,
            ]);

            // Generators
            $project_generators = $data['project'];

            foreach ($project_generators as $generator) {
                $data_generator_project_type = decrypt($generator['generator-project-type']);

                // Validate generator
                $customGeneratorsMessages = [
                    'required' => 'Preencha o campo :attribute',
                ];

                $generatorsAttributes = [
                    'generator-project-type' => 'Tipo de Projeto',
                    'generator-cep' => 'CEP',
                    'generator-address' => 'Endereço',
                    'generator-number' => 'Número/Apt.',
                    'generator-neighborhood' => 'Bairro',
                    'generator-city' => 'Cidade',
                    'generator-state' => 'Estado',
                    'generator-contract-account' => 'Conta Contrato da Geradora',
                    'generator-other-contract-account' => 'Outra Conta Contrato da Geradora',
                    'generator-consumption' => 'Consumo da Geradora'
                ];

                $validator_generators = Validator::make($generator, [
                    'generator-project-type' => 'required',
                    'generator-cep' => 'required',
                    'generator-address' => 'required',
                    'generator-number' => 'required',
                    'generator-neighborhood' => 'required',
                    'generator-city' => 'required',
                    'generator-state' => 'required',
                    'generator-contract-account' => Rule::requiredIf($generator['generator-contract-account'] != null),
                    'generator-other-contract-account' => [
                        Rule::requiredIf($generator['generator-contract-account'] == null)
                    ],
                    'generator-consumption' => [
                        Rule::requiredIf($data_generator_project_type == 'AUTOCONSUMO_REMOTO')
                    ]
                ], $customGeneratorsMessages, $generatorsAttributes);

                // Validate equipment
                $arr_equipments = [];

                foreach($generator['equipments'] as $generator_equipment) {
                    array_push($arr_equipments, $generator_equipment);
                }

                $customEquipmentsMessages = [
                    'required' => 'Preencha o campo :attribute',
                ];

                $EquipmentsAttributes = [
                    '*.quantity' => 'Quantidade',
                ];

                $validator_equipments = Validator::make($arr_equipments, [
                    '*.quantity' => 'required'
                ], $customEquipmentsMessages, $EquipmentsAttributes);

                // Validate beneficiary
                if ($data_generator_project_type != 'INDIVIDUAL') {
                    $arr_beneficiaries = [];

                    foreach ($generator['beneficiaries'] as $generator_beneficiary) {
                        array_push($arr_beneficiaries, $generator_beneficiary);
                    }

                    $customBeneficiariesMessages = [
                        'required' => 'Preencha o campo :attribute',
                    ];

                    $beneficiariesAttributes = [
                        '*.beneficiary-contract-account' => 'Conta Contrato Beneficiária',
                        '*.beneficiary-consumption-class' => 'Classe de Consumo',
                        '*.beneficiary-rate' => 'Taxa',
                        '*.beneficiary-address' => 'Endereço',
                    ];

                    $validator_beneficiaries = Validator::make($arr_beneficiaries, [
                        '*.beneficiary-consumption-class' => [
                            Rule::requiredIf($data_generator_project_type == 'AUTOCONSUMO_REMOTO' || $data_generator_project_type == 'GERACAO_COMPARTILHADA')
                        ],
                        '*.beneficiary-rate' => [
                            Rule::requiredIf($data_generator_project_type == 'AUTOCONSUMO_REMOTO' || $data_generator_project_type == 'GERACAO_COMPARTILHADA')
                        ],
                        '*.beneficiary-address' => [
                            Rule::requiredIf($data_generator_project_type == 'AUTOCONSUMO_REMOTO' || $data_generator_project_type == 'GERACAO_COMPARTILHADA')
                        ],
                    ], $customBeneficiariesMessages, $beneficiariesAttributes);

                    if ($validator_equipments->fails()) {
                        foreach ($validator_equipments->getMessageBag()->getMessages() as $error) {
                            return back()->withInput($request->all())->with('error', $error[0]);
                        }
                    }

                    if ($validator_beneficiaries->fails()) {
                        foreach ($validator_beneficiaries->getMessageBag()->getMessages() as $error) {
                            return back()->withInput($request->all())->with('error', $error[0]);
                        }
                    }
                }

                if ($validator_generators->fails()) {
                    foreach ($validator_generators->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    // Update contract status
                    $contract->status = ContractController::$STATUS_ACTIVE;
                    $contract->save();

                    // Generator client
                    $data_generator_client = $generator['generator-client'];

                    $generator_client = Client::where('name', $data_generator_client)
                        ->orWhere('corporate_name', $data_generator_client)
                        ->first();

                    if ($generator_client != null && $generator_client->exists()) {
                        if ($generator_client->is_corporate) {
                            $generator_corporate_client = Client::all()
                                ->where('corporate_name', $data_generator_client)
                                ->first();

                            if ($generator_corporate_client != null) {
                                $generator_client_id = $generator_corporate_client->id;
                            }

                            else $generator_client_id = $contract->client->id;
                        }

                        else {
                            $not_generator_corporate_client = Client::all()
                                ->where('name', $data_generator_client)
                                ->first();

                            if ($not_generator_corporate_client != null) {
                                $generator_client_id = $not_generator_corporate_client->id;
                            }

                            else $generator_client_id = $contract->client->id;
                        }
                    }

                    else $generator_client_id = $contract->client->id;

                    if ($data_generator_project_type == "AUTOCONSUMO_REMOTO") {
                        $generator_consumption = doubleval(str_replace(',', '.', $generator['generator-consumption']));
                    }
    
                    else $generator_consumption = null;

                    // generator contract account value
                    if ($generator['generator-contract-account'] == null) {
                        $generator_contract_account = $generator['generator-other-contract-account'];
                        $different_generator_contract_account = true;
                    }

                    else {
                        $generator_contract_account = $generator['generator-contract-account'];
                        $different_generator_contract_account = false;
                    }

                    // Create generators
                    $generator_info = EngineeringGenerator::create([
                        'engineering_project_id' => $project_info->id,
                        'client_id' => $generator_client_id,
                        'generator_project_type' => $data_generator_project_type,
                        'generator_status' => EngineeringController::$ACTIVE,
                        'generator_cep' => $generator['generator-cep'],
                        'generator_address' => $generator['generator-address'],
                        'generator_number' => $generator['generator-number'],
                        'generator_complement' => $generator['generator-complement'],
                        'generator_neighborhood' => $generator['generator-neighborhood'],
                        'generator_city' => $generator['generator-city'],
                        'generator_state' => $generator['generator-state'],
                        'different_generator_contract_account' => $different_generator_contract_account,
                        'generator_contract_account' => $generator_contract_account,
                        'generator_power' => doubleval(str_replace(',', '.', $generator['generator-power'])) * 1000,
                        'generator_consumption' => $generator_consumption,
                    ]);

                    if ($data_generator_project_type != 'INDIVIDUAL' && $data_generator_project_type != 'RESERVADO') {
                        // Create beneficiary effective date
                        $beneficiary_effective_date_info = BeneficiaryEffectiveDate::create([
                            'generator_id' => $generator_info->id,
                            'effective_date' => date('Y-m-d'),
                            'status' => true,
                        ]);
                    }

                    // Equipments
                    foreach ($generator['equipments'] as $equipment) {
                        $equipment_id = decrypt($equipment['equipment-id']);
                        $equipment_type = decrypt($equipment['type']);

                        // Create equipments
                        EngineeringGeneratorEquipments::create([
                            'engineering_generator_id' => $generator_info->id,
                            'equipment_id' => $equipment_id,
                            'name' => $equipment['name'],
                            'quantity' => $equipment['quantity'],
                            'type' => $equipment_type,
                        ]);
                    }

                    // Beneficiaries
                    if ($data_generator_project_type != 'INDIVIDUAL' && $data_generator_project_type != 'RESERVADO') {
                        foreach ($generator['beneficiaries'] as $beneficiary) {
                            // Beneficiary client
                            if ($data_generator_project_type == 'GERACAO_COMPARTILHADA') {
                                $data_beneficiary_client = $beneficiary['beneficiary-client'];

                                $beneficiary_client = Client::where('name', $data_beneficiary_client)
                                    ->orWhere('corporate_name', $data_beneficiary_client)
                                    ->first();

                                if ($beneficiary_client != null && $beneficiary_client->exists()) {
                                    if ($beneficiary_client->is_corporate) {
                                        $corporate_beneficiary_client = Client::all()
                                            ->where('corporate_name', $data_beneficiary_client)
                                            ->first();

                                        if ($corporate_beneficiary_client != null) {
                                            $beneficiary_client_id = $corporate_beneficiary_client->id;
                                        }

                                        else $beneficiary_client_id = $generator_client_id;
                                    }

                                    else {
                                        $not_corporate_beneficiary_client = Client::all()
                                            ->where('name', $data_beneficiary_client)->first();

                                        if ($not_corporate_beneficiary_client != null) {
                                            $beneficiary_client_id = $not_corporate_beneficiary_client->id;
                                        }

                                        else $beneficiary_client_id = $generator_client_id;
                                    }
                                }

                                else $beneficiary_client_id = $generator_client_id;
                            }

                            else $beneficiary_client_id = null;

                            // beneficiary contract account value
                            if ($beneficiary['beneficiary-contract-account'] == null) {
                                $beneficiary_contract_account = $beneficiary['beneficiary-other-contract-account'];
                                $different_beneficiary_contract_account = true;
                            }

                            else {
                                $beneficiary_contract_account = $beneficiary['beneficiary-contract-account'];
                                $different_beneficiary_contract_account = false;
                            }

                            // Create beneficiaries
                            EngineeringBeneficiary::create([
                                'engineering_generator_id' => $generator_info->id,
                                'beneficiary_effective_date_id' => $beneficiary_effective_date_info->id,
                                'client_id' => $beneficiary_client_id,
                                'different_beneficiary_contract_account' => $different_beneficiary_contract_account,
                                'beneficiary_contract_account' => $beneficiary_contract_account,
                                'beneficiary_consumption_class' => decrypt($beneficiary['beneficiary-consumption-class']),
                                'beneficiary_rate' => doubleval(str_replace(',', '.', $beneficiary['beneficiary-rate'])),
                                'beneficiary_address' => $beneficiary['beneficiary-address'],
                            ]);
                        }
                    }
                }
            }

            // Sending email with contract informations
            self::sendEngineeringProjectMail($contract, $contract->project, 'store');

            return redirect()->route('engineering_project_index')->with('success', 'Projeto salvo com sucesso.');
        }

        else return back()->withInput()->with('error', 'Contrato não encontrado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $project = EngineeringProject::find($id);

        if ($project->exists()) {
            $generators = $project->generator;

            $all_files = Storage::allFiles('files');
            $bill_contract_accounts = [];

            $images_preview = [];
            $images_installation = [];
            $images_final = [];
            $images_other = [];

            foreach ($all_files as $file) {
                $arr_file_infos = explode('_', $file);
                $arr_account_month = $arr_file_infos[1] . '_' . explode('.', $arr_file_infos[3])[0] . '-' . $arr_file_infos[2];
                array_push($bill_contract_accounts, $arr_account_month);
            }
            
            foreach ($generators as $generator_key => $generator) {   
                // Generator equipments           
                foreach ($generator->generator_equipment as $equipment) {
                    switch ($equipment->type) {
                        case 'GENERATOR':
                            $equipment_generator = EquipmentGenerator::find($equipment->equipment_id);
                            $equipment_datasheet = $equipment_generator->datasheet_path;
                            $equipment['datasheet_path'] = $equipment_datasheet;
                            break;

                        case 'SOLAR_INVERTER':
                            $equipment_inverter = EquipmentSolarInverter::find($equipment->equipment_id);
                            $equipment_datasheet = $equipment_inverter->datasheet_path;
                            $equipment['datasheet_path'] = $equipment_datasheet;
                            break;
                    }
                }

                // Generator images
                foreach ($generator->images as $image) {
                    switch ($image->type) {
                        case 'VISTORIA_PREVIA':
                            array_push($images_preview, [
                                'generator_id' => $generator_key + 1,
                                'type' => 'previous',
                            ]);
                            break;

                        case 'INSTALACAO':
                            array_push($images_installation, [
                                'generator_id' => $generator_key + 1,
                                'type' => 'installation',
                            ]);
                            break;

                        case 'VISTORIA_FINAL':
                            array_push($images_final, [
                                'generator_id' => $generator_key + 1,
                                'type' => 'final',
                            ]);
                            break;

                        case 'OUTRAS':
                            array_push($images_other, [
                                'generator_id' => $generator_key + 1,
                                'type' => 'others',
                            ]);
                            break;
                    }
                }
            }

            /** Equipments */
            $equipments_generator = EquipmentGenerator::all();
            $equipments_solar_inverter = EquipmentSolarInverter::all();
            $equipments = [];

            foreach ($equipments_generator as $generator) {
                $text = 'Módulo Solar ' . $generator->producer . ' - ' . $generator->module . ' - ' . $generator->technology . ' - ' . str_replace('.', ',', $generator->power) . ' W';

                foreach ($project->contract->contractsProducts() as $product) {
                    if ($product->name == $text) {
                        array_push($equipments, [
                            'id' => encrypt($generator->id),
                            'name' => $product->name,
                            'type' => encrypt('GENERATOR'),
                            'category' => 'generator',
                            'power' => $generator->power,
                            'quantity' => $product->quantity,
                            'datasheet_path' => $generator->datasheet_path,
                        ]);
                    }
                }
            }

            foreach ($equipments_solar_inverter as $inverter) {
                $text = 'Inversor ' . $inverter->producer . ' - ' . str_replace('.', ',', $inverter->power) . ' kW - ' . $inverter->mppt . ' MPPT - ' . $inverter->voltage . ' V';

                foreach ($project->contract->contractsProducts() as $product) {
                    if ($product->name == $text) {
                        array_push($equipments, [
                            'id' => encrypt($inverter->id),
                            'name' => $product->name,
                            'type' => encrypt('SOLAR_INVERTER'),
                            'category' => 'inverter',
                            'power' => $inverter->power,
                            'quantity' => $product->quantity,
                            'datasheet_path' => $inverter->datasheet_path,
                        ]);
                    }
                }
            }

            $clients = Client::orderBy('name', 'ASC')->get();
            $clients_names = [];

            foreach ($clients as $client) {
                if ($client->is_corporate) array_push($clients_names, $client->corporate_name);
                else array_push($clients_names, $client->name);
            }

            // Project observations
            $observations = $project->observation != null ? $project->observation : null;

            return view('engineering.show', [
                'project' => $project,
                'generators' => $generators,
                'bill_contract_accounts' => $bill_contract_accounts,
                'clients' => $clients_names,
                'equipments' => $equipments,
                'observations' => $observations,
                'images_preview' => $images_preview,
                'images_installation' => $images_installation,
                'images_final' => $images_final,
                'images_other' => $images_other,
            ]);
        }

        else return back()->withInput()->with('error', 'Projeto não encontrado.');
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

        $project = EngineeringProject::find($id);
        $generators = $project->generator;
        $arr_beneficiaries = [];
        $arr_generator_has_beneficiaries = [];

        foreach ($generators as $key => $generator) {
            if (count($generator->beneficiary) > 0) array_push($arr_beneficiaries, $generator->beneficiary);

            foreach ($generator->generator_equipment as $equipment) {
                switch ($equipment->type) {
                    case 'GENERATOR':
                        $equipment_generator = EquipmentGenerator::find($equipment->equipment_id);
                        $equipment_datasheet = $equipment_generator->datasheet_path;
                        $equipment['datasheet_path'] = $equipment_datasheet;
                        break;

                    case 'SOLAR_INVERTER':
                        $equipment_inverter = EquipmentSolarInverter::find($equipment->equipment_id);
                        $equipment_datasheet = $equipment_inverter->datasheet_path;
                        $equipment['datasheet_path'] = $equipment_datasheet;
                        break;
                }
            }


            if (count($generator->beneficiary)) {
                array_push($arr_generator_has_beneficiaries, [
                    'index' => $key + 1,
                    'qtde_beneficiaries' => count($generator->beneficiary)
                ]);
            }
        }

        /** Equipments */
        $equipments_generator = EquipmentGenerator::all();
        $equipments_solar_inverter = EquipmentSolarInverter::all();
        $equipments = [];

        foreach ($equipments_generator as $generator) {
            $text = 'Módulo Solar ' . $generator->producer . ' - ' . $generator->module . ' - ' . $generator->technology . ' - ' . str_replace('.', ',', $generator->power) . ' W';

            foreach ($project->contract->contractsProducts() as $product) {
                if ($product->name == $text) {
                    array_push($equipments, [
                        'id' => encrypt($generator->id),
                        'name' => $product->name,
                        'type' => encrypt('GENERATOR'),
                        'category' => 'generator',
                        'power' => $generator->power,
                        'quantity' => $product->quantity,
                        'datasheet_path' => $generator->datasheet_path,
                    ]);
                }
            }
        }

        foreach ($equipments_solar_inverter as $inverter) {
            $text = 'Inversor ' . $inverter->producer . ' - ' . str_replace('.', ',', $inverter->power) . ' kW - ' . $inverter->mppt . ' MPPT - ' . $inverter->voltage . ' V';

            foreach ($project->contract->contractsProducts() as $product) {
               if ($product->name == $text) {
                    array_push($equipments, [
                        'id' => encrypt($inverter->id),
                        'name' => $product->name,
                        'type' => encrypt('SOLAR_INVERTER'),
                        'category' => 'inverter',
                        'power' => $inverter->power,
                        'quantity' => $product->quantity,
                        'datasheet_path' => $inverter->datasheet_path,
                    ]);
                }
            }
        }

        $total_beneficiaries = count($arr_beneficiaries);

        $clients = Client::orderBy('name', 'ASC')->get();
        $clients_names = [];

        foreach ($clients as $client) {
            if ($client->is_corporate) array_push($clients_names, $client->corporate_name);
            else array_push($clients_names, $client->name);
        }

        // Project observations
        $observations = $project->observation != null ? $project->observation : null;

        return view('engineering.edit', [
            'project' => $project,
            'generators' => $generators,
            'total_beneficiaries' => $total_beneficiaries,
            'generator_has_beneficiaries' => $arr_generator_has_beneficiaries,
            'clients' => $clients_names,
            'login' => $project->contract->client->login,
            'password' => $project->contract->client->password,
            'equipments' => $equipments,
            'observations' => $observations
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $project = EngineeringProject::all()->where('id', $id)->first();

        if ($project->exists()) {
            // Generators
            $data_generators = $data['project'];

            foreach ($data_generators as $data_generator) {
                $data_generator_project_type = decrypt($data_generator['generator-project-type']);

                // Validate generator
                $customGeneratorsMessages = [
                    'required' => 'Preencha o campo :attribute',
                ];

                $generatorsAttributes = [
                    'generator-project-type' => 'Tipo de Projeto',
                    'generator-cep' => 'CEP',
                    'generator-address' => 'Endereço',
                    'generator-number' => 'Número/Apt.',
                    'generator-neighborhood' => 'Bairro',
                    'generator-city' => 'Cidade',
                    'generator-state' => 'Estado',
                    'generator-contract-account' => 'Conta Contrato da Geradora',
                    'generator-other-contract-account' => 'Outra Conta Contrato da Geradora',
                    'generator-consumption' => 'Consumo da Geradora'
                ];

                $validator_generators = Validator::make($data_generator, [
                    'generator-project-type' => 'required',
                    'generator-cep' => 'required',
                    'generator-address' => 'required',
                    'generator-number' => 'required',
                    'generator-neighborhood' => 'required',
                    'generator-city' => 'required',
                    'generator-state' => 'required',
                    'generator-contract-account' => [
                        Rule::requiredIf($data_generator['generator-contract-account'] != null)
                    ],
                    'generator-other-contract-account' => [
                        Rule::requiredIf($data_generator['generator-contract-account'] == null)
                    ],
                    'generator-consumption' => [
                        Rule::requiredIf($data_generator_project_type == 'AUTOCONSUMO_REMOTO')
                    ]
                ], $customGeneratorsMessages, $generatorsAttributes);

                // Validate equipment
                $arr_equipments = [];

                foreach($data_generator['equipments'] as $generator_equipment) {
                    array_push($arr_equipments, $generator_equipment);
                }

                $customEquipmentsMessages = [
                    'required' => 'Preencha o campo :attribute',
                ];

                $EquipmentsAttributes = [
                    '*.quantity' => 'Quantidade',
                ];

                $validator_equipments = Validator::make($arr_equipments, [
                    '*.quantity' => 'required'
                ], $customEquipmentsMessages, $EquipmentsAttributes);

                // Validate beneficiary
                if ($data_generator_project_type != 'INDIVIDUAL' && $data_generator_project_type != 'RESERVADO') {
                    $arr_beneficiaries = [];
    
                    foreach ($data_generator['beneficiaries'] as $generator_beneficiary) {
                        array_push($arr_beneficiaries, $generator_beneficiary);
                    }
    
                    $customBeneficiariesMessages = [
                        'required' => 'Preencha o campo :attribute',
                    ];
    
                    $beneficiariesAttributes = [
                        '*.beneficiary-contract-account' => 'Conta Contrato Beneficiária',
                        '*.beneficiary-consumption-class' => 'Classe de Consumo',
                        '*.beneficiary-rate' => 'Taxa',
                        '*.beneficiary-address' => 'Endereço',
                    ];
    
                    $beneficiariesAttributes = [
                        '*.beneficiary-consumption-class' => 'Classe de Consumo',
                        '*.beneficiary-rate' => 'Taxa',
                        '*.beneficiary-address' => 'Endereço',
                    ];
        
                    $validator_beneficiaries = Validator::make($arr_beneficiaries, [
                        '*.beneficiary-consumption-class' => [
                            Rule::requiredIf($data_generator_project_type == 'AUTOCONSUMO_REMOTO' || $data_generator_project_type == 'GERACAO_COMPARTILHADA')
                        ],
                        '*.beneficiary-rate' => [
                            Rule::requiredIf($data_generator_project_type == 'AUTOCONSUMO_REMOTO' || $data_generator_project_type == 'GERACAO_COMPARTILHADA')
                        ],
                        '*.beneficiary-address' => [
                            Rule::requiredIf($data_generator_project_type == 'AUTOCONSUMO_REMOTO' || $data_generator_project_type == 'GERACAO_COMPARTILHADA')
                        ],
                    ], $customBeneficiariesMessages, $beneficiariesAttributes);

                    if ($validator_equipments->fails()) {
                        foreach ($validator_equipments->getMessageBag()->getMessages() as $error) {
                            return back()->withInput($request->all())->with('error', $error[0]);
                        }
                    }
        
                    if ($validator_beneficiaries->fails()) {
                        foreach ($validator_beneficiaries->getMessageBag()->getMessages() as $error) {
                            return back()->withInput($request->all())->with('error', $error[0]);
                        }
                    }
                }

                if ($validator_generators->fails()) {
                    foreach ($validator_generators->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }
    
                else {
                    // Project observation
                    if ($data['project-observation'] != null) {
                        $observation = str_replace("\r\n",'<br>', addslashes(htmlspecialchars(trim($data['project-observation']))));
                    }

                    else $observation = null;
    
                    // Update project
                    $project->observation = $observation;
                    $project->save();
                    
                    // Generator client
                    $data_generator_client = $data_generator['generator-client'];
                    $generator_client = Client::where('name', $data_generator_client)
                        ->orWhere('corporate_name', $data_generator_client)
                        ->first();

                    if ($generator_client != null && $generator_client->exists()) {
                        if ($generator_client->is_corporate) {
                            $corporate_generator_client = Client::all()
                                ->where('corporate_name', $data_generator_client)
                                ->first();

                            if ($corporate_generator_client != null) {
                                $generator_client_id = $corporate_generator_client->id;
                            }

                            else $generator_client_id = $project->contract->client->id;
                        }

                        else {
                            $not_corporate_generator_client = Client::all()
                                ->where('name', $data_generator_client)
                                ->first();

                            if ($not_corporate_generator_client != null) {
                                $generator_client_id = $not_corporate_generator_client->id;
                            }

                            else $generator_client_id = $project->contract->client->id;
                        }
                    }

                    else $generator_client_id = $project->contract->client->id;

                    if ($data_generator_project_type == "AUTOCONSUMO_REMOTO") {
                        $generator_consumption = doubleval(str_replace(',', '.', $data_generator['generator-consumption']));
                    }
    
                    else $generator_consumption = null;

                    // Generator contract account value
                    if ($data_generator['generator-contract-account'] == null) {
                        $generator_contract_account = $data_generator['generator-other-contract-account'];
                        $different_contract_account = true;
                    }

                    else {
                        $generator_contract_account = $data_generator['generator-contract-account'];
                        $different_contract_account = false;
                    }

                    // Update generator
                    if (array_key_exists('generator-id', $data_generator)) {
                        $generator = EngineeringGenerator::findOrFail(decrypt($data_generator['generator-id']));

                        $generator->client_id = $generator_client_id;
                        $generator->generator_project_type = $data_generator_project_type;
                        $generator->generator_cep = $data_generator['generator-cep'];
                        $generator->generator_address = $data_generator['generator-address'];
                        $generator->generator_number = $data_generator['generator-number'];
                        $generator->generator_complement = $data_generator['generator-complement'];
                        $generator->generator_neighborhood = $data_generator['generator-neighborhood'];
                        $generator->generator_city = $data_generator['generator-city'];
                        $generator->generator_state = $data_generator['generator-state'];
                        $generator->different_generator_contract_account = $different_contract_account;
                        $generator->generator_contract_account = $generator_contract_account;
                        $generator->generator_power = doubleval(str_replace(',', '.', $data_generator['generator-power'])) * 1000;
                        $generator->generator_consumption = $generator_consumption;
                        $generator->save();

                        // Update equipments
                        foreach ($data_generator['equipments'] as $data_equipment) {
                            $equipment = EngineeringGeneratorEquipments::findOrFail(decrypt($data_equipment['id']));
                            $equipment->quantity = $data_equipment['quantity'];
                            $equipment->save();
                        }

                        // Beneficiaries
                        if ($data_generator_project_type != 'INDIVIDUAL' && $data_generator_project_type != 'RESERVADO') {
                            if (count($generator->beneficiary_effective_date) == 0) {
                                // Create beneficiary effective date
                                $new_beneficiary_effective_date = BeneficiaryEffectiveDate::create([
                                    'generator_id' => $generator->id,
                                    'effective_date' => date('Y-m-d'),
                                    'status' => true,
                                ]);
                            }

                            foreach ($data_generator['beneficiaries'] as $data_beneficiary) {
                                // Beneficiary client
                                if ($data_generator_project_type == 'GERACAO_COMPARTILHADA') {
                                    $data_beneficiary_client = $data_beneficiary['beneficiary-client'];

                                    $beneficiary_client = Client::where('name', $data_beneficiary_client)
                                        ->orWhere('corporate_name', $data_beneficiary_client)
                                        ->first();

                                    if ($beneficiary_client != null && $beneficiary_client->exists()) {
                                        if ($beneficiary_client->is_corporate) {
                                            $corporate_beneficiary_client = Client::all()
                                                ->where('corporate_name', $data_beneficiary_client)
                                                ->first();

                                            if ($corporate_beneficiary_client != null) {
                                                $beneficiary_client_id = $corporate_beneficiary_client->id;
                                            }

                                            else $beneficiary_client_id = $generator_client->id;
                                        }

                                        else {
                                            $not_corporate_beneficiary_client = Client::all()
                                                ->where('name', $data_beneficiary_client)->first();

                                            if ($not_corporate_beneficiary_client != null) {
                                                $beneficiary_client_id = $not_corporate_beneficiary_client->id;
                                            }

                                            else $beneficiary_client_id = $generator_client->id;
                                        }
                                    }

                                    else $beneficiary_client_id = $generator_client->id;
                                }

                                else $beneficiary_client_id = null;

                                // Beneficiary contract account value
                                if ($data_beneficiary['beneficiary-contract-account'] == null) {
                                    $beneficiary_contract_account = $data_beneficiary['beneficiary-other-contract-account'];
                                    $different_beneficiary_contract_account = true;
                                }

                                else {
                                    $beneficiary_contract_account = $data_beneficiary['beneficiary-contract-account'];
                                    $different_beneficiary_contract_account = false;
                                }

                                // Check if beneficiary account is saved on Storage
                                if (array_key_exists('beneficiary-id', $data_beneficiary)) {
                                    $beneficiary = EngineeringBeneficiary::findOrFail(decrypt($data_beneficiary['beneficiary-id']));

                                    $beneficiary->client_id = $beneficiary_client_id;
                                    $beneficiary->different_beneficiary_contract_account = $different_beneficiary_contract_account;
                                    $beneficiary->beneficiary_contract_account = $beneficiary_contract_account;
                                    $beneficiary->beneficiary_consumption_class = decrypt($data_beneficiary['beneficiary-consumption-class']);
                                    $beneficiary->beneficiary_rate = doubleval(str_replace(',', '.', $data_beneficiary['beneficiary-rate']));
                                    $beneficiary->beneficiary_address = $data_beneficiary['beneficiary-address'];
                                    $beneficiary->save();
                                }

                                else {
                                    $beneficiary_effective_date = BeneficiaryEffectiveDate::all()
                                        ->where('generator_id', $generator->id)
                                        ->where('status', 1);

                                    foreach ($beneficiary_effective_date as $effective_date) {
                                        $beneficiary_effective_date_info_id = $effective_date->id;
                                    }

                                    EngineeringBeneficiary::create([
                                        'engineering_generator_id' => $generator->id,
                                        'beneficiary_effective_date_id' => $beneficiary_effective_date_info_id,
                                        'client_id' => $beneficiary_client_id,
                                        'different_beneficiary_contract_account' => $different_beneficiary_contract_account,
                                        'beneficiary_contract_account' => $beneficiary_contract_account,
                                        'beneficiary_consumption_class' => decrypt($data_beneficiary['beneficiary-consumption-class']),
                                        'beneficiary_rate' => doubleval(str_replace(',', '.', $data_beneficiary['beneficiary-rate'])),
                                        'beneficiary_address' => $data_beneficiary['beneficiary-address'],
                                    ]);
                                }
                            }
                        }
                    }

                    // Create generator
                    else {
                         // Generator contract account value
                        if ($data_generator['generator-contract-account'] == null) {
                            $generator_contract_account = $data_generator['generator-other-contract-account'];
                            $different_contract_account = true;
                        }

                        else {
                            $generator_contract_account = $data_generator['generator-contract-account'];
                            $different_contract_account = false;
                        }

                        $generator_info = EngineeringGenerator::create([
                            'engineering_project_id' => $id,
                            'client_id' => $generator_client_id,
                            'generator_project_type' => $data_generator_project_type,
                            'generator_status' => EngineeringController::$ACTIVE,
                            'generator_cep' => $data_generator['generator-cep'],
                            'generator_address' => $data_generator['generator-address'],
                            'generator_number' => $data_generator['generator-number'],
                            'generator_complement' => $data_generator['generator-complement'],
                            'generator_neighborhood' => $data_generator['generator-neighborhood'],
                            'generator_city' => $data_generator['generator-city'],
                            'generator_state' => $data_generator['generator-state'],
                            'different_generator_contract_account' => $different_contract_account,
                            'generator_contract_account' => $generator_contract_account,
                            'generator_power' => doubleval(str_replace(',', '.', $data_generator['generator-power'])) * 1000,
                            'generator_consumption' => $generator_consumption
                        ]);

                        if ($data_generator_project_type != 'INDIVIDUAL' && $data_generator_project_type != 'RESERVADO') {
                            // Create beneficiary effective date
                            $new_beneficiary_effective_date = BeneficiaryEffectiveDate::create([
                                'generator_id' => $generator_info->id,
                                'effective_date' => date('Y-m-d'),
                                'status' => true,
                            ]);
                        }

                        // Equipments
                        foreach ($data_generator['equipments'] as $equipment) {
                            $equipment_id = decrypt($equipment['equipment-id']);
                            $equipment_type = decrypt($equipment['type']);
    
                            // Create equipments
                            EngineeringGeneratorEquipments::create([
                                'engineering_generator_id' => $generator_info->id,
                                'equipment_id' => $equipment_id,
                                'name' => $equipment['name'],
                                'quantity' => $equipment['quantity'],
                                'type' => $equipment_type,
                            ]);
                        }

                        // Beneficiaries
                        if ($data_generator_project_type != 'INDIVIDUAL' && $data_generator_project_type != 'RESERVADO') {
                            foreach ($data_generator['beneficiaries'] as $data_beneficiary) {
                                // Beneficiary client
                                if ($data_generator_project_type == 'GERACAO_COMPARTILHADA') {
                                    $data_beneficiary_client = $data_beneficiary['beneficiary-client'];

                                    $beneficiary_client = Client::where('name', $data_beneficiary_client)
                                        ->orWhere('corporate_name', $data_beneficiary_client)
                                        ->first();

                                    if ($beneficiary_client != null && $beneficiary_client->exists()) {
                                        if ($beneficiary_client->is_corporate) {
                                            $corporate_beneficiary_client = Client::all()
                                                ->where('corporate_name', $data_beneficiary_client)
                                                ->first();

                                            if ($corporate_beneficiary_client != null) {
                                                $beneficiary_client_id = $corporate_beneficiary_client->id;
                                            }

                                            else $beneficiary_client_id = $generator_client_id;
                                        }

                                        else {
                                            $not_corporate_beneficiary_client = Client::all()
                                                ->where('name', $data_beneficiary_client)->first();

                                            if ($not_corporate_beneficiary_client != null) {
                                                $beneficiary_client_id = $not_corporate_beneficiary_client->id;
                                            }

                                            else $beneficiary_client_id = $generator_client_id;
                                        }
                                    }

                                    else $beneficiary_client_id = $generator_client_id;
                                }

                                else $beneficiary_client_id = null;

                                // Beneficiary contract account value
                                if ($data_beneficiary['beneficiary-contract-account'] == null) {
                                    $beneficiary_contract_account = $data_beneficiary['beneficiary-other-contract-account'];
                                    $different_beneficiary_contract_account = true;
                                }

                                else {
                                    $beneficiary_contract_account = $data_beneficiary['beneficiary-contract-account'];
                                    $different_beneficiary_contract_account = false;
                                }

                                // Create beneficiary
                                EngineeringBeneficiary::create([
                                    'engineering_generator_id' => $generator_info->id,
                                    'beneficiary_effective_date_id' => $new_beneficiary_effective_date->id,
                                    'client_id' => $beneficiary_client_id,
                                    'different_beneficiary_contract_account' => $different_beneficiary_contract_account,
                                    'beneficiary_contract_account' => $beneficiary_contract_account,
                                    'beneficiary_consumption_class' => decrypt($data_beneficiary['beneficiary-consumption-class']),
                                    'beneficiary_rate' => doubleval(str_replace(',', '.', $data_beneficiary['beneficiary-rate'])),
                                    'beneficiary_address' => $data_beneficiary['beneficiary-address'],
                                ]);
                            }
                        }
                    }
                }
            }

            // Sending email with contract informations
            self::sendEngineeringProjectMail($project->contract, $project, 'update');

            return redirect()->route('engineering_project_show', ['id' => encrypt($id)])
                ->with('success', 'Projeto atualizado com sucesso.');
        }

        else return back()->withInput()->with('error', 'Projeto não encontrado.');
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
            $id = intval($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $project = EngineeringProject::findOrFail($id);

        $contract = $project->contract;
        $contract->status = ContractController::$STATUS_HIRED;
        $contract->save();

        if ($project != null) {
            // Generator
            foreach ($project->generator as $generator) {
                // Equipment
                foreach ($generator->generator_equipment as $equipment) {
                    $equipment->delete();
                }

                // Beneficiary
                if (count($generator->beneficiary) > 0) {
                    foreach ($generator->beneficiary as $beneficiary) {
                        $beneficiary->delete();
                    }
                }

                // Effective date
                if (count($generator->beneficiary_effective_date) > 0) {
                    foreach ($generator->beneficiary_effective_date as $effective_date) {
                        $effective_date->delete();
                    }
                }

                // Documents
                if ($generator->document != null) {
                    if ($generator->document->file_access_request_form_path != null) {
                        EngineeringController::destroyDocument($generator->document->file_access_request_form_path);
                    }

                    if ($generator->document->file_art_path != null) {
                        EngineeringController::destroyDocument($generator->document->file_art_path);
                    }

                    if ($generator->document->file_aneel_form_path != null) {
                        EngineeringController::destroyDocument($generator->document->file_aneel_form_path);
                    }

                    if ($generator->document->file_data_sheet_certificates_path != null) {
                        EngineeringController::destroyDocument($generator->document->file_data_sheet_certificates_path);
                    }

                    if ($generator->document->file_descriptive_memorial_path != null) {
                        EngineeringController::destroyDocument($generator->document->file_descriptive_memorial_path);
                    }

                    if ($generator->document->file_electrical_project_path != null) {
                        EngineeringController::destroyDocument($generator->document->file_electrical_project_path);
                    }

                    $generator->document->delete();
                }

                if (count($generator->newfile) > 0) {
                    foreach ($generator->newfile as $new_file) {
                        EngineeringController::destroyDocument($new_file->file_new_path);
                    }

                    $new_file->delete();
                }

                // Images
                if (count($generator->images) > 0) {
                    foreach ($generator->images as $image) {
                        EngineeringController::destroyImage($image->image_generator_path);
                    }

                    $image->delete();
                }

                $generator->delete();
            }

            $project->delete();
            
            return redirect('/engineering')->withInput()
                ->with('success', 'O projeto foi excluído com sucesso.');
        }
        
        else return back()->withInput()->with('error', 'Projeto não encontrado.');
    }

    public function destroyGeneratorAddress()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['id']);
            $id = intval($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $generator = EngineeringGenerator::all()->where('id', $id)->first();

        // Generator
        if ($generator != null) {
            // Equipments
            foreach ($generator->generator_equipment as $equipment) {
               $equipment->delete();
            }

            // Beneficiary
            if (count($generator->beneficiary) > 0) {
                foreach ($generator->beneficiary as $beneficiary) {
                    $beneficiary->delete();
                }
            }

            // Effective date
            if (count($generator->beneficiary_effective_date)) {
                foreach ($generator->beneficiary_effective_date as $effective_date) {
                    $effective_date->delete();
                }
            }

            // Documents
            if ($generator->document != null) {
                if ($generator->document->file_access_request_form_path != null) {
                    EngineeringController::destroyDocument($generator->document->file_access_request_form_path);
                }

                if ($generator->document->file_art_path != null) {
                    EngineeringController::destroyDocument($generator->document->file_art_path);
                }

                if ($generator->document->file_aneel_form_path != null) {
                    EngineeringController::destroyDocument($generator->document->file_aneel_form_path);
                }

                if ($generator->document->file_data_sheet_certificates_path != null) {
                    EngineeringController::destroyDocument($generator->document->file_data_sheet_certificates_path);
                }

                if ($generator->document->file_descriptive_memorial_path != null) {
                    EngineeringController::destroyDocument($generator->document->file_descriptive_memorial_path);
                }

                if ($generator->document->file_electrical_project_path != null) {
                    EngineeringController::destroyDocument($generator->document->file_electrical_project_path);
                }

                $generator->document->delete();
            }

            if (count($generator->newfile) > 0) {
                foreach ($generator->newfile as $new_file) {
                    EngineeringController::destroyDocument($new_file->file_new_path);
                }

                $new_file->delete();
            }

            // Images
            if (count($generator->images) > 0) {
                foreach ($generator->images as $image) {
                    EngineeringController::destroyImage($image->image_generator_path);
                }

                $image->delete();
            }

            $generator->delete();

            return back()->withInput()->with('success', 'A geradora foi excluída com sucesso.');
        }

        else return back()->withInput()->with('error', 'Geradora não encontrada.');
    }

    public function destroyApportionmentList($id)
    {
        try {
            $id = intval(decrypt($id));
        } catch (\Exception $e) {
            return redirect('/');
        }

        $beneficiary_effective_date = BeneficiaryEffectiveDate::all()->where('id', $id)->first();

        if ($beneficiary_effective_date != null) {
            foreach ($beneficiary_effective_date->beneficiary as $beneficiary) {
                $beneficiary->delete();
            } 

            $beneficiary_effective_date->delete();

            return back()->withInput()->with('success', 'A lista de rateio foi excluída com sucesso.');
        }

        else return back()->withInput()->with('error', 'Lista de rateio não encontrada.');
    }

    public function destroyBeneficiaryAddress()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['id']);
            $id = intval($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $beneficiary = EngineeringBeneficiary::all()->where('id', $id)->first();

        if ($beneficiary != null) {
            $beneficiary->delete();

            return back()->withInput()->with('success', 'O endereço foi excluído com sucesso.');
        }
        
        else return back()->withInput()->with('error', 'Endereço não encontrado.');
    }

    /** Destroy generator document in storage */
    public static function destroyGeneratorDocument ($type, $id)
    {
        try {
            $id = intval(decrypt($id));
            $type = substr(decrypt($type), 10);
        } catch (\Exception $e) {
            return redirect('/');
        }

        if ($type == 'new') $document = EngineeringGeneratorDocumentsNewFile::findOrFail($id);
        
        else {
            switch ($type) {
                case 'art':
                    $document = EngineeringDocumentArt::findOrFail($id);
                    break;

                case 'aneel_form':
                    $document = EngineeringDocumentAneel::findOrFail($id);
                    break;

                case 'descriptive_memorial':
                    $document = EngineeringDocumentDescriptiveMemorial::findOrFail($id);
                    break;

                case 'data_sheet_certificates':
                    $document = EngineeringDocumentDataSheetCertificates::findOrFail($id);
                    break;

                case 'electrical_project':
                    $document = EngineeringDocumentElectricalProject::findOrFail($id);
                    break;

                default:
                    $document = EngineeringGeneratorDocuments::findOrFail($id);
                    break;
            }
        }

        if ($document != null) {
            switch ($type) {
                // Access Request Form
                case 'access_request_form':
                    self::destroyDocument($document->file_access_request_form_path);
                    $document->delete();
                    break;

                // ART
                case 'art':
                    self::destroyDocument($document->file_art_path);
                    $document->delete();
                    break;

                // ANEEL Form
                case 'aneel_form':
                    self::destroyDocument($document->file_aneel_form_path);
                    $document->delete();
                    break;

                // Data Sheet and Certificates
                case 'data_sheet_certificates':
                    self::destroyDocument($document->file_data_sheet_certificates_path);
                    $document->delete();
                    break;

                // Descriptive Memorial
                case 'descriptive_memorial':
                    self::destroyDocument($document->file_descriptive_memorial_path);
                    $document->delete();
                    break;

                // Electrical Project
                case 'electrical_project':
                    self::destroyDocument($document->file_electrical_project_path);
                    $document->delete();
                    break;

                // New file
                case 'new':
                    self::destroyDocument($document->file_new_path);
                    $document->delete();
                    break;
            }

            return redirect()->route('engineering_project_show', [
                'id' => encrypt($document->generator->project->id)
            ])->with('success', 'Documento excluído com sucesso.');
        }

        else return back()->withInput()->with('error', 'Documento não encontrado.');
    }

    public function handleDestroyGeneratorImage()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['image']);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Geradora não encontrada.');
        }

        $image = EngineeringGeneratorImages::findOrFail($id);

        switch ($image->type) {
            case 'VISTORIA_PREVIA':
                $type = 'previous';
                break;

            case 'INSTALACAO':
                $type = 'installation';
                break;

            case 'VISTORIA_FINAL':
                $type = 'final';
                break;

            case 'OUTRAS':
                $type = 'others';
                break;
        }

        if ($image != null) {
            $image_path = substr($image->image_generator_path, 8);

            if (Storage::disk('engineering')->exists($image_path)) Storage::delete('engineering' . '/' . $image_path);

            $image->delete();

            // Generator images by type
            $generator = EngineeringGenerator::all()->where('id', $image->engineering_generator_id)->first();
            $arr_images_type_previous = [];
            $arr_images_type_installation = [];
            $arr_images_type_final = [];
            $arr_images_type_others = [];

            foreach ($generator->images as $generator_image) {
                if ($generator_image->type == 'VISTORIA_PREVIA') {
                    array_push($arr_images_type_previous, $generator_image);
                }

                if ($generator_image->type == 'INSTALACAO') {
                    array_push($arr_images_type_installation, $generator_image);
                }

                if ($generator_image->type == 'VISTORIA_FINAL') {
                    array_push($arr_images_type_final, $generator_image);
                }

                if ($generator_image->type == 'OUTRAS') {
                    array_push($arr_images_type_others, $generator_image);
                }
            }

            $qty_images_type_previous = count($arr_images_type_previous);
            $qty_images_type_installation = count($arr_images_type_installation);
            $qty_images_type_final = count($arr_images_type_final);
            $qty_images_type_others = count($arr_images_type_others);

            return response()->json([
                'status' => true,
                'message' => 'Imagem excluída com sucesso.',
                'type' => $type,
                'qty_images_type_previous' => $qty_images_type_previous,
                'qty_images_type_installation' => $qty_images_type_installation,
                'qty_images_type_final' => $qty_images_type_final,
                'qty_images_type_others' => $qty_images_type_others,
            ]);
        }

        else {
            return response()->json([
                'status' => false,
                'message' => 'Imagem não encontrada.',
            ]);
        }
    }

    public static function destroyDocument($request)
    {
        $file_path = substr($request, 8);
        $path = explode('/', $file_path);

        if ($path[1] == 'new') {
            $new_file_path = $path[0] . '/' . $path[1] . '/' . $path[2] . '/' . $path[3];

            if (Storage::disk('engineering')->exists($file_path)) {
                if (count(Storage::files('engineering/' . $new_file_path)) > 1) {
                    Storage::delete('engineering/' . $file_path);
                }

                else Storage::deleteDirectory('engineering/' . $new_file_path);
            }
        }

        else Storage::delete('engineering/' . $file_path);
    }

    public function destroyImage($request)
    {
        $image_path = substr($request, 8);

        if (Storage::disk('engineering')->exists($image_path)) Storage::delete('engineering' . '/' . $image_path);
    }

    public function destroyProtocol()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['id']);
            $id = intval($id);
            $type = decrypt($data['type']);
        } catch (\Exception $e) {
            return redirect('/');
        }

        switch ($type) {
            case 'submission':
                $submission = ProtocolProjectSubmission::all()->where('id', $id)->first();
                $generator = EngineeringGenerator::all()->where('id', $submission->generator_id)->first();
                $generator->generator_status = EngineeringController::$ACTIVE;
                $generator->save();

                if ($submission != null) {
                    $submission->delete();
        
                    return back()->withInput()->with('success', 'O protocolo foi excluído com sucesso.');
                }

                break;

            case 'feedback':
                $feedback = ProtocolRequestFeedback::all()->where('id', $id)->first();
                $generator = EngineeringGenerator::all()->where('id', $feedback->generator_id)->first();
                $submission = ProtocolProjectSubmission::all()->where('generator_id', $generator->id)->first();
                
                if ($submission != null) {
                    $generator->generator_status = EngineeringController::$SUBJECT;
                    $generator->save();
                }

                else {
                    $generator->generator_status = EngineeringController::$ACTIVE;
                    $generator->save();
                }

                if ($feedback != null) {
                    $feedback->delete();
        
                    return back()->withInput()->with('success', 'O protocolo foi excluído com sucesso.');
                }

                break;

            case 'issued':
                $issued = ProtocolFeedbackIssued::all()->where('id', $id)->first();
                $generator = EngineeringGenerator::all()->where('id', $issued->generator_id)->first();
                $submission = ProtocolProjectSubmission::all()->where('generator_id', $generator->id)->first();
                $feedback = ProtocolRequestFeedback::all()->where('generator_id', $generator->id)->first();
                
                if ($submission != null && $feedback == null) {
                    $generator->generator_status = EngineeringController::$SUBJECT;
                    $generator->save();
                }

                else if ($feedback != null) {
                    $generator->generator_status = EngineeringController::$PROTOCOLED;
                    $generator->save();
                }

                else {
                    $generator->generator_status = EngineeringController::$ACTIVE;
                    $generator->save();
                }

                if ($issued != null) {
                    $issued->delete();
        
                    return back()->withInput()->with('success', 'O protocolo foi excluído com sucesso.');
                }

                break;

            case 'provisional':
                $provisional = ProtocolProvisionalRequest::all()->where('id', $id)->first();
                $generator = EngineeringGenerator::all()->where('id', $provisional->generator_id)->first();
                $submission = ProtocolProjectSubmission::all()->where('generator_id', $generator->id)->first();
                $feedback = ProtocolRequestFeedback::all()->where('generator_id', $generator->id)->first();
                $issued = ProtocolFeedbackIssued::all()->where('generator_id', $generator->id)->first();
                
                if ($submission != null && $feedback == null && $issued == null) {
                    $generator->generator_status = EngineeringController::$SUBJECT;
                    $generator->save();
                }

                else if ($feedback != null && $issued == null) {
                    $generator->generator_status = EngineeringController::$PROTOCOLED;
                    $generator->save();
                }

                else if ($issued != null) {
                    $generator->generator_status = EngineeringController::$ISSUED;
                    $generator->save();
                }

                else {
                    $generator->generator_status = EngineeringController::$ACTIVE;
                    $generator->save();
                }

                if ($provisional != null) {
                    $provisional->delete();
        
                    return back()->withInput()->with('success', 'O protocolo foi excluído com sucesso.');
                }

                break;

            case 'survey':
                $survey = ProtocolSurvey::all()->where('id', $id)->first();
                $generator = EngineeringGenerator::all()->where('id', $survey->generator_id)->first();
                $submission = ProtocolProjectSubmission::all()->where('generator_id', $generator->id)->first();
                $feedback = ProtocolRequestFeedback::all()->where('generator_id', $generator->id)->first();
                $issued = ProtocolFeedbackIssued::all()->where('generator_id', $generator->id)->first();
                $provisional = ProtocolProvisionalRequest::all()->where('generator_id', $generator->id)->first();
                
                if ($submission != null && $feedback == null && $issued == null && $provisional == null) {
                    $generator->generator_status = EngineeringController::$SUBJECT;
                    $generator->save();
                }

                else if ($feedback != null && $issued == null && $provisional == null) {
                    $generator->generator_status = EngineeringController::$PROTOCOLED;
                    $generator->save();
                }

                else if ($issued != null && $provisional == null) {
                    $generator->generator_status = EngineeringController::$ISSUED;
                    $generator->save();
                }

                else if ($provisional != null) {
                    $generator->generator_status = EngineeringController::$PROVISIONAL;
                    $generator->save();
                }

                else {
                    $generator->generator_status = EngineeringController::$ACTIVE;
                    $generator->save();
                }

                if ($survey != null) {
                    $survey->delete();
        
                    return back()->withInput()->with('success', 'O protocolo foi excluído com sucesso.');
                }

                break;

            case 'homologated':
                $homologated = ProtocolHomologated::all()->where('id', $id)->first();
                $generator = EngineeringGenerator::all()->where('id', $homologated->generator_id)->first();
                $submission = ProtocolProjectSubmission::all()->where('generator_id', $generator->id)->first();
                $feedback = ProtocolRequestFeedback::all()->where('generator_id', $generator->id)->first();
                $issued = ProtocolFeedbackIssued::all()->where('generator_id', $generator->id)->first();
                $provisional = ProtocolProvisionalRequest::all()->where('generator_id', $generator->id)->first();
                $survey = ProtocolSurvey::all()->where('generator_id', $generator->id)->first();
                
                if ($submission != null && $feedback == null && $issued == null && $provisional == null) {
                    $generator->generator_status = EngineeringController::$SUBJECT;
                    $generator->save();
                }

                else if ($feedback != null && $issued == null && $provisional == null) {
                    $generator->generator_status = EngineeringController::$PROTOCOLED;
                    $generator->save();
                }

                else if ($issued != null && $provisional == null) {
                    $generator->generator_status = EngineeringController::$ISSUED;
                    $generator->save();
                }

                else if ($provisional != null) {
                    $generator->generator_status = EngineeringController::$PROVISIONAL;
                    $generator->save();
                }

                else if ($survey != null) {
                    $generator->generator_status = EngineeringController::$SURVEY;
                    $generator->save();
                }

                else {
                    $generator->generator_status = EngineeringController::$ACTIVE;
                    $generator->save();
                }

                if ($homologated != null) {
                    $homologated->delete();
        
                    return back()->withInput()->with('success', 'O protocolo foi excluído com sucesso.');
                }

                break;
        }
    }

    /** Store new apportionment list in storage */
    public static function createNewApportionmentList(Request $request, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $data = $request->all();
        $generator = EngineeringGenerator::findOrFail($id);

        if ($generator->exists()) {
            // Update beneficiary Effective Date
            $old_beneficiary_effective_date = BeneficiaryEffectiveDate::all()
                ->where('generator_id', $generator->id)
                ->where('status', 1)
                ->first();
            $old_beneficiary_effective_date->status = false;
            $old_beneficiary_effective_date->save();

            // Create beneficiary effective date
            $new_beneficiary_effective_date = BeneficiaryEffectiveDate::create([
                'generator_id' => $generator->id,
                'effective_date' => date('Y-m-d'),
                'status' => true,
            ]);

            foreach ($data['beneficiaries'] as $beneficiary) {
                $customBeneficiariesMessages = [
                    'required' => 'Preencha o campo :attribute',
                ];
    
                $beneficiariesAttributes = [
                    'beneficiary-contract-account' => 'Conta Contrato Beneficiária',
                    'beneficiary-other-contract-account' => 'Outra Conta Contrato Beneficiária',
                    'beneficiary-consumption-class' => 'Classe de Consumo',
                    'beneficiary-rate' => 'Taxa',
                    'beneficiary-address' => 'Endereço',
                ];
    
                $validator_beneficiaries = Validator::make($beneficiary, [
                    'beneficiary-contract-account' => [
                        Rule::requiredIf($beneficiary['beneficiary-contract-account'] != null)
                    ],
                    'beneficiary-other-contract-account' => [
                        Rule::requiredIf($beneficiary['beneficiary-contract-account'] == null)
                    ],
                    'beneficiary-consumption-class' => [
                        'required'
                    ],
                    'beneficiary-rate' => [
                        'required'
                    ],
                    'beneficiary-address' => [
                        'required'
                    ],
                ], $customBeneficiariesMessages, $beneficiariesAttributes);
                
                if ($validator_beneficiaries->fails()) {
                    foreach ($validator_beneficiaries->getMessageBag()->getMessages() as $error) {
                        return back()->withInput($request->all())->with('error', $error[0]);
                    }
                }
    
                else {
                    // Beneficiary client
                    if ($generator->generator_project_type == 'GERACAO_COMPARTILHADA') {
                        $data_beneficiary_client = $beneficiary['beneficiary-client'];

                        $beneficiary_client = Client::where('name', $data_beneficiary_client)
                            ->orWhere('corporate_name', $data_beneficiary_client)
                            ->first();

                        if ($beneficiary_client != null && $beneficiary_client->exists()) {
                            if ($beneficiary_client->is_corporate) {
                                $corporate_beneficiary_client = Client::all()
                                    ->where('corporate_name', $data_beneficiary_client)
                                    ->first();

                                if ($corporate_beneficiary_client != null) {
                                    $beneficiary_client_id = $corporate_beneficiary_client->id;
                                }

                                else $beneficiary_client_id = $generator->client_id;
                            }

                            else {
                                $not_corporate_beneficiary_client = Client::all()
                                    ->where('name', $data_beneficiary_client)->first();

                                if ($not_corporate_beneficiary_client != null) {
                                    $beneficiary_client_id = $not_corporate_beneficiary_client->id;
                                }

                                else $beneficiary_client_id = $generator->client_id;
                            }
                        }

                        else $beneficiary_client_id = $generator->client_id;
                    }

                    else $beneficiary_client_id = null;

                    // Beneficiary contract account value
                    if ($beneficiary['beneficiary-contract-account'] == null) {
                        $beneficiary_contract_account = $beneficiary['beneficiary-other-contract-account'];
                        $different_beneficiary_contract_account = true;
                    }

                    else {
                        $beneficiary_contract_account = $beneficiary['beneficiary-contract-account'];
                        $different_beneficiary_contract_account = false;
                    }

                    // Create beneficiaries
                    EngineeringBeneficiary::create([
                        'engineering_generator_id' => $generator->id,
                        'beneficiary_effective_date_id' => $new_beneficiary_effective_date->id,
                        'client_id' => $beneficiary_client_id,
                        'different_beneficiary_contract_account' => $different_beneficiary_contract_account,
                        'beneficiary_contract_account' => $beneficiary_contract_account,
                        'beneficiary_consumption_class' => decrypt($beneficiary['beneficiary-consumption-class']),
                        'beneficiary_rate' => doubleval(str_replace(',', '.', $beneficiary['beneficiary-rate'])),
                        'beneficiary_address' => $beneficiary['beneficiary-address'],
                    ]);
                }
            }

            return redirect()->route('engineering_project_show', ['id' => encrypt($generator->project->id)])
                ->with('success', 'Lista de rateio criada com sucesso.');
        }

        else return back()->withInput()->with('error', 'Contrato não encontrado.');
    }

    /** Get active Apportionment List data via Fetch */
    public function get_active_apportionment_list_fetch () 
    {
        $request = Request::capture();
        $data = $request->all();
        $generator_id = $data['generator'];
        $generator = EngineeringGenerator::where('id', $generator_id)->first();
        $arr_generator = [];
        $arr_beneficiaries = [];

        if (count($generator->beneficiary_effective_date) > 0) {
            $status = true;

            // All clients
            $clients = Client::orderBy('name', 'ASC')->get();
            $clients_names = [];

            foreach ($clients as $client) {
                if ($client->is_corporate) array_push($clients_names, $client->corporate_name);
                else array_push($clients_names, $client->name);
            }

            // Contract client credentials
            $contractClientHasCredentials = $generator->project->contract->client->login != null && $generator->project->contract->client->password != null;
            $contractClientHasNotCredentials = $generator->project->contract->client->login == null && $generator->project->contract->client->password == null;

            // Generator client
            $client = Client::all()->where('id', $generator->client_id)->first();
            $generator_client = $client->is_corporate ? $client->corporate_name : $client->name;

            // Generator contracted generation production
            $generator_contracted_generation_production = number_format((($generator->project->contract->monthly_avg_generation * 1000 / $generator->project->contract->getGeneratorPowerValue()) * $generator->generator_power) / 1000, '2', ',', '.');

            // Generator consumption
            $generator_consumption = number_format($generator->generator_consumption, 2, ',', '.');

            // Beneficiaries that belong to the Generator's Apportionment List
            foreach ($generator->beneficiary_effective_date as $beneficiary_effective_date) {
                if ($beneficiary_effective_date->status) {
                    $beneficiaries = EngineeringBeneficiary::all()->where('beneficiary_effective_date_id', $beneficiary_effective_date->id);
                }
            }

            foreach ($beneficiaries as $key => $beneficiary) {
                if ($beneficiary->client != null) {
                    $differentGeneratorBeneficiaryClient = $generator->client->id != $beneficiary->client->id ?
                        true :
                        false;

                    $beneficiaryClient = $beneficiary->client->is_corporate ?
                        $beneficiary->client->corporate_name :
                        $beneficiary->client->name;

                    $beneficiaryClientHasCredentials = $beneficiary->client->login != null && $beneficiary->client->password != null ?
                        true :
                        false;
                }

                else {
                    $differentGeneratorBeneficiaryClient = false;
                    $beneficiaryClient = $generator_client;
                    $beneficiaryClientHasCredentials = false;
                }
                
                $diferentBeneficiaryContractAccount = $beneficiary->different_beneficiary_contract_account == 1 ?
                    true :
                    false;
                
                array_push($arr_beneficiaries, [
                    'id' => encrypt($beneficiary->id),
                    'engineering_generator_id' => encrypt($beneficiary->engineering_generator_id),
                    'beneficiary_effective_date_id' => encrypt($beneficiary->beneficiary_effective_date_id),
                    'different_generator_beneficiary_client' => $differentGeneratorBeneficiaryClient,
                    'beneficiary_client' => $beneficiaryClient,
                    'different_beneficiary_contract_account' => $diferentBeneficiaryContractAccount,
                    'beneficiary_client_has_credentials' => $beneficiaryClientHasCredentials,
                    'beneficiary_contract_account' => $beneficiary->beneficiary_contract_account,
                    'beneficiary_consumption_class' => $beneficiary->beneficiary_consumption_class,
                    'beneficiary_rate' => $beneficiary->beneficiary_rate,
                    'beneficiary_address' => $beneficiary->beneficiary_address,
                ]);
            }

            array_push($arr_generator, [
                'clients' => $clients_names,
                'generator_project_type' => $generator->generator_project_type,
                'contract_client_has_credentials' => $contractClientHasCredentials,
                'contract_client_has_not_credentials' => $contractClientHasNotCredentials,
                'beneficiaries' => $arr_beneficiaries
            ]);

            return response()->json([
                'status' => $status,
                'generator' => $arr_generator
            ]);
        }

        else {
            $status = false;
            
            return response()->json([
                'status' => $status,
                'beneficiaries' => []
            ]);
        }
    }

    /** Send email when a engineering project is created or updated */
    public static function sendEngineeringProjectMail($contract, $project, $type)
    {
        $email = 'engenharia@sunnyhouse.com.br';

        $client_name = $contract->client->is_corporate ? $contract->client->corporate_name : $contract->client->name;
        $generator_power = $contract->getGeneratorPowerPrint();

        $maildata = [
            'client' => $client_name,
            'power' => $generator_power,
            'project' => $project
        ];
        
        Mail::to($email)->send(new EngineeringProjectMail($maildata, $type));
    }

    /** Store generator documents in storage */
    public function storeGeneratorDocuments(Request $request, $id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Geradora não encontrado.');
        }

        $data = $request->all();
        $generator = EngineeringGenerator::all()->where('id', $id)->first();

        if ($generator->exists()) {
            $customMessages = [
                'required' => 'Preencha o campo :attribute',
                'file' => 'O campo :attribute permite somente arquivos',
                'mimes' => 'O arquivo :attribute deve ser no formato :values.',
                'max' => [
                    'file' => 'O arquivo :attribute não pode ser maior do que 20 MB.',
                ],
            ];

            $attributes = [
                'generator-documents-art' => 'ART',
                'generator-documents-aneel' => 'Formulário ANEEL',
                'generator-documents-certificates' => 'Folha de Dados e Certificados',
                'generator-documents-memorial' => 'Memorial Descritivo',
                'generator-documents-electrical' => 'Projeto Elétrico',
                'generator-documents-new.*.file' => 'Novo Arquivo'
            ];

            $validator = Validator::make($data, [
                'generator-documents-art' => [
                    'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                ],
                'generator-documents-aneel' => [
                    Rule::requiredIf(array_key_exists('generator-documents-aneel', $request->file())), 'file', 'mimes:pdf,jpg,png', 'max:20480',
                ],
                'generator-documents-certificates' => [
                    'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                ],
                'generator-documents-memorial' => [
                    'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                ],
                'generator-documents-electrical' => [
                    'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                ],
                'generator-documents-new.*.file' => [
                    Rule::requiredIf(array_key_exists('generator-documents-new', $request->file())), 'file', 'mimes:pdf,jpg,png', 'max:20480',
                ]
            ], $customMessages, $attributes);

            if ($validator->fails()) {
                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    $error = $error[0];
                    return back()->withInput()->with('error', $error);
                }
            }

            else {
                $generator_contract_account = $generator->generator_contract_account;

                // ART
                $art_info = self::fileUpload($request->file()['generator-documents-art'], 'documents/art/' . $generator_contract_account);
                $art_name = $art_info[0];
                $art_path = $art_info[1];

                // ANEEL Form
                if (array_key_exists('generator-documents-aneel', $request->file())) {
                    $aneel_info = self::fileUpload($request->file()['generator-documents-aneel'], 'documents/aneel_form/' . $generator_contract_account);
                    $aneel_name = $aneel_info[0];
                    $aneel_path = $aneel_info[1];
                }

                // Data Sheet and Certificates
                $certificate_info = self::fileUpload($request->file()['generator-documents-certificates'], 'documents/data_sheet_certificates/' . $generator_contract_account);
                $certificate_name = $certificate_info[0];
                $certificate_path = $certificate_info[1];

                // Descriptive Memorial
                $memorial_info = self::fileUpload($request->file()['generator-documents-memorial'], 'documents/descriptive_memorial/' . $generator_contract_account);
                $memorial_name = $memorial_info[0];
                $memorial_path = $memorial_info[1];

                // Electrical generator
                $electrical_info = self::fileUpload($request->file()['generator-documents-electrical'], 'documents/electrical_project/' . $generator_contract_account);
                $electrical_name = $electrical_info[0];
                $electrical_path = $electrical_info[1];

                // New
                if (array_key_exists('generator-documents-new', $request->file())) {
                    foreach($data['generator-documents-new'] as $key => $new_file) {
                        $filename = ucwords(mb_strtolower($new_file['name'], 'UTF-8'));
                        $new_info = self::fileUpload($request->file()['generator-documents-new'][$key]['file'], 'documents/new/' . $generator_contract_account . '/' . str_replace('-', '', $key));
                        $new_name = $new_info[0];
                        $new_path = $new_info[1];

                        EngineeringGeneratorDocumentsNewFile::create([
                            'engineering_generator_id' => $id,
                            'name' => $filename,
                            'file_new_name' => $new_name,
                            'file_new_path' => $new_path,
                        ]);
                    }
                }

                // Create document ART
                EngineeringDocumentArt::create([
                    'generator_id' => $id,
                    'file_art_name' => $art_name,
                    'file_art_path' => $art_path,
                ]);

                // Create document ANEEL
                if (array_key_exists('generator-documents-aneel', $request->file())) {
                    EngineeringDocumentAneel::create([
                        'generator_id' => $id,
                        'file_aneel_form_name' => $aneel_name,
                        'file_aneel_form_path' => $aneel_path,
                    ]);
                }

                // Create document Data Sheet Certificates
                EngineeringDocumentDataSheetCertificates::create([
                    'generator_id' => $id,
                    'file_data_sheet_certificates_name' => $certificate_name,
                    'file_data_sheet_certificates_path' => $certificate_path,
                ]);

                // Create document Descriptive Memorial
                EngineeringDocumentDescriptiveMemorial::create([
                    'generator_id' => $id,
                    'file_descriptive_memorial_name' => $memorial_name,
                    'file_descriptive_memorial_path' => $memorial_path,
                ]);

                // Create document Electrical Project
                EngineeringDocumentElectricalProject::create([
                    'generator_id' => $id,
                    'file_electrical_project_name' => $electrical_name,
                    'file_electrical_project_path' => $electrical_path,
                ]);

                return redirect()->route('engineering_project_show', [
                    'id' => encrypt($generator->engineering_project_id)
                ])->with('success', 'Documento(s) salvo(s) com sucesso.');
            }
        }

        else return back()->withInput()->with('error', 'Geradora não encontrada.');
    }

    /** Update generator documents in storage */
    public function updateGeneratorDocuments(Request $request, $type, $id)
    {
        try {
            $id = decrypt($id);
            $type = decrypt($type);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Geradora não encontrado.');
        }

        $data = $request->all();

        if ($type == 'new') {
            $new_file = EngineeringGeneratorDocumentsNewFile::all()->where('id', $id)->first();
            $generator = EngineeringGenerator::all()->where('id', $new_file->engineering_generator_id)->first();
        }

        else $generator = EngineeringGenerator::all()->where('id', $id)->first();

        if ($generator->exists()) {
            $customMessages = [
                'required' => 'Preencha o campo :attribute',
                'file' => 'O campo :attribute permite somente arquivos',
                'mimes' => 'O arquivo :attribute deve ser no formato :values.',
                'max' => [
                    'file' => 'O arquivo :attribute não pode ser maior do que 20 MB.',
                ],
            ];

            switch ($type) {
                // ART
                case 'art':
                    $documents_art = EngineeringDocumentArt::all()
                        ->where('generator_id', $generator->id)
                        ->first();
        
                    $attribute = [
                        'generator-documents-art' => 'ART'
                    ];
        
                    $validator = Validator::make($data, [
                        'generator-documents-art' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if (array_key_exists('generator-documents-art', $request->file())) {
                            $art_info = self::fileUpload($request->file()['generator-documents-art'], 'documents/art/' . $generator->generator_contract_account);
                            $art_name = $art_info[0];
                            $art_path = $art_info[1];

                            if ($documents_art != null && $documents_art->file_art_path != 'NULL') {
                                self::destroyDocument($documents_art->file_art_path);
                            }
                        }
    
                        else {
                            $art_name = $documents_art->file_art_name;
                            $art_path = $documents_art->file_art_path;
                        }

                        // If ART document doesn't exists: CREATE; else: UPDATE
                        if ($documents_art == null) {
                            EngineeringDocumentArt::create([
                                'generator_id' => $id,
                                'file_art_name' => $art_name,
                                'file_art_path' => $art_path,
                            ]);
                        }
    
                        else {
                            $documents_art->file_art_name = $art_name;
                            $documents_art->file_art_path = $art_path;
                            $documents_art->save();
                        }
    
                        return redirect()->route('engineering_project_show', [
                            'id' => encrypt($generator->engineering_project_id)
                        ])->with('success', 'Documento atualizado com sucesso.');
                    }
        
                    break;
        
                // ANEEL Form
                case 'aneel_form':
                    $documents_aneel = EngineeringDocumentAneel::all()
                        ->where('generator_id', $generator->id)
                        ->first();
        
                    $attribute = [
                        'generator-documents-aneel' => 'Formulário ANEEL'
                    ];
        
                    $validator = Validator::make($data, [
                        'generator-documents-aneel' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if (array_key_exists('generator-documents-aneel', $request->file())) {
                            $aneel_info = self::fileUpload($request->file()['generator-documents-aneel'], 'documents/aneel_form/' . $generator->generator_contract_account);
                            $aneel_name = $aneel_info[0];
                            $aneel_path = $aneel_info[1];

                            if ($documents_aneel != null && $documents_aneel->file_aneel_form_path != null) {
                                self::destroyDocument($documents_aneel->file_aneel_form_path);
                            }
                        }
    
                        else {
                            $aneel_name = $documents_aneel->file_aneel_form_name;
                            $aneel_path = $documents_aneel->file_aneel_form_path;
                        }

                        // If ANEEL Form document doesn't exists: CREATE; else: UPDATE
                        if ($documents_aneel == null) {
                            EngineeringDocumentAneel::create([
                                'generator_id' => $id,
                                'file_aneel_form_name' => $aneel_name,
                                'file_aneel_form_path' => $aneel_path,
                            ]);
                        }

                        else {
                            $documents_aneel->file_aneel_form_name = $aneel_name;
                            $documents_aneel->file_aneel_form_path = $aneel_path;
                            $documents_aneel->save();
                        }
    
    
                        return redirect()->route('engineering_project_show', [
                            'id' => encrypt($generator->engineering_project_id)
                        ])->with('success', 'Documento atualizado com sucesso.');
                    }
        
                    break;
        
                // Data Sheet and Certificates
                case 'data_sheet_certificates':
                    $documents_certificates = EngineeringDocumentDataSheetCertificates::all()
                        ->where('generator_id', $generator->id)
                        ->first();
        
                    $attribute = [
                        'generator-documents-certificates' => 'Folha de Dados e Certificados'
                    ];
        
                    $validator = Validator::make($data, [
                        'generator-documents-certificates' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if (array_key_exists('generator-documents-certificates', $request->file())) {
                            $certificates_info = self::fileUpload($request->file()['generator-documents-certificates'], 'documents/data_sheet_certificates/' . $generator->generator_contract_account);
                            $certificates_name = $certificates_info[0];
                            $certificates_path = $certificates_info[1];

                            if ($documents_certificates != null && $documents_certificates->file_data_sheet_certificates_path != 'NULL') {
                                self::destroyDocument($documents_certificates->file_data_sheet_certificates_path);
                            }
                        }
    
                        else {
                            $certificates_name = $documents_certificates->file_data_sheet_certificates_name;
                            $certificates_path = $documents_certificates->file_data_sheet_certificates_path;
                        }

                        // If Data Sheet Certificates document doesn't exists: CREATE; else: UPDATE
                        if ($documents_certificates == null) {
                            EngineeringDocumentDataSheetCertificates::create([
                                'generator_id' => $id,
                                'file_data_sheet_certificates_name' => $certificate_name,
                                'file_data_sheet_certificates_path' => $certificate_path,
                            ]);
                        }

                        else {
                            $documents_certificates->file_data_sheet_certificates_name = $certificates_name;
                            $documents_certificates->file_data_sheet_certificates_path = $certificates_path;
                            $documents_certificates->save();
                        }
    
                        return redirect()->route('engineering_project_show', [
                            'id' => encrypt($generator->engineering_project_id)
                        ])->with('success', 'Documento atualizado com sucesso.');
                    }
        
                    break;
        
                // Descriptive Memorial
                case 'descriptive_memorial':
                    $documents_memorial = EngineeringDocumentDescriptiveMemorial::all()
                        ->where('generator_id', $generator->id)
                        ->first();
        
                    $attribute = [
                        'generator-documents-memorial' => 'Memorial Descritivo'
                    ];
        
                    $validator = Validator::make($data, [
                        'generator-documents-memorial' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if (array_key_exists('generator-documents-memorial', $request->file())) {
                            $memorial_info = self::fileUpload($request->file()['generator-documents-memorial'], 'documents/descriptive_memorial/' . $generator->generator_contract_account);
                            $memorial_name = $memorial_info[0];
                            $memorial_path = $memorial_info[1];

                            if ($documents_memorial != null && $documents_memorial->file_descriptive_memorial_path != 'NULL') {
                                self::destroyDocument($documents_memorial->file_descriptive_memorial_path);
                            }
                        }
    
                        else {
                            $memorial_name = $documents_memorial->file_descriptive_memorial_name;
                            $memorial_path = $documents_memorial->file_descriptive_memorial_path;
                        }

                        // If Descriptive Memorial document doesn't exists: CREATE; else: UPDATE
                        if ($documents_memorial == null) {
                            EngineeringDocumentDescriptiveMemorial::create([
                                'generator_id' => $id,
                                'file_descriptive_memorial_name' => $memorial_name,
                                'file_descriptive_memorial_path' => $memorial_path,
                            ]);
                        }

                        else {
                            $documents_memorial->file_descriptive_memorial_name = $memorial_name;
                            $documents_memorial->file_descriptive_memorial_path = $memorial_path;
                            $documents_memorial->save();
                        }
    
                        return redirect()->route('engineering_project_show', [
                            'id' => encrypt($generator->engineering_project_id)
                        ])->with('success', 'Documento atualizado com sucesso.');
                    }
        
                    break;
        
                // Electrical Project
                case 'electrical_project':
                    $documents_electrical = EngineeringDocumentElectricalProject::all()
                        ->where('generator_id', $generator->id)
                        ->first();
        
                    $attribute = [
                        'generator-documents-electrical' => 'Projeto Elétrico'
                    ];
        
                    $validator = Validator::make($data, [
                        'generator-documents-electrical' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if (array_key_exists('generator-documents-electrical', $request->file())) {
                            $electrical_info = self::fileUpload($request->file()['generator-documents-electrical'], 'documents/electrical_project/' . $generator->generator_contract_account);
                            $electrical_name = $electrical_info[0];
                            $electrical_path = $electrical_info[1];

                            if ($documents_electrical != null && $documents_electrical->file_electrical_project_path != 'NULL') {
                                self::destroyDocument($documents_electrical->file_electrical_project_path);
                            }
                        }
    
                        else {
                            $electrical_name = $documents_electrical->file_electrical_project_name;
                            $electrical_path = $documents_electrical->file_electrical_project_path;
                        }

                        // If Electrical Project document doesn't exists: CREATE; else: UPDATE
                        if ($documents_electrical == null) {
                            EngineeringDocumentElectricalProject::create([
                                'generator_id' => $id,
                                'file_electrical_project_name' => $electrical_name,
                                'file_electrical_project_path' => $electrical_path,
                            ]);
                        }

                        else {
                            $documents_electrical->file_electrical_project_name = $electrical_name;
                            $documents_electrical->file_electrical_project_path = $electrical_path;
                            $documents_electrical->save();
                        }
    
                        return redirect()->route('engineering_project_show', [
                            'id' => encrypt($generator->engineering_project_id)
                        ])->with('success', 'Documento atualizado com sucesso.');
                    }
        
                    break;

                // New File
                case 'new':
                    $documents_new = EngineeringGeneratorDocumentsNewFile::all()
                        ->where('id', $id)
                        ->first();
        
                    $attribute = ['generator-documents-new' => $documents_new->name];
        
                    $validator = Validator::make($data, [
                        'generator-documents-new' => [
                            'required', 'file', 'mimes:pdf,jpg,png', 'max:20480',
                        ],
                    ], $customMessages, $attribute);
        
                    if ($validator->fails()) {
                        foreach ($validator->getMessageBag()->getMessages() as $error) {
                            return back()->withInput()->with('error', $error[0]);
                        }
                    }
        
                    else {
                        if (array_key_exists('generator-documents-new', $request->file())) {
                            $new_item = explode('/', $documents_new->file_new_path)[4];
                            $new_info = self::fileUpload($request->file()['generator-documents-new'], 'documents/new/' . $generator->generator_contract_account . '/' . $new_item);
                            $new_name = $new_info[0];
                            $new_path = $new_info[1];

                            self::destroyDocument($documents_new->file_new_path);
                        }
    
                        else {
                            $new_name = $documents_new->file_new_name;
                            $new_path = $documents_new->file_new_path;
                        }
    
                        $documents_new->file_new_name = $new_name;
                        $documents_new->file_new_path = $new_path;
                        $documents_new->save();
    
                        return redirect()->route('engineering_project_show', [
                            'id' => encrypt($generator->engineering_project_id)
                        ])->with('success', 'Documento atualizado com sucesso.');
                    }
        
                    break;

                // Create New File from edit modal
                case 'newfile':
                    if (array_key_exists('generator-documents-new', $request->file())) {
                        $customMessages = [
                            'required' => 'Preencha o campo :attribute',
                            'file' => 'O campo :attribute permite somente arquivos',
                            'mimes' => 'O arquivo :attribute deve ser no formato :values.',
                            'max' => [
                                'file' => 'O arquivo :attribute não pode ser maior do que 2 MB.',
                            ],
                        ];
            
                        $attributes = ['generator-documents-new.*.file' => 'Novo Arquivo'];
            
                        $validator = Validator::make($data, [
                            'generator-documents-new.*.file' => [
                                Rule::requiredIf(array_key_exists('generator-documents-new', $request->file())), 'file', 'mimes:pdf,jpg,png', 'max:20480',
                            ]
                        ], $customMessages, $attributes);
            
                        if ($validator->fails()) {
                            foreach ($validator->getMessageBag()->getMessages() as $error) {
                                $error = $error[0];
                                return back()->withInput()->with('error', $error);
                            }
                        }
            
                        else {
                            $generator_contract_account = $generator->generator_contract_account;

                            foreach($data['generator-documents-new'] as $key => $new_file) {
                                $filename = ucwords(mb_strtolower($new_file['name'], 'UTF-8'));
                                $new_info = self::fileUpload($request->file()['generator-documents-new'][$key]['file'], 'documents/new/' . $generator_contract_account . '/' . str_replace('-', '', $key));
                                $new_name = $new_info[0];
                                $new_path = $new_info[1];
            
                                EngineeringGeneratorDocumentsNewFile::create([
                                    'engineering_generator_id' => $id,
                                    'name' => $filename,
                                    'file_new_name' => $new_name,
                                    'file_new_path' => $new_path,
                                ]);
                            }

                            return redirect()->route('engineering_project_show', [
                                    'id' => encrypt($generator->engineering_project_id)])
                                ->with('success', 'Documentos salvos com sucesso.');
                        }
                    }

                    else {
                        return redirect()
                            ->route('engineering_project_show', ['id' => encrypt($generator->engineering_project_id)])
                            ->with('warning', 'Nenhum documento foi salvo.');
                    }

                    break;
            }
        }

        else return back()->withInput()->with('error', 'Geradora não encontrada.');
    }

    /** Store generator images in storage */
    public function handleStoreGeneratorImages() 
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['generator']);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Geradora não encontrado.');
        }

        $generator = EngineeringGenerator::all()->where('id', $id)->first();

        if ($generator->exists()) {
            $customMessages = [
                'required' => 'Preencha o campo :attribute',
                'file' => 'O campo :attribute permite somente arquivos',
                'mimes' => 'O arquivo :attribute deve ser no formato :values.',
                'max' => [
                    'file' => 'O arquivo :attribute não pode ser maior do que 20 MB.',
                ],
            ];

            $attributes = [
                'generator-image-file' => 'Imagem',
                'generator-image-type' => 'Tipo'
            ];

            $validator = Validator::make($data, [
                'generator-image-file' => [
                    'required', 'file', 'mimes:jpg,png', 'max:20480',
                ],
                'generator-image-type' => [
                    'required'
                ]
            ], $customMessages, $attributes);

            if ($validator->fails()) {
                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    $error = $error[0];
                    return back()->withInput()->with('error', $error);
                }
            }

            else {
                $generator_contract_account = $generator->generator_contract_account;
                $filename = ucwords(mb_strtolower($data['generator-image-name'], 'UTF-8'));
                $image_type = decrypt($data['generator-image-type']);

                switch ($image_type) {
                    case 'VISTORIA_PREVIA':
                        $folder_type = 'preview';
                        break;
                        
                    case 'INSTALACAO':
                        $folder_type = 'installation';
                        break;

                    case 'VISTORIA_FINAL':
                        $folder_type = 'final';
                        break;

                    case 'OUTRAS':
                        $folder_type = 'other';
                        break;
                }

                $image_info = self::fileUpload($request->file()['generator-image-file'], 'image/' . $generator_contract_account . '/' . $folder_type);
                $image_name = $image_info[0];
                $image_path = $image_info[1];

                EngineeringGeneratorImages::create([
                    'engineering_generator_id' => $id,
                    'name' => $filename,
                    'type' => $image_type,
                    'image_generator_name' => $image_name,
                    'image_generator_path' => $image_path,
                ]);

                return response()->json([
                    'saved' => true,
                    'message' => 'Imagem salva com sucesso.',
                    'name' => $filename,
                    'type' => $image_type,
                ]);
            }
        }

        return response()->json([
            'saved' => true,
            'message' => 'Geradora não encontrada.'
        ]);
    }

    public function handleShowGeneratorImages() 
    {
        $request = Request::capture();
        $data = $request->all();

        switch ($data['type']) {
            case 'VISTORIA_PREVIA':
                $images = EngineeringGeneratorImages::all()->where('type', 'VISTORIA_PREVIA');
                break;
            
            case 'INSTALACAO':
                $images = EngineeringGeneratorImages::all()->where('type', 'INSTALACAO');
                break;

            case 'VISTORIA_FINAL':
                $images = EngineeringGeneratorImages::all()->where('type', 'VISTORIA_FINAL');
                break;

            case 'OUTRAS':
                $images = EngineeringGeneratorImages::all()->where('type', 'OUTRAS');
                break;
        }

        foreach ($images as $image) {
            $image_id = encrypt($image->id);
            $image_name = $image->name;
            $image_type = $image->type;
            $image_path = $image->image_generator_path;
        }

        return response()->json([
            'id' => $image_id,
            'name' => $image_name,
            'type' => $image_type,
            'path' => $image_path,
        ]);
    }

    /** Store/update project protocol in storage */
    public function protocol(Request $request, $type, $id)
    {
        try {
            $id = decrypt($id);
            $type = decrypt($type);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Geradora não encontrada.');
        }

        $data = $request->all();

        $customMessages = [
            'required' => 'Preencha o campo :attribute',
        ];

        switch ($type) {
            case 'submission':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number-submission' => 'Número do Protocolo',
                    'protocol-date-submission' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number-submission' => 'required',
                    'protocol-date-submission' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::where('generator_id', $id)->get();
                    $protocol_feedback = ProtocolRequestFeedback::where('generator_id', $id)->get();
                    $protocol_issued = ProtocolFeedbackIssued::where('generator_id', $id)->get();
                    $protocol_provisional = ProtocolProvisionalRequest::where('generator_id', $id)->get();
                    $protocol_survey = ProtocolSurvey::where('generator_id', $id)->get();
                    
                    array_push($arr_dates, strtotime($data['protocol-date-submission']));
                    
                    if (count($protocol_feedback) == 1) {
                        array_push($arr_dates, strtotime($protocol_feedback[0]->protocol_date));
                    }

                    if (count($protocol_issued) == 1) {
                        array_push($arr_dates, strtotime($protocol_issued[0]->protocol_date));
                    }

                    if (count($protocol_provisional) == 1) {
                        array_push($arr_dates, strtotime($protocol_provisional[0]->protocol_date));
                    }

                    if (count($protocol_survey) == 1) {
                        array_push($arr_dates, strtotime($protocol_survey[0]->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date-submission'])) {
                        $generator->generator_status = EngineeringController::$SUBJECT;
                        $generator->save();
                    }

                    if (count($protocol_submission) == 1) {
                        foreach ($protocol_submission as $submission) {
                            $submission->protocol_number = $data['protocol-number-submission'];
                            $submission->protocol_date = $data['protocol-date-submission'];
                            $submission->save();
                        }

                        return back()->withInput()->with('success', 'Protocolo atualizado com sucesso.');
                    }

                    else {
                        ProtocolProjectSubmission::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number-submission'],
                            'protocol_date' => $data['protocol-date-submission'],
                        ]);

                        return back()->withInput()->with('success', 'Protocolo criado com sucesso.');
                    }
                }

                break;

            case 'feedback':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number-feedback' => 'Número do Protocolo',
                    'protocol-date-feedback' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number-feedback' => 'required',
                    'protocol-date-feedback' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::where('generator_id', $id)->get();
                    $protocol_feedback = ProtocolRequestFeedback::where('generator_id', $id)->get();
                    $protocol_issued = ProtocolFeedbackIssued::where('generator_id', $id)->get();
                    $protocol_provisional = ProtocolProvisionalRequest::where('generator_id', $id)->get();
                    $protocol_survey = ProtocolSurvey::where('generator_id', $id)->get();
                    
                    array_push($arr_dates, strtotime($data['protocol-date-feedback']));
                    
                    if (count($protocol_submission) == 1) {
                        array_push($arr_dates, strtotime($protocol_submission[0]->protocol_date));
                    }

                    if (count($protocol_issued) == 1) {
                        array_push($arr_dates, strtotime($protocol_issued[0]->protocol_date));
                    }

                    if (count($protocol_provisional) == 1) {
                        array_push($arr_dates, strtotime($protocol_provisional[0]->protocol_date));
                    }
                    
                    if (count($protocol_survey) == 1) {
                        array_push($arr_dates, strtotime($protocol_survey[0]->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date-feedback'])) {
                        $generator->generator_status = EngineeringController::$PROTOCOLED;
                        $generator->save();
                    }

                    if (count($protocol_feedback) == 1) {
                        foreach ($protocol_feedback as $feedback) {
                            $feedback->protocol_number = $data['protocol-number-feedback'];
                            $feedback->protocol_date = $data['protocol-date-feedback'];
                            $feedback->save();
                        }

                        return back()->withInput()->with('success', 'Protocolo atualizado com sucesso.');
                    }

                    else {
                        ProtocolRequestFeedback::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number-feedback'],
                            'protocol_date' => $data['protocol-date-feedback'],
                        ]);

                        return back()->withInput()->with('success', 'Protocolo criado com sucesso.');
                    }
                }

                break;

            case 'issued':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number-issued' => 'Número do Protocolo',
                    'protocol-date-issued' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number-issued' => 'required',
                    'protocol-date-issued' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::where('generator_id', $id)->get();
                    $protocol_feedback = ProtocolRequestFeedback::where('generator_id', $id)->get();
                    $protocol_issued = ProtocolFeedbackIssued::where('generator_id', $id)->get();
                    $protocol_provisional = ProtocolProvisionalRequest::where('generator_id', $id)->get();
                    $protocol_survey = ProtocolSurvey::where('generator_id', $id)->get();
                    
                    array_push($arr_dates, strtotime($data['protocol-date-issued']));
                    
                    if (count($protocol_submission) == 1) {
                        array_push($arr_dates, strtotime($protocol_submission[0]->protocol_date));
                    }

                    if (count($protocol_feedback) == 1) {
                        array_push($arr_dates, strtotime($protocol_feedback[0]->protocol_date));
                    }

                    if (count($protocol_provisional) == 1) {
                        array_push($arr_dates, strtotime($protocol_provisional[0]->protocol_date));
                    }
                    
                    if (count($protocol_survey) == 1) {
                        array_push($arr_dates, strtotime($protocol_survey[0]->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date-issued'])) {
                        $generator->generator_status = EngineeringController::$ISSUED;
                        $generator->save();
                    }

                    if (count($protocol_issued) == 1) {
                        foreach ($protocol_issued as $issued) {
                            $issued->protocol_number = $data['protocol-number-issued'];
                            $issued->protocol_date = $data['protocol-date-issued'];
                            $issued->save();
                        }

                        return back()->withInput()->with('success', 'Protocolo atualizado com sucesso.');
                    }

                    else {
                        ProtocolFeedbackIssued::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number-issued'],
                            'protocol_date' => $data['protocol-date-issued'],
                        ]);

                        return back()->withInput()->with('success', 'Protocolo criado com sucesso.');
                    }
                }

                break;

            case 'provisional':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number-provisional' => 'Número do Protocolo',
                    'protocol-date-provisional' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number-provisional' => 'required',
                    'protocol-date-provisional' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::where('generator_id', $id)->get();
                    $protocol_feedback = ProtocolRequestFeedback::where('generator_id', $id)->get();
                    $protocol_issued = ProtocolFeedbackIssued::where('generator_id', $id)->get();
                    $protocol_provisional = ProtocolProvisionalRequest::where('generator_id', $id)->get();
                    $protocol_survey = ProtocolSurvey::where('generator_id', $id)->get();
                    
                    array_push($arr_dates, strtotime($data['protocol-date-provisional']));
                    
                    if (count($protocol_submission) == 1) {
                        array_push($arr_dates, strtotime($protocol_submission[0]->protocol_date));
                    }

                    if (count($protocol_feedback) == 1) {
                        array_push($arr_dates, strtotime($protocol_feedback[0]->protocol_date));
                    }

                    if (count($protocol_issued) == 1) {
                        array_push($arr_dates, strtotime($protocol_issued[0]->protocol_date));
                    }
                    
                    if (count($protocol_survey) == 1) {
                        array_push($arr_dates, strtotime($protocol_survey[0]->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date-provisional'])) {
                        $generator->generator_status = EngineeringController::$PROVISIONAL;
                        $generator->save();
                    }

                    /** Changing contract status */
                    $arr_status = [];

                    foreach ($project->generator as $gen) {
                        if ($gen->generator_status == "VISTORIA_PROVISORIA") array_push($arr_status, true);
                    }

                    if (count($arr_status) == count($project->generator)) {
                        $project->contract->status = "INSTALADO";
                        $project->contract->save();
                    }
                    /** End changing contract status */

                    if (count($protocol_provisional) == 1) {
                        foreach ($protocol_provisional as $provisional) {
                            $provisional->protocol_number = $data['protocol-number-provisional'];
                            $provisional->protocol_date = $data['protocol-date-provisional'];
                            $provisional->save();
                        }

                        return back()->withInput()->with('success', 'Protocolo atualizado com sucesso.');
                    }

                    else {
                        ProtocolProvisionalRequest::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number-provisional'],
                            'protocol_date' => $data['protocol-date-provisional'],
                        ]);

                        return back()->withInput()->with('success', 'Protocolo criado com sucesso.');
                    }
                }

                break;

            case 'survey':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number-survey' => 'Número do Protocolo',
                    'protocol-date-survey' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number-survey' => 'required',
                    'protocol-date-survey' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::where('generator_id', $id)->get();
                    $protocol_feedback = ProtocolRequestFeedback::where('generator_id', $id)->get();
                    $protocol_issued = ProtocolFeedbackIssued::where('generator_id', $id)->get();
                    $protocol_provisional = ProtocolProvisionalRequest::where('generator_id', $id)->get();
                    $protocol_survey = ProtocolSurvey::where('generator_id', $id)->get();
                    
                    array_push($arr_dates, strtotime($data['protocol-date-survey']));
                    
                    if (count($protocol_submission) == 1) {
                        array_push($arr_dates, strtotime($protocol_submission[0]->protocol_date));
                    }

                    if (count($protocol_feedback) == 1) {
                        array_push($arr_dates, strtotime($protocol_feedback[0]->protocol_date));
                    }

                    if (count($protocol_issued) == 1) {
                        array_push($arr_dates, strtotime($protocol_issued[0]->protocol_date));
                    }
                    
                    if (count($protocol_provisional) == 1) {
                        array_push($arr_dates, strtotime($protocol_provisional[0]->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date-survey'])) {
                        $generator->generator_status = EngineeringController::$SURVEY;
                        $generator->save();
                    }

                    if (count($protocol_survey) == 1) {
                        foreach ($protocol_survey as $survey) {
                            $survey->protocol_number = $data['protocol-number-survey'];
                            $survey->protocol_date = $data['protocol-date-survey'];
                            $survey->save();
                        }

                        return back()->withInput()->with('success', 'Protocolo atualizado com sucesso.');
                    }

                    else {
                        ProtocolSurvey::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number-survey'],
                            'protocol_date' => $data['protocol-date-survey'],
                        ]);

                        return back()->withInput()->with('success', 'Protocolo criado com sucesso.');
                    }
                }

                break;

            case 'homologated':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attribute = [
                    'protocol-date-homologated' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-date-homologated' => 'required',
                ], $customMessages, $attribute);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::where('generator_id', $id)->get();
                    $protocol_feedback = ProtocolRequestFeedback::where('generator_id', $id)->get();
                    $protocol_issued = ProtocolFeedbackIssued::where('generator_id', $id)->get();
                    $protocol_provisional = ProtocolProvisionalRequest::where('generator_id', $id)->get();
                    $protocol_survey = ProtocolSurvey::where('generator_id', $id)->get();
                    $protocol_homologated = ProtocolHomologated::where('generator_id', $id)->get();
                    
                    array_push($arr_dates, strtotime($data['protocol-date-homologated']));
                    
                    if (count($protocol_submission) == 1) {
                        array_push($arr_dates, strtotime($protocol_submission[0]->protocol_date));
                    }

                    if (count($protocol_feedback) == 1) {
                        array_push($arr_dates, strtotime($protocol_feedback[0]->protocol_date));
                    }

                    if (count($protocol_issued) == 1) {
                        array_push($arr_dates, strtotime($protocol_issued[0]->protocol_date));
                    }
                    
                    if (count($protocol_provisional) == 1) {
                        array_push($arr_dates, strtotime($protocol_provisional[0]->protocol_date));
                    }

                    if (count($protocol_survey) == 1) {
                        array_push($arr_dates, strtotime($protocol_survey[0]->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date-homologated'])) {
                        $generator->generator_status = EngineeringController::$HOMOLOGATED;
                        $generator->save();
                    }

                    if (count($protocol_homologated) == 1) {
                        foreach ($protocol_homologated as $homologated) {
                            $homologated->protocol_date = $data['protocol-date-homologated'];
                            $homologated->save();
                        }

                        return back()->withInput()->with('success', 'Protocolo atualizado com sucesso.');
                    }

                    else {
                        ProtocolHomologated::create([
                            'generator_id' => $id,
                            'protocol_date' => $data['protocol-date-homologated'],
                        ]);

                        return back()->withInput()->with('success', 'Protocolo criado com sucesso.');
                    }
                }

                break;
        }
    }

    /** Store/update project protocol in storage via FETCH API */
    public function handleProtocol()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['generator']);
            $type = decrypt($data['type']);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Geradora não encontrada.');
        }

        $customMessages = [
            'required' => 'Preencha o campo :attribute',
        ];

        switch ($type) {
            case 'submission':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number' => 'Número do Protocolo',
                    'protocol-date' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number' => 'required',
                    'protocol-date' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::all()->where('generator_id', $id)->first();
                    $protocol_feedback = ProtocolRequestFeedback::all()->where('generator_id', $id)->first();
                    $protocol_issued = ProtocolFeedbackIssued::all()->where('generator_id', $id)->first();
                    $protocol_provisional = ProtocolProvisionalRequest::all()->where('generator_id', $id)->first();
                    $protocol_survey = ProtocolSurvey::all()->where('generator_id', $id)->first();
                    
                    array_push($arr_dates, strtotime($data['protocol-date']));
                    
                    if ($protocol_feedback != null) {
                        array_push($arr_dates, strtotime($protocol_feedback->protocol_date));
                    }

                    if ($protocol_issued != null) {
                        array_push($arr_dates, strtotime($protocol_issued->protocol_date));
                    }

                    if ($protocol_provisional != null) {
                        array_push($arr_dates, strtotime($protocol_provisional->protocol_date));
                    }

                    if ($protocol_survey != null) {
                        array_push($arr_dates, strtotime($protocol_survey->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date'])) {;
                        $generator->generator_status = EngineeringController::$SUBJECT;
                        $generator->save();
                    };

                    if ($protocol_submission != null) {
                        $protocol_submission->protocol_number = $data['protocol-number'];
                        $protocol_submission->protocol_date = $data['protocol-date'];
                        $protocol_submission->save();

                        $pending = strtotime(date('Y-m-d', strtotime('+3 days', strtotime($protocol_submission->protocol_date)))) < strtotime(date('Y-m-d'));

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo atualizado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $protocol_submission->protocol_number,
                            'date' => $protocol_submission->protocol_date,
                            'deadline' => date('d/m/Y', strtotime('+3 days', strtotime($protocol_submission->protocol_date))),
                            'pending' => $pending,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }

                    else {
                        ProtocolProjectSubmission::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number'],
                            'protocol_date' => $data['protocol-date'],
                        ]);

                        $pending = strtotime(date('Y-m-d', strtotime('+3 days', strtotime($data['protocol-date'])))) < strtotime(date('Y-m-d'));

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo criado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $data['protocol-number'],
                            'date' => date('Y-m-d', strtotime($data['protocol-date'])),
                            'deadline' => date('d/m/Y', strtotime('+3 days', strtotime($data['protocol-date']))),
                            'pending' => $pending,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }
                }

                break;

            case 'feedback':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number' => 'Número do Protocolo',
                    'protocol-date' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number' => 'required',
                    'protocol-date' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::all()->where('generator_id', $id)->first();
                    $protocol_feedback = ProtocolRequestFeedback::all()->where('generator_id', $id)->first();
                    $protocol_issued = ProtocolFeedbackIssued::all()->where('generator_id', $id)->first();
                    $protocol_provisional = ProtocolProvisionalRequest::all()->where('generator_id', $id)->first();
                    $protocol_survey = ProtocolSurvey::all()->where('generator_id', $id)->first();
                    
                    array_push($arr_dates, strtotime($data['protocol-date']));
                    
                    if ($protocol_submission != null) {
                        array_push($arr_dates, strtotime($protocol_submission->protocol_date));
                    }

                    if ($protocol_issued != null) {
                        array_push($arr_dates, strtotime($protocol_issued->protocol_date));
                    }

                    if ($protocol_provisional != null) {
                        array_push($arr_dates, strtotime($protocol_provisional->protocol_date));
                    }
                    
                    if ($protocol_survey != null) {
                        array_push($arr_dates, strtotime($protocol_survey->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date'])) {
                        $generator->generator_status = EngineeringController::$PROTOCOLED;
                        $generator->save();
                    }

                    if ($protocol_feedback != null) {
                        $protocol_feedback->protocol_number = $data['protocol-number'];
                        $protocol_feedback->protocol_date = $data['protocol-date'];
                        $protocol_feedback->save();

                        $pending = strtotime(date('Y-m-d', strtotime('+15 days', strtotime($protocol_feedback->protocol_date)))) < strtotime(date('Y-m-d'));

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo atualizado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $protocol_feedback->protocol_number,
                            'date' => $protocol_feedback->protocol_date,
                            'deadline' => date('d/m/Y', strtotime('+15 days', strtotime($protocol_feedback->protocol_date))),
                            'pending' => $pending,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }

                    else {
                        ProtocolRequestFeedback::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number'],
                            'protocol_date' => $data['protocol-date'],
                        ]);

                        $pending = strtotime(date('Y-m-d', strtotime('+15 days', strtotime($data['protocol-date'])))) < strtotime(date('Y-m-d'));

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo criado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $data['protocol-number'],
                            'date' => date('Y-m-d', strtotime($data['protocol-date'])),
                            'deadline' => date('d/m/Y', strtotime('+15 days', strtotime($data['protocol-date']))),
                            'pending' => $pending,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }
                }

                break;

            case 'issued':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number' => 'Número do Protocolo',
                    'protocol-date' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number' => 'required',
                    'protocol-date' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::all()->where('generator_id', $id)->first();
                    $protocol_feedback = ProtocolRequestFeedback::all()->where('generator_id', $id)->first();
                    $protocol_issued = ProtocolFeedbackIssued::all()->where('generator_id', $id)->first();
                    $protocol_provisional = ProtocolProvisionalRequest::all()->where('generator_id', $id)->first();
                    $protocol_survey = ProtocolSurvey::all()->where('generator_id', $id)->first();
                    
                    array_push($arr_dates, strtotime($data['protocol-date']));
                    
                    if ($protocol_submission != null) {
                        array_push($arr_dates, strtotime($protocol_submission->protocol_date));
                    }

                    if ($protocol_feedback != null) {
                        array_push($arr_dates, strtotime($protocol_feedback->protocol_date));
                    }

                    if ($protocol_provisional != null) {
                        array_push($arr_dates, strtotime($protocol_provisional->protocol_date));
                    }
                    
                    if ($protocol_survey != null) {
                        array_push($arr_dates, strtotime($protocol_survey->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date'])) {
                        $generator->generator_status = EngineeringController::$ISSUED;
                        $generator->save();
                    }

                    if ($protocol_issued != null) {
                        $protocol_issued->protocol_number = $data['protocol-number'];
                        $protocol_issued->protocol_date = $data['protocol-date'];
                        $protocol_issued->save();

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo atualizado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $protocol_issued->protocol_number,
                            'date' => $protocol_issued->protocol_date,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }

                    else {
                        ProtocolFeedbackIssued::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number'],
                            'protocol_date' => $data['protocol-date'],
                        ]);

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo criado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $data['protocol-number'],
                            'date' => date('Y-m-d', strtotime($data['protocol-date'])),
                            'badge' => $data['badge-bg-color']
                        ]);
                    }
                }

                break;

            case 'provisional':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number' => 'Número do Protocolo',
                    'protocol-date' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number' => 'required',
                    'protocol-date' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::all()->where('generator_id', $id)->first();
                    $protocol_feedback = ProtocolRequestFeedback::all()->where('generator_id', $id)->first();
                    $protocol_issued = ProtocolFeedbackIssued::all()->where('generator_id', $id)->first();
                    $protocol_provisional = ProtocolProvisionalRequest::all()->where('generator_id', $id)->first();
                    $protocol_survey = ProtocolSurvey::all()->where('generator_id', $id)->first();
                    
                    array_push($arr_dates, strtotime($data['protocol-date']));
                    
                    if ($protocol_submission != null) {
                        array_push($arr_dates, strtotime($protocol_submission->protocol_date));
                    }

                    if ($protocol_feedback != null) {
                        array_push($arr_dates, strtotime($protocol_feedback->protocol_date));
                    }

                    if ($protocol_issued != null) {
                        array_push($arr_dates, strtotime($protocol_issued->protocol_date));
                    }
                    
                    if ($protocol_survey != null) {
                        array_push($arr_dates, strtotime($protocol_survey->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date'])) {
                        $generator->generator_status = EngineeringController::$PROVISIONAL;
                        $generator->save();
                    }

                    /** Changing contract status */
                    $arr_status = [];

                    foreach ($project->generator as $gen) {
                        if ($gen->generator_status == "VISTORIA_PROVISORIA") array_push($arr_status, true);
                    }

                    if (count($arr_status) == count($project->generator)) {
                        $project->contract->status = "INSTALADO";
                        $project->contract->save();
                    }
                    /** End changing contract status */

                    if ($protocol_provisional != null) {
                        $protocol_provisional->protocol_number = $data['protocol-number'];
                        $protocol_provisional->protocol_date = $data['protocol-date'];
                        $protocol_provisional->save();

                        $pending = strtotime(date('Y-m-d', strtotime('+3 days', strtotime($protocol_provisional->protocol_date)))) < strtotime(date('Y-m-d'));

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo atualizado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $protocol_provisional->protocol_number,
                            'date' => $protocol_provisional->protocol_date,
                            'deadline' => date('d/m/Y', strtotime('+3 days', strtotime($protocol_provisional->protocol_date))),
                            'pending' => $pending,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }

                    else {
                        ProtocolProvisionalRequest::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number'],
                            'protocol_date' => $data['protocol-date'],
                        ]);

                        $pending = strtotime(date('Y-m-d', strtotime('+3 days', strtotime($data['protocol-date'])))) < strtotime(date('Y-m-d'));

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo criado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $data['protocol-number'],
                            'date' => date('Y-m-d', strtotime($data['protocol-date'])),
                            'deadline' => date('d/m/Y', strtotime('+3 days', strtotime($data['protocol-date']))),
                            'pending' => $pending,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }
                }

                break;

            case 'survey':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attributes = [
                    'protocol-number' => 'Número do Protocolo',
                    'protocol-date' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-number' => 'required',
                    'protocol-date' => 'required',
                ], $customMessages, $attributes);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::all()->where('generator_id', $id)->first();
                    $protocol_feedback = ProtocolRequestFeedback::all()->where('generator_id', $id)->first();
                    $protocol_issued = ProtocolFeedbackIssued::all()->where('generator_id', $id)->first();
                    $protocol_provisional = ProtocolProvisionalRequest::all()->where('generator_id', $id)->first();
                    $protocol_survey = ProtocolSurvey::all()->where('generator_id', $id)->first();
                    
                    array_push($arr_dates, strtotime($data['protocol-date']));
                    
                    if ($protocol_submission != null) {
                        array_push($arr_dates, strtotime($protocol_submission->protocol_date));
                    }

                    if ($protocol_feedback != null) {
                        array_push($arr_dates, strtotime($protocol_feedback->protocol_date));
                    }

                    if ($protocol_issued != null) {
                        array_push($arr_dates, strtotime($protocol_issued->protocol_date));
                    }
                    
                    if ($protocol_provisional != null) {
                        array_push($arr_dates, strtotime($protocol_provisional->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date'])) {
                        $generator->generator_status = EngineeringController::$SURVEY;
                        $generator->save();
                    }

                    if ($protocol_survey != null) {
                        $protocol_survey->protocol_number = $data['protocol-number'];
                        $protocol_survey->protocol_date = $data['protocol-date'];
                        $protocol_survey->save();

                        $pending = strtotime(date('Y-m-d', strtotime('+7 days', strtotime($protocol_survey->protocol_date)))) < strtotime(date('Y-m-d'));

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo atualizado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $protocol_survey->protocol_number,
                            'date' => $protocol_survey->protocol_date,
                            'deadline' => date('d/m/Y', strtotime('+7 days', strtotime($protocol_survey->protocol_date))),
                            'pending' => $pending,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }

                    else {
                        ProtocolSurvey::create([
                            'generator_id' => $id,
                            'protocol_number' => $data['protocol-number'],
                            'protocol_date' => $data['protocol-date'],
                        ]);

                        $pending = strtotime(date('Y-m-d', strtotime('+7 days', strtotime($data['protocol-date'])))) < strtotime(date('Y-m-d'));

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo criado com sucesso.',
                            'status' => $generator->generator_status,
                            'number' => $data['protocol-number'],
                            'date' => date('Y-m-d', strtotime($data['protocol-date'])),
                            'deadline' => date('d/m/Y', strtotime('+7 days', strtotime($data['protocol-date']))),
                            'pending' => $pending,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }
                }

                break;

            case 'homologated':
                $generator = EngineeringGenerator::find($id);
                $project = EngineeringProject::all()->where('id', $generator->engineering_project_id)->first();

                $attribute = [
                    'protocol-date' => 'Data do Protocolo',
                ];

                $validator = Validator::make($data, [
                    'protocol-date' => 'required',
                ], $customMessages, $attribute);

                if ($validator->fails()) {
                    foreach ($validator->getMessageBag()->getMessages() as $error) {
                        return back()->withInput()->with('error', $error[0]);
                    }
                }

                else {
                    $arr_dates = [];
                    $protocol_submission = ProtocolProjectSubmission::all()->where('generator_id', $id)->first();
                    $protocol_feedback = ProtocolRequestFeedback::all()->where('generator_id', $id)->first();
                    $protocol_issued = ProtocolFeedbackIssued::all()->where('generator_id', $id)->first();
                    $protocol_provisional = ProtocolProvisionalRequest::all()->where('generator_id', $id)->first();
                    $protocol_survey = ProtocolSurvey::all()->where('generator_id', $id)->first();
                    $protocol_homologated = ProtocolHomologated::all()->where('generator_id', $id)->first();
                    
                    array_push($arr_dates, strtotime($data['protocol-date']));
                    
                    if ($protocol_submission != null) {
                        array_push($arr_dates, strtotime($protocol_submission->protocol_date));
                    }

                    if ($protocol_feedback != null) {
                        array_push($arr_dates, strtotime($protocol_feedback->protocol_date));
                    }

                    if ($protocol_issued != null) {
                        array_push($arr_dates, strtotime($protocol_issued->protocol_date));
                    }
                    
                    if ($protocol_provisional != null) {
                        array_push($arr_dates, strtotime($protocol_provisional->protocol_date));
                    }

                    if ($protocol_survey != null) {
                        array_push($arr_dates, strtotime($protocol_survey->protocol_date));
                    }

                    if (max($arr_dates) == strtotime($data['protocol-date'])) {
                        $generator->generator_status = EngineeringController::$HOMOLOGATED;
                        $generator->save();
                    }

                    if ($protocol_homologated != null) {
                        $protocol_homologated->protocol_date = $data['protocol-date'];
                        $protocol_homologated->save();

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo atualizado com sucesso.',
                            'status' => $generator->generator_status,
                            'date' => $protocol_homologated->protocol_date,
                            'badge' => $data['badge-bg-color']
                        ]);
                    }

                    else {
                        ProtocolHomologated::create([
                            'generator_id' => $id,
                            'protocol_date' => $data['protocol-date'],
                        ]);

                        return response()->json([
                            'saved' => true,
                            'message' => 'Protocolo criado com sucesso.',
                            'status' => $generator->generator_status,
                            'date' => date('Y-m-d', strtotime($data['protocol-date'])),
                            'badge' => $data['badge-bg-color']
                        ]);
                    }
                }

                break;
        }
    }

    /** Upload files to Storage */
    public static function fileUpload($req, $type)
    {
        $file_name = $req->getClientOriginalName();
        $path = $req->storeAs($type, $file_name, 'engineering');
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

        if ($type == 'image') {
            $file_type = 'image_generator_path';
            $file = EngineeringGeneratorImages::where('id', $id)->get($file_type)->first();
        }

        else {
            $main_folder = explode('/', $type)[0];
            $type_folder = explode('/', $type)[1];
            $file_type = 'file_' . $type_folder . '_path';

            if ($main_folder == 'documents') {
                if ($type_folder == 'new') {
                    $file = EngineeringGeneratorDocumentsNewFile::where('id', $id)->get($file_type)->first();
                }

                else {
                    switch ($type_folder) {
                        case 'art':
                            $file = EngineeringDocumentArt::where('id', $id)->get($file_type)->first();
                            break;

                        case 'aneel_form':
                            $file = EngineeringDocumentAneel::where('id', $id)->get($file_type)->first();
                            break;

                        case 'descriptive_memorial':
                            $file = EngineeringDocumentDescriptiveMemorial::where('id', $id)->get($file_type)->first();
                            break;

                        case 'data_sheet_certificates':
                            $file = EngineeringDocumentDataSheetCertificates::where('id', $id)->get($file_type)->first();
                            break;

                        case 'electrical_project':
                            $file = EngineeringDocumentElectricalProject::where('id', $id)->get($file_type)->first();
                            break;

                        default:
                            $file = EngineeringGeneratorDocuments::where('id', $id)->get($file_type)->first();
                            break;
                    }
                }
            }
        }

        if ($file != null) {
            if (Storage::disk('engineering')->exists(substr($file->$file_type, 8))) {
                $file_path = 'engineering/' . substr($file->$file_type, 8); 

                return Storage::response($file_path);
            }

            else return back()->withInput()->with('error', 'Arquivo não encontrado.');
        }

        else return back()->withInput()->with('error', 'O projeto não possui este arquivo salvo.');
    }

    /** Get client address */
    public function get_client_address_ajax()
    {
        $request = Request::capture();
        $data = $request->all();
        $name = $data['name'];
        $name = ucwords(mb_strtolower($name, 'UTF-8'));
        $client_name = Client::where('name', $name)->orWhere('corporate_name', $name)->first();
        $status = ($client_name) ? true : false;

        if ($status) {
            $client = [
                'cep' => $client_name->address_cep,
                'address' => $client_name->address,
                'number' => $client_name->address_number,
                'complement' => $client_name->address_complement,
                'city' => $client_name->address_city,
                'state' => $client_name->address_state,
                'neighborhood' => $client_name->address_neighborhood,
            ];

            return response()->json(['status' => $status, 'client' => $client]);
        }

        else return response()->json(['status' => $status, 'client' => []]);
    }

    /** Get client credentials */
    public function get_client_credentials_ajax()
    {
        $request = Request::capture();
        $data = $request->all();
        $name = $data['name'];
        $name = ucwords(mb_strtolower($name, 'UTF-8'));
        $client_name = Client::where('name', $name)->orWhere('corporate_name', $name)->first();
        $status = ($client_name) ? true : false;

        if ($status) {
            $client = [
                'login' => $client_name->login,
                'password' => $client_name->password,
            ];

            return response()->json(['status' => $status, 'client' => $client]);
        }

        else return response()->json(['status' => $status, 'client' => []]);
    }

    /** Get the default generator address */
    public function get_default_address()
    {
        $default_address = [
            'cep' => '68790-000',
            'address' => 'Tv. 5 Sub. Div. do Núcleo Col. Nsa. Sra. do Carmo de Benevides',
            'number' => '29',
            'complement' => 'Fazenda Sunny Park',
            'city' => 'Moema',
            'neighborhood' => 'Santa Izabel do Pará',
            'state' => 'PA',
        ];

        return response()->json(['address' => $default_address]);
    }

    /** Print Apportionament List */
    public function printApportionmentList($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $beneficiary_effective_date = BeneficiaryEffectiveDate::find($id);
        $date = date('YmdHis');
        $title = 'apportionment_list_' . $date;
        $text_font = 14;
        $line_height = 1.4;
        $rate_sum = 0;

        foreach ($beneficiary_effective_date->beneficiary as $beneficiary) {
            $rate_sum += $beneficiary->beneficiary_rate;
        }

        view()->share('contract', $beneficiary_effective_date);
        view()->share('title', $title);
        view()->share('text_font', $text_font);
        view()->share('line_height', $line_height);

        return view('engineering.printApportionmentList', [
            'title' => $title,
            'text_font' => $text_font,
            'effective_date' => $beneficiary_effective_date,
            'rate_sum' => $rate_sum
        ]);
    }

    /*** Show the form for creating a new Document Request */
    public function createGeneratorDocumentRequest($type, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $type = decrypt($type);
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $arr_engineers = [];
        $generator = EngineeringGenerator::findOrFail($id);
        $engineers_users = User::all()->where('is_engineer', 1);

        foreach ($engineers_users as $users) {
            array_push($arr_engineers, $users->name);
        }

        if ($type == 'up_to_ten') {
            return view('engineering.documents.access_request_form.createRequestUpToTen', [
                'generator' => $generator,
                'arr_engineers' => $arr_engineers
            ]);
        }

        else if ($type == 'above_ten_up_to_seventy_five') {
            return view('engineering.documents.access_request_form.createRequestAboveTenUpToSeventyFive', [
                'generator' => $generator,
                'arr_engineers' => $arr_engineers
            ]);
        }

        else {
            return view('engineering.documents.access_request_form.createRequestAboveSeventyFive', [
                'generator' => $generator,
                'arr_engineers' => $arr_engineers
            ]);
        }
    }

    /*** Store a new Document Request */
    public function storeGeneratorDocumentRequest(Request $request, $type, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $type = decrypt($type);
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $data = $request->all();
        $generator = EngineeringGenerator::all()->where('id', $id)->first();

        // If generator exists
        if ($generator->exists()) {
            // Verify Request Category
            if ($type == 'up_to_ten') $category = 'first';
            else if ($type == 'above_ten_up_to_seventy_five') $category = 'second';
            else $category = 'third';

            // Client cellphone value
            $data_client_cellphone = (isset($data["create-request-$category-clientcellphone"])) ?
                $data["create-request-$category-clientcellphone"] :
                null;

            // Client phone value
            $data_client_phone = (isset($data["create-request-$category-clientphone"])) ?
                $data["create-request-$category-clientphone"] :
                null;

            // Has special loads value
            $data_has_special_loads = (isset($data["create-request-$category-loads"])) ?
                $data["create-request-$category-loads"] :
                null;

            // Validate data
            $custom_messages = [
                'required' => 'Preencha o campo :attribute.',
                'string' =>  'O campo :attribute selecionado é inválido.',
                'regex' =>  'Preencha o campo :attribute corretamente.',
                'min' => [
                    'string' => ':attribute com no mínimo :min caractere(s).',
                ],
                'max' => [
                    'string' => ':attribute com no máximo :max caracteres.',
                ],
            ];

            $attributes = [
                "create-request-$category-clientrg" => 'RG',
                "create-request-$category-clientrgshipping" => 'Data de Expedição',
                "create-request-$category-clientcellphone" => 'Celular',
                "create-request-$category-clientphone" => 'Fixo',
                "create-request-$category-activity" => 'Ramo de Atividade',
                "create-request-$category-loads" => 'Possui Cargas Especiais',
                "create-request-$category-loadsdetails" => 'Detalhar Cargas Especiais',
                "create-request-$category-subgroup" => 'Subgrupo',
                "create-request-$category-class" => 'Classe',
                "create-request-$category-conntype" => 'Tipo de Ligação',
                "create-request-$category-ucpower" => 'Tensão de Atendimento da UC',
                "create-request-$category-extension" => 'Tipo de Ramal',
                "create-request-$category-transformerid" => 'Nº de Identificação do Poste ou Transformador mais Próximo',
                "create-request-$category-coordinatesx" => 'Coordenada X do Ponto de Entrega do Acessante',
                "create-request-$category-coordinatesy" => 'Coordenada Y do Ponto de Entrega do Acessante',
                "create-request-$category-managername" => 'Nome Completo',
                "create-request-$category-generationtype" => 'Tipo de Geração',
                "create-request-$category-generationdetails" => 'Especificar se necessário',
                "create-request-$category-generationframework" => 'Enquadramento da Microgeração',
                "create-request-$category-generationpower" => 'Potência de Geração',
                "create-request-$category-generationok" => 'OK',
                "create-request-$category-generationvoltage" => 'Tensão de Conexão',
                "create-request-$category-art" => 'ART do Responsável Técnico pelo projeto e instalação do sistema de microgeração',
                "create-request-$category-diagram" => 'Diagrama unifilar',
                "create-request-$category-memo" => 'Memorial Técnico Descritivo da instalação',
                "create-request-$category-compliance" => 'Certificados de Conformidade dos Inversores',
                "create-request-$category-participants" => 'Lista de unidades consumidoras participantes do sistema de compensação',
                "create-request-$category-instrument" => 'Cópia de instrumento jurídico',
                "create-request-$category-aneel" => 'Documento que comprove o reconhecimento pela ANEEL',
                "create-request-$category-rent" => 'Contrato de Aluguel ou Arrendamento da unidade consumidora',
                "create-request-$category-procuration" => 'Procuração',
                "create-request-$category-condominium" => 'Autorização de uso de área comum em condomínio',
            ];

            $validator = Validator::make($data, [
                "create-request-$category-clientrg" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-clientrg"] != null), 'string', 'min:7', 'max:9'
                ],
                "create-request-$category-clientrgshipping" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-clientrgshipping"] != null), 'date', 'date_format:"Y-m-d"'
                ],
                "create-request-$category-clientcellphone" => [
                    'nullable', Rule::requiredIf($data_client_cellphone != null), 'string',
                ],
                "create-request-$category-clientphone" => [
                    'nullable', Rule::requiredIf($data_client_phone != null), 'string',
                ],
                "create-request-$category-activity" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-activity"] != null), 'string', 'min:2',
                ],
                "create-request-$category-loads" => [
                    'nullable', Rule::requiredIf($data_has_special_loads != null), 'string',
                ],
                "create-request-$category-loadsdetails" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-loadsdetails"] != null), 'string', 'min:2',
                ],
                "create-request-$category-subgroup" => [
                    'required', 'string', 'min:1',
                ],
                "create-request-$category-class" => [
                    'required', 'string',
                ],
                "create-request-$category-conntype" => [
                    'required', 'string',
                ],
                "create-request-$category-ucpower" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-ucpower"] != null),
                ],
                "create-request-$category-extension" => [
                    'required', 'string',
                ],
                "create-request-$category-transformerid" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-transformerid"] != null), 'string',
                ],
                "create-request-$category-coordinatesx" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-coordinatesx"] != null),
                ],
                "create-request-$category-coordinatesy" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-coordinatesy"] != null),
                ],
                "create-request-$category-managername" => [
                    'required', 'string', 'min:5', 'max:255',
                ],
                "create-request-$category-generationtype" => [
                    'required', 'string',
                ],
                "create-request-$category-generationdetails" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-generationdetails"] != null), 'string', 'min:2',
                ],
                "create-request-$category-generationframework" => [
                    'required', 'string',
                ],
                "create-request-$category-generationpower" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-generationpower"] != null), 'string',
                ],
                "create-request-$category-generationok" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-generationok"] != null), 'string',
                ],
                "create-request-$category-generationvoltage" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-generationvoltage"] != null), 'string',
                ],
                "create-request-$category-art" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-art"] != null), 'string', 'min:2',
                ],
                "create-request-$category-diagram" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-diagram"] != null), 'string', 'min:2',
                ],
                "create-request-$category-memo" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-memo"] != null), 'string', 'min:2',
                ],
                "create-request-$category-compliance" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-compliance"] != null), 'string', 'min:2',
                ],
                "create-request-$category-participants" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-participants"] != null), 'string', 'min:2',
                ],
                "create-request-$category-instrument" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-instrument"] != null), 'string', 'min:2',
                ],
                "create-request-$category-aneel" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-aneel"] != null), 'string', 'min:2',
                ],
                "create-request-$category-rent" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-rent"] != null), 'string', 'min:2',
                ],
                "create-request-$category-procuration" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-procuration"] != null), 'string', 'min:2',
                ],
                "create-request-$category-condominium" => [
                    'nullable', Rule::requiredIf($data["create-request-$category-condominium"] != null), 'string', 'min:2',
                ],
            ], $custom_messages, $attributes);

            // If type is up to ten (<= 10%)
            if ($type == 'up_to_ten') {
                $attributes_category_first = [
                    "create-request-$category-ucload" => 'Carga Declarada da UC',
                    "create-request-$category-ucbreaker" => 'Disjuntor de Entrada da UC',
                    "create-request-$category-ucpd" => 'Potência Disponibilizada para UC',
                    'create-request-first-responsiblename' => 'Nome do Responsável Legal',
                    'create-request-first-responsiblephone' => 'Telefone do Responsável Legal',
                    'create-request-first-responsibleemail' => 'Email do Responsável Legal',
                    "create-request-$category-link" => 'Formulário de Ligação Nova',
                    "create-request-$category-pattern" => 'Formulário de Troca de Padrão',
                ];

                $validator_category_first = Validator::make($data, [
                    "create-request-$category-ucload" => [
                        'nullable', Rule::requiredIf($data["create-request-$category-ucload"] != null),
                    ],
                    "create-request-$category-ucbreaker" => [
                        'required',
                    ],
                    "create-request-$category-ucpd" => [
                        'nullable', Rule::requiredIf($data["create-request-$category-ucpd"] != null),
                    ],
                    'create-request-first-responsiblename' => [
                        'nullable', Rule::requiredIf($data['create-request-first-responsiblename'] != null), 'string',
                    ],
                    'create-request-first-responsiblephone' => [
                        'nullable', Rule::requiredIf($data['create-request-first-responsiblephone'] != null), 'string',
                    ],
                    'create-request-first-responsibleemail' => [
                        'nullable', Rule::requiredIf($data['create-request-first-responsibleemail'] != null), 'string', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i',
                    ],
                    "create-request-$category-link" => [
                        'nullable', Rule::requiredIf($data["create-request-$category-link"] != null), 'string', 'min:2',
                    ],
                    "create-request-$category-pattern" => [
                        'nullable', Rule::requiredIf($data["create-request-$category-pattern"] != null), 'string', 'min:2',
                    ],
                ], $custom_messages, $attributes_category_first);

                if ($validator_category_first->fails()) {
                    foreach ($validator_category_first->getMessageBag()->getMessages() as $error) {
                        return back()->withInput($data)->with('error', $error[0]);
                    }
                }
            }

            // If type is above ten up to seventy five (> 10% <= 75%)
            else if ($type == 'above_ten_up_to_seventy_five') {
                $attributes_category_second = [
                    "create-request-$category-ucload" => 'Carga Declarada da UC',
                    "create-request-$category-ucbreaker" => 'Disjuntor de Entrada da UC',
                    "create-request-$category-ucpd" => 'Potência Disponibilizada para UC',
                    'create-request-second-electrical' => 'Projeto elétrico das instalações de conexão',
                    "create-request-$category-link" => 'Formulário de Ligação Nova ',
                    "create-request-$category-pattern" => 'Formulário de Troca de Padrão',
                ];

                $validator_category_second = Validator::make($data, [
                    "create-request-$category-ucload" => [
                        'nullable', Rule::requiredIf($data["create-request-$category-ucload"] != null),
                    ],
                    "create-request-$category-ucbreaker" => [
                        'required',
                    ],
                    "create-request-$category-ucpd" => [
                        'nullable', Rule::requiredIf($data["create-request-$category-ucpd"] != null),
                    ],
                    'create-request-second-electrical' => [
                        'nullable', Rule::requiredIf($data['create-request-second-electrical'] != null), 'string', 'min:2',
                    ],
                    "create-request-$category-link" => [
                        'nullable', Rule::requiredIf($data["create-request-$category-link"] != null), 'string', 'min:2',
                    ],
                    "create-request-$category-pattern" => [
                        'nullable', Rule::requiredIf($data["create-request-$category-pattern"] != null), 'string', 'min:2',
                    ],
                ], $custom_messages, $attributes_category_second);

                if ($validator_category_second->fails()) {
                    foreach ($validator_category_second->getMessageBag()->getMessages() as $error) {
                        return back()->withInput($data)->with('error', $error[0]);
                    }
                }
            }

            // If type is above seventy five (> 75%)
            else {
                $attributes_category_third = [
                    'create-request-third-ucconn' => 'FP Médio no Ponto de Entrega/Conexão da UC',
                    'create-request-third-ucinstalledloadkw' => 'Carga Instalada da UC (em kW)',
                    'create-request-third-ucinstalledloadkva' => 'Carga Instalada da UC (em kVA)',
                    'create-request-third-ucdemandkw' => 'Demanda da UC (em kW)',
                    'create-request-third-ucdemandkva' => 'Demanda da UC (em kVA)',
                    'create-request-third-ucinputpattern' => 'Padrão de Entrada da UC',
                    'create-request-third-tariffgroup' => 'Tarifa GRUPO A',
                    'create-request-third-contracteddemandfp' => 'Demanda Contratada FP',
                    'create-request-third-contracteddemandp' => 'Demanda Contratada P',
                    'create-request-third-generationpd' => 'Potência Disponibilizada',
                    'create-request-third-stage' => 'Estágio atual do empreendimento',
                    'create-request-third-viability' => 'Formulário de Viabilidade Técnica',
                    'create-request-third-chartair' => 'Quadro de Cargas para Subestação Aérea',
                    'create-request-third-chartsheltered' => 'Quadro de Cargas para Subestação Abrigada',
                ];

                $validator_category_third = Validator::make($data, [
                    'create-request-third-ucconn' => [
                        'nullable', Rule::requiredIf($data['create-request-third-ucconn'] != null), 'string',
                    ],
                    'create-request-third-ucinstalledloadkw' => [
                        'nullable', Rule::requiredIf($data['create-request-third-ucinstalledloadkw'] != null),
                    ],
                    'create-request-third-ucinstalledloadkva' => [
                        'nullable', Rule::requiredIf($data['create-request-third-ucinstalledloadkva'] != null),
                    ],
                    'create-request-third-ucdemandkw' => [
                        'nullable', Rule::requiredIf($data['create-request-third-ucdemandkw'] != null),
                    ],
                    'create-request-third-ucdemandkva' => [
                        'nullable', Rule::requiredIf($data['create-request-third-ucdemandkva'] != null),
                    ],
                    'create-request-third-ucinputpattern' => [
                        'required', 'string'
                    ],
                    'create-request-third-tariffgroup' => [
                        'required', 'string'
                    ],
                    'create-request-third-contracteddemandfp' => [
                        'nullable', Rule::requiredIf($data['create-request-third-contracteddemandfp'] != null),
                    ],
                    'create-request-third-contracteddemandp' => [
                        'nullable', Rule::requiredIf($data['create-request-third-contracteddemandp'] != null),
                    ],
                    'create-request-third-generationpd' => [
                        'nullable', Rule::requiredIf($data['create-request-third-generationpd'] != null),
                    ],
                    'create-request-third-stage' => [
                        'nullable', Rule::requiredIf($data['create-request-third-stage'] != null), 'string', 'min:2',
                    ],
                    'create-request-third-viability' => [
                        'nullable', Rule::requiredIf($data['create-request-third-viability'] != null), 'string', 'min:2',
                    ],
                    'create-request-third-chartair' => [
                        'nullable', Rule::requiredIf($data['create-request-third-chartair'] != null), 'string', 'min:2',
                    ],
                    'create-request-third-chartsheltered' => [
                        'nullable', Rule::requiredIf($data['create-request-third-chartsheltered'] != null), 'string', 'min:2',
                    ],
                ], $custom_messages, $attributes_category_third);

                if ($validator_category_third->fails()) {
                    foreach ($validator_category_third->getMessageBag()->getMessages() as $error) {
                        return back()->withInput($data)->with('error', $error[0]);
                    }
                }
            }
            
            if ($validator->fails()) {
                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    return back()->withInput($data)->with('error', $error[0]);
                }
            }

            else {
                // Manager name
                $manager_name = decrypt($data["create-request-$category-managername"]);
                $user = User::all()->where('name', $manager_name)->first();

                // If user exists
                if ($user->exists()) {
                    // Client phone and cellphone
                    $is_client_cellphone = (strlen($generator->client->phone) == 15) ? true : false;

                    if ($is_client_cellphone) {
                        $client_phone = $data_client_phone;
                        $client_cellphone = $generator->client->phone;
                    }
    
                    else {
                        $client_phone = $generator->client->phone;
                        $client_cellphone = $data_client_cellphone;
                    }

                    // Has special loads
                    $has_special_loads = $data_has_special_loads != null && decrypt($data["create-request-$category-loads"]) == 'SIM' ? 
                        true :
                        false;

                    // Consumption class
                    $consumption_class = decrypt($data["create-request-$category-class"]);

                    // Connection type
                    $connection_type = decrypt($data["create-request-$category-conntype"]);

                    if ($type == 'above_seventy_five') {
                        // UC installed load (kW)
                        $uc_installed_load_kw = ($data["create-request-third-ucinstalledloadkw"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-third-ucinstalledloadkw"]) * 1000) :
                            null;

                        // UC installed load (kVA)
                        $uc_installed_load_kva = ($data["create-request-third-ucinstalledloadkva"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-third-ucinstalledloadkva"]) * 1000) :
                            null;

                        // UC demand (kW)
                        $uc_demand_kw = ($data["create-request-third-ucdemandkw"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-third-ucdemandkw"]) * 1000) :
                            null;

                        // UC demand (kvA)
                        $uc_demand_kva = ($data["create-request-third-ucdemandkva"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-third-ucdemandkva"]) * 1000) :
                            null;

                        // Contract demand FP
                        $contract_demand_fp = ($data["create-request-third-contracteddemandfp"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-third-contracteddemandfp"]) * 1000) :
                            null;

                        // Contract demand P
                        $contract_demand_p = ($data["create-request-third-contracteddemandp"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-third-contracteddemandp"]) * 1000) :
                            null;

                        // Available Power
                        $generation_available_power = ($data["create-request-third-generationpd"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-third-generationpd"]) * 1000) :
                            null;
                    }

                    // UC power
                    if ($type == 'above_seventy_five') {
                        $uc_power = ($data["create-request-$category-ucpower"] != null) ? 
                            doubleval(str_replace(',', '.', $data["create-request-$category-ucpower"]) * 1000) :
                            null;
                    }

                    else {
                        $uc_power = ($data["create-request-$category-ucpower"] != null) ? 
                            doubleval(str_replace(',', '.', $data["create-request-$category-ucpower"])) :
                            null;
                    }
                    
                    if ($type != 'above_seventy_five') {
                        // UC declared load
                        $uc_declared_load = ($data["create-request-$category-ucload"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-$category-ucload"]) * 1000) :
                            null;

                        // UC circuit breaker
                        $uc_circuit_breaker = doubleval(str_replace(',', '.', $data["create-request-$category-ucbreaker"]));

                        // UC available power
                        $uc_available_power = ($data["create-request-$category-ucpd"] != null) ?
                            doubleval(str_replace(',', '.', $data["create-request-$category-ucpd"]) * 1000) :
                            null;
                    }

                    // Point coordinate X
                    $coordinate_x = ($data["create-request-$category-coordinatesx"] != null) ?
                         str_replace(',', '.', $data["create-request-$category-coordinatesx"]) :
                         null;

                    // Point coordinate Y
                    $coordinate_y = ($data["create-request-$category-coordinatesy"] != null) ?
                        str_replace(',', '.', $data["create-request-$category-coordinatesy"]) :
                        null;

                    // Responsible name
                    if ($type == 'up_to_ten') {
                        $responsible_name = ($data['create-request-first-responsiblename'] != null) ?
                            ucwords(mb_strtolower($data['create-request-first-responsiblename'], 'UTF-8')) :
                            null;
                    }

                    // Generation power
                    $generation_power = ($data["create-request-$category-generationpower"] != null) ?
                        doubleval(str_replace(',', '.', $data["create-request-$category-generationpower"]) * 1000) :
                        null;

                    $arr_data_document_request = [
                        'generator_id' => $generator->id,
                        'user_id' => $user->id,
                        'client_rg' => $data["create-request-$category-clientrg"],
                        'client_rg_shipping_date' => $data["create-request-$category-clientrgshipping"],
                        'client_phone' => $client_phone,
                        'client_cellphone' => $client_cellphone,
                        'branch_activity' => $data["create-request-$category-activity"],
                        'has_special_loads' => $has_special_loads,
                        'special_loads_details' => $data["create-request-$category-loadsdetails"],
                        'subgroup' => $data["create-request-$category-subgroup"],
                        'consumption_class' => $consumption_class,
                        'connection_type' => $connection_type,
                        'uc_power' => $uc_power,
                        'extension_type' => $data["create-request-$category-extension"],
                        'transformer_identification' => $data["create-request-$category-transformerid"],
                        'point_coordinate_x' => $coordinate_x,
                        'point_coordinate_y' => $coordinate_y,
                        'generation_type' => $data["create-request-$category-generationtype"],
                        'generation_details' => $data["create-request-$category-generationdetails"],
                        'generation_framework' => $data["create-request-$category-generationframework"],
                        'generation_power' => $generation_power,
                        'generation_ok' => $data["create-request-$category-generationok"],
                        'generation_voltage' => $data["create-request-$category-generationvoltage"],
                        'generation_start_date' => 'EM PROJETO',
                        'art_observation' => $data["create-request-$category-art"],
                        'diagram_observation' => $data["create-request-$category-diagram"],
                        'memo_observation' => $data["create-request-$category-memo"],
                        'compliance_certificate_observation' => $data["create-request-$category-compliance"],
                        'uc_participants_observation' => $data["create-request-$category-participants"],
                        'legal_instrument_observation' => $data["create-request-$category-instrument"],
                        'aneel_observation' => $data["create-request-$category-aneel"],
                        'rent_contract_observation' => $data["create-request-$category-rent"],
                        'procuration_observation' => $data["create-request-$category-procuration"],
                        'condominium_observation' => $data["create-request-$category-condominium"],
                    ];

                    // Create document request up to ten (<= 10%)
                    if ($type == 'up_to_ten') {
                        $arr_data_first = [
                            'uc_declared_load' => $uc_declared_load,
                            'uc_circuit_breaker' => $uc_circuit_breaker,
                            'uc_available_power' => $uc_available_power,
                            'responsible_name' => $responsible_name,
                            'responsible_phone' => $data['create-request-first-responsiblephone'],
                            'responsible_email' => $data['create-request-first-responsibleemail'],
                            'new_link_observation' => $data["create-request-$category-link"],
                            'pattern_change_observation' => $data["create-request-$category-pattern"],
                        ];

                        $arr_create_first = array_merge($arr_data_document_request, $arr_data_first);

                        EngineeringDocumentRequestUpToTen::create($arr_create_first);
                    }

                    // Create document request above ten up to seventy five (> 10% <= 75%)
                    else if ($type == 'above_ten_up_to_seventy_five') {
                        $arr_data_second = [
                            'uc_declared_load' => $uc_declared_load,
                            'uc_circuit_breaker' => $uc_circuit_breaker,
                            'uc_available_power' => $uc_available_power,
                            'electrical_observation' => $data['create-request-second-electrical'],
                            'new_link_observation' => $data["create-request-$category-link"],
                            'pattern_change_observation' => $data["create-request-$category-pattern"],
                        ];

                        $arr_create_second = array_merge($arr_data_document_request, $arr_data_second);
                        
                        EngineeringDocumentRequestAboveTenUpToSeventyFive::create($arr_create_second);
                    }

                    // Create document request above seventy five (> 75%)
                    else {
                        $arr_data_third = [
                            'average_fp' => $data['create-request-third-ucconn'],
                            'uc_installed_load_kw' => $uc_installed_load_kw,
                            'uc_installed_load_kva' => $uc_installed_load_kva,
                            'uc_demand_kw' => $uc_demand_kw,
                            'uc_demand_kva' => $uc_demand_kva,
                            'uc_input_pattern' => $data['create-request-third-ucinputpattern'],
                            'tariff_group' => $data['create-request-third-tariffgroup'],
                            'contracted_demand_fp' => $contract_demand_fp,
                            'contracted_demand_p' => $contract_demand_p,
                            'generation_available_power' => $generation_available_power,
                            'electrical_observation' => $data['create-request-third-electrical'],
                            'current_stage_observation' => $data['create-request-third-stage'],
                            'technical_viability_observation' => $data['create-request-third-viability'],
                            'air_substation_observation' => $data['create-request-third-chartair'],
                            'air_sheltered_observation' => $data['create-request-third-chartsheltered'],
                        ];

                        $arr_create_third = array_merge($arr_data_document_request, $arr_data_third);

                        EngineeringDocumentRequestAboveSeventyFive::create($arr_create_third);
                    }

                    return redirect()->route('engineering_project_show', ['id' => encrypt($generator->project->id)])
                        ->with('success', 'Documento criado com sucesso.');
                }

                else return back()->withInput()->with('error', 'Usuário não encontrado.');
            }
        }

        else return back()->withInput()->with('error', 'Geradora não encontrada.');
    }

    /*** Show the form for editing a Document Request */
    public function editGeneratorDocumentRequest($type, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $type = decrypt($type);
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $arr_engineers = [];
        $engineers_users = User::all()->where('is_engineer', 1);

        foreach ($engineers_users as $users) {
            array_push($arr_engineers, $users->name);
        }

        // If type is up to ten (<= 10%)
        if ($type == 'up_to_ten') {
            $document_request_up_to_ten = EngineeringDocumentRequestUpToTen::findOrFail($id);

            return view('engineering.documents.access_request_form.editRequestUpToTen', [
                'document_request_up_to_ten' => $document_request_up_to_ten,
                'arr_engineers' => $arr_engineers
            ]);
        }

        // If type is above ten up to seventy five (> 10% <= 75%)
        else if ($type == 'above_ten_up_to_seventy_five') {
            $document_request_above_ten_up_to_seventy_five = EngineeringDocumentRequestAboveTenUpToSeventyFive::findOrFail($id);

            return view('engineering.documents.access_request_form.editRequestAboveTenUpToSeventyFive', [
                'document_request_above_ten_up_to_seventy_five' => $document_request_above_ten_up_to_seventy_five,
                'arr_engineers' => $arr_engineers
            ]);
        }

        // If type is above seventy five (> 75%)
        else {
            $document_request_above_seventy_five = EngineeringDocumentRequestAboveSeventyFive::findOrFail($id);

            return view('engineering.documents.access_request_form.editRequestAboveSeventyFive', [
                'document_request_above_seventy_five' => $document_request_above_seventy_five,
                'arr_engineers' => $arr_engineers
            ]);
        }
    }

    /*** Updating a Document Request */
    public function updateGeneratorDocumentRequest(Request $request, $type, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $type = decrypt($type);
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $data = $request->all();

        // Verify Request Category
        if ($type == 'up_to_ten') {
            $document_request = EngineeringDocumentRequestUpToTen::all()->where('id', $id)->first();
            $category = 'first';
        }

        else if ($type == 'above_ten_up_to_seventy_five') {
            $document_request = EngineeringDocumentRequestAboveTenUpToSeventyFive::all()->where('id', $id)->first();
            $category = 'second';
        }

        else {
            $document_request = EngineeringDocumentRequestAboveSeventyFive::all()->where('id', $id)->first();
            $category = 'third';
        }

        // Client cellphone value
        $data_client_cellphone = (isset($data["edit-request-$category-clientcellphone"])) ?
            $data["edit-request-$category-clientcellphone"] :
            null;

        // Client phone value
        $data_client_phone = (isset($data["edit-request-$category-clientphone"])) ?
            $data["edit-request-$category-clientphone"] :
            null;

        // Has special loads value
        $data_has_special_loads = (isset($data["edit-request-$category-loads"])) ?
            $data["edit-request-$category-loads"] :
            null;

        // If document exists
        if ($document_request->exists()) {
            // Validate data
            $custom_messages = [
                'required' => 'Preencha o campo :attribute.',
                'string' =>  'O campo :attribute selecionado é inválido.',
                'regex' =>  'Preencha o campo :attribute corretamente.',
                'min' => [
                    'string' => ':attribute com no mínimo :min caractere(s).',
                ],
                'max' => [
                    'string' => ':attribute com no máximo :max caracteres.',
                ],
            ];

            $attributes = [
                "edit-request-$category-clientrg" => 'RG',
                "edit-request-$category-clientrgshipping" => 'Data de Expedição',
                "edit-request-$category-clientcellphone" => 'Celular',
                "edit-request-$category-clientphone" => 'Fixo',
                "edit-request-$category-activity" => 'Ramo de Atividade',
                "edit-request-$category-loads" => 'Possui Cargas Especiais',
                "edit-request-$category-loadsdetails" => 'Detalhar Cargas Especiais',
                "edit-request-$category-subgroup" => 'Subgrupo',
                "edit-request-$category-class" => 'Classe',
                "edit-request-$category-conntype" => 'Tipo de Ligação',
                "edit-request-$category-ucpower" => 'Tensão de Atendimento da UC',
                "edit-request-$category-extension" => 'Tipo de Ramal',
                "edit-request-$category-transformerid" => 'Nº de Identificação do Poste ou Transformador mais Próximo',
                "edit-request-$category-coordinatesx" => 'Coordenada X do Ponto de Entrega do Acessante',
                "edit-request-$category-coordinatesy" => 'Coordenada Y do Ponto de Entrega do Acessante',
                "edit-request-$category-responsiblename" => 'Nome do Responsável Legal',
                "edit-request-$category-responsiblephone" => 'Telefone do Responsável Legal',
                "edit-request-$category-responsibleemail" => 'Email do Responsável Legal',
                "edit-request-$category-managername" => 'Nome Completo',
                "edit-request-$category-generationtype" => 'Tipo de Geração',
                "edit-request-$category-generationdetails" => 'Especificar se necessário',
                "edit-request-$category-generationframework" => 'Enquadramento da Microgeração',
                "edit-request-$category-generationpower" => 'Potência de Geração',
                "edit-request-$category-generationok" => 'OK',
                "edit-request-$category-generationvoltage" => 'Tensão de Conexão',
                "edit-request-$category-art" => 'ART do Responsável Técnico pelo projeto e instalação do sistema de microgeração',
                "edit-request-$category-diagram" => 'Diagrama unifilar',
                "edit-request-$category-memo" => 'Memorial Técnico Descritivo da instalação',
                "edit-request-$category-compliance" => 'Certificados de Conformidade dos Inversores',
                "edit-request-$category-participants" => 'Lista de unidades consumidoras participantes do sistema de compensação',
                "edit-request-$category-instrument" => 'Cópia de instrumento jurídico',
                "edit-request-$category-aneel" => 'Documento que comprove o reconhecimento pela ANEEL',
                "edit-request-$category-rent" => 'Contrato de Aluguel ou Arrendamento da unidade consumidora',
                "edit-request-$category-procuration" => 'Procuração',
                "edit-request-$category-condominium" => 'Autorização de uso de área comum em condomínio',
            ];

            $validator = Validator::make($data, [
                "edit-request-$category-clientrg" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-clientrg"] != null), 'string', 'min:7', 'max:9'
                ],
                "edit-request-$category-clientrgshipping" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-clientrgshipping"] != null), 'date', 'date_format:"Y-m-d"'
                ],
                "edit-request-$category-clientcellphone" => [
                    'nullable', Rule::requiredIf($data_client_cellphone != null), 'string',
                ],
                "edit-request-$category-clientphone" => [
                    'nullable', Rule::requiredIf($data_client_phone != null), 'string',
                ],
                "edit-request-$category-activity" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-activity"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-loads" => [
                    'nullable', Rule::requiredIf($data_has_special_loads != null), 'string',
                ],
                "edit-request-$category-loadsdetails" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-loadsdetails"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-subgroup" => [
                    'required', 'string', 'min:1',
                ],
                "edit-request-$category-class" => [
                    'required', 'string',
                ],
                "edit-request-$category-conntype" => [
                    'required', 'string',
                ],
                "edit-request-$category-ucpower" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-ucpower"] != null),
                ],
                "edit-request-$category-extension" => [
                    'required', 'string',
                ],
                "edit-request-$category-transformerid" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-transformerid"] != null), 'string',
                ],
                "edit-request-$category-coordinatesx" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-coordinatesx"] != null),
                ],
                "edit-request-$category-coordinatesy" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-coordinatesy"] != null),
                ],
                "edit-request-$category-managername" => [
                    'required', 'string', 'min:5', 'max:255',
                ],
                "edit-request-$category-generationtype" => [
                    'required', 'string',
                ],
                "edit-request-$category-generationdetails" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-generationdetails"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-generationframework" => [
                    'required', 'string',
                ],
                "edit-request-$category-generationpower" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-generationpower"] != null), 'string',
                ],
                "edit-request-$category-generationok" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-generationok"] != null), 'string',
                ],
                "edit-request-$category-generationvoltage" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-generationvoltage"] != null), 'string',
                ],
                "edit-request-$category-art" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-art"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-diagram" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-diagram"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-memo" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-memo"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-compliance" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-compliance"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-participants" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-participants"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-instrument" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-instrument"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-aneel" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-aneel"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-rent" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-rent"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-procuration" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-procuration"] != null), 'string', 'min:2',
                ],
                "edit-request-$category-condominium" => [
                    'nullable', Rule::requiredIf($data["edit-request-$category-condominium"] != null), 'string', 'min:2',
                ],
            ], $custom_messages, $attributes);

            // If type is up to ten (<= 10%)
            if ($type == 'up_to_ten') {
                $attributes_category_first = [
                    "edit-request-$category-ucload" => 'Carga Declarada da UC',
                    "edit-request-$category-ucbreaker" => 'Disjuntor de Entrada da UC',
                    "edit-request-$category-ucpd" => 'Potência Disponibilizada para UC',
                    'edit-request-first-responsiblename' => 'Nome do Responsável Legal',
                    'edit-request-first-responsiblephone' => 'Telefone do Responsável Legal',
                    'edit-request-first-responsibleemail' => 'Email do Responsável Legal',
                    "edit-request-$category-link" => 'Formulário de Ligação Nova',
                    "edit-request-$category-pattern" => 'Formulário de Troca de Padrão',
                ];

                $validator_category_first = Validator::make($data, [
                    "edit-request-$category-ucload" => [
                        'nullable', Rule::requiredIf($data["edit-request-$category-ucload"] != null),
                    ],
                    "edit-request-$category-ucbreaker" => [
                        'required',
                    ],
                    "edit-request-$category-ucpd" => [
                        'nullable', Rule::requiredIf($data["edit-request-$category-ucpd"] != null),
                    ],
                    'edit-request-first-responsiblename' => [
                        'nullable', Rule::requiredIf($data['edit-request-first-responsiblename'] != null), 'string',
                    ],
                    'edit-request-first-responsiblephone' => [
                        'nullable', Rule::requiredIf($data['edit-request-first-responsiblephone'] != null), 'string',
                    ],
                    'edit-request-first-responsibleemail' => [
                        'nullable', Rule::requiredIf($data['edit-request-first-responsibleemail'] != null), 'string', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i',
                    ],
                    "edit-request-$category-link" => [
                        'nullable', Rule::requiredIf($data["edit-request-$category-link"] != null), 'string', 'min:2',
                    ],
                    "edit-request-$category-pattern" => [
                        'nullable', Rule::requiredIf($data["edit-request-$category-pattern"] != null), 'string', 'min:2',
                    ],
                ], $custom_messages, $attributes_category_first);

                if ($validator_category_first->fails()) {
                    foreach ($validator_category_first->getMessageBag()->getMessages() as $error) {
                        return back()->withInput($data)->with('error', $error[0]);
                    }
                }
            }

            // If type is above ten up to seventy five (> 10% <= 75%)
            else if ($type == 'above_ten_up_to_seventy_five') {
                $attributes_category_second = [
                    "edit-request-$category-ucload" => 'Carga Declarada da UC',
                    "edit-request-$category-ucbreaker" => 'Disjuntor de Entrada da UC',
                    "edit-request-$category-ucpd" => 'Potência Disponibilizada para UC',
                    'edit-request-second-electrical' => 'Projeto elétrico das instalações de conexão',
                    "edit-request-$category-link" => 'Formulário de Ligação Nova ',
                    "edit-request-$category-pattern" => 'Formulário de Troca de Padrão',
                ];

                $validator_category_second = Validator::make($data, [
                    "edit-request-$category-ucload" => [
                        'nullable', Rule::requiredIf($data["edit-request-$category-ucload"] != null),
                    ],
                    "edit-request-$category-ucbreaker" => [
                        'required',
                    ],
                    "edit-request-$category-ucpd" => [
                        'nullable', Rule::requiredIf($data["edit-request-$category-ucpd"] != null),
                    ],
                    'edit-request-second-electrical' => [
                        'nullable', Rule::requiredIf($data['edit-request-second-electrical'] != null), 'string', 'min:2',
                    ],
                    "edit-request-$category-link" => [
                        'nullable', Rule::requiredIf($data["edit-request-$category-link"] != null), 'string', 'min:2',
                    ],
                    "edit-request-$category-pattern" => [
                        'nullable', Rule::requiredIf($data["edit-request-$category-pattern"] != null), 'string', 'min:2',
                    ],
                ], $custom_messages, $attributes_category_second);

                if ($validator_category_second->fails()) {
                    foreach ($validator_category_second->getMessageBag()->getMessages() as $error) {
                        return back()->withInput($data)->with('error', $error[0]);
                    }
                }
            }

            // If type is above seventy five (> 75%)
            else {
                $attributes_category_third = [
                    'edit-request-third-ucconn' => 'FP Médio no Ponto de Entrega/Conexão da UC',
                    'edit-request-third-ucinstalledloadkw' => 'Carga Instalada da UC (em kW)',
                    'edit-request-third-ucinstalledloadkva' => 'Carga Instalada da UC (em kVA)',
                    'edit-request-third-ucdemandkw' => 'Demanda da UC (em kW)',
                    'edit-request-third-ucdemandkva' => 'Demanda da UC (em kVA)',
                    'edit-request-third-ucinputpattern' => 'Padrão de Entrada da UC',
                    'edit-request-third-tariffgroup' => 'Tarifa GRUPO A',
                    'edit-request-third-contracteddemandfp' => 'Demanda Contratada FP',
                    'edit-request-third-contracteddemandp' => 'Demanda Contratada P',
                    'edit-request-third-generationpd' => 'Potência Disponibilizada',
                    'edit-request-third-stage' => 'Estágio atual do empreendimento',
                    'edit-request-third-viability' => 'Formulário de Viabilidade Técnica',
                    'edit-request-third-chartair' => 'Quadro de Cargas para Subestação Aérea',
                    'edit-request-third-chartsheltered' => 'Quadro de Cargas para Subestação Abrigada',
                ];

                $validator_category_third = Validator::make($data, [
                    'edit-request-third-ucconn' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-ucconn'] != null), 'string',
                    ],
                    'edit-request-third-ucinstalledloadkw' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-ucinstalledloadkw'] != null),
                    ],
                    'edit-request-third-ucinstalledloadkva' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-ucinstalledloadkva'] != null),
                    ],
                    'edit-request-third-ucdemandkw' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-ucdemandkw'] != null),
                    ],
                    'edit-request-third-ucdemandkva' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-ucdemandkva'] != null),
                    ],
                    'edit-request-third-ucinputpattern' => [
                        'required', 'string'
                    ],
                    'edit-request-third-tariffgroup' => [
                        'required', 'string'
                    ],
                    'edit-request-third-contracteddemandfp' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-contracteddemandfp'] != null),
                    ],
                    'edit-request-third-contracteddemandp' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-contracteddemandp'] != null),
                    ],
                    'edit-request-third-generationpd' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-generationpd'] != null),
                    ],
                    'edit-request-third-stage' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-stage'] != null), 'string', 'min:2',
                    ],
                    'edit-request-third-viability' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-viability'] != null), 'string', 'min:2',
                    ],
                    'edit-request-third-chartair' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-chartair'] != null), 'string', 'min:2',
                    ],
                    'edit-request-third-chartsheltered' => [
                        'nullable', Rule::requiredIf($data['edit-request-third-chartsheltered'] != null), 'string', 'min:2',
                    ],
                ], $custom_messages, $attributes_category_third);

                if ($validator_category_third->fails()) {
                    foreach ($validator_category_third->getMessageBag()->getMessages() as $error) {
                        return back()->withInput($data)->with('error', $error[0]);
                    }
                }   
            }
            
            if ($validator->fails()) {
                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    return back()->withInput($data)->with('error', $error[0]);
                }
            }

            else {
                // Manager name
                $manager_name = decrypt($data["edit-request-$category-managername"]);
                $user = User::all()->where('name', $manager_name)->first();

                // If user exists
                if ($user->exists()) {
                    // Client phone and cellphone
                    $is_client_cellphone = (strlen($document_request->generator->client->phone) == 15) ? true : false;

                    if ($is_client_cellphone) {
                        $client_phone = $data_client_phone;
                        $client_cellphone = $document_request->generator->client->phone;
                    }
    
                    else {
                        $client_phone = $document_request->generator->client->phone;
                        $client_cellphone = $data_client_cellphone;
                    }

                    // Has special loads
                    $has_special_loads = $data_has_special_loads != null && decrypt($data["edit-request-$category-loads"]) == 'SIM' ?
                        true :
                        false;

                    // Consumption class
                    $consumption_class = decrypt($data["edit-request-$category-class"]);

                    // Connection type
                    $connection_type = decrypt($data["edit-request-$category-conntype"]);

                    if ($type == 'above_seventy_five') {
                        // UC installed load (kW)
                        $uc_installed_load_kw = ($data["edit-request-third-ucinstalledloadkw"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-third-ucinstalledloadkw"]) * 1000) :
                            null;

                        // UC installed load (kVA)
                        $uc_installed_load_kva = ($data["edit-request-third-ucinstalledloadkva"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-third-ucinstalledloadkva"]) * 1000) :
                            null;

                        // UC demand (kW)
                        $uc_demand_kw = ($data["edit-request-third-ucdemandkw"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-third-ucdemandkw"]) * 1000) :
                            null;

                        // UC demand (kvA)
                        $uc_demand_kva = ($data["edit-request-third-ucdemandkva"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-third-ucdemandkva"]) * 1000) :
                            null;

                        // Contracted demand FP
                        $contracted_demand_fp = ($data["edit-request-third-contracteddemandfp"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-third-contracteddemandfp"]) * 1000) :
                            null;

                        // Contracted demand P
                        $contracted_demand_p = ($data["edit-request-third-contracteddemandp"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-third-contracteddemandp"]) * 1000) :
                            null;

                        // Available Power
                        $generation_available_power = ($data["edit-request-third-generationpd"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-third-generationpd"]) * 1000) :
                            null;
                    }

                    // UC power
                    if ($type == 'above_seventy_five') {
                        $uc_power = ($data["edit-request-$category-ucpower"] != null) ? 
                            doubleval(str_replace(',', '.', $data["edit-request-$category-ucpower"]) * 1000) :
                            null;
                    }

                    else {
                        $uc_power = ($data["edit-request-$category-ucpower"] != null) ? 
                            doubleval(str_replace(',', '.', $data["edit-request-$category-ucpower"])) :
                            null;
                    }
                    
                    if ($type != 'above_seventy_five') {
                        // UC declared load
                        $uc_declared_load = ($data["edit-request-$category-ucload"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-$category-ucload"]) * 1000) :
                            null;

                        // UC circuit breaker
                        $uc_circuit_breaker = doubleval(str_replace(',', '.', $data["edit-request-$category-ucbreaker"]));

                        // UC available power
                        $uc_available_power = ($data["edit-request-$category-ucpd"] != null) ?
                            doubleval(str_replace(',', '.', $data["edit-request-$category-ucpd"]) * 1000) :
                            null;
                    }

                    // Point coordinate X
                    $coordinate_x = ($data["edit-request-$category-coordinatesx"] != null) ?
                         str_replace(',', '.', $data["edit-request-$category-coordinatesx"]) :
                         null;

                    // Point coordinate Y
                    $coordinate_y = ($data["edit-request-$category-coordinatesy"] != null) ?
                        str_replace(',', '.', $data["edit-request-$category-coordinatesy"]) :
                        null;

                    // Responsible name
                    if ($type == 'up_to_ten') {
                        $responsible_name = ($data['edit-request-first-responsiblename'] != null) ?
                            ucwords(mb_strtolower($data['edit-request-first-responsiblename'], 'UTF-8')) :
                            null;
                    }

                    // Generation power
                    $generation_power = ($data["edit-request-$category-generationpower"] != null) ?
                    doubleval(str_replace(',', '.', $data["edit-request-$category-generationpower"]) * 1000) :
                    null;

                    // Update document
                    $document_request->generator_id = $document_request->generator->id;
                    $document_request->user_id = $user->id;
                    $document_request->client_rg = $data["edit-request-$category-clientrg"];
                    $document_request->client_rg_shipping_date = $data["edit-request-$category-clientrgshipping"];
                    $document_request->client_phone = $client_phone;
                    $document_request->client_cellphone = $client_cellphone;
                    $document_request->branch_activity = $data["edit-request-$category-activity"];
                    $document_request->has_special_loads = $has_special_loads;
                    $document_request->special_loads_details = $data["edit-request-$category-loadsdetails"];
                    $document_request->subgroup = $data["edit-request-$category-subgroup"];
                    $document_request->consumption_class = $consumption_class;
                    $document_request->connection_type = $connection_type;
                    $document_request->uc_power = $uc_power;
                    $document_request->extension_type = $data["edit-request-$category-extension"];
                    $document_request->transformer_identification = $data["edit-request-$category-transformerid"];
                    $document_request->point_coordinate_x = $coordinate_x;
                    $document_request->point_coordinate_y = $coordinate_y;
                    $document_request->generation_type = $data["edit-request-$category-generationtype"];
                    $document_request->generation_details = $data["edit-request-$category-generationdetails"];
                    $document_request->generation_framework = $data["edit-request-$category-generationframework"];
                    $document_request->generation_power = $generation_power;
                    $document_request->generation_ok = $data["edit-request-$category-generationok"];
                    $document_request->generation_voltage = $data["edit-request-$category-generationvoltage"];
                    $document_request->generation_start_date = 'EM PROJETO';
                    $document_request->art_observation = $data["edit-request-$category-art"];
                    $document_request->diagram_observation = $data["edit-request-$category-diagram"];
                    $document_request->memo_observation = $data["edit-request-$category-memo"];
                    $document_request->compliance_certificate_observation = $data["edit-request-$category-compliance"];
                    $document_request->uc_participants_observation = $data["edit-request-$category-participants"];
                    $document_request->legal_instrument_observation = $data["edit-request-$category-instrument"];
                    $document_request->aneel_observation = $data["edit-request-$category-aneel"];
                    $document_request->rent_contract_observation = $data["edit-request-$category-rent"];
                    $document_request->procuration_observation = $data["edit-request-$category-procuration"];
                    $document_request->condominium_observation = $data["edit-request-$category-condominium"];

                    // Update document request up to ten (<= 10%)
                    if ($type == 'up_to_ten') {
                        $document_request->uc_declared_load = $uc_declared_load;
                        $document_request->uc_circuit_breaker = $uc_circuit_breaker;
                        $document_request->uc_available_power = $uc_available_power;
                        $document_request->responsible_name = $responsible_name;
                        $document_request->responsible_phone = $data['edit-request-first-responsiblephone'];
                        $document_request->responsible_email = $data['edit-request-first-responsibleemail'];
                        $document_request->new_link_observation = $data["edit-request-$category-link"];
                        $document_request->pattern_change_observation = $data["edit-request-$category-pattern"];
                    }

                    // Update document request above ten up to seventy five (> 10%  <= 75%)
                    else if ($type == 'above_ten_up_to_seventy_five') {
                        $document_request->uc_declared_load = $uc_declared_load;
                        $document_request->uc_circuit_breaker = $uc_circuit_breaker;
                        $document_request->uc_available_power = $uc_available_power;
                        $document_request->electrical_observation = $data['edit-request-second-electrical'];
                        $document_request->new_link_observation = $data['edit-request-second-link'];
                        $document_request->pattern_change_observation = $data['edit-request-second-pattern'];
                    }

                    // Update document request above seventy five (> 75%)
                    else {
                        $document_request->average_fp = $data['edit-request-third-ucconn'];
                        $document_request->uc_installed_load_kw = $uc_installed_load_kw;
                        $document_request->uc_installed_load_kva = $uc_installed_load_kva;
                        $document_request->uc_demand_kw = $uc_demand_kw;
                        $document_request->uc_demand_kva = $uc_demand_kva;
                        $document_request->uc_input_pattern = $data['edit-request-third-ucinputpattern'];
                        $document_request->tariff_group = $data['edit-request-third-tariffgroup'];
                        $document_request->contracted_demand_fp = $contracted_demand_fp;
                        $document_request->contracted_demand_p = $contracted_demand_p;
                        $document_request->generation_available_power = $generation_available_power;
                        $document_request->electrical_observation = $data['edit-request-third-electrical'];
                        $document_request->current_stage_observation = $data['edit-request-third-stage'];
                        $document_request->technical_viability_observation = $data['edit-request-third-viability'];
                        $document_request->air_substation_observation = $data['edit-request-third-chartair'];
                        $document_request->air_sheltered_observation = $data['edit-request-third-chartsheltered'];
                    }

                    $document_request->save();

                    return redirect()->route('engineering_project_show', ['id' => encrypt($document_request->generator->project->id)])
                        ->with('success', 'Documento atualizado com sucesso.');
                }
            }
        }

        else return back()->withInput()->with('error', 'Documento não encontrado.');
    }

    /*** Get engineer user data via fetch  */
    public function get_engineer_data_fetch()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $name = decrypt($data['name']);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $engineer = User::where('name', $name)->first();
        $status = ($engineer) ? true : false;

        if ($status) {
            $user_status = $engineer->status ? true : false;

            if (!$user_status) {
                return response()->json([
                    'status' => $status,
                    'user_status' => $user_status,
                    'engineer_data' => $engineer->name
                ]);
            }
    
            else {
                $engineer_data = [
                    'title' => $engineer->professional_title,
                    'registration' => $engineer->professional_registration,
                    'registration_state' => $engineer->professional_state,
                    'email' => $engineer->email,
                    'address' => $engineer->address_complement,
                    'phone' => $engineer->phone,
                    'cellphone' => $engineer->cellphone,
                    'cep' => $engineer->cep,
                    'address' => $engineer->address,
                    'number' => $engineer->number,
                    'neighborhood' => $engineer->neighborhood,
                    'city' => $engineer->city,
                    'state' => $engineer->state,
                ];
    
                return response()->json([
                    'status' => $status,
                    'user_status' => $user_status,
                    'engineer_data' => $engineer_data
                ]);
            }
        }

        else {
            return response()->json([
                'status' => $status,
                'engineer_data' => []
            ]);
        }
    }

    /*** Print generator document Access Request Form  */
    public function printGeneratorDocumentRequest(Request $request, $type, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $type = decrypt($type);
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $data = $request->all();
        $generator = EngineeringGenerator::findOrFail($id);

        // If generator exists
        if ($generator->exists()) {
            // Verify Request Category
            if ($type == 'up_to_ten') {
                $document_request = $generator->document_request_up_to_ten;
                $category = 'first';
            }

            else if ($type == 'above_ten_up_to_seventy_five') {
                $document_request = $generator->document_request_above_ten_up_to_seventy_five;
                $category = 'second';
            }

            else {
                $document_request = $generator->document_request_above_seventy_five;
                $category = 'third';
            }

            // If document exists
            if ($document_request->exists()) {
                $date = date('YmdHis');
                $title = "accessrequestform_$date";
                $text_font = 7;
                $line_height = 1.4;

                view()->share('title', $title);
                view()->share('text_font', $text_font);
                view()->share('line_height', $line_height);
                view()->share('document_request', $document_request);
                view()->share('datas', $data);

                // Access Request Form - Up to Ten (<= 10%)
                if ($category == 'first') {
                    $uptoten_solar_qty_sum = 0;
                    $uptoten_solar_peakpower_sum = 0;
                    $uptoten_solar_arrangementarea_sum = 0;
                    $uptoten_inverter_ratedpower_sum = 0;

                    foreach ($data['request-uptoten'] as $key => $request_uptoten) {
                        if ($key == 'solar') {
                            foreach ($request_uptoten as $solar) {
                                $uptoten_solar_qty_sum += $solar['quantity'];
                                $uptoten_solar_peakpower_sum += str_replace(',', '.', $solar['peak-power']);
                                $uptoten_solar_arrangementarea_sum += str_replace(',', '.', $solar['arrangement-area']);
                            }
                        }

                        if ($key == 'inverter') {
                            foreach ($request_uptoten as $inverter) {
                                $uptoten_inverter_ratedpower_sum += str_replace(',', '.', $inverter['rated-power']);
                            }
                        }
                    }

                    view()->share('uptoten_solar_qty_sum', $uptoten_solar_qty_sum);
                    view()->share('uptoten_solar_peakpower_sum', $uptoten_solar_peakpower_sum);
                    view()->share('uptoten_solar_arrangementarea_sum', $uptoten_solar_arrangementarea_sum);
                    view()->share('uptoten_inverter_ratedpower_sum', $uptoten_inverter_ratedpower_sum);

                    return view('engineering.documents.access_request_form.printRequestUpToTenForm', [
                        'title' => $title,
                        'document_request' => $document_request,
                        'form_data' => $data['request-uptoten'],
                        'uptoten_solar_qty_sum' => $uptoten_solar_qty_sum,
                        'uptoten_solar_peakpower_sum' => $uptoten_solar_peakpower_sum,
                        'uptoten_solar_arrangementarea_sum' => $uptoten_solar_arrangementarea_sum,
                        'uptoten_inverter_ratedpower_sum' => $uptoten_inverter_ratedpower_sum,
                    ]);
                }

                else if ($category == 'second') {
                    $abovetenuptoseventyfive_solar_qty_sum = 0;
                    $abovetenuptoseventyfive_solar_peakpower_sum = 0;
                    $abovetenuptoseventyfive_solar_arrangementarea_sum = 0;
                    $abovetenuptoseventyfive_inverter_ratedpower_sum = 0;

                    foreach ($data['request-abovetenuptoseventyfive'] as $key => $request_abovetenuptoseventyfive) {
                        if ($key == 'solar') {
                            foreach ($request_abovetenuptoseventyfive as $solar) {
                                $abovetenuptoseventyfive_solar_qty_sum += $solar['quantity'];
                                $abovetenuptoseventyfive_solar_peakpower_sum += str_replace(',', '.', $solar['peak-power']);
                                $abovetenuptoseventyfive_solar_arrangementarea_sum += str_replace(',', '.', $solar['arrangement-area']);
                            }
                        }

                        if ($key == 'inverter') {
                            foreach ($request_abovetenuptoseventyfive as $inverter) {
                                $abovetenuptoseventyfive_inverter_ratedpower_sum += str_replace(',', '.', $inverter['rated-power']);
                            }
                        }
                    }

                    view()->share('abovetenuptoseventyfive_solar_qty_sum', $abovetenuptoseventyfive_solar_qty_sum);
                    view()->share('abovetenuptoseventyfive_solar_peakpower_sum', $abovetenuptoseventyfive_solar_peakpower_sum);
                    view()->share('abovetenuptoseventyfive_solar_arrangementarea_sum', $abovetenuptoseventyfive_solar_arrangementarea_sum);
                    view()->share('abovetenuptoseventyfive_inverter_ratedpower_sum', $abovetenuptoseventyfive_inverter_ratedpower_sum);

                    return view('engineering.documents.access_request_form.printRequestAboveTenUpToSeventyFiveForm', [
                        'title' => $title,
                        'document_request' => $document_request,
                        'form_data' => $data['request-abovetenuptoseventyfive'],
                        'abovetenuptoseventyfive_solar_qty_sum' => $abovetenuptoseventyfive_solar_qty_sum,
                        'abovetenuptoseventyfive_solar_peakpower_sum' => $abovetenuptoseventyfive_solar_peakpower_sum,
                        'abovetenuptoseventyfive_solar_arrangementarea_sum' => $abovetenuptoseventyfive_solar_arrangementarea_sum,
                        'abovetenuptoseventyfive_inverter_ratedpower_sum' => $abovetenuptoseventyfive_inverter_ratedpower_sum,
                    ]);
                }
                
                else {
                    $aboveseventyfive_solar_qty_sum = 0;
                    $aboveseventyfive_solar_peakpower_sum = 0;
                    $aboveseventyfive_solar_arrangementarea_sum = 0;
                    $aboveseventyfive_inverter_ratedpower_sum = 0;
                    $aboveseventyfive_transformer_ratedpower_sum = 0;

                    foreach ($data['request-aboveseventyfive'] as $key => $request_aboveseventyfive) {
                        if ($key == 'solar') {
                            foreach ($request_aboveseventyfive as $solar) {
                                $aboveseventyfive_solar_qty_sum += $solar['quantity'];
                                $aboveseventyfive_solar_peakpower_sum += str_replace(',', '.', $solar['peak-power']);
                                $aboveseventyfive_solar_arrangementarea_sum += str_replace(',', '.', $solar['arrangement-area']);
                            }
                        }

                        if ($key == 'inverter') {
                            foreach ($request_aboveseventyfive as $inverter) {
                                $aboveseventyfive_inverter_ratedpower_sum += str_replace(',', '.', $inverter['rated-power']);
                            }
                        }

                        if ($key == 'transformer') {
                            foreach ($request_aboveseventyfive as $transformer) {
                                if ($transformer['rated-power'] != "") {
                                    $aboveseventyfive_transformer_ratedpower_sum += str_replace(',', '.', $transformer['rated-power']);
                                }

                                else $aboveseventyfive_transformer_ratedpower_sum = 0;
                            }
                        }
                    }

                    view()->share('aboveseventyfive_solar_qty_sum', $aboveseventyfive_solar_qty_sum);
                    view()->share('aboveseventyfive_solar_peakpower_sum', $aboveseventyfive_solar_peakpower_sum);
                    view()->share('aboveseventyfive_solar_arrangementarea_sum', $aboveseventyfive_solar_arrangementarea_sum);
                    view()->share('aboveseventyfive_inverter_ratedpower_sum', $aboveseventyfive_inverter_ratedpower_sum);
                    view()->share('aboveseventyfive_transformer_ratedpower_sum', $aboveseventyfive_transformer_ratedpower_sum);

                    return view('engineering.documents.access_request_form.printRequestAboveSeventyFiveForm', [
                        'title' => $title,
                        'document_request' => $document_request,
                        'form_data' => $data['request-aboveseventyfive'],
                        'aboveseventyfive_solar_qty_sum' => $aboveseventyfive_solar_qty_sum,
                        'aboveseventyfive_solar_peakpower_sum' => $aboveseventyfive_solar_peakpower_sum,
                        'aboveseventyfive_solar_arrangementarea_sum' => $aboveseventyfive_solar_arrangementarea_sum,
                        'aboveseventyfive_inverter_ratedpower_sum' => $aboveseventyfive_inverter_ratedpower_sum,
                        'aboveseventyfive_transformer_ratedpower_sum' => $aboveseventyfive_transformer_ratedpower_sum,
                    ]);
                }   
            }

            else return back()->withInput()->with('error', 'Documento não encontrado.');
        }

        else return back()->withInput()->with('error', 'Geradora não encontrada.');
    }

    /*** Get engineer beneficiary data via fetch  */
    public function get_beneficiary_data_fetch()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['beneficiary']);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $beneficiary = EngineeringBeneficiary::where('id', $id)->first();
        $status = ($beneficiary) ? true : false;

        if ($status) {
            $beneficiary_client = $beneficiary->client != null ?
                true :
                false;

            $beneficiary_data = [
                'beneficiary_client' => $beneficiary_client,
                'different_beneficiary_contract_account' => $beneficiary->different_beneficiary_contract_account,
                'beneficiary_contract_account' => $beneficiary->beneficiary_contract_account,
            ];

            return response()->json([
                'status' => $status,
                'beneficiary_data' => $beneficiary_data
            ]);
        }

        else {
            return response()->json([
                'status' => $status,
                'beneficiary_data' => []
            ]);
        }
    }

    /*** Get engineer generator data via fetch  */
    public function get_generator_data_fetch()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['generator']);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $generator = EngineeringGenerator::where('id', $id)->first();
        $status = ($generator) ? true : false;

        if ($status) {
            $generator_data = [
                'different_generator_contract_account' => $generator->different_generator_contract_account,
                'generator_contract_account' => $generator->generator_contract_account,
                'generator_client_login' => $generator->client->login,
                'generator_client_password' => $generator->client->password,
            ];

            return response()->json([
                'status' => $status,
                'generator_data' => $generator_data
            ]);
        }

        else {
            return response()->json([
                'status' => $status,
                'generator_data' => []
            ]);
        }
    }

    // REMOVER
    public function migrate_generator_document_fetch()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['generator']);
            $type = decrypt($data['type']);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $generator = EngineeringGenerator::where('id', $id)->first();
        $status = ($generator) ? true : false;

        if ($status) {
            if ($type == 'request') {
                EngineeringDocumentAccessRequestForm::create([
                    'generator_id' => $generator->id,
                    'file_access_request_form_name' => $generator->document->file_access_request_form_name,
                    'file_access_request_form_path' => $generator->document->file_access_request_form_path,
                ]);

                return response()->json([
                    'status' => $status,
                    'created' => true
                ]);
            }

            else if ($type == 'art') {
                EngineeringDocumentArt::create([
                    'generator_id' => $generator->id,
                    'file_art_name' => $generator->document->file_art_name,
                    'file_art_path' => $generator->document->file_art_path,
                ]);

                return response()->json([
                    'status' => $status,
                    'created' => true
                ]);
            }

            else if ($type == 'aneel') {
                EngineeringDocumentAneel::create([
                    'generator_id' => $generator->id,
                    'file_aneel_form_name' => $generator->document->file_aneel_form_name,
                    'file_aneel_form_path' => $generator->document->file_aneel_form_path,
                ]);

                return response()->json([
                    'status' => $status,
                    'created' => true
                ]);
            }

            else if ($type == 'certificates') {
                EngineeringDocumentDataSheetCertificates::create([
                    'generator_id' => $generator->id,
                    'file_data_sheet_certificates_name' => $generator->document->file_data_sheet_certificates_name,
                    'file_data_sheet_certificates_path' => $generator->document->file_data_sheet_certificates_path,
                ]);

                return response()->json([
                    'status' => $status,
                    'created' => true
                ]);
            }

            else if ($type == 'memorial') {
                EngineeringDocumentDescriptiveMemorial::create([
                    'generator_id' => $generator->id,
                    'file_descriptive_memorial_name' => $generator->document->file_descriptive_memorial_name,
                    'file_descriptive_memorial_path' => $generator->document->file_descriptive_memorial_path,
                ]);

                return response()->json([
                    'status' => $status,
                    'created' => true
                ]);
            }

            else if ($type == 'electrical') {
                EngineeringDocumentElectricalProject::create([
                    'generator_id' => $generator->id,
                    'file_electrical_project_name' => $generator->document->file_electrical_project_name,
                    'file_electrical_project_path' => $generator->document->file_electrical_project_path,
                ]);

                return response()->json([
                    'status' => $status,
                    'created' => true
                ]);
            }
        }

        else {
            return response()->json([
                'status' => $status,
                'generator_data' => []
            ]);
        }
    }
}