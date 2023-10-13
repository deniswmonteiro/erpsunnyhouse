@section('page_title', 'Projetos de Engenharia')

<script src="{{asset(mix('js/engineering/list.js'))}}" defer></script>
<script>
    var url_generator_save_protocol = "{{route('engineering_protocol_fetch')}}";
    
    // REMOVER
    var url_fetch_migrate_generator_document = "{{route('engineering_migrate_generator_document_fetch')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Engenharia</h3>
            </div>
        </div>
    </x-slot>

    <div id="engineering-list">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Projetos</h4>
                        <p class="card-description">
                            Por meio desta tela é possível visualizar os projetos de engenharia registrados no sistema.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div>
                    <form action="{{route('engineering_project_search')}}"
                        method="POST"
                        id="form-search-engineering-project">
                        @csrf

                        <!-- Year -->
                        <div class="row">
                            <div class="col-12 col-md-4 mt-3 mb-5">
                                <div class="form-group">
                                    <label for="engineering-project-search" class="form-label">
                                        Buscar por ano
                                    </label>
                                    <div class="input-group">
                                        <select class="form-select" aria-label="engineering-project-search"
                                            id="engineering-project-search"
                                            name="engineering-project-search">
                                            <option value="" disabled selected>
                                                Selecione o ano do projeto
                                            </option>

                                            @foreach ($years as $year)
                                                <option value="{{$year}}" @if ($year == $search_year) selected @endif>
                                                    {{$year}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary rounded-end" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4" style="width: 100%" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Data de Criação</th>
                                    <th scope="col" class="text-center">Cliente</th>
                                    <th scope="col" class="text-center">Apelido</th>
                                    <th scope="col" class="text-center">Conta Contrato/Status da Geradora</th>
                                    <th scope="col" class="text-center">Protocolos</th>
                                    <th scope="col" class="text-center">Data do Contrato</th>
                                    <th scope="col" class="text-center">Potência do Gerador</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $key => $project)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td>{{$project->created_at->format('d/m/Y')}}</td>
                                        <td>
                                            {{
                                                $project->contract->client->is_corporate ?
                                                    $project->contract->client->corporate_name :
                                                    $project->contract->client->name
                                            }}

                                            {{ 
                                                $project->contract->nickname ?
                                                    '(' . $project->contract->nickname . ')' :
                                                    ''
                                            }}
                                        </td>
                                        <td>{{$project->contract->nickname}}</td>
                                        <td class="status position-relative">
                                            @foreach ($project->generator as $gen_key => $generator)
                                                @switch ($generator->generator_status)
                                                    @case ("ATIVO")
                                                        <p class="mb-1 pt-1 pb-1">
                                                            <span class="me-2">
                                                                CC {{$generator->generator_contract_account}}
                                                            </span>
                                                            <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                <span class="badge fw-bold bg-yellow"
                                                                    id="protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                    {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                </span>
                                                            </a>
                                                        </p>
                                                        @break

                                                    @case ("SUBMETIDO")
                                                        @if ($generator->submission != null)
                                                            @if (strtotime(date('Y-m-d', strtotime('+3 days', strtotime($generator->submission->protocol_date)))) < strtotime(date('Y-m-d')))
                                                                <p class="mb-1 pt-1 pb-1">
                                                                    <span class="me-2">
                                                                        CC {{$generator->generator_contract_account}}
                                                                    </span>
                                                                    <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                        <span class="badge fw-bold bg-danger"
                                                                            id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="right" 
                                                                            data-html="true"
                                                                            title="@include ('engineering.tooltipProtocolNumber')">
                                                                            {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                        </span>
                                                                    </a>
                                                                </p>

                                                            @else
                                                                <p class="mb-1 pt-1 pb-1">
                                                                    <span class="me-2">
                                                                        CC {{$generator->generator_contract_account}}
                                                                    </span>
                                                                    <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                        <span class="badge fw-bold bg-brown"
                                                                            id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="right" 
                                                                            data-html="true"
                                                                            title="@include ('engineering.tooltipProtocolNumber')">
                                                                            {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                        </span>
                                                                    </a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                        @break
                                            
                                                    @case ("PROTOCOLADO")
                                                        @if ($generator->feedback != null)
                                                            @if (strtotime(date('Y-m-d', strtotime('+15 days', strtotime($generator->feedback->protocol_date)))) < strtotime(date('Y-m-d')))
                                                                <p class="mb-1 pt-1 pb-1">
                                                                    <span class="me-2">
                                                                        CC {{$generator->generator_contract_account}}
                                                                    </span>
                                                                    <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                        <span class="badge fw-bold bg-danger"
                                                                            id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="right" 
                                                                            data-html="true"
                                                                            title="@include ('engineering.tooltipProtocolNumber')">
                                                                            {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                        </span>
                                                                    </a>
                                                                </p>
                                                        
                                                            @else
                                                                <p class="mb-1 pt-1 pb-1">
                                                                    <span class="me-2">
                                                                        CC {{$generator->generator_contract_account}}
                                                                    </span>
                                                                    <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                        <span class="badge fw-bold bg-info"
                                                                            id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="right" 
                                                                            data-html="true"
                                                                            title="@include ('engineering.tooltipProtocolNumber')">
                                                                            {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                        </span>
                                                                    </a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                        @break

                                                    @case ("PARECER_EMITIDO")
                                                        <p class="mb-1 pt-1 pb-1">
                                                            <span class="me-2">
                                                                CC {{$generator->generator_contract_account}}
                                                            </span>
                                                            <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                <span class="badge fw-bold bg-indigo"
                                                                    id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                    data-bs-toggle="tooltip" 
                                                                    data-bs-placement="right" 
                                                                    data-html="true"
                                                                    title="@include ('engineering.tooltipProtocolNumber')">
                                                                    {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                </span>
                                                            </a>
                                                        </p>
                                                        @break

                                                    @case ("VISTORIA_PROVISORIA")
                                                        @if ($generator->provisional != null)
                                                            @if (strtotime(date('Y-m-d', strtotime('+3 days', strtotime($generator->provisional->protocol_date)))) < strtotime(date('Y-m-d')))
                                                                <p class="mb-1 pt-1 pb-1">
                                                                    <span class="me-2">
                                                                        CC {{$generator->generator_contract_account}}
                                                                    </span>
                                                                    <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                        <span class="badge fw-bold bg-danger"
                                                                            id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="right" 
                                                                            data-html="true"
                                                                            title="@include ('engineering.tooltipProtocolNumber')">
                                                                            {{Str::replaceFirst('_', ' ', 'VISTORIA_PROVISÓRIA')}}
                                                                        </span>
                                                                    </a>
                                                                </p>
                                                       
                                                             @else
                                                                <p class="mb-1 pt-1 pb-1">
                                                                    <span class="me-2">
                                                                        CC {{$generator->generator_contract_account}}
                                                                    </span>
                                                                    <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                        <span class="badge fw-bold bg-warning"
                                                                            id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="right" 
                                                                            data-html="true"
                                                                            title="@include ('engineering.tooltipProtocolNumber')">
                                                                            {{Str::replaceFirst('_', ' ', 'VISTORIA_PROVISÓRIA')}}
                                                                        </span>
                                                                    </a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                        @break

                                                    @case ("VISTORIA")
                                                        @if ($generator->survey != null)
                                                            @if (strtotime(date('Y-m-d', strtotime('+7 days', strtotime($generator->survey->protocol_date)))) < strtotime(date('Y-m-d')))
                                                                <p class="mb-1 pt-1 pb-1">
                                                                    <span class="me-2">
                                                                        CC {{$generator->generator_contract_account}}
                                                                    </span>
                                                                    <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                        <span class="badge fw-bold bg-danger"
                                                                            id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="right" 
                                                                            data-html="true"
                                                                            title="@include ('engineering.tooltipProtocolNumber')">
                                                                            {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                        </span>
                                                                    </a>
                                                                </p>
                                                            
                                                            @else
                                                                <p class="mb-1 pt-1 pb-1">
                                                                    <span class="me-2">
                                                                        CC {{$generator->generator_contract_account}}
                                                                    </span>
                                                                    <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                        <span class="badge fw-bold bg-primary"
                                                                            id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="right" 
                                                                            data-html="true"
                                                                            title="@include ('engineering.tooltipProtocolNumber')">
                                                                            {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                        </span>
                                                                    </a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                        @break

                                                    @case ("HOMOLOGADO")
                                                        <p class="mb-1 pt-1 pb-1">
                                                            <span class="me-2">
                                                                CC {{$generator->generator_contract_account}}
                                                            </span>
                                                            <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                <span class="badge fw-bold bg-teal"
                                                                    id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                    data-bs-toggle="tooltip" 
                                                                    data-bs-placement="right" 
                                                                    data-html="true"
                                                                    title="@include ('engineering.tooltipProtocolNumber')">
                                                                    {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                    <i class="bi bi-pencil-fill d-none"></i>
                                                                </span>
                                                            </a>
                                                        </p>
                                                        @break

                                                    @case ("CONCLUÍDO")
                                                        <p class="mb-1 pt-1 pb-1">
                                                            <span class="me-2">
                                                                CC {{$generator->generator_contract_account}}
                                                            </span>
                                                            <a href="#" id="protocol-link-{{$key + 1}}-{{$gen_key + 1}}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}">
                                                                <span class="badge fw-bold bg-success"
                                                                    id="protocol-{{$key + 1}}-{{$gen_key + 1}}"
                                                                    data-bs-toggle="tooltip" 
                                                                    data-bs-placement="right" 
                                                                    data-html="true"
                                                                    title="@include ('engineering.tooltipProtocolNumber')">
                                                                    {{Str::replaceFirst('_', ' ', $generator->generator_status)}}
                                                                </span>
                                                            </a>
                                                        </p>
                                                        @break
                                                @endswitch
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($project->generator as $generator)
                                                @if ($generator->submission != null)
                                                    {{$generator->submission->protocol_number}}
                                                @endif

                                                @if ($generator->feedback != null)
                                                    {{$generator->feedback->protocol_number}}
                                                @endif

                                                @if ($generator->issued != null)
                                                    {{$generator->issued->protocol_number}}
                                                @endif

                                                @if ($generator->provisional != null)
                                                    {{$generator->provisional->protocol_number}}
                                                @endif

                                                @if ($generator->survey != null)
                                                    {{$generator->survey->protocol_number}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            {{date('d/m/Y', strToTime($project->contract->contract_date))}}
                                        </td>
                                        <td class="text-center">
                                            {{
                                                number_format($project->contract->getGeneratorPowerValue() / 1000, '2', ',', '.')
                                            }} kWp
                                        </td>
                                        {{-- <td class="text-center"> --}}
                                        <td class="text-center d-flex flex-column align-items-center">
                                            <form method="GET"
                                                action="{{route('engineering_project_show', ['id' => encrypt($project->id)])}}"
                                                {{-- class="me-2 mb-0 align-self-center"> --}}
                                                class="mb-2 align-self-center">
                                                <button type="submit"
                                                    class="btn bg-success justify-content-center align-items-center text-white">
                                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                                </button>
                                            </form>

                                            <!-- REMOVER -->
                                            <!-- Migrar documentos antigos para tabelas novas -->
                                            <a href="#" 
                                                id="btn-migrate-documents-{{$key + 1}}"
                                                class="btn bg-warning text-white @if ($generator->document == null || ($generator->document_art != null && $generator->document_certificates != null && $generator->document_memorial != null && $generator->document_electrical != null)) disabled @endif"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-migrate-documents-{{$key + 1}}">
                                                <i class="bi bi-arrow-left-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- REMOVER -->
                <!-- Modal Migrate Documents -->
                @foreach ($projects as $key => $project)
                    <div class="modal fade text-black"
                        id="modal-migrate-documents-{{$key + 1}}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Migrar Documentos</h5>
                                    <button type="button" 
                                        class="btn-close" 
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($project->generator as $gen_key => $generator)
                                        @if ($generator->document != null)
                                            <div class="card pt-3">
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="bg-primary rounded-top p-3">
                                                            <h5 class="card-title text-white mb-0">
                                                                Geradora {{$gen_key + 1}} &ndash; CC {{$generator->generator_contract_account}}
                                                            </h5>
                                                        </div>
                                                        <ol class="list-group pe-0">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Formulário de Solicitação de Acesso
                                                                    </div>
                                                                    <p class="mb-0">
                                                                        <span class="text-primary">
                                                                            Arquivo Salvo:
                                                                        </span>
                                                                        {{$generator->document->file_access_request_form_name}}
                                                                    </p>
                                                                </div>

                                                                @if ($generator->document_request == null)
                                                                    <form action="{{route('engineering_migrate_generator_document_fetch', ['id' => encrypt($generator->id), 'type' => encrypt('request')])}}" method="POST"
                                                                        id="form-migrate-document-request-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        class="mb-0"
                                                                        onsubmit="return false">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            name="generator-id"
                                                                            id="generator-id-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt($generator->id)}}">
                                                                        <input type="hidden"
                                                                            name="document-type"
                                                                            id="generator-document-request-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt('request')}}">
                                                                        <button type="submit" class="btn btn-success"
                                                                            id="btn-migrate-document-request-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            onclick="return window.formSubmitMigrateDocument('form-migrate-document-request-{{$key + 1}}-{{$gen_key + 1}}')">
                                                                            <i class="bi bi-save-fill"></i>

                                                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                                                id="btn-migrate-document-request-loading-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                role="status">
                                                                                <span class="visually-hidden">Loading...</span>
                                                                            </div>
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <button type="button" class="btn btn-success"
                                                                        disabled>
                                                                        <i class='bi bi-check-circle-fill'></i>
                                                                    </button>
                                                                @endif
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">ART</div>
                                                                    <p class="mb-0">
                                                                        <span class="text-primary">
                                                                            Arquivo Salvo:
                                                                        </span>
                                                                        {{$generator->document->file_art_name}}
                                                                    </p>
                                                                </div>

                                                                @if ($generator->document_art == null)
                                                                    <form action="{{route('engineering_migrate_generator_document_fetch', ['id' => encrypt($generator->id), 'type' => encrypt('art')])}}" method="POST"
                                                                        id="form-migrate-document-art-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        class="mb-0"
                                                                        onsubmit="return false">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            name="generator-id"
                                                                            id="generator-id-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt($generator->id)}}">
                                                                        <input type="hidden"
                                                                            name="document-type"
                                                                            id="generator-document-art-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt('art')}}">
                                                                        <button type="submit" class="btn btn-success"
                                                                            id="btn-migrate-document-art-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            onclick="return window.formSubmitMigrateDocument('form-migrate-document-art-{{$key + 1}}-{{$gen_key + 1}}')">
                                                                            <i class="bi bi-save-fill"></i>

                                                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                                                id="btn-migrate-document-art-loading-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                role="status">
                                                                                <span class="visually-hidden">Loading...</span>
                                                                            </div>
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <button type="button" class="btn btn-success"
                                                                        disabled>
                                                                        <i class='bi bi-check-circle-fill'></i>
                                                                    </button>
                                                                @endif
                                                            </li>

                                                            @if ($generator->document->file_aneel_form_name != null)
                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                    <div class="ms-2 me-auto">
                                                                        <div class="fw-bold">ANEEL</div>
                                                                        <p class="mb-0">
                                                                            <span class="text-primary">
                                                                                Arquivo Salvo:
                                                                            </span>

                                                                            @if ($generator->document->file_aneel_form_name == null)
                                                                                &ndash;
                                                                            @else
                                                                                {{$generator->document->file_aneel_form_name}}
                                                                            @endif
                                                                        </p>
                                                                    </div>

                                                                    @if ($generator->document_aneel == null)
                                                                        <form action="{{route('engineering_migrate_generator_document_fetch', ['id' => encrypt($generator->id), 'type' => encrypt('aneel')])}}"" method="POST"
                                                                            id="form-migrate-document-aneel-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            class="mb-0"
                                                                            onsubmit="return false">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                name="generator-id"
                                                                                id="generator-id-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                value="{{encrypt($generator->id)}}">
                                                                            <input type="hidden"
                                                                                name="document-type"
                                                                                id="generator-document-aneel-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                value="{{encrypt('aneel')}}">
                                                                            <button type="submit" class="btn btn-success"
                                                                                id="btn-migrate-document-aneel-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                onclick="return window.formSubmitMigrateDocument('form-migrate-document-aneel-{{$key + 1}}-{{$gen_key + 1}}')">
                                                                                <i class="bi bi-save-fill"></i>

                                                                                <div class="spinner-border spinner-border-sm text-white d-none"
                                                                                    id="btn-migrate-document-aneel-loading-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                    role="status">
                                                                                    <span class="visually-hidden">Loading...</span>
                                                                                </div>
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <button type="button" class="btn btn-success"
                                                                            disabled>
                                                                            <i class='bi bi-check-circle-fill'></i>
                                                                        </button>
                                                                    @endif
                                                                </li>
                                                            @endif
                                                            
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">Folha de Dados e Certificados</div>
                                                                    <p class="mb-0">
                                                                        <span class="text-primary">
                                                                            Arquivo Salvo:
                                                                        </span>
                                                                        {{$generator->document->file_data_sheet_certificates_name}}
                                                                    </p>
                                                                </div>
                                                                @if ($generator->document_certificates == null)
                                                                    <form action="{{route('engineering_migrate_generator_document_fetch', ['id' => encrypt($generator->id), 'type' => encrypt('certificates')])}}"" method="POST"
                                                                        id="form-migrate-document-certificates-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        class="mb-0"
                                                                        onsubmit="return false">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            name="generator-id"
                                                                            id="generator-id-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt($generator->id)}}">
                                                                        <input type="hidden"
                                                                            name="document-type"
                                                                            id="generator-document-certificates-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt('certificates')}}">
                                                                        <button type="submit" class="btn btn-success"
                                                                            id="btn-migrate-document-certificates-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            onclick="return window.formSubmitMigrateDocument('form-migrate-document-certificates-{{$key + 1}}-{{$gen_key + 1}}')">
                                                                            <i class="bi bi-save-fill"></i>

                                                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                                                id="btn-migrate-document-certificates-loading-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                role="status">
                                                                                <span class="visually-hidden">Loading...</span>
                                                                            </div>
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <button type="button" class="btn btn-success"
                                                                        disabled>
                                                                        <i class='bi bi-check-circle-fill'></i>
                                                                    </button>
                                                                @endif
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">Memorial Descritivo</div>
                                                                    <p class="mb-0">
                                                                        <span class="text-primary">
                                                                            Arquivo Salvo:
                                                                        </span>
                                                                        {{$generator->document->file_descriptive_memorial_name}}
                                                                    </p>
                                                                </div>

                                                                @if ($generator->document_memorial == null)
                                                                    <form action="{{route('engineering_migrate_generator_document_fetch', ['id' => encrypt($generator->id), 'type' => encrypt('memorial')])}}"" method="POST"
                                                                        id="form-migrate-document-memorial-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        class="mb-0"
                                                                        onsubmit="return false">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            name="generator-id"
                                                                            id="generator-id-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt($generator->id)}}">
                                                                        <input type="hidden"
                                                                            name="document-type"
                                                                            id="generator-document-memorial-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt('memorial')}}">
                                                                        <button type="submit" class="btn btn-success"
                                                                            id="btn-migrate-document-memorial-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            onclick="return window.formSubmitMigrateDocument('form-migrate-document-memorial-{{$key + 1}}-{{$gen_key + 1}}')">
                                                                            <i class="bi bi-save-fill"></i>

                                                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                                                id="btn-migrate-document-memorial-loading-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                role="status">
                                                                                <span class="visually-hidden">Loading...</span>
                                                                            </div>
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <button type="button" class="btn btn-success"
                                                                        disabled>
                                                                        <i class='bi bi-check-circle-fill'></i>
                                                                    </button>
                                                                @endif
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">Projeto Elétrico</div>
                                                                    <p class="mb-0">
                                                                        <span class="text-primary">
                                                                            Arquivo Salvo:
                                                                        </span>
                                                                        {{$generator->document->file_electrical_project_name}}
                                                                    </p>
                                                                </div>

                                                                @if ($generator->document_electrical == null)
                                                                    <form action="{{route('engineering_migrate_generator_document_fetch', ['id' => encrypt($generator->id), 'type' => encrypt('electrical')])}}"" method="POST"
                                                                        id="form-migrate-document-electrical-{{$key + 1}}-{{$gen_key + 1}}"
                                                                        class="mb-0"
                                                                        onsubmit="return false">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            name="generator-id"
                                                                            id="generator-id-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt($generator->id)}}">
                                                                        <input type="hidden"
                                                                            name="document-type"
                                                                            id="generator-document-electrical-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            value="{{encrypt('electrical')}}">
                                                                        <button type="submit" class="btn btn-success"
                                                                            id="btn-migrate-document-electrical-{{$key + 1}}-{{$gen_key + 1}}"
                                                                            onclick="return window.formSubmitMigrateDocument('form-migrate-document-electrical-{{$key + 1}}-{{$gen_key + 1}}')">
                                                                            <i class="bi bi-save-fill"></i>

                                                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                                                id="btn-migrate-document-electrical-loading-{{$key + 1}}-{{$gen_key + 1}}"
                                                                                role="status">
                                                                                <span class="visually-hidden">Loading...</span>
                                                                            </div>
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <button type="button" class="btn btn-success"
                                                                        disabled>
                                                                        <i class='bi bi-check-circle-fill'></i>
                                                                    </button>
                                                                @endif
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal Edit Protocol -->
                @foreach ($projects as $key => $project)
                    @foreach ($project->generator as $gen_key => $generator)
                        <div class="modal fade text-black" id="modal-edit-protocol-{{$key + 1}}-{{$gen_key + 1}}"
                            tabindex="-1" role="dialog" aria-hidden="true"
                            aria-labelledby="modal">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Protocolo</h5>
                                        <button type="button" 
                                            class="btn-close" 
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body pt-0">
                                        <div class="row pt-3">
                                            <div class="col-12 pb-3">
                                                <div class="form-group">
                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="nav flex-column nav-pills col-5" 
                                                            id="v-pills-tab-{{$key + 1}}-{{$gen_key + 1}}" 
                                                            role="tablist" 
                                                            aria-orientation="vertical">
                                                            <!-- Submission -->
                                                            <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'ATIVO' || $generator->generator_status == 'SUBMETIDO') active @endif" 
                                                                id="tab-protocol-submission-{{$key + 1}}-{{$gen_key + 1}}" 
                                                                data-bs-toggle="pill"
                                                                data-bs-target="#protocol-submission-{{$key + 1}}-{{$gen_key + 1}}" 
                                                                role="tab"
                                                                aria-controls="protocol-submission-{{$key + 1}}-{{$gen_key + 1}}" 
                                                                aria-selected="true">
                                                                1 - Submissão de Projeto
                                                            </button>

                                                            <!-- Feedback -->
                                                            <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'PROTOCOLADO') active @endif"
                                                                id="tab-protocol-feedback-{{$key + 1}}-{{$gen_key + 1}}" 
                                                                data-bs-toggle="pill"
                                                                data-bs-target="#protocol-feedback-{{$key + 1}}-{{$gen_key + 1}}"
                                                                role="tab" 
                                                                aria-controls="protocol-feedback-{{$key + 1}}-{{$gen_key + 1}}"
                                                                aria-selected="true">
                                                                2 - Solicitação de Parecer
                                                            </button>

                                                            <!-- Issued -->
                                                            <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'PARECER_EMITIDO') active @endif"
                                                                id="tab-protocol-issued-{{$key + 1}}-{{$gen_key + 1}}"
                                                                data-bs-toggle="pill"
                                                                data-bs-target="#protocol-issued-{{$key + 1}}-{{$gen_key + 1}}"
                                                                role="tab"
                                                                aria-controls="protocol-issued-{{$key + 1}}-{{$gen_key + 1}}" 
                                                                aria-selected="true">
                                                                3 - Parecer Emitido
                                                            </button>

                                                            <!-- Provisional -->
                                                            <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'VISTORIA_PROVISORIA') active @endif"
                                                                id="tab-protocol-provisional-{{$key + 1}}-{{$gen_key + 1}}"
                                                                data-bs-toggle="pill"
                                                                data-bs-target="#protocol-provisional-{{$key + 1}}-{{$gen_key + 1}}"
                                                                role="tab"
                                                                aria-controls="protocol-provisional-{{$key + 1}}-{{$gen_key + 1}}"
                                                                aria-selected="true">
                                                                4 - Vistoria Provisória
                                                            </button>

                                                            <!-- Survey -->
                                                            <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'VISTORIA' || $generator->generator_status == 'CONCLUÍDO') active @endif"
                                                                id="tab-protocol-survey-{{$key + 1}}-{{$gen_key + 1}}" 
                                                                data-bs-toggle="pill"
                                                                data-bs-target="#protocol-survey-{{$key + 1}}-{{$gen_key + 1}}"
                                                                role="tab" 
                                                                aria-controls="protocol-survey-{{$key + 1}}-{{$gen_key + 1}}"
                                                                aria-selected="true">
                                                                5 - Vistoria
                                                            </button>

                                                            <!-- Homologated -->
                                                            <button type="button" class="nav-link text-start shadow-none @if ($generator->generator_status == 'HOMOLOGADO') active @endif"
                                                                id="tab-protocol-survey-{{$key + 1}}-{{$gen_key + 1}}" 
                                                                data-bs-toggle="pill"
                                                                data-bs-target="#protocol-homologated-{{$key + 1}}-{{$gen_key + 1}}"
                                                                role="tab" 
                                                                aria-controls="protocol-homologated-{{$key + 1}}-{{$gen_key + 1}}"
                                                                aria-selected="true">
                                                                6 - Homologado
                                                            </button>
                                                        </div>
                                                        <div class="tab-content col-7" id="v-pills-tabContent-{{$key + 1}}-{{$gen_key + 1}}">
                                                            <!-- Submission -->
                                                            <div class="tab-pane fade show ps-5 @if ($generator->generator_status == 'ATIVO' || $generator->generator_status == 'SUBMETIDO') active @endif" 
                                                                id="protocol-submission-{{$key + 1}}-{{$gen_key + 1}}" role="tabpanel" aria-labelledby="tab-protocol-submission-{{$key + 1}}-{{$gen_key + 1}}">
                                                                @include('engineering.updateProtocol', [
                                                                    'type' => 'submission'
                                                                ])
                                                            </div>
                        
                                                            <!-- Feedback -->
                                                            <div class="tab-pane fade show ps-5 @if ($generator->generator_status == 'PROTOCOLADO') active @endif" 
                                                                id="protocol-feedback-{{$key + 1}}-{{$gen_key + 1}}" role="tabpanel"
                                                                aria-labelledby="tab-protocol-feedback-{{$key + 1}}-{{$gen_key + 1}}">
                                                                @include('engineering.updateProtocol', [
                                                                    'type' => 'feedback'
                                                                ])
                                                            </div>
                        
                                                            <!-- Issued -->
                                                            <div class="tab-pane fade show ps-5 @if ($generator->generator_status == 'PARECER_EMITIDO') active @endif" 
                                                                id="protocol-issued-{{$key + 1}}-{{$gen_key + 1}}" role="tabpanel"
                                                                aria-labelledby="tab-protocol-issued-{{$key + 1}}-{{$gen_key + 1}}">
                                                                @include('engineering.updateProtocol', [
                                                                    'type' => 'issued'
                                                                ])
                                                            </div>
                        
                                                            <!-- Provisional -->
                                                            <div class="tab-pane fade show ps-5 @if ($generator->generator_status == 'VISTORIA_PROVISORIA') active @endif"
                                                                id="protocol-provisional-{{$key + 1}}-{{$gen_key + 1}}" role="tabpanel" aria-labelledby="tab-protocol-provisional-{{$key + 1}}-{{$gen_key + 1}}">
                                                                @include('engineering.updateProtocol', [
                                                                    'type' => 'provisional'
                                                                ])
                                                            </div>
                        
                                                            <!-- Survey -->
                                                            <div class="tab-pane fade show ps-5 @if ($generator->generator_status == 'VISTORIA' || $generator->generator_status == 'CONCLUÍDO') active @endif" 
                                                                id="protocol-survey-{{$key + 1}}-{{$gen_key + 1}}" role="tabpanel"
                                                                aria-labelledby="tab-protocol-survey-{{$key + 1}}-{{$gen_key + 1}}">
                                                                @include('engineering.updateProtocol', [
                                                                    'type' => 'survey'
                                                                ])
                                                            </div>

                                                            <!-- Homologated -->
                                                            <div class="tab-pane fade show ps-5 @if ($generator->generator_status == 'HOMOLOGADO') active @endif" 
                                                                id="protocol-homologated-{{$key + 1}}-{{$gen_key + 1}}" role="tabpanel"
                                                                aria-labelledby="tab-protocol-homologated-{{$key + 1}}-{{$gen_key + 1}}">
                                                                @include('engineering.updateProtocol', [
                                                                    'type' => 'homologated'
                                                                ])
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>