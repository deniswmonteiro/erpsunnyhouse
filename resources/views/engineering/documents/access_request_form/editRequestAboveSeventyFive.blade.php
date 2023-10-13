@section('page_title', 'Editar Formulário de Solicitação de Acesso')

<script src="{{asset(mix('js/engineering/documents/access_request_form/editRequestAboveSeventyFive.js'))}}" defer></script>
<script>
    var url_get_engineer_data = "{{route('engineering_get_engineer_data_fetch')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>{{_('Editar Formulário de Solicitação de Acesso para Microgeração Distribuída')}}</h3>
                <p class="text-subtitle text-muted">
                    <span class="fw-bold">Acima de 75 kW até 5000 kW</span> para qualquer tipo de fonte renovável e co-geração qualificada.
                </p>
                <p class="mt-5">
                    Preencher, obrigatoriamente, todos os campos com asterísco (<span class="text-danger">*</span>).
                </p>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
        <form action="{{route('engineering_document_update_request', ['type' => encrypt('above_seventy_five'), 'id' => encrypt($document_request_above_seventy_five->id)])}}" method="POST"
            id="form-edit-request-type-third"
            onsubmit="return false">
            @csrf

            <!-- Registration Information and Data -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Identificação e Dados Cadastrais da Unidade Consumidora</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Client Name -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-clientname" class="form-label">
                                    Nome do Cliente/Razão Social (Titular da UC)
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-clientname"
                                    @if ($document_request_above_seventy_five->generator->client->is_corporate)
                                        value="{{$document_request_above_seventy_five->generator->client->corporate_name}}"
                                    @else
                                        value="{{$document_request_above_seventy_five->generator->client->name}}"
                                    @endif"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Client CPF/CNPJ -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-clientcpfcnpj" class="form-label">
                                    CPF/CNPJ
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-clientcpfcnpj"
                                    @if ($document_request_above_seventy_five->generator->client->is_corporate)
                                        value="{{$document_request_above_seventy_five->generator->client->cnpj}}"
                                    @else
                                        value="{{$document_request_above_seventy_five->generator->client->cpf}}"
                                    @endif"
                                    disabled>
                            </div>
                        </div>

                        <!-- Client RG -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-clientrg" class="form-label">
                                    RG
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-clientrg"
                                    name="edit-request-third-clientrg"
                                    value="{{$document_request_above_seventy_five->client_rg}}"
                                    onchange="return window.validateInput(this, 7)"
                                    onkeyup="return window.validateInput(this, 7)"
                                    maxlength="9">
                                <div class="invalid-feedback" id="edit-third-clientrg-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Client RG Shipping Date -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-clientrgshipping" class="form-label">
                                    Data de Expedição
                                </label>
                                <input class="form-control" type="date"
                                    id="edit-request-third-clientrgshipping"
                                    name="edit-request-third-clientrgshipping"
                                    value="{{$document_request_above_seventy_five->client_rg_shipping_date != null ? date('Y-m-d', strToTime($document_request_above_seventy_five->client_rg_shipping_date)) : ''}}"
                                    onchange="return window.validateRGShippingDate(this)"
                                    onkeyup="return window.validateRGShippingDate(this)">
                                <div class="invalid-feedback" id="edit-third-clientrgshipping-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator Address -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generatoraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-generatoraddress"
                                    value="{{$document_request_above_seventy_five->generator->generator_address}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator CEP -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generatorcep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-generatorcep"
                                    value="{{$document_request_above_seventy_five->generator->generator_cep}}"
                                    disabled>
                            </div>
                        </div>

                         <!-- Generator City -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generatorcity" class="form-label">
                                    Município
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-generatorcity"
                                    value="{{$document_request_above_seventy_five->generator->generator_city}}"
                                    disabled>
                            </div>
                        </div>

                         <!-- Generator State -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generatorstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select" 
                                    aria-label="edit-request-third-generatorstate"
                                    id="edit-request-third-generatorstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'AC' ? 'selected' : ''}}>
                                        AC
                                    </option>
                                    <option value="AL"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'AL' ? 'selected' : ''}}>
                                        AL
                                    </option>
                                    <option value="AP"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'AP' ? 'selected' : ''}}>
                                        AP
                                    </option>
                                    <option value="AM"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'AM' ? 'selected' : ''}}>
                                        AM
                                    </option>
                                    <option value="BA"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'BA' ? 'selected' : ''}}>
                                        BA
                                    </option>
                                    <option value="CE"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'CE' ? 'selected' : ''}}>
                                        CE
                                    </option>
                                    <option value="DF"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'DF' ? 'selected' : ''}}>
                                        DF
                                    </option>
                                    <option value="ES"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'ES' ? 'selected' : ''}}>
                                        ES
                                    </option>
                                    <option value="GO"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'GO' ? 'selected' : ''}}>
                                        GO
                                    </option>
                                    <option value="MA"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'MA' ? 'selected' : ''}}>
                                        MA
                                    </option>
                                    <option value="MT"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'MT' ? 'selected' : ''}}>
                                        MT
                                    </option>
                                    <option value="MS"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'MS' ? 'selected' : ''}}>
                                        MS
                                    </option>
                                    <option value="MG"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'MG' ? 'selected' : ''}}>
                                        MG
                                    </option>
                                    <option value="PA"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'PA' ? 'selected' : ''}}>
                                        PA
                                    </option>
                                    <option value="PB"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'PB' ? 'selected' : ''}}>
                                        PB
                                    </option>
                                    <option value="PR"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'PR' ? 'selected' : ''}}>
                                        PR
                                    </option>
                                    <option value="PE"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'PE' ? 'selected' : ''}}>
                                        PE
                                    </option>
                                    <option value="PI"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'PI' ? 'selected' : ''}}>
                                        PI
                                    </option>
                                    <option value="RJ"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'RJ' ? 'selected' : ''}}>
                                        RJ
                                    </option>
                                    <option value="RN"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'RN' ? 'selected' : ''}}>
                                        RN
                                    </option>
                                    <option value="RS"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'RS' ? 'selected' : ''}}>
                                        RS
                                    </option>
                                    <option value="RO"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'RO' ? 'selected' : ''}}>
                                        RO
                                    </option>
                                    <option value="RR"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'RR' ? 'selected' : ''}}>
                                        RR
                                    </option>
                                    <option value="SC"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'SC' ? 'selected' : ''}}>
                                        SC
                                    </option>
                                    <option value="SP"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'SP' ? 'selected' : ''}}>
                                        SP
                                    </option>
                                    <option value="SE"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'SE' ? 'selected' : ''}}>
                                        SE
                                    </option>
                                    <option value="TO"
                                        {{$document_request_above_seventy_five->generator->generator_state == 'TO' ? 'selected' : ''}}>
                                        TO
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (strlen(Str::of($document_request_above_seventy_five->generator->client->phone)->matchAll('/[\d]+/')[1]) == 5)
                            <!-- Client Cellphone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="edit-request-third-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="edit-request-third-clientcellphone"
                                        value="{{$document_request_above_seventy_five->generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="edit-request-third-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="edit-request-third-clientphone"
                                        name="edit-request-third-clientphone"
                                        value="{{$document_request_above_seventy_five->client_phone}}"
                                        onchange="return window.validatePhone(this, 10)"
                                        onkeyup="return window.validatePhone(this, 10)">
                                    <div class="invalid-feedback" id="edit-third-clientphone-feedback-request"></div>
                                </div>
                            </div>
                        @else
                            <!-- Client Cellphone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="edit-request-third-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="edit-request-third-clientcellphone"
                                        name="edit-request-third-clientcellphone"
                                        value="{{$document_request_above_seventy_five->client_cellphone}}"
                                        onchange="return window.validatePhone(this, 11)"
                                        onkeyup="return window.validatePhone(this, 11)">
                                    <div class="invalid-feedback"
                                        id="edit-third-clientcellphone-feedback-request"></div>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="edit-request-third-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="edit-request-third-clientphone"
                                        value="{{$document_request_above_seventy_five->generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>
                        @endif

                        <!-- Client Email -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-clientmail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="clientmail"
                                    id="edit-request-third-clientmail"
                                    value="{{$document_request_above_seventy_five->generator->client->email}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Project Type -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-projecttype" class="form-label">
                                    Tipo de Solicitação
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-projecttype"
                                    @switch ($document_request_above_seventy_five->generator->generator_project_type)
                                        @case ('INDIVIDUAL')
                                            value="Individual"
                                            @break
                                        @case ('AUTOCONSUMO_REMOTO')
                                            value="Autoconsumo Remoto"
                                            @break
                                        @case ('GERACAO_COMPARTILHADA')
                                            value="Geração Compartilhada"
                                            @break
                                        @case ('RESERVADO')
                                            value="Reservado"
                                            @break
                                    @endswitch
                                    disabled>
                            </div>
                        </div>

                        <!-- Contract Account -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-contractaccount" class="form-label">
                                    Conta Contrato (Se UC existente)
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-contractaccount"
                                    value="{{$document_request_above_seventy_five->generator->generator_contract_account}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Branch of Activity -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-activity" class="form-label">
                                    Ramo de Atividade (Descrição)
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-activity"
                                    name="edit-request-third-activity"
                                    value="{{$document_request_above_seventy_five->branch_activity}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="edit-third-activity-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Special Loads -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-loads" class="form-label">
                                    Possui Cargas Especiais?
                                </label>
                                <select class="form-select" 
                                    aria-label="edit-request-third-loads"
                                    id="edit-request-third-loads"
                                    name="edit-request-third-loads"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)">
                                    <option value="" disabled selected>
                                        Selecione uma opção
                                    </option>
                                    <option value="{{encrypt('NÃO')}}"
                                        {{!$document_request_above_seventy_five->has_special_loads ? 'selected' : ''}}>
                                        Não
                                    </option>
                                    <option value="{{encrypt('SIM')}}"
                                        {{$document_request_above_seventy_five->has_special_loads ? 'selected' : ''}}>
                                        Sim
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="edit-third-loads-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Special Loads Details -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-loadsdetails" class="form-label">
                                    Detalhar Cargas Especiais
                                </label>
                                <textarea class="form-control" id="edit-request-third-loadsdetails"
                                    name="edit-request-third-loadsdetails"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    rows="3">{{$document_request_above_seventy_five->special_loads_details}}</textarea>
                                <div class="invalid-feedback" id="edit-third-loadsdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Subgroup -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-subgroup" class="form-label">
                                    Subgrupo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-subgroup"
                                    name="edit-request-third-subgroup"
                                    value="{{$document_request_above_seventy_five->subgroup}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)"
                                    required>
                                <div class="invalid-feedback" id="edit-third-subgroup-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Class -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-class" class="form-label">
                                    Classe <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="edit-request-third-class"
                                    id="edit-request-third-class"
                                    name="edit-request-third-class"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha a classe
                                    </option>
                                    <option value="{{encrypt('RESIDENCIAL')}}"
                                        {{$document_request_above_seventy_five->consumption_class == 'RESIDENCIAL' ? 'selected' : ''}}>
                                        Residencial
                                    </option>
                                    <option value="{{encrypt('INDUSTRIAL')}}"
                                        {{$document_request_above_seventy_five->consumption_class == 'INDUSTRIAL' ? 'selected' : ''}}>
                                        Industrial
                                    </option>
                                    <option value="{{encrypt('COMERCIO_SERVICOS_OUTROS')}}"
                                        {{$document_request_above_seventy_five->consumption_class == 'COMERCIO_SERVICOS_OUTROS' ? 'selected' : ''}}>
                                        Comércio, Serviço e outras atividades
                                    </option>
                                    <option value="{{encrypt('RURAL')}}"
                                        {{$document_request_above_seventy_five->consumption_class == 'RURAL' ? 'selected' : ''}}>
                                        Rural
                                    </option>
                                    <option value="{{encrypt('PODER_PUBLICO')}}"
                                        {{$document_request_above_seventy_five->consumption_class == 'PODER_PUBLICO' ? 'selected' : ''}}>
                                        Poder Público
                                    </option>
                                    <option value="{{encrypt('ILUMINACAO_PUBLICA')}}"
                                        {{$document_request_above_seventy_five->consumption_class == 'ILUMINACAO_PUBLICA' ? 'selected' : ''}}>
                                        Iluminação Pública
                                    </option>
                                    <option value="{{encrypt('SERVICO_PUBLICO')}}"
                                        {{$document_request_above_seventy_five->consumption_class == 'SERVICO_PUBLICO' ? 'selected' : ''}}>
                                        Serviço Público
                                    </option>
                                    <option value="{{encrypt('CONSUMO_PROPRIO')}}"
                                        {{$document_request_above_seventy_five->consumption_class == 'CONSUMO_PROPRIO' ? 'selected' : ''}}>
                                        Consumo Próprio
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="edit-third-class-feedback-request"></div>
                            </div>
                        </div>

                        <!-- UC Connection -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-conntype" class="form-label">
                                    Conexão da UC <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="edit-request-third-conntype"
                                    id="edit-request-third-conntype"
                                    name="edit-request-third-conntype"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha o tipo
                                    </option>
                                    <option value="{{encrypt('MONOFASICO')}}"
                                        {{$document_request_above_seventy_five->connection_type == 'MONOFASICO' ? 'selected' : ''}}>
                                        Monofásico
                                    </option>
                                    <option value="{{encrypt('BIFASICO')}}"
                                        {{$document_request_above_seventy_five->connection_type == 'BIFASICO' ? 'selected' : ''}}>
                                        Bifásico
                                    </option>
                                    <option value="{{encrypt('TRIFASICO')}}"
                                        {{$document_request_above_seventy_five->connection_type == 'TRIFASICO' ? 'selected' : ''}}>
                                        Trifásico
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="edit-third-conntype-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Average FP at Delivery Point/UC Connection -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-ucconn" class="form-label">
                                    FP Médio no Ponto de Entrega/Conexão da UC
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-ucconn"
                                    name="edit-request-third-ucconn"
                                    value="{{$document_request_above_seventy_five->average_fp}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)">
                                <div class="invalid-feedback" id="edit-third-ucconn-feedback-request"></div>
                            </div>
                        </div>

                        <!-- UC Installed Load -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="edit-request-third-ucinstalledloadkw" class="form-label">
                                    Carga Instalada da UC
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="edit-request-third-ucinstalledloadkw"
                                                name="edit-request-third-ucinstalledloadkw"
                                                value="{{$document_request_above_seventy_five->uc_installed_load_kw != null ? Str::of($document_request_above_seventy_five->uc_installed_load_kw / 1000)->replace('.', ',') : ''}}"
                                                onchange="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-third-ucinstalledloadkw-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="edit-request-third-ucinstalledloadkva"
                                                name="edit-request-third-ucinstalledloadkva"
                                                value="{{$document_request_above_seventy_five->uc_installed_load_kva != null ? Str::of($document_request_above_seventy_five->uc_installed_load_kva / 1000)->replace('.', ',') : ''}}"
                                                onchange="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kVA</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-third-ucinstalledloadkva-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Demand -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="edit-request-third-ucdemandkw" class="form-label">
                                    Demanda da UC
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="edit-request-third-ucdemandkw"
                                                name="edit-request-third-ucdemandkw"
                                                value="{{$document_request_above_seventy_five->uc_demand_kw != null ? Str::of($document_request_above_seventy_five->uc_demand_kw / 1000)->replace('.', ',') : ''}}"
                                                onchange="return window.validateDouble(this, 1)"
                                                onkeyup="return window.validateDouble(this, 1)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-third-ucdemandkw-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="edit-request-third-ucdemandkva"
                                                name="edit-request-third-ucdemandkva"
                                                value="{{$document_request_above_seventy_five->uc_demand_kva != null ? Str::of($document_request_above_seventy_five->uc_demand_kva / 1000)->replace('.', ',') : ''}}"
                                                onchange="return window.validateDouble(this, 1)"
                                                onkeyup="return window.validateDouble(this, 1)">
                                            <span class="input-group-text">kVA</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-third-ucdemandkva-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- UC Input Pattern -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-ucinputpattern" class="form-label">
                                    Padrão de Entrada da UC <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-ucinputpattern"
                                    name="edit-request-third-ucinputpattern"
                                    value="{{$document_request_above_seventy_five->uc_input_pattern}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback"
                                    id="edit-third-ucinputpattern-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Power -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-ucpower" class="form-label">
                                    Tensão de Atendimento da UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="edit-request-third-ucpower"
                                        name="edit-request-third-ucpower"
                                        value="{{$document_request_above_seventy_five->uc_power != null ? Str::of($document_request_above_seventy_five->uc_power / 1000)->replace('.', ',') : ''}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kV</span>
                                </div>
                                <div class="invalid-feedback" id="edit-third-ucpower-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Tariff Group -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-tariffgroup" class="form-label">
                                    Tarifa GRUPO A <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-tariffgroup"
                                    name="edit-request-third-tariffgroup"
                                    value="{{$document_request_above_seventy_five->tariff_group}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="edit-third-tariffgroup-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Contracted Demand -->
                        <div class="col-12 col-lg-5">
                            <div class="form-group mb-0">
                                <label for="edit-request-third-contracteddemandfp" class="form-label">
                                    Demanda Contratada
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light btn-sm">FP</span>
                                            <input class="form-control" type="text"
                                                id="edit-request-third-contracteddemandfp"
                                                name="edit-request-third-contracteddemandfp"
                                                value="{{$document_request_above_seventy_five->contracted_demand_fp != null ? Str::of($document_request_above_seventy_five->contracted_demand_fp / 1000)->replace('.', ',') : ''}}"
                                                onchange="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-third-contracteddemandfp-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light btn-sm">P</span>
                                            <input class="form-control" type="text"
                                                id="edit-request-third-contracteddemandp"
                                                name="edit-request-third-contracteddemandp"
                                                value="{{$document_request_above_seventy_five->contracted_demand_p != null ? Str::of($document_request_above_seventy_five->contracted_demand_p / 1000)->replace('.', ',') : ''}}"
                                                onchange="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-third-contracteddemandp-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <!-- Extension Type -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-extension" class="form-label">
                                    Tipo de Ramal <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-extension"
                                    name="edit-request-third-extension"
                                    value="{{$document_request_above_seventy_five->extension_type}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="edit-third-extension-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Transformer Identification -->
                        <div class="col-12 col-lg-8 mb-3">
                           <div class="form-group">
                               <label for="edit-request-third-transformerid" class="form-label">
                                   Nº de Identificação do Poste ou Transformador mais Próximo
                               </label>
                               <input class="form-control" type="text"
                                   id="edit-request-third-transformerid"
                                   name="edit-request-third-transformerid"
                                   value="{{$document_request_above_seventy_five->transformer_identification}}"
                                   onchange="return window.validateInput(this, 2)"
                                   onkeyup="return window.validateInput(this, 2)">
                               <div class="invalid-feedback" id="edit-third-transformerid-feedback-request"></div>
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- System Delivery Point Coordinates X and Y-->
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label for="edit-request-third-coordinatesx" class="form-label">
                                    Preencher as Coordenadas Ponto de Entrega do Acessante em UTM Fuso 21, 22 ou 23
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">X</span>
                                    <input class="form-control" type="text"
                                        id="edit-request-third-coordinatesx"
                                        name="edit-request-third-coordinatesx"
                                        value="{{Str::of($document_request_above_seventy_five->point_coordinate_x)->replace('.', ',')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m E</span>
                                </div>
                                <div class="invalid-feedback" id="edit-third-coordinatesx-feedback-request"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">Y</span>
                                    <input class="form-control" type="text"
                                        id="edit-request-third-coordinatesy"
                                        name="edit-request-third-coordinatesy"
                                        value="{{Str::of($document_request_above_seventy_five->point_coordinate_y)->replace('.', ',')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m S</span>
                                </div>
                                <div class="invalid-feedback" id="edit-third-coordinatesy-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registration Information and Data -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dados Cadastrais do Responsável Técnico</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Technical Manager Name -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managername" class="form-label">
                                    Nome Completo <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                    aria-label="edit-request-third-managername"
                                    id="edit-request-third-managername"
                                    name="edit-request-third-managername"
                                    onchange="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Selecione o responsável
                                    </option>
                                    @foreach ($arr_engineers as $engineer)
                                        <option value="{{encrypt($engineer)}}"
                                            {{$document_request_above_seventy_five->user->name == $engineer ? 'selected' : ''}}>
                                            {{$engineer}}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="edit-third-managername-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Title -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managertitle" class="form-label">
                                    Título Profissional
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-managertitle"
                                    value="{{$document_request_above_seventy_five->user->professional_title}}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Technical Manager Professional Registration -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managerregistration" class="form-label">
                                    Nº do Registro Profissional
                                </label>
                                <input class="form-control rounded-end me-2" type="text"
                                    id="edit-request-third-managerregistration"
                                    value="{{$document_request_above_seventy_five->user->professional_registration}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Registration State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managerregistrationstate" class="form-label">
                                    UF
                                </label>
                                <select class="form-select" 
                                    aria-label="edit-request-third-managerregistrationstate"
                                    id="edit-request-third-managerregistrationstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC"
                                        {{$document_request_above_seventy_five->user->professional_state == 'AC' ? 'selected' : ''}}>
                                        AC
                                    </option>
                                    <option value="AL"
                                        {{$document_request_above_seventy_five->user->professional_state == 'AL' ? 'selected' : ''}}>
                                        AL
                                    </option>
                                    <option value="AP"
                                        {{$document_request_above_seventy_five->user->professional_state == 'AP' ? 'selected' : ''}}>
                                        AP
                                    </option>
                                    <option value="AM"
                                        {{$document_request_above_seventy_five->user->professional_state == 'AM' ? 'selected' : ''}}>
                                        AM
                                    </option>
                                    <option value="BA"
                                        {{$document_request_above_seventy_five->user->professional_state == 'BA' ? 'selected' : ''}}>
                                        BA
                                    </option>
                                    <option value="CE"
                                        {{$document_request_above_seventy_five->user->professional_state == 'CE' ? 'selected' : ''}}>
                                        CE
                                    </option>
                                    <option value="DF"
                                        {{$document_request_above_seventy_five->user->professional_state == 'DF' ? 'selected' : ''}}>
                                        DF
                                    </option>
                                    <option value="ES"
                                        {{$document_request_above_seventy_five->user->professional_state == 'ES' ? 'selected' : ''}}>
                                        ES
                                    </option>
                                    <option value="GO"
                                        {{$document_request_above_seventy_five->user->professional_state == 'GO' ? 'selected' : ''}}>
                                        GO
                                    </option>
                                    <option value="MA"
                                        {{$document_request_above_seventy_five->user->professional_state == 'MA' ? 'selected' : ''}}>
                                        MA
                                    </option>
                                    <option value="MT"
                                        {{$document_request_above_seventy_five->user->professional_state == 'MT' ? 'selected' : ''}}>
                                        MT
                                    </option>
                                    <option value="MS"
                                        {{$document_request_above_seventy_five->user->professional_state == 'MS' ? 'selected' : ''}}>
                                        MS
                                    </option>
                                    <option value="MG"
                                        {{$document_request_above_seventy_five->user->professional_state == 'MG' ? 'selected' : ''}}>
                                        MG
                                    </option>
                                    <option value="PA"
                                        {{$document_request_above_seventy_five->user->professional_state == 'PA' ? 'selected' : ''}}>
                                        PA
                                    </option>
                                    <option value="PB"
                                        {{$document_request_above_seventy_five->user->professional_state == 'PB' ? 'selected' : ''}}>
                                        PB
                                    </option>
                                    <option value="PR"
                                        {{$document_request_above_seventy_five->user->professional_state == 'PR' ? 'selected' : ''}}>
                                        PR
                                    </option>
                                    <option value="PE"
                                        {{$document_request_above_seventy_five->user->professional_state == 'PE' ? 'selected' : ''}}>
                                        PE
                                    </option>
                                    <option value="PI"
                                        {{$document_request_above_seventy_five->user->professional_state == 'PI' ? 'selected' : ''}}>
                                        PI
                                    </option>
                                    <option value="RJ"
                                        {{$document_request_above_seventy_five->user->professional_state == 'RJ' ? 'selected' : ''}}>
                                        RJ
                                    </option>
                                    <option value="RN"
                                        {{$document_request_above_seventy_five->user->professional_state == 'RN' ? 'selected' : ''}}>
                                        RN
                                    </option>
                                    <option value="RS"
                                        {{$document_request_above_seventy_five->user->professional_state == 'RS' ? 'selected' : ''}}>
                                        RS
                                    </option>
                                    <option value="RO"
                                        {{$document_request_above_seventy_five->user->professional_state == 'RO' ? 'selected' : ''}}>
                                        RO
                                    </option>
                                    <option value="RR"
                                        {{$document_request_above_seventy_five->user->professional_state == 'RR' ? 'selected' : ''}}>
                                        RR
                                    </option>
                                    <option value="SC"
                                        {{$document_request_above_seventy_five->user->professional_state == 'SC' ? 'selected' : ''}}>
                                        SC
                                    </option>
                                    <option value="SP"
                                        {{$document_request_above_seventy_five->user->professional_state == 'SP' ? 'selected' : ''}}>
                                        SP
                                    </option>
                                    <option value="SE"
                                        {{$document_request_above_seventy_five->user->professional_state == 'SE' ? 'selected' : ''}}>
                                        SE
                                    </option>
                                    <option value="TO"
                                        {{$document_request_above_seventy_five->user->professional_state == 'TO' ? 'selected' : ''}}>
                                        TO
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Technical Manager Email -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-manageremail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="email"
                                    id="edit-request-third-manageremail"
                                    value="{{$document_request_above_seventy_five->user->email}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Phone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managerphone" class="form-label">
                                    Telefone Fixo
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-managerphone"
                                    value="{{$document_request_above_seventy_five->user->phone}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Cellphone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managercellphone" class="form-label">
                                    Telefone Celular
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-managercellphone"
                                    value="{{$document_request_above_seventy_five->user->cellphone}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager CEP -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managercep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-managercep"
                                    value="{{$document_request_above_seventy_five->user->cep}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Address -->
                        <div class="col-12 col-lg-7 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-manageraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-manageraddress"
                                    value="{{$document_request_above_seventy_five->user->address}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Number -->
                        <div class="col-12 col-lg-2 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managernumber" class="form-label">
                                    Número/Apt.
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-managernumber"
                                    value="{{$document_request_above_seventy_five->user->number}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Neighborhood -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managerneighborhood" class="form-label">
                                    Bairro
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-managerneighborhood"
                                    value="{{$document_request_above_seventy_five->user->neighborhood}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager City -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managercity" class="form-label">
                                    Cidade
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-managercity"
                                    value="{{$document_request_above_seventy_five->user->city}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-managerstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select"
                                    aria-label="edit-request-third-managerstate"
                                    id="edit-request-third-managerstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC"
                                        {{$document_request_above_seventy_five->user->state == 'AC' ? 'selected' : ''}}>
                                        AC
                                    </option>
                                    <option value="AL"
                                        {{$document_request_above_seventy_five->user->state == 'AL' ? 'selected' : ''}}>
                                        AL
                                    </option>
                                    <option value="AP"
                                        {{$document_request_above_seventy_five->user->state == 'AP' ? 'selected' : ''}}>
                                        AP
                                    </option>
                                    <option value="AM"
                                        {{$document_request_above_seventy_five->user->state == 'AM' ? 'selected' : ''}}>
                                        AM
                                    </option>
                                    <option value="BA"
                                        {{$document_request_above_seventy_five->user->state == 'BA' ? 'selected' : ''}}>
                                        BA
                                    </option>
                                    <option value="CE"
                                        {{$document_request_above_seventy_five->user->state == 'CE' ? 'selected' : ''}}>
                                        CE
                                    </option>
                                    <option value="DF"
                                        {{$document_request_above_seventy_five->user->state == 'DF' ? 'selected' : ''}}>
                                        DF
                                    </option>
                                    <option value="ES"
                                        {{$document_request_above_seventy_five->user->state == 'ES' ? 'selected' : ''}}>
                                        ES
                                    </option>
                                    <option value="GO"
                                        {{$document_request_above_seventy_five->user->state == 'GO' ? 'selected' : ''}}>
                                        GO
                                    </option>
                                    <option value="MA"
                                        {{$document_request_above_seventy_five->user->state == 'MA' ? 'selected' : ''}}>
                                        MA
                                    </option>
                                    <option value="MT"
                                        {{$document_request_above_seventy_five->user->state == 'MT' ? 'selected' : ''}}>
                                        MT
                                    </option>
                                    <option value="MS"
                                        {{$document_request_above_seventy_five->user->state == 'MS' ? 'selected' : ''}}>
                                        MS
                                    </option>
                                    <option value="MG"
                                        {{$document_request_above_seventy_five->user->state == 'MG' ? 'selected' : ''}}>
                                        MG
                                    </option>
                                    <option value="PA"
                                        {{$document_request_above_seventy_five->user->state == 'PA' ? 'selected' : ''}}>
                                        PA
                                    </option>
                                    <option value="PB"
                                        {{$document_request_above_seventy_five->user->state == 'PB' ? 'selected' : ''}}>
                                        PB
                                    </option>
                                    <option value="PR"
                                        {{$document_request_above_seventy_five->user->state == 'PR' ? 'selected' : ''}}>
                                        PR
                                    </option>
                                    <option value="PE"
                                        {{$document_request_above_seventy_five->user->state == 'PE' ? 'selected' : ''}}>
                                        PE
                                    </option>
                                    <option value="PI"
                                        {{$document_request_above_seventy_five->user->state == 'PI' ? 'selected' : ''}}>
                                        PI
                                    </option>
                                    <option value="RJ"
                                        {{$document_request_above_seventy_five->user->state == 'RJ' ? 'selected' : ''}}>
                                        RJ
                                    </option>
                                    <option value="RN"
                                        {{$document_request_above_seventy_five->user->state == 'RN' ? 'selected' : ''}}>
                                        RN
                                    </option>
                                    <option value="RS"
                                        {{$document_request_above_seventy_five->user->state == 'RS' ? 'selected' : ''}}>
                                        RS
                                    </option>
                                    <option value="RO"
                                        {{$document_request_above_seventy_five->user->state == 'RO' ? 'selected' : ''}}>
                                        RO
                                    </option>
                                    <option value="RR"
                                        {{$document_request_above_seventy_five->user->state == 'RR' ? 'selected' : ''}}>
                                        RR
                                    </option>
                                    <option value="SC"
                                        {{$document_request_above_seventy_five->user->state == 'SC' ? 'selected' : ''}}>
                                        SC
                                    </option>
                                    <option value="SP"
                                        {{$document_request_above_seventy_five->user->state == 'SP' ? 'selected' : ''}}>
                                        SP
                                    </option>
                                    <option value="SE"
                                        {{$document_request_above_seventy_five->user->state == 'SE' ? 'selected' : ''}}>
                                        SE
                                    </option>
                                    <option value="TO"
                                        {{$document_request_above_seventy_five->user->state == 'TO' ? 'selected' : ''}}>
                                        TO
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features of Distributed Microgeneration -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Características da Microgeração Distribuída</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Generation Type -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generationtype" class="form-label">
                                    Tipo de Geração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-generationtype"
                                    name="edit-request-third-generationtype"
                                    value="{{$document_request_above_seventy_five->generation_type}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="edit-third-generationtype-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Details -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generationdetails" class="form-label">
                                    Especificar se necessário
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-generationdetails"
                                    name="edit-request-third-generationdetails"
                                    value="{{$document_request_above_seventy_five->generation_details}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback"
                                    id="edit-third-generationdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Microgeneration Framework -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generationframework" class="form-label">
                                    Enquadramento da Microgeração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-generationframework"
                                    name="edit-request-third-generationframework"
                                    value="{{$document_request_above_seventy_five->generation_framework}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback"
                                    id="edit-third-generationframework-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Power -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="edit-request-third-generationpower" class="form-label">
                                    Potência de Geração (PG)
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="edit-request-third-generationpower"
                                                name="edit-request-third-generationpower"
                                                value="{{$document_request_above_seventy_five->generation_power != null ? Str::of($document_request_above_seventy_five->generation_power / 1000)->replace('.', ',') : ''}}"
                                                onchange="return window.validateDouble(this)"
                                                onblur="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-third-generationpower-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light">
                                                OK
                                            </span>
                                            <input class="form-control" type="text"
                                                id="edit-request-third-generationok"
                                                name="edit-request-third-generationok"
                                                value="{{$document_request_above_seventy_five->generation_ok}}"
                                                onchange="return window.validateInput(this, 1)"
                                                onkeyup="return window.validateInput(this, 1)">
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-third-generationok-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generation Available Power -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generationpd" class="form-label">
                                    Potência Disponibilizada (PD)
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="edit-request-third-generationpd"
                                        name="edit-request-third-generationpd"
                                        value="{{$document_request_above_seventy_five->generation_available_power != null ? Str::of($document_request_above_seventy_five->generation_available_power / 1000)->replace('.', ',') : ''}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback"
                                    id="edit-third-generationpd-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Voltage -->
                        <div class="col-12 col-lg-5 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generationvoltage" class="form-label">
                                    Tensão de Conexão
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="edit-request-third-generationvoltage"
                                        name="edit-request-third-generationvoltage"
                                        value="{{$document_request_above_seventy_five->generation_voltage}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <span class="input-group-text">kV</span>
                                </div>
                                <div class="invalid-feedback"
                                    id="edit-third-generationvoltage-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Operation Initial Date -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="edit-request-third-generationstart" class="form-label">
                                    Data Início de Operação
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-third-generationstart"
                                    value="{{$document_request_above_seventy_five->generation_start_date}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Necessary Documents -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Documentos Necessários que Devem ser Anexados à Solicitação de Acesso
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mt-3 mb-4 border-bottom">
                        <div class="col-6">
                            <h6>Descrição</h6>
                        </div>

                        <div class="col-6">
                            <h6>Observações</h6>
                        </div>
                    </div>

                    <!-- ART -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">1.</span> ART do Responsável Técnico pelo projeto e instalação do sistema de microgeração
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-art"
                                    name="edit-request-third-art"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->art_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-art-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Diagram -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">2.</span> Diagrama unifilar contemplando Geração, Proteção (inversor, se for o caso), Carga e Medição
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-diagram"
                                    name="edit-request-third-diagram"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->diagram_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-diagram-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Descriptive Technical Memo -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">3.</span> Memorial Técnico Descritivo da instalação (Conforme Modelo do ANEXO III - MODELO DE MEMORIAL TÉCNICO DESCRITIVO)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-memo"
                                    name="edit-request-third-memo"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->memo_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-memo-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Electrical design of connection installations -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">4.</span> Projeto elétrico das instalações de conexão, contendo: a) Planta de Situação; b) Diagrama Funcional; c) Arranjos Físicos ou Lay-out; e d) Manual com Folha de Dados (datasheet) dos inversores
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-electrical"
                                    name="edit-request-third-electrical"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->electrical_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-electrical-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                     <!-- Current stage of the enterprise -->
                     <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">5.</span> Estágio atual do empreendimento, cronograma de implantação e expansão (PLANILHA NA GUIA 3)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-stage"
                                    name="edit-request-third-stage"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->current_stage_observation}}</textarea>
                                <div class="invalid-feedback" id="edit-third-stage-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Inverter Compliance Certificate -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">6.</span> Certificados de Conformidade dos Inversores ou o número de registro de concessão do INMETRO do(s) inversor(es) para a tensão nominal de conexão com a rede
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-compliance"
                                    name="edit-request-third-compliance"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->compliance_certificate_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-compliance-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- UC Participants -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">7.</span> Lista de unidades consumidoras participantes do sistema de compensação (se houver) indicando na porcentagem de rateio dos créditos e o enquadramento conforme incisos VI a VIII do art. 2º da Resolução Normativa nº 482/2012 (PLANILHA NA GUIA 2)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-participants"
                                    name="edit-request-third-participants"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->uc_participants_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-participants-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Legal Instrument -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">8.</span> Cópia de instrumento jurídico que comprove o compromisso de solidariedade entre os Integrantes (se houver)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-instrument"
                                    name="edit-request-third-instrument"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->legal_instrument_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-instrument-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Recognition for ANEEL -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">9.</span> Documento que comprove o reconhecimento pela ANEEL, da cogeração qualificada (se houver)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-aneel"
                                    name="edit-request-third-aneel"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->aneel_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-aneel-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Technical viability -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">10.</span> Formulário de Viabilidade Técnica, conforme ANEXO III - SOLICITAÇÃO DE VIABILIDADE TÉCNICA da norma NT.002.EQTL.Normas e Padrões
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-viability"
                                    name="edit-request-third-viability"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->technical_viability_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-viability-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Load chart for air substation -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">11.</span> Quadro de Cargas para Cálculo Preliminar da Carga Instalada e da Demanda e Cálculo de Parâmetros Preliminares de Dimensionamento para
                                Subestação Aérea até 300 kVA, conforme ANEXO II - DIMENSIONAMENTO DE SE AÉREA da norma NT.002.EQTL.Normas e Padrões
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-chartair"
                                    name="edit-request-third-chartair"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->air_substation_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-chartair-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Load chart sheltered substation -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">12.</span> Quadro de Cargas para Cálculo Preliminar da Carga Instalada e da Demanda para Subestação Abrigada (alvernaria ou cubículo) acima de 300
                                kVA, conforme ANEXO I - CÁLCULO DA DEMANDA da norma NT.002.EQTL.Normas e Padrões
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-chartsheltered"
                                    name="edit-request-third-chartsheltered"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->air_sheltered_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-chartsheltered-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Rent Contract -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">13.</span> Contrato de Aluguel ou Arrendamento da unidade consumidora (quando necessário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-rent"
                                    name="edit-request-third-rent"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->rent_contract_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-rent-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Procuration -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">14.</span> Procuração (quando necesário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-procuration"
                                    name="edit-request-third-procuration"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->procuration_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-procuration-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Use of Common Area in Condominium -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">15.</span> Autorização de uso de área comum em condomínio (quando necessário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-third-condominium"
                                    name="edit-request-third-condominium"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_above_seventy_five->condominium_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-third-condominium-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="btn-floating">
                    <button type="submit" class="btn btn-success"
                        id="btn-edit-request-type-third"
                        onclick="return window.submitFormEditRequestTypeThird(this)">
                        <i class="bi bi-save-fill"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>