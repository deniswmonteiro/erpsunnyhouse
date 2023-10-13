//init
$(document).ready(function () {
    initComponents();
});

function initComponents() {
    $('#new_client').hide();

    $('#documento').mask('##################0');
    $('#producaoMeta').mask('###0,00', {reverse: true});
    $('#diaLeitura').mask('#0');
    $('#ciclo').mask('#0');
    $('.money').mask("#.##0,00", { reverse: true });
}

/*
    ---------- CLICK BUTTON TO SUBMIT FORM ----------
 */

window.submit_form_contract_create = function () {
    var data = {
        'login': $('#login').val(),
    };

    executeAjaxValidateLogin(data, url_ajax_usinas_validate_login_senha);
};

function errorFocus() {
    $('.is-invalid').first().focus();
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

function isValidNumber(id, min) {
    let input = parseInt($(id).val());

    if (typeof input == "undefined" || isNaN(input)) {
        $(id).addClass('is-invalid');
        return false;
    }

    if (input <= min) {
        $(id).addClass('is-invalid');
        return false;
    }

    $(id).removeClass('is-invalid');
    return true;
}

function isValidMoney(id, min) {
    let value = $(id).val();
    value = parseInt(value.split('.').join("").split(',').join(""));

    if (value <= min || isNaN(value)) {
        $(id).addClass('is-invalid');
        return false;
    } else {
        $(id).removeClass('is-invalid');
        return true;
    }
}

/*
    ---------- Submit Form Create new Contract ----------
 */

function executeAjaxValidateLogin(data, url) {
    submit();
    
    /*$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'GET',
        dataType: "json",
        data: data,
        success: function (resp) {
            if (resp.status) {
                submit();
            } else {
                $('#login').addClass('is-invalid');
                errorFocus();
            }
        },
        error: function (resp) {
            $('#login').addClass('is-invalid');
        }
    });*/
}

function submit() {
    let submit = true;

    // if (!isValidInput('#cc', 3)) submit = false;
    if (!isValidInput('#nome', 3)) submit = false;
    if (!isValidInput('#apelido', 3)) submit = false;
    if (!isValidInput('#documento', 3)) submit = false;
    if (!isValidInput('#login', 3)) submit = false;
    if (!isValidInput('#senha', 3)) submit = false;
    if (!isValidInput('#producaoMeta', 3)) submit = false;
    if (!isValidNumber('#diaLeitura', 0)) submit = false;
    if (!isValidNumber('#ciclo', 0)) submit = false;
    if (!isValidMoney('#investimento', 1)) submit = false;
    
    errorFocus();

    if (submit) $("#form-update-usina").submit();
}






