@section('page_title', 'Criar Formulário de Solicitação de Acesso')

<script src="{{asset(mix('js/engineering/documents/access_request_form/createRequestAboveSeventyFive.js'))}}"defer></script>
<script>
    var url_get_engineer_data = "{{route('engineering_get_engineer_data_fetch')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>{{_('Criar Formulário de Solicitação de Acesso para Minigeração Distribuída')}}</h3>
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
        <form action="{{route('engineering_document_store_request', ['type' => encrypt('above_seventy_five'), 'id' => encrypt($generator->id)])}}" method="POST"
            id="form-create-request-type-third"
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
                                <label for="create-request-third-clientname" class="form-label">
                                    Nome do Cliente/Razão Social (Titular da UC)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-clientname"
                                    @if ($generator->client->is_corporate)
                                        value="{{$generator->client->corporate_name}}"
                                    @else
                                        value="{{$generator->client->name}}"
                                    @endif"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Client CPF/CNPJ -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-clientcpfcnpj" class="form-label">
                                    CPF/CNPJ
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-clientcpfcnpj"
                                    @if ($generator->client->is_corporate)
                                        value="{{$generator->client->cnpj}}"
                                    @else
                                        value="{{$generator->client->cpf}}"
                                    @endif"
                                    disabled>
                            </div>
                        </div>

                        <!-- Client RG -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-clientrg" class="form-label">
                                    RG
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-clientrg"
                                    name="create-request-third-clientrg"
                                    value="{{old('create-request-third-clientrg')}}"
                                    onchange="return window.validateInput(this, 7)"
                                    onkeyup="return window.validateInput(this, 7)"
                                    maxlength="9">
                                <div class="invalid-feedback" id="create-third-clientrg-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Client RG Shipping Date -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-clientrgshipping" class="form-label">
                                    Data de Expedição
                                </label>
                                <input class="form-control" type="date"
                                    id="create-request-third-clientrgshipping"
                                    name="create-request-third-clientrgshipping"
                                    value="{{old('create-request-third-clientrgshipping')}}"
                                    onchange="return window.validateRGShippingDate(this)"
                                    onkeyup="return window.validateRGShippingDate(this)">
                                <div class="invalid-feedback" id="create-third-clientrgshipping-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator Address -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generatoraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-generatoraddress"
                                    value="{{$generator->generator_address}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator CEP -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generatorcep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-generatorcep"
                                    value="{{$generator->generator_cep}}"
                                    disabled>
                            </div>
                        </div>

                         <!-- Generator City -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generatorcity" class="form-label">
                                    Município
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-generatorcity"
                                    value="{{$generator->generator_city}}"
                                    disabled>
                            </div>
                        </div>

                         <!-- Generator State -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generatorstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-third-generatorstate"
                                    id="create-request-third-generatorstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC" {{$generator->generator_state == 'AC' ? 'selected' : ''}}>
                                        AC
                                    </option>
                                    <option value="AL" {{$generator->generator_state == 'AL' ? 'selected' : ''}}>
                                        AL
                                    </option>
                                    <option value="AP" {{$generator->generator_state == 'AP' ? 'selected' : ''}}>
                                        AP
                                    </option>
                                    <option value="AM" {{$generator->generator_state == 'AM' ? 'selected' : ''}}>
                                        AM
                                    </option>
                                    <option value="BA" {{$generator->generator_state == 'BA' ? 'selected' : ''}}>
                                        BA
                                    </option>
                                    <option value="CE" {{$generator->generator_state == 'CE' ? 'selected' : ''}}>
                                        CE
                                    </option>
                                    <option value="DF" {{$generator->generator_state == 'DF' ? 'selected' : ''}}>
                                        DF
                                    </option>
                                    <option value="ES" {{$generator->generator_state == 'ES' ? 'selected' : ''}}>
                                        ES
                                    </option>
                                    <option value="GO" {{$generator->generator_state == 'GO' ? 'selected' : ''}}>
                                        GO
                                    </option>
                                    <option value="MA" {{$generator->generator_state == 'MA' ? 'selected' : ''}}>
                                        MA
                                    </option>
                                    <option value="MT" {{$generator->generator_state == 'MT' ? 'selected' : ''}}>
                                        MT
                                    </option>
                                    <option value="MS" {{$generator->generator_state == 'MS' ? 'selected' : ''}}>
                                        MS
                                    </option>
                                    <option value="MG" {{$generator->generator_state == 'MG' ? 'selected' : ''}}>
                                        MG
                                    </option>
                                    <option value="PA" {{$generator->generator_state == 'PA' ? 'selected' : ''}}>
                                        PA
                                    </option>
                                    <option value="PB" {{$generator->generator_state == 'PB' ? 'selected' : ''}}>
                                        PB
                                    </option>
                                    <option value="PR" {{$generator->generator_state == 'PR' ? 'selected' : ''}}>
                                        PR
                                    </option>
                                    <option value="PE" {{$generator->generator_state == 'PE' ? 'selected' : ''}}>
                                        PE
                                    </option>
                                    <option value="PI" {{$generator->generator_state == 'PI' ? 'selected' : ''}}>
                                        PI
                                    </option>
                                    <option value="RJ" {{$generator->generator_state == 'RJ' ? 'selected' : ''}}>
                                        RJ
                                    </option>
                                    <option value="RN" {{$generator->generator_state == 'RN' ? 'selected' : ''}}>
                                        RN
                                    </option>
                                    <option value="RS" {{$generator->generator_state == 'RS' ? 'selected' : ''}}>
                                        RS
                                    </option>
                                    <option value="RO" {{$generator->generator_state == 'RO' ? 'selected' : ''}}>
                                        RO
                                    </option>
                                    <option value="RR" {{$generator->generator_state == 'RR' ? 'selected' : ''}}>
                                        RR
                                    </option>
                                    <option value="SC" {{$generator->generator_state == 'SC' ? 'selected' : ''}}>
                                        SC
                                    </option>
                                    <option value="SP" {{$generator->generator_state == 'SP' ? 'selected' : ''}}>
                                        SP
                                    </option>
                                    <option value="SE" {{$generator->generator_state == 'SE' ? 'selected' : ''}}>
                                        SE
                                    </option>
                                    <option value="TO" {{$generator->generator_state == 'TO' ? 'selected' : ''}}>
                                        TO
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (strlen(Str::of($generator->client->phone)->matchAll('/[\d]+/')[1]) == 5)
                            <!-- Client Cellphone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-third-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-third-clientcellphone"
                                        value="{{$generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-third-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-third-clientphone"
                                        name="create-request-third-clientphone"
                                        value="{{old('create-request-third-clientphone')}}"
                                        onchange="return window.validatePhone(this, 10)"
                                        onkeyup="return window.validatePhone(this, 10)">
                                    <div class="invalid-feedback" id="create-third-clientphone-feedback-request"></div>
                                </div>
                            </div>
                        @else
                            <!-- Client Cellphone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-third-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-third-clientcellphone"
                                        name="create-request-third-clientcellphone"
                                        value="{{old('create-request-third-clientcellphone')}}"
                                        onchange="return window.validatePhone(this, 11)"
                                        onkeyup="return window.validatePhone(this, 11)">
                                    <div class="invalid-feedback"
                                        id="create-third-clientcellphone-feedback-request"></div>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-third-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-third-clientphone"
                                        value="{{$generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>
                        @endif

                        <!-- Client Email -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-clientmail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="clientmail"
                                    id="create-request-third-clientmail"
                                    value="{{$generator->client->email}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Project Type -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-projecttype" class="form-label">
                                    Tipo de Solicitação
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-projecttype"
                                    @switch ($generator->generator_project_type)
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
                                <label for="create-request-third-contractaccount" class="form-label">
                                    Conta Contrato (Se UC existente)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-contractaccount"
                                    value="{{$generator->generator_contract_account}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Branch of Activity -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-activity" class="form-label">
                                    Ramo de Atividade (Descrição)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-activity"
                                    name="create-request-third-activity"
                                    value="{{old('create-request-third-activity')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="create-third-activity-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Special Loads -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-loads" class="form-label">
                                    Possui Cargas Especiais?
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-third-loads"
                                    id="create-request-third-loads"
                                    name="create-request-third-loads"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)">
                                    <option value="" disabled selected>
                                        Selecione uma opção
                                    </option>
                                    <option value="{{encrypt('NÃO')}}">
                                        Não
                                    </option>
                                    <option value="{{encrypt('SIM')}}">
                                        Sim
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="create-third-loads-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Special Loads Details -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-loadsdetails" class="form-label">
                                    Detalhar Cargas Especiais
                                </label>
                                <textarea class="form-control" id="create-request-third-loadsdetails"
                                    name="create-request-third-loadsdetails"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    rows="3">{{old('create-request-third-loadsdetails')}}</textarea>
                                <div class="invalid-feedback" id="create-third-loadsdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Subgroup -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-subgroup" class="form-label">
                                    Subgrupo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-subgroup"
                                    name="create-request-third-subgroup"
                                    value="{{old('create-request-third-subgroup')}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)"
                                    required>
                                <div class="invalid-feedback" id="create-third-subgroup-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Class -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-class" class="form-label">
                                    Classe <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-third-class"
                                    id="create-request-third-class"
                                    name="create-request-third-class"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha a classe
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
                                <div class="invalid-feedback"  id="create-third-class-feedback-request"></div>
                            </div>
                        </div>

                        <!-- UC Connection -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-conntype" class="form-label">
                                    Conexão da UC <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-third-conntype"
                                    id="create-request-third-conntype"
                                    name="create-request-third-conntype"
                                    onchange="return window.validateSelect(this)"
                                    onblur="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Escolha o tipo
                                    </option>
                                    <option value="{{encrypt('MONOFASICO')}}">
                                        Monofásico
                                    </option>
                                    <option value="{{encrypt('BIFASICO')}}">
                                        Bifásico
                                    </option>
                                    <option value="{{encrypt('TRIFASICO')}}">
                                        Trifásico
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="create-third-conntype-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Average FP at Delivery Point/UC Connection -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-ucconn" class="form-label">
                                    FP Médio no Ponto de Entrega/Conexão da UC
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-ucconn"
                                    name="create-request-third-ucconn"
                                    value="{{old('create-request-third-ucconn')}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)">
                                <div class="invalid-feedback" id="create-third-ucconn-feedback-request"></div>
                            </div>
                        </div>

                        <!-- UC Installed Load -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="create-request-third-ucinstalledloadkw" class="form-label">
                                    Carga Instalada da UC
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="create-request-third-ucinstalledloadkw"
                                                name="create-request-third-ucinstalledloadkw"
                                                value="{{old('create-request-third-ucinstalledloadkw')}}"
                                                onchange="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-third-ucinstalledloadkw-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="create-request-third-ucinstalledloadkva"
                                                name="create-request-third-ucinstalledloadkva"
                                                value="{{old('create-request-third-ucinstalledloadkva')}}"
                                                onchange="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kVA</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-third-ucinstalledloadkva-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Demand -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="create-request-third-ucdemandkw" class="form-label">
                                    Demanda da UC
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="create-request-third-ucdemandkw"
                                                name="create-request-third-ucdemandkw"
                                                value="{{old('create-request-third-ucdemandkw')}}"
                                                onchange="return window.validateDouble(this, 1)"
                                                onkeyup="return window.validateDouble(this, 1)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-third-ucdemandkw-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="create-request-third-ucdemandkva"
                                                name="create-request-third-ucdemandkva"
                                                value="{{old('create-request-third-ucdemandkva')}}"
                                                onchange="return window.validateDouble(this, 1)"
                                                onkeyup="return window.validateDouble(this, 1)">
                                            <span class="input-group-text">kVA</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-third-ucdemandkva-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- UC Input Pattern -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-ucinputpattern" class="form-label">
                                    Padrão de Entrada da UC <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-ucinputpattern"
                                    name="create-request-third-ucinputpattern"
                                    value="{{old('create-request-third-ucinputpattern')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback"
                                    id="create-third-ucinputpattern-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Power -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-ucpower" class="form-label">
                                    Tensão de Atendimento da UC <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-third-ucpower"
                                        name="create-request-third-ucpower"
                                        value="{{old('create-request-third-ucpower')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)"
                                        required>
                                    <span class="input-group-text">kV</span>
                                </div>
                                <div class="invalid-feedback" id="create-third-ucpower-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Tariff Group -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-tariffgroup" class="form-label">
                                    Tarifa GRUPO A <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-tariffgroup"
                                    name="create-request-third-tariffgroup"
                                    value="{{old('create-request-third-tariffgroup')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="create-third-tariffgroup-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Contracted Demand -->
                        <div class="col-12 col-lg-5">
                            <div class="form-group mb-0">
                                <label for="create-request-third-contracteddemandfp" class="form-label">
                                    Demanda Contratada
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light btn-sm">FP</span>
                                            <input class="form-control" type="text"
                                                id="create-request-third-contracteddemandfp"
                                                name="create-request-third-contracteddemandfp"
                                                value="{{old('create-request-third-contracteddemandfp')}}"
                                                onchange="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-third-contracteddemandfp-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light btn-sm">P</span>
                                            <input class="form-control" type="text"
                                                id="create-request-third-contracteddemandp"
                                                name="create-request-third-contracteddemandp"
                                                value="{{old('create-request-third-contracteddemandp')}}"
                                                onchange="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-third-contracteddemandp-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <!-- Extension Type -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-extension" class="form-label">
                                    Tipo de Ramal <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-extension"
                                    name="create-request-third-extension"
                                    value="{{old('create-request-third-extension')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="create-third-extension-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Transformer Identification -->
                        <div class="col-12 col-lg-8 mb-3">
                           <div class="form-group">
                               <label for="create-request-third-transformerid" class="form-label">
                                   Nº de Identificação do Poste ou Transformador mais Próximo
                               </label>
                               <input class="form-control" type="text"
                                   id="create-request-third-transformerid"
                                   name="create-request-third-transformerid"
                                   value="{{old('create-request-third-transformerid')}}"
                                   onchange="return window.validateInput(this, 2)"
                                   onkeyup="return window.validateInput(this, 2)">
                               <div class="invalid-feedback" id="create-third-transformerid-feedback-request"></div>
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- System Delivery Point Coordinates X and Y-->
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label for="create-request-third-coordinatesx" class="form-label">
                                    Preencher as Coordenadas Ponto de Entrega do Acessante em UTM Fuso 21, 22 ou 23
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">X</span>
                                    <input class="form-control" type="text"
                                        id="create-request-third-coordinatesx"
                                        name="create-request-third-coordinatesx"
                                        value="{{old('create-request-third-coordinatesx')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m E</span>
                                </div>
                                <div class="invalid-feedback" id="create-third-coordinatesx-feedback-request"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">Y</span>
                                    <input class="form-control" type="text"
                                        id="create-request-third-coordinatesy"
                                        name="create-request-third-coordinatesy"
                                        value="{{old('create-request-third-coordinatesy')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m S</span>
                                </div>
                                <div class="invalid-feedback" id="create-third-coordinatesy-feedback-request"></div>
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
                                <label for="create-request-third-managername" class="form-label">
                                    Nome Completo <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-third-managername"
                                    id="create-request-third-managername"
                                    name="create-request-third-managername"
                                    onchange="return window.validateSelect(this)"
                                    required>
                                    <option value="" disabled selected>
                                        Selecione o responsável
                                    </option>
                                    @foreach ($arr_engineers as $engineer)
                                        <option value="{{encrypt($engineer)}}">
                                            {{$engineer}}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="create-third-managername-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Title -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managertitle" class="form-label">
                                    Título Profissional
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-managertitle"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Technical Manager Professional Registration -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managerregistration" class="form-label">
                                    Nº do Registro Profissional
                                </label>
                                <input class="form-control rounded-end me-2" type="text"
                                    id="create-request-third-managerregistration"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Registration State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managerregistrationstate" class="form-label">
                                    UF
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-third-managerregistrationstate"
                                    id="create-request-third-managerregistrationstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                        </div>

                        <!-- Technical Manager Email -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-manageremail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="email"
                                    id="create-request-third-manageremail"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Phone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managerphone" class="form-label">
                                    Telefone Fixo
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-managerphone"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Cellphone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managercellphone" class="form-label">
                                    Telefone Celular
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-managercellphone"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager CEP -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managercep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-managercep"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Address -->
                        <div class="col-12 col-lg-7 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-manageraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-manageraddress"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Number -->
                        <div class="col-12 col-lg-2 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managernumber" class="form-label">
                                    Número/Apt.
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-managernumber"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Neighborhood -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managerneighborhood" class="form-label">
                                    Bairro
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-managerneighborhood"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager City -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managercity" class="form-label">
                                    Cidade
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-managercity"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-managerstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-third-managerstate"
                                    id="create-request-third-managerstate"
                                    disabled>
                                    <option value="" disabled selected>
                                        Selecione o estado
                                    </option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features of Distributed Minigeneration -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Características da Minigeração Distribuída</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Generation Type -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generationtype" class="form-label">
                                    Tipo de Geração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-generationtype"
                                    name="create-request-third-generationtype"
                                    value="{{old('create-request-third-generationtype')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="create-third-generationtype-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Details -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generationdetails" class="form-label">
                                    Especificar se necessário
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-generationdetails"
                                    name="create-request-third-generationdetails"
                                    value="{{old('create-request-third-generationdetails')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback"
                                    id="create-third-generationdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Microgeneration Framework -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generationframework" class="form-label">
                                    Enquadramento da Microgeração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-generationframework"
                                    name="create-request-third-generationframework"
                                    value="{{old('create-request-third-generationframework')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback"
                                    id="create-third-generationframework-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Power -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="create-request-third-generationpower" class="form-label">
                                    Potência de Geração (PG)
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="create-request-third-generationpower"
                                                name="create-request-third-generationpower"
                                                value="{{old('create-request-third-generationpower')}}"
                                                onchange="return window.validateDouble(this)"
                                                onblur="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-third-generationpower-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light">
                                                OK
                                            </span>
                                            <input class="form-control" type="text"
                                                id="create-request-third-generationok"
                                                name="create-request-third-generationok"
                                                value="{{old('create-request-third-generationok')}}"
                                                onchange="return window.validateInput(this, 1)"
                                                onkeyup="return window.validateInput(this, 1)">
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-third-generationok-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generation Available Power -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generationpd" class="form-label">
                                    Potência Disponibilizada (PD)
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-third-generationpd"
                                        name="create-request-third-generationpd"
                                        value="{{old('create-request-third-generationpd')}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback"
                                    id="create-third-generationpd-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Voltage -->
                        <div class="col-12 col-lg-5 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generationvoltage" class="form-label">
                                    Tensão de Conexão
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-third-generationvoltage"
                                        name="create-request-third-generationvoltage"
                                        value="{{old('create-request-third-generationvoltage')}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <span class="input-group-text">kV</span>
                                </div>
                                <div class="invalid-feedback"
                                    id="create-third-generationvoltage-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Operation Initial Date -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-third-generationstart" class="form-label">
                                    Data Início de Operação
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-third-generationstart"
                                    value="EM PROJETO"
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
                                <textarea class="form-control" id="create-request-third-art"
                                    name="create-request-third-art"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-art')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-art-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Diagram -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">2.</span> Diagrama unifilar e de blocos do sistema de geração, carga e proteção
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-third-diagram"
                                    name="create-request-third-diagram"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-diagram')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-diagram-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-memo"
                                    name="create-request-third-memo"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-memo')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-memo-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-electrical"
                                    name="create-request-third-electrical"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-electrical')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-electrical-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-stage"
                                    name="create-request-third-stage"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-stage')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-stage-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Inverter Compliance Certificate -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">6.</span> Certificados de Conformidade dos Inversores ou o número de registro de concessão do INMETRO do(s) inversor(es) para a tensão nominal de
                                conexão com a rede
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-third-compliance"
                                    name="create-request-third-compliance"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-compliance')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-compliance-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- UC Participants -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">7.</span> Lista de unidades consumidoras participantes do sistema de compensação (se houver) indicando na porcentagem de rateio dos créditos e o
                                enquadramento conforme incisos VI a VIII do art. 2º da Resolução Normativa nº 482/2012 (PLANILHA NA GUIA 2)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-third-participants"
                                    name="create-request-third-participants"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-participants')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-participants-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-instrument"
                                    name="create-request-third-instrument"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-instrument')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-instrument-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-aneel"
                                    name="create-request-third-aneel"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-aneel')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-aneel-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-viability"
                                    name="create-request-third-viability"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-viability')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-viability-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-chartair"
                                    name="create-request-third-chartair"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-chartair')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-chartair-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-chartsheltered"
                                    name="create-request-third-chartsheltered"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-chartsheltered')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-chartsheltered-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-rent"
                                    name="create-request-third-rent"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-rent')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-rent-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-procuration"
                                    name="create-request-third-procuration"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-procuration')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-procuration-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-third-condominium"
                                    name="create-request-third-condominium"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-third-condominium')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-third-condominium-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-end mt-5 mb-5">
                <div class="col-12 col-md-3 d-flex justify-content-end">
                    <a href="{{route('engineering_project_show', ['id' => encrypt($generator->project->id)])}}"
                        class="btn bg-danger text-white me-2">
                        Cancelar
                    </a>
                    <button class="btn bg-success text-white float-end d-flex align-items-center" 
                        type="submit"
                        id="btn-create-request-type-third"
                        onclick="return window.submitFormCreateRequestTypeThird(this)">
                        Criar Formulário
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>