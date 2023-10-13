<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Client;
use App\Models\Contract;
use App\Models\ContractPayment;
use App\Models\ContractEquipment;
use App\Models\EquipmentGenerator;
use App\Models\EquipmentOther;
use App\Models\EquipmentCable;
use App\Models\EquipmentConnector;
use App\Models\EquipmentSolarInverter;
use App\Models\EquipmentStringBox;
use App\Models\PaymentAfterBy;
use App\Models\PaymentCash;
use App\Models\PaymentCompanyInstallment;
use App\Models\PaymentCustom;
use App\Models\PaymentPartialParceled;
use App\Models\PaymentTotalParceled;
use App\Models\PaymentType;
use App\Models\Seller;
use App\Models\SellerTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;

class ContractController extends Controller
{
    public static $STATUS_BUDGET = 'ORÇANDO';
    public static $STATUS_HIRED = 'CONTRATADO';
    public static $STATUS_ACTIVE = 'ATIVO';
    public static $STATUS_INSTALLING = 'INSTALANDO';
    public static $STATUS_PENDENCY = 'PENDÊNCIA';
    public static $STATUS_INSTALLED = 'INSTALADO';
    public static $STATUS_CONCLUDED = 'CONCLUÍDO';
    public static $STATUS_CANCELED = 'CANCELADO';

    public static $PAYMENT_CASH = "À VISTA";
    public static $PAYMENT_PARTIAL_PARCELED = "FINANCIAMENTO PARCIAL";
    public static $PAYMENT_TOTAL_PARCELED = "FINANCIAMENTO TOTAL";
    public static $PAYMENT_COMPANY_INSTALLMENT = "PARCELAMENTO EMPRESA";
    public static $PAYMENT_CUSTOM = "PERSONALIZADO";

    public static $PAYMENT_AFTER_SIGNATURE = "30 DIAS DA ASSINATURA";
    public static $PAYMENT_AFTER_CONCLUSION = "CONCLUSÃO DA INSTALAÇÃO";
    public static $PAYMENT_AFTER_HOMOLOGATION = "HOMOLOGAÇÃO";

    public static $MAGIC_NUMBER = 3750;

