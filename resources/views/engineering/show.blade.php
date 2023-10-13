@section('page_title', 'Dados do Projeto')

<script src="{{asset(mix('js/engineering/show.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/createDocumentAddNewFile.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/editDocumentAddNewFile.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/createGeneratorAddImage.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/editGeneratorAddImage.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/addApportionmentListBeneficiary.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/documents/access_request_form/addTableItem/addRequestSolarItem.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/documents/access_request_form/addTableItem/addRequestInverterItem.js'))}}" defer></script>
<script src="{{asset(mix('js/engineering/documents/access_request_form/addTableItem/addRequestTransformerItem.js'))}}" defer></script>
<script>
    var url_generator_store_image = "{{route('engineering_generator_images_store_fetch')}}";
    var url_generator_show_image = "{{route('engineering_generator_images_show_fetch')}}";
    var url_generator_destroy_image = "{{route('engineering_generator_destroy_image_fetch')}}";
    var url_ajax_get_client_credentials = "{{route('engineering_get_client_credentials_ajax')}}";
    var url_fetch_get_active_apportionment_list = "{{route('engineering_project_get_active_apportionment_list_fetch')}}";

    var beneficiaryConsumptionClassIndex1 = "{{encrypt('RESIDENCIAL')}}";
    var beneficiaryConsumptionClassIndex2 = "{{encrypt('INDUSTRIAL')}}";
    var beneficiaryConsumptionClassIndex3 = "{{encrypt('COMERCIO_SERVICOS_OUTROS')}}";
    var beneficiaryConsumptionClassIndex4 = "{{encrypt('RURAL')}}";
    var beneficiaryConsumptionClassIndex5 = "{{encrypt('PODER_PUBLICO')}}";
    var beneficiaryConsumptionClassIndex6 = "{{encrypt('ILUMINACAO_PUBLICA')}}";
    var beneficiaryConsumptionClassIndex7 = "{{encrypt('SERVICO_PUBLICO')}}";
    var beneficiaryConsumptionClassIndex8 = "{{encrypt('CONSUMO_PROPRIO')}}";
    
    var generatorImageTypeIndex1 = "{{encrypt('VISTORIA_PREVIA')}}";
    var generatorImageTypeIndex2 = "{{encrypt('INSTALACAO')}}";
    var generatorImageTypeIndex3 = "{{encrypt('VISTORIA_FINAL')}}";
    var generatorImageTypeIndex4 = "{{encrypt('OUTRAS')}}";
    
    var assetProjectImage = "{{asset('/images/engineering/')}}";

    var clients = @json($clients);
    
    var billContractAccounts = @json($bill_contract_accounts);
    var equipments = @json($equipments);
    
    var observations = @json($observations);

    var imagesPreview = @json($images_preview);
    var imagesInstallation = @json($images_installation);
    var imagesFinal = @json($images_final);
    var imagesOther = @json($images_other);
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{_('Dados do Projeto de Engenharia')}}</h3>
                <p class="text-subtitle text-muted">{{_('Visualizar os dados do projeto.')}}</p>
            </div>
        </div>
    </x-slot>

    <section>
        <!-- Project Informations -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Opções de Gerenciamento</h4>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row text-center">
                        <!-- Edit -->
                        <div class="col-6 col-md-3 mb-4">
                            <div>
                                <p class="mb-1">Editar</p>
                                <a class="btn bg-success text-white lh-1 pt-2 pb-2"
                                    href="{{route('engineering_project_edit', ['id' => encrypt($project->id)])}}">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Delete -->
                        <div class="col-6 col-md-3">
                            <div>
                                <p class="mb-1">Excluir</p>
                                <a class="btn bg-danger text-white lh-1 pt-2 pb-2"
                                    data-bs-toggle="modal"
                                    data-bs-dismiss="modal"
                                    data-bs-target="#modal-delete-project">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contract Informations -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informações do Contrato</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Contract Date -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <span class="fw-bold">Data de Criação:</span>
                            <p  class="mb-0">{{$project->contract->created_at->format('d/m/Y')}}</p>
                        </div>
                    </div>

                    <!-- Installation Deadline -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <span class="fw-bold">Data de Conclusão:</span>
                            <p  class="mb-0">
                                {{date('d/m/Y', strtotime($project->contract->installation_deadline))}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Client -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <span class="fw-bold d-block">Cliente:</span>
                            <div class="d-flex">
                                <span class="rounded bg-brown fw-bold fs-6 me-2 pt-1 ps-2 pe-2">
                                    {{
                                        $project->contract->client->is_corporate ? 
                                            $project->contract->client->corporate_name :
                                            $project->contract->client->name
                                    }}
                                </span>
                                <button type="button" class="btn btn-primary input-group-text text-white rounded-end border border-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-show-project-client">
                                    <i class="bi bi-person-badge"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Client Phone -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <span class="fw-bold">Telefone:</span>
                            <p class="mb-0">
                                @if ($project->contract->client->phone != null) 
                                    {{$project->contract->client->phone}}

                                    <a href="https://wa.me/55{{preg_replace('/[^0-9]/', '', $project->contract->client->phone)}}/?text=Olá!%20Tudo%20bem?%20Aqui%20é%20{{Auth::user()->name}}%20do%20time%20de%20engenharia%20da%20Sunny%20House%20Energia%20Solar"
                                        target="_blank" class="p-2">
                                        <i class="bi bi-whatsapp text-success" style="font-size: 18px" role="img" aria-label="WhatsApp"></i>
                                    </a>
                                @else &mdash;
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
                <div class="row">
                    <!-- Structure Type -->
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <span class="fw-bold">Tipo de Estrutura:</span>
                            @switch ($project->contract->generator_structure)
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
                        <p>{{$project->contract->area}}</p>
                    </div>

                    <!-- Monthly Average Generation -->
                    <div class="col-12 col-md-12 col-lg-4">
                        <span class="fw-bold">Geração Média Mensal (kWh):</span>
                        <p>{{$project->contract->monthly_avg_generation}}</p>
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
                <ul class="nav nav-pills nav-justified mb-3" id="generator-pills-tab" role="tablist">
                    @foreach ($generators as $gen_key => $generator)
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link shadow-none @if ($gen_key + 1 == 1) active @endif"
                                id="pills-{{$gen_key + 1}}-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#pills-{{$gen_key + 1}}"
                                role="tab" aria-controls="pills-{{$gen_key + 1}}"
                                aria-selected="true">
                                Geradora {{$gen_key + 1}} &ndash; CC: {{$generator->generator_contract_account}}
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="protocol-">
                    @foreach ($generators as $gen_key => $generator)
                        <div class="tab-pane fade show @if ($gen_key + 1 == 1) active @endif"
                            id="pills-{{$gen_key + 1}}"
                            role="tabpanel"
                            aria-labelledby="pills-{{$gen_key + 1}}-tab">
                            <div class="card">
                                <div class="card-body border border-gray rounded ps-0 pe-0 pt-4 pb-0">
                                    <div class="row ps-4 pe-4 mb-2">
                                        <!-- Client Documents -->
                                        <div class="col-12 col-md-3 mb-4">
                                            <div class="text-center">
                                                <p class="mb-1">Documentos do Cliente</p>
                                                <a class="btn bg-primary text-white lh-1 pt-2 pb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-dismiss="modal"
                                                    data-bs-target="#modal-generator-client-documents-{{$gen_key + 1}}">
                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Project Documents -->
                                        <div class="col-12 col-md-3 mb-4">
                                            <div class="text-center">
                                                <p class="mb-1">Documentos do Projeto</p>
                                                <a class="btn bg-primary text-white lh-1 pt-2 pb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-dismiss="modal"
                                                    @if ($generator->document_request != null || $generator->document_art != null || $generator->document_aneel != null || $generator->document_certificates != null || $generator->document_memorial != null || $generator->document_electrical != null)
                                                        data-bs-target="#modal-edit-generator-documents-{{$gen_key + 1}}"
                                                    @else
                                                        data-bs-target="#modal-create-generator-documents-{{$gen_key + 1}}"
                                                    @endif
                                                    >
                                                    <i class="bi bi-file-earmark-post-fill"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Generator Images -->
                                        <div class="col-12 col-md-3 mb-4">
                                            <div class="text-center">
                                                <p class="mb-1">Imagens do Projeto</p>
                                                <a class="btn bg-primary text-white lh-1 pt-2 pb-2"
                                                    id="btn-modal-generator-images-{{$gen_key + 1}}"
                                                    onclick="return window.initSlides(this)"
                                                    data-bs-toggle="modal"
                                                    data-bs-dismiss="modal"
                                                    data-bs-target="#modal-generator-image-{{$gen_key + 1}}">
                                                    <i class="bi bi-file-earmark-image"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Beneficiary -->
                                        @if (count($generator->beneficiary) > 0)
                                            <div class="col-12 col-md-3 mb-3">
                                                <div class="text-center">
                                                    <p class="mb-1">Beneficiárias</p>
                                                    <a class="btn bg-warning text-white lh-1 pt-2 pb-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-dismiss="modal"
                                                        data-bs-target="#modal-beneficiary-view-{{$gen_key + 1}}">
                                                        <i class="bi bi-diagram-3-fill"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <hr>

                                    <div class="row ps-4 pe-4 mt-4">
                                        <!-- Generator Client -->
                                        <div class="col-12 col-lg-7 mb-3">
                                            <div class="form-group">
                                                <span class="fw-bold d-block">Cliente:</span>
                                                <div class="d-flex">
                                                    <span class="rounded bg-brown fw-bold fs-6 me-2 pt-1 ps-2 pe-2">
                                                        @if ($generator->client != null)
                                                            {{
                                                                $generator->client->is_corporate ? 
                                                                    $generator->client->corporate_name :
                                                                    $generator->client->name
                                                            }}
                                                        @endif
                                                    </span>

                                                    <button type="button" class="btn btn-primary input-group-text text-white rounded-end border border-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-show-generator-client-{{$gen_key + 1}}">
                                                        <i class="bi bi-person-badge"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Generator Client Phone -->
                                        <div class="col-12 col-lg-5 mb-3">
                                            <div class="form-group">
                                                <span class="fw-bold">Telefone:</span>
                                                <p class="mb-0">
                                                    @if ($generator->client != null)
                                                        @if ($generator->client->phone != null) 
                                                            {{$generator->client->phone}}

                                                            <a href="https://wa.me/55{{preg_replace('/[^0-9]/', '', $generator->client->phone)}}/?text=Olá!%20Tudo%20bem?%20Aqui%20é%20{{Auth::user()->name}}%20do%20time%20de%20engenharia%20da%20Sunny%20House%20Energia%20Solar" target="_blank" class="p-2">
                                                                <i class="bi bi-whatsapp text-success" style="font-size: 18px" role="img" aria-label="WhatsApp"></i>
                                                            </a>
                                                        @else &mdash;
                                                        @endif
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mt-0">

                                    <div class="row ps-4 pe-4">
                                        <!-- Protocol -->
                                        <div class="col-12 col-md-7 mt-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Protocolo</span>
                                                <div class="d-flex align-items-start mt-4"
                                                    id="protocol-tab-{{$gen_key + 1}}">
                                                    <div class="nav flex-column nav-pills col-5" 
                                                        id="protocol-pills-tab-{{$gen_key + 1}}" 
                                                        role="tablist" 
                                                        aria-orientation="vertical">
                                                        <!-- Submission -->
                                                        <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'ATIVO' || $generator->generator_status == 'SUBMETIDO') active @endif" 
                                                            id="tab-protocol-submission-1-{{$gen_key + 1}}" 
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#protocol-submission-1-{{$gen_key + 1}}" role="tab"
                                                            aria-controls="protocol-submission-1-{{$gen_key + 1}}" 
                                                            aria-selected="true">
                                                            1 - Submissão de Projeto
                                                        </button>

                                                        <!-- Feedback -->
                                                        <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'PROTOCOLADO') active @endif"
                                                            id="tab-protocol-feedback-1-{{$gen_key + 1}}" 
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#protocol-feedback-1-{{$gen_key + 1}}"
                                                            role="tab" 
                                                            aria-controls="protocol-feedback-1-{{$gen_key + 1}}"
                                                            aria-selected="true">
                                                            2 - Solicitação de Parecer
                                                        </button>

                                                        <!-- Issued -->
                                                        <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'PARECER_EMITIDO') active @endif"
                                                            id="tab-protocol-issued-1-{{$gen_key + 1}}"
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#protocol-issued-1-{{$gen_key + 1}}"
                                                            role="tab"
                                                            aria-controls="protocol-issued-1-{{$gen_key + 1}}" 
                                                            aria-selected="true">
                                                            3 - Parecer Emitido
                                                        </button>

                                                        <!-- Provisional -->
                                                        <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'VISTORIA_PROVISORIA') active @endif"
                                                            id="tab-protocol-provisional-1-{{$gen_key + 1}}"
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#protocol-provisional-1-{{$gen_key + 1}}"
                                                            role="tab"
                                                            aria-controls="protocol-provisional-1-{{$gen_key + 1}}"
                                                            aria-selected="true">
                                                            4 - Vistoria Provisória
                                                        </button>

                                                        <!-- Survey -->
                                                        <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'VISTORIA' || $generator->generator_status == 'CONCLUÍDO') active @endif"
                                                            id="tab-protocol-survey-1-{{$gen_key + 1}}" 
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#protocol-survey-1-{{$gen_key + 1}}"
                                                            role="tab" 
                                                            aria-controls="protocol-survey-1-{{$gen_key + 1}}"
                                                            aria-selected="true">
                                                            5 - Vistoria
                                                        </button>
                                                        
                                                        <!-- Homologated -->
                                                        <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'HOMOLOGADO') active @endif"
                                                            id="tab-protocol-survey-1-{{$gen_key + 1}}" 
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#protocol-homologated-1-{{$gen_key + 1}}"
                                                            role="tab" 
                                                            aria-controls="protocol-homologated-1-{{$gen_key + 1}}"
                                                            aria-selected="true">
                                                            6 - Homologado
                                                        </button>
                                                    </div>
                                                    <div class="tab-content col-7 ps-5"
                                                        id="protocol-pills-content-{{$gen_key + 1}}">
                                                        <!-- Submission -->
                                                        <div class="tab-pane fade show @if ($generator->generator_status == 'ATIVO' || $generator->generator_status == 'SUBMETIDO') active @endif" 
                                                            id="protocol-submission-1-{{$gen_key + 1}}" role="tabpanel" aria-labelledby="tab-protocol-submission-1-{{$gen_key + 1}}">
                                                            @include('engineering.showProtocol', [
                                                                'key' => 0,
                                                                'type' => 'submission'
                                                            ])
                                                        </div>
                    
                                                        <!-- Feedback -->
                                                        <div class="tab-pane fade show @if ($generator->generator_status == 'PROTOCOLADO') active @endif" 
                                                            id="protocol-feedback-1-{{$gen_key + 1}}" role="tabpanel"
                                                            aria-labelledby="tab-protocol-feedback-1-{{$gen_key + 1}}">
                                                            @include('engineering.showProtocol', [
                                                                'key' => 0,
                                                                'type' => 'feedback'
                                                            ])
                                                        </div>
                    
                                                        <!-- Issued -->
                                                        <div class="tab-pane fade show @if ($generator->generator_status == 'PARECER_EMITIDO') active @endif" 
                                                            id="protocol-issued-1-{{$gen_key + 1}}" role="tabpanel"
                                                            aria-labelledby="tab-protocol-issued-1-{{$gen_key + 1}}">
                                                            @include('engineering.showProtocol', [
                                                                'key' => 0,
                                                                'type' => 'issued'
                                                            ])
                                                        </div>
                    
                                                        <!-- Provisional -->
                                                        <div class="tab-pane fade show @if ($generator->generator_status == 'VISTORIA_PROVISORIA') active @endif"
                                                            id="protocol-provisional-1-{{$gen_key + 1}}" role="tabpanel" aria-labelledby="tab-protocol-provisional-1-{{$gen_key + 1}}">
                                                            @include('engineering.showProtocol', [
                                                                'key' => 0,
                                                                'type' => 'provisional'
                                                            ])
                                                        </div>
                    
                                                        <!-- Survey -->
                                                        <div class="tab-pane fade show @if ($generator->generator_status == 'VISTORIA' || $generator->generator_status == 'CONCLUÍDO') active @endif" 
                                                            id="protocol-survey-1-{{$gen_key + 1}}" role="tabpanel"
                                                            aria-labelledby="tab-protocol-survey-1-{{$gen_key + 1}}">
                                                            @include('engineering.showProtocol', [
                                                                'key' => 0,
                                                                'type' => 'survey'
                                                            ])
                                                        </div>

                                                        <!-- Homologated -->
                                                        <div class="tab-pane fade show @if ($generator->generator_status == 'HOMOLOGADO') active @endif" 
                                                            id="protocol-homologated-1-{{$gen_key + 1}}" role="tabpanel"
                                                            aria-labelledby="tab-protocol-homologated-1-{{$gen_key + 1}}">
                                                            @include('engineering.showProtocol', [
                                                                'key' => 0,
                                                                'type' => 'homologated'
                                                            ])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-12 col-md-4 offset-md-1 mt-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Status</span>
                                                <div class="d-flex mt-4">
                                                    @switch ($generator->generator_status)
                                                        @case ("ATIVO")
                                                            <span class="rounded bg-yellow text-white fw-bold fs-6 pt-2 pb-2 ps-2 pe-2">
                                                                {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                            </span>
                                                            @break
                        
                                                        @case ("SUBMETIDO")
                                                            <span class="rounded bg-secondary text-white fw-bold fs-6 pt-2 pb-2 ps-2 pe-2">
                                                                {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                            </span>
                                                            @break
                                                        
                                                        @case ("PROTOCOLADO")
                                                            <span class="rounded bg-info text-white fw-bold fs-6 pt-2 pb-2 ps-2 pe-2">
                                                                {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                            </span>
                                                            @break
                        
                                                        @case ("PARECER_EMITIDO")
                                                            <span class="rounded bg-indigo text-white fw-bold fs-6 pt-2 pb-2 ps-2 pe-2">
                                                                {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                            </span>
                                                        @break
                        
                                                        @case ("VISTORIA_PROVISORIA")
                                                            <span class="rounded bg-warning text-white fw-bold fs-6 pt-2 pb-2 ps-2 pe-2">
                                                                {{Str::replaceFirst('_', ' ', 'VISTORIA_PROVISÓRIA')}}
                                                            </span>
                                                        @break
                        
                                                        @case ("VISTORIA")
                                                            <span class="rounded bg-primary text-white fw-bold fs-6 pt-2 pb-2 ps-2 pe-2">
                                                                {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                            </span>
                                                        @break

                                                        @case ("HOMOLOGADO")
                                                            <span class="rounded bg-teal text-white fw-bold fs-6 pt-2 pb-2 ps-2 pe-2">
                                                                {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                            </span>
                                                        @break

                                                        @case ("CONCLUÍDO")
                                                            <span class="rounded bg-success text-white fw-bold fs-6 pt-2 pb-2 ps-2 pe-2">
                                                                {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                            </span>
                                                        @break
                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row ps-4 pe-4 mt-4">
                                        <!-- Project Type -->
                                        <div class="col-12 col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Tipo de Projeto:</span>
                                                <p id="generator-project-type-{{$gen_key + 1}}">
                                                    @switch ($generator->generator_project_type)
                                                        @case ('INDIVIDUAL')
                                                            Individual
                                                            @break
                                                        @case ('AUTOCONSUMO_REMOTO')
                                                            Autoconsumo Remoto
                                                            @break
                                                        @case ('GERACAO_COMPARTILHADA')
                                                            Geração Compartilhada
                                                            @break
                                                        @case ('RESERVADO')
                                                            Reservado
                                                            @break
                                                    @endswitch
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ps-4 pe-4">
                                        <!-- CEP -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <span class="fw-bold">CEP:</span>
                                                <p>{{$generator->generator_cep}}</p>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row ps-4 pe-4">
                                        <!-- Address -->
                                        <div class="col-12 col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Endereço:</span>
                                                <p>{{$generator->generator_address}}</p>
                                            </div>
                                        </div>
        
                                        <!-- Number -->
                                        <div class="col-12 col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Número/Apt.:</span>
                                                <p>{{$generator->generator_number}}</p>
                                            </div>
                                        </div>
                                    
                                        <!-- Complement -->
                                        <div class="col-12 col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Complemento:</span>
                                                <p>
                                                    @if ($generator->generator_complement != null)
                                                        {{$generator->generator_complement}}
                                                    @else &mdash;
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row ps-4 pe-4">
                                        <!-- Neighborhood -->
                                        <div class="col-12 col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Bairro:</span>
                                                <p>{{$generator->generator_neighborhood}}</p>
                                            </div>
                                        </div>
        
                                        <!-- City -->
                                        <div class="col-12 col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Cidade:</span>
                                                <p>{{$generator->generator_city}}</p>
                                            </div>
                                        </div>
        
                                        <!-- State -->
                                        <div class="col-12 col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Estado:</span>
                                                <p>{{$generator->generator_state}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ps-4 pe-4">
                                        <!-- Generator Power -->
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Potência da Geradora (kWp):</span>
                                                <p>
                                                    {{Str::replaceFirst('.', ',', $generator->generator_power / 1000)}}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Contracted kWp Production -->
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Produção do kWp Contratado (kWh):</span>
                                                <p>
                                                    {{
                                                        number_format((($project->contract->monthly_avg_generation * 1000 / $project->contract->getGeneratorPowerValue()) * $generator->generator_power) / 1000, '2', ',', '.')
                                                    }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Estimated kWp Production -->
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Produção do kWp Estimado (kWh):</span>
                                                <p>
                                                    {{number_format(($generator->generator_power * 116) / 1000, 2, ',', '.')}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row ps-4 pe-4">
                                        <!-- Contract Account -->
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Conta Contrato Geradora:</span>
                                                <p>{{$generator->generator_contract_account}}</p>
                                            </div>
                                        </div>

                                        <!-- Generator Consumption -->
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <span class="fw-bold">Consumo da Geradora (kWh):</span>
                                                <p>
                                                    @if ($generator->generator_consumption != null)
                                                        {{
                                                            number_format($generator->generator_consumption, 2, ',', '.')
                                                        }}
                                                    @else &mdash;
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Generator Equipments -->
                                    <div class="row ps-4 pe-4 mt-4">
                                        <div class="card">
                                            <div class="card-header border border-gray rounded bg-light bg-gradient p-3 ps-4">
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
                                                                    <th scope="col">Produto</th>
                                                                    <th scope="col">Quantidade</th>
                                                                    <th scope="col" class="text-center">
                                                                        Datasheet
                                                                    </th>
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
                                                                        <td class="pt-4">
                                                                            {{$equipment->name}}
                                                                        </td>
                                                                        <td class="pt-4" 
                                                                            id="equipment-quantity-{{$category}}-{{$gen_key + 1}}-{{$key_equipment + 1}}
                                                                            " data-equipment-{{$category}}="{{$equipment->name}}">
                                                                            {{$equipment->quantity}}
                                                                        </td>
                                                                        <td class="text-center d-flex justify-content-center pt-4">
                                                                            <a href="{{route('datasheet_view', ['type' => encrypt($equipment->type), 'id' => encrypt($equipment->equipment_id)])}}" 
                                                                                target="_blank"
                                                                                class="btn bg-primary text-white mt-1
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
                                    </div>
                                </div>   
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Observations -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Observações:</h4>
            </div>
            <div class="card-body">
                <p id="project-observation"></p>
            </div>

            <div id="btn-floating">
                <a href="{{route('engineering_project_index')}}"
                    class="btn btn-danger d-inline-flex align-items-center justify-content-center me-2">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Modal Delete Project -->
    <div class="modal fade text-black" id="modal-delete-project"
        tabindex="-1" role="dialog" aria-hidden="true"
        aria-labelledby="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Projeto</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <span class="d-block">
                        Você deseja excluir o projeto do(a) cliente
                        <span class="fw-bold">
                        {{
                            $project->contract->client->is_corporate ? 
                                $project->contract->client->corporate_name :
                                $project->contract->client->name
                        }}</span>
                        da nossa base de dados?
                    </span>
                    <span class="text-danger">
                        A ação não pode ser desfeita!
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" 
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <form action="{{route('engineering_project_destroy', ['id' => encrypt($project->id)])}}"
                        method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Confirmar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Show Project Client -->
    <div class="modal fade text-black"
        id="modal-show-project-client"
        tabindex="-1" role="dialog" aria-hidden="true"
        aria-labelledby="modal-show-project-client">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informações do Cliente</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Profile Informations -->
                    <div class="card border">
                        <div class="card-header bg-blue-lighten p-3">
                            <h4 class="card-title mb-0">Informações de Perfil</h4>
                        </div>
                        <div class="card-body pt-4 pb-1">
                            @if ($project->contract->client->is_corporate)
                                <div class="row">
                                    <!-- Corporate Name -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">Razão Social:</span>
                                        <p>{{$project->contract->client->corporate_name}}</p>
                                    </div>

                                    <!-- CNPJ -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">CNPJ:</span>
                                        <p>{{$project->contract->client->cnpj}}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <!-- Name -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <span class="fw-bold">Nome:</span>
                                    <p>{{$project->contract->client->name}}</p>
                                </div>

                                <!-- Birth Date -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <span class="fw-bold">Data de Nascimento:</span>
                                    <p>{{date('d/m/Y', strToTime($project->contract->client->birth_date))}}</p>
                                </div>

                                <!-- CPF -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <span class="fw-bold">CPF:</span>
                                    <p>{{$project->contract->client->cpf}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Email -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <span class="fw-bold">Email:</span>
                                    <p>{{$project->contract->client->email}}</p>
                                </div>

                                <!-- Phone -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <span class="fw-bold">Telefone:</span>
                                    <p>{{$project->contract->client->phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Informations -->
                    <div class="card border">
                        <div class="card-header bg-blue-lighten p-3">
                            <h4 class="card-title mb-0">Informações de Endereço</h4>
                        </div>
                        <div class="card-body pt-4 pb-1">
                            <div class="row">
                                <!-- CEP -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <span class="fw-bold">CEP:</span>
                                    <p>{{$project->contract->client->address_cep}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Address -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <span class="fw-bold">Endereço:</span>
                                    <p>{{$project->contract->client->address}}</p>
                                </div>

                                <!-- Number -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <span class="fw-bold">Número:</span>
                                    <p>{{$project->contract->client->address_number}}</p>
                                </div>

                                <!-- Complement -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <span class="fw-bold">Complemento:</span>
                                    <p>{{$project->contract->client->address_complement}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Neighborhood -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <span class="fw-bold">Bairro:</span>
                                    <p>{{$project->contract->client->address_neighborhood}}</p>
                                </div>

                                <!-- City -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <span class="fw-bold">Cidade:</span>
                                    <p>{{$project->contract->client->address_city}}</p>
                                </div>

                                <!-- State -->
                                <div class="col-12 col-lg-3 mb-3">
                                    <span class="fw-bold">Estado:</span>
                                    <p>{{$project->contract->client->address_state}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Equatorial Credentials -->
                    <div class="card border">
                        <div class="card-header bg-blue-lighten p-3">
                            <h4 class="card-title mb-0">Credenciais Equatorial</h4>
                        </div>
                        <div class="card-body pt-4 pb-1">
                            <div class="row">
                                <!-- Login -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <span class="fw-bold">Login:</span>
                                    <p>
                                        @if ($project->contract->client->login != null)
                                            {{$project->contract->client->login}}
                                        @else &mdash;
                                        @endif
                                    </p>
                                </div>

                                <!-- Password -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <span class="fw-bold">Senha:</span>
                                    <p>
                                        @if ($project->contract->client->password != null)
                                            {{$project->contract->client->password}}
                                        @else &mdash;
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($generators as $gen_key => $generator)
        <!-- Modal Show Generator Client -->
        <div class="modal fade text-black"
            id="modal-show-generator-client-{{$gen_key + 1}}"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal-show-generator-client-{{$gen_key + 1}}">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Informações do Cliente</h5>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Profile Informations -->
                        <div class="card border">
                            <div class="card-header bg-blue-lighten p-3">
                                <h4 class="card-title mb-0">Informações de Perfil</h4>
                            </div>
                            <div class="card-body pt-4 pb-1">
                                @if ($generator->client->is_corporate)
                                    <div class="row">
                                        <!-- Corporate Name -->
                                        <div class="col-12 col-lg-6 mb-3">
                                            <span class="fw-bold">Razão Social:</span>
                                            <p>{{$generator->client->corporate_name}}</p>
                                        </div>

                                        <!-- CNPJ -->
                                        <div class="col-12 col-lg-6 mb-3">
                                            <span class="fw-bold">CNPJ:</span>
                                            <p>{{$generator->client->cnpj}}</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">Nome:</span>
                                        <p>{{$generator->client->name}}</p>
                                    </div>

                                    <!-- Birth Date -->
                                    <div class="col-12 col-lg-3 mb-3">
                                        <span class="fw-bold">Data de Nascimento:</span>
                                        <p>{{date('d/m/Y', strToTime($generator->client->birth_date))}}</p>
                                    </div>

                                    <!-- CPF -->
                                    <div class="col-12 col-lg-3 mb-3">
                                        <span class="fw-bold">CPF:</span>
                                        <p>{{$generator->client->cpf}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">Email:</span>
                                        <p>{{$generator->client->email}}</p>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">Telefone:</span>
                                        <p>{{$generator->client->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Informations -->
                        <div class="card border">
                            <div class="card-header bg-blue-lighten p-3">
                                <h4 class="card-title mb-0">Informações de Endereço</h4>
                            </div>
                            <div class="card-body pt-4 pb-1">
                                <div class="row">
                                    <!-- CEP -->
                                    <div class="col-12 col-md-3 mb-3">
                                        <span class="fw-bold">CEP:</span>
                                        <p>{{$generator->client->address_cep}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Address -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">Endereço:</span>
                                        <p>{{$generator->client->address}}</p>
                                    </div>

                                    <!-- Number -->
                                    <div class="col-12 col-lg-3 mb-3">
                                        <span class="fw-bold">Número:</span>
                                        <p>{{$generator->client->address_number}}</p>
                                    </div>

                                    <!-- Complement -->
                                    <div class="col-12 col-lg-3 mb-3">
                                        <span class="fw-bold">Complemento:</span>
                                        <p>{{$generator->client->address_complement}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Neighborhood -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">Bairro:</span>
                                        <p>{{$generator->client->address_neighborhood}}</p>
                                    </div>

                                    <!-- City -->
                                    <div class="col-12 col-lg-3 mb-3">
                                        <span class="fw-bold">Cidade:</span>
                                        <p>{{$generator->client->address_city}}</p>
                                    </div>

                                    <!-- State -->
                                    <div class="col-12 col-lg-3 mb-3">
                                        <span class="fw-bold">Estado:</span>
                                        <p>{{$generator->client->address_state}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Equatorial Credentials -->
                        <div class="card border">
                            <div class="card-header bg-blue-lighten p-3">
                                <h4 class="card-title mb-0">Credenciais Equatorial</h4>
                            </div>
                            <div class="card-body pt-4 pb-1">
                                <div class="row">
                                    <!-- Login -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">Login:</span>
                                        <p>
                                            @if ($generator->client->login != null)
                                                {{$generator->client->login}}
                                            @else
                                                &mdash;
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="fw-bold">Senha:</span>
                                        <p>
                                            @if ($generator->client->password != null)
                                                {{$generator->client->password}}
                                            @else
                                                &mdash;
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Generator Client Documents -->
        <div class="modal fade text-black" id="modal-generator-client-documents-{{$gen_key + 1}}"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Documentos do Cliente</h5>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Client Informations -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-black">Informações do Cliente</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- CNH -->
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <div class="form-group">
                                            <span class="fw-bold d-inline-block">CNH:</span>
                                            <form action="{{route('clients_file_view', ['type' => encrypt('cnh'), 'id' => encrypt($generator->client->id)])}}"
                                                method="POST" class="align-self-center mt-1" enctype="multipart/form-data"
                                                target="_blank">
                                                @csrf
                                                <button type="submit"
                                                    class="btn bg-primary btn-sm text-white"
                                                    @if ($generator->client->file_cnh_path == null) disabled @endif>
                                                    <i class="bi bi-file-pdf-fill me-1"></i>
                                                    Visualizar
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Procuration -->
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <div class="form-group">
                                            <span class="fw-bold">Procuração:</span><br>
                                            <form action="{{route('clients_file_view', ['type' => encrypt('procuration'), 'id' => encrypt($generator->client->id)])}}"
                                                method="POST" class="align-self-center mt-1"
                                                enctype="multipart/form-data"
                                                target="_blank">
                                                @csrf
                                                <button type="submit"
                                                    class="btn bg-primary btn-sm text-white"
                                                    @if ($generator->client->file_procuration_path == null) disabled @endif>
                                                    <i class="bi bi-file-pdf-fill me-1"></i>
                                                    Visualizar
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- CNPJ -->
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <div class="form-group">
                                            <span class="fw-bold">CNPJ:</span><br>
                                            <form action="{{route('clients_file_view', ['type' => encrypt('cnpj'), 'id' => encrypt($generator->client->id)])}}" method="POST" class="align-self-center mt-1" 
                                                enctype="multipart/form-data"
                                                target="_blank">
                                                @csrf
                                                <button type="submit"
                                                    class="btn bg-primary btn-sm text-white"
                                                    @if ($generator->client->file_cnpj_path == null) disabled @endif>
                                                    <i class="bi bi-file-pdf-fill me-1"></i>
                                                    Visualizar
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Social Contract -->
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <div class="form-group">
                                            <span class="fw-bold">Contrato Social:</span><br>
                                            <form action="{{route('clients_file_view', ['type' => encrypt('social_contract'), 'id' => encrypt($generator->client->id)])}}"
                                                method="POST" class="align-self-center mt-1"
                                                enctype="multipart/form-data"
                                                target="_blank">
                                                @csrf
                                                <button type="submit"
                                                    class="btn bg-primary btn-sm text-white"
                                                    @if ($generator->client->file_social_contract_path == null) disabled @endif>
                                                    <i class="bi bi-file-pdf-fill me-1"></i>
                                                    Visualizar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($generator->client->login != null && $generator->client->password != null)
                            <!-- View Bills -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-black">Visualizar Faturas</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="generator-table-id">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">
                                                            Conta Contrato
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Endereço
                                                        </th>
                                                        <th scope="col" class="text-center">Bairro</th>
                                                        <th scope="col" class="text-center">Cidade</th>
                                                        <th scope="col" class="text-center">Fatura</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="border-1">
                                                    <tr id="generator-contract-account-info-{{$gen_key + 1}}">
                                                        <td class="text-center">
                                                            {{$generator->generator_contract_account}}
                                                        </td>
                                                        <td>{{$generator->generator_address}}</td>
                                                        <td>{{$generator->generator_neighborhood}}</td>
                                                        <td>{{$generator->generator_city}}</td>
                                                        <td>
                                                            <form action="{{route('clients_contract_bill', ['id' => encrypt($generator->generator_contract_account)])}}"
                                                                method="POST" target="_blank"
                                                                enctype="multipart/form-data" 
                                                                class="align-self-center me-2 mb-0"
                                                                id="generator-contract-account-bill-{{$gen_key + 1}}"
                                                                onsubmit="return false">
                                                                @csrf
                                                                <input type="hidden" 
                                                                    name="contract-account"
                                                                    id="generator-contract-account-{{$gen_key + 1}}">
                                                                <div class="input-group">
                                                                    <input type="month" 
                                                                        class="form-control date"
                                                                        name="contract-account-date-{{$gen_key + 1}}"
                                                                        id="generator-contract-account-date-{{$gen_key + 1}}"
                                                                        onkeyup="return window.validateBillDate(this)"
                                                                        onblur="return window.validateBillDate(this)"
                                                                        onchange="return window.validateBillDate(this)">
                                                                    <button type="submit" 
                                                                        class="btn bg-primary text-white btn-sm"
                                                                        id="generator-btn-account-{{$gen_key + 1}}"
                                                                        onclick="return window.getContractAccount(this, '{{$generator->client->login}}', '{{$generator->client->password}}', '{{$generator->generator_contract_account}}')"
                                                                        disabled>
                                                                        <i class="bi bi-download"
                                                                            id="generator-icon-file-download-{{$gen_key + 1}}"></i>
                                                                        <div class="spinner-border spinner-border-sm text-white d-none" 
                                                                            id="generator-loading-contract-account-{{$gen_key + 1}}" role="status">
                                                                            <span class="visually-hidden">
                                                                                Loading...
                                                                            </span>
                                                                        </div>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" 
                            data-bs-dismiss="modal">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create Generator Documents -->
        <div class="modal fade text-black"
            id="modal-create-generator-documents-{{$gen_key + 1}}"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Documentos do Projeto</h5>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Access Request Form -->
                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="create-generator-documents-request-{{$gen_key + 1}}" 
                                                class="form-label fw-bold">
                                                Formulário de Solicitação de Acesso
                                            </label>

                                            @php
                                                $arr_request_power = [];

                                                foreach ($generator->generator_equipment as $equipment) {
                                                    if ($equipment->type == 'SOLAR_INVERTER') {
                                                        array_push($arr_request_power, $equipment->equipment->power);
                                                    }
                                                }

                                                $request_power_sum = array_sum($arr_request_power);
                                            @endphp

                                            @switch ($request_power_sum)
                                                @case ($request_power_sum <= 10)
                                                    @if ($generator->document_request_up_to_ten == null)
                                                        <form action="{{route('engineering_document_create_request', ['type' => encrypt('up_to_ten'), 'id' => encrypt($generator->id)])}}" method="GET">
                                                            <button class="btn bg-primary d-block text-white lh-1 pt-2 pb-2 mb-0"
                                                            type="submit">
                                                                Criar Documento
                                                                <i class="bi bi-file-earmark-text-fill ms-1"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <div class="d-flex">
                                                            <form action="{{route('engineering_document_edit_request', ['type' => encrypt('up_to_ten'), 'id' => encrypt($generator->document_request_up_to_ten->id)])}}" method="GET"
                                                                class="me-3 mb-0">
                                                                <button class="btn bg-success d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                    Editar
                                                                    <i class="bi bi-pencil-fill ms-1"></i>
                                                                </button>
                                                            </form>

                                                            <button type="button"
                                                                class="btn bg-primary d-block text-white lh-1 pt-2 pb-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-dismiss="modal"
                                                                data-bs-target="#modal-show-request-uptoten-{{$gen_key + 1}}">
                                                                Gerar Documento
                                                                <i class="bi bi-file-earmark-pdf-fill ms-1"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @break;

                                                @case ($request_power_sum > 10 && $request_power_sum <= 75)
                                                    @if ($generator->document_request_above_ten_up_to_seventy_five == null)
                                                        <form action="{{route('engineering_document_create_request', ['type' => encrypt('above_ten_up_to_seventy_five'), 'id' => encrypt($generator->id)])}}"
                                                            method="GET">
                                                            <button class="btn bg-primary d-block text-white lh-1 pt-2 pb-2 mb-0"
                                                            type="submit">
                                                                Criar Documento
                                                                <i class="bi bi-file-earmark-text-fill ms-1"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <div class="d-flex">
                                                            <form action="{{route('engineering_document_edit_request', ['type' => encrypt('above_ten_up_to_seventy_five'), 'id' => encrypt($generator->document_request_above_ten_up_to_seventy_five->id)])}}"
                                                                method="GET"
                                                                class="me-3 mb-0">
                                                                <button class="btn bg-success d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                    Editar
                                                                    <i class="bi bi-pencil-fill ms-1"></i>
                                                                </button>
                                                            </form>

                                                            <button type="button"
                                                                class="btn bg-primary d-block text-white lh-1 pt-2 pb-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-dismiss="modal"
                                                                data-bs-target="#modal-show-request-abovetenuptoseventyfive-{{$gen_key + 1}}">
                                                                Gerar Documento
                                                                <i class="bi bi-file-earmark-pdf-fill ms-1"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @break;

                                                @default
                                                    @if ($generator->document_request_above_seventy_five == null)
                                                        <form action="{{route('engineering_document_create_request', ['type' => encrypt('above_seventy_five'), 'id' => encrypt($generator->id)])}}"
                                                            method="GET">
                                                            <button class="btn bg-primary d-block text-white lh-1 pt-2 pb-2 mb-0"
                                                            type="submit">
                                                                Criar Documento
                                                                <i class="bi bi-file-earmark-text-fill ms-1"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <div class="d-flex">
                                                            <form action="{{route('engineering_document_edit_request', ['type' => encrypt('above_seventy_five'), 'id' => encrypt($generator->document_request_above_seventy_five->id)])}}"
                                                                method="GET"
                                                                class="me-3 mb-0">
                                                                <button class="btn bg-success d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                    Editar
                                                                    <i class="bi bi-pencil-fill ms-1"></i>
                                                                </button>
                                                            </form>

                                                            <button type="button"
                                                                class="btn bg-primary d-block text-white lh-1 pt-2 pb-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-dismiss="modal"
                                                                data-bs-target="#modal-show-request-aboveseventyfive-{{$gen_key + 1}}">
                                                                Gerar Documento
                                                                <i class="bi bi-file-earmark-pdf-fill ms-1"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @break;
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{route('engineering_generator_documents_store', ['id' => encrypt($generator->id)])}}" method="POST" enctype="multipart/form-data"
                            id="form-create-generator-documents-{{$gen_key + 1}}"
                            class="mb-0">
                            @csrf
                            <div class="card">
                                <div class="card-body pt-0" id="generator-create-documents-{{$gen_key + 1}}">
                                    <div class="row">
                                        <!-- ART -->
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="create-generator-documents-art-{{$gen_key + 1}}"
                                                    class="form-label fw-bold">
                                                    ART
                                                </label>
                                                <input class="form-control" type="file"
                                                    id="create-generator-documents-art-{{$gen_key + 1}}" name="generator-documents-art"
                                                    value="{{old('generator-documents-art')}}" 
                                                    onchange="return window.validateCreateFile(this)"
                                                    onblur="return window.validateCreateFile(this)">
                                                <div class="invalid-feedback" 
                                                    id="create-documents-art-feedback-{{$gen_key + 1}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- ANEEL Form -->
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="create-generator-documents-aneel-{{$gen_key + 1}}" class="form-label fw-bold">
                                                    Formulário ANEEL
                                                </label>
                                                <input class="form-control" type="file"
                                                    id="create-generator-documents-aneel-{{$gen_key + 1}}" name="generator-documents-aneel"
                                                    value="{{old('generator-documents-aneel')}}" 
                                                    onchange="return window.validateCreateFile(this)"
                                                    onblur="return window.validateCreateFile(this)">
                                                <div class="invalid-feedback"
                                                    id="create-documents-aneel-feedback-{{$gen_key + 1}}"></div>
                                            </div>
                                        </div>

                                        <!-- Data Sheet and Certificates -->
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="create-generator-documents-certificates-{{$gen_key + 1}}" class="form-label fw-bold">
                                                    Folha de Dados e Certificados
                                                </label>
                                                <input class="form-control" type="file"
                                                    id="create-generator-documents-certificates-{{$gen_key + 1}}" name="generator-documents-certificates"
                                                    value="{{old('generator-documents-certificates')}}" 
                                                    onchange="return window.validateCreateFile(this)"
                                                    onblur="return window.validateCreateFile(this)">
                                                <div class="invalid-feedback" 
                                                    id="create-documents-certificates-feedback-{{$gen_key + 1}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Descriptive Memorial -->
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="create-generator-documents-memorial-{{$gen_key + 1}}" class="form-label fw-bold">
                                                    Memorial Descritivo
                                                </label>
                                                <input class="form-control" type="file"
                                                    id="create-generator-documents-memorial-{{$gen_key + 1}}" name="generator-documents-memorial"
                                                    value="{{old('generator-documents-memorial')}}" 
                                                    onchange="return window.validateCreateFile(this)"
                                                    onblur="return window.validateCreateFile(this)">
                                                <div class="invalid-feedback" 
                                                    id="create-documents-memorial-feedback-{{$gen_key + 1}}"></div>
                                            </div>
                                        </div>

                                        <!-- Electrical Project -->
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="create-generator-documents-electrical-{{$gen_key + 1}}" class="form-label fw-bold">
                                                    Projeto Elétrico
                                                </label>
                                                <input class="form-control" type="file"
                                                    id="create-generator-documents-electrical-{{$gen_key + 1}}" name="generator-documents-electrical"
                                                    value="{{old('generator-documents-electrical')}}" 
                                                    onchange="return window.validateCreateFile(this)"
                                                    onblur="return window.validateCreateFile(this)">
                                                <div class="invalid-feedback" 
                                                    id="create-documents-electrical-feedback-{{$gen_key + 1}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body pt-0 pb-0">
                                <!-- button Add New File -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button class="btn btn-warning d-flex justify-content-center align-items-center"
                                                type="button"
                                                id="btn-create-add-new-file-{{$gen_key + 1}}"
                                                onclick="return window.createDocumentAddNewFile(this)">
                                                <i class="bi bi-plus-circle-fill me-1"></i>
                                                Adicionar Novo Arquivo
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" 
                            data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button class="btn bg-success text-white float-end d-flex align-items-center" 
                            type="button"
                            id="btn-create-generator-documents-{{$gen_key + 1}}"
                            onclick="return window.submitFormCreateGeneratorDocuments(this)">
                            Enviar Arquivos
                            <div class="spinner-border spinner-border-sm text-white d-none ms-3"
                                id="btn-create-generator-documents-loading-{{$gen_key + 1}}"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div> 

        <!-- Modal Show Generator Documents - Up to ten (<= 10%) -->
        <div class="modal fade text-black"
            id="modal-show-request-uptoten-{{$gen_key + 1}}"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal">
            @include('engineering.documents.access_request_form.modals.modalFormGeneratorDocumentRequestFirst', [
                'key' => $gen_key + 1
            ])
        </div>

        <!-- Modal Show Generator Documents - Above ten up to seventy five (> 10% <= 75%) -->
        <div class="modal fade text-black"
            id="modal-show-request-abovetenuptoseventyfive-{{$gen_key + 1}}"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal">
            @include('engineering.documents.access_request_form.modals.modalFormGeneratorDocumentRequestSecond', [
                'key' => $gen_key + 1
            ])
        </div>

        <!-- Modal Show Generator Documents - Above seventy five (> 75%) -->
        <div class="modal fade text-black"
            id="modal-show-request-aboveseventyfive-{{$gen_key + 1}}"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal">
            @include('engineering.documents.access_request_form.modals.modalFormGeneratorDocumentRequestThird', [
                'key' => $gen_key + 1
            ])
        </div>

        <!-- Modal Edit Generator Documents -->
        @if ($generator->document_request != null || $generator->document_art != null || $generator->document_aneel != null || $generator->document_certificates != null || $generator->document_memorial != null || $generator->document_electrical != null)
            <div class="modal fade text-black" id="modal-edit-generator-documents-{{$gen_key + 1}}"
                tabindex="-1" role="dialog" aria-hidden="true"
                aria-labelledby="modal">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Documentos do Projeto</h5>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body pb-0"
                                    id="generator-edit-documents-{{$gen_key + 1}}">
                                    <div class="row">
                                        <!-- Access Request Form -->
                                        @if ($generator->document_request != null)
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'request',
                                                'label' => 'Formulário de Solicitação de Acesso',
                                                'generator_document' => $generator->document_request,
                                                'generator_document_path' => $generator->document_request->file_access_request_form_path,
                                                'type' => 'documents/request',
                                                'name' => 'file_access_request_form_name',
                                                'file_path' => 'file_access_request_form_path'
                                            ])
                                        
                                        @else
                                            <div class="col-12 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <p class="fw-bold mb-2">
                                                        Formulário de Solicitação de Acesso:
                                                    </p>
                                                    
                                                    @php
                                                        $arr_request_power = [];

                                                        foreach ($generator->generator_equipment as $equipment) {
                                                            if ($equipment->type == 'SOLAR_INVERTER') {
                                                                array_push($arr_request_power, $equipment->equipment->power);
                                                            }
                                                        }

                                                        $request_power_sum = array_sum($arr_request_power);
                                                    @endphp

                                                    @switch ($request_power_sum)
                                                        @case ($request_power_sum <= 10)
                                                            @if ($generator->document_request_up_to_ten == null)
                                                                <form action="{{route('engineering_document_create_request', ['type' => encrypt('up_to_ten'), 'id' => encrypt($generator->id)])}}" method="GET">
                                                                    <button class="btn bg-primary d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                        Criar Documento
                                                                        <i class="bi bi-file-earmark-text-fill ms-1"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <div class="d-flex">
                                                                    <form action="{{route('engineering_document_edit_request', ['type' => encrypt('up_to_ten'), 'id' => encrypt($generator->document_request_up_to_ten->id)])}}" method="GET"
                                                                        class="me-3 mb-0">
                                                                        <button class="btn bg-success d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                            Editar
                                                                            <i class="bi bi-pencil-fill ms-1"></i>
                                                                        </button>
                                                                    </form>

                                                                    <button type="button"
                                                                        class="btn bg-primary d-block text-white lh-1 pt-2 pb-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-dismiss="modal"
                                                                        data-bs-target="#modal-show-request-uptoten-{{$gen_key + 1}}">
                                                                        Gerar Documento
                                                                        <i class="bi bi-file-earmark-pdf-fill ms-1"></i>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                            @break;

                                                        @case ($request_power_sum > 10 && $request_power_sum <= 75)
                                                            @if ($generator->document_request_above_ten_up_to_seventy_five == null)
                                                                <form action="{{route('engineering_document_create_request', ['type' => encrypt('above_ten_up_to_seventy_five'), 'id' => encrypt($generator->id)])}}"
                                                                    method="GET">
                                                                    <button class="btn bg-primary d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                        Criar Documento
                                                                        <i class="bi bi-file-earmark-text-fill ms-1"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <div class="d-flex">
                                                                    <form action="{{route('engineering_document_edit_request', ['type' => encrypt('above_ten_up_to_seventy_five'), 'id' => encrypt($generator->document_request_above_ten_up_to_seventy_five->id)])}}" method="GET"
                                                                        class="me-3 mb-0">
                                                                        <button class="btn bg-success d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                            Editar
                                                                            <i class="bi bi-pencil-fill ms-1"></i>
                                                                        </button>
                                                                    </form>

                                                                    <button type="button"
                                                                        class="btn bg-primary d-block text-white lh-1 pt-2 pb-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-dismiss="modal"
                                                                        data-bs-target="#modal-show-request-abovetenuptoseventyfive-{{$gen_key + 1}}">
                                                                        Gerar Documento
                                                                        <i class="bi bi-file-earmark-pdf-fill ms-1"></i>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                            @break;

                                                        @default
                                                            @if ($generator->document_request_above_seventy_five == null)
                                                                <form action="{{route('engineering_document_create_request', ['type' => encrypt('above_seventy_five'), 'id' => encrypt($generator->id)])}}"
                                                                    method="GET">
                                                                    <button class="btn bg-primary d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                        Criar Documento
                                                                        <i class="bi bi-file-earmark-text-fill ms-1"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <div class="d-flex">
                                                                    <form action="{{route('engineering_document_edit_request', ['type' => encrypt('above_seventy_five'), 'id' => encrypt($generator->document_request_above_seventy_five->id)])}}"
                                                                        method="GET"
                                                                        class="me-3 mb-0">
                                                                        <button class="btn bg-success d-block text-white lh-1 pt-2 pb-2" type="submit">
                                                                            Editar
                                                                            <i class="bi bi-pencil-fill ms-1"></i>
                                                                        </button>
                                                                    </form>

                                                                    <button type="button"
                                                                        class="btn bg-primary d-block text-white lh-1 pt-2 pb-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-dismiss="modal"
                                                                        data-bs-target="#modal-show-request-aboveseventyfive-{{$gen_key + 1}}">
                                                                        Gerar Documento
                                                                        <i class="bi bi-file-earmark-pdf-fill ms-1"></i>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                            @break;
                                                    @endswitch
                                                </div>
                                            </div>
                                        @endif

                                        <!-- ART -->
                                        @if ($generator->document_art == null)
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'art',
                                                'label' => 'ART',
                                                'generator_document' => $generator->document_art,
                                                'type' => 'documents/art',
                                                'name' => 'file_art_name',
                                                'file_path' => 'file_art_path'
                                            ])
                                        @else
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'art',
                                                'label' => 'ART',
                                                'generator_document' => $generator->document_art,
                                                'generator_document_path' => $generator->document_art->file_art_path,
                                                'type' => 'documents/art',
                                                'name' => 'file_art_name',
                                                'file_path' => 'file_art_path'
                                            ])
                                        @endif
                                    </div>
                                    <div class="row">
                                        <!-- ANEEL Form -->
                                        @if ($generator->document_aneel == null)
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'aneel',
                                                'label' => 'Formulário ANEEL',
                                                'generator_document' => $generator->document_aneel,
                                                'type' => 'documents/aneel_form',
                                                'name' => 'file_aneel_form_name',
                                                'file_path' => 'file_aneel_form_path'
                                            ])
                                        @else
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'aneel',
                                                'label' => 'Formulário ANEEL',
                                                'generator_document' => $generator->document_aneel,
                                                'generator_document_path' => $generator->document_aneel->file_aneel_form_path,
                                                'type' => 'documents/aneel_form',
                                                'name' => 'file_aneel_form_name',
                                                'file_path' => 'file_aneel_form_path'
                                            ])
                                        @endif
                                    
                                        <!-- Data Sheet and Certificates  -->
                                        @if ($generator->document_certificates == null)
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'certificates',
                                                'label' => 'Folha de Dados e Certificados',
                                                'generator_document' => $generator->document_certificates,
                                                'type' => 'documents/data_sheet_certificates',
                                                'name' => 'file_data_sheet_certificates_name',
                                                'file_path' => 'file_data_sheet_certificates_path'
                                            ])
                                        @else
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'certificates',
                                                'label' => 'Folha de Dados e Certificados',
                                                'generator_document' => $generator->document_certificates,
                                                'generator_document_path' => $generator->document_certificates->file_data_sheet_certificates_path,
                                                'type' => 'documents/data_sheet_certificates',
                                                'name' => 'file_data_sheet_certificates_name',
                                                'file_path' => 'file_data_sheet_certificates_path'
                                            ])
                                        @endif
                                    </div>
                                    <div class="row">
                                        <!-- Descriptive Memorial -->
                                        @if ($generator->document_memorial == null)
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'memorial',
                                                'label' => 'Memorial Descritivo',
                                                'generator_document' => $generator->document_memorial,
                                                'type' => 'documents/descriptive_memorial',
                                                'name' => 'file_descriptive_memorial_name',
                                                'file_path' => 'file_descriptive_memorial_path'
                                            ])
                                        @else
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'memorial',
                                                'label' => 'Memorial Descritivo',
                                                'generator_document' => $generator->document_memorial,
                                                'generator_document_path' => $generator->document_memorial->file_descriptive_memorial_path,
                                                'type' => 'documents/descriptive_memorial',
                                                'name' => 'file_descriptive_memorial_name',
                                                'file_path' => 'file_descriptive_memorial_path'
                                            ])
                                        @endif
            
                                        <!-- Electrical Project -->
                                        @if ($generator->document_electrical == null)
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'electrical',
                                                'label' => 'Projeto Elétrico',
                                                'generator_document' => $generator->document_electrical,
                                                'type' => 'documents/electrical_project',
                                                'name' => 'file_electrical_project_name',
                                                'file_path' => 'file_electrical_project_path'
                                            ])
                                        @else
                                            @include ('engineering.showGeneratorDocuments', [
                                                'id' => 'electrical',
                                                'label' => 'Projeto Elétrico',
                                                'generator_document' => $generator->document_electrical,
                                                'generator_document_path' => $generator->document_electrical->file_electrical_project_path,
                                                'type' => 'documents/electrical_project',
                                                'name' => 'file_electrical_project_name',
                                                'file_path' => 'file_electrical_project_path'
                                            ])
                                        @endif
                                    </div>

                                    @if ($generator->newfile != null)
                                        <div class="row">
                                            @foreach ($generator->newfile as $new_key => $new_file)
                                                <!-- New File -->
                                                <div class="col-12 col-md-6 mb-3" 
                                                    id="documents-new-{{$gen_key + 1}}-{{$new_key + 1}}" data-add-new-file>
                                                    <div class="form-group">
                                                        <p class="fw-bold mb-2">
                                                            {{$new_file->name}}
                                                        </p>
                                                        <div class="d-flex align-items-center" 
                                                            id="file-management-new-{{$gen_key + 1}}-{{$new_key + 1}}">
                                                            <!-- Show file -->
                                                            <form action="{{route('engineering_project_file_view', ['type' => encrypt('documents/new'), 'id' => encrypt($new_file->id)])}}"
                                                                method="POST" enctype="multipart/form-data"
                                                                class="mb-0 me-3"
                                                                target="_blank">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn bg-primary text-white">
                                                                    <i class="bi bi-file-earmark-post-fill"></i>
                                                                </button>
                                                            </form>

                                                            <!-- Edit file -->
                                                            <button type="button"
                                                                class="btn bg-warning text-white me-3"
                                                                id="btn-edit-new-{{$gen_key + 1}}-{{$new_key + 1}}"
                                                                onclick="return window.enableEditDocumentForm(this)">
                                                                <i class="bi bi-pencil-fill"></i>
                                                            </button>

                                                            <!-- Delete file -->
                                                            <form action="{{route('engineering_generator_destroy_document', ['type' => encrypt('documents/new'), 'id' => encrypt($new_file->id)])}}"
                                                                method="POST"
                                                                class="mb-0 me-3">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn bg-danger text-white">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="@if ($generator->newfile != null) d-none @endif" id="file-new-{{$gen_key + 1}}-{{$new_key + 1}}">
                                                            <!-- File upload -->
                                                            <form action="{{route('engineering_generator_documents_update', ['type' => encrypt('new'), 'id' => encrypt($new_file->id)])}}"
                                                                method="POST" 
                                                                enctype="multipart/form-data"
                                                                class="mb-0"
                                                                id="form-document-new-{{$gen_key + 1}}-{{$new_key + 1}}">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input class="form-control" 
                                                                            type="file"
                                                                            id="edit-generator-documents-new-{{$gen_key + 1}}-{{$new_key + 1}}" 
                                                                            name="generator-documents-new"
                                                                            value="{{old('generator-documents-new')}}" 
                                                                            onchange="return window.validateEditFile(this)"
                                                                            onblur="return window.validateEditFile(this)">
                                                                        <button type="submit"
                                                                            class="input-group-text btn bg-success text-white @if ($generator->newfile == null) rounded-end @endif"
                                                                            id="btn-update-new-{{$gen_key + 1}}-{{$new_key + 1}}"
                                                                            onclick="return window.submitFormUpdateGeneratorDocuments(this)">
                                                                            <i class="bi bi-check-circle-fill"></i>

                                                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                                                id="btn-update-new-loading-{{$gen_key + 1}}-{{$new_key + 1}}"
                                                                                role="status">
                                                                                <span class="visually-hidden">
                                                                                    Loading...
                                                                                </span>
                                                                            </div>
                                                                        </button>

                                                                        <!-- 
                                                                            Cancel file editing and hide input 
                                                                        -->
                                                                        @if ($generator->newfile != null)
                                                                            <button type="button"
                                                                                class="input-group-text btn bg-danger text-white" 
                                                                                id="btn-cancel-edit-new-{{$gen_key + 1}}-{{$new_key + 1}}"
                                                                                onclick="return window.cancelDocumentEdit(this)">
                                                                                <i class="bi bi-x-circle-fill"></i>
                                                                            </button>
                                                                        @endif
                                                                    </div>

                                                                    <!-- 
                                                                        Show the file name if it exists
                                                                    -->
                                                                    @if ($generator->newfile != null)
                                                                        <div class="valid-feedback d-block" 
                                                                            id="file-new-name-{{$gen_key + 1}}-{{$new_key + 1}}">
                                                                            <span class="fw-bold">Arquivo atual:</span> {{$new_file->file_new_name}}
                                                                        </div>
                                                                    @endif
                                                                    
                                                                    <div class="invalid-feedback" 
                                                                        id="edit-documents-new-feedback-{{$gen_key + 1}}-{{$new_key + 1}}"></div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('engineering_generator_documents_update', ['type' => encrypt('newfile'), 'id' => encrypt($generator->id)])}}" method="POST" enctype="multipart/form-data"
                                        class="mt-0 mb-0"
                                        id="form-add-new-file-{{$gen_key + 1}}">
                                        @csrf
                                    </form>
                                    <!-- button Add New File -->
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group mb-0">
                                                <button class="btn btn-warning d-flex justify-content-center align-items-center"
                                                    type="button"
                                                    id="btn-edit-add-new-file-{{$gen_key + 1}}"
                                                    onclick="return window.editDocumentAddNewFile(this)">
                                                    <i class="bi bi-plus-circle-fill me-2"></i>
                                                    Adicionar Novo Arquivo
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" 
                                data-bs-dismiss="modal">
                                Fechar
                            </button>
                            <button class="btn bg-success text-white float-end d-flex align-items-center"
                                type="button"
                                id="btn-submit-new-file-{{$gen_key + 1}}"
                                onclick="return window.submitFormAddNewFile(this)"
                                disabled>
                                Enviar Novo(s) Arquivo(s)

                                <div class="spinner-border spinner-border-sm text-white d-none ms-3"
                                    id="btn-submit-new-file-loading-{{$gen_key + 1}}"
                                    role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modal Generator Images -->
        <div class="modal fade text-black" id="modal-generator-image-{{$gen_key + 1}}"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal">
            <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Imagens do Projeto</h5>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0 pb-0">
                        <form action="#" method="POST" enctype="multipart/form-data"
                            id="form-generator-image-{{$gen_key + 1}}"
                            class="pt-3">
                            @csrf

                            <input type="hidden" id="generator-id-{{$gen_key + 1}}" 
                                name="generator-id"
                                value="{{encrypt($generator->id)}}">

                            <div class="card border mb-5">
                                <div class="card-header bg-blue-lighten p-3">
                                    <h4 class="card-title mb-0">Adicionar Imagem</h4>
                                </div>
                                <div class="card-body pt-4 pb-1">
                                    <div class="row">
                                        <!-- Image Name -->
                                        <div class="col-12 col-md-4 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" 
                                                    for="generator-create-image-name-{{$gen_key + 1}}">
                                                    Nome da Imagem
                                                </label>
                                                <input class="form-control" type="text"
                                                    id="generator-create-image-name-{{$gen_key + 1}}" name="generator-image-name"
                                                    value="{{old('generator-image-name')}}" 
                                                    onchange="return window.validateImageName(this)"
                                                    onblur="return window.validateImageName(this)"
                                                    onkeyup="return window.validateImageName(this)">
                                                <div class="invalid-feedback" 
                                                    id="create-image-name-feedback-{{$gen_key + 1}}"></div>
                                            </div>
                                        </div>

                                        <!-- Image Type -->
                                        <div class="col-12 col-md-3 mb-3">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="generator-create-image-type-{{$gen_key + 1}}">
                                                    Tipo da Imagem
                                                </label>
                                                <select class="form-select" 
                                                    aria-label="generator-create-image-type-{{$gen_key + 1}}"
                                                    id="generator-create-image-type-{{$gen_key + 1}}" name="generator-image-type"
                                                    onchange="return window.validateSelect(this)"
                                                    onblur="return window.validateSelect(this)">
                                                    <option value="" disabled selected>
                                                        Escolha o tipo da imagem
                                                    </option>
                                                    <option value="{{encrypt("VISTORIA_PREVIA")}}">
                                                        Vistoria Prévia
                                                    </option>
                                                    <option value="{{encrypt("INSTALACAO")}}">
                                                        Imagens da Instalação
                                                    </option>
                                                    <option value="{{encrypt("VISTORIA_FINAL")}}">
                                                        Vistoria Final
                                                    </option>
                                                    <option value="{{encrypt("OUTRAS")}}">
                                                        Outras Imagens
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback"
                                                    id="create-image-type-feedback-{{$gen_key + 1}}"></div>
                                            </div>
                                        </div>

                                        <!-- Generator Image -->
                                        <div class="col-12 col-md-5 mb-3">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="generator-create-image-file-{{$gen_key + 1}}">
                                                    Arquivo de Imagem
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="file"
                                                        id="generator-create-image-file-{{$gen_key + 1}}" name="generator-image-file"
                                                        value="{{old('generator-image-file')}}" 
                                                        onchange="return window.validateCreateImage(this)"
                                                        onblur="return window.validateCreateImage(this)">
                                                    <button type="button"
                                                        class="input-group-text btn bg-success text-white rounded ms-4" 
                                                        id="btn-create-image-{{$gen_key + 1}}"
                                                        onclick="return window.submitFormAddGeneratorImage('form-generator-image-{{$gen_key + 1}}')">
                                                        <i class="bi bi-check-circle-fill"></i>

                                                        <div class="spinner-border spinner-border-sm text-white d-none"
                                                            id="btn-create-image-loading-{{$gen_key + 1}}" role="status">
                                                            <span class="visually-hidden">
                                                                Loading...
                                                            </span>
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="invalid-feedback" 
                                                    id="create-image-file-feedback-{{$gen_key + 1}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card mt-5">
                            <div class="card-header pt-0 pb-3">
                                <h4 class="card-title">Imagens</h4>
                            </div>
                            <div class="card-body pb-0">
                                @php
                                    $images_types = [
                                        [
                                            'type' => 'VISTORIA_PREVIA',
                                            'title' => 'Vistoria Prévia',
                                            'class' => 'previous'
                                        ],
                                        [
                                            'type' => 'INSTALACAO',
                                            'title' => 'Imagens da Instalação',
                                            'class' => 'installation'
                                        ],
                                        [
                                            'type' => 'VISTORIA_FINAL',
                                            'title' => 'Vistoria Final',
                                            'class' => 'final'
                                        ],
                                        [
                                            'type' => 'OUTRAS',
                                            'title' => 'Outras Imagens',
                                            'class' => 'others'
                                        ],
                                    ]
                                @endphp

                                <ul class="nav nav-pills nav-justified"
                                    id="image-pills-tab-{{$gen_key + 1}}"
                                    role="tablist">

                                    @for ($i = 0; $i < count($images_types); $i++)
                                        <li class="nav-item" role="presentation">
                                            <button type="button"
                                                class="nav-link shadow-none disabled @if ($i == 0) active @endif" 
                                                id="pills-image-tab-{{$images_types[$i]['class']}}-{{$gen_key + 1}}"
                                                onclick="return window.initSlidesFromModal(this)"
                                                data-bs-toggle="pill"
                                                data-bs-target="#pills-image-{{$images_types[$i]['class']}}-{{$gen_key + 1}}"
                                                role="tab"
                                                aria-controls="pills-image-{{$gen_key + 1}}" 
                                                aria-selected="true">
                                                {{$images_types[$i]['title']}}
                                            </button>
                                        </li>
                                    @endfor
                                </ul>
                                <div class="tab-content mt-3" id="image-pills-{{$gen_key + 1}}">
                                    @for ($i = 0; $i < count($images_types); $i++)
                                        @include ('engineering.slides', [
                                            'arr_images' => $generator->images,
                                            'type' => $images_types[$i]['type'],
                                            'item' => $i
                                        ])
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" 
                            data-bs-dismiss="modal">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Beneficiary -->
        @if (count($generator->beneficiary) > 0)
            <!-- Modal Show Beneficiaries -->
            <div class="modal fade text-black"
                id="modal-beneficiary-view-{{$gen_key + 1}}"
                tabindex="-1" role="dialog" aria-hidden="true"
                aria-labelledby="modal">
                <div class="modal-dialog modal-fullscreen" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Beneficiárias</h5>
                            <button type="button" class="btn-close" 
                                data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-5">
                                        <div class="col-12 col-md-2">
                                            <a class="btn btn-warning d-flex justify-content-center align-items-center"
                                                data-bs-toggle="modal"
                                                data-bs-dismiss="modal"
                                                data-bs-target="#modal-new-apportionment-list-{{$gen_key + 1}}">
                                                <i class="bi bi-plus-circle-fill me-2"></i>
                                                Nova Lista de Rateio
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-hover pt-4"
                                                style="width: 100%" 
                                                id="table-effective-date-{{$gen_key + 1}}">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">
                                                            Data de Vigência
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Status
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Lista de Rateio
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Excluir Lista de Rateio
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Cliente
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Telefone
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Conta Contrato
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Classe de Consumo
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Rateio (%)
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Endereço
                                                        </th>
                                                        <th scope="col" class="text-center">
                                                            Documentos/Ações
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($generator->beneficiary as $ben_key =>  $beneficiary)
                                                        <tr>
                                                            <!-- Beneficiary effective date -->
                                                            <td class="text-center">
                                                                {{
                                                                    date('d/m/Y', strtotime($beneficiary->beneficiary_effective_date->effective_date))
                                                                }}
                                                            </td>

                                                            <!-- 
                                                                Beneficiary effective date status
                                                            -->
                                                            <td class="text-center">
                                                                @if  ($beneficiary->beneficiary_effective_date->status == 1)
                                                                    ATIVO
                                                                @endif
                                                            </td>

                                                            <!-- Beneficiary apportionment list -->
                                                            <td class="text-center">
                                                                {{route('engineering_print_apportionment_list', ['id' => encrypt($beneficiary->beneficiary_effective_date->id)])}}
                                                            </td>

                                                            <!--
                                                                Delete Beneficiary effective date
                                                            -->
                                                            <td class="text-center">
                                                                {{route('engineering_project_destroy_apportionment_list', ['id' => encrypt($beneficiary->beneficiary_effective_date->id)])}}
                                                            </td>

                                                            <!-- Beneficiary client -->
                                                            <td class="@if ($beneficiary->client != null) text-start @else text-center @endif">
                                                                @if ($beneficiary->client != null)
                                                                    {{
                                                                        $beneficiary->client->is_corporate ? 
                                                                            $beneficiary->client->corporate_name : $beneficiary->client->name
                                                                    }}
                                                                @else
                                                                    &mdash;
                                                                @endif
                                                            </td>
                                    
                                                            <!-- Beneficiary Client Phone -->
                                                            <td class="text-center">
                                                                @if ($beneficiary->client != null)
                                                                    @if ($beneficiary->client->phone != null) 
                                                                        {{$beneficiary->client->phone}}

                                                                        <a href="https://wa.me/55{{preg_replace('/[^0-9]/', '', $beneficiary->client->phone)}}/?text=Olá!%20Tudo%20bem?%20Aqui%20é%20{{Auth::user()->name}}%20do%20time%20de%20engenharia%20da%20Sunny%20House%20Energia%20Solar"
                                                                            target="_blank" class="p-2">
                                                                            <i class="bi bi-whatsapp text-success" style="font-size: 18px" role="img" aria-label="WhatsApp"></i>
                                                                        </a>
                                                                    @else &mdash;
                                                                    @endif

                                                                    @else &mdash;
                                                                @endif
                                                            </td>
                                    
                                                            <!-- Beneficiary contract account -->
                                                            <td class="text-center">
                                                                {{
                                                                    $beneficiary->beneficiary_contract_account
                                                                }}
                                                            </td>
                                    
                                                            <!-- Beneficiary consumption class -->
                                                            <td class="text-center">
                                                                @switch ($beneficiary->beneficiary_consumption_class)
                                                                    @case ('RESIDENCIAL')
                                                                        Residencial
                                                                        @break
                                                                    @case ('INDUSTRIAL')
                                                                        Industrial
                                                                        @break
                                                                    @case ('COMERCIO_SERVICOS_OUTROS')
                                                                        Comércio, Serviço e outras atividades
                                                                        @break
                                                                    @case ('RURAL')
                                                                        Rural
                                                                        @break
                                                                    @case ('PODER_PUBLICO')
                                                                        Poder Público
                                                                        @break
                                                                    @case ('ILUMINACAO_PUBLICA')
                                                                        Iluminação Pública
                                                                        @break
                                                                    @case ('SERVICO_PUBLICO')
                                                                        Serviço Público
                                                                        @break
                                                                    @case ('CONSUMO_PROPRIO')
                                                                        Consumo Próprio
                                                                        @break
                                                                @endswitch
                                                            </td>
                                    
                                                            <!-- Benefificary rate -->
                                                            <td class="text-center">
                                                                {{Str::replaceFirst('.', ',', $beneficiary->beneficiary_rate)}}
                                    
                                                                @if ($generator->generator_project_type == "AUTOCONSUMO_REMOTO")
                                                                    <span class="ms-1">
                                                                        ({{
                                                                            number_format((((($project->contract->monthly_avg_generation * 1000 / $project->contract->getGeneratorPowerValue()) * $generator->generator_power) / 1000) - $generator->generator_consumption) * $beneficiary->beneficiary_rate / 100, 2, ',', '.')
                                                                        }} kWh)
                                                                    </span>
                                                                @else
                                                                    <span class="ms-1">
                                                                        ({{
                                                                            number_format(((($project->contract->monthly_avg_generation * 1000 / $project->contract->getGeneratorPowerValue()) * $generator->generator_power) / 1000) * $beneficiary->beneficiary_rate / 100, 2, ',', '.')
                                                                        }} kWh)
                                                                    </span>
                                                                @endif
                                                            </td>
                                    
                                                            <!-- Beneficiary address -->
                                                            <td>
                                                                {{$beneficiary->beneficiary_address}}
                                                            </td>

                                                            <td class="text-center">
                                                                @if ($beneficiary->client != null && $generator->generator_project_type == "GERACAO_COMPARTILHADA")
                                                                    <a class="btn bg-primary btn-sm text-white lh-1 pt-2 pb-2 me-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-dismiss="modal"
                                                                        data-bs-target="#modal-show-beneficiary-client-{{$ben_key + 1}}">
                                                                        <i class="bi bi-person-badge"></i>
                                                                    </a>

                                                                    <a class="btn bg-primary btn-sm text-white lh-1 pt-2 pb-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-dismiss="modal"
                                                                        data-bs-target="#modal-beneficiary-client-documents-{{$ben_key + 1}}">
                                                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                                                    </a>
                                                                @else &mdash;
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" 
                                data-bs-dismiss="modal">
                                Fechar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($generator->beneficiary as $ben_key => $beneficiary)
                @if ($generator->generator_project_type == 'GERACAO_COMPARTILHADA' && $beneficiary->client != null)
                    <!-- Modal Show Beneficiary Client -->
                    <div class="modal fade text-black"
                        id="modal-show-beneficiary-client-{{$ben_key + 1}}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal-show-beneficiary-client-{{$ben_key + 1}}">
                        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Informações do Cliente</h5>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card border">
                                        <!-- Profile Informations -->
                                        <div class="card-header bg-blue-lighten p-3">
                                            <h4 class="card-title mb-0">Informações de Perfil</h4>
                                        </div>
                                        <div class="card-body pt-4 pb-1">
                                            @if ($beneficiary->client->is_corporate)
                                                <div class="row">
                                                    <!-- Corporate Name -->
                                                    <div class="col-12 col-md-5 col-lg-4 mb-3">
                                                        <span class="fw-bold">Razão Social:</span>
                                                        <p>
                                                            {{$beneficiary->client->corporate_name}}
                                                        </p>
                                                    </div>

                                                    <!-- CNPJ -->
                                                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                        <span class="fw-bold">CNPJ:</span>
                                                        <p>{{$beneficiary->client->cnpj}}</p>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <!-- Name -->
                                                <div class="col-12 col-md-5 col-lg-4 mb-3">
                                                    <span class="fw-bold">Nome:</span>
                                                    <p>{{$beneficiary->client->name}}</p>
                                                </div>

                                                <!-- Birth Date -->
                                                <div class="col-12 col-md-4 mb-3">
                                                    <span class="fw-bold">Data de Nascimento:</span>
                                                    <p>
                                                        {{date('d/m/Y', strToTime($beneficiary->client->birth_date))}}
                                                    </p>
                                                </div>

                                                <!-- CPF -->
                                                <div class="col-12 col-md-3 col-lg-4 mb-3">
                                                    <span class="fw-bold">CPF:</span>
                                                    <p>{{$beneficiary->client->cpf}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Email -->
                                                <div class="col-12 col-md-5 col-lg-4 mb-3">
                                                    <span class="fw-bold">Email:</span>
                                                    <p>{{$beneficiary->client->email}}</p>
                                                </div>

                                                <!-- Phone -->
                                                <div class="col-12 col-md-6 mb-3">
                                                    <span class="fw-bold">Telefone:</span>
                                                    <p>{{$beneficiary->client->phone}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address Informations -->
                                    <div class="card border">
                                        <div class="card-header bg-blue-lighten p-3">
                                            <h4 class="card-title mb-0">Informações de Endereço</h4>
                                        </div>
                                        <div class="card-body pt-4 pb-0">
                                            <div class="row">
                                                <!-- CEP -->
                                                <div class="col-12 col-md-3 mb-3">
                                                    <span class="fw-bold">CEP:</span>
                                                    <p>{{$beneficiary->client->address_cep}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Address -->
                                                <div class="col-12 col-md-4 mb-3">
                                                    <span class="fw-bold">Endereço:</span>
                                                    <p>{{$beneficiary->client->address}}</p>
                                                </div>

                                                <!-- Number -->
                                                <div class="col-12 col-md-4 mb-3">
                                                    <span class="fw-bold">Número:</span>
                                                    <p>{{$beneficiary->client->address_number}}</p>
                                                </div>

                                                <!-- Complement -->
                                                <div class="col-12 col-md-4 mb-3">
                                                    <span class="fw-bold">Complemento:</span>
                                                    <p>{{$beneficiary->client->address_complement}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Neighborhood -->
                                                <div class="col-12 col-md-4 mb-3">
                                                    <span class="fw-bold">Bairro:</span>
                                                    <p>{{$beneficiary->client->address_neighborhood}}</p>
                                                </div>

                                                <!-- City -->
                                                <div class="col-12 col-md-4 mb-3">
                                                    <span class="fw-bold">Cidade:</span>
                                                    <p>{{$beneficiary->client->address_city}}</p>
                                                </div>

                                                <!-- State -->
                                                <div class="col-12 col-md-4 mb-3">
                                                    <span class="fw-bold">Estado:</span>
                                                    <p>{{$beneficiary->client->address_state}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Equatorial Credentials -->
                                    <div class="card border">
                                        <div class="card-header bg-blue-lighten p-3">
                                            <h4 class="card-title mb-0">Credenciais Equatorial</h4>
                                        </div>
                                        <div class="card-body pt-4 pb-0">
                                            <div class="row">
                                                <!-- Login -->
                                                <div class="col-12 col-md-6 mb-3">
                                                    <span class="fw-bold">Login:</span>
                                                    <p>
                                                        @if ($beneficiary->client->login != null)
                                                            {{$beneficiary->client->login}}
                                                        @else &mdash;
                                                        @endif
                                                    </p>
                                                </div>

                                                <!-- Password -->
                                                <div class="col-12 col-md-6 mb-3">
                                                    <span class="fw-bold">Senha:</span>
                                                    <p>
                                                        @if ($beneficiary->client->password != null)
                                                            {{$beneficiary->client->password}}
                                                        @else &mdash;
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn bg-primary text-white lh-1 pt-2 pb-2"
                                        data-bs-toggle="modal"
                                        data-bs-dismiss="modal"
                                        data-bs-target="#modal-beneficiary-view-{{$gen_key + 1}}">
                                        Voltar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Beneficiary Client Documents -->
                    <div class="modal fade text-black"
                        id="modal-beneficiary-client-documents-{{$ben_key + 1}}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog modal-fullscreen" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Documentos do Cliente</h5>
                                    <button type="button" class="btn-close" 
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Client Informations -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title text-black">Informações do Cliente</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- CNH -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <span class="fw-bold d-inline-block">CNH:</span>
                                                        <form action="{{route('clients_file_view', ['type' => encrypt('cnh'), 'id' => encrypt($beneficiary->client->id)])}}" method="POST" 
                                                            enctype="multipart/form-data"
                                                            target="_blank"
                                                            class="align-self-center mt-1" >
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn bg-primary btn-sm text-white"
                                                                @if ($beneficiary->client->file_cnh_path == null) disabled @endif>
                                                                <i class="bi bi-file-pdf me-1"></i>
                                                                Visualizar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                
                                                <!-- Procuration -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <span class="fw-bold">Procuração:</span><br>
                                                        <form action="{{route('clients_file_view', ['type' => encrypt('procuration'), 'id' => encrypt($beneficiary->client->id)])}}" method="POST"  
                                                            class="align-self-center mt-1"
                                                            enctype="multipart/form-data"
                                                            target="_blank">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn bg-primary btn-sm text-white"
                                                                @if ($beneficiary->client->file_procuration_path == null) disabled @endif>
                                                                <i class="bi bi-file-pdf me-1"></i>
                                                                Visualizar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                
                                                <!-- CNPJ -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <span class="fw-bold">CNPJ:</span><br>
                                                        <form action="{{route('clients_file_view', ['type' => encrypt('cnpj'), 'id' => encrypt($beneficiary->client->id)])}}" method="POST" 
                                                            class="align-self-center mt-1" 
                                                            enctype="multipart/form-data"
                                                            target="_blank">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn bg-primary btn-sm text-white"
                                                                @if ($beneficiary->client->file_cnpj_path == null) disabled @endif>
                                                                <i class="bi bi-file-pdf me-1"></i>
                                                                Visualizar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                
                                                <!-- Social Contract -->
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <span class="fw-bold">Contrato Social:</span><br>
                                                        <form action="{{route('clients_file_view', ['type' => encrypt('social_contract'), 'id' => encrypt($beneficiary->client->id)])}}" method="POST" 
                                                            class="align-self-center mt-1"
                                                            enctype="multipart/form-data"
                                                            target="_blank">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn bg-primary btn-sm text-white"
                                                                @if ($beneficiary->client->file_social_contract_path == null) disabled @endif>
                                                                <i class="bi bi-file-pdf me-1"></i>
                                                                Visualizar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    @if ($beneficiary->client->login != null && $beneficiary->client->password != null)
                                        <!-- View Bills -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title text-black">Visualizar Faturas</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped"
                                                            id="beneficiary-table-id">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="text-center">
                                                                        Conta Contrato
                                                                    </th>
                                                                    <th scope="col" class="text-center">
                                                                        Endereço
                                                                    </th>
                                                                    <th scope="col" class="text-center">
                                                                        Bairro
                                                                    </th>
                                                                    <th scope="col" class="text-center">
                                                                        Cidade
                                                                    </th>
                                                                    <th scope="col" class="text-center">
                                                                        Fatura
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="border-1">
                                                                <tr id="beneficiary-contract-account-info-{{$ben_key + 1}}">
                                                                    <td class="text-center">
                                                                        {{
                                                                            $beneficiary->beneficiary_contract_account
                                                                        }}
                                                                    </td>
                                                                    <td>{{$beneficiary->client->address}}</td>
                                                                    <td>
                                                                        {{
                                                                            $beneficiary->client->address_neighborhood
                                                                        }}
                                                                    </td>
                                                                    <td>{{$beneficiary->client->address_city}}</td>
                                                                    <td>
                                                                        <form action="{{route('clients_contract_bill', ['id' => encrypt($beneficiary->beneficiary_contract_account)])}}" method="POST" target="_blank"
                                                                            enctype="multipart/form-data" 
                                                                            class="align-self-center me-2 mb-0"
                                                                            id="beneficiary-contract-account-bill-{{$ben_key + 1}}"
                                                                            onsubmit="return false">
                                                                            @csrf
                                                                            <input type="hidden" 
                                                                                name="contract-account"
                                                                                id="beneficiary-contract-account-{{$ben_key + 1}}">
                                                                            <div class="input-group">
                                                                                <input type="month" 
                                                                                    class="form-control date"
                                                                                    name="contract-account-date-{{$ben_key + 1}}"
                                                                                    id="beneficiary-contract-account-date-{{$ben_key + 1}}"
                                                                                    onkeyup="return window.validateBillDate(this)"
                                                                                    onblur="return window.validateBillDate(this)"
                                                                                    onchange="return window.validateBillDate(this)">
                                                                                <button type="submit" 
                                                                                    class="btn bg-primary text-white btn-sm"
                                                                                    id="beneficiary-btn-account-{{$ben_key + 1}}"
                                                                                    onclick="return window.getContractAccount(this, '{{$beneficiary->client->login}}', '{{$beneficiary->client->password}}', '{{$beneficiary->beneficiary_contract_account}}')"
                                                                                    disabled>
                                                                                    <i class="bi bi-download"
                                                                                        id="beneficiary-icon-file-download-{{$ben_key + 1}}"></i>
                                                                                    <div class="spinner-border spinner-border-sm text-white d-none" 
                                                                                        id="beneficiary-loading-contract-account-{{$ben_key + 1}}" role="status">
                                                                                        <span class="visually-hidden">
                                                                                            Loading...
                                                                                        </span>
                                                                                    </div>
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <a class="btn bg-primary text-white lh-1 pt-2 pb-2"
                                        data-bs-toggle="modal"
                                        data-bs-dismiss="modal"
                                        data-bs-target="#modal-beneficiary-view-{{$gen_key + 1}}">
                                        Voltar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        
        <!-- Modal Create Apportionment List -->
        @if (count($generator->beneficiary) > 0)
            <div class="modal fade text-black"
                id="modal-new-apportionment-list-{{$gen_key + 1}}"
                tabindex="-1" role="dialog" aria-hidden="true"
                aria-labelledby="modal"
                data-generator>
                <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nova Lista de Rateio</h5>
                            <button type="button" class="btn-close" 
                                data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row p-4">
                                <input type="hidden" 
                                    id="active-generator-apportionment-list-{{$gen_key + 1}}"
                                    value="{{($generator->id)}}">

                                <!-- Checkbox same active Apportionment List data -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                            <div class="spinner-border spinner-border-sm text-warning d-none ms-2 mb-1" style="margin-right: .74rem"
                                                id="loading-client-address-{{$gen_key + 1}}" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <label class="form-check-label fw-normal"
                                                style="color: #607080"
                                                for="chk-same-generator-active-apportionment-list-{{$gen_key + 1}}">
                                                Usar dados da Lista de Rateio ativa
                                            </label>
                                            <input class="form-check-input"
                                                type="checkbox"
                                                id="chk-same-generator-active-apportionment-list-{{$gen_key + 1}}"
                                                name="chk-same-generator-active-apportionment-list"
                                                value="{{old('chk-same-generator-active-apportionment-list')}}"
                                                onchange="return window.setSameActiveApportinmentListData(this)">
                                        </div>                                
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Generator client -->
                                        <div class="col-4">
                                            <input type="hidden"
                                                id="apportionment-list-generator-client-{{$gen_key + 1}}" 
                                                value="@if ($generator->client != null)
                                                    {{
                                                        $generator->client->is_corporate ? 
                                                            $generator->client->corporate_name :
                                                            $generator->client->name
                                                    }}
                                                @endif">
                                        </div>

                                        <!-- Contracted kWp generation -->
                                        <div class="col-4">
                                            <input type="hidden"
                                                id="apportionment-list-generator-contracted-generation-production-{{$gen_key + 1}}" 
                                                value="{{
                                                    number_format((($project->contract->monthly_avg_generation * 1000 / $project->contract->getGeneratorPowerValue()) * $generator->generator_power) / 1000, '2', ',', '.')
                                                }}">
                                        </div>

                                        <!-- Generator consumption -->
                                        <div class="col-4">
                                            <input type="hidden"
                                                id="apportionment-list-generator-consumption-{{$gen_key + 1}}" 
                                                value="{{
                                                    number_format($generator->generator_consumption, 2, ',', '.')
                                                }}">
                                        </div>
                                    </div>

                                    <!-- Beneficiary -->
                                    <div id="new-apportionment-list-{{$gen_key + 1}}"
                                        data-beneficiaries>
                                        <div class="accordion"
                                            id="cc-beneficiaries-{{$gen_key + 1}}">
                                            <!-- Active Apportionment List -->
                                            <form action="{{route('engineering_generator_new_apportionment_list', ['id' => encrypt($generator->id)])}}" method="POST"
                                                id="form-active-apportionment-list-{{$gen_key + 1}}"
                                                class="d-none mb-0">
                                                @csrf
                                                <div id="active-apportionment-list-{{$gen_key + 1}}"></div>
                                            </form>
                                                
                                            <!-- Create Apportionment List -->
                                            <form action="{{route('engineering_generator_new_apportionment_list', ['id' => encrypt($generator->id)])}}" method="POST"
                                                id="form-create-apportionment-list-{{$gen_key + 1}}"
                                                class="mb-0">
                                                @csrf
                                                <div id="create-apportionment-list-{{$gen_key + 1}}">
                                                    <div class="accordion-item"
                                                        id="create-beneficiary-{{$gen_key + 1}}-1" data-create-beneficiary-item>
                                                        <h2 class="accordion-header" 
                                                            id="create-beneficiary-heading-{{$gen_key + 1}}-1">
                                                            <button class="accordion-button fw-bold bg-light bg-gradient text-primary" 
                                                                type="button" 
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#create-beneficiary-collapse-{{$gen_key + 1}}-1" aria-expanded="true" aria-controls="create-beneficiary-collapse-{{$gen_key + 1}}-1">
                                                                Beneficiária 1
                                                            </button>
                                                        </h2>
                                                        <div id="create-beneficiary-collapse-{{$gen_key + 1}}-1" 
                                                            class="accordion-collapse collapse show" 
                                                            aria-labelledby="create-beneficiary-heading-{{$gen_key + 1}}-1" 
                                                            data-bs-parent="#cc-beneficiaries-{{$gen_key + 1}}">
                                                            <div class="accordion-body">
                                                                <div class="@if ($generator->generator_project_type == 'AUTOCONSUMO_REMOTO') d-none @endif"
                                                                    id="create-beneficiary-client-{{$gen_key + 1}}-1">
                                                                    <div class="row mt-3">
                                                                        <div class="col-12 mb-4">
                                                                            <div class="form-check">
                                                                                <input
                                                                                    class="form-check-input" type="checkbox"
                                                                                    id="create-chk-add-beneficiary-client-{{$gen_key + 1}}-1"
                                                                                    name="chk-add-beneficiary-client"
                                                                                    @if (old('chk-add-beneficiary-client') === 'on') checked @endif
                                                                                    onchange="return window.checkIfAddClientBeneficiary(this)">
                                                                                <label for="create-chk-add-beneficiary-client-{{$gen_key + 1}}-1"
                                                                                    class="form-check-label">
                                                                                    Cliente diferente da Geradora?
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <!-- Beneficiary Client -->
                                                                        <div class="col-12 col-md-6 mb-3 d-none"
                                                                            id="create-client-beneficiary-{{$gen_key + 1}}-1">
                                                                            <div class="form-group">
                                                                                <label for="create-project-beneficiary-client-{{$gen_key + 1}}-1"
                                                                                class="form-label">
                                                                                    Cliente
                                                                                </label>
                                                                                <input class="form-control"
                                                                                    type="text"
                                                                                    id="create-project-beneficiary-client-{{$gen_key + 1}}-1" 
                                                                                    name="beneficiaries[address-1][beneficiary-client]">
                                                                                <div class="invalid-feedback"
                                                                                    id="create-client-beneficiary-{{$gen_key + 1}}-1-feedback-project"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!--
                                                                        Beneficiary Contract Account
                                                                    -->
                                                                    <div class="col-12 col-md-6 mb-3">
                                                                        <div class="@if ($generator->project->contract->client->login != null && $generator->project->contract->client->password != null) d-none @endif"   
                                                                            id="create-beneficiary-contract-account-input-{{$gen_key + 1}}-1">
                                                                            <div class="form-group">
                                                                                <label for="create-cc-beneficiary-input-{{$gen_key + 1}}-1"
                                                                                    class="form-label">
                                                                                    Conta Contrato Beneficiária
                                                                                </label>
                                                                                <input class="form-control"
                                                                                    type="text" 
                                                                                    id="create-cc-beneficiary-input-{{$gen_key + 1}}-1"
                                                                                    name="beneficiaries[address-1][beneficiary-contract-account]"
                                                                                    onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"
                                                                                    onblur="return window.validateInput(this, 1)"
                                                                                    onkeyup="return window.validateInput(this, 1)"
                                                                                    maxlength="12"
                                                                                    data-beneficiary
                                                                                    required>
                                                                                <div class="invalid-feedback"
                                                                                    id="create-cc-beneficiary-input-{{$gen_key + 1}}-1-feedback-project"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="@if ($generator->project->contract->client->login == null && $generator->project->contract->client->password == null) d-none @endif"
                                                                            id="create-beneficiary-contract-account-select-{{$gen_key + 1}}-1">
                                                                            <div class="form-group">
                                                                                <label for="create-cc-beneficiary-select-{{$gen_key + 1}}-1"  
                                                                                    class="form-label">
                                                                                    Conta Contrato Beneficiária
                                                                                </label>
                                                                                <select class="form-select" 
                                                                                    aria-label="create-cc-beneficiary-select-{{$gen_key + 1}}-1"
                                                                                    id="create-cc-beneficiary-select-{{$gen_key + 1}}-1"
                                                                                    name="beneficiaries[address-1][beneficiary-contract-account]"
                                                                                    onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"
                                                                                    onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)"
                                                                                    required>
                                                                                    <option value="" disabled selected>
                                                                                        Selecione a conta contrato
                                                                                    </option>
                                                                                </select>
                                                                                <div class="invalid-feedback"
                                                                                    id="create-cc-beneficiary-select-{{$gen_key + 1}}-1-feedback-project"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- 
                                                                        Other beneficiary contract account
                                                                    -->
                                                                    <div class="col-12 col-md-6 mb-3 d-none"
                                                                        id="create-other-beneficiary-contract-account-{{$gen_key + 1}}-1">
                                                                        <div class="form-group">
                                                                            <label for="create-other-cc-beneficiary-{{$gen_key + 1}}-1"
                                                                                class="form-label">
                                                                                Outra Conta Contrato Beneficiária
                                                                            </label>
                                                                            <input class="form-control"
                                                                                type="text"
                                                                                id="create-other-cc-beneficiary-{{$gen_key + 1}}-1"
                                                                                name="beneficiaries[address-1][beneficiary-other-contract-account]"
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
                                                                            <label for="create-beneficiary-consumption-class-{{$gen_key + 1}}-1"
                                                                                class="form-label">
                                                                                Classe de Consumo
                                                                            </label>
                                                                            <select class="form-select"
                                                                                aria-label="create-beneficiary-consumption-class"
                                                                                id="create-beneficiary-consumption-class-{{$gen_key + 1}}-1"
                                                                                name="beneficiaries[address-1][beneficiary-consumption-class]"
                                                                                onchange="return window.validateSelect(this), window.enableBtnAddBeneficiary(this)"
                                                                                onblur="return window.validateSelect(this)"
                                                                                data-beneficiary
                                                                                required>
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
                                                                                id="create-beneficiary-consumption-class-{{$gen_key + 1}}-1-feedback-project">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Rate -->
                                                                    <div class="col-12 col-md-6 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="create-project-beneficiary-rate-{{$gen_key + 1}}-1"
                                                                                class="form-label">
                                                                                Rateio
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <input class="form-control"
                                                                                    type="text" 
                                                                                    id="create-project-beneficiary-rate-{{$gen_key + 1}}-1"
                                                                                    name="beneficiaries[address-1][beneficiary-rate]"
                                                                                    value="100"
                                                                                    onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"
                                                                                    onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                                    onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                                    data-beneficiaryrequired>
                                                                                <span class="input-group-text rounded-end">
                                                                                    %
                                                                                </span>
                                                                                <span class="input-group-text bg-secondary text-white ms-4 rounded" 
                                                                                    id="create-rate-monthly-avg-generation-{{$gen_key + 1}}-1" data-rate-monthly>
                                                                                </span>
                                                                            </div>
                                                                            <div class="invalid-feedback"
                                                                                id="create-beneficiary-rate-{{$gen_key + 1}}-1-feedback-project">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- Address -->
                                                                    <div class="col-12 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="create-beneficiary-address-{{$gen_key + 1}}-1" class="form-label">
                                                                                Endereço
                                                                            </label>
                                                                            <input class="form-control"
                                                                                type="text" 
                                                                                id="create-beneficiary-address-{{$gen_key + 1}}-1" name="beneficiaries[address-1][beneficiary-address]"
                                                                                onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"
                                                                                onblur="return window.validateInput(this, 2)"
                                                                                onkeyup="return window.validateInput(this, 2)"
                                                                                data-beneficiary
                                                                                required>
                                                                            <div class="invalid-feedback"
                                                                                id="beneficiary-address-{{$gen_key + 1}}-1-feedback-create">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button Add Beneficiary -->
                                                    <div class="row justify-content-end mt-4 mb-4">
                                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                                            <div class="form-group"> 
                                                                <button class="btn btn-warning d-flex justify-content-center align-items-center btn-add-beneficiary"
                                                                    type="button"
                                                                    id="btn-create-add-beneficiary-{{$gen_key + 1}}"
                                                                    onclick="return window.addApportionmentListBeneficiary(this)"
                                                                    disabled>
                                                                    <i class="bi bi-plus-circle-fill me-2"></i>
                                                                    Adicionar Beneficiária
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn bg-danger text-white"
                                    data-bs-toggle="modal"
                                    data-bs-dismiss="modal"
                                    data-bs-target="#modal-beneficiary-view-{{$gen_key + 1}}">
                                    Voltar
                                </a>
                                <button class="btn bg-success text-white float-end d-flex align-items-center" 
                                    type="button"
                                    id="btn-new-apportionment-list-{{$gen_key + 1}}"
                                    onclick="return window.submitFormNewApportionmentList(this)">
                                    Criar Lista de Rateio
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</x-app-layout>