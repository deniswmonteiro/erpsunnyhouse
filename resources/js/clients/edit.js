/** INIT */
$(document).ready(function () {
    window.checkClientType(document.querySelector("#chk-change-client-type"));
    window.checkIfAddCredentials(document.querySelector("#chk-add-credentials"));

    // Mask
    $("#client-cpf").mask("000.000.000-00", { reverse: true });
    $("#client-corporatecnpj").mask("00.000.000/0000-00", { reverse: true });
    $("#client-phone").mask(window.SPMaskBehavior, spOptions);
    $("#client-cep").mask("00000-000");
    $("#client-state").mask("ZZ", {
        translation: {
            "Z": {
                pattern: /[A-Z]/,
            }
        }
    });
});

/** FUNCTIONS */
// Enable client document editing
window.enableEditClientDocumentForm = function (el) {
    const elemType = el.id.split("-")[3];
    const imageEdit = document.querySelector(`#edit-client-document-${elemType}`);
    const imageManagement = document.querySelector(`#client-management-document-${elemType}`);

    imageEdit.classList.remove("d-none");
    imageManagement.classList.add("d-none");
}

// Cancel client document editing
window.cancelClientDocumentEdit = function (el) {
    const elemType = el.id.split("-")[3];
    const imageEdit = document.querySelector(`#edit-client-document-${elemType}`);
    const imageManagement = document.querySelector(`#client-management-document-${elemType}`);
    const file = document.querySelector(`#file-${elemType}`);
    const feedback = el.closest(".form-group").lastElementChild;
    const filename = document.querySelector(`#file-${elemType}-name`);
    const btnSubmitDocumentEdit = document.querySelector(`#btn-update-document-${elemType}`);

    imageEdit.classList.add("d-none");
    imageManagement.classList.remove("d-none");

    btnSubmitDocumentEdit.setAttribute("disabled", true);

    file.value = "";
    file.classList.remove("is-valid", "is-invalid");
    feedback.classList.remove("is-valid", "is-invalid");
    feedback.innerText = "";

    if (filename !== null) {
        filename.classList.remove("d-none");
        filename.classList.add("d-block");
    }
}

/** Change client type */
window.checkClientType = function (el) {
    const corporateClient = document.querySelector("#corporate-client");
    const clientCorporateName = document.querySelector("#client-corporatename");
    const clientCorporateCNPJ = document.querySelector("#client-corporatecnpj");
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
        clientPassword.removeAttribute("min");
    }

    else {
        corporateClient.classList.add("d-none");
        clientCorporateName.removeAttribute("required");
        clientCorporateCNPJ.removeAttribute("required");
        documentCorporateClient.classList.add("d-none");

        $("#client-login").mask("000.000.000-00", { reverse: true });

        clientPassword.setAttribute("type", "date");
        clientPassword.classList.add("date");
        clientPassword.setAttribute("min", "1923-01-01");
    }

    // Enable/disable password input if change client type value
    if (clientHasCredentials) showChangePassword(el.checked, clientPassword);
}

/** Enable/disable password input if change client type value */
function showChangePassword(chkClientType, clientPassword) {
    const chkChangePassword = document.querySelector("#chk-change-password");
    const clientPasswordFeedback = document.querySelector("#client-feedback-password-edit");

    if ((chkClientType && !isCorporateClient || !chkClientType && isCorporateClient)) {
        chkChangePassword.parentElement.classList.add("d-none");
        chkChangePassword.checked = false;
        clientPassword.removeAttribute("disabled");
        return true;
    }

    else if ((chkClientType && isCorporateClient || !chkClientType && !isCorporateClient) && chkChangePassword.checked) {
        chkChangePassword.parentElement.classList.remove("d-none");
        clientPassword.removeAttribute("disabled");
        return true;
    }

    else {
        chkChangePassword.parentElement.classList.remove("d-none");
        clientPassword.setAttribute("disabled", true);
        clientPassword.classList.remove("is-valid", "is-invalid");
        clientPasswordFeedback.innerText = "";
        clientPasswordFeedback.classList.remove("is-valid", "is-invalid");
        return false;
    }
}

