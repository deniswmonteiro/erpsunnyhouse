$(document).ready(function () {
    $('#table_id').DataTable({
        "language": {
            "lengthMenu": "Visualizar _MENU_ itens por página",
            "zeroRecords": "Sem Informações",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "infoEmpty": "Sem Informações",
            "infoFiltered": "",
            "search": "Pesquisar",
            "paginate": {
                "first": "Primera",
                "previous": "Anterior",
                "next": "Próxima",
                "last": "Última"
            }
        },
        "lengthMenu": [[25, 50, 75 - 1], [25, 50, 75, "All"]],
    });

    // Mask
    $("#bank-code").mask("0#");
});

/** FUNCTIONS */
/** Clear the form if the cancel button was clicked */
window.clearFormCreateBank = function () {
    const bankCode = document.querySelector("#bank-code");
    const bankCodeFeedback = document.querySelector("#bank-feedback-code-create");
    const name = document.querySelector("#bank-name");
    const nameFeedback = document.querySelector("#bank-feedback-name-create");

    bankCode.value = "";
    name.value = "";

    bankCode.classList.remove("is-valid", "is-invalid");
    bankCodeFeedback.classList.remove("is-valid", "is-invalid");
    bankCodeFeedback.innerText = "";

    name.classList.remove("is-valid", "is-invalid");
    nameFeedback.classList.remove("is-valid", "is-invalid");
    nameFeedback.innerText = "";
}

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** VALIDATIONS */
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
window.submitFormCreateBank = async function () {
    let submit = true;
    const formCreateBank = document.querySelector("#form-create-bank");
    const bankCode = document.querySelector("#bank-code");
    const bankName = document.querySelector("#bank-name");

    const isValidTicketBankCode = window.validateInput(bankCode, 1) ? true : false;
    const isValidTicketBankName = window.validateInput(bankName, 2) ? true : false;

    if (!isValidTicketBankCode) submit = false;
    if (!isValidTicketBankName) submit = false;

    errorFocus();

    if (submit) {
        const btnCreateBank = document.querySelector("#btn-create-bank");
        const btnCreateBankLoading = document.querySelector("#btn-create-bank-loading");

        btnCreateBank.setAttribute("disabled", true);
        btnCreateBankLoading.classList.remove("d-none");

        formCreateBank.submit();
    }
}

window.submitFormEditBank = async function (el) {
    let submit = true;
    const elItem = el.id.split("-")[3];
    const formEditBank = document.querySelector(`#form-edit-bank-${elItem}`);
    const bankCode = document.querySelector(`#bank-code-${elItem}`);
    const bankName = document.querySelector(`#bank-name-${elItem}`);

    const isValidTicketBankCode = window.validateInput(bankCode, 1) ? true : false;
    const isValidTicketBankName = window.validateInput(bankName, 2) ? true : false;

    if (!isValidTicketBankCode) submit = false;
    if (!isValidTicketBankName) submit = false;

    errorFocus();

    if (submit) {
        const btnEditBank = document.querySelector(`#btn-edit-bank-${elItem}`);
        const btnEditBankLoading = document.querySelector(`#btn-edit-bank-loading-${elItem}`);

        btnEditBank.setAttribute("disabled", true);
        btnEditBankLoading.classList.remove("d-none");

        formEditBank.submit();
    }
}