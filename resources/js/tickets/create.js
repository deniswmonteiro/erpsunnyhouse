/** INIT FUNCTIONS */
$(document).ready(function () {
    window.autocomplete(document.querySelector("#ticket-contract"), contracts);
    window.autocomplete(document.querySelector("#ticket-client"), clients);
});

/** FUNCTIONS */
/** Autocomplete */
window.autocomplete = function (inp, arr) {
    let has_items = false;
    let currentFocus;
    const feedback = $(`#${inp.id}`).next();
    const inputItem = (inp.id.split("-")[1] === "contract") ? "Contrato" : "Cliente";

    $(`#${inp.id}`).on("input", function (e) {
        let a, b, i, val = this.value;
        has_items = false;

        closeAllLists();

        if (!val) {
            $(`#new_${inp.id}`).show();
            $(`#${inp.id}`).removeClass("is-valid");
            $(`#${inp.id}`).addClass("is-invalid");
            feedback.text("Preencha o campo.");
            feedback.removeClass("valid-feedback");
            feedback.addClass("invalid-feedback");
            return false;
        }

        else {
            $(`#new_${inp.id}`).hide();
            $(`#${inp.id}`).removeClass("is-valid");
            $(`#${inp.id}`).addClass("is-invalid");
            feedback.text(`${inputItem} não encontrado.`);
            feedback.removeClass("valid-feedback");
            feedback.addClass("invalid-feedback");
        }

        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", `autocomplete-list-${inp.id}`);
        a.setAttribute("class", "autocomplete-items ");
        a.setAttribute("style", "margin-left: 24px; margin-top: -23px; width: 705px");

        this.parentNode.appendChild(a);
        const limit = 10;
        let size = 0;

        for (i = 0; i < arr.length; i++) {
            if (arr[i]["client"].toLowerCase().includes(val.toLowerCase()) && size < limit) {
                let text;
                has_items = true;
                size++;

                b = document.createElement("DIV");

                if (inputItem === "Contrato") {
                    text = (arr[i]["generator_power"] === null) ?
                        `${arr[i]["client"]}` :
                        `${arr[i]["client"]} (${arr[i]["generator_power"]} kWp)`;
                }

                else text = `${arr[i]["client"]}`;

                const reg = new RegExp(`(${val})`, "gi");

                b.innerHTML = text.replace(reg, "<strong>$1</strong>");
                b.innerHTML += `<input type="hidden" value="${arr[i]['client']}">`;

                b.addEventListener("click", function (e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    $(`#${inp.id}`).removeClass("is-invalid");
                    $(`#${inp.id}`).addClass("is-valid");
                    feedback.removeClass("invalid-feedback");
                    feedback.addClass(["valid-feedback", "d-block"]);
                    feedback.text("Formato aceito.");

                    closeAllLists();
                });

                a.appendChild(b);
            }
        }

        if (arr.indexOf(this.value) >= 0) $(`#${inp.id}`).removeClass("is-invalid");

        else {
            if (!has_items || !$(`#${inp.id}`).val()) $(`#new_${inp.id}`).show();
            else $(`#new_${inp.id}`).hide();

            $(`#${inp.id}`).addClass("is-invalid");
            feedback.text(`${inputItem} não encontrado.`);
            feedback.removeClass("valid-feedback");
            feedback.addClass(["invalid-feedback", "d-block"]);
        }
    });

    inp.addEventListener("keydown", function (e) {
        let x = document.getElementById(`autocomplete-list-${inp.id}`);

        if (x) x = x.getElementsByTagName("div");

        currentFocus = (typeof currentFocus === "undefined") ? -1 : currentFocus;

        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        }

        else if (e.keyCode == 38) {
            currentFocus--;
            addActive(x);
        }

        else if (e.keyCode == 13) {
            e.preventDefault();

            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        if (!x) return false;

        removeActive(x);

        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);

        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        for (let i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        const x = document.getElementsByClassName("autocomplete-items");

        for (let i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) x[i].parentNode.removeChild(x[i]);
        }
    }

    document.addEventListener("click", e => closeAllLists(e.target));
}

/** Use Client instead of Contract */
window.changeToClientData = function (el) {
    const ticketContract = document.querySelector("#ticket-contract");
    const ticketContractFeedback = document.querySelector("#ticket-feedback-contract-create");
    const ticketClient = document.querySelector("#ticket-client");
    const ticketClientFeedback = document.querySelector("#ticket-feedback-client-create");

    if (el.checked) {
        ticketContract.value = "";

        ticketContract.closest(".row").classList.add("d-none");
        ticketClient.closest(".row").classList.remove("d-none");
        ticketContract.removeAttribute("required");
        ticketClient.setAttribute("required", true);

        ticketContract.classList.remove("is-valid", "is-invalid");
        ticketContractFeedback.classList.remove("is-valid", "is-invalid");
        ticketContractFeedback.innerText = "";
    }

    else {
        ticketClient.value = "";

        ticketClient.closest(".row").classList.add("d-none");
        ticketContract.closest(".row").classList.remove("d-none");
        ticketClient.removeAttribute("required");
        ticketContract.setAttribute("required", true);

        ticketClient.classList.remove("is-valid", "is-invalid");
        ticketClientFeedback.classList.remove("is-valid", "is-invalid");
        ticketClientFeedback.innerText = "";
    }
}