/** Fill in address fields when the CEP is filled */
window.fillInAddressFields = async function (el) {
    const isValidCep = window.validateCep(el);
    const feedback = el.closest(".form-group").lastElementChild;
    const clientAddress = document.querySelector("#client-address");
    const clientNumber = document.querySelector("#client-number");
    const clientComplement = document.querySelector("#client-complement");
    const clientNeighborhood = document.querySelector("#client-neighborhood");
    const clientCity = document.querySelector("#client-city");
    const clientState = document.querySelector("#client-state");
    const addressFields = [
        el, clientAddress, clientNumber, clientComplement, clientNeighborhood, clientCity, clientState
    ];
    const addressInformationsLoading = document.querySelector("#address-informations-loading");

    if (isValidCep) {
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

            clientAddress.value = result.logradouro;
            clientNeighborhood.value = result.bairro;
            clientCity.value = result.localidade;
            clientState.value = result.uf;

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

/** Show inputs to edit credentials */
window.checkIfAddCredentials = function (el) {
    const credentials = document.querySelector("#credentials");
    const clientLogin = document.querySelector("#client-login");
    const clientPassword = document.querySelector("#client-password");
    const chkChangePassword = document.querySelector("#chk-change-password");

    if (el.checked) {
        credentials.classList.remove("d-none");
        clientLogin.setAttribute("required", true);

        if (chkChangePassword.parentElement.classList.contains("d-none")) {
            clientPassword.removeAttribute("disabled");
            clientPassword.setAttribute("required", true);
        }
    }

    else {
        credentials.classList.add("d-none");
        clientLogin.removeAttribute("required");

        if (!chkChangePassword.checked && !chkChangePassword.parentElement.classList.contains("d-none")) {
            clientPassword.setAttribute("disabled", true);
            clientPassword.removeAttribute("required");
        }
    }
}

/** Show input to change password */
window.checkChangePassword = function (el) {
    const clientPassword = document.querySelector("#client-password");
    const feedback = document.querySelector("#client-feedback-password-edit");

    if (el.checked) {
        clientPassword.setAttribute("required", true);
        clientPassword.removeAttribute("disabled");
    }

    else {
        clientPassword.removeAttribute("required");
        clientPassword.setAttribute("disabled", true);
        clientPassword.value = "";
        clientPassword.classList.remove("is-invalid");
        feedback.innerText = "";
        feedback.classList.remove("invalid-feedback");
    }
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

    if (el.hasAttribute("required")) {
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

window.validateDate = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;
    const min = 8;
    const date = el.value;
    const minDate = el.getAttribute("min");

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

    else if (date < minDate) {
        feedback.innerText = "Digite um ano de nascimento válido.";
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

window.validateFile = function (el) {
    const fileType = el.id.split("-")[1];
    const filename = document.querySelector(`#file-${fileType}-name`);
    const feedback = el.closest(".form-group").lastElementChild;
    const mimeTypes = ["application/pdf", "image/jpeg", "image/png"];

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
        if (filename !== null) {
            filename.classList.remove("d-block");
            filename.classList.add("d-none");
        }

        feedback.classList.remove("d-none");
        feedback.classList.add("d-block");

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

window.validateFile = function (el) {
    const fileType = el.id.split("-")[1];
    const filename = document.querySelector(`#file-${fileType}-name`);
    const feedback = el.closest(".form-group").lastElementChild;
    const mimeTypes = ["application/pdf", "image/jpeg", "image/png"];
    const btnSubmitDocument = document.querySelector(`#btn-update-document-${fileType}`);

    if (el.files.length === 0) {
        if (filename !== null) {
            filename.classList.remove("d-none");
            filename.classList.add("d-block");
        }

        feedback.classList.remove("d-block");
        feedback.classList.add("d-none");
        validate(el, true);

        btnSubmitDocument.setAttribute("disabled", true);

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

            btnSubmitDocument.setAttribute("disabled", true);

            return false;
        }

        else if (el.files[0] !== undefined && el.files[0].size > 10 * 1024 * 1024) {
            feedback.innerText = `O arquivo ${el.files[0].name} ultrapassou limite de 10 MB.`;
            validate(el, false);
            validateFeedback(feedback, false);

            btnSubmitDocument.setAttribute("disabled", true);

            return false;
        }

        else {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);

            btnSubmitDocument.removeAttribute("disabled");

            return true;
        }
    }
}

window.validateCep = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

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
    const feedback = el.nextElementSibling;
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

        else if (el.value < minDate) {
            feedback.innerText = "Digite um ano de nascimento válido.";
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
window.submitFormEditClientDocument = function (el) {
    const fileType = el.id.split("-")[3];
    let submit = true;
    const formEditClientFile = document.querySelector(`#form-client-document-${fileType}`);
    const file = document.querySelector(`#file-${fileType}`);
    const feedback = el.closest(".form-group").lastElementChild;
    const btnCancelDocumentEdit = document.querySelector(`#btn-cancel-edit-${fileType}`);

    const isValidClientDocument = window.validateFile(file);

    if (!isValidClientDocument) submit = false;

    errorFocus();

    if (submit) {
        const btnEditDocument = document.querySelector(`#btn-update-document-${fileType}`);
        const btnEditDocumentIcon = document.querySelector(`#btn-update-document-${fileType} i`);
        const btnEditDocumentLoading = document.querySelector(`#btn-update-document-loading-${fileType}`);

        btnEditDocument.setAttribute("disabled", true);
        btnEditDocumentIcon.classList.add("d-none");
        btnEditDocumentLoading.classList.remove("d-none");
        btnCancelDocumentEdit.setAttribute("disabled", true);

        if (file.files[0] !== undefined) {
            feedback.innerHTML = `<span class="fw-bold">Enviando:</span> ${file.files[0].name}...`;
        }

        formEditClientFile.submit();
    }
}

window.submitFormEditClient = function () {
    let submit = true;
    const formEditClient = document.querySelector("#form-edit-client");
    const chkChangeClientype = document.querySelector("#chk-change-client-type");
    const clientCorporateName = document.querySelector("#client-corporatename");
    const clientCorporateCNPJ = document.querySelector("#client-corporatecnpj");
    const clientName = document.querySelector("#client-name");
    const clientBirth = document.querySelector("#client-birth");
    const clientCPF = document.querySelector("#client-cpf");
    const clientEmail = document.querySelector("#client-email");
    const clientPhone = document.querySelector("#client-phone");
    const clientCEP = document.querySelector("#client-cep");
    const clientAddress = document.querySelector("#client-address");
    const clientNumber = document.querySelector("#client-number");
    const clientNeighborhood = document.querySelector("#client-neighborhood");
    const clientCity = document.querySelector("#client-city");
    const clientState = document.querySelector("#client-state");
    const chkAddCredentials = document.querySelector("#chk-add-credentials");
    const clientLogin = document.querySelector("#client-login");
    const clientPassword = document.querySelector("#client-password");

    if (chkChangeClientype.checked) {
        const isValidClientCorporateName = window.validateInput(clientCorporateName, 2);
        const isValidClientCorporateCNPJ = window.validateIdentification(clientCorporateCNPJ, 14);

        if (!isValidClientCorporateName) submit = false;
        if (!isValidClientCorporateCNPJ) submit = false;

        errorFocus();
    }

    const isValidClientName = window.validateInput(clientName, 5);
    const isValidClientBirth = window.validateDate(clientBirth);
    const isValidClientCPF = window.validateIdentification(clientCPF, 11);
    const isValidClientEmail = window.validateEmail(clientEmail);
    const isValidClientPhone = window.validatePhone(clientPhone, 10);
    const isValidClientCEP = window.validateCep(clientCEP);
    const isValidClientAddress = window.validateInput(clientAddress, 2);
    const isValidClientNumber = window.validateInput(clientNumber, 1);
    const isValidClientNeighborhood = window.validateInput(clientNeighborhood, 2);
    const isValidClientCity = window.validateInput(clientCity, 2);
    const isValidClientState = window.validateInput(clientState, 2);

    if (!isValidClientName) submit = false;
    if (!isValidClientBirth) submit = false;
    if (!isValidClientCPF) submit = false;
    if (!isValidClientEmail) submit = false;
    if (!isValidClientPhone) submit = false;
    if (!isValidClientCEP) submit = false;
    if (!isValidClientAddress) submit = false;
    if (!isValidClientNumber) submit = false;
    if (!isValidClientNeighborhood) submit = false;
    if (!isValidClientCity) submit = false;
    if (!isValidClientState) submit = false;

    errorFocus();

    if (chkAddCredentials.checked) {
        const isValidClientLogin = window.validateLogin(clientLogin);
        let isValidClientPassword

        if (!isValidClientLogin) submit = false;

        errorFocus();

        if (clientHasCredentials) {
            const isPasswordInputEnable = showChangePassword(chkChangeClientype.checked, clientPassword);

            if (isPasswordInputEnable) {
                isValidClientPassword = window.validatePassword(clientPassword);

                if (!isValidClientPassword) submit = false;

                errorFocus();
            }
        }

        else {
            isValidClientPassword = window.validatePassword(clientPassword);

            if (!isValidClientPassword) submit = false;

            errorFocus();
        }
    }

    if (submit) formEditClient.submit();
};
