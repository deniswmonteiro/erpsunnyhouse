// INIT
$(document).ready(function () {
    autocomplete(document.querySelector("#seller-team"), teams);  // Seller Team

    // Mask
    $("#seller-phone").mask(window.SPMaskBehavior, spOptions);
    $("#seller-cep").mask("00000-000");
    $("#seller-state").mask("ZZ", {
        translation: {
            "Z": {
                pattern: /[A-Z]/,
            }
        }
    });
});

/** FUNCTIONS */
/** Autocomplete */
function autocomplete(inp, arr) {
    let hasItems = false;
    let currentFocus;
    const btnCreate = $("#btn-create-team");
    const feedback = $("#seller-create-feedback-team");

    // Execute a function when someone writes in the text field
    $(`#${inp.id}`).on("input", function (e) {
        hasItems = false;
        let a, b, i;
        const val = this.value;

        // Close any already open lists of autocompleted values
        closeAllLists();

        if (!val) {
            $(`#new_${inp.id}`).show();

            $(`#${inp.id}`).removeClass("is-valid");
            $(`#${inp.id}`).addClass("is-invalid");

            btnCreate.attr("disabled", true);

            feedback.text("Preencha o campo.");
            feedback.removeClass("valid-feedback");
            feedback.addClass(["invalid-feedback", "d-block"]);

            return false;
        }

        else {
            $(`#new_${inp.id}`).hide();

            $(`#${inp.id}`).removeClass("is-valid");
            $(`#${inp.id}`).addClass("is-invalid");

            btnCreate.removeAttr("disabled");

            feedback.text("Time de Vendas não encontrado.");
            feedback.removeClass("valid-feedback");
            feedback.addClass(["invalid-feedback", "d-block"]);
        }

        currentFocus = -1;

        // Create a DIV element that will contain the items (values)
        a = document.createElement("DIV");
        a.setAttribute("id", `autocomplete-list-${inp.id}`);
        a.setAttribute("class", "autocomplete-items");
        a.setAttribute("style", `margin-left: 0; margin-top: 40px; width: ${$(`#${inp.id}`).parent().width()}px`);

        // Append the DIV element as a child of the autocomplete container
        this.parentNode.appendChild(a);

        // For each item in the array
        const limit = 10;
        let size = 0;

        for (i = 0; i < arr.length; i++) {
            // Check if the item starts with the same letters as the text field value
            if (arr[i].toLowerCase().includes(val.toLowerCase()) && size < limit) {
                hasItems = true;
                size++;

                // Create a DIV element for each matching element
                b = document.createElement("DIV");

                // Make the matching letters bold
                const text = arr[i];
                const reg = new RegExp(`(${val})`, 'gi');
                b.innerHTML = text.replace(reg, '<strong>$1</strong>');

                // Insert a input field that will hold the current array item's value
                b.innerHTML += `<input type="hidden" value="${arr[i]}">`;

                // Execute a function when someone clicks on the item value (DIV element)
                b.addEventListener("click", function (e) {
                    // Insert the value for the autocomplete text field
                    inp.value = this.getElementsByTagName("input")[0].value;

                    $(`#${inp.id}`).removeClass("is-invalid");
                    $(`#${inp.id}`).addClass("is-valid");

                    btnCreate.attr("disabled", true);

                    feedback.text("Formato aceito.");
                    feedback.removeClass("invalid-feedback");
                    feedback.addClass("valid-feedback");

                    // Close the list of autocompleted values (or any other open lists of autocompleted values
                    closeAllLists();
                });

                a.appendChild(b);
            }
        }

        if (arr.indexOf(this.value) >= 0) $(`#${inp.id}`).removeClass("is-invalid");

        else {
            if (!hasItems || !$(`#${inp.id}`).val()) $(`#new_${inp.id}`).show();
            else $(`#new_${inp.id}`).hide();

            $(`#${inp.id}`).addClass("is-invalid");
        }
    });

    // Execute a function presses a key on the keyboard
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(`autocomplete-list-${inp.id}`);

        if (x) x = x.getElementsByTagName("div");
        currentFocus = (typeof currentFocus === "undefined") ? -1 : currentFocus;

        // If the arrow DOWN key is pressed, increase the currentFocus variable
        if (e.keyCode == 40) {
            currentFocus++;

            // And and make the current item more visible
            addActive(x);
        }

        // If the arrow UP key is pressed, decrease the currentFocus variable
        else if (e.keyCode == 38) {
            currentFocus--;

            // And and make the current item more visible
            addActive(x);
        }

        // If the ENTER key is pressed, prevent the form from being submitted
        else if (e.keyCode == 13) {
            e.preventDefault();

            if (currentFocus > -1) {
                // And simulate a click on the "active" item
                if (x) x[currentFocus].click();
            }
        }
    });

    // A function to classify an item as "active"
    function addActive(x) {
        if (!x) return false;

        // Start by removing the "active" class on all items
        removeActive(x);

        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);

        // Add class "autocomplete-active"
        x[currentFocus].classList.add("autocomplete-active");
    }

    // A function to remove the "active" class from all autocomplete items
    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    // Close all autocomplete lists in the document except the one passed as an argument
    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");

        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) x[i].parentNode.removeChild(x[i]);
        }
    }

    // Execute a function when someone clicks in the document
    document.addEventListener("click", (e) => closeAllLists(e.target));
}

