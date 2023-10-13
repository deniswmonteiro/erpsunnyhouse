<div class="modal fade w-100 text-black" id="modal-create-team"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal">
    <div class="modal-dialog modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insira os dados do Time de Vendas</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="#" method="POST"
                    class="mb-0"
                    id="form-create-seller-team"
                    onsubmit="return false">
                    @csrf
                    
                    <div class="card border mt-3">
                        <div class="card-header bg-blue-lighten p-3">
                            <h4 class="card-title mb-0">Informações do Time de Vendas</h4>
                        </div>
                        <div class="card-body pt-4 pb-1">
                            <!-- Name -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="team-name" class="form-label">
                                            Nome
                                        </label>
                                        <input type="text" class="form-control"
                                            id="team-name"
                                            name="team-name"
                                            value="{{old('team-name')}}"
                                            onchange="return window.validateInput(this, 5)"
                                            onblur="return window.validateInput(this, 5)"
                                            onkeyup="return window.validateInput(this, 5)"
                                            required>
                                        <div class="invalid-feedback" id="team-create-feedback-name"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Voltar
                </button>
                <button type="button"
                    class="btn bg-success text-white d-inline-flex align-items-center"
                    id="btn-create-team"
                    onclick="return window.submitCreateSellerTeam(this)">
                    Cadastrar Time de Vendas

                    <div class="spinner-border spinner-border-sm text-white ms-2 d-none"
                        id="btn-create-team-loading"
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