/** INIT */
$(document).ready(function () {
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
    $("#client-login").mask("000.000.000-00", { reverse: true });
});

/** FUNCTIONS */
/** Change client type */
window.checkClientType = function (el) {
    const corporateClient = document.querySelector("#corporate-client");
    const clientCorporateName = document.querySelector("#client-corporatename");
    const clientCorporateNameFeedback = document.querySelector("#client-feedback-corporatename-create");
    const clientCorporateCNPJ = document.querySelector("#client-corporatecnpj");
    const fileCNPJ = document.querySelector("#file-cnpj");
    const fileCNPJFeedback = document.querySelector("#file-cnpj-feedback");
    const fileSocialContract = document.querySelector("#file-socialcontract");
    const fileSocialContractFeedback = document.querySelector("#file-socialcontract-feedback");
    const clientCorporateCNPJFeedback = document.querySelector("#client-feedback-corporatecnpj-create");
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
window.submitFormCreateClient = function () {
    let submit = true;
    const formCreateClient = document.querySelector("#form-create-client");
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
    const clientNeighborhood = document.querySelector("#client-neighborhood");
    const clientCity = document.querySelector("#client-city");
    const clientState = document.querySelector("#client-state");
    const chkAddCredentials = document.querySelector("#chk-add-credentials");
    const clientLogin = document.querySelector("#client-login");
    const clientPassword = document.querySelector("#client-password");

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
        const allInputsFile = document.querySelectorAll("input[type='file']");
        const btnCreateClient = document.querySelector("#btn-create-client");
        const btnCreateClientLoading = document.querySelector("#btn-create-client-loading");

        btnCreateClient.setAttribute("disabled", true);
        btnCreateClientLoading.classList.remove("d-none");

        allInputsFile.forEach(input => {
            if (input.files[0] !== undefined) {
                input.nextElementSibling.innerHTML = `<span class="fw-bold">Enviando:</span> ${input.files[0].name}...`;
            }
        });

        formCreateClient.submit();
    }
};
