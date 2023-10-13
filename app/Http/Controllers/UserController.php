<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
        if (Auth::user() == null || Auth::user()->category_id != 1) return redirect('/');

        $users = User::orderBy('name', 'asc')->get();

        return view('users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Auth::user() == null || Auth::user()->category_id != 1) return redirect('/');

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::user() == null || Auth::user()->category_id != 1) return redirect('/');

        $data = $request->all();

        try {
            $category = intval(decrypt($data['category']));
            $status = (decrypt($data['status']) == 'true' ? true : false);
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // Checks if the user is an engineer
        if ($category == 2) $is_engineer = true;
                
        else if ($category == 3) {
            $is_engineer = (isset($data['chk-is-engineer'])) ? true : false;
        }

        else $is_engineer = false;

        // Validate user
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
            'email' => 'Email',
            'password' => 'Senha',
            'category' => 'Categoria',
            'status' => 'Status',
            'professional-title' => 'Título Profissional',
            'professional-registration' => 'Nº do Registro Profissional',
            'professional-state' => 'UF',
            'phone' => 'Telefone Fixo',
            'cellphone' => 'Telefone Celular',
            'cep' => 'CEP',
            'address' => 'Endereço',
            'number' => 'Número',
            'neighborhood' => 'Bairro',
            'city' => 'Cidade',
            'state' => 'Estado',
        ];

        $validator = Validator::make($data, [
            'name' => [
                'required', 'string', 'min:5', 'max:255'
            ],
            'email' => [
                'required', 'string', 'max:255', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i', Rule::unique('user')
            ],
            'password' => [
                'required', 'string', 'min:6', 'regex:/^[a-zA-Z0-9@#$%!^&*-.]{6,}$/'
            ],
            'category' => [
                'required', 'string'
            ],
            'status' => [
                'required', 'string'
            ],
            'professional-title' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
            'professional-registration' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
            'professional-state' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
            'phone' => [
                'nullable', Rule::requiredIf(($is_engineer) && $data['phone'] != null), 'string', 'min:14', 'max:14'
            ],
            'cellphone' => [
                'nullable', Rule::requiredIf($is_engineer), 'string', 'min:15', 'max:15'
            ],
            'cep' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
            'address' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
            'number' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
            'neighborhood' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
            'city' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
            'state' => [
                'nullable', Rule::requiredIf($is_engineer), 'string'
            ],
        ], $custom_messages, $attributes);

        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->getMessages() as $error) {
                return back()->withInput($data)->with('error', $error[0]);
            }
        }

        else {
            $name = ucwords(mb_strtolower($data['name'], 'UTF-8'));
            $password = Hash::make($data['password']);            

            if ($data['professional-title'] != null) {
                $professional_title = ucwords(mb_strtolower($data['professional-title'], 'UTF-8'));
            }

            else $professional_title = null;
            
            if ($request->request->has('professional-state')) $professional_state = $data['professional-state'];
            else $professional_state = null;

            if ($request->request->has('state')) $state = $data['state'];
            else $state = null;

            // Create user
            User::create([
                'name' => $name,
                'password' => $password,
                'email' => $data['email'],
                'category_id' => $category,
                'status' => $status,
                'is_engineer' => $is_engineer,
                'professional_title' => $professional_title,
                'professional_registration' => $data['professional-registration'],
                'professional_state' => $professional_state,
                'phone' => $data['phone'],
                'cellphone' => $data['cellphone'],
                'cep' => $data['cep'],
                'address' => $data['address'],
                'number' => $data['number'],
                'neighborhood' => $data['neighborhood'],
                'city' => $data['city'],
                'state' => $state,
            ]);

            return redirect('/users')->with('success', 'Usuário adicionado com sucesso.');
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
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::user() == null || Auth::user()->category_id != 1) return redirect('/');
        
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $user = User::find($id);

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        if (Auth::user() == null || Auth::user()->category_id != 1) return redirect('/');

        $data = $request->all();

        try {
            $id = intval(decrypt($id));
            $category = intval(decrypt($data['category']));
            $status = (decrypt($data['status']) == 'true' ? true : false);
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $user = User::findOrFail($id);

        // Checks if the user is an engineer
        if ($category == 2) $is_engineer = true;
                
        else if ($category == 3) {
            $is_engineer = (isset($data['chk-is-engineer'])) ? true : false;
        }

        else $is_engineer = false;

        if ($user->exists()) {
            // Validate user
            $custom_messages = [
                'required' => 'Preencha o campo :attribute.',
                'string' =>  'O campo :attribute é inválido.',
                'regex' =>  'Preencha o campo :attribute corretamente.',
                'unique' => ':attribute já cadastrado no sistema.',
            ];

            $attributes = [
                'name' => 'Nome',
                'email' => 'Email',
                'password' => 'Senha',
                'category' => 'Categoria',
                'status' => 'Status',
                'professional-title' => 'Título Profissional',
                'professional-registration' => 'Nº do Registro Profissional',
                'professional-state' => 'UF',
                'phone' => 'Telefone Fixo',
                'cellphone' => 'Telefone Celular',
                'cep' => 'CEP',
                'address' => 'Endereço',
                'number' => 'Número',
                'neighborhood' => 'Bairro',
                'city' => 'Cidade',
                'state' => 'Estado',
            ];

            $validator = Validator::make($data, [
                'name' => [
                    'required', 'string', 'min:5', 'max:255'
                ],
                'email' => [
                    'required', 'string', 'max:255', 'regex:/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i', Rule::unique('user')->ignore($user)
                ],
                'password' => [
                    Rule::requiredIf($request->request->has('password') && $data['password'] != null),
                ],
                'category' => [
                    'required', 'string'
                ],
                'status' => [
                    'required', 'string'
                ],
                'professional-title' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
                'professional-registration' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
                'professional-state' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
                'phone' => [
                    'nullable', Rule::requiredIf(($is_engineer) && $data['phone'] != null), 'string',
                ],
                'cellphone' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string',
                ],
                'cep' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
                'address' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
                'number' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
                'neighborhood' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
                'city' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
                'state' => [
                    'nullable', Rule::requiredIf($is_engineer), 'string'
                ],
            ], $custom_messages, $attributes);

            if ($validator->fails()) {
                foreach ($validator->getMessageBag()->getMessages() as $error) {
                    return back()->withInput($data)->with('error', $error[0]);
                }
            }

            else {
                if (strlen($data['password']) > 0) {
                    $password = Hash::make($data['password']);
                    $user->password = $password;
                }
                
                $name = ucwords(mb_strtolower($data['name'], 'UTF-8'));

                // Engineer data
                if ($is_engineer) {
                    $professional_title = ucwords(mb_strtolower($data['professional-title'], 'UTF-8'));
                    $professional_registration = $data['professional-registration'];
                    $professional_state = $data['professional-state'];
                    $phone = $data['phone'];
                    $cellphone = $data['cellphone'];
                    $cep = $data['cep'];
                    $address = $data['address'];
                    $number = $data['number'];
                    $neighborhood = $data['neighborhood'];
                    $city = $data['city'];
                    $state = $data['state'];
                }

                else {
                    $professional_title = null;
                    $professional_registration = null;
                    $professional_state = null;
                    $phone = null;
                    $cellphone = null;
                    $cep = null;
                    $address = null;
                    $number = null;
                    $neighborhood = null;
                    $city = null;
                    $state = null;
                }

                // Update user data
                $user->name = $name;
                $user->email = $data['email'];
                $user->category_id = $category;
                $user->status = $status;
                $user->is_engineer = $is_engineer;
                $user->professional_title = $professional_title;
                $user->professional_registration = $professional_registration;
                $user->professional_state = $professional_state;
                $user->phone = $phone;
                $user->cellphone = $cellphone;
                $user->cep = $cep;
                $user->address = $address;
                $user->number = $number;
                $user->neighborhood = $neighborhood;
                $user->city = $city;
                $user->state = $state;
                $user->save();

                return redirect('/users')->with('success', 'Usuário atualizado com sucesso.');
            }
        }

        else return back()->withInput()->with('error', 'Usuário não encontrado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
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

        $user = User::find($id);

        if ($user != null) {
            $logout = ($user->id == Auth::id()) ? true : false;
            $user->delete();

            if ($logout) return redirect('/logout');

            return back()->withInput()
                ->with('success', 'O usuário foi excluído com sucesso.');
        }
        
        else return redirect('/');
    }

    public function validate_email()
    {
        $request = Request::capture();
        $data = $request->all();
        $email = $data['email'];

        $user = User::where('email', $email)->first();

        $status = ($user) ? true : false;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        return response()->json([
            'exist_user' => $status,
            'validated_fail' => $validator->fails()
        ]);
    }

    public function validate_email_user()
    {
        $request = Request::capture();
        $data = $request->all();
        $email = $data['email'];
        $id = $data['user'];

        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/users')->withInput()->with('error', 'Ocorreu um erro ao atualziar o usuário.');
        }

        $user = User::where('email', $email)->where('id', '!=', $id)->first();
        $status = ($user) ? true : false;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'user' => 'required',
        ]);

        return response()->json([
            'exist_user' => $status,
            'validated_fail' => $validator->fails()
        ]);
    }

}
