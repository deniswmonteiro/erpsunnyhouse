<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Fatura;
use App\Models\ContasContrato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContasContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Auth::user() == null) return redirect('/');

        // https://stackoverflow.com/questions/54161500/laravel-db-query-builder-left-join-with-related-counts

        $contacontratos = ContasContrato::select(DB::raw('count(contas_contratos.id)'))
        ->whereColumn('client_id', 'client.id')
        ->getQuery();

        $clients = Client::select('client.*')
        ->selectSub($contacontratos, 'contacontratos_count')
        ->orderBy('name', 'ASC')
        ->get();

        return view('sunnypark.contascontratos.list', ['clientes' => $clients]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Auth::user() == null) return redirect('/');

        // Pega todos os clientes
        $clients = Client::orderBy('name', 'ASC')->get();
        $clients_names = [];

        foreach ($clients as $client) {
            if($client->is_corporate) array_push($clients_names, $client->corporate_name);
            else array_push($clients_names, $client->name);
        }

        return view('sunnypark.contascontratos.create', [
            'clients' => $clients_names,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create_fatura($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        return view('sunnypark.contascontratos.create-fatura', [
            'id' => encrypt($id)
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
        if(Auth::user() == null) return redirect('/');

        $data = $request->all();
        $client = $data['client'];
        $unidade = $data['unidade'];
        $apelido = $data['apelido'];
        $classificacao = $data['classificacao'];
        $tipo = $data['tipo'];
        $modalidade = $data['modalidade'];

        // Pega o cliente
        $client = ucwords(mb_strtolower($client, 'UTF-8'));
        $client = Client::where('name', $client)->orWhere('corporate_name', $client)->first();
        
        if ($client) {
            $contasContrato = ContasContrato::create([
                'client_id' => $client->id,
                'cod_cc' => $unidade,
                'apelido' => $apelido,
                'classificacao' => $classificacao,
                'tipo_classificacao' => $tipo,
                'modalidade_tarifaria' => $modalidade,
            ]);

            return redirect()->route('sunnypark_contascontratos_index', ['id' => encrypt($contasContrato->id)])
                ->with('success', 'Conta Contrato salvo no sistema.');
        }
        else {
            return redirect()->route('sunnypark_contascontratos_index')
                ->with('error', 'Houve um erro ao criar a conta contrato. Sem correpondência de cliente.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_fatura(Request $request,  $id)
    {
        if(Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $data = $request->all();
        $data_fatura = $data['data_fatura'];
        $valor_faturado = format_money_to_double($data['valor_faturado']);
        $valor_tarifa = format_money_to_double($data['valor_tarifa']);
        $valor_tarifa_comp = format_money_to_double($data['valor_tarifa_comp']);
        $data_inicio = $data['data_inicio'];
        $energia_reg = format_money_to_double($data['energia_reg']);
        $energia_comp = format_money_to_double($data['energia_comp']);
        $data_fim = $data['data_fim'];
        $energia_fat = format_money_to_double($data['energia_fat']);

        $fatura = Fatura::create([
            'contas_contratos_id' => $id,
            'data_fatura' => $data_fatura,
            'valor_faturado' => $valor_faturado,
            'valor_tarifa' => $valor_tarifa,
            'valor_tarifa_energia' => $valor_tarifa_comp,
            'data_inicio_ciclo' => $data_inicio,
            'kwh_energia_registrada' => $energia_reg,
            'kwh_energia_compensada' => $energia_comp,
            'data_fim_ciclo' => $data_fim,
            'kwh_faturada' => $energia_fat
        ]);

        return redirect()->route('sunnypark_contascontratos_list_faturas', ['id' => encrypt($id)])
            ->with('success', 'Fatura salva no sistema.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $client =  Client::find($id);

        $faturas = Fatura::select(DB::raw('count(faturas.id)'))
        ->whereColumn('contas_contratos_id', 'contas_contratos.id')
        ->getQuery();

        $contasContrato = ContasContrato::select('contas_contratos.*')
        ->selectSub($faturas, 'faturas_count')
        ->where('client_id', $id)
        ->orderBy('cod_cc', 'ASC')
        ->get();

        return view('sunnypark.contascontratos.list-contratos', [
            'cliente' => $client,
            'contascontratos' => $contasContrato
        ]);
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
        } catch (\Exception $e) {
            return redirect('/');
        }

        $contasContrato = ContasContrato::find($id);

        return view('sunnypark.contascontratos.edit', ['cc' => $contasContrato]);
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

        // $type_new_generator = 1;
        $data = $request->all();

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }
        
        $unidade = $data['unidade'];
        $apelido = $data['apelido'];
        $classificacao = $data['classificacao'];
        $tipo = $data['tipo'];
        $modalidade = $data['modalidade'];

        $contasContrato = ContasContrato::find($id);

        if ($contasContrato) {
            $contasContrato->cod_cc = $unidade;
            $contasContrato->apelido = $apelido;
            $contasContrato->classificacao = $classificacao;
            $contasContrato->tipo_classificacao = $tipo;
            $contasContrato->modalidade_tarifaria = $modalidade;

            $contasContrato->save();

            return redirect()->route('sunnypark_contascontratos_list', ['id' => encrypt($contasContrato->client_id)])->with('success', 'Conta Contrato atualizado no sistema.');
        }
        else {
            return redirect()->route('sunnypark_contascontratos_list', ['id' => encrypt($contasContrato->client_id)])->with('error', 'Houve um erro ao atualizar a conta contrato, sem correpondencia no sistema.');
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

        $contasContratos = ContasContrato::where('client_id', $id)->get();;

        foreach ($contasContratos as $contascontrato) {
            $contascontrato->delete();
            $contascontrato->deleteFaturas();
        }

        return redirect()->route('sunnypark_contascontratos_index')->withInput()->with('success', 'Contas contratos (e faturas) deletados do sistema com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy_cc($id)
    {
        try {
            $id = decrypt($id);
            $id = intval($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $contasContrato = ContasContrato::find($id);

        if ($contasContrato != null) {
            $contasContrato->delete();
            return redirect()->route('sunnypark_contascontratos_list', ['id' => encrypt($contasContrato->client_id)])->withInput()
                ->with('success', 'A conta contrato foi deletada do sistema com sucesso.');
        }
        
        else return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list_faturas($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $faturas = Fatura::where('contas_contratos_id', $id)->orderBy('id', 'ASC')->get();

        return view('sunnypark.contascontratos.list-faturas', [
            'id' => $id,
            'faturas' => $faturas
        ]);
    }
}
