/** INIT FUNCTIONS */
$(document).ready(function () {
    const projectType = document.querySelector("#project-type-1");
    let generatorContractAccount;
    let beneficiaryContractAccount;
    const rate = document.querySelector("#project-beneficiary-rate-1-1");

    window.changeProjectType(projectType);

    window.autocomplete(document.querySelector("#project-generator-client-1"), clients);
    window.autocomplete(document.querySelector("#project-beneficiary-client-1-1"), clients);

    // If contract client has login and password
    if (contractClientLogin !== null && contractClientPassword !== null) {
        generatorContractAccount = document.querySelector("#project-cc-generator-select-1");
        beneficiaryContractAccount = document.querySelector("#project-cc-beneficiary-select-1-1");

        window.getGeneratorClientContractAccounts(generatorContractAccount, contractClientLogin, contractClientPassword);
        window.getBeneficiaryClientContractAccounts(beneficiaryContractAccount, contractClientLogin, contractClientPassword);
    }

    window.getOversizingInfo(document.querySelector("#equipment-oversizing-info-1"));

    rate.value = 100;
    window.validateBeneficiaryRate(rate);

    // Mask
    $("#project-cep-1").mask("00000-000");
    $("#project-cc-generator-input-1").mask("0#");
    $("#project-other-cc-generator-1").mask("0#");
    $("#project-generator-consumption-1").mask("#####9V##", {
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
    $("#project-cc-beneficiary-input-1-1").mask("0#");
    $("#project-other-cc-beneficiary-1-1").mask("0#");
    $("#project-beneficiary-rate-1-1").mask("##9V##", {
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
});

/** FUNCTIONS */
/** Autocomplete  */
window.autocomplete = function (inp, arr) {
    let has_items = false;
    let currentFocus;

    $(`#${inp.id}`).on("input", function (e) {
        let a, b, i, val = this.value;
        has_items = false;

        closeAllLists();

        if (!val) {
            $(`#new_${inp.id}`).show();
            $(`#${inp.id}`).addClass("is-invalid");
            $(`#${inp.id}`).next().text("Preencha o campo.");
            $(`#${inp.id}`).next().addClass("is-invalid");
            return false;
        }

        else {
            $(`#new_${inp.id}`).hide();
            $(`#${inp.id}`).next().text("");
            $(`#${inp.id}`).next().removeClass("is-invalid");
        }

        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", `autocomplete-list-${inp.id}`);
        a.setAttribute("class", "autocomplete-items ");

        if (inp.id.split("-")[1] === "beneficiary") {
            a.setAttribute("style", "margin-left: 66px; width:" + $(`#${inp.id}`).parent().width() + "px");
        }

        else a.setAttribute("style", "margin-left: 45px; width:" + $(`#${inp.id}`).parent().width() + "px");

        this.parentNode.appendChild(a);
        const limit = 10;
        let size = 0;

        for (i = 0; i < arr.length; i++) {
            if (arr[i].toLowerCase().includes(val.toLowerCase()) && size < limit) {
                has_items = true;
                size++;

                b = document.createElement("DIV");

                let text = arr[i];
                const reg = new RegExp(`(${val})`, "gi");

                b.innerHTML = text.replace(reg, "<strong>$1</strong>");
                b.innerHTML += `<input type="hidden" value="${arr[i]}">`;

                b.addEventListener("click", function (e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    $(`#${inp.id}`).removeClass("is-invalid");

                    if (inp.id.split("-")[1] === "generator") window.getGeneratorClientCredentials(inp);

                    else {
                        const elemId = inp.id.split("-")[3];
                        window.getBeneficiaryClientCredentials(inp, elemId);
                    }

                    closeAllLists();
                });

                a.appendChild(b);
            }
        }

        if (arr.indexOf(this.value) >= 0) $(`#${inp.id}`).removeClass("is-invalid");

        else {
            if (!has_items || !$(`#${inp.id}`).val()) $(`#new_${inp.id}`).show();
            else $(`#new_${inp.id}`).hide();

            $(`#${inp.id}`).addClass("is-invalid");
        }
    });

    inp.addEventListener("keydown", function (e) {
        let x = document.getElementById(`autocomplete-list-${inp.id}`);

        if (x) x = x.getElementsByTagName("div");

        currentFocus = (typeof currentFocus === "undefined") ? -1 : currentFocus;

        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        }

        else if (e.keyCode == 38) { //up
            currentFocus--;
            addActive(x);
        }

        else if (e.keyCode == 13) {
            e.preventDefault();

            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        if (!x) return false;

        removeActive(x);

        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);

        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        for (let i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        const x = document.getElementsByClassName("autocomplete-items");

        for (let i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) x[i].parentNode.removeChild(x[i]);
        }
    }

    document.addEventListener("click", e => closeAllLists(e.target));
}

/** Handle the project type change and show/hide CC Beneficiaries */
window.changeProjectType = function (el, isBeneficiary = false, beneficiaryId = null) {
    const elemId = el.id.split("-")[2];
    const generatorId = document.querySelector(`#address-${elemId}`).id;
    const installationCep = document.querySelector(`#${generatorId} #project-cep-${elemId}`);
    const installationAddress = document.querySelector(`#${generatorId} #project-address-${elemId}`);
    const installationNumber = document.querySelector(`#${generatorId} #project-number-${elemId}`);
    const installationComplement = document.querySelector(`#${generatorId} #project-complement-${elemId}`);
    const installationNeighborhood = document.querySelector(`#${generatorId} #project-neighborhood-${elemId}`);
    const installationCity = document.querySelector(`#${generatorId} #project-city-${elemId}`);
    const installationState = document.querySelector(`#${generatorId} #project-state-${elemId}`);
    const addressFields = [
        installationCep, installationAddress, installationNumber, installationComplement, installationNeighborhood, installationCity, installationState
    ];
    const generatorContractAccount = document.querySelector(`#${generatorId} #generator-contract-account-select-${elemId}`);
    let contractAccount;
    let hasNotReservedOption;
    let generatorContractedGenerationProduction;
    const generatorConsumption = document.querySelector(`#${generatorId} #project-generator-consumption-${elemId}`);
    const beneficiaries = document.querySelectorAll(`#${generatorId} [data-beneficiaries]`);
    const rates = document.querySelectorAll(`#${generatorId} input[id^="project-beneficiary-rate"]`);
    const ratesMonthlyAvgGeneration = document.querySelectorAll(`#${generatorId} span[id^="rate-monthly-avg-generation"]`);

    // If project type is "Consumo Remoto"
    if (el.selectedIndex === 2) {
        generatorConsumption.closest(".input-group").parentNode.parentNode.classList.remove("d-none");
        generatorConsumption.setAttribute("data-address", true);

        // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
        generatorContractedGenerationProduction = Number(document.querySelector(`#${generatorId} #generator-contracted-generation-production-${elemId}`).value.replace(".", "").replace(",", "."));

        ratesMonthlyAvgGeneration.forEach(generation => {
            rates.forEach(rate => {
                const rateItem = document.querySelector(`#${generatorId} #${rate.id}`);

                if (rate.id.split("-")[3] === generation.id.split("-")[4] && generation !== null && rateItem !== null) {
                    generation.innerText = `${Number(((generatorContractedGenerationProduction - generatorConsumption.value.replace(",", ".")) * rate.value.replace(",", ".")) / 100).toLocaleString("pt-BR", { maximumFractionDigits: 2 })} kWh`;
                }
            });
        });
    }

    else {
        generatorConsumption.closest(".input-group").parentNode.parentNode.classList.add("d-none");
        generatorConsumption.removeAttribute("data-address");

        // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
        generatorContractedGenerationProduction = Number(document.querySelector(`#${generatorId} #generator-contracted-generation-production-${elemId}`).value.replace(".", "").replace(",", "."));

        ratesMonthlyAvgGeneration.forEach(generation => {
            rates.forEach(rate => {
                const rateItem = document.querySelector(`#${generatorId} #${rate.id}`);

                if (rate.id.split("-")[3] === generation.id.split("-")[4] && generation !== null && rateItem !== null) {
                    generation.innerText = `${Number((generatorContractedGenerationProduction * rate.value.replace(",", ".")) / 100).toLocaleString("pt-BR", { maximumFractionDigits: 2 })} kWh`
                }
            });
        });
    }

    // If project type is "Reservado"
    if (el.selectedIndex === 4) {
        $(`#project-cep-${elemId}`).unmask();
        $(`#project-cc-generator-input-${elemId}`).unmask();

        if (!generatorContractAccount.classList.contains("d-none")) {
            contractAccount = document.querySelector(`#${generatorId} #project-cc-generator-select-${elemId}`);

            for (let i = 0; i < contractAccount.options.length; i++) {
                if (contractAccount.options[i].value !== "RESERVADO") hasNotReservedOption = true;
                else hasNotReservedOption = false;
            }

            if (hasNotReservedOption) {
                contractAccount.options[contractAccount.options.length] = new Option("RESERVADO", "RESERVADO", true, true);
                window.validateSelect(contractAccount);
            }
        }

        else {
            contractAccount = document.querySelector(`#${generatorId} #project-cc-generator-input-${elemId}`);
            contractAccount.value = "RESERVADO";
            window.validateInput(contractAccount);
        }

        [...addressFields].forEach(field => field.value = "RESERVADO");
        validateAddressFields(addressFields);
    }

    else {
        if (el.selectedIndex !== 0) {
            $(`#project-cep-${elemId}`).mask("00000-000");
            $(`#project-cc-generator-input-${elemId}`).mask("0#");

            if (!generatorContractAccount.classList.contains("d-none")) {
                contractAccount = document.querySelector(`#${generatorId} #project-cc-generator-select-${elemId}`);

                for (let i = 0; i < contractAccount.options.length; i++) {
                    if (contractAccount.options[i].value === "RESERVADO") hasNotReservedOption = true;
                    else hasNotReservedOption = false;
                }

                if (hasNotReservedOption) {
                    contractAccount.removeChild(contractAccount.options[contractAccount.options.length - 1]);
                    contractAccount.selectedIndex = 0;
                    window.validateSelect(contractAccount);
                }
            }

            else {
                contractAccount = document.querySelector(`#${generatorId} #project-cc-generator-input-${elemId}`);
                window.validateInput(contractAccount);
            }

            validateAddressFields(addressFields);
        }
    }

    beneficiaries.forEach(beneficiary => {
        if (el.selectedIndex === 2 || el.selectedIndex === 3) beneficiary.classList.remove("d-none");
        else beneficiary.classList.add("d-none");
    });

    // Choose Beneficiary Client only if project type is "Geração Compartilhada"
    if (isBeneficiary) {
        const chkAddBeneficiaryClient = document.querySelector(`#${generatorId} #chk-add-beneficiary-client-${elemId}-${beneficiaryId}`);
        const beneficiaryClient = document.querySelector(`#${generatorId} #beneficiary-client-${elemId}-${beneficiaryId}`);
        const beneficiaryContractAccountSelect = document.querySelector(`#${generatorId} #beneficiary-contract-account-select-${elemId}-${beneficiaryId}`);
        const beneficiaryContractAccountInput = document.querySelector(`#${generatorId} #beneficiary-contract-account-input-${elemId}-${beneficiaryId}`);

        if (el.selectedIndex === 3) beneficiaryClient.classList.remove("d-none");

        else {
            beneficiaryClient.classList.add("d-none");
            chkAddBeneficiaryClient.checked = false;
            window.checkIfAddClientBeneficiary(chkAddBeneficiaryClient);
        }

        // Show input or select to add beneficiary contract account
        if (!generatorContractAccount.classList.contains("d-none")) {
            beneficiaryContractAccountSelect.classList.remove("d-none");
            beneficiaryContractAccountInput.classList.add("d-none");
        }

        else {
            beneficiaryContractAccountSelect.classList.add("d-none");
            beneficiaryContractAccountInput.classList.remove("d-none");
        }
    }

    else {
        const chksAddBeneficiaryClient = document.querySelectorAll(`#${generatorId} input[id^="chk-add-beneficiary-client"]`);
        const beneficiariesClients = document.querySelectorAll(`#${generatorId} div[id^="beneficiary-client"]`);
        const beneficiariesContractAccountSelects = document.querySelectorAll(`#${generatorId} div[id^="beneficiary-contract-account-select"]`);
        const beneficiariesContractAccountInputs = document.querySelectorAll(`#${generatorId} div[id^="beneficiary-contract-account-input"]`);

        beneficiariesClients.forEach(client => {
            if (el.selectedIndex === 3) client.classList.remove("d-none");

            else {
                client.classList.add("d-none");
                chksAddBeneficiaryClient.forEach(chk => {
                    chk.checked = false;
                    window.checkIfAddClientBeneficiary(chk);
                });
            }

            // Show input or select to add beneficiary contract account
            if (!generatorContractAccount.classList.contains("d-none")) {
                beneficiariesContractAccountSelects.forEach(select => select.classList.remove("d-none"));
                beneficiariesContractAccountInputs.forEach(input => input.classList.add("d-none"));
            }

            else {
                beneficiariesContractAccountSelects.forEach(select => select.classList.add("d-none"));
                beneficiariesContractAccountInputs.forEach(input => input.classList.remove("d-none"));
            }
        });
    }
}

/** Show input to add generator client */
window.checkIfAddClient = function (el) {
    const elemId = el.id.split("-")[4];
    const generatorId = el.closest("[data-address-item]").id;
    const generatorClient = document.querySelector(`#generator-client-${elemId}`);
    const generatorClientInput = document.querySelector(`#${generatorClient.id} input`);
    const generatorContractAccountSelect = document.querySelector(`#generator-contract-account-select-${elemId}`);
    const generatorContractAccountInput = document.querySelector(`#generator-contract-account-input-${elemId}`);
    const beneficiariesContractAccountSelects = document.querySelectorAll(`#${generatorId} div[id^="beneficiary-contract-account-select"]`);
    const beneficiariesContractAccountInputs = document.querySelectorAll(`#${generatorId} div[id^="beneficiary-contract-account-input"]`);
    const chksAddBeneficiaryClient = document.querySelectorAll(`#${generatorId} input[id^="chk-add-beneficiary-client"]`);
    const otherGeneratorContractAccount = document.querySelector(`#other-generator-contract-account-${elemId}`);

    otherGeneratorContractAccount.classList.add("d-none");

    if (el.checked) generatorClient.classList.remove("d-none");

    else {
        generatorClient.classList.add("d-none");
        generatorClientInput.value = "";
    }

    // Show input or select to add contract account
    if (contractClientLogin !== null && contractClientPassword !== null) {
        const generatorContractAccount = document.querySelector(`#project-cc-generator-select-${elemId}`);
        const beneficiariesContractAccounts = document.querySelectorAll(`#${generatorId} select[id^="project-cc-beneficiary-select"]`);

        // Generator
        generatorContractAccountSelect.classList.remove("d-none");
        generatorContractAccountInput.classList.add("d-none");
        window.getGeneratorClientContractAccounts(generatorContractAccount, contractClientLogin, contractClientPassword);

        // Beneficiaries
        beneficiariesContractAccountSelects.forEach(select => {
            chksAddBeneficiaryClient.forEach(chk => {
                if (!chk.checked) select.classList.remove("d-none");
            });
        });

        beneficiariesContractAccountInputs.forEach(input => {
            chksAddBeneficiaryClient.forEach(chk => {
                if (!chk.checked) input.classList.add("d-none");
            });
        });

        beneficiariesContractAccounts.forEach(contractAccount => {
            chksAddBeneficiaryClient.forEach(chk => {
                if (!chk.checked) {
                    window.getBeneficiaryClientContractAccounts(contractAccount, contractClientLogin, contractClientPassword);
                }
            });
        });
    }

    else {
        // Generator
        generatorContractAccountSelect.classList.add("d-none");
        generatorContractAccountInput.classList.remove("d-none");

        // Beneficiaries
        beneficiariesContractAccountSelects.forEach(select => {
            chksAddBeneficiaryClient.forEach(chk => {
                if (!chk.checked) select.classList.add("d-none");
            });
        });

        beneficiariesContractAccountInputs.forEach(input => {
            chksAddBeneficiaryClient.forEach(chk => {
                if (!chk.checked) input.classList.remove("d-none");
            });
        });
    }
}

/** Get client generator credentials */
window.getGeneratorClientCredentials = async function (el) {
    const elemId = el.id.split("-")[3];
    const generator = el.closest("[data-address-item]").id;
    const generatorContractAccountSelect = document.querySelector(`#generator-contract-account-select-${elemId}`);
    const generatorContractAccountInput = document.querySelector(`#generator-contract-account-input-${elemId}`);
    const generatorContractAccount = document.querySelector(`#project-cc-generator-select-${elemId}`);
    const beneficiariesContractAccountSelects = document.querySelectorAll(`#${generator} div[id^="beneficiary-contract-account-select"]`);
    const beneficiariesContractAccountInputs = document.querySelectorAll(`#${generator} div[id^="beneficiary-contract-account-input"]`);
    const beneficiariesContractAccounts = document.querySelectorAll(`#${generator} select[id^="project-cc-beneficiary-select"]`);
    const chksAddBeneficiaryClient = document.querySelectorAll(`#${generator} input[id^="chk-add-beneficiary-client"]`);
    const otherGeneratorContractAccount = document.querySelector(`#${generator} div[id^="other-generator-contract-account"]`);

    const body = {
        "name": el.value
    };

    const response = await fetch(url_ajax_get_client_credentials, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(body)
    });

    const result = await response.json();

    otherGeneratorContractAccount.classList.add("d-none");

    if (response.ok) {
        const login = result.client["login"];
        const password = result.client["password"];

        if (login !== null && password !== null) {
            // Generator
            generatorContractAccountSelect.classList.remove("d-none");
            generatorContractAccountInput.classList.add("d-none");

            // Remove all select options
            while (generatorContractAccount.options.length > 0) {
                generatorContractAccount.remove(0);
            }

            // Set the first select option
            const selectGeneratorContractAccount = generatorContractAccount.options[generatorContractAccount.options.length] = new Option("Selecione a conta contrato", "", true, true);
            selectGeneratorContractAccount.setAttribute("disabled", true);

            window.getGeneratorClientContractAccounts(generatorContractAccount, login, password);

            // Beneficiaries
            beneficiariesContractAccounts.forEach(contractAccount => {
                chksAddBeneficiaryClient.forEach(chk => {
                    if (!chk.checked) {
                        // Remove all select options
                        while (contractAccount.options.length > 0) {
                            contractAccount.remove(0);
                        }

                        // Set the first select option
                        const selectBeneficiaryContractAccount = contractAccount.options[contractAccount.options.length] = new Option("Selecione a conta contrato", "", true, true);
                        selectBeneficiaryContractAccount.setAttribute("disabled", true);

                        window.getBeneficiaryClientContractAccounts(contractAccount, login, password);
                    }
                });
            });
        }

        else {
            // Generator
            generatorContractAccountSelect.classList.add("d-none");
            generatorContractAccountInput.classList.remove("d-none");

            generatorContractAccount.value = "RESERVADO";
            window.validateInput(generatorContractAccount);

            // Beneficiaries
            beneficiariesContractAccountSelects.forEach(select => {
                chksAddBeneficiaryClient.forEach(chk => {
                    if (!chk.checked) select.classList.add("d-none");
                });
            });

            beneficiariesContractAccountInputs.forEach(input => {
                chksAddBeneficiaryClient.forEach(chk => {
                    if (!chk.checked) input.classList.remove("d-none");
                });
            });
        }
    }

    else {
        // Generator
        generatorContractAccountSelect.classList.add("d-none");
        generatorContractAccountInput.classList.remove("d-none");

        // Beneficiaries
        beneficiariesContractAccountSelects.forEach(select => {
            chksAddBeneficiaryClient.forEach(chk => {
                if (!chk.checked) select.classList.add("d-none");
            });
        });

        beneficiariesContractAccountInputs.forEach(input => {
            chksAddBeneficiaryClient.forEach(chk => {
                if (!chk.checked) input.classList.remove("d-none");
            });
        });
    }
}

/** Get client beneficiary credentials */
window.getBeneficiaryClientCredentials = async function (el, beneficiaryId) {
    const generator = el.id.split("-")[3];
    const beneficiaryContractAccountSelect = document.querySelector(`#beneficiary-contract-account-select-${generator}-${beneficiaryId}`);
    const beneficiaryContractAccountInput = document.querySelector(`#beneficiary-contract-account-input-${generator}-${beneficiaryId}`);
    const beneficiaryContractAccount = document.querySelector(`#project-cc-beneficiary-select-${generator}-${beneficiaryId}`);
    const otherBeneficiaryContractAccount = document.querySelector(`#other-beneficiary-contract-account-${generator}-${beneficiaryId}`);

    const body = {
        "name": el.value
    };

    const response = await fetch(url_ajax_get_client_credentials, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(body)
    });

    const result = await response.json();

    otherBeneficiaryContractAccount.classList.add("d-none");

    if (response.ok) {
        const login = result.client["login"];
        const password = result.client["password"];

        if (login !== null && password !== null) {
            beneficiaryContractAccountSelect.classList.remove("d-none");
            beneficiaryContractAccountInput.classList.add("d-none");

            // Remove all select options
            while (beneficiaryContractAccount.options.length > 0) {
                beneficiaryContractAccount.remove(0);
            }

            // Set the first select option
            const selectBeneficiaryContractAccount = beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Selecione a conta contrato", "", true, true);
            selectBeneficiaryContractAccount.setAttribute("disabled", true);

            window.getBeneficiaryClientContractAccounts(beneficiaryContractAccount, login, password);
        }

        else {
            beneficiaryContractAccountSelect.classList.add("d-none");
            beneficiaryContractAccountInput.classList.remove("d-none");
        }
    }

    else {
        beneficiaryContractAccountSelect.classList.add("d-none");
        beneficiaryContractAccountInput.classList.remove("d-none");
    }
}

/** Get client generator contract accounts */
window.getGeneratorClientContractAccounts = async function (el, login, password) {
    const generator = el.id.split("-")[4];
    const projectType = document.querySelector(`#project-type-${generator}`);
    const generatorContractAccountSelect = document.querySelector(`#generator-contract-account-select-${generator}`);
    const generatorContractAccountInput = document.querySelector(`#generator-contract-account-input-${generator}`);
    const generatorContractAccount = document.querySelector(`#project-cc-generator-select-${generator}`);
    let hasNotReservedOption;

    const url = "http://equatorial.sunnyhouse.com.br/listAccountContracts";
    let body = {
        user: login,
        password: password
    }

    generatorContractAccount.setAttribute("disabled", true);

    // Remove all select options
    while (generatorContractAccount.options.length > 0) {
        generatorContractAccount.remove(0);
    }

    // Set the first select option
    const generatorLoading = generatorContractAccount.options[generatorContractAccount.options.length] = new Option("Carregando...", "", true, true);
    generatorLoading.setAttribute("disabled", true);

    const response = await fetch(url, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(body)
    });

    const result = await response.json();

    if (response.ok) {
        generatorContractAccount.removeAttribute("disabled");

        result.data["login"] = login;
        result.data["password"] = password;

        // Remove all select options
        while (generatorContractAccount.options.length > 0) {
            generatorContractAccount.remove(0);
        }

        // Set the first select option
        const selectGeneratorContractAccount = generatorContractAccount.options[generatorContractAccount.options.length] = new Option("Selecione a conta contrato", "", true, true);
        selectGeneratorContractAccount.setAttribute("disabled", true);

        for (let i = 0; i < result.data["accountContractsCount"]; i++) {
            const address = result.data["accountContracts"][i]["Endereco"];
            const neighborhood = result.data["accountContracts"][i]["Bairro"];

            generatorContractAccount.options[generatorContractAccount.options.length] = new Option(`${Number(result.data["accountContracts"][i]["Numero"])} - ${address.toLowerCase().replace(/(?:^|\s)\S/g, (a) => a.toUpperCase())}, ${neighborhood.toLowerCase().replace(/(?:^|\s)\S/g, (a) => a.toUpperCase())}`, Number(result.data["accountContracts"][i]["Numero"]));
        }

        generatorContractAccount.options[generatorContractAccount.options.length] = new Option("Outra conta contrato", "", false, false);

        if (projectType.selectedIndex === 4) {
            for (let i = 0; i < generatorContractAccount.options.length; i++) {
                if (generatorContractAccount.options[i].value !== "RESERVADO") hasNotReservedOption = true;
                else hasNotReservedOption = false;
            }

            if (hasNotReservedOption) {
                generatorContractAccount.options[generatorContractAccount.options.length] = new Option("RESERVADO", "RESERVADO", true, true);
            }
        }

        window.validateSelect(generatorContractAccount);
    }

    else {
        // If client Equatorial credentials are invalid
        const generatorClient = document.querySelector(`#project-generator-client-${generator}`);

        if (generatorClient.value !== "") {
            generatorClient.previousElementSibling.classList.add("d-flex", "align-items-center");
            generatorClient.previousElementSibling.insertAdjacentHTML("beforeend", `
                <span class="badge bg-danger ms-2" style="font-size: 0.75rem !important">
                    Verificar credenciais inválidas.
                </span>
            `);
        }

        generatorContractAccountSelect.classList.add("d-none");
        generatorContractAccountInput.classList.remove("d-none");
    }
}

/** Get client beneficiary contract accounts */
window.getBeneficiaryClientContractAccounts = async function (el, login, password) {
    const beneficiary = el.id.split("-")[5];
    const generator = el.id.split("-")[4];
    const beneficiaryContractAccountSelect = document.querySelector(`#beneficiary-contract-account-select-${generator}-${beneficiary}`);
    const beneficiaryContractAccountInput = document.querySelector(`#beneficiary-contract-account-input-${generator}-${beneficiary}`);
    const beneficiaryContractAccount = document.querySelector(`#project-cc-beneficiary-select-${generator}-${beneficiary}`);

    const url = "http://equatorial.sunnyhouse.com.br/listAccountContracts";
    let body = {
        user: login,
        password: password
    }

    beneficiaryContractAccountSelect.classList.remove("d-none");
    beneficiaryContractAccountInput.classList.add("d-none");

    // Remove all select options
    while (beneficiaryContractAccount.options.length > 0) {
        beneficiaryContractAccount.remove(0);
    }

    // Set the first select option
    const beneficiaryLoading = beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Carregando...", "", true, true);
    beneficiaryLoading.setAttribute("disabled", true);

    const response = await fetch(url, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(body)
    });

    const result = await response.json();

    if (response.ok) {
        result.data["login"] = login;
        result.data["password"] = password;

        beneficiaryContractAccountSelect.classList.remove("d-none");
        beneficiaryContractAccountInput.classList.add("d-none");

        // Remove all select options
        while (beneficiaryContractAccount.options.length > 0) {
            beneficiaryContractAccount.remove(0);
        }

        // Set the first select option
        const selectBeneficiaryContractAccount = beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Selecione a conta contrato", "", true, true);
        selectBeneficiaryContractAccount.setAttribute("disabled", true);

        for (let i = 0; i < result.data["accountContractsCount"]; i++) {
            const address = result.data["accountContracts"][i]["Endereco"];
            const neighborhood = result.data["accountContracts"][i]["Bairro"];

            beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option(`${Number(result.data["accountContracts"][i]["Numero"])} - ${address.toLowerCase().replace(/(?:^|\s)\S/g, (a) => a.toUpperCase())}, ${neighborhood.toLowerCase().replace(/(?:^|\s)\S/g, (a) => a.toUpperCase())}`, Number(result.data["accountContracts"][i]["Numero"]));
        }

        beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Outra conta contrato", "", false, false);

        window.validateSelect(beneficiaryContractAccount);
    }

    else {
        // If client Equatorial credentials are invalid
        const beneficiaryClient = document.querySelector(`#project-beneficiary-client-${generator}-${beneficiary}`);

        if (beneficiaryClient.value !== "") {
            beneficiaryClient.previousElementSibling.classList.add("d-flex", "align-items-center");
            beneficiaryClient.previousElementSibling.insertAdjacentHTML("beforeend", `
                <span class="badge bg-danger ms-2" style="font-size: 0.75rem !important">
                    Verificar credenciais inválidas.
                </span>
            `);
        }

        beneficiaryContractAccountSelect.classList.add("d-none");
        beneficiaryContractAccountInput.classList.remove("d-none");
    }
}

