/** INIT */
$(document).ready(function () {
    $("#create-equipment-generatorpower").mask("#####9V##", {
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
    $("#create-equipment-inverterpower").mask("#####9V##", {
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
    $("#create-equipment-mppt").mask("#####9V##", {
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
    $("#create-equipment-guarantee").mask("0#");
});

/** FUNCTIONS */
/** When equipment type is changed */
window.changeEquipmentTypeToCreate = function (el) {
    const equipmentType = el.selectedIndex;
    const equipmentFormFields = getEquipmentFormFieldsToCreate();
    const equipmentFormFieldsToReset = [
        equipmentFormFields[1], equipmentFormFields[2], equipmentFormFields[3], equipmentFormFields[4], equipmentFormFields[5], equipmentFormFields[6], equipmentFormFields[7], equipmentFormFields[8], equipmentFormFields[9], equipmentFormFields[10], equipmentFormFields[11]
    ]

    resetEquipmentFormToCreate(equipmentFormFieldsToReset);

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
    const equipmentFormFields = getEquipmentFormFieldsToCreate();

    resetEquipmentFormToCreate(equipmentFormFields);

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
function getEquipmentFormFieldsToCreate() {
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
function resetEquipmentFormToCreate(equipmentFormFields) {
    [...equipmentFormFields].forEach(field => {
        const fieldFeedback = field.closest(".form-group").lastElementChild;

        field.value = "";
        field.classList.remove("is-valid", "is-invalid");
        fieldFeedback.classList.remove("is-valid", "is-invalid");
        fieldFeedback.innerText = "";
    });
}

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** VALIDATIONS */
window.validateInput = function (el, min) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.getAttribute("required") !== null) {
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

window.validateSelect = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.getAttribute("required") !== null) {
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

window.validateFile = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;
    const mimeTypes = ['application/pdf'];

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
window.submitFormCreateEquipment = function () {
    let submit = true;
    const formCreateEquipment = document.querySelector("#form-create-equipment");
    const equipmentFormFields = getEquipmentFormFieldsToCreate();

    const isValidEquipmentType = window.validateSelect(equipmentFormFields[0]) ? true : false;
    const isValidEquipmentItem = window.validateInput(equipmentFormFields[1], 2) ? true : false;
    const isValidEquipmentModule = window.validateInput(equipmentFormFields[2], 2) ? true : false;
    const isValidEquipmentProducer = window.validateInput(equipmentFormFields[3], 2) ? true : false;
    const isValidEquipmentModel = window.validateInput(equipmentFormFields[4], 2) ? true : false;
    const isValidEquipmentGeneratorPower = window.validateInput(equipmentFormFields[5], 2) ? true : false;
    const isValidEquipmentInverterPower = window.validateInput(equipmentFormFields[6], 2) ? true : false;
    const isValidEquipmentMPPT = window.validateInput(equipmentFormFields[7], 2) ? true : false;
    const isValidEquipmentVoltage = window.validateSelect(equipmentFormFields[8]) ? true : false;
    const isValidEquipmentTechnology = window.validateSelect(equipmentFormFields[9]) ? true : false;
    const isValidEquipmentGuarantee = window.validateInput(equipmentFormFields[10], 2) ? true : false;
    const isValidEquipmentDatasheet = window.validateFile(equipmentFormFields[11]) ? true : false;

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
        const btnCreateEquipment = document.querySelector("#btn-create-equipment");
        const btnCreateEquipmentLoading = document.querySelector("#btn-create-equipment-loading");
        const datasheet = document.querySelector("#create-equipment-datasheet");

        btnCreateEquipment.setAttribute("disabled", true);
        btnCreateEquipmentLoading.classList.remove("d-none");

        if (datasheet.files.length !== 0) {
            const datasheetFeedback = datasheet.closest(".form-group").lastElementChild;
            datasheetFeedback.innerHTML = `<span class="fw-bold">Enviando:</span> ${datasheet.files[0].name}...`;
        }

        formCreateEquipment.submit();
    }
}