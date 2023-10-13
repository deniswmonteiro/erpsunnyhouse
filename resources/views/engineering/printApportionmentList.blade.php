<x-print-layout>
    <x-slot name="header"></x-slot>

    @section('title', $title)

    <div class="page position-relative" id="apportionment-list">
        <div class="row border border-2 border-dark border-bottom-0">
            <div class="col-2 d-flex p-0">
                <img src="{{asset('images/logo/equatorial-logo.svg')}}"
                    style="width: 110px">
            </div>
            <div class="col-10 text-center pt-1 pb-1">
                <span class="text-uppercase fw-bold" style="font-size: 12px !important">
                    Lista de Rateio para as Unidades Consumidoras Participantes do Sistema de Compensação
                </span>
                <span class="d-block fw-bold" style="font-size: 12px !important">
                    (Autoconsumo Remoto, Geração Compartilhada e EMUC)
                </span>
            </div>
        </div>

        <div class="row border border-2 border-dark border-top-0 border-bottom-0 border-end-1">
            <div class="col-4 border border-dark border-bottom-0 border-start-0 border-end-0 p-0 ps-1 pe-1">
                <span class="fw-bold" style="font-size: 12px !important">Conta Contrato da UC geradora</span>
            </div>
            <div class="col-3 border border-dark border-bottom-0 border-end-0 text-center p-0 ps-1 pe-1">
                <span class="fw-bold" style="font-size: 12px !important">
                    {{$effective_date->generator->generator_contract_account}}
                </span>
            </div>
            <div class="col-2 border border-dark border-bottom-0 border-end-0 p-0 ps-1 pe-1">
                <span class="fw-bold" style="font-size: 12px !important">Enquadramento</span>
            </div>
            <div class="col-3 border border border-dark border-bottom-0 border-end-0 text-center p-0 ps-1 pe-1">
                <span class="fw-bold" style="font-size: 12px !important">
                    @switch ($effective_date->generator->generator_project_type)
                        @case ('INDIVIDUAL')
                            Individual
                            @break
                        @case ('AUTOCONSUMO_REMOTO')
                            Autoconsumo Remoto
                            @break
                        @case ('GERACAO_COMPARTILHADA')
                            Geração Compartilhada
                            @break
                        @case ('RESERVADO')
                            Reservado
                            @break
                    @endswitch
                </span>
            </div>
        </div>

        <div class="row border border-2 border-dark border-top-0 border-bottom-0 border-end-1">
            <div class="col-3 border border-dark border-bottom-0 border-start-0 border-end-0 text-start p-0 ps-1 pe-2"
                style="width: auto">
                <span class="fw-bold" style="font-size: 12px !important">Local da solicitação</span>
            </div>
            <div class="col-5 border border-1 border-dark border-bottom-0 border-end-0 text-center p-0 ps-1 pe-1"
                style="width: 347px">
                <span class="fw-bold text-uppercase" style="font-size: 10px !important">
                    {{$effective_date->generator->generator_address}}
                </span>
            </div>
            <div class="col-2 border border-1 border-dark border-bottom-0 border-end-0 text-start p-0 ps-1 pe-1">
                <span class="fw-bold" style="font-size: 12px !important">Data solicitação</span>
            </div>
            <div class="col-2 border border-1 border-dark border-bottom-0 border-end-0 text-center p-0 ps-1 pe-1">
                <span class="fw-bold text-center" style="font-size: 12px !important">
                    {{date('d/m/Y', strtotime($effective_date->effective_date))}}
                </span>
            </div>
        </div>

        <div class="row">
            <table class="table table-bordered border border-2 border-dark border-top-0">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10px"></th>
                        <th scope="col" class="text-center fw-bold p-1" style="font-size: 12px !important">
                            % kWh
                        </th>
                        <th scope="col" class="text-center fw-bold p-1" style="font-size: 12px !important">
                            Conta Contrato
                        </th>
                        <th scope="col" class="text-center fw-bold p-1" style="font-size: 12px !important">
                            Classe de Consumo
                        </th>
                        <th scope="col" class="text-center fw-bold text-uppercase p-1"
                            style="font-size: 12px !important">
                            Endereço
                        </th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach ($effective_date->beneficiary as $key => $beneficiary)
                        <tr>
                            <td class="text-center p-1" style="font-size: 12px !important">{{$key + 1}}</td>
                            <td class="text-center text-dark p-1" style="font-size: 12px !important">
                                {{number_format($beneficiary->beneficiary_rate, 5, ',', '.')}}
                            </td>
                            <td class="text-center p-1" style="font-size: 12px !important">
                                {{$beneficiary->beneficiary_contract_account}}
                            </td>
                            <td class="text-center p-1" style="font-size: 12px !important">
                                @switch ($beneficiary->beneficiary_consumption_class)
                                    @case ('RESIDENCIAL')
                                        Residencial
                                        @break
                                    @case ('INDUSTRIAL')
                                        Industrial
                                        @break
                                    @case ('COMERCIO_SERVICOS_OUTROS')
                                        Comércio, Serviço e outras atividades
                                        @break
                                    @case ('RURAL')
                                        Rural
                                        @break
                                    @case ('PODER_PUBLICO')
                                        Poder Público
                                        @break
                                    @case ('ILUMINACAO_PUBLICA')
                                        Iluminação Pública
                                        @break
                                    @case ('SERVICO_PUBLICO')
                                        Serviço Público
                                        @break
                                    @case ('CONSUMO_PROPRIO')
                                        Consumo Próprio
                                        @break
                                @endswitch
                            </td>
                            <td class="text-start p-1" style="font-size: 12px !important">
                                {{$beneficiary->beneficiary_address}}
                            </td>
                        </tr>
                    @endforeach

                    @for ($i = $key + 1; $i < 30; $i++)
                        <tr>
                            <td class="text-center p-1" style="font-size: 12px !important">{{$i + 1}}</td>
                            <td class="p-1"></td>
                            <td class="p-1"></td>
                            <td class="p-1"></td>
                            <td class="p-1"></td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <td scope="row" class="text-center fw-bold border border-dark text-uppercase p-0 ps-1 pe-1"
                            style="font-size: 12px !important">
                            Total
                        </td>
                        <td scope="row" class="text-center fw-bold border border-dark p-0 ps-1 pe-1"
                            style="font-size: 12px !important; background-color: #02AF52">
                            {{number_format($rate_sum, 5, ',', '.')}}
                        </td>
                        <td scope="row" colspan="3" style="background-color: #808080"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-print-layout>