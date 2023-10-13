@section('page_title', 'Adicionar Contas Contratos')

<script src="{{asset(mix('js/sunnypark/contascontratos/create.js'))}}" defer></script>
<script>
    var url_ajax_email_client = "{{route('clients_validate_email')}}";
    var url_ajax_store_client = "{{route('clients_store_ajax')}}";
    var url_ajax_client_validate_name = "{{route('clients_validate_name')}}";

    var clients = @json($clients);
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Adicionar Contas Contratos</h3>
                <p class="text-subtitle text-muted">Insira no formulário os dados da nova conta contrato.</p>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
    	<form id="form-create-contract" action="{{route('sunnypark_contascontratos_store')}}" method="post">
            @csrf

            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">Informações de Perfil</h4>
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <!-- Client -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="client" class="form-label">Cliente <span class="text-danger">*</span></label>
                                <input id="client" type="text"
                                    name="client"
                                    value=""
                                    class="form-control"
                                    autocomplete="off" required>
                                <div class="invalid-feedback">
                                    <button id="new_client" type="button" class="btn btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal_new_client"
                                        onclick="return window.handleClientNameOnNewClientModal()">
                                        Inserir Cliente
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- CC -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="unidade" class="form-label">Código da unidade consumidora <span class="text-danger">*</span></label>
                                <input id="unidade" type="text" name="unidade" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Apelido -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="apelido" class="form-label">Apelido <span class="text-danger">*</span></label>
                                <input id="apelido" type="text" name="apelido" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Classificação -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="classificacao" class="form-label">Classificação <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="classificacao" id="classificacao" name="classificacao" data-value="">
                                    <option value="" disabled selected></option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="A3a">A3a</option>
                                    <option value="A4">A4</option>
                                    <option value="AS">AS</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="B4">B4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tipo -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="tipo" class="form-label">Tipo <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="tipo" id="tipo" name="tipo" data-value="">
                                    <option value="" disabled selected></option>
                                    <option value="comercial">Comercial</option>
                                    <option value="rural">Rural Agroindustrial</option>
                                    <option value="residencial">Residencial</option>
                                    <option value="comercial_outro">Comercial Outros Serviços e Outras Atividades</option>
                                    <option value="comercial_servicos">Comercial Serviços de Comunicações e Telecomunicações</option>
                                    <option value="industrial">Industrial Industrial</option>
                                    <option value="rural_agro">Rural Agropecuária Rural</option>
                                    <option value="poder">Poder público Federal</option>
                                </select>
                            </div>
                        </div>

                        <!-- Modalidade -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="modalidade" class="form-label">Modalidade tarifária <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="modalidade" id="modalidade" name="modalidade" data-value="">
                                    <option value="" disabled selected></option>
                                    <option value="convencional">Convencional</option>
                                    <option value="branca">Tárifa Branca</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button id="btn-generator" class="btn bg-success text-white float-end mt-3"
                        type="button"
                        onclick="window.submit_form_contract_create()">
                        Criar Conta Contrato
                    </button>
                </div>
            </div>   
        </form>
    </div>

    <!-- Modal Client -->
    <div class="modal fade w-100" id="modal_new_client"
         style="color: black"
         tabindex="-1" role="dialog" aria-hidden="true"
         aria-labelledby="modal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insira os dados do cliente</h5>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="#" method="post" onsubmit="return false">
                            <div class="card">
                                <div class="card-header" style="padding-top: 0; padding-bottom: 0">
                                    <h4 class="card-title">Informações de Perfil</h4>
                                </div>
                                <div class="card-body">
                                    <!--Checkbox CPF -->
                                    <div class="col-12 col-md-12 mb-4" id="user_data_client">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="client-checkbox-type">
                                                    Pessoa Jurídica
                                                </label>
                                                <input class="form-check-input" type="checkbox"
                                                    id="client-checkbox-type"
                                                    name="checkbox_is_pj"
                                                    value="{{old('checkbox_is_pj')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Corporate Name -->
                                    <div class="form-group mb-3 d-none">
                                        <label for="client-corporate-name" class="form-label">Razão Social</label>
                                        <input type="text" name="client-corporate-name" id="client-corporate-name"
                                            value="{{old('client-corporate-name')}}"
                                            class="form-control">
                                        <div class="invalid-feedback">
                                            Formato incorreto.
                                        </div>
                                    </div>

                                    <!-- CNPJ -->
                                    <div class="form-group mb-3 d-none">
                                        <label for="client-cnpj" class="form-label">CNPJ</label>
                                        <input id="client-cnpj" type="text" value="{{old('client-cnpj')}}"
                                            name="client-cnpj"
                                            class="form-control">
                                        <div class="invalid-feedback">
                                            Formato inválido.
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="form-group mb-3">
                                        <label for="client-name" class="form-label">Nome</label>
                                        <input id="client-name" type="text" value=""
                                            name="client-name"
                                            class="form-control" required minlength="5">
                                        <div class="invalid-feedback" id="name-feedback-client">
                                            Mínimo de 5 Caracterres.
                                        </div>
                                    </div>

                                    <!-- CPF -->
                                    <div class="form-group mb-3">
                                        <label for="client-cpf" class="form-label">CPF</label>
                                        <input id="client-cpf" type="text" value=""
                                            name="client-cpf"
                                            class="form-control"
                                            required>
                                        <div class="invalid-feedback" id="client-cpf-feedback">
                                            Formato inválido.
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group mb-3">
                                        <label for="client-email" class="form-label">E-mail</label>
                                        <input type="email" name="client-email" id="client-email" value=""
                                            class="form-control" required>
                                        <div class="invalid-feedback" id="client-email-feedback">
                                            Formato incorreto.
                                        </div>
                                    </div>

                                    <!-- Telefone -->
                                    <div class="form-group mb-3">
                                        <label for="client-phone" class="form-label">Telefone</label>
                                        <input id="client-phone" type="text" value="" name="client-phone"
                                            class="form-control" required>
                                        <div class="invalid-feedback">
                                            Formato incorreto.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" style="padding-top: 0; padding-bottom: 0">
                                    <h4 class="card-title">Informações de Endereço</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- CEP -->
                                        <div class="form-group col-12 col-md-12 col-lg-2 mb-3">
                                            <label for="client-cep" class="form-label">CEP</label>
                                            <input type="text" name="client-cep" id="client-cep"
                                                value="" class="form-control" required>
                                        </div>

                                        <!-- Endereço -->
                                        <div class="form-group col-12 col-md-12 col-lg-8 mb-3">
                                            <label for="client-address" class="form-label">Endereço</label>
                                            <input type="text" name="client-address" id="client-address"
                                                value="" class="form-control" required>
                                        </div>

                                        <!-- Numero -->
                                        <div class="form-group col-12 col-md-12 col-lg-2 mb-3">
                                            <label for="client-number" class="form-label">Número/Apt</label>
                                            <input type="text" name="client-number" id="client-number"
                                                value="" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- neighborhood -->
                                        <div class="form-group col-12 col-md-12 col-lg-4 mb-3">
                                            <label for="client-neighborhood" class="form-label">Bairro</label>
                                            <input type="text" name="client-neighborhood" id="client-neighborhood"
                                                value="" class="form-control" required>
                                        </div>

                                        <!-- City -->
                                        <div class="form-group col-12 col-md-12 col-lg-4 mb-3">
                                            <label for="client-city" class="form-label">Cidade</label>
                                            <input type="text" name="client-city" id="client-city"
                                                value="" class="form-control" required>
                                        </div>

                                        <!-- State -->
                                        <div class="form-group col-12 col-md-12 col-lg-4 mb-3">
                                            <label for="client-state" class="form-label">Estado</label>
                                            <input type="text" name="client-state" id="client-state"
                                                value="" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Complemento -->
                                        <div class="form-group col-12 col-md-12 col-lg-12 mb-3">
                                            <label for="client-complement">Complemento</label>
                                            <input type="text" name="client-complement" id="client-complement"
                                                value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header pt-0 pb-0">
                                    <h4 class="card-title">Credenciais Equatorial</h4>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mt-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                id="chk-add-credentials"
                                                name="chk-add-credentials"
                                                @if(old('chk-add-credentials') === 'on') checked @endif
                                                onchange="return window.checkIfAddCredentials(this)">
                                            <label class="form-check-label" for="chk-add-credentials">
                                                Adicionar credenciais de acesso?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-none" id="credentials">
                                        <div class="row">
                                            <!-- Login -->
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="client-login" class="form-label">Login</label>
                                                    <input type="text" class="form-control"
                                                        name="client-login"
                                                        id="client-login"
                                                        value="{{old('client-login')}}"
                                                        onchange="return window.validateLogin(this)"
                                                        onblur="return window.validateLogin(this)"
                                                        onkeyup="return window.validateLogin(this)">
                                                    <div class="invalid-feedback" id="login-feedback-create-client"></div>
                                                </div>
                                            </div>
                    
                                            <!-- Password -->
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="client-password" class="form-label">Senha</label>
                                                    <input type="date"
                                                        class="form-control date"
                                                        name="client-password"
                                                        id="client-password"
                                                        onchange="return window.validatePassword(this)"
                                                        onblur="return window.validatePassword(this)"
                                                        onkeyup="return window.validatePassword(this)">
                                                    <div class="invalid-feedback"
                                                        id="password-feedback-create-client"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Voltar
                    </button>
                    <form action="#" onsubmit="return false"
                        method="post" style="margin-block-end: 0!important;">
                        <button class="btn bg-success text-white"
                            type="button" id="btn-create-client">
                            Cadastrar Cliente
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>