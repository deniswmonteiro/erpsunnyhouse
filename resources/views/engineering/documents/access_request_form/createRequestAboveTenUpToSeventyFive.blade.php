@section('page_title', 'Criar Formulário de Solicitação de Acesso')

<script src="{{asset(mix('js/engineering/documents/access_request_form/createRequestAboveTenUpToSeventyFive.js'))}}" defer></script>
<script>
    var url_get_engineer_data = "{{route('engineering_get_engineer_data_fetch')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>{{_('Criar Formulário de Solicitação de Acesso para Microgeração Distribuída')}}</h3>
                <p class="text-subtitle text-muted">
                    Dados para geração <span class="fw-bold">maior que 10 kW até 75 kW</span>.
                </p>
                <p class="mt-5">
                    Preencher, obrigatoriamente, todos os campos com asterísco (<span class="text-danger">*</span>).
                </p>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
        <form action="{{route('engineering_document_store_request', ['type' => encrypt('above_ten_up_to_seventy_five'), 'id' => encrypt($generator->id)])}}" method="POST"
            id="form-create-request-type-second"
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
                                <label for="create-request-second-clientname" class="form-label">
                                    Nome do Cliente/Razão Social (Titular da UC)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-clientname"
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
                                <label for="create-request-second-clientcpfcnpj" class="form-label">
                                    CPF/CNPJ
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-clientcpfcnpj"
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
                                <label for="create-request-second-clientrg" class="form-label">
                                    RG
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-clientrg"
                                    name="create-request-second-clientrg"
                                    value="{{old('create-request-second-clientrg')}}"
                                    onchange="return window.validateInput(this, 7)"
                                    onkeyup="return window.validateInput(this, 7)"
                                    maxlength="9">
                                <div class="invalid-feedback" id="create-second-clientrg-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Client RG Shipping Date -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-clientrgshipping" class="form-label">
                                    Data de Expedição
                                </label>
                                <input class="form-control" type="date"
                                    id="create-request-second-clientrgshipping"
                                    name="create-request-second-clientrgshipping"
                                    value="{{old('create-request-second-clientrgshipping')}}"
                                    onchange="return window.validateRGShippingDate(this)"
                                    onkeyup="return window.validateRGShippingDate(this)">
                                <div class="invalid-feedback"
                                    id="create-second-clientrgshipping-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator Address -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-generatoraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-generatoraddress"
                                    value="{{$generator->generator_address}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator CEP -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-generatorcep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-generatorcep"
                                    value="{{$generator->generator_cep}}"
                                    disabled>
                            </div>
                        </div>

                         <!-- Generator City -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-generatorcity" class="form-label">
                                    Município
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-generatorcity"
                                    value="{{$generator->generator_city}}"
                                    disabled>
                            </div>
                        </div>

                         <!-- Generator State -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-generatorstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-second-generatorstate"
                                    id="create-request-second-generatorstate"
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
                                    <label for="create-request-second-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-second-clientcellphone"
                                        value="{{$generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-second-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-second-clientphone"
                                        name="create-request-second-clientphone"
                                        value="{{old('create-request-second-clientphone')}}"
                                        onchange="return window.validatePhone(this, 10)"
                                        onkeyup="return window.validatePhone(this, 10)">
                                    <div class="invalid-feedback" id="create-second-clientphone-feedback-request"></div>
                                </div>
                            </div>
                        @else
                            <!-- Client Cellphone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-second-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-second-clientcellphone"
                                        name="create-request-second-clientcellphone"
                                        value="{{old('create-request-second-clientcellphone')}}"
                                        onchange="return window.validatePhone(this, 11)"
                                        onkeyup="return window.validatePhone(this, 11)">
                                    <div class="invalid-feedback"
                                        id="create-second-clientcellphone-feedback-request"></div>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-second-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-second-clientphone"
                                        value="{{$generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>
                        @endif

                        <!-- Client Email -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-clientmail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="clientmail"
                                    id="create-request-second-clientmail"
                                    value="{{$generator->client->email}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Project Type -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-projecttype" class="form-label">
                                    Tipo de Solicitação
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-projecttype"
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
                                <label for="create-request-second-contractaccount" class="form-label">
                                    Conta Contrato (Se UC existente)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-contractaccount"
                                    value="{{$generator->generator_contract_account}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Branch of Activity -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-activity" class="form-label">
                                    Ramo de Atividade (Descrição)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-activity"
                                    name="create-request-second-activity"
                                    value="{{old('create-request-second-activity')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="create-second-activity-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Special Loads -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-loads" class="form-label">
                                    Possui Cargas Especiais?
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-second-loads"
                                    id="create-request-second-loads"
                                    name="create-request-second-loads"
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
                                <div class="invalid-feedback" id="create-second-loads-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Special Loads Details -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-loadsdetails" class="form-label">
                                    Detalhar Cargas Especiais
                                </label>
                                <textarea class="form-control" id="create-request-second-loadsdetails"
                                    name="create-request-second-loadsdetails"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    rows="3">{{old('create-request-second-loadsdetails')}}</textarea>
                                <div class="invalid-feedback" id="create-second-loadsdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Subgroup -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-subgroup" class="form-label">
                                    Subgrupo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-subgroup"
                                    name="create-request-second-subgroup"
                                    value="{{old('create-request-second-subgroup')}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)"
                                    required>
                                <div class="invalid-feedback" id="create-second-subgroup-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Class -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-class" class="form-label">
                                    Classe <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-second-class"
                                    id="create-request-second-class"
                                    name="create-request-second-class"
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
                                <div class="invalid-feedback" 
                                    id="create-second-class-feedback-request">
                                </div>
                            </div>
                        </div>

                        <!-- Connection Type -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-conntype" class="form-label">
                                    Tipo de Ligação <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-second-conntype"
                                    id="create-request-second-conntype"
                                    name="create-request-second-conntype"
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
                                <div class="invalid-feedback" 
                                    id="create-second-conntype-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Power -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-ucpower" class="form-label">
                                    Tensão de Atendimento da UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-second-ucpower"
                                        name="create-request-second-ucpower"
                                        value="{{old('create-request-second-ucpower')}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">V</span>
                                </div>
                                <div class="invalid-feedback" id="create-second-ucpower-feedback-request"></div>
                            </div>
                        </div>

                        <!-- UC Declared Load -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-ucload" class="form-label">
                                    Carga Declarada da UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-second-ucload"
                                        name="create-request-second-ucload"
                                        value="{{old('create-request-second-ucload')}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback" id="create-second-ucload-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Input Circuit Breaker -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-ucbreaker" class="form-label">
                                    Disjuntor de Entrada da UC <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-second-ucbreaker"
                                        name="create-request-second-ucbreaker"
                                        value="{{old('create-request-second-ucbreaker')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)"
                                        required>
                                    <span class="input-group-text">A</span>
                                </div>
                                <div class="invalid-feedback" id="create-second-ucbreaker-feedback-request"></div>
                            </div>
                        </div>

                         <!-- UC Available Power -->
                         <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-ucpd" class="form-label">
                                    Potência Disponibilizada para UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-second-ucpd"
                                        name="create-request-second-ucpd"
                                        value="{{old('create-request-second-ucpd')}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback" id="create-second-ucpd-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <!-- Extension Type -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-extension" class="form-label">
                                    Tipo de Ramal <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-extension"
                                    name="create-request-second-extension"
                                    value="{{old('create-request-second-extension')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="create-second-extension-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Transformer Identification -->
                        <div class="col-12 col-lg-8 mb-3">
                           <div class="form-group">
                               <label for="create-request-second-transformerid" class="form-label">
                                   Nº de Identificação do Poste ou Transformador mais Próximo
                               </label>
                               <input class="form-control" type="text"
                                   id="create-request-second-transformerid"
                                   name="create-request-second-transformerid"
                                   value="{{old('create-request-second-transformerid')}}"
                                   onchange="return window.validateInput(this, 2)"
                                   onkeyup="return window.validateInput(this, 2)">
                               <div class="invalid-feedback" id="create-second-transformerid-feedback-request"></div>
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- System Delivery Point Coordinates X and Y-->
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label for="create-request-second-coordinatesx" class="form-label">
                                    Preencher as Coordenadas Ponto de Entrega do Acessante em UTM Fuso 21, 22 ou 23
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">X</span>
                                    <input class="form-control" type="text"
                                        id="create-request-second-coordinatesx"
                                        name="create-request-second-coordinatesx"
                                        value="{{old('create-request-second-coordinatesx')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m E</span>
                                </div>
                                <div class="invalid-feedback" id="create-second-coordinatesx-feedback-request"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">Y</span>
                                    <input class="form-control" type="text"
                                        id="create-request-second-coordinatesy"
                                        name="create-request-second-coordinatesy"
                                        value="{{old('create-request-second-coordinatesy')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m S</span>
                                </div>
                                <div class="invalid-feedback" id="create-second-coordinatesy-feedback-request"></div>
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
                                <label for="create-request-second-managername" class="form-label">
                                    Nome Completo <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-second-managername"
                                    id="create-request-second-managername"
                                    name="create-request-second-managername"
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
                                <div class="invalid-feedback" id="create-second-managername-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Title -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managertitle" class="form-label">
                                    Título Profissional
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-managertitle"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Technical Manager Professional Registration -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managerregistration" class="form-label">
                                    Nº do Registro Profissional
                                </label>
                                <input class="form-control rounded-end me-2" type="text"
                                    id="create-request-second-managerregistration"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Registration State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managerregistrationstate" class="form-label">
                                    UF
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-second-managerregistrationstate"
                                    id="create-request-second-managerregistrationstate"
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
                                <label for="create-request-second-manageremail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="email"
                                    id="create-request-second-manageremail"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Phone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managerphone" class="form-label">
                                    Telefone Fixo
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-managerphone"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Cellphone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managercellphone" class="form-label">
                                    Telefone Celular
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-managercellphone"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager CEP -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managercep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-managercep"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Address -->
                        <div class="col-12 col-lg-7 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-manageraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-manageraddress"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Number -->
                        <div class="col-12 col-lg-2 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managernumber" class="form-label">
                                    Número/Apt.
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-managernumber"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Neighborhood -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managerneighborhood" class="form-label">
                                    Bairro
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-managerneighborhood"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager City -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managercity" class="form-label">
                                    Cidade
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-managercity"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-managerstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-second-managerstate"
                                    id="create-request-second-managerstate"
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
                                <label for="create-request-second-generationtype" class="form-label">
                                    Tipo de Geração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-generationtype"
                                    name="create-request-second-generationtype"
                                    value="{{old('create-request-second-generationtype')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="create-second-generationtype-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Details -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-generationdetails" class="form-label">
                                    Especificar se necessário
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-generationdetails"
                                    name="create-request-second-generationdetails"
                                    value="{{old('create-request-second-generationdetails')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback"
                                    id="create-second-generationdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Microgeneration Framework -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-generationframework" class="form-label">
                                    Enquadramento da Microgeração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-generationframework"
                                    name="create-request-second-generationframework"
                                    value="{{old('create-request-second-generationframework')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback"
                                    id="create-second-generationframework-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Power -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="create-request-second-generationpower" class="form-label">
                                    Potência de Geração
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="create-request-second-generationpower"
                                                name="create-request-second-generationpower"
                                                value="{{old('create-request-second-generationpower')}}"
                                                onchange="return window.validateDouble(this)"
                                                onblur="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-second-generationpower-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light">
                                                OK
                                            </span>
                                            <input class="form-control" type="text"
                                                id="create-request-second-generationok"
                                                name="create-request-second-generationok"
                                                value="{{old('create-request-second-generationok')}}"
                                                onchange="return window.validateInput(this, 1)"
                                                onkeyup="return window.validateInput(this, 1)">
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-second-generationok-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generation Voltage -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-generationvoltage" class="form-label">
                                    Tensão de Conexão
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-second-generationvoltage"
                                        name="create-request-second-generationvoltage"
                                        value="{{old('create-request-second-generationvoltage')}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <span class="input-group-text">V</span>
                                </div>
                                <div class="invalid-feedback"
                                    id="create-second-generationvoltage-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Operation Initial Date -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-second-generationstart" class="form-label">
                                    Data Início de Operação
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-second-generationstart"
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
                                <textarea class="form-control" id="create-request-second-art"
                                    name="create-request-second-art"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-art')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-art-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-second-diagram"
                                    name="create-request-second-diagram"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-diagram')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-diagram-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-second-memo"
                                    name="create-request-second-memo"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-memo')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-memo-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-second-electrical"
                                    name="create-request-second-electrical"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-electrical')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-electrical-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Inverter Compliance Certificate -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">5.</span> Certificados de Conformidade dos Inversores ou o número de registro de concessão do INMETRO do(s) inversor(es) para a tensão nominal de
                                conexão com a rede
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-compliance"
                                    name="create-request-second-compliance"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-compliance')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-compliance-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- UC Participants -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">6.</span> Lista de unidades consumidoras participantes do sistema de compensação (se houver) indicando na porcentagem de rateio dos créditos e o
                                enquadramento conforme incisos VI a VIII do art. 2º da Resolução Normativa nº 482/2012 (PLANILHA NA GUIA 2)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-participants"
                                    name="create-request-second-participants"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-participants')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-participants-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Legal Instrument -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">7.</span> Cópia de instrumento jurídico que comprove o compromisso de solidariedade entre os Integrantes (se houver)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-instrument"
                                    name="create-request-second-instrument"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-instrument')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-instrument-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Recognition for ANEEL -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">8.</span> Documento que comprove o reconhecimento pela ANEEL, da cogeração qualificada (se houver)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-aneel"
                                    name="create-request-second-aneel"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-aneel')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-aneel-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- New Link -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">9.</span> Formulário de Ligação Nova (quando necessário, conforme observação) (Conforme ANEXO IV - FORMULÁRIO DE LIGAÇÃO NOVA)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-link"
                                    name="create-request-second-link"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-link')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-link-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Pattern Change -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">10.</span> Formulário de Troca de Padrão (de monofásico para bifásico ou trifásico, de bifásico para trifásico, de trifásico para bifásico ou monofásico, de bifásico para monofásico) (Conforme ANEXO V - FORMULÁRIO DE TROCA DE PADRÃO)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-pattern"
                                    name="create-request-second-pattern"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-pattern')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-pattern-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Rent Contract -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">11.</span> Contrato de Aluguel ou Arrendamento da unidade consumidora (quando necessário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-rent"
                                    name="create-request-second-rent"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-rent')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-rent-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Procuration -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">12.</span> Procuração (quando necesário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-procuration"
                                    name="create-request-second-procuration"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-procuration')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-procuration-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Use of Common Area in Condominium -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <p>
                                <span class="fw-bold">13.</span> Autorização de uso de área comum em condomínio (quando necessário, conforme observação)
                            </p>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <textarea class="form-control" id="create-request-second-condominium"
                                    name="create-request-second-condominium"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-second-condominium')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-second-condominium-feedback-request"></div>
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
                        id="btn-create-request-type-second"
                        onclick="return window.submitFormCreateRequestTypeSecond(this)">
                        Criar Formulário
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>