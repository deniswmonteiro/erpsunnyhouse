@section('page_title', 'Adicionar Usuário')

<script src="{{asset(mix('js/users/create.js'))}}" defer></script>
<script>
    var url_fetch_email = "{{route('users_validate_email')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{_('Adicionar Usuário')}}</h3>
                <p class="text-subtitle text-muted">
                    {{_('Insira no formulário os dados do novo usuário.')}}
                </p>
                <p class="mt-5">
                    Preencher, obrigatoriamente, todos os campos com asterísco (<span class="text-danger">*</span>).
                </p>
            </div>
        </div>
    </x-slot>

    <div>
        <form action="{{route('store_user')}}" method="POST"
            class="mb-5"
            id="form-create-user"
            onsubmit="return false">
            @csrf

            <!-- Access Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Acesso</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Name -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    Nome Completo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="name"
                                    name="name"
                                    value="{{old('name')}}"
                                    onblur="return window.validateName(this)"
                                    onchange="return window.validateName(this)"
                                    onkeyup="return window.validateName(this)"
                                    required>
                                <div class="invalid-feedback" id="name-feedback-user"></div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="email"
                                    id="email"
                                    name="email"
                                    value="{{old('email')}}"
                                    onblur="return window.validateEmail(this)"
                                    onchange="return window.validateEmail(this)"
                                    onkeyup="return window.validateEmail(this)"
                                    required>
                                <div class="invalid-feedback" id="email-feedback-user"></div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    Senha <span class="text-danger">*</span>
                                </label>
                                <div class="input-group" id="show-hide-password">
                                    <input class="form-control" type="password"
                                        id="password"
                                        name="password"
                                        onblur="return window.validatePassword(this)"
                                        onchange="return window.validatePassword(this)"
                                        onkeyup="return window.validatePassword(this)"
                                        required>
                                    <button type="button" class="input-group-text btn btn-primary"
                                        onclick="return window.showHidePassword(this)">
                                        <i class="bi bi-eye-slash-fill"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="password-feedback-user"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Perfil</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Category -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="category" class="form-label">
                                    Categoria <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" aria-label="category"
                                    id="category"
                                    name="category"
                                    data-value="{{old('category')}}"
                                    onblur="return window.validateSelect(this), window.addEngineerData(this)"
                                    onchange="return window.validateSelect(this), window.addEngineerData(this)">
                                    <option value="" disabled selected>
                                        Escolha a categoria
                                    </option>
                                    <option value="{{encrypt(1)}}">
                                        Administrador
                                    </option>
                                    <option value="{{encrypt(2)}}">
                                        Engenharia
                                    </option>
                                    <option value="{{encrypt(3)}}">
                                        Operacional
                                    </option>
                                    <option value="{{encrypt(4)}}">
                                        Técnico
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="category-feedback-user"></div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="status" class="form-label">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" aria-label="status"
                                    id="status"
                                    name="status"
                                    data-value="{{old('status')}}"
                                    onblur="return window.validateSelect(this)"
                                    onchange="return window.validateSelect(this)">
                                    <option value="" disabled selected>
                                        Escolha o status
                                    </option>
                                    <option value="{{encrypt('true')}}">
                                        Ativo
                                    </option>
                                    <option value="{{encrypt('false')}}">
                                        Bloqueado
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="status-feedback-user"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-none mt-4 mb-3" id="is-engineer">
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    id="chk-is-engineer"
                                    name="chk-is-engineer"
                                    onchange="return window.checkIfEngineerData(this)">
                                <label class="form-check-label" for="chk-is-engineer">
                                    Adicionar dados do engenheiro?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-none" id="engineer-data">
                        <div class="row">
                            <!-- Professional Title -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="professional-title" class="form-label">
                                        Título Profissional <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text"
                                        id="professional-title"
                                        name="professional-title"
                                        value="{{old('professional-title')}}"
                                        onblur="return window.validateInput(this, 2)"
                                        onchange="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback" id="professional-title-feedback-user"></div>
                                </div>
                            </div>

                            <!-- Professional Registration Number -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="professional-registration" class="form-label">
                                        Nº do Registro Profissional <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text"
                                        id="professional-registration"
                                        name="professional-registration"
                                        value="{{old('professional-registration')}}"
                                        onblur="return window.validateInput(this, 2)"
                                        onchange="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback" id="professional-registration-feedback-user"></div>
                                </div>
                            </div>

                            <!-- Professional State -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="professional-state" class="form-label">
                                        UF <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" aria-label="professional-state"
                                        id="professional-state"
                                        name="professional-state"
                                        data-value="{{old('professional-state')}}"
                                        onblur="return window.validateSelect(this)"
                                        onchange="return window.validateSelect(this)">
                                        <option value="" disabled selected>
                                            Escolha o estado
                                        </option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                    <div class="invalid-feedback" id="professional-state-feedback-user"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Phone -->
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="phone" class="form-label">
                                        Telefone Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="phone"
                                        name="phone"
                                        value="{{old('phone')}}"
                                        onblur="return window.validatePhone(this)"
                                        onchange="return window.validatePhone(this)"
                                        onkeyup="return window.validatePhone(this)">
                                    <div class="invalid-feedback" id="phone-feedback-user"></div>
                                </div>
                            </div>

                            <!-- Cellphone -->
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="cellphone" class="form-label">
                                        Telefone Celular <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text"
                                        id="cellphone"
                                        name="cellphone"
                                        value="{{old('cellphone')}}"
                                        onblur="return window.validatePhone(this)"
                                        onchange="return window.validatePhone(this)"
                                        onkeyup="return window.validatePhone(this)">
                                    <div class="invalid-feedback" id="cellphone-feedback-user"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- CEP -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="cep" class="form-label">
                                        CEP <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text"
                                        id="cep"
                                        name="cep"
                                        value="{{old('cep')}}"
                                        onchange="return window.fillInAddressFields(this), window.validateCep(this)"
                                        onblur="return window.fillInAddressFields(this), window.validateCep(this)">
                                    <div class="invalid-feedback" id="cep-feedback-user"></div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-12 col-lg-7 mb-3">
                                <div class="form-group">
                                    <label for="address" class="form-label">
                                        Endereço <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text"
                                        id="address"
                                        name="address"
                                        value="{{old('address')}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback"
                                        id="address-feedback-user"></div>
                                </div>
                            </div>

                            <!-- Number -->
                            <div class="col-12 col-lg-2 mb-3">
                                <div class="form-group">
                                    <label for="number" class="form-label">
                                        Número/Apt. <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text"
                                        id="number"
                                        name="number"
                                        value="{{old('number')}}"
                                        onchange="return window.validateInput(this, 1)"
                                        onblur="return window.validateInput(this, 1)"
                                        onkeyup="return window.validateInput(this, 1)">
                                    <div class="invalid-feedback" id="number-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Neighborhood -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="neighborhood" class="form-label">
                                        Bairro <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text"
                                        id="neighborhood"
                                        name="neighborhood"
                                        value="{{old('neighborhood')}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback"
                                        id="neighborhood-feedback-user"></div>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="city" class="form-label">
                                        Cidade <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text"
                                        id="city"
                                        name="city"
                                        value="{{old('city')}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <div class="invalid-feedback" id="city-feedback-user"></div>
                                </div>
                            </div>

                            <!-- State -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="state" class="form-label">
                                        Estado <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" aria-label="state"
                                        id="state"
                                        name="state"
                                        data-value="{{old('state')}}"
                                        onchange="return window.validateSelect(this)"
                                        onblur="return window.validateSelect(this)">
                                        <option value="" disabled selected>
                                            Escolha o estado
                                        </option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                    <div class="invalid-feedback" id="state-feedback-user"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-end mt-5">
                        <a href="{{route('users_index')}}" class="btn bg-danger text-white me-2">
                            Cancelar
                        </a>
                        <button type="button"
                            class="btn bg-success text-white d-inline-flex align-items-center"
                            id="btn-create-user"
                            onclick="window.submitFormUserCreate()">
                            Adicionar Usuário
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>