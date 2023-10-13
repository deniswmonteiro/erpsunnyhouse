<x-print-layout>
    <x-slot name="header"></x-slot>

    @section('title', $title)

    <div class="page position-relative" id="power-of-attorney">
        <div class="row">
            <div class="col">
                <img style="margin-left: -38px!important;margin-top: -38px!important"
                    src="{{asset('images/contract/img_power_of_attorney.png')}}"
                    width="270px">
            </div>
            <div class="col">
                <p class="align-middle padding-top-100"><strong>PROCURAÇÃO</strong></p>
            </div>
        </div>
        <p>
            Pelo presente instrumento particular de procuração, eu, <strong>{{$contract->client->name}}</strong>,
            inscrito(a) no CPF nº <strong>{{$contract->client->cpf}}</strong>, residente e domiciliado(a) na cidade
            de {{$contract->client->address_city}}-{{$contract->client->address_state}},
            
            @if ($contract->client->is_corporate)
                responsável pela empresa <span class="fw-bold">{{$contract->client->corporate_name}}</span>, inscrito no CNPJ nº <span class="fw-bold">{{$contract->client->cnpj}}</span>,
            @endif

            constituo e nomeio meu bastante procuradores Sr(a). <strong>Rafael Feio Calandrini</strong>, portador(a) da carteira de identidade de nº
            <strong>3591215</strong>, inscrito(a) no CPF nº <strong>708.782.182-20</strong>, residente e domiciliado(a)
            na <strong> Av. Tavares Bastos, nº 1495</strong>, na cidade de Belém-PA,<strong> Nixon Menezes Girard da Silva</strong>, portador(a) da carteira de identidade de nº <strong>3478807</strong>, inscrito(a) no CPF
            nº <strong>510.830.192-87</strong>, residente e domiciliado(a) na <strong>Rod. Augusto Montenegro, nº 4900, LOTE 184</strong>, na cidade de Belém-PA; <strong>Nádia Adriana Naiff Steiner</strong>, portador(a) da
            carteira de identidade de nº <strong>2264292</strong>, inscrito(a) no CPF nº <strong>518.835.702-04</strong>, residente e domiciliado(a) na <strong>Pass. Santo Antônio, nº 120A - Altos - Souza</strong>, na
            cidade de Belém-PA; <strong>Thiago Rodrigues Brito</strong>, inscrito(a) no CPF nº <strong>379.493.718-03</strong>, residente e domiciliado(a) na <strong>WE 28, nº 371 - Cidade Nova 8</strong>, na cidade de Ananindeua-PA; e <strong>Weslley Leão Monteiro</strong>, inscrito(a) no CPF nº <strong>942.777.612-91</strong>, residente e domiciliado(a) na <strong>Tv. Angustura, nº 993 - Sacramenta</strong>, na cidade de Belém-PA, para representá-lo(a) junto à Equatorial Energia Pará e o Conselho Regional de Engenharia do Estado do Pará (CREA-PA), podendo assinar, dar e receber entradas em processos administrativos, enfim, praticar qualquer ato do interesse do outorgante.
        </p>

        <p class="text-center pt-3">
            Belém, {{$day . ' de ' . $month . ' de ' . $year . '.'}}
        </p>

        <p class="pt-3">
            X
        </p>

        <img class="position-absolute bottom-0 start-0 footer-img" style="width: 793px;"
            src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
    </div>


</x-print-layout>