/** Insert the field value into the new name field on the modal */
window.handleNameOnNewItemModal = function () {
    let nameValue = document.querySelector(`#seller-team`);
    const newItemName = document.querySelector("#team-name");

    newItemName.value = nameValue.value;
}

/** Fill in address fields when the CEP is filled */
window.fillInAddressFields = async function (el) {
    const isValidCep = window.validateCep(el);
    const feedback = el.closest(".form-group").lastElementChild;
    const address = document.querySelector("#seller-address");
    const number = document.querySelector("#seller-number");
    const complement = document.querySelector("#seller-complement");
    const neighborhood = document.querySelector("#seller-neighborhood");
    const city = document.querySelector("#seller-city");
    const state = document.querySelector("#seller-state");
    const addressFields = [
        el, address, number, complement, neighborhood, city, state
    ];
    const addressInformationsLoading = document.querySelector("#seller-cep-loading");

    if (isValidCep && el.value.length > 0) {
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

            address.value = result.logradouro;
            neighborhood.value = result.bairro;
            city.value = result.localidade;
            state.value = result.uf;

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

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** VALIDATIONS */
window.validateInput = function (el, min) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.hasAttribute("required") || el.value.length > 0) {
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

window.validateCep = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.hasAttribute("required") || el.value.length > 0) {
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

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateFieldWithAutoComplete = function (el, arrType) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.hasAttribute("required") || el.value.length > 0) {
        if (arrType.find(elem => elem === el.value)) {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }

        else if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else {
            feedback.innerText = "Time de Vendas não cadastrado no sistema.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }
    }

    else {
        feedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(feedback, true);
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
/** Create Seller Team */
window.submitCreateSellerTeam = async function (el) {
    let submit = true;
    const modalCreateSellerTeam = document.querySelector("#modal-create-team");
    const teamName = document.querySelector("#team-name");
    const sellerTeam = document.querySelector("#seller-team");
    const btnCreateTeam = document.querySelector("#btn-create-team");
    const sellerTeamFeedback = sellerTeam.closest(".form-group").lastElementChild;

    const isValidTeamName = window.validateInput(teamName, 5);

    if (!isValidTeamName) submit = false;

    errorFocus();

    if (submit) {
        const btnCreateSellerTeamLoading = document.querySelector("#btn-create-team-loading");

        el.setAttribute("disabled", true);
        btnCreateSellerTeamLoading.classList.remove("d-none");

        /** Fetch Seller Team data */
        const body = {
            "name": teamName.value,
        };

        const response = await fetch(url_ajax_store_team, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(body)
        });

        const result = await response.json();

        if (result.status) {
            teams = null;
            teams = result.teams_names;
            autocomplete(document.querySelector("#seller-team"), teams);

            sellerTeam.value = result.team_name;
            sellerTeam.classList.remove("is-invalid");
            sellerTeam.classList.add("is-valid");

            btnCreateTeam.setAttribute("disabled", true);

            sellerTeamFeedback.innerText = "Formato aceito.";
            sellerTeamFeedback.classList.remove("invalid-feedback");
            sellerTeamFeedback.classList.add("valid-feedback", "d-block");

            $("#modal-create-team").modal("hide");

            el.removeAttribute("disabled");
            btnCreateSellerTeamLoading.classList.add("d-none");
        }

        else {
            const modalCreateSellerTeamBody = document.querySelector(`#${modalCreateSellerTeam.id} .modal-body`);

            [...result.message].forEach((message, key) => {
                modalCreateSellerTeamBody.insertAdjacentHTML("afterbegin", `
                    <span class="alert alert-danger alert-dismissible show fade mb-0"
                        id="alert-create-seller-team-${key}">
                        <span class="fw-bold">${message}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            style="top: -1 !important;" 
                            aria-label="Close"></button>
                    </span>
                `);

                alert = document.querySelector(`#alert-create-seller-team-${key}`);
                alert.style.width = "400px";
                alert.style.margin = "0 auto";
                alert.style.display = "block";
            });

            el.removeAttribute("disabled");
            btnCreateSellerTeamLoading.classList.add("d-none");

            $("span.alert")
                .delay(2000)
                .fadeOut(350);
        }
    }
}

/** Edit Seller */
window.submitFormEditSeller = async function () {
    let submit = true;
    const formEditSeller = document.querySelector("#form-edit-seller");
    const sellerName = document.querySelector("#seller-name");
    const sellerPhone = document.querySelector("#seller-phone");
    const sellerEmail = document.querySelector("#seller-email");
    const sellerTeam = document.querySelector("#seller-team");
    const sellerCep = document.querySelector("#seller-cep");
    const sellerAddress = document.querySelector("#seller-address");
    const sellerNumber = document.querySelector("#seller-number");
    const sellerComplement = document.querySelector("#seller-complement");
    const sellerNeighborhood = document.querySelector("#seller-neighborhood");
    const sellerCity = document.querySelector("#seller-city");
    const sellerState = document.querySelector("#seller-state");

    const isValidSellerName = window.validateInput(sellerName, 5);
    const isValidSellerPhone = window.validatePhone(sellerPhone, 10);
    const isValidSellerEmail = window.validateEmail(sellerEmail);
    const isValidSellerTeam = window.validateFieldWithAutoComplete(sellerTeam, teams);
    const isValidSellerCep = window.validateCep(sellerCep);
    const isValidSellerAddress = window.validateInput(sellerAddress, 5);
    const isValidSellerNumber = window.validateInput(sellerNumber, 1);
    const isValidSellerComplement = window.validateInput(sellerComplement, 2);
    const isValidSellerNeighborhood = window.validateInput(sellerNeighborhood, 2);
    const isValidSellerCity = window.validateInput(sellerCity, 2);
    const isValidSellerState = window.validateInput(sellerState, 2);

    if (!isValidSellerName) submit = false;
    if (!isValidSellerPhone) submit = false;
    if (!isValidSellerEmail) submit = false;
    if (!isValidSellerTeam) submit = false;
    if (!isValidSellerCep) submit = false;
    if (!isValidSellerAddress) submit = false;
    if (!isValidSellerNumber) submit = false;
    if (!isValidSellerComplement) submit = false;
    if (!isValidSellerNeighborhood) submit = false;
    if (!isValidSellerCity) submit = false;
    if (!isValidSellerState) submit = false;

    errorFocus();

    if (submit) formEditSeller.submit();
}