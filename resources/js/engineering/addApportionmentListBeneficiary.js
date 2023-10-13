window.addApportionmentListBeneficiary = function (el) {
    el.setAttribute("disabled", true);

    const generator = el.id.split("-")[4];
    const type = el.id.split("-")[1];
    const addressItem = document.querySelector(`#new-apportionment-list-${generator}`).id;
    const beneficiaries = document.querySelector(`#${addressItem} #cc-beneficiaries-${generator}`);
    const totalBeneficiaries = document.querySelectorAll(`#${beneficiaries.id} [data-${type}-beneficiary-item]`);
    const beneficiary = Number(totalBeneficiaries[totalBeneficiaries.length - 1].id.split("-")[3]) + 1;

    el.closest(".row").insertAdjacentHTML("beforebegin",
        `
            <div class="accordion-item" 
                id="${type}-beneficiary-${generator.toString()}-${beneficiary.toString()}"
                data-${type}-beneficiary-item>
                <h2 class="accordion-header d-flex" 
                    id="${type}-beneficiary-heading-${generator.toString()}-${beneficiary.toString()}">
                    <button type="button" class="accordion-button fw-bold rounded-0 rounded-start bg-light bg-gradient text-primary" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#${type}-beneficiary-collapse-${generator.toString()}-${beneficiary.toString()}" aria-expanded="true"
                        aria-controls="${type}-beneficiary-collapse-${generator.toString()}-${beneficiary.toString()}">
                        Beneficiária ${beneficiary.toString()}
                    </button>
                    <button type="button" class="btn btn-danger rounded-0 rounded-end"
                        id="btn-${type}-remove-beneficiary-item-${generator.toString()}-${beneficiary.toString()}"
                        onclick="return window.removeBeneficiaryItem(this)">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </h2>
                <div id="${type}-beneficiary-collapse-${generator.toString()}-${beneficiary.toString()}"
                    class="accordion-collapse collapse show" 
                    aria-labelledby="${type}-beneficiary-heading-${generator.toString()}-${beneficiary.toString()}"
                    data-bs-parent="#cc-beneficiaries-${generator.toString()}">
                    <div class="accordion-body">
                        <div class="d-none"
                            id="${type}-beneficiary-client-${generator.toString()}-${beneficiary.toString()}">
                            <div class="row mt-3">
                                <div class="col-12 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="${type}-chk-add-beneficiary-client-${generator.toString()}-${beneficiary.toString()}" name="chk-add-beneficiary-client"
                                            onchange="return window.checkIfAddClientBeneficiary(this)">
                                        <label for="${type}-chk-add-beneficiary-client-${generator.toString()}-${beneficiary.toString()}" class="form-check-label">
                                            Cliente diferente da Geradora?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Beneficiary Client -->
                                <div class="col-12 col-md-6 mb-3 d-none" 
                                    id="${type}-client-beneficiary-${generator.toString()}-${beneficiary.toString()}">
                                    <div class="form-group">
                                        <label for="${type}-project-beneficiary-client-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                            Cliente
                                        </label>
                                        <input class="form-control" type="text"
                                            id="${type}-project-beneficiary-client-${generator.toString()}-${beneficiary.toString()}" name="beneficiaries[address-${beneficiary.toString()}][beneficiary-client]"
                                            onfocus="return window.autocomplete(this, clients)">
                                        <div class="invalid-feedback"
                                            id="${type}-client-beneficiary-${generator.toString()}-${beneficiary.toString()}-feedback-project"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Beneficiary Contract Account -->
                            <div class="col-12 col-md-6 mb-3">
                                <div id="${type}-beneficiary-contract-account-input-${generator.toString()}-${beneficiary.toString()}">
                                    <div class="form-group">
                                        <label for="${type}-cc-beneficiary-input-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                            Conta Contrato Beneficiária
                                        </label>
                                        <input class="form-control" type="text" 
                                            id="${type}-cc-beneficiary-input-${generator.toString()}-${beneficiary.toString()}"
                                            name="beneficiaries[address-${beneficiary.toString()}][beneficiary-contract-account]"
                                            onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)"
                                            maxlength="12"
                                            data-beneficiary
                                            required>
                                        <div class="invalid-feedback" 
                                            id="${type}-cc-beneficiary-input-${generator.toString()}-${beneficiary.toString()}-feedback-project"></div>
                                    </div>
                                </div>
                                <div id="${type}-beneficiary-contract-account-select-${generator.toString()}-${beneficiary.toString()}">
                                    <div class="form-group">
                                        <label for="${type}-cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                            Conta Contrato Beneficiária
                                        </label>
                                        <select class="form-select" 
                                            aria-label="${type}-cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}"
                                            id="${type}-cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}"
                                            name="beneficiaries[address-${beneficiary.toString()}][beneficiary-contract-account]"
                                            onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"
                                            onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)"
                                            required>
                                            <option value="" disabled selected>
                                                Selecione a conta contrato
                                            </option>
                                        </select>
                                        <div class="invalid-feedback"
                                            id="${type}-cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}-feedback-project"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Other beneficiary contract account -->
                            <div class="col-12 col-md-6 mb-3 d-none"
                                id="${type}-other-beneficiary-contract-account-${generator.toString()}-${beneficiary.toString()}">
                                <div class="form-group">
                                    <label for="${type}-other-cc-beneficiary-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                        Outra Conta Contrato Beneficiária
                                    </label>
                                    <input class="form-control" type="text" 
                                        id="${type}-other-cc-beneficiary-${generator.toString()}-${beneficiary.toString()}"
                                        name="beneficiaries[address-${beneficiary.toString()}][beneficiary-other-contract-account]"
                                        onchange="return window.validateInput(this, 1)"
                                        onblur="return window.validateInput(this, 1)"
                                        onkeyup="return window.validateInput(this, 1)"
                                        maxlength="12">
                                    <div class="invalid-feedback" 
                                        id="${type}-cc-other-beneficiary-${generator.toString()}-${beneficiary.toString()}-feedback-project">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Consumption Class -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="${type}-beneficiary-consumption-class-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                        Classe de Consumo
                                    </label>
                                    <select class="form-select" 
                                        aria-label="${type}-beneficiary-consumption-class"
                                        id="${type}-beneficiary-consumption-class-${generator.toString()}-${beneficiary.toString()}" name="beneficiaries[address-${beneficiary.toString()}][beneficiary-consumption-class]"
                                        onchange="return window.validateSelect(this), window.enableBtnAddBeneficiary(this)"
                                        onblur="return window.validateSelect(this)"
                                        data-beneficiary
                                        required>
                                        <option value="" disabled selected>
                                            Escolha a classe de consumo
                                        </option>
                                        <option value="${beneficiaryConsumptionClassIndex1}">
                                            Residencial
                                        </option>
                                        <option value="${beneficiaryConsumptionClassIndex2}">
                                            Industrial
                                        </option>
                                        <option value="${beneficiaryConsumptionClassIndex3}">
                                            Comércio, Serviço e outras atividades
                                        </option>
                                        <option value="${beneficiaryConsumptionClassIndex4}">
                                            Rural
                                        </option>
                                        <option value="${beneficiaryConsumptionClassIndex5}">
                                            Poder Público
                                        </option>
                                        <option value="${beneficiaryConsumptionClassIndex6}">
                                            Iluminação Pública
                                        </option>
                                        <option value="${beneficiaryConsumptionClassIndex7}">
                                            Serviço Público
                                        </option>
                                        <option value="${beneficiaryConsumptionClassIndex8}">
                                            Consumo Próprio
                                        </option>
                                    </select>
                                    <div class="invalid-feedback" 
                                        id="${type}-beneficiary-consumption-class-${generator.toString()}-${beneficiary.toString()}-feedback-project">
                                    </div>
                                </div>
                            </div>

                            <!-- Rate -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="${type}-project-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                        Rateio
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" type="text"
                                            id="${type}-project-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}"
                                            name="beneficiaries[address-${beneficiary.toString()}][beneficiary-rate]"
                                            onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"
                                            onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                            onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                            data-beneficiary
                                            required>
                                        <span class="input-group-text rounded-end">%</span>
                                        <span class="input-group-text bg-secondary text-white ms-4 rounded" 
                                            id="${type}-rate-monthly-avg-generation-${generator.toString()}-${beneficiary.toString()}">
                                        </span>
                                    </div>
                                    <div class="invalid-feedback" 
                                        id="${type}-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}-feedback-project">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Address -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="${type}-project-beneficiary-address-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                        Endereço
                                    </label>
                                    <input class="form-control" type="text"
                                        id="${type}-project-beneficiary-address-${generator.toString()}-${beneficiary.toString()}" name="beneficiaries[address-${beneficiary.toString()}][beneficiary-address]"
                                        onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        data-beneficiary
                                        required>
                                    <div class="invalid-feedback" 
                                        id="${type}-beneficiary-address-${generator.toString()}-${beneficiary.toString()}-feedback-project"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    );

    // mask
    $(`#${type}-cc-beneficiary-input-${generator.toString()}-${beneficiary.toString()}`).mask("0#");
    $(`#${type}-other-cc-beneficiary-${generator.toString()}-${beneficiary.toString()}`).mask("0#");
    $(`#${type}-project-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}`).mask("##9V##", {
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

    const generatorClient = document.querySelector(`#apportionment-list-generator-client-${generator.toString()}`);
    const beneficiaryClient = document.querySelector(`#${type}-beneficiary-client-${generator.toString()}-${beneficiary.toString()}`);
    const rate = document.querySelector(`#${beneficiaries.id} #${type}-project-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}`);
    const allRateInputs = document.querySelectorAll(`#${beneficiaries.id} input[id^="${type}-project-beneficiary-rate"]`);
    const sumRateInputs = Array.from(allRateInputs).reduce((total, current) =>
        total + Number(current.value.replace(",", ".")), 0);

    window.getBeneficiaryClientCredentials(generatorClient, beneficiary.toString(), type);
    window.handleGeneratorProjectType(beneficiaryClient);

    rate.value = (100 - sumRateInputs).toLocaleString("pt-br", { maximumFractionDigits: 2 });
    window.validateBeneficiaryRate(rate);
    window.handleBeneficiaryRate(rate);
}