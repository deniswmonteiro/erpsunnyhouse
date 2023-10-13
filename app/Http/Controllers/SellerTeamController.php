<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Seller;
use App\Models\SellerTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SellerTeamController extends Controller
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
        if (Auth::user() == null) return redirect('/');

        $teams = SellerTeam::orderBy('name', 'asc')->get();

        return view('sellersTeam.list', [
            'teams' => $teams
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

    public function store_team_ajax()
    {
        $request = Request::capture();
        $data = $request->all();

        // Validate Seller Team
        $custom_messages = [
            'required' => 'Preencha o campo :attribute.',
            'string' =>  'O campo :attribute selecionado é inválido.',
            'min' => [
                'string' => 'Mínimo de :min caractere(s).',
            ],
            'max' => [
                'string' => 'Máximo de :max caracteres.',
            ],
            'unique' => ':attribute já cadastrado no sistema.',
        ];

        $attributes = [
            'name' => 'Nome',
        ];

        $validator = Validator::make($data, [
            'name' => [
                'required', 'string', 'min:5', 'max:255', Rule::unique('seller_team')
            ],
        ], $custom_messages, $attributes);

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
            $name = ucwords(mb_strtolower($data['name'], 'UTF-8'));

            // Create Seller Team
            $team = SellerTeam::create([
                'name' => $name
            ]);

            $teams = SellerTeam::all();
            $teams_names = [];

            foreach ($teams as $team) {
                array_push($teams_names, $team->name);
            }

            return response()->json([
                'status' => true,
                'message' => ['Time de Vendas salvo com sucesso'],
                'teams_names' => $teams_names,
                'team_name' => $team->name
            ]);
        }
    }
}
