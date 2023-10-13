@section('page_title', 'Vendedores')

<script src="{{asset(mix('js/sellers/list.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last mb-2">
                <h3>Vendedores Cadastrados no Sistema</h3>
            </div>
        </div>
    </x-slot>

    <div id="seller-list">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Vendedores</h4>
                        <p class="card-description">
                            Por meio desta tela é possível realizar o gerenciamento de
                            vendedores cadastrados no sistema.
                        </p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2 mt-3 mb-5">
                        <div class="row">
                            <a href="{{route('sellers_create')}}"
                                class="btn bg-orange d-flex justify-content-center align-items-center"
                                type="submit">
                                <i class="bi bi-person-plus-fill me-1"></i>
                                Novo Vendedor
                            </a>
                        </div>
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
                                <th scope="col" class="text-center">Equipe de Vendas</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($sellers as $key => $seller)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td>{{$seller->name}}</td>
                                        <td>{{$seller->email}}</td>
                                        <td class="text-center">{{$seller->phone}}</td>
                                        <td>{{$seller->team->name}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <form action="{{route('sellers_edit',['id'=>encrypt($seller->id)])}}"
                                                    method="GET"
                                                    class="me-2 mb-0 align-self-center">
                                                    @csrf
                                                    <button class="btn bg-success text-white"
                                                        type="submit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <a class="btn bg-danger text-white"
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
                </div>

                @foreach($sellers as $key => $seller)
                    <!-- Modal Delete -->
                    <div class="modal fade" id="modal_delete_{{$key}}"
                        style="color: black"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Deletar Vendedor</h5>
                                    <button type="button" 
                                        class="btn-close" 
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Você deseja deletar o vendedor
                                    <span class="fw-bold">{{$seller->name}}</span>?
                                    <p class="mb-0">
                                        Você está prestes a deletar um vendedor da nossa base de dados.
                                    </p>
                                    <p class="text-danger mb-0">
                                        A ação não pode ser desfeita!
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <form action="{{route('sellers_destroy', ['id' => encrypt($seller->id)])}}"
                                        method="POST">
                                        @csrf
                                        
                                        <button type="submit" class="btn btn-danger">
                                            Deletar Vendedor
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
