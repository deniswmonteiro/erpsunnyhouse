<x-print-layout>
    <x-slot name="header"></x-slot>

    @section('title', $title)

    <div class="page position-relative" id="technical-certificate">
        <div class="row justify-content-end">
            <div class="col-6">
                <p class="align-middle padding-top-50 fw-bold mb-4">
                    Atestado de Capacidade Técnica e Conclusão de Instalação Fotovoltaico
                </p>
            </div>
        </div>
        <div class="row">
            <div class="mt-3 mb-4">
                <p class="mb-0">
                    Eu, <strong>{{$contract->client->name}}</strong>, inscrito no CPF nº
                    <strong>{{$contract->client->cpf}}</strong>, atesto para os devidos fins que fui atendido pela empresa
                    <strong>S H SOLUÇÕES TECNOLÓGICAS (SUNNY HOUSE)</strong>, inscrita no CNPJ nº
                    <strong>09.445.760/0001-87</strong> e Inscrição Estadual nº <strong>152712020</strong>, sendo prestado serviços e fornecidos produtos e/ou equipamentos de Gerador Solar Fotovoltaico e que em todo o processo de instalação as expectativas foram atendidas no tocante a prazo de entrega, qualidade e atendimento aos requisitos para a geração de energia com módulos fotovoltaicos, sem qualquer pendência.
                </p>
                <p>
                    Ademais, estou ciente que, na presente data, se inicia o prazo de <strong>12 meses de garantia de instalação.</strong>
                </p>
            </div>
        </div>
        <div class="row">
            <div>
                <h2 class="text-black">Produtos Fornecidos:</h2>
                <p>
                    Projeto Gerador Solar Fotovoltaico em sistema conectado <strong>ON GRID</strong> de 
                    <strong>{{$contract->getGeneratorPowerPrint()}}</strong>.
                </p>
            </div>
            <div class="mt-2">
                <h2 class="text-black">Local de Instalação:</h2>
                <p class="mb-0">
                    {{$contract->client->address}}, {{$contract->client->address_number}}
                </p>
                <p>
                    {{$contract->client->address_city}}/{{$contract->client->address_state}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="mt-5 mb-5">
                <p class="text-center">
                    Belém, {{$day . ' de ' . $month . ' de ' . $year . '.'}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mt-5 signature-line">
                <ul class="list-group">
                    <li class="list-group-item p-0">{{$contract->client->name}}</li>
                    <li class="list-group-item p-0">CPF: {{$contract->client->cpf}}</li>
                </ul>
            </div>
        </div>
    </div>
</x-print-layout>