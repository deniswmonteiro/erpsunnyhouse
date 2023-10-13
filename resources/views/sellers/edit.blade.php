@section('page_title', 'Editar Vendedor')

<script src="{{asset(mix('js/sellers/edit.js'))}}" defer></script>
<script>
    var url_ajax_email = "{{route('sellers_validate_email_seller')}}";
    var seller = "{{encrypt($seller->id)}}";
    var url_ajax_store_team = "{{route('teams_store_ajax')}}";

    var teams = @json($teams);
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edição de Vendedor</h3>
                <p class="text-subtitle text-muted">
                    Edite os dados do vendedor selecionado.
                </p>
            </div>
        </div>
    </x-slot>

    <div>
        <form action="{{route('sellers_update', ['id' => encrypt($seller->id)])}}" method="POST"
            id="form-edit-seller"
            onsubmit="return false">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Perfil</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Name -->
                        <div class="col-12 col-lg-5 mb-3">
                            <div class="form-group">
                                <label for="seller-name" class="form-label">
                                    Nome
                                </label>
                                <input type="text" class="form-control"
                                    id="seller-name"
                                    name="name"
                                    value="{{$seller->name}}"
                                    onchange="return window.validateInput(this, 5)"
                                    onblur="return window.validateInput(this, 5)"
                                    onkeyup="return window.validateInput(this, 5)"
                                    required>
                                <div class="invalid-feedback" id="seller-edit-feedback-name"></div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="seller-phone" class="form-label">
                                    Telefone
                                </label>
                                <input type="text" class="form-control"
                                    id="seller-phone"
                                    name="phone"
                                    value="{{$seller->phone}}"
                                    onchange="return window.validatePhone(this, 10)"
                                    onblur="return window.validatePhone(this, 10)"
                                    onkeyup="return window.validatePhone(this, 10)"
                                    required>
                                <div class="invalid-feedback" id="seller-edit-feedback-phone"></div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for=seller-email" class="form-label">
                                    E-mail
                                </label>
                                <input type="email" class="form-control"
                                    id="seller-email"
                                    name="email" 
                                    value="{{$seller->email}}"
                                    onchange="return window.validateEmail(this)"
                                    onblur="return window.validateEmail(this)"
                                    onkeyup="return window.validateEmail(this)"
                                    required>
                                <div class="invalid-feedback" id="seller-edit-feedback-email"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Team -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="team" class="form-label">
                                    Time de Vendas
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        id="seller-team" 
                                        name="team"
                                        value="{{$seller->team->name}}"
                                        required>
                                    <button type="button" class="btn btn-warning"
                                        id="btn-create-team"
                                        data-bs-target="#modal-create-team"
                                        data-bs-toggle="modal"
                                        data-bs-dismiss="modal"
                                        onclick="return window.handleNameOnNewItemModal()"
                                        disabled>
                                        Inserir Time de Vendas
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="seller-edit-feedback-team"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Contato</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- CEP -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="seller-cep" class="form-label">
                                    CEP
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control rounded"
                                        id="seller-cep"
                                        name="cep"
                                        value="{{$seller->cep}}"
                                        onblur="return window.validateCep(this), window.fillInAddressFields(this)">
                                    <div class="input-group-text bg-white border-0 d-flex justify-content-center d-none"
                                        id="seller-cep-loading">
                                        <span class="spinner-border text-primary spinner-border spinner-border-sm"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="invalid-feedback" id="seller-edit-feedback-cep"></div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-12 col-lg-7 mb-3">
                            <div class="form-group">
                                <label for="seller-address" class="form-label">
                                    Endereço
                                </label>
                                <input type="text" class="form-control"
                                    id="seller-address"
                                    name="address"
                                    value="{{$seller->address}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="seller-edit-feedback-address"></div>
                            </div>
                        </div>

                        <!-- Number -->
                        <div class="col-12 col-lg-2 mb-3">
                            <div class="form-group">
                                <label for="seller-number" class="form-label">
                                    Número
                                </label>
                                <input type="text" class="form-control"
                                    id="seller-number"
                                    name="number"
                                    value="{{$seller->address_number}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)">
                                <div class="invalid-feedback" id="seller-edit-feedback-number"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Complement -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="seller-complement" class="form-label">
                                    Complemento
                                </label>
                                <input type="text" class="form-control"
                                    id="seller-complement"
                                    name="complement"
                                    value="{{$seller->complement}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="seller-edit-feedback-complement"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Neighborhood -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="seller-neighborhood" class="form-label">
                                    Bairro
                                </label>
                                <input type="text" class="form-control"
                                    id="seller-neighborhood"
                                    name="neighborhood"
                                    value="{{$seller->neighborhood}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="seller-edit-feedback-neighborhood"></div>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="seller-city" class="form-label">
                                    Cidade
                                </label>
                                <input type="text" class="form-control"
                                    id="seller-city"
                                    name="city"
                                    value="{{$seller->city}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="seller-edit-feedback-city"></div>
                            </div>
                        </div>

                        <!-- State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="seller-state" class="form-label">
                                    Estado
                                </label>
                                <input type="text" class="form-control"
                                    id="seller-state"
                                    name="state"
                                    value="{{$seller->state}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="seller-edit-feedback-state"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="btn-floating">
                <a href="{{route('sellers_index')}}"
                    class="btn btn-danger d-inline-flex align-items-center justify-content-center me-2">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </a>
                <button type="submit" class="btn btn-success"
                    id="btn-edit-seller"
                    onclick="return window.submitFormEditSeller()">
                    <i class="bi bi-save-fill"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Modal Create Seller Team -->
    @include ('sellers.modals.modalCreateSellerTeam')
</x-app-layout>
