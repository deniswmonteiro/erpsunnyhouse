@section('page_title', 'Usina')

<script src="{{asset(mix('js/sunnypark/usinas/list-all.js'))}}" defer></script>

<x-app-layout>
	<x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Usina</h3>
            </div>
        </div>
    </x-slot>

    {{-- View --}}
    <div>
    	{{-- Listagem --}}
        <div class="card">
            {{-- <div class="card-header">
                <h4 class="card-title">Contas Contratos</h4>
            </div> --}}
            <div class="card-body">
            	<div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4" id="table_id">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">C. Contrato</th>
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Apelido</th>
                                <th scope="col" class="text-center">Documento</th>
                                <th scope="col" class="text-center">Login</th>
                                <th scope="col" class="text-center">Meta</th>
                                <th scope="col" class="text-center">Dia leitura</th>
                                <th scope="col" class="text-center">Investimento</th>
                                <th scope="col" class="text-center">Ciclo</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{$usina->contaContrato->cod_cc}}
                                    </td>
                                    <td>
                                        {{$usina->nome}}
                                    </td>
                                    <td>
                                        {{$usina->apelido}}
                                    </td>
                                    <td>
                                        {{$usina->documento}}
                                    </td>
                                    <td>
                                        {{$usina->login}}<br>
                                        {{$usina->senha}}
                                    </td>
                                    <td>
                                        {{$usina->producaoMeta}} Kwh
                                    </td>
                                    <td>
                                        {{$usina->diaLeitura}}
                                    </td>
                                    <td>
                                        R$ {{$usina->investimento}}
                                    </td>
                                    <td>
                                        {{$usina->ciclo}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Rateio --}}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Lista de rateio</h4>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <a class="btn bg-orange btn-szie d-flex justify-content-center align-items-center" href="{{route('sunnypark_usinas_create_rateio', ['id' => encrypt($usina->id)])}}">
                            <i class="bi bi-plus-lg me-1"></i> Novo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            	<div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4 table_render">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">Vigencia</th>
                                <th scope="col" class="text-center">C. Contrato</th>
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Endereço</th>
                                <th scope="col" class="text-center">Rateio</th>
                                <th scope="col" class="text-center">Ciclo M+</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Aputação --}}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Apurações</h4>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <a class="btn bg-orange btn-szie d-flex justify-content-center align-items-center" href="{{route('sunnypark_usinas_create_apuracao', ['id' => encrypt($usina->id)])}}">
                            <i class="bi bi-plus-lg me-1"></i> Novo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            	<div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4 table_render">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">Mês Ref</th>
                                <th scope="col" class="text-center">Produção</th>
                                <th scope="col" class="text-center">Desempenho</th>
                                <th scope="col" class="text-center">Valor</th>
                                <th scope="col" class="text-center">Rendimento</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>