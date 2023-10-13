@section('page_title', 'Adicionar Contrato')

<script src="{{asset(mix('js/contracts/create.js'))}}" defer></script>
<script>
    var url_ajax_email_client = "{{route('clients_validate_email')}}";
    var url_ajax_store_client = "{{route('clients_store_ajax')}}";

    var url_ajax_email_seller = "{{route('sellers_validate_email')}}";
    var url_ajax_store_seller = "{{route('sellers_store_ajax')}}";

    var url_get_products_by_name = "{{route('get_products_by_name')}}";
    
    var url_store_product_ajax = "{{route('store_product_ajax')}}";

    var url_ajax_store_team = "{{route('teams_store_ajax')}}";

    var url_ajax_client_validate_name = "{{route('clients_validate_name')}}";

    var url_ajax_seller_validate_name = "{{route('sellers_validate_name')}}";

    var sellers = @json($sellers);
    var clients = @json($clients);
    var teams = @json($teams);
    var banks = @json($banks);
    
    var equipments = @json($equipments);
    var equipmentsArray = @json($equipments_array);

    var validationInstall = @json($validation_install);

    var selectTypeGenerator = "1";
    var selectTypeMaintenance = "2";
</script>
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{_('Cadastrar Contrato')}}</h3>
                <p class="text-subtitle text-muted">
                    {{_('Insira no formulário os dados do novo contrato.')}}
                </p>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
        <form action="{{route('contracts_store')}}" method="POST" id="form-create-contract">
            @csrf

            <input type="hidden" id="table-data" name="table" value="" />

            <!-- Contract Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações do Contrato</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Seller -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="contract-seller" class="form-label">
                                    Vendedor
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        id="contract-seller"
                                        name="seller"
                                        required>
                                    <button type="button" class="btn btn-warning"
                                        id="btn-create-seller"
                                        data-bs-target="#modal-create-seller"
                                        data-bs-toggle="modal"
                                        onclick="return window.handleNameOnNewItemModal(this)"
                                        disabled>
                                        Inserir Vendedor
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="contract-create-feedback-seller"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Client -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="contract-client" class="form-label">
                                    Cliente
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        id="contract-client"
                                        name="client"
                                        required>
                                    <button type="button" class="btn btn-warning"
                                        id="btn-create-client"
                                        data-bs-target="#modal-create-client"
                                        data-bs-toggle="modal"
                                        onclick="return window.handleNameOnNewItemModal(this)"
                                        disabled>
                                        Inserir Cliente
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="contract-create-feedback-client"></div>
                            </div>
                        </div>

                        <!-- Nickname -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="contract-nickname" class="form-label">
                                    Apelido (opcional)
                                </label>
                                <input type="text" class="form-control"
                                    id="contract-nickname"
                                    name="nickname"
                                    value="{{old('nickname')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="contract-create-feedback-nickname"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Type -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-type" class="form-label">
                                    Tipo de Contrato
                                </label>
                                <select class="form-select" aria-label="contract-type"
                                    id="contract-type"
                                    name="type"
                                    data-value="{{old('type')}}"
                                    onblur="return window.validateSelect(this), window.handleContractType(this)"
                                    onchange="return window.validateSelect(this), window.handleContractType(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha o tipo de contrato
                                    </option>
                                    <option value="1">
                                        Instalação de Gerador Solar
                                    </option>
                                    <option value="2">
                                        Manutenção
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="contract-create-feedback-type"></div>
                            </div>
                        </div>

                        <!-- Contract Date -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-date" class="form-label">
                                    Data do Contrato
                                </label>
                                <input type="date" class="form-control date"
                                    id="contract-date"
                                    name="contract-date"
                                    value="{{date('Y-m-d')}}"
                                    onkeyup="return window.validateDate(this), window.handleInstallationDeadline(this)"
                                    onblur="return window.validateDate(this), window.handleInstallationDeadline(this)"
                                    onchange="return window.validateDate(this), window.handleInstallationDeadline(this)"
                                    required>
                                <div class="invalid-feedback" id="contract-create-feedback-date"></div>
                            </div>
                        </div>

                        <!-- Installation Deadline -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-deadline" class="form-label">
                                    Prazo de Instalação
                                </label>
                                <input id="contract-deadline" type="date"
                                    name="installation-deadline"
                                    class="form-control date"
                                    value="{{date('Y-m-d', strtotime('+90 days'))}}"
                                    min="{{date('Y-m-d', strtotime('+90 days'))}}"
                                    onkeyup="return  window.validateDate(this)"
                                    onblur="return  window.validateDate(this)"
                                    onchange="return  window.validateDate(this)"
                                    required>
                                <div class="invalid-feedback" id="contract-create-feedback-deadline"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Contract Value -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contract-value" class="form-label">
                                    Valor do Contrato
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control"
                                        id="contract-value"
                                        name="payment-value"
                                        value="{{old('payment-value')}}"
                                        onchange="return window.validateDouble(this), window.calculateProfit(), window.calculateKitCost(), window.calculateInstallationCost()"
                                        onblur="return window.validateDouble(this), window.calculateProfit(), window.calculateKitCost(), window.calculateInstallationCost()"
                                        onkeyup="return window.validateDouble(this), window.calculateProfit(), window.calculateKitCost(), window.calculateInstallationCost()"
                                        required>
                                </div>
                                <div class="invalid-feedback" id="contract-create-feedback-value"></div>
                            </div>
                        </div>

                        <!-- Profit Estimate -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contract-profit-estimate" class="form-label">
                                    Estimativa de Lucro
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        id="contract-profit-estimate"
                                        name="profit-estimate"
                                        value="{{$profit_estimate}}"
                                        onchange="return window.validateCostPercentage(), window.calculateProfit()"
                                        onblur="return window.validateCostPercentage(), window.calculateProfit()"
                                        onkeyup="return window.validateCostPercentage(), window.calculateProfit()"
                                        data-cost-percentage
                                        required>
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="invalid-feedback" id="contract-create-feedback-profit-estimate"></div>
                            </div>
                        </div>

                        <!-- Profit -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contract-profit" class="form-label">
                                    Lucro
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control"
                                        id="contract-profit"
                                        name="profit"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="kit-installation-costs">
                        <div class="row">
                            <!-- Kit Quota -->
                            <div class="col-12 col-lg-4 offset-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="contract-kit-quota" class="form-label">
                                        Quota do Kit
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            id="contract-kit-quota"
                                            name="kit-quota"
                                            value="{{$kit_quota}}"
                                            onchange="return window.validateCostPercentage(), window.calculateKitCost()"
                                            onblur="return window.validateCostPercentage(), window.calculateKitCost()"
                                            onkeyup="return window.validateCostPercentage(), window.calculateKitCost()"
                                            data-cost-percentage>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <div class="invalid-feedback" id="contract-create-feedback-kit-quota"></div>
                                </div>
                            </div>

                            <!-- Kit Cost -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="contract-kit-cost" class="form-label">
                                        Custo do Kit
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control"
                                            id="contract-kit-cost"
                                            name="kit-cost"
                                            value="{{old('kit-cost')}}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Installation Quota -->
                            <div class="col-12 col-lg-4 offset-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="contract-installation-quota" class="form-label">
                                        Quota da Instalação
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            id="contract-installation-quota"
                                            name="installation-quota"
                                            value="{{$installation_quota}}"
                                            onchange="return window.validateCostPercentage(), window.calculateInstallationCost()"
                                            onblur="return window.validateCostPercentage(), window.calculateInstallationCost()"
                                            onkeyup="return window.validateCostPercentage(), window.calculateInstallationCost()"
                                            data-cost-percentage>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <div class="invalid-feedback"
                                        id="contract-create-feedback-installation-quota"></div>
                                </div>
                            </div>

                            <!-- Installation Cost -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="contract-installation-cost" class="form-label">
                                        Custo da Instalação
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control"
                                            id="contract-installation-cost"
                                            name="installation-cost"
                                            value="{{old('installation-cost')}}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Description -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="contract-description" class="form-label">
                                    Descrição do Contrato (opcional)
                                </label>
                                <textarea class="form-control"
                                    id="contract-description"
                                    name="description"
                                    rows="3"
                                    onchange="return window.validateTextarea(this, 5, 250)"
                                    onblur="return window.validateTextarea(this, 5, 250)"
                                    onkeyup="return window.validateTextarea(this, 5, 250)"></textarea>
                                <div class="invalid-feedback" id="contract-create-feedback-description"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Solar Kit Items -->
            <div class="card d-none" id="contract-generator">
                <div class="card-header">
                    <h4 id="label-generator" class="card-title">Itens do Kit Solar</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Structure Type -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-structure" class="form-label">
                                    Tipo de estrutura
                                </label>
                                <select class="form-select" aria-label="contract-structure"
                                    id="contract-structure"
                                    name="structure"
                                    data-value="{{old('type')}}"
                                    onblur="return window.validateSelect(this)"
                                    onchange="return window.validateSelect(this)">
                                    <option value="" disabled selected>
                                        Escolha o tipo de estrutura
                                    </option>
                                    <option value="1">
                                        Solo Monoposte
                                    </option>
                                    <option value="2">
                                        Laje
                                    </option>
                                    <option value="3">
                                        Fibrocimento
                                    </option>
                                    <option value="4">
                                        Cerâmico
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="contract-create-feedback-structure"></div>
                            </div>
                        </div>

                        <!-- Area -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-area" class="form-label">
                                    Área Configurada (m<sup>2</sup>)
                                </label>
                                <input type="text" class="form-control"
                                    id="contract-area"
                                    name="area"
                                    value="{{old('area')}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)">
                                <div class="invalid-feedback" id="contract-create-feedback-area"></div>
                            </div>
                        </div>

                        <!-- Monthly Average Generation -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-monthly-avg-generation" class="form-label">
                                    Geração Média Mensal (kWh)
                                </label>
                                <input type="text" class="form-control"
                                    id="contract-monthly-avg-generation"
                                    name="monthly_avg_generation"
                                    value="{{old('monthly_avg_generation')}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)">
                                <div class="invalid-feedback" id="contract-create-feedback-avg-generation"></div>
                            </div>
                        </div>

                        <!-- Products Generator -->
                        <div class="mb-2 mt-3 text-danger d-none" id="invalid-table">
                            Error.
                        </div>
                        <div class="col-12 col-md-12">
                            <table class="table border border-2"
                                id="editable-table" name="editable-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody class="border-1"></tbody>
                            </table>
                            <button type="button" class="btn bg-orange text-white float-start m-1"
                                id="btn-add-table-row"
                                onclick="return window.tableIsValid()">
                                <i class="bi bi-plus-circle-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações de Pagamento</h4>
                </div>
                <div class="card-body">
                    <!-- Payment Type -->
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="contract-payment-type" class="form-label">
                                    Forma de Pagamento
                                </label>
                                <select class="form-select" aria-label="contract-payment-type"
                                    id="contract-payment-type"
                                    name="payment_type"
                                    onblur="return window.validateSelect(this), window.handlePaymentType(this)"
                                    onchange="return window.validateSelect(this), window.handlePaymentType(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha a forma de pagamento
                                    </option>
                                    <option value="{{contract_name_cash()}}">
                                        {{contract_name_cash()}}
                                    </option>
                                    <option value="{{contract_name_partial_parceled()}}">
                                        {{contract_name_partial_parceled()}}
                                    </option>
                                    <option value="{{contract_name_total_parceled()}}">
                                        {{contract_name_total_parceled()}}
                                    </option>
                                    <option value="{{contract_name_company_installment()}}">
                                        {{contract_name_company_installment()}}
                                    </option>
                                    <option value="{{contract_name_custom()}}">
                                        {{contract_name_custom()}}
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="payment-feedback-type-create"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Bank Name -->
                        <div class="col-12 col-md-12 col-lg-12 mb-3 d-none">
                            <div class="form-group">
                                <label for="contract-payment-bank" class="form-label">
                                    Nome do Banco
                                </label>
                                <input type="text" class="form-control"
                                    id="contract-payment-bank"
                                    name="payment_bank">
                                <div class="invalid-feedback" id="payment-feedback-bank-create"></div>
                            </div>
                        </div>

                        <!-- Payment Description -->
                        <div class="col-12 mb-3 d-none">
                            <div class="form-group">
                                <label for="contract-payment-description" class="form-label">
                                    Descrição da Forma de Pagamento
                                </label>
                                <textarea class="form-control"
                                    id="contract-payment-description"
                                    name="payment_text"
                                    rows="3"
                                    onchange="return window.validateTextarea(this, 10, 250)"
                                    onblur="return window.validateTextarea(this, 10, 250)"
                                    onkeyup="return window.validateTextarea(this, 10, 250)"></textarea>
                                <div class="invalid-feedback" id="payment-feedback-description-edit"></div>
                            </div>
                        </div>

                        <!-- Cash Payment -->
                        <div class="col-12 col-md-12 col-lg-6 mb-3 d-none">
                            <div class="form-group">
                                <label for="contract-payment-cash" class="form-label">
                                    Entrada à Vista
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control"
                                        id="contract-payment-cash"
                                        name="payment_cash"
                                        value="{{old('payment_cash')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                </div>
                                <div class="invalid-feedback" id="payment-feedback-cash-create"></div>
                            </div>
                        </div>

                        <!-- Payment Quantity -->
                        <div class="col-12 col-md-12 col-lg-6 mb-3 d-none">
                            <div class="form-group">
                                <label for="contract-payment-quantity" class="form-label">
                                    Número de Parcelas do Saldo Restante
                                </label>
                                <input type="text" class="form-control"
                                    id="contract-payment-quantity"
                                    name="payment_quantity"
                                    value="{{old('payment_cash')}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)">
                                <div class="invalid-feedback" id="payment-feedback-quantity-create"></div>
                            </div>
                        </div>

                        <!-- Payment After -->
                        <div id="contract-payment-after" class="col-12 col-md-12 col-lg-6 mb-3 d-none">
                            <div class="form-group">
                                <label class="form-label">
                                    Pagamento Após
                                </label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"
                                        id="contract-payment-signature"
                                        name="payment_after_by"
                                        value="{{encrypt(\App\Http\Controllers\ContractController::$PAYMENT_AFTER_SIGNATURE)}}">
                                    <label class="form-check-label" for="contract-payment-signature">
                                        {{\App\Http\Controllers\ContractController::$PAYMENT_AFTER_SIGNATURE}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"
                                        id="contract-payment-conclusion"
                                        name="payment_after_by"
                                        value="{{encrypt(\App\Http\Controllers\ContractController::$PAYMENT_AFTER_CONCLUSION)}}">
                                    <label class="form-check-label" for="contract-payment-conclusion">
                                        {{\App\Http\Controllers\ContractController::$PAYMENT_AFTER_CONCLUSION}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"
                                        id="contract-payment-homologation"
                                        name="payment_after_by"
                                        value="{{encrypt(\App\Http\Controllers\ContractController::$PAYMENT_AFTER_HOMOLOGATION)}}">
                                    <label class="form-check-label" for="contract-payment-homologation">
                                        {{\App\Http\Controllers\ContractController::$PAYMENT_AFTER_HOMOLOGATION}}
                                    </label>
                                </div>
                                <div class="invalid-feedback" id="payment-feedback-after-create"></div>
                            </div>
                        </div>
                    </div>
                    <div class="float-end mt-5">
                        <a href="javascript:history.back()" class="btn bg-danger text-white me-2">
                            Cancelar
                        </a>
                        <button type="submit" class="btn bg-success text-white"
                            id="btn-create-generator"
                            onclick="window.submitFormCreateContract()">
                            Criar Contrato
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal create Seller -->
    @include ('contracts.modals.modalCreateSeller')
    
    <!-- Modal create Seller Team -->
    @include ('contracts.modals.modalCreateSellerTeam')
    
    <!-- Modal create Client -->
    @include ('contracts.modals.modalCreateClient')

    <!-- Modal create Product -->
    @include ('contracts.modals.modalCreateProduct')
</x-app-layout>