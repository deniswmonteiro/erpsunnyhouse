<x-print-layout>
    <x-slot name="header"></x-slot>

    @section('title', $title)

    <div class="page print-adhesion @if ($logo) position-relative @endif" id="print-adhesion">
        <div class="row">
            @if ($logo)
                <div class="col-3">
                    <img style="margin-left: -38px !important; margin-top: -38px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="130px">
                </div>
                <div class="col-6">
                    <p class="text-end">
                        Proposta/Termo de Adesão:
                        <span class="fw-bold">{{contract_number($contract)}}</span>
                        {{(new DateTime())->format('d/m/Y')}}
                    </p>
                </div>
                <div class="col-3">
                    <p class="text-end fw-bold">Página 1/2</p>
                </div>
            @else
                <div class="col-9">
                    <p class="text-end">
                        Proposta/Termo de Adesão:
                        <span class="fw-bold">{{contract_number($contract)}}</span>
                        {{(new DateTime())->format('d/m/Y')}}
                    </p>
                </div>
                <div class="col-3">
                    <p class="text-end fw-bold">Página 1/2</p>
                </div>
            @endif
        </div>

        <div class="row @if (!$logo) padding-top-130 @else mt-4 @endif">
            <div class="m-0">
                <!-- Client -->
                <table class="table">
                    <thead></thead>
                    <tbody class="border-0">
                        <tr>
                            @if ($contract->client->is_corporate)
                                <td class="fw-bold">Cliente</td>
                                <td class="table-active">{{$contract->client->corporate_name}}</td>
                                <td class="fw-bold">Nome</td>
                                <td class="table-active">{{$contract->client->name}}</td>
                            @else
                                <td class="fw-bold">Cliente</td>
                                <td class="table-active">{{$contract->client->name}}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="fw-bold">CNPJ</td>
                            @if ($contract->client->is_corporate)
                                <td class="table-active">{{$contract->client->cnpj}}</td>
                            @else
                                <td class="table-active">&mdash;</td>
                            @endif
                            <td class="fw-bold">CPF</td>
                            <td class="table-active">{{$contract->client->cpf}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Telefone</td>
                            <td class="table-active">{{$contract->client->phone}}</td>
                            <td class="fw-bold">E-Mail</td>
                            <td class="table-active">{{$contract->client->email}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">CEP</td>
                            <td class="table-active">{{$contract->client->address_cep}}</td>
                            <td class="fw-bold">Endereço</td>
                            <td class="table-active">{{$contract->client->address}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Número</td>
                            <td class="table-active">{{$contract->client->address_number}}</td>
                            <td class="fw-bold">Complemento</td>
                            <td class="table-active">{{$contract->client->address_complement}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Bairro</td>
                            <td class="table-active">{{$contract->client->address_neighborhood}}</td>
                            <td class="fw-bold">Cidade</td>
                            <td class="table-active">{{$contract->client->address_city}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <p class="mt-1">
                    Prezados senhores, atendendo a solicitação de V.sas., é com prazer que submetemos a sua apreciação nossa proposta comercial para o fornecimento de equipamentos conforme descrito.
                </p>
            </div>
        </div>

        <!-- Itens -->
        <div>
            @if ($contract->type == 1)
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <td colspan="4" class="text-center">
                                <span class="fw-bold">Gerador {!! $contract->getGeneratorPowerPrint() !!}</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" colspan="3">Produto</th>
                            <th scope="col">Quant.</th>
                        </tr>
                    </thead>
                    <tbody class="border-1">
                        <tr>
                            @switch ($contract->generator_structure)
                                @case (1)
                                    <td colspan="3">Estrutura de Fixação Solo Monoposte</td>
                                    @break
                                
                                @case (2)
                                    <td colspan="3">Estrutura de Fixação Laje</td>
                                    @break
                                
                                @case (3)
                                    <td colspan="3">Estrutura de Fixação Fibrocimento</td>
                                    @break
                                
                                @case (4)
                                    <td colspan="3">Estrutura de Fixação Cerâmico</td>
                                    @break
                            @endswitch

                            <td>1 KIT</td>
                        </tr>
                        
                        @foreach ($contract->contractsProducts() as $product)
                            <tr>
                                <td colspan="3">{{$product->name}}</td>
                                <td colspan="1">{{$product->quantity}}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td>
                                <span class="fw-bold d-block">Área Configurada:</span>
                                {{$contract->area}}m<sup>2</sup>
                            </td>
                            <td>
                                <span class="fw-bold d-block">Geração Média Mensal:</span>
                                {{$contract->monthly_avg_generation}} kWh
                            </td>
                            <td style="border-right: 0 !important">
                                <span class="fw-bold d-block">Valor do Sistema:</span>
                                <span>R$ {{format_money($contract->getValue())}}</span>
                            </td>
                            <td style="border-left: 0 !important"></td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Economic proposal -->
        <div class="row">
            <p class="fw-bold mb-0">Proposta Econômica:</p>
        
            <table class="table">
                <thead></thead>
                <tbody class="border-0">
                    <tr>
                        <td colspan="3">
                            1 &ndash; Equipamento Conforme Descrito:........................................................
                        </td>
                        <td>
                            R$ {{format_money($contract->getValue())}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            2 &ndash; Instalação/Projeto/Homologação/Frete/Placa Geração Própria:................
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
        </div>

        <!-- Payment Conditions -->
        <div class="row">
            <p class="fw-bold mb-1">Condições de Pagamento:</p>

            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="contract">
                    <label class="form-check-label" for="contract">
                        @switch($contract->payment->type->name)
                            @case (contract_name_cash())
                                <p>Entrada de R$ {{format_money($contract->paymentData()->cash)}}
                                    na assinatura e saldo na 
                                    @if($contract->paymentData()->payment_after_by == \App\Http\Controllers\ContractController::$PAYMENT_AFTER_CONCLUSION)
                                        {{(mb_strtolower($contract->paymentData()->payment_after_by, 'UTF-8'))}}.
                                    @elseif($contract->paymentData()->payment_after_by == \App\Http\Controllers\ContractController::$PAYMENT_AFTER_HOMOLOGATION)
                                        {{(mb_strtolower($contract->paymentData()->payment_after_by, 'UTF-8'))}}.
                                    @endif
                                </p>
                            @break

                            @case (contract_name_partial_parceled())
                                <p> 
                                    Entrada de R$ {{format_money($contract->paymentData()->cash)}} na assinatura e 
                                    saldo financiado pelo 
                                    @if ($contract->paymentData()->bank != '') banco {{$contract->paymentData()->bank}}.
                                    @else banco.
                                    @endif
                                </p>
                            @break

                            @case (contract_name_total_parceled())
                                <p> 100% financiado pelo 
                                    @if ($contract->paymentData()->bank != '') banco {{$contract->paymentData()->bank}}.
                                    @else banco.
                                    @endif
                                </p>
                            @break

                            @case (contract_name_company_installment())
                                <p> 
                                    R$ {{format_money($contract->paymentData()->cash)}} na assinatura e saldo em 
                                    {{$contract->paymentData()->quantity_parcel}} parcela(s) no valor de 
                                    R$ {{format_money($contract->paymentData()->value_parcel)}} @if($contract->paymentData()->quantity_parcel !== 1) cada @endif a partir 
                                    @if($contract->paymentData()->payment_after_by == \App\Http\Controllers\ContractController::$PAYMENT_AFTER_SIGNATURE)
                                        de
                                    @else
                                        da
                                    @endif
                                    {{mb_strtolower($contract->paymentData()->payment_after_by, 'UTF-8')}}.
                                    
                                    @if ($contract->paymentData()->bank != '')
                                        Financiamento das parcelas realizado pelo
                                        banco {{$contract->paymentData()->bank}}.
                                    @endif
                                </p>
                            @break

                            @case (contract_name_custom())
                                <p> {{$contract->paymentData()->text}}.</a>
                            @break
                        @endswitch
                    </label>
                </div>
            </div>
            <div>
                <p>
                    <span class="fw-bold">Prazo de Entrega:</span>
                    {{date('d/m/Y', strToTime($contract->installation_deadline))}}
                </p>
            </div>
            <div>
                <p class="mb-0">
                    @if ($adhesion_bank == 'rd-adhesion-bank-itau')
                        Dados Bancários: <span class="fw-bold">Itaú (AG: <span class="fw-normal">7494</span> &ndash; CC: <span class="fw-normal">18883-7</span> &ndash; PIX: <span class="fw-normal">contato@sunnyhouse.com.br</span>)</span>
                    @else
                        Dados Bancários: <span class="fw-bold">Santander (AG: <span class="fw-normal">1679</span> &ndash; CC: <span class="fw-normal">13001366-1</span> &ndash; PIX: <span class="fw-normal">santander@sunnyhouse.com.br</span>)</span>
                    @endif
                </p>
            </div>
            <div>
                <p class="mb-0">
                    <span class="fw-bold">SH Soluções Tecnológicas LTDA. CNPJ: 09445760/0001-87</span>
                </p>
            </div>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-adhesion @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-3">
                    <img style="margin-left: -38px !important; margin-top: -38px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="130px">
                </div>
                <div class="col-6">
                    <p class="text-end">
                        Proposta/Termo de Adesão:
                        <span class="fw-bold">{{contract_number($contract)}}</span>
                        {{(new DateTime())->format('d/m/Y')}}
                    </p>
                </div>
                <div class="col-3">
                    <p class="text-end fw-bold">Página 2/2</p>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-9">
                    <p class="text-end">
                        Proposta/Termo de Adesão:
                        <span class="fw-bold">{{contract_number($contract)}}</span>
                        {{(new DateTime())->format('d/m/Y')}}
                    </p>
                </div>
                <div class="col-3">
                    <p class="text-end fw-bold">Página 2/2</p>
                </div>
            </div>
        @endif
        
        <div class="row @if (!$logo) padding-top-130 @else mt-4 @endif">
            <p class="mb-0">
                Produtos e equipamentos industrializados, gerador fotovoltaico de potência não superior a
                750 W sob NCM 8501.31.20, potência superior a 750 W, mas não superior a 75 kW sob NCM
                8501.32.20, superior a 75 kW, mas não superior a 375 kW sob NCM 8501.33.20, de potência
                superior a 375 kW sob NCM 8501.34.20 conforme convênio CONFAZ 101/97.
            </p>
            <p class="fw-bold">
                De um ponto de vista geral, tudo que não é claramente especificado fica excluído do fornecimento
                e o &ldquo;comprador&rdquo; tem pleno conhecimento de todos os aspectos técnicos dos equipamentos e componentes ofertados.
            </p>

            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox1">
                    <label class="form-check-label" for="checkbox1">
                        Emissão de NF-e como único item &ldquo;GERADOR FOTOVOLTAICO&rdquo; conforme Convênio CONFAZ
                        101/97, que concede isenção do ICMS nas operações com equipamentos e componentes
                        para o aproveitamento das energias solar e eólica.
                    </label>
                </div>
            </div>

            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox2">
                    <label class="form-check-label fw-bold" for="checkbox2">
                        Impostos
                    </label>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-3">
                    <p class="mb-0">
                        <span class="fw-bold d-block">PIS</span>
                        1,65%
                    </p>
                </div>
                <div class="col-3">
                    <p class="mb-0">
                        <span class="fw-bold d-block">COFINS</span>
                        7,6%
                    </p>
                </div>
                <div class="col-3">
                    <p class="mb-0">
                        <span class="fw-bold d-block">IPI</span>
                        0%
                    </p>
                </div>
                <div class="col-3">
                    <p class="mb-0">
                        <span class="fw-bold d-block">ICMS</span>
                        0%
                    </p>
                </div>
            </div>

            <div class="mt-4">
                <p class="fw-bold mb-1">Sobre as Garantias dos Equipamentos:</p>
            </div>

            <div class="row">
                @foreach ($contract->contractsProductsType('GENERATOR') as $product)
                    <div class="col-4">
                        <span class="fw-bold d-block">{{$product->name}}</span>
                        <span class="d-block">Garantia de Fabricação: {{$product->guarantee}}</span>
                        <span class="d-block">Garantia de Eficiência: 25 anos</span>
                    </div>
                @endforeach

                @foreach ($contract->contractsProductsType('SOLAR_INVERTER') as $product)
                    <div class="col-4">
                        <span class="fw-bold d-block">{{$product->name}}</span>
                        {{$product->guarantee}}
                    </div>
                @endforeach

                @foreach ($contract->contractsProductsType('STRING_BOX') as $product)
                    <div class="col-4">
                        <span class="fw-bold d-block">{{$product->name}}</span>
                        12 meses
                    </div>
                @endforeach
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <p class="fw-bold mb-0">
                        Estrutura
                        @switch ($contract->generator_structure)
                            @case (1)
                                Solo Monoposte
                                @break
                            
                            @case (2)
                                Laje
                                @break

                            @case (3)
                                Fibrocimento
                                @break

                            @case (4)
                                Cerâmico
                                @break
                        @endswitch
                    </p>
                    12 meses
                </div>

                <div class="col-4">
                    <p class="fw-bold mb-0">Instalação Sunny House</p>
                    12 meses
                </div>

                <div class="col-4">
                    <p class="fw-bold mb-0">Componentes</p>
                    12 meses
                </div>
            </div>

            <p class="text-center fw-bold mt-5">TERMO DE ADESÃO</p>
            <p>
                <span class="fw-bold">Cliente</span> aceita todas as condições de fornecimento ofertadas nesta proposta
                e condições de vendas e garantias da SUNNY HOUSE.
            </p>
        </div>

        <div class="mt-3">
            <div class="row ps-3">
                Aceite/De acordo
            </div>
            <div class="row text-center padding-top-30">
                <div class="col-4">
                    <p>_____________________</p>
                    <p>Nome Legível</p>
                </div>
                <div class="col-4">
                    <p>_____________________</p>
                    <p>Assinatura</p>
                </div>
                <div class="col-3">
                    <p>_____/_____/_____</p>
                    <p>Data</p>
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

