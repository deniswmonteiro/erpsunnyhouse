@section('page_title', 'Editar Contrato')

<script src="{{asset(mix('js/contracts/edit.js'))}}" defer></script>
<script>
    var url_ajax_email_client = "{{route('clients_validate_email')}}";
    var url_ajax_store_client = "{{route('clients_store_ajax')}}";

    var url_ajax_email_seller = "{{route('sellers_validate_email')}}";
    var url_ajax_store_seller = "{{route('sellers_store_ajax')}}";

    var url_store_product_ajax = "{{route('store_product_ajax')}}";

    var url_get_products_by_name = "{{route('get_products_by_name')}}";

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
                <h3>{{_('Editar Contrato')}}</h3>
                <p class="text-subtitle text-muted">{{_('Dados do contrato.')}}</p>
            </div>
        </div>
    </x-slot>

    <section>
        <!-- Management Options -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Opções de Gerenciamento</h4>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row text-center">
                        @if ($contract->type == 1 && $contract->status == 2 && $contract->project == null)
                            <!-- Run Project -->
                            <div class="col-12 col-md-6 col-lg-3 pb-4">
                                <div>
                                    <p class="mb-1">Executar Projeto</p>
                                    <a class="btn bg-warning text-white lh-1 pt-2 pb-2"
                                        href="{{route('engineering_project_create', ['id' => encrypt($contract->id)])}}">
                                        <i class="bi bi-gear-fill"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        @if ($contract->type == 1)
                            <!-- Contract of Adhesion -->
                            <div class="col-12 col-md-6 col-lg-3 pb-4">
                                <p class="mb-1">Ver Termo de Adesão</p>
                                <button type="button"
                                    class="btn btn-primary text-white lh-1 pt-2 pb-2"
                                    id="generate-contract-adhesion"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-generate-contract-adhesion">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        
                            <!-- Contract -->
                            <div class="col-12 col-md-6 col-lg-3 pb-4">
                                <p class="mb-1">Ver Contrato</p>
                                <button id="generate_contract" type="button"
                                    class="btn btn-primary text-white lh-1 pt-2 pb-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-generate-contract">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>

                            <!-- Power of Attorney -->
                            <div class="col-12 col-md-6 col-lg-3 pb-4">
                                <form action="{{route('contracts_print_power_of_attorney', ['id' => encrypt($contract->id)])}}" method="POST" target="_blank">
                                    @csrf
                                    
                                    <div>
                                        <p class="mb-1">Procuração Equatorial-PA</p>
                                        <button class="btn bg-primary text-white lh-1 pt-2 pb-2" type="submit">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Technical Certificate -->
                            <div class="col-12 col-md-6 col-lg-3 pb-4">
                                <form action="{{route('contracts_print_technical_certificate', ['id' => encrypt($contract->id)])}}" method="POST" target="_blank">
                                    @csrf

                                    <div>
                                        <p class="mb-1">Atestado Técnico</p>
                                        <button class="btn bg-primary text-white lh-1 pt-2 pb-2" type="submit">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <!-- Receipt of Payment -->
                        <div class="col-12 col-md-6 col-lg-3 pb-4">
                            <p class="mb-1">Recibo de Pagamento</p>
                            <button type="button" class="btn btn-primary text-white lh-1 pt-2 pb-2"
                                id="generate-receipt-payment"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-generate-receipt-payment">
                                <i class="bi bi-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('contracts_update', ['id' => encrypt($contract->id)])}}" 
            method="POST" enctype="multipart/form-data"
            id="form-edit-contract">
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
                                        value="{{$contract->seller->name}}"
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
                                <div class="invalid-feedback" id="contract-edit-feedback-seller"></div>
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
                                        @if ($contract->client->is_corporate)
                                            value="{{$contract->client->corporate_name}}"
                                        @else
                                            value="{{$contract->client->name}}"
                                        @endif"
                                        required>
                                    <button type="button" 
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-show-client">
                                        <i class="bi bi-person-badge"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning rounded-end"
                                        id="btn-create-client"
                                        data-bs-target="#modal-create-client"
                                        data-bs-toggle="modal"
                                        onclick="return window.handleNameOnNewItemModal(this)"
                                        disabled>
                                        Inserir Cliente
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="contract-edit-feedback-client"></div>
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
                                    value="{{$contract->nickname}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="contract-edit-feedback-nickname"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Type -->
                        <div class="col-12 col-md-6 mb-3">
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
                                    <option value="1" @if ($contract->type == 1) selected @endif>
                                        Instalação de Gerador Solar
                                    </option>
                                    <option value="2" @if ($contract->type == 2) selected @endif>
                                        Manutenção
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="contract-edit-feedback-type"></div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="contract-status" class="form-label">
                                    Status do Contrato
                                </label>
                                <select class="form-select" aria-label="contract-status"
                                    id="contract-status"
                                    name="status"
                                    data-value="{{old('status')}}"
                                    onblur="return window.validateSelect(this)"
                                    onchange="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha o status do contrato
                                    </option>
                                    <option value="{{encrypt(1)}}" @if ($contract->status == 1) selected @endif>
                                        Orçando
                                    </option>
                                    <option value="{{encrypt(2)}}" @if ($contract->status == 2) selected @endif>
                                        Contratado
                                    </option>
                                    <option value="{{encrypt(3)}}" @if ($contract->status == 3) selected @endif>
                                        Ativo
                                    </option>
                                    <option value="{{encrypt(4)}}" @if ($contract->status == 4) selected @endif>
                                        Pendência
                                    </option>
                                    <option value="{{encrypt(5)}}" @if ($contract->status == 5) selected @endif>
                                        Instalando
                                    </option>
                                    <option value="{{encrypt(6)}}" @if ($contract->status == 6) selected @endif>
                                        Instalado
                                    </option>
                                    <option value="{{encrypt(7)}}" @if ($contract->status == 7) selected @endif>
                                        Concluído
                                    </option>
                                    <option value="{{encrypt(8)}}" @if ($contract->status == 8) selected @endif>
                                        Cancelado
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="contract-edit-feedback-status"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Contract Date -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="contract-date" class="form-label">
                                    Data do Contrato
                                </label>
                                <input type="date" class="form-control date"
                                    id="contract-date"
                                    name="contract-date"
                                    value="{{date('Y-m-d', strToTime($contract->contract_date))}}"
                                    onkeyup="return window.validateDate(this), window.handleInstallationDeadline(this)"
                                    onblur="return window.validateDate(this), window.handleInstallationDeadline(this)"
                                    onchange="return window.validateDate(this), window.handleInstallationDeadline(this)"
                                    required>
                                <div class="invalid-feedback" id="contract-edit-feedback-date"></div>
                            </div>
                        </div>

                        <!-- Installation Deadline -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="contract-deadline" class="form-label">
                                    Prazo de Instalação
                                </label>
                                <input type="date" class="form-control date"
                                    id="contract-deadline"
                                    name="installation-deadline"
                                    value="{{date('Y-m-d', strToTime($contract->installation_deadline))}}"
                                    min="{{date('Y-m-d', strToTime($contract->installation_deadline))}}"
                                    onkeyup="return  window.validateDate(this)"
                                    onblur="return  window.validateDate(this)"
                                    onchange="return  window.validateDate(this)"
                                    required>
                                <div class="invalid-feedback" id="contract-edit-feedback-deadline"></div>
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
                                        value="{{format_money($contract->paymentData()->value)}}"
                                        onchange="return window.validateDouble(this), window.calculateProfit(), window.calculateKitCost(), window.calculateInstallationCost()"
                                        onblur="return window.validateDouble(this), window.calculateProfit(), window.calculateKitCost(), window.calculateInstallationCost()"
                                        onkeyup="return window.validateDouble(this), window.calculateProfit(), window.calculateKitCost(), window.calculateInstallationCost()"
                                        required>
                                </div>
                                <div class="invalid-feedback" id="contract-edit-feedback-value"></div>
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
                                        value="{{Str::of($contract->profit_estimate)->replace('.', ',')}}"
                                        onchange="return window.validateCostPercentage(), window.calculateProfit()"
                                        onblur="return window.validateCostPercentage(), window.calculateProfit()"
                                        onkeyup="return window.validateCostPercentage(), window.calculateProfit()"
                                        data-cost-percentage
                                        required>
                                    <span class="input-group-text rounded-end">%</span>
                                </div>
                                <div class="invalid-feedback" id="contract-edit-feedback-profit-estimate"></div>
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
                                        value="{{format_money($contract->paymentData()->value * ($contract->profit_estimate / 100))}}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="@if ($contract->type != 1) d-none @endif" id="kit-installation-costs">
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
                                            value="{{Str::of($contract->kit_quota)->replace('.', ',')}}"
                                            onchange="return window.validateCostPercentage(), window.calculateKitCost()"
                                            onblur="return window.validateCostPercentage(), window.calculateKitCost()"
                                            onkeyup="return window.validateCostPercentage(), window.calculateKitCost()"
                                            data-cost-percentage
                                            required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <div class="invalid-feedback" id="contract-edit-feedback-kit-quota"></div>
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
                                            value="{{format_money($contract->paymentData()->value * ($contract->kit_quota / 100))}}"
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
                                            value="{{Str::of($contract->installation_quota)->replace('.', ',')}}"
                                            onchange="return window.validateCostPercentage(), window.calculateInstallationCost()"
                                            onblur="return window.validateCostPercentage(), window.calculateInstallationCost()"
                                            onkeyup="return window.validateCostPercentage(), window.calculateInstallationCost()"
                                            data-cost-percentage
                                            required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <div class="invalid-feedback" id="contract-edit-feedback-installation-quota"></div>
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
                                            value="{{format_money($contract->paymentData()->value * ($contract->installation_quota / 100))}}"
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
                                    onkeyup="return window.validateTextarea(this, 5, 250)">{{$contract->description}}</textarea>
                                <div class="invalid-feedback" id="contract-edit-feedback-description"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kit Solar Itens -->
            <div class="card {{($contract->type != 1) ? 'd-none' : ''}}" id="contract-generator">
                <div class="card-header">
                    <h4 id="label_generator" class="card-title">
                        Itens do Kit Solar - {!! $contract->getGeneratorPower() !!}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <!-- Structure Type -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contract-structure" class="form-label">
                                    Tipo de Estrutura
                                </label>
                                <select class="form-select" aria-label="contract-structure"
                                    id="contract-structure"
                                    name="structure"
                                    data-value="{{old('structure')}}"
                                    onblur="return window.validateSelect(this)"
                                    onchange="return window.validateSelect(this)">>
                                    <option value="" disabled selected>
                                        Escolha o tipo de estrutura
                                    </option>
                                    <option value="1" @if ($contract->generator_structure == 1) selected @endif>
                                        Solo Monoposte
                                    </option>
                                    <option value="2" @if ($contract->generator_structure == 2) selected @endif>
                                        Laje
                                    </option>
                                    <option value="3" @if ($contract->generator_structure == 3) selected @endif>
                                        Fibrocimento
                                    </option>
                                    <option value="4" @if ($contract->generator_structure == 4) selected @endif>
                                        Cerâmico
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="contract-edit-feedback-structure"></div>
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
                                    value="{{$contract->area}}"
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
                                <input type="number" class="form-control"
                                    id="contract-monthly-avg-generation"
                                    name="monthly_avg_generation"
                                    value="{{$contract->monthly_avg_generation}}"
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
                        <div class="col-12">
                            <table class="table border border-2"
                                id="editable-table"
                                name="editable-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody class="border-1">
                                    @foreach ($contract->contractsProducts() as $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->quantity}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button id="btn-add-table-row"
                                class="btn bg-orange text-white float-start m-1"
                                type="button">
                                <i class="bi bi-plus-circle-fill"></i>
                            </button>
                        </div>
                    </div>

                    <!-- If already have equipment -->
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    id="chk-have-equipment"
                                    name="chk-have-equipment"
                                    @if ($contract->equipment_date_acquisition !== null || $contract->equipment_delivery_date !== null || $contract->file_invoice_path !== null) checked @endif
                                    onchange="return window.checkIfHaveEquipment(this)">
                                <label class="form-check-label" for="chk-have-equipment">
                                    Equipamentos já adquiridos?
                                </label>
                            </div>
                        </div>
                        <div class="d-none" id="equipment-informations">
                            <div class="row">
                                <!-- Date of Acquisition -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label for="equipment-date-acquisition" class="form-label">
                                            Data de Aquisição
                                        </label>
                                        <div class="input-group">
                                            <input type="date" class="form-control date rounded"
                                                id="equipment-date-acquisition"
                                                name="equipment-date-acquisition"
                                                min="2000-01-01"
                                                max="{{date('Y-m-d')}}"
                                                value="{{$contract->equipment_date_acquisition}}"
                                                onchange="return window.validateDateAcquisition(this)"
                                                onblur="return window.validateDateAcquisition(this)"
                                                onkeyup="return window.validateDateAcquisition(this)">
                                        </div>
                                        <div class="invalid-feedback" id="date-acquisition-feedback"></div>
                                    </div>
                                </div>

                                <!-- Delivery Date -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label for="equipment-delivery-date" class="form-label">
                                            Data de Entrega
                                        </label>
                                        <div class="input-group">
                                            <input type="date" class="form-control date rounded"
                                                id="equipment-delivery-date"
                                                name="equipment-delivery-date"
                                                min="2000-01-01"
                                                max="{{date('Y-m-d')}}"
                                                value="{{$contract->equipment_delivery_date}}" 
                                                onchange="return window.validateDeliveryDate(this)"
                                                onblur="return window.validateDeliveryDate(this)"
                                                onkeyup="return window.validateDeliveryDate(this)">
                                        </div>
                                        <div class="invalid-feedback" id="delivery-date-feedback"></div>
                                    </div>
                                </div>

                                <!-- Invoice -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="equipment-file-invoice" class="form-label">
                                            Nota Fiscal
                                        </label>
                                        <div class="input-group">
                                            <input type="file" class="form-control"
                                                id="equipment-file-invoice" 
                                                name="equipment-file-invoice"
                                                value="{{old('equipment-file-invoice')}}"
                                                onchange="return window.validateFile(this)"
                                                onblur="return window.validateFile(this)">

                                            <button type="button"
                                                class="btn bg-primary text-white rounded-end"
                                                onclick="return document.querySelector('#form-show-invoice').submit()"
                                                @if ($contract->file_invoice_path == null) disabled @endif>
                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                            </button>

                                            @if ($contract->file_invoice_path != null)
                                                <div class="valid-feedback d-block" id="file-invoice-name">
                                                    <span class="fw-bold">Arquivo atual:</span> {{Str::between($contract->file_invoice_name, '_', -1)}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="invalid-feedback" id="file-invoice-feedback-contract"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Forma de Pagamento</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Payment Type -->
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
                                    <option value="{{contract_name_cash()}}"
                                        @if (contract_payment_is($contract,contract_name_cash())) selected @endif>
                                        {{contract_name_cash()}}
                                    </option>
                                    <option value="{{contract_name_partial_parceled()}}"
                                        @if (contract_payment_is($contract,contract_name_partial_parceled())) selected @endif>
                                        {{contract_name_partial_parceled()}}
                                    </option>
                                    <option value="{{contract_name_total_parceled()}}"
                                        @if (contract_payment_is($contract,contract_name_total_parceled())) selected @endif>
                                        {{contract_name_total_parceled()}}
                                    </option>
                                    <option value="{{contract_name_company_installment()}}"
                                        @if (contract_payment_is($contract,contract_name_company_installment())) selected @endif>
                                        {{contract_name_company_installment()}}
                                    </option>
                                    <option value="{{contract_name_custom()}}"
                                        @if (contract_payment_is($contract,contract_name_custom())) selected @endif>
                                        {{contract_name_custom()}}
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="payment-feedback-type-edit"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Bank Name -->
                        <div class="col-12
                            @if (contract_payment_in($contract, [contract_name_partial_parceled(), contract_name_company_installment()])) col-lg-6
                            @else col-lg-12
                            @endif
                            @if (!contract_payment_in($contract,[contract_name_partial_parceled(),contract_name_total_parceled(), contract_name_company_installment()])) d-none
                            @endif mb-3">
                            <div class="form-group">
                                <label for="contract-payment-bank" class="form-label">
                                    Nome do Banco
                                </label>
                                <input type="text" class="form-control"
                                    id="contract-payment-bank"
                                    name="payment_bank"
                                    value="{{$contract->paymentData()->bank}}">
                                <div class="invalid-feedback" id="payment-feedback-bank-edit"></div>
                            </div>
                        </div>

                        <!-- Payment Description -->
                        <div class="col-12 mb-3
                            @if (!contract_payment_in($contract,[contract_name_custom()]))
                                d-none @endif">
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
                                    onkeyup="return window.validateTextarea(this, 10, 250)"
                                    @if (contract_payment_in($contract, [contract_name_custom()]))
                                    required @endif>{{$contract->paymentData()->text}}</textarea>
                                <div class="invalid-feedback" id="payment-feedback-description-edit"></div>
                            </div>
                        </div>

                        <!-- Cash Payment -->
                        <div class="col-12 col-lg-6
                            @if (!contract_payment_in($contract, [
                                contract_name_cash(), contract_name_partial_parceled(), contract_name_company_installment()
                            ]))
                                d-none
                            @endif mb-3">
                            <div class="form-group">
                                <label for="contract-payment-cash" class="form-label">
                                    Entrada à Vista
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control"
                                        id="contract-payment-cash"
                                        name="payment_cash"
                                        value="{{format_money($contract->paymentData()->cash)}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    </div>
                                <div class="invalid-feedback" id="payment-feedback-cash-edit"></div>
                            </div>
                        </div>

                        <!-- Payment Quantity -->
                        <div class="col-12 col-lg-6
                            @if (!contract_payment_in($contract, [contract_name_company_installment()]))
                                d-none
                            @endif mb-3">
                            <div class="form-group">
                                <label for="contract-payment-quantity" class="form-label">
                                    Número de Parcelas do Saldo Restante
                                </label>
                                <input type="text" class="form-control"
                                    name="payment_quantity"
                                    id="contract-payment-quantity"
                                    value="{{$contract->paymentData()->quantity_parcel}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)">
                                <div class="invalid-feedback" id="payment-feedback-quantity-edit"></div>
                            </div>
                        </div>

                        <!-- Payment After -->
                        <div id="contract-payment-after" class="col-12 col-lg-6 mt-1 mb-3
                            @if (!contract_payment_in($contract, [
                                contract_name_cash(), contract_name_company_installment()
                            ]))
                                d-none
                            @endif">
                            <div class="form-group">
                                <label class="form-label">Pagamento Após</label>
                                <div class="form-check
                                    @if (contract_payment_in($contract, [contract_name_cash()]))
                                        d-none
                                    @else d-block
                                    @endif">
                                    <input type="radio" class="form-check-input"
                                        id="contract-payment-signature"
                                        name="payment_after_by"
                                        @if ($contract->paymentData()->payment_after_by == \App\Http\Controllers\ContractController::$PAYMENT_AFTER_SIGNATURE)
                                            checked
                                        @endif
                                        value="{{encrypt(\App\Http\Controllers\ContractController::$PAYMENT_AFTER_SIGNATURE)}}">
                                    <label class="form-check-label" for="payment_signature">
                                        {{\App\Http\Controllers\ContractController::$PAYMENT_AFTER_SIGNATURE}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" 
                                        id="contract-payment-conclusion"
                                        name="payment_after_by"
                                        @if ($contract->paymentData()->payment_after_by == \App\Http\Controllers\ContractController::$PAYMENT_AFTER_CONCLUSION)
                                        checked
                                        @endif
                                        value="{{encrypt(\App\Http\Controllers\ContractController::$PAYMENT_AFTER_CONCLUSION)}}">
                                    <label class="form-check-label" for="payment_conclusion">
                                        {{\App\Http\Controllers\ContractController::$PAYMENT_AFTER_CONCLUSION}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"
                                        id="contract-payment-homologation"
                                        name="payment_after_by"
                                        @if ($contract->paymentData()->payment_after_by == \App\Http\Controllers\ContractController::$PAYMENT_AFTER_HOMOLOGATION)
                                        checked
                                        @endif
                                        value="{{encrypt(\App\Http\Controllers\ContractController::$PAYMENT_AFTER_HOMOLOGATION)}}">
                                    <label class="form-check-label" for="payment_homologation">
                                        {{\App\Http\Controllers\ContractController::$PAYMENT_AFTER_HOMOLOGATION}}
                                    </label>
                                </div>
                                <div class="invalid-feedback" id="payment-feedback-after-edit"></div>
                            </div>
                        </div>
                    </div>
                    <div id="btn-floating">
                        <a href="{{$contract->type == 1 ? route('contracts_installation') : route('contracts_maintenance')}}"
                            class="btn btn-danger d-inline-flex align-items-center justify-content-center me-2">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                        </a>
                        <button type="button" class="btn btn-success"
                            id="btn-edit-contract"
                            onclick="window.submitFormEditContract()">
                            <i class="bi bi-save-fill"></i>
                            
                            <div class="spinner-border spinner-border-sm text-white d-none"
                                id="btn-edit-contract-loading"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </form>

         <!-- Form show equipment Invoice -->
        <form action="{{route('contracts_file_view', ['type' => encrypt('invoice'), 'id' => encrypt($contract->id)])}}"
            method="POST" target="_blank"
            enctype="multipart/form-data"
            id="form-show-invoice"
            class="align-self-center">
            @csrf
        </form>
    </section>

    <!-- Modal Generate Contract Adhesion -->
    @include ('contracts.modals.modalGenerateContractAdhesion')

    <!-- Modal Generate Contract -->
    @include ('contracts.modals.modalGenerateContract')

    <!-- Modal Generate Receipt Payment -->
    @include ('contracts.modals.modalGenerateReceiptPayment')

    <!-- Modal create Seller -->
    @include ('contracts.modals.modalCreateSeller')
    
    <!-- Modal create Seller Team -->
    @include ('contracts.modals.modalCreateSellerTeam')

    <!-- Modal show Client -->
    @include ('contracts.modals.modalShowClient')
     
    <!-- Modal create Client -->
    @include ('contracts.modals.modalCreateClient')
 
    <!-- Modal create Product -->
    @include ('contracts.modals.modalCreateProduct')
</x-app-layout>
