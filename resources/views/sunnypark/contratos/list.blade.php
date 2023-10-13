@section('page_title', 'Contratos')

<script src="{{asset(mix('js/sunnypark/contratos/list.js'))}}" defer></script>

<x-app-layout>
	<x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Contratos</h3>
            </div>
        </div>
    </x-slot>

    <div>
    	<div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Contratos</h4>
                        <p class="card-description">
                            Por meio desta tela é possível realizar o gerenciamento dos contratos registrados no sistema.
                        </p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <a class="btn bg-orange btn-szie d-flex justify-content-center align-items-center" href="{{route('sunnypark_contratos_create')}}">
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
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Tipo</th>
                                <th scope="col" class="text-center">Vigência (mês)</th>
                                <th scope="col" class="text-center">Data do Contrato</th>
                                <th scope="col" class="text-center">Potência</th>
                                <th scope="col" class="text-center">Quantidade</th>
                                <th scope="col" class="text-center">Valor Base</th>
                                <th scope="col" class="text-center">Desconto</th>
                                <th scope="col" class="text-center">Tarifa Base</th>
                                <th scope="col" class="text-center">Meta Gestão</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($contratos as $key => $contrato)
                                <tr>
                                    <td class="text-center">{{$key + 1}}</td>
                                    <td>
                                        {{$contrato->client->is_corporate ? $contrato->client->corporate_name : $contrato->client->name }}
                                    </td>
                                    <td>
                                        @switch ($contrato->status)
                                            @case ("minuta")
                                                <span class="badge bg-secondary fw-bold">
                                                    Minuta
                                                </span>
                                                @break

                                            @case ("contratado")
                                                <span class="badge bg-brown fw-bold">
                                                    Contratado
                                                </span>
                                                @break
                                            
                                            @case ("ativo")
                                                <span class="badge bg-info fw-bold">
                                                    Ativo
                                                </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($contrato->tipo_contrato)
                                            @case("flex")
                                                <span class="badge bg-secondary">{{$contrato->tipo_contrato}}</span>
                                                @break
                                            @case ("flex_plus")
                                                <span class="badge bg-secondary">{{$contrato->tipo_contrato}}</span>
                                                @break
                                            @case("normal")
                                                <span class="badge bg-secondary">{{$contrato->tipo_contrato}}</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        {{$contrato->tempo_vigencia}}
                                    </td>
                                    <td>
                                        {{isset($contrato->data_vigencia) ? date('d/m/Y', strToTime($contrato->data_vigencia)) : "-"}}
                                    </td>
                                    <td>
                                        {{$contrato->potencia_quota}}
                                    </td>
                                    <td>
                                        {{$contrato->qtd_kwh}} Kwh
                                    </td>
                                    <td>
                                        R$ {{format_money($contrato->valor)}}
                                    </td>
                                    <td>
                                        {{$contrato->desconto}}%
                                    </td>
                                    <td>
                                        R$ {{format_money($contrato->tarifa_base)}}
                                    </td>
                                    <td>
                                        R$ {{format_money($contrato->meta_gestao)}}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="{{route('sunnypark_contratos_edit', ['id' => encrypt($contrato->id)])}}" method="GET" class="me-2 mb-0 align-self-center">
                                                @csrf
                                                <button class="btn bg-success text-white"
                                                    type="submit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </form>
                                            <button id="generate_contract" type="button"
                                                class="btn bg-primary text-white me-2 mb-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_generate_contract_{{$key}}">
                                                <i class="bi bi-download"></i>
                                            </button>
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
                </div>

                {{-- MODAL --}}
                @foreach($contratos as $key => $contrato)
                    <!-- Modal Delete -->
                    <div class="modal fade" id="modal_delete_{{$key}}"
                        style="color: black"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog modal-dialog-centered"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Deletar Cliente</h5>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">
                                        Você deseja deletar o contrato #{{$key + 1}} do cliente
                                        <span class="fw-bold">
                                            {{$contrato->client->is_corporate ? $contrato->client->corporate_name : $contrato->client->name}}
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
                                    <form action="{{route('sunnypark_contratos_destroy',['id'=>encrypt($contrato->id)])}}"
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

                    <!-- Modal Generate Contract -->
                    <div class="modal fade w-100" id="modal_generate_contract_{{$key}}"
                        style="color: black"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Escolha o assinante do contrato</h4>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="card">
                                            <div class="card-body">
                                                <form method="POST" target="_blank" 
                                                    action="{{route('sunnypark_contratos_print', ['id' => encrypt($contrato->id)])}}"
                                                    class="form_generate_contract_{{$key}}" onsubmit="return false">
                                                    @csrf
                                                    <div class="row">
                                                        <!-- Signature Name -->
                                                        <div class="col-12 col-md-12">
                                                            <div class="form-group">
                                                                <label for="contract-signature-name" class="form-label">
                                                                    Assinatura no Contrato
                                                                </label>
                                                                <select 
                                                                    class="form-select contract-signature-name_{{$key}}"
                                                                    aria-label="contract-signature-name" 
                                                                    name="contract-signature-name"
                                                                    value="{{old('contract-signature-name')}}"
                                                                    onchange="return window.validateContractSignatureName(this)"
                                                                    onblur="return window.validateContractSignatureName(this)">
                                                                    <option value="" disabled selected>
                                                                        Escolha o assinante
                                                                    </option>
                                                                    <option value="{{encrypt('1')}}">
                                                                        Nixon Menezes Girard da Silva
                                                                    </option>
                                                                    <option value="{{encrypt('2')}}">
                                                                        Rafael Feio Calandrini
                                                                    </option>
                                                                </select>
                                                                <div class="invalid-feedback signature-name-feedback-contract_{{$key}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Voltar
                                    </button>
                                    <a href="#" class="btn bg-success text-white" 
                                        onclick="event.preventDefault(), window.formGenerateContractSubmit('.form_generate_contract_{{$key}}')">
                                        Emitir Contrato
                                    </a>
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
                                                {{$contrato->client->is_corporate ? $contrato->client->corporate_name : $contrato->client->name }}.
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
                                        <form action="{{route('sunnypark_contascontratos_download',['id'=>encrypt($contrato->client->id)])}}"
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
</x-app-layout>