/** Use the same contract installation address */
window.setSameContractInstallationAddress = function (el) {
    const elemId = el.id.split("-")[4];
    const clientName = (document.querySelector(`#project-generator-client-${elemId}`).value === "") ?
        document.querySelector("#client").innerText :
        document.querySelector(`#project-generator-client-${elemId}`).value;
    const loadingClientAddress = document.querySelector(`#loading-client-address-${elemId}`);
    const chkDefaultAddress = document.querySelector(`#chk-default-address-${elemId}`);
    const btnAddAddress = document.querySelector("#btn-add-address");
    const contractAccountInput = document.querySelector(`#address-${elemId} #generator-contract-account-input-${elemId}`);
    let generatorContractAccount;
    const generatorPower = document.querySelector(`#address-${elemId} #project-generator-power-${elemId}`);
    const installationCep = document.querySelector(`#address-${elemId} #project-cep-${elemId}`);
    const installationAddress = document.querySelector(`#address-${elemId} #project-address-${elemId}`);
    const installationNumber = document.querySelector(`#address-${elemId} #project-number-${elemId}`);
    const installationComplement = document.querySelector(`#address-${elemId} #project-complement-${elemId}`);
    const installationNeighborhood = document.querySelector(`#address-${elemId} #project-neighborhood-${elemId}`);
    const installationCity = document.querySelector(`#address-${elemId} #project-city-${elemId}`);
    const installationState = document.querySelector(`#address-${elemId} #project-state-${elemId}`);
    const addressFields = [
        installationCep, installationAddress, installationNumber, installationComplement, installationNeighborhood, installationCity, installationState
    ];

    if (contractAccountInput.classList.contains("d-none")) {
        generatorContractAccount = document.querySelector(`#address-${elemId} #project-cc-generator-select-${elemId}`);
    }

    else generatorContractAccount = document.querySelector(`#address-${elemId} #project-cc-generator-input-${elemId}`);

    if (el.checked) {
        chkDefaultAddress.setAttribute("disabled", true);
        chkDefaultAddress.previousElementSibling.style.opacity = ".5";
        el.classList.add("d-none");
        el.parentNode.style.paddingLeft = 0;
        loadingClientAddress.classList.remove("d-none");

        if (contractAccountInput.classList.contains("d-none")) {
            if (generatorContractAccount.selectedIndex !== 0 && generatorPower.value !== "") {
                btnAddAddress.removeAttribute("disabled");
            }
        }

        else {
            if (generatorContractAccount.value !== "" && generatorPower.value !== "") {
                btnAddAddress.removeAttribute("disabled");
            }
        }

        const data = {
            "name": clientName
        };

        executeAjaxPopulateAddress(el, loadingClientAddress, data, url_ajax_get_client_address, addressFields);
    }

    else {
        chkDefaultAddress.removeAttribute("disabled");
        chkDefaultAddress.previousElementSibling.style.opacity = "1";
        btnAddAddress.setAttribute("disabled", true);
        resetAddressInformations(addressFields);
    }
}

