window.addRequestInverterItem = function (el) {
    el.setAttribute("disabled", true);

    const type = el.id.split("-")[3];
    const generator = el.id.split("-")[6];
    const accordion = document.querySelector(`#table-request-${type}-inverter-${generator}`);
    const totalInverterItems = document.querySelectorAll(`#${accordion.id} [data-request-${type}-inverter-item]`);
    let item = totalInverterItems.length + 1;

    accordion.insertAdjacentHTML("beforeend", `
        <div class="accordion-item"
            id="request-${type}-inverter-item-${generator.toString()}-${item.toString()}"
            data-request-${type}-inverter-item>
            <h2 class="accordion-header d-flex">
                <button class="accordion-button fw-bold text-primary" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#item-request-${type}-inverter-${generator.toString()}-${item.toString()}"
                    aria-expanded="true"
                    aria-controls="item-request-${type}-inverter-${generator.toString()}-${item.toString()}">
                    Item ${item.toString()}
                </button>
                <button type="button" class="btn btn-danger rounded-0"
                    id="btn-remove-request-${type}-inverter-item-${generator.toString()}-${item.toString()}"
                    onclick="return window.removeRequestItem(this)">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </h2>
            <div id="item-request-${type}-inverter-${generator.toString()}-${item.toString()}"
                class="accordion-collapse collapse show"
                data-bs-parent="#table-request-${type}-inverter-${generator.toString()}">
                <div class="accordion-body">
                    <div class="row mt-3">
                        <!-- Manufacturer -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-inverter-manufacturer-${generator.toString()}-${item.toString()}" class="form-label">
                                    Fabricante *
                                </label>
                                <input class="form-control" 
                                    type="text"
                                    id="request-${type}-inverter-manufacturer-${generator.toString()}-${item.toString()}" name="request-${type}[inverter][item-${item.toString()}][manufacturer]"
                                    onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    required
                                    data-request-${type}-inverter-field>
                                <div class="invalid-feedback"
                                    id="${type}-inverter-manufacturer-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Model -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-inverter-model-${generator.toString()}-${item.toString()}"
                                    class="form-label">
                                    Modelo *
                                </label>
                                <input class="form-control" 
                                    type="text"
                                    id="request-${type}-inverter-model-${generator.toString()}-${item.toString()}"
                                    name="request-${type}[inverter][item-${item.toString()}][model]"
                                    onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    required
                                    data-request-${type}-inverter-field>
                                <div class="invalid-feedback"
                                    id="${type}-inverter-model-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Rated Power -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-inverter-ratedpower-${generator.toString()}-${item.toString()}" class="form-label">
                                    Potência Nominal
                                </label>
                                <div class="input-group">
                                    <input class="form-control" 
                                        type="text"
                                        id="request-${type}-inverter-ratedpower-${generator.toString()}-${item.toString()}" name="request-${type}[inverter][item-${item.toString()}][rated-power]"
                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        required
                                        data-request-${type}-inverter-field
                                        data-request-${type}-inverter-sum>
                                    <span class="input-group-text">
                                        kW
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-inverter-ratedpower-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Operating Voltage Range -->
                        <div class="col-12 col-lg-8 mb-3">
                            <div class="form-group mb-0">
                                <label for="request-${type}-inverter-initialvoltage-${generator.toString()}-${item.toString()}" class="form-label">
                                    Faixa de Tensão de Operação
                                </label>
                            </div>

                            <!-- Initial Voltage -->
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control"
                                                type="text"
                                                id="request-${type}-inverter-initialvoltage-${generator.toString()}-${item.toString()}"
                                                name="request-${type}[inverter][item-${item.toString()}][initial-voltage]" placeholder="Tensão Inicial"
                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                required
                                                data-request-${type}-inverter-field>
                                            <span class="input-group-text">
                                                V
                                            </span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="${type}-inverter-initialvoltage-feedback-request-${generator.toString()}-${item.toString()}"></div>
                                    </div>
                                </div>

                                <!-- Final Voltage -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control"
                                                type="text"
                                                id="request-${type}-inverter-finalvoltage-${generator.toString()}-${item.toString()}"
                                                name="request-${type}[inverter][item-${item.toString()}][final-voltage]" placeholder="Tensão Final"
                                                onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                                required
                                                data-request-${type}-inverter-field>
                                            <span class="input-group-text">
                                                V
                                            </span>
                                        </div>
                                        <div class="invalid-feedback"
                                            id="${type}-inverter-finalvoltage-feedback-request-${generator.toString()}-${item.toString()}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rated Current- -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-inverter-ratedcurrent-${generator.toString()}-${item.toString()}" class="form-label">
                                    Corrente Nominal
                                </label>
                                <div class="input-group">
                                    <input class="form-control" 
                                        type="text"
                                        id="request-${type}-inverter-ratedcurrent-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[inverter][item-${item.toString()}][rated-current]"
                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                        required
                                        data-request-${type}-inverter-field>
                                    <span class="input-group-text">
                                        A
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-inverter-ratedcurrent-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Power Factor -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-inverter-powerfactor-${generator.toString()}-${item.toString()}" class="form-label">
                                    Fator de Potência
                                </label>
                                <input class="form-control" 
                                    type="text"
                                    id="request-${type}-inverter-powerfactor-${generator.toString()}-${item.toString()}"
                                    name="request-${type}[inverter][item-${item.toString()}][power-factor]"
                                    onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    required
                                    data-request-${type}-inverter-field>
                                <div class="invalid-feedback"
                                    id="${type}-inverter-powerfactor-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Yield -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-inverter-yield-${generator.toString()}-${item.toString()}"
                                    class="form-label">
                                    Rendimento
                                </label>
                                <div class="input-group">
                                    <input class="form-control" 
                                        type="text"
                                        id="request-${type}-inverter-yield-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[inverter][item-${item.toString()}][yield]"
                                        onchange="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                        onblur="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                        onkeyup="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                        required
                                        data-request-${type}-inverter-field>
                                    <span class="input-group-text">
                                        %
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-inverter-yield-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Current DHT -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-inverter-currentdht-${generator.toString()}-${item.toString()}" class="form-label">
                                    DHT de Corrente
                                </label>
                                <div class="input-group">
                                    <input class="form-control" 
                                        type="text"
                                        id="request-${type}-inverter-currentdht-${generator.toString()}-${item.toString()}" name="request-${type}[inverter][item-${item.toString()}][current-dht]"
                                        onchange="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                        onblur="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                        onkeyup="return window.validatePercentage(this), window.enableBtnRequestAddTableItem(this)"
                                        required
                                        data-request-${type}-inverter-field>
                                    <span class="input-group-text">
                                        %
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-inverter-currentdht-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);

    // Mask
    $([`#request-${type}-inverter-ratedpower-${generator.toString()}-${item.toString()}`,
    `#request-${type}-inverter-initialvoltage-${generator.toString()}-${item.toString()}`,
    `#request-${type}-inverter-finalvoltage-${generator.toString()}-${item.toString()}`,
    `#request-${type}-inverter-ratedcurrent-${generator.toString()}-${item.toString()}`
    ]).mask("####9V##", {
        translation: {
            "V": {
                pattern: /[\,]/
            },
            "#": {
                pattern: /[0-9]/,
                optional: true
            }
        }
    });
    $([`#request-${type}-inverter-yield-${generator.toString()}-${item.toString()}`,
    `#request-${type}-inverter-currentdht-${generator.toString()}-${item.toString()}`
    ]).mask("##9V##", {
        translation: {
            "V": {
                pattern: /[\,]/
            },
            "#": {
                pattern: /[0-9]/,
                optional: true
            }
        }
    });
}

