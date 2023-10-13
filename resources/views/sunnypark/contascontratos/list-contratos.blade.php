@section('page_title', 'Contas Contratos do cliente')

<script src="{{asset(mix('js/sunnypark/contascontratos/list-contratos.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Contas Contratos</h3>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
    	<div>
            {{-- Cliente info --}}
    		<div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações do Cliente</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <span class="fw-bold">Razão Social:</span>
                                <p>{{!empty($cliente->corporate_name) ? $cliente->corporate_name : '-'}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <span class="fw-bold">CNPJ:</span>
                                <p>{{!empty($cliente->cnpj) ? $cliente->cnpj : '-'}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <span class="fw-bold">Nome:</span>
                                <p>{{$cliente->is_corporate ? $cliente->corporate_name : $cliente->name }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <span class="fw-bold">Data de Nascimento:</span>
                                <p>{{date('d/m/Y', strToTime($cliente->birth_date))}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <span class="fw-bold">CPF:</span>
                                <p>{{$cliente->cpf}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <span class="fw-bold">Email:</span>
                                <p>{{$cliente->email}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <span class="fw-bold">Telefone:</span>
                                <p>{{$cliente->phone}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Listagem --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contas Contratos</h4>
                </div>
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-striped pt-4" id="table_id">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Código</th>
                                    <th scope="col" class="text-center">Apelido</th>
                                    <th scope="col" class="text-center">Classificação</th>
                                    <th scope="col" class="text-center">Tipo</th>
                                    <th scope="col" class="text-center">Modalidade Tarifária</th>
                                    <th scope="col" class="text-center">Faturas</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contascontratos as $key => $cc)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td>
                                            {{$cc->cod_cc}}
                                        </td>
                                        <td>
                                            {{$cc->apelido}}
                                        </td>
                                        <td>
                                            {{$cc->classificacao}}
                                        </td>
                                        <td>
                                            @switch ($cc->tipo_classificacao)
                                                @case ("comercial")
                                                    Comercial
                                                    @break
                                                @case ("rural")
                                                    Rural Agroindustrial
                                                    @break
                                                @case ("residencial")
                                                    Residencial
                                                    @break
                                                @case ("comercial_outro")
                                                    Comercial Outros Serviços e Outras Atividades
                                                    @break
                                                @case ("comercial_servicos")
                                                    Comercial Serviços de Comunicações e Telecomunicações
                                                    @break
                                                @case ("industrial")
                                                    Industrial Industrial
                                                    @break
                                                @case ("rural_agro")
                                                    Rural Agropecuária Rural
                                                    @break
                                                @case ("poder")
                                                    Poder público Federal
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch ($cc->modalidade_tarifaria)
                                                @case ("convencional")
                                                    Convencional
                                                    @break

                                                @case ("branca")
                                                    Tárifa Branca
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            {{$cc->faturas_count}}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <form action="{{route('sunnypark_contascontratos_edit', ['id' => encrypt($cc->id)])}}" method="GET" class="me-2 mb-0 align-self-center">
                                                    @csrf
                                                    <button class="btn bg-success text-white"
                                                        type="submit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                </form>
                                                <form action="{{route('sunnypark_contascontratos_list_faturas', ['id' => encrypt($cc->id)])}}" method="GET"
                                                    class="me-2 mb-0 align-self-center">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn bg-success justify-content-center align-items-center text-white">
                                                        <i class="bi bi-arrow-right-circle"></i>
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
                        @foreach($contascontratos as $key => $cc)
                            <!-- Modal Delete -->
                            <div class="modal fade" id="modal_delete_{{$key}}"
                                style="color: black"
                                tabindex="-1" role="dialog" aria-hidden="true"
                                aria-labelledby="modal">
                                <div class="modal-dialog modal-dialog-centered"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Deletar contras contratos</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-0">
                                                Você deseja deletar as contas contrato de número
                                                <span class="fw-bold">
                                                    {{$cc->cod_cc}}
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
                                            <form action="{{route('sunnypark_contascontratos_destroy_cc',['id'=>encrypt($cc->id)])}}"
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>