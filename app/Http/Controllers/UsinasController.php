<?php

namespace App\Http\Controllers;

use App\Models\Usina;
use App\Models\UsinaApuracao;
use App\Models\ContasContrato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UsinasController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Auth::user() == null) return redirect('/');

        $apuracao = UsinaApuracao::select(DB::raw('mesref'))
        ->whereColumn('usinas_id', 'usinas.id')
        ->orderBy('id', 'DESC')
        ->limit(1)
        ->getQuery();

        $usinas = Usina::select('usinas.*')
        ->selectSub($apuracao, 'ultimaapuracao')
        ->orderBy('nome', 'ASC')
        ->get();

        return view('sunnypark.usinas.list', ['usinas' => $usinas]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list($id)
    {
        if(Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $usina = Usina::find($id);

        return view('sunnypark.usinas.list-all', ['usina' => $usina]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Auth::user() == null) return redirect('/');

        // Pega todos as contas contratos
        $contascontratos = ContasContrato::orderBy('cod_cc', 'ASC')->get();
        $cc_codes = [];

        foreach ($contascontratos as $cc) {
            array_push($cc_codes, $cc->cod_cc);
        }

        return view('sunnypark.usinas.create', ['cc' => $cc_codes]);
    }

    public function exist_login()
    {
        $request = Request::capture();
        $data = $request->all();

        $login = $data['login'];

        $usina_login = Usina::where('login', $login)->first();
        $status_login = ($usina_login) ? false : true;

        // Isso aqui tá meio errado, melhorar e ver depois
        /*$validator = Validator::make($request->all(), [
            'login' => [
                Rule::requiredIf($request->request->has('chk-add-credentials')),
            ],
        ]);*/

        return response()->json(['status' => $status_login]);
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
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        if(Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $usina = Usina::find($id);

        return view('sunnypark.usinas.edit', ['usina' => $usina]);
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
        
        $nome = $data['nome'];
        $apelido = $data['apelido'];
        $documento = $data['documento'];
        $login = $data['login'];
        $senha = $data['senha'];
        $producaoMeta = format_money_to_double($data['producaoMeta']);
        $diaLeitura = $data['diaLeitura'];
        $ciclo = $data['ciclo'];
        $investimento = format_money_to_double($data['investimento']);

        $usina = Usina::find($id);

        if ($usina) {
            $usina->nome = $nome;
            $usina->apelido = $apelido;
            $usina->documento = $documento;
            // $usina->login = $login;
            $usina->senha = $senha;
            $usina->producaoMeta = $producaoMeta;
            $usina->diaLeitura = $diaLeitura;
            $usina->ciclo = $ciclo;
            $usina->investimento = $investimento;

            $usina->save();

            return redirect()->route('sunnypark_usinas_index')->with('success', 'Usina atualizada no sistema.');
        }
        else {
            return redirect()->route('sunnypark_usinas_index')->with('error', 'Houve um erro ao atualizar a usina, sem correpondencia no sistema.');
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
        if(Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
            $id = intval($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $usina = Usina::find($id);

        if ($usina != null) {
            $usina->delete();
            return redirect()->route('sunnypark_usinas_index')->withInput()->with('success', 'A usina foi deletada do sistema com sucesso.');
        }
        else return redirect('/');
    }
	
}