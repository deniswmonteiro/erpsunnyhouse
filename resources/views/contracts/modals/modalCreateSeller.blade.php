<div class="modal fade w-100 text-black" id="modal-create-seller"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal">
    <div class="modal-dialog modal-dialog-scrollable modal-xl"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insira os dados do Vendedor</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="#" method="POST"
                    enctype="multipart/form-data"
                    class="mb-0"
                    id="form-create-seller"
                    onsubmit="return false">
                    @csrf

                    <!-- Profile Informations -->
                    <div class="card border mt-3">
                        <div class="card-header bg-blue-lighten p-3">
                            <h4 class="card-title mb-0">Informações de Perfil</h4>
                        </div>
                        <div class="card-body pt-4 pb-1">
                            <div class="row">
                                <!-- Name -->
                                <div class="col-12 col-lg-5 mb-3">
                                    <div class="form-group">
                                        <label for="seller-name" class="form-label">
                                            Nome
                                        </label>
                                        <input type="text" class="form-control"
                                            id="seller-name"
                                            name="seller-name"
                                            onchange="return window.validateInput(this, 5)"
                                            onblur="return window.validateInput(this, 5)"
                                            onkeyup="return window.validateInput(this, 5)"
                                            data-input
                                            required>
                                        <div class="invalid-feedback" id="seller-create-feedback-name"></div>
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
                                            name="seller-phone"
                                            onchange="return window.validatePhone(this, 10)"
                                            onblur="return window.validatePhone(this, 10)"
                                            onkeyup="return window.validatePhone(this, 10)"
                                            data-input
                                            required>
                                        <div class="invalid-feedback" id="seller-create-feedback-phone"></div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-12 col-lg-4 mb-3">
                                    <div class="form-group">
                                        <label for="seller-email" class="form-label">
                                            E-mail
                                        </label>
                                        <input type="email" class="form-control"
                                            id="seller-email"
                                            name="seller-email"
                                            onchange="return window.validateEmail(this)"
                                            onblur="return window.validateEmail(this)"
                                            onkeyup="return window.validateEmail(this)"
                                            data-input
                                            required>
                                        <div class="invalid-feedback" id="seller-create-feedback-email"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Team -->
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="seller-team" class="form-label">
                                            Time de Vendas
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                id="seller-team" 
                                                name="seller-team"
                                                data-input
                                                required>
                                            <button type="button" class="btn btn-warning"
                                                id="btn-create-team"
                                                data-bs-target="#modal-create-team"
                                                data-bs-toggle="modal"
                                                data-bs-dismiss="modal"
                                                onclick="return window.handleNameOnNewItemModal(this)"
                                                disabled>
                                                Inserir Time de Vendas
                                            </button>
                                        </div>
                                        <div class="invalid-feedback" id="seller-create-feedback-team"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Informations -->
                    <div class="card border">
                        <div class="card-header bg-blue-lighten p-3">
                            <h4 class="card-title mb-0">Informações de Contato</h4>
                        </div>
                        <div class="card-body pt-4 pb-1">
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
                                                name="seller-cep"
                                                onblur="return window.validateCep(this), window.fillInAddressFields(this)"
                                                data-input>
                                            <div class="input-group-text bg-white border-0 d-flex justify-content-center d-none"
                                                id="seller-cep-loading">
                                                <span class="spinner-border text-primary spinner-border spinner-border-sm"
                                                    role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback" id="seller-create-feedback-cep"></div>
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
                                            name="seller-address"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)"
                                            data-input>
                                        <div class="invalid-feedback" id="seller-create-feedback-address"></div>
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
                                            name="seller-number"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)"
                                            data-input>
                                        <div class="invalid-feedback" id="seller-create-feedback-number"></div>
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
                                            name="seller-complement"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)"
                                            data-input>
                                        <div class="invalid-feedback" id="seller-create-feedback-complement"></div>
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
                                            name="seller-neighborhood"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)"
                                            data-input>
                                        <div class="invalid-feedback" id="seller-create-feedback-neighborhood"></div>
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
                                            name="seller-city"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)"
                                            data-input>
                                        <div class="invalid-feedback" id="seller-create-feedback-city"></div>
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
                                            name="seller-state"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)"
                                            data-input>
                                        <div class="invalid-feedback" id="seller-create-feedback-state"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-bs-dismiss="modal"
                    onclick="return window.resetFormFields(this)">
                    Cancelar
                </button>
                <button type="button"
                    class="btn bg-success text-white d-inline-flex align-items-center"
                    id="btn-create-seller"
                    onclick="return window.submitCreateSeller(this)">
                    Cadastrar Vendedor

                    <div class="spinner-border spinner-border-sm text-white ms-2 d-none"
                        id="btn-create-seller-loading"
                        role="status">
                        <span class="visually-hidden">
                            Loading...
                        </span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>