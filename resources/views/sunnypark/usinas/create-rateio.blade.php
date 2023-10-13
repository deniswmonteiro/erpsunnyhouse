@section('page_title', 'Adicionar Rateio')

<script src="{{asset(mix('js/sunnypark/usinas/create-rateio.js'))}}" defer></script>
<script>
    var cc = @json($cc);
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Adicionar Rateio</h3>
                <p class="text-subtitle text-muted">Insira no formulário os dados da novo rateio.</p>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
        <form id="form-create-rateio" action="{{route('sunnypark_usinas_store_rateio', ['id' => encrypt($usina->id)])}}" method="post">
            @csrf

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Conta contrato Beneficiaria -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="cc" class="form-label">Conta Contrato Beneficiaria <span class="text-danger">*</span></label>
                                <input id="cc" type="text"
                                    name="cc"
                                    value=""
                                    class="form-control"
                                    autocomplete="off" required>
                                <div class="invalid-feedback">
                                    <a id="new_cc" type="button" class="btn btn-warning" target="_self" href="{{route('sunnypark_contascontratos_create')}}">Inserir Conta Contrato</a>
                                </div>
                            </div>
                        </div> 

                        <!-- Conta Contrato Geradora -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="cc_geradora" class="form-label">Conta Contrato Geradora</label>
                                <input id="cc_geradora" type="text" name="cc_geradora" class="form-control" value="{{$usina->contaContrato->cod_cc}}" readonly>
                            </div>
                        </div>

                        <!-- Rateio -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="rateio" class="form-label">Rateio <span class="text-danger">*</span></label>
                                <input id="rateio" type="text" name="rateio" class="form-control" value="" required>
                            </div>
                        </div>

                        <!-- Vigência -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="vigencia" class="form-label">Vigência <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="vigencia" type="date" value="" name="vigencia" class="form-control date" required>
                                </div>
                            </div>
                        </div>

                        <!-- Ciclo M+ -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="form-group">
                                <label for="ciclocreditos" class="form-label">Ciclo M+ <span class="text-danger">*</span></label>
                                <input id="ciclocreditos" type="text" name="ciclocreditos" class="form-control" value="" required>
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