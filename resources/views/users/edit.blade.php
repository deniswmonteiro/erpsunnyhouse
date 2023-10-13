@section('page_title', 'Editar Usuário')

<script src="{{asset(mix('js/users/edit.js'))}}" defer></script>
<script>
    var url_fetch_email = "{{route('users_validate_email_user')}}";
    var user = "{{encrypt($user->id)}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{_('Editar Usuário')}}</h3>
                <p class="text-subtitle text-muted">
                    {{_('Edite os dados do usuário selecionado.')}}
                </p>
                <p class="mt-5">
                    Preencher, obrigatoriamente, todos os campos com asterísco (<span class="text-danger">*</span>).
                </p>
            </div>
        </div>
    </x-slot>

    <div>
        <form action="{{route('update_user', ['id' => encrypt($user->id)])}}" method="POST"
            class="mb-5"
            id="form-update-user"
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
                                <label for="name" class="form-label">Nome</label>
                                <input class="form-control" type="text"
                                    id="name"
                                    name="name"
                                    value="{{($user->name)}}"
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
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="email"
                                    id="email"
                                    name="email"
                                    value="{{$user->email}}"
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
                                <label for="password" class="form-label">Senha</label>
                                <div class="input-group" id="show-hide-password">
                                    <input class="form-control" type="password"
                                        id="password"
                                        name="password"
                                        onblur="return window.validatePassword(this)"
                                        onchange="return window.validatePassword(this)"
                                        onkeyup="return window.validatePassword(this)">
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
                                <label for="categoria" class="form-label">
                                    Categoria
                                </label>
                                <select class="form-select" aria-label="category"
                                    id="category"
                                    name="category"
                                    onblur="return window.validateSelect(this), window.addEngineerData(this)"
                                    onchange="return window.validateSelect(this), window.addEngineerData(this)">
                                    <option value="" disabled selected>
                                        Escolha a categoria
                                    </option>
                                    <option value="{{encrypt(1)}}" {{$user->category_id == 1 ? 'selected' : ''}}>
                                        Administrador
                                    </option>
                                    <option value="{{encrypt(2)}}" {{$user->category_id == 2 ? 'selected': ''}}>
                                        Engenharia
                                    </option>
                                    <option value="{{encrypt(3)}}" {{$user->category_id == 3 ? 'selected' : ''}}>
                                        Operacional
                                    </option>
                                    <option value="{{encrypt(4)}}" {{$user->category_id == 4 ? 'selected' : ''}}>
                                        Técnico
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="category-feedback-user"></div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" aria-label="status"
                                    id="status"
                                    name="status"
                                    onblur="return window.validateSelect(this)"
                                    onchange="return window.validateSelect(this)">
                                    <option value="" disabled selected>
                                        Escolha o status
                                    </option>
                                    <option value="{{encrypt('true')}}" {{$user->status? 'selected' : ''}}>
                                        Ativo
                                    </option>
                                    <option value="{{encrypt('false')}}" {{!$user->status? 'selected' : ''}}>
                                        Bloqueado
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="status-feedback-user"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row @if ($user->category_id != 3 && !$user->is_engineer) d-none @endif mt-4 mb-3"
                        id="is-engineer">
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    id="chk-is-engineer"
                                    name="chk-is-engineer"
                                    onchange="return window.checkIfEngineerData(this)"
                                    @if ($user->is_engineer) checked @endif>
                                <label class="form-check-label" for="chk-is-engineer">
                                    Adicionar dados do engenheiro?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="@if (!$user->is_engineer) d-none @endif" id="engineer-data">
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
                                        value="{{$user->professional_title}}"
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
                                        value="{{$user->professional_registration}}"
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
                                        onblur="return window.validateSelect(this)"
                                        onchange="return window.validateSelect(this)">
                                        <option value="" disabled selected>
                                            Escolha o estado
                                        </option>
                                        <option value="AC" {{$user->professional_state == 'AC' ? 'selected' : ''}}>
                                            AC
                                        </option>
                                        <option value="AL" {{$user->professional_state == 'AL' ? 'selected' : ''}}>
                                            AL
                                        </option>
                                        <option value="AP" {{$user->professional_state == 'AP' ? 'selected' : ''}}>
                                            AP
                                        </option>
                                        <option value="AM" {{$user->professional_state == 'AM' ? 'selected' : ''}}>
                                            AM
                                        </option>
                                        <option value="BA" {{$user->professional_state == 'BA' ? 'selected' : ''}}>
                                            BA
                                        </option>
                                        <option value="CE" {{$user->professional_state == 'CE' ? 'selected' : ''}}>
                                            CE
                                        </option>
                                        <option value="DF" {{$user->professional_state == 'DF' ? 'selected' : ''}}>
                                            DF
                                        </option>
                                        <option value="ES" {{$user->professional_state == 'ES' ? 'selected' : ''}}>
                                            ES
                                        </option>
                                        <option value="GO" {{$user->professional_state == 'GO' ? 'selected' : ''}}>
                                            GO
                                        </option>
                                        <option value="MA" {{$user->professional_state == 'MA' ? 'selected' : ''}}>
                                            MA
                                        </option>
                                        <option value="MT" {{$user->professional_state == 'MT' ? 'selected' : ''}}>
                                            MT
                                        </option>
                                        <option value="MS" {{$user->professional_state == 'MS' ? 'selected' : ''}}>
                                            MS
                                        </option>
                                        <option value="MG" {{$user->professional_state == 'MG' ? 'selected' : ''}}>
                                            MG
                                        </option>
                                        <option value="PA" {{$user->professional_state == 'PA' ? 'selected' : ''}}>
                                            PA
                                        </option>
                                        <option value="PB" {{$user->professional_state == 'PB' ? 'selected' : ''}}>
                                            PB
                                        </option>
                                        <option value="PR" {{$user->professional_state == 'PR' ? 'selected' : ''}}>
                                            PR
                                        </option>
                                        <option value="PE" {{$user->professional_state == 'PE' ? 'selected' : ''}}>
                                            PE
                                        </option>
                                        <option value="PI" {{$user->professional_state == 'PI' ? 'selected' : ''}}>
                                            PI
                                        </option>
                                        <option value="RJ" {{$user->professional_state == 'RJ' ? 'selected' : ''}}>
                                            RJ
                                        </option>
                                        <option value="RN" {{$user->professional_state == 'RN' ? 'selected' : ''}}>
                                            RN
                                        </option>
                                        <option value="RS" {{$user->professional_state == 'RS' ? 'selected' : ''}}>
                                            RS
                                        </option>
                                        <option value="RO" {{$user->professional_state == 'RO' ? 'selected' : ''}}>
                                            RO
                                        </option>
                                        <option value="RR" {{$user->professional_state == 'RR' ? 'selected' : ''}}>
                                            RR
                                        </option>
                                        <option value="SC" {{$user->professional_state == 'SC' ? 'selected' : ''}}>
                                            SC
                                        </option>
                                        <option value="SP" {{$user->professional_state == 'SP' ? 'selected' : ''}}>
                                            SP
                                        </option>
                                        <option value="SE" {{$user->professional_state == 'SE' ? 'selected' : ''}}>
                                            SE
                                        </option>
                                        <option value="TO" {{$user->professional_state == 'TO' ? 'selected' : ''}}>
                                            TO
                                        </option>
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
                                        value="{{$user->phone}}"
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
                                        value="{{$user->cellphone}}"
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
                                        value="{{$user->cep}}"
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
                                        value="{{$user->address}}"
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
                                        value="{{$user->number}}"
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
                                        value="{{$user->neighborhood}}"
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
                                        value="{{$user->city}}"
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
                                        onchange="return window.validateSelect(this)"
                                        onblur="return window.validateSelect(this)">
                                        <option value="" disabled selected>
                                            Escolha o estado
                                        </option>
                                        <option value="AC" {{$user->state == 'AC' ? 'selected' : ''}}>
                                            AC
                                        </option>
                                        <option value="AL" {{$user->state == 'AL' ? 'selected' : ''}}>
                                            AL
                                        </option>
                                        <option value="AP" {{$user->state == 'AP' ? 'selected' : ''}}>
                                            AP
                                        </option>
                                        <option value="AM" {{$user->state == 'AM' ? 'selected' : ''}}>
                                            AM
                                        </option>
                                        <option value="BA" {{$user->state == 'BA' ? 'selected' : ''}}>
                                            BA
                                        </option>
                                        <option value="CE" {{$user->state == 'CE' ? 'selected' : ''}}>
                                            CE
                                        </option>
                                        <option value="DF" {{$user->state == 'DF' ? 'selected' : ''}}>
                                            DF
                                        </option>
                                        <option value="ES" {{$user->state == 'ES' ? 'selected' : ''}}>
                                            ES
                                        </option>
                                        <option value="GO" {{$user->state == 'GO' ? 'selected' : ''}}>
                                            GO
                                        </option>
                                        <option value="MA" {{$user->state == 'MA' ? 'selected' : ''}}>
                                            MA
                                        </option>
                                        <option value="MT" {{$user->state == 'MT' ? 'selected' : ''}}>
                                            MT
                                        </option>
                                        <option value="MS" {{$user->state == 'MS' ? 'selected' : ''}}>
                                            MS
                                        </option>
                                        <option value="MG" {{$user->state == 'MG' ? 'selected' : ''}}>
                                            MG
                                        </option>
                                        <option value="PA" {{$user->state == 'PA' ? 'selected' : ''}}>
                                            PA
                                        </option>
                                        <option value="PB" {{$user->state == 'PB' ? 'selected' : ''}}>
                                            PB
                                        </option>
                                        <option value="PR" {{$user->state == 'PR' ? 'selected' : ''}}>
                                            PR
                                        </option>
                                        <option value="PE" {{$user->state == 'PE' ? 'selected' : ''}}>
                                            PE
                                        </option>
                                        <option value="PI" {{$user->state == 'PI' ? 'selected' : ''}}>
                                            PI
                                        </option>
                                        <option value="RJ" {{$user->state == 'RJ' ? 'selected' : ''}}>
                                            RJ
                                        </option>
                                        <option value="RN" {{$user->state == 'RN' ? 'selected' : ''}}>
                                            RN
                                        </option>
                                        <option value="RS" {{$user->state == 'RS' ? 'selected' : ''}}>
                                            RS
                                        </option>
                                        <option value="RO" {{$user->state == 'RO' ? 'selected' : ''}}>
                                            RO
                                        </option>
                                        <option value="RR" {{$user->state == 'RR' ? 'selected' : ''}}>
                                            RR
                                        </option>
                                        <option value="SC" {{$user->state == 'SC' ? 'selected' : ''}}>
                                            SC
                                        </option>
                                        <option value="SP" {{$user->state == 'SP' ? 'selected' : ''}}>
                                            SP
                                        </option>
                                        <option value="SE" {{$user->state == 'SE' ? 'selected' : ''}}>
                                            SE
                                        </option>
                                        <option value="TO" {{$user->state == 'TO' ? 'selected' : ''}}>
                                            TO
                                        </option>
                                    </select>
                                    <div class="invalid-feedback" id="state-feedback-user"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="btn-floating">
                        <a href="{{route('users_index')}}"
                            class="btn btn-danger d-inline-flex align-items-center justify-content-center me-2">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                        </a>
                        <button type="submit" class="btn btn-success"
                            id="btn-update-user"
                            onclick="return window.submitFormUserUpdate()">
                            <i class="bi bi-save-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>