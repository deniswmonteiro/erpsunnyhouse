@section('page_title', 'Tickets/OS')

<script src="{{asset(mix('js/tickets/list.js'))}}" defer></script>
<script src="{{asset(mix('js/tickets/create.js'))}}" defer></script>
<script>
    var contracts = @json($contracts);
    var clients = @json($clients);
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tickets/OS</h3>
            </div>
        </div>
    </x-slot>

    <div id="ticket-list">
        <div class="card">
            <div class="card-header">
                <div class="row mb-5">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Tickets/OS</h4>
                        <p class="card-description">
                            Por meio desta tela é possível visualizar os tickets dos contratos registrados no sistema.
                        </p>
                    </div>

                    @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                        <div class="col-12 col-md-4 col-lg-2 mt-3">
                            <a class="btn bg-orange d-flex justify-content-center align-items-center"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-ticket-create">
                                <i class="bi bi-ticket-fill me-2"></i>
                                Novo Ticket
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                            <div class="row mt-1 mb-5 pb-4" id="ticket-list-selection">
                                <div class="btn-group btn-group-sm"
                                    role="group" aria-label="Select tickets to be shown">
                                    <input type="radio" class="btn-check"
                                        name="ticket-selection"
                                        id="btn-ticket-selection-all"
                                        autocomplete="off"
                                        onclick="return window.showTicketsTable(this)"
                                        checked>
                                    <label class="btn btn-outline-primary" for="btn-ticket-selection-all">
                                        Todos
                                        <span class="badge bg-warning fw-bold">
                                            {{count($tickets)}}
                                        </span>
                                    </label>
                                
                                    <input type="radio" class="btn-check"
                                        name="ticket-selection"
                                        id="btn-ticket-selection-user"
                                        autocomplete="off"
                                        onclick="return window.showTicketsTable(this)">
                                    <label class="btn btn-outline-primary" for="btn-ticket-selection-user">
                                        Meus
                                        <span class="badge bg-warning fw-bold">
                                            {{count($arr_tickets_user)}}
                                        </span>
                                    </label>
                                
                                    <input type="radio" class="btn-check"
                                        name="ticket-selection"
                                        id="btn-ticket-selection-open"
                                        autocomplete="off"
                                        onclick="return window.showTicketsTable(this)">
                                    <label class="btn btn-outline-primary" for="btn-ticket-selection-open">
                                        Abertos
                                        <span class="badge bg-warning fw-bold">
                                            {{count($arr_tickets_open)}}
                                        </span>
                                    </label>
            
                                    <input type="radio" class="btn-check"
                                        name="ticket-selection"
                                        id="btn-ticket-selection-progress"
                                        autocomplete="off"
                                        onclick="return window.showTicketsTable(this)">
                                    <label class="btn btn-outline-primary" for="btn-ticket-selection-progress">
                                        Em andamento
                                        <span class="badge bg-warning fw-bold">
                                            {{count($arr_tickets_inprogress)}}
                                        </span>
                                    </label>
            
                                    <input type="radio" class="btn-check"
                                        name="ticket-selection"
                                        id="btn-ticket-selection-overdue"
                                        autocomplete="off"
                                        onclick="return window.showTicketsTable(this)">
                                    <label class="btn btn-outline-primary" for="btn-ticket-selection-overdue">
                                        Em atraso
                                        <span class="badge bg-warning fw-bold">
                                            {{count($arr_tickets_overdue)}}
                                        </span>
                                    </label>
            
                                    <input type="radio" class="btn-check"
                                        name="ticket-selection"
                                        id="btn-ticket-selection-concluded"
                                        autocomplete="off"
                                        onclick="return window.showTicketsTable(this)">
                                    <label class="btn btn-outline-primary" for="btn-ticket-selection-concluded">
                                        Concluídos
                                        <span class="badge bg-warning fw-bold">
                                            {{count($arr_tickets_concluded)}}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endif

                        <!-- Show table with all tickets -->
                        <div id="ticket-selection-all" class="d-block">
                            @include ('tickets.listTable', [
                                'tickets' => $tickets,
                                'type' => 'all'
                            ])
                        </div>

                        <!-- Show table with user tickets -->
                        <div id="ticket-selection-user" class="d-none">
                            @include ('tickets.listTable', [
                                'tickets' => $arr_tickets_user,
                                'type' => 'user'
                            ])
                        </div>

                        <!-- Show table with 'ABERTO' status ticket -->
                        <div id="ticket-selection-open" class="d-none">
                            @include ('tickets.listTable', [
                                'tickets' => $arr_tickets_open,
                                'type' => 'open'
                            ])
                        </div>

                        <!-- Show table with 'EM_ANDAMENTO' status ticket -->
                        <div id="ticket-selection-progress" class="d-none">
                            @include ('tickets.listTable', [
                                'tickets' => $arr_tickets_inprogress,
                                'type' => 'progress'
                            ])
                        </div>

                        <!-- show table with overdue tickets -->
                        <div id="ticket-selection-overdue" class="d-none">
                            @include ('tickets.listTable', [
                                'tickets' => $arr_tickets_overdue,
                                'type' => 'overdue'
                            ])
                        </div>

                        <!-- Show table with user tickets -->
                        <div id="ticket-selection-concluded" class="d-none">
                            @include ('tickets.listTable', [
                                'tickets' => $arr_tickets_concluded,
                                'type' => 'concluded'
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal create -->
        @include('tickets.create')

        <!-- Modal delete -->
        @foreach ($tickets as $key => $ticket)
            <div class="modal fade" id="modal-delete-{{$key}}"
                style="color: black"
                tabindex="-1" role="dialog" aria-hidden="true"
                aria-labelledby="modal">
                <div class="modal-dialog"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Deletar Ticket</h5>
                            <button type="button" 
                                class="btn-close" 
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="d-block">
                                Você deseja excluir o ticket do @if ($ticket->is_contract) contrato de @else cliente @endif 
                                <span class="fw-bold">
                                    @if ($ticket->is_contract)
                                        {{
                                            $ticket->contract->client->is_corporate ?
                                                $ticket->contract->client->corporate_name :
                                                $ticket->contract->client->name
                                        }}
                                    @else
                                        {{
                                            $ticket->client->is_corporate ?
                                                $ticket->client->corporate_name :
                                                $ticket->client->name
                                        }}
                                    @endif
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
                            <form action="{{route('tickets_destroy', ['id' => encrypt($ticket->id)])}}" method="POST">
                                @csrf

                                <button type="submit" class="btn btn-danger">
                                    Deletar Ticket
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>