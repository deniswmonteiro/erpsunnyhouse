@section('page_title', 'Editar Usinas')

<script src="{{asset(mix('js/sunnypark/usinas/edit.js'))}}" defer></script>
<script>
    var url_ajax_usinas_validate_login_senha = "{{route('sunnypark_usinas_validate_login')}}";
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Editar Usinas</h3>
                <p class="text-subtitle text-muted">Edite os dados da usina selecionada.</p>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
    	<form id="form-update-usina" action="{{route('sunnypark_usinas_update', ['id' => encrypt($usina->id)])}}" method="post">
            @csrf

            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">Informações de Perfil</h4>
                </div> --}}
                <div class="card-body">
                	<div class="row">
                        <!-- Conta contrato -->
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="cc" class="form-label">Conta Contrato <span class="text-danger">*</span></label>
                                <input id="cc" type="text"
                                    name="cc"
                                    value="{{$usina->contaContrato->cod_cc}}"
                                    class="form-control"
                                    autocomplete="off" readonly>
                                <div class="invalid-feedback">
                                    <a id="new_cc" type="button" class="btn btn-warning" target="_self" href="{{route('sunnypark_contascontratos_create')}}">Inserir Conta Contrato</a>
                                </div>
                            </div>
                        </div> 

                        <!-- Nome -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                                <input id="nome" type="text" name="nome" class="form-control" value="{{$usina->nome}}" required>
                            </div>
                        </div>

                        <!-- Apelido -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="apelido" class="form-label">Apelido <span class="text-danger">*</span></label>
                                <input id="apelido" type="text" name="apelido" class="form-control" value="{{$usina->apelido}}" required>
                            </div>
                        </div>

                        <!-- Documento -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="documento" class="form-label">Documento <span class="text-danger">*</span></label>
                                <input id="documento" type="text" name="documento" class="form-control" value="{{$usina->documento}}" required>
                            </div>
                        </div>

                        <!-- Login -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="login" class="form-label">Login <span class="text-danger">*</span></label>
                                <input id="login" type="text" name="login" class="form-control" value="{{$usina->login}}" readonly>
                            </div>
                        </div>

                        <!-- Senha -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="senha" class="form-label">Senha <span class="text-danger">*</span></label>
                                <input id="senha" type="text" name="senha" class="form-control" value="{{$usina->senha}}" required>
                            </div>
                        </div>

                        <!-- Producao Meta -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="producaoMeta" class="form-label">Producao Meta (Kwh)<span class="text-danger">*</span></label>
                                <input id="producaoMeta" type="text" name="producaoMeta" class="form-control" value="{{$usina->producaoMeta}}" required>
                            </div>
                        </div>

                        <!-- Dia Leitura -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="diaLeitura" class="form-label">Dia Leitura <span class="text-danger">*</span></label>
                                <input id="diaLeitura" type="text" name="diaLeitura" class="form-control" value="{{$usina->diaLeitura}}" required>
                            </div>
                        </div>

                        <!-- Ciclo M+ -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="ciclo" class="form-label">Ciclo M+ <span class="text-danger">*</span></label>
                                <input id="ciclo" type="text" name="ciclo" class="form-control" value="{{$usina->ciclo}}" required>
                            </div>
                        </div>

                        <!-- Investimento -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-group">
                                <label for="investimento" class="form-label">Investimento (R$) <span class="text-danger">*</span></label>
                                <input id="investimento" type="text" name="investimento" class="form-control money" value="{{$usina->investimento}}" required>
                            </div>
                        </div>
                    </div>
                    <button id="btn-generator" class="btn bg-success text-white float-end mt-3"
                        type="button"
                        onclick="window.submit_form_contract_create()">
                        Criar Usina
                    </button>
                </div>
            </div>
		</form>
    </div>
</x-app-layout>