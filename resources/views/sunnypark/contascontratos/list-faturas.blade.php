@section('page_title', 'Faturas')

<script src="{{asset(mix('js/sunnypark/contascontratos/list-faturas.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Faturas</h3>
            </div>
        </div>
    </x-slot>

    <!-- View -->
    <div>
    	<div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Faturas</h4>
                        <p class="card-description">
                            Por meio desta tela é possível realizar o gerenciamento das faturas.
                        </p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <a class="btn bg-orange btn-szie d-flex justify-content-center align-items-center" href="{{route('sunnypark_contascontratos_create_fatura', ['id' => encrypt($id)])}}">
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
                                <th scope="col" class="text-center">Data Fatura</th>
                                <th scope="col" class="text-center">Valor Faturado</th>
                                <th scope="col" class="text-center">Valor Tarifa</th>
                                <th scope="col" class="text-center">Tarifa Energia Compensada</th>
                                <th scope="col" class="text-center">Início do Ciclo</th>
                                <th scope="col" class="text-center">Energia Registrada</th>
                                <th scope="col" class="text-center">Energia Compensada</th>
                                <th scope="col" class="text-center">Fim do Ciclo</th>
                                <th scope="col" class="text-center">Energia Faturada</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($faturas as $key => $fatura)
                                <tr>
                                    <td class="text-center">{{$key + 1}}</td>
                                    <td>
                                        {{$fatura->data_fatura}}
                                    </td>
                                    <td>
                                    	R$ {{format_money($fatura->valor_faturado)}}
                                    </td>
                                    <td>
                                    	R$ {{format_money($fatura->valor_tarifa)}}
                                    </td>
                                    <td>
                                    	R$ {{format_money($fatura->valor_tarifa_energia)}}
                                    </td>
                                    <td>
                                    	{{isset($fatura->data_inicio_ciclo) ? date('d/m/Y', strToTime($fatura->data_inicio_ciclo)) : "-"}}
                                    </td>
                                    <td>
                                    	{{$fatura->kwh_energia_registrada}} kWh
                                    </td>
                                    <td>
                                    	{{$fatura->kwh_energia_compensada}} kWh
                                    </td>
                                    <td>
                                    	{{isset($fatura->data_fim_ciclo) ? date('d/m/Y', strToTime($fatura->data_fim_ciclo)) : "-"}}
                                    </td>
                                    <td>
                                        {{$fatura->kwh_faturada}} kWh
                                    </td>
                                    <td>
                                        
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
</x-app-layout>