function executeAjaxPopulateAddress(el, loading, data, url, addressFields) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        },
        url: url,
        type: "GET",
        dataType: "json",
        data: data,
        success: function (resp) {
            el.classList.remove("d-none");
            el.parentNode.style.paddingLeft = "2.5em";
            loading.classList.add("d-none");

            if (resp.status) {
                addressFields.forEach(field => {
                    for (let [key, value] of Object.entries((resp.client))) {
                        if (field.id.split("-")[1] === key) field.value = value.trim();
                    }
                });

                validateAddressFields(addressFields);
            }

            else resetAddressInformations(addressFields);
        },
        error: function (resp) { }
    });
}

/** Use the default generator address */
window.setDefaultGeneratorAddress = function (el) {
    const elemId = el.id.split("-")[3];
    const loadingDefaultAddress = document.querySelector(`#loading-default-address-${elemId}`);
    const chkClientAddress = document.querySelector(`#chk-same-contract-address-${elemId}`);
    const btnAddAddress = document.querySelector("#btn-add-address");
    const contractAccountInput = document.querySelector(`#address-${elemId} #generator-contract-account-input-${elemId}`);
    let generatorContractAccount;
    const generatorPower = document.querySelector(`#address-${elemId} #project-generator-power-${elemId}`);
    const installationCep = document.querySelector(`#address-${elemId} #project-cep-${elemId}`);
    const installationAddress = document.querySelector(`#address-${elemId} #project-address-${elemId}`);
    const installationNumber = document.querySelector(`#address-${elemId} #project-number-${elemId}`);
    const installationComplement = document.querySelector(`#address-${elemId} #project-complement-${elemId}`);
    const installationNeighborhood = document.querySelector(`#address-${elemId} #project-neighborhood-${elemId}`);
    const installationCity = document.querySelector(`#address-${elemId} #project-city-${elemId}`);
    const installationState = document.querySelector(`#address-${elemId} #project-state-${elemId}`);
    const addressFields = [
        installationCep, installationAddress, installationNumber, installationComplement, installationNeighborhood, installationCity, installationState
    ];

    if (contractAccountInput.classList.contains("d-none")) {
        generatorContractAccount = document.querySelector(`#address-${elemId} #project-cc-generator-select-${elemId}`);
    }

    else generatorContractAccount = document.querySelector(`#address-${elemId} #project-cc-generator-input-${elemId}`);

    if (el.checked) {
        chkClientAddress.setAttribute("disabled", true);
        chkClientAddress.previousElementSibling.style.opacity = ".5";
        el.classList.add("d-none");
        el.parentNode.style.paddingLeft = 0;
        loadingDefaultAddress.classList.remove("d-none");

        if (contractAccountInput.classList.contains("d-none")) {
            if (generatorContractAccount.selectedIndex !== 0 && generatorPower.value !== "") {
                btnAddAddress.removeAttribute("disabled");
            }
        }

        else {
            if (generatorContractAccount.value !== "" && generatorPower.value !== "") {
                btnAddAddress.removeAttribute("disabled");
            }
        }

        getDefaultGeneratorAddress(el, loadingDefaultAddress, url_get_default_address, addressFields);
    }

    else {
        chkClientAddress.removeAttribute("disabled");
        chkClientAddress.previousElementSibling.style.opacity = "1";
        btnAddAddress.setAttribute("disabled", true);
        resetAddressInformations(addressFields);
    }
}

