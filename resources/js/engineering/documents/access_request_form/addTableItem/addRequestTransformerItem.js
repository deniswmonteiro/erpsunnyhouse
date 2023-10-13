window.addRequestTransformerItem = function (el) {
    const type = el.id.split("-")[3];
    const generator = el.id.split("-")[6];
    const accordion = document.querySelector(`#table-request-${type}-transformer-${generator}`);
    const totalTransformerItems = document.querySelectorAll(`#${accordion.id} [data-request-${type}-transformer-item]`);
    let item = totalTransformerItems.length + 1;

    accordion.insertAdjacentHTML("beforeend", `
        <div class="accordion-item"
            id="request-${type}-transformer-item-${generator.toString()}-${item.toString()}"
            data-request-${type}-transformer-item>
            <h2 class="accordion-header">
                <button class="accordion-button fw-bold text-primary" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#item-request-${type}-transformer-${generator.toString()}-${item.toString()}"
                    aria-expanded="true"
                    aria-controls="item-request-${type}-transformer-${generator.toString()}-${item.toString()}">
                    Item ${item.toString()}
                </button>
            </h2>
            <div id="item-request-${type}-transformer-${generator.toString()}-${item.toString()}"
                class="accordion-collapse collapse show"
                data-bs-parent="#table-request-${type}-transformer-${generator.toString()}">
                <div class="accordion-body">
                    <div class="row mt-3">
                        <!-- Rated Power -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-transformer-ratedpower-${generator.toString()}-${item.toString()}" class="form-label">
                                    Potência Nominal
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="request-${type}-transformer-ratedpower-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[transformer][item--${item.toString()}][rated-power]"
                                        onchange="return window.validateDouble(this), window.sumRequestTableField(this)"
                                        onblur="return window.validateDouble(this), window.sumRequestTableField(this)"
                                        onkeyup="return window.validateDouble(this), window.sumRequestTableField(this)"
                                        data-request-${type}-transformer-sum>
                                    <span class="input-group-text">
                                        kVA
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-transformer-ratedpower-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Connection Type -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-transformer-connectiontype-${generator.toString()}-${item.toString()}" class="form-label">
                                    Tipo de Ligação
                                </label>
                                <input class="form-control" type="text"
                                    id="request-${type}-transformer-connectiontype-${generator.toString()}-${item.toString()}"
                                    value="&Delta;-Y"
                                    disabled>
                            </div>
                        </div>

                        <!-- Transformer Impedance -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-transformer-impedance-${generator.toString()}-${item.toString()}" class="form-label">
                                    Impedância do Trafo
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="request-${type}-transformer-impedance-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[transformer][item-${item.toString()}][impedance]"
                                        onchange="return window.validatePercentage(this)"
                                        onblur="return window.validatePercentage(this)"
                                        onkeyup="return window.validatePercentage(this)">
                                    <span class="input-group-text">
                                        %
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-transformer-impedance-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Primary Voltage -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-transformer-primaryvoltage-${generator.toString()}-${item.toString()}" class="form-label">
                                    Tensão Primária
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="request-${type}-transformer-primaryvoltage-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[transformer][item-${item.toString()}][primary-voltage]"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">
                                        V
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-transformer-primaryvoltage-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Secondary Voltage -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-transformer-secondaryvoltage-${generator.toString()}-${item.toString()}" class="form-label">
                                    Tensão Secundária
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="request-${type}-transformer-secondaryvoltage-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[transformer][item-${item.toString()}][secondary-voltage]"
                                        onchange="return window.validateDouble(this)"
                                        onblur="return window.validateDouble(this)"
                                        onkeyup="return window.validateDouble(this)">
                                    <span class="input-group-text">
                                        V
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-transformer-secondaryvoltage-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>

                        <!-- Switch Range -->
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="request-${type}-transformer-switchrange-${generator.toString()}-${item.toString()}" class="form-label">
                                    Faixa de Comutador (+ ou - x%)
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text"
                                        id="request-${type}-transformer-switchrange-${generator.toString()}-${item.toString()}"
                                        name="request-${type}[transformer][item-${item.toString()}][switch-range]"
                                        onchange="return window.validatePercentage(this)"
                                        onblur="return window.validatePercentage(this)"
                                        onkeyup="return window.validatePercentage(this)">
                                    <span class="input-group-text">
                                        %
                                    </span>
                                </div>
                                <div class="invalid-feedback"
                                    id="${type}-transformer-switchrange-feedback-request-${generator.toString()}-${item.toString()}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);

    // Mask
    $(["input[id^='request-aboveseventyfive-transformer-ratedpower']",
        "input[id^='request-aboveseventyfive-transformer-primaryvoltage']",
        "input[id^='request-aboveseventyfive-transformer-secondaryvoltage']",
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
    $(["input[id^='request-aboveseventyfive-transformer-impedance']",
        "input[id^='request-aboveseventyfive-transformer-switchrange']",
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