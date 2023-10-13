//init
var autocompleClient = null;

$(document).ready(function () {
    // AutoComplete client
    autocompleClient = autocomplete(document.getElementById("client"), clients);

    initComponents();
    eventsHandler();
});

function initComponents() {
    const today = Date.now();
    const passwordDate = toDateFormat(today, "en-us");

    $('#new_client').hide();

    $("#client-password").attr("max", passwordDate);
    $('#client-phone').mask(window.SPMaskBehavior, spOptions);
    $('#client-cep').mask('00000-000');
    $('#client-cpf').mask('000.000.000-00', { reverse: true });
    $('#client-cnpj').mask('00.000.000/0000-00', { reverse: true });
    $('#client-login').mask('000.000.000-00', { reverse: true });

    $('#contract-vigencia').mask('#0');
    $('#quantidade').mask('###0,00', {reverse: true});
    $('#potencia').mask('###0,00', {reverse: true});
    $('.money').mask("#.##0,00", { reverse: true });
    $('#desconto').mask('#0');
    $('#tarifa_base').mask('###0,00', {reverse: true});
    $('#meta_gestao').mask('###0,00', {reverse: true});
}

function eventsHandler() {
    $('#client-name').on('change paste keyup input focus', function (e) {
        if ($('#client-name').val().length < 5) {
            $('#name-feedback-client').text("Nome Inválido - Mínimo 5 Caracteres.");
            $('#client-name').addClass('is-invalid');
        }

        else $('#client-name').removeClass('is-invalid');
    });

    $('#client-email').on('change paste keyup input focus', function (e) {
        var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if ($('#client-email').val().match(mailformat)) {
            $('#client-email').removeClass('is-invalid');
        } else {
            $('#client-email').addClass('is-invalid');
            $('#client-email-feedback').text("E-Mail Inválido - Formato incorreto.");
        }
    });

    $('#client-phone').on('change paste keyup input create focus', function (e) {
        if (this.value.length === ('(00) 00000-0000'.length) || this.value.length === ('(00) 0000-0000'.length)) {
            $('#client-phone').removeClass('is-invalid');
        } else {
            $('#client-phone').addClass('is-invalid');
        }
    });

    $('#client-cep').on('change paste keyup input create focus', function (e) {
        if (this.value.length === '00000-000'.length) {
            // $('#cep').removeClass('is-invalid');

            $.ajax({
                url: 'https://viacep.com.br/ws/' + $(this).val().replace("-", "") + '/json/unicode/',
                dataType: 'json',
                success: function (resposta) {
                    if (typeof resposta.erro === 'undefined') {
                        $("#client-address").val(resposta.logradouro);
                        $("#client-state").val(resposta.uf);
                        $("#client-city").val(resposta.localidade);
                        $("#client-neighborhood").val(resposta.bairro);

                        isValidInput('#client-address', 2);
                        isValidInput('#client-state', 2);
                        isValidInput('#client-city', 2);
                        isValidInput('#client-neighborhood', 2);
                    }
                }
            });

        } else {
            // $('#cep').addClass('is-invalid');
        }
    });

    $('#client-cpf').on('change paste keyup input create focus', function (e) {
        if ($('#client-cpf').val().length === '000.000.000-00'.length) {
            $('#client-cpf').removeClass('is-invalid');
        } else {
            $('#client-cpf').addClass('is-invalid');
            $('#client-cpf-feedback').text("CPF Inválido - Formato incorreto.");
        }
    });

    $('#client-cnpj').on('change paste keyup input create focus', function (e) {
        if (this.value.length === ('00.000.000/0000-00'.length)) {
            $('#client-cnpj').removeClass('is-invalid');
        } else {
            $('#client-cnpj').addClass('is-invalid');
        }
    });

    $('#client-checkbox-type').on('change', function () {
        let isChecked = $('#client-checkbox-type').is(':checked');
        const login = document.querySelector("#client-login");
        const password = document.querySelector("#client-password");

        if (isChecked) {
            $('#client-cnpj').closest('.form-group').removeClass("d-none");
            $('#client-corporate-name').closest('.form-group').removeClass("d-none");
            $('#login').mask('00.000.000/0000-00', { reverse: true });

            password.setAttribute("type", "text");
            password.classList.remove("date");
            window.validateLogin(login);
        }

        else {
            $('#client-cnpj').closest('.form-group').addClass("d-none");
            $('#client-corporate-name').closest('.form-group').addClass("d-none");
            $('#login').mask('000.000.000-00', { reverse: true });

            password.setAttribute("type", "date");
            password.classList.add("date");
            window.validateLogin(login);
            window.validatePassword(password);
        }
    });

    $('#modal_new_client').on('hidden.bs.modal', function (e) {
        $('#client-name').val('');
        $('#client-name').removeClass('is-invalid');
        $('#client-phone').val('');
        $('#client-phone').removeClass('is-invalid');
        $('#client-address').val('');
        $('#client-address').removeClass('is-invalid');
        $('#client-cep').val('');
        $('#client-cep').removeClass('is-invalid');
        $('#client-number').val('');
        $('#client-number').removeClass('is-invalid');
        $('#client-email').val('');
        $('#client-email').removeClass('is-invalid');
        $('#client-complement').val('');
        $('#client-complement').removeClass('is-invalid');
        $('#client-cpf').removeClass('is-invalid');
        $('#client-cpf').val('');
        $('#client-cnpj').removeClass('is-invalid');
        $('#client-cnpj').val('');
        $('#client-corporate-name').removeClass('is-invalid');
        $('#client-corporate-name').val('');
    });

    $('#btn-create-client').on('click', function () {
        var data = {
            'client-name': $('#client-name').val(),
            'client-cpf': $('#client-cpf').val(),
            'checkbox-is-pj': $('#client-checkbox-type').is(':checked') ? 'on' : 'off',
            'client-cnpj': $('#client-cnpj').val(),
            'client-corporate-name': $('#client-corporate-name').val(),
            'client-email': $('#client-email').val(),
            'client-phone': $('#client-phone').val(),
            'client-cep': $('#client-cep').val(),
            'client-address': $('#client-address').val(),
            'client-number': $('#client-number').val(),
            'client-state': $('#client-state').val(),
            'client-city': $('#client-city').val(),
            'client-neighborhood': $('#client-neighborhood').val(),
            'client-complement': $('#client-complement').val(),
            'checkbox-add-credentials': $('#chk-add-credentials').is(':checked') ? 'on' : 'off',
            'client-login': $("#client-login").val(),
            'client-password': $("#client-password").val(),
        };

        executeAjaxCreateClient(data, url_ajax_store_client);
    });

    eventsModalClient();
}

