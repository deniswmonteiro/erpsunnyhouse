@section('page_title', 'Equipamentos')

<script src="{{asset(mix('js/equipments/list.js'))}}" defer></script>
<script src="{{asset(mix('js/equipments/create.js'))}}" defer></script>
<script src="{{asset(mix('js/equipments/edit.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3>Equipamentos Cadastrados no Sistema</h3>
            </div>
        </div>
    </x-slot>

    <div id="equipment-list">
        <div class="card">
            <div class="card-header">
                <div class="row mb-5">
                    <div class="col-12 col-md-8 col-lg-9">
                        <h4 class="card-title">Gerenciar Equipamentos</h4>
                        <p class="card-description">Gerencie os equipamentos do sistema.</p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mt-3 mb-5">
                        <a class="btn bg-orange d-flex justify-content-center align-items-center"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-new-product">
                            <i class="bi bi-cpu-fill me-1"></i>
                            Novo Equipamento
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4" id="table_id">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipments_array as $key => $equipment)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$equipment['text']}}</td>
                                        <td class="text-center col-2">{{$equipment['category']}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn bg-success align-self-center text-white me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-equipment-{{$key}}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <a class="btn bg-danger align-self-center text-white me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete-equipment-{{$key}}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                                <form action="{{route('datasheet_view', ['type' => encrypt($equipment['type']), 'id' => $equipment['id']])}}" method="GET"
                                                    class="mb-0" enctype="multipart/form-data"
                                                    class="align-self-center"
                                                    target="_blank">
                                                    @csrf

                                                    <button type="submit"
                                                        class="btn bg-primary btn-sm text-white d-flex justify-content-center align-items-center"
                                                        @if ($equipment['datasheet_path'] === null || $equipment['datasheet_path'] === '') disabled @endif>
                                                        <i class="bi bi-download me-1"></i>
                                                        Datasheet
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
            </div>
        </div>

        <!-- Modal create -->
        @include('equipments.create')

        <!-- Modal edit -->
        @foreach ($equipments_array as $key => $equipment)
            @include('equipments.edit')
        @endforeach

        <!-- Modal Delete -->
        @foreach ($equipments_array as $key => $equipment)
            <div class="modal fade" id="modal-delete-equipment-{{$key}}"
                style="color: black"
                tabindex="-1" role="dialog" aria-hidden="true"
                aria-labelledby="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Deletar Equipamento</h5>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">
                                Você deseja deletar o equipamento
                                <span class="fw-bold">{{$equipment['text']}}</span>?
                            </p>
                            <p class="mb-0">
                                Caso o equipamento esteja associado a um ou mais contratos, ele não será excluído e uma lista com esses contratos será apresentada a seguir.
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
                            <form action="{{route('equipments_destroy', ['id' => $equipment['id']])}}"
                                method="POST">
                                @csrf

                                <input type="hidden" name="type" value="{{encrypt($equipment['type'])}}">
                                <button type="submit" class="btn btn-danger">
                                    Deletar Equipamento
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>