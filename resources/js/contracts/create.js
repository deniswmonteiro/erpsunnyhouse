// INIT
$(document).ready(function () {
    autocomplete(document.querySelector("#contract-seller"), sellers);  // Seller
    autocomplete(document.querySelector("#contract-client"), clients);  // Client
    autocomplete(document.querySelector("#seller-team"), teams);  // Seller Team
    autocomplete(document.querySelector("#contract-payment-bank"), banks);  // Bank

    // Editable Table
    var editableTable = new BSTable("editable-table", {
        $addButton: $("#btn-add-table-row"),
        advanced: {
            columnLabel: "Opções"  // Set the column label to have no text
        }
    });

    editableTable.init();

    // Mask
    $("#seller-phone").mask(window.SPMaskBehavior, spOptions);
    $(["#seller-cep", "#client-cep"]).mask("00000-000");
    $(["#seller-state", "#client-state"]).mask("ZZ", {
        translation: {
            "Z": {
                pattern: /[A-Z]/,
            }
        }
    });
    $("#client-cpf").mask("000.000.000-00", { reverse: true });
    $("#client-corporatecnpj").mask("00.000.000/0000-00", { reverse: true });
    $("#client-phone").mask(window.SPMaskBehavior, spOptions);
    $("#client-login").mask("000.000.000-00", { reverse: true });
    $(["#contract-value", "#contract-payment-cash"]).mask("#.##0,00", { reverse: true });
    $(["#contract-profit-estimate", "#contract-kit-quota", "contract-installation-quota"]).mask("Z##9V##", {
        translation: {
            "Z": {
                pattern: /[\-\+]/,
                optional: true
            },
            "V": {
                pattern: /[\,]/
            },
            "#": {
                pattern: /[0-9]/,
                optional: true
            }
        }
    });
    $(["#create-equipment-generatorpower", "#create-equipment-inverterpower"]).mask("#####9V##", {
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
    $(["#create-equipment-guarantee", "#create-equipment-mppt", "#contract-area", "#contract-monthly-avg-generation", "#contract-payment-quantity"]).mask("0#");
});

/** FUNCTIONS */
/** Autocomplete */
function autocomplete(inp, arr) {
    let hasItems = false;
    let currentFocus;
    let inputType;
    const inputID = (inp.classList.contains("solar-kit")) ? "equipment" : inp.id.split("-")[1];
    const btnCreate = $(`#btn-create-${inputID}`);
    const feedback = $(`#${inp.id}`).closest(".form-group").children().last();

    // Input type
    switch (inputID) {
        case "seller":
            inputType = "Vendedor";
            break;

        case "client":
            inputType = "Cliente";
            break;

        case "team":
            inputType = "Time de Vendas";
            break;

        case "payment":
            inputType = "Banco";
            break;
    }

    // Execute a function when someone writes in the text field
    $(`#${inp.id}`).on("input", function (e) {
        hasItems = false;
        let a, b, i;
        const val = this.value;

        // Close any already open lists of autocompleted values
        closeAllLists();

        if (!val) {
            $(`#new_${inp.id}`).show();

            if (inputID !== "equipment") {
                $(`#${inp.id}`).removeClass("is-valid");
                $(`#${inp.id}`).addClass("is-invalid");

                btnCreate.attr("disabled", true);

                feedback.text("Preencha o campo.");
                feedback.removeClass("valid-feedback");
                feedback.addClass(["invalid-feedback", "d-block"]);
            }

            return false;
        }

        else {
            $(`#new_${inp.id}`).hide();

            if (inputID !== "equipment") {
                $(`#${inp.id}`).removeClass("is-valid");
                $(`#${inp.id}`).addClass("is-invalid");

                btnCreate.removeAttr("disabled");

                feedback.text(`${inputType} não encontrado.`);
                feedback.removeClass("valid-feedback");
                feedback.addClass(["invalid-feedback", "d-block"]);
            }
        }

        currentFocus = -1;

        // Create a DIV element that will contain the items (values)
        a = document.createElement("DIV");
        a.setAttribute("id", `autocomplete-list-${inp.id}`);
        a.setAttribute("class", "autocomplete-items");

        if (inputID === "equipment") {
            a.setAttribute("style", `margin-left: 34px; margin-top: 1px; width: ${$(`#${inp.id}`).parent().width()}px`);
        }

        else if (inputID === "payment") {
            a.setAttribute("style", `margin-left: 24; margin-top: -24px; width: ${$(`#${inp.id}`).parent().width()}px`);
        }

        else {
            a.setAttribute("style", `margin-left: 0; margin-top: 40px; width: ${$(`#${inp.id}`).parent().width()}px`);
        }

        // Append the DIV element as a child of the autocomplete container
        this.parentNode.appendChild(a);

        // For each item in the array
        const limit = 10;
        let size = 0;

        for (i = 0; i < arr.length; i++) {
            // Input item
            const inputItem = (inputID === "client") ? inputItem = arr[i][0] : inputItem = arr[i];

            // Check if the item starts with the same letters as the text field value
            if (inputItem.toLowerCase().includes(val.toLowerCase()) && size < limit) {
                hasItems = true;
                size++;

                // Create a DIV element for each matching element
                b = document.createElement("DIV");

                // Make the matching letters bold
                const text = inputItem;
                const reg = new RegExp(`(${val})`, 'gi');
                b.innerHTML = text.replace(reg, '<strong>$1</strong>');

                // Insert a input field that will hold the current array item's value
                b.innerHTML += `<input type="hidden" value="${arr[i]}">`;

                // Execute a function when someone clicks on the item value (DIV element)
                b.addEventListener("click", function (e) {
                    // Input value
                    const inputValue = (inputID === "client") ?
                        this.getElementsByTagName("input")[0].value.split(",")[0] :
                        this.getElementsByTagName("input")[0].value;

                    // Insert the value for the autocomplete text field
                    inp.value = inputValue;

                    $(`#${inp.id}`).removeClass("is-invalid");
                    $(`#${inp.id}`).addClass("is-valid");

                    if (inputID !== "equipment") {
                        btnCreate.attr("disabled", true);

                        feedback.text("Formato aceito.");
                        feedback.removeClass("invalid-feedback");
                        feedback.addClass("valid-feedback");
                    }

                    // Close the list of autocompleted values (or any other open lists of autocompleted values
                    closeAllLists();
                });

                a.appendChild(b);
            }
        }

        if (arr.indexOf(this.value) >= 0) $(`#${inp.id}`).removeClass("is-invalid");

        else {
            if (!hasItems || !$(`#${inp.id}`).val()) $(`#new_${inp.id}`).show();
            else $(`#new_${inp.id}`).hide();

            $(`#${inp.id}`).addClass("is-invalid");
        }
    });

    // Execute a function presses a key on the keyboard
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(`autocomplete-list-${inp.id}`);

        if (x) x = x.getElementsByTagName("div");
        currentFocus = (typeof currentFocus === "undefined") ? -1 : currentFocus;

        // If the arrow DOWN key is pressed, increase the currentFocus variable
        if (e.keyCode == 40) {
            currentFocus++;

            // And and make the current item more visible
            addActive(x);
        }

        // If the arrow UP key is pressed, decrease the currentFocus variable
        else if (e.keyCode == 38) {
            currentFocus--;

            // And and make the current item more visible
            addActive(x);
        }

        // If the ENTER key is pressed, prevent the form from being submitted
        else if (e.keyCode == 13) {
            e.preventDefault();

            if (currentFocus > -1) {
                // And simulate a click on the "active" item
                if (x) x[currentFocus].click();
            }
        }
    });

    // A function to classify an item as "active"
    function addActive(x) {
        if (!x) return false;

        // Start by removing the "active" class on all items
        removeActive(x);

        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);

        // Add class "autocomplete-active"
        x[currentFocus].classList.add("autocomplete-active");
    }

    // A function to remove the "active" class from all autocomplete items
    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    // Close all autocomplete lists in the document except the one passed as an argument
    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");

        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) x[i].parentNode.removeChild(x[i]);
        }
    }

    // Execute a function when someone clicks in the document
    document.addEventListener("click", (e) => closeAllLists(e.target));
}

/** Insert the field value into the new name field on the modal */
window.handleNameOnNewItemModal = function (el) {
    const elemType = el.id.split("-")[2];
    let nameValue;

    (elemType !== "team") ?
        nameValue = document.querySelector(`#contract-${elemType}`) :
        nameValue = document.querySelector(`#seller-${elemType}`)

    const newItemName = document.querySelector(`#${elemType}-name`);

    newItemName.value = nameValue.value;
}

/** Reset all form fields and validations from modal */
window.resetFormFields = function (el) {
    const modalID = el.closest(".modal").id;
    const fieldsInput = document.querySelectorAll(`#${modalID} [data-input]`);
    const fieldsCheck = document.querySelectorAll(`#${modalID} [data-check]`);

    [...fieldsInput].forEach(input => {
        const inputFeedback = input.closest(".form-group").lastElementChild;

        input.value = "";
        input.classList.remove("is-valid", "is-invalid");
        inputFeedback.classList.remove("is-valid", "is-invalid");
        inputFeedback.innerText = "";
    });

    [...fieldsCheck].forEach(check => check.checked = false);
}