function eventsModalClient() {
    $('#client-cep').on('input change paste keyup focus', function () {
        isValidCEP('#' + this.id);
    });

    $('#client-address, #client-state, #client-city, #client-neighborhood')
        .on('change paste keyup input create focus', function () {
            isValidInput('#' + this.id, 2);
        });

    $('#client-number').on('change paste keyup input create focus', function () {
        isValidInput('#' + this.id, 1);
    });
}

/** show inputs to add credentials */
window.checkIfAddCredentials = function (el) {
    const credentials = document.querySelector("#credentials");

    el.checked ? credentials.classList.remove("d-none") : credentials.classList.add("d-none");
}

window.validateLogin = function (el) {
    const loginFeedback = document.querySelector("#login-feedback-create-client");
    const clientType = document.querySelector("#client-checkbox-type");

    if (clientType.checked) {
        if (el.value.length === 0) {
            loginFeedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(loginFeedback, false);
            return false;
        }

        else if (el.value.length < 14) {
            loginFeedback.innerText = "Mínimo de 14 dígitos.";
            validate(el, false);
            validateFeedback(loginFeedback, false);
            return false;
        }

        else {
            loginFeedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(loginFeedback, true);
            return true;
        }
    }

    else {
        if (el.value.length === 0) {
            loginFeedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(loginFeedback, false);
            return false;
        }

        else if (el.value.length < 14) {
            loginFeedback.innerText = "Mínimo de 11 dígitos.";
            validate(el, false);
            validateFeedback(loginFeedback, false);
            return false;
        }

        else {
            loginFeedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(loginFeedback, true);
            return true;
        }
    }
}

