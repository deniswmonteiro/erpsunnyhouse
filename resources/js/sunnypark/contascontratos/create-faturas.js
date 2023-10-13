//init
$(document).ready(function () {
    initComponents();
});

function initComponents() {
    $('#valor_faturado').mask("#.##0,00", { reverse: true });
    $('#valor_tarifa').mask("#.##0,00", { reverse: true });
    $('#valor_tarifa_comp').mask("#.##0,00", { reverse: true });
    $('#energia_reg').mask('###0,00', {reverse: true});
    $('#energia_comp').mask('###0,00', {reverse: true});
    $('#energia_fat').mask('###0,00', {reverse: true});
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
    submit();
};

function submit() {
    let submit = true;

    if (!isValidInput('#valor_faturado', 2)) submit = false;
    if (!isValidInput('#valor_tarifa', 2)) submit = false;
    if (!isValidInput('#valor_tarifa_comp', 2)) submit = false;
    if (!isValidInput('#energia_reg', 2)) submit = false;
    if (!isValidInput('#energia_comp', 2)) submit = false;
    if (!isValidInput('#energia_fat', 2)) submit = false;
    
    errorFocus();

    if (submit) $("#form-create-fatura").submit();
}
