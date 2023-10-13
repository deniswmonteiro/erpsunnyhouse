@section('page_title', 'Editar Projeto de Engenharia')

<script src="{{asset(mix('js/engineering/edit.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/editAddAddress.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/editAddCCBeneficiary.js'))}}" defer></script>
<script>
    var url_ajax_get_client_address = "{{route('engineering_get_client_address_ajax')}}";
    var url_get_default_address = "{{route('engineering_get_default_address_fetch')}}";
    var url_ajax_get_client_credentials = "{{route('engineering_get_client_credentials_ajax')}}";
    var url_fetch_get_generator_data = "{{route('engineering_get_generator_data_fetch')}}";
    var url_fetch_get_beneficiary_data = "{{route('engineering_get_beneficiary_data_fetch')}}";

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
    
    var totalBeneficiaries = @json($total_beneficiaries);
    var arrGeneratorHasBeneficiaries = @json($generator_has_beneficiaries);
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

    var observations = @json($observations);
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{_('Editar Projeto de Engenharia')}}</h3>
                <p class="text-subtitle text-muted">{{_('Dados do projeto.')}}</p>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
        <form action="{{route('engineering_project_update', ['id' => encrypt($project->id)])}}"
            method="POST" enctype="multipart/form-data"
            id="form-update-engineering-project"
            onsubmit="return window.submitFormEditProject()">
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
                                <p>{{$project->contract->created_at->format('d/m/Y')}}</p>
                            </div>
                        </div>

                        <!-- Installation Deadline -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <span class="fw-bold">Data de Conclusão:</span>
                                <p>{{date('d/m/Y', strToTime($project->contract->installation_deadline))}}</p>
                            </div>
                        </div>

                        <!-- Client -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <span class="fw-bold">Cliente:</span>
                                <p id="client">
                                    @if ($project->contract->client->is_corporate)
                                        {{$project->contract->client->corporate_name}}
                                    @else {{$project->contract->client->name}}
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
                        Itens do Kit Solar &ndash; {!! $project->contract->getGeneratorPower() !!}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <!-- Structure Type -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <span class="fw-bold">Tipo de Estrutura:</span>
                                <p>
                                    @switch ($project->contract->generator_structure)
                                        @case (1)
                                            Solo Monoposte
                                            @break
                                        
                                        @case (2)
                                            Laje
                                            @break
                                        
                                        @case (3)
                                            Fibrocimento
                                            @break
                                        
                                        @case (4)
                                            Cerâmico
                                            @break
                                    @endswitch
                                </p>
                            </div>
                        </div>

                        <!-- Area -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <span class="fw-bold">Área Configurada (m<sup>2</sup>):</span>
                            <p>{{$project->contract->area}}</p>
                        </div>

                        <!-- Monthly Average Generation -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <span class="fw-bold">Geração Média Mensal (kWh):</span>
                            <p id="monthly-avg-generation">{{$project->contract->monthly_avg_generation}}</p>
                        </div>

                        <!-- Products Generator -->
                        <div class="col-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="border border-gray bg-blue-lighten">
                                        <tr>
                                            <th scope="col" class="text-primary ps-4 pt-3 pe-4 pb-3">Produto</th>
                                            <th scope="col" class="text-primary ps-4 pt-3 pe-4 pb-3">Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border border-gray pt-4 pb-2">
                                        @foreach ($project->contract->contractsProducts() as $product)
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
                        <!-- Generator -->
                        @foreach ($generators as $gen_key => $generator)
                            <div class="accordion-item" id="address-{{$gen_key + 1}}" data-address-item>
                                <h2 class="accordion-header @if ($gen_key + 1 != 1) d-flex @endif"
                                    id="address-heading-{{$gen_key + 1}}">
                                    <button class="accordion-button fw-bold text-primary"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#address-collapse-{{$gen_key + 1}}"
                                        
                                        @if ($gen_key + 1 == 1)
                                            aria-expanded="true"
                                        @else
                                            aria-expanded="false"
                                        @endif
                                            
                                        aria-controls="address-collapse-{{$gen_key + 1}}">
                                        Geradora {{$gen_key + 1}}
                                    </button>

                                    @if ($gen_key + 1 != 1)
                                        <button type="button" class="btn btn-danger rounded-0 rounded-end"
                                            data-bs-toggle="modal"
                                            data-bs-dismiss="modal"
                                            data-bs-target="#modal-delete-generator-{{$gen_key + 1}}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    @endif
                                </h2>
                                <div id="address-collapse-{{$gen_key + 1}}" 
                                    class="accordion-collapse collapse @if ($gen_key + 1 == 1) show @endif"
                                    aria-labelledby="address-heading-{{$gen_key + 1}}" 
                                    data-bs-parent="#address-informations">
                                    <div class="accordion-body">
                                        <input type="hidden"
                                            id="edit-generator-id-{{$gen_key + 1}}"
                                            name="project[generator-{{$gen_key + 1}}][generator-id]" 
                                            value="{{encrypt($generator->id)}}">
                                        <div class="row mt-3">
                                            <!-- Project Type -->
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="project-type-{{$gen_key + 1}}" class="form-label">
                                                        Tipo de Projeto
                                                    </label>
                                                    <select class="form-select"
                                                        aria-label="project-type-{{$gen_key + 1}}"
                                                        id="project-type-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-project-type]"
                                                        onchange="return window.changeProjectType(this), window.validateProjectType(this), window.enableBtnAddAddress(this)"
                                                        onblur="return window.validateProjectType(this), window.enableBtnAddAddress(this)">
                                                        <option value="" disabled selected>
                                                            Escolha o tipo de projeto
                                                        </option>
                                                        <option value="{{encrypt('INDIVIDUAL')}}"
                                                            @if ($generator->generator_project_type == 'INDIVIDUAL') selected @endif>
                                                            Individual
                                                        </option>
                                                        <option value="{{encrypt('AUTOCONSUMO_REMOTO')}}"
                                                            @if ($generator->generator_project_type == 'AUTOCONSUMO_REMOTO') selected @endif>
                                                            Autoconsumo Remoto
                                                        </option>
                                                        <option value="{{encrypt('GERACAO_COMPARTILHADA')}}"
                                                            @if ($generator->generator_project_type == 'GERACAO_COMPARTILHADA') selected @endif>
                                                            Geração Compartilhada
                                                        </option>
                                                        <option value="{{encrypt('RESERVADO')}}"
                                                            @if ($generator->generator_project_type == 'RESERVADO') selected @endif>
                                                            Reservado
                                                        </option>
                                                    </select>

                                                    <div class="invalid-feedback"
                                                        id="type-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <!-- Checkbox Client -->
                                            <div class="col-12 mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="chk-add-generator-client-{{$gen_key + 1}}"
                                                        name="chk-add-generator-client"
                                                        @if ($generator->client != null)
                                                            {{
                                                                $project->contract->client->id != $generator->client->id ?
                                                                    'checked' :
                                                                    ''
                                                            }}
                                                        @endif
                                                        onchange="return window.checkIfAddClient(this)">
                                                    <label class="form-check-label"
                                                        for="chk-add-generator-client-{{$gen_key + 1}}">
                                                        Cliente diferente do contrato?
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Generator Client -->
                                            <div class="col-12 col-md-6 mb-3
                                                @if ($generator->client != null)
                                                    {{ $project->contract->client->id != $generator->client->id ?
                                                        '' :
                                                        'd-none' }}
                                                @endif"
                                                id="generator-client-{{$gen_key + 1}}">
                                                <div class="form-group">
                                                    <label for="project-generator-client-{{$gen_key + 1}}" 
                                                        class="form-label">
                                                        Cliente
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        id="project-generator-client-{{$gen_key + 1}}" 
                                                        name="project[generator-{{$gen_key + 1}}][generator-client]"
                                                        value="{{
                                                            $generator->client != null ?
                                                                ($generator->client->is_corporate ? 
                                                                    $generator->client->corporate_name :
                                                                    $generator->client->name) : ('')
                                                            }}">
                                                    <div class="invalid-feedback"
                                                        id="client-generator-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <!-- Checkbox client address -->
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <div class="spinner-border spinner-border-sm text-warning d-none ms-2 mb-1" style="margin-right: .74rem"
                                                            id="loading-client-address-{{$gen_key + 1}}"
                                                            role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <label class="form-check-label fw-normal" 
                                                            style="color: #607080"
                                                            for="chk-same-contract-address-{{$gen_key + 1}}">
                                                            Usar o endereço do cliente
                                                        </label>
                                                        <input class="form-check-input" type="checkbox"
                                                            id="chk-same-contract-address-{{$gen_key + 1}}"
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
                                                            id="loading-default-address-{{$gen_key + 1}}"
                                                            role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <label class="form-check-label fw-normal"
                                                            style="color: #607080"
                                                            for="chk-default-address-{{$gen_key + 1}}">
                                                            Usar o endereço Sunny Park
                                                        </label>
                                                        <input class="form-check-input" type="checkbox"
                                                            id="chk-default-address-{{$gen_key + 1}}"
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
                                                    <label for="project-cep-{{$gen_key + 1}}" class="form-label">
                                                        CEP
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        id="project-cep-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-cep]"
                                                        value="{{$generator->generator_cep}}"
                                                        onchange="return window.fillInAddressFields(this), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this), window.validateCep(this)"
                                                        onblur="return window.validateCep(this), window.fillInAddressFields(this)"
                                                        onkeyup="return window.validateInput(this, 2)"
                                                        data-address>
                                                    <div class="invalid-feedback" 
                                                        id="cep-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-12 col-lg-7 mb-3">
                                                <div class="form-group">
                                                    <label for="project-address-{{$gen_key + 1}}" class="form-label">
                                                        Endereço
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        id="project-address-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-address]"
                                                        value="{{$generator->generator_address}}"
                                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                        onblur="return window.validateInput(this, 2)"
                                                        onkeyup="return window.validateInput(this, 2)"
                                                        data-address>
                                                    <div class="invalid-feedback"
                                                        id="address-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>

                                            <!-- Number -->
                                            <div class="col-12 col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="project-number-{{$gen_key + 1}}" class="form-label">
                                                        Número/Apt.
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        id="project-number-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-number]"
                                                        value="{{$generator->generator_number}}"
                                                        onchange="return window.validateInput(this, 1), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                        onblur="return window.validateInput(this, 1)"
                                                        onkeyup="return window.validateInput(this, 1)"
                                                        data-address>
                                                    <div class="invalid-feedback"
                                                        id="number-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Complement -->
                                            <div class="col-12 mb-3">
                                                <div class="form-group">
                                                    <label for="project-complement-{{$gen_key + 1}}" 
                                                        class="form-label">
                                                        Complemento
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        id="project-complement-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-complement]"
                                                        value="{{$generator->generator_complement}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Neighborhood -->
                                            <div class="col-12 col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="project-neighborhood-{{$gen_key + 1}}" 
                                                        class="form-label">
                                                        Bairro
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        id="project-neighborhood-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-neighborhood]" 
                                                        value="{{$generator->generator_neighborhood}}"
                                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                        onblur="return window.validateInput(this, 2)"
                                                        onkeyup="return window.validateInput(this, 2)"
                                                        data-address>
                                                    <div class="invalid-feedback"
                                                        id="neighborhood-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>

                                            <!-- City -->
                                            <div class="col-12 col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="project-city-{{$gen_key + 1}}" class="form-label">
                                                        Cidade
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        id="project-city-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-city]"
                                                        value="{{$generator->generator_city}}"
                                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                        onblur="return window.validateInput(this, 2)"
                                                        onkeyup="return window.validateInput(this, 2)"
                                                        data-address>
                                                    <div class="invalid-feedback"
                                                        id="city-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>

                                            <!-- State -->
                                            <div class="col-12 col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="project-state-{{$gen_key + 1}}" class="form-label">
                                                        Estado
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        id="project-state-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-state]"
                                                        value="{{$generator->generator_state}}"
                                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                                        onblur="return window.validateInput(this, 2)"
                                                        onkeyup="return window.validateInput(this, 2)"
                                                        data-address>
                                                    <div class="invalid-feedback"
                                                        id="state-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Generator Power -->
                                            <div class="col-12 col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="project-generator-power-{{$gen_key + 1}}" 
                                                        class="form-label">
                                                        Potência da Geradora
                                                    </label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="text"
                                                            id="project-generator-power-{{$gen_key + 1}}"
                                                            name="project[generator-{{$gen_key + 1}}][generator-power]"
                                                            value="{{Str::replaceFirst('.', ',', $generator->generator_power)}}"
                                                            readonly>
                                                        <span class="input-group-text">kWp</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Contracted kWp Production -->
                                            <div class="col-12 col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="generator-contracted-generation-production-{{$gen_key + 1}}" class="form-label">
                                                        Produção do kWp Contratado
                                                    </label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="text"
                                                            id="generator-contracted-generation-production-{{$gen_key + 1}}"
                                                            value="{{number_format((($project->contract->monthly_avg_generation * 1000 / $project->contract->getGeneratorPowerValue()) * $generator->generator_power) / 1000, '2', ',', '.')}}"
                                                            readonly>
                                                        <span class="input-group-text">kWh</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Estimated kWp Production -->
                                            <div class="col-12 col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="generator-estimated-generation-production-{{$gen_key + 1}}" class="form-label">
                                                        Produção do kWp Estimado
                                                    </label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="text"
                                                            id="generator-estimated-generation-production-{{$gen_key + 1}}"
                                                            value="{{number_format(($generator->generator_power * 116) / 1000, 1, ',', '.')}}"
                                                            readonly>
                                                        <span class="input-group-text">kWh</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Generator Contract Account -->
                                            <div class="col-12 col-md-5 mb-3">
                                                <div class="@if ($generator->client->login != null && $generator->client->password != null) d-none @endif"    
                                                    id="generator-contract-account-input-{{$gen_key + 1}}">
                                                    <div class="form-group">
                                                        <label for="project-cc-generator-input-{{$gen_key + 1}}" 
                                                            class="form-label">
                                                            Conta Contrato Geradora
                                                        </label>
                                                        <input class="form-control" type="text" 
                                                            id="project-cc-generator-input-{{$gen_key + 1}}"
                                                            name="project[generator-{{$gen_key + 1}}][generator-contract-account]"
                                                            value="{{$generator->generator_contract_account}}"
                                                            onchange="return window.validateInput(this, 1), window.enableBtnAddAddress(this)"
                                                            onblur="return window.validateInput(this, 1)"
                                                            onkeyup="return window.validateInput(this, 1)"
                                                            maxlength="12"
                                                            data-address>
                                                        <div class="invalid-feedback" id="cc-generator-input-{{$gen_key + 1}}-feedback-project"></div>
                                                    </div>
                                                </div>
                                                <div class="@if ($generator->client->login == null && $generator->client->password == null) d-none @endif" 
                                                    id="generator-contract-account-select-{{$gen_key + 1}}">
                                                    <div class="form-group">
                                                        <label for="project-cc-generator-select-{{$gen_key + 1}}" 
                                                            class="form-label">
                                                            Conta Contrato Geradora
                                                        </label>
                                                        <select class="form-select" 
                                                            aria-label="project-cc-generator-select-{{$gen_key + 1}}"
                                                            id="project-cc-generator-select-{{$gen_key + 1}}"
                                                            name="project[generator-{{$gen_key + 1}}][generator-contract-account]"
                                                            onchange="return window.validateSelect(this, 1), window.enableBtnAddAddress(this), window.setDifferentGeneratorContractAccount(this)"
                                                            onblur="return window.validateSelect(this, 1), window.setDifferentGeneratorContractAccount(this)">
                                                            <option value="" disabled>
                                                                Selecione a conta contrato
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback" id="cc-generator-select-{{$gen_key + 1}}-feedback-project"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Other generator contract account -->
                                            <div class="col-12 col-md-4 mb-3 @if (!$generator->different_generator_contract_account) d-none @endif"
                                                id="other-generator-contract-account-{{$gen_key + 1}}">
                                                <div class="form-group">
                                                    <label for="project-other-cc-generator-{{$gen_key + 1}}" 
                                                        class="form-label">
                                                        Outra Conta Contrato Geradora
                                                    </label>
                                                    <input class="form-control" type="text" 
                                                        id="project-other-cc-generator-{{$gen_key + 1}}"
                                                        name="project[generator-{{$gen_key + 1}}][generator-other-contract-account]"
                                                        value="{{$generator->generator_contract_account}}"
                                                        onchange="return window.validateInput(this, 1)"
                                                        onblur="return window.validateInput(this, 1)"
                                                        onkeyup="return window.validateInput(this, 1)"
                                                        maxlength="12">
                                                    <div class="invalid-feedback" 
                                                        id="cc-other-generator-{{$gen_key + 1}}-feedback-project"></div>
                                                </div>
                                            </div>

                                            <!-- Generator Consumption -->
                                            <div class="col-12 col-md-3 mb-3 @if ($generator->generator_project_type != "AUTOCONSUMO_REMOTO") d-none @endif">
                                                <div class="form-group">
                                                    <label for="project-generator-consumption-{{$gen_key + 1}}" 
                                                        class="form-label">
                                                        Consumo da Geradora
                                                    </label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="text"
                                                            id="project-generator-consumption-{{$gen_key + 1}}"
                                                            name="project[generator-{{$gen_key + 1}}][generator-consumption]" value="{{Str::replaceFirst('.', ',', $generator->generator_consumption)}}"
                                                            onchange="return window.handleGeneratorConsumption(this), window.enableBtnAddAddress(this), window.validateInput(this, 1), window.handleGeneratorConsumption(this), window.validateGeneratorConsumption(this)"
                                                            onblur="return window.handleGeneratorConsumption(this), window.validateInput(this, 1), window.handleGeneratorConsumption(this), window.validateGeneratorConsumption(this)"
                                                            onkeyup="return window.handleGeneratorConsumption(this), window.validateInput(this, 1), window.handleGeneratorConsumption(this), window.validateGeneratorConsumption(this)">
                                                        <span class="input-group-text">kWh</span>
                                                    </div>
                                                    <div class="invalid-feedback" 
                                                        id="generator-consumption-{{$gen_key + 1}}-feedback-project">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Generator Equipments -->
                                        <div class="card mt-4">
                                            <div class="card-header border border-gray rounded-top bg-light bg-gradient p-3 ps-3">
                                                <h6 class="mb-0 text-primary"
                                                    id="equipment-oversizing-info-{{$gen_key + 1}}">
                                                    Equipamentos &ndash; Geradora {{Str::replaceFirst('.', ',', $generator->generator_power / 1000)}} kWp
                                                    <p class="mb-0 mt-2 d-none"
                                                        id="equipment-oversizing-percentage-{{$gen_key + 1}}"></p>
                                                </h6>
                                            </div>
                                            <div class="card-body border border-gray rounded-bottom border-top-0 pt-4 pb-0">
                                                <div class="row mb-4">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="col-7 text-center">
                                                                        Produto
                                                                    </th>
                                                                    <th scope="col" class="text-center">Quantidade</th>
                                                                    <th scope="col" class="text-center">Datasheet</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="border-0">
                                                                @foreach ($generator->generator_equipment as $key_equipment => $equipment)
                                                                    @php
                                                                        if ($equipment->type == "GENERATOR") {
                                                                            $category = "generator";
                                                                        }

                                                                        else $category = "inverter";
                                                                    @endphp

                                                                    <tr>
                                                                        <input type="hidden" 
                                                                            name="project[generator-{{$gen_key + 1}}][equipments][equipment-{{$key_equipment + 1}}][id]"
                                                                            value="{{encrypt($equipment->id)}}">
                                                                        <input type="hidden"
                                                                            name="project[generator-{{$gen_key + 1}}][equipments][equipment-{{$key_equipment + 1}}][equipment-id]"
                                                                            value="{{encrypt($equipment->equipment_id)}}">
                                                                        <input type="hidden"
                                                                            name="project[generator-{{$gen_key + 1}}][equipments][equipment-{{$key_equipment + 1}}][type]"
                                                                            value="{{encrypt($equipment->type)}}">
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
                                                                                aria-label="equipment-quantity-{{$category}}-1-{{$key_equipment + 1}}"
                                                                                id="equipment-quantity-{{$category}}-{{$gen_key + 1}}-{{$key_equipment + 1}}"
                                                                                name="project[generator-{{$gen_key + 1}}][equipments][equipment-{{$key_equipment + 1}}][quantity]"
                                                                                onchange="return window.validateSelect(this, 1), window.validateEquipmentQuantity(this), window.getOversizingInfo(this)"
                                                                                onblur="return window.validateSelect(this, 1), window.validateEquipmentQuantity(this), window.getOversizingInfo(this)"
                                                                                data-equipment-{{$category}}="{{$equipment->name}}">
                                                                                <option value="" disabled>
                                                                                    Selecione a quantidade
                                                                                </option>

                                                                                @for ($i = 0; $i <= $equipments[$key_equipment]['quantity']; $i++)
                                                                                    <option value="{{$i}}"
                                                                                        @if ($equipment->quantity == $i)
                                                                                            selected
                                                                                        @endif>
                                                                                        {{$i}}
                                                                                    </option>
                                                                                @endfor
                                                                            </select>
                                                                            <span class="invalid-feedback" 
                                                                                id="equipment-quantity-{{$category}}-{{$gen_key + 1}}-{{$key_equipment + 1}}-feedback-project"></span>
                                                                        </td>
                                                                        <td class="text-center pt-4">
                                                                            <a href="{{route('datasheet_view', ['type' => encrypt($equipment->type), 'id' => encrypt($equipment->equipment_id)])}}" 
                                                                                target="_blank"
                                                                                class="btn bg-primary text-white
                                                                                @if ($equipment->datasheet_path === null || $equipment->datasheet_path === '') disabled @endif">
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

                                        <!-- Beneficiary -->
                                        <div class="d-none" data-beneficiaries>
                                            <div class="accordion" id="cc-beneficiaries-{{$gen_key + 1}}">
                                                @if (count($generator->beneficiary) < 1)
                                                    <div class="accordion-item"
                                                        id="beneficiary-{{$gen_key + 1}}-1" data-beneficiary-item>
                                                        <h2 class="accordion-header"
                                                            id="beneficiary-heading-{{$gen_key + 1}}-1">
                                                            <button class="accordion-button fw-bold bg-light bg-gradient text-primary"
                                                                type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#beneficiary-collapse-{{$gen_key + 1}}-1" aria-expanded="true"
                                                                aria-controls="beneficiary-collapse-{{$gen_key + 1}}-1">
                                                                Beneficiária 1
                                                            </button>
                                                        </h2>
                                                        <div id="beneficiary-collapse-{{$gen_key + 1}}-1"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="beneficiary-heading-{{$gen_key + 1}}-1"
                                                            data-bs-parent="#cc-beneficiaries-{{$gen_key + 1}}">
                                                            <div class="accordion-body">
                                                                <div class="row mt-3 d-none"
                                                                    id="beneficiary-client-{{$gen_key + 1}}-1">
                                                                    <div class="col-12 mb-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                id="chk-add-beneficiary-client-{{$gen_key + 1}}-1"
                                                                                onchange="return window.checkIfAddClientBeneficiary(this)">
                                                                            <label class="form-check-label"
                                                                                for="chk-add-beneficiary-client-{{$gen_key + 1}}-1">
                                                                                Cliente diferente da Geradora?
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <!-- Beneficiary Client -->
                                                                        <div class="col-12 col-md-6 mb-3 d-none"
                                                                            id="client-beneficiary-{{$gen_key + 1}}-1">
                                                                            <div class="form-group">
                                                                                <label for="project-beneficiary-client-{{$gen_key + 1}}-1" class="form-label">
                                                                                    Cliente
                                                                                </label>
                                                                                <input class="form-control" type="text"
                                                                                    id="project-beneficiary-client-{{$gen_key + 1}}-1"
                                                                                    name="project[generator-{{$gen_key + 1}}][beneficiaries][address-1][beneficiary-client]">
                                                                                <div class="invalid-feedback"
                                                                                    id="client-beneficiary-{{$gen_key + 1}}-1-feedback-project"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- Beneficiary Contract Account -->
                                                                    <div class="col-12 col-md-6 mb-3">
                                                                        <div class="@if ($generator->client->login != null && $generator->client->password != null) d-none @endif"
                                                                            id="beneficiary-contract-account-input-{{$gen_key + 1}}-1">
                                                                            <div class="form-group">
                                                                                <label for="project-cc-beneficiary-input-{{$gen_key + 1}}-1" class="form-label">
                                                                                    Conta Contrato Beneficiária
                                                                                </label>
                                                                                <input class="form-control" type="text" 
                                                                                    id="project-cc-beneficiary-input-{{$gen_key + 1}}-1"
                                                                                    name="project[generator-{{$gen_key + 1}}][beneficiaries][address-1][beneficiary-contract-account]"
                                                                                    onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"
                                                                                    onblur="return window.validateInput(this, 1)"
                                                                                    onkeyup="return window.validateInput(this, 1)"
                                                                                    maxlength="12"
                                                                                    data-beneficiary>
                                                                                <div class="invalid-feedback" 
                                                                                    id="cc-beneficiary-input-{{$gen_key + 1}}-1-feedback-project"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="@if ($generator->client->login == null && $generator->client->password == null) d-none @endif"
                                                                            id="beneficiary-contract-account-select-{{$gen_key + 1}}-1">
                                                                            <div class="form-group">
                                                                                <label for="project-cc-beneficiary-select-{{$gen_key + 1}}-1" class="form-label">
                                                                                    Conta Contrato Beneficiária
                                                                                </label>
                                                                                <select class="form-select" 
                                                                                    aria-label="project-cc-beneficiary-select-{{$gen_key + 1}}-1"
                                                                                    id="project-cc-beneficiary-select-{{$gen_key + 1}}-1"
                                                                                    name="project[generator-{{$gen_key + 1}}][beneficiaries][address-1][beneficiary-contract-account]"
                                                                                    onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"
                                                                                    onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)">
                                                                                    <option value="" disabled selected>
                                                                                        Selecione a conta contrato
                                                                                    </option>
                                                                                </select>
                                                                                <div class="invalid-feedback"
                                                                                    id="cc-beneficiary-select-{{$gen_key + 1}}-1-feedback-project"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Other beneficiary contract account -->
                                                                    <div class="col-12 col-md-6 mb-3 d-none"
                                                                        id="other-beneficiary-contract-account-{{$gen_key + 1}}-1">
                                                                        <div class="form-group">
                                                                            <label for="project-other-cc-beneficiary-{{$gen_key + 1}}-1" class="form-label">
                                                                                Outra Conta Contrato Beneficiária
                                                                            </label>
                                                                            <input class="form-control" type="text" 
                                                                                id="project-other-cc-beneficiary-{{$gen_key + 1}}-1"
                                                                                name="project[generator-{{$gen_key + 1}}][beneficiaries][address-1][beneficiary-other-contract-account]"
                                                                                onchange="return window.validateInput(this, 1)"
                                                                                onblur="return window.validateInput(this, 1)"
                                                                                onkeyup="return window.validateInput(this, 1)"
                                                                                maxlength="12">
                                                                            <div class="invalid-feedback" 
                                                                                id="cc-other-beneficiary-{{$gen_key + 1}}-1-feedback-project">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- Consumption Class -->
                                                                    <div class="col-12 col-md-6 mb-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="project-beneficiary-consumption-class-{{$gen_key + 1}}-1">
                                                                                Classe de Consumo
                                                                            </label>
                                                                            <select class="form-select"
                                                                                aria-label="project-beneficiary-consumption-class-{{$gen_key + 1}}-1"
                                                                                id="project-beneficiary-consumption-class-{{$gen_key + 1}}-1"
                                                                                name="project[generator-{{$gen_key + 1}}][beneficiaries][address-1][beneficiary-consumption-class]"
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
                                                                                id="beneficiary-consumption-class-{{$gen_key + 1}}-1-feedback-project">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Rate -->
                                                                    <div class="col-12 col-md-6 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="project-beneficiary-rate-{{$gen_key + 1}}-1" class="form-label">
                                                                                Rateio
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <input class="form-control" type="text" 
                                                                                    id="project-beneficiary-rate-{{$gen_key + 1}}-1"
                                                                                    name="project[generator-{{$gen_key + 1}}][beneficiaries][address-1][beneficiary-rate]"
                                                                                    value="100"
                                                                                    onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"
                                                                                    onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                                    onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                                    data-beneficiary>
                                                                                <span class="input-group-text rounded-end">
                                                                                    %
                                                                                </span>
                                                                                <span class="input-group-text bg-secondary text-white ms-4 rounded" 
                                                                                    id="rate-monthly-avg-generation-{{$gen_key + 1}}-1"
                                                                                    data-rate-monthly>
                                                                                </span>
                                                                            </div>
                                                                            <div class="invalid-feedback" 
                                                                                id="beneficiary-rate-{{$gen_key + 1}}-1-feedback-project">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- Address -->
                                                                    <div class="col-12 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="project-beneficiary-address-{{$gen_key + 1}}-1"  
                                                                                class="form-label">
                                                                                Endereço
                                                                            </label>
                                                                            <input class="form-control" type="text" 
                                                                                id="project-beneficiary-address-{{$gen_key + 1}}-1"
                                                                                name="project[generator-{{$gen_key + 1}}][beneficiaries][address-1][beneficiary-address]"
                                                                                value=""
                                                                                onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"
                                                                                onblur="return window.validateInput(this, 2)"
                                                                                onkeyup="return window.validateInput(this, 2)"
                                                                                data-beneficiary>
                                                                            <div class="invalid-feedback" 
                                                                                id="beneficiary-address-{{$gen_key + 1}}-1-feedback-project">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach ($generator->beneficiary_effective_date as $effective_date)
                                                        @foreach ($effective_date->beneficiary as $ben_key => $beneficiary)
                                                            @if ($effective_date->status)
                                                            <div class="accordion-item" 
                                                                id="beneficiary-{{$gen_key + 1}}-{{$ben_key + 1}}" data-beneficiary-item>
                                                                <h2 class="accordion-header d-flex"
                                                                    id="beneficiary-heading-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                    <button class="accordion-button fw-bold bg-light bg-gradient text-primary"
                                                                        type="button"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#beneficiary-collapse-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                        
                                                                         @if ($ben_key + 1 == 1)
                                                                            aria-expanded="true"
                                                                        @else
                                                                            aria-expanded="false"
                                                                        @endif

                                                                        aria-controls="beneficiary-collapse-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                        Beneficiária {{$ben_key + 1}}
                                                                    </button>
                                                                    <button type="button" 
                                                                        class="btn btn-danger rounded-0 rounded-end"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-dismiss="modal"
                                                                        data-bs-target="#modal-delete-beneficiary-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </button>
                                                                </h2>
                                                                <div class="accordion-collapse collapse @if ($ben_key + 1 == 1) show @endif" 
                                                                    id="beneficiary-collapse-{{$gen_key + 1}}-{{$ben_key + 1}}" 
                                                                    aria-labelledby="beneficiary-heading-{{$gen_key + 1}}-{{$ben_key + 1}}" 
                                                                    data-bs-parent="#cc-beneficiaries-{{$gen_key + 1}}">
                                                                    <div class="accordion-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <input type="hidden"
                                                                                    id="edit-beneficiary-id-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                    name="project[generator-{{$gen_key + 1}}][beneficiaries][address-{{$ben_key + 1}}][beneficiary-id]"
                                                                                    value="{{encrypt($beneficiary->id)}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-none" 
                                                                            id="beneficiary-client-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                            <div class="row mt-3">
                                                                                <div class="col-12 mb-4">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox"
                                                                                            id="chk-add-beneficiary-client-{{$gen_key + 1}}-{{$ben_key + 1}}" 
                                                                                            name="chk-add-beneficiary-client"
                                                                                            @if ($beneficiary->client != null)
                                                                                                {{ 
                                                                                                    $generator->client->id != $beneficiary->client->id ?
                                                                                                    'checked' :
                                                                                                    ''
                                                                                                }}
                                                                                            @endif
                                                                                            onchange="return window.checkIfAddClientBeneficiary(this)">
                                                                                        <label class="form-check-label"
                                                                                            for="chk-add-beneficiary-client-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                                            Cliente diferente da Geradora?
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <!-- Beneficiary Client -->
                                                                                <div class="col-12 col-md-6 mb-3
                                                                                    @if ($beneficiary->client != null)
                                                                                        {{
                                                                                            $generator->client->id != $beneficiary->client->id ?
                                                                                                '' :
                                                                                                'd-none'
                                                                                        }}
                                                                                    @else d-none
                                                                                    @endif"
                                                                                    id="client-beneficiary-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                                    <div class="form-group">
                                                                                        <label for="project-beneficiary-client-{{$gen_key + 1}}-{{$ben_key + 1}}" class="form-label">
                                                                                            Cliente
                                                                                        </label>
                                                                                        <input class="form-control"
                                                                                            type="text"
                                                                                            id="project-beneficiary-client-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                            name="project[generator-{{$gen_key + 1}}][beneficiaries][address-{{$ben_key + 1}}][beneficiary-client]"
                                                                                            value="{{
                                                                                                $beneficiary->client != null ?
                                                                                                    ($beneficiary->client->is_corporate ? 
                                                                                                        $beneficiary->client->corporate_name :
                                                                                                        $beneficiary->client->name) : ('')
                                                                                                }}">
                                                                                        <div class="invalid-feedback"
                                                                                            id="client-beneficiary-{{$gen_key + 1}}-{{$ben_key + 1}}-feedback-project"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <!-- Beneficiary Contract Account -->
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <div class="@if ($beneficiary->client != null && $beneficiary->client->login != null && $beneficiary->client->password != null) d-none @endif"    
                                                                                    id="beneficiary-contract-account-input-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                                    <div class="form-group">
                                                                                        <label for="project-cc-beneficiary-input-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                            class="form-label">
                                                                                            Conta Contrato Beneficiária
                                                                                        </label>
                                                                                        <input class="form-control" type="text" 
                                                                                            id="project-cc-beneficiary-input-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                            name="project[generator-{{$gen_key + 1}}][beneficiaries][address-{{$ben_key + 1}}][beneficiary-contract-account]"
                                                                                            value="{{$beneficiary->beneficiary_contract_account}}"
                                                                                            onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"
                                                                                            onblur="return window.validateInput(this, 1)"
                                                                                            onkeyup="return window.validateInput(this, 1)"
                                                                                            maxlength="12"
                                                                                            data-beneficiary>
                                                                                        <div class="invalid-feedback" 
                                                                                            id="cc-beneficiary-input-{{$gen_key + 1}}-{{$ben_key + 1}}-feedback-project"></div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="@if ($beneficiary->client != null && $beneficiary->client->login == null && $beneficiary->client->password == null) d-none @endif" 
                                                                                    id="beneficiary-contract-account-select-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                                    <div class="form-group">
                                                                                        <label for="project-cc-beneficiary-select-{{$gen_key + 1}}-{{$ben_key + 1}}" 
                                                                                            class="form-label">
                                                                                            Conta Contrato Beneficiária
                                                                                        </label>
                                                                                        <select class="form-select" 
                                                                                            aria-label="project-cc-beneficiary-select-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                            id="project-cc-beneficiary-select-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                            name="project[generator-{{$gen_key + 1}}][beneficiaries][address-{{$ben_key + 1}}][beneficiary-contract-account]"
                                                                                            onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"
                                                                                            onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)">
                                                                                            <option value="" disabled selected>
                                                                                                Selecione a conta contrato
                                                                                            </option>
                                                                                        </select>

                                                                                        <div class="invalid-feedback"
                                                                                            id="cc-beneficiary-select-{{$gen_key + 1}}-{{$ben_key + 1}}-feedback-project"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Other beneficiary contract account -->
                                                                            <div class="col-12 col-md-6 mb-3 @if (!$beneficiary->different_beneficiary_contract_account) d-none @endif"
                                                                                id="other-beneficiary-contract-account-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                            <div class="form-group">
                                                                                <label for="project-other-cc-beneficiary-{{$gen_key + 1}}-{{$ben_key + 1}}" class="form-label">
                                                                                    Outra Conta Contrato Beneficiária
                                                                                </label>
                                                                                <input class="form-control" type="text" 
                                                                                    id="project-other-cc-beneficiary-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                    name="project[generator-{{$gen_key + 1}}][beneficiaries][address-{{$ben_key + 1}}][beneficiary-other-contract-account]"
                                                                                    value="{{$beneficiary->beneficiary_contract_account}}"
                                                                                    onchange="return window.validateInput(this, 1)"
                                                                                    onblur="return window.validateInput(this, 1)"
                                                                                    onkeyup="return window.validateInput(this, 1)"
                                                                                    maxlength="12">
                                                                                <div class="invalid-feedback" 
                                                                                    id="cc-other-beneficiary-{{$gen_key + 1}}-{{$ben_key + 1}}-feedback-project">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <!-- Consumption Class -->
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <div class="form-group">
                                                                                    <label class="form-label"
                                                                                        for="project-beneficiary-consumption-class-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                                        Classe de Consumo
                                                                                    </label>
                                                                                    <select class="form-select"
                                                                                        aria-label="project-beneficiary-consumption-class-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                        id="project-beneficiary-consumption-class-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                        name="project[generator-{{$gen_key + 1}}][beneficiaries][address-{{$ben_key + 1}}][beneficiary-consumption-class]"
                                                                                        onchange="return window.validateSelect(this), window.enableBtnAddBeneficiary(this)"
                                                                                        onblur="return window.validateSelect(this)"
                                                                                        data-beneficiary>
                                                                                        <option value="" disabled selected>
                                                                                            Escolha a classe de consumo
                                                                                        </option>
                                                                                        <option value="{{encrypt('RESIDENCIAL')}}" @if ($beneficiary->beneficiary_consumption_class == 'RESIDENCIAL') selected @endif>
                                                                                            Residencial
                                                                                        </option>
                                                                                        <option value="{{encrypt('INDUSTRIAL')}}" @if ($beneficiary->beneficiary_consumption_class == 'INDUSTRIAL') selected @endif>
                                                                                            Industrial
                                                                                        </option>
                                                                                        <option value="{{encrypt('COMERCIO_SERVICOS_OUTROS')}}" @if ($beneficiary->beneficiary_consumption_class == 'COMERCIO_SERVICOS_OUTROS') selected @endif>
                                                                                            Comércio, Serviço e outras atividades
                                                                                        </option>
                                                                                        <option value="{{encrypt('RURAL')}}" @if ($beneficiary->beneficiary_consumption_class == 'RURAL') selected @endif>
                                                                                            Rural
                                                                                        </option>
                                                                                        <option value="{{encrypt('PODER_PUBLICO')}}" @if ($beneficiary->beneficiary_consumption_class == 'PODER_PUBLICO') selected @endif>
                                                                                            Poder Público
                                                                                        </option>
                                                                                        <option value="{{encrypt('ILUMINACAO_PUBLICA')}}" @if ($beneficiary->beneficiary_consumption_class == 'ILUMINACAO_PUBLICA') selected @endif>
                                                                                            Iluminação Pública
                                                                                        </option>
                                                                                        <option value="{{encrypt('SERVICO_PUBLICO')}}" @if ($beneficiary->beneficiary_consumption_class == 'SERVICO_PUBLICO') selected @endif>
                                                                                            Serviço Público
                                                                                        </option>
                                                                                        <option value="{{encrypt('CONSUMO_PROPRIO')}}" @if ($beneficiary->beneficiary_consumption_class == 'CONSUMO_PROPRIO') selected @endif>
                                                                                            Consumo Próprio
                                                                                        </option>
                                                                                    </select>
                                                                                    <div class="invalid-feedback" 
                                                                                        id="beneficiary-consumption-class-{{$gen_key + 1}}-{{$ben_key + 1}}-feedback-project">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Rate -->
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <div class="form-group">
                                                                                    <label for="project-beneficiary-rate-{{$gen_key + 1}}-{{$ben_key + 1}}" class="form-label">
                                                                                        Taxa
                                                                                    </label>
                                                                                    <div class="input-group">
                                                                                        <input class="form-control"     
                                                                                            type="text" 
                                                                                            id="project-beneficiary-rate-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                            name="project[generator-{{$gen_key + 1}}][beneficiaries][address-{{$ben_key + 1}}][beneficiary-rate]"
                                                                                            value="{{Str::replaceFirst('.', ',',$beneficiary->beneficiary_rate)}}"
                                                                                            onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"
                                                                                            onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                                            onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                                            data-beneficiary>
                                                                                        <span class="input-group-text rounded-end">
                                                                                            %
                                                                                        </span>
                                                                                        <span class="input-group-text bg-secondary text-white ms-4 rounded" 
                                                                                            id="rate-monthly-avg-generation-{{$gen_key + 1}}-{{$ben_key + 1}}">
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="invalid-feedback" 
                                                                                        id="beneficiary-rate-{{$gen_key + 1}}-{{$ben_key + 1}}-feedback-project">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <!-- Address -->
                                                                            <div class="col-12 mb-3">
                                                                                <div class="form-group">
                                                                                    <label for="project-beneficiary-address-{{$gen_key + 1}}-{{$ben_key + 1}}"  
                                                                                        class="form-label">
                                                                                        Endereço
                                                                                    </label>
                                                                                    <input class="form-control" type="text" 
                                                                                        id="project-beneficiary-address-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                                        name="project[generator-{{$gen_key + 1}}][beneficiaries][address-{{$ben_key + 1}}][beneficiary-address]"
                                                                                        value="{{$beneficiary->beneficiary_address}}"
                                                                                        onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"
                                                                                        onblur="return window.validateInput(this, 2)"
                                                                                        onkeyup="return window.validateInput(this, 2)"
                                                                                        data-beneficiary>
                                                                                    <div class="invalid-feedback" 
                                                                                        id="beneficiary-address-{{$gen_key + 1}}-{{$ben_key + 1}}-feedback-project">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal Delete Beneficiary -->
                                                            <div class="modal fade text-black" 
                                                                id="modal-delete-beneficiary-{{$gen_key + 1}}-{{$ben_key + 1}}"
                                                                tabindex="-1" role="dialog" aria-hidden="true"
                                                                aria-labelledby="modal">
                                                                <div class="modal-dialog modal-dialog-centered" 
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                Excluir Beneficiária
                                                                            </h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <span class="d-block">
                                                                                Você deseja excluir esta beneficiária da nossa base de dados?
                                                                            </span>
                                                                            <span class="text-danger">
                                                                                A ação não pode ser desfeita!
                                                                            </span>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-danger" 
                                                                                data-bs-dismiss="modal">
                                                                                Cancelar
                                                                            </button>
                                                                            <a href="{{route('engineering_project_destroy_beneficiary', ['id' => encrypt($beneficiary->id)])}}" 
                                                                                class="btn bg-success text-white">
                                                                                Confirmar
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </div>
                                            
                                            <!-- button Add Beneficiary -->
                                            <div class="row justify-content-end mt-4 mb-4">
                                                <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-end">
                                                    <div class="form-group"> 
                                                        <button class="btn btn-warning d-flex justify-content-center 
                                                            align-items-center btn-add-beneficiary" type="button"
                                                            id="btn-add-beneficiary-{{$gen_key + 1}}"
                                                            onclick="return window.editAddCCBeneficiary(this)"
                                                            @if (count($generator->beneficiary) < 1) disabled @endif>
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
                            
                            <!-- Modal Delete Generator -->
                            <div class="modal fade text-black" id="modal-delete-generator-{{$gen_key + 1}}"
                                tabindex="-1" role="dialog" aria-hidden="true"
                                aria-labelledby="modal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Excluir Geradora</h5>
                                        </div>
                                        <div class="modal-body">
                                            <span class="d-block">
                                                Você deseja excluir esta geradora da nossa base de dados?
                                            </span>
                                            <span class="text-danger">
                                                A ação não pode ser desfeita!
                                            </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" 
                                                data-bs-dismiss="modal">
                                                Cancelar
                                            </button>
                                            <a href="{{route('engineering_project_destroy_generator', ['id' => encrypt($generator->id)])}}" 
                                                class="btn bg-success text-white">
                                                Confirmar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- button Add Generator -->
                    <div class="row justify-content-end mt-4 mb-5">
                        <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-end">
                            <div class="form-group">
                                <button class="btn btn-warning d-flex justify-content-center align-items-center" 
                                    type="button"
                                    id="btn-add-address"
                                    onclick="return window.editAddAddress(this)">
                                    <i class="bi bi-plus-circle-fill me-2"></i>
                                    Adicionar Geradora
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Observations -->
                    <div class="row mt-4">
                        <div class="col-12 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="project-observation" class="form-label">
                                    Observações (opcional)
                                </label>
                                <textarea class="form-control"
                                    id="project-observation"
                                    name="project-observation"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="btn-floating">
                        <a href="{{route('engineering_project_show', ['id' => encrypt($project->id)])}}"
                            class="btn btn-danger d-inline-flex align-items-center justify-content-center me-2">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                        </a>
                        <button type="submit" class="btn btn-success"
                            id="btn-edit-project">
                            <i class="bi bi-save-fill"></i>
                        </button>
                    </div>
                </div>    
            </div>
        </form>
    </div>
</x-app-layout>