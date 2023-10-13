<!-- Modal Show Generator Documents - Above seventy five (> 75%) -->
<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Formulário de Solicitação de Acesso para Minigeração Distribuída
            </h5>
            <button type="button" class="btn-close" 
                data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body bg-blue-lighten">
            <form action="{{route('engineering_print_document_request', ['type' => encrypt('above_seventy_five'), 'id' => encrypt($generator->id)])}}" target="_blank" method="POST"
                id="form-request-aboveseventyfive-{{$key}}"
                class="mb-0"
                onsubmit="return false">
                @csrf
                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="card-title">
                            Informações das Unidades Geradoras (UG): 
                            <span class="fs-6 text-danger text-uppercase">
                                Preencher conforme o tipo de fonte de geração
                            </span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Photovoltaic Solar -->
                        <div class="card">
                            <div class="card-header ps-0 pe-0">
                                <h6 class="card-title fs-6 mb-0">
                                    1. Solar Fotovoltáica
                                </h6>
                            </div>
                            <span class="mb-2 text-secondary fs-7">
                                Obs.: Célula Fotovoltáica é a unidade básica; Módulo é o conjunto de células; e Arranjo é o agrupamento de módulos, o gerador.
                            </span>
                            <div class="accordion"
                                id="table-request-aboveseventyfive-solar-{{$key}}" data-request-aboveseventyfive-solar-table>
                                <div class="accordion-item"
                                    id="request-aboveseventyfive-solar-item-{{$key}}-1" data-request-aboveseventyfive-solar-item>
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-bold text-primary" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#item-request-aboveseventyfive-solar-{{$key}}-1"
                                            aria-expanded="true"
                                            aria-controls="item-request-aboveseventyfive-solar-{{$key}}-1">
                                            Item 1
                                        </button>
                                    </h2>
                                    <div id="item-request-aboveseventyfive-solar-{{$key}}-1"
                                        class="accordion-collapse collapse show"
                                        data-bs-parent="#table-request-aboveseventyfive-solar-{{$key}}">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <!-- Module Power -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-solar-modulepower-{{$key}}-1" class="form-label">
                                                            Potência do Módulo
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-solar-modulepower-{{$key}}-1"
                                                                name="request-aboveseventyfive[solar][item-1][module-power]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                required
                                                                data-request-aboveseventyfive-solar-field>
                                                            <span class="input-group-text">
                                                                W
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-solar-modulepower-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Quantity -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-solar-quantity-{{$key}}-1"
                                                            class="form-label">
                                                            Quantidade
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-aboveseventyfive-solar-quantity-{{$key}}-1"
                                                            name="request-aboveseventyfive[solar][item-1][quantity]"
                                                            onchange="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                            onblur="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                            onkeyup="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                            required
                                                            data-request-aboveseventyfive-solar-field
                                                            data-request-aboveseventyfive-solar-sum>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-solar-quantity-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Peak Power -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-solar-peakpower-{{$key}}-1" class="form-label">
                                                            Potência de Pico
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-solar-peakpower-{{$key}}-1"
                                                                name="request-aboveseventyfive[solar][item-1][peak-power]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                required
                                                                data-request-aboveseventyfive-solar-field
                                                                data-request-aboveseventyfive-solar-sum>
                                                            <span class="input-group-text">
                                                                kWp
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-solar-peakpower-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Arrangement Area- -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-solar-arrangementarea-{{$key}}-1" class="form-label">
                                                            Área do Arranjo
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-solar-arrangementarea-{{$key}}-1"
                                                                name="request-aboveseventyfive[solar][item-1][arrangement-area]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                required
                                                                data-request-aboveseventyfive-solar-field
                                                                data-request-aboveseventyfive-solar-sum>
                                                            <span class="input-group-text">
                                                                m<sup>2</sup>
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-solar-arrangementarea-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Module Manufacturers- -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-solar-modulemanufacturers-{{$key}}-1" class="form-label">
                                                            Fabricante(s) dos Módulos
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-aboveseventyfive-solar-modulemanufacturers-{{$key}}-1"
                                                            name="request-aboveseventyfive[solar][item-1][module-manufacturers]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-aboveseventyfive-solar-field>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-solar-modulemanufacturers-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Module Model -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-solar-modulemodel-{{$key}}-1" class="form-label">
                                                            Modelo
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-aboveseventyfive-solar-modulemodel-{{$key}}-1"
                                                            name="request-aboveseventyfive[solar][item-1][module-model]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-aboveseventyfive-solar-field>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-solar-modulemodel-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="border border-gray border-top-0 bg-light rounded-bottom ps-3 pe-3">
                                <div class="row pt-3 ps-1 pe-1">
                                    <!-- Quantity Total -->
                                    <div class="col-12 col-lg-4 mb-3" 
                                        id="request-aboveseventyfive-solar-total-quantity-{{$key}}">
                                        <div class="form-group mb-0">
                                            <span class="fw-bold d-block d-block">
                                                Quantidade:
                                            </span>
                                            <p class="d-inline-block mb-0">0</p>
                                        </div>
                                    </div>

                                    <!-- Power Peak Total -->
                                    <div class="col-12 col-lg-4 mb-3" 
                                        id="request-aboveseventyfive-solar-total-peakpower-{{$key}}">
                                        <div class="form-group mb-0">
                                            <span class="fw-bold d-block">
                                                Potência de Pico:
                                            </span>
                                            <p class="d-inline-block mb-0">0</p> kWp
                                        </div>
                                    </div>

                                    <!-- Arrangement Area Total -->
                                    <div class="col-12 col-lg-4 mb-3" 
                                        id="request-aboveseventyfive-solar-total-arrangementarea-{{$key}}">
                                        <div class="form-group mb-0">
                                            <span class="fw-bold d-block">
                                                Área do Arranjo:
                                            </span>
                                            <p class="d-inline-block mb-0">0</p> m<sup>2</sup>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button Add Solar Item -->
                            <div class="row justify-content-end mt-4 mb-4">
                                <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-end">
                                    <div class="form-group"> 
                                        <button class="btn btn-warning d-flex justify-content-center align-items-center"
                                            type="button"
                                            id="btn-add-request-aboveseventyfive-solar-item-{{$key}}"
                                            onclick="return window.addRequestSolarItem(this)"
                                            disabled>
                                            <i class="bi bi-plus-circle-fill me-2"></i>
                                            Adicionar Item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inverters Data -->
                        <div class="card">
                            <div class="card-header ps-0 pe-0">
                                <h6 class="card-title fs-6 mb-0">
                                    2. Dados dos Inversores
                                </h6>
                            </div>
                            <span class="mb-2 text-secondary fs-7">
                                Obs.: Unidades Geradoras Fotovoltáicas e Eólicas.
                            </span>
                            <div class="accordion"
                                id="table-request-aboveseventyfive-inverter-{{$key}}" data-request-aboveseventyfive-inverter-table>
                                <div class="accordion-item"
                                    id="request-aboveseventyfive-inverter-item-{{$key}}-1"
                                    data-request-aboveseventyfive-inverter-item>
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-bold text-primary" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#item-request-aboveseventyfive-inverter-{{$key}}-1"
                                            aria-expanded="true"
                                            aria-controls="item-request-aboveseventyfive-inverter-{{$key}}-1">
                                            Item 1
                                        </button>
                                    </h2>
                                    <div id="item-request-aboveseventyfive-inverter-{{$key}}-1"
                                        class="accordion-collapse collapse show"
                                        data-bs-parent="#table-request-aboveseventyfive-inverter-{{$key}}">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <!-- Manufacturer -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-inverter-manufacturer-{{$key}}-1" class="form-label">
                                                            Fabricante *
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-aboveseventyfive-inverter-manufacturer-{{$key}}-1"
                                                            name="request-aboveseventyfive[inverter][item-1][manufacturer]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-aboveseventyfive-inverter-field>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-inverter-manufacturer-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Model -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-inverter-model-{{$key}}-1" class="form-label">
                                                            Modelo *
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-aboveseventyfive-inverter-model-{{$key}}-1"
                                                            name="request-aboveseventyfive[inverter][item-1][model]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-aboveseventyfive-inverter-field>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-inverter-model-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Rated Power -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-inverter-ratedpower-{{$key}}-1" class="form-label">
                                                            Potência Nominal
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-inverter-ratedpower-{{$key}}-1"
                                                                name="request-aboveseventyfive[inverter][item-1][rated-power]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                required
                                                                data-request-aboveseventyfive-inverter-field
                                                                data-request-aboveseventyfive-inverter-sum>
                                                            <span class="input-group-text">
                                                                kW
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-inverter-ratedpower-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Operating Voltage Range -->
                                                <div class="col-12 col-lg-8 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="request-aboveseventyfive-inverter-initialvoltage-{{$key}}-1"
                                                            class="form-label">
                                                            Faixa de Tensão de Operação
                                                        </label>
                                                    </div>

                                                    <!-- Initial Voltage -->
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input class="form-control" type="text"
                                                                        id="request-aboveseventyfive-inverter-initialvoltage-{{$key}}-1"
                                                                        name="request-aboveseventyfive[inverter][item-1][initial-voltage]"
                                                                        placeholder="Tensão Inicial"
                                                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        required
                                                                        data-request-aboveseventyfive-inverter-field>
                                                                    <span class="input-group-text">
                                                                        V
                                                                    </span>
                                                                </div>
                                                                <div class="invalid-feedback"
                                                                    id="aboveseventyfive-inverter-initialvoltage-feedback-request-{{$key}}-1"></div>
                                                            </div>
                                                        </div>

                                                        <!-- Final Voltage -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input class="form-control" type="text"
                                                                        id="request-aboveseventyfive-inverter-finalvoltage-{{$key}}-1"
                                                                        name="request-aboveseventyfive[inverter][item-1][final-voltage]"
                                                                        placeholder="Tensão Final"
                                                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        required
                                                                        data-request-aboveseventyfive-inverter-field>
                                                                    <span class="input-group-text">
                                                                        V
                                                                    </span>
                                                                </div>
                                                                <div class="invalid-feedback"
                                                                    id="aboveseventyfive-inverter-finalvoltage-feedback-request-{{$key}}-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Rated Current- -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-inverter-ratedcurrent-{{$key}}-1" class="form-label">
                                                            Corrente Nominal
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-inverter-ratedcurrent-{{$key}}-1"
                                                                name="request-aboveseventyfive[inverter][item-1][rated-current]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                required
                                                                data-request-aboveseventyfive-inverter-field>
                                                            <span class="input-group-text">
                                                                A
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-inverter-ratedcurrent-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Power Factor -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-inverter-powerfactor-{{$key}}-1" class="form-label">
                                                            Fator de Potência
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-aboveseventyfive-inverter-powerfactor-{{$key}}-1"
                                                            name="request-aboveseventyfive[inverter][item-1][power-factor]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-aboveseventyfive-inverter-field>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-inverter-powerfactor-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Yield -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-inverter-yield-{{$key}}-1" 
                                                            class="form-label">
                                                            Rendimento
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-inverter-yield-{{$key}}-1"
                                                                name="request-aboveseventyfive[inverter][item-1][yield]"
                                                                onchange="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                onblur="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                onkeyup="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                required
                                                                data-request-aboveseventyfive-inverter-field>
                                                            <span class="input-group-text">
                                                                %
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-inverter-yield-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Current DHT -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-inverter-currentdht-{{$key}}-1" class="form-label">
                                                            DHT de Corrente
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-inverter-currentdht-{{$key}}-1"
                                                                name="request-aboveseventyfive[inverter][item-1][current-dht]"
                                                                onchange="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                onblur="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                onkeyup="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                required
                                                                data-request-aboveseventyfive-inverter-field>
                                                            <span class="input-group-text">
                                                                %
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-inverter-currentdht-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="border border-gray border-top-0 bg-light rounded-bottom ps-3 pe-3">
                                <div class="row pt-3 ps-1 pe-1">
                                    <!-- Rated Power -->
                                    <div class="col-12 col-lg-4 mb-3" 
                                        id="request-aboveseventyfive-inverter-total-ratedpower-{{$key}}">
                                        <div class="form-group mb-0">
                                            <span class="fw-bold d-block">
                                                Potência Nominal:
                                            </span>
                                            <p class="d-inline-block mb-0">0</p> kW
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button Add Inverter Item -->
                            <div class="row justify-content-end mt-4 mb-4">
                                <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-end">
                                    <div class="form-group mb-0"> 
                                        <button class="btn btn-warning d-flex justify-content-center align-items-center"
                                            type="button"
                                            id="btn-add-request-aboveseventyfive-inverter-item-{{$key}}"
                                            onclick="return window.addRequestInverterItem(this)"
                                            disabled>
                                            <i class="bi bi-plus-circle-fill me-2"></i>
                                            Adicionar Item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data on the Substation Transformers for Connection with the Distribution System -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="card-title">
                            Dados dos Transformadores da Subestação de Conexão com o Sistema de Distribuição
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Substation Transformers -->
                        <div class="card">
                            <div class="accordion"
                                id="table-request-aboveseventyfive-transformer-{{$key}}" data-request-aboveseventyfive-transformer-table>
                                <div class="accordion-item"
                                    id="request-aboveseventyfive-transformer-item-{{$key}}-1" data-request-aboveseventyfive-transformer-item>
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-bold text-primary" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#item-request-aboveseventyfive-transformer-{{$key}}-1"
                                            aria-expanded="true"
                                            aria-controls="item-request-aboveseventyfive-transformer-{{$key}}-1">
                                            Item 1
                                        </button>
                                    </h2>
                                    <div id="item-request-aboveseventyfive-transformer-{{$key}}-1"
                                        class="accordion-collapse collapse show"
                                        data-bs-parent="#table-request-aboveseventyfive-transformer-{{$key}}">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <!-- Rated Power -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-transformer-ratedpower-{{$key}}-1" class="form-label">
                                                            Potência Nominal
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-transformer-ratedpower-{{$key}}-1"
                                                                name="request-aboveseventyfive[transformer][item-1][rated-power]"
                                                                onchange="return window.validateDouble(this), window.sumRequestTableField(this)"
                                                                onblur="return window.validateDouble(this), window.sumRequestTableField(this)"
                                                                onkeyup="return window.validateDouble(this), window.sumRequestTableField(this)"
                                                                data-request-aboveseventyfive-transformer-sum>
                                                            <span class="input-group-text">
                                                                kVA
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-transformer-ratedpower-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Connection Type -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-transformer-connectiontype-{{$key}}-1" class="form-label">
                                                            Tipo de Ligação
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-aboveseventyfive-transformer-connectiontype-{{$key}}-1"
                                                            value="&Delta;-Y"
                                                            disabled>
                                                    </div>
                                                </div>

                                                <!-- Transformer Impedance -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-transformer-impedance-{{$key}}-1" class="form-label">
                                                            Impedância do Trafo
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-transformer-impedance-{{$key}}-1"
                                                                name="request-aboveseventyfive[transformer][item-1][impedance]"
                                                                onchange="return window.validatePercentage(this)"
                                                                onblur="return window.validatePercentage(this)"
                                                                onkeyup="return window.validatePercentage(this)">
                                                            <span class="input-group-text">
                                                                %
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-transformer-impedance-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Primary Voltage -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-transformer-primaryvoltage-{{$key}}-1" class="form-label">
                                                            Tensão Primária
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-transformer-primaryvoltage-{{$key}}-1"
                                                                name="request-aboveseventyfive[transformer][item-1][primary-voltage]"
                                                                onchange="return window.validateDouble(this)"
                                                                onblur="return window.validateDouble(this)"
                                                                onkeyup="return window.validateDouble(this)">
                                                            <span class="input-group-text">
                                                                V
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-transformer-primaryvoltage-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Secondary Voltage -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-transformer-secondaryvoltage-{{$key}}-1" class="form-label">
                                                            Tensão Secundária
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-transformer-secondaryvoltage-{{$key}}-1"
                                                                name="request-aboveseventyfive[transformer][item-1][secondary-voltage]"
                                                                onchange="return window.validateDouble(this)"
                                                                onblur="return window.validateDouble(this)"
                                                                onkeyup="return window.validateDouble(this)">
                                                            <span class="input-group-text">
                                                                V
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-transformer-secondaryvoltage-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Switch Range -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-aboveseventyfive-transformer-switchrange-{{$key}}-1" class="form-label">
                                                            Faixa de Comutador (+ ou - x%)
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-aboveseventyfive-transformer-switchrange-{{$key}}-1"
                                                                name="request-aboveseventyfive[transformer][item-1][switch-range]"
                                                                onchange="return window.validatePercentage(this)"
                                                                onblur="return window.validatePercentage(this)"
                                                                onkeyup="return window.validatePercentage(this)">
                                                            <span class="input-group-text">
                                                                %
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="aboveseventyfive-transformer-switchrange-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="border border-gray border-top-0 bg-light rounded-bottom ps-3 pe-3">
                                <div class="row pt-3 ps-1 pe-1">
                                    <!-- Rated Power -->
                                    <div class="col-12 col-lg-4 mb-3" 
                                        id="request-aboveseventyfive-transformer-total-ratedpower-{{$key}}">
                                        <div class="form-group mb-0">
                                            <span class="fw-bold d-block">
                                                Potência Nominal:
                                            </span>
                                            <p class="d-inline-block mb-0">0</p> kVA
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button Add Transformers Item -->
                            <div class="row justify-content-end mt-4 mb-4">
                                <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-end">
                                    <div class="form-group mb-0"> 
                                        <button class="btn btn-warning d-flex justify-content-center align-items-center"
                                            type="button"
                                            id="btn-add-request-aboveseventyfive-transformer-item-{{$key}}"
                                            onclick="return window.addRequestTransformerItem(this)">
                                            <i class="bi bi-plus-circle-fill me-2"></i>
                                            Adicionar Item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" 
                data-bs-dismiss="modal">
                Fechar
            </button>
            <button class="btn bg-success text-white float-end d-flex align-items-center" type="submit"
                id="btn-submit-form-request-aboveseventyfive-{{$key}}"
                onclick="return window.submitFormRequest(this)">
                Gerar Formulário
            </button>
        </div>
    </div>
</div>