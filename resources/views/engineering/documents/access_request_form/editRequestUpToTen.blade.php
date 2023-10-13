@section('page_title', 'Editar Formulário de Solicitação de Acesso')

<script src="{{asset(mix('js/engineering/documents/access_request_form/editRequestUpToTen.js'))}}" defer></script>
<script>
    var url_get_engineer_data = "{{route('engineering_get_engineer_data_fetch')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>{{_('Editar Formulário de Solicitação de Acesso para Microgeração')}}</h3>
                <p class="text-subtitle text-muted">
                    Dados para geração de <span class="fw-bold">até 10 kW</span>.
                </p>
                <p class="mt-5">
                    Preencher, obrigatoriamente, todos os campos com asterísco (<span class="text-danger">*</span>).
                </p>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
        <form action="{{route('engineering_document_update_request', ['type' => encrypt('up_to_ten'), 'id' => encrypt($document_request_up_to_ten->id)])}}" method="POST"
            id="form-edit-request-type-first"
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
                                <label for="edit-request-first-clientname" class="form-label">
                                    Nome do Cliente/Razão Social (Titular da UC)
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-clientname"
                                    @if ($document_request_up_to_ten->generator->client->is_corporate)
                                        value="{{$document_request_up_to_ten->generator->client->corporate_name}}"
                                    @else
                                        value="{{$document_request_up_to_ten->generator->client->name}}"
                                    @endif"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Client CPF/CNPJ -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-clientcpfcnpj" class="form-label">
                                    CPF/CNPJ
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-clientcpfcnpj"
                                    @if ($document_request_up_to_ten->generator->client->is_corporate)
                                        value="{{$document_request_up_to_ten->generator->client->cnpj}}"
                                    @else
                                        value="{{$document_request_up_to_ten->generator->client->cpf}}"
                                    @endif"
                                    disabled>
                            </div>
                        </div>

                        <!-- Client RG -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-clientrg" class="form-label">
                                    RG
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-clientrg"
                                    name="edit-request-first-clientrg"
                                    value="{{$document_request_up_to_ten->client_rg}}"
                                    onchange="return window.validateInput(this, 7)"
                                    onkeyup="return window.validateInput(this, 7)"
                                    maxlength="9">
                                <div class="invalid-feedback" id="edit-first-clientrg-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Client RG Shipping Date -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-clientrgshipping" class="form-label">
                                    Data de Expedição
                                </label>
                                <input class="form-control" type="date"
                                    id="edit-request-first-clientrgshipping"
                                    name="edit-request-first-clientrgshipping"
                                    value="{{$document_request_up_to_ten->client_rg_shipping_date != null ? date('Y-m-d', strToTime($document_request_up_to_ten->client_rg_shipping_date)) : ''}}"
                                    onchange="return window.validateRGShippingDate(this)"
                                    onkeyup="return window.validateRGShippingDate(this)">
                                <div class="invalid-feedback" id="edit-first-clientrgshipping-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator Address -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-generatoraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-generatoraddress"
                                    value="{{$document_request_up_to_ten->generator->generator_address}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator CEP -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-generatorcep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-generatorcep"
                                    value="{{$document_request_up_to_ten->generator->generator_cep}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Generator City -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-generatorcity" class="form-label">
                                    Município
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-generatorcity"
                                    value="{{$document_request_up_to_ten->generator->generator_city}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Generator State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-generatorstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select" 
                                    aria-label="edit-request-first-generatorstate"
                                    id="edit-request-first-generatorstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC"
                                        {{$document_request_up_to_ten->generator->generator_state == 'AC' ? 'selected' : ''}}>
                                        AC
                                    </option>
                                    <option value="AL"
                                        {{$document_request_up_to_ten->generator->generator_state == 'AL' ? 'selected' : ''}}>
                                        AL
                                    </option>
                                    <option value="AP"
                                        {{$document_request_up_to_ten->generator->generator_state == 'AP' ? 'selected' : ''}}>
                                        AP
                                    </option>
                                    <option value="AM"
                                        {{$document_request_up_to_ten->generator->generator_state == 'AM' ? 'selected' : ''}}>
                                        AM
                                    </option>
                                    <option value="BA"
                                        {{$document_request_up_to_ten->generator->generator_state == 'BA' ? 'selected' : ''}}>
                                        BA
                                    </option>
                                    <option value="CE"
                                        {{$document_request_up_to_ten->generator->generator_state == 'CE' ? 'selected' : ''}}>
                                        CE
                                    </option>
                                    <option value="DF"
                                        {{$document_request_up_to_ten->generator->generator_state == 'DF' ? 'selected' : ''}}>
                                        DF
                                    </option>
                                    <option value="ES"
                                        {{$document_request_up_to_ten->generator->generator_state == 'ES' ? 'selected' : ''}}>
                                        ES
                                    </option>
                                    <option value="GO"
                                        {{$document_request_up_to_ten->generator->generator_state == 'GO' ? 'selected' : ''}}>
                                        GO
                                    </option>
                                    <option value="MA"
                                        {{$document_request_up_to_ten->generator->generator_state == 'MA' ? 'selected' : ''}}>
                                        MA
                                    </option>
                                    <option value="MT"
                                        {{$document_request_up_to_ten->generator->generator_state == 'MT' ? 'selected' : ''}}>
                                        MT
                                    </option>
                                    <option value="MS"
                                        {{$document_request_up_to_ten->generator->generator_state == 'MS' ? 'selected' : ''}}>
                                        MS
                                    </option>
                                    <option value="MG"
                                        {{$document_request_up_to_ten->generator->generator_state == 'MG' ? 'selected' : ''}}>
                                        MG
                                    </option>
                                    <option value="PA"
                                        {{$document_request_up_to_ten->generator->generator_state == 'PA' ? 'selected' : ''}}>
                                        PA
                                    </option>
                                    <option value="PB"
                                        {{$document_request_up_to_ten->generator->generator_state == 'PB' ? 'selected' : ''}}>
                                        PB
                                    </option>
                                    <option value="PR"
                                        {{$document_request_up_to_ten->generator->generator_state == 'PR' ? 'selected' : ''}}>
                                        PR
                                    </option>
                                    <option value="PE"
                                        {{$document_request_up_to_ten->generator->generator_state == 'PE' ? 'selected' : ''}}>
                                        PE
                                    </option>
                                    <option value="PI"
                                        {{$document_request_up_to_ten->generator->generator_state == 'PI' ? 'selected' : ''}}>
                                        PI
                                    </option>
                                    <option value="RJ"
                                        {{$document_request_up_to_ten->generator->generator_state == 'RJ' ? 'selected' : ''}}>
                                        RJ
                                    </option>
                                    <option value="RN"
                                        {{$document_request_up_to_ten->generator->generator_state == 'RN' ? 'selected' : ''}}>
                                        RN
                                    </option>
                                    <option value="RS"
                                        {{$document_request_up_to_ten->generator->generator_state == 'RS' ? 'selected' : ''}}>
                                        RS
                                    </option>
                                    <option value="RO"
                                        {{$document_request_up_to_ten->generator->generator_state == 'RO' ? 'selected' : ''}}>
                                        RO
                                    </option>
                                    <option value="RR"
                                        {{$document_request_up_to_ten->generator->generator_state == 'RR' ? 'selected' : ''}}>
                                        RR
                                    </option>
                                    <option value="SC"
                                        {{$document_request_up_to_ten->generator->generator_state == 'SC' ? 'selected' : ''}}>
                                        SC
                                    </option>
                                    <option value="SP"
                                        {{$document_request_up_to_ten->generator->generator_state == 'SP' ? 'selected' : ''}}>
                                        SP
                                    </option>
                                    <option value="SE"
                                        {{$document_request_up_to_ten->generator->generator_state == 'SE' ? 'selected' : ''}}>
                                        SE
                                    </option>
                                    <option value="TO"
                                        {{$document_request_up_to_ten->generator->generator_state == 'TO' ? 'selected' : ''}}>
                                        TO
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (strlen(Str::of($document_request_up_to_ten->generator->client->phone)->matchAll('/[\d]+/')[1]) == 5)
                            <!-- Client Cellphone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="edit-request-first-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="edit-request-first-clientcellphone"
                                        value="{{$document_request_up_to_ten->generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="edit-request-first-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="edit-request-first-clientphone"
                                        name="edit-request-first-clientphone"
                                        value="{{$document_request_up_to_ten->client_phone}}"
                                        onchange="return window.validatePhone(this, 10)"
                                        onkeyup="return window.validatePhone(this, 10)">
                                    <div class="invalid-feedback" id="edit-first-clientphone-feedback-request"></div>
                                </div>
                            </div>
                        @else
                            <!-- Client Cellphone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="edit-request-first-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="edit-request-first-clientcellphone"
                                        name="edit-request-first-clientcellphone"
                                        value="{{$document_request_up_to_ten->client_cellphone}}"
                                        onchange="return window.validatePhone(this, 11)"
                                        onkeyup="return window.validatePhone(this, 11)">
                                    <div class="invalid-feedback"
                                        id="edit-first-clientcellphone-feedback-request"></div>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="edit-request-first-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="edit-request-first-clientphone"
                                        value="{{$document_request_up_to_ten->generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>
                        @endif

                        <!-- Client Email -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-clientmail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="clientmail"
                                    id="edit-request-first-clientmail"
                                    value="{{$document_request_up_to_ten->generator->client->email}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Project Type -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-projecttype" class="form-label">
                                    Tipo de Solicitação
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-projecttype"
                                    @switch ($document_request_up_to_ten->generator->generator_project_type)
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
                                <label for="edit-request-first-contractaccount" class="form-label">
                                    Conta Contrato (Se UC existente)
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-contractaccount"
                                    value="{{$document_request_up_to_ten->generator->generator_contract_account}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Branch of Activity -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-activity" class="form-label">
                                    Ramo de Atividade (Descrição)
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-activity"
                                    name="edit-request-first-activity"
                                    value="{{$document_request_up_to_ten->branch_activity}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="edit-first-activity-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Special Loads -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-loads" class="form-label">
                                    Possui Cargas Especiais?
                                </label>
                                <select class="form-select" 
                                    aria-label="edit-request-first-loads"
                                    id="edit-request-first-loads"
                                    name="edit-request-first-loads"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)">
                                    <option value="" disabled selected>
                                        Selecione uma opção
                                    </option>
                                    <option value="{{encrypt('NÃO')}}"
                                        {{!$document_request_up_to_ten->has_special_loads ? 'selected' : ''}}>
                                        Não
                                    </option>
                                    <option value="{{encrypt('SIM')}}"
                                        {{$document_request_up_to_ten->has_special_loads ? 'selected' : ''}}>
                                        Sim
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="edit-first-loads-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Special Loads Details -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-loadsdetails" class="form-label">
                                    Detalhar Cargas Especiais
                                </label>
                                <textarea class="form-control" id="edit-request-first-loadsdetails"
                                    name="edit-request-first-loadsdetails"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    rows="3">{{$document_request_up_to_ten->special_loads_details}}</textarea>
                                <div class="invalid-feedback" id="edit-first-loadsdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Subgroup -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-subgroup" class="form-label">
                                    Subgrupo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-subgroup"
                                    name="edit-request-first-subgroup"
                                    value="{{$document_request_up_to_ten->subgroup}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)"
                                    required>
                                <div class="invalid-feedback" id="edit-first-subgroup-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Class -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-class" class="form-label">
                                    Classe <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="edit-request-first-class"
                                    id="edit-request-first-class"
                                    name="edit-request-first-class"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha a classe
                                    </option>
                                    <option value="{{encrypt('RESIDENCIAL')}}"
                                        {{$document_request_up_to_ten->consumption_class == 'RESIDENCIAL' ? 'selected' : ''}}>
                                        Residencial
                                    </option>
                                    <option value="{{encrypt('INDUSTRIAL')}}"
                                        {{$document_request_up_to_ten->consumption_class == 'INDUSTRIAL' ? 'selected' : ''}}>
                                        Industrial
                                    </option>
                                    <option value="{{encrypt('COMERCIO_SERVICOS_OUTROS')}}"
                                        {{$document_request_up_to_ten->consumption_class == 'COMERCIO_SERVICOS_OUTROS' ? 'selected' : ''}}>
                                        Comércio, Serviço e outras atividades
                                    </option>
                                    <option value="{{encrypt('RURAL')}}"
                                        {{$document_request_up_to_ten->consumption_class == 'RURAL' ? 'selected' : ''}}>
                                        Rural
                                    </option>
                                    <option value="{{encrypt('PODER_PUBLICO')}}"
                                        {{$document_request_up_to_ten->consumption_class == 'PODER_PUBLICO' ? 'selected' : ''}}>
                                        Poder Público
                                    </option>
                                    <option value="{{encrypt('ILUMINACAO_PUBLICA')}}"
                                        {{$document_request_up_to_ten->consumption_class == 'ILUMINACAO_PUBLICA' ? 'selected' : ''}}>
                                        Iluminação Pública
                                    </option>
                                    <option value="{{encrypt('SERVICO_PUBLICO')}}"
                                        {{$document_request_up_to_ten->consumption_class == 'SERVICO_PUBLICO' ? 'selected' : ''}}>
                                        Serviço Público
                                    </option>
                                    <option value="{{encrypt('CONSUMO_PROPRIO')}}"
                                        {{$document_request_up_to_ten->consumption_class == 'CONSUMO_PROPRIO' ? 'selected' : ''}}>
                                        Consumo Próprio
                                    </option>
                                </select>
                                <div class="invalid-feedback" 
                                    id="edit-first-class-feedback-request">
                                </div>
                            </div>
                        </div>

                        <!-- Connection Type -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-conntype" class="form-label">
                                    Tipo de Ligação <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="edit-request-first-conntype"
                                    id="edit-request-first-conntype"
                                    name="edit-request-first-conntype"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha o tipo
                                    </option>
                                    <option value="{{encrypt('MONOFASICO')}}"
                                        {{$document_request_up_to_ten->connection_type == 'MONOFASICO' ? 'selected' : ''}}>
                                        Monofásico
                                    </option>
                                    <option value="{{encrypt('BIFASICO')}}"
                                        {{$document_request_up_to_ten->connection_type == 'BIFASICO' ? 'selected' : ''}}>
                                        Bifásico
                                    </option>
                                    <option value="{{encrypt('TRIFASICO')}}"
                                        {{$document_request_up_to_ten->connection_type == 'TRIFASICO' ? 'selected' : ''}}>
                                        Trifásico
                                    </option>
                                </select>
                                <div class="invalid-feedback" 
                                    id="edit-first-conntype-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Power -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-ucpower" class="form-label">
                                    Tensão de Atendimento da UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="edit-request-first-ucpower"
                                        name="edit-request-first-ucpower"
                                        value="{{$document_request_up_to_ten->uc_power != null ? Str::of($document_request_up_to_ten->uc_power)->replace('.', ',') : ''}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">V</span>
                                </div>
                                <div class="invalid-feedback" id="edit-first-ucpower-feedback-request"></div>
                            </div>
                        </div>

                        <!-- UC Declared Load -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-ucload" class="form-label">
                                    Carga Declarada da UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="edit-request-first-ucload"
                                        name="edit-request-first-ucload"
                                        value="{{$document_request_up_to_ten->uc_declared_load != null ? Str::of($document_request_up_to_ten->uc_declared_load / 1000)->replace('.', ',') : ''}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback" id="edit-first-ucload-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Input Circuit Breaker -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-ucbreaker" class="form-label">
                                    Disjuntor de Entrada da UC <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="edit-request-first-ucbreaker"
                                        name="edit-request-first-ucbreaker"
                                        value="{{$document_request_up_to_ten->uc_circuit_breaker != null ? Str::of($document_request_up_to_ten->uc_circuit_breaker)->replace('.', ',') : ''}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)"
                                        required>
                                    <span class="input-group-text">A</span>
                                </div>
                                <div class="invalid-feedback" id="edit-first-ucbreaker-feedback-request"></div>
                            </div>
                        </div>

                         <!-- UC Available Power -->
                         <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-ucpd" class="form-label">
                                    Potência Disponibilizada para UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="edit-request-first-ucpd"
                                        name="edit-request-first-ucpd"
                                        value="{{$document_request_up_to_ten->uc_available_power != null ? Str::of($document_request_up_to_ten->uc_available_power / 1000)->replace('.', ',') : ''}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback" id="edit-first-ucpd-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <!-- Extension Type -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-extension" class="form-label">
                                    Tipo de Ramal <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-extension"
                                    name="edit-request-first-extension"
                                    value="{{$document_request_up_to_ten->extension_type}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="edit-first-extension-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Transformer Identification -->
                        <div class="col-12 col-lg-8 mb-3">
                           <div class="form-group">
                               <label for="edit-request-first-transformerid" class="form-label">
                                   Nº de Identificação do Poste ou Transformador mais Próximo
                               </label>
                               <input class="form-control" type="text"
                                   id="edit-request-first-transformerid"
                                   name="edit-request-first-transformerid"
                                   value="{{$document_request_up_to_ten->transformer_identification}}"
                                   onchange="return window.validateInput(this, 2)"
                                   onkeyup="return window.validateInput(this, 2)">
                               <div class="invalid-feedback" id="edit-first-transformerid-feedback-request"></div>
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- System Delivery Point Coordinates X and Y-->
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label for="edit-request-first-coordinatesx" class="form-label">
                                    Preencher as Coordenadas Ponto de Entrega do Acessante em UTM Fuso 21, 22 ou 23
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">X</span>
                                    <input class="form-control" type="text"
                                        id="edit-request-first-coordinatesx"
                                        name="edit-request-first-coordinatesx"
                                        value="{{Str::of($document_request_up_to_ten->point_coordinate_x)->replace('.', ',')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m E</span>
                                </div>
                                <div class="invalid-feedback" id="edit-first-coordinatesx-feedback-request"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">Y</span>
                                    <input class="form-control" type="text"
                                        id="edit-request-first-coordinatesy"
                                        name="edit-request-first-coordinatesy"
                                        value="{{Str::of($document_request_up_to_ten->point_coordinate_y)->replace('.', ',')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m S</span>
                                </div>
                                <div class="invalid-feedback" id="edit-first-coordinatesy-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Responsible Name -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-responsiblename" class="form-label">
                                    Nome do Responsável Legal
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-responsiblename"
                                    name="edit-request-first-responsiblename"
                                    value="{{$document_request_up_to_ten->responsible_name}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="edit-first-responsiblename-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Responsible Phone -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-responsiblephone" class="form-label">
                                    Telefone do Responsável Legal
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-responsiblephone"
                                    name="edit-request-first-responsiblephone"
                                    value="{{$document_request_up_to_ten->responsible_phone}}"
                                    onchange="return window.validatePhone(this, 11)"
                                    onkeyup="return window.validatePhone(this, 11)">
                                <div class="invalid-feedback" id="edit-first-responsiblephone-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Responsible Email -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-responsibleemail" class="form-label">
                                    Email do Responsável Legal
                                </label>
                                <input class="form-control" type="email"
                                    id="edit-request-first-responsibleemail"
                                    name="edit-request-first-responsibleemail"
                                    value="{{$document_request_up_to_ten->responsible_email}}"
                                    onchange="return window.validateResponsibleEmail(this)"
                                    onkeyup="return window.validateResponsibleEmail(this)">
                                <div class="invalid-feedback" id="edit-first-responsibleemail-feedback-request"></div>
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
                                <label for="edit-request-first-managername" class="form-label">
                                    Nome Completo <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                    aria-label="edit-request-first-managername"
                                    id="edit-request-first-managername"
                                    name="edit-request-first-managername"
                                    onchange="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Selecione o responsável
                                    </option>
                                    @foreach ($arr_engineers as $engineer)
                                        <option value="{{encrypt($engineer)}}"
                                            {{$document_request_up_to_ten->user->name == $engineer ? 'selected' : ''}}>
                                            {{$engineer}}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="edit-first-managername-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Title -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managertitle" class="form-label">
                                    Título Profissional
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-managertitle"
                                    value="{{$document_request_up_to_ten->user->professional_title}}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Technical Manager Professional Registration -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managerregistration" class="form-label">
                                    Nº do Registro Profissional
                                </label>
                                <input class="form-control rounded-end me-2" type="text"
                                    id="edit-request-first-managerregistration"
                                    value="{{$document_request_up_to_ten->user->professional_registration}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Registration State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managerregistrationstate" class="form-label">
                                    UF
                                </label>
                                <select class="form-select" 
                                    aria-label="edit-request-first-managerregistrationstate"
                                    id="edit-request-first-managerregistrationstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC"
                                        {{$document_request_up_to_ten->user->professional_state == 'AC' ? 'selected' : ''}}>
                                        AC
                                    </option>
                                    <option value="AL"
                                        {{$document_request_up_to_ten->user->professional_state == 'AL' ? 'selected' : ''}}>
                                        AL
                                    </option>
                                    <option value="AP"
                                        {{$document_request_up_to_ten->user->professional_state == 'AP' ? 'selected' : ''}}>
                                        AP
                                    </option>
                                    <option value="AM"
                                        {{$document_request_up_to_ten->user->professional_state == 'AM' ? 'selected' : ''}}>
                                        AM
                                    </option>
                                    <option value="BA"
                                        {{$document_request_up_to_ten->user->professional_state == 'BA' ? 'selected' : ''}}>
                                        BA
                                    </option>
                                    <option value="CE"
                                        {{$document_request_up_to_ten->user->professional_state == 'CE' ? 'selected' : ''}}>
                                        CE
                                    </option>
                                    <option value="DF"
                                        {{$document_request_up_to_ten->user->professional_state == 'DF' ? 'selected' : ''}}>
                                        DF
                                    </option>
                                    <option value="ES"
                                        {{$document_request_up_to_ten->user->professional_state == 'ES' ? 'selected' : ''}}>
                                        ES
                                    </option>
                                    <option value="GO"
                                        {{$document_request_up_to_ten->user->professional_state == 'GO' ? 'selected' : ''}}>
                                        GO
                                    </option>
                                    <option value="MA"
                                        {{$document_request_up_to_ten->user->professional_state == 'MA' ? 'selected' : ''}}>
                                        MA
                                    </option>
                                    <option value="MT"
                                        {{$document_request_up_to_ten->user->professional_state == 'MT' ? 'selected' : ''}}>
                                        MT
                                    </option>
                                    <option value="MS"
                                        {{$document_request_up_to_ten->user->professional_state == 'MS' ? 'selected' : ''}}>
                                        MS
                                    </option>
                                    <option value="MG"
                                        {{$document_request_up_to_ten->user->professional_state == 'MG' ? 'selected' : ''}}>
                                        MG
                                    </option>
                                    <option value="PA"
                                        {{$document_request_up_to_ten->user->professional_state == 'PA' ? 'selected' : ''}}>
                                        PA
                                    </option>
                                    <option value="PB"
                                        {{$document_request_up_to_ten->user->professional_state == 'PB' ? 'selected' : ''}}>
                                        PB
                                    </option>
                                    <option value="PR"
                                        {{$document_request_up_to_ten->user->professional_state == 'PR' ? 'selected' : ''}}>
                                        PR
                                    </option>
                                    <option value="PE"
                                        {{$document_request_up_to_ten->user->professional_state == 'PE' ? 'selected' : ''}}>
                                        PE
                                    </option>
                                    <option value="PI"
                                        {{$document_request_up_to_ten->user->professional_state == 'PI' ? 'selected' : ''}}>
                                        PI
                                    </option>
                                    <option value="RJ"
                                        {{$document_request_up_to_ten->user->professional_state == 'RJ' ? 'selected' : ''}}>
                                        RJ
                                    </option>
                                    <option value="RN"
                                        {{$document_request_up_to_ten->user->professional_state == 'RN' ? 'selected' : ''}}>
                                        RN
                                    </option>
                                    <option value="RS"
                                        {{$document_request_up_to_ten->user->professional_state == 'RS' ? 'selected' : ''}}>
                                        RS
                                    </option>
                                    <option value="RO"
                                        {{$document_request_up_to_ten->user->professional_state == 'RO' ? 'selected' : ''}}>
                                        RO
                                    </option>
                                    <option value="RR"
                                        {{$document_request_up_to_ten->user->professional_state == 'RR' ? 'selected' : ''}}>
                                        RR
                                    </option>
                                    <option value="SC"
                                        {{$document_request_up_to_ten->user->professional_state == 'SC' ? 'selected' : ''}}>
                                        SC
                                    </option>
                                    <option value="SP"
                                        {{$document_request_up_to_ten->user->professional_state == 'SP' ? 'selected' : ''}}>
                                        SP
                                    </option>
                                    <option value="SE"
                                        {{$document_request_up_to_ten->user->professional_state == 'SE' ? 'selected' : ''}}>
                                        SE
                                    </option>
                                    <option value="TO"
                                        {{$document_request_up_to_ten->user->professional_state == 'TO' ? 'selected' : ''}}>
                                        TO
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Technical Manager Email -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-manageremail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="email"
                                    id="edit-request-first-manageremail"
                                    value="{{$document_request_up_to_ten->user->email}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Phone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managerphone" class="form-label">
                                    Telefone Fixo
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-managerphone"
                                    value="{{$document_request_up_to_ten->user->phone}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Cellphone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managercellphone" class="form-label">
                                    Telefone Celular
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-managercellphone"
                                    value="{{$document_request_up_to_ten->user->cellphone}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager CEP -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managercep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-managercep"
                                    value="{{$document_request_up_to_ten->user->cep}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Address -->
                        <div class="col-12 col-lg-7 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-manageraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-manageraddress"
                                    value="{{$document_request_up_to_ten->user->address}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Number -->
                        <div class="col-12 col-lg-2 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managernumber" class="form-label">
                                    Número/Apt.
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-managernumber"
                                    value="{{$document_request_up_to_ten->user->number}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Neighborhood -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managerneighborhood" class="form-label">
                                    Bairro
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-managerneighborhood"
                                    value="{{$document_request_up_to_ten->user->neighborhood}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager City -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managercity" class="form-label">
                                    Cidade
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-managercity"
                                    value="{{$document_request_up_to_ten->user->city}}"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-managerstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select"
                                    aria-label="edit-request-first-managerstate"
                                    id="edit-request-first-managerstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC"
                                        {{$document_request_up_to_ten->user->state == 'AC' ? 'selected' : ''}}>
                                        AC
                                    </option>
                                    <option value="AL"
                                        {{$document_request_up_to_ten->user->state == 'AL' ? 'selected' : ''}}>
                                        AL
                                    </option>
                                    <option value="AP"
                                        {{$document_request_up_to_ten->user->state == 'AP' ? 'selected' : ''}}>
                                        AP
                                    </option>
                                    <option value="AM"
                                        {{$document_request_up_to_ten->user->state == 'AM' ? 'selected' : ''}}>
                                        AM
                                    </option>
                                    <option value="BA"
                                        {{$document_request_up_to_ten->user->state == 'BA' ? 'selected' : ''}}>
                                        BA
                                    </option>
                                    <option value="CE"
                                        {{$document_request_up_to_ten->user->state == 'CE' ? 'selected' : ''}}>
                                        CE
                                    </option>
                                    <option value="DF"
                                        {{$document_request_up_to_ten->user->state == 'DF' ? 'selected' : ''}}>
                                        DF
                                    </option>
                                    <option value="ES"
                                        {{$document_request_up_to_ten->user->state == 'ES' ? 'selected' : ''}}>
                                        ES
                                    </option>
                                    <option value="GO"
                                        {{$document_request_up_to_ten->user->state == 'GO' ? 'selected' : ''}}>
                                        GO
                                    </option>
                                    <option value="MA"
                                        {{$document_request_up_to_ten->user->state == 'MA' ? 'selected' : ''}}>
                                        MA
                                    </option>
                                    <option value="MT"
                                        {{$document_request_up_to_ten->user->state == 'MT' ? 'selected' : ''}}>
                                        MT
                                    </option>
                                    <option value="MS"
                                        {{$document_request_up_to_ten->user->state == 'MS' ? 'selected' : ''}}>
                                        MS
                                    </option>
                                    <option value="MG"
                                        {{$document_request_up_to_ten->user->state == 'MG' ? 'selected' : ''}}>
                                        MG
                                    </option>
                                    <option value="PA"
                                        {{$document_request_up_to_ten->user->state == 'PA' ? 'selected' : ''}}>
                                        PA
                                    </option>
                                    <option value="PB"
                                        {{$document_request_up_to_ten->user->state == 'PB' ? 'selected' : ''}}>
                                        PB
                                    </option>
                                    <option value="PR"
                                        {{$document_request_up_to_ten->user->state == 'PR' ? 'selected' : ''}}>
                                        PR
                                    </option>
                                    <option value="PE"
                                        {{$document_request_up_to_ten->user->state == 'PE' ? 'selected' : ''}}>
                                        PE
                                    </option>
                                    <option value="PI"
                                        {{$document_request_up_to_ten->user->state == 'PI' ? 'selected' : ''}}>
                                        PI
                                    </option>
                                    <option value="RJ"
                                        {{$document_request_up_to_ten->user->state == 'RJ' ? 'selected' : ''}}>
                                        RJ
                                    </option>
                                    <option value="RN"
                                        {{$document_request_up_to_ten->user->state == 'RN' ? 'selected' : ''}}>
                                        RN
                                    </option>
                                    <option value="RS"
                                        {{$document_request_up_to_ten->user->state == 'RS' ? 'selected' : ''}}>
                                        RS
                                    </option>
                                    <option value="RO"
                                        {{$document_request_up_to_ten->user->state == 'RO' ? 'selected' : ''}}>
                                        RO
                                    </option>
                                    <option value="RR"
                                        {{$document_request_up_to_ten->user->state == 'RR' ? 'selected' : ''}}>
                                        RR
                                    </option>
                                    <option value="SC"
                                        {{$document_request_up_to_ten->user->state == 'SC' ? 'selected' : ''}}>
                                        SC
                                    </option>
                                    <option value="SP"
                                        {{$document_request_up_to_ten->user->state == 'SP' ? 'selected' : ''}}>
                                        SP
                                    </option>
                                    <option value="SE"
                                        {{$document_request_up_to_ten->user->state == 'SE' ? 'selected' : ''}}>
                                        SE
                                    </option>
                                    <option value="TO"
                                        {{$document_request_up_to_ten->user->state == 'TO' ? 'selected' : ''}}>
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
                                <label for="edit-request-first-generationtype" class="form-label">
                                    Tipo de Geração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-generationtype"
                                    name="edit-request-first-generationtype"
                                    value="{{$document_request_up_to_ten->generation_type}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="edit-first-generationtype-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Details -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-generationdetails" class="form-label">
                                    Especificar se necessário
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-generationdetails"
                                    name="edit-request-first-generationdetails"
                                    value="{{$document_request_up_to_ten->generation_details}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback"
                                    id="edit-first-generationdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Microgeneration Framework -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-generationframework" class="form-label">
                                    Enquadramento da Microgeração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-generationframework"
                                    name="edit-request-first-generationframework"
                                    value="{{$document_request_up_to_ten->generation_framework}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="edit-first-generationframework-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Power -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="edit-request-first-generationpower" class="form-label">
                                    Potência de Geração
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="edit-request-first-generationpower"
                                                name="edit-request-first-generationpower"
                                                value="{{$document_request_up_to_ten->generation_power != null ? Str::of($document_request_up_to_ten->generation_power / 1000)->replace('.', ',') : ''}}"
                                                onchange="return window.validateDouble(this)"
                                                onblur="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-first-generationpower-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light">
                                                OK
                                            </span>
                                            <input class="form-control" type="text"
                                                id="edit-request-first-generationok"
                                                name="edit-request-first-generationok"
                                                value="{{$document_request_up_to_ten->generation_ok}}"
                                                onchange="return window.validateInput(this, 1)"
                                                onkeyup="return window.validateInput(this, 1)">
                                        </div>
                                        <div class="invalid-feedback"
                                            id="edit-first-generationok-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generation Voltage -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-generationvoltage" class="form-label">
                                    Tensão de Conexão
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="edit-request-first-generationvoltage"
                                        name="edit-request-first-generationvoltage"
                                        value="{{$document_request_up_to_ten->generation_voltage}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <span class="input-group-text">V</span>
                                </div>
                                <div class="invalid-feedback"
                                    id="edit-first-generationvoltage-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Operation Initial Date -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="edit-request-first-generationstart" class="form-label">
                                    Data Início de Operação
                                </label>
                                <input class="form-control" type="text"
                                    id="edit-request-first-generationstart"
                                    value="{{$document_request_up_to_ten->generation_start_date}}"
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
                                <textarea class="form-control" id="edit-request-first-art"
                                    name="edit-request-first-art"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->art_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-art-feedback-request"></div>
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
                                <textarea class="form-control" id="edit-request-first-diagram"
                                    name="edit-request-first-diagram"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->diagram_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-diagram-feedback-request"></div>
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
                                <textarea class="form-control" id="edit-request-first-memo"
                                    name="edit-request-first-memo"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->memo_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-memo-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Inverter Compliance Certificate -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">4.</span> Certificados de Conformidade dos Inversores ou o número de registro de concessão do INMETRO do(s) inversor(es) para a tensão nominal de conexão com a rede
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-compliance"
                                    name="edit-request-first-compliance"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->compliance_certificate_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-compliance-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- UC Participants -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">5.</span> Lista de unidades consumidoras participantes do sistema de compensação (se houver) indicando na porcentagem de rateio dos créditos e o enquadramento conforme incisos VI a VIII do art. 2º da Resolução Normativa nº 482/2012 (PLANILHA NA GUIA 2)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-participants"
                                    name="edit-request-first-participants"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->uc_participants_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-participants-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Legal Instrument -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">6.</span> Cópia de instrumento jurídico que comprove o compromisso de solidariedade entre os Integrantes (se houver)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-instrument"
                                    name="edit-request-first-instrument"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->legal_instrument_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-instrument-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Recognition for ANEEL -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">7.</span> Documento que comprove o reconhecimento pela ANEEL, da cogeração qualificada (se houver)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-aneel"
                                    name="edit-request-first-aneel"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->aneel_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-aneel-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- New Link -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">8.</span> Formulário de Ligação Nova (quando necessário, conforme observação) (Conforme ANEXO IV - FORMULÁRIO DE LIGAÇÃO NOVA)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-link"
                                    name="edit-request-first-link"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->new_link_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-link-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Pattern Change -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">9.</span> Formulário de Troca de Padrão (de monofásico para bifásico ou trifásico, de bifásico para trifásico, de trifásico para bifásico ou monofásico, de bifásico para monofásico) (Conforme ANEXO V - FORMULÁRIO DE TROCA DE PADRÃO)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-pattern"
                                    name="edit-request-first-pattern"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->pattern_change_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-pattern-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Rent Contract -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">10.</span> Contrato de Aluguel ou Arrendamento da unidade consumidora (quando necessário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-rent"
                                    name="edit-request-first-rent"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->rent_contract_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-rent-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Procuration -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">11.</span> Procuração (quando necesário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-procuration"
                                    name="edit-request-first-procuration"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->procuration_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-procuration-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Use of Common Area in Condominium -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">12.</span> Autorização de uso de área comum em condomínio (quando necessário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="edit-request-first-condominium"
                                    name="edit-request-first-condominium"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{$document_request_up_to_ten->condominium_observation}}</textarea>
                                <div class="invalid-feedback"
                                    id="edit-first-condominium-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="btn-floating">
                    <button type="submit" class="btn btn-success"
                        id="btn-edit-request-type-first"
                        onclick="return window.submitFormEditRequestTypeFirst(this)">
                        <i class="bi bi-save-fill"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>