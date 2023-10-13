@section('page_title', 'Editar Conta Contrato')

<script src="{{asset(mix('js/sunnypark/contascontratos/edit.js'))}}" defer></script>
<x-app-layout>
	<x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Editar Conta Contrato</h3>
                <p class="text-subtitle text-muted">Edite os dados da conta contrato selecionada.</p>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
    	<form id="form-update-contract" action="{{route('sunnypark_contascontratos_update', ['id' => encrypt($cc->id)])}}" method="post">
            @csrf

            <div class="card">
            	<div class="card-body">
                    <div class="row">
                    	<!-- CC -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="unidade" class="form-label">Código da unidade consumidora <span class="text-danger">*</span></label>
                                <input id="unidade" type="text" name="unidade" class="form-control" value="{{$cc->cod_cc}}" required>
                            </div>
                        </div>

                        <!-- Apelido -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="apelido" class="form-label">Apelido <span class="text-danger">*</span></label>
                                <input id="apelido" type="text" name="apelido" class="form-control" value="{{$cc->apelido}}" required>
                            </div>
                        </div>

                        <!-- Classificação -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="classificacao" class="form-label">Classificação <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="classificacao" id="classificacao" name="classificacao" data-value="">
                                    <option value="" disabled selected></option>
                                    <option value="A1" @if($cc->classificacao == "A1") selected @endif>A1</option>
                                    <option value="A2" @if($cc->classificacao == "A2") selected @endif>A2</option>
                                    <option value="A3" @if($cc->classificacao == "A3") selected @endif>A3</option>
                                    <option value="A3a" @if($cc->classificacao == "A3a") selected @endif>A3a</option>
                                    <option value="A4" @if($cc->classificacao == "A4") selected @endif>A4</option>
                                    <option value="AS" @if($cc->classificacao == "AS") selected @endif>AS</option>
                                    <option value="B1" @if($cc->classificacao == "B1") selected @endif>B1</option>
                                    <option value="B2" @if($cc->classificacao == "B2") selected @endif>B2</option>
                                    <option value="B3" @if($cc->classificacao == "B3") selected @endif>B3</option>
                                    <option value="B4" @if($cc->classificacao == "B4") selected @endif>B4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tipo -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="tipo" class="form-label">Tipo <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="tipo" id="tipo" name="tipo" data-value="">
                                    <option value="" disabled selected></option>
                                    <option value="comercial" @if($cc->tipo_classificacao == "comercial") selected @endif>Comercial</option>
                                    <option value="rural" @if($cc->tipo_classificacao == "rural") selected @endif>Rural Agroindustrial</option>
                                    <option value="residencial" @if($cc->tipo_classificacao == "residencial") selected @endif>Residencial</option>
                                    <option value="comercial_outro" @if($cc->tipo_classificacao == "comercial_outro") selected @endif>Comercial Outros Serviços e Outras Atividades</option>
                                    <option value="comercial_servicos" @if($cc->tipo_classificacao == "comercial_servicos") selected @endif>Comercial Serviços de Comunicações e Telecomunicações</option>
                                    <option value="industrial" @if($cc->tipo_classificacao == "industrial") selected @endif>Industrial Industrial</option>
                                    <option value="rural_agro" @if($cc->tipo_classificacao == "rural_agro") selected @endif>Rural Agropecuária Rural</option>
                                    <option value="poder" @if($cc->tipo_classificacao == "poder") selected @endif>Poder público Federal</option>
                                </select>
                            </div>
                        </div>

                        <!-- Modalidade -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="modalidade" class="form-label">Modalidade tarifária <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="modalidade" id="modalidade" name="modalidade" data-value="">
                                    <option value="" disabled selected></option>
                                    <option value="convencional" @if($cc->modalidade_tarifaria == "convencional") selected @endif>Convencional</option>
                                    <option value="branca" @if($cc->modalidade_tarifaria == "branca") selected @endif>Tárifa Branca</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button id="btn-generator" class="btn bg-success text-white float-end mt-3"
                        type="button"
                        onclick="window.submit_form_contract_create()">
                        Editar Conta Contrato
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>