/** Get the address of the default generator */
async function getDefaultGeneratorAddress(el, loading, url, addressFields) {
    const response = await fetch(url);
    const result = await response.json();

    if (response.ok) {
        el.classList.remove("d-none");
        el.parentNode.style.paddingLeft = "2.5em";
        loading.classList.add("d-none");

        addressFields.forEach(field => {
            for (let [key, value] of Object.entries((result.address))) {
                if (field.id.split("-")[1] === key) field.value = value.trim();
            }
        });

        validateAddressFields(addressFields);
    }

    else resetAddressInformations(addressFields);
}

function resetAddressInformations(addressFields) {
    addressFields.forEach(field => field.value = "");
    validateAddressFields(addressFields);
}

/** Change the switch if installation address fields are not filled */
window.ifInstallationAddressFieldsValueChanges = function (el) {
    const elemId = el.id.split("-")[2];
    const chkSameInstallationAddress = document.querySelector(`#chk-same-contract-address-${elemId}`);

    chkSameInstallationAddress.checked = false;
}

/** Set a different generator contract account */
window.setDifferentGeneratorContractAccount = function (el) {
    const elemId = el.id.split("-")[4];
    const otherGeneratorContractAccount = document.querySelector(`#other-generator-contract-account-${elemId}`);

    if (el.selectedIndex === (el.length - 1)) otherGeneratorContractAccount.classList.remove("d-none");

    else {
        otherGeneratorContractAccount.classList.add("d-none");
        otherGeneratorContractAccount.value = "";
    }
}