    public function __construct()
    {
        $this->middleware('auth.not_engineering')->except('fileView');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function installation()
    {
        if (Auth::user() == null) return redirect('/');

        $contracts_installation = Contract::where('type', 1)->orderBy('contract_date', 'desc')->get();

        return view('contracts.list-installation', [
            'contracts_installation' => $contracts_installation
        ]);
    }

    public function maintenance()
    {
        if (Auth::user() == null) return redirect('/');

        $contracts_maintenance = Contract::where('type', 2)->orderBy('contract_date', 'desc')->get();

        return view('contracts.list-maintenance', [
            'contracts_maintenance' => $contracts_maintenance
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($type)
    {
        if (Auth::user() == null) return redirect('/');

        $sellers = Seller::orderBy('name', 'ASC')->get();
        $clients = Client::orderBy('name', 'ASC')->get();
        $banks = Bank::orderBy('code', 'ASC')->get();

        $sellers_names = [];

        foreach ($sellers as $seller) {
            array_push($sellers_names, $seller->name);
        }

        $clients_names = [];

        foreach ($clients as $client) {
            if ($client->is_corporate) array_push($clients_names, [$client->corporate_name, $client->is_corporate]);
            else array_push($clients_names, [$client->name, $client->is_corporate]);
        }

        $bank_names = [];

        foreach ($banks as $bank) {
            array_push($bank_names, $bank->code . ' - ' . $bank->name);
        }

        // EQUIPMENTS
        $equipments_cable = EquipmentCable::all();
        $equipments_connector = EquipmentConnector::all();
        $equipments_other = EquipmentOther::all();
        $equipments_generator = EquipmentGenerator::all();
        $equipments_solar_inverter = EquipmentSolarInverter::all();
        $equipments_string_box = EquipmentStringBox::all();

        $equipments = [];
        $equipments_array = [];

        $cables = [];
        $connectors = [];
        $others = [];

        foreach ($equipments_cable as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'CABLE', encrypt($equipment->id)]);
            array_push($equipments, $equipment->name);
            array_push($cables, $equipment->name);
        }

        foreach ($equipments_connector as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'CONNECTOR', encrypt($equipment->id)]);
            array_push($equipments, $equipment->name);
            array_push($connectors, $equipment->name);
        }

        foreach ($equipments_other as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'OTHER', encrypt($equipment->id)]);
            array_push($equipments, $equipment->name);
            array_push($others, $equipment->name);
        }

        foreach ($equipments_generator as $equipment) {
            $text = 'Módulo Solar ' . $equipment->producer . ' - ' . $equipment->module . ' - ' . $equipment->technology . ' - ' . str_replace('.', ',', $equipment->power) . ' W';
            array_push($equipments_array, [$text, 'GENERATOR', encrypt($equipment->id), $equipment->power]);
            array_push($equipments, $text);
        }

        foreach ($equipments_solar_inverter as $equipment) {
            $text = 'Inversor ' . $equipment->producer . ' - ' . str_replace('.', ',', $equipment->power) . ' kW - ' . $equipment->mppt . ' MPPT - ' . $equipment->voltage . ' V';
            array_push($equipments_array, [$text, 'SOLAR_INVERTER', encrypt($equipment->id), $equipment->power]);
            array_push($equipments, $text);
        }

        foreach ($equipments_string_box as $equipment) {
            $text = 'String Box ' . $equipment->producer . ' ' . $equipment->module;
            array_push($equipments_array, [$text, 'STRING_BOX', encrypt($equipment->id)]);
            array_push($equipments, $text);
        }

        function orderArray($a, $b) {
            if ($a[0] == $b[0]) return 0;

            return ($a[0] < $b[0]) ? -1 : 1;
        }

        usort($equipments_array, "App\Http\Controllers\orderArray");
        sort($equipments);

        $validation_install = [
            'category' => [
                ['quantity' => 1, 'name' => 'SOLAR_INVERTER', 'error' => 'Faltando 1 Inversor Solar'],
                ['quantity' => 1, 'name' => 'GENERATOR', 'error' => 'Faltando 1 Módulo Solar'],
                ['quantity' => 1, 'name' => 'CONNECTOR', 'error' => 'Faltando 1 par de Conector MC4'],
                ['quantity' => 1, 'name' => 'CABLE', 'error' => 'Faltando 1 tipo de cabo'],
            ]
        ];

        // SELLER TEAMS
        $teams = SellerTeam::orderBy('name', 'asc')->get();
        $teams_names = [];

        foreach ($teams as $team) {
            array_push($teams_names, $team->name);
        }

        $profit_estimate = 15;  // default profit estimate (15%)
        $kit_quota = 75;  // default kit quota (75%)
        $installation_quota = 10;  // default installation quota (10%)

        return view('contracts.create', [
            'sellers' => $sellers_names,
            'clients' => $clients_names,
            'banks' => $bank_names,
            'equipments' => $equipments,
            'equipments_array' => $equipments_array,
            'validation_install' => $validation_install,
            'teams' => $teams_names,
            'profit_estimate' => $profit_estimate,
            'kit_quota' => $kit_quota,
            'installation_quota' => $installation_quota
        ]);
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
        $type_new_generator = 1;
        $seller = $data['seller'];
        $client = $data['client'];
        $type = $data['type'];
        $contract_date = $data['contract-date'];
        $installation_deadline = $data['installation-deadline'];
        $description = $data['description'];
        $nickname = $data['nickname'];
        $area = $data['area'];
        $monthly_avg_generation = $data['monthly_avg_generation'];
        $contract_payment_name = $data['payment_type'];
        $payment_text = $data['payment_text'];
        $payment_value = $data['payment-value'];
        $payment_cash = $data['payment_cash'];
        $payment_quantity = $data['payment_quantity'];
        $profit_estimate = format_money_to_double($data['profit-estimate']);
        $kit_quota = $data['kit-quota'];
        $installation_quota = $data['installation-quota'];
        $payment_bank = $data['payment_bank'];

        if (isset($data['payment_after_by'])) {
            $payment_after_by = decrypt($data['payment_after_by']);
            $payment_after_by_type = PaymentAfterBy::where('name', $payment_after_by)->first();
        }

        if ($type == $type_new_generator) {
            $structure = $data['structure'];
            $structure = intval($structure);
            $table = $data['table'];
            $table = json_decode($table);
        }
        
        else {
            $structure = null;
            $table = [];
        }

        $seller = ucwords(mb_strtolower($seller, 'UTF-8'));
        $client = ucwords(mb_strtolower($client, 'UTF-8'));
        $nickname = ucwords(mb_strtolower($nickname, 'UTF-8'));
        $type = intval($type);

        // equipments
        $equipments_array = self::getEquipmentsArray();

        $client = Client::where('name', $client)->orWhere('corporate_name', $client)->first();
        $seller = Seller::where('name', $seller)->first();

        // payment_type
        $payment_type = PaymentType::where('name', $contract_payment_name)->first();

        switch ($contract_payment_name) {
            case ContractController::$PAYMENT_CASH:
                $payment_after_by_id = $payment_after_by_type->id;
                $value = format_money_to_double($payment_value);
                $cash = format_money_to_double($payment_cash);

                $payment = PaymentCash::create([
                    'payment_after_by_id' => $payment_after_by_id,
                    'value' => $value,
                    'value_initial' => $cash,
                ]);

                break;

            case ContractController::$PAYMENT_PARTIAL_PARCELED:
                $value = format_money_to_double($payment_value);
                $cash = format_money_to_double($payment_cash);
                $name_bank = $payment_bank;
                $code_bank = explode(' - ', $name_bank)[0];

                if ($payment_bank != null) {
                    $name_bank = $payment_bank;
                    $code_bank = explode(' - ', $name_bank)[0];
                    $bank = Bank::where('code', $code_bank)->first()->id;
                }
                
                else $bank = null;

                $payment = PaymentPartialParceled::create([
                    'value' => $value,
                    'cash' => $cash,
                    'bank_id' => $bank,
                ]);

                break;

             case ContractController::$PAYMENT_TOTAL_PARCELED:
                // date_initial, quantity, value, bank_id, is_signature
                $value = format_money_to_double($payment_value);
                
                if ($payment_bank !== null) {
                    $name_bank = $payment_bank;
                    $code_bank = explode(' - ', $name_bank)[0];
                    $bank = Bank::where('code', $code_bank)->first()->id;
                }
                
                else $bank = null;

                $payment = PaymentTotalParceled::create([
                    'value' => $value,
                    'bank_id' => $bank,
                ]);

                break;

            case ContractController::$PAYMENT_COMPANY_INSTALLMENT:
                $value = format_money_to_double($payment_value);
                $cash = format_money_to_double($payment_cash);
                $quantity = intval($payment_quantity);
                $name_bank = $payment_bank;
                $code_bank = explode(' - ', $name_bank)[0];

                if ($payment_bank != null) {
                    $name_bank = $payment_bank;
                    $code_bank = explode(' - ', $name_bank)[0];
                    $bank = Bank::where('code', $code_bank)->first()->id;
                }
                
                else $bank = null;

                $payment_after_by_id = $payment_after_by_type->id;

                $payment = PaymentCompanyInstallment::create([
                    'payment_after_by_id' => $payment_after_by_id,
                    'value' => $value,
                    'cash' => $cash,
                    'quantity_parcel' => $quantity,
                    'bank_id' => $bank,
                ]);

                break;

            case ContractController::$PAYMENT_CUSTOM:
                $value = format_money_to_double($payment_value);
                $text = $payment_text;

                $payment = PaymentCustom::create([
                    'value' => $value,
                    'text' => $text,
                ]);

                break;
        }

        $contract_payment = ContractPayment::create([
            'payment_type_id' => $payment_type->id,
            'payment_id' => $payment->id
        ]);

        if ($client && $seller && $payment && $contract_payment) {
            // Define Kit and Installation Percentages
            if ($type == $type_new_generator) {
                $kit_quota = format_money_to_double($data['kit-quota']);
                $installation_quota = format_money_to_double($data['installation-quota']);
            }

            else {
                $kit_quota = null;
                $installation_quota = null;
            }

            $contract = Contract::create([
                'seller_id' => $seller->id,
                'client_id' => $client->id,
                'type' => $type,
                'contract_date' => $contract_date,
                'installation_deadline' => $installation_deadline,
                'payment_id' => $contract_payment->id,
                'profit_estimate' => $profit_estimate,
                'kit_quota' => $kit_quota,
                'installation_quota' => $installation_quota,
                'status' => ContractController::$STATUS_BUDGET,
                'description' => $description,
                'nickname' => $nickname,
                'generator_structure' => $structure,
                'area' => $area,
                'monthly_avg_generation' => $monthly_avg_generation
            ]);

            if ($type == $type_new_generator) {
                foreach ($table as $item) {
                    $name = $item[0];
                    $quantity = $item[1];

                    foreach ($equipments_array as $equipment) {
                        $equipment_name = $equipment[0];

                        if ($equipment_name == $name) {
                            $equipment_type = $equipment[1];
                            $equipment_id = $equipment[2];
                            $equipment_id = decrypt($equipment_id);

                            ContractEquipment::create([
                                'contract_id' => $contract->id,
                                'product_id' => $equipment_id,
                                'type' => $equipment_type,
                                'quantity' => $quantity
                            ]);
                        }
                    }
                }
            }

            $contract_route = $contract->type == 1 ? 'contracts_installation' : 'contracts_maintenance';

            return redirect()->route($contract_route)->with('success', 'Contrato salvo no sistema.');
        }
        
        else {
            return back()
                ->with('error', 'Houve um erro ao criar o contrato. Sem correpondência de cliente e/ou vendedor.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
    public function edit($type, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $sellers = Seller::orderBy('name', 'ASC')->get();
        $clients = Client::orderBy('name', 'ASC')->get();
        $banks = Bank::orderBy('code', 'ASC')->get();

        $sellers_names = [];

        foreach ($sellers as $seller) {
            array_push($sellers_names, $seller->name);
        }

        $clients_names = [];

        foreach ($clients as $client) {
            if ($client->is_corporate) array_push($clients_names, [$client->corporate_name, $client->is_corporate]);
            else array_push($clients_names, [$client->name, $client->is_corporate]);
        }

        $bank_names = [];

        foreach ($banks as $bank) {
            array_push($bank_names, $bank->code . ' - ' . $bank->name);
        }

        // equipments
        $equipments_cable = EquipmentCable::all();
        $equipments_connector = EquipmentConnector::all();
        $equipments_other = EquipmentOther::all();
        $equipments_generator = EquipmentGenerator::all();
        $equipments_solar_inverter = EquipmentSolarInverter::all();
        $equipments_string_box = EquipmentStringBox::all();
        $equipments = [];
        $equipments_array = [];

        $cables = [];
        $connectors = [];
        $others = [];

        foreach ($equipments_cable as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'CABLE', encrypt($equipment->id)]);
            array_push($equipments, $equipment->name);
            array_push($cables, $equipment->name);
        }

        foreach ($equipments_connector as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'CONNECTOR', encrypt($equipment->id)]);
            array_push($equipments, $equipment->name);
            array_push($connectors, $equipment->name);
        }

        foreach ($equipments_other as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'OTHER', encrypt($equipment->id)]);
            array_push($equipments, $equipment->name);
            array_push($others, $equipment->name);
        }

        foreach ($equipments_generator as $equipment) {
            $text = 'Módulo Solar ' . $equipment->producer . ' - ' . $equipment->module . ' - ' . $equipment->technology . ' - ' . str_replace('.', ',', $equipment->power) . ' W';
            array_push($equipments_array, [$text, 'GENERATOR', encrypt($equipment->id), $equipment->power]);
            array_push($equipments, $text);
        }

        foreach ($equipments_solar_inverter as $equipment) {
            $text = 'Inversor ' . $equipment->producer . ' - ' . str_replace('.', ',', $equipment->power) . ' kW - ' . $equipment->mppt . ' MPPT - ' . $equipment->voltage . ' V';
            array_push($equipments_array, [$text, 'SOLAR_INVERTER', encrypt($equipment->id), $equipment->power]);
            array_push($equipments, $text);
        }

        foreach ($equipments_string_box as $equipment) {
            $text = 'String Box ' . $equipment->producer . ' ' . $equipment->module;
            array_push($equipments_array, [$text, 'STRING_BOX', encrypt($equipment->id)]);
            array_push($equipments, $text);
        }

        function orderArray($a, $b) {
            if ($a[0] == $b[0]) return 0;

            return ($a[0] < $b[0]) ? -1 : 1;
        }

        usort($equipments_array, "App\Http\Controllers\orderArray");
        sort($equipments);

        $validation_install = [
            'category' => [
                ['quantity' => 1, 'name' => 'SOLAR_INVERTER', 'error' => 'Faltando 1 Inversor Solar'],
                ['quantity' => 1, 'name' => 'GENERATOR', 'error' => 'Faltando 1 Módulo Solar'],
                ['quantity' => 1, 'name' => 'CONNECTOR', 'error' => 'Faltando 1 par de Conector MC4'],
                ['quantity' => 1, 'name' => 'CABLE', 'error' => 'Faltando 1 tipo de cabo'],
            ]
        ];

        // sellet teams
        $teams = SellerTeam::orderBy('name', 'asc')->get();
        $teams_names = [];

        foreach ($teams as $team) {
            array_push($teams_names, $team->name);
        }

        $contract = Contract::find($id);

        switch ($contract->status) {
            case 'ORÇANDO':
                $contract["status"] = 1;
                break;

            case 'CONTRATADO':
                $contract["status"] = 2;
                break;

            case 'ATIVO':
                $contract["status"] = 3;
                break;

            case 'PENDÊNCIA':
                $contract["status"] = 4;
                break;

            case 'INSTALANDO':
                $contract["status"] = 5;
                break;

            case 'INSTALADO':
                $contract["status"] = 6;
                break;

            case 'CONCLUÍDO':
                $contract["status"] = 7;
                break;

            case 'CANCELADO':
                $contract["status"] = 8;
                break;
        }

        return view('contracts.edit', [
            'sellers' => $sellers_names,
            'clients' => $clients_names,
            'equipments' => $equipments,
            'equipments_array' => $equipments_array,
            'contract' => $contract,
            'banks' => $bank_names,
            'validation_install' => $validation_install,
            'teams' => $teams_names
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

        $type_new_generator = 1;
        $data = $request->all();

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/login');
        }
        
        $seller = $data['seller'];
        $client = $data['client'];
        $type = $data['type'];
        $status = $data['status'];
        $contract_date = $data['contract-date'];
        $installation_deadline = $data['installation-deadline'];
        $description = $data['description'];
        $nickname = $data['nickname'];
        $area = $data['area'];
        $monthly_avg_generation = $data['monthly_avg_generation'];
        $contract_payment_name = $data['payment_type'];
        $payment_text = $data['payment_text'];
        $payment_value = $data['payment-value'];
        $payment_cash = $data['payment_cash'];
        $payment_quantity = $data['payment_quantity'];
        $profit_estimate = format_money_to_double($data['profit-estimate']);
        $kit_quota = $data['kit-quota'];
        $installation_quota = $data['installation-quota'];
        $payment_bank = $data['payment_bank'];

        if (isset($data['payment_after_by'])) {
            $payment_after_by = decrypt($data['payment_after_by']);
            $payment_after_by_type = PaymentAfterBy::where('name', $payment_after_by)->first();
        }

        if ($type == $type_new_generator) {
            $structure = $data['structure'];
            $structure = intval($structure);
            $table = $data['table'];
            $table = json_decode($table);
        }

        else {
            $structure = null;
            $table = [];
        }

        $seller = ucwords(mb_strtolower($seller, 'UTF-8'));
        $client = ucwords(mb_strtolower($client, 'UTF-8'));
        $nickname = ucwords(mb_strtolower($nickname, 'UTF-8'));
        $type = intval($type);

        // equipments
        $equipments_array = self::getEquipmentsArray();

        $client = Client::where('name', $client)->orWhere('corporate_name', $client)->first();
        $seller = Seller::where('name', $seller)->first();

        // payment_type
        $payment_type = PaymentType::where('name', $contract_payment_name)->first();

        switch ($contract_payment_name) {
            case ContractController::$PAYMENT_CASH:
                $payment_after_by_id = $payment_after_by_type->id;
                $value = format_money_to_double($payment_value);
                $cash = format_money_to_double($payment_cash);
                
                $payment = PaymentCash::create([
                    'payment_after_by_id' => $payment_after_by_id,
                    'value' => $value,
                    'value_initial' => $cash,
                ]);

                break;

            case ContractController::$PAYMENT_PARTIAL_PARCELED:
                $value = format_money_to_double($payment_value);
                $cash = format_money_to_double($payment_cash);
                $name_bank = $payment_bank;
                $code_bank = explode(' - ', $name_bank)[0];

                if ($payment_bank != null) {
                    $name_bank = $payment_bank;
                    $code_bank = explode(' - ', $name_bank)[0];
                    $bank = Bank::where('code', $code_bank)->first()->id;
                }

                else $bank = null;

                $payment = PaymentPartialParceled::create([
                    'value' => $value,
                    'cash' => $cash,
                    'bank_id' => $bank,
                ]);

                break;

            case ContractController::$PAYMENT_TOTAL_PARCELED:
                $value = format_money_to_double($payment_value);

                if ($payment_bank != null) {
                    $name_bank = $payment_bank;
                    $code_bank = explode(' - ', $name_bank)[0];
                    $bank = Bank::where('code', $code_bank)->first()->id;
                }
                
                else $bank = null;

                $payment = PaymentTotalParceled::create([
                    'value' => $value,
                    'bank_id' => $bank,
                ]);

                break;

            case ContractController::$PAYMENT_COMPANY_INSTALLMENT:
                $value = format_money_to_double($payment_value);
                $cash = format_money_to_double($payment_cash);
                $quantity = intval($payment_quantity);
                $name_bank = $payment_bank;
                $code_bank = explode(' - ', $name_bank)[0];

                if ($payment_bank != null) {
                    $name_bank = $payment_bank;
                    $code_bank = explode(' - ', $name_bank)[0];
                    $bank = Bank::where('code', $code_bank)->first()->id;
                }

                else $bank = null;

                $payment_after_by_id = $payment_after_by_type->id;

                $payment = PaymentCompanyInstallment::create([
                    'payment_after_by_id' => $payment_after_by_id,
                    'value' => $value,
                    'cash' => $cash,
                    'quantity_parcel' => $quantity,
                    'bank_id' => $bank,
                ]);

                break;

            case ContractController::$PAYMENT_CUSTOM:
                // text, value
                $value = format_money_to_double($payment_value);
                $text = $payment_text;

                $payment = PaymentCustom::create([
                    'value' => $value,
                    'text' => $text,
                ]);
                
                break;
        }

        if ($client && $seller && $payment) {
            $contract = Contract::find($id);

            // Define Kit and Installation Percentages
            if ($type == $type_new_generator) {
                $kit_quota = format_money_to_double($data['kit-quota']);
                $installation_quota = format_money_to_double($data['installation-quota']);
            }

            else {
                $kit_quota = null;
                $installation_quota = null;
            }

            if ($contract) {
                $cp = ContractPayment::find($contract->payment_id);

                switch (ContractPayment::find($contract->payment_id)->type->name) {
                    case ContractController::$PAYMENT_CASH:
                        PaymentCash::find($cp->payment_id)->delete();
                        break;

                    case ContractController::$PAYMENT_PARTIAL_PARCELED:
                        PaymentPartialParceled::find($cp->payment_id)->delete();
                        break;

                    case ContractController::$PAYMENT_TOTAL_PARCELED:
                        PaymentTotalParceled::find($cp->payment_id)->delete();
                        break;

                    case ContractController::$PAYMENT_COMPANY_INSTALLMENT:
                        PaymentCompanyInstallment::find($cp->payment_id)->delete();
                        break;

                    case ContractController::$PAYMENT_CUSTOM:
                        PaymentCustom::find($cp->payment_id)->delete();
                        break;
                }

                switch (decrypt($status)) {
                    case 1:
                        $status = 'ORÇANDO';
                        break;

                    case 2:
                        $status = 'CONTRATADO';
                        break;

                    case 3:
                        $status = 'ATIVO';
                        break;

                    case 4:
                        $status = 'PENDÊNCIA';
                        break;

                    case 5:
                        $status = 'INSTALANDO';
                        break;

                    case 6:
                        $status = 'INSTALADO';
                        break;

                    case 7:
                        $status = 'CONCLUÍDO';
                        break;

                    case 8:
                        $status = 'CANCELADO';
                        break;
                }

                if ($status == 'CONCLUÍDO' && $contract->project != null) {
                    foreach ($contract->project->generator as $generator) {
                        $generator->generator_status = EngineeringController::$CONCLUDED;
                        $generator->save();
                    }
                }

                if ($request->request->has('chk-have-equipment')) {
                    $equipment_date_acquisition = $data['equipment-date-acquisition'];
                    $equipment_delivery_date = $data['equipment-delivery-date'];

                    // Invoice
                    if (array_key_exists('equipment-file-invoice', $request->file())) {
                        $invoice_info = self::fileUpload($request->file()['equipment-file-invoice'], 'invoice');
                        $invoice_name = $invoice_info[0];
                        $invoice_path = $invoice_info[1];
                    }

                    else {
                        $invoice_name = $contract->file_invoice_name;
                        $invoice_path = $contract->file_invoice_path;
                    }
                }
                
                else {
                    $equipment_date_acquisition = null;
                    $equipment_delivery_date = null;
                    $invoice_name = null;
                    $invoice_path = null;
                }

                $cp->payment_type_id = $payment_type->id;
                $cp->payment_id = $payment->id;
                $cp->save();

                $contract->seller_id = $seller->id;
                $contract->client_id = $client->id;
                $contract->status = $status;
                $contract->installation_deadline = $installation_deadline;
                $contract->contract_date = $contract_date;
                $contract->profit_estimate = $profit_estimate;
                $contract->kit_quota = $kit_quota;
                $contract->installation_quota = $installation_quota;
                $contract->description = $description;
                $contract->nickname = $nickname;
                $contract->generator_structure = $structure;
                $contract->area = $area;
                $contract->monthly_avg_generation = $monthly_avg_generation;
                $contract->equipment_date_acquisition = $equipment_date_acquisition;
                $contract->equipment_delivery_date = $equipment_delivery_date;
                $contract->file_invoice_name = $invoice_name;
                $contract->	file_invoice_path = $invoice_path;
                $contract->type = $type;
                $contract->save();
                $contract->deleteContractProducts();

                if ($type == $type_new_generator) {
                    foreach ($table as $item) {
                        $name = $item[0];
                        $quantity = $item[1];
                        
                        foreach ($equipments_array as $equipment) {
                            $equipment_name = $equipment[0];

                            if ($equipment_name == $name) {
                                $equipment_type = $equipment[1];
                                $equipment_id = $equipment[2];
                                $equipment_id = decrypt($equipment_id);
                                
                                ContractEquipment::create([
                                    'contract_id' => $contract->id,
                                    'product_id' => $equipment_id,
                                    'type' => $equipment_type,
                                    'quantity' => $quantity
                                ]);
                            }
                        }
                    }
                }

                $contract_route = $contract->type == 1 ? 'contracts_installation' : 'contracts_maintenance';

                return redirect()->route($contract_route)->with('success', 'Contrato atualizado no sistema.');
            }
            
            else {
                return redirect()->route('contracts_edit')
                    ->with('error', 'Houve um erro ao atualizar o contrato, sem correpondencia de contrato.');
            }
        }
        
        else {
            return redirect()->route('contracts_edit')
                ->with('error', 'Houve um erro ao atualizar o contrato, sem correpondencia de cliente e/ou vendedor.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $id = decrypt($id);
            $id = intval($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $contract = Contract::find($id);

        if ($contract != null) {
            $contract->delete();
            $contract->deleteContractProducts();

            $contract_type = $contract->type == 1 ? 'installation' : 'maintenance';
            
            return redirect("/contracts/$contract_type")->withInput()
                ->with('success', 'O contrato foi deletado do sistema com sucesso.');
        }
        
        else return redirect('/');
    }

    /** Update Contract Status from contract list via Fetch API */
    public function updateContractStatus()
    {
        $request = Request::capture();
        $data = $request->all();

        try {
            $id = decrypt($data['contract']);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $data = $request->all();
        $contract = Contract::find($id);

        if ($contract->exists()) {
            switch (decrypt($data['status'])) {
                case 1:
                    $status = 'ORÇANDO';
                    break;

                case 2:
                    $status = 'CONTRATADO';
                    break;

                case 3:
                    $status = 'ATIVO';
                    break;

                case 4:
                    $status = 'PENDÊNCIA';
                    break;

                case 5:
                    $status = 'INSTALANDO';
                    break;

                case 6:
                    $status = 'INSTALADO';
                    break;

                case 7:
                    $status = 'CONCLUÍDO';
                    break;

                case 8:
                    $status = 'CANCELADO';
                    break;
            }

            if ($status == 'CONCLUÍDO' && $contract->project != null) {
                foreach ($contract->project->generator as $generator) {
                    $generator->generator_status = EngineeringController::$CONCLUDED;
                    $generator->save();
                }
            }

            $contract->status = $status;
            $contract->save();

            return response()->json([
                'saved' => true,
                'message' => 'Status atualizado com sucesso.',
                'status' => $contract->status,
                'badge' => $data['badge-bg-color']
            ]);
        }

        return response()->json([
            'saved' => false,
            'message' => 'Contrato não encontrado.'
        ]);
    }

    /** Upload files to Storage */
    public static function fileUpload($req, $type)
    {
        $file_name = time() . '_' . $req->getClientOriginalName();
        $path = $req->storeAs($type, $file_name, 'contract');
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
        $file = Contract::where('id', $id)->get($file_type)->first();

        if ($file !== null) {
            if (Storage::disk('contract')->exists(substr($file->$file_type, 8))) {
                $file_name = explode('/', $file->$file_type)[2];
                $file_path = 'contract/' . $type . '/' . $file_name;

                return Storage::response($file_path);
            }

            else return back()->withInput()->with('error', 'Arquivo não encontrado.');
        }

        else return back()->withInput()->with('error', 'O contrato não possui este arquivo salvo.');
    }

    public function showFormPDF()
    {
        if (session()->has('pdf_attributes')) {
            $attributes = session()->get('pdf_attributes');

            return view('textPDF', ['pdf' => $attributes]);

        } else {
            return view('textPDF');
        }
    }

    public function getPDF(Request $request)
    {

        $data = $request->all();

        $status = true;
        if (isset($data['file'])) {
            $pdf = $data['file'];

            try {
                $text = PDFtoText($pdf);
            } catch (\Exception $e) {
                $status = false;
            }

        } else {
            $status = false;
        }

        if ($status) {
            $attributes = new \stdClass();
            $contaContato = string_between_two_string($text, "Conta Contrato", "Para atendimento, informe este  número");
            $mesReferencia = string_between_two_string($text, "Conta do mês", "Vencimento");
            $consumoInsento = string_between_two_string($text, "Consumo Isento", "Dev Geração");
            $consumoInsentoQtd = string_split(' ', $consumoInsento, 0);
            $consumoInsentoTarifa = string_split(' ', $consumoInsento, 1);
            $consumoInsentoValor = string_split(' ', $consumoInsento, 2);
            $informacoesCliente = string_between_two_string($text, "Informações para o cliente", "Conta de Energia Elétrica");

            $attributes->contract = $contaContato;
            $attributes->month = $mesReferencia;
            $attributes->consumptionExemptionTableQnt = $consumoInsentoQtd;
            $attributes->consumptionExemptionTableTar = $consumoInsentoTarifa;
            $attributes->consumptionExemptionTableVal = $consumoInsentoValor;
            $attributes->informationsClient = [];

            if (strlen($informacoesCliente) > 0) {

                foreach (explode("\t", $informacoesCliente) as $info) {

                    if (strlen($info) > 0) {
                        //remove empty spaces in int of text
                        for ($i = 0; $i < strlen($info); $i++) {

                            if ($info[$i] == " ") {
                                $info = substr($info, 1);
                                $i--;
                            } else {
                                array_push($attributes->informationsClient, $info);
                                break;
                            }
                        }

                    }
                }
            }
        }

        session()->flash('pdf_attributes', $attributes);

        return redirect()->route('contracts_pdf');
    }

    /** Generate report */
    public function printReport(Request $request)
    {
        if (Auth::user() == null) return redirect('/');

        $data = $request->all();
        $initial_date = $data['report-date-start'];
        $final_date = $data['report-date-end'];

        $period_start = implode('-', array_reverse(explode('/', $initial_date)));
        $period_end = implode('-', array_reverse(explode('/', $final_date)));

        $contracts = Contract::whereBetween('contract_date', [$period_start, $period_end])
            ->orderBy('contract_date', 'desc')
            ->where('status', 'not like', 'ORÇANDO')
            ->get();

        $total_pages = ceil(count($contracts) / 16);

        $total_sales_array = [];
        $total_profit_estimate_array = [];

        foreach ($contracts as $contract) {
            array_push($total_sales_array, $contract->paymentData()->value);
            array_push($total_profit_estimate_array, $contract->paymentData()->value * ($contract->profit_estimate / 100));
        }

        $total_sales = array_sum($total_sales_array);
        $total_profit_estimate = array_sum($total_profit_estimate_array);
            
        $date = date('YmdHis');
        $title = 'Report_' . $date;
        $text_font = 12;
        $line_height = 1.5;

        // Share data to view
        view()->share('contracts', $contracts);;
        view()->share('total_sales', $total_sales);
        view()->share('total_profit_estimate', $total_profit_estimate);
        view()->share('total_pages', $total_pages);
        view()->share('title', $title);;
        view()->share('text_font', $text_font);;
        view()->share('line_height', $line_height);
        view()->share('period_start', $period_start);
        view()->share('period_end', $period_end);

        return view('contracts.printReport', [
            'contracts' => $contracts,
            'total_sales' => $total_sales,
            'total_profit_estimate' => $total_profit_estimate,
            'total_pages' => $total_pages,
            'title' => $title,
            'text_font' => $text_font,
            'period_start' => $period_start,
            'period_end' => $period_end
        ]);
    }

    public function printAdhesion(Request $request, $id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $adhesion_logo = $request->input('chk-adhesion-logo');
        $adhesion_bank = $request->input('rd-adhesion-bank');

        $contract = Contract::find($id);
        $date = date('YmdHis');
        $number = contract_number($contract);
        
        if ($contract->client->is_corporate) $name = explode(' ', $contract->client->corporate_name)[0];
        else $name = explode(' ', $contract->client->name)[0];

        $title = $name . '_adhesion_' . $number . '_' . $date;
        $text_font = 13;
        $line_height = 1.5;
        $logo = ($adhesion_logo == 'on') ? true : false;

        // share data to view
        view()->share('contract', $contract);
        view()->share('title', $title);
        view()->share('text_font', $text_font);
        view()->share('line_height', $line_height);
        view()->share('logo', $logo);

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        return view('contracts.printAdhesion', [
            'contract' => $contract,
            'title' => $title,
            'logo' => $logo,
            'adhesion_bank' => $adhesion_bank,
        ]);
    }

    public function printContract(Request $request, $id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Belem');

        if (Auth::user()->email == 'nixon@sunnyhouse.com.br' || Auth::user()->email == 'rafael@sunnyhouse.com.br') {
            $signature_name = null;
        }

        else $signature_name = decrypt($request->input('contract-signature-name'));

        $customMessages = [
            'required' => 'Preencha o campo :attribute',
            'string' => 'O campo :attribute foi preenchido incorretamente',
            'min' => 'O campo :attribute deve ter no mínimo :min caractere(s)',
            'max' => 'O campo :attribute deve ter no máximo :min caractere(s)'
        ];

        $attributes = [
            'contract-signature-name' => 'Nome',
            'contract-signature-cpf' => 'CPF',
        ];

        $validator = Validator::make($request->all(), [
            'contract-signature-name' => [
                Rule::requiredIf($request->request->has('contract-signature-name')), 'string', 'min:5', 'max:255'
            ],
            'contract-signature-cpf' => [
                Rule::requiredIf($request->request->has('contract-signature-cpf')), 'string', 'cpf'
            ],
        ], $customMessages, $attributes);

        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->getMessages() as $error){
                return back()->withInput()->with('error', $error[0]);
            }
        }

        else {
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

            $contract_logo = $request->input('chk-contract-logo');

            $contract = Contract::find($id);
            $date = date('YmdHis');
            $number = contract_number($contract);

            if ($contract->client->is_corporate) $name = explode(' ', $contract->client->corporate_name)[0];
            else $name = explode(' ', $contract->client->name)[0];

            $title = $name . '_contract_' . $number . '_' . $date;
            $text_font = 11.3;
            $line_height = 1.5;
            $logo = ($contract_logo == 'on') ? true : false;

            // share data to view
            view()->share('contract', $contract);
            view()->share('title', $title);
            view()->share('text_font', $text_font);
            view()->share('line_height', $line_height);
            view()->share('logo', $logo);

            return view('contracts.printContract', [
                'contract' => $contract, 
                'title' => $title,
                'text_font' => $text_font,
                'signature_name' => $signature_name,
                'logo' => $logo,
                'day' => $day,
                'month' => $month,
                'year' => $year
            ]);
        }
    }

    public function printPowerOfAttorney($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $contract = Contract::find($id);
        $date = date('YmdHis');
        $number = contract_number($contract);
        
        if ($contract->client->is_corporate) $name = explode(' ', $contract->client->corporate_name)[0];
        else $name = explode(' ', $contract->client->name)[0];

        $title = $name . '_power_of_attorney_' . $number . '_' . $date;
        $text_font = 16.5;
        $line_height = 2;

        // share data to view
        view()->share('contract', $contract);;
        view()->share('title', $title);;
        view()->share('text_font', $text_font);;
        view()->share('line_height', $line_height);;

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

        return view('contracts.printPowerOfAttorney', [
            'contract' => $contract,
            'title' => $title,
            'text_font' => $text_font,
            'day' => $day,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function printReceiptOfPayment(Request $request, $id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $amount = $request->input('receipt-amount');
        $description = trim($request->input('receipt-description'));
        $receipt_logo = $request->input('chk-receipt-logo');

        $customMessages = [
            'required' => 'Preencha o campo :attribute',
            'string' => 'O campo :attribute foi preenchido incorretamente',
            'min' => 'O campo :attribute deve ter no mínimo :min caractere(s)'
        ];

        $attributes = [
            'receipt-amount' => 'Quantia',
            'receipt-description' => 'Descrição',
        ];

        $validator = Validator::make($request->all(), [
            'receipt-amount' => [
                'required', 'string', 'min: 1'
            ],
            'receipt-description' => [
                'required', 'string', 'min: 10'
            ],
        ], $customMessages, $attributes);

        if ($validator->fails()) return back()->withInput();

        else {
            $contract = Contract::find($id);
            $date = date('YmdHis');
            $number = contract_number($contract);

            if ($contract->client->is_corporate) $name = explode(' ', $contract->client->corporate_name)[0];
            else $name = explode(' ', $contract->client->name)[0];

            $title = $name . '_power_of_attorney_' . $number . '_' . $date;
            $text_font = 16.5;
            $line_height = 2;
            $logo = ($receipt_logo == 'on') ? true : false;

            // share data to view
            view()->share('contract', $contract);
            view()->share('title', $title);
            view()->share('text_font', $text_font);
            view()->share('line_height', $line_height);
            view()->share('amount', $amount);
            view()->share('description', $description);
            view()->share('logo', $logo);

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

            return view('contracts.printReceiptOfPayment', [
                'contract' => $contract,
                'title' => $title,
                'text_font' => $text_font,
                'amount' => $amount,
                'description' => $description,
                'logo' => $logo,
                'day' => $day,
                'month' => $month,
                'year' => $year,
            ]);
        }
    }

    public function printTechnicalCertificate($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $contract = Contract::find($id);
        $date = date('YmdHis');
        $number = contract_number($contract);
        
        if ($contract->client->is_corporate) $name = explode(' ', $contract->client->corporate_name)[0];
        else $name = explode(' ', $contract->client->name)[0];

        $title = $name . '_power_of_attorney_' . $number . '_' . $date;

        $text_font = 16;
        $line_height = 2;

        // share data to view
        view()->share('contract', $contract);;
        view()->share('title', $title);;
        view()->share('text_font', $text_font);;
        view()->share('line_height', $line_height);;

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

        return view('contracts.printTechnicalCertificate', [
            'contract' => $contract,
            'title' => $title,
            'text_font' => $text_font,
            'day' => $day,
            'month' => $month,
            'year' => $year
        ]);
    }

    public function downloadAdhesion($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }
        $contract = Contract::find($id);

        $date = date('YmdHis');
        $number = contract_number($contract);
        
        if ($contract->client->is_corporate) $name = explode(' ', $contract->client->corporate_name)[0];
        else $name = explode(' ', $contract->client->name)[0];

        $title = $name . '_power_of_attorney_' . $number . '_' . $date;

        // share data to view
        view()->share('contract', $contract);;
        view()->share('title', $title);;
        $pdf = PDF::loadView('contracts.print', $contract);
        PDF::setOptions(['isPhpEnabled' => true]);
        $pdf->setPaper('A4', 'portrait');

//        $pdf->setBasePath(public_path());
        // download PDF file with download method

        return $pdf->download($title . '.pdf');
    }

    function getEquipmentsArray()
    {
        //equipments
        $equipments_cable = EquipmentCable::all();
        $equipments_connector = EquipmentConnector::all();
        $equipments_other = EquipmentOther::all();
        $equipments_generator = EquipmentGenerator::all();
        $equipments_solar_inverter = EquipmentSolarInverter::all();
        $equipments_string_box = EquipmentStringBox::all();

        $equipments_array = [];

        foreach ($equipments_cable as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'CABLE', encrypt($equipment->id)]);
        }

        foreach ($equipments_connector as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'CONNECTOR', encrypt($equipment->id)]);
        }

        foreach ($equipments_other as $equipment) {
            //text, category, id
            array_push($equipments_array, [$equipment->name, 'OTHER', encrypt($equipment->id)]);
        }

        foreach ($equipments_generator as $equipment) {
            $text = 'Módulo Solar ' . $equipment->producer . ' - ' . $equipment->module . ' - ' . $equipment->technology . ' - ' . str_replace('.', ',', $equipment->power) . ' W';
            array_push($equipments_array, [$text, 'GENERATOR', encrypt($equipment->id), $equipment->power]);
        }

        foreach ($equipments_solar_inverter as $equipment) {
            $text = 'Inversor ' . $equipment->producer . ' - ' . str_replace('.', ',', $equipment->power) . ' kW - ' . $equipment->mppt . ' MPPT - ' . $equipment->voltage . ' V';
            array_push($equipments_array, [$text, 'SOLAR_INVERTER', encrypt($equipment->id), $equipment->power]);
        }

        foreach ($equipments_string_box as $equipment) {
            $text = 'String Box ' . $equipment->producer . ' ' . $equipment->module;
            array_push($equipments_array, [$text, 'STRING_BOX', encrypt($equipment->id)]);
        }

        return $equipments_array;
    }
}
