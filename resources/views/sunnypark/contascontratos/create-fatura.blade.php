@section('page_title', 'Adicionar Contas Contratos')

<script src="{{asset(mix('js/sunnypark/contascontratos/create-faturas.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Adicionar Fatura</h3>
                <p class="text-subtitle text-muted">Insira no formulário os dados da nova fatura.</p>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
    	<form id="form-create-fatura" action="{{route('sunnypark_contascontratos_store_fatura', ['id' => encrypt($id)])}}" method="post">
            @csrf

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Data fatura -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="data_fatura" class="form-label">Data Fatura (mês-ano) <span class="text-danger">*</span></label>
                                <input id="data_fatura" type="text" name="data_fatura" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Valor Faturado -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="valor_faturado" class="form-label">Valor Faturado (R$) <span class="text-danger">*</span></label>
                                <input id="valor_faturado" type="text" name="valor_faturado" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Valor Tarifa -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="valor_tarifa" class="form-label">Valor Tarifa (R$) <span class="text-danger">*</span></label>
                                <input id="valor_tarifa" type="text" name="valor_tarifa" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Tarifa Energia Compensada -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="valor_tarifa_comp" class="form-label">Tarifa Energia Compensada (R$) <span class="text-danger">*</span></label>
                                <input id="valor_tarifa_comp" type="text" name="valor_tarifa_comp" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Início do Ciclo -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="data_inicio" class="form-label">Início do Ciclo</label>
                                <div class="input-group">
                                    <input id="data_inicio" type="date" value="" 
                                        name="data_inicio"
                                        class="form-control date"
                                        {{-- required --}}>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Energia Registrada -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="energia_reg" class="form-label">Energia Registrada (kWh) <span class="text-danger">*</span></label>
                                <input id="energia_reg" type="text" name="energia_reg" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Energia Compensada -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="energia_comp" class="form-label">Energia Compensada (kWh) <span class="text-danger">*</span></label>
                                <input id="energia_comp" type="text" name="energia_comp" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Fim do Ciclo -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="data_fim" class="form-label">Fim do Ciclo</label>
                                <div class="input-group">
                                    <input id="data_fim" type="date" value="" 
                                        name="data_fim"
                                        class="form-control date"
                                        {{-- required --}}>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Energia Faturada -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="energia_fat" class="form-label">Energia Faturada <span class="text-danger">*</span></label>
                                <input id="energia_fat" type="text" name="energia_fat" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                    <button id="btn-generator" class="btn bg-success text-white float-end mt-3"
                        type="button"
                        onclick="window.submit_form_contract_create()">
                        Criar Fatura
                    </button>
                </div>
            </div>   
        </form>
    </div>
</x-app-layout>