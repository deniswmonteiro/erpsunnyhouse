window.addRequestSolarItem = function (el) {
    el.setAttribute("disabled", true);

    const type = el.id.split("-")[3];
    const generator = el.id.split("-")[6];
    const accordion = document.querySelector(`#table-request-${type}-solar-${generator}`);
    const totalSolarItems = document.querySelectorAll(`#${accordion.id} [data-request-${type}-solar-item]`);
    let item = totalSolarItems.length + 1;

    accordion.insertAdjacentHTML("beforeend", `
        <div class="accordion-item"
            id="request-${type}-solar-item-${generator.toString()}-${item.toString()}"
            data-request-${type}-solar-item>
            <h2 class="accordion-header d-flex">
                <button class="accordion-button fw-bold text-primary" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#item-${type}-solar-${generator.toString()}-${item.toString()}"
                    aria-expanded="true"
                    aria-controls="item-${type}-solar-${generator.toString()}-${item.toString()}">
                    Item ${item.toString()}
                </button>
                <button type="button" class="btn btn-danger rounded-0"
                    id="btn-remove-request-${type}-solar-item-${generator.toString()}-${item.toString()}"
                    onclick="return window.removeRequestItem(this)">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </h2>
            <div id="item-${type}-solar-${generator.toString()}-${item.toString()}"
                class="accordion-collapse collapse show"
                data-bs-parent="#table-${type}-solar-${generator.toString()}">
                <div class="accordion-body">
                    <div class="row mt-3">
                        <!-- Module Power -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-solar-modulepower-${generator.toString()}-${item.toString()}" class="form-label">
                                    Potência do Módulo
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="request-${type}-solar-modulepower-${generator.toString()}-${item.toString()}" name="request-${type}[solar][item-${item.toString()}][module-power]"
                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this)"
                                        required
                                        data-request-${type}-solar-field>
                                    <span class="input-group-text">
                                        W
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-solar-modulepower-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-solar-quantity-${generator.toString()}-${item.toString()}"
                                    class="form-label">
                                    Quantidade
                                </label>
                                <input class="form-control" 
                                    type="text"
                                    id="request-${type}-solar-quantity-${generator.toString()}-${item.toString()}"
                                    name="request-${type}[solar][item-${item.toString()}][quantity]"
                                    onchange="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                    onblur="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                    onkeyup="return window.validateInput(this, 1), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                    required
                                    data-request-${type}-solar-field
                                    data-request-${type}-solar-sum>
                                <div class="invalid-feedback"
                                    id="${type}-solar-quantity-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Peak Power -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-solar-peakpower-${generator.toString()}-${item.toString()}"
                                    class="form-label">
                                    Potência de Pico
                                </label>
                                <div class="input-group">
                                    <input class="form-control" 
                                        type="text"
                                        id="request-${type}-solar-peakpower-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[solar][item-${item.toString()}][peak-power]"
                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        required
                                        data-request-${type}-solar-field
                                        data-request-${type}-solar-sum>
                                    <span class="input-group-text">
                                        kWp
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-solar-peakpower-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Arrangement Area- -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-solar-arrangementarea-${generator.toString()}-${item.toString()}" class="form-label">
                                    Área do Arranjo
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="request-${type}-solar-arrangementarea-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[solar][item-${item.toString()}][arrangement-area]"
                                        onchange="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        onblur="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        onkeyup="return window.validateDouble(this), window.enableBtnRequestAddTableItem(this), window.sumRequestTableField(this)"
                                        required
                                        data-request-${type}-solar-field
                                        data-request-${type}-solar-sum>
                                    <span class="input-group-text">
                                        m<sup>2</sup>
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-solar-arrangementarea-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Module Manufacturers- -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-solar-modulemanufacturers-${generator.toString()}-${item.toString()}" class="form-label">
                                    Fabricante(s) dos Módulos
                                </label>
                                <input class="form-control" 
                                    type="text"
                                    id="request-${type}-solar-modulemanufacturers-${generator.toString()}-${item.toString()}"
                                    name="request-${type}[solar][item-${item.toString()}][module-manufacturers]"
                                    onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    required
                                    data-request-${type}-solar-field>
                                <div class="invalid-feedback"
                                    id="${type}-solar-modulemanufacturers-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Module Model -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-solar-modulemodel-${generator.toString()}-${item.toString()}" class="form-label">
                                    Modelo
                                </label>
                                <input class="form-control" 
                                    type="text"
                                    id="request-${type}-solar-modulemodel-${generator.toString()}-${item.toString()}"
                                    name="request-${type}[solar][item-${item.toString()}][module-model]"
                                    onchange="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onblur="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    onkeyup="return window.validateInput(this, 2), window.enableBtnRequestAddTableItem(this)"
                                    required
                                    data-request-${type}-solar-field>
                                <div class="invalid-feedback"
                                    id="${type}-solar-modulemodel-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);

    // Mask
    $(`#request-${type}-solar-quantity-${generator.toString()}-${item.toString()}`).mask("0#");
    $([`#request-${type}-solar-modulepower-${generator.toString()}-${item.toString()}`,
    `#request-${type}-solar-peakpower-${generator.toString()}-${item.toString()}`,
    `#request-${type}-solar-arrangementarea-${generator.toString()}-${item.toString()}`,
    `#request-${type}-inverter-ratedpower-${generator.toString()}-${item.toString()}`,
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