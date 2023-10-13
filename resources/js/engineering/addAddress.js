window.addAddress = function (el) {
    el.setAttribute("disabled", true);

    const addressInformations = document.querySelector("#address-informations");
    const totalAddress = document.querySelectorAll(`#${addressInformations.id} [data-address-item]`);
    const generator = Number(totalAddress[totalAddress.length - 1].id.split("-")[1]) + 1;

    addressInformations.insertAdjacentHTML("beforeend",
        `
            <div class="accordion-item" id="address-${generator.toString()}" data-address-item>
                <h2 class="accordion-header d-flex" id="address-heading-${generator.toString()}">
                    <button type="button" class="accordion-button fw-bold rounded-0 rounded-start" 
                        data-bs-toggle="collapse" data-bs-target="#address-collapse-${generator.toString()}"
                        aria-expanded="true" aria-controls="address-collapse-${generator.toString()}">
                        Geradora ${generator.toString()}
                    </button>
                    <button type="button" class="btn btn-danger rounded-0 rounded-end"
                        onclick="return window.removeAddressItem(this)">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </h2>
                <div id="address-collapse-${generator.toString()}"
                    class="accordion-collapse collapse show" 
                    aria-labelledby="address-heading-${generator.toString()}" 
                    data-bs-parent="#address-informations">
                    <div class="accordion-body">
                        <div class="row mt-3">
                            <!-- Project Type -->
                            <div class="col-12 col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="project-type-${generator.toString()}" class="form-label">
                                        Tipo de Projeto
                                    </label>
                                    <select class="form-select"
                                        aria-label="project-type-${generator.toString()}"
                                        id="project-type-${generator.toString()}"
                                        name="project[generator-${generator.toString()}][generator-project-type]"
                                        onchange="return window.changeProjectType(this), window.validateSelect(this), window.enableBtnAddAddress(this)"
                                        onblur="return window.validateSelect(this), window.enableBtnAddAddress(this)"
                                        data-address>
                                        <option value="" disabled selected>
                                            Escolha o tipo de projeto
                                        </option>
                                        <option value="${generatorProjectTypeIndex1}">
                                            Individual
                                        </option>
                                        <option value="${generatorProjectTypeIndex2}">
                                            Autoconsumo Remoto
                                        </option>
                                        <option value="${generatorProjectTypeIndex3}">
                                            Geração Compartilhada
                                        </option>
                                        <option value="${generatorProjectTypeIndex4}">
                                            Reservado
                                        </option>
                                    </select>
                                    <div class="invalid-feedback"
                                        id="type-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <!-- Checkbox Client -->
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="chk-add-generator-client-${generator.toString()}"
                                        name="chk-add-generator-client"
                                        onchange="return window.checkIfAddClient(this)">
                                    <label for="chk-add-generator-client-${generator.toString()}" 
                                        class="form-check-label">
                                        Cliente diferente do contrato?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Generator Client -->
                            <div class="col-12 col-md-6 mb-3 d-none" id="generator-client-${generator.toString()}">
                                <div class="form-group">
                                    <label for="project-generator-client-${generator.toString()}" class="form-label">
                                        Cliente
                                    </label>
                                    <input class="form-control" type="text"
                                        id="project-generator-client-${generator.toString()}" 
                                        name="project[generator-${generator.toString()}][generator-client]"
                                        onfocus="return window.autocomplete(this, clients)">
                                    <div class="invalid-feedback"
                                        id="client-generator-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <!-- Checkbox client address -->
                            <div class="col-12 col-md-6 mb-4">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <div class="spinner-border spinner-border-sm text-warning d-none ms-2 mb-1"     
                                            style="margin-right: .74rem"
                                            id="loading-client-address-${generator.toString()}"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <label class="form-check-label fw-normal"
                                            style="color: #607080"
                                            for="chk-same-contract-address-${generator.toString()}">
                                            Usar o endereço do cliente
                                        </label>
                                        <input class="form-check-input" type="checkbox"
                                            id="chk-same-contract-address-${generator.toString()}"
                                            name="chk-same-contract-address"
                                            onchange="return window.setSameContractInstallationAddress(this)">
                                    </div>                                
                                </div>
                            </div>

                            <!-- Checkbox default generator address -->
                            <div class="col-12 col-md-6 mb-4">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <div class="spinner-border spinner-border-sm text-warning d-none ms-2 mb-1" style="margin-right: .74rem"
                                            id="loading-default-address-${generator.toString()}"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <label class="form-check-label fw-normal"
                                            style="color: #607080"
                                            for="chk-default-address-${generator.toString()}">
                                            Usar o endereço Sunny Park
                                        </label>
                                        <input class="form-check-input" type="checkbox"
                                            id="chk-default-address-${generator.toString()}"
                                            name="chk-default-address"
                                            onchange="return window.setDefaultGeneratorAddress(this)">
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- CEP -->
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="form-group">
                                    <label for="project-cep-${generator.toString()}" class="form-label">
                                        CEP
                                    </label>
                                    <input class="form-control" type="text"
                                        id="project-cep-${generator.toString()}"
                                        name="project[generator-${generator.toString()}][generator-cep]"
                                        onchange="return window.fillInAddressFields(this), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this), window.validateCep(this)"
                                        onblur="return window.validateCep(this), window.fillInAddressFields(this)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        data-address>
                                    <div class="invalid-feedback"
                                        id="cep-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-12 col-lg-7 mb-3">
                                <div class="form-group">
                                    <label for="project-address-${generator.toString()}" class="form-label">
                                        Endereço
                                    </label>
                                    <input class="form-control" type="text" 
                                        id="project-address-${generator.toString()}"
                                        name="project[generator-${generator.toString()}][generator-address]" 
                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        data-address>
                                    <div class="invalid-feedback"
                                        id="address-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>

                            <!-- Number -->
                            <div class="col-12 col-lg-2 mb-3">
                                <div class="form-group">
                                    <label for="project-number-${generator.toString()}" class="form-label">
                                        Número/Apt.
                                    </label>
                                    <input class="form-control" type="text"
                                        id="project-number-${generator.toString()}"
                                        name="project[generator-${generator.toString()}][generator-number]"
                                        onchange="return window.validateInput(this, 1), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                        onblur="return window.validateInput(this, 1)"
                                        onkeyup="return window.validateInput(this, 1)"
                                        data-address>
                                    <div class="invalid-feedback"
                                        id="number-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Complement -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="project-complement-${generator.toString()}" class="form-label">
                                        Complemento
                                    </label>
                                    <input class="form-control" type="text"
                                        id="project-complement-${generator.toString()}"
                                        name="project[generator-${generator.toString()}][generator-complement]">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Neighborhood -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="project-neighborhood-${generator.toString()}" class="form-label">
                                        Bairro
                                    </label>
                                    <input class="form-control" type="text"
                                        id="project-neighborhood-${generator.toString()}"
                                        name="project[generator-${generator.toString()}][generator-neighborhood]"
                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        data-address>
                                    <div class="invalid-feedback"
                                        id="neighborhood-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="project-city-${generator.toString()}" class="form-label">
                                        Cidade
                                    </label>
                                    <input class="form-control" type="text"
                                        id="project-city-${generator.toString()}""
                                        name="project[generator-${generator.toString()}][generator-city]"
                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        data-address>
                                    <div class="invalid-feedback"
                                        id="city-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>

                            <!-- State -->
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="project-state-${generator.toString()}" class="form-label">
                                        Estado
                                    </label>
                                    <input class="form-control" type="text"
                                        id="project-state-${generator.toString()}"
                                        name="project[generator-${generator.toString()}][generator-state]"
                                        onchange="return window.validateInput(this, 2), window.ifInstallationAddressFieldsValueChanges(this), window.enableBtnAddAddress(this)"
                                        onblur="return window.validateInput(this, 2)"
                                        onkeyup="return window.validateInput(this, 2)"
                                        data-address>
                                    <div class="invalid-feedback"
                                        id="state-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Generator Power -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="project-generator-power-${generator.toString()}" 
                                        class="form-label">
                                        Potência da Geradora
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" type="text"
                                            id="project-generator-power-${generator.toString()}"
                                            name="project[generator-${generator.toString()}][generator-power]"
                                            readonly>
                                        <span class="input-group-text">kWp</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Contracted kWp Production -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="generator-contracted-generation-production-${generator.toString()}"
                                        class="form-label">
                                        Produção do kWp Contratado
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" type="text"
                                            id="generator-contracted-generation-production-${generator.toString()}"
                                            readonly>
                                        <span class="input-group-text">kWh</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Estimated kWp Production -->
                            <div class="col-12 col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="generator-estimated-generation-production-${generator.toString()}"
                                        class="form-label">
                                        Produção do kWp Estimado
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" type="text"
                                            id="generator-estimated-generation-production-${generator.toString()}"
                                            readonly>
                                        <span class="input-group-text">kWh</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Generator Contract Account -->
                            <div class="col-12 col-md-5 mb-3">
                                <div id="generator-contract-account-input-${generator.toString()}">
                                    <div class="form-group">
                                        <label for="project-cc-generator-input-${generator.toString()}" 
                                            class="form-label">
                                            Conta Contrato Geradora
                                        </label>
                                        <input class="form-control" type="text"
                                            id="project-cc-generator-input-${generator.toString()}"
                                            name="project[generator-${generator.toString()}][generator-contract-account]" onchange="return window.validateInput(this, 1), window.enableBtnAddAddress(this)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)"
                                            maxlength="12"
                                            data-address>
                                        <div class="invalid-feedback" 
                                            id="cc-generator-input-${generator.toString()}-feedback-project"></div>
                                    </div>
                                </div>
                                <div id="generator-contract-account-select-${generator.toString()}">
                                    <div class="form-group">
                                        <label for="project-cc-generator-select-${generator.toString()}" 
                                            class="form-label">
                                            Conta Contrato Geradora
                                        </label>
                                        <select class="form-select" 
                                            aria-label="project-cc-generator-select-${generator.toString()}"
                                            id="project-cc-generator-select-${generator.toString()}"
                                            name="project[generator-${generator.toString()}][generator-contract-account]"
                                            onchange="return window.validateSelect(this, 1), window.enableBtnAddAddress(this), window.setDifferentGeneratorContractAccount(this)"
                                            onblur="return window.validateSelect(this, 1), window.setDifferentGeneratorContractAccount(this)">
                                            <option value="" disabled selected>
                                                Selecione a conta contrato
                                            </option>
                                        </select>
                                        <div class="invalid-feedback"
                                            id="cc-generator-select-${generator.toString()}-feedback-project"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Other generator contract account -->
                            <div class="col-12 col-md-4 mb-3 d-none"
                                id="other-generator-contract-account-${generator.toString()}">
                                <div class="form-group">
                                    <label for="project-other-cc-generator-${generator.toString()}" class="form-label">
                                        Outra Conta Contrato Geradora
                                    </label>
                                    <input class="form-control" type="text" 
                                        id="project-other-cc-generator-${generator.toString()}"
                                        name="project[generator-${generator.toString()}][generator-other-contract-account]"
                                        onchange="return window.validateInput(this, 1)"
                                        onblur="return window.validateInput(this, 1)"
                                        onkeyup="return window.validateInput(this, 1)"
                                        maxlength="12">
                                    <div class="invalid-feedback" 
                                        id="cc-other-generator-${generator.toString()}-feedback-project"></div>
                                </div>
                            </div>

                            <!-- Generator Consumption -->
                            <div class="col-12 col-md-3 mb-3 d-none">
                                <div class="form-group">
                                    <label for="project-generator-consumption-${generator.toString()}" 
                                        class="form-label">
                                        Consumo da Geradora
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" type="text"
                                            id="project-generator-consumption-${generator.toString()}"
                                            name="project[generator-${generator.toString()}][generator-consumption]"
                                            onchange="return window.handleGeneratorConsumption(this), window.validateInput(this, 1), window.enableBtnAddAddress(this), window.handleGeneratorConsumption(this), window.validateGeneratorConsumption(this)"
                                            onblur="return window.handleGeneratorConsumption(this), window.validateInput(this, 1), window.handleGeneratorConsumption(this), window.validateGeneratorConsumption(this)"
                                            onkeyup="return window.handleGeneratorConsumption(this), window.validateInput(this, 1), window.handleGeneratorConsumption(this), window.validateGeneratorConsumption(this)">
                                        <span class="input-group-text">kWh</span>
                                    </div>
                                    <div class="invalid-feedback" 
                                        id="generator-consumption-${generator.toString()}-feedback-project">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Generator Equipments -->
                        <div class="card mt-4">
                            <div class="card-header border border-gray rounded-0 bg-light bg-gradient p-3 ps-4">
                                <h6 class="mb-0 text-primary" id="equipment-oversizing-info-${generator.toString()}">
                                    Equipamentos
                                    <p class="mb-0 mt-2" 
                                        id="equipment-oversizing-percentage-${generator.toString()}"></p>
                                </h6>
                            </div>
                            <div class="card-body border border-gray rounded-bottom border-top-0 pt-4 pb-0">
                                <div class="row mb-4">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="col-7 text-center">Produto</th>
                                                    <th scope="col" class="text-center">Quantidade</th>
                                                    <th scope="col" class="text-center">Datasheet</th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-0" id="generator-equipments-${generator.toString()}">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-none" data-beneficiaries>
                            <div class="accordion" id="cc-beneficiaries-${generator.toString()}">
                                <div class="accordion-item"
                                    id="beneficiary-${generator.toString()}-1"
                                    data-beneficiary-item>
                                    <h2 class="accordion-header d-flex"
                                        id="beneficiary-heading-${generator.toString()}-1">
                                        <button type="button" class="accordion-button fw-bold rounded-0 rounded-start"  
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#beneficiary-collapse-${generator.toString()}-1"
                                            aria-expanded="true"
                                            aria-controls="beneficiary-collapse-${generator.toString()}-1">
                                            Beneficiária 1
                                        </button>
                                    </h2>
                                    <div id="beneficiary-collapse-${generator.toString()}-1"
                                        class="accordion-collapse collapse show" 
                                        aria-labelledby="beneficiary-heading-${generator.toString()}-1" 
                                        data-bs-parent="#cc-beneficiaries-${generator.toString()}">
                                        <div class="accordion-body">
                                            <div class="row mt-3 d-none"
                                                id="beneficiary-client-${generator.toString()}-1">
                                                <div class="col-12 mb-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="chk-add-beneficiary-client-${generator.toString()}-1"
                                                            onchange="return window.checkIfAddClientBeneficiary(this)">
                                                        <label class="form-check-label" 
                                                            for="chk-add-beneficiary-client-${generator.toString()}-1">
                                                            Cliente diferente da Geradora?
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Beneficiary Client -->
                                                    <div class="col-12 col-md-6 mb-3 d-none" 
                                                        id="client-beneficiary-${generator.toString()}-1">
                                                        <div class="form-group">
                                                            <label for="project-beneficiary-client-${generator.toString()}-1" class="form-label">
                                                                Cliente
                                                            </label>
                                                            <input class="form-control" type="text"
                                                                id="project-beneficiary-client-${generator.toString()}-1" name="project[generator-${generator.toString()}][beneficiaries][address-1][beneficiary-client]"
                                                                onfocus="return window.autocomplete(this, clients)">
                                                            <div class="invalid-feedback"
                                                                id="client-beneficiary-${generator.toString()}-1-feedback-project"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Beneficiary Contract Account -->
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div id="beneficiary-contract-account-input-${generator.toString()}-1">
                                                        <div class="form-group">
                                                            <label for="project-cc-beneficiary-input-${generator.toString()}-1" class="form-label">
                                                                Conta Contrato Beneficiária
                                                            </label>
                                                            <input class="form-control" type="text" 
                                                                id="project-cc-beneficiary-input-${generator.toString()}-1"
                                                                name="project[generator-${generator.toString()}][beneficiaries][address-1][beneficiary-contract-account]"
                                                                onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"
                                                                onblur="return window.validateInput(this, 1)"
                                                                onkeyup="return window.validateInput(this, 1)"
                                                                maxlength="12"
                                                                data-beneficiary>
                                                            <div class="invalid-feedback" 
                                                                id="cc-beneficiary-input-${generator.toString()}-1-feedback-project"></div>
                                                        </div>
                                                    </div>
                                                    <div id="beneficiary-contract-account-select-${generator.toString()}-1">
                                                        <div class="form-group">
                                                            <label for="project-cc-beneficiary-select-${generator.toString()}-1" class="form-label">
                                                                Conta Contrato Beneficiária
                                                            </label>
                                                            <select class="form-select" 
                                                                aria-label="project-cc-beneficiary-select-${generator.toString()}-1"
                                                                id="project-cc-beneficiary-select-${generator.toString()}-1"
                                                                name="project[generator-${generator.toString()}][beneficiaries][address-1][beneficiary-contract-account]"
                                                                onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"
                                                                onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)">
                                                                <option value="" disabled selected>
                                                                    Selecione a conta contrato
                                                                </option>
                                                            </select>
                                                            <div class="invalid-feedback"
                                                                id="cc-beneficiary-select-${generator.toString()}-1-feedback-project"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Other beneficiary contract account -->
                                                <div class="col-12 col-md-6 mb-3 d-none"
                                                    id="other-beneficiary-contract-account-${generator.toString()}-1">
                                                    <div class="form-group">
                                                        <label for="project-other-cc-beneficiary-${generator.toString()}-1" class="form-label">
                                                            Outra Conta Contrato Beneficiária
                                                        </label>
                                                        <input class="form-control" type="text" 
                                                            id="project-other-cc-beneficiary-${generator.toString()}-1"
                                                            name="project[generator-${generator.toString()}][beneficiaries][address-1][beneficiary-other-contract-account]"
                                                            onchange="return window.validateInput(this, 1)"
                                                            onblur="return window.validateInput(this, 1)"
                                                            onkeyup="return window.validateInput(this, 1)"
                                                            maxlength="12">
                                                        <div class="invalid-feedback" 
                                                            id="cc-other-beneficiary-${generator.toString()}-1-feedback-project">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Consumption Class -->
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="project-beneficiary-consumption-class-${generator.toString()}-1" class="form-label">
                                                            Classe de Consumo
                                                        </label>
                                                        <select class="form-select" 
                                                            aria-label="project-beneficiary-consumption-class-${generator.toString()}-1"
                                                            id="project-beneficiary-consumption-class-${generator.toString()}-1"
                                                            name="project[generator-${generator.toString()}][beneficiaries][address-1][beneficiary-consumption-class]"
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
                                                            id="beneficiary-consumption-class-${generator.toString()}-1-feedback-project">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Rate -->
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="project-beneficiary-rate-${generator.toString()}-1"
                                                            class="form-label">
                                                            Rateio
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text"
                                                                id="project-beneficiary-rate-${generator.toString()}-1"
                                                                name="project[generator-${generator.toString()}][beneficiaries][address-1][beneficiary-rate]"
                                                                onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"
                                                                onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                                data-beneficiary>
                                                            <span class="input-group-text rounded-end">
                                                                %
                                                            </span>
                                                            <span class="input-group-text bg-secondary text-white ms-4 rounded"
                                                                id="rate-monthly-avg-generation-${generator.toString()}-1"></span>
                                                        </div>
                                                        <div class="invalid-feedback" 
                                                            id="beneficiary-rate-${generator.toString()}-1-feedback-project"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Address -->
                                                <div class="col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="project-beneficiary-address-${generator.toString()}-1" class="form-label">
                                                            Endereço
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            id="project-beneficiary-address-${generator.toString()}-1"
                                                            name="project[generator-${generator.toString()}][beneficiaries][address-1][beneficiary-address]"
                                                            onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"
                                                            onblur="return window.validateInput(this, 2)"
                                                            onkeyup="return window.validateInput(this, 2)"
                                                            data-beneficiary>
                                                        <div class="invalid-feedback" 
                                                            id="beneficiary-address-${generator.toString()}-1-feedback-project"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- button Add Beneficiary -->
                            <div class="row justify-content-end mt-4 mb-4">
                                <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-end">
                                    <div class="form-group">
                                        <button class="btn btn-warning d-flex justify-content-center 
                                            align-items-center btn-add-beneficiary" type="button"
                                            id="btn-add-beneficiary-${generator.toString()}"
                                            onclick="return window.addCCBeneficiary(this)"
                                            disabled>
                                            <i class="bi bi-plus me-1"></i>
                                            Adicionar Beneficiária
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    );

    /** Generator Equipments */
    const generatorEquipments = document.querySelector(`#generator-equipments-${generator.toString()}`);

    equipments.forEach((equipment, index) => {
        const hasDatasheet = (equipment.datasheet_path === null) ? "disabled" : "";

        generatorEquipments.insertAdjacentHTML("beforeend", `
            <tr>
                <input type="hidden" 
                    name="project[generator-${generator.toString()}][equipments][equipment-${index + 1}][equipment-id]"
                    value="${equipment.id}">
                <input type="hidden" 
                    name="project[generator-${generator.toString()}][equipments][equipment-${index + 1}][type]"
                    value="${equipment.type}">
                <td class="pt-4">
                    <span>
                        ${equipment.name}
                    </span>
                    <input class="form-control" type="hidden"
                        id="equipment-name-${equipment.category}-${generator.toString()}-${index + 1}"
                        name="project[generator-${generator.toString()}][equipments][equipment-${index + 1}][name]"
                        value="${equipment.name}"
                        readonly>
                </td>
                <td class="form-group pt-4">
                    <select class="form-select" 
                        aria-label="equipment-quantity-${equipment.category}-${generator.toString()}-${index + 1}"
                        id="equipment-quantity-${equipment.category}-${generator.toString()}-${index + 1}"
                        name="project[generator-${generator.toString()}][equipments][equipment-${index + 1}][quantity]"
                        onchange="return window.validateSelect(this, 1), window.validateEquipmentQuantity(this),  window.getOversizingInfo(this)"
                        onblur="return window.validateSelect(this, 1), window.validateEquipmentQuantity(this),  window.getOversizingInfo(this)"
                        data-equipment-${equipment.category}="${equipment.name}">
                        <option value="" disabled selected>
                            Selecione a quantidade
                        </option>
                    </select>
                    <span class="invalid-feedback" 
                        id="equipment-quantity-${equipment.category}-${generator.toString()}-${index + 1}-feedback-project"></span>
                </td>
                <td class="text-center pt-4">
                    <a href="${equipment.url}" target="_blank"
                        class="btn bg-primary text-white ${hasDatasheet}">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                    </a>
                </td>
            </tr>
        `);

        // Add options to equipment quantity select
        const moduleQuantitySelect = document.querySelector(`#equipment-quantity-generator-${generator.toString()}-${index + 1}`);
        const inverterQuantitySelect = document.querySelector(`#equipment-quantity-inverter-${generator.toString()}-${index + 1}`);

        for (let i = 0; i <= equipment.quantity; i++) {
            if (equipment.category === "generator") {
                moduleQuantitySelect.insertAdjacentHTML("beforeend", `<option value="${i}">${i}</option>`);
            }

            else if (equipment.category === "inverter") {
                inverterQuantitySelect.insertAdjacentHTML("beforeend", `<option value="${i}">${i}</option>`);
            }
        }

        // Modules
        if (moduleQuantitySelect !== null) {
            moduleQuantitySelect.selectedIndex = ((Number(equipment.quantity) + 1) - [...document.querySelectorAll(`[data-equipment-generator='${equipment.name}']`)].reduce((acc, curr) => {
                return acc + Number(curr.options[curr.selectedIndex].value);
            }, 0));

            window.validateEquipmentQuantity(moduleQuantitySelect);
        }

        // Inverters
        if (inverterQuantitySelect !== null) {
            inverterQuantitySelect.selectedIndex = ((Number(equipment.quantity) + 1) - [...document.querySelectorAll(`[data-equipment-inverter='${equipment.name}']`)].reduce((acc, curr) => {
                return acc + Number(curr.options[curr.selectedIndex].value);
            }, 0));

            window.validateEquipmentQuantity(inverterQuantitySelect);
        }

        window.getOversizingInfo(document.querySelector(`#equipment-oversizing-info-${generator.toString()}`));
    });

    // Mask
    $(`#project-cep-${generator.toString()}`).mask("00000-000");
    $(`#project-cc-generator-input-${generator.toString()}`).mask("0#");
    $(`#project-other-cc-generator-${generator.toString()}`).mask("0#");
    $(`#project-generator-consumption-${generator.toString()}`).mask("#####9V##", {
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
    $(`#project-cc-beneficiary-input-${generator.toString()}-1`).mask("0#");
    $(`#project-other-cc-beneficiary-${generator.toString()}-1`).mask("0#");
    $(`#project-beneficiary-rate-${generator.toString()}-1`).mask("##9V##", {
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
    const generatorContractAccountInput = document.querySelector(`#generator-contract-account-input-${generator.toString()}`);
    const generatorContractAccountSelect = document.querySelector(`#generator-contract-account-select-${generator.toString()}`);
    let generatorContractAccount;

    // Beneficiary
    const beneficiaries = document.querySelectorAll(`${addressInformations.id} [data-beneficiaries]`);
    const beneficiaryContractAccountInput = document.querySelector(`#beneficiary-contract-account-input-${generator.toString()}-1`);
    const beneficiaryContractAccountSelect = document.querySelector(`#beneficiary-contract-account-select-${generator.toString()}-1`);
    let beneficiaryContractAccount;

    const projectType = document.querySelector(`#project-type-${generator.toString()}`);
    const rate = document.querySelector(`#project-beneficiary-rate-${generator.toString()}-1`);

    /** Show input or select to add generator contract account */
    if (contractClientLogin !== null && contractClientPassword !== null) {
        // Generator
        generatorContractAccountInput.classList.add("d-none");
        generatorContractAccountSelect.classList.remove("d-none");
        generatorContractAccount = document.querySelector(`#project-cc-generator-select-${generator.toString()}`);
        window.getGeneratorClientContractAccounts(generatorContractAccount, contractClientLogin, contractClientPassword);

        // Beneficiary
        beneficiaryContractAccountInput.classList.add("d-none");
        beneficiaryContractAccountSelect.classList.remove("d-none");
        beneficiaryContractAccount = document.querySelector(`#project-cc-beneficiary-select-${generator.toString()}-1`);
        window.getBeneficiaryClientContractAccounts(beneficiaryContractAccount, contractClientLogin, contractClientPassword);
    }

    else {
        // Generator
        generatorContractAccountInput.classList.remove("d-none");
        generatorContractAccountSelect.classList.add("d-none");

        // Beneficiary
        beneficiaryContractAccountInput.classList.remove("d-none");
        beneficiaryContractAccountSelect.classList.add("d-none");
    }

    window.changeProjectType(projectType);

    beneficiaries.forEach(beneficiary => {
        projectType.selectedIndex > 1 ? beneficiary.classList.remove("d-none") : beneficiary.classList.add("d-none");
    });

    rate.value = 100;
    window.validateBeneficiaryRate(rate);
    window.handleBeneficiaryRate(rate);
}