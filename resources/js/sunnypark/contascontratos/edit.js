//init
$(document).ready(function () {
    initComponents();
});

function initComponents() {
    $('#unidade').mask('##########0');
}

/*
    ---------- Submit Form Create new Contract ----------
 */

function isValidInput(id, min) {
    if ($(id).val() && $(id).val().length >= min) {
        $(id).removeClass('is-invalid');
        return true;
    } else {
        $(id).addClass('is-invalid');
        return false;
    }
}

function errorFocus() {
    $('.is-invalid').first().focus();
}

/*
    ---------- CLICK BUTTON TO SUBMIT FORM ----------
 */

window.submit_form_contract_create = function () {
    let submit = true;

    if (!isValidInput('#unidade', 3)) submit = false;
    if (!isValidInput('#apelido', 3)) submit = false;
    if (!isValidInput('#classificacao', 1)) submit = false;
    if (!isValidInput('#tipo', 1)) submit = false;
    if (!isValidInput('#modalidade', 1)) submit = false;
    
    errorFocus();

    if (submit) $("#form-update-contract").submit();
};