<table class="table table-striped pt-4" style="width: 100%" id="table-tickets-{{$type}}">
    <thead>
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Título</th>
            <th scope="col" class="text-center">Contrato/Cliente</th>
            <th scope="col" class="text-center">Apelido</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Tipo</th>
            <th scope="col" class="text-center">Responsáveis</th>
            <th scope="col" class="text-center">Criação</th>
            <th scope="col" class="text-center">Prazo</th>
            <th scope="col" class="text-center">Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $key => $ticket)
            <tr>
                <td class="text-center">
                    {{$key + 1}}
                </td>
                <td>
                    {{$ticket->title}}
                </td>
                <td>
                    @if ($ticket->is_contract)
                        {{
                            $ticket->contract->client->is_corporate ?
                                $ticket->contract->client->corporate_name :
                                $ticket->contract->client->name
                        }}

                        {{
                            $ticket->contract->nickname ?
                                '(' . $ticket->contract->nickname . ')' :
                                ''
                        }}
                    @else
                        {{
                            $ticket->client->is_corporate ?
                                $ticket->client->corporate_name :
                                $ticket->client->name
                        }}

                        {{
                            $ticket->nickname ?
                                '(' . $ticket->nickname . ')' :
                                ''
                        }}
                    @endif
                </td>
                <td>
                    @if ($ticket->is_contract)
                        {{$ticket->contract->nickname}}
                    @else
                        {{$ticket->client->nickname}}
                    @endif
                </td>
                <td class="status position-relative text-center">
                    @switch ($ticket->status)
                        @case ("ABERTO")
                            <span class="badge fw-bold bg-secondary">
                                <span>{{$ticket->status}}</span>
                                <i class="bi bi-pencil-fill d-none"></i>
                            </span>
                        @break

                        @case ("EM_ANDAMENTO")
                            <span class="badge fw-bold bg-info">
                                <span>{{Str::of($ticket->status)->replace('_', ' ')}}</span>
                                <i class="bi bi-pencil-fill d-none"></i>
                            </span>
                        @break

                        @case ("EM_ESPERA")
                            <span class="badge fw-bold bg-warning">
                                <span>{{Str::of($ticket->status)->replace('_', ' ')}}</span>
                                <i class="bi bi-pencil-fill d-none"></i>
                            </span>
                        @break

                        @case ("CONCLUÍDO")
                            <span class="badge fw-bold bg-success">
                                <span>{{$ticket->status}}</span>
                                <i class="bi bi-pencil-fill d-none"></i>
                            </span>
                        @break

                        @case ("CANCELADO")
                            <span class="badge fw-bold bg-danger">
                                <span>{{$ticket->status}}</span>
                                <i class="bi bi-pencil-fill d-none"></i>
                            </span>
                        @break
                    @endswitch
                </td>
                <td class="text-center">
                    {{Str::of($ticket->type)->lower()->ucfirst()}}
                </td>
                
                @if (count($ticket->responsible) != 0)
                    <td>
                        @foreach ($ticket->responsible as $responsible)
                            <p class="mt-1 mb-1">
                                <span class="badge bg-brown fw-bold">
                                    {{$responsible->user->name}}
                                </span>
                            </p>
                        @endforeach
                    </td>
                @else
                    <td class="text-center">
                        &ndash;
                    </td>
                @endif
                
                <td class="text-center">
                    {{$ticket->created_at->format('d/m/Y')}}
                </td>
                <td class="text-center">
                    @if ($ticket->deadline != null)
                        {{date('d/m/Y', strToTime($ticket->deadline))}}
                    @else
                        &ndash;
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <form method="GET"
                            action="{{route('tickets_edit', ['id' => encrypt($ticket->id)])}}"
                            class="me-2 mb-0 align-self-center">
                            <button type="submit"
                                class="btn bg-success justify-content-center align-items-center text-white">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </button>
                        </form>

                        @if (Auth::user()->category_id == 1 || Auth::user()->category_id == 3)
                            <!-- Ticket delete -->
                            <a class="btn bg-danger text-white"
                                    data-bs-toggle="modal"
                                    data-bs-dismiss="modal"
                                    data-bs-target="#modal-delete-{{$key}}">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>