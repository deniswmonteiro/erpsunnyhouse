//init
var autocompleTeam = null;
var email_is_valid = true;

$(document).ready(function () {

    // AutoComplete team name
    autocompleTeam = autocomplete(document.getElementById("team"), teams);

    initComponents();
    eventsHandler();

});

function initComponents() {
    $('#new_team').hide();

    //Mask
    $('#phone').mask(window.SPMaskBehavior, spOptions);
    $('#cep').mask('00000-000');
    $('#name').removeClass('is-invalid');
    $('#email').removeClass('is-invalid');
    $('#team').removeClass('is-invalid');
    $('#cep').removeClass('is-invalid');
    $('#phone').removeClass('is-invalid');
    $('#address').removeClass('is-invalid');
    $('#number').removeClass('is-invalid');
    $('#complement').removeClass('is-invalid');


}

function eventsHandler() {
    $('#name').on('change paste keyup input create', function (e) {

        if (this.value.length >= 5) {
            $('#name').removeClass('is-invalid');
        } else {
            $('#name').addClass('is-invalid');
        }

    });

    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms, 1 second
    $('#email').on('change paste keyup input create focus', function (e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(executeAjaxEmail, doneTypingInterval);

    });

    $('#phone').on('change paste keyup input create focus', function (e) {

        if (this.value.length >= ('(00) 0000-0000'.length)) {
            $('#phone').removeClass('is-invalid');
        } else {
            $('#phone').addClass('is-invalid');
        }
    });

    $('#cep').on('change paste keyup input create focus', function (e) {

        if (this.value.length === '00000-000'.length) {
            // $('#cep').removeClass('is-invalid');

            $.ajax({
                url: 'https://viacep.com.br/ws/' + $(this).val().replace("-", "") + '/json/unicode/',
                dataType: 'json',
                success: function (resposta) {
                    if (typeof resposta.erro === 'undefined') {
                        $("#address").val(
                            resposta.logradouro + ' - ' +
                            resposta.bairro + ' - ' +
                            resposta.localidade + ' - ' +
                            resposta.uf
                        );
                    }
                }
            });

        } else {
            // $('#cep').addClass('is-invalid');
        }
    });

    $('#btn-create-team').on('click', function () {
        let name = $('#team-name').val();

        if (name.length >= 5) {
            $('#team-name').removeClass('is-invalid');
            var data = {
                'team-name': name
            };

            executeAjaxCreateTeam(data, url_ajax_store_team);
        } else {
            $('#team-name').addClass('is-invalid');
        }
    });
}

window.submit_form_seller_update = function () {
    let submit = true;
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if ($('#name').val().length < 5) submit = false;
    if (!regex.test($('#email').val())) submit = false;
    if ($('#phone').val().length < '(00) 0000-0000'.length) submit = false;
    if (!email_is_valid) submit = false;
    if ($("#team").hasClass("is-invalid")) submit = false;

    return submit
};

function executeAjaxEmail() {
    var email = $("#email").val();
    var name = $("#name").val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_ajax_email,
        type: 'GET',
        dataType: "json",
        data: {email: email, seller: seller, name: name},
        success: function (data) {
            validateEmail(data);
        },
        error: function (resposta) {

        }
    });
}

function validateEmail(msg) {
    if (msg.exist_email) {

        $('#email_feedback').text("Email Inválido - Endereço já utilizado no sistema");
        $('#email').addClass('is-invalid');

    } else if (msg.validated_fail) {
        $('#email_feedback').text("Email Inválido.");
        $('#email').addClass('is-invalid');

    } else {
        $('#email').removeClass('is-invalid');
    }

    if (msg.exist_name) {
        $('#name_feedback').text("Nome Inválido - Já utilizado no sistema");
        $('#name').addClass('is-invalid');

    } else {
        $('#name').removeClass('is-invalid');

    }

    if ($('#name').val().length < 5) {
        $('#name_feedback').text("Mínimo 5 caracteres.");
        $('#name').addClass('is-invalid');

    }

    if (!msg.exist_email && !msg.exist_name && !msg.validated_fail) {
        email_is_valid = true;

    } else {
        email_is_valid = false;

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
    ---------- Create new Team ----------
 */

function executeAjaxCreateTeam(data, url) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'GET',
        dataType: "json",
        data: data,
        success: function (resp) {
            validateCreateTeam(resp);
        },
        error: function (resposta) {
        }
    });
}

function validateCreateTeam(resp) {

    if (resp.saved) {
        autocompleTeam = null;
        autocompleTeam = autocomplete(document.getElementById("team"), resp.items);

        $('#team').val(resp.name);
        $('#team').removeClass('is-invalid');
        $('#modal_new_team').modal('hide');

    }
}
