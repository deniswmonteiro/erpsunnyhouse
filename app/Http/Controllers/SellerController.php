<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\SellerTeam;
use App\Models\Contract;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;
use Illuminate\Validation\Rule;

class SellerController extends Controller
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

        $sellers = Seller::orderBy('name', 'asc')->get();

        return view('sellers.list', ['sellers' => $sellers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Auth::user() == null) return redirect('/');

        $teams = SellerTeam::orderBy('name', 'asc')->get();
        $teams_names = [];

        foreach ($teams as $team) {
            array_push($teams_names, $team->name);
        }

        return view('sellers.create', [
            'teams' => $teams_names
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

        // Validate seller
        $custom_messages = [
            'required' => 'Preencha o campo :attribute.',
            'string' =>  'O campo :attribute selecionado é inválido.',
            'regex' =>  'Preencha o campo :attribute corretamente.',
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
            'phone' => 'Telefone',
            'email' => 'Email',
            'team' => 'Time de Vendas',
            'cep' => 'CEP',
            'address' => 'Endereço',
            'address-number' => 'Número',
            'complement' => 'Complemento',
            'neighborhood' => 'Bairro',
            'city' => 'Cidade',
            'state' => 'Estado',
        ];

        $validator = Validator::make($data, [
            'name' => [
                'required', 'string', 'min:5', 'max:255', Rule::unique('seller')
            ],
            'phone' => [
                'required', 'string',
            ],
            'email' => [
                'required', 'string', 'max:255', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i', Rule::unique('seller'),
            ],
            'team' => [
                'required', 'string',
            ],
            'cep' => [
                'nullable', Rule::requiredIf($data['cep'] != null), 'string'
            ],
            'address' => [
                'nullable', Rule::requiredIf($data['address'] != null), 'string'
            ],
            'number' => [
                'nullable', Rule::requiredIf($data['number'] != null), 'string'
            ],
            'complement' => [
                'nullable', Rule::requiredIf($data['complement'] != null), 'string'
            ],
            'neighborhood' => [
                'nullable', Rule::requiredIf($data['neighborhood'] != null), 'string'
            ],
            'city' => [
                'nullable', Rule::requiredIf($data['city'] != null), 'string'
            ],
            'state' => [
                'nullable', Rule::requiredIf($data['state'] != null), 'string', 'min:2', 'max:2'
            ],
        ], $custom_messages, $attributes);

        if ($validator->fails()) {
            $errors = [];

            foreach ($validator->getMessageBag()->getMessages() as $error) {
                return back()->withInput()->with('error', $error[0]);
            }
        }

        else {
            $seller_team = SellerTeam::where('name', $data['team'])->first();

            if (!$seller_team) {
                return back()->withInput()->with('error', 'Time de Vendas não encontrado.');
            }

            else {
                $name = ucwords(mb_strtolower($data['name'], 'UTF-8'));
                $cep = ($data['cep'] != null) ? $data['cep'] : null;
                $address = ($data['address'] != null) ? ucwords(mb_strtolower($data['address'], 'UTF-8')) : null;
                $number = ($data['number']) != null ? $data['number'] : null;
                $complement = ($data['complement'] != null) ? $data['complement'] : null;
                $neighborhood = ($data['neighborhood'] != null) ?
                    ucwords(mb_strtolower($data['neighborhood'], 'UTF-8')) :
                    null;
                $city = ($data['city'] != null) ? ucwords(mb_strtolower($data['city'], 'UTF-8')) : null;
                $state = ($data['state'] != null) ? mb_strtoupper($data['state'], 'UTF-8') : null;

                Seller::create([
                    'name' => $name,
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'cep' => $cep,
                    'address' => $address,
                    'address_number' => $number,
                    'complement' => $complement,
                    'neighborhood' => $neighborhood,
                    'city' => $city,
                    'state' => $state,
                    'seller_team_id' => $seller_team->id,
                ]);

                return redirect('/sellers')->with('success', 'Vendedor cadastrado com sucesso.');
            }
        }
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        if (Auth::user() == null) return redirect('/');
        try {
            $id = decrypt($id);
        } catch (Exception $e) {
            return redirect('/login');
        }

        $seller = Seller::find($id);
        $teams = SellerTeam::orderBy('name', 'asc')->get();
        $teams_names = [];
        foreach ($teams as $team) {
            array_push($teams_names, $team->name);
        }

        return view('sellers.edit', ['seller' => $seller, 'teams' => $teams_names]);
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

        $data = $request->all();

        try {
            $id = decrypt($id);
        } catch (Exception $e) {
            return redirect('/login');
        }

        $seller = Seller::findOrFail($id);

        if ($seller->exists()) {
            // Validate seller
            $custom_messages = [
                'required' => 'Preencha o campo :attribute.',
                'string' =>  'O campo :attribute selecionado é inválido.',
                'regex' =>  'Preencha o campo :attribute corretamente.',
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
                'phone' => 'Telefone',
                'email' => 'Email',
                'team' => 'Time de Vendas',
                'cep' => 'CEP',
                'address' => 'Endereço',
                'address-number' => 'Número',
                'complement' => 'Complemento',
                'neighborhood' => 'Bairro',
                'city' => 'Cidade',
                'state' => 'Estado',
            ];

            $validator = Validator::make($data, [
                'name' => [
                    'required', 'string', 'min:5', 'max:255', Rule::unique('seller')->ignore($seller)
                ],
                'phone' => [
                    'required', 'string',
                ],
                'email' => [
                    'required', 'string', 'max:255', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i', Rule::unique('seller')->ignore($seller)
                ],
                'team' => [
                    'required', 'string',
                ],
                'cep' => [
                    'nullable', Rule::requiredIf($data['cep'] != null), 'string'
                ],
                'address' => [
                    'nullable', Rule::requiredIf($data['address'] != null), 'string'
                ],
                'number' => [
                    'nullable', Rule::requiredIf($data['number'] != null), 'string'
                ],
                'complement' => [
                    'nullable', Rule::requiredIf($data['complement'] != null), 'string'
                ],
                'neighborhood' => [
                    'nullable', Rule::requiredIf($data['neighborhood'] != null), 'string'
                ],
                'city' => [
                    'nullable', Rule::requiredIf($data['city'] != null), 'string'
                ],
                'state' => [
                    'nullable', Rule::requiredIf($data['state'] != null), 'string', 'min:2', 'max:2'
                ],
            ], $custom_messages, $attributes);

            if ($validator->fails()) {
                $errors = [];

                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    return back()->withInput()->with('error', $error[0]);
                }
            }

            else {
                $seller_team = SellerTeam::where('name', $data['team'])->first();

                if (!$seller_team) {
                    return back()->withInput()->with('error', 'Time de Vendas não encontrado.');
                }

                else {
                    $name = ucwords(mb_strtolower($data['name'], 'UTF-8'));
                    $cep = ($data['cep'] != null) ? $data['cep'] : null;
                    $address = ($data['address'] != null) ? ucwords(mb_strtolower($data['address'], 'UTF-8')) : null;
                    $number = ($data['number']) != null ? $data['number'] : null;
                    $complement = ($data['complement'] != null) ? $data['complement'] : null;
                    $neighborhood = ($data['neighborhood'] != null) ?
                        ucwords(mb_strtolower($data['neighborhood'], 'UTF-8')) :
                        null;
                    $city = ($data['city'] != null) ? ucwords(mb_strtolower($data['city'], 'UTF-8')) : null;
                    $state = ($data['state'] != null) ? mb_strtoupper($data['state'], 'UTF-8') : null;

                    // Update seller data
                    $seller->name = $name;
                    $seller->email = $data['email'];
                    $seller->phone = $data['phone'];
                    $seller->cep = $cep;
                    $seller->address = $address;
                    $seller->address_number = $number;
                    $seller->complement = $complement;
                    $seller->neighborhood = $neighborhood;
                    $seller->city = $city;
                    $seller->state = $state;
                    $seller->seller_team_id = $seller_team->id;
                    $seller->save();

                    return redirect('/sellers')->with('success', 'Vendedor atualizado com sucesso.');
                }
            }
        }

        else return back()->withInput()->with('error', 'Vendedor não encontrado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $id = decrypt($id);
            $id = intval($id);
        } catch (Exception $e) {
            return redirect('/');
        }

        $seller = Seller::find($id);

        if($seller != null) {
            $contracts = [];
            $seller_contracts = Contract::where('seller_id', $seller->id)->get();

            foreach($seller_contracts as $contract) {
                array_push($contracts, $contract);
            }
            
            if(empty($contracts)) {
                $seller->delete();
                return back()->withInput()->with('success', 'Vendedor(a) deletado(a) com sucesso.');
            }
    
            else {
                return view('sellers.listSellerContracts', [
                    'seller' => $seller,
                    'contracts' => $contracts
                ]);
            }
        }
        
        else return redirect('/');
    }

    public function validate_email()
    {
        $request = Request::capture();
        $data = $request->all();
        $email = $data['email'];
        $name = $data['name'];
        $name = ucwords(mb_strtolower($name, 'UTF-8'));

        $seller_email = Client::where('email', $email)->first();
        $seller_name = Client::where('name', $name)->first();

        $status_email = ($seller_email) ? true : false;
        $status_name = ($seller_name) ? true : false;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        return response()->json(['exist_email' => $status_email, 'exist_name' => $status_name, 'validated_fail' => $validator->fails()]);
    }

    //update seller exist
    public function validate_email_seller()
    {
        $request = Request::capture();
        $data = $request->all();
        $email = $data['email'];
        $id = $data['seller'];
        $name = $data['name'];
        $name = ucwords(mb_strtolower($name, 'UTF-8'));

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/sellers')->withInput()
                ->with('error', "Ocorreu um erro ao atualziar o vendedor.");
        }

        $client_id = Client::where('email', $email)->where('id', '!=', $id)->first();
        $client_name = Client::where('name', $name)->where('id', '!=', $id)->first();

        $status_email = ($client_id) ? true : false;
        $status_name = ($client_name) ? true : false;


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'seller' => 'required',
        ]);

        return response()->json(['exist_email' => $status_email, 'exist_name' => $status_name, 'validated_fail' => $validator->fails()]);
    }

    public function store_seller_ajax()
    {
        $request = Request::capture();
        $data = $request->all();

        // Validate seller
        $custom_messages = [
            'required' => 'Preencha o campo :attribute.',
            'string' =>  'O campo :attribute selecionado é inválido.',
            'regex' =>  'Preencha o campo :attribute corretamente.',
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
            'phone' => 'Telefone',
            'email' => 'Email',
            'team' => 'Time de Vendas',
            'cep' => 'CEP',
            'address' => 'Endereço',
            'address-number' => 'Número',
            'complement' => 'Complemento',
            'neighborhood' => 'Bairro',
            'city' => 'Cidade',
            'state' => 'Estado',
        ];

        $validator = Validator::make($data, [
            'name' => [
                'required', 'string', 'min:5', 'max:255', Rule::unique('seller')
            ],
            'phone' => [
                'required', 'string',
            ],
            'email' => [
                'required', 'string', 'max:255', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i', Rule::unique('seller'),
            ],
            'team' => [
                'required', 'string',
            ],
            'cep' => [
                'nullable', Rule::requiredIf($data['cep'] != null), 'string'
            ],
            'address' => [
                'nullable', Rule::requiredIf($data['address'] != null), 'string'
            ],
            'address-number' => [
                'nullable', Rule::requiredIf($data['address-number'] != null), 'string'
            ],
            'complement' => [
                'nullable', Rule::requiredIf($data['complement'] != null), 'string'
            ],
            'neighborhood' => [
                'nullable', Rule::requiredIf($data['neighborhood'] != null), 'string'
            ],
            'city' => [
                'nullable', Rule::requiredIf($data['city'] != null), 'string'
            ],
            'state' => [
                'nullable', Rule::requiredIf($data['state'] != null), 'string', 'min:2', 'max:2'
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
            $seller_team = SellerTeam::where('name', $data['team'])->first();

            if (!$seller_team) {
                return response()->json([
                    'status' => false,
                    'message' => ['Time de Vendas não encontrado'],
                ]);
            }

            else {
                $name = ucwords(mb_strtolower($data['name'], 'UTF-8'));
                $cep = ($data['cep'] != null) ? $data['cep'] : null;
                $address = ($data['address'] != null) ? ucwords(mb_strtolower($data['address'], 'UTF-8')) : null;
                $number = ($data['address-number']) != null ? $data['address-number'] : null;
                $complement = ($data['complement'] != null) ? $data['complement'] : null;
                $neighborhood = ($data['neighborhood'] != null) ?
                    ucwords(mb_strtolower($data['neighborhood'], 'UTF-8')) :
                    null;
                $city = ($data['city'] != null) ? ucwords(mb_strtolower($data['city'], 'UTF-8')) : null;
                $state = ($data['state'] != null) ? mb_strtoupper($data['state'], 'UTF-8') : null;

                $seller = Seller::create([
                    'name' => $name,
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'cep' => $cep,
                    'address' => $address,
                    'address_number' => $number,
                    'complement' => $complement,
                    'neighborhood' => $neighborhood,
                    'city' => $city,
                    'state' => $state,
                    'seller_team_id' => $seller_team->id,
                ]);

                $sellers = Seller::all();
                $sellers_names = [];

                foreach ($sellers as $seller) {
                    array_push($sellers_names, $seller->name);
                }

                return response()->json([
                    'status' => true,
                    'message' => ['Vendedor salvo com sucesso'],
                    'sellers_names' => $sellers_names,
                    'seller_name' => $seller->name
                ]);
            }
        }
    }

    public function exist_name_seller()
    {
        $request = Request::capture();
        $data = $request->all();

        $name = $data['name'];
        $exist = Seller::where('name', $name)->first();

        if ($exist) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
