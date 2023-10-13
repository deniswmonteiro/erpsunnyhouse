/** FUNCTIONS */
/** Change from text to icon in status badge */
window.changeStatusTextIcon = function (el) {
    const icon = document.querySelector(`#${el.id} i`);
    const text = document.querySelector(`#${el.id} span`);

    icon.classList.remove("d-none");
    text.classList.add("d-none");
}

/** Change from icon to text in status badge */
window.changeStatusIconText = function (el) {
    const icon = document.querySelector(`#${el.id} i`);
    const text = document.querySelector(`#${el.id} span`);

    icon.classList.add("d-none");
    text.classList.remove("d-none");
}

/** Clear the form if the cancel button was clicked */
window.clearFormGenerateReport = function () {
    const startDate = document.querySelector("#report-date-start");
    const startDateFeedback = document.querySelector("#start-date-feedback-report");
    const finalDate = document.querySelector("#report-date-end");
    const finalDateFeedback = document.querySelector("#end-date-feedback-report");

    startDate.value = "";
    startDate.classList.remove("is-valid", "is-invalid");
    startDateFeedback.classList.remove("is-valid", "is-invalid");
    startDateFeedback.innerText = "";

    finalDate.value = "";
    finalDate.classList.remove("is-valid", "is-invalid");
    finalDateFeedback.classList.remove("is-valid", "is-invalid");
    finalDateFeedback.innerText = "";
}

/** Clear the form if the cancel button was clicked */
window.clearFormEditStatus = function (el) {
    const elemItem = el.closest(".modal").id.split("-")[3];
    const status = document.querySelector(`#status-edit-${elemItem}`);
    const feedback = status.closest(".form-group").lastElementChild;

    status.value = "";
    status.classList.remove("is-valid", "is-invalid");
    feedback.classList.remove("valid-feedback", "invalid-feedback");
    feedback.innerText = "";
}

/** Formats date in milliseconds to "yyyy-mm-dd" or "dd/mm/yyyy" */
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

/** VALIDATIONS */
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

window.validateStartDate = function (el) {
    const startDate = el.value;
    const startDateFeedback = el.closest(".form-group").lastElementChild;
    const final = document.querySelector("#report-date-end");
    const finalDate = final.value;
    const finalDateFeedback = document.querySelector("#end-date-feedback-report");
    const minDate = el.getAttribute("min");
    const minDateValue = `${minDate.split("-")[2]}/${minDate.split("-")[1]}/${minDate.split("-")[0]}`;
    const maxDate = el.getAttribute("max");
    const maxDateValue = `${maxDate.split("-")[2]}/${maxDate.split("-")[1]}/${maxDate.split("-")[0]}`;

    if (startDate.length === 0) {
        startDateFeedback.innerText = "Preencha o campo.";
        validateFeedback(startDateFeedback, false);
        validate(el, false);
        return false;
    }

    else if (startDate.split("-")[0].length > 4) {
        startDateFeedback.innerText = "O ano deve ter no máximo 4 dígitos.";
        validate(el, false);
        validateFeedback(startDateFeedback, false);
        return false;
    }

    else if (startDate < minDate) {
        startDateFeedback.innerText = `Digite uma data posterior ou igual à ${minDateValue}.`;
        validate(el, false);
        validateFeedback(startDateFeedback, false);
        return false;
    }

    else if (startDate > maxDate) {
        startDateFeedback.innerText = `Digite uma data anterior ou igual à ${maxDateValue}.`;
        validate(el, false);
        validateFeedback(startDateFeedback, false);
        return false;
    }

    else if (startDate > finalDate && finalDate.split("-").length === 3) {
        startDateFeedback.innerText = "Data inicial não pode ser posterior à data final.";
        validate(el, false);
        validateFeedback(startDateFeedback, false);

        finalDateFeedback.innerText = "Data final não pode ser anterior à data inicial.";
        validate(final, false);
        validateFeedback(finalDateFeedback, false);

        return false;
    }

    else {
        startDateFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(startDateFeedback, true);

        if (finalDate.split("-").length === 3) {
            finalDateFeedback.innerText = "Formato aceito.";
            validate(final, true);
            validateFeedback(finalDateFeedback, true);
        }

        return true;
    }
}

