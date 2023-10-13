/** INIT FUNCTIONS */
$(document).ready(function () {
    /** Mask */
    $("#professional-registration").mask("0#");
    $("#cep").mask("00000-000");
    $('#phone').mask(window.SPMaskBehavior, spOptions);
    $('#cellphone').mask(window.SPMaskBehavior, spOptions);
});

/** FUNCTIONS */
/** Check if email is already in use */
async function executeAjaxEmail(email, feedback) {
    const body = {
        "email": email.value,
        "user": user
    };

    const response = await fetch(url_fetch_email, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(body)
    });

    const result = await response.json();

    if (response.ok) return result;
}

/** Toggle hide/show password text */
window.showHidePassword = function (el) {
    const input = document.querySelector("#password");
    const icon = document.querySelector("#show-hide-password i");

    if (input.getAttribute("type") === "password") {
        input.setAttribute("type", "text");
        icon.classList.remove("bi-eye-slash-fill");
        icon.classList.add("bi-eye-fill");
    }

    else {
        input.setAttribute("type", "password");
        icon.classList.remove("bi-eye-fill");
        icon.classList.add("bi-eye-slash-fill");
    }
}

/** Show form to set engineer data */
window.addEngineerData = function (el) {
    const isEngineer = document.querySelector("#is-engineer");
    const engineerData = document.querySelector("#engineer-data");
    const chkIsEngineer = document.querySelector(`#${isEngineer.id} #chk-is-engineer`);

    if (el.selectedIndex === 2) {
        isEngineer.classList.add("d-none");
        engineerData.classList.remove("d-none");
    }

    else if (el.selectedIndex === 3) {
        isEngineer.classList.remove("d-none");
        engineerData.classList.add("d-none");

        window.checkIfEngineerData(chkIsEngineer);
    }

    else {
        isEngineer.classList.add("d-none");
        engineerData.classList.add("d-none");
    }
}

/** If select to show form with engineer data is checked */
window.checkIfEngineerData = function (el) {
    const engineerData = document.querySelector("#engineer-data")

    el.checked ? engineerData.classList.remove("d-none") : engineerData.classList.add("d-none");
}

/** Fill address fields when 'CEP' is filled */
window.fillInAddressFields = async function (el) {
    const isValidCep = window.validateCep(el);
    const cepFeedback = document.querySelector(`#cep-feedback-user`);
    const address = document.querySelector(`#address`);
    const number = document.querySelector(`#number`);
    const neighborhood = document.querySelector(`#neighborhood`);
    const city = document.querySelector(`#city`);
    const state = document.querySelector(`#state`);
    const addressFields = [
        el, address, number, neighborhood, city, state
    ];

    if (isValidCep) {
        const response = await fetch(`https://viacep.com.br/ws/${el.value}/json/`);
        const result = await response.json();

        if (result.erro) addressFields.forEach(field => field.value = "");

        else {
            cepFeedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(cepFeedback, true);

            address.value = result.logradouro;
            neighborhood.value = result.bairro;
            city.value = result.localidade;
            state.value = result.uf;
        }
    }

    else addressFields.forEach(field => field.value = "");

    validateAddressFields(addressFields);
}

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** VALIDATIONS */
window.validateName = function (el) {
    const nameFeedback = document.querySelector("#name-feedback-user");

    if (el.value.length === 0) {
        nameFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(nameFeedback, false);
        return false;
    }

    else if (el.value.length < 5) {
        nameFeedback.innerText = "Mínimo de 5 dígitos.";
        validate(el, false);
        validateFeedback(nameFeedback, false);
        return false;
    }

    else {
        nameFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(nameFeedback, true);
        return true;
    }
}

window.validateEmail = async function (el) {
    const emailFeedback = document.querySelector("#email-feedback-user");

    if (el.value.length === 0) {
        emailFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(emailFeedback, false);
        return false;
    }

    else if (!/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/.test(el.value)) {
        emailFeedback.innerText = "Formato inválido.";
        validate(el, false);
        validateFeedback(emailFeedback, false);
        return false;
    }

    else {
        const result = await executeAjaxEmail(el, emailFeedback);

        if (result.exist_user) {
            emailFeedback.innerText = "Email já cadastrado no sistema.";
            validate(email, false);
            validateFeedback(emailFeedback, false);
            return false;
        }

        else if (result.validated_fail) {
            emailFeedback.innerText = "Formato inválido.";
            validate(email, false);
            validateFeedback(emailFeedback, false);
            return false;
        }

        else {
            emailFeedback.innerText = "Formato aceito.";
            validate(email, true);
            validateFeedback(emailFeedback, true);
            return true;
        }
    }
}

