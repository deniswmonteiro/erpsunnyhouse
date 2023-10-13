window.addCCBeneficiary = function (el) {
    el.setAttribute("disabled", true);

    const generator = el.id.split("-")[3];
    const beneficiaries = document.querySelector(`#address-${generator} #cc-beneficiaries-${generator}`);
    const totalBeneficiaries = document.querySelectorAll(`#${beneficiaries.id} [data-beneficiary-item]`);
    const beneficiary = Number(totalBeneficiaries[totalBeneficiaries.length - 1].id.split("-")[2]) + 1;

    beneficiaries.insertAdjacentHTML("beforeend",
        `
            <div class="accordion-item"
                id="beneficiary-${generator.toString()}-${beneficiary.toString()}"
                data-beneficiary-item>
                <h2 class="accordion-header d-flex"
                    id="beneficiary-heading-${generator.toString()}-${beneficiary.toString()}">
                    <button type="button"
                        class="accordion-button fw-bold bg-light bg-gradient text-primary rounded-0 rounded-start" 
                        data-bs-toggle="collapse"
                        data-bs-target="#beneficiary-collapse-${generator.toString()}-${beneficiary.toString()}"
                        aria-expanded="true"
                        aria-controls="beneficiary-collapse-${generator.toString()}-${beneficiary.toString()}">
                        Beneficiária ${beneficiary.toString()}
                    </button>
                    <button type="button" class="btn btn-danger rounded-0 rounded-end"
                        onclick="return window.removeBeneficiaryItem(this)">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </h2>
                <div id="beneficiary-collapse-${generator.toString()}-${beneficiary.toString()}"
                    class="accordion-collapse collapse show" 
                    aria-labelledby="beneficiary-heading-${generator.toString()}-${beneficiary.toString()}"
                    data-bs-parent="#cc-beneficiaries-${generator.toString()}">
                    <div class="accordion-body">
                        <div class="row mt-3 d-none" id="beneficiary-client-${generator.toString()}-${beneficiary.toString()}">
                            <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="chk-add-beneficiary-client-${generator.toString()}-${beneficiary.toString()}"
                                        onchange="return window.checkIfAddClientBeneficiary(this)">
                                    <label class="form-check-label" 
                                        for="chk-add-beneficiary-client-${generator.toString()}-${beneficiary.toString()}">
                                        Cliente diferente da Geradora?
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Beneficiary Client -->
                                <div class="col-12 col-md-6 mb-3 d-none"
                                    id="client-beneficiary-${generator.toString()}-${beneficiary.toString()}">
                                    <div class="form-group">
                                        <label for="project-beneficiary-client-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                            Cliente
                                        </label>
                                        <input class="form-control" type="text"
                                            id="project-beneficiary-client-${generator.toString()}-${beneficiary.toString()}" 
                                            name="project[generator-${generator.toString()}][beneficiaries][address-${beneficiary.toString()}][beneficiary-client]"
                                            onfocus="return window.autocomplete(this, clients)">
                                        <div class="invalid-feedback"
                                            id="client-beneficiary-${generator.toString()}-${beneficiary.toString()}-feedback-project"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Beneficiary Contract Account -->
                            <div class="col-12 col-md-6 mb-3">
                                <div id="beneficiary-contract-account-input-${generator.toString()}-${beneficiary.toString()}">
                                    <div class="form-group">
                                        <label for="project-cc-beneficiary-input-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                            Conta Contrato Beneficiária
                                        </label>
                                        <input class="form-control" type="text" 
                                            id="project-cc-beneficiary-input-${generator.toString()}-${beneficiary.toString()}"
                                            name="project[generator-${generator.toString()}][beneficiaries][address-${beneficiary.toString()}][beneficiary-contract-account]"
                                            onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)"
                                            maxlength="12"
                                            data-beneficiary>
                                        <div class="invalid-feedback" 
                                            id="cc-beneficiary-input-${generator.toString()}-${beneficiary.toString()}-feedback-project"></div>
                                    </div>
                                </div>
                                <div id="beneficiary-contract-account-select-${generator.toString()}-${beneficiary.toString()}">
                                    <div class="form-group">
                                        <label for="project-cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                            Conta Contrato Beneficiária
                                        </label>
                                        <select class="form-select" 
                                            aria-label="project-cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}"
                                            id="project-cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}"
                                            name="project[generator-${generator.toString()}][beneficiaries][address-${beneficiary.toString()}][beneficiary-contract-account]"
                                            onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"
                                            onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)">
                                            <option value="" disabled selected>
                                                Selecione a conta contrato
                                            </option>
                                        </select>
                                        <div class="invalid-feedback"
                                            id="cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}-feedback-project"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Other beneficiary contract account -->
                            <div class="col-12 col-md-6 mb-3 d-none"
                                id="other-beneficiary-contract-account-${generator.toString()}-${beneficiary.toString()}">
                                <div class="form-group">
                                    <label for="project-other-cc-beneficiary-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                        Outra Conta Contrato Beneficiária
                                    </label>
                                    <input class="form-control" type="text" 
                                        id="project-other-cc-beneficiary-${generator.toString()}-${beneficiary.toString()}"
                                        name="project[generator-${generator.toString()}][beneficiaries][address-${beneficiary.toString()}][beneficiary-other-contract-account]"
                                        onchange="return window.validateInput(this, 1)"
                                        onblur="return window.validateInput(this, 1)"
                                        onkeyup="return window.validateInput(this, 1)"
                                        maxlength="12">
                                    <div class="invalid-feedback" 
                                        id="cc-other-beneficiary-${generator.toString()}-${beneficiary.toString()}-feedback-project">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Consumption Class -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="project-beneficiary-consumption-class-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                        Classe de Consumo
                                    </label>
                                    <select class="form-select"
                                        aria-label="project-beneficiary-consumption-class-${generator.toString()}-${beneficiary.toString()}"
                                        id="project-beneficiary-consumption-class-${generator.toString()}-${beneficiary.toString()}"
                                        name="project[generator-${generator.toString()}][beneficiaries][address-${beneficiary.toString()}][beneficiary-consumption-class]"
                                        onchange="return window.validateSelect(this), window.enableBtnAddBeneficiary(this)"
                                        onblur="return window.validateSelect(this)"
                                        data-beneficiary>
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
                                        id="beneficiary-consumption-class-${generator.toString()}-${beneficiary.toString()}-feedback-project">
                                    </div>
                                </div>
                            </div>

                            <!-- Rate -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="project-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                        Rateio
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" type="text"
                                            id="project-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}"
                                            name="project[generator-${generator.toString()}][beneficiaries][address-${beneficiary.toString()}][beneficiary-rate]"
                                            onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"
                                            onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                            onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                            data-beneficiary>
                                        <span class="input-group-text rounded-end">
                                            %
                                        </span>
                                        <span class="input-group-text bg-secondary text-white ms-4 rounded" 
                                            id="rate-monthly-avg-generation-${generator.toString()}-${beneficiary.toString()}">
                                        </span>
                                    </div>
                                    <div class="invalid-feedback" 
                                        id="beneficiary-rate-${generator.toString()}-${beneficiary.toString()}-feedback-project">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Address -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="project-beneficiary-address-${generator.toString()}-${beneficiary.toString()}" class="form-label">
                                        Endereço
                                    </label>
                                    <input class="form-control" type="text"
                                        id="project-beneficiary-address-${generator.toString()}-${beneficiary.toString()}"
                                        name="project[generator-${generator.toString()}][beneficiaries][address-${beneficiary.toString()}][beneficiary-address]"
                                        onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        data-beneficiary>
                                    <div class="invalid-feedback" 
                                        id="beneficiary-address-${generator.toString()}-${beneficiary.toString()}-feedback-project"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    );

    // mask
    $(`#project-cc-beneficiary-input-${generator.toString()}-${beneficiary.toString()}`).mask("0#");
    $(`#project-other-cc-beneficiary-${generator.toString()}-${beneficiary.toString()}`).mask("0#");
    $(`#project-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}`).mask("##9V##", {
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

    // Generator
    const projectType = document.querySelector(`#address-${generator.toString()} select[id^="project-type"]`);
    const generatorContractAccount = document.querySelector(`#address-${generator.toString()} div[id^="generator-contract-account-select"]`);
    const generatorChkAddClient = document.querySelector(`#address-${generator.toString()} input[id^="chk-add-generator-client"]`);
    const generatorClient = document.querySelector(`#address-${generator.toString()} input[id^="project-generator-client"]`);

    // Beneficiary
    const beneficiaryContractAccountInput = document.querySelector(`#beneficiary-contract-account-input-${generator.toString()}-${beneficiary.toString()}`);
    const beneficiaryContractAccountSelect = document.querySelector(`#beneficiary-contract-account-select-${generator.toString()}-${beneficiary.toString()}`);
    const rate = document.querySelector(`#${beneficiaries.id} #project-beneficiary-rate-${generator.toString()}-${beneficiary.toString()}`);
    const allRateInputs = document.querySelectorAll(`#${beneficiaries.id} input[id^="project-beneficiary-rate"]`);
    const sumRateInputs = Array.from(allRateInputs).reduce((total, current) =>
        total + Number(current.value.replace(",", ".")), 0);

    // show input or select to add beneficiary contract account
    if (!generatorContractAccount.classList.contains("d-none")) {
        const beneficiaryContractAccount = document.querySelector(`#project-cc-beneficiary-select-${generator.toString()}-${beneficiary.toString()}`);

        beneficiaryContractAccountSelect.classList.remove("d-none");
        beneficiaryContractAccountInput.classList.add("d-none");

        if (generatorChkAddClient.checked) {
            window.getBeneficiaryClientCredentials(generatorClient, beneficiary.toString());
        }

        else {
            window.getBeneficiaryClientContractAccounts(beneficiaryContractAccount, contractClientLogin, contractClientPassword);
        }
    }

    else {
        beneficiaryContractAccountSelect.classList.add("d-none");
        beneficiaryContractAccountInput.classList.remove("d-none");
    }

    rate.value = (100 - sumRateInputs).toLocaleString("pt-br", { maximumFractionDigits: 2 });
    window.validateBeneficiaryRate(rate);
    window.handleBeneficiaryRate(rate);

    window.changeProjectType(projectType, true, beneficiary.toString());
}