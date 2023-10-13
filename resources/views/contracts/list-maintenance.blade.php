@section('page_title', 'Contratos - Manutenção')

<script src="{{asset(mix('js/contracts/list.js'))}}" defer></script>
<script src="{{asset(mix('js/contracts/list-maintenance.js'))}}" defer></script>
<script>
    var url_contract_update_status = "{{route('contracts_update_status_fetch')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>Contratos de Manutenção Registrados no Sistema</h3>
            </div>
        </div>
    </x-slot>

    <div id="contract-list-maintenance">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-lg-10">
                        <h4 class="card-title">Gerenciar Contratos de Manutenção</h4>
                        <p class="card-description">
                            Por meio desta tela é possível realizar o gerenciamento dos contratos de manutenção registrados no sistema.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-12 col-md-4 col-lg-3">
                        <a href="{{route('contracts_create', ['type' => 'maintenance'])}}"
                            class="btn btn-warning d-flex justify-content-center align-items-center">
                            <i class="bi bi-person-plus-fill me-1"></i>
                            Novo Contrato
                        </a>
                    </div>
                    <div class="col-12 col-md-4">
                        <button type="button"
                            class="btn btn-primary text-white d-flex justify-content-center align-items-center"
                            id="generate_report"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-generate-report">
                            <i class="bi bi-download me-1"></i>
                            Gerar Relatório
                        </button>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4" id="contract-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Cliente</th>
                                    <th scope="col" class="text-center">Apelido</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Data do Contrato</th>
                                    <th scope="col" class="text-center">Valor</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contracts_maintenance as $key => $contract)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td>
                                            {{
                                                $contract->client->is_corporate ?
                                                    $contract->client->corporate_name :
                                                    $contract->client->name
                                            }}

                                            {{ $contract->nickname ? '(' . $contract->nickname . ')' : '' }}
                                        </td>
                                        <td>{{$contract->nickname}}</td>
                                        <td class="status position-relative">
                                            <p class="mb-0">
                                                <a href="#" id="status-link-{{$key}}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-status-{{$key}}">
                                                    @switch ($contract->status)
                                                        @case ("ORÇANDO")
                                                            <span class="badge fw-bold bg-secondary"
                                                                id="status-{{$key}}"
                                                                onmouseover="return window.changeStatusTextIcon(this)"
                                                                onmouseout="return window.changeStatusIconText(this)">
                                                                <span>{{$contract->status}}</span>
                                                                <i class="bi bi-pencil-fill d-none"></i>
                                                            </span>
                                                            @break

                                                        @case ("CONTRATADO")
                                                            <span class="badge fw-bold bg-brown"
                                                                id="status-{{$key}}"
                                                                onmouseover="return window.changeStatusTextIcon(this)"
                                                                onmouseout="return window.changeStatusIconText(this)">
                                                                <span>{{$contract->status}}</span>
                                                                <i class="bi bi-pencil-fill d-none"></i>
                                                            </span>
                                                            @break
                                                        
                                                        @case ("ATIVO")
                                                            <span class="badge fw-bold bg-info"
                                                                id="status-{{$key}}"
                                                                onmouseover="return window.changeStatusTextIcon(this)"
                                                                onmouseout="return window.changeStatusIconText(this)">
                                                                <span>{{$contract->status}}</span>
                                                                <i class="bi bi-pencil-fill d-none"></i>
                                                            </span>
                                                            @break
                                                        
                                                        @case ("PENDÊNCIA")
                                                            <span class="badge fw-bold bg-danger"
                                                                id="status-{{$key}}"
                                                                onmouseover="return window.changeStatusTextIcon(this)"
                                                                onmouseout="return window.changeStatusIconText(this)">
                                                                <span>{{$contract->status}}</span>
                                                                <i class="bi bi-pencil-fill d-none"></i>
                                                            </span>
                                                            @break

                                                        @case ("INSTALANDO")
                                                            <span class="badge fw-bold bg-primary"
                                                                id="status-{{$key}}"
                                                                onmouseover="return window.changeStatusTextIcon(this)"
                                                                onmouseout="return window.changeStatusIconText(this)">
                                                                <span>{{$contract->status}}</span>
                                                                <i class="bi bi-pencil-fill d-none"></i>
                                                            </span>
                                                        @break

                                                        @case ("INSTALADO")
                                                            <span class="badge fw-bold bg-warning"
                                                                id="status-{{$key}}"
                                                                onmouseover="return window.changeStatusTextIcon(this)"
                                                                onmouseout="return window.changeStatusIconText(this)">
                                                                <span>{{$contract->status}}</span>
                                                                <i class="bi bi-pencil-fill d-none"></i>
                                                            </span>
                                                        @break

                                                        @case ("CONCLUÍDO")
                                                            <span class="badge fw-bold bg-success"
                                                                id="status-{{$key}}"
                                                                onmouseover="return window.changeStatusTextIcon(this)"
                                                                onmouseout="return window.changeStatusIconText(this)">
                                                                <span>{{$contract->status}}</span>
                                                                <i class="bi bi-pencil-fill d-none"></i>
                                                            </span>
                                                        @break

                                                        @case ("CANCELADO")
                                                            <span class="badge fw-bold bg-dark"
                                                                id="status-{{$key}}"
                                                                onmouseover="return window.changeStatusTextIcon(this)"
                                                                onmouseout="return window.changeStatusIconText(this)">
                                                                <span>{{$contract->status}}</span>
                                                                <i class="bi bi-pencil-fill d-none"></i>
                                                            </span>
                                                        @break
                                                    @endswitch
                                                </a>

                                                <!-- Link to engineering project -->
                                                @if ($contract->status != 'ORÇANDO' && $contract->project != null)
                                                    <a href="{{route('engineering_project_show', ['id' => encrypt($contract->project->id)])}}" target="_blank"
                                                        id="link-show-engineering-project-{{$key}}">
                                                        <span class="badge"
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="right" 
                                                            title="@include ('contracts.tooltipEngineeringGeneratorStatus', ['generators' => $contract->project->generator])">
                                                            <i class="bi bi-gear-fill"
                                                                style="font-size: 1.1rem; color: #607080;"></i>
                                                        </span>
                                                    </a>
                                                @endif

                                                <!-- Show equipment purchased -->
                                                @if ($contract->status != 'ORÇANDO' && ($contract->equipment_date_acquisition != null || $contract->equipment_delivery_date != null || $contract->file_invoice_path != null))
                                                    <a href="#" id="link-show-equipment-purchased-{{$key}}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-show-equipment-purchased-{{$key}}">
                                                        <span class="badge">
                                                            <i class="bi bi-cpu-fill"
                                                                style="font-size: 1.1rem; color: #607080;"></i>
                                                        </span>
                                                    </a>
                                                @endif

                                                <!-- Link to contract ticket -->
                                                @if ($contract->ticket != null)
                                                    <a href="{{route('tickets_edit', ['id' => encrypt($contract->ticket->id)])}}" target="_blank">
                                                        <span class="badge">
                                                            <i class="bi bi-ticket-fill text-danger"
                                                                style="font-size: 1.1rem"></i>
                                                        </span>
                                                    </a>
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            {{date('d/m/Y', strToTime($contract->contract_date))}}
                                        </td>
                                        <td class="text-center">R$ {{format_money($contract->getValue())}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                {{-- <!-- Project Costs -->
                                                @if ($contract->project != null)
                                                    <a href="{{route('costs_create', ['id' => encrypt($contract->project->id)])}}"
                                                        class="btn bg-orange text-white me-2">
                                                        <i class="bi bi-coin"></i>
                                                    </a>
                                                @else
                                                    <a href="#" class="btn bg-orange text-white me-2 disabled">
                                                        <i class="bi bi-coin"></i>
                                                    </a>
                                                @endif --}}

                                                <!-- Contract edit -->
                                                <form action="{{route('contracts_edit', ['type' => 'maintenance', 'id' => encrypt($contract->id)])}}" method="GET"
                                                    class="me-2 mb-0 align-self-center">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn bg-success justify-content-center align-items-center text-white">
                                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                                    </button>
                                                </form>

                                                <!-- Contract delete -->
                                                <a class="btn bg-danger text-white"
                                                    data-bs-toggle="modal"
                                                    data-bs-dismiss="modal"
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

                <!-- Modal Edit Status -->
                @foreach ($contracts_maintenance as $key => $contract)
                    <div class="modal fade text-black" id="modal-edit-status-{{$key}}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Status do Contrato</h5>
                                    <button type="button" class="btn-close" 
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="#" method="POST" id="form-update-contract-status-{{$key}}">
                                        <input type="hidden" id="status-id-{{$key}}" 
                                            name="status-id"
                                            value="{{encrypt($contract->id)}}">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="form-group">
                                                    <label for="status" class="form-label">
                                                        Status do Contrato
                                                    </label>
                                                    <select class="form-select" aria-label="status"
                                                        id="status-edit-{{$key}}"
                                                        name="status"
                                                        data-value="{{old('status')}}"
                                                        onchange="return window.validateSelect(this)"
                                                        onblur="return window.validateSelect(this)">
                                                        <option value="" disabled selected>
                                                            Escolha o status do contrato
                                                        </option>
                                                        <option value="{{encrypt(1)}}">
                                                            Orçando
                                                        </option>
                                                        <option value="{{encrypt(2)}}">
                                                            Contratado
                                                        </option>
                                                        <option value="{{encrypt(3)}}">
                                                            Ativo
                                                        </option>
                                                        <option value="{{encrypt(4)}}">
                                                            Pendência
                                                        </option>
                                                        <option value="{{encrypt(5)}}">
                                                            Instalando
                                                        </option>
                                                        <option value="{{encrypt(6)}}">
                                                            Instalado
                                                        </option>
                                                        <option value="{{encrypt(7)}}">
                                                            Concluído
                                                        </option>
                                                        <option value="{{encrypt(8)}}">
                                                            Cancelado
                                                        </option>
                                                    </select>
                                                <div class="invalid-feedback" 
                                                    id="update-status-{{$key}}-feedback-contract"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                        onclick="return window.clearFormEditStatus(this)">
                                        Cancelar
                                    </button>
                                    <button type="button" class="btn btn-success d-flex align-items-center"
                                        id="btn-update-contract-status-{{$key}}"
                                        onclick="return window.formUpdateContractStatus('form-update-contract-status-{{$key}}')">
                                        Atualizar Status

                                        <div class="spinner-border spinner-border-sm text-white d-none ms-2"
                                            id="btn-update-contract-status-loading-{{$key}}"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal Show Equipment Purchased -->
                @foreach ($contracts_maintenance as $key => $contract)
                    <div class="modal fade text-black" id="modal-show-equipment-purchased-{{$key}}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Informações sobre Equipamentos Adquiridos</h5>
                                    <button type="button" class="btn-close" 
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-0">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Date of Acquisition -->
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <span class="fw-bold">Data de Aquisição:</span>
                                                        <p>
                                                            @if ($contract->equipment_date_acquisition != null)
                                                                {{date('d/m/Y', strToTime($contract->equipment_date_acquisition))}}
                                                            @else
                                                                &mdash;
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            
                                                <!-- Delivery Date -->
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <span class="fw-bold">Data de Entrega:</span>
                                                        <p>
                                                            @if ($contract->equipment_delivery_date != null)
                                                                {{date('d/m/Y', strToTime($contract->equipment_delivery_date))}}
                                                            @else
                                                                &mdash;
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Invoice -->
                                                <div class="col-12 mb-3">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <span class="fw-bold">Nota Fiscal:</span>
                                                            <form action="{{route('contracts_file_view', ['type' => encrypt('invoice'), 'id' => encrypt($contract->id)])}}"
                                                                method="POST" enctype="multipart/form-data"
                                                                target="_blank"
                                                                class="align-self-center mt-1">
                                                                @csrf
                                                                
                                                                <button type="submit"
                                                                    class="btn bg-primary btn-sm text-white"
                                                                    @if ($contract->file_invoice_path == null) disabled @endif>
                                                                    <i class="bi bi-file-earmark-pdf-fill me-1"></i>
                                                                    Visualizar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Fechar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal Delete -->
                @foreach ($contracts_maintenance as $key => $contract)
                    <div class="modal fade text-black" id="modal-delete-{{$key}}"
                        tabindex="-1" role="dialog" aria-hidden="true"
                        aria-labelledby="modal">
                        <div class="modal-dialog"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Deletar Contrato</h5>
                                    <button type="button" 
                                        class="btn-close" 
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <span class="d-block">
                                        Você deseja excluir o contrato do(a) cliente 
                                        <span class="fw-bold">
                                            {{
                                                $contract->client->is_corporate ?
                                                    $contract->client->corporate_name :
                                                    $contract->client->name
                                            }}
                                        </span>
                                        da nossa base de dados?
                                    </span>
                                    <span class="text-danger">
                                        A ação não pode ser desfeita!
                                    </span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <form action="{{route('contracts_destroy', ['id' => encrypt($contract->id)])}}"
                                        method="POST">
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

    <!-- Modal Generate Report -->
    <div class="modal fade w-100 text-black" id="modal-generate-report"
        tabindex="-1" role="dialog" aria-hidden="true"
        aria-labelledby="modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Escolha o Período de Vendas</h5>
                    <button type="button" class="btn-close" 
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card border">
                        <div class="card-header bg-blue-lighten p-3">
                            <h4 class="card-title mb-0">Período de Vendas</h4>
                        </div>
                        <div class="card-body pt-4 pb-1">
                            <form action="{{route('contracts_print_report')}}"
                                method="POST" target="_blank"
                                id="form-generate-report"
                                class="mb-0"
                                onsubmit="return false">
                                @csrf
                                
                                <div class="row">
                                    <!-- Initial date -->
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="report-date-start">Data Inicial</label>
                                            <input id="report-date-start" type="date"
                                                name="report-date-start"
                                                class="form-control"
                                                min="{{date('2000-01-01')}}"
                                                max="{{date('Y-m-d')}}"
                                                onkeyup="return window.validateStartDate(this)"
                                                onblur="return window.validateStartDate(this)"
                                                onchange="return window.validateStartDate(this)"
                                                required>
                                            <div class="invalid-feedback"
                                                id="start-date-feedback-report"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Final date -->
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="report-date-end">Data Final</label>
                                            <input id="report-date-end" type="date"
                                                name="report-date-end"
                                                class="form-control"
                                                min="{{date('2000-01-01')}}"
                                                max="{{date('Y-m-d')}}"
                                                onkeyup="return window.validateFinalDate(this)"
                                                onblur="return window.validateFinalDate(this)"
                                                onchange="return window.validateFinalDate(this)"
                                                required>
                                            <div class="invalid-feedback" id="end-date-feedback-report"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        onclick="return window.clearFormGenerateReport()">
                        Cancelar
                    </button>
                    <button type="submit" class="btn bg-success text-white"
                        onclick="return window.formSubmitGenerateReport(this)">
                        Gerar Relatório
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
