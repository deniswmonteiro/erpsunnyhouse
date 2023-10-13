<div class="modal fade w-100 text-black" id="modal-generate-contract"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Escolha o assinante do contrato</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('contracts_print_contract', ['id' => encrypt($contract->id)])}}"
                            method="POST" target="_blank"
                            id="form-generate-contract"
                            onsubmit="return false">
                            @csrf

                            @if (Auth::user()->email != 'nixon@sunnyhouse.com.br' || Auth::user()->email != 'rafael@sunnyhouse.com.br')
                                <div class="row mb-3">
                                    <!-- Signature Name -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contract-signature-name" class="form-label">
                                                Assinatura no Contrato
                                            </label>
                                            <select class="form-select" aria-label="contract-signature-name" 
                                                id="contract-signature-name"
                                                name="contract-signature-name"
                                                value="{{old('contract-signature-name')}}"
                                                onchange="return window.window.validateSelect(this)"
                                                onblur="return window.window.validateSelect(this)"
                                                data-input
                                                required>
                                                <option value="" disabled selected>
                                                    Escolha o assinante
                                                </option>
                                                <option value="{{encrypt('1')}}">
                                                    Nixon Menezes Girard da Silva
                                                </option>
                                                <option value="{{encrypt('2')}}">
                                                    Rafael Feio Calandrini
                                                </option>
                                            </select>
                                            <div class="invalid-feedback" id="signature-name-feedback-contract"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="chk-contract-logo"
                                            name="chk-contract-logo"
                                            @if (old('chk-contract-logo') == 'on') checked @endif
                                            data-check>
                                        <label class="form-check-label" for="chk-contract-logo">
                                            Gerar contrato com logomarca?
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
                    data-bs-dismiss="modal"
                    onclick="return window.resetFormFields(this)">
                    Fechar
                </button>
                <button type="submit" class="btn bg-success text-white"
                    id="btn-generate-receipt-payment"
                    onclick="return window.generateContract()">
                    Emitir Contrato
                </button>
            </div>
        </div>
    </div>
</div>