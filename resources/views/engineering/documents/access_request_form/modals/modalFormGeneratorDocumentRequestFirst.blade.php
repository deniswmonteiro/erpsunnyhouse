<!-- Modal Show Generator Documents - Up to ten (<= 10%) -->
<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Gerar Formulário de Solicitação de Acesso para Microgeração Distribuída até 10 kW
            </h5>
            <button type="button" class="btn-close" 
                data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body bg-blue-lighten">
            <form action="{{route('engineering_print_document_request', ['type' => encrypt('up_to_ten'), 'id' => encrypt($generator->id)])}}" target="_blank" method="POST"
                id="form-request-uptoten-{{$key}}"
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
                                id="table-request-uptoten-solar-{{$key}}"
                                data-request-uptoten-solar-table>
                                <div class="accordion-item"
                                    id="request-uptoten-solar-item-{{$key}}-1"
                                    data-request-uptoten-solar-item>
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-bold text-primary" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#item-request-uptoten-solar-{{$key}}-1"
                                            aria-expanded="true"
                                            aria-controls="item-request-uptoten-solar-{{$key}}-1">
                                            Item 1
                                        </button>
                                    </h2>
                                    <div id="item-request-uptoten-solar-{{$key}}-1"
                                        class="accordion-collapse collapse show"
                                        data-bs-parent="#table-request-uptoten-solar-{{$key}}">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <!-- Module Power -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-solar-modulepower-{{$key}}-1"
                                                            class="form-label">
                                                            Potência do Módulo
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" 
                                                                type="text"
                                                                id="request-uptoten-solar-modulepower-{{$key}}-1"
                                                                name="request-uptoten[solar][item-1][module-power]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                required
                                                                data-request-uptoten-solar-field>
                                                            <span class="input-group-text">
                                                                W
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-solar-modulepower-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Quantity -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-solar-quantity-{{$key}}-1"
                                                            class="form-label">
                                                            Quantidade
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-uptoten-solar-quantity-{{$key}}-1"
                                                            name="request-uptoten[solar][item-1][quantity]"
                                                            onchange="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                            onblur="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                            onkeyup="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                            required
                                                            data-request-uptoten-solar-field
                                                            data-request-uptoten-solar-sum>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-solar-quantity-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Peak Power -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-solar-peakpower-{{$key}}-1"
                                                            class="form-label">
                                                            Potência de Pico
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-uptoten-solar-peakpower-{{$key}}-1"
                                                                name="request-uptoten[solar][item-1][peak-power]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                required
                                                                data-request-uptoten-solar-field
                                                                data-request-uptoten-solar-sum>
                                                            <span class="input-group-text">
                                                                kWp
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-solar-peakpower-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Arrangement Area- -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-solar-arrangementarea-{{$key}}-1"
                                                            class="form-label">
                                                            Área do Arranjo
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-uptoten-solar-arrangementarea-{{$key}}-1"
                                                                name="request-uptoten[solar][item-1][arrangement-area]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                required
                                                                data-request-uptoten-solar-field
                                                                data-request-uptoten-solar-sum>
                                                            <span class="input-group-text">
                                                                m<sup>2</sup>
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-solar-arrangementarea-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Module Manufacturers- -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-solar-modulemanufacturers-{{$key}}-1" class="form-label">
                                                            Fabricante(s) dos Módulos
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-uptoten-solar-modulemanufacturers-{{$key}}-1"
                                                            name="request-uptoten[solar][item-1][module-manufacturers]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-uptoten-solar-field>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-solar-modulemanufacturers-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Module Model -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-solar-modulemodel-{{$key}}-1"
                                                            class="form-label">
                                                            Modelo
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-uptoten-solar-modulemodel-{{$key}}-1"
                                                            name="request-uptoten[solar][item-1][module-model]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-uptoten-solar-field>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-solar-modulemodel-feedback-request-{{$key}}-1"></div>
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
                                        id="request-uptoten-solar-total-quantity-{{$key}}">
                                        <div class="form-group mb-0">
                                            <span class="fw-bold d-block d-block">
                                                Quantidade:
                                            </span>
                                            <p class="d-inline-block mb-0">0</p>
                                        </div>
                                    </div>

                                    <!-- Power Peak Total -->
                                    <div class="col-12 col-lg-4 mb-3" 
                                        id="request-uptoten-solar-total-peakpower-{{$key}}">
                                        <div class="form-group mb-0">
                                            <span class="fw-bold d-block">
                                                Potência de Pico:
                                            </span>
                                            <p class="d-inline-block mb-0">0</p> kWp
                                        </div>
                                    </div>

                                    <!-- Arrangement Area Total -->
                                    <div class="col-12 col-lg-4 mb-3" 
                                        id="request-uptoten-solar-total-arrangementarea-{{$key}}">
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
                                            id="btn-add-request-uptoten-solar-item-{{$key}}"
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
                                id="table-request-uptoten-inverter-{{$key}}"
                                data-request-uptoten-inverter-table>
                                <div class="accordion-item"
                                    id="request-uptoten-inverter-item-{{$key}}-1"
                                    data-request-uptoten-inverter-item>
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-bold text-primary" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#item-request-uptoten-inverter-{{$key}}-1"
                                            aria-expanded="true"
                                            aria-controls="item-request-uptoten-inverter-{{$key}}-1">
                                            Item 1
                                        </button>
                                    </h2>
                                    <div id="item-request-uptoten-inverter-{{$key}}-1"
                                        class="accordion-collapse collapse show"
                                        data-bs-parent="#table-request-uptoten-inverter-{{$key}}">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <!-- Manufacturer -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-inverter-manufacturer-{{$key}}-1"
                                                            class="form-label">
                                                            Fabricante *
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-uptoten-inverter-manufacturer-{{$key}}-1"
                                                            name="request-uptoten[inverter][item-1][manufacturer]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-uptoten-inverter-field>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-inverter-manufacturer-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Model -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-inverter-model-{{$key}}-1"
                                                            class="form-label">
                                                            Modelo *
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-uptoten-inverter-model-{{$key}}-1"
                                                            name="request-uptoten[inverter][item-1][model]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-uptoten-inverter-field>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-inverter-model-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Rated Power -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-inverter-ratedpower-{{$key}}-1"
                                                            class="form-label">
                                                            Potência Nominal
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-uptoten-inverter-ratedpower-{{$key}}-1"
                                                                name="request-uptoten[inverter][item-1][rated-power]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                                                required
                                                                data-request-uptoten-inverter-field
                                                                data-request-uptoten-inverter-sum>
                                                            <span class="input-group-text">
                                                                kW
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-inverter-ratedpower-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Operating Voltage Range -->
                                                <div class="col-12 col-lg-8 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label for="request-uptoten-inverter-initialvoltage-{{$key}}-1" class="form-label">
                                                            Faixa de Tensão de Operação
                                                        </label>
                                                    </div>

                                                    <!-- Initial Voltage -->
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input class="form-control" type="text"
                                                                        id="request-uptoten-inverter-initialvoltage-{{$key}}-1"
                                                                        name="request-uptoten[inverter][item-1][initial-voltage]"
                                                                        placeholder="Tensão Inicial"
                                                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        required
                                                                        data-request-uptoten-inverter-field>
                                                                    <span class="input-group-text">
                                                                        V
                                                                    </span>
                                                                </div>
                                                                <div class="invalid-feedback"
                                                                    id="uptoten-inverter-initialvoltage-feedback-request-{{$key}}-1"></div>
                                                            </div>
                                                        </div>

                                                        <!-- Final Voltage -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input class="form-control" type="text"
                                                                        id="request-uptoten-inverter-finalvoltage-{{$key}}-1"
                                                                        name="request-uptoten[inverter][item-1][final-voltage]"
                                                                        placeholder="Tensão Final"
                                                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                        required
                                                                        data-request-uptoten-inverter-field>
                                                                    <span class="input-group-text">
                                                                        V
                                                                    </span>
                                                                </div>
                                                                <div class="invalid-feedback"
                                                                    id="uptoten-inverter-finalvoltage-feedback-request-{{$key}}-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Rated Current- -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-inverter-ratedcurrent-{{$key}}-1"
                                                            class="form-label">
                                                            Corrente Nominal
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-uptoten-inverter-ratedcurrent-{{$key}}-1"
                                                                name="request-uptoten[inverter][item-1][rated-current]"
                                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                                required
                                                                data-request-uptoten-inverter-field>
                                                            <span class="input-group-text">
                                                                A
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-inverter-ratedcurrent-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Power Factor -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-inverter-powerfactor-{{$key}}-1"
                                                            class="form-label">
                                                            Fator de Potência
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="request-uptoten-inverter-powerfactor-{{$key}}-1"
                                                            name="request-uptoten[inverter][item-1][power-factor]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                                            required
                                                            data-request-uptoten-inverter-field>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-inverter-powerfactor-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Yield -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-inverter-yield-{{$key}}-1"
                                                            class="form-label">
                                                            Rendimento
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-uptoten-inverter-yield-{{$key}}-1"
                                                                name="request-uptoten[inverter][item-1][yield]"
                                                                onchange="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                onblur="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                onkeyup="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                required
                                                                data-request-uptoten-inverter-field>
                                                            <span class="input-group-text">
                                                                %
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-inverter-yield-feedback-request-{{$key}}-1"></div>
                                                    </div>
                                                </div>

                                                <!-- Current DHT -->
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="request-uptoten-inverter-currentdht-{{$key}}-1"
                                                            class="form-label">
                                                            DHT de Corrente
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="request-uptoten-inverter-currentdht-{{$key}}-1"
                                                                name="request-uptoten[inverter][item-1][current-dht]"
                                                                onchange="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                onblur="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                onkeyup="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                                                required
                                                                data-request-uptoten-inverter-field>
                                                            <span class="input-group-text">
                                                                %
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback"
                                                            id="uptoten-inverter-currentdht-feedback-request-{{$key}}-1"></div>
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
                                        id="request-uptoten-inverter-total-ratedpower-{{$key}}">
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
                                            id="btn-add-request-uptoten-inverter-item-{{$key}}"
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
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" 
                data-bs-dismiss="modal">
                Fechar
            </button>
            <button class="btn bg-success text-white float-end d-flex align-items-center" type="submit"
                id="btn-submit-form-request-uptoten-{{$key}}"
                onclick="return window.submitFormRequest(this)">
                Gerar Formulário
            </button>
        </div>
    </div>
</div>