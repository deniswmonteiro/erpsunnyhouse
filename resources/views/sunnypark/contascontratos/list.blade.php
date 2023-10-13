@section('page_title', 'Beneficiárias')

<script src="{{asset(mix('js/sunnypark/contascontratos/list.js'))}}" defer></script>

<x-app-layout>
	<x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Beneficiárias</h3>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
    	<div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Beneficiários</h4>
                        <p class="card-description">
                            Por meio desta tela é possível realizar o gerenciamento das contas contratos registrados no sistema por cliente.
                        </p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <a class="btn bg-orange btn-szie d-flex justify-content-center align-items-center" href="{{route('sunnypark_contascontratos_create')}}">
                            <i class="bi bi-plus-lg me-1"></i> Novo
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
                                <th scope="col" class="text-center">Cliente</th>
                                <th scope="col" class="text-center">Qtd. contas</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $key => $cliente)
                                <tr>
                                    <td class="text-center">{{$key + 1}}</td>
                                    <td>
                                        {{$cliente->is_corporate ? $cliente->corporate_name : $cliente->name }}
                                    </td>
                                    <td>
                                        {{$cliente->contacontratos_count}}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="{{route('sunnypark_contascontratos_list', ['id' => encrypt($cliente->id)])}}" method="GET"
                                                class="me-2 mb-0 align-self-center">
                                                @csrf
                                                <button type="submit"
                                                    class="btn bg-success justify-content-center align-items-center text-white">
                                                    <i class="bi bi-arrow-right-circle"></i>
                                                </button>
                                            </form>
                                            <a class="btn bg-secondary text-white me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_download_{{$key}}">
                                                <i class="bi bi-box-arrow-in-down"></i>
                                            </a>
                                            <a class="btn bg-danger text-white me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_delete_{{$key}}">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- MODAL --}}
                    @foreach($clientes as $key => $cliente)
                        <!-- Modal Delete -->
                        <div class="modal fade" id="modal_delete_{{$key}}"
                            style="color: black"
                            tabindex="-1" role="dialog" aria-hidden="true"
                            aria-labelledby="modal">
                            <div class="modal-dialog modal-dialog-centered"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Deletar contras contratos e faturas</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">
                                            Você deseja deletar as contas contratos e faturas do cliente
                                            <span class="fw-bold">
                                                {{$cliente->is_corporate ? $cliente->corporate_name : $cliente->name}}
                                            </span>?
                                        </p>
                                        <p class="mb-0">
                                            <span class="text-danger">A ação não pode ser desfeita!</span>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>
                                        <form action="{{route('sunnypark_contascontratos_destroy',['id'=>encrypt($cliente->id)])}}"
                                            method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                Deletar Conta Contrato
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal download --}}
                        <div class="modal fade" id="modal_download_{{$key}}"
                            style="color: black"
                            tabindex="-1" role="dialog" aria-hidden="true"
                            aria-labelledby="modal">
                            <div class="modal-dialog modal-dialog-centered"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Baixar contras contratos</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">
                                            Iremos baixar todas as contas contratos não existentes em nosso sistema diretamente do sistema da Equatorial para o seguinte usuário:
                                            <span class="fw-bold">
                                                {{$cliente->is_corporate ? $cliente->corporate_name : $cliente->name}}.
                                            </span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="text-warning">Este processo pode demorar alguns minutos.</span>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>
                                        <form action="{{route('sunnypark_contascontratos_download',['id'=>encrypt($cliente->id)])}}"
                                            method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">
                                                Baixar Conta Contrato
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
    </div>
</x-app-layout>