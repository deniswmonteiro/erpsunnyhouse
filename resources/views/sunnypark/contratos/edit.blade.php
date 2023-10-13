@section('page_title', 'Editar Contrato')

<script src="{{asset(mix('js/sunnypark/contratos/edit.js'))}}" defer></script>
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
                <h3>Editar Contratos</h3>
                <p class="text-subtitle text-muted">Edite os dados do contrato selecionado.</p>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
        <form id="form-update-contract" action="{{route('sunnypark_contratos_update', ['id' => encrypt($contrato->id)])}}" method="post">
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
                                    @if($contrato->client->is_corporate)
                                        value="{{$contrato->client->corporate_name}}"
                                    @else
                                        value="{{$contrato->client->name}}"
                                    @endif
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

                        <!-- Type -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="type" class="form-label">Tipo de Contrato <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="type" id="type" name="type"
                                    data-value="">
                                    <option value="" disabled selected>Escolha o tipo de contrato</option>
                                    <option value="flex" @if($contrato->tipo_contrato == "flex") selected @endif>Flex</option>
                                    <option value="poder" @if($contrato->tipo_contrato == "flex_plus") selected @endif>Flex Plus</option>
                                    <option value="normal" @if($contrato->tipo_contrato == "normal") selected @endif>Normal</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" aria-label="status" id="status" name="status"
                                    data-value="">
                                    <option value="" disabled selected>Escolha o status</option>
                                    <option value="minuta" @if($contrato->status == "minuta") selected @endif>Minuta</option>
                                    <option value="contratado" @if($contrato->status == "contratado") selected @endif>Contratado</option>
                                    <option value="ativo" @if($contrato->status == "ativo") selected @endif>Ativo</option>
                                </select>
                            </div>
                        </div>

                        <!-- Qtd KWH -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="quantidade" class="form-label">Quantidade <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="quantidade" type="text"
                                        name="quantidade"
                                        class="form-control"
                                        value="{{$contrato->qtd_kwh}}"
                                        onchange="return window.calculateQuota(this)"
                                        onblur="return window.calculateQuota(this)"
                                        required>
                                    <span class="input-group-text">KWH</span>
                                    <div class="invalid-feedback">
                                        Formato incorreto.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Potencia da quota -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="potencia" class="form-label">Potência da Quota <span class="text-danger">*</span></label>
                                <input id="potencia" type="text"
                                    name="potencia"
                                    value="{{$contrato->potencia_quota}}" 
                                    class="form-control"
                                    required readonly>
                                <div class="invalid-feedback">
                                    Formato incorreto.
                                </div>
                            </div>
                        </div>

                        <!-- Tempo vigencia -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-vigencia" class="form-label">Tempo de Vigência (mês) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="contract-vigencia" type="number" value="{{$contrato->tempo_vigencia}}"
                                        name="contract-vigencia"
                                        class="form-control date"
                                        required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Inicio vigencia -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-date" class="form-label">Inicio de Vigência <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="contract-date" type="date" value="{{$contrato->data_vigencia ?: date('Y-m-d', strToTime($contrato->data_vigencia))}}" 
                                        name="contract-date"
                                        class="form-control date"
                                        required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Valor -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="payment_value" class="form-label">Valor Base do Contrato <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input id="payment_value" type="text"
                                        name="payment_value"
                                        class="form-control money"
                                        value="{{$contrato->valor}}"
                                        data-xpc="{{format_money($contrato->valor)}}"
                                        required>
                                    <div class="invalid-feedback">
                                        Formato incorreto.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Desconto -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="desconto" class="form-label">Desconto (%) <span class="text-danger">*</span></label>
                                <input id="desconto" type="text" name="desconto" class="form-control" value="{{$contrato->desconto}}" required>
                            </div>
                        </div>

                        <!-- Tarifa Base -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="tarifa_base" class="form-label">Tarifa Base (R$) <span class="text-danger">*</span></label>
                                <input id="tarifa_base" type="text" name="tarifa_base" class="form-control" value="{{$contrato->tarifa_base}}" required>
                            </div>
                        </div>

                        <!-- Meta Gestão -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="meta_gestao" class="form-label">Meta Gestão (R$) <span class="text-danger">*</span></label>
                                <input id="meta_gestao" type="text" name="meta_gestao" class="form-control" value="{{$contrato->meta_gestao}}" required>
                            </div>
                        </div>
                    </div>
                    <button id="btn-generator" class="btn bg-success text-white float-end mt-3"
                        type="button"
                        onclick="window.submit_form_contract_create()">
                        Editar Contrato
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