/** Fill in address fields when the CEP is filled */
window.fillInAddressFields = async function (el) {
    const elemItem = el.id.split("-")[0];
    const isValidCep = window.validateCep(el);
    const feedback = el.closest(".form-group").lastElementChild;
    const address = document.querySelector(`#${elemItem}-address`);
    const number = document.querySelector(`#${elemItem}-number`);
    const complement = document.querySelector(`#${elemItem}-complement`);
    const neighborhood = document.querySelector(`#${elemItem}-neighborhood`);
    const city = document.querySelector(`#${elemItem}-city`);
    const state = document.querySelector(`#${elemItem}-state`);
    const addressFields = [
        el, address, number, complement, neighborhood, city, state
    ];
    const addressInformationsLoading = document.querySelector(`#${elemItem}-cep-loading`);

    if (isValidCep && el.value.length > 0) {
        addressInformationsLoading.classList.remove("d-none");

        const response = await fetch(`https://viacep.com.br/ws/${el.value}/json/`);
        const result = await response.json();

        if (result.erro) {
            addressInformationsLoading.classList.add("d-none");
            addressFields.forEach(field => field.value = "");

            feedback.innerText = "CEP não encontrado.";
            validate(el, false);
            validateFeedback(feedback, false);
        }

        else {
            addressInformationsLoading.classList.add("d-none");

            address.value = result.logradouro;
            neighborhood.value = result.bairro;
            city.value = result.localidade;
            state.value = result.uf;

            validateAddressFields(addressFields);
        }
    }

    else addressFields.forEach(field => field.value = "");
}

function validateAddressFields(addressFields) {
    window.validateInput(addressFields[1], 2);
    window.validateInput(addressFields[2], 1);
    window.validateInput(addressFields[3], 1);
    window.validateInput(addressFields[4], 2);
    window.validateInput(addressFields[5], 2);
    window.validateInput(addressFields[6], 2);
}

/** Change client type */
window.checkClientType = function (el) {
    const corporateClient = document.querySelector("#corporate-client");
    const clientCorporateName = document.querySelector("#client-corporatename");
    const clientCorporateNameFeedback = document.querySelector("#client-create-feedback-corporatename");
    const clientCorporateCNPJ = document.querySelector("#client-corporatecnpj");
    const clientCorporateCNPJFeedback = document.querySelector("#client-create-feedback-corporatecnpj");
    const fileCNPJ = document.querySelector("#file-cnpj");
    const fileCNPJFeedback = document.querySelector("#file-cnpj-feedback");
    const fileSocialContract = document.querySelector("#file-socialcontract");
    const fileSocialContractFeedback = document.querySelector("#file-socialcontract-feedback");
    const documentCorporateClient = document.querySelector("#document-corporate-client");
    const clientPassword = document.querySelector("#client-password");

    if (el.checked) {
        corporateClient.classList.remove("d-none");
        clientCorporateName.setAttribute("required", true);
        clientCorporateCNPJ.setAttribute("required", true);
        documentCorporateClient.classList.remove("d-none");

        $("#client-login").mask("00.000.000/0000-00", { reverse: true });

        clientPassword.setAttribute("type", "email");
        clientPassword.classList.remove("date");
    }

    else {
        corporateClient.classList.add("d-none");

        clientCorporateName.removeAttribute("required");
        clientCorporateName.value = "";
        clientCorporateName.classList.remove("is-valid", "is-invalid");
        clientCorporateNameFeedback.innerText = "";
        clientCorporateNameFeedback.classList.remove("is-valid", "is-invalid");

        clientCorporateCNPJ.removeAttribute("required");
        clientCorporateCNPJ.value = "";
        clientCorporateCNPJ.classList.remove("is-valid", "is-invalid");
        clientCorporateCNPJFeedback.innerText = "";
        clientCorporateCNPJFeedback.classList.remove("is-valid", "is-invalid");

        documentCorporateClient.classList.add("d-none");

        fileCNPJ.value = "";
        fileCNPJ.classList.remove("is-valid", "is-invalid");
        fileCNPJFeedback.innerText = "";
        fileCNPJFeedback.classList.remove("is-valid", "is-invalid");

        fileSocialContract.value = "";
        fileSocialContract.classList.remove("is-valid", "is-invalid");
        fileSocialContractFeedback.innerText = "";
        fileSocialContractFeedback.classList.remove("is-valid", "is-invalid");

        $("#client-login").mask("000.000.000-00", { reverse: true });

        clientPassword.setAttribute("type", "date");
        clientPassword.classList.add("date");
    }
}

/** Show inputs to add credentials */
window.checkIfAddCredentials = function (el) {
    const credentials = document.querySelector("#credentials");
    const clientLogin = document.querySelector("#client-login");
    const clientLoginFeedback = document.querySelector("#client-feedback-login-create");
    const clientPassword = document.querySelector("#client-password");
    const clientPasswordFeedback = document.querySelector("#client-feedback-password-create");

    if (el.checked) {
        credentials.classList.remove("d-none");
        clientLogin.setAttribute("required", true);
        clientPassword.setAttribute("required", true);
    }

    else {
        credentials.classList.add("d-none");

        clientLogin.removeAttribute("required");
        clientLogin.value = "";
        clientLogin.classList.remove("is-valid", "is-invalid");
        clientLoginFeedback.innerText = "";
        clientLoginFeedback.classList.remove("is-valid", "is-invalid");

        clientPassword.removeAttribute("required");
        clientPassword.value = "";
        clientPassword.classList.remove("is-valid", "is-invalid");
        clientPasswordFeedback.innerText = "";
        clientPasswordFeedback.classList.remove("is-valid", "is-invalid");
    }
}

/** Show/hide generator section */
window.handleContractType = function (el) {
    const contractGenerator = document.querySelector("#contract-generator");
    const kitInstallationCosts = document.querySelector("#kit-installation-costs");

    // Kit installation costs section
    const contractKitQuota = document.querySelector("#contract-kit-quota");
    const contractKitQuotaFeedback = contractKitQuota.closest(".form-group").lastElementChild;
    const contractInstallationQuota = document.querySelector("#contract-installation-quota");
    const contractInstallationQuotaFeedback = contractInstallationQuota.closest(".form-group").lastElementChild;

    // Solar kit items section
    const contractStructureType = document.querySelector("#contract-structure");
    const contractStructureTypeFeedback = contractStructureType.closest(".form-group").lastElementChild;
    const contractArea = document.querySelector("#contract-area");
    const contractAreaFeedback = contractArea.closest(".form-group").lastElementChild;
    const contractMonthlyAvgGeneration = document.querySelector("#contract-monthly-avg-generation");
    const contractMonthlyAvgGenerationFeedback = contractMonthlyAvgGeneration.closest(".form-group").lastElementChild;

    if (el.selectedIndex === 1) {
        contractGenerator.classList.remove("d-none");
        kitInstallationCosts.classList.remove("d-none");

        // Kit installation costs section
        contractKitQuota.setAttribute("required", true);
        contractInstallationQuota.setAttribute("required", true);

        // Solar kit items section
        contractStructureType.setAttribute("required", true);
        contractStructureType.value = "";
        contractStructureType.classList.remove("is-valid", "is-invalid");
        contractStructureTypeFeedback.innerText = "";
        contractStructureTypeFeedback.classList.remove("is-valid", "is-invalid");

        contractArea.setAttribute("required", true);
        contractArea.value = "";
        contractArea.classList.remove("is-valid", "is-invalid");
        contractAreaFeedback.innerText = "";
        contractAreaFeedback.classList.remove("is-valid", "is-invalid");

        contractMonthlyAvgGeneration.setAttribute("required", true);
        contractMonthlyAvgGeneration.value = "";
        contractMonthlyAvgGeneration.classList.remove("is-valid", "is-invalid");
        contractMonthlyAvgGenerationFeedback.innerText = "";
        contractMonthlyAvgGenerationFeedback.classList.remove("is-valid", "is-invalid");

        window.calculateKitCost();
        window.calculateInstallationCost();
        window.tableIsValid();
    }

    else {
        contractGenerator.classList.add("d-none");
        kitInstallationCosts.classList.add("d-none");

        // Kit installation costs section
        contractKitQuota.removeAttribute("required");
        contractKitQuota.value = 75;
        contractKitQuota.classList.remove("is-valid", "is-invalid");
        contractKitQuotaFeedback.innerText = "";
        contractKitQuotaFeedback.classList.remove("is-valid", "is-invalid");

        contractInstallationQuota.removeAttribute("required");
        contractInstallationQuota.value = 10;
        contractInstallationQuota.classList.remove("is-valid", "is-invalid");
        contractInstallationQuotaFeedback.innerText = "";
        contractInstallationQuotaFeedback.classList.remove("is-valid", "is-invalid");

        // Solar kit items section
        contractStructureType.removeAttribute("required");
        contractStructureType.value = "";
        contractStructureType.classList.remove("is-valid", "is-invalid");
        contractStructureTypeFeedback.innerText = "";
        contractStructureTypeFeedback.classList.remove("is-valid", "is-invalid");

        contractArea.removeAttribute("required");
        contractArea.value = "";
        contractArea.classList.remove("is-valid", "is-invalid");
        contractAreaFeedback.innerText = "";
        contractAreaFeedback.classList.remove("is-valid", "is-invalid");

        contractMonthlyAvgGeneration.removeAttribute("required");
        contractMonthlyAvgGeneration.value = "";
        contractMonthlyAvgGeneration.classList.remove("is-valid", "is-invalid");
        contractMonthlyAvgGenerationFeedback.innerText = "";
        contractMonthlyAvgGenerationFeedback.classList.remove("is-valid", "is-invalid");
    }

    window.calculateProfit();
    window.validateCostPercentage();
}