window.validatePassword = function (el) {
    const passwordFeedback = document.querySelector("#password-feedback-create-client");
    const clientType = document.querySelector("#client-checkbox-type");

    if (clientType.checked) {
        el.removeAttribute("maxlength");

        if (el.value.length === 0) {
            passwordFeedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(passwordFeedback, false);
            return false;
        }

        else if (el.value.length < 5) {
            passwordFeedback.innerText = "Mínimo de 5 dígitos.";
            validate(el, false);
            validateFeedback(passwordFeedback, false);
            return false;
        }

        else if (!/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/.test(el.value)) {
            passwordFeedback.innerText = "Digite um email válido.";
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

    else {
        el.setAttribute("maxlength", "10");

        if (el.value.length === 0) {
            passwordFeedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(passwordFeedback, false);
            return false;
        }

        else if (el.value.split("-").length < 3) {
            passwordFeedback.innerText = "Digite uma data válida.";
            validate(el, false);
            validateFeedback(passwordFeedback, false);
            return false;
        }

        else if (el.value.split("-")[0] < 1900) {
            passwordFeedback.innerText = "Digite um ano de nascimento válido.";
            validate(el, false);
            validateFeedback(passwordFeedback, false);
            return false;
        }

        else if (el.value.length < 10) {
            passwordFeedback.innerText = "Mínimo de 8 dígitos.";
            validate(el, false);
            validateFeedback(passwordFeedback, false);
            return false;
        }

        else if (el.value.length > 10) {
            passwordFeedback.innerText = "Máximo de 8 dígitos.";
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

/*
    ---------- AUTOCOMPLETE ----------
 */
function autocomplete(inp, arr) {
    var has_items = false;
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    $('#' + inp.id).on('input', function (e) {
        has_items = false;
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
            $('#new_' + inp.id).show();
            $('#' + inp.id).addClass('is-invalid');
            return false;
        } else {
            $('#new_' + inp.id).hide();
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", "autocomplete-list-" + inp.id);
        a.setAttribute("class", "autocomplete-items ");
        a.setAttribute("style", "margin-left: 25px; width:" + $('#' + inp.id).parent().width() + 'px');
        /*append the DIV element as a child of the autocomplete container:*/

        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        var limit = 10;
        var size = 0;
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].toLowerCase().includes(val.toLowerCase()) && size < limit) {
                has_items = true;
                size++;
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                let text = arr[i];
                var reg = new RegExp('(' + val + ')', 'gi');
                b.innerHTML = text.replace(reg, '<strong>$1</strong>');

                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;

                    /*change class is-invalid*/
                    if (arr.indexOf(inp.value) >= 0) {
                        $('#' + inp.id).removeClass('is-invalid');
                    } else {
                        $('#' + inp.id).addClass('is-invalid');
                    }

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }

        if (arr.indexOf(this.value) >= 0) {

            $('#' + inp.id).removeClass('is-invalid');

        } else {

            if (!has_items || !$('#' + inp.id).val()) {
                $('#new_' + inp.id).show();
            } else {
                $('#new_' + inp.id).hide();
            }

            $('#' + inp.id).addClass('is-invalid');
        }
    });

    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById("autocomplete-list-" + inp.id);

        if (x) x = x.getElementsByTagName("div");
        currentFocus = (typeof currentFocus === 'undefined') ? -1 : currentFocus;

        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

/*
    ---------- Create new client ----------
 */
function executeAjaxCreateClient(data, url) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'GET',
        dataType: "json",
        data: data,
        success: function (resp) {
            validateCreateClient(resp);
        },
        error: function (resposta) {

        }
    });
}

function validateCreateClient(resp) {
    if (resp.saved) {
        autocompleClient = null;
        autocompleClient = autocomplete(document.getElementById("client"), resp.items);

        resp.hasOwnProperty("corporateName") ?
            $('#client').val(resp.corporateName) :
            $('#client').val(resp.name);

        $('#client').removeClass('is-invalid');
        $('#modal_new_client').modal('hide');
    }

    else {
        if (resp.corporate_name_invalid) {
            $('#client-corporate-name').focus();
            $('#client-corporate-name').addClass('is-invalid');
        }

        if (resp.cnpj_invalid) {
            $('#client-cnpj').focus();
            $('#client-cnpj').addClass('is-invalid');
        }

        if (resp.name_invalid) {
            $('#client-name').focus();
            $('#client-name').addClass('is-invalid');
        }

        if (resp.cpf_invalid) {
            $('#client-cpf').focus();
            $('#client-cpf').addClass('is-invalid');
        }

        if (resp.email_invalid) {
            $('#client-email').focus();
            $('#client-email').addClass('is-invalid');
        }

        if (resp.invalid_email) {
            $('#client-email').focus();
            $('#client-email').addClass('is-invalid');
        }

        if (resp.invalid_phone) {
            $('#client-phone').focus();
            $('#client-phone').addClass('is-invalid');
        }

        if (resp.cep_invalid) {
            $('#client-cep').focus();
            $('#client-cep').addClass('is-invalid');
        }

        if (resp.address_invalid) {
            $('#client-corporate-name').focus();
            $('#client-address').addClass('is-invalid');
        }

        if (resp.number_invalid) {
            $('#client-number').focus();
            $('#client-number').addClass('is-invalid');
        }

        if (resp.state_invalid) {
            $('#client-state').focus();
            $('#client-state').addClass('is-invalid');
        }

        if (resp.city_invalid) {
            $('#client-city').focus();
            $('#client-city').addClass('is-invalid');
        }

        if (resp.neighborhood_invalid) {
            $('#client-neighborhood').focus();
            $('#client-neighborhood').addClass('is-invalid');
        }

        if (resp.login_invalid) {
            $('#client-login').focus();
            $('#client-login').addClass('is-invalid');
        }

        if (resp.password_invalid) {
            $('#client-password').focus();
            $('#client-password').addClass('is-invalid');
        }
    }
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

function isValidCEP(id) {
    if ($(id).val() && $(id).val().length === '00000-000'.length) {
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

/** insert the client field value into the new client name field on the modal */
window.handleClientNameOnNewClientModal = function () {
    const clientNameValue = document.querySelector("#client").value;
    const newClientName = document.querySelector("#client-name");

    newClientName.value = clientNameValue;
}

window.calculateQuota = function (el) {
    const quantidade = parseFloat(el.value.replace(".", "").replace(",", "."));
    let quota = quantidade / 116;
    let fixQuota = quota.toFixed(2).replace(".", ",");

    $("#potencia").val(fixQuota);
}

// formats date in milliseconds to "yyyy-mm-dd" or "dd/mm/yyyy"
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

/*
    ---------- CLICK BUTTON TO SUBMIT FORM ----------
 */

window.submit_form_contract_create = function () {
    var data = {
        'name': $('#client').val(),
    };

    executeAjaxValidateClientName(data, url_ajax_client_validate_name);
};

function errorFocus() {
    $('.is-invalid').first().focus();
}

/*
    ---------- Submit Form Create new Contract ----------
 */

function executeAjaxValidateClientName(data, url) {
    $.ajax({
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
                $('#client').addClass('is-invalid');
                errorFocus();
            }
        },
        error: function (resp) {
            $('#client').addClass('is-invalid');
        }
    });
}

function submit() {
    let submit = true;
    let selectType = $("#type").val();
    // let selectStatus = $("#status").val();

    if (selectType == null) {
        submit = false;
        $("#type").addClass('is-invalid');
    }

    $("#status").val('minuta');
    /*if (selectStatus == null) {
        submit = false;
        $("#status").addClass('is-invalid');
    }*/

    if (!isValidInput('#client', 3)) submit = false;
    if (!isValidInput('#potencia', 1)) submit = false;
    if (!isValidInput('#quantidade', 3)) submit = false;
    if (!isValidNumber('#contract-vigencia', 0)) submit = false;
    // if (!isValidInput('#contract-date', 2)) submit = false;
    if (!isValidMoney('#payment_value', 1)) submit = false;

    if (!isValidNumber('#desconto', 0)) submit = false;
    if (!isValidMoney('#tarifa_base', 1)) submit = false;
    if (!isValidMoney('#meta_gestao', 1)) submit = false;
    
    errorFocus();

    if (submit) $("#form-create-contract").submit();
}