/** Handle the change in the power value of the generator */
window.handleGeneratorPower = function (el) {
    const elemId = el.id.split("-")[3];
    const beneficiariesRate = document.querySelectorAll(`#address-${elemId} input[id^="project-beneficiary-rate"]`);
    const generatorContractedGenerationProduction = document.querySelector(`#generator-contracted-generation-production-${elemId}`);
    const generatorEstimatedGenerationProduction = document.querySelector(`#generator-estimated-generation-production-${elemId}`);
    const avgMonthlyGeneration = document.querySelector("#monthly-avg-generation");
    const totalGeneratorPower = document.querySelector("#total-generator-power");

    // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
    const avgGeneration = Number(avgMonthlyGeneration.innerText) * 1000;
    const totalPower = totalGeneratorPower.innerText.split(" ")[1] === "kWp" ?
        Number(totalGeneratorPower.innerText.split(" ")[0].replace(",", ".") * 1000) :
        Number(totalGeneratorPower.innerText.split(" ")[0]);
    const generatorPower = Number(el.value.replace(",", ".") * 1000);

    generatorContractedGenerationProduction.value = (((avgGeneration / totalPower) * generatorPower) / 1000)
        .toLocaleString("pt-BR", { maximumFractionDigits: 2 });

    // Estimated kWp generation
    generatorEstimatedGenerationProduction.value = ((generatorPower * 116) / 1000)
        .toLocaleString("pt-BR", { maximumFractionDigits: 2 });

    // Beneficiary rate
    beneficiariesRate.forEach(rate => window.handleBeneficiaryRate(rate));
}

/** Handle the change in the consumption value of the generator */
window.handleGeneratorConsumption = function (el) {
    const elemId = el.id.split("-")[3];
    const addressItem = document.querySelector(`#address-${elemId}`);
    const projectType = document.querySelector(`#project-type-${elemId}`);
    const ratesMonthlyAvgGeneration = document.querySelectorAll(`#${addressItem.id} span[id^="rate-monthly-avg-generation"]`);
    const rates = document.querySelectorAll(`#${addressItem.id} input[id^="project-beneficiary-rate"]`);

    if (projectType.selectedIndex === 2) {
        // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
        const generatorContractedGenerationProduction = Number(document.querySelector(`#generator-contracted-generation-production-${elemId}`).value.replace(".", "").replace(",", "."));

        ratesMonthlyAvgGeneration.forEach(generation => {
            rates.forEach(rate => {
                if (rate.id.split("-")[3] === generation.id.split("-")[4]) {
                    generation.innerText = `${Number(((generatorContractedGenerationProduction - el.value.replace(",", ".")) * rate.value.replace(",", ".")) / 100).toLocaleString("pt-BR", { maximumFractionDigits: 2 })} kWh`;
                }
            });
        });
    }
}

/** Show generator power and oversizing percentage if exists */
window.getOversizingInfo = function (el) {
    const generatorId = el.id.split("-")[3];
    const moduleQuantity = document.querySelectorAll(`#address-${generatorId} [data-equipment-generator]`);
    const inverterQuantity = document.querySelectorAll(`#address-${generatorId} [data-equipment-inverter]`);
    const generatorPower = document.querySelector(`#project-generator-power-${generatorId}`);
    const equipmentOversizingPercentage = document.querySelector(`#equipment-oversizing-percentage-${generatorId}`);

    // Modules
    const arrModules = [...equipments].map((equipment) => {
        if (equipment.category === "generator") return equipment.power;
    }).filter(elem => elem !== undefined);

    const power = [...moduleQuantity]
        .map((item, index) => Number(item.options[item.selectedIndex].value) * arrModules[index])
        .reduce((acc, curr) => acc + curr, 0);

    // Inverters
    const arrInverters = [...equipments].map((equipment) => {
        if (equipment.category === "inverter") return equipment.power;
    }).filter(elem => elem !== undefined);

    const oversizing = [...inverterQuantity]
        .map((item, index) => Number(item.options[item.selectedIndex].value) * arrInverters[index] * 1000)
        .reduce((acc, curr) => acc + curr, 0);

    // Generator power
    generatorPower.value = (power / 1000).toLocaleString("pt-BR", { maximumFractionDigits: 2 });
    window.handleGeneratorPower(generatorPower);

    // Oversizing
    if (oversizing > 0) {
        equipmentOversizingPercentage.innerHTML = `<small>(sobredimensionamento de inversor: ${Math.round((power / oversizing) * 100)}%)</small>`;
        equipmentOversizingPercentage.classList.remove("d-none");
    }
}

/** Show input to add beneficiary client */
window.checkIfAddClientBeneficiary = function (el) {
    const beneficiary = el.id.split("-")[5];
    const generator = el.closest("[data-address-item]").id.split("-")[1];
    const generatorContractAccount = document.querySelector(`#generator-contract-account-select-${generator}`);
    const generatorChkAddClient = document.querySelector(`#chk-add-generator-client-${generator}`);
    const generatorClient = document.querySelector(`#project-generator-client-${generator}`);
    const beneficiaryClient = document.querySelector(`#client-beneficiary-${generator}-${beneficiary}`);
    const beneficiaryClientInput = document.querySelector(`#${beneficiaryClient.id} input`);
    const beneficiaryContractAccountSelect = document.querySelector(`#beneficiary-contract-account-select-${generator}-${beneficiary}`);
    const beneficiaryContractAccountInput = document.querySelector(`#beneficiary-contract-account-input-${generator}-${beneficiary}`);
    const otherBeneficiaryContractAccount = document.querySelector(`#other-beneficiary-contract-account-${generator}-${beneficiary}`);

    otherBeneficiaryContractAccount.classList.add("d-none");

    if (el.checked) beneficiaryClient.classList.remove("d-none");

    else {
        beneficiaryClient.classList.add("d-none");
        beneficiaryClientInput.value = "";
    }

    // Show input or select to add beneficiary contract account
    if (!generatorContractAccount.classList.contains("d-none")) {
        const beneficiaryContractAccount = document.querySelector(`#project-cc-beneficiary-select-${generator}-${beneficiary}`);

        if (generatorChkAddClient.checked) window.getBeneficiaryClientCredentials(generatorClient, elemId);

        else {
            window.getBeneficiaryClientContractAccounts(beneficiaryContractAccount, contractClientLogin, contractClientPassword);
        }
    }

    else {
        beneficiaryContractAccountSelect.classList.add("d-none");
        beneficiaryContractAccountInput.classList.remove("d-none");
    }
}

/** Set a different beneficiary contract account */
window.setDifferentBeneficiaryContractAccount = function (el) {
    const generator = el.id.split("-")[4];
    const beneficiary = el.id.split("-")[5];
    const otherBeneficiaryContractAccount = document.querySelector(`#other-beneficiary-contract-account-${generator}-${beneficiary}`);

    if (el.selectedIndex === (el.length - 1)) otherBeneficiaryContractAccount.classList.remove("d-none");

    else {
        otherBeneficiaryContractAccount.classList.add("d-none");
        otherBeneficiaryContractAccount.value = "";
    }
}

/** Handle the change in the rate value of the beneficiary */
window.handleBeneficiaryRate = function (el) {
    const beneficiary = el.id.split("-")[4];
    const addressItem = el.closest("[data-address-item]");
    const generator = addressItem.id.split("-")[1];
    const projectType = document.querySelector(`#${addressItem.id} #project-type-${generator}`);
    let generatorContractedGenerationProduction;
    const generatorConsumption = document.querySelector(`#${addressItem.id} #project-generator-consumption-${generator}`);
    const rateMonthlyAvgGeneration = document.querySelector(`#rate-monthly-avg-generation-${generator}-${beneficiary}`);

    if (projectType.selectedIndex === 2) {
        // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
        generatorContractedGenerationProduction = Number(document.querySelector(`#${addressItem.id} #generator-contracted-generation-production-${generator}`).value.replace(".", "").replace(",", "."));

        rateMonthlyAvgGeneration.innerText = `${Number(((generatorContractedGenerationProduction - generatorConsumption.value.replace(",", ".")) * el.value.replace(",", ".")) / 100).toLocaleString("pt-BR", { maximumFractionDigits: 2 })} kWh`;
    }

    else {
        // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
        generatorContractedGenerationProduction = Number(document.querySelector(`#${addressItem.id} #generator-contracted-generation-production-${generator}`).value.replace(".", "").replace(",", "."));

        rateMonthlyAvgGeneration.innerText = `${Number((generatorContractedGenerationProduction * el.value.replace(",", ".")) / 100).toLocaleString("pt-BR", { maximumFractionDigits: 2 })} kWh`;
    }
}

