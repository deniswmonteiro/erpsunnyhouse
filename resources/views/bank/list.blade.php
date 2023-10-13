@section('page_title', 'Bancos')

<script src="{{asset(mix('js/bank/list.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Bancos Cadastrados no Sistema</h3>
            </div>
        </div>
    </x-slot>

    <div id="bank-list">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-9">
                        <h4 class="card-title">Gerenciar Bancos</h4>
                        <p class="card-description">Gerenciamento dos bancos aceitos no sistema.</p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mt-3 mb-5">
                        <a class="btn bg-orange d-flex justify-content-center align-items-center"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-create-bank">
                            <i class="bi bi-bank2 me-1"></i>
                            Novo Banco
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
                                    <th scope="col" class="text-center">Código</th>
                                    <th scope="col" class="text-center">Banco</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banks as $key => $bank)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">{{$bank->code}}</td>
                                        <td>{{$bank->name}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <form action="#" class="me-2 mb-0 align-self-center" method="GET">
                                                    @csrf
                                                    <a class="btn bg-success text-white"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-{{$key}}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                </form>
                                                <a class="btn bg-danger text-white"
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

                <!-- Modal add Bank -->
                <div class="modal fade" id="modal-create-bank"
                    style="color: black"
                    tabindex="-1" role="dialog" aria-hidden="true"
                    aria-labelledby="modal">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cadastrar Banco</h5>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('banks_store')}}" method="POST"
                                    class="mb-0"
                                    id="form-create-bank"
                                    onsubmit="return false">
                                    @csrf

                                    <div class="row">
                                        <!-- Code -->
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="bank-code" class="form-label">
                                                    Código
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="bank-code" 
                                                    name="code"
                                                    value=""
                                                    onblur="return window.validateInput(this, 1)"
                                                    onkeyup="return window.validateInput(this, 1)"
                                                    required>
                                                <div class="invalid-feedback" id="bank-feedback-code-create"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="bank-name" class="form-label">
                                                    Nome do Banco
                                                </label>
                                                <input type="text" class="form-control"
                                                    id="bank-name"
                                                    name="name"
                                                    value=""
                                                    onblur="return window.validateInput(this, 2)"
                                                    onkeyup="return window.validateInput(this, 2)"
                                                    required>
                                                <div class="invalid-feedback" id="bank-feedback-name-create"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                    onclick="return window.clearFormCreateBank()">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn bg-success text-white d-inline-flex align-items-center"
                                    id="btn-create-bank"
                                    onclick="return window.submitFormCreateBank()">
                                    Salvar Banco

                                    <div class="spinner-border spinner-border-sm text-white ms-2 d-none"
                                        id="btn-create-bank-loading"
                                        role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal update Bank -->
                @foreach ($banks as $key => $bank)
                    <div class="modal fade" id="modal-edit-{{$key}}"
                        style="color: black"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Atualizar Banco</h5>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('banks_update', ['id' => encrypt($bank->id)])}}" method="POST"
                                        class="mb-0"
                                        id="form-edit-bank-{{$key}}"
                                        onsubmit="return false">
                                        @csrf

                                        <div class="row">
                                            <!-- Code -->
                                            <div class="col-12 mb-3">
                                                <div class="form-group">
                                                    <label for="bank-code-{{$key}}" class="form-label">
                                                        Código
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="bank-code-{{$key}}"
                                                        name="code"
                                                        value="{{$bank->code}}"
                                                        onblur="return window.validateInput(this, 1)"
                                                        onkeyup="return window.validateInput(this, 1)"
                                                        required>
                                                    <div class="invalid-feedback"
                                                        id="bank-feedback-code-edit-{{$key}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Name -->
                                            <div class="col-12 mb-3">
                                                <div class="form-group">
                                                    <label for="bank-name-{{$key}}" class="form-label">
                                                        Nome do Banco
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="bank-name-{{$key}}"
                                                        name="name"
                                                        value="{{$bank->name}}"
                                                        onblur="return window.validateInput(this, 2)"
                                                        onkeyup="return window.validateInput(this, 2)"
                                                        required>
                                                    <div class="invalid-feedback"
                                                        id="bank-feedback-name-edit-{{$key}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="btn bg-success text-white d-inline-flex align-items-center"
                                        id="btn-edit-bank-{{$key}}"
                                        onclick="return window.submitFormEditBank(this)">
                                        Atualizar Banco

                                        <div class="spinner-border spinner-border-sm text-white ms-2 d-none"
                                            id="btn-edit-bank-loading-{{$key}}"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal delete Bank -->
                @foreach ($banks as $key => $bank)
                    <div class="modal fade" id="modal-delete-{{$key}}"
                        style="color: black"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Deletar Banco</h5>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">
                                        Você deseja deletar o banco
                                        <span class="fw-bold">{{$bank->code.' - '.$bank->name}}</span>?
                                    </p>
                                    <p class="mb-0">
                                        Caso o banco esteja associado a um ou mais contratos, ele não será excluído e uma lista com esses contratos será apresentada a seguir.
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
                                    <form action="{{route('banks_destroy', ['id' => encrypt($bank->id)])}}"
                                        method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-danger">
                                            Deletar Banco
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
