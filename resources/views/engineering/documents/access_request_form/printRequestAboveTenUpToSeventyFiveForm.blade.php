<x-print-layout>
    <x-slot name="header"></x-slot>

    @section('title', $title)

    <div class="page position-relative" id="request-second-1">
        <div class="border border-2 border-bottom-0 border-dark" style="padding: 2px 8px !important">
            <div class="row border border-2 border-dark">
                <div class="col-2 d-flex p-0">
                    <img src="{{asset('images/logo/equatorial-logo.svg')}}"
                        style="width: 100px">
                </div>
                <div class="col-10 text-center pt-3 pb-3">
                    <h1 class="text-uppercase fw-bold text-black" style="font-size: 10px !important">
                        NT.020.EQTL.Normas e Padrões
                    </h1>
                    <h2 class="d-block fw-bold text-black mb-0" style="font-size: 10px !important">
                        ANEXO II - Formulário de Solicitação de Acesso para Microgeração Distribuída acima de 10 kW
                    </h2>
                </div>
            </div>
            <div class="row border border-2 border-dark p-1 mt-2 mb-2">
                <h1 class="text-black fw-bold mb-0 p-0" style="font-size: 8px !important">
                    Informações das Unidades Geradoras (UG): (<span class="text-danger" style="font-size: 8px !important">PREENCHER CONFORME O TIPO DE FONTE DE GERAÇÃO</span>)
                </h1>
            </div>
            
            <!-- Photovoltaic Solar -->
            <div class="row mt-3 mb-3">
                <h2 class="text-black" style="font-size: 8px !important">
                    1. Solar Fotovoltáica
                </h2>
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Item
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Potência do Módulo (W)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Quantidade
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Potência de Pico (kWp):
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Área de Arranjo (m<sup>2</sup>):
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Fabricante(s) dos Módulos
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Módulo
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @foreach ($form_data as $key => $data)
                            @if ($key == 'solar')
                                @foreach ($data as $key => $solar_item)
                                    <tr>
                                        <th scope="row" class="text-center align-middle p-1">
                                            {{Str::of($key)->substr(-1)}}
                                        </th>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$solar_item['module-power']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$solar_item['quantity']}}
                                        </td>
                                        <td class="text-center p-1">
                                            {{$solar_item['peak-power']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$solar_item['arrangement-area']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$solar_item['module-manufacturers']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$solar_item['module-model']}}
                                        </td>
                                    </tr>
                                @endforeach

                                @for ($i = count($data) + 1; $i <= 10; $i++)
                                    <tr>
                                        <th scope="row" class="text-center align-middle p-1">
                                            {{$i}}
                                        </th>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                    </tr>
                                @endfor
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot class="border-top-0">
                        <tr>
                            <td scope="row" class="text-center fw-bold text-uppercase p-1">
                                Total
                            </td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="text-center fw-bold p-1">
                                {{number_format($abovetenuptoseventyfive_solar_qty_sum, 0, ',', '.')}}
                            </td>
                            <td scope="row" class="text-center fw-bold p-1">
                                {{number_format($abovetenuptoseventyfive_solar_peakpower_sum, 2, ',', '.')}}
                            </td>
                            <td scope="row" class="text-center fw-bold p-1">
                                {{number_format($abovetenuptoseventyfive_solar_arrangementarea_sum, 2, ',', '.')}}
                            </td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                        </tr>
                    </tfoot>
                </table>
                
                <p class="font-italic mb-0">
                    Obs.: Célula fotovoltaica é a unidade básica, módulo é o conjunto de células e arranjo é o agrupamento de módulos, o gerador
                </p>
            </div>

            <div class="row mb-3">
                <!-- Inverters Data -->
                <h2 class="text-black" style="font-size: 8px !important">
                    2. Dados dos Inversores
                </h2>
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center p-1" style="width: 35px">
                                Item
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Fabricante*
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Modelo*
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8; width: 60px">
                                Potência Nominal (kW)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8; width: 90px">
                                Faixa de tensão de operação (V)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8; width: 75px">
                                Corrente Nominal (A)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8; width: 75px">
                                Fator de Potência
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8; width: 75px">
                                Rendimento (%)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8; width: 90px">
                                DHT de Corrente (%)
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @foreach ($form_data as $key => $data)
                            @if ($key == 'inverter')
                                @foreach ($data as $key => $inverter_item)
                                    <tr>
                                        <th scope="row" class="text-center align-middle p-1">
                                            {{Str::of($key)->substr(-1)}}
                                        </th>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$inverter_item['manufacturer']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$inverter_item['model']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$inverter_item['rated-power']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$inverter_item['initial-voltage']}}-{{$inverter_item['final-voltage']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$inverter_item['rated-current']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$inverter_item['power-factor']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            {{$inverter_item['yield']}}
                                        </td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6">
                                            ≤{{$inverter_item['current-dht']}}
                                        </td>
                                    </tr>
                                @endforeach

                                @for ($i = count($data) + 1; $i <= 10; $i++)
                                    <tr>
                                        <th scope="row" class="text-center align-middle p-1">
                                            {{$i}}
                                        </th>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                        <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                    </tr>
                                @endfor
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot class="border-top-0">
                        <tr>
                            <td scope="row" class="text-center fw-bold text-uppercase p-1">
                                Total
                            </td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="text-center fw-bold p-1">
                                {{number_format($abovetenuptoseventyfive_inverter_ratedpower_sum, 2, ',', '.')}}
                            </td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                        </tr>
                    </tfoot>
                </table>
                
                <p class="font-italic mb-0">
                    Obs: Unidades Geradoras Fotovoltáicas e Eólicas
                </p>
            </div>

            <!-- Wind -->
            <div class="row mb-3">
                <h2 class="text-black" style="font-size: 8px !important">
                    3. Eólica
                </h2>
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center p-1">
                                Item
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Fabricante/Modelo
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Eixo do rotor (horizontal/vertical)*
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Altura Máxima da Pá (m)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Diâmetro do rotor (m)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Controle de Potência <sup>(1)</sup>
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8; width: 75px !important">
                                Velocidade de rotação nominal/Sobrevelocidade máxima (rpm)
                            </th>
                            <th colspan="2" class="text-center p-0" style="background-color: #D8D8D8">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="border: none !important">
                                                Velocidade do Vento (m/s)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        <tr>
                                            <td style="border-left: none !important; border-bottom: none !important">
                                                Entrada em serviço (cut-in)
                                            </td>
                                            <td style="border-right: none !important; border-bottom: none !important">
                                                Saída de serviço (cut-out)
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                            <th colspan="2" class="text-center p-0" style="background-color: #D8D8D8">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="border: none !important">
                                                Potência Gerada (kW)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        <tr>
                                            <td style="border-left: none !important; border-bottom: none !important">
                                                Entrada em serviço (cut-in)
                                            </td>
                                            <td style="border-right: none !important; border-bottom: none !important">
                                                Saída de serviço (cut-out)
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Momento de Inércia da Massa Girante MD2/4 (kg.m2)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Documentação de certificação da turbina <sup>(2)</sup>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @for ($i = 1; $i <= 10; $i++)
                            <tr>
                                <th scope="row" class="text-center align-middle p-1">
                                    {{$i}}
                                </th>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6; width: 43.7px !important"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6; width: 43.7px !important"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot class="border-top-0">
                        <tr>
                            <td scope="row" class="text-center fw-bold text-uppercase p-1">
                                Total
                            </td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1"></td>
                            <td scope="row" class="p-1"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                        </tr>
                    </tfoot>
                </table>
                
                <p class="font-italic">
                    Obs: No caso de aerogerador não convencional informar a altura máxima atingida pela estrutura.
                </p>
                <p class="mb-1">
                    <sup>(1)</sup> Passo variável(Stall), Estol(pitch), Estol ativo (active stall), etc.
                </p>
                <p class="mb-0">
                    <sup>(2)</sup> Data
                </p>
            </div>

            <!-- Hydraulics -->
            <div class="row mt-3 mb-3">
                <h2 class="text-black" style="font-size: 8px !important">
                    4. Hidráulica
                </h2>
                <table class="table table-bordered mb-1">
                    <thead>
                        <tr>
                            <th class="text-center p-1">
                                Item
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Rio
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Bacia / SubBacia
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Tipo turbina
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Fabricante Turbina
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Potência Turbina (kVA)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Fabricante Gerador
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Potência do Gerador (kVA)
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Fator de Potência do Gerador
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Potência do Gerador (kW)
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @for ($i = 1; $i <= 3; $i++)
                            <tr>
                                <th scope="row" class="text-center align-middle p-1">
                                    {{$i}}
                                </th>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                                <td class="text-center p-1" style="background-color: #FFE7D6"></td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot class="border-top-0">
                        <tr>
                            <td scope="row" class="text-center fw-bold text-uppercase p-1">
                                Total
                            </td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1"></td>
                            <td scope="row" class="p-1" style="background-color: #808080"></td>
                            <td scope="row" class="p-1"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="page position-relative" id="request-second-2">
        <div class="border border-2 border-top-0 border-dark p-1" style="padding: 2px 8px !important">
            <!-- Thermal -->
            <div class="row">
                <h2 class="text-black" style="font-size: 8px !important">
                    5. Térmica (Biomassa/Solar Térmica/Cogeração)
                </h2>
                <table class="table table-bordered mb-1">
                    <thead>
                        <tr>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Informação
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Especificação
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Unidade
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Periodicidade
                            </th>
                            <th class="text-center p-1" style="background-color: #D8D8D8">
                                Observação
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <tr>
                            <td class="p-1">Fabricante das Turbinas*</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Tipo de Turbina* <sup>(1)</sup></td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Fabricante/Modelo do Gerador</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Potência Nominal de Placa</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>
                            <td class="p-1">kVA</td>

                            @for ($i = 1; $i <= 2; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Potência Máxima em Regime Contínuo</td>
                            <td class="p-1"></td>
                            <td class="p-1">kW</td>

                            @for ($i = 1; $i <= 2; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Corrente Nominal</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>
                            <td class="p-1">A</td>

                            @for ($i = 1; $i <= 2; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Tensão Nominal</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>
                            <td class="p-1">kV</td>

                            @for ($i = 1; $i <= 2; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Frequência Nominal</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>
                            <td class="p-1">Hz</td>

                            @for ($i = 1; $i <= 2; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Velocidade Nominal</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>
                            <td class="p-1">rpm</td>

                            @for ($i = 1; $i <= 2; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Número de fases</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Tipo e Ligação <sup>(2)</sup></td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Número de pólos</td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-1">Fator de Potência Máximo* <sup>(3)</sup></td>
                            <td class="p-1" style="background-color: #FFE7D6"></td>

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-1"></td>
                            @endfor
                        </tr>
                    </tbody>
                </table>

                <p class="mt-1 mb-1">
                    <sup>(1)</sup> G/V/O
                </p>
                <p class="mb-1">
                    <sup>(2)</sup> Y ou &Delta;
                </p>
                <p class="mb-0">
                    <sup>(3)</sup> Sobre-excitado ou Sub-excitado
                </p>
            </div>
        </div>
        <div class="row mt-1">
            <span class="d-block">
                GERÊNCIA CORPORATIVA DE NORMAS E PADRÕES. NT.020.EQTL.Normas e Padrões ANEXO I - FORMULÁRIO DE SOLICITAÇÃO DE ACESSO PARA MICROGERAÇÃO DISTRIBUÍDA ACIMA DE 10 kW REVISÃO 03.
            </span>
            <span class="d-block">
                DATA: 17/10/2019. ELABORADO POR: GILBERTO CARRERA
            </span>
        </div>
    </div>

    <div class="page position-relative" id="request-second-3">
        <div class="border border-2 border-bottom-0 border-dark p-1" style="padding: 2px 8px !important">
            <div class="row border border-2 border-dark">
                <div class="col-2 d-flex p-0">
                    <img src="{{asset('images/logo/equatorial-logo.svg')}}"
                        style="width: 100px">
                </div>
                <div class="col-10 text-center pt-3 pb-3">
                    <h1 class="text-uppercase fw-bold text-black" style="font-size: 10px !important">
                        NT.020.EQTL.Normas e Padrões
                    </h1>
                    <h2 class="d-block fw-bold text-black mb-0" style="font-size: 10px !important">
                        ANEXO II - Formulário de Solicitação de Acesso para Microgeração Distribuída até 10 kW
                    </h2>
                </div>
            </div>
            <div class="row border border-2 border-dark mt-3 mb-3 p-1">
                <p class="fw-bold mb-0 p-0" style="font-size: 8px !important">
                    1. Identificação e Dados Cadastrais da Unidade Consumidora - <span class="text-danger" style="font-size: 8px !important">PREENCHER, OBRIGATORIAMENTE, TODOS OS CAMPOS NA COR VERMELHA</span>
                </p>
            </div>
            <div class="row">
                <!-- Client Name -->
                <div class="col-6 mb-3 ps-0">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="bg-gray border-bottom border-dark p-1">
                            <span>Nome do Cliente / Razão Social (Titular da Unidade Consumidora)</span>
                        </div>
                        <div class="p-1">
                            <p class="text-uppercase mb-0">
                                @if ($document_request->generator->client->is_corporate)
                                    {{$document_request->generator->client->corporate_name}}
                                @else
                                    {{$document_request->generator->client->name}}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Client CPF/CNPJ -->
                <div class="col-3 mb-2">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="bg-gray border-bottom border-bottom-1 border-dark text-center p-1">
                            <span>CPF/CNPJ</span>
                        </div>
                        <div class="text-center p-1">
                            <p class="text-uppercase mb-0">
                                @if ($document_request->generator->client->is_corporate)
                                    {{$document_request->generator->client->cnpj}}
                                @else
                                    {{$document_request->generator->client->cpf}}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Client RG -->
                <div class="col-3 mb-3 pe-0">
                    <div class="form-group border border-dark mb-0 p-0 mb-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <!-- RG -->
                                    <div class="col-7 pe-0">
                                        <div class="form-group text-center bg-gray border-end border-bottom border-dark p-1 mb-0">
                                            <span class="text-uppercase">RG</span>
                                        </div>
                                    </div>
                                    <div class="col-5 ps-0">
                                        <div class="form-group text-center border-bottom border-dark ps-0 p-1 mb-0">
                                            <p class="mb-0">
                                                @if ($document_request->client_rg != null)
                                                    {{$document_request->client_rg}}
                                                @else
                                                    &ndash;
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- RG Shipping Date -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-7 pe-0">
                                        <div class="form-group text-center bg-gray border-end border-dark p-1 mb-0">
                                            <span class="text-uppercase">Data Expedição</span>
                                        </div>
                                    </div>
                                    <div class="col-5 ps-0">
                                        <div class="form-group text-center ps-0 p-1 mb-0">
                                            <p class="mb-0">
                                                @if ($document_request->client_rg_shipping_date != null)
                                                    {{date('d/m/Y', strtotime($document_request->client_rg_shipping_date))}}
                                                @else
                                                    &ndash;
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Generator Address -->
                <div class="col-7 mb-2 ps-0">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="bg-gray border-bottom border-dark p-1">
                            <span>Endereço</span>
                        </div>
                        <div class="p-1">
                            <p class="text-uppercase mb-0">
                                {{$document_request->generator->generator_address}}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Phones -->
                <div class="col-5 mb-3 pe-0">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="bg-gray border-bottom border-dark p-1">
                            <span>Contatos telefônicos</span>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <!-- Cellphone -->
                                    <div class="col-2 border-end border-dark">
                                        <div class="form-group text-center p-1 mb-0">
                                            <span>Celular</span>
                                        </div>
                                    </div>
                                    <div class="col-4 border-end border-dark">
                                        <div class="form-group text-center p-1 mb-0">
                                            <p class="mb-0">
                                                @if ($document_request->client_cellphone != null)
                                                    {{Str::of($document_request->client_cellphone)
                                                        ->replace('(', '')
                                                        ->replace(')', '')}}
                                                @else
                                                    &ndash;
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-2 border-end border-dark">
                                        <div class="form-group text-center p-1 mb-0">
                                            <span>Fixo</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group text-center p-1 mb-0">
                                            <p class="mb-0">
                                                @if ($document_request->client_phone != null)
                                                    {{Str::of($document_request->client_phone)
                                                        ->replace('(', '')
                                                        ->replace(')', '')}}
                                                @else
                                                    &ndash;
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Generator CEP -->
                <div class="col-2 mb-3">
                    <div class="row">
                        <div class="col-3 ps-0 pe-0">
                            <div class="form-group text-center bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>CEP</span>
                            </div>
                        </div>
                        <div class="col-9 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    {{$document_request->generator->generator_cep}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Generator City -->
                <div class="col-4 mb-3">
                    <div class="row">
                        <div class="col-3 pe-0">
                            <div class="form-group text-center bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>Município</span>
                            </div>
                        </div>

                        <div class="col-9 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="text-uppercase mb-0">
                                    {{$document_request->generator->generator_city}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Generator State -->
                <div class="col-2 mb-3">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="form-group text-center bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    UF (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>

                        <div class="col-3 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="text-uppercase mb-0">
                                    {{$document_request->generator->generator_state}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Client Email -->
                <div class="col-4 mb-3">
                    <div class="row">
                        <div class="col-3 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>E-mail</span>
                            </div>
                        </div>

                        <div class="col-9 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    {{$document_request->generator->client->email}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Project Type -->
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-3 ps-0 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    Tipo de Solicitação (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>
                        <div class="col-9 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="fw-bold mb-0">
                                    @switch ($document_request->generator->generator_project_type)
                                        @case ('INDIVIDUAL')
                                            INDIVIDUAL
                                            @break

                                        @case ('INDIVIDUAL')
                                            AUTOCONSUMO REMOTO
                                            @break

                                        @case ('GERACAO_COMPARTILHADA')
                                            GERAÇÃO COMPARTILHADA
                                            @break

                                        @case ('RESERVADO')
                                            RESERVADO
                                            @break
                                    @endswitch
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Contract Account -->
                <div class="col-7 ps-0 mb-3">
                    <div class="form-group text-center border border-dark p-1 mb-0">
                        <span class="text-uppercase fw-bold">
                            Informar o número da conta contrato
                        </span>
                    </div>
                </div>

                <div class="col-5 mb-3">
                    <div class="row">
                        <div class="col-8 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>
                                    Conta Contrato (Se UC existente)
                                </span>
                            </div>
                        </div>
                        <div class="col-4 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    {{$document_request->generator->generator_contract_account}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Branch of Activity -->
                <div class="col-8 mb-3">
                    <div class="row">
                        <div class="col-5 ps-0 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>
                                    Ramo de Atividade (Descrição)
                                </span>
                            </div>
                        </div>
                        <div class="col-7 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    @if ($document_request->branch_activity != null)
                                        <span>
                                            {{$document_request->branch_activity}}
                                        </span>
                                    @else &ndash;
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Special Loads -->
                <div class="col-4 mb-3">
                    <div class="row">
                        <div class="col-10 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>
                                    Possui Cargas Especiais?
                                </span>
                            </div>
                        </div>

                        <div class="col-2 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="fw-bold mb-0">
                                    @switch ($document_request->has_special_loads)
                                        @case (0)
                                            NÃO
                                            @break

                                        @case (1)
                                            SIM
                                            @break
                                    @endswitch
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Special Loads Details -->
                <div class="col-9 mb-3">
                    <div class="row">
                        <div class="col-4 ps-0 pe-0">
                            <div class="form-group bg-gray border border-1 border-end-0 border-dark p-1 mb-0">
                                <span>Detalhar - Cargas especiais</span>
                            </div>
                        </div>
                        <div class="col-8 ps-0">
                            <div class="form-group text-center border border-1 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    @if ($document_request->special_loads_details != null)
                                        <span>
                                            {{$document_request->special_loads_details}}
                                        </span>
                                    @else &ndash;
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subgroup -->
                <div class="col-3 mb-3">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="form-group text-center bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    Subgrupo (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>

                        <div class="col-3 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="fw-bold mb-0">
                                    {{$document_request->subgroup}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Class -->
                <div class="col-6 mb-3" style="width: 307px">
                    <div class="row">
                        <div class="col-3 ps-0 pe-0" style="width: 85px">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    Classe (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>
                        <div class="col-9 ps-0" style="width: 222px">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="fw-bold mb-0">
                                    @switch ($document_request->consumption_class)
                                        @case ('RESIDENCIAL')
                                            RESIDENCIAL
                                            @break

                                        @case ('INDUSTRIAL')
                                            INDUSTRIAL
                                            @break

                                        @case ('COMERCIO_SERVICOS_OUTROS')
                                            COMÉRCIO, SERVIÇOS E OUTRAS ATIVIDADES
                                            @break

                                        @case ('RURAL')
                                            RURAL
                                            @break

                                        @case ('PODER_PUBLICO')
                                            PODER PÚBLICO
                                            @break

                                        @case ('ILUMINACAO_PUBLICA')
                                            ILUMINAÇÃO PÚBLICA
                                            @break

                                        @case ('SERVICO_PUBLICO')
                                            SERVIÇO PÚBLICO
                                            @break

                                        @case ('CONSUMO_PROPRIO')
                                            CONSUMO PRÓPRIO
                                            @break
                                    @endswitch
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Connection Type -->
                <div class="col-3 mb-3" style="width: 208px">
                    <div class="row">
                        <div class="col-8 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    Tipo de Ligação (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>
                        <div class="col-4 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="fw-bold mb-0">
                                    @switch ($document_request->connection_type)
                                        @case ('MONOFASICO')
                                            MONOFÁSICO
                                            @break

                                        @case ('BIFASICO')
                                            BIFÁSICO
                                            @break

                                        @case ('TRIFASICO')
                                            TRIFÁSICO
                                            @break
                                    @endswitch
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UC Power -->
                <div class="col-3 mb-3 pe-0" style="width: 185px">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="form-group text-center bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>Tensão de Atendimento da UC</span>
                            </div>
                        </div>
                        <div class="col-3 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    @if ($document_request->uc_power != null)
                                        <span class="fw-bold">
                                            {{Str::of($document_request->uc_power)->replace('.', ',')}} V
                                        </span>
                                    @else
                                        &ndash;
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- UC Declared Load -->
                <div class="col-4 mb-3">
                    <div class="row">
                        <div class="col-8 ps-0 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>Carga Declarada da UC</span>
                            </div>
                        </div>
                        <div class="col-4 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    @if ($document_request->uc_declared_load != null)
                                        <span class="fw-bold">
                                            {{Str::of($document_request->uc_declared_load / 1000)
                                                ->replace('.', ',')}} kW
                                        </span>
                                    @else
                                        &ndash;
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UC Input Circuit Breaker -->
                <div class="col-4 mb-3">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    Disjuntor de Entrada da UC (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>
                        <div class="col-3 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    @if ($document_request->uc_circuit_breaker != null)
                                        <span class="fw-bold">
                                            {{Str::of($document_request->uc_circuit_breaker)
                                                ->replace('.', ',')}} A
                                        </span>
                                    @else &ndash;
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UC Available Power -->
                <div class="col-4 mb-3">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>
                                    Potência Disponibilizada (PD) para UC
                                </span>
                            </div>
                        </div>
                        <div class="col-3 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    @if ($document_request->uc_available_power != null)
                                        <span class="fw-bold">
                                            {{Str::of($document_request->uc_available_power / 1000)
                                                ->replace('.', ',')}} kW
                                        </span>
                                    @else
                                        &ndash;
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Extension Type -->
                <div class="col-4 mb-3">
                    <div class="row">
                        <div class="col-7 ps-0 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    Tipo de Ramal (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>
                        <div class="col-5 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="fw-bold text-uppercase mb-0">
                                    {{$document_request->extension_type}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transformer Identification -->
                <div class="col-8 mb-3">
                    <div class="row">
                        <div class="col-8 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>
                                    Nº de dentificação do poste ou transformador mais próximo
                                </span>
                            </div>
                        </div>
                        <div class="col-4 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="mb-0">
                                    @if ($document_request->transformer_identification != null)
                                        {{$document_request->transformer_identification}}
                                    @else
                                        ND
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- System Delivery Point Coordinates X and Y-->
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-8 ps-0 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>
                                    Preencher as coordenadas ponto de entrega do acessante em UTM Fuso 21, 22 ou 23
                                </span>
                            </div>
                        </div>
                        <div class="col-4 ps-0 pe-0">
                            <div class="row">
                                <div class="col-2 pe-0">
                                    <div class="form-group text-center border border-end-0 border-dark p-1 mb-0">
                                        <span>X =</span>
                                    </div>
                                </div>
                                <div class="col-4 ps-0 pe-0">
                                    <div class="form-group text-center border border-end-0 border-dark p-1 mb-0">
                                        <p class="mb-0">
                                            @if ($document_request->point_coordinate_y != null)
                                                <span class="fw-bold">
                                                    {{Str::of($document_request->point_coordinate_y)
                                                        ->replace('.', ',')}} m S
                                                </span>
                                            @else &ndash;
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-2 ps-0 pe-0">
                                    <div class="form-group text-center border border-end-0 border-dark p-1 mb-0">
                                        <span>Y =</span>
                                    </div>
                                </div>
                                <div class="col-4 ps-0">
                                    <div class="form-group text-center border border-dark p-1 mb-0">
                                        <p class="mb-0">
                                            @if ($document_request->point_coordinate_x != null)
                                                <span class="fw-bold">
                                                    {{Str::of($document_request->point_coordinate_x)
                                                        ->replace('.', ',')}} m E
                                                </span>
                                            @else
                                                &ndash;
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registration Information and Data -->
            <div class="row border border-2 border-dark p-1 mb-3 mt-1">
                <p class="fw-bold mb-0 p-0" style="font-size: 8px !important">
                    2. Dados Cadastrais do Responsável Técnico
                </p>
            </div>

            <div class="row">
                <!-- Technical Manager Name -->
                <div class="col-4 mb-3 ps-0">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="bg-gray border-bottom border-dark p-1">
                            <span>Nome Completo</span>
                        </div>
                        <div class="p-1">
                            <p class="text-uppercase mb-0">
                                {{$document_request->user->name}}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Technical Manager Professional Title -->
                <div class="col-3 mb-3">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="text-center bg-gray border-bottom border-dark p-1">
                            <span>Título Profissional</span>
                        </div>
                        <div class="text-center p-1">
                            <p class="text-uppercase mb-0">
                                {{$document_request->user->professional_title}}
                            </p>
                        </div>
                    </div>
                </div>

                 <!-- Technical Manager Professional Registration -->
                 <div class="col-5 mb-3 pe-0">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="text-center bg-gray border-bottom border-dark p-1">
                            <span>Registro Profissional</span>
                        </div>
                        <div class="row">
                            <div class="col-2 pe-0">
                                <div class="form-group text-center border-end border-dark p-1 mb-0">
                                    <span>Nº</span>
                                </div>
                            </div>
                            <div class="col-6 ps-0 pe-0">
                                <div class="form-group text-center border-end border-dark p-1 mb-0">
                                    <p class="mb-0">
                                        {{$document_request->user->professional_registration}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-2 ps-0 pe-0">
                                <div class="form-group text-center border-end border-dark p-1 mb-0">
                                    <span>UF</span>
                                </div>
                            </div>
                            <div class="col-2 ps-0">
                                <div class="form-group text-center p-1 mb-0">
                                    <p class="mb-0">
                                        {{$document_request->user->professional_state}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Technical Manager Email -->
                <div class="col-4 mb-3 ps-0">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="bg-gray border-bottom border-dark p-1">
                            <span>E-mail</span>
                        </div>
                        <div class="p-1">
                            <p class="mb-0">
                                {{$document_request->user->email}}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Technical Manager Phone -->
                <div class="col-4 mb-3">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="text-center bg-gray border-bottom border-dark p-1">
                            <span>Telefone Fixo</span>
                        </div>
                        <div class="text-center p-1">
                            <p class="mb-0">
                                @if ($document_request->user->phone != null)
                                    {{$document_request->user->phone}}
                                @else
                                    &ndash;
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Technical Manager Cellphone -->
                <div class="col-4 mb-3 pe-0">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="text-center bg-gray border-bottom border-dark p-1">
                            <span>Telefone Celular</span>
                        </div>
                        <div class="text-center p-1">
                            <p class="mb-0">
                                @if ($document_request->user->cellphone != null)
                                    {{$document_request->user->cellphone}}
                                @else
                                    &ndash;
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Technical Manager Address -->
                <div class="col-5 mb-3 ps-0">
                    <div class="form-group border border-dark mb-0 p-0">
                        <div class="bg-gray border-bottom border-dark p-1">
                            <span>Endereço de Correspondência</span>
                        </div>
                        <div class="p-1">
                            <p class="text-uppercase mb-0">
                                {{$document_request->user->address}}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-5 mb-2">
                    <div class="form-group border border-dark mb-0 p-0 mb-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <!-- Technical Manager Neighborhood -->
                                    <div class="col-3 pe-0">
                                        <div class="form-group bg-gray border-end border-bottom border-dark p-1 mb-0">
                                            <span>Bairro</span>
                                        </div>
                                    </div>
                                    <div class="col-9 ps-0">
                                        <div class="form-group border-bottom border-dark ps-1 p-1 mb-0">
                                            <p class="text-uppercase mb-0">
                                                {{$document_request->user->neighborhood}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technical Manager City -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3 pe-0">
                                        <div class="form-group bg-gray border-end border-dark p-1 mb-0">
                                            <span>Município</span>
                                        </div>
                                    </div>
                                    <div class="col-9 ps-0">
                                        <div class="form-group ps-1 p-1 mb-0">
                                            <p class="text-uppercase mb-0">
                                                {{$document_request->user->city}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-2 mb-3 pe-0">
                    <div class="form-group border border-dark mb-0 p-0 mb-0">
                        <div class="row">
                            <!-- Technical Manager State -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4 pe-0">
                                        <div class="form-group bg-gray border-end border-bottom border-dark p-1 mb-0">
                                            <span>UF:</span>
                                        </div>
                                    </div>
                                    <div class="col-8 ps-0">
                                        <div class="form-group border-bottom border-dark ps-1 p-1 mb-0">
                                            <p class="mb-0">
                                                {{$document_request->user->state}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technical Manager CEP -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4 pe-0">
                                        <div class="form-group bg-gray border-end border-dark p-1 mb-0">
                                            <span>CEP:</span>
                                        </div>
                                    </div>
                                    <div class="col-8 ps-0">
                                        <div class="form-group ps-1 p-1 mb-0">
                                            <p class="mb-0">
                                                {{$document_request->user->cep}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features of Distributed Microgeneration -->
            <div class="row border border-2 border-dark p-1 mb-3 mt-1">
                <p class="fw-bold mb-0 p-0" style="font-size: 8px !important">
                    3. Características da Microgeração Distribuída
                </p>
            </div>

            <div class="row">
                <!-- Extension Type -->
                <div class="col-5 mb-3">
                    <div class="row">
                        <div class="col-6 ps-0 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    Tipo de Geração (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>
                        <div class="col-6 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="text-uppercase mb-0">
                                    {{$document_request->generation_type}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Generation Details -->
                <div class="col-7 mb-3">
                    <div class="row">
                        <div class="col-4 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>
                                    Especificar se necessário
                                </span>
                            </div>
                        </div>
                        <div class="col-8 ps-0 pe-0">
                            <div class="form-group border border-dark p-1 mb-0">
                                <p class="mb-0 text-uppercase fw-bold">
                                    {{$document_request->generation_details}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Microgeneration Framework -->
                <div class="col-8 mb-3">
                    <div class="row">
                        <div class="col-6 ps-0 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <p class="mb-0">
                                    Enquadramento da Microgeração (<span class="text-danger">selecionar</span>)
                                </p>
                            </div>
                        </div>
                        <div class="col-6 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="text-uppercase fw-bold mb-0">
                                    {{$document_request->generation_framework}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 mb-3 pe-0">
                    <div class="form-group border border-dark mb-0" style="min-height: 15.1855px"></div>
                </div>
            </div>
            <div class="row">
                <!-- Generation Power -->
                <div class="col-3 mb-3">
                    <div class="row">
                        <div class="col-7 ps-0 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>Potência Geração (PG)</span>
                            </div>
                        </div>
                        <div class="col-5 ps-0">
                            <div class="row">
                                <div class="col-7 pe-0">
                                    <div class="form-group text-center border border-end-0 border-dark p-1 mb-0" style="background-color: #00B242">
                                        <p class="fw-bold mb-0">
                                            @if ($document_request->generation_power != null)
                                                {{Str::of($document_request->generation_power / 1000)
                                                    ->replace('.', ',')}}
                                            @else
                                                &ndash;
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-5 ps-0">
                                    <div class="form-group text-center border border-dark p-1 mb-0">
                                        <p class="fw-bold mb-0">
                                            kW
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-2 mb-3">
                    <div class="form-group border border-dark text-center p-1 mb-0"
                        style="background-color: #00B242">
                        <span class="text-uppercase fw-bold">
                            OK: {{$document_request->generation_ok}}
                        </span>
                    </div>
                </div>

                <!-- Generation Voltage -->
                <div class="col-3 mb-3">
                    <div class="row">
                        <div class="col-7 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>Tensão Conexão</span>
                            </div>
                        </div>
                        <div class="col-5 ps-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="fw-bold mb-0">
                                    @if ($document_request->generation_voltage != null)
                                        {{$document_request->generation_voltage}} V
                                    @else
                                        &ndash;
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Generation Operation Initial Date -->
                <div class="col-4 mb-3">
                    <div class="row">
                        <div class="col-7 pe-0">
                            <div class="form-group bg-gray border border-end-0 border-dark p-1 mb-0">
                                <span>Data Início de Operação</span>
                            </div>
                        </div>
                        <div class="col-5 ps-0 pe-0">
                            <div class="form-group text-center border border-dark p-1 mb-0">
                                <p class="fw-bold text-uppercase mb-0">
                                    {{$document_request->generation_start_date}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Necessary Documents -->
            <div class="row border border-2 border-dark p-1 mb-3 mt-1">
                <p class="fw-bold mb-0 p-0" style="font-size: 8px !important">
                    4. Documentos necessários que devem ser anexados à Solicitação de Acesso:
                </p>
            </div>

            <div class="row">
                <table class="table table-borderless mb-2">
                    <thead class="border border-dark">
                        <tr>
                            <th scope="col" class="border-end border-dark text-center p-1"
                                style="background-color: #D8D8D8">
                                Descrição
                            </th>
                            <th scope="col" class="text-center p-1" style="width: 240px; background-color: #D8D8D8">
                                Observações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border border-1 border-dark">
                        <!-- ART -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                1. ART do Responsável Técnico pelo projeto e instalação do sistema de microgeração
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->art_observation}}
                            </td>
                        </tr>

                        <!-- Diagram -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                2. Diagrama unifilar contemplando Geração, Proteção (inversor, se for o caso), Carga e Medição
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->diagram_observation}}
                            </td>
                        </tr>

                        <!-- Descriptive Technical Memo -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                3. Memorial Técnico Descritivo da instalação (Conforme Modelo do ANEXO III - MODELO DE MEMORIAL TÉCNICO DESCRITIVO)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->memo_observation}}
                            </td>
                        </tr>

                         <!-- Electrical design of connection installations -->
                         <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                4. Projeto elétrico das instalações de conexão, contendo: a) Planta de Situação; b) Diagrama Funcional; c) Arranjos Físicos ou Lay-out; e d) Manual com Folha de Dados (datasheet) dos inversores
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->electrical_observation}}
                            </td>
                        </tr>

                        <!-- Inverter Compliance Certificate -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                5. Certificados de Conformidade dos Inversores ou o número de registro de concessão do INMETRO do(s) inversor(es) para a tensão nominal de conexão com a rede
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->compliance_certificate_observation}}
                            </td>
                        </tr>

                        <!-- UC Participants -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                6. Lista de unidades consumidoras participantes do sistema de compensação (se houver) indicando na porcentagem de rateio dos créditos e o enquadramento conforme incisos VI a VIII do art. 2º da Resolução Normativa nº 482/2012 (PLANILHA NA GUIA 2)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->uc_participants_observation}}
                            </td>
                        </tr>

                        <!-- UC Participants -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                7. Cópia de instrumento jurídico que comprove o compromisso de solidariedade entre os Integrantes (se houver)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->legal_instrument_observation}}
                            </td>
                        </tr>

                        <!-- Recognition for ANEEL -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                8. Documento que comprove o reconhecimento pela ANEEL, da cogeração qualificada (se houver)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->aneel_observation}}
                            </td>
                        </tr>

                        <!-- New Link -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                9. Formulário de Ligação Nova (quando necessário, conforme observação) (Conforme ANEXO IV - FORMULÁRIO DE LIGAÇÃO NOVA)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->new_link_observation}}
                            </td>
                        </tr>

                        <!-- Pattern Change -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                10. Formulário de Troca de Padrão (de monofásico para bifásico ou trifásico, de bifásico para trifásico, de trifásico para bifásico ou monofásico, de bifásico para monofásico) (Conforme ANEXO V - FORMULÁRIO DE TROCA DE PADRÃO)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->pattern_change_observation}}
                            </td>
                        </tr>

                        <!-- Rent Contract -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                11. Contrato de Aluguel ou Arrendamento da unidade consumidora (quando necessário, conforme observação)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->rent_contract_observation}}
                            </td>
                        </tr>

                        <!-- Procuration -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                12. Procuração (quando necesário, conforme observação)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->procuration_observation}}
                            </td>
                        </tr>

                        <!-- Use of Common Area in Condominium -->
                        <tr>
                            <td class="border-end border-bottom border-dark p-1">
                                13. Autorização de uso de área comum em condomínio (quando necessário, conforme observação)
                            </td>
                            <td class="border-bottom border-dark p-1">
                                {{$document_request->condominium_observation}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="page position-relative" id="request-second-4">
        <div class="border border-2 border-top-0 border-dark p-1" style="padding: 2px 8px !important">
            <!-- Necessary Documents -->
            <div class="row border border-2 border-dark p-1 mt-1">
                <p class="fw-bold mb-0 p-0">
                    5. Este formulário deve ser preenchido e encaminhado aos canais de atendimento Corporativo da Concessionária
                </p>
            </div>

            <div class="row border border-2 border-top-0 border-dark">
                <div class="col-7 border-end border-dark ps-0">
                    <div class="form-group p-1 mb-0">
                        <p class="mb-2">
                            <span class="text-uppercase fw-bold" style="position: initial;">Pará</span> - Sede de regionais (Belém, Castanhal, Marabá, Santarém e Altamira)
                        </p>
                        <p class="mb-2">
                            <span class="text-uppercase fw-bold" style="position: initial;">Maranhão</span> - Sede de regionais (São Luís, Imperatriz, Timon, Balsas e Bacabal)
                        </p>
                        <p class="mb-2">
                            <span class="text-uppercase fw-bold" style="position: initial;">Piauí</span> - Sede de regionais (Teresina, Parnaíba, Picos, Bom Jesus e Floriano)
                        </p>
                        <p class="mb-5">
                            <span class="text-uppercase fw-bold" style="position: initial;">Alagoas</span> - Sede de regionais (Maceio,Arapiraca, Matriz de Camaragibe e Santana do Ipanema)
                        </p>
                        <p class="mb-1">
                            Em caso de dúvidas entrar em contato com os canais de atendimento disponibilizados na norma <span class="fw-bold">NT.020.EQTL.Normas e Padrões</span>.
                        </p>
                    </div>
                </div>
                <div class="col-5 ps-0 pe-0">
                    <div class="form-group p-1 mb-0">
                        <span class="mb-1">
                            Eu, acessante identificado neste formulário, venho por meio deste instrumento, solicitar o acesso para microgeração distribuída, fornecendo meus dados cadastrais assim como as documentos necessários, em conformidade com as normas e resoluções aplicáveis.
                        </span>

                        <div class="row" style="margin-top: 30px">
                            <div class="col-2 text-center">
                                <div class="form-group text-center border-bottom border-dark mb-1">
                                    <span class="text-uppercase">Belém</span>
                                </div>
                                <span>Local</span>
                            </div>
                            <div class="col-3 text-center">
                                <div class="form-group text-center border-bottom border-dark mb-1">
                                    <span class="text-uppercase">
                                        {{date('d/m/Y')}}
                                    </span>
                                </div>
                                <span>Data</span>
                            </div>
                            <div class="col-7 text-center" style="margin-top: 9.5px">
                                <div class="form-group text-center border-bottom border-dark mb-0"></div>
                                <span>Assinatura do Responsável</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <span class="d-block">
                GERÊNCIA CORPORATIVA DE NORMAS E PADRÕES. NT.020.EQTL.Normas e Padrões ANEXO I - FORMULÁRIO DE SOLICITAÇÃO DE ACESSO PARA MICROGERAÇÃO DISTRIBUÍDA ACIMA DE 10 kW REVISÃO 03.
            </span>
            <span class="d-block">
                DATA: 17/10/2019. ELABORADO POR: GILBERTO CARRERA
            </span>
        </div>
    </div>
</x-print-layout>