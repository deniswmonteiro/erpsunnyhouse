<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contrato;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ContratosController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Auth::user() == null) return redirect('/');

        $contratos = Contrato::orderBy('data_vigencia', 'desc')->get();

        return view('sunnypark.contratos.list', ['contratos' => $contratos]);
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

        return view('sunnypark.contratos.create', [
            'clients' => $clients_names,
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
        $status = $data['status'];
        $type = $data['type'];
        $quantidade = format_money_to_double($data['quantidade']);
        $potencia = format_money_to_double($data['potencia']);
        $contract_vigencia = $data['contract-vigencia'];
        $contract_date = $data['contract-date'];
        $payment_value = format_money_to_double($data['payment_value']);
        $desconto = $data['desconto'];
        $tarifa_base = format_money_to_double($data['tarifa_base']);
        $meta_gestao = format_money_to_double($data['meta_gestao']);

        // Pega o cliente
        $client = ucwords(mb_strtolower($client, 'UTF-8'));
        $client = Client::where('name', $client)->orWhere('corporate_name', $client)->first();
        
        if ($client) {
            $contrato = Contrato::create([
                'client_id' => $client->id,
                'status' => $status,
                'tipo_contrato' => $type,
                'potencia_quota' => $potencia,
                'qtd_kwh' => $quantidade,
                'tempo_vigencia' => $contract_vigencia,
                'data_vigencia' => $contract_date,
                'valor' => $payment_value,
                'desconto' => $desconto,
                'tarifa_base' => $tarifa_base,
                'meta_gestao' => $meta_gestao,
            ]);

            return redirect()->route('sunnypark_contratos_index', ['id' => encrypt($contrato->id)])
                ->with('success', 'Contrato salvo no sistema.');
        }
        else {
            return redirect()->route('sunnypark_contratos_index')
                ->with('error', 'Houve um erro ao criar o contrato. Sem correpondência de cliente.');
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
        if (Auth::user() == null) return redirect('/');

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $clients = Client::orderBy('name', 'ASC')->get();
        $contrato = Contrato::find($id);
        $clients_names = [];

        foreach ($clients as $client) {
            if ($client->is_corporate) array_push($clients_names, [$client->corporate_name, $client->is_corporate]);
            else array_push($clients_names, [$client->name, $client->is_corporate]);
        }

        return view('sunnypark.contratos.edit', [
            'clients' => $clients_names,
            'contrato' => $contrato
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

        // $type_new_generator = 1;
        $data = $request->all();

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }
        
        $client = $data['client'];
        $status = $data['status'];
        $type = $data['type'];
        $quantidade = format_money_to_double($data['quantidade']);
        $potencia = format_money_to_double($data['potencia']);
        $contract_vigencia = $data['contract-vigencia'];
        $contract_date = $data['contract-date'];
        $payment_value = format_money_to_double($data['payment_value']);
        $desconto = $data['desconto'];
        $tarifa_base = format_money_to_double($data['tarifa_base']);
        $meta_gestao = format_money_to_double($data['meta_gestao']);

        $client = ucwords(mb_strtolower($client, 'UTF-8'));
        $client = Client::where('name', $client)->orWhere('corporate_name', $client)->first();

        if ($client) {
            $contrato = Contrato::find($id);

            if ($contrato) {
                $contrato->client_id = $client->id;
                $contrato->status = $status;
                $contrato->tipo_contrato = $type;
                $contrato->qtd_kwh = $quantidade;
                $contrato->potencia_quota = $potencia;
                $contrato->tempo_vigencia = $contract_vigencia;
                $contrato->data_vigencia = $contract_date;
                $contrato->valor = $payment_value;
                $contrato->desconto = $desconto;
                $contrato->tarifa_base = $tarifa_base;
                $contrato->meta_gestao = $meta_gestao;

                $contrato->save();

                return redirect()->route('sunnypark_contratos_index')->with('success', 'Contrato atualizado no sistema.');
            }
            else {
                return redirect()->route('sunnypark_contratos_index')->with('error', 'Houve um erro ao atualizar o contrato, sem correpondencia de contrato.');
            }
        }
        else {
            return redirect()->route('sunnypark_contratos_edit')->with('error', 'Houve um erro ao atualizar o contrato, sem correpondencia de cliente.');
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

        $contrato = Contrato::find($id);

        if ($contrato != null) {
            $contrato->delete();
            return redirect()->route('sunnypark_contratos_index')->withInput()
                ->with('success', 'O contrato foi deletado do sistema com sucesso.');
        }
        
        else return redirect('/');
    }

    public function print(Request $request, $id)
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

            $contrato = Contrato::find($id);
            $date = date('YmdHis');
            $number = contract_number($contrato);
            $name = explode(' ', "contrato nome")[0];

            $title = $name . '_' . $number . '_' . $date;
            $text_font = 11.3;
            $line_height = 1.5;

            // share data to view
            view()->share('contract', $contrato);
            view()->share('title', $title);
            view()->share('text_font', $text_font);
            view()->share('line_height', $line_height);

            $title = $name . '_contract_' . $number . '_' . $date;

            // Quem vai assinar da empresa
            if (empty($signature_name)) {
                if (Auth::user()->email == "nixon@sunnyhouse.com.br") {
                    $signeeName = "Nixon Menezes Girard da Silva";
                    $signeeDoc = "510.830.192-87";
                }
                else {
                    $signeeName = "Rafael Feio Calandrini";
                    $signeeDoc = "708.782.182-20" ;
                }
            }
            elseif ($signature_name == 1) {
                $signeeName = "Nixon Menezes Girard da Silva";
                $signeeDoc = "510.830.192-87";
            }
            elseif ($signature_name == 2) {
                $signeeName = "Rafael Feio Calandrini";
                $signeeDoc = "708.782.182-20";
            }

            // Cliente que vai assinar
            if ($contrato->client->is_corporate) {
                $cliType = "CNPJ";
                $cliName = $contrato->client->corporate_name;
                $cliDoc = $contrato->client->cnpj;
                $cliRepresentante = $contrato->client->name;
            }
            else {
                $cliType = "CPF";
                $cliName = $contrato->client->name;
                $cliDoc = $contrato->client->cpf;
                $cliRepresentante = "";
            }

            return view('sunnypark.contratos.printContract', [
                'contract' => $contrato, 
                'title' => $title,
                'text_font' => $text_font,
                'signature_name' => $signature_name,
                'day' => $day,
                'month' => $month,
                'year' => $year,
                'signeeName' => $signeeName,
                'signeeDoc' => $signeeDoc,
                'cliType' => $cliType,
                'cliName' => $cliName,
                'cliDoc' => $cliDoc,
                'cliRepresentante' => $cliRepresentante
            ]);
        }
    }

}