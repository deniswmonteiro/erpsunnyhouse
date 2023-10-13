@section('page_title', 'Usinas')

<script src="{{asset(mix('js/sunnypark/usinas/list.js'))}}" defer></script>

<x-app-layout>
	<x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Usinas</h3>
            </div>
        </div>
    </x-slot>

    <div>
    	<div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Usinas</h4>
                        <p class="card-description">
                            Por meio desta tela é possível realizar o gerenciamento das usinas registradas no sistema.
                        </p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <a class="btn bg-orange btn-szie d-flex justify-content-center align-items-center" href="{{route('sunnypark_usinas_create')}}">
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
                                <th scope="col" class="text-center">C. Contrato</th>
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Apelido</th>
                                <th scope="col" class="text-center">Documento</th>
                                <th scope="col" class="text-center">Login</th>
                                <th scope="col" class="text-center">Meta</th>
                                <th scope="col" class="text-center">Dia leitura</th>
                                <th scope="col" class="text-center">Investimento</th>
                                <th scope="col" class="text-center">Ciclo</th>
                                <th scope="col" class="text-center">Última apuração</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($usinas as $key => $usina)
                                <tr>
                                    <td class="text-center">{{$key + 1}}</td>
                                    <td>
                                        {{$usina->contaContrato->cod_cc}}
                                    </td>
                                    <td>
                                        {{$usina->nome}}
                                    </td>
                                    <td>
                                        {{$usina->apelido}}
                                    </td>
                                    <td>
                                        {{$usina->documento}}
                                    </td>
                                    <td>
                                        {{$usina->login}}<br>
                                        {{$usina->senha}}
                                    </td>
                                    <td>
                                        {{$usina->producaoMeta}} Kwh
                                    </td>
                                    <td>
                                        {{$usina->diaLeitura}}
                                    </td>
                                    <td>
                                        R$ {{$usina->investimento}}
                                    </td>
                                    <td>
                                        {{$usina->ciclo}}
                                    </td>
                                    <td>
                                        {{$usina->ultimaapuracao}}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="{{route('sunnypark_usinas_edit', ['id' => encrypt($usina->id)])}}" method="GET" class="me-2 mb-0 align-self-center">
                                                @csrf
                                                <button class="btn bg-success text-white"
                                                    type="submit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>
                                            <form action="{{route('sunnypark_usinas_list', ['id' => encrypt($usina->id)])}}" method="GET" class="me-2 mb-0 align-self-center">
                                                @csrf
                                                <button class="btn bg-success text-white"
                                                    type="submit">
                                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                                </button>
                                            </form>
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
                    @foreach($usinas as $key => $usina)
                        <!-- Modal Delete -->
                        <div class="modal fade" id="modal_delete_{{$key}}"
                            style="color: black"
                            tabindex="-1" role="dialog" aria-hidden="true"
                            aria-labelledby="modal">
                            <div class="modal-dialog modal-dialog-centered"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Deletar Usina</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">
                                            Você deseja deletar a usina #{{$key + 1}} de apelido
                                            <span class="fw-bold">
                                                {{$usina->apelido}}
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
                                        <form action="{{route('sunnypark_usinas_destroy',['id'=>encrypt($usina->id)])}}"
                                            method="post">
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
    </div>
</x-app-layout>