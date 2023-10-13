<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contract;
use App\Models\ContractEquipment;
use App\Models\EquipmentGenerator;
use App\Models\EquipmentCable;
use App\Models\EquipmentConnector;
use App\Models\EquipmentOther;
use App\Models\EquipmentSolarInverter;
use App\Models\EquipmentStringBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EquipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.not_engineering')->except(['datasheetView']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Equipments
        $equipments_generator = EquipmentGenerator::all();
        $equipments_solar_inverter = EquipmentSolarInverter::all();
        $equipments_string_box = EquipmentStringBox::all();
        $equipments_cable = EquipmentCable::all();
        $equipments_connector = EquipmentConnector::all();
        $equipments_other = EquipmentOther::all();

        $equipments_array = [];
        $equipments = [];

        // Generator
        foreach ($equipments_generator as $equipment) {
            if (!Storage::disk('public')->exists(substr($equipment->datasheet_path, 9))) {
                $equipment->datasheet_name = null;
                $equipment->datasheet_path = null;
            }

            $text = 'Módulo Solar ' . $equipment->producer . ' - ' . $equipment->module . ' - ' . $equipment->technology . ' - ' . str_replace('.', ',', $equipment->power) . ' W';

            array_push($equipments_array, [
                'id' => encrypt($equipment->id),
                'text' => $text,
                'module' => $equipment->module,
                'producer' => $equipment->producer,
                'model' => null,
                'power' => str_replace('.', ',', $equipment->power),
                'mppt' => null,
                'voltage' => null,
                'technology' => $equipment->technology,
                'guarantee' => $equipment->guarantee,
                'datasheet_name' => $equipment->datasheet_name,
                'datasheet_path' => $equipment->datasheet_path,
                'type' => 'GENERATOR',
                'category' => 'Gerador Solar',
            ]);

            array_push($equipments, $text);
        }

        // Solar Inverter
        foreach ($equipments_solar_inverter as $equipment) {
            if (!Storage::disk('public')->exists(substr($equipment->datasheet_path, 9))) {
                $equipment->datasheet_name = null;
                $equipment->datasheet_path = null;
            }

            $text = 'Inversor ' . $equipment->producer . ' - ' . str_replace('.', ',', $equipment->power) . ' kW - ' . $equipment->mppt . ' MPPT - ' . $equipment->voltage . ' V';
            
            array_push($equipments_array, [
                'id' => encrypt($equipment->id),
                'text' => $text,
                'module' => null,
                'producer' => $equipment->producer,
                'model' => null,
                'power' => str_replace('.', ',', $equipment->power),
                'mppt' => $equipment->mppt,
                'voltage' => $equipment->voltage,
                'technology' => null,
                'guarantee' => $equipment->guarantee,
                'datasheet_name' => $equipment->datasheet_name,
                'datasheet_path' => $equipment->datasheet_path,
                'type' => 'SOLAR_INVERTER',
                'category' => 'Inversor Solar',
            ]);

            array_push($equipments, $text);
        }

        // String box
        foreach ($equipments_string_box as $equipment) {
            if (!Storage::disk('public')->exists(substr($equipment->datasheet_path, 9))) {
                $equipment->datasheet_name = null;
                $equipment->datasheet_path = null;
            }

            $text = 'String Box ' . $equipment->producer . ' ' . $equipment->model;
            
            array_push($equipments_array, [
                'id' => encrypt($equipment->id),
                'text' => $text,
                'module' => null,
                'producer' => $equipment->producer,
                'model' => $equipment->model,
                'power' => null,
                'mppt' => null,
                'voltage' => null,
                'technology' => null,
                'guarantee' => null,
                'datasheet_name' => $equipment->datasheet_name,
                'datasheet_path' => $equipment->datasheet_path,
                'type' => 'STRING_BOX',
                'category' => 'String Box',
            ]);
            
            array_push($equipments, $text);
        }

        // Cable
        foreach ($equipments_cable as $equipment) {
            if (!Storage::disk('public')->exists(substr($equipment->datasheet_path, 9))) {
                $equipment->datasheet_name = null;
                $equipment->datasheet_path = null;
            }

            array_push($equipments_array, [
                'id' => encrypt($equipment->id),
                'text' => $equipment->name,
                'module' => null,
                'producer' => null,
                'model' => null,
                'power' => null,
                'mppt' => null,
                'voltage' => null,
                'technology' => null,
                'guarantee' => null,
                'datasheet_name' => $equipment->datasheet_name,
                'datasheet_path' => $equipment->datasheet_path,
                'type' => 'CABLE',
                'category' => 'Cabo',
            ]);

            array_push($equipments, $equipment->name);
        }

        // Connector
        foreach ($equipments_connector as $equipment) {
            if (!Storage::disk('public')->exists(substr($equipment->datasheet_path, 9))) {
                $equipment->datasheet_name = null;
                $equipment->datasheet_path = null;
            }

            array_push($equipments_array, [
                'id' => encrypt($equipment->id),
                'text' => $equipment->name,
                'module' => null,
                'producer' => null,
                'model' => null,
                'power' => null,
                'mppt' => null,
                'voltage' => null,
                'technology' => null,
                'guarantee' => null,
                'datasheet_name' => $equipment->datasheet_name,
                'datasheet_path' => $equipment->datasheet_path,
                'type' => 'CONNECTOR',
                'category' => 'Conector',
            ]);

            array_push($equipments, $equipment->name);
        }

        // Other
        foreach ($equipments_other as $equipment) {
            if (!Storage::disk('public')->exists(substr($equipment->datasheet_path, 9))) {
                $equipment->datasheet_name = null;
                $equipment->datasheet_path = null;
            }

            array_push($equipments_array, [
                'id' => encrypt($equipment->id),
                'text' => $equipment->name,
                'module' => null,
                'producer' => null,
                'model' => null,
                'power' => null,
                'mppt' => null,
                'voltage' => null,
                'technology' => null,
                'guarantee' => null,
                'datasheet_name' => $equipment->datasheet_name,
                'datasheet_path' => $equipment->datasheet_path,
                'type' => 'OTHER',
                'category' => 'Outros',
            ]);

            array_push($equipments, $equipment->name);
        }

        function orderArray($a, $b) {
            if ($a['text'] == $b['text']) return 0;
            
            return ($a['text'] < $b['text']) ? -1 : 1;
        }

        usort($equipments_array, "App\Http\Controllers\orderArray");
        sort($equipments);

        return view('equipments.list', [
            'equipments' => $equipments,
            'equipments_array' => $equipments_array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $equipment_type = decrypt($data['create-equipment-type']);
        } catch (Exception $e) {
            return redirect('/');
        }

        if ($request->file()) {
            $datasheet_info = self::datasheetUpload($request);
            $datasheet_name = $datasheet_info[0];
            $datasheet_path = $datasheet_info[1];
        }

        else {
            $datasheet_name = null;
            $datasheet_path = null;
        }

        switch ($equipment_type) {
            case 'GENERATOR':
                EquipmentGenerator::create([
                    'module' => $data['create-equipment-module'],
                    'producer' => $data['create-equipment-producer'],
                    'technology' => decrypt($data['create-equipment-technology']),
                    'power' => str_replace(',', '.', $data['create-equipment-generatorpower']),
                    'guarantee' => intval($data['create-equipment-guarantee']),
                    'datasheet_name' => $datasheet_name,
                    'datasheet_path' => $datasheet_path
                ]);
                break;

            case 'SOLAR_INVERTER':
                EquipmentSolarInverter::create([
                    'producer' => $data['create-equipment-producer'],
                    'mppt' => intval($data['create-equipment-mppt']),
                    'power' => str_replace(',', '.', $data['create-equipment-inverterpower']),
                    'voltage' => intval(decrypt($data['create-equipment-voltage'])),
                    'guarantee' => intval($data['create-equipment-guarantee']),
                    'datasheet_name' => $datasheet_name,
                    'datasheet_path' => $datasheet_path
                ]);
                break;

            case 'STRING_BOX':
                EquipmentStringBox::create([
                    'model' => $data['create-equipment-model'],
                    'producer' => $data['create-equipment-producer'],
                    'datasheet_name' => $datasheet_name,
                    'datasheet_path' => $datasheet_path
                ]);
                break;

            case 'CABLE':
                EquipmentCable::create([
                    'name' => $data['create-equipment-item'],
                    'datasheet_name' => $datasheet_name,
                    'datasheet_path' => $datasheet_path
                ]);
                break;

            case 'CONNECTOR':
                EquipmentConnector::create([
                    'name' => $data['create-equipment-item'],
                    'datasheet_name' => $datasheet_name,
                    'datasheet_path' => $datasheet_path
                ]);
                break;

            case 'OTHER':
                EquipmentOther::create([
                    'name' => $data['create-equipment-item'],
                    'datasheet_name' => $datasheet_name,
                    'datasheet_path' => $datasheet_path
                ]);
                break;
        }

        return redirect()->route('equipments_index')->with('success', 'Equipamento cadastrado com sucesso.');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = $request->all();

        try {
            $id = decrypt($id);
            $equipment_type = decrypt($data['edit-equipment-type']);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocorreu erro ao atualizar o equipamento.');
        }

        switch ($equipment_type) {
            case 'GENERATOR':
                $equipment = EquipmentGenerator::find($id);
                $equipment->module = $data['edit-equipment-module'];
                $equipment->producer = $data['edit-equipment-producer'];
                $equipment->technology = $data['edit-equipment-technology'];
                $equipment->power = str_replace(',', '.', $data['edit-equipment-generatorpower']);
                $equipment->guarantee = intval($data['edit-equipment-guarantee']);

                if ($request->file()) {
                    $datasheet_info = self::datasheetUpload($request);
                    $equipment->datasheet_name = $datasheet_info[0];
                    $equipment->datasheet_path = $datasheet_info[1];
                }
        
                else {
                    $equipment->datasheet_name = $equipment->datasheet_name;
                    $equipment->datasheet_path = $equipment->datasheet_path;
                }

                $equipment->save();
                break;

            case 'SOLAR_INVERTER':
                $equipment = EquipmentSolarInverter::find($id);
                $equipment->producer = $data['edit-equipment-producer'];
                $equipment->mppt = $data['edit-equipment-mppt'];
                $equipment->power = str_replace(',', '.', $data['edit-equipment-inverterpower']);
                $equipment->voltage = $data['edit-equipment-voltage'];
                $equipment->guarantee = intval($data['edit-equipment-guarantee']);
                
                if ($request->file()) {
                    $datasheet_info = self::datasheetUpload($request);
                    $equipment->datasheet_name = $datasheet_info[0];
                    $equipment->datasheet_path = $datasheet_info[1];
                }
        
                else {
                    $equipment->datasheet_name = $equipment->datasheet_name;
                    $equipment->datasheet_path = $equipment->datasheet_path;
                }

                $equipment->save();
                break;

            case 'STRING_BOX':
                $equipment = EquipmentStringBox::find($id);
                $equipment->model = $data['edit-equipment-model'];
                $equipment->producer = $data['edit-equipment-producer'];
                
                if ($request->file()) {
                    $datasheet_info = self::datasheetUpload($request);
                    $equipment->datasheet_name = $datasheet_info[0];
                    $equipment->datasheet_path = $datasheet_info[1];
                }
        
                else {
                    $equipment->datasheet_name = $equipment->datasheet_name;
                    $equipment->datasheet_path = $equipment->datasheet_path;
                }

                $equipment->save();
                break;

            case 'CABLE':
                $equipment = EquipmentCable::find($id);
                $equipment->name = $data['edit-equipment-item'];
                
                if ($request->file()) {
                    $datasheet_info = self::datasheetUpload($request);
                    $equipment->datasheet_name = $datasheet_info[0];
                    $equipment->datasheet_path = $datasheet_info[1];
                }
        
                else {
                    $equipment->datasheet_name = $equipment->datasheet_name;
                    $equipment->datasheet_path = $equipment->datasheet_path;
                }

                $equipment->save();
                break;

            case 'CONNECTOR':
                $equipment = EquipmentConnector::find($id);
                $equipment->name = $data['edit-equipment-item'];
                
                if ($request->file()) {
                    $datasheet_info = self::datasheetUpload($request);
                    $equipment->datasheet_name = $datasheet_info[0];
                    $equipment->datasheet_path = $datasheet_info[1];
                }
        
                else {
                    $equipment->datasheet_name = $equipment->datasheet_name;
                    $equipment->datasheet_path = $equipment->datasheet_path;
                }

                $equipment->save();
                break;

            case 'OTHER':
                $equipment = EquipmentOther::find($id);
                $equipment->name = $data['edit-equipment-item'];
                
                if ($request->file()) {
                    $datasheet_info = self::datasheetUpload($request);
                    $equipment->datasheet_name = $datasheet_info[0];
                    $equipment->datasheet_path = $datasheet_info[1];
                }
        
                else {
                    $equipment->datasheet_name = $equipment->datasheet_name;
                    $equipment->datasheet_path = $equipment->datasheet_path;
                }

                $equipment->save();
                break;
        }

        return redirect()->route('equipments_index')->with('success', 'Equipamento atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($id);
            $equipment_type = decrypt($data['type']);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocorreu um erro ao deletar equipamento.');
        }

        $equipment = null;

        switch ($equipment_type) {
            case 'GENERATOR':
                $equipment = EquipmentGenerator::find($id);
                $equipment_contract = ContractEquipment::where('type', 'GENERATOR')
                    ->where('product_id', $equipment->id)
                    ->get();
                break;

            case 'SOLAR_INVERTER':
                $equipment = EquipmentSolarInverter::find($id);
                $equipment_contract = ContractEquipment::where('type', 'SOLAR_INVERTER')
                    ->where('product_id', $equipment->id)
                    ->get();
                break;

            case 'STRING_BOX':
                $equipment = EquipmentStringBox::find($id);
                $equipment_contract = ContractEquipment::where('type', 'STRING_BOX')
                    ->where('product_id', $equipment->id)
                    ->get();
                break;

            case 'OTHER':
                $equipment = EquipmentOther::find($id);
                $equipment_contract = ContractEquipment::where('type', 'OTHER')
                    ->where('product_id', $equipment->id)
                    ->get();
                break;

            case 'CABLE':
                $equipment = EquipmentCable::find($id);
                $equipment_contract = ContractEquipment::where('type', 'CABLE')
                    ->where('product_id', $equipment->id)
                    ->get();
                break;
                
            case 'CONNECTOR':
                $equipment = EquipmentConnector::find($id);
                $equipment_contract = ContractEquipment::where('type', 'CONNECTOR')
                    ->where('product_id', $equipment->id)
                    ->get();
                break;
        }

        $contracts = [];

        foreach ($equipment_contract as $contract) {
            $cont = Contract::where('id', $contract->contract_id)->first();
            array_push($contracts, $cont);
        }

        if (empty($contracts) && $equipment != null) {
            $equipment->delete();
            return back()->withInput()->with('success', 'Equipamento deletado com sucesso.');
        }

        else {
            return view('equipments.listEquipmentContracts', [
                'equipment' => $equipment,
                'contracts' => $contracts
            ]);
        }
    }

    public function get_products_by_name()
    {
        try {
            $request = Request::capture();
            $data = $request->all();

            $name = $data['name'];
            $name = ucwords(mb_strtolower($name, 'UTF-8'));

            $equipments_other = EquipmentOther::where('name', 'like', '%' . $name . '%')
                ->take(6)
                ->get();

            $equipments_cable = EquipmentCable::where('name', 'like', '%' . $name . '%')
                ->take(6)
                ->get();

            $equipments_connector = EquipmentConnector::where('name', 'like', '%' . $name . '%')
                ->take(6)
                ->get();

            $equipments_generator = EquipmentGenerator::where('module', 'like', '%' . $name . '%')
                ->orWhere('producer', 'like', '%' . $name . '%')
                ->orWhere('technology', 'like', '%' . $name . '%')
                ->take(6)->get();

            $equipments_solar_inverter = EquipmentSolarInverter::where('producer', 'like', '%' . $name . '%')
                ->take(6)->get();

            $equipments_string_box = EquipmentStringBox::where('producer', 'like', '%' . $name . '%')
                ->orWhere('module', 'like', '%' . $name . '%')
                ->take(6)->get();

            $equipments_names = [];
            
            foreach ($equipments_cable as $equipment) {
                array_push($equipments_names, $equipment->name);
            }

            foreach ($equipments_connector as $equipment) {
                array_push($equipments_names, $equipment->name);
            }

            foreach ($equipments_other as $equipment) {
                array_push($equipments_names, $equipment->name);
            }

            foreach ($equipments_generator as $equipment) {
                $text = 'Módulo Solar ' . $equipment->producer . ' ' . $equipment->producer . ' - ' . $equipment->technology . ' - ' . str_replace('.', ',', $equipment->power) . ' kW';
                array_push($equipments_names, $text);
            }

            foreach ($equipments_solar_inverter as $equipment) {
                $text = 'Inversor ' . $equipment->producer . ' ' . str_replace('.', ',', $equipment->power) . ' kW - ' . $equipment->mppt . ' MPPT - ' . $equipment->voltage . ' V';
                array_push($equipments_names, $text);
            }

            foreach ($equipments_string_box as $equipment) {
                $text = 'String Box ' . $equipment->producer . ' ' . $equipment->model;
                array_push($equipments_names, $text);
            }

            sort($equipments_names);
            $equipments_names = array_slice($equipments_names, 0, 6);

            return response()->json(['equipments' => $equipments_names]);
        } catch (\Exception $e) {
            return response()->json(['equipments' => []]);
        }
    }

    public function store_product_ajax()
    {
        $request = Request::capture();
        $data = $request->all();

        $equipment_type = decrypt($data['equipment-type']);
        $name = '';

        $customMessages = [
            'required' => 'Preencha o campo :attribute.',
            'regex' =>  'Preencha o campo :attribute corretamente.',
            'string' =>  'O campo :attribute selecionado é inválido.',
            'integer' =>  'O campo :attribute deve ser um interiro.',
            'file' => 'O campo :attribute permite somente arquivos.',
            'mimes' => 'O :attribute deve ser no formato :values.',
            'min' => 'Mínimo de :min caractere(s).',
            'max' => [
                'file' => 'O :attribute não pode ser maior do que 10 MB.',
            ],
        ];

        $attributes = [
            'equipment-type' => 'Tipo de Produto',
            'equipment-item' => 'Item',
            'equipment-module' => 'Módulo',
            'equipment-producer' => 'Fabricante',
            'equipment-model' => 'Modelo',
            'equipment-generator-power' => 'Potência',
            'equipment-inverter-power' => 'Potência',
            'equipment-mppt' => 'MPPT',
            'equipment-voltage' => 'Tensão',
            'equipment-technology' => 'Tecnologia',
            'equipment-guarantee' => 'Garantia',
            'equipment-datasheet' => 'Datasheet',
        ];

        switch ($equipment_type) {
            case 'GENERATOR':
                $validator_generator = Validator::make($data, [
                    'equipment-module' => [
                        'required', 'string', 'min:2', 'max:255',
                    ],
                    'equipment-producer' => [
                        'required', 'string', 'min:2', 'max:255',
                    ],
                    'equipment-generator-power' => [
                        'required', 'string',
                    ],
                    'equipment-technology' => [
                        'required', 'string',
                    ],
                    'equipment-guarantee' => [
                        'required', 'integer',
                    ],
                    'equipment-datasheet' => [
                        'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                    ],
                ], $customMessages, $attributes);
        
                if ($validator_generator->fails()) {
                    $errors = [];
        
                    foreach ($validator_generator->getMessageBag()->getMessages() as $error) {
                        array_push($errors, $error[0]);
                    }
        
                    return response()->json([
                        'status' => false,
                        'message' => $errors,
                    ]);
                }

                else {
                    if ($request->file()) {
                        $datasheet_info = self::datasheetUpload($request);
                        $datasheet_name = $datasheet_info[0];
                        $datasheet_path = $datasheet_info[1];
                    }
            
                    else {
                        $datasheet_name = null;
                        $datasheet_path = null;
                    }

                    $equipment = EquipmentGenerator::create([
                        'module' => ucwords(mb_strtolower($data['equipment-module'], 'UTF-8')),
                        'producer' => ucwords(mb_strtolower($data['equipment-producer'], 'UTF-8')),
                        'technology' => decrypt($data['equipment-technology']),
                        'power' => doubleval(str_replace(',', '.', $data['equipment-generator-power'])),
                        'guarantee' => intval($data['equipment-guarantee']),
                        'datasheet_name' => $datasheet_name,
                        'datasheet_path' => $datasheet_path
                    ]);

                    $name = 'Módulo Solar ' . $equipment->producer . ' - ' . $equipment->module . ' - ' . $equipment->technology . ' - ' . str_replace('.', ',', $equipment->power) . ' W';
                }

                break;

            case 'SOLAR_INVERTER':
                $validator_inverter = Validator::make($data, [
                    'equipment-producer' => [
                        'required', 'string', 'min:2', 'max:255',
                    ],
                    'equipment-inverter-power' => [
                        'required', 'string',
                    ],
                    'equipment-mppt' => [
                        'required', 'integer',
                    ],
                    'equipment-voltage' => [
                        'required', 'string',
                    ],
                    'equipment-guarantee' => [
                        'required', 'integer',
                    ],
                    'equipment-datasheet' => [
                        'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                    ],
                ], $customMessages, $attributes);
        
                if ($validator_inverter->fails()) {
                    $errors = [];
        
                    foreach ($validator_inverter->getMessageBag()->getMessages() as $error) {
                        array_push($errors, $error[0]);
                    }
        
                    return response()->json([
                        'status' => false,
                        'message' => $errors,
                    ]);
                }

                else {
                    if ($request->file()) {
                        $datasheet_info = self::datasheetUpload($request);
                        $datasheet_name = $datasheet_info[0];
                        $datasheet_path = $datasheet_info[1];
                    }
            
                    else {
                        $datasheet_name = null;
                        $datasheet_path = null;
                    }

                    $equipment = EquipmentSolarInverter::create([
                        'producer' => ucwords(mb_strtolower($data['equipment-producer'], 'UTF-8')),
                        'power' => doubleval(str_replace(',', '.', $data['equipment-inverter-power'])),
                        'mppt' => intval($data['equipment-mppt']),
                        'voltage' => decrypt($data['equipment-voltage']),
                        'guarantee' => intval($data['equipment-guarantee']),
                        'datasheet_name' => $datasheet_name,
                        'datasheet_path' => $datasheet_path
                    ]);

                    $name = 'Inversor ' . $equipment->producer . ' - ' . str_replace('.', ',', $equipment->power) . ' kW - ' . $equipment->mppt . ' MPPT - ' . $equipment->voltage . ' V';
                }

                break;

            case 'STRING_BOX':
                $validator_string_box = Validator::make($data, [
                    'equipment-producer' => [
                        'required', 'string', 'min:2', 'max:255',
                    ],
                    'equipment-model' => [
                        'required', 'string', 'min:2', 'max:255',
                    ],
                    'equipment-datasheet' => [
                        'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                    ],
                ], $customMessages, $attributes);
        
                if ($validator_string_box->fails()) {
                    $errors = [];
        
                    foreach ($validator_string_box->getMessageBag()->getMessages() as $error) {
                        array_push($errors, $error[0]);
                    }
        
                    return response()->json([
                        'status' => false,
                        'message' => $errors,
                    ]);
                }

                else {
                    if ($request->file()) {
                        $datasheet_info = self::datasheetUpload($request);
                        $datasheet_name = $datasheet_info[0];
                        $datasheet_path = $datasheet_info[1];
                    }
            
                    else {
                        $datasheet_name = null;
                        $datasheet_path = null;
                    }

                    $equipment = EquipmentStringBox::create([
                        'producer' => ucwords(mb_strtolower($data['equipment-producer'], 'UTF-8')),
                        'model' => ucwords(mb_strtolower($data['equipment-model'], 'UTF-8')),
                        'datasheet_name' => $datasheet_name,
                        'datasheet_path' => $datasheet_path
                    ]);

                    $name = 'String Box ' . $equipment->producer . ' ' . $equipment->model;
                }

                break;

            case 'CABLE':
                $validator_cable = Validator::make($data, [
                    'equipment-item' => [
                        'required', 'string', 'min:2', 'max:255',
                    ],
                    'equipment-datasheet' => [
                        'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                    ],
                ], $customMessages, $attributes);
        
                if ($validator_cable->fails()) {
                    $errors = [];
        
                    foreach ($validator_cable->getMessageBag()->getMessages() as $error) {
                        array_push($errors, $error[0]);
                    }
        
                    return response()->json([
                        'status' => false,
                        'message' => $errors,
                    ]);
                }

                else {
                    if ($request->file()) {
                        $datasheet_info = self::datasheetUpload($request);
                        $datasheet_name = $datasheet_info[0];
                        $datasheet_path = $datasheet_info[1];
                    }
            
                    else {
                        $datasheet_name = null;
                        $datasheet_path = null;
                    }

                    $equipment = EquipmentCable::create([
                        'name' => ucwords(mb_strtolower($data['equipment-item'], 'UTF-8')),
                        'datasheet_name' => $datasheet_name,
                        'datasheet_path' => $datasheet_path
                    ]);

                    $name = $equipment->name;
                }

                break;

            case 'CONNECTOR':
                $validator_connector = Validator::make($data, [
                    'equipment-item' => [
                        'required', 'string', 'min:2', 'max:255',
                    ],
                    'equipment-datasheet' => [
                        'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                    ],
                ], $customMessages, $attributes);
        
                if ($validator_connector->fails()) {
                    $errors = [];
        
                    foreach ($validator_connector->getMessageBag()->getMessages() as $error) {
                        array_push($errors, $error[0]);
                    }
        
                    return response()->json([
                        'status' => false,
                        'message' => $errors,
                    ]);
                }

                else {
                    if ($request->file()) {
                        $datasheet_info = self::datasheetUpload($request);
                        $datasheet_name = $datasheet_info[0];
                        $datasheet_path = $datasheet_info[1];
                    }
            
                    else {
                        $datasheet_name = null;
                        $datasheet_path = null;
                    }

                    $equipment = EquipmentConnector::create([
                        'name' => ucwords(mb_strtolower($data['equipment-item'], 'UTF-8')),
                        'datasheet_name' => $datasheet_name,
                        'datasheet_path' => $datasheet_path
                    ]);

                    $name = $equipment->name;
                }

                break;

            case 'OTHER':
                $validator_other = Validator::make($data, [
                    'equipment-item' => [
                        'required', 'string', 'min:2', 'max:255',
                    ],
                    'equipment-datasheet' => [
                        'nullable', 'file', 'mimes:pdf,jpg,png', 'max:10240',
                    ],
                ], $customMessages, $attributes);
        
                if ($validator_other->fails()) {
                    $errors = [];
        
                    foreach ($validator_other->getMessageBag()->getMessages() as $error) {
                        array_push($errors, $error[0]);
                    }
        
                    return response()->json([
                        'status' => false,
                        'message' => $errors,
                    ]);
                }

                else {
                    if ($request->file()) {
                        $datasheet_info = self::datasheetUpload($request);
                        $datasheet_name = $datasheet_info[0];
                        $datasheet_path = $datasheet_info[1];
                    }
            
                    else {
                        $datasheet_name = null;
                        $datasheet_path = null;
                    }

                    $equipment = EquipmentOther::create([
                        'name' => ucwords(mb_strtolower($data['equipment-item'], 'UTF-8')),
                        'datasheet_name' => $datasheet_name,
                        'datasheet_path' => $datasheet_path
                    ]);

                    $name = $equipment->name;
                }

                break;
            }

        // Equipments
        $equipments_generator = EquipmentGenerator::all();
        $equipments_solar_inverter = EquipmentSolarInverter::all();
        $equipments_string_box = EquipmentStringBox::all();
        $equipments_cable = EquipmentCable::all();
        $equipments_connector = EquipmentConnector::all();
        $equipments_other = EquipmentOther::all();

        $equipments_array = [];
        $equipments = [];

        // Generator
        foreach ($equipments_generator as $generator) {
            $text = 'Módulo Solar ' . $generator->producer . ' - ' . $generator->module . ' - ' . $generator->technology . ' - ' . str_replace('.', ',', $generator->power) . ' W';

            array_push($equipments_array, [
                $text,
                'GENERATOR',
                encrypt($generator->id),
                $generator->power
            ]);
            array_push($equipments, $text);
        }

        // Inverter
        foreach ($equipments_solar_inverter as $inverter) {
            $text = 'Inversor ' . $inverter->producer . ' - ' . str_replace('.', ',', $inverter->power) . ' kW - ' . $inverter->mppt . ' MPPT - ' . $inverter->voltage . ' V';

            array_push($equipments_array, [
                $text,
                'SOLAR_INVERTER',
                encrypt($inverter->id),
                $inverter->power
            ]);
            array_push($equipments, $text);
        }

        // String box
        foreach ($equipments_string_box as $string_box) {
            $text = 'String Box ' . $string_box->producer . ' ' . $string_box->module;

            array_push($equipments_array, [
                $text,
                'STRING_BOX',
                encrypt($string_box->id)
            ]);
            array_push($equipments, $text);
        }

        // Cable
        foreach ($equipments_cable as $cable) {
            array_push($equipments_array, [
                $cable->name,
                'CABLE',
                encrypt($cable->id)
            ]);
            array_push($equipments, $cable->name);
        }

        // Connector
        foreach ($equipments_connector as $connector) {
            array_push($equipments_array, [
                $equipment->name,
                'CONNECTOR',
                encrypt($connector->id)
            ]);
            array_push($equipments, $connector->name);
        }

        // Other
        foreach ($equipments_other as $other) {
            array_push($equipments_array, [
                $other->name,
                'OTHER',
                encrypt($other->id)
            ]);
            array_push($equipments, $other->name);
        }

        function orderArray($a, $b)
        {
            if ($a[0] == $b[0]) return 0;
            
            return ($a[0] < $b[0]) ? -1 : 1;
        }

        usort($equipments_array, "App\Http\Controllers\orderArray");
        sort($equipments);

        return response()->json([
            'status' => true,
            'message' => ['Equipamento salvo com sucesso'],
            'equipments' => $equipments,
            'equipments_array' => $equipments_array,
            'equipment_name' => $name
        ]);
    }

    public static function datasheetUpload($req)
    {
        $req->validate([
            'equipment-datasheet' => [
                'mimes:pdf', 'max:10240'
            ]
        ]);

        if ($req->file()) {
            $file_name = time() . '_' . $req->file('equipment-datasheet')->getClientOriginalName();
            $file_path = $req->file('equipment-datasheet')->storeAs('datasheets', $file_name, 'public');

            $datasheet_name = time() . '_' . $req->file('equipment-datasheet')->getClientOriginalName();
            $datasheet_path = '/storage/' . $file_path;
            
            return [$datasheet_name, $datasheet_path];
        }
   }

    public function datasheetView($type, $id)
    {
        try {
            $id = decrypt($id);
            $type = decrypt($type);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocorreu um erro ao visualizar o datasheet.');
        }

        switch ($type) {
            case 'GENERATOR':
                $file = EquipmentGenerator::where('id', $id)->first();
                break;

            case 'SOLAR_INVERTER':
                $file = EquipmentSolarInverter::where('id', $id)->first();
                break;

            case 'STRING_BOX':
                $file = EquipmentStringBox::where('id', $id)->first();
                break;

            case 'CABLE':
                $file = EquipmentCable::where('id', $id)->first();
                break;

            case 'CONNECTOR':
                $file = EquipmentConnector::where('id', $id)->first();
                break;

            case 'OTHER':
                $file = EquipmentOther::where('id', $id)->first();
                break;
        }

        if ($file->datasheet_path !== null) {
            if (Storage::disk('public')->exists(substr($file->datasheet_path, 9))) {
                $file_name = $file->datasheet_name;
                $file_path = 'public/datasheets/' . $file_name;
            
                return Storage::response($file_path);
            }

            else return back()->withInput()->with('error', 'Datasheet não encontrado. Faça o envio de novo arquivo.');
        }

        else return back()->withInput()->with('error', 'O equipamento não possui Datasheet salvo.');
    }
}
