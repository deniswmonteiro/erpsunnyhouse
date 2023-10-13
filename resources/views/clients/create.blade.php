@section('page_title', 'Adicionar Cliente')

<script src="{{asset(mix('js/clients/create.js')) }}" defer></script>
<script>
    var url_ajax_email = "{{route('clients_validate_email')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{_('Cadastrar Cliente')}}</h3>
                <p class="text-subtitle text-muted">
                    {{_('Insira no formulário os dados do novo cliente.')}}
                </p>
            </div>
        </div>
    </x-slot>

    <div>
        <form action="{{route('clients_store')}}" method="POST"
            enctype="multipart/form-data"
            id="form-create-client"
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
                        <div class="col-12 mb-4">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <label for="chk-change-client-type" class="form-check-label">
                                        Pessoa Jurídica
                                    </label>
                                    <input class="form-check-input" type="checkbox" 
                                        id="chk-change-client-type"
                                        name="chk-change-client-type" 
                                        value="{{old('chk-change-client-type')}}"
                                        onchange="return window.checkClientType(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="corporate-client">
                        <div class="row">
                            <!-- Corporate Name -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="client-corporatename" class="form-label">
                                        Razão Social
                                    </label>
                                    <input class="form-control" type="text"
                                        id="client-corporatename"
                                        name="client-corporatename"
                                        value="{{old('client-corporatename')}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback" id="client-feedback-corporatename-create"></div>
                                </div>
                            </div>

                            <!-- CNPJ -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="client-corporatecnpj" class="form-label">CNPJ</label>
                                    <input class="form-control" type="text"
                                        id="client-corporatecnpj"
                                        name="client-corporatecnpj"
                                        value="{{old('client-corporatecnpj')}}"
                                        onchange="return window.validateIdentification(this, 14)"
                                        onblur="return window.validateIdentification(this, 14)"
                                        onkeyup="return window.validateIdentification(this, 14)">
                                    <div class="invalid-feedback" id="client-feedback-corporatecnpj-create"></div>
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
                                    value="{{old('client-name')}}"
                                    onchange="return window.validateInput(this, 5)"
                                    onblur="return window.validateInput(this, 5)"
                                    onkeyup="return window.validateInput(this, 5)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-name-create"></div>
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
                                        value="{{old('client-birth')}}"
                                        min="1923-01-01"
                                        onchange="return window.validateDate(this)"
                                        onblur="return window.validateDate(this)"
                                        onkeyup="return window.validateDate(this)"
                                        required>
                                </div>
                                <div class="invalid-feedback" id="client-feedback-birth-create"></div>
                            </div>
                        </div>

                        <!-- CPF -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="client-cpf" class="form-label">CPF</label>
                                <input class="form-control" type="text"
                                    id="client-cpf"
                                    name="client-cpf"
                                    value="{{old('client-cpf')}}"
                                    onchange="return window.validateIdentification(this, 11)"
                                    onblur="return window.validateIdentification(this, 11)"
                                    onkeyup="return window.validateIdentification(this, 11)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-cpf-create"></div>
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
                                    value="{{old('client-email')}}"
                                    onchange="return window.validateEmail(this)"
                                    onblur="return window.validateEmail(this)"
                                    onkeyup="return window.validateEmail(this)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-email-create"></div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="client-phone" class="form-label">Telefone</label>
                                <input class="form-control" type="text"
                                    id="client-phone"
                                    name="client-phone"
                                    value="{{old('client-phone')}}"
                                    onchange="return window.validatePhone(this, 10)"
                                    onblur="return window.validatePhone(this, 10)"
                                    onkeyup="return window.validatePhone(this, 10)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-phone-create"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações do Cliente</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- CNH -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="file-cnh" class="form-label">CNH</label>
                                <input class="form-control" type="file"
                                    id="file-cnh" 
                                    name="file-cnh"
                                    value="{{old('file-cnh')}}" 
                                    onchange="return window.validateFile(this)"
                                    onblur="return window.validateFile(this)">
                                <div class="invalid-feedback" id="file-cnh-feedback"></div>
                            </div>
                        </div>

                        <!-- Procuration -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="file-procuration" class="form-label">Procuração</label>
                                <input class="form-control" type="file"
                                    id="file-procuration" 
                                    name="file-procuration"
                                    value="{{old('file-procuration')}}" 
                                    onchange="return window.validateFile(this)"
                                    onblur="return window.validateFile(this)">
                                <div class="invalid-feedback" id="file-procuration-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="document-corporate-client">
                        <div class="row">
                            <!-- CNPJ -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="file-cnpj" class="form-label">CNPJ</label>
                                    <input class="form-control" type="file"
                                        id="file-cnpj" 
                                        name="file-cnpj"
                                        value="{{old('file-cnpj')}}" 
                                        onchange="return window.validateFile(this)"
                                        onblur="return window.validateFile(this)">
                                    <div class="invalid-feedback" id="file-cnpj-feedback"></div>
                                </div>
                            </div>

                            <!-- Social Contract -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="file-socialcontract" class="form-label">
                                        Contrato Social
                                    </label>
                                    <input class="form-control" type="file"
                                        id="file-socialcontract" 
                                        name="file-socialcontract"
                                        value="{{old('file-socialcontract')}}" 
                                        onchange="return window.validateFile(this)"
                                        onblur="return window.validateFile(this)">
                                    <div class="invalid-feedback" id="file-socialcontract-feedback"></div>
                                </div>
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
                                        value="{{old('client-cep')}}"
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
                                <div class="invalid-feedback" id="client-feedback-cep-create"></div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-12 col-md-7 mb-3">
                            <div class="form-group">
                                <label for="client-address" class="form-label">Endereço</label>
                                <input class="form-control" type="text"
                                    id="client-address"
                                    name="client-address"
                                    value="{{old('client-address')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-address-create"></div>
                            </div>
                        </div>

                        <!-- Number -->
                        <div class="col-12 col-md-2 mb-3">
                            <div class="form-group">
                                <label for="client-number" class="form-label">Número</label>
                                <input class="form-control" type="text"
                                    id="client-number"
                                    name="client-number"
                                    value="{{old('client-number')}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-number-create"></div>
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
                                    value="{{old('client-complement')}}">
                                <div class="invalid-feedback" id="client-feedback-complement-create"></div>
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
                                    value="{{old('client-neighborhood')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-neighborhood-create"></div>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="client-city" class="form-label">Cidade</label>
                                <input class="form-control" type="text"
                                    id="client-city"
                                    name="client-city"
                                    value="{{old('client-city')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-city-create"></div>
                            </div>
                        </div>

                        <!-- State -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="client-state" class="form-label">Estado</label>
                                <input class="form-control" type="text"
                                    id="client-state"
                                    name="client-state"
                                    value="{{old('client-state')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="client-feedback-state-create"></div>
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
                                    @if (old('chk-add-credentials') === 'on') checked @endif
                                    onchange="return window.checkIfAddCredentials(this)">
                                <label class="form-check-label" for="chk-add-credentials">
                                    Adicionar credenciais de acesso?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="credentials">
                        <div class="row">
                            <!-- Login -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="client-login" class="form-label">Login</label>
                                    <input type="text" class="form-control"
                                        id="client-login"
                                        name="client-login"
                                        value="{{old('client-login')}}"
                                        onchange="return window.validateLogin(this)"
                                        onblur="return window.validateLogin(this)"
                                        onkeyup="return window.validateLogin(this)">
                                    <div class="invalid-feedback" id="client-feedback-login-create"></div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="client-password" class="form-label">Senha</label>
                                    <input type="date" class="form-control date"
                                        id="client-password"
                                        name="client-password"
                                        value="{{old('client-password')}}"
                                        min="1923-01-01"
                                        onchange="return window.validatePassword(this)"
                                        onblur="return window.validatePassword(this)"
                                        onkeyup="return window.validatePassword(this)">
                                    <div class="invalid-feedback" id="client-feedback-password-create"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="float-end mt-5">
                        <a href="{{route('clients_index')}}" class="btn bg-danger text-white me-2">
                            Cancelar
                        </a>
                        <button type="button"
                            class="btn bg-success text-white d-inline-flex align-items-center"
                            id="btn-create-client"
                            onclick="window.submitFormCreateClient()">
                            Criar Cliente

                            <div class="spinner-border spinner-border-sm text-white ms-2 d-none"
                                id="btn-create-client-loading"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
