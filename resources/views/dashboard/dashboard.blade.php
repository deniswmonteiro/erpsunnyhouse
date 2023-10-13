@section('page_title', 'Dashboard')

<script src="{{ asset(mix('js/dashboard/dashboard.js')) }}" defer></script>

<x-app-layout>
    <x-slot name="header"></x-slot>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card bg-orange pt-3 pb-3">
                            <div class="card-header bg-orange text-center" style="padding: 5px 10px!important;">
                                <h6 class="text-light d-flex justify-content-center">
                                    <span>FILTRAR</span>
                                    <i class="bi bi-funnel-fill ms-2"></i>
                                </h6>
                            </div>
                            <div class="row text-center" style="padding-top: 20px">
                                <div class="col d-flex justify-content-center">
                                    <button type="button" class="btn btn-light d-flex align-items-center me-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal_sellers">
                                        <i class="bi bi-file-person me-2"></i>
                                        <span>{{count($sellers). '/'.count($sellers_all)}}</span>
                                    </button>
                                    <button type="button" class="btn btn-light d-flex align-items-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal_sellers_team">
                                        <i class="bi bi-shop me-2"></i>
                                        <span>{{count($sellers_team). '/'.count($sellers_team_all) }}</span>
                                    </button>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row text-center d-flex justify-content-center">
                                    <div class="col-7 col-lg-10 bg-light rounded mt-2">
                                        <div class="form-check form-switch pt-2 pb-2 d-flex align-items-center">
                                            <input class="form-check-input me-2" type="checkbox"
                                                id="flexSwitchCheck"
                                                onchange="window.change_type_update_dashboard('table_seller','form_seller', 'seller')"
                                                @if ($type) checked @endif>
                                            <small style="font-size: 12px; line-height: 1.4; color: #607080">
                                                Somente Instalação
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col" style="margin-left: 15px">
                                    <table class="table text-light table_padding_1 m-auto" style="font-size: 11px;">
                                        <tbody>
                                            <tr>
                                                <td>Orçamento do Mês</td>
                                                <td>R$ {{format_money($value_total)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Vendas do Mês</td>
                                                <td>R$ {{format_money($value_active)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card pt-3 pb-3" style="height: 225px;">
                            <div class="card-header" style="padding: 0 10px!important;">
                                <small>CONVERSÃO</small>
                            </div>
                            <div class="card-body">
                                <div class="row" style="margin-top: 15px!important;">
                                    <div class="col-4 d-flex justify-content-center" id="donut_1"
                                        style="height: 110px;padding: 0!important;">
                                    </div>
                                    <div class="col-4 d-flex justify-content-center" id="donut_2"
                                        style="height: 110px;padding: 0!important;">
                                    </div>
                                    <div class="col-4 d-flex justify-content-center" id="donut_3"
                                        style="height: 110px;padding: 0!important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card pt-3 pb-3" style="height: 225px;">
                    <div class="card-header mb-4" style="padding: 0 10px!important;">
                        <small>POTÊNCIA VENDIDA</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3" id="seller_generation_power"
                                 style="height: 130px;padding: 0!important;margin-top: 10px!important;">
                            </div>
                            <div class="col-9">
                                <h6 class="mb-3">
                                    {{
                                        ($generation_power) > 1000 ?
                                            ($generation_power/1000) . ' KWp' :
                                            $generation_power.' Wp'
                                    }}
                                    <small class="fw-light d-block">TOTAL</small>
                                </h6>
                                <div class="row">
                                    @foreach ($generation_power_array as $generation)
                                        <div class="col-4">
                                            <div style="border-left: 5px solid {{$generation['color']}};">
                                                <div style="margin-left: 5px">
                                                    <h6 style="margin-bottom: 0!important;">
                                                        {{
                                                            $generation['value']>1000 ?
                                                                ($generation['value']/1000) . ' KWp' :
                                                                $generation['value'] . ' Wp'
                                                        }}
                                                    </h6>
                                                    <small>{{$generation['name']}}</small>
                                                    <h6>
                                                        {{
                                                            ($generation_power)>0 ?
                                                                round(($generation['value']/$generation_power)*100,2) :
                                                                0
                                                        }}%
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mycontent-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card pt-3" style="height: 335px;">
                    <div class="card-header mb-4" style="padding: 0 10px!important;">
                        <small>ÚLTIMOS ORÇAMENTOS E VENDAS</small>
                    </div>
                    <div class="card-body overflow-auto">
                        <div class="row d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table" id="table_id" style="font-size: 11px;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="text-center">Cliente</th>
                                            <th scope="col" class="text-center">Tipo</th>
                                            <th scope="col" class="text-center">Data do Contrato</th>
                                            <th scope="col" class="text-center">Valor</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-1">
                                        @foreach ($contracts as $key => $contract)
                                            <tr>
                                                <td>{{$contract->client->name}}</td>
                                                <td class="text-center">
                                                    {{($contract->type == 1) ? 'Instalação' : 'Manutenção'}}
                                                </td>
                                                <td class="text-center">
                                                    {{date('d/m/Y', strToTime($contract->contract_date))}}
                                                </td>
                                                <td class="text-center">R$ {{format_money($contract->getValue())}}</td>
                                                <td class="text-center">
                                                    @switch ($contract->status)
                                                        @case (\App\Http\Controllers\ContractController::$STATUS_BUDGET)
                                                            <span class="badge bg-secondary">{{$contract->status}}</span>
                                                            @break

                                                        @case (\App\Http\Controllers\ContractController::$STATUS_HIRED)
                                                            <span class="badge bg-brown">{{$contract->status}}</span>
                                                            @break

                                                        @case (\App\Http\Controllers\ContractController::$STATUS_ACTIVE)
                                                            <span class="badge bg-info">{{$contract->status}}</span>
                                                            @break

                                                        @case(\App\Http\Controllers\ContractController::$STATUS_PENDENCY)
                                                            <span class="badge bg-danger">{{$contract->status}}</span>
                                                            @break
                                                        
                                                        @case(\App\Http\Controllers\ContractController::$STATUS_INSTALLING)
                                                            <span class="badge bg-primary">{{$contract->status}}</span>
                                                            @break
                                                        
                                                        @case(\App\Http\Controllers\ContractController::$STATUS_INSTALLED)
                                                            <span class="badge bg-warning">{{$contract->status}}</span>
                                                            @break
                                                        
                                                        @case(\App\Http\Controllers\ContractController::$STATUS_CONCLUDED)
                                                            <span class="badge bg-success">{{$contract->status}}</span>
                                                            @break

                                                        @case(\App\Http\Controllers\ContractController::$STATUS_CANCELED)
                                                            <span class="badge bg-black">{{$contract->status}}</span>
                                                            @break
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card pt-3" style="height: 335px;">
                    <div class="card-header mb-4" style="padding: 0 10px!important;">
                        <small>QUANTIDADE DE ORÇAMENTOS E VENDAS</small>
                    </div>
                    <div class="card-body overflow-auto">
                        <div id="seller_quantity" style="height: 250px;padding: 0!important;"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card pt-3 pb-3" style="height: 260px;">
                    <div class="card-header mb-4" style="padding: 0 10px !important;">
                        <small>CONTRATOS TOTAIS</small>
                    </div>
                    <div class="card-body">
                        <div id="status_quantity" style="height: 200px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card pt-3 pb-3" style="height: 260px;">
                    <div class="card-header mb-4" style="padding: 0 10px!important;">
                        <small>VALORES DE VENDAS</small>
                    </div>
                    <div class="card-body">
                        <div id="amount" style="height: 200px"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Select Sellers -->
        <div class="modal fade w-100" id="modal_sellers"
            style="color: black"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filtrar por Vendedores</h5>
                        <button type="button" class="btn-close align-self-end m-1"
                            data-bs-dismiss="modal"
                            aria-label="close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table_seller">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Equipe de Vendas</th>
                                        <th scope="col">Vendas no Mês (R$)</th>
                                        <th scope="col">
                                            Selecionar Todos
                                            <input type="checkbox" class="form-check-input"
                                                id="check_sellers"
                                                value=""
                                                @if (count($sellers) == count($sellers_all))
                                                checked
                                                @endif>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sellers_all as $key => $seller)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$seller->name}}</td>
                                            <td>{{$seller->team->name}}</td>
                                            <td>
                                                {{format_money($seller->totalSales(date('Y-m-').'01', date('Y-m-t')))}}
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox"
                                                    value=""
                                                    @if (in_collection($seller ,$sellers))
                                                        checked
                                                    @endif>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('dashboard')}}" id="form_seller">
                            @csrf
                        </form>
                        <button class="btn bg-success text-white" type="button"
                            onclick="window.submit_form_update_dashboard('table_seller','form_seller','seller')">
                            <i class="bi bi-check2-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Select Sellers Team -->
        <div class="modal fade w-100" id="modal_sellers_team"
            style="color: black"
            tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filtrar por Equipe de Vendas</h5>
                        <button type="button" class="btn-close align-self-end m-1"
                            data-bs-dismiss="modal"
                            aria-label="close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table_seller_team">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Número de Vendedores</th>
                                        <th scope="col">Vendas no Mês (R$)</th>
                                        <th scope="col">
                                            Selecionar Todos
                                            <input id="check_sellers_team" type="checkbox"
                                                class="form-check-input"
                                                value=""
                                                @if (count($sellers_team) == count($sellers_team_all))
                                                    checked
                                                @endif>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sellers_team_all as $key => $team)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$team->name}}</td>
                                            <td>Possui <strong>{{count($team->sellers)}}</strong> Vendedores.</td>
                                            <td>
                                                R$ {{format_money($team->totalSales(date('Y-m-').'01', date('Y-m-t')))}}
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox"
                                                    value=""
                                                    @if (in_collection($team ,$sellers_team)) checked @endif>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('dashboard')}}" id="form_seller_team">
                            @csrf
                        </form>
                        <button class="btn bg-success text-white" type="button"
                            onclick="window.submit_form_update_dashboard('table_seller_team','form_seller_team','seller_team')">
                            <i class="bi bi-check2-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{plotDonut2('seller_generation_power', $generation_power_array)}}
    {{plotColumn('seller_quantity', $offer_sale)}}
    {{plotLine('status_quantity', $status)}}
    {{plotBar('amount', $amount, true)}}

    @if (isset($conversion))
        {{plotDonut('donut_1', $conversion[0], '#006fb3')}}
        {{plotDonut('donut_2', $conversion[1], '#ff8c00')}}
        {{plotDonut('donut_3', $conversion[2], '#ffea44')}}
    @endif
</x-app-layout>
