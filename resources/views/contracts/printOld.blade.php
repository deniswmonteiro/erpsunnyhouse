<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset(mix('css/fonts.css')) }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset(mix('css/bootstrap.css'))}}">
    <link rel="stylesheet" href="{{asset(mix('css/app.css')) }}">
    <link rel="stylesheet" href="{{asset(mix('css/style.css'))}}">

    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6" media="print">
    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6/dist/themes/oldstyle.min.css" media="print">
</head>
<body class="print">
<br>

<section>
    <div class="print-page cover notprint">
        <div class="yesprint">
            <div class="print-selection">
                <div class="row">
                    <p class="title">Proposta / Termo de Adesão:
                        <strong>{{contract_number($contract)}}</strong> {{(new DateTime())->format('d/m/Y')}}
                    </p>
                    <p style="text-align: right; padding-right: 50px"><strong>Página 1/2</strong></p>
                </div>

                <div class="row">

                    <div class="m-0 text-black">
                        <!-- Client -->
                        <table class="table text-black">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th><strong>Cliente</strong></th>
                                <td class="table-color">{{$contract->client->name}}</td>
                                <td><strong>Nome</strong></td>
                                <td class="table-color">{{$contract->contract_name}}</td>
                            </tr>
                            <tr>
                                <th><strong>Endreço</strong></th>
                                <td class="table-color">{{$contract->address}}</td>
                                <td><strong>CPF</strong></td>
                                <td class="table-color">{{$contract->client->cpf}}</td>
                            </tr>
                            <tr>
                                <th><strong>Bairro</strong></th>
                                <td class="table-color">{{$contract->address_neighborhood}}</td>
                                <td><strong>E-Mail</strong></td>
                                <td class="table-color">{{$contract->client->email}}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="table-color"></td>
                                <td><strong>Cidade</strong></td>
                                <td class="table-color">{{$contract->address_city}}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="table-color"></td>
                                <td><strong>Telefone</strong></td>
                                <td class="table-color">{{$contract->phone}}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="table-color"></td>
                                <td><strong>CEP</strong></td>
                                <td class="table-color">{{$contract->address_cep}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <a class="text-black">Prezados Senhores, Atendendo a solicitação de V.sas., é com prazer que
                            submetemos a sua
                            apreciação nossa proposta comercial para o fornecimento de equipamentos conforme
                            descriminado.</a>
                    </div>
                </div>
                {{--ITENS--}}
                <div>
                    @if($contract->type == 1)
                        <table class="table text-black border-black">
                            <thead>
                            <tr>
                                <td colspan="4" style="text-align: center" class="border-black">
                                    <strong>Gerador {!! $contract->getGeneratorPowerPrint() !!}</strong>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Quantidade</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @switch($contract->generator_structure)
                                    @case(1)
                                    <td class="border-black" colspan="3">Estrutura de Fixação Solo Monoposte</td>
                                    @break
                                    @case(2)
                                    <td class="border-black" colspan="3">Estrutura de Fixação Laje</td>
                                    @break
                                    @case(3)
                                    <td class="border-black" colspan="3">Estrutura de Fixação Fibrocimento</td>
                                    @break
                                    @case(4)
                                    <td class="border-black" colspan="3">Estrutura de Fixação Cerâmico</td>
                                    @break
                                @endswitch
                                <td class="border-black">1 KIT</td>
                            </tr>
                            @foreach($contract->contractsProducts() as $product)
                                <tr>
                                    <td class="border-black" colspan="3">{{$product->name}}</td>
                                    <td class="border-black">{{$product->quantity}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="border-black">
                                    <strong>Área Configurada:</strong>
                                    <br>{{$contract->area}}m<sup>2</sup>
                                </td>
                                <td class="border-black">
                                    <strong>Geração Média Mensal:</strong>
                                    <br>{{$contract->monthly_avg_generation}} kWh
                                </td>
                                <td class="border-black" colspan="2">
                                    <strong>Valor do Sistema:</strong>
                                    <br>R$ {{format_money($contract->getValue())}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </div>

                {{--PAYMENT--}}
                <div>

                    <div><strong>Proposta Econômica:</strong></div>
                    <table class="table text-black">
                        <thead>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="3">
                                1 - Equipamento Conforme
                                Descriminado:........................................................
                            </td>
                            <td>
                                R$ {{format_money($contract->getValue())}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">2 – Instalação / Projeto / Homologação / Frete / Placa Geração
                                Própria:...........
                            </td>
                            <td>Incluso</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <strong>TOTAL FORNECIMENTO:</strong>
                            </td>
                            <td>
                                R$ {{format_money($contract->getValue())}}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div><strong>Condições de Pagamento:</strong></div>

                    <div style="margin-top: 5px;!important;">
                        <input type="checkbox" id="contract" name="contract1" value=""
                               style="margin-right: 10px!important;">

                        <label for="contract">
                            @switch($contract->payment->type->name)
                                @case(contract_name_cash())
                                <a> Valor a pagar à vista no montante de
                                    R$ {{format_money($contract->paymentData()->cash)}}
                                    .</a>
                                @break

                                @case(contract_name_partial_parceled())
                                <a> Montante de entrada no valor de R$ {{format_money($contract->paymentData()->cash)}}.
                                    Acrescido de {{$contract->paymentData()->quantity_parcel}} parcelas no valor de
                                    R$ {{format_money($contract->paymentData()->value_parcel)}}. A partir
                                    @if($contract->paymentData()->after_by == \App\Http\Controllers\ContractController::$PAYMENT_AFTER_SIGNATURE)
                                        de
                                    @else
                                        da
                                    @endif
                                    {{mb_strtolower($contract->paymentData()->after_by, 'UTF-8')}}.
                                    @if($contract->paymentData()->bank != '')
                                        Sendo o financiamento das parcelas realizado pelo
                                        banco {{$contract->paymentData()->bank}}.
                                    @endif
                                </a>
                                @break

                                @case(contract_name_total_parceled())
                                <a> Pagamento mediante a {{$contract->paymentData()->quantity_parcel}} parcelas no valor
                                    de
                                    R$ {{format_money($contract->paymentData()->value_parcel)}}. Apartir
                                    @if($contract->paymentData()->after_by == \App\Http\Controllers\ContractController::$PAYMENT_AFTER_SIGNATURE)
                                        de
                                    @else
                                        da
                                    @endif
                                    {{(mb_strtolower($contract->paymentData()->after_by, 'UTF-8'))}}.
                                    @if($contract->paymentData()->bank != '')
                                        Sendo o financiamento das parcelas realizado pelo
                                        banco {{$contract->paymentData()->bank}}.
                                    @endif
                                </a>
                                @break

                                @case(contract_name_custom())
                                <a> {{$contract->paymentData()->text}}.</a>
                                @break
                            @endswitch


                        </label>
                    </div>

                    <div>Dados Bancários:<strong>ITAÚ AG: 7494 CC: 18883-7</strong></div>
                    <div><strong>SH Soluções Tecnológicas LTDA. CNPJ: 09445760/0001-87</strong></div>
                </div>

            </div>
        </div>
    </div>
</section>
</body>