/** Enable Add Address button only if all field are filled */
window.enableBtnAddAddress = function (el) {
    const btnAddAddress = document.querySelector("#btn-add-address");
    const addressItem = el.closest("[data-address-item]").id;
    const projectType = document.querySelector(`#${addressItem} select[id^="project-type"]`);
    const addressFields = document.querySelectorAll(`#${addressItem} [data-address]`);
    let areAllAddressFieldsFilledIn;
    const contractAccountInput = document.querySelector(`#${addressItem} div[id^="generator-contract-account-input"]`);
    const generatorContractAccountInput = document.querySelector(`#${addressItem} input[id^="project-cc-generator-input"]`);

    if (!contractAccountInput.classList.contains("d-none")) {
        generatorContractAccountInput.setAttribute("data-address", true);
    }

    else generatorContractAccountInput.removeAttribute("data-address");

    areAllAddressFieldsFilledIn = [...addressFields]
        .map(field => field.value === "" ? true : false)
        .every(field => field === false);

    if (!areAllAddressFieldsFilledIn && projectType.selectedIndex === 0) btnAddAddress.setAttribute("disabled", true);
    else btnAddAddress.removeAttribute("disabled");
}

/** Remove a item from address informations */
window.removeAddressItem = function (el) {
    el.parentNode.parentNode.remove();
    const btnAddAddress = document.querySelector("#btn-add-address");
    const addressItem = document.querySelectorAll("[data-address-item]");
    const totalGeneratorPower = document.querySelector("#total-generator-power").innerText.split(" ")[0];
    const totalGeneratorPowerUnity = document.querySelector("#total-generator-power").innerText.split(" ")[1];
    const total = (totalGeneratorPowerUnity === "kWp") ?
        Number(totalGeneratorPower.replace(",", ".") * 1000) :
        Number(totalGeneratorPower);
    const generatorPower = document.querySelector("#project-generator-power-1");
    let quantityModule;
    let quantityInverter;
    const equipmentQuantityModule = document.querySelector("#equipment-quantity-generator-1-1");
    const equipmentQuantityInverter = document.querySelector("#equipment-quantity-inverter-1-2");

    equipments.forEach(equipment => {
        if (equipment.category === "generator") quantityModule = equipment.quantity;
        if (equipment.category === "inverter") quantityInverter = equipment.quantity;
    });

    if (addressItem.length >= 1) btnAddAddress.removeAttribute("disabled");
    if (addressItem.length === 1) {
        generatorPower.value = total;
        equipmentQuantityModule.value = quantityModule;
        equipmentQuantityInverter.value = quantityInverter;
    }

    window.handleGeneratorPower(generatorPower);
    window.validateEquipmentQuantity(equipmentQuantityModule);
    window.validateEquipmentQuantity(equipmentQuantityInverter);
}

/** Enable button only if all field are filled */
window.enableBtnAddBeneficiary = function (el) {
    const addressItem = el.closest("[data-address-item]").id;
    const beneficiaryItem = el.closest("[data-beneficiary-item]").id;
    const btnAddBeneficiary = document.querySelector(`#${addressItem} .btn-add-beneficiary`);
    const beneficiaryFields = document.querySelectorAll(`#${beneficiaryItem} [data-beneficiary]`);
    let areAllBeneficiaryFieldsFilledIn;
    const contractAccountInput = document.querySelector(`#${beneficiaryItem} div[id^="beneficiary-contract-account-input"]`);
    const beneficiaryContractAccountInput = document.querySelector(`#${beneficiaryItem} input[id^="project-cc-beneficiary-input"]`);

    if (!contractAccountInput.classList.contains("d-none")) {
        beneficiaryContractAccountInput.setAttribute("data-beneficiary", true);
    }

    else beneficiaryContractAccountInput.removeAttribute("data-beneficiary");

    areAllBeneficiaryFieldsFilledIn = [...beneficiaryFields]
        .map(field => field.value === "" ? true : false)
        .every(field => field === false);

    if (!areAllBeneficiaryFieldsFilledIn) btnAddBeneficiary.setAttribute("disabled", true);
    else btnAddBeneficiary.removeAttribute("disabled");
}

/** Remove a item from beneficiaries */
window.removeBeneficiaryItem = function (el) {
    const addressItem = el.closest("[data-address-item]").id;
    el.parentNode.parentNode.remove();
    const btnAddBeneficiary = document.querySelector(`#${addressItem} .btn-add-beneficiary`);
    const beneficiaryItem = document.querySelectorAll(`#${addressItem} [data-beneficiary-item]`);
    const ccBeneficiary = document.querySelector(`#${addressItem} [data-beneficiary-item]:first-of-type`);
    const rate = document.querySelector(`#${ccBeneficiary.id} input[id^="project-beneficiary-rate"]:first-of-type`);

    if (beneficiaryItem.length >= 1) btnAddBeneficiary.removeAttribute("disabled");
    if (beneficiaryItem.length === 1) rate.value = 100;

    window.validateBeneficiaryRate(rate);
    window.handleBeneficiaryRate(rate);
}

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** VALIDATIONS */
window.validateClient = function (el) {
    const elemId = el.id.split("-")[2];
    const clientFeedback = document.querySelector(`#client-${elemId}-feedback-project`);

    if (clients.find(elem => elem === el.value)) {
        clientFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(clientFeedback, true);
        return true;
    }

    else {
        clientFeedback.innerText = "Cliente não cadastrado no sistema.";
        validate(el, false);
        validateFeedback(clientFeedback, false);
        return false;
    }
}

window.validateBeneficiaryClient = function (el) {
    const generator = el.id.split("-")[3];
    const beneficiary = el.id.split("-")[4];
    const clientFeedback = document.querySelector(`#client-beneficiary-${generator}-${beneficiary}-feedback-project`);

    if (clients.find(elem => elem === el.value)) {
        clientFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(clientFeedback, true);
        return true;
    }

    else {
        clientFeedback.innerText = "Cliente não cadastrado no sistema.";
        validate(el, false);
        validateFeedback(clientFeedback, false);
        return false;
    }
}

window.validateCep = function (el) {
    const elemId = el.id.split("-")[2];
    const cepFeedback = document.querySelector(`#cep-${elemId}-feedback-project`);

    if (el.value.split("-").join("").length === 0) {
        cepFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(cepFeedback, false);
        return false;
    }

    else if (el.value.split("-").join("").length < 8) {
        cepFeedback.innerText = "Mínimo de 8 dígitos.";
        validate(el, false);
        validateFeedback(cepFeedback, false);
        return false;
    }

    else {
        cepFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(cepFeedback, true);
        return true;
    }
}

window.validateGeneratorConsumption = function (el) {
    const elemId = el.id.split("-")[3];
    const generatorConsumption = Number(el.value.replace(",", "."));
    const generatorConsumptionFeedback = document.querySelector(`#generator-consumption-${elemId}-feedback-project`);
    const projectType = document.querySelector(`#project-type-${elemId}`);
    const rateMonthlyAvgGeneration = document.querySelectorAll("span[id^='rate-monthly-avg-generation']");

    // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
    const generatorContractedGenerationProduction = Number(document.querySelector(`#generator-contracted-generation-production-${elemId}`).value.replace(".", "").replace(",", "."));

    if (el.value.length === 0) {
        generatorConsumptionFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(generatorConsumptionFeedback, false);
        return false;
    }

    else if (el.value.substr(-1) === ",") {
        generatorConsumptionFeedback.innerText = "Digite um valor válido.";
        validate(el, false);
        validateFeedback(generatorConsumptionFeedback, false);
        return false;
    }

    else if (generatorConsumption > generatorContractedGenerationProduction) {
        generatorConsumptionFeedback.innerHTML = "Digite um valor menor que a <span class='fw-bold'>Produção do kWp Contratado</span>.";
        validate(el, false);
        validateFeedback(generatorConsumptionFeedback, false);

        if (projectType.selectedIndex === 2) {
            rateMonthlyAvgGeneration.forEach(generation => generation.innerText = "0 kWh");
        }

        return false;
    }

    else {
        generatorConsumptionFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(generatorConsumptionFeedback, true);
        return true;
    }
}