window.validatePassword = function (el) {
    const passwordFeedback = document.querySelector("#password-feedback-user");

    if (el.value.length === 0) {
        passwordFeedback.innerText = "A senha não será alterada.";
        validate(el, true);
        validateFeedback(passwordFeedback, true);
        return true;
    }

    else {
        if (el.value.length < 6) {
            passwordFeedback.innerText = "Mínimo de 6 dígitos.";
            validate(el, false);
            validateFeedback(passwordFeedback, false);
            return false;
        }

        else if (!/^[a-zA-Z0-9@#$%!^&*-.]{6,}$/.test(el.value)) {
            passwordFeedback.innerText = "Formato inválido.";
            validate(el, false);
            validateFeedback(passwordFeedback, false);
            return false;
        }

        else {
            passwordFeedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(passwordFeedback, true);
            return true;
        }
    }
}

window.validatePhone = function (el) {
    const elemId = el.id;
    let feedback;
    let digits;

    if (elemId === "phone") {
        feedback = document.querySelector("#phone-feedback-user");
        digits = 10;
    }

    else {
        feedback = document.querySelector("#cellphone-feedback-user");
        digits = 11;
    }

    if (el.value.length === 0) {
        feedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (el.value.replace(/[^0-9]/g, '').length !== digits) {
        feedback.innerText = `O telefone deve conter ${digits} dígitos.`;
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
    const cepFeedback = document.querySelector("#cep-feedback-user");

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

function validateAddressFields(addressFields) {
    window.validateCep(addressFields[0]);
    window.validateInput(addressFields[1], 2);
    window.validateInput(addressFields[2], 1);
    window.validateInput(addressFields[3], 2);
    window.validateInput(addressFields[4], 2);
    window.validateSelect(addressFields[5]);
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
        validate(el, false);
        validateFeedback(selectFeedback, false);
        return false;
    }

    else {
        selectFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(selectFeedback, true);
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

window.submitFormUserUpdate = async function () {
    let submit;
    const formUpdateUser = document.querySelector("#form-update-user");
    const userName = document.querySelector("#name");
    const userEmail = document.querySelector("#email");
    const userPassword = document.querySelector("#password");
    const userCategory = document.querySelector("#category");
    const userStatus = document.querySelector("#status");
    const chkIsEngineer = document.querySelector("#chk-is-engineer");
    const professionalTitle = document.querySelector("#professional-title");
    const professionalRegistration = document.querySelector("#professional-registration");
    const professionalState = document.querySelector("#professional-state");
    const phone = document.querySelector("#phone");
    const cellphone = document.querySelector("#cellphone");
    const cep = document.querySelector("#cep");
    const address = document.querySelector("#address");
    const number = document.querySelector("#number");
    const neighborhood = document.querySelector("#neighborhood");
    const city = document.querySelector("#city");
    const state = document.querySelector("#state");

    const isValidUserName = window.validateName(userName);
    const isValidUserEmail = await window.validateEmail(userEmail);
    const isValidUserPassword = window.validatePassword(userPassword);
    const isValidUserCategory = window.validateSelect(userCategory);
    const isValidUserStatus = window.validateSelect(userStatus);
    let isValidProfessionalTitle;
    let isValidProfessionalRegistration;
    let isValidProfessionalState;
    let isValidPhone;
    let isValidCellPhone;
    let isValidCep;
    let isValidAddress;
    let isValidNumber;
    let isValidNeighborhood;
    let isValidCellCity;
    let isValidCellState;

    if (userCategory.selectedIndex === 2 || (userCategory.selectedIndex === 3 && chkIsEngineer.checked)) {
        isValidProfessionalTitle = window.validateInput(professionalTitle, 2);
        isValidProfessionalRegistration = window.validateInput(professionalRegistration, 2);
        isValidProfessionalState = window.validateSelect(professionalState);
        isValidPhone;

        if (phone.value.length !== 0) isValidPhone = window.validatePhone(phone);
        else isValidPhone = true;

        isValidCellPhone = window.validatePhone(cellphone);
        isValidCep = window.validateCep(cep);
        isValidAddress = window.validateInput(address, 2);
        isValidNumber = window.validateInput(number, 1);
        isValidNeighborhood = window.validateInput(neighborhood, 2);
        isValidCellCity = window.validateInput(city, 2);
        isValidCellState = window.validateSelect(state);
    }

    else {
        isValidProfessionalTitle = true;
        isValidProfessionalRegistration = true;
        isValidProfessionalState = true;
        isValidPhone = true;
        isValidCellPhone = true;
        isValidCep = true;
        isValidAddress = true;
        isValidNumber = true;
        isValidNeighborhood = true;
        isValidCellCity = true;
        isValidCellState = true;
    }

    if (!isValidUserName) submit = false;
    else if (!isValidUserEmail) submit = false;
    else if (!isValidUserPassword) submit = false;
    else if (!isValidUserCategory) submit = false;
    else if (!isValidUserStatus) submit = false;
    else if (!isValidProfessionalTitle) submit = false;
    else if (!isValidProfessionalRegistration) submit = false;
    else if (!isValidProfessionalState) submit = false;
    else if (!isValidPhone) submit = false;
    else if (!isValidCellPhone) submit = false;
    else if (!isValidCep) submit = false;
    else if (!isValidAddress) submit = false;
    else if (!isValidNumber) submit = false;
    else if (!isValidNeighborhood) submit = false;
    else if (!isValidCellCity) submit = false;
    else if (!isValidCellState) submit = false;
    else submit = true;

    errorFocus();

    if (submit) formUpdateUser.submit();
}