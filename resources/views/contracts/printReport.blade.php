<script src="{{asset(mix('js/contracts/printReport.js'))}}" defer></script>

<x-print-layout>
    <x-slot name="header"></x-slot>

    @section('title', $title)
        <div class="col-12 text-center mt-5 btn-print">
            <form>
                <button type="submit" class="btn btn-success text-white btn-xl"
                    onclick="event.preventDefault(); window.print()">
                    Imprimir
                </button>
            </form>
        </div>
        <div class="page">
            <div class="row">
                <div class="col">
                    <img style="margin-left: -38px!important;margin-top: -38px!important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col">
                    <p class="text-end">
                        Gerado em: {{(new DateTime())->format('d/m/Y')}}
                    </p>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-borderless display" id="report-table">
                    <thead>
                        <tr>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td colspan="6" class="text-center fw-bold">
                                Relatório de Vendas 
                                ({{implode('/', array_reverse(explode('-', $period_start)))}} &ndash; {{implode('/', array_reverse(explode('-', $period_end)))}})
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center ">#</th>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Vendedor</th>
                            <th class="text-center">Status</th>
                            <th class="text-center col-2">Valor do Contrato (R$)</th>
                            <th class="text-center col-2">Estimativa de Lucro (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contracts as $key => $contract)
                            <tr>
                                <th scope="row" class="text-center align-middle text-black">{{$key + 1}}</th>

                                @switch ($contract->client->is_corporate)
                                    @case(0)
                                        <td class="text-start text-black">{{$contract->client->name}}</td>
                                        @break

                                    @case(1)
                                        <td class="text-start text-black">{{$contract->client->corporate_name}}</td>
                                        @break
                                @endswitch
                                
                                <td class="text-start text-black">{{$contract->seller->name}}</td>
                                <td class="text-start text-black">{{Str::ucfirst(Str::lower(($contract->status)))}}</td>
                                <td class="text-center text-black">
                                    {{format_money($contract->paymentData()->value)}}
                                </td>
                                <td class="text-center text-black">
                                    {{format_money($contract->paymentData()->value * ($contract->profit_estimate / 100))}}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th class="text-black text-center fw-bold pe-5">Total</th>
                            <th class="text-black text-center">{{format_money($total_sales)}}</th>
                            <th class="text-black text-center">{{format_money($total_profit_estimate)}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-print-layout>