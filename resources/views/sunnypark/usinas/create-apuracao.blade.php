@section('page_title', 'Adicionar Apuração')

<script src="{{asset(mix('js/sunnypark/usinas/create-apuracao.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Adicionar Apuração</h3>
                <p class="text-subtitle text-muted">Insira no formulário os dados da nova apuração.</p>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
        <form id="form-create-aputacao" action="{{route('sunnypark_usinas_store_apuracao', ['id' => encrypt($usina->id)])}}" method="post">
            @csrf

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Conta Contrato -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="cc" class="form-label">Conta Contrato</label>
                                <input id="cc" type="text" name="cc" class="form-control" value="{{$usina->contaContrato->cod_cc}}" readonly>
                            </div>
                        </div>

                        <!-- Produção -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="producao" class="form-label">Produção <span class="text-danger">*</span></label>
                                <input id="producao" type="text" name="producao" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Mês Ref -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="mesref" class="form-label">Mês Ref <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="mesref" type="date" value="" name="mesref" class="form-control date" required>
                                </div>
                            </div>
                        </div>

                        <!-- Tarifa -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="tarifa" class="form-label">Tarifa <span class="text-danger">*</span></label>
                                <input id="tarifa" type="text" name="tarifa" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                    <button id="btn-generator" class="btn bg-success text-white float-end mt-3"
                        type="button"
                        onclick="window.submit_form_rateio_create()">
                        Criar Rateio
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>