window.validateEquipmentQuantity = function (el) {
    const elemId = el.id.split("-")[3];
    const elemItem = el.id.split("-")[4];
    const elemType = el.id.split("-")[2];
    const elDataAttr = (elemType === "generator") ? el.dataset.equipmentGenerator : el.dataset.equipmentInverter;
    const equipmentQuantity = document.querySelectorAll(`[data-equipment-${elemType} = '${elDataAttr}']`);
    let quantity;
    const equipmentQuantityFeedback = document.querySelector(`#equipment-quantity-${elemType}-${elemId}-${elemItem}-feedback-project`);

    const sumEquipments = [...equipmentQuantity].reduce((acc, curr) => {
        return acc + Number(curr.options[curr.selectedIndex].value);
    }, 0);

    equipments.forEach(equipment => {
        if (equipment.name.toLowerCase() === elDataAttr.toLowerCase()) quantity = Number(equipment.quantity);
    });

    if (sumEquipments !== quantity) {
        equipmentQuantity.forEach(equipment => {
            equipment.nextElementSibling.innerHTML = "A soma das quantidades deve ser igual à quantidade total do produto.";
            validateFeedback(equipment.nextElementSibling, false);
        });

        return false;
    }

    else if (el.selectedIndex === 0) {
        equipmentQuantityFeedback.innerText = "Selecione uma opção.";
        validateFeedback(equipmentQuantityFeedback, false);
        return false;
    }

    else {
        equipmentQuantity.forEach(equipment => {
            equipment.nextElementSibling.innerHTML = "Formato aceito.";
            validateFeedback(equipment.nextElementSibling, true);
            return true;
        });

        equipmentQuantityFeedback.innerText = "Formato aceito.";
        validateFeedback(equipmentQuantityFeedback, true);
        return true;
    }
}

window.validateBeneficiaryRate = function (el) {
    const beneficiary = el.id.split("-")[4];
    const addressItem = el.closest("[data-address-item]").id;
    const generator = addressItem.split("-")[1];
    const rateFeedback = document.querySelector(`#beneficiary-rate-${generator}-${beneficiary}-feedback-project`);
    const beneficiariesRateInput = document.querySelectorAll(`#${addressItem} input[id^="project-beneficiary-rate"]`);
    const sumBeneficiariesRateInput = [...beneficiariesRateInput].reduce((acc, curr) => {
        return acc + Number(curr.value.replace(",", "."));
    }, 0);

    if (sumBeneficiariesRateInput !== 100) {
        beneficiariesRateInput.forEach(rate => {
            rate.parentNode.nextElementSibling.innerHTML = "A soma das taxas deve ser igual à <span class='fw-bold'>100%</span>.";
            validate(rate, false);
            validateFeedback(rate.parentNode.nextElementSibling, false);
        });

        return false;
    }

    else if (el.value.length === 0) {
        rateFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(rateFeedback, false);
        return false;
    }

    else if (el.value > 100) {
        rateFeedback.innerText = "Digite um valor menor ou igual a 100%";
        validate(el, false);
        validateFeedback(rateFeedback, false);
        return false;
    }

    else if (Number(el.value) === 0) {
        rateFeedback.innerText = "Digite um valor maior que zero.";
        validate(el, false);
        validateFeedback(rateFeedback, false);
        return false;
    }

    else if (el.value.substr(-1) === ",") {
        rateFeedback.innerText = "Digite um valor válido.";
        validate(el, false);
        validateFeedback(rateFeedback, false);
        return false;
    }

    else {
        beneficiariesRateInput.forEach(rate => {
            rate.parentNode.nextElementSibling.innerText = "Formato aceito.";
            validate(rate, true);
            validateFeedback(rate.parentNode.nextElementSibling, true);
        });

        rateFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(rateFeedback, true);
        return true;
    }
}

window.validateInput = function (el, min) {
    const elFeedback = el.closest(".form-group").lastElementChild;

    if (el.value.length === 0) {
        elFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(elFeedback, false);
        return false;
    }

    else if (el.value.length < min) {
        elFeedback.innerText = (min === 1) ? `Mínimo de ${min} caractere.` : `Mínimo de ${min} caracteres.`;
        validate(el, false);
        validateFeedback(elFeedback, false);
        return false;
    }

    else {
        elFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(elFeedback, true);
        return true;
    }
}

window.validateSelect = function (el) {
    const selectFeedback = el.closest(".form-group").lastElementChild;

    if (el.selectedIndex === 0) {
        selectFeedback.innerText = "Escolha uma opção.";

        if (el.id.split("-")[0] !== "equipment") validate(el, false);

        validateFeedback(selectFeedback, false);
        return false;
    }

    else {
        selectFeedback.innerText = "Formato aceito.";

        if (el.id.split("-")[0] !== "equipment") validate(el, true);

        validateFeedback(selectFeedback, true);
        return true;
    }
}

window.fillInAddressFields = async function (el) {
    const elemId = el.id.split("-")[2];
    const projectType = document.querySelector(`#address-${elemId} #project-type-${elemId}`);
    const isValidCep = window.validateCep(el);
    const cepFeedback = document.querySelector(`#address-${elemId} #cep-${elemId}-feedback-project`);
    const installationAddress = document.querySelector(`#address-${elemId} #project-address-${elemId}`);
    const installationNumber = document.querySelector(`#address-${elemId} #project-number-${elemId}`);
    const installationComplement = document.querySelector(`#address-${elemId} #project-complement-${elemId}`);
    const installationNeighborhood = document.querySelector(`#address-${elemId} #project-neighborhood-${elemId}`);
    const installationCity = document.querySelector(`#address-${elemId} #project-city-${elemId}`);
    const installationState = document.querySelector(`#address-${elemId} #project-state-${elemId}`);
    const addressFields = [
        el, installationAddress, installationNumber, installationComplement, installationNeighborhood, installationCity, installationState
    ];

    if (projectType.selectedIndex !== 0 && projectType.selectedIndex !== 4) {
        if (isValidCep) {
            const response = await fetch(`https://viacep.com.br/ws/${el.value}/json/`);
            const result = await response.json();

            if (result.erro) {
                addressFields.forEach(field => field.value = "");

                cepFeedback.innerText = "CEP não encontrado.";
                validate(el, false);
                validateFeedback(cepFeedback, false);
            }

            else {
                cepFeedback.innerText = "Formato aceito.";
                validate(el, true);
                validateFeedback(cepFeedback, true);

                installationAddress.value = result.logradouro;
                installationNeighborhood.value = result.bairro;
                installationCity.value = result.localidade;
                installationState.value = result.uf;
            }
        }

        else addressFields.forEach(field => field.value = "");
    }

    validateAddressFields(addressFields);
}

function validateAddressFields(addressFields) {
    window.validateCep(addressFields[0]);
    window.validateInput(addressFields[1], 2);
    window.validateInput(addressFields[2], 1);
    window.validateInput(addressFields[4], 2);
    window.validateInput(addressFields[5], 2);
    window.validateInput(addressFields[6], 2);
}

function validate(el, value) {
    if (value) {
        el.classList.add("is-valid");
        el.classList.remove("is-invalid");
    }

    else {
        el.classList.add("is-invalid");
        el.classList.remove("is-valid");
    }
}

function validateFeedback(el, value) {
    if (value) {
        el.classList.add("valid-feedback");
        el.classList.remove("invalid-feedback");
        el.style.display = "block"
    }

    else {
        el.classList.add("invalid-feedback");
        el.classList.remove("valid-feedback");
        el.style.display = "block"
    }
}

