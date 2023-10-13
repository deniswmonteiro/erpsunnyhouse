@section('page_title', 'Tickets/OS - Editar')

<script src="{{asset(mix('js/tickets/edit.js'))}}" defer></script>
<script>
    var url_tickets_update = "{{route('tickets_update_fetch')}}";
    var url_post_ticket_comment = "{{route('ticket_comment_store_fetch')}}";
    var url_post_ticket_attachment = "{{route('ticket_attachment_store_fetch')}}";
    
    var ticketTitle = @json($ticket_title);
    var ticketDescription = @json($ticket_description);
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Editar Ticket/OS</h3>
                <p class="text-subtitle text-muted">{{_('Visualizar e editar informações do ticket.')}}</p>
            </div>
        </div>
    </x-slot>

    <div id="ticket-edit">
        <!-- Ticket Informations -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informações do Ticket</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="ticket-id"
                        id="ticket-id"
                        value="{{encrypt($ticket->id)}}">
                    
                    <!-- Title -->
                    <div class="col-12 col-lg-6 mb-3">
                        <form action="#" method="POST"
                            class="mb-0"
                            onsubmit="return false">
                            @csrf

                            <div class="form-group">
                                <label for="ticket-title" class="form-label">
                                    Título
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="ticket-title"
                                        name="ticket-title"
                                        value="{{$ticket->title}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        disabled>
                                    
                                    @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                                        <span class="bg-success text-white p-2"
                                            style="display: none"
                                            id="btn-ticket-title-updated">
                                        </span>
                                        <button type="button"
                                            class="btn btn-sm bg-warning text-white rounded-end"
                                            id="btn-edit-ticket-title"
                                            onclick="return window.enableEditTicketField(this)">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm bg-danger text-white d-none"
                                            id="btn-cancel-ticket-title"
                                            onclick="return window.cancelEditTicketField(this)">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </button>
                                        <button type="submit"
                                            class="btn btn-sm bg-success text-white rounded-end d-none"
                                            id="btn-update-ticket-title"
                                            onclick="return window.updateTicket(this)">
                                            <i class="bi bi-check-circle-fill"></i>

                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                id="btn-update-ticket-title-loading"
                                                role="status">
                                                <span class="visually-hidden">
                                                    Loading...
                                                </span>
                                            </div>
                                        </button>
                                    @endif
                                </div>
                                <div class="invalid-feedback" id="ticket-feedback-title-edit"></div>
                            </div>
                        </form>
                    </div>

                    <!-- Status -->
                    <div class="col-12 col-lg-6 mb-3">
                        <form action="#" method="POST"
                            class="mb-0"
                            onsubmit="return false">
                            @csrf
                    
                            <div class="form-group">
                                <label for="ticket-status" class="form-label">
                                    Status
                                </label>
                                <div class="input-group">
                                    <select class="form-select" aria-label="ticket-status"
                                        id="ticket-status"
                                        name="ticket-status"
                                        onchange="return window.validateSelect(this), window.enableSubmitButton(this)"
                                        @if (Auth::user()->category_id != 1 && Auth::user()->category_id != 3) disabled @endif>
                                        <option value="" disabled selected>
                                            Selecione o status
                                        </option>
                                        <option value="{{encrypt('ABERTO')}}"
                                            @if ($ticket->status == 'ABERTO') selected @endif>
                                            Aberto
                                        </option>
                                        <option value="{{encrypt('EM_ANDAMENTO')}}"
                                            @if ($ticket->status == 'EM_ANDAMENTO') selected @endif>
                                            Em Andamento
                                        </option>
                                        <option value="{{encrypt('EM_ESPERA')}}"
                                            @if ($ticket->status == 'EM_ESPERA') selected @endif>
                                            Em Espera
                                        </option>
                                        <option value="{{encrypt('CONCLUÍDO')}}"
                                            @if ($ticket->status == 'CONCLUÍDO') selected @endif>
                                            Concluído
                                        </option>
                                        <option value="{{encrypt('CANCELADO')}}"
                                            @if ($ticket->status == 'CANCELADO') selected @endif>
                                            Cancelado
                                        </option>
                                    </select>

                                    @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                                        <span class="bg-success text-white p-2"
                                            style="display: none"
                                            id="btn-ticket-status-updated">
                                        </span>
                                        <button type="submit"
                                            class="btn btn-sm bg-success text-white rounded-end"
                                            id="btn-update-ticket-status"
                                            onclick="return window.updateTicket(this)"
                                            disabled>
                                            <i class="bi bi-check-circle-fill"></i>

                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                id="btn-update-ticket-status-loading"
                                                role="status">
                                                <span class="visually-hidden">
                                                    Loading...
                                                </span>
                                            </div>
                                        </button>
                                    @endif
                                </div>
                                <div class="invalid-feedback" id="ticket-feedback-status-edit"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <!-- Description -->
                    <div class="col-12 mb-3">
                        <form action="#" method="POST"
                            class="mb-0"
                            onsubmit="return false">
                            @csrf
                    
                            <div class="form-group">
                                <label for="ticket-description" class="form-label">
                                    Descrição
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="ticket-description"
                                        name="ticket-description"
                                        value="{{$ticket->description}}"
                                        onchange="return window.validateInput(this, 2)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        disabled>
                                    @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                                        <span class="bg-success text-white p-2"
                                            style="display: none"
                                            id="btn-ticket-description-updated">
                                        </span>
                                        <button type="button"
                                            class="btn btn-sm bg-warning text-white rounded-end"
                                            id="btn-edit-ticket-description"
                                            onclick="return window.enableEditTicketField(this)">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm bg-danger text-white d-none"
                                            id="btn-cancel-ticket-description"
                                            onclick="return window.cancelEditTicketField(this)">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </button>
                                        <button type="submit"
                                            class="btn btn-sm bg-success text-white rounded-end d-none"
                                            id="btn-update-ticket-description"
                                            onclick="return window.updateTicket(this)">
                                            <i class="bi bi-check-circle-fill"></i>

                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                id="btn-update-ticket-description-loading"
                                                role="status">
                                                <span class="visually-hidden">
                                                    Loading...
                                                </span>
                                            </div>
                                        </button>
                                    @endif
                                </div>
                                <div class="invalid-feedback" id="ticket-feedback-description-edit"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Ticket Details -->
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detalhes</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Deadline -->
                            <div class="col-12 mb-3">
                                <form action="#" method="POST"
                                    class="mb-0"
                                    onsubmit="return false">
                                    @csrf
                            
                                    <div class="form-group">
                                        <label for="ticket-deadline" class="form-label">
                                            Prazo
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control date" type="date"
                                                id="ticket-deadline"
                                                name="ticket-deadline"
                                                value="{{date($ticket->deadline)}}"
                                                min="{{date('Y-m-d')}}"
                                                onkeyup="return window.validateTicketDeadline(this), window.enableSubmitButton(this)"
                                                onblur="return window.validateTicketDeadline(this), window.enableSubmitButton(this)"
                                                onchange="return window.validateTicketDeadline(this), window.enableSubmitButton(this)"
                                                @if (Auth::user()->category_id != 1 && Auth::user()->category_id != 3) disabled @endif>
                                            @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                                                <span class="bg-success text-white p-2"
                                                    style="display: none"
                                                    id="btn-ticket-deadline-updated">
                                                </span>
                                                <button type="submit"
                                                    class="btn btn-sm bg-success text-white rounded-end"
                                                    id="btn-update-ticket-deadline"
                                                    onclick="return window.updateTicket(this)"
                                                    disabled>
                                                    <i class="bi bi-check-circle-fill"></i>

                                                    <div class="spinner-border spinner-border-sm text-white d-none"
                                                        id="btn-update-ticket-deadline-loading"
                                                        role="status">
                                                        <span class="visually-hidden">
                                                            Loading...
                                                        </span>
                                                    </div>
                                                </button>
                                            @endif
                                        </div>
                                        <div class="invalid-feedback" id="ticket-feedback-deadline-edit"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Responsibles -->
                            <div class="col-12 mb-4">
                                <form action="#" method="POST"
                                    class="mb-0"
                                    onsubmit="return false">
                                    @csrf

                                    <div class="form-group">
                                        <label for="ticket-responsibles" class="form-label">
                                            Responsáveis
                                        </label>

                                        <p id="ticket-responsibles-badge">
                                            @if (count($ticket->responsible) > 0)
                                                @foreach ($ticket->responsible as $responsible)
                                                    <span class="badge bg-brown fw-bold">
                                                        @if ($responsible->user->cellphone != null)
                                                            @php
                                                                $current_url = url()->current();
                                                                $url_length = count(explode('/', $current_url)) - 1;
                                                                $url_id = explode('/', $current_url)[$url_length];
                                                                $url = 'http://erp.sunnyhouse.com.br/tickets/edit/' . $url_id;
                                                            @endphp

                                                            <a href="https://wa.me/55{{preg_replace('/[^0-9]/', '', $responsible->user->cellphone)}}/?text=Olá, {{$responsible->user->name}}! Você foi atribuído(a) a uma OS. Mais informações em {{$url}}"
                                                                target="_blank"
                                                                class="text-white">
                                                                {{$responsible->user->name}}
                                                                <i class="bi bi-whatsapp ms-1"
                                                                    role="img" aria-label="WhatsApp"></i>
                                                            </a>
                                                        @else
                                                            {{$responsible->user->name}}
                                                        @endif
                                                    </span>
                                                @endforeach
                                            @endif
                                        </p>

                                        @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                                            <select class="form-select"
                                                aria-label="ticket-responsibles multiple"
                                                id="ticket-responsibles"
                                                name="ticket-responsibles[]"
                                                onchange="return window.validateSelect(this), window.enableSubmitButton(this)"
                                                onblur="return window.validateSelect(this), window.enableSubmitButton(this)"
                                                onkeyup="return window.validateSelect(this), window.enableSubmitButton(this)"
                                                multiple>
                                                <option value="" disabled selected>
                                                    Selecione os responsáveis
                                                </option>

                                                @foreach ($users as $user)
                                                    <option value="{{encrypt($user->id)}}">
                                                        {{$user->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id="ticket-feedback-responsibles-edit"></div>
                                        @endif
                                    </div>

                                    @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                                        <div class="d-flex justify-content-end align-items-center mt-3">
                                            <span class="bg-success text-white rounded ps-2 pe-2 me-3"
                                                style="display: none; padding-top: 3px; padding-bottom: 3px"
                                                id="btn-ticket-responsibles-updated">
                                            </span>
                                            <button type="submit"
                                                class="btn bg-success text-white rounded-end"
                                                id="btn-update-ticket-responsibles"
                                                onclick="return window.updateTicket(this)"
                                                disabled>
                                                <i class="bi bi-check-circle-fill"></i>

                                                <div class="spinner-border spinner-border-sm text-white d-none"
                                                    id="btn-update-ticket-responsibles-loading"
                                                    role="status">
                                                    <span class="visually-hidden">
                                                        Loading...
                                                    </span>
                                                </div>
                                            </button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Type -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="ticket-type" class="form-label">
                                        Tipo
                                    </label>
                                    <select class="form-select" aria-label="ticket-type"
                                        id="ticket-type"
                                        name="ticket-type"
                                        disabled>
                                        <option value="" disabled selected>
                                            Selecione o tipo
                                        </option>
                                        <option value="{{encrypt('GENERATION')}}"
                                            @if ($ticket->type == 'GERAÇÃO') selected @endif>
                                            Geração
                                        </option>
                                        <option value="{{encrypt('CONCESSIONAIRE')}}"
                                            @if ($ticket->type == 'CONCESSIONÁRIA') selected @endif>
                                            Concessionária
                                        </option>
                                        <option value="{{encrypt('MAINTENANCE')}}"
                                            @if ($ticket->type == 'MANUTENÇÃO') selected @endif>
                                            Manutenção
                                        </option>
                                        <option value="{{encrypt('CLEANING')}}"
                                            @if ($ticket->type == 'LIMPEZA') selected @endif>
                                            Limpeza
                                        </option>
                                        <option value="{{encrypt('COMMERCIAL')}}"
                                            @if ($ticket->type == 'COMERCIAL') selected @endif>
                                            Comercial
                                        </option>
                                        <option value="{{encrypt('COMMISSIONING')}}"
                                            @if ($ticket->type == 'COMISSIONAMENTO') selected @endif>
                                            Comissionamento
                                        </option>
                                        <option value="{{encrypt('VISIT')}}"
                                            @if ($ticket->type == 'VISITA') selected @endif>
                                            Visita
                                        </option>
                                        <option value="{{encrypt('REPORTS')}}"
                                            @if ($ticket->type == 'RELATÓRIOS') selected @endif>
                                            Relatórios
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Contract or Client -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="ticket-contract" class="form-label">
                                        Contrato/Cliente
                                    </label>
                                    <input class="form-control" type="text"
                                        id="ticket-contract" 
                                        name="ticket-contract"

                                        @if ($ticket->is_contract)
                                            value="{{
                                                $ticket->contract->client->is_corporate ? 
                                                    $ticket->contract->client->corporate_name :
                                                    $ticket->contract->client->name
                                            }}"
                                        @else
                                            value="{{
                                                $ticket->client->is_corporate ? 
                                                    $ticket->client->corporate_name :
                                                    $ticket->client->name
                                            }}"
                                        @endif
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Requester -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="ticket-contract" class="form-label">
                                        Solicitante
                                    </label>
                                    <input class="form-control" type="text"
                                        id="ticket-contract" 
                                        name="ticket-contract"
                                        value="{{$ticket->requester}}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Created at -->
                            <div class="col-12">
                                <p>
                                    <span class="fw-bold">Criado em:</span>
                                    {{date('d/m/Y - H:i:s', strToTime($ticket->created_at))}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Historic -->
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Histórico</h4>
                    </div>
                    <div class="card-body @if (count($ticket->log) > 0) overflow-y-scroll @endif"
                        style="max-height: 43.313rem"
                        id="ticket-log-card">
                        <ul class="list-group" id="ticket-log">
                            @if (count($ticket->log) == 0)
                                <li id="ticket-log-empty">
                                    <p class="text-primary fw-bold mb-0">
                                        <i class="bi bi-card-list"></i>
                                        Nenhum item para mostrar
                                    </p>
                                </li>
                            @else
                                @foreach ($ticket->log as $key => $log)
                                    <li class="rounded mb-3" id="log-new-{{$key + 1}}"
                                        data-log-item>
                                        <div class="d-flex w-100 justify-content-between rounded-top bg-light bg-gradient border border-gray p-3 pt-2 pb-2"
                                            id="log-header-{{$key + 1}}">
                                            <small class="text-primary fw-bold"
                                                id="log-author-{{$key + 1}}">
                                                {{$log->message}}
                                            </small>
                                            <small id="log-data-{{$key + 1}}">
                                                {{date('d/m/Y - H:i:s', strtotime($log->created_at))}}
                                            </small>
                                        </div>
                                        <div class="border border-gray border-top-0 rounded-bottom p-3"
                                            id="log-text-{{$key + 1}}">
                                            <p class="mb-0">
                                                <span class="fw-bold">Realizado por:</span> {{$log->user->name}}
                                            </p>

                                            @if ($log->old_value == null)
                                                @if ($log->field == 'PRAZO')
                                                    <p class="mb-0">
                                                        &ndash; Atualizado para <span class="text-warning">{{date('d/m/Y', strtotime($log->new_value))}}</span>
                                                    </p>
                                                @elseif ($log->field == 'RESPONSÁVEIS')
                                                    <p class="mb-0">
                                                        &ndash; Atualizado para 
                                                        <span class="text-warning">
                                                            @foreach ($log->new_value as $new_responsible)
                                                                {{'[' . $new_responsible . ']'}}
                                                            @endforeach
                                                        </span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        &ndash; Atualizado para <span class="text-warning">{{$log->new_value}}</span>
                                                    </p>
                                                @endif
                                            @else
                                                @if ($log->field == 'PRAZO')
                                                    <p class="mb-0">
                                                        &ndash; Modificado de <span class="text-warning">{{date('d/m/Y', strtotime($log->old_value))}}</span> para <span class="text-warning">{{date('d/m/Y', strtotime($log->new_value))}}</span>
                                                    </p>
                                                @elseif ($log->field == 'RESPONSÁVEIS')
                                                    <p class="mb-0">
                                                        &ndash; Modificado de 
                                                        <span class="text-warning">
                                                            @foreach ($log->old_value as $old_responsible)
                                                                {{'[' . $old_responsible . ']'}}
                                                            @endforeach
                                                        </span> 
                                                        para
                                                        <span class="text-warning">
                                                            @foreach ($log->new_value as $new_responsible)
                                                                {{'[' . $new_responsible . ']'}}
                                                            @endforeach
                                                        </span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        &ndash; Modificado de <span class="text-warning">{{$log->old_value}}</span> para <span class="text-warning">{{$log->new_value}}</span>
                                                    </p>
                                                @endif
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Ticket Comments -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Comentários</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-5">
                        <div class="card">
                            <div class="card-body p-0">
                                <form action="#" method="POST"
                                    class="mb-0"
                                    onsubmit="return false">
                                    @csrf

                                    <div class="row">
                                        <!-- Comments responsibles -->
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="ticket-comments-responsibles" 
                                                    class="form-label">
                                                    Responsáveis
                                                </label>
                                                <select class="form-select"
                                                    aria-label="ticket-comments-responsibles multiple"
                                                    id="ticket-comments-responsibles"
                                                    name="ticket-comments-responsibles[]"
                                                    onchange="return window.validateSelect(this)"
                                                    onblur="return window.validateSelect(this)"
                                                    onkeyup="return window.validateSelect(this)"
                                                    multiple>
                                                    <option value="" disabled selected>
                                                        Selecione os responsáveis
                                                    </option>
        
                                                    @foreach ($users as $user)
                                                        <option value="{{encrypt($user->id)}}">
                                                            {{$user->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"
                                                    id="ticket-feedback-comments-responsibles-edit"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Comments Text -->
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="ticket-comments-text" class="form-label">
                                                    Comentário
                                                </label>
                                                <textarea class="form-control"
                                                    style="height: 6.56rem; max-height: 6.56rem"
                                                    id="ticket-comments-text"
                                                    name="ticket-comments-text"
                                                    onchange="return window.validateTextarea(this, 5, 250)"
                                                    onblur="return window.validateTextarea(this, 5, 250)"
                                                    onkeyup="return window.validateTextarea(this, 5, 250)"
                                                    rows="3"
                                                    required></textarea>
                                                <div class="invalid-feedback"
                                                    id="ticket-feedback-comments-text-edit"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <span class="bg-success text-white rounded ps-2 pe-2 me-3"
                                                style="display: none; padding-top: 3px; padding-bottom: 3px"
                                                id="btn-ticket-comment-added">
                                            </span>
                                            <button type="button"
                                                class="btn bg-success text-white rounded-end"
                                                id="btn-create-ticket-comment"
                                                onclick="return window.submitTicketComment()">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3 pe-0">
                        <div class="card">
                            <div class="card-body pt-0 ps-0 @if (count($ticket->comment) > 0) overflow-y-scroll @endif"
                                style="max-height: 25.4375rem"
                                id="ticket-comments-card">
                                <div class="d-flex justify-content-center d-none" id="ticket-comments-loading">
                                    <div class="spinner-border text-warning"
                                        style="width: 3rem; height: 3rem;"
                                        role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <ul class="list-group" id="comments-ticket">
                                    @if (count($ticket->comment) == 0)
                                        <li id="ticket-comments-empty">
                                            <p class="text-primary fw-bold mt-4 mb-0">
                                                <i class="bi bi-card-text"></i>
                                                Nenhum comentário adicionado
                                            </p>
                                        </li>
                                    @else
                                        @foreach ($ticket->comment as $key => $comment)
                                            <li class="rounded mb-3" id="comment-new-{{$key + 1}}"
                                                data-comment-item>
                                                <div class="d-flex w-100 justify-content-between rounded-top bg-light bg-gradient border border-gray p-3 pt-2 pb-2"
                                                    id="comment-header-{{$key + 1}}">
                                                    <small class="text-primary fw-bold"
                                                        id="comment-author-{{$key + 1}}">
                                                        {{$comment->comment_author}}
                                                    </small>
                                                    <small id="comment-data-{{$key + 1}}">
                                                        {{date('d/m/Y - H:i:s', strToTime($comment->comment_date))}}
                                                    </small>
                                                </div>
                                                <div class="border border-gray border-top-0 rounded-bottom p-3"
                                                    id="comment-text-{{$key + 1}}">

                                                    @if (count($comment->ticketCommentResponsible) > 0)
                                                        <span class="text-warning" style="margin-right: 3px"
                                                            id="comment-text-responsibles-{{$key + 1}}">
                                                            @foreach ($comment->ticketCommentResponsible as $responsible)
                                                                @if ($responsible->user->cellphone != null)
                                                                    @php
                                                                        $current_url = url()->current();
                                                                        $url_length = count(explode('/', $current_url)) - 1;
                                                                        $url_id = explode('/', $current_url)[$url_length];
                                                                        $url = 'http://erp.sunnyhouse.com.br/tickets/edit/' . $url_id;
                                                                    @endphp

                                                                    <a href="https://wa.me/55{{preg_replace('/[^0-9]/', '', $responsible->user->cellphone)}}/?text=Olá, {{$responsible->user->name}}! Você foi atribuído(a) a uma OS. Mais informações em {{$url}}"
                                                                        target="_blank"
                                                                        class="text-success">
                                                                        [{{$responsible->user->name}}
                                                                        <i class="bi bi-whatsapp ms-1"
                                                                            role="img" aria-label="WhatsApp"></i>]
                                                                    </a>
                                                                @else
                                                                    [{{$responsible->user->name}}]
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    @endif

                                                    {{$comment->comment_text}}
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ticket Attachments -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Anexos</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <form action="#" method="POST"
                                    class="mb-0"
                                    onsubmit="return false">
                                    @csrf

                                    <div class="row">
                                        <!-- Ticket attachment -->
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="ticket-attachment" 
                                                    class="form-label">
                                                    Anexo
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="file"
                                                        id="ticket-attachment"
                                                        name="ticket-attachment"
                                                        onchange="return window.validateFile(this), window.enableSubmitButton(this)"
                                                        required>
                                                    <span class="bg-success text-white p-2"
                                                        style="display: none"
                                                        id="btn-ticket-attachment-added">
                                                    </span>
                                                    <button type="submit"
                                                        class="btn btn-sm bg-success text-white rounded-end"
                                                        id="btn-update-ticket-attachment"
                                                        onclick="return window.submitTicketAttachment()"
                                                        disabled>
                                                        <i class="bi bi-check-circle-fill"></i>
                                                    </button>
                                                </div>
                                                <div class="invalid-feedback"
                                                    id="ticket-feedback-attachment-edit"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3 pe-0">
                        <div class="card" id="ticket-attachment-panel">
                            <div class="card-body pt-0 ps-0 overflow-y-scroll @if (count($ticket->attachment) == 0) d-none @endif" style="max-height: 25.4375rem">
                                <div class="d-flex justify-content-center d-none" id="ticket-attachment-loading">
                                    <div class="spinner-border text-warning"
                                        style="width: 3rem; height: 3rem;"
                                        role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <ul class="list-group" id="attachment-ticket">
                                    @if (count($ticket->attachment) > 0)
                                        @foreach ($ticket->attachment as $key => $attachment)
                                            <li class="rounded mb-3" id="comment-new-{{$key + 1}}"
                                                data-attachment-item>
                                                <div class="d-flex w-100 justify-content-between rounded-top bg-light bg-gradient border border-gray p-3 pt-2 pb-2"
                                                    id="attachment-header-{{$key + 1}}">
                                                    <small class="text-primary fw-bold"
                                                        id="attachment-author-{{$key + 1}}">
                                                        {{$attachment->author}}
                                                    </small>
                                                    <small id="attachment-data-{{$key + 1}}">
                                                        {{date('d/m/Y - H:i:s', strToTime($attachment->created_at))}}
                                                    </small>
                                                </div>

                                                <p class="border border-gray border-top-0 rounded-bottom p-3 mb-0"
                                                    id="attachment-text-{{$key + 1}}">
                                                    <a href="{{route('ticket_file_view', ['id' => encrypt($attachment->id)])}}" 
                                                        target="_blank">
                                                        {{$attachment->file_ticket_attachment_name}}
                                                    </a>
                                                </p>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="btn-floating">
                    <a href="{{route('tickets_index')}}"
                        class="btn btn-danger d-inline-flex align-items-center justify-content-center me-2">
                        <i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>