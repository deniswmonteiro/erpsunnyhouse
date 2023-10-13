@section('page_title', 'Editar Cliente')

<script src="{{asset(mix('js/clients/edit.js')) }}" defer></script>
<script>
    var url_ajax_email = "{{route('clients_validate_email_client')}}";
    var client = "{{encrypt($client->id)}}";
    var clientHasCredentials = @json($client_has_credentials);
    var isCorporateClient = @json($is_corporate_client);
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edição de Cliente</h3>
                <p class="text-subtitle text-muted">Edite os dados do cliente selecionado.</p>
            </div>
        </div>
    </x-slot>

    <div>
        <!-- Client Informations -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Documentos do Cliente</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- CNH -->
                    @include ('clients.editClientDocument', [
                        'type' => 'cnh',
                        'label' => 'CNH',
                        'name' => 'file_cnh_name',
                        'path' => 'file_cnh_path',
                    ])

                    <!-- Procuration -->
                    @include ('clients.editClientDocument', [
                        'type' => 'procuration',
                        'label' => 'Procuração',
                        'name' => 'file_procuration_name',
                        'path' => 'file_procuration_path',
                    ])
                </div>
                <div class="@if (!$client->is_corporate) d-none @endif" id="document-corporate-client">
                    <div class="row">
                        <!-- CNPJ -->
                        @include ('clients.editClientDocument', [
                            'type' => 'cnpj',
                            'label' => 'CNPJ',
                            'name' => 'file_cnpj_name',
                            'path' => 'file_cnpj_path',
                        ])

                        <!-- Social Contract -->
                        @include ('clients.editClientDocument', [
                            'type' => 'socialcontract',
                            'label' => 'Contrato Social',
                            'name' => 'file_social_contract_name',
                            'path' => 'file_social_contract_path',
                        ])
                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('clients_update', ['id' => encrypt($client->id)])}}" method="POST"
            id="form-edit-client"
            onsubmit="return false">
            @csrf

            <!-- Profile Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Perfil</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Checkbox change client type -->
                        <div class="col-12 mb-2" id="user-data-client">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <label for="chk-change-client-type" class="form-check-label">
                                        Pessoa Jurídica
                                    </label>
                                    <input class="form-check-input" type="checkbox"
                                        id="chk-change-client-type"
                                        name="chk-change-client-type"
                                        @if ($client->is_corporate) checked @endif
                                        onchange="return window.checkClientType(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="@if (!$client->is_corporate) d-none @endif" id="corporate-client">
                        <div class="row">
                            <!-- Corporate Name -->
                            <div class="col-12 col-md-9 mb-3">
                                <div class="form-group">
                                    <label for="client-corporatename" class="form-label">
                                        Razão Social
                                    </label>
                                    <input class="form-control" type="text"
                                        id="client-corporatename"
                                        name="client-corporatename"
                                        value="{{$client->corporate_name}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback" id="client-feedback-corporatename-edit"></div>
                                </div>
                            </div>

                            <!-- CNPJ -->
                            <div class="col-12 col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="client-corporatecnpj" class="form-label">CNPJ</label>
                                    <input class="form-control" type="text"
                                        id="client-corporatecnpj"
                                        name="client-corporatecnpj"
                                        value="{{$client->cnpj}}"
                                        onchange="return window.validateIdentification(this, 14)"
                                        onblur="return window.validateIdentification(this, 14)"
                                        onkeyup="return window.validateIdentification(this, 14)">
                                    <div class="invalid-feedback" id="client-feedback-corporatecnpj-edit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Name -->
                        <div class="col-12 col-md-5 mb-3">
                            <div class="form-group">
                                <label for="client-name" class="form-label">Nome</label>
                                <input class="form-control" type="text" 
                                    id="client-name" 
                                    name="client-name"
                                    value="{{($client->name)}}"
                                    onchange="return window.validateInput(this, 5)"
                                    onblur="return window.validateInput(this, 5)"
                                    onkeyup="return window.validateInput(this, 5)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-name-edit"></div>
                            </div>
                        </div>

                        <!-- Birth Date -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="client-birth" class="form-label">
                                    Data de Nascimento
                                </label>
                                <div class="input-group">
                                    <input class="form-control date" type="date"
                                        id="client-birth"
                                        name="client-birth"
                                        value="{{$client->birth_date}}"
                                        min="1923-01-01"
                                        onchange="return window.validateDate(this)"
                                        onblur="return window.validateDate(this)"
                                        onkeyup="return window.validateDate(this)"
                                        required>
                                    </div>
                                <div class="invalid-feedback" id="client-feedback-birth-edit"></div>
                            </div>
                        </div>

                        <!-- CPF -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="client-cpf" class="form-label">CPF</label>
                                <input class="form-control" type="text"
                                    id="client-cpf"
                                    name="client-cpf"
                                    value="{{($client->cpf)}}"
                                    onchange="return window.validateIdentification(this, 11)"
                                    onblur="return window.validateIdentification(this, 11)"
                                    onkeyup="return window.validateIdentification(this, 11)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-cpf-edit"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Email -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="client-email" class="form-label">Email</label>
                                <input class="form-control" type="email"
                                    id="client-email"
                                    name="client-email"
                                    value="{{$client->email}}"
                                    onchange="return window.validateEmail(this)"
                                    onblur="return window.validateEmail(this)"
                                    onkeyup="return window.validateEmail(this)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-email-edit"></div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="client-phone" class="form-label">Telefone</label>
                                <input class="form-control" type="text" 
                                    id="client-phone"
                                    name="client-phone"
                                    value="{{$client->phone}}"
                                    onchange="return window.validatePhone(this, 10)"
                                    onblur="return window.validatePhone(this, 10)"
                                    onkeyup="return window.validatePhone(this, 10)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-phone-edit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Endereço</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- CEP -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="client-cep" class="form-label">CEP</label>
                                <div class="input-group">
                                    <input class="form-control rounded" type="text"
                                        id="client-cep"
                                        name="client-cep"
                                        value="{{$client->address_cep}}"
                                        onchange="return window.validateCep(this), window.fillInAddressFields(this)"
                                        onblur="return window.validateCep(this), window.fillInAddressFields(this)"
                                        required>
                                    <div class="input-group-text bg-white border-0 d-flex justify-content-center d-none"
                                        id="address-informations-loading">
                                        <span class="spinner-border text-primary spinner-border spinner-border-sm"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="invalid-feedback" id="client-feedback-cep-edit"></div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-12 col-md-7 mb-3">
                            <div class="form-group">
                                <label for="client-address" class="form-label">Endereço</label>
                                <input class="form-control" type="text"
                                    id="client-address"    
                                    name="client-address"
                                    value="{{($client->address)}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-address-edit"></div>
                            </div>
                        </div>

                        <!-- Number -->
                        <div class="col-12 col-md-2 mb-3">
                            <div class="form-group">
                                <label for="client-number" class="form-label">Número</label>
                                <input class="form-control" type="text"
                                    id="client-number"
                                    name="client-number"
                                    value="{{($client->address_number)}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-number-edit"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Complement -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="client-complement" class="form-label">Complemento</label>
                                <input class="form-control" type="text"
                                    id="client-complement"
                                    name="client-complement"
                                    value="{{($client->address_complement)}}">
                                <div class="invalid-feedback" id="client-feedback-complement-edit"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Neighborhood -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="client-neighborhood" class="form-label">Bairro</label>
                                <input class="form-control" type="text"
                                    id="client-neighborhood"
                                    name="client-neighborhood"
                                    value="{{$client->address_neighborhood}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-neighborhood-edit"></div>
                            </div>
                        </div>
                        
                        <!-- City -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="client-city" class="form-label">Cidade</label>
                                <input class="form-control" type="text"
                                    id="client-city"
                                    name="client-city"
                                    value="{{$client->address_city}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-city-edit"></div>
                            </div>
                        </div>

                        <!-- State -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="client-state" class="form-label">Estado</label>
                                <input class="form-control" type="text"
                                    id="client-state"
                                    name="client-state"
                                    value="{{$client->address_state}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-state-edit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Equatorial Credentials -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Credenciais Equatorial</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    id="chk-add-credentials"
                                    name="chk-add-credentials"
                                    @if ($client->login != null || $client->password != null) checked @endif
                                    onchange="return window.checkIfAddCredentials(this)">
                                <label class="form-check-label" for="chk-add-credentials">
                                    Adicionar credenciais de acesso?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="@if ($client->login == null || $client->password == null) d-none @endif"
                        id="credentials">
                        <div class="row">
                            <!-- Login -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="client-login" class="form-label">Login</label>
                                    <input type="text" class="form-control"
                                        id="client-login"
                                        name="client-login"
                                        value="{{($client->login)}}"
                                        onchange="return window.validateLogin(this)"
                                        onblur="return window.validateLogin(this)"
                                        onkeyup="return window.validateLogin(this)">
                                    <div class="invalid-feedback" id="client-feedback-login-edit"></div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="client-password" class="form-label">Senha</label>
                                    <input type="@if ($client->is_corporate) email @else date @endif" 
                                        class="form-control @if (!$client->is_corporate) date @endif"
                                        id="client-password"
                                        name="client-password"
                                        @if (!$client->is_corporate) min="1923-01-01" @endif
                                        onchange="return window.validatePassword(this)"
                                        onblur="return window.validatePassword(this)"
                                        onkeyup="return window.validatePassword(this)"
                                        disabled>
                                    <div class="invalid-feedback" id="client-feedback-password-edit"></div>

                                    <div class="form-check mt-3 @if ($client->login == null || $client->password == null) d-none @endif">
                                        <input class="form-check-input" type="checkbox"
                                            id="chk-change-password"
                                            name="chk-change-password"
                                            @if ($client->login == null || $client->password == null) checked @endif
                                            onchange="return window.checkChangePassword(this)">
                                        <label class="form-check-label" for="chk-change-password">
                                            Alterar senha?
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="btn-floating">
                        <a href="{{route('clients_index')}}"
                            class="btn btn-danger d-inline-flex align-items-center justify-content-center me-2">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                        </a>
                        <button type="button" class="btn btn-success"
                            id="btn-edit-client"
                            onclick="return window.submitFormEditClient()">
                            <i class="bi bi-save-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
