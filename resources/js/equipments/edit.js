/** INIT */
$(document).ready(function () {
    const equipmentsType = document.querySelectorAll("select[id^='edit-equipment-type-']");

    [...equipmentsType].forEach(type => {
        window.changeEquipmentTypeToEdit(type)
    });

    $("input[id^='edit-equipment-generatorpower']").mask("#####9V##", {
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
    $("input[id^='edit-equipment-inverterpower']").mask("#####9V##", {
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
    $("input[id^='edit-equipment-mppt']").mask("#####9V##", {
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
    $("input[id^='edit-equipment-guarantee']").mask("0#");
});

/** FUNCTIONS */
/** When equipment type is changed */
window.changeEquipmentTypeToEdit = function (el) {
    const elemItem = el.id.split("-")[3];
    const equipmentType = el.selectedIndex;
    const equipmentFormFields = getEquipmentFormFieldsToEdit(elemItem);

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

/** Get all equipment form fields */
function getEquipmentFormFieldsToEdit(elemItem) {
    const equipmentType = document.querySelector(`#edit-equipment-type-${elemItem}`);
    const equipmentItem = document.querySelector(`#edit-equipment-item-${elemItem}`);
    const equipmentModule = document.querySelector(`#edit-equipment-module-${elemItem}`);
    const equipmentProducer = document.querySelector(`#edit-equipment-producer-${elemItem}`);
    const equipmentModel = document.querySelector(`#edit-equipment-model-${elemItem}`);
    const equipmentGeneratorPower = document.querySelector(`#edit-equipment-generatorpower-${elemItem}`);
    const equipmentInverterPower = document.querySelector(`#edit-equipment-inverterpower-${elemItem}`);
    const equipmentPowerMPPT = document.querySelector(`#edit-equipment-mppt-${elemItem}`);
    const equipmentPowerVoltage = document.querySelector(`#edit-equipment-voltage-${elemItem}`);
    const equipmentPowerTechnology = document.querySelector(`#edit-equipment-technology-${elemItem}`);
    const equipmentPowerGuarantee = document.querySelector(`#edit-equipment-guarantee-${elemItem}`);
    const equipmentDatasheet = document.querySelector(`#edit-equipment-datasheet-${elemItem}`);
    const equipmentFormFields = [
        equipmentType, equipmentItem, equipmentModule, equipmentProducer, equipmentModel, equipmentGeneratorPower, equipmentInverterPower, equipmentPowerMPPT, equipmentPowerVoltage, equipmentPowerTechnology, equipmentPowerGuarantee, equipmentDatasheet
    ];

    return equipmentFormFields;
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
    const elemItem = el.id.split("-")[3];
    const filename = document.querySelector(`#equipment-datasheet-name-${elemItem}`);
    const feedback = el.closest(".form-group").lastElementChild;
    const mimeTypes = ['application/pdf'];

    if (el.files.length === 0) {
        if (filename !== null) {
            filename.classList.remove("d-none");
            filename.classList.add("d-block");
        }

        feedback.classList.remove("d-block");
        feedback.classList.add("d-none");
        validate(el, true);
        return true;
    }

    else {
        filename !== null && filename.classList.remove("d-block");
        filename !== null && filename.classList.add("d-none");

        feedback.classList.add("d-block");
        feedback.classList.remove("d-none");

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
window.submitFormEditEquipment = function (el) {
    const elemItem = el.id.split("-")[3];
    let submit = true;
    const formEditEquipment = document.querySelector(`#form-edit-equipment-${elemItem}`);
    const equipmentFormFields = getEquipmentFormFieldsToEdit(elemItem);

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
        const btnEditEquipment = document.querySelector(`#btn-edit-equipment-${elemItem}`);
        const btnEditEquipmentLoading = document.querySelector(`#btn-edit-equipment-loading-${elemItem}`);
        const datasheet = document.querySelector(`#edit-equipment-datasheet-${elemItem}`);

        btnEditEquipment.setAttribute("disabled", true);
        btnEditEquipmentLoading.classList.remove("d-none");

        if (datasheet.files.length !== 0) {
            const datasheetFeedback = datasheet.closest(".form-group").lastElementChild;
            datasheetFeedback.innerHTML = `<span class="fw-bold">Enviando:</span> ${datasheet.files[0].name}...`;
        }

        formEditEquipment.submit();
    }
}