/** Change Installation Deadline to 90 days after Contract Date */
window.handleInstallationDeadline = function (el) {
    const installationDeadline = document.querySelector("#contract-deadline");
    const contractDate = Date.parse(el.value);
    const installationDeadlineValue = toDateFormat(contractDate + (91 * 24 * 60 * 60 * 1000), "en-us");

    if (el.value !== "" && el.value.length === 10) {
        installationDeadline.value = installationDeadlineValue;
        installationDeadline.setAttribute("min", installationDeadlineValue);
        installationDeadline.classList.remove("is-invalid");
    }
}

/** Calculate Profit from Profit Estimate */
window.calculateProfit = function () {
    const profitEstimate = document.querySelector("#contract-profit-estimate");
    const paymentValue = parseFloat(document.querySelector("#contract-value").value
        .replaceAll(".", "")
        .replace(",", "."));
    const profitEstimateValue = parseFloat(profitEstimate.value.replace(",", ".")) / 100;
    const profit = document.querySelector("#contract-profit");

    isNaN(paymentValue) || isNaN(profitEstimateValue) ?
        profit.value = "" :
        profit.value = (paymentValue * profitEstimateValue).toLocaleString("pt-br", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

    window.validateCostPercentage(profitEstimate);
}

/** Calculate Kit Cost from Kit Quota */
window.calculateKitCost = function () {
    const kitInstallationCosts = document.querySelector("#kit-installation-costs");

    if (!kitInstallationCosts.classList.contains("d-none")) {
        const kitQuota = document.querySelector("#contract-kit-quota");
        const paymentValue = parseFloat(document.querySelector("#contract-value").value
            .replaceAll(".", "")
            .replace(",", "."));
        const kitQuotaValue = parseFloat(kitQuota.value.replace(",", ".")) / 100;
        const kitCost = document.querySelector("#contract-kit-cost");

        isNaN(paymentValue) || isNaN(kitQuotaValue) ?
            kitCost.value = "" :
            kitCost.value = (paymentValue * kitQuotaValue).toLocaleString("pt-br", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

        window.validateCostPercentage(kitQuota);
    }
}

/** Calculate Installation Cost from Installation Quota */
window.calculateInstallationCost = function () {
    const kitInstallationCosts = document.querySelector("#kit-installation-costs");

    if (!kitInstallationCosts.classList.contains("d-none")) {
        const installationQuota = document.querySelector("#contract-installation-quota");
        const paymentValue = parseFloat(document.querySelector("#contract-value").value
            .replaceAll(".", "")
            .replace(",", "."));
        const installationQuotaValue = parseFloat(installationQuota.value.replace(",", ".")) / 100;
        const installationCost = document.querySelector("#contract-installation-cost");

        isNaN(paymentValue) || isNaN(installationQuotaValue) ?
            installationCost.value = "" :
            installationCost.value = (paymentValue * installationQuotaValue).toLocaleString("pt-br", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

        window.validateCostPercentage(installationQuota);
    }
}

window.adjustLabelKitSolar = function (el) {
    let powerTotal = 0;
    let oversizingTotal = 0;
    const equipmentModule = [];
    const equipmentInverter = [];

    setTimeout(function () {
        $(el).closest("tr").find("td").find("input").each(function () {
            $(this).val();
        });

        $(el).closest("tbody").find("tr").each(function () {
            let name = $(this).find("td:nth-child(1)").html();
            let quantity = $(this).find("td:nth-child(2)").html();
            let equipment = getEquipment(name);

            if (typeof equipment !== "undefined") {
                const indexType = 1;

                switch (equipment[indexType]) {
                    case "GENERATOR":
                        equipmentModule.push([equipment, quantity]);
                        break;

                    case "SOLAR_INVERTER":
                        equipmentInverter.push([equipment, quantity]);
                        break;
                }
            }
        });

        equipmentModule.forEach(function (item) {
            let equip = 0;
            let pow = 3;
            let quant = 1;
            let power = item[equip][pow];
            let quantity = item[quant];

            powerTotal = powerTotal + (power * quantity);
        });

        equipmentInverter.forEach(function (item) {
            let equip = 0;
            let pow = 3;
            let quant = 1;
            let power = item[equip][pow] * 1000;  // Convert W to kW
            let quantity = item[quant];

            oversizingTotal = oversizingTotal + (power * quantity);
        });

        if (powerTotal > 0 && oversizingTotal > 0) {
            let oversizingPercentage = (powerTotal / oversizingTotal) * 100;
            let label = "Wp";

            oversizingPercentage = parseFloat(oversizingPercentage).toFixed(0);

            if (powerTotal > 1000) {
                powerTotal = powerTotal / 1000;
                label = "kWp";
            }

            $("#label-generator").html(`Itens do Kit Solar - Gerador ${powerTotal.toString().replace(".", ",")} ${label} <p><small> (sobredimensionamento de inversor: ${oversizingPercentage}%)</small></p>`);
        }

        else $("#label-generator").html("Itens do Kit Solar");

        window.tableIsValid();  // Verify if exists items
    }, 200);
};

window.onEditField = function (el) {
    window.adjustLabelKitSolar(el);

    const editableIndex = 0;
    const index = $(el).parent().index();
    const id = el.id;
    const text = $(`#${id}`).val();

    if (index === editableIndex) {
        // Clear quantity column
        $(el).parent().parent().find("input").last().val("");
        $(el).parent().parent().find("input").last().addClass("is-invalid");

        autocomplete(document.getElementById(id), equipments);

        function exists(products) {
            return products === text;
        }

        const items = equipments.find(exists);

        if (typeof items === "undefined") $(`#${id}`).addClass("is-invalid");
        else $(`#${id}`).removeClass("is-invalid");

        setTimeout(function () {
            const autocompletItems = $(`#autocomplete-list-${id} div`);

            if (text.length > 0 && autocompletItems.length === 0 && $(`#${id}`).hasClass("is-invalid")) {
                if ($(`#button-create-product-${id}`).length < 1) {
                    $(`#${id}`).parent().append(`
                        <button type="button" class="btn btn-warning margin-top"
                            id="button-create-product-${id}"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-create-product"
                            onclick="window.saveInputId('${id}')">
                            Novo Produto
                        </button>
                    `);
                }
            }

            else $(`#button-create-product-${id}`).remove();
        }, 100);
    }

    else {
        // Verify if is empty
        if (!text) $(`#${id}`).addClass("is-invalid");
        else $(`#${id}`).removeClass("is-invalid");
    }
};

window.onDeleteRow = function (el) {
    window.adjustLabelKitSolar(el);

    window.tableIsValid();  // Verify if exists items
};

window.tableIsValid = function (status = true) {
    window.adjustLabelKitSolar($("table > tbody > tr"));

    $("#invalid-table").addClass("d-none");
    $("#invalid-table").text("");

    // Validate by Category
    validationInstall.category.forEach(function (element) {
        if ($("table > tbody > tr").length > 0) {
            let existsCategory = false;
            const categoryValidate = element.name;

            $("table > tbody > tr").each(function (key, val) {
                const value = $(this).find("td:first").text();

                function existsInArray(products) {
                    const name = 0;
                    return products[name] === value;
                }

                const items = equipmentsArray.find(existsInArray);
                const indexType = 1;

                if (typeof items !== "undefined" && items[indexType] === categoryValidate) {
                    existsCategory = true;
                }
            });

            if (!existsCategory) {
                $("#invalid-table").removeClass("d-none");

                let error = $("#invalid-table").html();
                let newError = `
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            <span>${element.error}</span>
                        </div>
                    </div>`;

                error = error + newError;

                $("#invalid-table").html(error);

                status = false;
            }
        }
    });

    return status;
}

function getEquipment(value) {
    function existsInArray(products) {
        let name = 0;

        return products[name] === value;
    }

    return equipmentsArray.find(existsInArray);
}

window.saveInputId = function (id) {
    const equipmentInputID = document.querySelector("#create-equipment-id");

    equipmentInputID.value = id;
};

/** When equipment type is changed */
window.handleEquipmentType = function (el) {
    const equipmentType = el.selectedIndex;
    const equipmentFormFields = getEquipmentFormFields();
    const equipmentFormFieldsToReset = [
        equipmentFormFields[1], equipmentFormFields[2], equipmentFormFields[3], equipmentFormFields[4], equipmentFormFields[5], equipmentFormFields[6], equipmentFormFields[7], equipmentFormFields[8], equipmentFormFields[9], equipmentFormFields[10], equipmentFormFields[11]
    ]

    resetEquipmentForm(equipmentFormFieldsToReset);

    switch (equipmentType) {
        // None
        case 0:
            window.validateSelect(el);
            break;

        // Generator
        case 1:
            // Item
            equipmentFormFields[1].closest(".row").classList.add("d-none");
            equipmentFormFields[1].removeAttribute("required");

            // Module
            equipmentFormFields[2].closest(".row").classList.remove("d-none");
            equipmentFormFields[2].setAttribute("required", true);

            // Producer
            equipmentFormFields[3].closest(".row").classList.remove("d-none");
            equipmentFormFields[3].setAttribute("required", true);

            // Model
            equipmentFormFields[4].closest(".row").classList.add("d-none");
            equipmentFormFields[4].removeAttribute("required");

            // Generator Power
            equipmentFormFields[5].closest(".row").classList.remove("d-none");
            equipmentFormFields[5].setAttribute("required", true);

            // Inverter Power
            equipmentFormFields[6].closest(".row").classList.add("d-none");
            equipmentFormFields[6].removeAttribute("required");

            // MPPT
            equipmentFormFields[7].closest(".row").classList.add("d-none");
            equipmentFormFields[7].removeAttribute("required");

            // Voltage
            equipmentFormFields[8].closest(".row").classList.add("d-none");
            equipmentFormFields[8].removeAttribute("required");

            // Technology
            equipmentFormFields[9].closest(".row").classList.remove("d-none");
            equipmentFormFields[9].setAttribute("required", true);

            // Guarantee
            equipmentFormFields[10].closest(".row").classList.remove("d-none");
            equipmentFormFields[10].setAttribute("required", true);

            // Datasheet
            equipmentFormFields[11].closest(".row").classList.remove("d-none");

            break;

        // Solar Inverter
        case 2:
            // Item
            equipmentFormFields[1].closest(".row").classList.add("d-none");
            equipmentFormFields[1].removeAttribute("required");

            // Module
            equipmentFormFields[2].closest(".row").classList.add("d-none");
            equipmentFormFields[2].removeAttribute("required");

            // Producer
            equipmentFormFields[3].closest(".row").classList.remove("d-none");
            equipmentFormFields[3].setAttribute("required", true);

            // Model
            equipmentFormFields[4].closest(".row").classList.add("d-none");
            equipmentFormFields[4].removeAttribute("required");

            // Generator Power
            equipmentFormFields[5].closest(".row").classList.add("d-none");
            equipmentFormFields[5].removeAttribute("required");

            // Inverter Power
            equipmentFormFields[6].closest(".row").classList.remove("d-none");
            equipmentFormFields[6].setAttribute("required", true);

            // MPPT
            equipmentFormFields[7].closest(".row").classList.remove("d-none");
            equipmentFormFields[7].setAttribute("required", true);

            // Voltage
            equipmentFormFields[8].closest(".row").classList.remove("d-none");
            equipmentFormFields[8].setAttribute("required", true);

            // Technology
            equipmentFormFields[9].closest(".row").classList.add("d-none");
            equipmentFormFields[9].removeAttribute("required");

            // Guarantee
            equipmentFormFields[10].closest(".row").classList.remove("d-none");
            equipmentFormFields[10].setAttribute("required", true);

            // Datasheet
            equipmentFormFields[11].closest(".row").classList.remove("d-none");

            break;

        // String Box
        case 3:
            // Item
            equipmentFormFields[1].closest(".row").classList.add("d-none");
            equipmentFormFields[1].removeAttribute("required");

            // Module
            equipmentFormFields[2].closest(".row").classList.add("d-none");
            equipmentFormFields[2].removeAttribute("required");

            // Producer
            equipmentFormFields[3].closest(".row").classList.remove("d-none");
            equipmentFormFields[3].setAttribute("required", true);

            // Model
            equipmentFormFields[4].closest(".row").classList.remove("d-none");
            equipmentFormFields[4].setAttribute("required", true);

            // Generator Power
            equipmentFormFields[5].closest(".row").classList.add("d-none");
            equipmentFormFields[5].removeAttribute("required");

            // Inverter Power
            equipmentFormFields[6].closest(".row").classList.add("d-none");
            equipmentFormFields[6].removeAttribute("required");

            // MPPT
            equipmentFormFields[7].closest(".row").classList.add("d-none");
            equipmentFormFields[7].removeAttribute("required");

            // Voltage
            equipmentFormFields[8].closest(".row").classList.add("d-none");
            equipmentFormFields[8].removeAttribute("required");

            // Technology
            equipmentFormFields[9].closest(".row").classList.add("d-none");
            equipmentFormFields[9].removeAttribute("required");

            // Guarantee
            equipmentFormFields[10].closest(".row").classList.add("d-none");
            equipmentFormFields[10].removeAttribute("required");

            // Datasheet
            equipmentFormFields[11].closest(".row").classList.remove("d-none");

            break;

        // Cable, Connector, and Other
        default:
            // Item
            equipmentFormFields[1].closest(".row").classList.remove("d-none");
            equipmentFormFields[1].setAttribute("required", true);

            // Module
            equipmentFormFields[2].closest(".row").classList.add("d-none");
            equipmentFormFields[2].removeAttribute("required");

            // Producer
            equipmentFormFields[3].closest(".row").classList.add("d-none");
            equipmentFormFields[3].removeAttribute("required");

            // Model
            equipmentFormFields[4].closest(".row").classList.add("d-none");
            equipmentFormFields[4].removeAttribute("required");

            // Generator Power
            equipmentFormFields[5].closest(".row").classList.add("d-none");
            equipmentFormFields[5].removeAttribute("required");

            // Inverter Power
            equipmentFormFields[6].closest(".row").classList.add("d-none");
            equipmentFormFields[6].removeAttribute("required");

            // MPPT
            equipmentFormFields[7].closest(".row").classList.add("d-none");
            equipmentFormFields[7].removeAttribute("required");

            // Voltage
            equipmentFormFields[8].closest(".row").classList.add("d-none");
            equipmentFormFields[8].removeAttribute("required");

            // Technology
            equipmentFormFields[9].closest(".row").classList.add("d-none");
            equipmentFormFields[9].removeAttribute("required");

            // Guarantee
            equipmentFormFields[10].closest(".row").classList.add("d-none");
            equipmentFormFields[10].removeAttribute("required");

            // Datasheet
            equipmentFormFields[11].closest(".row").classList.remove("d-none");

            break;
    }
}

/** Clear all equipment form fields */
window.clearFormCreateEquipment = function () {
    const equipmentFormFields = getEquipmentFormFields();

    resetEquipmentForm(equipmentFormFields);

    equipmentFormFields[1].closest(".row").classList.add("d-none");  // Item
    equipmentFormFields[2].closest(".row").classList.add("d-none");  // Module
    equipmentFormFields[3].closest(".row").classList.add("d-none");  // Producer
    equipmentFormFields[4].closest(".row").classList.add("d-none");  // Model
    equipmentFormFields[5].closest(".row").classList.add("d-none");  // Generator Power
    equipmentFormFields[6].closest(".row").classList.add("d-none");  // Inverter Power
    equipmentFormFields[7].closest(".row").classList.add("d-none");  // MPPT
    equipmentFormFields[8].closest(".row").classList.add("d-none");  // Voltage
    equipmentFormFields[9].closest(".row").classList.add("d-none");  // Technology
    equipmentFormFields[10].closest(".row").classList.add("d-none");  // Guarantee
    equipmentFormFields[11].closest(".row").classList.add("d-none");  // Datasheet
}

/** Get all equipment form fields */
function getEquipmentFormFields() {
    const equipmentType = document.querySelector("#create-equipment-type");
    const equipmentItem = document.querySelector("#create-equipment-item");
    const equipmentModule = document.querySelector("#create-equipment-module");
    const equipmentProducer = document.querySelector("#create-equipment-producer");
    const equipmentModel = document.querySelector("#create-equipment-model");
    const equipmentGeneratorPower = document.querySelector("#create-equipment-generatorpower");
    const equipmentInverterPower = document.querySelector("#create-equipment-inverterpower");
    const equipmentMPPT = document.querySelector("#create-equipment-mppt");
    const equipmentVoltage = document.querySelector("#create-equipment-voltage");
    const equipmentTechnology = document.querySelector("#create-equipment-technology");
    const equipmentGuarantee = document.querySelector("#create-equipment-guarantee");
    const equipmentDatasheet = document.querySelector("#create-equipment-datasheet");
    const equipmentFormFields = [
        equipmentType, equipmentItem, equipmentModule, equipmentProducer, equipmentModel, equipmentGeneratorPower, equipmentInverterPower, equipmentMPPT, equipmentVoltage, equipmentTechnology, equipmentGuarantee, equipmentDatasheet
    ];

    return equipmentFormFields;
}

/** Reset all equipment form fields and validations */
function resetEquipmentForm(equipmentFormFields) {
    [...equipmentFormFields].forEach(field => {
        const fieldFeedback = field.closest(".form-group").lastElementChild;

        field.value = "";
        field.classList.remove("is-valid", "is-invalid");
        fieldFeedback.classList.remove("is-valid", "is-invalid");
        fieldFeedback.innerText = "";
    });
}

/** When payment type is changed */
window.handlePaymentType = function (el) {
    const paymentType = el.selectedIndex;
    const paymentBank = document.querySelector("#contract-payment-bank");
    const paymentDescription = document.querySelector("#contract-payment-description");
    const paymentCash = document.querySelector("#contract-payment-cash");
    const paymentQuantity = document.querySelector("#contract-payment-quantity");
    const paymentAfter = document.querySelector("#contract-payment-after");
    const paymentFormFieldsToReset = [
        paymentBank, paymentDescription, paymentCash, paymentQuantity
    ];

    resetPaymentForm(paymentFormFieldsToReset);

    if (paymentQuantity.closest(".form-group").parentNode.classList.contains("col-lg-4")) {
        paymentQuantity.closest(".form-group").parentNode.classList.remove("col-lg-4");
        paymentQuantity.closest(".form-group").parentNode.classList.add("col-lg-6");
    }

    if (paymentAfter.classList.contains("col-lg-4")) {
        paymentAfter.classList.remove("col-lg-4");
        paymentAfter.classList.add("col-lg-6");
    }

    switch (paymentType) {
        // None
        case 0:
            window.validateSelect(el);
            break;

        // In Cash
        case 1:
            paymentDescription.closest(".form-group").parentNode.classList.add("d-none");
            paymentDescription.removeAttribute("required");

            paymentCash.closest(".form-group").parentNode.classList.remove("d-none");
            paymentCash.setAttribute("required", true);

            paymentQuantity.closest(".form-group").parentNode.classList.add("d-none");
            paymentQuantity.removeAttribute("required");

            paymentBank.closest(".form-group").parentNode.classList.add("d-none");
            paymentBank.removeAttribute("required");

            paymentAfter.classList.remove("d-none");
            paymentAfter.getElementsByClassName("form-check")[0].classList.add("d-none");

            break;

        // Partial Funding
        case 2:
            paymentDescription.closest(".form-group").parentNode.classList.add("d-none");
            paymentDescription.removeAttribute("required");

            paymentCash.closest(".form-group").parentNode.classList.remove("d-none");
            paymentCash.setAttribute("required", true);
            paymentCash.closest(".form-group").parentNode.classList.add("col-lg-6");

            paymentQuantity.closest(".form-group").parentNode.classList.add("d-none");
            paymentQuantity.removeAttribute("required");

            paymentBank.closest(".form-group").parentNode.classList.remove("d-none");
            paymentBank.setAttribute("required", true);
            paymentBank.closest(".form-group").parentNode.classList.remove("col-lg-12");
            paymentBank.closest(".form-group").parentNode.classList.add("col-lg-6");

            paymentAfter.classList.add("d-none");
            paymentAfter.getElementsByClassName("form-check")[0].classList.add("d-none");

            break;

        // Total Financing
        case 3:
            paymentDescription.closest(".form-group").parentNode.classList.add("d-none");
            paymentDescription.removeAttribute("required");

            paymentCash.closest(".form-group").parentNode.classList.add("d-none");
            paymentCash.removeAttribute("required");

            paymentQuantity.closest(".form-group").parentNode.classList.add("d-none");
            paymentQuantity.removeAttribute("required");

            paymentBank.closest(".form-group").parentNode.classList.remove("d-none");
            paymentCash.setAttribute("required", true);

            paymentAfter.classList.add("d-none");

            break;

        // Company Installments
        case 4:
            paymentDescription.closest(".form-group").parentNode.classList.add("d-none");
            paymentDescription.removeAttribute("required");

            paymentCash.closest(".form-group").parentNode.classList.remove("d-none");
            paymentCash.setAttribute("required", true);

            paymentQuantity.closest(".form-group").parentNode.classList.remove("d-none");
            paymentQuantity.setAttribute("required", true);

            paymentBank.closest(".form-group").parentNode.classList.add("d-none");
            paymentBank.removeAttribute("required");
            paymentBank.closest(".form-group").parentNode.classList.remove("col-lg-12");
            paymentBank.closest(".form-group").parentNode.classList.add("col-lg-6");

            paymentAfter.classList.remove("d-none");
            paymentAfter.getElementsByClassName("form-check")[0].classList.remove("d-none");

            break;

        // Custom
        case 5:
            paymentDescription.closest(".form-group").parentNode.classList.remove("d-none");
            paymentDescription.setAttribute("required", true);

            paymentCash.closest(".form-group").parentNode.classList.add("d-none");
            paymentCash.removeAttribute("required");

            paymentQuantity.closest(".form-group").parentNode.classList.add("d-none");
            paymentQuantity.removeAttribute("required");

            paymentBank.closest(".form-group").parentNode.classList.add("d-none");
            paymentBank.removeAttribute("required");

            paymentAfter.classList.add("d-none");

            break;

        // Default
        default:
            paymentDescription.closest(".form-group").parentNode.classList.add("d-none");
            paymentDescription.removeAttribute("required");

            paymentCash.closest(".form-group").parentNode.classList.add("d-none");
            paymentCash.removeAttribute("required");

            paymentQuantity.closest(".form-group").parentNode.classList.add("d-none");
            paymentQuantity.removeAttribute("required");

            paymentBank.closest(".form-group").parentNode.classList.add("d-none");
            paymentBank.removeAttribute("required");

            paymentAfter.classList.add("d-none");
            paymentAfter.removeAttribute("required");

            break;
    }
}

/** Reset all payment form fields and validations */
function resetPaymentForm(paymentFormFields) {
    [...paymentFormFields].forEach(field => {
        const fieldFeedback = field.closest(".form-group").lastElementChild;

        field.value = "";
        field.classList.remove("is-valid", "is-invalid");
        fieldFeedback.classList.remove("is-valid", "is-invalid");
        fieldFeedback.innerText = "";
    });
}

/** Formats date in milliseconds to "yyyy-mm-dd" or "dd/mm/yyyy" */
function toDateFormat(date, format) {
    date = new Date((parseInt(date)));

    let day = ((date.getDate().toString().length == 1) ?
        "0" + date.getDate().toString() :
        date.getDate().toString());
    let month = parseInt(date.getMonth()) + 1;

    month = ((month.toString().length == 1) ?
        "0" + month.toString() :
        month.toString());

    let year = date.getFullYear();

    switch (format) {
        case "pt-br":
            date = `${day}/${month}/${year}`;
            break;

        case "en-us":
            date = `${year}-${month}-${day}`;
            break;

        default:
            date = `${day}/${month}/${year}`;
            break;
    }

    return date;
}

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** VALIDATIONS */
window.validateInput = function (el, min) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.hasAttribute("required") && el.value.length > 0) {
        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.length < min) {
            feedback.innerText = (min === 1) ? `Mínimo de ${min} caractere.` : `Mínimo de ${min} caracteres.`;
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateDouble = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.hasAttribute("required") && el.value.length > 0) {
        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (Number(el.value.replace(".", "").replace(",", ".")) === 0) {
            feedback.innerText = "Digite um valor maior que zero.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.substr(-1) === ",") {
            feedback.innerText = "Digite um valor válido.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateTextarea = function (el, min, max) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.hasAttribute("required") && el.value.length > 0) {
        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.length < min) {
            feedback.innerText = (min === 1) ? `Mínimo de ${min} caractere.` : `Mínimo de ${min} caracteres.`;
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.length > max) {
            feedback.innerText = `Máximo de ${max} caracteres.`;
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateSelect = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.hasAttribute("required") && el.selectedIndex !== 0) {
        if (el.selectedIndex === 0) {
            feedback.innerText = "Escolha uma opção.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateFieldWithAutoComplete = function (el, arrType) {
    const elemType = el.id.split("-")[1];
    let inputType;
    const feedback = el.closest(".form-group").lastElementChild;

    switch (elemType) {
        case "seller":
            inputType = "Vendedor";
            break;

        case "client":
            inputType = "Cliente";
            break;

        case "payment":
            inputType = "Banco";
            break;
    }

    const typeValue = (elemType === "client") ?
        arrType.find(elem => elem[0] === el.value) :
        arrType.find(elem => elem === el.value);

    if (el.hasAttribute("required") || el.value.length > 0) {
        if (typeValue) {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }

        else if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = `${inputType} não cadastrado no sistema.`;
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateDate = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;
    const min = 8;
    const date = el.value;
    const minDate = el.getAttribute("min");
    const maxDate = el.getAttribute("max");

    if (date.split("-").length < 3) {
        feedback.innerText = "Formato inválido.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (date.split("-")[0].length > 4) {
        feedback.innerText = "O ano deve ter no máximo 4 dígitos.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (date.length < min) {
        feedback.innerText = `Mínimo de ${min} caracteres.`;
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (date < minDate || date > maxDate) {
        feedback.innerText = "Digite uma data válida.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validatePhone = function (el, qty) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.value.length === 0) {
        feedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (el.value.replace(/[^0-9]/g, "").length < qty) {
        feedback.innerText = `Mínimo de ${qty} caracteres.`;
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateEmail = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.value.length === 0) {
        feedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (!/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/.test(el.value)) {
        feedback.innerText = "Formato inválido.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

/** Validate percentage of Profit, Kit and Installation */
window.validateCostPercentage = function () {
    const kitInstallationCosts = document.querySelector("#kit-installation-costs");
    const profitEstimate = document.querySelector("#contract-profit-estimate");

    // If contract type is "Manutenção"
    if (kitInstallationCosts.classList.contains("d-none")) {
        const isValid = window.validatePercentage(profitEstimate);
        return isValid;
    }

    // If contract type is "Instalação de Gerador Solar"
    else {
        const costPercentageInputs = document.querySelectorAll("[data-cost-percentage]");
        const sumCostPercentageInputs = [...costPercentageInputs].reduce((acc, curr) => {
            return acc + Number(curr.value.replace(",", "."));
        }, 0);

        if (sumCostPercentageInputs !== 100) {
            costPercentageInputs.forEach(cost => {
                cost.parentNode.nextElementSibling.innerHTML = "A soma das porcentagens deve ser igual à <span class='fw-bold'>100%</span>.";
                validate(cost, false);
                validateFeedback(cost.parentNode.nextElementSibling, false);
            });

            return false;
        }

        else {
            costPercentageInputs.forEach(cost => window.validatePercentage(cost));
            return true;
        }
    }
}

window.validatePercentage = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.value.length === 0) {
        feedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (el.value.replace(",", ".") > 100) {
        feedback.innerText = "Digite um valor menor ou igual a 100%";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (Number(el.value.replace(",", ".")) === 0) {
        feedback.innerText = "Digite um valor maior que zero.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (el.value.substr(-1) === ",") {
        feedback.innerText = "Digite um valor válido.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateIdentification = function (el, qty) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.value.length === 0) {
        feedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (el.value.replace(/[^0-9]/g, "").length !== qty) {
        feedback.innerText = (qty === 1) ?
            `O campo deve possuir ${qty} caractere.` :
            `O campo deve possuir ${qty} caracteres.`;
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateCep = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.hasAttribute("required") || el.value.length > 0) {
        if (el.value.split("-").join("").length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.split("-").join("").length < 8) {
            feedback.innerText = "Mínimo de 8 dígitos.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateFile = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;
    const mimeTypes = ["application/pdf", "image/jpeg", "image/png"];

    if (el.files[0] !== undefined && mimeTypes.indexOf(el.files[0].type) == -1) {
        feedback.innerText = `O arquivo ${el.files[0].name} não é permitido.`;
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (el.files[0] !== undefined && el.files[0].size > 10 * 1024 * 1024) {
        feedback.innerText = `O arquivo ${el.files[0].name} ultrapassou limite de 10 MB.`;
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateLogin = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;
    const clientType = document.querySelector("#chk-change-client-type");

    if (clientType.checked) {
        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.length < 18) {
            feedback.innerText = "Mínimo de 14 dígitos.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }

    else {
        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.length < 14) {
            feedback.innerText = "Mínimo de 11 dígitos.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }
}

window.validatePassword = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;
    const clientType = document.querySelector("#chk-change-client-type");

    if (clientType.checked) {
        el.removeAttribute("maxlength");

        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.length < 5) {
            feedback.innerText = "Mínimo de 5 dígitos.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (!/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/.test(el.value)) {
            feedback.innerText = "Digite um email válido.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }

    else {
        const min = 8;
        const minDate = el.getAttribute("min");
        const maxDate = el.getAttribute("max");

        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.split("-").length < 3) {
            feedback.innerText = "Digite uma data válida.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.split("-")[0].length > 4) {
            feedback.innerText = "O ano deve ter no máximo 4 dígitos.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.length < min) {
            feedback.innerText = `Mínimo de ${min} caracteres.`;
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value < minDate || el.value > maxDate) {
            feedback.innerText = "Digite um ano válido.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }
    }
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

/** SUBMIT */
/** Create Seller Team */
window.submitCreateSellerTeam = async function (el) {
    let submit = true;
    const modalCreateSellerTeam = document.querySelector("#modal-create-team");
    const teamName = document.querySelector("#team-name");
    const sellerTeam = document.querySelector("#seller-team");
    const btnCreateTeam = document.querySelector("#btn-create-team");
    const sellerTeamFeedback = sellerTeam.closest(".form-group").lastElementChild;

    const isValidTeamName = window.validateInput(teamName, 5);

    if (!isValidTeamName) submit = false;

    errorFocus();

    if (submit) {
        const btnCreateSellerTeamLoading = document.querySelector("#btn-create-team-loading");

        el.setAttribute("disabled", true);
        btnCreateSellerTeamLoading.classList.remove("d-none");

        /** Fetch Seller Team data */
        const body = {
            "name": teamName.value,
        };

        const response = await fetch(url_ajax_store_team, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(body)
        });

        const result = await response.json();

        if (result.status) {
            teams = null;
            teams = result.teams_names;
            autocomplete(document.querySelector("#seller-team"), teams);

            sellerTeam.value = result.team_name;
            sellerTeam.classList.remove("is-invalid");
            sellerTeam.classList.add("is-valid");

            btnCreateTeam.setAttribute("disabled", true);

            sellerTeamFeedback.innerText = "Formato aceito.";
            sellerTeamFeedback.classList.remove("invalid-feedback");
            sellerTeamFeedback.classList.add("valid-feedback", "d-block");

            $("#modal-create-team").modal("hide");
            $("#modal-create-seller").modal("show");

            el.removeAttribute("disabled");
            btnCreateSellerTeamLoading.classList.add("d-none");
        }

        else {
            const modalCreateSellerTeamBody = document.querySelector(`#${modalCreateSellerTeam.id} .modal-body`);

            [...result.message].forEach((message, key) => {
                modalCreateSellerTeamBody.insertAdjacentHTML("afterbegin", `
                    <span class="alert alert-danger alert-dismissible show fade mb-0"
                        id="alert-create-seller-team-${key}">
                        <span class="fw-bold">${message}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            style="top: -1 !important;" 
                            aria-label="Close"></button>
                    </span>
                `);

                alert = document.querySelector(`#alert-create-seller-team-${key}`);
                alert.style.width = "400px";
                alert.style.margin = "0 auto";
                alert.style.display = "block";
            });

            el.removeAttribute("disabled");
            btnCreateSellerTeamLoading.classList.add("d-none");

            $("span.alert")
                .delay(2000)
                .fadeOut(350);
        }
    }
}

/** Create Seller */
window.submitCreateSeller = async function (el) {
    let submit = true;
    const modalCreateSeller = document.querySelector("#modal-create-seller");
    const sellerName = document.querySelector("#seller-name");
    const sellerPhone = document.querySelector("#seller-phone");
    const sellerEmail = document.querySelector("#seller-email");
    const sellerTeam = document.querySelector("#seller-team");
    const sellerCep = document.querySelector("#seller-cep");
    const sellerAddress = document.querySelector("#seller-address");
    const sellerNumber = document.querySelector("#seller-number");
    const sellerComplement = document.querySelector("#seller-complement");
    const sellerNeighborhood = document.querySelector("#seller-neighborhood");
    const sellerCity = document.querySelector("#seller-city");
    const sellerState = document.querySelector("#seller-state");

    const contractSeller = document.querySelector("#contract-seller");
    const btnCreateSeller = document.querySelector("#btn-create-seller");
    const contractSellerFeedback = contractSeller.closest(".form-group").lastElementChild;

    const isValidSellerName = window.validateInput(sellerName, 5);
    const isValidSellerPhone = window.validatePhone(sellerPhone, 10);
    const isValidSellerEmail = window.validateEmail(sellerEmail);
    const isValidSellerTeam = window.validateFieldWithAutoComplete(sellerTeam, teams);
    const isValidSellerCep = window.validateCep(sellerCep);
    const isValidSellerAddress = window.validateInput(sellerAddress, 5);
    const isValidSellerNumber = window.validateInput(sellerNumber, 1);
    const isValidSellerComplement = window.validateInput(sellerComplement, 2);
    const isValidSellerNeighborhood = window.validateInput(sellerNeighborhood, 2);
    const isValidSellerCity = window.validateInput(sellerCity, 2);
    const isValidSellerState = window.validateInput(sellerState, 2);

    if (!isValidSellerName) submit = false;
    if (!isValidSellerPhone) submit = false;
    if (!isValidSellerEmail) submit = false;
    if (!isValidSellerTeam) submit = false;
    if (!isValidSellerCep) submit = false;
    if (!isValidSellerAddress) submit = false;
    if (!isValidSellerNumber) submit = false;
    if (!isValidSellerComplement) submit = false;
    if (!isValidSellerNeighborhood) submit = false;
    if (!isValidSellerCity) submit = false;
    if (!isValidSellerState) submit = false;

    errorFocus();

    if (submit) {
        const btnCreateSellerLoading = document.querySelector("#btn-create-seller-loading");

        el.setAttribute("disabled", true);
        btnCreateSellerLoading.classList.remove("d-none");

        /** Fetch Seller data */
        const body = {
            "name": sellerName.value,
            "phone": sellerPhone.value,
            "email": sellerEmail.value,
            "team": sellerTeam.value,
            "cep": sellerCep.value,
            "address": sellerAddress.value,
            "address-number": sellerNumber.value,
            "complement": sellerComplement.value,
            "neighborhood": sellerNeighborhood.value,
            "city": sellerCity.value,
            "state": sellerState.value,
        };

        const response = await fetch(url_ajax_store_seller, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(body)
        });

        const result = await response.json();

        if (result.status) {
            sellers = null;
            sellers = result.sellers_names;
            autocomplete(document.querySelector("#contract-seller"), result.sellers_names);

            contractSeller.value = result.seller_name;
            contractSeller.classList.remove("is-invalid");
            contractSeller.classList.add("is-valid");

            btnCreateSeller.setAttribute("disabled", true);

            contractSellerFeedback.innerText = "Formato aceito.";
            contractSellerFeedback.classList.remove("invalid-feedback");
            contractSellerFeedback.classList.add("valid-feedback", "d-block");

            $(modalCreateSeller).modal("hide");

            el.removeAttribute("disabled");
            btnCreateSellerLoading.classList.add("d-none");

            window.resetFormFields(el);
        }

        else {
            const modalCreateSellerBody = document.querySelector(`#${modalCreateSeller.id} .modal-body`);

            [...result.message].forEach((message, key) => {
                modalCreateSellerBody.insertAdjacentHTML("afterbegin", `
                    <span class="alert alert-danger alert-dismissible show fade mb-0"
                        id="alert-create-seller-${key}">
                        <span class="fw-bold">${message}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            style="top: -1 !important;" 
                            aria-label="Close"></button>
                    </span>
                `);

                alert = document.querySelector(`#alert-create-seller-${key}`);
                alert.style.width = "400px";
                alert.style.margin = "0 auto";
                alert.style.display = "block";
            });

            el.removeAttribute("disabled");
            btnCreateSellerLoading.classList.add("d-none");

            $("span.alert")
                .delay(2000)
                .fadeOut(350);
        }
    }
}

/** Create Client */
window.submitCreateClient = async function (el) {
    let submit = true;
    const modalCreateClient = document.querySelector("#modal-create-client");
    const chkChangeClientype = document.querySelector("#chk-change-client-type");
    const clientCorporateName = document.querySelector("#client-corporatename");
    const clientCorporateCNPJ = document.querySelector("#client-corporatecnpj");
    const clientName = document.querySelector("#client-name");
    const clientBirth = document.querySelector("#client-birth");
    const clientCPF = document.querySelector("#client-cpf");
    const clientEmail = document.querySelector("#client-email");
    const clientPhone = document.querySelector("#client-phone");
    const fileCNH = document.querySelector("#file-cnh");
    const fileProcuration = document.querySelector("#file-procuration");
    const fileCNPJ = document.querySelector("#file-cnpj");
    const fileSocialContract = document.querySelector("#file-socialcontract");
    const clientCEP = document.querySelector("#client-cep");
    const clientAddress = document.querySelector("#client-address");
    const clientNumber = document.querySelector("#client-number");
    const clientComplement = document.querySelector("#client-complement");
    const clientNeighborhood = document.querySelector("#client-neighborhood");
    const clientCity = document.querySelector("#client-city");
    const clientState = document.querySelector("#client-state");
    const chkAddCredentials = document.querySelector("#chk-add-credentials");
    const clientLogin = document.querySelector("#client-login");
    const clientPassword = document.querySelector("#client-password");

    const contractClient = document.querySelector("#contract-client");
    const btnCreateClient = document.querySelector("#btn-create-client");
    const contractClientFeedback = contractClient.closest(".form-group").lastElementChild;
    const formData = new FormData();

    if (chkChangeClientype.checked) {
        const isValidClientCorporateName = window.validateInput(clientCorporateName, 2);
        const isValidClientCorporateCNPJ = window.validateIdentification(clientCorporateCNPJ, 14);
        const isValidClientFileCNPJ = window.validateFile(fileCNPJ);
        const isValidClientFileSocialContract = window.validateFile(fileSocialContract);

        if (!isValidClientCorporateName) submit = false;
        if (!isValidClientCorporateCNPJ) submit = false;
        if (!isValidClientFileCNPJ) submit = false;
        if (!isValidClientFileSocialContract) submit = false;

        errorFocus();
    }

    const isValidClientName = window.validateInput(clientName, 5);
    const isValidClientBirth = window.validateDate(clientBirth);
    const isValidClientCPF = window.validateIdentification(clientCPF, 11);
    const isValidClientEmail = window.validateEmail(clientEmail);
    const isValidClientPhone = window.validatePhone(clientPhone, 10);
    const isValidFileCNH = window.validateFile(fileCNH);
    const isValidFileProcuration = window.validateFile(fileProcuration);
    const isValidClientCEP = window.validateCep(clientCEP);
    const isValidClientAddress = window.validateInput(clientAddress, 2);
    const isValidClientNumber = window.validateInput(clientNumber, 1);
    const isValidClientComplement = window.validateInput(clientComplement, 2);
    const isValidClientNeighborhood = window.validateInput(clientNeighborhood, 2);
    const isValidClientCity = window.validateInput(clientCity, 2);
    const isValidClientState = window.validateInput(clientState, 2);

    if (!isValidClientName) submit = false;
    if (!isValidClientBirth) submit = false;
    if (!isValidClientCPF) submit = false;
    if (!isValidClientEmail) submit = false;
    if (!isValidClientPhone) submit = false;
    if (!isValidFileCNH) submit = false;
    if (!isValidFileProcuration) submit = false;
    if (!isValidClientCEP) submit = false;
    if (!isValidClientAddress) submit = false;
    if (!isValidClientNumber) submit = false;
    if (!isValidClientComplement) submit = false;
    if (!isValidClientNeighborhood) submit = false;
    if (!isValidClientCity) submit = false;
    if (!isValidClientState) submit = false;

    errorFocus();

    if (chkAddCredentials.checked) {
        const isValidClientLogin = window.validateLogin(clientLogin);
        const isValidClientPassword = window.validatePassword(clientPassword);

        if (!isValidClientLogin) submit = false;
        if (!isValidClientPassword) submit = false;

        errorFocus();
    }

    if (submit) {
        const clientCNHFile = (fileCNH.files.length) ? fileCNH.files[0] : null;
        const clientProcurationFile = (fileProcuration.files.length) ? fileProcuration.files[0] : null;
        const clientCNPJFile = (fileCNPJ.files.length) ? fileCNPJ.files[0] : null;
        const clientSocialContractFile = (fileSocialContract.files.length) ? fileSocialContract.files[0] : null;

        const btnCreateClientLoading = document.querySelector("#btn-create-client-loading");

        el.setAttribute("disabled", true);
        btnCreateClientLoading.classList.remove("d-none");

        /** Fetch Client data */
        if (chkChangeClientype.checked) {
            formData.append("chk-change-client-type", chkChangeClientype.checked);
            formData.append("client-corporatename", clientCorporateName.value);
            formData.append("client-corporatecnpj", clientCorporateCNPJ.value);
        }

        formData.append("client-name", clientName.value);
        formData.append("client-birth", clientBirth.value);
        formData.append("client-cpf", clientCPF.value);
        formData.append("client-email", clientEmail.value);
        formData.append("client-phone", clientPhone.value);

        if (clientCNHFile !== null) formData.append("file-cnh", clientCNHFile);
        if (clientProcurationFile !== null) formData.append("file-procuration", clientProcurationFile);
        if (clientCNPJFile !== null) formData.append("file-cnpj", clientCNPJFile);
        if (clientSocialContractFile !== null) formData.append("file-socialcontract", clientSocialContractFile);

        formData.append("client-cep", clientCEP.value);
        formData.append("client-address", clientAddress.value);
        formData.append("client-number", clientNumber.value);
        formData.append("client-complement", clientComplement.value);
        formData.append("client-neighborhood", clientNeighborhood.value);
        formData.append("client-city", clientCity.value);
        formData.append("client-state", clientState.value);

        if (chkAddCredentials.checked) {
            formData.append("chk-add-credentials", chkAddCredentials.checked);
            formData.append("client-login", clientLogin.value);
            formData.append("client-password", clientPassword.value);
        }

        const response = await fetch(url_ajax_store_client, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            },
            body: formData
        });

        const result = await response.json();

        if (result.status) {
            clients = null;
            clients = result.clients_names;
            autocomplete(document.querySelector("#contract-client"), result.clients_names);

            contractClient.value = result.client_name;
            contractClient.classList.remove("is-invalid");
            contractClient.classList.add("is-valid");

            btnCreateClient.setAttribute("disabled", true);

            contractClientFeedback.innerText = "Formato aceito.";
            contractClientFeedback.classList.remove("invalid-feedback");
            contractClientFeedback.classList.add("valid-feedback", "d-block");

            $(modalCreateClient).modal("hide");

            el.removeAttribute("disabled");
            btnCreateClientLoading.classList.add("d-none");

            window.resetFormFields(el);
        }

        else {
            const modalCreateClientBody = document.querySelector(`#${modalCreateClient.id} .modal-body`);

            [...result.message].forEach((message, key) => {
                modalCreateClientBody.insertAdjacentHTML("afterbegin", `
                    <span class="alert alert-danger alert-dismissible show fade mb-0"
                        id="alert-create-client-${key}">
                        <span class="fw-bold">${message}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            style="top: -1 !important;" 
                            aria-label="Close"></button>
                    </span>
                `);

                alert = document.querySelector(`#alert-create-client-${key}`);
                alert.style.width = "400px";
                alert.style.margin = "0 auto";
                alert.style.display = "block";
            });

            el.removeAttribute("disabled");
            btnCreateClientLoading.classList.add("d-none");

            $("span.alert")
                .delay(2000)
                .fadeOut(350);
        }
    }
}

/** Create Equipment */
window.submitFormCreateEquipment = async function (el) {
    let submit = true;
    const modalCreateEquipment = document.querySelector("#modal-create-product");
    const equipmentType = document.querySelector("#create-equipment-type");
    const equipmentItem = document.querySelector("#create-equipment-item");
    const equipmentModule = document.querySelector("#create-equipment-module");
    const equipmentProducer = document.querySelector("#create-equipment-producer");
    const equipmentModel = document.querySelector("#create-equipment-model");
    const equipmentGeneratorPower = document.querySelector("#create-equipment-generatorpower");
    const equipmentInverterPower = document.querySelector("#create-equipment-inverterpower");
    const equipmentMPPT = document.querySelector("#create-equipment-mppt");
    const equipmentVoltage = document.querySelector("#create-equipment-voltage");
    const equipmentTechnology = document.querySelector("#create-equipment-technology");
    const equipmentGuarantee = document.querySelector("#create-equipment-guarantee");
    const equipmentDatasheet = document.querySelector("#create-equipment-datasheet");
    const formData = new FormData();

    const isValidEquipmentType = window.validateSelect(equipmentType);
    const isValidEquipmentItem = window.validateInput(equipmentItem, 2);
    const isValidEquipmentModule = window.validateInput(equipmentModule, 2);
    const isValidEquipmentProducer = window.validateInput(equipmentProducer, 2);
    const isValidEquipmentModel = window.validateInput(equipmentModel, 2);
    const isValidEquipmentGeneratorPower = window.validateInput(equipmentGeneratorPower, 2);
    const isValidEquipmentInverterPower = window.validateInput(equipmentInverterPower, 2);
    const isValidEquipmentMPPT = window.validateInput(equipmentMPPT, 2);
    const isValidEquipmentVoltage = window.validateSelect(equipmentVoltage);
    const isValidEquipmentTechnology = window.validateSelect(equipmentTechnology);
    const isValidEquipmentGuarantee = window.validateInput(equipmentGuarantee, 2);
    const isValidEquipmentDatasheet = window.validateFile(equipmentDatasheet);

    if (!isValidEquipmentType) submit = false;
    if (!isValidEquipmentItem) submit = false;
    if (!isValidEquipmentModule) submit = false;
    if (!isValidEquipmentProducer) submit = false;
    if (!isValidEquipmentModel) submit = false;
    if (!isValidEquipmentGeneratorPower) submit = false;
    if (!isValidEquipmentInverterPower) submit = false;
    if (!isValidEquipmentMPPT) submit = false;
    if (!isValidEquipmentVoltage) submit = false;
    if (!isValidEquipmentTechnology) submit = false;
    if (!isValidEquipmentGuarantee) submit = false;
    if (!isValidEquipmentDatasheet) submit = false;

    errorFocus();

    if (submit) {
        const btnCreateEquipmentLoading = document.querySelector("#btn-create-equipment-loading");

        el.setAttribute("disabled", true);
        btnCreateEquipmentLoading.classList.remove("d-none");

        formData.append("equipment-type", equipmentType.value);

        if (equipmentItem.value !== "") formData.append("equipment-item", equipmentItem.value);
        if (equipmentModule.value !== "") formData.append("equipment-module", equipmentModule.value);
        if (equipmentProducer.value !== "") formData.append("equipment-producer", equipmentProducer.value);
        if (equipmentModel.value !== "") formData.append("equipment-model", equipmentModel.value);

        if (equipmentGeneratorPower.value !== "") {
            formData.append("equipment-generator-power", equipmentGeneratorPower.value);
        }

        if (equipmentInverterPower.value !== "") {
            formData.append("equipment-inverter-power", equipmentInverterPower.value);
        }

        if (equipmentMPPT.value !== "") formData.append("equipment-mppt", equipmentMPPT.value);
        if (equipmentVoltage.value !== "") formData.append("equipment-voltage", equipmentVoltage.value);
        if (equipmentTechnology.value !== "") formData.append("equipment-technology", equipmentTechnology.value);
        if (equipmentGuarantee.value !== "") formData.append("equipment-guarantee", equipmentGuarantee.value);

        // Datasheet
        if (equipmentDatasheet.files.length !== 0) {
            const datasheetFeedback = equipmentDatasheet.closest(".form-group").lastElementChild;

            datasheetFeedback.innerHTML = `<span class="fw-bold">Enviando:</span> ${equipmentDatasheet.files[0].name}...`;
            formData.append("equipment-datasheet", equipmentDatasheet.files[0]);
        }

        const response = await fetch(url_store_product_ajax, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            },
            body: formData
        });

        const result = await response.json();

        if (result.status) {
            const equipmentInputID = document.querySelector("#create-equipment-id").value;
            const contractEquipment = document.querySelector("table#editable-table input:first-of-type");
            const btnCreateProduct = document.querySelector(`#button-create-product-${equipmentInputID}`);

            equipments = null;
            equipments = result.equipments;
            equipmentsArray = null;
            equipmentsArray = result.equipments_array;

            contractEquipment.value = result.equipment_name;
            contractEquipment.classList.remove("is-invalid");

            btnCreateProduct.remove();

            $(modalCreateEquipment).modal("hide");

            el.removeAttribute("disabled");
            btnCreateEquipmentLoading.classList.add("d-none");

            window.clearFormCreateEquipment();
        }

        else {
            const modalCreateEquipmentBody = document.querySelector(`#${modalCreateEquipment.id} .modal-body`);

            [...result.message].forEach((message, key) => {
                modalCreateEquipmentBody.insertAdjacentHTML("afterbegin", `
                    <span class="alert alert-danger alert-dismissible show fade mb-3"
                        id="alert-create-equipment-${key}">
                        <span class="fw-bold">${message}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            style="top: -1 !important;" 
                            aria-label="Close"></button>
                    </span>
                `);

                alert = document.querySelector(`#alert-create-equipment-${key}`);
                alert.style.width = "400px";
                alert.style.margin = "0 auto";
                alert.style.display = "block";
            });

            el.removeAttribute("disabled");
            btnCreateEquipmentLoading.classList.add("d-none");

            $("span.alert")
                .delay(2000)
                .fadeOut(350);
        }
    }
}

/** Create contract */
window.submitFormCreateContract = function () {
    let submit = true;
    const formCreateContract = document.querySelector("#form-create-contract");
    const contractSeller = document.querySelector("#contract-seller");
    const contractClient = document.querySelector("#contract-client");
    const contractNickname = document.querySelector("#contract-nickname");
    const contractType = document.querySelector("#contract-type");
    const contractDate = document.querySelector("#contract-date");
    const contractDeadline = document.querySelector("#contract-deadline");
    const contractValue = document.querySelector("#contract-value");
    const contractProfitEstimate = document.querySelector("#contract-profit-estimate");
    const contractKitQuota = document.querySelector("#contract-kit-quota");
    const contractInstallationQuota = document.querySelector("#contract-installation-quota");
    const contractDescription = document.querySelector("#contract-description");
    const contractStructure = document.querySelector("#contract-structure");
    const contractArea = document.querySelector("#contract-area");
    const contractMonthlyAvgGeneration = document.querySelector("#contract-monthly-avg-generation");
    const contractPaymentType = document.querySelector("#contract-payment-type");
    const contractPaymentBank = document.querySelector("#contract-payment-bank");
    const contractPaymentDescription = document.querySelector("#contract-payment-description");
    const contractPaymentCash = document.querySelector("#contract-payment-cash");
    const contractPaymentQuantity = document.querySelector("#contract-payment-quantity");
    const paymentAfterSignature = document.querySelector("#contract-payment-signature");
    const paymentAfterConclusion = document.querySelector("#contract-payment-conclusion");
    const paymentAfterHomologation = document.querySelector("#contract-payment-homologation");
    const paymentAfterFeedback = document.querySelector("#payment-feedback-after-create");

    const isValidContractSeller = window.validateFieldWithAutoComplete(contractSeller, sellers);
    const isValidContractClient = window.validateFieldWithAutoComplete(contractClient, clients);
    const isValidContractNickname = window.validateInput(contractNickname, 2);
    const isValidContractType = window.validateSelect(contractType);
    const isValidContractDate = window.validateDate(contractDate);
    const isValidContractDeadline = window.validateDate(contractDeadline);
    const isValidContractValue = window.validateDouble(contractValue);
    const isValidContractProfitEstimate = window.validateCostPercentage(contractProfitEstimate);
    const isValidContractKitQuota = window.validateCostPercentage(contractKitQuota);
    const isValidContractInstallationQuota = window.validateCostPercentage(contractInstallationQuota);
    const isValidContractDescription = window.validateTextarea(contractDescription, 5, 250);
    const isValidContractStructure = window.validateSelect(contractStructure);
    const isValidContractArea = window.validateInput(contractArea, 1);
    const isValidContractMonthlyAvgGeneration = window.validateInput(contractMonthlyAvgGeneration, 1);
    const isValidContractPaymentType = window.validateSelect(contractPaymentType);
    const isValidPaymentBank = window.validateFieldWithAutoComplete(contractPaymentBank, banks);
    const isValidContractPaymentDescription = window.validateTextarea(contractPaymentDescription, 10, 250);
    const isValidContractPaymentCash = window.validateDouble(contractPaymentCash);
    const isValidContractPaymentQuantity = window.validateInput(contractPaymentQuantity, 1);

    errorFocus();

    if (!isValidContractSeller) submit = false;
    if (!isValidContractClient) submit = false;
    if (!isValidContractNickname) submit = false;
    if (!isValidContractType) submit = false;
    if (!isValidContractDate) submit = false;
    if (!isValidContractDeadline) submit = false;
    if (!isValidContractValue) submit = false;
    if (!isValidContractProfitEstimate) submit = false;
    if (!isValidContractKitQuota) submit = false;
    if (!isValidContractInstallationQuota) submit = false;
    if (!isValidContractDescription) submit = false;
    if (!isValidContractStructure) submit = false;
    if (!isValidContractArea) submit = false;
    if (!isValidContractMonthlyAvgGeneration) submit = false;
    if (!isValidContractPaymentType) submit = false;
    if (!isValidPaymentBank) submit = false;
    if (!isValidContractPaymentDescription) submit = false;
    if (!isValidContractPaymentCash) submit = false;
    if (!isValidContractPaymentQuantity) submit = false;

    // Case Contract Type is "Instalação do Gerador Solar"
    if (contractType.selectedIndex === 1) {
        // Validate table
        if ($("#editable-table > tbody > tr").length === 0) submit = false;

        const tableSolarKit = document.querySelector("#table-data");
        let table = [];
        let hasInvalid = false;

        $("#editable-table input").each(function () {
            if ($(this).hasClass("is-invalid")) hasInvalid = true;
        });

        if (hasInvalid) submit = false;

        else {
            $("#editable-table > tbody > tr").each(function () {
                table.push([
                    $(this).find("td").eq(0).text(),
                    $(this).find("td").eq(1).text()
                ]);
            });

            table = JSON.stringify(table);
            tableSolarKit.value = table;
        }

        // Verify if exists items
        submit = window.tableIsValid(submit);
    }

    // Payment In Cash
    if (contractPaymentType.selectedIndex === 1) {
        if (!paymentAfterConclusion.checked && !paymentAfterHomologation.checked) {
            paymentAfterFeedback.innerText = "Escolha uma opção.";
            paymentAfterFeedback.style.display = "block";
            validateFeedback(paymentAfterFeedback, false);

            submit = false;
        }
    }

    // Payment Company Installments
    if (contractPaymentType.selectedIndex === 4) {
        if (!paymentAfterSignature.checked && !paymentAfterConclusion.checked && !paymentAfterHomologation.checked) {
            paymentAfterFeedback.innerText = "Escolha uma opção.";
            paymentAfterFeedback.style.display = "block";
            validateFeedback(paymentAfterFeedback, false);

            submit = false;
        }
    }

    if (submit) formCreateContract.submit();
}