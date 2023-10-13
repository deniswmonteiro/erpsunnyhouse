@section('page_title', 'Editar Vendedor')

<script src="{{asset(mix('js/sellersTeam/list.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Times de vendas no sistema</h3>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Times de Vendas</h4>
                        <p class="card-description">Por meio desta tela é possível realizar o gerenciamento dos times de
                            vendas cadastrados no sistema.</p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <a href="{{route('seller_team_index')}}" class="mt-auto btn bg-orange m-auto btn-szie"
                           type="submit">
                            <i class="bi bi-person-plus-fill"></i>
                            Novo
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
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Número de Vendedores</th>
                                <th scope="col">Vendas Totais</th>
                                <th scope="col">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $key => $team)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{$team->name}}</td>
                                    <td>Possui <strong>{{count($team->sellers)}}</strong> Vendedores.</td>
                                    <td>R$ {{$team->totalSales()}}.</td>
                                    <td>
                                        <form action="{{route('seller_team_index',['id'=>encrypt($team->id)])}}"
                                              method="GET" style="margin-block-end: 0!important;">
                                            @csrf
                                            <button class="mt-auto btn bg-success m-auto text-white"
                                                    type="submit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <a class="mt-auto btn bg-danger m-auto text-white"
                                               data-bs-toggle="modal"
                                               data-bs-target="#modal_delete_{{$key}}">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            @foreach($teams as $key => $tea)
                <!-- Modal Delete -->
                    <div class="modal fade" id="modal_delete_{{$key}}"
                         style="color: black"
                         tabindex="-1" role="dialog" aria-hidden="true"
                         aria-labelledby="modal">
                        <div class="modal-dialog modal-dialog-centered"
                             role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Deletar Time de Vendas</h5>
                                    <button type="button" class="close"
                                            data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Você deseja deletar o time de vendas
                                    <strong>{{$team->name}}</strong>?<br>
                                    Você está prestes a deletar um time da nossa base de dados.<br>
                                    <a class="text-danger">A ação não pode ser desfeita!</a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                            class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar
                                    </button>
                                    <form action="{{route('seller_team_destroy',['id'=>encrypt($team->id)])}}"
                                          method="post">
                                        @csrf
                                        <button
                                            type="submit" class="btn btn-danger">
                                            Deletar Time de Vendas
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