window.validateFinalDate = function (el) {
    const finalDate = el.value;
    const finalDateFeedback = el.closest(".form-group").lastElementChild;
    const start = document.querySelector("#report-date-start");
    const startDate = start.value;
    const startDateFeedback = document.querySelector("#start-date-feedback-report");
    const minDate = el.getAttribute("min");
    const minDateValue = `${minDate.split("-")[2]}/${minDate.split("-")[1]}/${minDate.split("-")[0]}`;
    const maxDate = el.getAttribute("max");
    const maxDateValue = `${maxDate.split("-")[2]}/${maxDate.split("-")[1]}/${maxDate.split("-")[0]}`;

    if (finalDate.length === 0) {
        finalDateFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(finalDateFeedback, false);
        return false;
    }

    else if (finalDate.split("-")[0].length > 4) {
        finalDateFeedback.innerText = "O ano deve ter no máximo 4 dígitos.";
        validate(el, false);
        validateFeedback(finalDateFeedback, false);
        return false;
    }

    else if (finalDate < minDate) {
        finalDateFeedback.innerText = `Digite uma data posterior ou igual à ${minDateValue}.`;
        validate(el, false);
        validateFeedback(finalDateFeedback, false);
        return false;
    }

    else if (finalDate > maxDate) {
        finalDateFeedback.innerText = `Digite uma data anterior ou igual à ${maxDateValue}.`;
        validate(el, false);
        validateFeedback(finalDateFeedback, false);
        return false;
    }

    else if (startDate > finalDate) {
        startDateFeedback.innerText = "Data inicial não pode ser posterior à data final.";
        validate(start, false);
        validateFeedback(startDateFeedback, false);

        finalDateFeedback.innerText = "Data final não pode ser anterior à data inicial.";
        validate(el, false);
        validateFeedback(finalDateFeedback, false);
        return false;
    }

    else {
        finalDateFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(finalDateFeedback, true);

        if (startDate.split("-").length === 3) {
            startDateFeedback.innerText = "Formato aceito.";
            validate(start, true);
            validateFeedback(startDateFeedback, true);
        }

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
    }

    else {
        el.classList.add("invalid-feedback");
        el.classList.remove("valid-feedback");
    }
}

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** SUBMIT */
/** Update contract status */
window.formUpdateContractStatus = async function (el) {
    let submit = true;
    const elemId = el.split("-")[4];
    const modalUpdateStatus = document.querySelector(`#modal-edit-status-${elemId}`);
    const formUpdateContractStatus = document.querySelector(`#form-update-contract-status-${elemId}`);
    const status = document.querySelector(`#${formUpdateContractStatus.id} #status-edit-${elemId}`);
    const statusBadge = document.querySelector(`#status-link-${elemId} span`);
    const statusBadgeBgColor = statusBadge.className.split(/\s+/)[2];
    const statusText = document.querySelector(`#${statusBadge.id} span`);

    const isValidStatus = window.validateSelect(status) ? true : false;

    if (!isValidStatus) submit = false;

    errorFocus();

    if (submit) {
        const badgeItem = document.querySelector(`#${statusBadge.id}`).closest("p");
        const contractId = document.querySelector(`#${formUpdateContractStatus.id} #status-id-${elemId}`);
        const btnUpdateContractStatus = document.querySelector(`#btn-update-contract-status-${elemId}`);
        const btnUpdateContractStatusLoading = document.querySelector(`#btn-update-contract-status-loading-${elemId}`);
        const iconEngineeringProject = document.querySelector(`#link-show-engineering-project-${elemId}`);
        const iconEquipmentPurchased = document.querySelector(`#link-show-equipment-purchased-${elemId}`);
        let alert;

        btnUpdateContractStatus.setAttribute("disabled", true);
        btnUpdateContractStatusLoading.classList.remove("d-none");

        const body = {
            "contract": contractId.value,
            "status": status.options[status.selectedIndex].value,
            "badge-bg-color": statusBadgeBgColor
        }

        const response = await fetch(url_contract_update_status, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(body)
        });

        const result = await response.json();

        if (response.ok) {
            switch (result.status) {
                case "ORÇANDO":
                    statusBadge.classList.remove(result.badge);
                    statusBadge.classList.add("bg-secondary");

                    if (iconEngineeringProject !== null) iconEngineeringProject.classList.add("d-none");
                    if (iconEquipmentPurchased !== null) iconEquipmentPurchased.classList.add("d-none");

                    break;

                case "CONTRATADO":
                    statusBadge.classList.remove(result.badge);
                    statusBadge.classList.add("bg-brown");

                    if (iconEngineeringProject !== null) iconEngineeringProject.classList.remove("d-none");
                    if (iconEquipmentPurchased !== null) iconEquipmentPurchased.classList.remove("d-none");

                    break;

                case "ATIVO":
                    statusBadge.classList.remove(result.badge);
                    statusBadge.classList.add("bg-info");

                    if (iconEngineeringProject !== null) iconEngineeringProject.classList.remove("d-none");
                    if (iconEquipmentPurchased !== null) iconEquipmentPurchased.classList.remove("d-none");

                    break;

                case "PENDÊNCIA":
                    statusBadge.classList.remove(result.badge);
                    statusBadge.classList.add("bg-danger");

                    if (iconEngineeringProject !== null) iconEngineeringProject.classList.remove("d-none");
                    if (iconEquipmentPurchased !== null) iconEquipmentPurchased.classList.remove("d-none");

                    break;

                case "INSTALANDO":
                    statusBadge.classList.remove(result.badge);
                    statusBadge.classList.add("bg-primary");

                    if (iconEngineeringProject !== null) iconEngineeringProject.classList.remove("d-none");
                    if (iconEquipmentPurchased !== null) iconEquipmentPurchased.classList.remove("d-none");

                    break;

                case "INSTALADO":
                    statusBadge.classList.remove(result.badge);
                    statusBadge.classList.add("bg-warning");

                    if (iconEngineeringProject !== null) iconEngineeringProject.classList.remove("d-none");
                    if (iconEquipmentPurchased !== null) iconEquipmentPurchased.classList.remove("d-none");

                    break;

                case "CONCLUÍDO":
                    statusBadge.classList.remove(result.badge);
                    statusBadge.classList.add("bg-success");

                    if (iconEngineeringProject !== null) iconEngineeringProject.classList.remove("d-none");
                    if (iconEquipmentPurchased !== null) iconEquipmentPurchased.classList.remove("d-none");

                    break;

                case "CANCELADO":
                    statusBadge.classList.remove(result.badge);
                    statusBadge.classList.add("bg-dark");

                    if (iconEngineeringProject !== null) iconEngineeringProject.classList.remove("d-none");
                    if (iconEquipmentPurchased !== null) iconEquipmentPurchased.classList.remove("d-none");

                    break;
            }

            statusText.innerText = result.status;
            $(modalUpdateStatus).modal("hide");
            status.selectedIndex = 0;
            status.classList.remove("is-valid");
            btnUpdateContractStatus.removeAttribute("disabled");
            btnUpdateContractStatusLoading.classList.add("d-none");

            if (result.saved) {
                badgeItem.insertAdjacentHTML("afterend", `
                    <span class="alert alert-success alert-dismissible show fade mb-0" id="alert-badge-${elemId}">
                        <span class="fw-bold">${result.message}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            style="top: -1 !important;" 
                            aria-label="Close"></button>
                    </span>
                `);

                alert = document.querySelector(`#alert-badge-${elemId}`);
                alert.style.width = "270px";
            }

            else {
                badgeItem.insertAdjacentHTML("afterend", `
                    <span class="alert alert-danger alert-dismissible show fade mb-0" id="alert-badge-${elemId}">
                        <span class="fw-bold">${result.message}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            style="top: -1 !important;" 
                            aria-label="Close"></button>
                    </span>
                `);

                alert = document.querySelector(`#alert-badge-${elemId}`);
                alert.style.width = "230px";
            }

            alert.style.zIndex = "1000";
            alert.style.position = "absolute";
            alert.style.marginLeft = "110px";
            alert.style.top = "1px";

            $("span.alert")
                .delay(2000)
                .fadeOut(350);
        }
    }
}

/** Generate report */
window.formSubmitGenerateReport = function (el) {
    let submit = true;
    const formGenerateReport = document.querySelector("#form-generate-report");
    const reportStartDate = document.querySelector("#report-date-start");
    const reportEndDate = document.querySelector("#report-date-end");

    const isValidStartDate = window.validateStartDate(reportStartDate) ? true : false;
    const isValidEndDate = window.validateFinalDate(reportEndDate) ? true : false;

    if (!isValidStartDate) submit = false;
    if (!isValidEndDate) submit = false;

    errorFocus();

    if (submit) formGenerateReport.submit();
}