<?php

namespace App\Http\Controllers;

use App\Models\Usina;
use App\Models\UsinaRateio;
use App\Models\ContasContrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class usinasRateioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($id)
    {
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $usina = Usina::find($id);

        // Pega todos as contas contratos
        $contascontratos = ContasContrato::orderBy('cod_cc', 'ASC')->get();
        $cc_codes = [];

        foreach ($contascontratos as $cc) {
            array_push($cc_codes, $cc->cod_cc);
        }

        return view('sunnypark.usinas.create-rateio', ['usina' => $usina, 'cc' => $cc_codes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        /*if(Auth::user() == null) return redirect('/');

        $data = $request->all();
        $contas_contratos_id = $data['cc'];
        $nome = $data['nome'];
        $apelido = $data['apelido'];
        $documento = $data['documento'];
        $login = $data['login'];
        $senha = $data['senha'];
        $producaoMeta = format_money_to_double($data['producaoMeta']);
        $diaLeitura = $data['diaLeitura'];
        $ciclo = $data['ciclo'];
        $investimento = format_money_to_double($data['investimento']);

        // Pega a cc
        $cc = ContasContrato::where('cod_cc', $contas_contratos_id)->first();
        
        if ($cc) {
            $usina = Usina::create([
                'contas_contratos_id' => $cc->id,
                'nome' => $nome,
                'apelido' => $apelido,
                'documento' => $documento,
                'login' => $login,
                'senha' => $senha,
                'producaoMeta' => $producaoMeta,
                'diaLeitura' => $diaLeitura,
                'ciclo' => $ciclo,
                'investimento' => $investimento,
            ]);

            return redirect()->route('sunnypark_usinas_index')->with('success', 'Usina salva no sistema.');
        }
        else {
            return redirect()->route('sunnypark_usinas_index')->with('error', 'Houve um erro ao criar a usina. Sem correpondência de conta contrato.');
        }*/
    }
}
