@section('page_title', 'Clientes')

<script src="{{asset(mix('js/clients/list.js'))}}" defer></script>
<script>
     var url_fetch_client_contract_accounts = "{{route('clients_contract_accounts')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3>Clientes Cadastrados no Sistema</h3>
            </div>
        </div>
    </x-slot>

    <div id="client-list">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Clientes</h4>
                        <p class="card-description">
                            Por meio desta tela é possível realizar o gerenciamento de clientes
                            cadastrados no sistema.
                        </p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2 mt-3 mb-5">
                        <a href="{{route('clients_create')}}" class="btn bg-orange d-flex justify-content-center align-items-center" type="submit">
                            <i class="bi bi-person-plus-fill me-1"></i>
                            Novo Cliente
                        </a>
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
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Telefone</th>
                                <th scope="col" class="text-center">Tipo</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $key => $client)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td>
                                            {{
                                                $client->is_corporate ?
                                                    $client->corporate_name :
                                                    $client->name
                                            }}
                                        </td>
                                        <td>{{$client->email}}</td>
                                        <td class="text-center">{{$client->phone}}</td>
                                        <td class="text-center">
                                            @if ($client->is_corporate)
                                                <span class="badge bg-primary fw-bold">PESSOA JURÍDICA</span>

                                                @if ($client->ticket != null && !$client->ticket->is_contract)
                                                    <a href="{{route('tickets_edit', ['id' => encrypt($client->ticket->id)])}}" target="_blank">
                                                        <span class="badge mt-2 p-0">
                                                            <i class="bi bi-ticket-fill text-danger"
                                                                style="font-size: 1.1rem"></i>
                                                        </span>
                                                    </a>
                                                @endif
                                            @else
                                                <span class="badge bg-orange fw-bold">PESSOA FÍSICA</span>

                                                @if ($client->ticket != null && !$client->ticket->is_contract)
                                                    <a href="{{route('tickets_edit', ['id' => encrypt($client->ticket->id)])}}" target="_blank">
                                                        <span class="badge mt-2 p-0">
                                                            <i class="bi bi-ticket-fill text-danger"
                                                                style="font-size: 1.1rem"></i>
                                                        </span>
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="col col-4 ps-0 pe-0">
                                            <div class="d-flex justify-content-center">
                                                <form action="{{route('clients_edit', ['id' => encrypt($client->id)])}}"
                                                    method="GET" class="me-2 mb-0 align-self-center">
                                                    @csrf
                                                    <button class="btn bg-success text-white"
                                                        type="submit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <a class="btn bg-danger text-white me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal_delete_{{$key}}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>

                                                <form action="{{route('clients_print_power_of_attorney', ['id' => encrypt($client->id)])}}" method="POST" target="_blank"
                                                    class="align-self-center me-2 mb-0">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn bg-primary text-white btn-sm">
                                                        Procuração
                                                    </button>
                                                </form>
                                                
                                                <form action="{{route('clients_contract_accounts')}}" 
                                                    method="POST" target="_blank"
                                                    class="align-self-center me-2 mb-0"
                                                    id="form-client-contract-accounts-{{$key + 1}}"
                                                    onsubmit="return false">
                                                    @csrf
                                                    <input type="hidden" name="contract-accounts"
                                                        id="client-contract-accounts-{{$key + 1}}">
                                                    <button type="submit" class="btn bg-secondary text-white btn-sm"
                                                        onclick="return window.getClientContractAccounts(this, '{{$client->login}}', '{{$client->password}}')"
                                                        id="btn-client-contract-accounts-{{$key + 1}}"
                                                        @if ($client->login == null && $client->password == null)
                                                            disabled
                                                        @endif>
                                                        <span id="btn-text-{{$key + 1}}">Contas Energia</span>
                                                        <div class="spinner-border spinner-border-sm text-white d-none"
                                                            id="loading-contract-accounts-{{$key + 1}}"
                                                            role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @foreach($clients as $key => $client)
                    <!-- Modal Delete -->
                    <div class="modal fade" id="modal_delete_{{$key}}"
                        style="color: black"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Deletar Cliente</h5>
                                    <button type="button" class="btn-close" 
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">
                                        Você deseja deletar o cliente
                                        <span class="fw-bold">
                                            {{$client->is_corporate ?
                                                $client->corporate_name :
                                                $client->name}}    
                                        </span>?
                                    </p>
                                    <p class="mb-0">
                                        Caso o(a) cliente esteja associado(a) a um ou mais contratos, ele(a) não será excluído e uma lista com esses contratos será apresentada a seguir.
                                    </p>
                                    <p class="mb-0">
                                        <span class="text-danger">A ação não pode ser desfeita!</span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <form action="{{route('clients_destroy',['id'=>encrypt($client->id)])}}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            Deletar Cliente
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
