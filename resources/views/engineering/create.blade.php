@section('page_title', 'Criar Projeto de Engenharia')

<script src="{{asset(mix('js/engineering/create.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/addAddress.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/addCCBeneficiary.js'))}}" defer></script>
<script>
    var url_ajax_get_client_address = "{{route('engineering_get_client_address_ajax')}}";
    var url_get_default_address = "{{route('engineering_get_default_address_fetch')}}";
    var url_ajax_get_client_credentials = "{{route('engineering_get_client_credentials_ajax')}}";

    var generatorProjectTypeIndex1 = "{{encrypt('INDIVIDUAL')}}";
    var generatorProjectTypeIndex2 = "{{encrypt('AUTOCONSUMO_REMOTO')}}";
    var generatorProjectTypeIndex3 = "{{encrypt('GERACAO_COMPARTILHADA')}}";
    var generatorProjectTypeIndex4 = "{{encrypt('RESERVADO')}}";

    var beneficiaryConsumptionClassIndex1 = "{{encrypt('RESIDENCIAL')}}";
    var beneficiaryConsumptionClassIndex2 = "{{encrypt('INDUSTRIAL')}}";
    var beneficiaryConsumptionClassIndex3 = "{{encrypt('COMERCIO_SERVICOS_OUTROS')}}";
    var beneficiaryConsumptionClassIndex4 = "{{encrypt('RURAL')}}";
    var beneficiaryConsumptionClassIndex5 = "{{encrypt('PODER_PUBLICO')}}";
    var beneficiaryConsumptionClassIndex6 = "{{encrypt('ILUMINACAO_PUBLICA')}}";
    var beneficiaryConsumptionClassIndex7 = "{{encrypt('SERVICO_PUBLICO')}}";
    var beneficiaryConsumptionClassIndex8 = "{{encrypt('CONSUMO_PROPRIO')}}";

    var clients = @json($clients);
    var contractClientLogin = @json($login);
    var contractClientPassword = @json($password);

    var equipments = @json($equipments);

    equipments.forEach(equipment => {
        var url = "{{route('datasheet_view', ['type' => ':type', 'id' => ':id'])}}";
        url = url.replace(':type', equipment.type);
        url = url.replace(':id', equipment.id);

        equipment["url"] = url;
    });
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{_('Criar Projeto de Instalação')}}</h3>
                <p class="text-subtitle text-muted">{{_('Dados para execução do projeto.')}}</p>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
        <form action="{{route('engineering_project_store', ['id' => encrypt($contract->id)])}}"
            method="POST"
            id="form-create-engineering-project"
            onsubmit="return window.submitFormCreateProject()">
            @csrf
           
            <!-- Contract Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações do Contrato</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Contract Date -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <span class="fw-bold">Data de Criação:</span>
                                <p>{{$contract->created_at->format('d/m/Y')}}</p>
                            </div>
                        </div>

                        <!-- Installation Deadline -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <span class="fw-bold">Data de Conclusão:</span>
                                <p>{{date('d/m/Y', strToTime($contract->installation_deadline))}}</p>
                            </div>
                        </div>

                        <!-- Client -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <span class="fw-bold">Cliente:</span>
                                <p id="client">
                                    @if ($contract->client->is_corporate) {{$contract->client->corporate_name}}
                                    @else {{$contract->client->name}}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kit Solar -->
            <div class="card" id="generator">
                <div class="card-header">
                    <h4 id="label_generator" class="card-title">
                        Itens do Kit Solar &ndash; {!! $contract->getGeneratorPower() !!}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <!-- Structure Type -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <span class="fw-bold">Tipo de Estrutura:</span>
                                @switch ($contract->generator_structure)
                                    @case (1)
                                        <p>Solo Monoposte</p>
                                        @break
                                    
                                    @case (2)
                                        <p>Laje</p>
                                        @break
                                    
                                    @case (3)
                                        <p>Fibrocimento</p>
                                        @break
                                    
                                    @case (4)
                                        <p>Cerâmico</p>
                                        @break
                                @endswitch
                            </div>
                        </div>

                        <!-- Area -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <span class="fw-bold">Área Configurada (m<sup>2</sup>):</span>
                            <p>{{$contract->area}}</p>
                        </div>

                        <!-- Monthly Average Generation -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <span class="fw-bold">Geração Média Mensal (kWh):</span>
                            <p id="monthly-avg-generation">{{$contract->monthly_avg_generation}}</p>
                        </div>

                        <!-- Products Generator -->
                        <div class="col-12 col-md-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-hover" id="editable-table" name="editable-table">
                                    <thead class="border border-gray bg-blue-lighten">
                                        <tr>
                                            <th scope="col" class="text-primary ps-4 pt-3 pe-4 pb-3">Produto</th>
                                            <th scope="col" class="text-primary ps-4 pt-3 pe-4 pb-3">Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border border-gray pt-4 pb-2">
                                        @foreach ($contract->contractsProducts() as $product)
                                            <tr>
                                                <td class="ps-4 pt-3 pe-4 pb-3">{{$product->name}}</td>
                                                <td class="ps-4 pt-3 pe-4 pb-3">{{$product->quantity}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tecnical Informations -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações Técnicas</h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="address-informations">
                        <div class="accordion-item" id="address-1" data-address-item>
                            <h2 class="accordion-header" id="address-heading-1">
                                <button class="accordion-button fw-bold text-primary" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#address-collapse-1"
                                    aria-expanded="true" aria-controls="address-collapse-1">
                                    Geradora 1
                                </button>
                            </h2>
                            <div id="address-collapse-1" class="accordion-collapse collapse show" 
                                aria-labelledby="address-heading-1" 
                                data-bs-parent="#address-informations">
                                <div class="accordion-body">
                                    <div class="row mt-3">
                                        <!-- Project Type -->
                                        <div class="col-12 col-md-4 mb-4">
                                            <div class="form-group">
                                                <label for="project-type-1" class="form-label">Tipo de Projeto</label>
                                                <select class="form-select" aria-label="project-type-1"
                                                    id="project-type-1"
                                                    name="project[generator-1][generator-project-type]"
                                                    onchange="return window.changeProjectType(this), window.validateSelect(this), window.enableBtnAddAddress(this)"
                                                    onblur="return window.validateSelect(this), window.enableBtnAddAddress(this)">
                                                    <option value="" disabled selected>
                                                        Escolha o tipo de projeto
                                                    </option>
                                                    <option value="{{encrypt('INDIVIDUAL')}}">
                                                        Individual
                                                    </option>
                                                    <option value="{{encrypt('AUTOCONSUMO_REMOTO')}}">
                                                        Autoconsumo Remoto
                                                    </option>
                                                    <option value="{{encrypt('GERACAO_COMPARTILHADA')}}">
                                                        Geração Compartilhada
                                                    </option>
                                                    <option value="{{encrypt('RESERVADO')}}">
                                                        Reservado
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback" id="type-1-feedback-project"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <!-- Checkbox Client -->
                                        <div class="col-12 mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="chk-add-generator-client-1"
                                                    name="chk-add-generator-client"
                                                    @if (old('chk-add-generator-client') === 'on') checked @endif
                                                    onchange="return window.checkIfAddClient(this)">
                                                <label class="form-check-label" for="chk-add-generator-client-1">
                                                    Cliente diferente do contrato?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Generator Client -->
                                        <div class="col-12 col-md-6 mb-3 d-none" id="generator-client-1">
                                            <div class="form-group">
                                                <label for="project-generator-client-1" class="form-label">
                                                    Cliente
                                                </label>
                                                <input class="form-control" type="text"
                                                    id="project-generator-client-1" 
                                                    name="project[generator-1][generator-client]">
                                                <div class="invalid-feedback"
                                                    id="client-generator-1-feedback-project"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <!-- Checkbox client address -->
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="form-group">
                                                <div class="form-check form-switch">
                                                    <div class="spinner-border spinner-border-sm text-warning d-none ms-2 mb-1" style="margin-right: .74rem"
                                                        id="loading-client-address-1"
                                                        role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <label class="form-check-label fw-normal"
                                                        style="color: #607080"
                                                        for="chk-same-contract-address-1">
                                                        Usar o endereço do cliente
                                                    </label>
                                                    <input class="form-check-input" type="checkbox"
                                                        id="chk-same-contract-address-1"
                                                        name="chk-same-contract-address"
                                                        value="{{old('chk-same-contract-address')}}"
                                                        onchange="return window.setSameContractInstallationAddress(this)">
                                                </div>                                
                                            </div>
                                        </div>

                                        <!-- Checkbox default generator address -->
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="form-group">
                                                <div class="form-check form-switch">
                                                    <div class="spinner-border spinner-border-sm text-warning d-none ms-2 mb-1" style="margin-right: .74rem"
                                                        id="loading-default-address-1"
                                                        role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <label class="form-check-label fw-normal"
                                                        style="color: #607080"
                                                        for="chk-default-address-1">
                                                        Usar o endereço Sunny Park
                                                    </label>
                                                    <input class="form-check-input" type="checkbox"
                                                        id="chk-default-address-1"
                                                        name="chk-default-address"
                                                        value="{{old('chk-default-address')}}"
                                                        onchange="return window.setDefaultGeneratorAddress(this)">
                                                </div>                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- CEP -->
                                        <div class="col-12 col-lg-3 mb-3">
                                            <div class="form-group">
                                                <label for="project-cep-1" class="form-label">CEP</label>
                                                <input class="form-control" type="text"
                                                    id="project-cep-1"
                                                    name="project[generator-1][generator-cep]"
                                                    onchange="return window.fillInAddressFields(this), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this), window.validateCep(this)"
                                                    onblur="return window.validateCep(this), window.fillInAddressFields(this)"
                                                    onkeyup="return window.validateInput(this, 2)"
                                                    data-address>
                                                <div class="invalid-feedback" id="cep-1-feedback-project"></div>
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="col-12 col-lg-7 mb-3">
                                            <div class="form-group">
                                                <label for="project-address-1" class="form-label">Endereço</label>
                                                <input class="form-control" type="text"
                                                    id="project-address-1"
                                                    name="project[generator-1][generator-address]"
                                                    onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                    onblur="return window.validateInput(this, 2)"
                                                    onkeyup="return window.validateInput(this, 2)"
                                                    data-address>
                                                <div class="invalid-feedback"
                                                    id="address-1-feedback-project"></div>
                                            </div>
                                        </div>

                                        <!-- Number -->
                                        <div class="col-12 col-lg-2 mb-3">
                                            <div class="form-group">
                                                <label for="project-number-1" class="form-label">
                                                    Número/Apt.
                                                </label>
                                                <input class="form-control" type="text"
                                                    id="project-number-1"
                                                    name="project[generator-1][generator-number]"
                                                    onchange="return window.validateInput(this, 1), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                    onblur="return window.validateInput(this, 1)"
                                                    onkeyup="return window.validateInput(this, 1)"
                                                    data-address>
                                                <div class="invalid-feedback" id="number-1-feedback-project"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Complement -->
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="project-complement-1" class="form-label">
                                                    Complemento
                                                </label>
                                                <input class="form-control" type="text"
                                                    id="project-complement-1"
                                                    name="project[generator-1][generator-complement]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Neighborhood -->
                                        <div class="col-12 col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label for="project-neighborhood-1" class="form-label">
                                                    Bairro
                                                </label>
                                                <input class="form-control" type="text"
                                                    name="project[generator-1][generator-neighborhood]" 
                                                    id="project-neighborhood-1"
                                                    onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                    onblur="return window.validateInput(this, 2)"
                                                    onkeyup="return window.validateInput(this, 2)"
                                                    data-address>
                                                <div class="invalid-feedback"
                                                    id="neighborhood-1-feedback-project"></div>
                                            </div>
                                        </div>

                                        <!-- City -->
                                        <div class="col-12 col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label for="project-city-1" class="form-label">Cidade</label>
                                                <input class="form-control" type="text"
                                                    id="project-city-1"
                                                    name="project[generator-1][generator-city]"
                                                    onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                    onblur="return window.validateInput(this, 2)"
                                                    onkeyup="return window.validateInput(this, 2)"
                                                    data-address>
                                                <div class="invalid-feedback" id="city-1-feedback-project"></div>
                                            </div>
                                        </div>

                                        <!-- State -->
                                        <div class="col-12 col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label for="project-state-1" class="form-label">Estado</label>
                                                <input class="form-control" type="text"
                                                    id="project-state-1"
                                                    name="project[generator-1][generator-state]"
                                                    onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                    onblur="return window.validateInput(this, 2)"
                                                    onkeyup="return window.validateInput(this, 2)"
                                                    data-address>
                                                <div class="invalid-feedback" id="state-1-feedback-project"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Generator Power -->
                                        <div class="col-12 col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="project-generator-power-1" class="form-label">
                                                    Potência da Geradora
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                        id="project-generator-power-1"
                                                        name="project[generator-1][generator-power]"
                                                        readonly>
                                                    <span class="input-group-text">kWp</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Contracted kWp Production -->
                                        <div class="col-12 col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="generator-contracted-generation-production-1"
                                                    class="form-label">
                                                    Produção do kWp Contratado
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                        id="generator-contracted-generation-production-1"
                                                        readonly>
                                                    <span class="input-group-text">kWh</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Estimated kWp Production -->
                                        <div class="col-12 col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="generator-estimated-generation-production-1"
                                                    class="form-label">
                                                    Produção do kWp Estimado
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                        id="generator-estimated-generation-production-1"
                                                        readonly>
                                                    <span class="input-group-text">kWh</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Generator Contract Account -->
                                        <div class="col-12 col-md-5 mb-3">
                                            <div class="@if ($contract->client->login != null && $contract->client->password != null) d-none @endif"    
                                                id="generator-contract-account-input-1">
                                                <div class="form-group">
                                                    <label for="project-cc-generator-input-1" class="form-label">
                                                        Conta Contrato Geradora
                                                    </label>
                                                    <input class="form-control" type="text" 
                                                        id="project-cc-generator-input-1"
                                                        name="project[generator-1][generator-contract-account]"
                                                        onchange="return window.validateInput(this, 1), window.enableBtnAddAddress(this)"
                                                        onblur="return window.validateInput(this, 1), window.enableBtnAddAddress(this)"
                                                        onkeyup="return window.validateInput(this, 1), window.enableBtnAddAddress(this)"
                                                        maxlength="12"
                                                        data-address>
                                                    <div class="invalid-feedback" 
                                                        id="cc-generator-input-1-feedback-project"></div>
                                                </div>
                                            </div>
                                            <div class="@if ($contract->client->login == null && $contract->client->password == null) d-none @endif" 
                                                id="generator-contract-account-select-1">
                                                <div class="form-group">
                                                    <label for="project-cc-generator-select-1" class="form-label">
                                                        Conta Contrato Geradora
                                                    </label>
                                                    <select class="form-select" 
                                                        aria-label="project-cc-generator-select-1"
                                                        id="project-cc-generator-select-1"
                                                        name="project[generator-1][generator-contract-account]"
                                                        onchange="return window.validateSelect(this, 1), window.enableBtnAddAddress(this), window.setDifferentGeneratorContractAccount(this)"
                                                        onblur="return window.validateSelect(this, 1), window.setDifferentGeneratorContractAccount(this)">
                                                        <option value="" disabled selected>
                                                            Selecione a conta contrato
                                                        </option>
                                                    </select>
                                                    <div class="invalid-feedback"
                                                        id="cc-generator-select-1-feedback-project"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Other generator contract account -->
                                        <div class="col-12 col-md-4 mb-3 d-none"
                                            id="other-generator-contract-account-1">    
                                            <div class="form-group">
                                                <label for="project-other-cc-generator-1" class="form-label">
                                                    Outra Conta Contrato Geradora
                                                </label>
                                                <input class="form-control" type="text" 
                                                    id="project-other-cc-generator-1"
                                                    name="project[generator-1][generator-other-contract-account]"
                                                    onchange="return window.validateInput(this, 1)"
                                                    onblur="return window.validateInput(this, 1)"
                                                    onkeyup="return window.validateInput(this, 1)"
                                                    maxlength="12">
                                                <div class="invalid-feedback" 
                                                    id="cc-other-generator-1-feedback-project"></div>
                                            </div>
                                        </div>

                                        <!-- Generator Consumption -->
                                        <div class="col-12 col-md-3 mb-3 d-none">
                                            <div class="form-group">
                                                <label for="project-generator-consumption-1" class="form-label">
                                                    Consumo da Geradora
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                        id="project-generator-consumption-1"
                                                        name="project[generator-1][generator-consumption]"
                                                        onchange="return window.handleGeneratorConsumption(this), window.validateInput(this, 1), window.enableBtnAddAddress(this), window.validateGeneratorConsumption(this)"
                                                        onblur="return window.handleGeneratorConsumption(this), window.validateInput(this, 1), window.validateGeneratorConsumption(this)"
                                                        onkeyup="return window.handleGeneratorConsumption(this), window.validateInput(this, 1), window.validateGeneratorConsumption(this)">
                                                    <span class="input-group-text">kWh</span>
                                                </div>
                                                <div class="invalid-feedback" 
                                                    id="generator-consumption-1-feedback-project"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Generator Equipments -->
                                    <div class="card mt-4">
                                        <div class="card-header border border-gray rounded-top bg-light bg-gradient p-3 ps-3">
                                            <h6 class="mb-0 text-primary" id="equipment-oversizing-info-1">
                                                Equipamentos
                                                <p class="mb-0 mt-2" id="equipment-oversizing-percentage-1"></p>
                                            </h6>
                                        </div>
                                        <div class="card-body border border-gray rounded-bottom border-top-0 pt-4 pb-0">
                                            <div class="row mb-4">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="col-7 text-center">Produto</th>
                                                                <th scope="col" class="text-center">Quantidade</th>
                                                                <th scope="col" class="text-center">Datasheet</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="border-0">
                                                            @foreach ($equipments as $key_equipment => $equipment)
                                                                <tr>
                                                                    <input type="hidden"
                                                                        name="project[generator-1][equipments][equipment-{{$key_equipment + 1}}][equipment-id]" value="{{$equipment['id']}}">
                                                                    <input type="hidden"
                                                                        name="project[generator-1][equipments][equipment-{{$key_equipment + 1}}][type]" value="{{$equipment['type']}}">
                                                                    <td class="form-group pt-4">
                                                                        <span>
                                                                            {{$equipment['name']}}
                                                                        </span>
                                                                        <input class="form-control"   
                                                                            type="hidden"
                                                                            id="equipment-name-{{$equipment['category']}}-1-{{$key_equipment + 1}}"
                                                                            name="project[generator-1][equipments][equipment-{{$key_equipment + 1}}][name]"
                                                                            value="{{$equipment['name']}}"
                                                                            readonly>
                                                                    </td>
                                                                    <td class="form-group pt-4">
                                                                        <select class="form-select" 
                                                                            aria-label="equipment-quantity-{{$equipment['category']}}-1-{{$key_equipment + 1}}"
                                                                            id="equipment-quantity-{{$equipment['category']}}-1-{{$key_equipment + 1}}"
                                                                            name="project[generator-1][equipments][equipment-{{$key_equipment + 1}}][quantity]" onchange="return window.validateSelect(this, 1), window.validateEquipmentQuantity(this), window.getOversizingInfo(this)"
                                                                            onblur="return window.validateSelect(this, 1), window.validateEquipmentQuantity(this), window.getOversizingInfo(this)"
                                                                            data-equipment-{{$equipment['category']}}="{{$equipment['name']}}">
                                                                            <option value="" disabled>
                                                                                Selecione a quantidade
                                                                            </option>
                                                                            
                                                                            @for ($i = 0; $i <= $equipment['quantity']; $i++)
                                                                                <option value="{{$i}}"
                                                                                    @if ($equipment['quantity'] == $i)
                                                                                        selected
                                                                                    @endif>
                                                                                    {{$i}}
                                                                                </option>
                                                                            @endfor
                                                                        </select>
                                                                        <span class="invalid-feedback" 
                                                                            id="equipment-quantity-{{$equipment['category']}}-1-{{$key_equipment + 1}}-feedback-project"></span>
                                                                    </td>
                                                                    <td class="text-center pt-4">
                                                                        <a href="{{route('datasheet_view', ['type' => $equipment['type'], 'id' => $equipment['id']])}}" target="_blank"
                                                                            class="btn bg-primary text-white
                                                                            @if ($equipment['datasheet_path'] === null || $equipment['datasheet_path'] === '') disabled @endif">
                                                                            <i class="bi bi-file-earmark-pdf-fill"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-none" data-beneficiaries>
                                        <div class="accordion" id="cc-beneficiaries-1">
                                            <div class="accordion-item" id="beneficiary-1-1" data-beneficiary-item>
                                                <h2 class="accordion-header" id="beneficiary-heading-1-1">
                                                    <button class="accordion-button fw-bold bg-light bg-gradient text-primary" type="button"
                                                        data-bs-toggle="collapse" 
                                                        data-bs-target="#beneficiary-collapse-1-1"
                                                        aria-expanded="true" aria-controls="beneficiary-collapse-1-1">
                                                        Beneficiária 1
                                                    </button>
                                                </h2>
                                                <div id="beneficiary-collapse-1-1"
                                                    class="accordion-collapse collapse show" 
                                                    aria-labelledby="beneficiary-heading-1-1"
                                                    data-bs-parent="#cc-beneficiaries-1">
                                                    <div class="accordion-body">
                                                        <div class="d-none" id="beneficiary-client-1-1">
                                                            <div class="row mt-3">
                                                                <div class="col-12 mb-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="chk-add-beneficiary-client-1-1"
                                                                            onchange="return window.checkIfAddClientBeneficiary(this)">
                                                                        <label class="form-check-label" for="chk-add-beneficiary-client-1-1">
                                                                            Cliente diferente da Geradora?
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- Beneficiary Client -->
                                                                <div class="col-12 col-md-6 mb-3 d-none" 
                                                                    id="client-beneficiary-1-1">
                                                                    <div class="form-group">
                                                                        <label for="project-beneficiary-client-1-1" 
                                                                            class="form-label">
                                                                            Cliente
                                                                        </label>
                                                                        <input class="form-control" type="text"
                                                                            id="project-beneficiary-client-1-1" 
                                                                            name="project[generator-1][beneficiaries][address-1][beneficiary-client]">
                                                                        <div class="invalid-feedback" 
                                                                            id="client-beneficiary-1-1-feedback-project"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Beneficiary Contract Account -->
                                                            <div class="col-12 col-md-6 mb-3">
                                                                <div class="@if ($contract->client->login != null && $contract->client->password != null) d-none @endif"    
                                                                    id="beneficiary-contract-account-input-1-1">
                                                                    <div class="form-group">
                                                                        <label for="project-cc-beneficiary-input-1-1"
                                                                            class="form-label">
                                                                            Conta Contrato Beneficiária
                                                                        </label>
                                                                        <input class="form-control" type="text" 
                                                                            id="project-cc-beneficiary-input-1-1"
                                                                            name="project[generator-1][beneficiaries][address-1][beneficiary-contract-account]"
                                                                            onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"
                                                                            onblur="return window.validateInput(this, 1)"
                                                                            onkeyup="return window.validateInput(this, 1)"
                                                                            maxlength="12"
                                                                            data-beneficiary>
                                                                        <div class="invalid-feedback" 
                                                                            id="cc-beneficiary-input-1-1-feedback-project"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="@if ($contract->client->login == null && $contract->client->password == null) d-none @endif" 
                                                                    id="beneficiary-contract-account-select-1-1">
                                                                    <div class="form-group">
                                                                        <label for="project-cc-beneficiary-select-1-1"
                                                                            class="form-label">
                                                                            Conta Contrato Beneficiária
                                                                        </label>
                                                                        <select class="form-select" 
                                                                            aria-label="project-cc-beneficiary-select-1-1" id="project-cc-beneficiary-select-1-1"
                                                                            name="project[generator-1][beneficiaries][address-1][beneficiary-contract-account]"
                                                                            onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"
                                                                            onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)">
                                                                            <option value="" disabled selected>
                                                                                Selecione a conta contrato
                                                                            </option>
                                                                        </select>
                                                                        <div class="invalid-feedback"
                                                                            id="cc-beneficiary-select-1-1-feedback-project"></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Other beneficiary contract account -->
                                                            <div class="col-12 col-md-6 mb-3 d-none"
                                                                id="other-beneficiary-contract-account-1-1">
                                                                <div class="form-group">
                                                                    <label for="project-other-cc-beneficiary-1-1"
                                                                        class="form-label">
                                                                        Outra Conta Contrato Beneficiária
                                                                    </label>
                                                                    <input class="form-control" type="text" 
                                                                        id="project-other-cc-beneficiary-1-1"
                                                                        name="project[generator-1][beneficiaries][address-1][beneficiary-other-contract-account]"
                                                                        onchange="return window.validateInput(this, 1)"
                                                                        onblur="return window.validateInput(this, 1)"
                                                                        onkeyup="return window.validateInput(this, 1)"
                                                                        maxlength="12">
                                                                    <div class="invalid-feedback" 
                                                                        id="cc-other-beneficiary-1-1-feedback-project">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Consumption Class -->
                                                            <div class="col-12 col-md-6 mb-3">
                                                                <div class="form-group">
                                                                    <label  
                                                                        for="project-beneficiary-consumption-class-1-1" 
                                                                        class="form-label">
                                                                        Classe de Consumo
                                                                    </label>
                                                                    <select class="form-select"
                                                                        aria-label="project-beneficiary-consumption-class-1-1"
                                                                        id="project-beneficiary-consumption-class-1-1"
                                                                        name="project[generator-1][beneficiaries][address-1][beneficiary-consumption-class]"
                                                                        onchange="return window.validateSelect(this), window.enableBtnAddBeneficiary(this)"
                                                                        onblur="return window.validateSelect(this)"
                                                                        data-beneficiary>
                                                                        <option value="" disabled selected>
                                                                            Escolha a classe de consumo
                                                                        </option>
                                                                        <option value="{{encrypt('RESIDENCIAL')}}">
                                                                            Residencial
                                                                        </option>
                                                                        <option value="{{encrypt('INDUSTRIAL')}}">
                                                                            Industrial
                                                                        </option>
                                                                        <option value="{{encrypt('COMERCIO_SERVICOS_OUTROS')}}">
                                                                            Comércio, Serviço e outras atividades
                                                                        </option>
                                                                        <option value="{{encrypt('RURAL')}}">
                                                                            Rural
                                                                        </option>
                                                                        <option value="{{encrypt('PODER_PUBLICO')}}">
                                                                            Poder Público
                                                                        </option>
                                                                        <option value="{{encrypt('ILUMINACAO_PUBLICA')}}">
                                                                            Iluminação Pública
                                                                        </option>
                                                                        <option value="{{encrypt('SERVICO_PUBLICO')}}">
                                                                            Serviço Público
                                                                        </option>
                                                                        <option value="{{encrypt('CONSUMO_PROPRIO')}}">
                                                                            Consumo Próprio
                                                                        </option>
                                                                    </select>
                                                                    <div class="invalid-feedback" 
                                                                        id="beneficiary-consumption-class-1-1-feedback-project">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Rate -->
                                                            <div class="col-12 col-md-6 mb-3">
                                                                <div class="form-group">
                                                                    <label for="project-beneficiary-rate-1-1"
                                                                        class="form-label">
                                                                        Rateio
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <input class="form-control" type="text" 
                                                                            id="project-beneficiary-rate-1-1"
                                                                            name="project[generator-1][beneficiaries][address-1][beneficiary-rate]"
                                                                            onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"
                                                                            onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                            onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                            data-beneficiary>
                                                                        <span class="input-group-text rounded-end">
                                                                            %
                                                                        </span>
                                                                        <span class="input-group-text bg-secondary text-white ms-4 rounded" 
                                                                            id="rate-monthly-avg-generation-1-1"></span>
                                                                    </div>
                                                                    <div class="invalid-feedback" 
                                                                        id="beneficiary-rate-1-1-feedback-project"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Address -->
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="project-beneficiary-address-1-1" 
                                                                        class="form-label">
                                                                        Endereço
                                                                    </label>
                                                                    <input class="form-control" type="text"
                                                                        id="project-beneficiary-address-1-1"
                                                                        name="project[generator-1][beneficiaries][address-1][beneficiary-address]"
                                                                        onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"
                                                                        onblur="return window.validateInput(this, 2)"
                                                                        onkeyup="return window.validateInput(this, 2)"
                                                                        data-beneficiary>
                                                                    <div class="invalid-feedback" 
                                                                        id="beneficiary-address-1-1-feedback-project">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- button Add CC Beneficiary -->
                                        <div class="row justify-content-end mt-4 mb-4">
                                            <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-end">
                                                <div class="form-group">
                                                    <button class="btn btn-warning d-flex justify-content-center 
                                                        align-items-center btn-add-beneficiary" type="button"
                                                        id="btn-add-beneficiary-1"
                                                        onclick="return window.addCCBeneficiary(this)"
                                                        disabled>
                                                        <i class="bi bi-plus-circle-fill me-2"></i>
                                                        Adicionar Beneficiária
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- button Add Generator -->
                    <div class="row justify-content-end mt-4 mb-5">
                        <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-end">
                            <div class="form-group">
                                <button class="btn btn-warning d-flex justify-content-center align-items-center" 
                                    type="button"
                                    id="btn-add-address"
                                    onclick="return window.addAddress(this)"
                                    disabled>
                                    <i class="bi bi-plus-circle-fill me-2"></i>
                                    Adicionar Geradora
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Observations -->
                        <div class="col-12 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="project-observation" class="form-label">
                                    Observações (opcional)
                                </label>
                                <textarea class="form-control" id="project-observation"
                                    name="project-observation"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="float-end mt-5">
                        <a href="{{route('contracts_edit', ['type' => 'installation', 'id' => encrypt($contract->id)])}}" class="btn bg-danger text-white me-2">
                            Cancelar
                        </a>
                        <button type="submit" class="btn bg-success text-white d-inline-flex align-items-center"
                            id="btn-create-project">
                            Criar Projeto
                        </button>
                    </div>
                </div>                
            </div>
        </form>
    </div>
</x-app-layout>