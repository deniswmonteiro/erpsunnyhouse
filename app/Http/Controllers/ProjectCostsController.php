<?php

namespace App\Http\Controllers;

use App\Models\ContractEquipment;
use App\Models\EngineeringProject;
use App\Models\EquipmentSolarInverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectCostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.not_engineering');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('costs.list');
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

        $project = EngineeringProject::find($id);
        $equipments = ContractEquipment::all()->where('contract_id', $project->contract->id);

        foreach ($equipments as $equipment) {
            if ($equipment->type == "SOLAR_INVERTER") $inverter_id = $equipment->product_id;
        }

        $inverter = EquipmentSolarInverter::find($inverter_id);
        $inverter_model = 'Inversor ' . $inverter->producer . ' - ' . str_replace('.', ',', $inverter->power) . ' kW - ' . $inverter->mppt . ' MPPT - ' . $inverter->voltage . ' V';

        return view('costs.create', [
            'project' => $project,
            'inverter_model' => $inverter_model
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
