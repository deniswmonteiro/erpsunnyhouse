//init
var autocompleClient = null;

$(document).ready(function () {
    // AutoComplete conta contrato
    autocompleClient = autocomplete(document.getElementById("cc"), cc);

    initComponents();
    // eventsHandler();
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
            // Convert int to string
            arr[i] = arr[i].toString();

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
                $('#login').addClass('is-invalid');
                errorFocus();
            }
        },
        error: function (resp) {
            $('#login').addClass('is-invalid');
        }
    });
}

function submit() {
    let submit = true;

    if (!isValidInput('#cc', 3)) submit = false;
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

    if (submit) $("#form-create-usina").submit();
}
