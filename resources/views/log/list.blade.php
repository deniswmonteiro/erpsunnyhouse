@section('page_title', 'Logs')

<script src="{{asset(mix('js/logs/list.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Lista de Logs do Sistema</h3>
            </div>
        </div>
    </x-slot>

    <div id="log-list">
        <div class="card">
            <div class="card-header">
                <div class="row mb-5">
                    <div class="col-12 col-md-8 col-lg-11">
                        <h4 class="card-title">Ver Logs</h4>
                        <p class="card-description">
                            Acompanhar fluxo de ações dentro do sistema.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Usuário</th>
                                    <th scope="col" class="text-center">Categoria</th>
                                    <th scope="col" class="text-center">Título</th>
                                    <th scope="col" class="text-center">IP</th>
                                    <th scope="col" class="text-center">DATA</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $key =>  $log)
                                    <tr>
                                        <td class="text-center">
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {{$log->user->name}}
                                        </td>
                                        <td class="text-center">
                                            @switch ($log->category)
                                                @case ("USUARIO")
                                                    <span class="badge bg-yellow fw-bold">
                                                        USUÁRIO
                                                    </span>
                                                    @break

                                                @case ("CLIENTE")
                                                    <span class="badge bg-brown fw-bold">
                                                        {{$log->category}}
                                                    </span>
                                                    @break
                                            
                                                @case ("VENDEDOR")
                                                    <span class="badge bg-info fw-bold">
                                                        {{$log->category}}
                                                    </span>
                                                    @break

                                                @case ("CONTRATO")
                                                    <span class="badge bg-primary fw-bold">
                                                        {{$log->category}}
                                                    </span>
                                                    @break

                                                @case ("BANCO")
                                                    <span class="badge bg-warning fw-bold">
                                                        {{$log->category}}
                                                    </span>
                                                    @break

                                                @case ("EQUIPAMENTO")
                                                    <span class="badge bg-success fw-bold">
                                                        {{$log->category}}
                                                    </span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            {{$log->title}}
                                        </td>
                                        <td class="text-center">
                                            {{$log->ip}}
                                        </td>
                                        <td class="text-center">
                                            {{$log->created_at->format('d/m/Y H:i:s')}}
                                        </td>
                                        <td class="text-center">
                                            <a class="mt-auto btn bg-orange m-auto text-white"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-show-{{$key}}">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Show -->
            @foreach ($logs as $key => $log)
                <div class="modal fade text-black" id="modal-show-{{$key}}"
                    tabindex="-1" role="dialog"
                    aria-hidden="true"
                    aria-labelledby="modal">
                    <div class="modal-dialog"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detalhes do Log</h5>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-primary fw-bold">{{$log->title}}</p>
                                {!! $log->message !!}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
