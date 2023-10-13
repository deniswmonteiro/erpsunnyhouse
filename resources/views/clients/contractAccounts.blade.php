@section('page_title', 'Visualizar Faturas')

<script src="{{asset(mix('js/clients/contractAccounts.js'))}}" defer></script>
<script>
    var billContractAccounts = @json($bill_contract_accounts);
    var arrContractAccounts = [];
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3>Conta Contrato</h3>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Visualizar Faturas</h4>
                        <p class="card-description">
                            Por meio desta página é possível acessar as faturas da(s) conta(s) contrato do cliente
                            junto à Equatorial Pará.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="mt-3 mb-4">
                        <p class="mb-0">
                            <span class="fw-bold">Cliente:</span> {{$client_data->firstName}} {{$client_data->lastName}}
                        </p>
                        <p>
                            <span class="fw-bold">Quantidade de Contas Contrato:</span>
                            {{$client_data->accountContractsCount}}
                        </p>
                        <p>
                            <button type="button"
                                class="btn bg-warning text-white lh-1 pt-2 pb-2"
                                id="open-modal-client-bills"
                                data-bs-toggle="modal"
                                data-bs-dismiss="modal"
                                data-bs-target="#modal-show-client-bills">
                                Faturas Salvas
                                <i class="bi bi-file-earmark-pdf ms-2"></i>
                            </button>
                        </p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Conta Contrato</th>
                                    <th scope="col" class="text-center">Endereço</th>
                                    <th scope="col" class="text-center">Bairro</th>
                                    <th scope="col" class="text-center">Cidade</th>
                                    <th scope="col" class="text-center">Número de Instalação</th>
                                    <th scope="col" class="text-center">Visualizar Fatura</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($client_data->accountContracts as $key => $account)
                                    <tr id="contract-account-info-{{$key + 1}}">
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">{{$account->Numero}}</td>
                                        <td>{{$account->Endereco}}</td>
                                        <td>{{$account->Bairro}}</td>
                                        <td>{{$account->Cidade}}</td>
                                        <td class="text-center">{{$account->NumeroInstalacao}}</td>
                                        <td>
                                            <form method="POST" enctype="multipart/form-data" action="{{route('clients_contract_bill', ['id' => encrypt($account->Numero)])}}" 
                                                target="_blank"
                                                class="align-self-center me-2 mb-0"
                                                id="contract-account-bill-{{$key + 1}}"
                                                onsubmit="return false">
                                                @csrf
                                                <input type="hidden" name="contract-account"
                                                    id="contract-account-{{$key + 1}}">
                                                <div class="input-group">
                                                    <input type="month" class="form-control date"
                                                        name="contract-account-date-{{$key + 1}}"
                                                        id="contract-account-date-{{$key + 1}}"
                                                        onkeyup="return window.validateBillDate(this)"
                                                        onblur="return window.validateBillDate(this)"
                                                        onchange="return window.validateBillDate(this)">
                                                    <button type="submit" class="btn bg-primary text-white btn-sm"
                                                        id="btn-account-{{$key + 1}}"
                                                        onclick="return window.getContractAccount(this, '{{$client_data->login}}', '{{$client_data->password}}', '{{$account->Numero}}')"
                                                        disabled>
                                                        <i class="bi bi-download"
                                                            id="icon-file-download-{{$key + 1}}"></i>
                                                        <div class="spinner-border spinner-border-sm text-white d-none " id="loading-contract-account-{{$key + 1}}" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </button>
                                                </div>
                                            </form>
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

    <!-- Modal Show Client Bills -->
    <div class="modal fade text-black" id="modal-show-client-bills"
        tabindex="-1" role="dialog" aria-hidden="true"
        aria-labelledby="modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Faturas Salvas
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body pb-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Conta Contrato</th>
                                        <th scope="col" class="text-center">Mês de Referência</th>
                                        <th scope="col" class="text-center">Ação</th>
                                    </tr>
                                </thead>
                                <tbody class="border-1">
                                    @foreach ($client as $c)
                                        <script>
                                            var clientContractAccounts = @json(count($c->contract_accounts));

                                            if (clientContractAccounts === 1) {
                                                arrContractAccounts.push(@json($c->contract_accounts));
                                            }
                                        </script>

                                        @foreach ($c->contract_accounts as $key => $contract_account)
                                            <tr>
                                                <th scope="row" class="text-center">{{$key + 1}}</th>
                                                <td class="text-center">
                                                    {{$contract_account->contract_account_number}}
                                                </td>
                                                <td class="text-center">
                                                    {{date('m/Y', strToTime($contract_account->account_month))}}
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{route('clients_destroy_bill', ['id' => encrypt($contract_account->id)])}}" 
                                                        method="POST" class="mb-0"
                                                        id="form-client-delete-bill-{{$key + 1}}"
                                                        onsubmit="return false">
                                                        @csrf
                                                        <input type="hidden"
                                                            name="contract-accounts"
                                                            id="client-contract-accounts-{{$key + 1}}">
                                                        <button type="submit"
                                                            class="btn bg-danger text-white"
                                                            onclick="return window.deleteClientContractAccountBill(this, '{{$c->login}}', '{{$c->password}}')"
                                                            id="btn-client-delete-bill-{{$key + 1}}">
                                                            <i class="bi bi-trash-fill"
                                                                id="btn-icon-{{$key + 1}}"></i>

                                                            <div class="spinner-border spinner-border-sm text-white d-none" id="btn-client-delete-bill-loading-{{$key + 1}}"
                                                                role="status">
                                                                <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
