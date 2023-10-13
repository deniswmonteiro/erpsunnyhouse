@section('page_title', 'Usuários')

<script src="{{asset(mix('js/users/list.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Usuários Cadastrados</h3>
            </div>
        </div>
    </x-slot>

    <div id="user-list">
        <div class="card">
            <div class="card-header">
                <div class="row mb-5">
                    <div class="col-12 col-md-8 col-lg-9">
                        <h4 class="card-title">Gerenciar Usuários</h4>
                        <p class="card-description">Lista de usuários cadastrados no sistema.</p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mt-3 mb-5">
                        <a class="mt-auto btn bg-orange m-auto btn-szie "
                           href="{{route('create_user')}}" role="button">
                            <i class="bi bi-person-plus-fill"></i>
                            Adicionar Usuário
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4" id="table-users">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Nome</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">Categoria</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key =>  $user)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td class="text-center">
                                            {{Str::substr($user->category->name, 0, 1) . Str::lower(Str::substr($user->category->name, 1))}}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <form action="{{route('edit_user', ['id' => encrypt($user->id)])}}"
                                                    method="GET"
                                                    class="me-2 mb-0 align-self-center">
                                                    @csrf

                                                    <button class="btn bg-success text-white"
                                                        type="submit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <a class="mt-auto btn bg-danger m-auto text-white"
                                                    data-bs-toggle="modal"
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
            </div>

            @foreach ($users as $key => $user)
                <!-- Modal Delete -->
                <div class="modal fade text-black" id="modal-delete-{{$key}}"
                    tabindex="-1" role="dialog" aria-hidden="true"
                    aria-labelledby="modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Deletar Usuário</h5>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-0">
                                    Você deseja deletar o usuário
                                    <span class="fw-bold">{{$user->name}}</span>?
                                </p>
                                <p class="mb-0">
                                    Você está prestes a deletar um usuário da nossa base de dados.
                                </p>
                                <p class="mb-0">
                                    <span class="text-danger">A ação não pode ser desfeita!</span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <form action="{{route('destroy_user', ['id' => encrypt($user->id)])}}"
                                    method="POST">
                                    @csrf

                                    <button
                                        type="submit" class="btn btn-danger">
                                        Deletar Usuário
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>