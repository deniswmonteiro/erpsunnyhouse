<div class="modal fade w-100 text-black" id="modal-generate-contract-adhesion"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Termo de Adesão</h4>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('contracts_print_adhesion', ['id' => encrypt($contract->id)])}}"
                            method="POST" target="_blank"
                            id="form-generate-contract-adhesion"
                            onsubmit="return false">
                            @csrf

                            <!-- Logo -->
                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="chk-adhesion-logo"
                                            name="chk-adhesion-logo"
                                            @if (old('chk-adhesion-logo') == 'on') checked @endif>
                                        <label class="form-check-label" for="chk-adhesion-logo">
                                            Gerar termo com logomarca?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Bank data -->
                            <div class="row">
                                <h6 class="text-black">Selecione os Dados Bancários</h6>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            id="rd-adhesion-bank-itau"
                                            name="rd-adhesion-bank"
                                            value="rd-adhesion-bank-itau"
                                            checked>
                                        <label class="form-check-label" for="rd-adhesion-bank-itau">
                                            Itaú Unibanco Holding S.A.
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            id="rd-adhesion-bank-santander"
                                            name="rd-adhesion-bank"
                                            value="rd-adhesion-bank-santander">
                                        <label class="form-check-label" for="rd-adhesion-bank-santander">
                                            Banco Santander S.A.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Fechar
                </button>
                <a href="#" class="btn bg-success text-white" 
                    onclick="event.preventDefault(), document.querySelector('#form-generate-contract-adhesion').submit()">
                    Emitir Termo de Adesão
                </a>
            </div>
        </div>
    </div>
</div>