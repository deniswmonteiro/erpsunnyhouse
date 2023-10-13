@section('page_title', 'Criar Formulário de Solicitação de Acesso')

<script src="{{asset(mix('js/engineering/documents/access_request_form/createRequestUpToTen.js'))}}" defer></script>
<script>
    var url_get_engineer_data = "{{route('engineering_get_engineer_data_fetch')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>{{_('Criar Formulário de Solicitação de Acesso para Microgeração')}}</h3>
                <p class="text-subtitle text-muted">
                    Dados para geração <span class="fw-bold">até 10 kW</span>.
                </p>
                <p class="mt-5">
                    Preencher, obrigatoriamente, todos os campos com asterísco (<span class="text-danger">*</span>).
                </p>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
        <form action="{{route('engineering_document_store_request', ['type' => encrypt('up_to_ten'), 'id' => encrypt($generator->id)])}}" method="POST"
            id="form-create-request-type-first"
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
                                <label for="create-request-first-clientname" class="form-label">
                                    Nome do Cliente/Razão Social (Titular da UC)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-clientname"
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
                                <label for="create-request-first-clientcpfcnpj" class="form-label">
                                    CPF/CNPJ
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-clientcpfcnpj"
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
                                <label for="create-request-first-clientrg" class="form-label">
                                    RG
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-clientrg"
                                    name="create-request-first-clientrg"
                                    value="{{old('create-request-first-clientrg')}}"
                                    onchange="return window.validateInput(this, 7)"
                                    onkeyup="return window.validateInput(this, 7)"
                                    maxlength="9">
                                <div class="invalid-feedback" id="create-first-clientrg-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Client RG Shipping Date -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-clientrgshipping" class="form-label">
                                    Data de Expedição
                                </label>
                                <input class="form-control" type="date"
                                    id="create-request-first-clientrgshipping"
                                    name="create-request-first-clientrgshipping"
                                    value="{{old('create-request-first-clientrgshipping')}}"
                                    onchange="return window.validateRGShippingDate(this)"
                                    onkeyup="return window.validateRGShippingDate(this)">
                                <div class="invalid-feedback" id="create-first-clientrgshipping-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator Address -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-generatoraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-generatoraddress"
                                    value="{{$generator->generator_address}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generator CEP -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-generatorcep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-generatorcep"
                                    value="{{$generator->generator_cep}}"
                                    disabled>
                            </div>
                        </div>

                         <!-- Generator City -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-generatorcity" class="form-label">
                                    Município
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-generatorcity"
                                    value="{{$generator->generator_city}}"
                                    disabled>
                            </div>
                        </div>

                         <!-- Generator State -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-generatorstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-first-generatorstate"
                                    id="create-request-first-generatorstate"
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
                                    <label for="create-request-first-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-first-clientcellphone"
                                        value="{{$generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-first-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-first-clientphone"
                                        name="create-request-first-clientphone"
                                        value="{{old('create-request-first-clientphone')}}"
                                        onchange="return window.validatePhone(this, 10)"
                                        onkeyup="return window.validatePhone(this, 10)">
                                    <div class="invalid-feedback" id="create-first-clientphone-feedback-request"></div>
                                </div>
                            </div>
                        @else
                            <!-- Client Cellphone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-first-clientcellphone" class="form-label">
                                        Celular
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-first-clientcellphone"
                                        name="create-request-first-clientcellphone"
                                        value="{{old('create-request-first-clientcellphone')}}"
                                        onchange="return window.validatePhone(this, 11)"
                                        onkeyup="return window.validatePhone(this, 11)">
                                    <div class="invalid-feedback"
                                        id="create-first-clientcellphone-feedback-request"></div>
                                </div>
                            </div>

                            <!-- Client Phone -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="create-request-first-clientphone" class="form-label">
                                        Fixo
                                    </label>
                                    <input class="form-control" type="text"
                                        id="create-request-first-clientphone"
                                        value="{{$generator->client->phone}}"
                                        disabled>
                                </div>
                            </div>
                        @endif

                        <!-- Client Email -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-clientmail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="clientmail"
                                    id="create-request-first-clientmail"
                                    value="{{$generator->client->email}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Project Type -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-projecttype" class="form-label">
                                    Tipo de Solicitação
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-projecttype"
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
                                <label for="create-request-first-contractaccount" class="form-label">
                                    Conta Contrato (Se UC existente)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-contractaccount"
                                    value="{{$generator->generator_contract_account}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Branch of Activity -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-activity" class="form-label">
                                    Ramo de Atividade (Descrição)
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-activity"
                                    name="create-request-first-activity"
                                    value="{{old('create-request-first-activity')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="create-first-activity-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Special Loads -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-loads" class="form-label">
                                    Possui Cargas Especiais?
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-first-loads"
                                    id="create-request-first-loads"
                                    name="create-request-first-loads"
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
                                <div class="invalid-feedback" id="create-first-loads-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Special Loads Details -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-loadsdetails" class="form-label">
                                    Detalhar Cargas Especiais
                                </label>
                                <textarea class="form-control" id="create-request-first-loadsdetails"
                                    name="create-request-first-loadsdetails"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    rows="3">{{old('create-request-first-loadsdetails')}}</textarea>
                                <div class="invalid-feedback" id="create-first-loadsdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Subgroup -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-subgroup" class="form-label">
                                    Subgrupo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-subgroup"
                                    name="create-request-first-subgroup"
                                    value="{{old('create-request-first-subgroup')}}"
                                    onchange="return window.validateInput(this, 1)"
                                    onblur="return window.validateInput(this, 1)"
                                    onkeyup="return window.validateInput(this, 1)"
                                    required>
                                <div class="invalid-feedback" id="create-first-subgroup-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Class -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-class" class="form-label">
                                    Classe <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-first-class"
                                    id="create-request-first-class"
                                    name="create-request-first-class"
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
                                    id="create-first-class-feedback-request">
                                </div>
                            </div>
                        </div>

                        <!-- Connection Type -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-conntype" class="form-label">
                                    Tipo de Ligação <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-first-conntype"
                                    id="create-request-first-conntype"
                                    name="create-request-first-conntype"
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
                                    id="create-first-conntype-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Power -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-ucpower" class="form-label">
                                    Tensão de Atendimento da UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-first-ucpower"
                                        name="create-request-first-ucpower"
                                        value="{{old('create-request-first-ucpower')}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">V</span>
                                </div>
                                <div class="invalid-feedback" id="create-first-ucpower-feedback-request"></div>
                            </div>
                        </div>

                        <!-- UC Declared Load -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-ucload" class="form-label">
                                    Carga Declarada da UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-first-ucload"
                                        name="create-request-first-ucload"
                                        value="{{old('create-request-first-ucload')}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback" id="create-first-ucload-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- UC Input Circuit Breaker -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-ucbreaker" class="form-label">
                                    Disjuntor de Entrada da UC <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-first-ucbreaker"
                                        name="create-request-first-ucbreaker"
                                        value="{{old('create-request-first-ucbreaker')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)"
                                        required>
                                    <span class="input-group-text">A</span>
                                </div>
                                <div class="invalid-feedback" id="create-first-ucbreaker-feedback-request"></div>
                            </div>
                        </div>

                        <!-- UC Available Power -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-ucpd" class="form-label">
                                    Potência Disponibilizada para UC
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-first-ucpd"
                                        name="create-request-first-ucpd"
                                        value="{{old('create-request-first-ucpd')}}"
                                        onchange="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback" id="create-first-ucpd-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <!-- Extension Type -->
                         <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-extension" class="form-label">
                                    Tipo de Ramal <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-extension"
                                    name="create-request-first-extension"
                                    value="{{old('create-request-first-extension')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="create-first-extension-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Transformer Identification -->
                        <div class="col-12 col-lg-8 mb-3">
                           <div class="form-group">
                               <label for="create-request-first-transformerid" class="form-label">
                                   Nº de Identificação do Poste ou Transformador mais Próximo
                               </label>
                               <input class="form-control" type="text"
                                   id="create-request-first-transformerid"
                                   name="create-request-first-transformerid"
                                   value="{{old('create-request-first-transformerid')}}"
                                   onchange="return window.validateInput(this, 2)"
                                   onkeyup="return window.validateInput(this, 2)">
                               <div class="invalid-feedback" id="create-first-transformerid-feedback-request"></div>
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- System Delivery Point Coordinates X and Y-->
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label for="create-request-first-coordinatesx" class="form-label">
                                    Preencher as Coordenadas Ponto de Entrega do Acessante em UTM Fuso 21, 22 ou 23
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">X</span>
                                    <input class="form-control" type="text"
                                        id="create-request-first-coordinatesx"
                                        name="create-request-first-coordinatesx"
                                        value="{{old('create-request-first-coordinatesx')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m E</span>
                                </div>
                                <div class="invalid-feedback" id="create-first-coordinatesx-feedback-request"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light btn-sm">Y</span>
                                    <input class="form-control" type="text"
                                        id="create-request-first-coordinatesy"
                                        name="create-request-first-coordinatesy"
                                        value="{{old('create-request-first-coordinatesy')}}"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">m S</span>
                                </div>
                                <div class="invalid-feedback" id="create-first-coordinatesy-feedback-request"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Responsible Name -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-responsiblename" class="form-label">
                                    Nome do Responsável Legal
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-responsiblename"
                                    name="create-request-first-responsiblename"
                                    value="{{old('create-request-first-responsiblename')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback" id="create-first-responsiblename-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Responsible Phone -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-responsiblephone" class="form-label">
                                    Telefone do Responsável Legal
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-responsiblephone"
                                    name="create-request-first-responsiblephone"
                                    value="{{old('create-request-first-responsiblephone')}}"
                                    onchange="return window.validatePhone(this, 11)"
                                    onkeyup="return window.validatePhone(this, 11)">
                                <div class="invalid-feedback" id="create-first-responsiblephone-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Responsible Email -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-responsibleemail" class="form-label">
                                    Email do Responsável Legal
                                </label>
                                <input class="form-control" type="email"
                                    id="create-request-first-responsibleemail"
                                    name="create-request-first-responsibleemail"
                                    value="{{old('create-request-first-responsibleemail')}}"
                                    onchange="return window.validateResponsibleEmail(this)"
                                    onkeyup="return window.validateResponsibleEmail(this)">
                                <div class="invalid-feedback" id="create-first-responsibleemail-feedback-request"></div>
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
                                <label for="create-request-first-managername" class="form-label">
                                    Nome Completo <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-first-managername"
                                    id="create-request-first-managername"
                                    name="create-request-first-managername"
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
                                <div class="invalid-feedback" id="create-first-managername-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Title -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managertitle" class="form-label">
                                    Título Profissional
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-managertitle"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Technical Manager Professional Registration -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managerregistration" class="form-label">
                                    Nº do Registro Profissional
                                </label>
                                <input class="form-control rounded-end me-2" type="text"
                                    id="create-request-first-managerregistration"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Professional Registration State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managerregistrationstate" class="form-label">
                                    UF
                                </label>
                                <select class="form-select" 
                                    aria-label="create-request-first-managerregistrationstate"
                                    id="create-request-first-managerregistrationstate"
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
                                <label for="create-request-first-manageremail" class="form-label">
                                    Email
                                </label>
                                <input class="form-control" type="email"
                                    id="create-request-first-manageremail"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Phone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managerphone" class="form-label">
                                    Telefone Fixo
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-managerphone"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Cellphone -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managercellphone" class="form-label">
                                    Telefone Celular
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-managercellphone"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager CEP -->
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managercep" class="form-label">
                                    CEP
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-managercep"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Address -->
                        <div class="col-12 col-lg-7 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-manageraddress" class="form-label">
                                    Endereço
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-manageraddress"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager Number -->
                        <div class="col-12 col-lg-2 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managernumber" class="form-label">
                                    Número/Apt.
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-managernumber"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technical Manager Neighborhood -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managerneighborhood" class="form-label">
                                    Bairro
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-managerneighborhood"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager City -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managercity" class="form-label">
                                    Cidade
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-managercity"
                                    disabled>
                            </div>
                        </div>

                        <!-- Technical Manager State -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-managerstate" class="form-label">
                                    Estado
                                </label>
                                <select class="form-select"
                                    aria-label="create-request-first-managerstate"
                                    id="create-request-first-managerstate"
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
                                <label for="create-request-first-generationtype" class="form-label">
                                    Tipo de Geração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-generationtype"
                                    name="create-request-first-generationtype"
                                    value="{{old('create-request-first-generationtype')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="create-first-generationtype-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Details -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-generationdetails" class="form-label">
                                    Especificar se necessário
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-generationdetails"
                                    name="create-request-first-generationdetails"
                                    value="{{old('create-request-first-generationdetails')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">
                                <div class="invalid-feedback"
                                    id="create-first-generationdetails-feedback-request"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Microgeneration Framework -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-generationframework" class="form-label">
                                    Enquadramento da Microgeração <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-generationframework"
                                    name="create-request-first-generationframework"
                                    value="{{old('create-request-first-generationframework')}}"
                                    onchange="return window.validateInput(this, 2)"
                                    onblur="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)"
                                    required>
                                <div class="invalid-feedback" id="create-first-generationframework-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Power -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="create-request-first-generationpower" class="form-label">
                                    Potência de Geração
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="text"
                                                id="create-request-first-generationpower"
                                                name="create-request-first-generationpower"
                                                value="{{old('create-request-first-generationpower')}}"
                                                onchange="return window.validateDouble(this)"
                                                onblur="return window.validateDouble(this)"
                                                onkeyup="return window.validateDouble(this)">
                                            <span class="input-group-text">kW</span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-first-generationpower-feedback-request"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-light">
                                                OK
                                            </span>
                                            <input class="form-control" type="text"
                                                id="create-request-first-generationok"
                                                name="create-request-first-generationok"
                                                value="{{old('create-request-first-generationok')}}"
                                                onchange="return window.validateInput(this, 1)"
                                                onkeyup="return window.validateInput(this, 1)">
                                        </div>
                                        <div class="invalid-feedback"
                                            id="create-first-generationok-feedback-request"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Generation Voltage -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-generationvoltage" class="form-label">
                                    Tensão de Conexão
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="create-request-first-generationvoltage"
                                        name="create-request-first-generationvoltage"
                                        value="{{old('create-request-first-generationvoltage')}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)">
                                    <span class="input-group-text">V</span>
                                </div>
                                <div class="invalid-feedback"
                                    id="create-first-generationvoltage-feedback-request"></div>
                            </div>
                        </div>

                        <!-- Generation Operation Initial Date -->
                        <div class="col-12 col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="create-request-first-generationstart" class="form-label">
                                    Data Início de Operação
                                </label>
                                <input class="form-control" type="text"
                                    id="create-request-first-generationstart"
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
                                <textarea class="form-control" id="create-request-first-art"
                                    name="create-request-first-art"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-art')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-art-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-diagram"
                                    name="create-request-first-diagram"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-diagram')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-diagram-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-memo"
                                    name="create-request-first-memo"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-memo')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-memo-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-compliance"
                                    name="create-request-first-compliance"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-compliance')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-compliance-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-participants"
                                    name="create-request-first-participants"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-participants')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-participants-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-instrument"
                                    name="create-request-first-instrument"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-instrument')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-instrument-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-aneel"
                                    name="create-request-first-aneel"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-aneel')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-aneel-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-link"
                                    name="create-request-first-link"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-link')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-link-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-pattern"
                                    name="create-request-first-pattern"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-pattern')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-pattern-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-rent"
                                    name="create-request-first-rent"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-rent')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-rent-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-procuration"
                                    name="create-request-first-procuration"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-procuration')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-procuration-feedback-request"></div>
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
                                <textarea class="form-control" id="create-request-first-condominium"
                                    name="create-request-first-condominium"
                                    rows="3"
                                    onchange="return window.validateInput(this, 2)"
                                    onkeyup="return window.validateInput(this, 2)">{{old('create-request-first-condominium')}}</textarea>
                                <div class="invalid-feedback"
                                    id="create-first-condominium-feedback-request"></div>
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
                        id="btn-create-request-type-first"
                        onclick="return window.submitFormCreateRequestTypeFirst(this)">
                        Criar Formulário
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>