window.submitFormCreateProject = function () {
    let submit = true;
    const generatorsProjectType = document.querySelectorAll("select[id^='project-type']");
    const chksAddGeneratorClients = document.querySelectorAll("input[id^='chk-add-generator-client']");
    const clients = document.querySelectorAll("input[id^='project-client']");
    const installationCep = document.querySelectorAll("input[id^='project-cep']");
    const installationAddress = document.querySelectorAll("input[id^='project-address']");
    const installationNumber = document.querySelectorAll("input[id^='project-number']");
    const installationNeighborhood = document.querySelectorAll("input[id^='project-neighborhood']");
    const installationCity = document.querySelectorAll("input[id^='project-city']");
    const installationState = document.querySelectorAll("input[id^='project-state']");
    const generatorContractAccountInput = document.querySelectorAll("div[id^='generator-contract-account-input']");
    const generatorContractAccountSelect = document.querySelectorAll("div[id^='generator-contract-account-select']");
    let installationCCGeneratorInput;
    let installationCCGeneratorSelect;
    const generatorOtherContractAccount = document.querySelectorAll("div[id^='other-generator-contract-account']");
    let generatorOtherContractAccountInput;
    const equipmentModules = document.querySelectorAll("select[id^='equipment-quantity-generator']");
    const equipmentInverters = document.querySelectorAll("select[id^='equipment-quantity-inverter']");
    const chksAddBeneficiaryClient = document.querySelectorAll("input[id^='chk-add-beneficiary-client']");
    let installationCCBeneficiaryInput;
    let installationCCBeneficiarySelect;
    let beneficiaryOtherContractAccountInput;

    const isValidProjectType = [...generatorsProjectType].every(type => window.validateSelect(type) ? true : false);
    const isValidCEP = [...installationCep].every(cep => window.validateCep(cep) ? true : false);
    const isValidAddress = [...installationAddress].every(address => window.validateInput(address) ? true : false);
    const isValidNumber = [...installationNumber].every(number => window.validateInput(number) ? true : false);

    const isValidNeighborhood = [...installationNeighborhood].every(neighborhood => {
        return window.validateInput(neighborhood) ? true : false
    });

    const isValidCity = [...installationCity].every(city => window.validateInput(city) ? true : false);
    const isValidState = [...installationState].every(state => window.validateInput(state) ? true : false);

    // Equipments
    const isValidEquipmentModule = [...equipmentModules].every(equipmentModule => {
        return window.validateEquipmentQuantity(equipmentModule) ? true : false
    });

    const isValidEquipmentInverter = [...equipmentInverters].every(equipmentInverter => {
        return window.validateEquipmentQuantity(equipmentInverter) ? true : false
    });

    // Generator Client
    const arrClients = [];

    chksAddGeneratorClients.forEach(chk => {
        clients.forEach(client => {
            if (chk.checked && chk.id.split("-")[3] === client.id.split("-")[2]) arrClients.push(client);
        });
    });

    const isValidClient = arrClients.every(client => window.validateClient(client) ? true : false);

    // Generator contract account via input
    let isValidCCGeneratorInput;

    generatorContractAccountInput.forEach(input => {
        if (!input.classList.contains("d-none")) {
            installationCCGeneratorInput = document.querySelectorAll(`#${input.id} input[id^="project-cc-generator-input"]`);

            isValidCCGeneratorInput = [...installationCCGeneratorInput].every(ccGeneratorInput => {
                return window.validateInput(ccGeneratorInput) ? true : false
            });

            errorFocus();

            if (!isValidCCGeneratorInput) submit = false;
        }
    });

    // Generator contract account via select
    let isValidCCGeneratorSelect;

    generatorContractAccountSelect.forEach(select => {
        if (!select.classList.contains("d-none")) {
            installationCCGeneratorSelect = document.querySelectorAll(`#${select.id} select[id^="project-cc-generator-select"]`);

            isValidCCGeneratorSelect = [...installationCCGeneratorSelect].every(ccGeneratorSelect => {
                return window.validateSelect(ccGeneratorSelect) ? true : false
            });

            errorFocus();

            if (!isValidCCGeneratorSelect) submit = false;
        }
    });

    // Other generator contract account
    let isValidOtherGeneratorContractAccount;

    generatorOtherContractAccount.forEach(div => {
        if (!div.classList.contains("d-none")) {
            generatorOtherContractAccountInput = document.querySelectorAll(`#${div.id} input[id^="project-other-cc-generator"]`);

            isValidOtherGeneratorContractAccount = [...generatorOtherContractAccountInput].every(otherGeneratorCA => {
                return window.validateInput(otherGeneratorCA) ? true : false
            });

            errorFocus();

            if (!isValidOtherGeneratorContractAccount) submit = false;
        }
    });

    generatorsProjectType.forEach(type => {
        const typeId = type.id.split("-")[2];

        // Generator consumption
        if (type.selectedIndex === 2) {
            const installationGeneratorConsumption = document.querySelectorAll(`#project-generator-consumption-${typeId}`);

            const isValidGeneratorConsumption = [...installationGeneratorConsumption].every(generatorConsumption => {
                return window.validateGeneratorConsumption(generatorConsumption) ? true : false
            });

            errorFocus();

            if (!isValidGeneratorConsumption) submit = false;
        }

        if (type.selectedIndex === 3) {
            // Beneficiary Client
            const arrBeneficiariesClients = [];
            let beneficiaryClient;

            chksAddBeneficiaryClient.forEach(chk => {
                if (chk.checked) {
                    beneficiaryClient = document.querySelector(`#project-beneficiary-client-${chk.id.split("-")[4]}-${chk.id.split("-")[5]}`);
                    arrBeneficiariesClients.push(beneficiaryClient);
                }
            });

            const isValidBeneficiaryClient = arrBeneficiariesClients.every(client => {
                return window.validateBeneficiaryClient(client) ? true : false
            });

            errorFocus();

            if (!isValidBeneficiaryClient) submit = false;
        }

        if (type.selectedIndex === 2 || type.selectedIndex === 3) {
            // Beneficiary contract account via input
            const beneficiaryContractAccountInput = document.querySelectorAll(`#address-${typeId} div[id^="beneficiary-contract-account-input"]`);
            let isValidCCBeneficiaryInput;

            beneficiaryContractAccountInput.forEach(input => {
                if (!input.classList.contains("d-none")) {
                    installationCCBeneficiaryInput = document.querySelectorAll(`#${input.id} input[id^="project-cc-beneficiary-input"]`);

                    isValidCCBeneficiaryInput = [...installationCCBeneficiaryInput].every(ccBeneficiaryInput => {
                        return window.validateInput(ccBeneficiaryInput) ? true : false
                    });

                    errorFocus();

                    if (!isValidCCBeneficiaryInput) submit = false;
                }
            });

            // Beneficiary contract account via select
            const beneficiaryContractAccountSelect = document.querySelectorAll(`#address-${typeId} div[id^="beneficiary-contract-account-select"]`);
            let isValidCCBeneficiarySelect;

            beneficiaryContractAccountSelect.forEach(select => {
                if (!select.classList.contains("d-none")) {
                    installationCCBeneficiarySelect = document.querySelectorAll(`#${select.id} select[id^="project-cc-beneficiary-select"]`);

                    isValidCCBeneficiarySelect = [...installationCCBeneficiarySelect].every(ccBeneficiarySelect => {
                        return window.validateSelect(ccBeneficiarySelect) ? true : false
                    });

                    errorFocus();

                    if (!isValidCCBeneficiarySelect) submit = false;
                }
            });

            // Other beneficiary contract account
            const beneficiaryOtherContractAccount = document.querySelectorAll(`#address-${typeId} div[id^="other-beneficiary-contract-account"]`);
            let isValidOtherBeneficiaryCA;

            beneficiaryOtherContractAccount.forEach(div => {
                if (!div.classList.contains("d-none")) {
                    beneficiaryOtherContractAccountInput = document.querySelectorAll(`#${div.id} input[id^="project-other-cc-beneficiary"]`);

                    isValidOtherBeneficiaryCA = [...beneficiaryOtherContractAccountInput].every(otherBeneficiaryCA => {
                        return window.validateInput(otherBeneficiaryCA) ? true : false
                    });

                    errorFocus();

                    if (!isValidOtherBeneficiaryCA) submit = false;
                }
            });

            const beneficiaryConsumptionClass = document.querySelectorAll("select[id^='project-beneficiary-consumption-class']");
            const beneficiaryRate = document.querySelectorAll("input[id^='project-beneficiary-rate']");
            const beneficiaryAddress = document.querySelectorAll("input[id^='project-beneficiary-address']");

            // Beneficiary consumption class
            const arrBeneficiaryConsumptionClass = [];

            beneficiaryConsumptionClass.forEach(consumptionClass => {
                if (!consumptionClass.closest("[data-beneficiaries]").classList.contains("d-none")) {
                    arrBeneficiaryConsumptionClass.push(consumptionClass);
                }
            });

            const isValidBeneficiaryConsumptionClass = arrBeneficiaryConsumptionClass.every(consumptionClass => {
                return window.validateSelect(consumptionClass) ? true : false
            });

            // Beneficiary rate
            const arrBeneficiaryRate = [];

            beneficiaryRate.forEach(rate => {
                if (!rate.closest("[data-beneficiaries]").classList.contains("d-none")) {
                    arrBeneficiaryRate.push(rate)
                }
            });

            const isValidBeneficiaryRate = arrBeneficiaryRate.every(rate => {
                return window.validateBeneficiaryRate(rate) ? true : false
            });

            // Beneficiary address
            const arrBeneficiaryAddress = [];

            beneficiaryAddress.forEach(address => {
                if (!address.closest("[data-beneficiaries]").classList.contains("d-none")) {
                    arrBeneficiaryAddress.push(address)
                }
            });

            const isValidBeneficiaryAddress = arrBeneficiaryAddress.every(address => {
                return window.validateInput(address, 2) ? true : false
            });

            if (!isValidBeneficiaryConsumptionClass) submit = false;
            else if (!isValidBeneficiaryRate) submit = false;
            else if (!isValidBeneficiaryAddress) submit = false;

            errorFocus();
        }
    });

    if (!isValidProjectType) submit = false;
    else if (!isValidClient) submit = false;
    else if (!isValidCEP) submit = false;
    else if (!isValidAddress) submit = false;
    else if (!isValidNumber) submit = false;
    else if (!isValidNeighborhood) submit = false;
    else if (!isValidCity) submit = false;
    else if (!isValidState) submit = false;
    else if (!isValidEquipmentModule) submit = false;
    else if (!isValidEquipmentInverter) submit = false;

    errorFocus();

    return submit;
}