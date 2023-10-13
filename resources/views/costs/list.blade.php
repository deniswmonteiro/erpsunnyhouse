@section('page_title', 'Custo da Obra do Projeto')

<script src="{{asset(mix('js/costs/list.js'))}}" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Custo da Obra do Projeto</h3>
            </div>
        </div>
    </x-slot>

    <section id="costs-list">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-10">
                        <h4 class="card-title">Gerenciar Custos dos Projetos</h4>
                        <p class="card-description">
                            Por meio desta tela é possível visualizar os custos das obras dos projetos de engenharia registrados no sistema.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped pt-4" style="width: 100%" id="table_id">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Data de Criação</th>
                                    <th scope="col" class="text-center">Cliente</th>
                                    <th scope="col" class="text-center">Apelido</th>
                                    <th scope="col" class="text-center">Conta Contrato/Status da Geradora</th>
                                    <th scope="col" class="text-center">Protocolos</th>
                                    <th scope="col" class="text-center">Data do Contrato</th>
                                    <th scope="col" class="text-center">Potência do Gerador</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>