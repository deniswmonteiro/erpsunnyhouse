@section('page_title', 'Contratos Relacionados com o(a) Cliente')

<script src="{{asset(mix('js/clients/listClientContracts.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row mb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Contratos</h3>
            </div>
        </div>
    </x-slot>

    <div id="client-contracts-list">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-title">Editar Contratos</h4>
                        <p class="card-description">
                            Os seguintes contratos possuem relação com o(a) cliente
                            <span class="fw-bold text-primary">
                                {{$client->is_corporate ? $client->corporate_name : $client->name}}
                            </span>
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
                                    <th scope="col" class="text-center">Cliente</th>
                                    <th scope="col" class="text-center">Apelido</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Tipo</th>
                                    <th scope="col" class="text-center">Data do Contrato</th>
                                    <th scope="col" class="text-center">Valor</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contracts as $key => $contract)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>
                                            {{
                                                $contract->client->is_corporate ?
                                                    $contract->client->corporate_name :
                                                    $contract->client->name
                                            }}
                                        </td>
                                        <td>{{$contract->nickname}}</td>
                                        <td class="text-center">
                                            @switch ($contract->status)
                                                @case ("ORÇANDO")
                                                    <span class="badge bg-secondary fw-bold">
                                                        {{$contract->status}}
                                                    </span>
                                                    @break

                                                @case ("CONTRATADO")
                                                    <span class="badge bg-brown fw-bold">
                                                        {{$contract->status}}
                                                    </span>
                                                    @break
                                                
                                                @case ("ATIVO")
                                                    <span class="badge bg-info fw-bold">
                                                        {{$contract->status}}
                                                    </span>
                                                    @break

                                                @case ("PENDÊNCIA")
                                                    <span class="badge bg-danger fw-bold">
                                                        {{$contract->status}}
                                                    </span>
                                                    @break

                                                @case ("INSTALANDO")
                                                    <span class="badge bg-primary fw-bold">
                                                        {{$contract->status}}
                                                    </span>
                                                @break

                                                @case ("INSTALADO")
                                                    <span class="badge bg-warning fw-bold">
                                                        {{$contract->status}}
                                                    </span>
                                                @break

                                                @case ("CONCLUÍDO")
                                                    <span class="badge bg-success fw-bold">
                                                        {{$contract->status}}
                                                    </span>
                                                @break

                                                @case ("CANCELADO")
                                                    <span class="badge bg-black fw-bold">
                                                        {{$contract->status}}
                                                    </span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="text-center">
                                            {{($contract->type == 1) ? 'Instalação' : 'Manutenção'}}
                                        </td>
                                        <td class="text-center">{{date('d/m/Y', strToTime($contract->contract_date))}}</td>
                                        <td class="text-center">R$ {{format_money($contract->getValue())}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                @php
                                                    $contract_type = $contract->type == 1 ? 'installation' : 'maintenance';
                                                @endphp

                                                <form action="{{route('contracts_edit', ['type' => $contract_type, 'id' => encrypt($contract->id)])}}" method="GET"
                                                    class="me-2 mb-0 align-self-center">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn bg-success justify-content-center align-items-center text-white">
                                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                                    </button>
                                                </form>
                                                <a class="btn bg-danger text-white"
                                                    data-bs-toggle="modal"
                                                    data-bs-dismiss="modal"
                                                    data-bs-target="#modal-delete-{{$key}}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Delete -->
                @foreach ($contracts as $key => $contract)
                    <div class="modal fade" id="modal-delete-{{$key}}"
                        style="color: black"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Deletar Contrato</h5>
                                    <button type="button" 
                                        class="btn-close" 
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <span class="d-block">
                                        Você deseja excluir o contrato do(a) cliente
                                        <span class="fw-bold">
                                            {{
                                                $contract->client->is_corporate ?
                                                    $contract->client->corporate_name :
                                                    $contract->client->name
                                            }}
                                        </span>
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
                                    <form action="{{route('contracts_destroy', ['id' => encrypt($contract->id)])}}"
                                        method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-danger">
                                            Deletar Contrato
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
