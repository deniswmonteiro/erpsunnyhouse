<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Sunny House</h3>
                <p class="text-subtitle text-muted">Seja Bem-Vindo.</p>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Painel Principal</h4>
            </div>
            <div class="card-body" style="height: 700px">
                <div class="row">
                    <form action="{{route('contracts_pdf_manager')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input class="form-control" type="file" id="file" name="file">
                        </div>
                        <br>
                        <button class="mt-auto btn bg-orange" type="submit">
                            <i class="bi bi-upload"></i>
                            Enviar
                        </button>
                    </form>
                </div>

                @if(isset($pdf))

                    <div class="row">
                        <br><br>
                        Conta Contrato: {{$pdf->contract}} <br>
                        Mês: {{$pdf->month}} <br>
                        Tabela de Insenção de Consumo: <br>
                        - Quantidade: {{$pdf->consumptionExemptionTableQnt}} <br>
                        - Tarifa: {{$pdf->consumptionExemptionTableTar}} <br>
                        - Valor: {{$pdf->consumptionExemptionTableVal}} <br>

                        @if(count($pdf->informationsClient)>0)
                            Tabela Informações para o Cliente:<br>
                            @foreach($pdf->informationsClient as $info)
                                - {{$info}} <br>
                            @endforeach
                        @endif
                    </div>

                @endif
            </div>
        </div>
    </section>
</x-app-layout>
