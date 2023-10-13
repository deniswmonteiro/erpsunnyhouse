<div class="modal fade w-100 text-black" id="modal-generate-receipt-payment"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Preencha os dados do recibo</h4>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" target="_blank" class="mb-0"
                            action="{{route('contracts_print_receipt_of_payment', ['id'=>encrypt($contract->id)])}}" id="form-generate-receipt-payment"
                            onsubmit="return false">
                            @csrf

                            <div class="row">
                                <!-- Amount -->
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="receipt-amount" class="form-label">
                                            Valor
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">R$</span>
                                            <input id="receipt-amount" type="text" value="" 
                                                name="receipt-amount"
                                                class="form-control"
                                                onblur="return window.validateDouble(this)"
                                                onchange="return window.validateDouble(this)"
                                                data-input
                                                required>
                                        </div>
                                        <div class="invalid-feedback" id="amount-feedback-receipt"></div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="receipt-description" class="form-label">
                                            Descrição
                                        </label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="receipt-description" 
                                                name="receipt-description"
                                                rows="3"
                                                onchange="return window.validateTextarea(this, 10, 250)"
                                                onblur="return window.validateTextarea(this, 10, 250)"
                                                onkeyup="return window.validateTextarea(this, 10, 250)"
                                                data-input
                                                required></textarea>
                                        </div>
                                        <div class="invalid-feedback" id="description-feedback-receipt"></div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="chk-receipt-logo"
                                            name="chk-receipt-logo"
                                            @if (old('chk-receipt-logo') == 'on') checked @endif
                                            data-check>
                                        <label class="form-check-label" for="chk-receipt-logo">
                                            Gerar recibo com logomarca?
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
                    onclick="return window.generateReceiptPayment()">
                    Emitir Recibo
                </button>
            </div>
        </div>
    </div>
</div>