/** Clear the form if the cancel button was clicked */
window.clearFormCreateTicket = function () {
    const title = document.querySelector("#ticket-title");
    const titleFeedback = document.querySelector("#ticket-feedback-title-create");
    const contract = document.querySelector("#ticket-contract");
    const contractFeedback = document.querySelector("#ticket-feedback-contract-create");
    const client = document.querySelector("#ticket-client");
    const clientFeedback = document.querySelector("#ticket-feedback-client-create");
    const type = document.querySelector("#ticket-type");
    const typeFeedback = document.querySelector("#ticket-feedback-type-create");
    const deadline = document.querySelector("#ticket-deadline");
    const deadlineFeedback = document.querySelector("#ticket-feedback-deadline-create");
    const chkUseClient = document.querySelector("#chk-use-client-data");

    title.value = "";
    contract.value = "";
    client.value = "";
    type.selectedIndex = 0;
    deadline.value = "";

    title.classList.remove("is-valid", "is-invalid");
    titleFeedback.classList.remove("is-valid", "is-invalid");
    titleFeedback.innerText = "";

    contract.classList.remove("is-valid", "is-invalid");
    contractFeedback.classList.remove("is-valid", "is-invalid");
    contractFeedback.innerText = "";

    client.classList.remove("is-valid", "is-invalid");
    clientFeedback.classList.remove("is-valid", "is-invalid");
    clientFeedback.innerText = "";

    type.classList.remove("is-valid", "is-invalid");
    typeFeedback.classList.remove("is-valid", "is-invalid");
    typeFeedback.innerText = "";

    deadline.classList.remove("is-valid", "is-invalid");
    deadlineFeedback.classList.remove("is-valid", "is-invalid");
    deadlineFeedback.innerText = "";

    chkUseClient.checked = false;
    window.changeToClientData(chkUseClient);
}

/** Formats date in milliseconds to "dd/mm/yyyy" or "yyyy-mm-dd" */
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

window.validateSelect = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.selectedIndex === 0) {
        feedback.innerText = "Escolha uma opção.";
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

window.validateContract = function (el) {
    const feedback = document.querySelector("#ticket-feedback-contract-create");

    if (el.hasAttribute("required")) {
        if (contracts.find(elem => elem["client"] === el.value)) {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }

        else {
            feedback.innerText = "Contrato não encontrado.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }
    }

    else {
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateClient = function (el) {
    const feedback = document.querySelector("#ticket-feedback-client-create");

    if (el.hasAttribute("required")) {
        if (clients.find(elem => elem["client"] === el.value)) {
            feedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(feedback, true);
            return true;
        }

        else {
            feedback.innerText = "Cliente não encontrado.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }
    }

    else {
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateTicketDeadline = function (el) {
    const feedback = document.querySelector("#ticket-feedback-deadline-create");
    const min = 8;
    const deadlineDate = el.value;
    const todayDate = toDateFormat(Date.now(), "en-us");

    if (isNaN(deadlineDate)) {
        if (deadlineDate.split("-").length < 3) {
            feedback.innerText = "Formato inválido.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (deadlineDate.split("-")[0].length > 4) {
            feedback.innerText = "O ano deve ter no máximo 4 dígitos.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (deadlineDate < todayDate) {
            feedback.innerText = "O Prazo deve ser igual ou maior a data de hoje.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (deadlineDate.length < 8) {
            feedback.innerText = `Mínimo de ${min} caracteres.`;
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
        feedback.innerText = "";
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
window.submitFormCreateTicket = async function () {
    let submit = true;
    const formCreateTicket = document.querySelector("#form-create-ticket");
    const title = document.querySelector("#ticket-title");
    const contract = document.querySelector("#ticket-contract");
    const contractId = document.querySelector("#ticket-contract-id");
    const client = document.querySelector("#ticket-client");
    const clientId = document.querySelector("#ticket-client-id");
    const type = document.querySelector("#ticket-type");
    const deadline = document.querySelector("#ticket-deadline");

    const isValidTicketTitle = window.validateInput(title, 2) ? true : false;
    const isValidTicketContract = contract.hasAttribute("required") ?
        window.validateContract(contract) ? true : false :
        true;
    const isValidTicketClient = client.hasAttribute("required") ?
        window.validateClient(client) ? true : false :
        true;
    const isValidTicketType = window.validateSelect(type) ? true : false;
    const isValidTicketDeadline = window.validateTicketDeadline(deadline) ? true : false;

    if (!isValidTicketTitle) submit = false;
    if (!isValidTicketContract) submit = false;
    if (!isValidTicketClient) submit = false;
    if (!isValidTicketType) submit = false;
    if (!isValidTicketDeadline) submit = false;

    errorFocus();

    if (submit) {
        const btnCreateTicket = document.querySelector("#btn-create-ticket");
        const btnCreateTicketLoading = document.querySelector("#btn-create-ticket-loading");
        let contractName;
        let clientName;

        btnCreateTicket.setAttribute("disabled", true);
        btnCreateTicketLoading.classList.remove("d-none");

        if (contract.hasAttribute("required")) {
            contractName = contracts.find(elem => {
                if (elem["client"] === contract.value) return elem;
            });

            contractId.value = contractName["contract_id"];
        }

        else {
            clientName = clients.find(elem => {
                if (elem["client"] === client.value) return elem;
            });

            clientId.value = clientName["client_id"];
        }

        formCreateTicket.submit();
    }
}