<x-print-layout>
    <x-slot name="header"></x-slot>

    @section('title', $title)

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8">
                    <p class="text-end fw-bold text-decoration-underline">
                        TERMO DE CONDIÇÕES GERAIS DE FORNECIMENTO E INSTALAÇÃO DE GERADOR SOLAR FOTOVOLTAICO POR ENCOMENDA
                    </p>
                    <p class="fw-bold">
                        <span class="me-3">1.</span> PREÂMBULO
                    </p>
                    <p class="text-justify">
                        <span class="me-3">1.1.</span> O presente Termo de Condições Gerais de Fornecimento de GSF por encomenda (&ldquo;Termo&rdquo;) estabelece as normas gerais das atividades para aquisição junto à <span class="fw-bold">SUNNY HOUSE</span>, cuja potência máxima instalada foi escolhida pelo cliente no Termo de Adesão, ficando reservado à <span class="fw-bold">SUNNY HOUSE</span> a propriedade do GSF com todos os equipamentos e ativos que o compõe até que o valor total de venda indicado no Termo de Adesão e regulado neste Termo (&ldquo;Preço&rdquo;) seja 
                        <span class="text-decoration-underline">integralmente</span> pago pelo Cliente, caracterizando-se o pacto de reserva de domínio entre as Partes ora acordado. O Preço do GSF, condições de pagamento, locais de entrega dos componentes e conclusão do processo de instalação e ativação do GSF, bem como dos serviços adicionais de operação e manutenção que a
                        <span class="fw-bold">SUNNY HOUSE</span> poderá prestar a pedido do Cliente também estão previstos no Termo de Adesão.
                    </p>
                    <p class="text-justify">
                        <span class="me-3">1.2.</span> Este Termo tem plena eficácia e obrigatoriedade, salvo se alterado total ou parcialmente por acordo escrito entre as Partes.
                    </p>
                </div>
            </div>
        @else
            <div class="row d-flex justify-content-end">
                <div class="col-8">
                    <p class="text-end fw-bold text-decoration-underline">
                        TERMO DE CONDIÇÕES GERAIS DE FORNECIMENTO E INSTALAÇÃO DE GERADOR SOLAR FOTOVOLTAICO POR ENCOMENDA
                    </p>
                    <p class="fw-bold">
                        <span class="me-3">1.</span> PREÂMBULO
                    </p>
                    <p>
                        <span class="me-3">1.1.</span> O presente Termo de Condições Gerais de Fornecimento de GSF por encomenda (&ldquo;Termo&rdquo;) estabelece as normas gerais das atividades para aquisição junto à <span class="fw-bold">SUNNY HOUSE</span>, cuja potência máxima instalada foi escolhida pelo cliente no Termo de Adesão, ficando reservado à <span class="fw-bold">SUNNY HOUSE</span> a propriedade do GSF com todos os equipamentos e ativos que o compõe até que o valor total de venda indicado no Termo de Adesão e regulado neste Termo (&ldquo;Preço&rdquo;) seja 
                        <span class="text-decoration-underline">integralmente</span> pago pelo Cliente, caracterizando-se o pacto de reserva de domínio entre as Partes ora acordado. O Preço do GSF, condições de pagamento, locais de entrega dos componentes e conclusão do processo de instalação e ativação do GSF, bem como dos serviços adicionais de operação e manutenção que a
                        <span class="fw-bold">SUNNY HOUSE</span> poderá prestar a pedido do Cliente também estão previstos no Termo de Adesão.
                    </p>
                    <p>
                        <span class="me-3">1.2.</span> Este Termo tem plena eficácia e obrigatoriedade, salvo se alterado total ou parcialmente por acordo escrito entre as Partes.
                    </p>
                </div>
            </div>
        @endif
        
        <div class="row text-justify">
            <p>
                <span class="me-3">1.3.</span> Ao assinar o Termo de Adesão, que deve ser analisado pelo Cliente sempre em conjunto com este Termo, o Cliente realiza o pedido de aquisição do GSF automaticamente e declara estar integralmente de acordo com as cláusulas deste Termo.
            </p>

            <p class="fw-bold">
                <span class="me-3">2.</span> OBJETO
            </p>
            <p class="mb-0">
                <span class="pe-3">2.1.</span> O objeto deste Termo compreende o processo de aquisição e
                instalação de um GSF para o Cliente, englobando as seguintes atividades, as quais serão realizadas pela SUNNY HOUSE e/ou por seus subcontratados:
            </p>

            <ol type="I" style="padding-left: 25px;">
                <li>
                    <span>
                        A elaboração pela SUNNY HOUSE da documentação de projeto para o acesso do GSF à
                        distribuidora de energia da localidade do Cliente (&ldquo;Projeto&rdquo;);
                    </span>
                </li>
                <li>
                    <span>
                        O fornecimento dos componentes que englobam o GSF adquirido pela SUNNY HOUSE para a conversão de
                        energia solar em eletricidade, conforme modalidade escolhida pelo Cliente no Termo de Adesão;
                    </span>
                </li>
                <li>
                    <span>
                        O transporte, a finalização do processo de aquisição e a entrega do GSF selecionado no Termo de
                        Adesão no endereço do imóvel informado pelo Cliente;
                    </span>
                </li>
                <li>
                    <span>
                        A instalação completa do GSF selecionado no Termo de Adesão no local de instalação informado pelo Cliente e conforme definidos no Projeto.
                    </span>
                </li>
                <li>
                    <span>
                        Testes de funcionalidade do GSF.
                    </span>
                </li>
            </ol>

            <p class="mb-0">
                <span class="me-3">2.2.</span> A SUNNY HOUSE prestará os serviços de operação e
                manutenção do GSF abaixo <span class="text-decoration-underline">descritos</span> (&ldquo;O&M&rdquo;),
                durante o período indicado no Termo de Adesão, sem custo adicional para o Cliente:
            </p>

            <ol type="I" style="padding-left: 25px;">
                <li>
                    <span>
                        Realização de monitoramento remoto (desde que haja disponibilidade de internet no local de
                        instalação) do desempenho de geração do GSF. Sendo verificada a ocorrência de inconsistência,
                        tomará as devidas ações para possíveis correções.
                    </span>
                </li>
            </ol>

            <p class="mb-0">
                <span class="me-3">2.3.</span> Em complemento ao serviço de O&M descrito na Cláusula 2.2,
                item (I) acima, o Cliente poderá contratar os serviços abaixo descritos mediante pagamento adicional e solicitação à <span class="text-decoration-underline">SUNNY HOUSE</span>
                (&ldquo;<span class="text-decoration-underline">O&M</span> Adicional&rdquo;):
            </p>
            <ol type="I" style="padding-left: 25px;">
                <li>
                    <span>
                        Inspeção de fixação dos módulos, estruturas metálicas e cabeamento no telhado ou no local do
                        Imóvel onde o GSF fora instalado;
                    </span>
                </li>
                <li>
                    <span>
                        Limpeza dos módulos fotovoltaicos do GSF;
                    </span>
                </li>
                <li>
                    <span>
                        Medições elétricas e conferência de equipamentos e conexões, fazendo os reparos quando necessários.
                    </span>
                </li>
            </ol>

            <p>
                <span class="me-3">2.4.</span> Para correta instalação do GSF, poderão ser realizados
                pela SUNNY HOUSE mediante contratação e pagamento pelo Cliente, serviços adicionais necessários que não compõem o escopo da Proposta (&ldquo;Serviços Adicionais&rdquo;), tais como: reforço da rede elétrica do imóvel onde será instalado o GSF; adequação da caixa de medição; trabalhos de alvenaria e pintura para embutir eletrodutos; reforço no telhado, etc.
            </p>
            <p>
                <span class="me-3">2.4.1.</span> Sendo constatada a necessidade de realização de Serviços
                Adicionais, o Cliente poderá optar por contratar a SUNNY HOUSE ou outro profissional, que deverá realizá-los antes da instalação do GSF pela SUNNY HOUSE
            </p>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <p class="fw-bold">
                        <span class="me-3">3.</span> ANEXOS AO TERMO
                    </p>
                    <p>
                        <span class="me-3">3.1.</span> Fazem parte integrante deste Termo os seguintes Anexos,
                        dispostos na seguinte ordem de prevalência no caso de divergência entre suas disposições:
                    </p>
        
                    <div class="row" style="padding-left: 25px; margin-bottom: 20px">
                        <div class="col-2">Anexo I</div>
                        <div class="col-10">TERMO DE ADESÃO</div>
        
                        <div class="col-2">Anexo A</div>
                        <div class="col-10">COMO FUNCIONA UM GERADOR SOLAR</div>
        
                        <div class="col-2">Anexo B</div>
                        <div class="col-10">ESPECIFICAÇÕES TÉCNICAS</div>
        
                        <div class="col-2">Anexo C</div>
                        <div class="col-10">GARANTIAS</div>
                    </div>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-12">
                    <p class="fw-bold">
                        <span class="me-3">3.</span> ANEXOS AO TERMO
                    </p>
                    <p>
                        <span class="me-3">3.1.</span> Fazem parte integrante deste Termo os seguintes Anexos,
                        dispostos na seguinte ordem de prevalência no caso de divergência entre suas disposições:
                    </p>
                </div>

                <div class="row" style="padding-left: 25px; margin-bottom: 20px">
                    <div class="col-2">Anexo I</div>
                    <div class="col-10">TERMO DE ADESÃO</div>

                    <div class="col-2">Anexo A</div>
                    <div class="col-10">COMO FUNCIONA UM GERADOR SOLAR</div>

                    <div class="col-2">Anexo B</div>
                    <div class="col-10">ESPECIFICAÇÕES TÉCNICAS</div>

                    <div class="col-2">Anexo C</div>
                    <div class="col-10">GARANTIAS</div>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <p class="fw-bold">
                <span class="me-3">4.</span> OBRIGAÇÕES E RESPONSABILIDADES DAS PARTES
            </p>
            <p>
                <span class="me-3">4.1.</span> Sem prejuízo das demais disposições deste Termo, são
                obrigações da SUNNY HOUSE:
            </p>

            <p>
            <ol type="I" style="padding-left: 25px;">
                <li>
                   <span>
                        Agendar a finalização do processo de instalação do GSF em dia e hora conveniente para o Cliente,
                        respeitado o horário comercial (8h às 17h) em dias úteis;
                   </span>
                </li>
                <li>
                    <span>
                        Realizar todas as atividades de fornecimento, instalação e O&M do GSF com técnica, diligência,
                        presteza, prudência e qualidade, observando integralmente as disposições deste Termo, da legislação e regulamentação aplicáveis, arcando com os custos necessários para a instalação do GSF e conexão à rede distribuidora, exceto obras de adequação de infraestrutura elétrica, mecânica e civil que porventura o imóvel necessite para a correta instalação do GSF, e que não tenham sido contratados pelo Cliente, constando por escrito no Termo de Adesão;
                    </span>
                </li>
                <li>
                    <span>
                        Prestar para o Cliente os esclarecimentos e as informações que se fizerem necessárias à adequada
                        utilização do GSF;
                    </span>
                </li>
                <li>
                    <span>
                        Respeitar e fazer com que todos os seus prepostos, empregados e subcontratados respeitem todas as normas aplicáveis à segurança, higiene e medicina do trabalho, decorrentes de exigências legais, previstas em leis e disposições aplicáveis;
                    </span>
                </li>
                <li>
                    <span>
                        Responsabilizar-se por todo e qualquer dano direto causados ao Cliente e/ou a terceiros, em virtude da má execução do objeto deste Termo;
                    </span>
                </li>
                <li>
                    <span>
                        Configurar o(s) inversor(es) e/ou sistema de monitoramento do GSF em rede sem-fio quando
                        disponível, conforme previsão no Termo de Adesão;
                    </span>
                </li>
                <li>
                    <span>
                        Descartar adequadamente os resíduos sólidos gerados durante as atividades de fornecimento e
                        instalação do GSF;
                    </span>
                </li>
                <li>
                    <span>
                        Homologar o GSF junto à concessionária distribuidora de energia que o GSF será
                        conectado (&ldquo;Distribuidora&rdquo;);
                    </span>
                </li>
                <li>
                    <span>
                        Auditar as duas primeiras faturas da conta de energia elétrica do Cliente emitida pela Distribuidora após a homologação do GSF, desde que disponibilizada à SUNNY HOUSE pelo Cliente em formato PDF, de forma legível e em até 3 dias úteis a contar de sua emissão;
                    </span>
                </li>
                <li>
                    <span>
                        Fornecer após a conclusão da implantação do GSF, manual de usuário do
                        GSF (&ldquo;Manual&rdquo;), contendo informações referentes a sua operação e manutenção.
                    </span>
                </li>
            </ol>
            </p>
            <p>
                <span class="me-3">4.2.</span> Sem prejuízo das demais disposições deste Termo,
                <span class="fw-bold">são obrigações do Cliente:</span>
            </p>
            <ol type="I" style="padding-left: 25px;">
                <li>
                    <span>
                        Disponibilizar à SUNNY HOUSE em tempo hábil, informações e documentos necessários para
                        finalização do processo de aquisição e instalação do GSF, bem como permitir acesso de funcionários e subcontratados da SUNNY HOUSE ao imóvel, mediante prévio agendamento;
                    </span>
                </li>
                <li>
                    <span>
                        Nos dias agendados para instalaçãodo GSF, apresentar os locais de instalação dos equipamentos,
                        livres e desimpedidos de pessoas e objetos que possam obstruir ou colocar em risco equipamentos ou pessoas durante o acesso dos funcionários e subcontratados da SUNNY HOUSE;
                    </span>
                </li>
                <li>
                    <span>
                        Utilizar o GSF e os equipamentos que o integra, apenas e tão somente para a captação de energia
                        solar e sua conversão em energia elétrica;
                    </span>
                </li>
                <li>
                    <span>
                        Abster-se de ceder o GSF a qualquer terceiro sem o conhecimento e autorização por escrito da SUNNY HOUSE,nemconstituir sobre ele, direta ou indiretamente, ônus, penhor, caução, gravame, outorgar em garantia de qualquer espécie, até que sejam quitadas todasas parcelas do Preço, respeitando pacto de reserva de domínio acordado na Cláusula 1.2 do presente Termo;
                    </span>
                </li>
                <li>
                    <span>
                        Efetuar o pagamento do Preço na forma e datas acordadas no Termo de Adesão;
                    </span>
                </li>
                <li>
                    <span>
                        Permitir o acesso da SUNNY HOUSE ao local de instalação dos equipamentos do GSF para retirada e
                        retomada dos mesmos em caso de inadimplemento do Preço, respeitando o pacto de reserva de
                        domínio;
                    </span>
                </li>
            </ol>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <ol type="I" start="7">
                        <li>
                            <span>
                                Impedir o acesso de terceiros ao GSF com finalidade de reengenharia ou qualquer outra prática análoga, sob pena de perda das garantias de equipamentos, instalação e serviços realizados;
                            </span>
                        </li>
                        <li>
                            <span>
                                Disponibilizar e manter a sua própria custa, conexão de internet e rede tipo
                                &ldquo;WiFi&rdquo; adequada e com potência suficiente para permitir a transmissão de dados provenientes do GSF e seus equipamentos.
                            </span>
                        </li>
                    </ol>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-8 offset-4">
                    <ol type="I" start="7">
                        <li>
                            <span>
                                Impedir o acesso de terceiros ao GSF com finalidade de reengenharia ou qualquer outra prática análoga, sob pena de perda das garantias de equipamentos, instalação e serviços realizados;
                            </span>
                        </li>
                        <li>
                            <span>
                                Disponibilizar e manter a sua própria custa, conexão de internet e rede tipo
                                &ldquo;WiFi&rdquo; adequada e com potência suficiente para permitir a transmissão de dados provenientes do GSF e seus equipamentos.
                            </span>
                        </li>
                    </ol>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <p class="mt-5 pt-3">
                <span class="me-3">4.3.</span> Caso os módulos fotovoltaicos sejam instalados sobre o
                telhado do Cliente, a SUNNY HOUSE deverá realizar inspeção prévia à instalação no telhado, devendo certificar que inexiste telhas quebradas ou qualquer defeito ou situação que permita a entrada de água, se comprometendo a não prejudicar a sua estanqueidade após a conclusão dos serviços, bem como se responsabiliza a reparar eventuais danos causados ao telhado comprovadamente comprovados que tenha causado. Sendo identificados problemas na inspeção prévia, os mesmos serão reportados ao Cliente que deverá providenciar rapidamente os reparos necessários, sob pena da SUNNY HOUSE deixar de garantir a estanqueidade após a conclusão. <span class="fw-bold">A avaliação de capacidade de suporte mecânica do telhado não faz parte do escopo e/ou responsabilidade da SUNNY HOUSE.</span>
            </p>

            <p class="fw-bold"><span class="me-3">5.</span> VIGÊNCIA</p>
            <p>
                <span class="me-3">5.1.</span> Este contrato tem início na data da assinatura do mesmo
                pelas partes e vigorará até a homologação do GSF junto a distribuidora, exceto, pela garantia de instalação pela SUNNY HOUSE e obrigações dela decorrentes, que deverá perdurar pelo prazo previsto no Termo de adesão.
            </p>

            <p class="fw-bold"><span class="me-3">6.</span> GARANTIA</p>
            <p>
                <span class="me-3">6.1.</span> As garantias dos fabricantes de máquinas e equipamentos
                que compõem o GSF que a SUNNY HOUSE repassa ao Cliente, e Garantia SUNNY HOUSE estão previstas no Anexo C ao presente Termo.
            </p>

            <p class="fw-bold"><span class="me-3">7.</span> PREÇO E CONDIÇÃO DE PAGAMENTO</p>
            <p>
                <span class="me-3">7.1.</span> O Preço e condições de pagamento são aqueles descritos no
                Termo de Adesão, conforme as características do GSF adquirido, instalação, O&M e O&M Adicional caso contratado pelo Cliente, atualizado monetariamente com base na variação mensal do IPCA &ndash; Índice de Preços ao Consumidor &ndash; Amplo, publicado pelo Instituto Brasileiro de Geografia e Estatística &ndash; IBGE (&ldquo;IPCA&rdquo;), pro rata die, ou outro índice que o substitua.
            </p>
            <p>
                <span class="me-3">7.2.</span> Os tributos, taxas e emolumentos devidos, que incidirem
                sobre o processo de industrialização e fornecimento do GSF, serão suportados pelo contribuinte conforme determinado pela legislação, e aqueles que recaiam sobre o Cliente, estarão destacados na nota fiscal com as alíquotas vigentes na data do faturamento.
            </p>
            <p>
                <span class="me-3">7.3.</span> O Cliente não poderá suspender o pagamento de parte ou
                totalidade do Preço, efetuar pagamentos parciais diferente do acordado no Termo de Adesão, ou ainda, efetuar retenções de qualquer natureza baseado em reclamações não reconhecidas pela SUNNY HOUSE, sob pena de arcar com o custo de capitação praticado por instituições financeiras reconhecidamente de 1ª linha, que a SUNNY HOUSE terá que acessar para recomposição do seu fluxo de caixa, além das penalidades previstas na Cláusula 10ª.
            </p>
            <p>
                <span class="me-3">7.4.</span> Na hipótese de ocorrer inadimplemento ou atraso no
                pagamento de qualquer parcela do Preço por motivos não imputáveis à SUNNY HOUSE incidirá sobre a parcela inadimplida ou em atraso, os encargos de juros, correção monetária e multas previstas na Cláusula 10ª.
            </p>
            <p class="fw-bold"><span class="me-3">8.</span> EXCLUDENTE DE RESPONSABILIDADE</p>
            <p>
                <span class="me-3">8.1.</span> Nenhuma das Partes será responsável pelo descumprimento de
                suas obrigações, nem estarão sujeitas a reparar quaisquer danos, reivindicações, ações judiciais e extrajudiciais, desde que decorrentes de caso fortuito ou força maior, na forma prevista no artigo 393 do Código Civil Brasileiro, devendo, para tanto, comunicar a ocorrência de tal fato no menor prazo possível à outra Parte, e informar os efeitos danosos do evento. Na ocorrência de Eventos de Caso Fortuito ou de Força Maior (conforme abaixo definido), o prazo de entrega será estendido por período equivalente ao atraso, acrescido de um período razoável para o reinício da execução a ser acordado entre as Partes.
            </p>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <p>
                        <span class="me-3">8.2.</span> Para os fins desta Cláusula, acordam as Partes que em
                        complemento ao previsto no artigo 393 do Código Civil Brasileiro, será considerada hipótese de caso fortuito ou força maior a ocorrência de evento ou condição: (i) que torne impossível o cumprimento pela Parte afetada de suas obrigações em conformidade com o presente Termo; (ii) na medida em que tais eventos estiverem fora de controle razoável da Parte afetada e não sejam causados por sua culpa ou negligência; (iii) que não poderia ter sido prevenido ou evitado pela Parte afetada pelo exercício da devida diligência, incluindo o dispêndio de qualquer montante razoável levando-se em consideração o Preço; e, (iv) são considerados exemplificativamente eventos de Força Maior as inundações, terremotos, guerras, distúrbios civis, revoltas, insurreições, sabotagens, embargos comerciais, incêndios, explosões, desligamento e in terrupções da rede da Distribuidora, greves, e outros, ocasionados por terceiros, que impeçam as Partes de tempestivamente cumprirem seus deveres e obrigações
                        (<span class="text-decoration-underline">&ldquo;Eventos de Caso Fortuito ou de Força Maior&rdquo;</span>).
                    </p>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-12">
                    <p>
                        <span class="me-3">8.2.</span> Para os fins desta Cláusula, acordam as Partes que em
                        complemento ao previsto no artigo 393 do Código Civil Brasileiro, será considerada hipótese de caso fortuito ou força maior a ocorrência de evento ou condição: (i) que torne impossível o cumprimento pela Parte afetada de suas obrigações em conformidade com o presente Termo; (ii) na medida em que tais eventos estiverem fora de controle razoável da Parte afetada e não sejam causados por sua culpa ou negligência; (iii) que não poderia ter sido prevenido ou evitado pela Parte afetada pelo exercício da devida diligência, incluindo o dispêndio de qualquer montante razoável levando-se em consideração o Preço; e, (iv) são considerados exemplificativamente eventos de Força Maior as inundações, terremotos, guerras, distúrbios civis, revoltas, insurreições, sabotagens, embargos comerciais, incêndios, explosões, desligamento e in terrupções da rede da Distribuidora, greves, e outros, ocasionados por terceiros, que impeçam as Partes de tempestivamente cumprirem seus deveres e obrigações
                        (<span class="text-decoration-underline">&ldquo;Eventos de Caso Fortuito ou de Força Maior&rdquo;</span>).
                    </p>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <p>
                <span class="me-3">8.3.</span> Caso um Evento de Caso Fortuito ou de Força Maior provoque
                impacto no Preço e/ou data de entrega/instalação do GSF, deverão as Partes buscar o reequilíbrio econômico-financeiro do Termo, pautadas na boa-fé contratual, para acordarem as revisões necessárias no Termo de Adesão, sob pena de rescisão contratual e efeitos da Cláusula 10.4.
            </p>
            <p class="fw-bold">
                <span class="me-3">9.</span> PROPRIEDADE INTELECTUAL, CONFIDENCIALIDADE E DIREITO À IMAGEM
            </p>
            <p>
                <span class="me-3">9.1.</span> O Cliente reconhece que todos e quaisquer dados, informações, projetos, estudos, conhecimentos, relatórios, manuais, tecnologias, instruções, operações, segredos de negócio, documentos, fluxogramas, informações mercadológicas, base de dados, entre outros, relacionados ao GSF, sua instalação, monitoramento, manutenção e este Termo e seus anexos, são de propriedade exclusiva da SUNNY HOUSE e/ou de seus fornecedores e/ou subcontratados e respectivos sucessores.
            </p>
            <p>
                <span class="me-3">9.2.</span> O objeto deste Termo é a entrega e instalação de um GSF pela SUNNY HOUSE para o Cliente, feito sob encomenda, bem como a execução dos Serviços de O&M e O&M Adicional casos contratados pelo Cliente, não havendo por este Termo, qualquer outorga por parte da SUNNY HOUSE de qualquer licença, cessão, direito de uso ou qualquer outro direito relacionado aos dados, informações, projetos, estudos, conhecimentos, relatórios, marcas, manuais ou tecnologias do GSF ou do sistema fotovoltaico.
            </p>
            <p>
                <span class="me-3">9.3.</span> O Cliente desde já concede à SUNNY HOUSE o direito de utilizar, a título gratuito, as imagens do GSF instalado no imóvel para eventual veiculação na mídia, realização de campanhas, produção de materiais de marketing ou outras atividades correlatas.
            </p>

            <p class="fw-bold">
                <span class="me-3">10.</span> RESPONSABILIDADES E PENALIDADES
            </p>
            <p>
                <span class="me-3">10.1.</span> O não pagamento das importâncias devidas à SUNNY HOUSE pelo Cliente segundo os prazos previstos neste Contrato, por culpa exclusiva do Cliente, sujeitará o Cliente ao pagamento da importância em atraso acrescida de multa de mora de 2% (dois por cento), e ainda juros de mora à razão de 1% (um por cento) ao mês e correção monetária com base na variação do IPCA, incidentes a partir da data de vencimento e até a data do efetivo pagamento, calculados pro <em>ratadie</em>.
            </p>
            <p>
                <span class="me-3">10.2.</span> Persistindo o inadimplemento nos termos da Cláusula 10.1
                acima por um período superior a 20 (vinte) dias, e sem prejuízo das demais disposições previstas neste Termo, poderá a SUNNY HOUSE, a seu exclusivo critério, declarar a dívida antecipadamente vencida de forma integral, podendo fazer valer seu direito de reaver o GSF em virtude do pacto de reserva de domínio acordado entre as Partes neste Termo.
            </p>
            <p>
                <span class="me-3">10.3.</span> Sem prejuízo de quaisquer outras obrigações e responsabilidades previstas neste Contrato, a SUNNY HOUSE é responsável pelos danos diretos porventura causados por seus empregados, contratados e/ou prepostos ao Cliente na execução deste Termo.
            </p>
            <p>
                <span class="me-3">10.4.</span> As Partes responderão, apenas, pelos danos diretos que tenham sido causados por sua culpa comprovada e exclusiva, ficando, todavia, deste já avençado que as Partes não serão responsáveis por perdas e danos indiretos, perdas de produção, de receita, por multas do poder concedente e/ou lucros cessantes, perante elas ou quaisquer terceiros, durante a execução deste Termo.
            </p>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <p>
                        <span class="me-3">10.5.</span> As Partes acordam que a cobrança de todas as
                        penalidades estabelecidas neste Termo será realizada mediante notificação para a constituição da outra Parte em mora, nos termos do Artigo 397 do Código Civil.
                    </p>
                    <p>
                        <span class="me-3">10.6.</span> As PARTES acordam que o valor de referência para
                        cálculo das penalidades estabelecidas neste Termo, será o Preço corrigido na forma da Cláusula 7.1, desde a data de assinatura do Termo de Adesão até a data de pagamento da penalidade.
                    </p>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-8 offset-4">
                    <p>
                        <span class="me-3">10.5.</span> As Partes acordam que a cobrança de todas as
                        penalidades estabelecidas neste Termo será realizada mediante notificação para a constituição da outra Parte em mora, nos termos do Artigo 397 do Código Civil.
                    </p>
                    <p>
                        <span class="me-3">10.6.</span> As PARTES acordam que o valor de referência para
                        cálculo das penalidades estabelecidas neste Termo, será o Preço corrigido na forma da Cláusula 7.1, desde a data de assinatura do Termo de Adesão até a data de pagamento da penalidade.
                    </p>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <p class="fw-bold mt-5 pt-3">
                <span class="me-3">11.</span> RESCISÃO
            </p>
            <p>
                <span class="me-3">11.1.</span> Este Termo poderá ser rescindido por qualquer das Partes
                mediante comunicação, por escrito, a outra Parte, sem que caiba em benefício da Parte que deu causa à rescisão, qualquer reclamação, indenização ou compensação, em razão da rescisão, nos seguintes casos:
            </p>
            <ol type="I" style="padding-left: 25px;">
                <li>
                    <span>
                        Decretação de insolvência, falência ou liquidação de qualquer das Partes;
                    </span>
                </li>
                <li>
                    <span>
                        Pela impossibilidade de sua consecução, em razão de determinação judicial, lei ou embargo
                        determinado por autoridade competente.
                    </span>
                </li>
                <li>
                    <span>
                        Nas hipóteses em que restar constatada a inviabilidade técnica do projeto no local de instalação
                        previamente contratado. Neste caso a SUNNY HOUSE devolverá os valores efetivamente despendidos
                        pelo Cliente caso existam.
                    </span>
                </li>
            </ol>
            <p>
                <span class="me-3">11.2.</span> Sem prejuízo da satisfação de seus demais direitos, a SUNNY HOUSE poderá, a seu exclusivo critério, rescindir este Termo, mediante prévia e expressa comunicação ao Cliente, com antecedência mínima de 5 (cinco) dias nos seguintes casos:
            </p>
            <ol type="I" style="padding-left: 25px;">
                <li>
                    <span>
                        Não cumprimento de qualquer das obrigações pecuniárias deste Termo pelo Cliente, desde que a SUNNY HOUSE envie notificação por escrito neste sentido estabelecendo prazo para seu cumprimento;
                    </span>
                </li>
                <li>
                    <span>
                        Cessão e/ou transferência parcial ou total para terceiros das obrigações assumidas pela Cliente,
                        sem prévia e expressa autorização da SUNNY HOUSE.
                    </span>
                </li>
            </ol>
            <p>
                <span class="me-3">11.3</span> O Cliente poderá, a seu exclusivo critério rescindir este
                Termo, mediante prévia e expressa comunicação à SUNNY HOUSE, com antecedência mínima de 30 (trinta) dias nos seguintes casos:
            </p>
            <ol type="I" style="padding-left: 25px;">
                <li>
                    <span>
                        Atraso superior a 30 (trinta) dias no prazo previsto para finalização do processo de instalação do GSF no imóvel do Cliente, por culpa exclusiva da SUNNY HOUSE.
                    </span>
                </li>
            </ol>
            <p>
                <span class="me-3">11.4.</span> O presente Termo poderá ser rescindido de forma imotivada pelo Cliente, antes da efetiva instalação do GSF, mediante o envio para a SUNNY HOUSE de notificação escrita, com 30 (trinta) dias de antecedência. Neste caso o Cliente deverá pagar à SUNNY HOUSE multa rescisória equivalente à 20% (vinte por cento) do valor total do Preço, sem prejuízo da SUNNY HOUSE cobrar do Cliente, valores de materiais já encomendados a terceiros e que não puderem ser cancelados até a data da rescisão. Os valores aqui descritos ficam limitados ao disposto na cláusula 10.5.
            </p>
            <p>
                <span class="me-3">11.5</span> O Cliente declara desde já, que caso ocorra a rescisão do
                presente Termo por qualquer motivo, estar ciente que a Garantia SUNNY HOUSE não se aplica em nenhuma hipótese caso um terceiro contratado pelo Cliente venha a finalizar o processo de instalação de qualquer equipamento que compõe o GSF e que os custos incorridos e comprovados pela SUNNY HOUSE no fornecimento/instalação do GSF do Cliente, poderá ser cobrado a seu exclusivo critério.
            </p>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <p class="fw-bold">
                        <span class="me-3">12.</span> DISPOSIÇÕES GERAIS
                    </p>
                    <p>
                        <span class="me-3">12.1.</span> As Partes estabelecem que qualquer evento que envolva ou afete qualquer das Partes e que possa prejudicar o regular cumprimento das obrigações pactuadas neste Termo, deverá ser comunicada imediatamente à outra parte, sempre por escrito e endereçada conforme a seguir:
                    </p>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-12">
                    <p class="fw-bold">
                        <span class="me-3">12.</span> DISPOSIÇÕES GERAIS
                    </p>
                    <p>
                        <span class="me-3">12.1.</span> As Partes estabelecem que qualquer evento que envolva ou afete qualquer das Partes e que possa prejudicar o regular cumprimento das obrigações pactuadas neste Termo, deverá ser comunicada imediatamente à outra parte, sempre por escrito e endereçada conforme a seguir:
                    </p>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <p>
                <span class="d-block">SUNNY HOUSE - ME</span>
                <span class="d-block">Rua da Marinha, 125 A, entre Av. Rodolfo</span>
                <span class="d-block">Chermont e Capanema, Marambaia, PA, CEP</span>
                <span class="d-block">66620-200: Departamento Comercial</span>
                <span class="d-block">e-mail:contato@sunnyhouse.com.br</span>
            </p>
            <p>
                <span class="me-3">12.2.</span> A tolerância de ambas as Partes em relação a quaisquer
                condições ora pactuadas, não representará novação ou renúncia de direitos, caracterizando-se exclusivamente como mera liberalidade.
            </p>
            <p>
                <span class="me-3">12.3.</span> Se qualquer uma das disposições do presente Termo for ou
                vier a tornar-se nula ou revelar-se omissa, tal nulidade ou omissão não afetará a validade das demais disposições deste Termo. Nesse caso, as Partes envidarão esforços no sentido de estabelecer normas que mais se aproximem, quanto ao resultado econômico, da(s) disposição(ões) a ser(em) alterada(s) ou eliminada(s).
            </p>
            <p>
                <span class="me-3">12.4.</span> O presente Termo e seus Anexos compreende o acordo total das Partes e cancela os demais acordos, verbais ou escritos, propostas de fornecimento, enfim quaisquer documentos assinados pelas Partes.
            </p>
            <p>
                <span class="me-3">12.5.</span> Fica desde já eleito, com exclusão de qualquer outro, por mais privilegiado que seja, o foro da Comarca de Belém-PA, para quaisquer ações ou medidas judiciais referentes a este Termo.
            </p>

            <p class="text-center font-size-15 padding-top-70">
                Belém, {{$day . ' de ' . $month . ' de ' . $year . '.'}}
            </p>

            <p class="padding-top-150">
                <span class="fw-bold">
                    <span class="d-block">_____________________________</span>
                    <span class="d-block">Contratada</span>

                    @switch ($signature_name)
                        @case (null)
                            @if (Auth::user()->email == 'nixon@sunnyhouse.com.br')
                                <span class="d-block">Nixon Menezes Girard da Silva</span>
                                <span class="d-block">CPF: 510.830.192-87</span>
                            @else
                                <span class="d-block">Rafael Feio Calandrini</span>
                                <span class="d-block">CPF: 708.782.182-20</span>
                            @endif
                            @break

                        @case (1)
                            <span class="d-block">Nixon Menezes Girard da Silva</span>
                            <span class="d-block">CPF: 510.830.192-87</span>
                            @break

                        @case (2)
                            <span class="d-block">Rafael Feio Calandrini</span>
                            <span class="d-block">CPF: 708.782.182-20</span>
                        @break
                    @endswitch

                    <span class="d-block">S H Soluções Tecnológicas Ltda - Sunny House</span>
                    <span class="d-block">CNPJ: 09.445.760/0001-87</span>
                </span>
            </p>

            <p class="padding-top-70">
                <span class="fw-bold">
                    <span class="d-block">_____________________________</span>
                    <span class="d-block">Contratante</span>

                    @if ($contract->client->is_corporate)
                        <span class="d-block">{{$contract->client->corporate_name}}</span>
                        <span class="d-block">CNPJ: {{$contract->client->cnpj}}</span>

                    @else
                        <span class="d-block">{{$contract->client->name}}</span>
                        <span class="d-block">CPF: {{$contract->client->cpf}}</span>
                    @endif
                </span>
            </p>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <p class="text-center fw-bold">
                        <span class="text-decoration-underline">ANEXO A - COMO FUNCIONA UM GERADOR SOLAR</span>
                    </p>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-12">
                    <p class="text-center fw-bold">
                        <span class="text-decoration-underline">ANEXO A - COMO FUNCIONA UM GERADOR SOLAR</span>
                    </p>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <img class="padding-top-150" src="{{asset('images/contract/img_anexo_a.png')}}">

            <ol class="padding-top-70" style="padding-left: 25px;">
                <li class="fw-bold mb-5">
                    <span>
                        Os painéis fotovoltaicos <a style="font-weight: normal">geram energia elétrica quando expostos ao sol, em corrente contínua. Os painéis são geralmente instalados no telhado ou no solo, sendo fixados com estruturas metálicas de suporte.</a>
                    </span>
                </li>
                <li class="fw-bold mb-5">
                    <span>
                        O  inversor <a style="font-weight: normal"> converte a energia em corrente contínua gerada pelos painéis para corrente alternada, que é o padrão nas casas. Essa energia pode ser usada normalmente por todos os tipos de equipamento que se ligam na rede elétrica da casa ou empresa como, por exemplo, iluminação, ar-condicionado, eletrodomésticos etc. O inversor está conectado no quadro elétrico (geral) da casa ou empresa.</a>
                    </span>
                </li>
                <li class="fw-bold mb-5">
                    <span>
                        O medidor bidirecional <a style="font-weight: normal">será instalado pela concessionária no momento da homologação, substituindo o medidor tradicional (que apenas mede consumo). Com isso será possível medir o consumo e também a energia enviada para a rede</a>.
                    </span>
                </li>
                <li class="fw-bold mb-5">
                    <span>
                        A ligação com a rede elétrica continua <a style="font-weight: normal"> – os painéis são ligados ao inversor e este é ligado ao quadro geral da casa ou empresa. A energia elétrica gerada e não utilizada (&ldquo;excedente&rdquo;) é enviada para a rede, gerando créditos em kWh. Esses créditos valem por 60 meses e podem ser usados por consumidores do mesmo grupo econômico (CNPJ) ou pessoa física (CPF). A geração e uso dos créditos vem automaticamente na conta de energia dá, distribuidora de energia elétrica, sem custo adicional.</a>
                    </span>
                </li>
            </ol>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <p class="fw-bold">
                        <span class="text-decoration-underline">ANEXO B – ESPECIFICAÇÕES TÉCNICAS</span>
                    </p>
                    <p>
                        Na SUNNY HOUSE utilizamos exclusivamente equipamentos e serviços da mais alta qualidade disponível
                        no mercado global. Nosso Sistema Solar Fotovoltaico (GSF) é composto dos seguintes elementos:
                    </p>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-8 offset-4">
                    <p class="fw-bold">
                        <span class="text-decoration-underline">ANEXO B – ESPECIFICAÇÕES TÉCNICAS</span>
                    </p>
                    <p>
                        Na SUNNY HOUSE utilizamos exclusivamente equipamentos e serviços da mais alta qualidade disponível
                        no mercado global. Nosso Sistema Solar Fotovoltaico (GSF) é composto dos seguintes elementos:
                    </p>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <table class="table table-bordered border-blue @if (!$logo) mt-5 @endif">
                <thead>
                    <tr>
                        <td class="table-active fw-bold" style="width: 110px">Componente</td>
                        <td class="table-active fw-bold" style="width: 230px">Função</td>
                        <td class="table-active fw-bold">Características Principais</td>
                    </tr>
                </thead>
                <tbody class="border-1">
                    <tr class="text-start">
                        <td class="fw-bold">
                            Módulos Fotovoltaicos
                        </td>
                        <td>
                            Geração de energia elétrica a partir da incidência da luz do sol.
                        </td>
                        <td>
                            Módulos certificados pelas normas internacionais e INMETRO, CLASSE A de alto rendimento,
                            durabilidade e confiabilidade para maximizar a geração de energia elétrica
                        </td>
                    </tr>
                    <tr class="text-start">
                        <td class="fw-bold">
                            Inversor(es)
                        </td>
                        <td>
                            Conversão de energia elétrica de corrente contínua em corrente alternada.
                        </td>
                        <td>
                            Inversores certificados pelas normas internacionais e INMETRO, CLASSE A de última geração, com
                            modo de operar simplificado e com rastreamento do ponto de máxima potência (MPPT).
                        </td>
                    </tr>
                    <tr class="text-start">
                        <td class="fw-bold">
                            Estrutura de suporte
                        </td>
                        <td>
                            Fixação dos módulos fotovoltaicos no telhado ou no solo.
                        </td>
                        <td>
                            Estruturas de alumínio e/ou aço galvanizado. Instalação rápida, alta robustez e durabilidade
                            garantida sem prejudicar a estrutura existente de fixação.
                        </td>
                    </tr>
                    <tr class="text-start">
                        <td class="fw-bold">
                            Cabos
                        </td>
                        <td>
                            Interligação dos componentes elétricos
                        </td>
                        <td>
                            Cabos flexíveis especificamente fabricados para uso solar, proteção UV, anti-chama e
                            halogênio livre, seguindo normas brasileiras e internacionais.
                        </td>
                    </tr>
                    <tr class="text-start">
                        <td class="fw-bold">
                            Quadro de proteção
                        </td>
                        <td>
                            Quadro envolvendo dispositivos de proteção contra surto (DPS), disjuntores e fusíveis.
                        </td>
                        <td>
                            Quadros com proteção UV, IP54 ou superior. DPS, fusíveis e disjuntores de fabricantes de
                            primeira linha.
                        </td>
                    </tr>
                    <tr class="text-start">
                        <td class="fw-bold">
                            Sistema de monitoramento
                        </td>
                        <td>
                            Permite acompanhamento remoto (via WEB e aplicativo para celular) do desempenho do gerador.
                        </td>
                        <td>
                            Conexão WIFI ou rede celular. Medição das grandezas elétricas do gerador fotovoltaico,
                            permitindo acompanhamento do sistema em tempo real, 24h por dia via computador, tablet.
                        </td>
                    </tr>
                    <tr class="text-start">
                        <td class="fw-bold">
                            Estação meteorológica
                        </td>
                        <td>
                            Monitoramento das grandezas meteorológicas necessárias para visualizar o desempenho do gerador.
                        </td>
                        <td>
                            Equipamento de alta precisão e durabilidade, interligado no sistema de monitoramento.
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered border-blue">
                <thead>
                    <tr>
                        <td class="table-active fw-bold">
                            Incluído na proposta e preço
                        </td>
                        <td class="table-active fw-bold">
                            Não incluído na proposta, nem no preço
                        </td>
                    </tr>
                </thead>
                <tbody class="border-1">
                    <tr>
                        <td style="width: 310px">
                            <ul>
                                <li>
                                    Desenvolvimento de projeto executivo
                                </li>
                                <li>
                                    Emissão de ART (Anotação de Responsabilidade Técnica pelo CREA)
                                </li>
                                <li>
                                    Entrega de documentação completa &ldquo;Como- Construído&rdquo;, incluindo desenhos, manuais, folha de dados, etc.
                                </li>
                                <li>
                                    Estudo para otimização do layout e escolha dos equipamentos principais, visando
                                    maximizar o rendimento do gerador solar fotovoltaico e minimizar custos futuros com operação e manutenção
                                </li>
                                <li>
                                    Fornecimento de todos os materiais necessários para instalação do gerador solar
                                    fotovoltaico
                                </li>
                                <li>
                                    Homologação e registro do Gerador Solar Fotovoltaico SUNNY HOUSE junto à
                                    distribuidora de energia elétrica
                                </li>
                                <li>
                                    Instalação completa
                                </li>
                                <li>
                                    Testes e comissionamento
                                </li>
                            </ul>
                        </td>
                        <td>
                            <em>Atividades eventualmente a incluir, conforme necessidade do projeto</em>
                            <ul>
                                <li>
                                    Reforço e reforma na rede elétrica existente
                                </li>
                                <li>
                                    Aterramento do quadro elétrico geral e caixa de medição (padrão de entrada)
                                </li>
                                <li>
                                    Adequação/melhoria dos componentes do quadro elétrico da residência (Substituição de
                                    disjuntores, cabos, inclusão de novos componentes)
                                </li>
                                <li>
                                    Adequação da caixa de medição (padrão de entrada) (Substituição de disjuntores, cabos, inclusão de novos componentes)
                                </li>
                                <li>
                                    Adequação da caixa de medição (padrão de entrada) (Substituição de disjuntores, cabos, inclusão de novos componentes)
                                </li>
                                <li>
                                    Reforma da caixa de medição (troca da caixa de metal existente devido à corrosão,
                                    sujeira, metal danificado, etc)
                                </li>
                                <li>
                                    Instalação e/ou reparo de sistema SPDA (para raio)
                                </li>
                                <li>
                                    Quebrar e/ou rasgar parede para embutir os eletrodutos
                                </li>
                                <li>
                                    Trabalhos de alvenaria e pintura
                                </li>
                                <li>
                                    Reforço no telhado
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <p class="text-center fw-bold">
                        <span class="text-decoration-underline">ANEXO C – GARANTIAS</span>
                    </p>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-12">
                    <p class="text-center fw-bold">
                        <span class="text-decoration-underline">ANEXO C – GARANTIAS</span>
                    </p>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <p class="padding-top-80 fw-bold">
                <span class="me-3">1.</span> INTRODUÇÃO
            </p>
            <p style="text-indent: 30px;">
                <span class="fw-bold me-3">1.1.</span> Os prazos das garantias abrangidas por este Termo se iniciarão a partir da data de assinatura do Termo de Adesão. O Termo de Adesão será assinado após finalização do processo de aquisição e instalação do GSF. As Partes concordam que, a partir da entrega e instalação, com a assinatura do correspondente Termo de Adesão pelo Cliente, a responsabilidade quanto ao GSF passará a ser, única e exclusivamente do Cliente e eventual contratação de seguro será de sua exclusiva responsabilidade.
            </p>

            <p class="fw-bold mt-3"><span class="me-3">2.</span> GARANTIA INDIVIDUAL</p>
            <p style="text-indent: 30px;">
                <span class="fw-bold me-3">2.1.</span> GARANTIA DO FABRICANTE: A SUNNY HOUSE repassará integralmente para o Cliente a garantia tal qual fornecida pelos fabricantes dos equipamentos que fazem parte do GSF e na extensão de abrangência tal qual recebida pela SUNNY HOUSE as quais limitam-se aos prazos abaixo estipulados:
            </p>

            <div class="row mt-3 mb-3 ms-2 me-2">
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
            <div class="row mt-3 mb-3 ms-2 me-2">
                <div class="col-4">
                    <span class="fw-bold d-block">
                        <span class="d-block">Estrutura</span>

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
                    </span>
                    12 meses
                </div>

                <div class="col-4 m-2">
                    <span class="fw-bold d-block">Componentes</span>
                    12 meses
                </div>
            </div>

            <p class="mt-3" style="text-indent: 30px;">
                <span class="fw-bold me-3">2.2.</span> GARANTIA SUNNY HOUSE: Esta garantia abrange as falhas e defeitos nas atividades de instalação do GSF realizadas pela SUNNY HOUSE, e terão o prazo correspondente a 12 meses. Os serviços de O&M e O&M Adicional, conforme escolhidos pelo Cliente, e previstos no Termo de Adesão, prestados pela SUNNY HOUSE ou por empresa por ela subcontratada, terão o prazo de 12 meses, exceto se de outra forma previsto no Termo de Adesão e/ou conforme contratado pelo Cliente.
            </p>

            <p style="text-indent: 30px;">
                <span class="fw-bold me-3">2.3.</span> Os prazos das garantias previstos nos itens 2.1 e 2.2 acima compreendem a somatória da garantia legal prevista no inciso II do artigo 26 do Código de Defesa do Consumidor e da garantia contratual fornecida pela SUNNY HOUSE e/ou pelos fabricantes dos equipamentos e componentes que compõem o GSF.
            </p>

            <p style="text-indent: 30px;">
                <span class="fw-bold me-3">2.4.</span> Enquanto vigente a Garantia SUNNY HOUSE, a SUNNY HOUSE reparará ou substituirá qualquer peça defeituosa, material ou componente do GSF, bem como corrigir qualquer defeito de fabricação, sem qualquer custo ou despesa para o Cliente (incluindo todos os custos de mão de obra), desde que seja enviada pelo Cliente uma reclamação na forma prevista na Cláusula 2.8 deste Anexo, em virtude de atos, exclusivamente, decorrentes dos serviços por ela prestado no âmbito deste Termo. A responsabilidade abrangida nesta garantia em relação à defeitos ou vícios de equipamentos que compõem o GSF ficarão a cargo de cada fabricante, respeitados os prazos previstos na Cláusula 2.1 deste Anexo. A SUNNY HOUSE terá o direito de escolher e utilizar componentes novas ou recondicionadas ao efetuar reparos ou substituições. A SUNNY HOUSE terá o direito, sem nenhum custo adicional para o Cliente, de atualizar ou adicionar qualquer componente no GSF para garantir seu funcionamento de acordo com as garantias estabelecidas.
            </p>

            <p style="text-indent: 30px;">
                <span class="fw-bold me-3">2.5.</span> O CLIENTE CONCORDA EM NÃO FAZER QUAISQUER MODIFICAÇÕES, MELHORIAS, REVISÕES OU ADIÇÕES AO GSF OU VIOLAR EVENTUAIS LACRES INSTALADOS PELA SUNNY HOUSE OU TOMAR QUALQUER OUTRA MEDIDA. ESTAS MODIFICAÇÕES PODEM RESULTAR EM PERDA DA GARANTIA DO GSF.
            </p>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>

    <div class="page print-contract @if ($logo) position-relative @endif">
        @if ($logo)
            <div class="row">
                <div class="col-4">
                    <img style="margin-left: -37px !important; margin-top: -37px !important"
                        src="{{asset('images/contract/img_power_of_attorney.png')}}"
                        width="200px">
                </div>
                <div class="col-8 text-justify">
                    <p style="text-indent: 30px;">
                        <span class="fw-bold me-3">2.6.</span> Passado o período da Garantia SUNNY HOUSE todos os custos de deslocamento, estadias, despesas de viagem ou fretes dos funcionários e/ou subcontratados da SUNNY HOUSE designados para verificação de qualquer problema ocorrido e posterior conserto serão cobrados do Cliente, ainda que vigente as Garantias dos Fabricantes
                    </p>
                </div>
            </div>
        @else
            <div class="row text-justify">
                <div class="col-12">
                    <p style="text-indent: 30px;">
                        <span class="fw-bold me-3">2.6.</span> Passado o período da Garantia SUNNY HOUSE todos os custos de deslocamento, estadias, despesas de viagem ou fretes dos funcionários e/ou subcontratados da SUNNY HOUSE designados para verificação de qualquer problema ocorrido e posterior conserto serão cobrados do Cliente, ainda que vigente as Garantias dos Fabricantes
                    </p>
                </div>
            </div>
        @endif

        <div class="row text-justify">
            <p style="text-indent: 30px;">
                <span class="fw-bold me-3">2.7.</span> As peças a serem fornecidas em virtude das Garantias dos Fabricantes, serão entregues pelo fabricante no imóvel onde o fornecimento da compra inicial foi realizado. O defeito deve ser comunicado por escrito em até 7 (sete) dias após ser detectado, devendo o item defeituoso ser enviado ao fabricante e/ou à SUNNY HOUSE com frete pré-pago, sendo certo que existem alguns defeitos ou falhas que somente o fabricante poderá solucionar. Na hipótese do item defeituoso ser substituído pela SUNNY HOUSE em virtude da gravidade do defeito, o Cliente reconhece que este bem passará a ser detido e de propriedade da SUNNY HOUSE de forma automática, sem necessidade de qualquer comunicação formal nesse sentido, ficando, ainda, a SUNNY HOUSE no direito de decretar a necessidade ou não de substituição de eventual item defeituoso pela SUNNY HOUSE
                (ou conserto desse item), no prazo de garantia, desde que tal liberalidade por parte da SUNNY HOUSE não prejudique o desempenho do GSF instalado no imóvel do Cliente.
            </p>
            <p style="text-indent: 30px;">
                <span class="fw-bold me-3">2.8.</span> Reclamações: O cliente pode registrar uma reclamação enviando um e-mail para contato@sunnyhouse.com.br.
            </p>
            <p style="text-indent: 30px;">
                <span class="fw-bold me-3">2.9.</span> Exclusões e Exoneração: As garantias ora previstas não se aplicam a qualquer reparo, substituição ou correção necessária quando:
            </p>
            <ol type="a" style="padding-left: 70px;">
                <li>
                    Uma empresa ou técnico autônomo sem anuência da SUNNY HOUSE reinstalar, reparar,
                    modificar ou corrigir o GSF;
                </li>
                <li>
                    A destruição ou danos causados ao GSF e/ou as suas respectivas capacidades para produzir
                    energia elétrica com segurança não tenha sido causada pela SUNNY HOUSE ou os seus
                    subcontratados durante eventual intervenção do sistema após instalação do GSF (Exemplo:
                    queda de árvore sobre o GSF);
                </li>
                <li>
                    O Cliente violar suas obrigações previstas neste Termo, causando defeitos por uso indevido,
                    falta de cuidado, abusos, negligências, acidentes e sobrecargas do GSF;
                </li>
                <li>
                    Qualquer Evento de Força Maior, conforme definido neste Termo e incluindo os exemplos a
                    seguir descritos: (i) Acúmulo de folhagem sobre os módulos fotovoltaicos ou sombreamento
                    que não existia na data de instalação do GSF; (ii) Qualquer falha no GSF que não tenha sido
                    causada por um defeito de seus componentes; (iii) Roubo ou furto do GSF ou qualquer de
                    seus componentes; (iv) Danos ao Imóvel onde o GSF foi instalado, sem que este dano tenha
                    sido causado pela SUNNY HOUSE e/ou por seus subcontratados; e, (v) Danos ao GSF
                    causados por vandalismo.
                </li>
            </ol>

            <p class="fw-bold mt-4">
                <span class="me-3">3.</span> REPARO, REALOCAÇÃO OU REMOÇÃO DO GSF
            </p>
            <p>
                <span class="fw-bold me-3">3.1.</span> Para manutenção das garantias aqui previstas, o Cliente deverá contratar à a SUNNY HOUSE ou uma empresa por ela homologada, caso (i) o GSF precise de reparos que não são de responsabilidade do fabricante e/ou da SUNNY HOUSE conforme previstos neste Termo; (ii) o GSF precisar ser removido e reinstalado para facilitar a remodelação do Imóvel; ou, (iii) o GSF precisar ser
                realocado para um outro imóvel da propriedade do Cliente. Em caso de remoção temporária ou realocação do
                GSF para um outro imóvel, a SUNNY HOUSE fará um orçamento específico correspondente aos serviços necessários.
            </p>
            <p class="fw-bold">
                <span class="me-3">4.</span> CESSÃO E TRANSFERENCIA DA GARANTIA
            </p>
            <p>
                <span class="fw-bold me-3">4.1.</span></strong> A SUNNY HOUSE terá o direito de ceder seus direitos ou obrigações decorrentes desta garantia, a um terceiro profissionalmente e financeiramente qualificado para assunção desta obrigação, sem anuênciado Cliente. As garantias protegem apenas o Cliente que adquiriu o GSF.Os direitos e obrigações sob esta garantia serão automaticamente transferidos para qualquer pessoa que adquire o GSF do Cliente desde que o GSF seja mantido no imóvel local de instalação original do GSF ou quando expressamente anuído pela SUNNY HOUSE.
            </p>

            <p class="fw-bold">
                <span class="me-3">5.</span> PROCESSO DE HOMOLOGAÇÃO DO GSF
            </p>
            <p>
                <span class="fw-bold me-3">5.1.</span></strong> A SUNNY HOUSE não se responsabilizará por qualquer dano, ato, evento ou condição causado pelo Cliente ao ligar o GSF antes da finalização do processo de homologação do GSF pela distribuidora de energia elétrica local, conforme descrito em suas normas.
            </p>
        </div>

        @if ($logo)
            <img class="position-absolute bottom-0 start-0 footer-img"
                style="width: 793px;"
                src="{{asset('images/contract/img_power_of_attorney_bottom.png')}}">
        @endif
    </div>
</x-print-layout>