<x-print-layout>
    <x-slot name="header">
    </x-slot>

    @section('title', $title)

    {{-- Page 1 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <p class="text-end">
                    <strong class="font-size-13">
                        INSTRUMENTO PARTICULAR DE LOCAÇÃO DE BENS E INSTALAÇÕES
                    </strong>
                </p>
            </div>
            <div class="col-12 padding-top-40">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center" colspan="2"><strong class="font-size-13">DAS PARTES</strong></td>
                        </tr>
                    </thead>
                    <tbody class="border-1">
                        <tr>
                            <td><b class="font-size-13">LOCADORA</b></td>
                            <td class="font-size-13"><strong class="font-size-13">S H SOLUÇÕES TECNOLÓGICAS LTDA (SUNNY HOUSE)</strong> com sede na Rod Augusto Montenegro, no 4300 Sala 802 Sul Parque Office, cidade de Belém, Estado do PA, CEP 66635-110, inscrito perante o CNPJ sob no <strong class="font-size-13">09.445.760/0001- 87</strong>, neste ato representada na forma do seu Contrato Social pelo seu sócio diretor <strong class="font-size-13">{{strtoupper($signeeName)}}</strong>; e-mail contato@sunnyhouse.com.br</td>
                        </tr>
                        <tr>
                            <td><b class="font-size-13">LOCATÁRIO</b></td>
                            @if($cliType == "CNPJ")
                                <td class="font-size-13"><strong class="font-size-13">{{strtoupper($cliName)}}</strong>, com sede na {{$contract->client->address_neighborhood}}, {{$contract->client->address_number}}, cidade de {{$contract->client->address_city}}, Estado de {{$contract->client->address_state}}, CEP {{$contract->client->address_cep}}, inscrita perante o {{$cliType}} sob no <strong class="font-size-13">{{$cliDoc}}</strong>, neste ato pelo seu representante legal <strong class='font-size-13'>{{$cliRepresentante}}</strong>; e-mail {{$contract->client->email}};</td>
                            @endif
                            @if($cliType == "CPF")
                                <td class="font-size-13"><strong class="font-size-13">{{strtoupper($cliName)}}</strong>, com moradia em {{$contract->client->address_neighborhood}}, {{$contract->client->address_number}}, cidade de {{$contract->client->address_city}}, Estado de {{$contract->client->address_state}}, CEP {{$contract->client->address_cep}}, inscrita perante o {{$cliType}} de número <strong class="font-size-13">{{$cliDoc}}</strong>; e-mail {{$contract->client->email}};</td>
                            @endif
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center"><strong class="font-size-13">DETALHES DA LOCAÇÃO</strong></td>
                        </tr>
                    </thead>
                    <tbody class="border-1">
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Potência da quota-parte locada: {{$contract->potencia_quota}} KWP</b></td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Estimativa de geração:</b> {{$contract->qtd_kwh * 12}} KWh/ANO ({{$contract->qtd_kwh}} KWh / MÊS)</td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Período de locação:</b> {{$contract->tempo_vigencia}} meses</td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Concessionária Local:</b> Equatorial Energia</td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Aluguel mensal com desconto:</b> R$ {{format_money($contract->valor)}}</td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Forma de pagamento:</b> Boleto Bancário</td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Data de vencimento:</b> último dia do mês</td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Reajuste do aluguel:</b> anualmente, conforme Cláusula 3.2</td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Contas Contratos:</b> Todas da titularidade da contratante do grupo B</td>
                        </tr>
                        <tr>
                            <td class="font-size-13"><b class="font-size-13">Local:</b> Fazenda Sunny Park</td>
                        </tr>
                    </tbody>
                </table>
                <p class="font-size-13 padding-top-20">Pelo presente instrumento particular e na melhor forma de direito, as PARTES acima qualificadas, doravante denominadas em conjunto “PARTES” ou, individualmente, “PARTE”.</p>
            </div>
        </div>
    </div>

    {{-- Page 2 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <p class="text-center">
                    <strong class="font-size-13">
                        Considerações Preliminares:
                    </strong>
                </p>
                <ol class="padding-top-40" style="padding-left: 25px;" type="1">
                    <li class="font-size-13"><span class="font-size-13">Considerando que a <strong class="font-size-13">LOCADORA</strong> é empresa com larga experiência em projetos e construção de centrais geradoras de energia fotovoltaica (<strong class="font-size-13">“CENTRAL GERADORA”</strong>);</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Considerando que o <strong class="font-size-13">LOCATÁRIO</strong> participa de <strong class="font-size-13">CONSÓRCIO</strong>, constituído, nos termos do seu Instrumento de Constituição de Consórcio, para exploração de <strong class="font-size-13">CENTRAL GERADORA</strong>, a fim de proporcionar as unidades consumidoras de suas consorciadas a participação no Sistema de Compensação de Energia Elétrica (<strong class="font-size-13">“SCEE”</strong>), criado pela Resolução Normativa n.o 482/2012 (<strong class="font-size-13">“REN 482/2012”</strong>), publicada pela Agência Nacional de Energia Elétrica (<strong class="font-size-13">“ANEEL”</strong>), na modalidade de geração compartilhada;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Considerando que a <strong class="font-size-13">LOCADORA</strong> desenvolverá empreendimento de geração de energia solar fotovoltaica no Estado do Pará e pretende locar uma quota-parte para o <strong class="font-size-13">LOCATÁRIO</strong>;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Considerando que a área na qual a <strong class="font-size-13">CENTRAL GERADORA</strong> será instalada encontra-se, neste ato, livre e desembaraçada de qualquer ônus que possa impedir o bom andamento do presente <strong class="font-size-13">CONTRATO</strong>.</span></li>
                </ol>
                <p class="font-size-13 padding-top-20"><strong class="font-size-13">RESOLVEM</strong> celebrar o presente INSTRUMENTO PARTICULAR DE CONTRATO DE LOCAÇÃO DE BENS E INSTALAÇÕES (<strong class="font-size-13">“CONTRATO”</strong>), fazendo-o nos seguintes termos e condições:</p>
                <p class="padding-top-20"><strong class="font-size-13">CLÁUSULA PRIMEIRA – OBJETO</strong></p>
                <ol class="padding-top-20" type="1">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1">
                            <li class="font-size-13"><span class="font-size-13">O presente <strong class="font-size-13">CONTRATO</strong> tem por objeto a locação, pelo <strong class="font-size-13">LOCATÁRIO</strong>, de uma quota- parte da <strong class="font-size-13">CENTRAL GERADORA</strong>, conforme discriminado no preâmbulo deste <strong class="font-size-13">CONTRATO</strong>, a fim de receber créditos de energia em suas unidades consumidoras, também informadas no preâmbulo, a serem devidamente cadastradas no <strong class="font-size-13">SCEE</strong>.</span></li>   
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 3 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <ol style="padding-left: 4cm;" type="1">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="2">
                            <li class="font-size-13"><span class="font-size-13">Observados os termos e condições deste <strong class="font-size-13">CONTRATO</strong> e do <strong class="font-size-13">CONSÓRCIO</strong>, uma vez realizada a conexão da <strong class="font-size-13">CENTRAL GERADORA</strong> à rede de distribuição de energia da Concessionária Local, o <strong class="font-size-13">LOCATÁRIO</strong> passará a gozar dos benefícios da quota locada da <strong class="font-size-13">CENTRAL GERADORA</strong>, pelo prazo de vigência deste <strong class="font-size-13">CONTRATO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="3">
                            <li class="font-size-13"><span class="font-size-13">O <strong class="font-size-13">LOCATÁRIO</strong> declara que as suas unidades consumidoras estão localizadas na mesma área de concessão de que a <strong class="font-size-13">CENTRAL GERADORA</strong> faz parte, bem como que tem ciência de que elas deverão permanecer dentro da área de concessão da distribuidora em questão até o fim do presente <strong class="font-size-13">CONTRATO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="4">
                            <li class="font-size-13"><span class="font-size-13">O <strong class="font-size-13">LOCATÁRIO</strong>, durante a vigência do <strong class="font-size-13">CONTRATO</strong>, não poderá dar à sua quota da <strong class="font-size-13">CENTRAL GERADORA</strong> outra destinação além das previstas neste <strong class="font-size-13">CONTRATO</strong>, ficando vedada a cessão, ou sublocação, parcial ou total, sem a previa anuência da outra <strong class="font-size-13">PARTE</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <p class="padding-top-20"><strong class="font-size-13">CLÁUSULA SEGUNDA – VIGÊNCIA</strong></p>
                <ol class="padding-top-20" style="padding-left: 25px;" type="1" start="2">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1">
                            <li class="font-size-13"><span class="font-size-13">O presente contrato entra em vigor na data da primeira entrega dos créditos de energia oriundos da quota alugada da <strong class="font-size-13">CENTRAL GERADORA</strong> para as unidades consumidoras do <strong class="font-size-13">LOCATÁRIO</strong>, permanecendo vigente pelo prazo definido no preâmbulo, sendo renovado de forma automática, por igual período, se não houver manifestação das <strong class="font-size-13">PARTES</strong> até 65 (sessenta e cinco) dias antes do fim do prazo previsto para a conclusão do <strong class="font-size-13">CONTRATO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <p class="padding-top-20"><strong class="font-size-13">CLÁUSULA TERCEIRA – REMUNERAÇÃO E CONDIÇÕES DE PAGAMENTO</strong></p>
                <ol class="padding-top-20" type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="1">
                            <li class="font-size-13"><span class="font-size-13">As <strong class="font-size-13">PARTES</strong> ajustam que o <strong class="font-size-13">LOCATÁRIO</strong> pagará à <strong class="font-size-13">LOCADORA</strong> o valor definido no preâmbulo do <strong class="font-size-13">CONTRATO</strong> referente à quota alugada (“Remuneração”).</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="2">
                            <li class="font-size-13"><span class="font-size-13">A Remuneração será reajustada anualmente, a partir do aniversário deste <strong class="font-size-13">CONTRATO</strong>, pela Inflação Energética.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="3">
                            <li class="font-size-13"><span class="font-size-13">O pagamento da Remuneração será realizado na data pactuada no preâmbulo, mediante a quitação de boleto bancário que será expedido pela <strong class="font-size-13">LOCADORA</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 4 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <ol type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="4">
                            <li class="font-size-13"><span class="font-size-13">O boleto com o valor da locação deverá ser enviado ao <strong class="font-size-13">LOCATÁRIO</strong> até 5 (cinco) dias antes da data de vencimento.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="5">
                            <li class="font-size-13"><span class="font-size-13">O atraso na entrega do boleto pela <strong class="font-size-13">LOCADORA</strong> ao <strong class="font-size-13">LOCATÁRIO</strong> importará na prorrogação do prazo para o pagamento em número de dias equivalente aos de atraso na apresentação dos documentos de cobrança, sem que o <strong class="font-size-13">LOCATÁRIO</strong> suporte qualquer ônus em decorrência desse fato, tais como correção monetária, multa e juros, mas a estes não se limitando.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="6">
                            <li class="font-size-13"><span class="font-size-13">O atraso no pagamento, por culpa do <strong class="font-size-13">LOCATÁRIO</strong>, acarretará a aplicação de multa de 2% (dois por cento) sobre o valor do débito, acrescida de juros de mora de 1% (um por cento) ao mês, e correção monetária “pró-rata”, com base na variação do IGP-M/FGV, devida desde a(s) data(s) do(s) vencimento(s), até a do efetivo pagamento, incidente sobre o(s) valor(es) em atraso. Caso a inadimplência seja superior a 90 (noventa) dias, o <strong class="font-size-13">CONTRATO</strong> poderá ser rescindido sem aviso prévio.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="7">
                            <li class="font-size-13"><span class="font-size-13">Os tributos e demais encargos fiscais incidentes, direta ou indiretamente, sobre o objeto do presente Contrato já estão inclusos na Remuneração.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="8">
                            <li class="font-size-13"><span class="font-size-13">O pagamento devido pelo <strong class="font-size-13">LOCATÁRIO</strong> à <strong class="font-size-13">LOCADORA</strong> deverá ser efetuado livre de quaisquer ônus e deduções não autorizadas, inclusive no caso de eventuais suspensões de energia pela Concessionária Local. Todas as despesas financeiras decorrentes dos referidos pagamentos correrão por conta do <strong class="font-size-13">LOCATÁRIO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="9">
                            <li class="font-size-13"><span class="font-size-13">Em caso de produção de energia inferior ao contratado, a cobrança mensal será realizada proporcionalmente ao resultado obtido, nunca ultrapassando os 100%.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="3">
                    <li class="font-size-13">
                        <ol style="padding-left: 2.2rem;" type="1" start="10">
                            <li class="font-size-13"><span class="font-size-13">Em caso de produção acima de 100% do contratado, será criado um saldo com a produção adicional que será utilizado para complementar os meses com produção inferior ao contratado.</span></li>
                        </ol>
                    </li>
                </ol>
                <p class="padding-top-20"><strong class="font-size-13">CLÁUSULA QUARTA – OBRIGAÇÕES DA LOCADORA</strong></p>
                <ol class="padding-top-20" type="1" start="4">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="1">
                            <li class="font-size-13"><span class="font-size-13">Durante a vigência deste Contrato, a <strong class="font-size-13">LOCADORA</strong> deverá:</span></li>
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 5 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <ol style="padding-left: 4cm;" type="I">
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Garantir a posse, o uso e o gozo pacífico da quota locada da <strong class="font-size-13">CENTRAL GERADORA</strong> e seus frutos pelo <strong class="font-size-13">LOCATÁRIO</strong>, tomando todas as medidas necessárias contra quaisquer perturbações;</span></li>
                </ol>
                <ol type="I" start="2">
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Comunicar imediatamente o <strong class="font-size-13">LOCATÁRIO</strong> acerca de qualquer fato, alteração e/ou problema que julgue relevante em relação ao objeto ora contratado que possa impactar o <strong class="font-size-13">CONTRATO</strong>;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Responsabilizar-se pela supervisão e prevenção de acidentes, nos termos da legislação brasileira aplicável à atividade de geração de energia;</span></li>
                </ol>
                <ol class="padding-top-20" type="I" start="4">
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Responsabilizar por todas as remunerações e indenizações ou quaisquer outras quantias devidas a seus empregados e subcontratados, assim como manter o <strong class="font-size-13">LOCATÁRIO</strong> indene de todos pagamentos desta natureza;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Solicitar prontamente ao <strong class="font-size-13">LOCATÁRIO</strong> todas as informações que necessitar para cumprir suas obrigações;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Realizar toda a interface junto à Concessionária Local com o objetivo de proporcionar a participação das unidades consumidoras do <strong class="font-size-13">LOCATÁRIO</strong> no <strong class="font-size-13">SCEE</strong> durante todo o <strong class="font-size-13">CONTRATO</strong>;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Permitir o acesso do <strong class="font-size-13">LOCATÁRIO</strong> à <strong class="font-size-13">CENTRAL GERADORA</strong>, mediante visita previamente agendada.</span></li>
                </ol>
                <p class="padding-top-20"><strong class="font-size-13">CLÁUSULA QUINTA – OBRIGAÇÕES DO LOCATÁRIO</strong></p>
                <ol class="padding-top-20" type="1" start="5">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="1">
                            <li class="font-size-13"><span class="font-size-13">Durante a vigência deste Contrato, o <strong class="font-size-13">LOCATÁRIO</strong> deverá:</span></li>
                        </ol>
                    </li>
                </ol>
                <ol type="I">
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Prestar todas as informações solicitadas pela <strong class="font-size-13">LOCADORA</strong> para execução plena do presente <strong class="font-size-13">CONTRATO</strong>;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Realizar pontualmente o pagamento da Remuneração e quaisquer outros valores devidos em razão do presente <strong class="font-size-13">CONTRATO</strong>, bem como das taxas, impostos, tributos e todas as contribuições que incidam ou venham a incidir ou sejam decorrentes do presente <strong class="font-size-13">CONTRATO</strong>;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Fornecer e emitir os documentos que lhe competir, se necessários ou quando exigidos pela <strong class="font-size-13">LOCADORA</strong>, às suas expensas;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Manter-se integrante do Consórcio definido no preâmbulo enquanto viger este <strong class="font-size-13">CONTRATO</strong>;</span></li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 6 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <ol type="I" start="5">
                    <li class="font-size-13"><span class="font-size-13">Comunicar a <strong class="font-size-13">LOCADORA</strong> eventual alteração das unidades consumidoras (inclusão/exclusão ou alteração de endereço) cadastradas no <strong class="font-size-13">SCEE</strong> em até 65 (sessenta e cinco) dias de antecedência, para que possa realizar os trâmites junto à Concessionária Local. O <strong class="font-size-13">LOCATÁRIO</strong> tem ciência de que o aproveitamento dos frutos da quota-parte locada poderá ser prejudicado no mês em que houver a solicitação de troca de titularidade, devendo ele, de qualquer maneira, arcar com o valor integral da Remuneração.</span></li>
                </ol>
                <p class="padding-top-20"><strong class="font-size-13">CLAUSULA SEXTA - RESCISÃO</strong></p>
                <ol class="padding-top-20" type="1" start="6">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1">
                            <li class="font-size-13"><span class="font-size-13">O presente <strong class="font-size-13">CONTRATO</strong> poderá ser rescindido nas seguintes hipóteses:</span></li>
                        </ol>
                    </li>
                </ol>
                <ol type="I">
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">por mútuo acordo das <strong class="font-size-13">PARTES</strong>;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">por qualquer das <strong class="font-size-13">PARTES</strong>, por justa causa, na hipótese de:</span></li>
                    <ol type="a">
                        <li class="font-size-13 padding-top-20"><span class="font-size-13">a outra <strong class="font-size-13">PARTE</strong>, agindo com dolo, má-fé ou culpa grave, lhe causar danos diretos, devidamente comprovados;</span></li>
                    </ol>
                </ol>
                <ol type="I" start="3">
                    <ol type="a" start="2">
                        <li class="font-size-13"><span class="font-size-13">a outra <strong class="font-size-13">PARTE</strong> praticar qualquer tipo de fraude ou falsidade com, contra ou em nome da <strong class="font-size-13">PARTE</strong> prejudicada e/ou de suas Afiliadas;</span></li>
                        <li class="font-size-13 padding-top-20"><span class="font-size-13">inadimplemento contratual com relação a qualquer das obrigações ora estabelecidas neste <strong class="font-size-13">CONTRATO</strong>, desde que não sanado dentro do prazo de tolerância estabelecido para o respectivo inadimplemento, ou, caso nada disponha, no prazo de 15 (quinze) dias a contar do recebimento de notificação escrita encaminhada pela <strong class="font-size-13">PARTE</strong> prejudicada neste sentido, hipótese em que a <strong class="font-size-13">PARTE</strong> faltosa deverá arcar com as perdas e danos comprovadamente incorridos pela <strong class="font-size-13">PARTE</strong> prejudicada em consequência de seu inadimplemento, consoante oportunamente apurado, e de qualquer outra penalidade aqui prevista;</span></li>
                    </ol>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">por qualquer uma das <strong class="font-size-13">PARTES</strong>, imediatamente e independente de qualquer notificação, se qualquer uma das <strong class="font-size-13">PARTES</strong>:</span></li>
                    <ol type="a">
                        <li class="font-size-13 padding-top-20"><span class="font-size-13">tiver decretada falência, tiver pedido de recuperação judicial deferido, tiver homologado plano de recuperação extrajudicial, tornar-se insolvente ou for liquidada extrajudicialmente;</span></li>
                    </ol>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 7 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <ol style="padding-left: 4cm;" type="I" start="3">
                    <ol type="a" start="2">
                        <li class="font-size-13"><span class="font-size-13">ceder ou transferir quaisquer de seus direitos e/ou obrigações previstos neste <strong class="font-size-13">CONTRATO</strong> sem a prévia concordância da outra <strong class="font-size-13">PARTE</strong> por escrito, exceção feita à cessão total ou parcial do presente <strong class="font-size-13">CONTRATO</strong> pela <strong class="font-size-13">LOCATÁRIA</strong> a qualquer Afiliada;</span></li>
                    </ol>
                </ol>
                <ol type="I" start="4">
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">em caso de transferência de controle, direto ou indireto do <strong class="font-size-13">LOCATÁRIO</strong>, exceto se tiver havido concordância prévia e por escrito pela <strong class="font-size-13">LOCADORA</strong>;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">na hipótese de saída/exclusão do <strong class="font-size-13">LOCATÁRIO</strong> do <strong class="font-size-13">CONSÓRCIO</strong>;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">na hipótese de comprovada ocorrência de caso fortuito ou de força maior que impeça a continuidade deste <strong class="font-size-13">CONTRATO</strong> por mais de 180 (cento e oitenta) dias.</span></li>
                </ol>
                <ol class="padding-top-20" type="1" start="6">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="2">
                            <li class="font-size-13"><span class="font-size-13">Em caso de rescisão em virtude de alguma das hipóteses elencadas nos incisos “ii” a ”v” da cláusula anterior, caberá à <strong class="font-size-13">PARTE</strong> inocente o direito de receber multa contratual da <strong class="font-size-13">PARTE</strong> infratora, no importe de 3 vezes o valor da Remuneração vigente à época, em até 15 (quinze) dias corridos da data da rescisão.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="6">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="3">
                            <li class="font-size-13"><span class="font-size-13">Na hipótese de a <strong class="font-size-13">LOCATÁRIA</strong> rescindir o <strong class="font-size-13">CONTRATO</strong> de forma antecipada e sem aviso prévio de 120 dias, esta deverá arcar com multa contratual de 20% da Remuneração vigente à época, multiplicado pelos meses remanescente de <strong class="font-size-13">contrato</strong> , em até 15 (quinze) dias corridos da data da rescisão caso.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="6">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="4">
                            <li class="font-size-13"><span class="font-size-13">Além da multa prevista na cláusula anterior, em qualquer hipótese de rescisão, o <strong class="font-size-13">LOCATÁRIO</strong> deverá arcar com os valores devidos a título de Remuneração até que seja efetivado o seu descadastramento enquanto beneficiário da quota-parte da CENTRAL GERADORA, a serem calculados pro rate die.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="6">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="5">
                            <li class="font-size-13"><span class="font-size-13">Em caso de interesse da <strong class="font-size-13">LOCATÁRIA</strong> em adquirir sua própria usina de energia solar fotovoltaica dando preferência para a <strong class="font-size-13">LOCADORA</strong> em projetar, fornecer equipamentos, instalar e homologar junto a Concessionária Local, a rescisão do presente <strong class="font-size-13">CONTRATO</strong>, se dará imediatamente após a homologação da usina de propriedade da LOCATÁRIA, sem qualquer penalização prevista nos itens 6.3 e 6.4</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="6">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="6">
                            <li class="font-size-13"><span class="font-size-13">Na hipótese de rescisão do presente <strong class="font-size-13">CONTRATO</strong> por qualquer motivo, permanecerão em pleno vigor e efeito as Cláusulas 7a a 9a do presente <strong class="font-size-13">CONTRATO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 8 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">     
                <p><strong class="font-size-13">CLÁUSULA SÉTIMA - CONFIDENCIALIDADE</strong></p>
                <ol class="padding-top-20" type="1" start="7">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1">
                            <li class="font-size-13"><span class="font-size-13">Os termos e condições contidos neste <strong class="font-size-13">CONTRATO</strong>, ou em qualquer outro documento referente aos pontos nele descritos, que venham a ser analisados, encaminhados ou distribuídos entre as PARTES, deverão ser tratados como confidenciais enquanto perdurar este <strong class="font-size-13">CONTRATO</strong> e por mais 2 (dois) anos após o término de sua vigência. Nenhuma das <strong class="font-size-13">PARTES</strong> poderá revelar o conteúdo de qualquer documento a terceiros, a menos que a outra a autorize por escrito.</span></li>
                        </ol>
                    </li>
                </ol>
                <p class="padding-top-20"><strong class="font-size-13">CLÁUSULA OITAVA – INDENIZAÇÃO</strong></p>
                <ol class="padding-top-20" type="1" start="8">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1">
                            <li class="font-size-13"><span class="font-size-13">O <strong class="font-size-13">LOCATÁRIO</strong>, pelo presente <strong class="font-size-13">CONTRATO</strong>, concorda em indenizar a <strong class="font-size-13">LOCADORA</strong> e suas Afiliadas por perdas e danos diretos devidamente comprovados oriundos de ações ou omissões relacionados a este <strong class="font-size-13">CONTRATO</strong> caso, notificado a respeito, não sane a irregularidade no prazo de 15 (quinze) dias ou outro previamente definido, seja neste <strong class="font-size-13">CONTRATO</strong>, seja por acordo firmado entre as <strong class="font-size-13">PARTES</strong> quando da ocasião.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="8">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="2">
                            <li class="font-size-13"><span class="font-size-13">A <strong class="font-size-13">LOCADORA</strong> não se responsabiliza por qualquer impacto na performance técnica da <strong class="font-size-13">CENTRAL GERADORA</strong> que decorra de ação ou omissão da Concessionária Local.</span></li>
                        </ol>
                    </li>
                </ol>
                <p class="padding-top-20"><strong class="font-size-13">CLÁUSULA NONA - DISPOSIÇÕES GERAIS</strong></p>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1">
                            <li class="font-size-13"><span class="font-size-13">O presente <strong class="font-size-13">CONTRATO</strong> obriga as <strong class="font-size-13">PARTES</strong> e seus sucessores, sendo vedado a qualquer das Partes transferir os direitos e obrigações impostos por este instrumento sem a prévia e expressa anuência da outra <strong class="font-size-13">PARTE</strong>, exceção feita à transferência pela <strong class="font-size-13">LOCADORA</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 9 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <ol style="padding-left: 4cm;" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="2">
                            <li class="font-size-13"><span class="font-size-13">Os termos e disposições deste <strong class="font-size-13">CONTRATO</strong> prevalecerão sobre quaisquer outros entendimentos ou acordos anteriores entre as <strong class="font-size-13">PARTES</strong>, expressos ou implícitos, referentes às condições aqui estabelecidas, não se responsabilizando, em consequência, as <strong class="font-size-13">PARTES</strong> por quaisquer ajustes estabelecidos por seus empregados, representantes e intermediários, que não constem das cláusulas inseridas no presente <strong class="font-size-13">CONTRATO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="3">
                            <li class="font-size-13"><span class="font-size-13">Nada neste <strong class="font-size-13">CONTRATO</strong> deverá ser considerado como constituição de uma sociedade ou parceria entre a <strong class="font-size-13">LOCADORA</strong> e o <strong class="font-size-13">LOCATÁRIO</strong>, nem a criação de um relacionamento de representação entre as <strong class="font-size-13">PARTES</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="4">
                            <li class="font-size-13"><span class="font-size-13">Na eventualidade de quaisquer dos termos ou condições deste <strong class="font-size-13">CONTRATO</strong> serem considerados inválidos, nulos ou inexequíveis, as disposições remanescentes não serão afetadas, prejudicadas ou anuladas. Nesse caso, as <strong class="font-size-13">PARTES</strong> envidarão esforços no sentido de estabelecer normas que mais se aproximem da(s) disposição(ões) invalidada(s), de forma a traduzir a intenção inicial das <strong class="font-size-13">PARTES</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="5">
                            <li class="font-size-13"><span class="font-size-13">A tolerância de qualquer uma das <strong class="font-size-13">PARTES</strong>, em relação a eventuais infrações da outra, totais ou parciais, não importará em modificação contratual, novação ou renúncia a direito, devendo ser considerada mera liberalidade da citada <strong class="font-size-13">PARTE</strong>. Nenhuma renúncia, por qualquer das <strong class="font-size-13">PARTES</strong>, a qualquer direito ou benefício, legal ou contratual, será válida, exceto se feita por escrito pela <strong class="font-size-13">PARTE</strong> renunciante.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="6">
                            <li class="font-size-13"><span class="font-size-13">Nenhuma <strong class="font-size-13">PARTE</strong> poderá, sem o prévio consentimento escrito da outra, usar o nome, denominação social, marcas ou demais sinais visuais e de identificação da outra <strong class="font-size-13">PARTE</strong>, ou se referir a eles, direta ou indiretamente.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="7">
                            <li class="font-size-13"><span class="font-size-13">Qualquer alteração ao presente <strong class="font-size-13">CONTRATO</strong> somente terá validade depois de formalizada por escrito, por meio da celebração de aditamento contratual assinado por ambas as <strong class="font-size-13">PARTES</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="8">
                            <li class="font-size-13"><span class="font-size-13">Todas as notificações, consentimentos, solicitações e outras comunicações previstas neste <strong class="font-size-13">CONTRATO</strong> somente serão consideradas válidas e eficazes se respeitarem a forma escrita e forem enviadas por meio de carta com aviso de recebimento ou protocolo; fax ou e-mail com comprovante de recebimento, para as <strong class="font-size-13">PARTES</strong> nos endereços do preâmbulo deste <strong class="font-size-13">CONTRATO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 10 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <ol type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1" start="9">
                            <li class="font-size-13"><span class="font-size-13">A mudança de destinatário de endereço ou de quaisquer dados de contato, deve ser prontamente comunicada à outra <strong class="font-size-13">PARTE</strong>, conforme aqui previsto; se dita comunicação deixar de ser realizada, qualquer aviso ou comunicação entregue aos destinatários ou nos endereços do preâmbulo do <strong class="font-size-13">CONTRATO</strong>, será considerada como tendo sido regularmente feita e recebida.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 2.2rem;" type="1" start="10">
                            <li class="font-size-13"><span class="font-size-13">Caso, após a data de assinatura deste <strong class="font-size-13">CONTRATO</strong>, seja alterada a regra de incidência de qualquer tributo sobre as operações de compensação de energia elétrica (<strong class="font-size-13">SCEE</strong>), em decorrência de adoção, promulgação ou modificação da legislação aplicável, em especial o Imposto sobre Circulação de Mercadorias e Serviços (<strong class="font-size-13">“ICMS”</strong>), as <strong class="font-size-13">PARTES</strong> avaliarão o impacto da criação ou majoração de referido tributo, a fim de atingir o reequilíbrio econômico-financeiro do <strong class="font-size-13">CONTRATO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 2.2rem;" type="1" start="11">
                            <li class="font-size-13"><span class="font-size-13">Caso haja mudança posterior na legislação e normas do setor elétrico brasileiro, incluindo nos Procedimentos de Distribuição – PRODIST ou na REN 482/12, que possam impactar substancialmente as condições ora pactuadas, as <strong class="font-size-13">PARTES</strong> desde já concordam em renegociar de boa-fé este <strong class="font-size-13">CONTRATO</strong>, mediante aditivo contratual, visando a manutenção do equilíbrio econômico-financeiro.</span></li>
                        </ol>
                    </li>
                </ol>
                <ol class="padding-top-20" type="1" start="9">
                    <li class="font-size-13">
                        <ol style="padding-left: 2.2rem;" type="1" start="12">
                            <li class="font-size-13"><span class="font-size-13">O presente <strong class="font-size-13">CONTRATO</strong>, assinado juntamente com 2 (duas) testemunhas, constitui título executivo extrajudicial, na forma do Artigo 784, Inciso III, do Código de Processo Civil.</span></li>
                        </ol>
                    </li>
                </ol>
                <p class="padding-top-20"><strong class="font-size-13">CLÁUSULA DÉCIMA – FORO</strong></p>
                <ol class="padding-top-20" type="1" start="10">
                    <li class="font-size-13">
                        <ol style="padding-left: 1.3rem;" type="1">
                            <li class="font-size-13"><span class="font-size-13">As Partes elegem o foro da Comarca de <strong class="font-size-13">Belém</strong>, Estado do <strong class="font-size-13">PA</strong>, com renúncia de qualquer outro, por mais privilegiado que seja para dirimir todas as questões oriundas deste <strong class="font-size-13">CONTRATO</strong>.</span></li>
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 11 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <p class="font-size-13 padding-top-60">E, assim, por estarem justas e contratadas, firmam o presente Contrato em 2 (duas) vias de igual teor e forma, perante as 2 (duas) testemunhas abaixo assinados.</p>
                <p class="font-size-13 text-center padding-top-80"><strong class="font-size-13">Belém, {{$day . ' de ' . $month . ' de ' . $year . '.'}}</strong></p>
                <p class="font-size-13 padding-top-20"><strong class="font-size-13">LOCADORA:</strong></p>
                <div class="row padding-top-80">
                    <div class="col-12"><p class="text-center">____________________________________________________</p></div>
                </div>
                <p class="font-size-13 text-center"><strong class="font-size-13">SUNNY HOUSE (S H SOLUÇÕES TECNOLÓGICAS)</strong></p>
                <p class="font-size-13 text-center">CNPJ: <strong class="font-size-13">09.445.760/0001-87</strong></p>
                <p class="font-size-13">Por: {{strtoupper($signeeName)}}</p>
                <p class="font-size-13">Cargo: CEO / FOUNDER</p>
                <p class="font-size-13">CPF: {{$signeeDoc}}</p>
                <p class="font-size-13 padding-top-80"><strong class="font-size-13">LOCATÁRIO:</strong></p>
                <div class="row padding-top-80">
                <div class="col-12"><p class="text-center">____________________________________________________</p></div>
                </div>
                <p class="font-size-13 text-center"><strong class="font-size-13">{{strtoupper($cliName)}}</strong></p>
                <p class="font-size-13 text-center">{{$cliType}}: <strong class="font-size-13">{{$cliDoc}}</strong></p>
            </div>
        </div>
    </div>

    {{-- Page 12 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <p class="font-size-13 text-center"><strong class="font-size-13">TERMO DE COMPROMISSO DE SOLIDARIEDADE</strong></p>
                <p class="font-size-13 text-center"><strong class="font-size-13">E ADESÃO AO CONSÓRCIO</strong></p>
                <ol class="padding-top-40" type="1">
                    <li class="font-size-13"><span class="font-size-13">Pelo presente Termo de Adesão e Procuração, a sociedade qualificada no item 5 abaixo (“Consorciada”), por liberalidade, opta por tornar-se membro do <strong class="font-size-13">CONSÓRCIO SUNNY PARK</strong>, após a leitura, compreensão e concordância com todos os termos do Instrumento Particular de Constituição de Consórcio, aderindo, neste ato, ao <strong class="font-size-13">CONSÓRCIO SUNNY PARK</strong> e declarando, na presente data, que:</span></li>
                </ol>
                <ol type="a">
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">por unanimidade seus sócios aprovam, com base nos arts. 278 e 279 da Lei no 6.404/1976, a participação no <strong class="font-size-13">CONSÓRCIO SUNNY PARK</strong>, com sede na Tv 5 Sub Div. Do Nucleo Col. Nsa. Sra. Do Carmo de Benevides, No 29 LT A2 CEP: 68790-000 na cidade de Santa Izabel do Pará - PA, destinado à exploração pela Consorciada e os demais membros do Consórcio da geração compartilhada de energia prevista na Resolução Normativa no 482/2012 da ANEEL e posteriores alterações;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">autoriza a sua administração a tomar todas as medidas e assinar todos os documentos necessários para tanto, incluindo, mas não se limitando ao instrumento de constituição do referido Consórcio;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">o representante signatário possui pleno direito, poder e autoridade para celebrar o presente Termo, cumprindo com as obrigações e compromissos estabelecidos nele e no Instrumento de Constituição do <strong class="font-size-13">CONSÓRCIO SUNNY PARK</strong> ao qual está vinculado;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">o <u class="font-size-13">Instrumento Particular de Constituição de Consórcio e o presente Termo</u> foram devidamente aprovados pelos seus órgãos de administração, em conformidade com seus atos constitutivos;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">o presente Termo foi devidamente celebrado, constituindo-se obrigação válida, vinculante e exequível em relação à Consorciada, consoante seus respectivos termos e condições;</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">não há nenhum processo, ação, investigação ou procedimento, pendente ou iminente, contra a Consorciada declarante ou perante qualquer corte, autoridade arbitral, administrativa ou governamental que, se decidido negativamente, seja ou será capaz de interferir na sua capacidade de cumprir com as obrigações decorrentes do Termo de Adesão e do Instrumento de Constituição de <strong class="font-size-13">CONSÓRCIO SUNNY PARK</strong>.</span></li>
                </ol>
                <ol class="padding-top-20" type="1" start="2">
                    <li class="font-size-13"><span class="font-size-13"><u class="font-size-13">ADESÃO AO CONSÓRCIO:</u> Neste ato, a Consorciada, expressamente, adere ao Consórcio e outorga à Consorciada Líder a Procuração, conforme item 3 abaixo. A adesão, no entanto, não implica responsabilidade civil e nem criminal do Consorciado.</span></li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Page 13 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <p class="font-size-13" style="padding-left: 4cm;"><u class="font-size-13">PROCURAÇÃO:</u> Em conformidade com o art. 684 do Código Civil, a Consorciada outorga à Consorciada Líder, de forma irrevogável e irretratável, (a) poderes gerais necessários para que a Consorciada Líder a represente em todo e qualquer assunto interno do Consórcio, os quais advém da sua função de administradora, representante e líder do Consórcio, incluindo, mas não se limitando, à representação da Consorciada nas Deliberações do Consórcio e perante terceiros, inclusive ANEEL, CCEE, ONS, EPE, MME e Distribuidora de Energia, na qual a Consorciada e/ou o Empreendimento será conectado; à assinatura de qualquer alteração do Instrumento de Constituição do Consórcio, tais como atos de ingresso e saída de Consorciada, extinção do Consórcio e outras deliberações porventura necessárias; à tomada de todas as medidas necessárias para a assinatura de quaisquer documentos que sejam exigíveis para que o Consórcio preencha os requisitos para viabilizar o funcionamento do Empreendimento, inclusive àquelas referentes a exclusão de Consorciadas em caso de inadimplemento no pagamento do Valor da Contribuição; (b) poderes especiais, para autorizá-la a receber citações, intimações e notificações provenientes de qualquer processo judicial e/ou administrativo relacionado ao Consórcio e/ou ao Empreendimento e/ou à sua condição de Consorciada; (c) outros poderes eventualmente necessários ao fiel cumprimento deste mandato, incluindo, mas não se limitando, àqueles necessários para assinar instrumentos e acordos, transigir e renunciar a direitos para assegurar o funcionamento regular do Empreendimento e Consórcio, podendo a Consorciada Líder substabelecer, sem reservas de poderes, o presente Termo de Adesão e Procuração.</p>
                <p class="font-size-13 padding-top-20">A qualificação da Consorciada e as condições da entrada no Consórcio são as seguintes:</p>
                <table class="table table-bordered">
                    <tbody class="border-1">
                        <tr>
                            <td class="font-size-13">Razão Social</td>
                            <td class="font-size-13"><strong class="font-size-13">{{$contract->client->corporate_name}}</strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">CNPJ</td>
                            <td class="font-size-13"><strong class="font-size-13">{{$contract->client->cnpj}}</strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">NIRE:</td>
                            <td class="font-size-13"><strong class="font-size-13"></strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">Endereço</td>
                            <td class="font-size-13"><strong class="font-size-13"></strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">Representante Legal</td>
                            <td class="font-size-13"><strong class="font-size-13">{{$contract->client->name}}</strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">CPF Representante Legal</td>
                            <td class="font-size-13"><strong class="font-size-13">{{$contract->client->cpf}}</strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">Endereço Representante Legal</td>
                            <td class="font-size-13"><strong class="font-size-13">{{$contract->client->address}}, {{$contract->client->address_number}}, {{$contract->client->address_neighborhood}}, {{$contract->client->address_cep}}, {{$contract->client->address_city}}/{{$contract->client->address_state}}</strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">E-mail</td>
                            <td class="font-size-13"><strong class="font-size-13">{{$contract->client->email}}</strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">Telefone</td>
                            <td class="font-size-13"><strong class="font-size-13">{{$contract->client->phone}}</strong></td>
                        </tr>
                        <tr>
                            <td class="font-size-13">Participação no Consórcio</td>
                            <td class="font-size-13"><strong class="font-size-13"></strong></td>    
                        </tr>
                        <tr>
                            <td class="font-size-13">Número de Instalação (UC)</td>
                            <td class="font-size-13"><strong class="font-size-13">Todas da titularidade do consorciado do grupo B</strong></td>    
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Page 14 --}}
    <div class="page pagecontrato">
        <div class="row text-justify">
            <div class="col-12">
                <ol type="1" start="3">
                    <li class="font-size-13 padding-top-60"><span class="font-size-13">Esse Termo de Adesão, por meio do qual será concluída a vinculação da Consorciada ao Consórcio, somente se aperfeiçoará com (i) o envio pela Consorciadas e a posse pela Consorciada Líder de todas as informações contidas na tabela acima e (ii) a apresentação, pela Consorciada, da cópia dos seus Atos Constitutivos atualizados e de outros documentos porventura necessários para a comprovação dos poderes dos seus representantes para a adesão ao Consórcio.</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">A Consorciada, neste ato, cede e autoriza o uso do seu nome, razão social ou nome fantasia, bem como sua imagem ao Consórcio. A presente cessão é concedida ao Consórcio, abrangendo inclusive a cessão da licença a terceiros, de forma direta ou indireta, bem como a inseri-la em todo e qualquer material como fotos, documentos e quaisquer outros meios de comunicação, para toda e qualquer finalidade, seja para uso comercial, de publicidade, jornalístico, editorial, marketing e/ou didático, sob toda e qualquer forma de processo de comunicação audiovisual ao público. Declara, ainda, estar ciente e de acordo que o Consórcio será o legítimo titular dos direitos ora outorgados, sem limitação de território. O Consórcio poderá exibir, distribuir e/ou divulgar, direta ou indiretamente, o nome e a imagem, durante a permanência da Consorciada no consórcio. A presente autorização é concedida em caráter absolutamente gratuito, ficando desde já avençado que a Consorciada nada tem a reclamar com relação à autorização ora concedida, em Juízo ou fora dele.</span></li>
                    <li class="font-size-13 padding-top-20"><span class="font-size-13">Todas as comunicações e documentos relativos ao Consórcio deverão ser encaminhadas ao endereço indicado na cláusula 1 deste contato@sunnyhouse.com.br</span></li>
                </ol>
                <p class="font-size-13 text-center padding-top-80"><strong class="font-size-13">Belém, {{$day . ' de ' . $month . ' de ' . $year . '.'}}</strong></p>
                <div class="row padding-top-80">
                    <div class="col-12"><p class="text-center">____________________________________________________</p></div>
                </div>
                <p class="font-size-13 text-center"><strong class="font-size-13">{{strtoupper($cliName)}}</strong></p>
                <p class="font-size-13 text-center">{{$cliType}}: <strong class="font-size-13">{{$cliDoc}}</strong></p>
            </div>
        </div>
    </div>
</x-print-layout>