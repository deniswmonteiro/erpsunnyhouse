<!-- Modal Create Ticket -->
<div class="modal fade w-100 text-black" id="modal-ticket-create"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo Ticket/OS</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tickets_store')}}" method="POST"
                    id="form-create-ticket"
                    class="mb-0"
                    onsubmit="return false">
                    @csrf
                    
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="ticket-contract-id"
                                id="ticket-contract-id">

                            <input type="hidden" name="ticket-client-id"
                                id="ticket-client-id">
                            
                            <!-- Title -->
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label for="ticket-title" class="form-label">
                                            Título <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text"
                                            id="ticket-title"
                                            name="ticket-title"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)"
                                            required>
                                        <div class="invalid-feedback" id="ticket-feedback-title-create"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                            <label class="form-check-label fw-normal" 
                                                style="color: #607080"
                                                for="chk-use-client-data">
                                                Usar o Cliente
                                            </label>
                                            <input class="form-check-input" type="checkbox"
                                                id="chk-use-client-data"
                                                onchange="return window.changeToClientData(this)">
                                        </div>                                
                                    </div>
                                </div>
                            </div>

                            <!-- Contract -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="ticket-contract" class="form-label">
                                            Contrato <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text"
                                            id="ticket-contract" 
                                            name="ticket-contract"
                                            required>
                                        <div class="invalid-feedback" id="ticket-feedback-contract-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Client -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="ticket-client" class="form-label">
                                            Cliente <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text"
                                            id="ticket-client" 
                                            name="ticket-client">
                                        <div class="invalid-feedback" id="ticket-feedback-client-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="ticket-type" class="form-label">
                                            Tipo <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" aria-label="ticket-type"
                                            id="ticket-type"
                                            name="ticket-type"
                                            onchange="return window.validateSelect(this)"
                                            onblur="return window.validateSelect(this)"
                                            onkeyup="return window.validateSelect(this)"
                                            required>
                                            <option value="" disabled selected>
                                                Selecione o tipo
                                            </option>
                                            <option value="{{encrypt('GENERATION')}}">
                                                Geração
                                            </option>
                                            <option value="{{encrypt('CONCESSIONAIRE')}}">
                                                Concessionária
                                            </option>
                                            <option value="{{encrypt('MAINTENANCE')}}">
                                                Manutenção
                                            </option>
                                            <option value="{{encrypt('CLEANING')}}">
                                                Limpeza
                                            </option>
                                            <option value="{{encrypt('COMMERCIAL')}}">
                                                Comercial
                                            </option>
                                            <option value="{{encrypt('COMMISSIONING')}}">
                                                Comissionamento
                                            </option>
                                            <option value="{{encrypt('VISIT')}}">
                                                Visita
                                            </option>
                                            <option value="{{encrypt('REPORTS')}}">
                                                Relatórios
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="ticket-feedback-type-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deadline -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="ticket-deadline" class="form-label">
                                            Prazo
                                        </label>
                                        <input class="form-control date" type="date"
                                            id="ticket-deadline"
                                            name="ticket-deadline"
                                            min="{{date('Y-m-d')}}"
                                            onchange="return window.validateTicketDeadline(this)"
                                            onblur="return window.validateTicketDeadline(this)"
                                            onkeyup="return window.validateTicketDeadline(this)">
                                        <div class="invalid-feedback" id="ticket-feedback-deadline-create"></div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-secondary mt-3">
                                Preencher, obrigatoriamente, todos os campos com asterísco (<span class="text-danger">*</span>).
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-bs-dismiss="modal"
                    onclick="return window.clearFormCreateTicket()">
                    Cancelar
                </button>
                <button type="submit" class="btn bg-success text-white d-inline-flex align-items-center"
                    id="btn-create-ticket"
                    onclick="return window.submitFormCreateTicket(this)">
                    Criar Ticket

                    <div class="spinner-border spinner-border-sm text-white ms-2 d-none"
                        id="btn-create-ticket-loading"
                        role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>