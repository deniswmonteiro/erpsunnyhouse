<x-print-layout>
    <x-slot name="header"></x-slot>

    @section('title', $title)

    <div class="page position-relative" id="receipt-of-payment">
        @if ($logo)
            <div class="row">
                <div class="col">
                    <img style="margin-left: -38px !important; margin-top: -38px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="270px">
                </div>
                <div class="col">
                    <p class="align-middle padding-top-100"><strong>Recibo de Pagamento</strong></p>
                </div>
            </div>
        @else
            <div class="row justify-content-end">
                <div class="col-6">
                    <h1 class="align-middle padding-top-100 mb-4"><strong>Recibo de Pagamento</strong></h1>
                </div>
            </div>
        @endif

        <div class="row">
            <p class="mt-3">
                Recebemos de 
                
                @if($contract->client->is_corporate)
                    <strong>{{$contract->client->corporate_name}}</strong>, CNPJ nº <strong>{{$contract->client->cnpj}}</strong>,
                @else
                    <strong>{{$contract->client->name}}</strong>, CPF nº <strong>{{$contract->client->cpf}}</strong>,
                @endif
                
                a quantia de <strong>R$ {{$amount}}</strong>, referente ao(a) {{lcfirst($description)}}, dando-lhe por este recibo a devida quitação.
            </p>
        </div>

        <div class="row">
            <p class="text-center pt-5 pb-5">
                Belém, {{$day . ' de ' . $month . ' de ' . $year . '.'}}
            </p>
        </div>

        <div class="row">
            <div class="col-5 mt-5">
                <img src="{{asset('images/contract/signature.png')}}"
                    class="img-fluid ms-4"
                    id="img-signature"
                    style="max-width: 60%">
                <div class="signature-line">
                    <ul class="list-group">
                        <li class="list-group-item p-0">Nixon Menezes Girard da Silva</li>
                        <li class="list-group-item p-0">Sunny House</li>
                        <li class="list-group-item p-0">CNPJ: 09.445.760/0001-87</li>
                    </ul>
                </div>
            </div>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>
</x-print-layout>