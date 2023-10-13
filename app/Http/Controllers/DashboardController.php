<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Seller;
use App\Models\SellerTeam;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Http\Request;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome\ChromeProcess;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.not_engineering');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $request = Request::capture();
        $data = $request->all();
        $sellers_all = Seller::orderBy('name', 'asc')->get();
        $sellers_team_all = SellerTeam::orderBy('name', 'asc')->get();
        $type = isset($data['type']);

        if (isset($data['seller_team'])) {
            $names = explode(',', $data['seller_team']);
            $sellers_team_id = [];
            $sellers_team = SellerTeam::whereIn('name', $names)->get();

            foreach ($sellers_team as $teams) {
                array_push($sellers_team_id, $teams->id);
            }

            $sellers = Seller::whereIn('seller_team_id', $sellers_team_id)->get();
        }
        
        else if (isset($data['seller'])) {
            $names = explode(',', $data['seller']);
            $sellers = Seller::whereIn('name', $names)->get();
            $sellers_team_id = [];

            foreach ($sellers as $seller) {
                array_push($sellers_team_id, $seller->team->id);
            }

            $sellers_team = SellerTeam::whereIn('id', $sellers_team_id)->get();
        }
        
        else {
            $sellers = $sellers_all;
            $sellers_team = $sellers_team_all;
        }

        // a partir do dia 01 do mês
        $init_month = date("Y-m-", strtotime(date("Y-m-d"))) . '01';
        $end_date = date("Y-m-d", strtotime(date("Y-m-d")));
        $start_3_month = date("Y-m-", strtotime($init_month . "-2 month")) . '01';
        $start_5_month = date("Y-m-", strtotime($init_month . " -4 month")) . '01';

        $conversion = getChartContractConversion($start_3_month, $end_date, $sellers, $type);
        $generation_power_array = getChartContractGenerationPower($start_3_month, $end_date, $sellers, $type);
        $offer_sale = getChartContractOfferSale($start_5_month, $end_date, $sellers, $type);
        $chart_status = getChartContractByStatus($start_5_month, $end_date, $sellers, $type);
        $amount = getChartContractAmount($start_5_month, $end_date, $sellers, $type);

        $generation_power = 0;

        foreach ($generation_power_array as $generation) {
            $generation_power += $generation['value'];
        }

        $value_total = $this->getValueContractAmount($type, $init_month, $end_date);
        $value_active = $this->getValueContractAmount($type, $init_month, $end_date, 
            ContractController::$STATUS_CONCLUDED);

        if ($type) $contracts = Contract::orderBy('contract_date', 'desc')->where('type', 1)->limit(10)->get();
        else $contracts = Contract::orderBy('contract_date', 'desc')->limit(10)->get();

        return view('dashboard/dashboard', [
            'amount' => $amount,
            'conversion' => $conversion,
            'contracts' => $contracts,
            'value_total' => $value_total,
            'value_active' => $value_active,
            'generation_power_array' => $generation_power_array,
            'generation_power' => $generation_power,
            'offer_sale' => $offer_sale,
            'status' => $chart_status,
            'sellers' => $sellers,
            'sellers_all' => $sellers_all,
            'sellers_team' => $sellers_team,
            'sellers_team_all' => $sellers_team_all,
            'type' => $type,
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function getValueContractAmount($type, $start_date, $end_date, $status = null)
    {
        $start_date = $start_date;
        $end_date = $end_date;

        if ($status == null) {
            $contracts = Contract::whereBetween('contract_date', [$start_date, $end_date])->get();
        }
        
        else {
            $contracts = Contract::whereBetween('contract_date', [$start_date, $end_date])
                ->where('status', $status)
                ->get();
        }

        $value = 0;
        
        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type == 1) {
                    $value += $contract->getValue();
                }
            }
            
            else {
                $value += $contract->getValue();
            }
        }

        return $value;
    }
}
