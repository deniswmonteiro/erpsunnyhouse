$(document).ready(function () {
    moment.locale("pt-br");
    window.moment.locale("pt-br");

    $.fn.dataTable.moment("DD/MM/YYYY");
    $.fn.dataTable.moment("DD/MM/YYYY");

    var monthMap = new Map();
    monthMap.set(1, "Janeiro");
    monthMap.set(2, "Fevereiro");
    monthMap.set(3, "Março");
    monthMap.set(4, "Abril");
    monthMap.set(5, "Maio");
    monthMap.set(6, "Junho");
    monthMap.set(7, "Julho");
    monthMap.set(8, "Agosto");
    monthMap.set(9, "Setembro");
    monthMap.set(10, "Outubro");
    monthMap.set(11, "Novembro");
    monthMap.set(12, "Dezembro");

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
        columnDefs: [{
            targets: [1, 3, 5],
            searchable: true,
            visible: false
        }],
        rowGroup: {
            endRender: function (rows, group) {
                const sum = rows
                    .data()
                    .pluck(7)
                    .reduce((a, b) => {
                        const value = b.split(" ")[0];
                        const unity = b.split(" ")[1];
                        const totalGeneratorPower = (unity === "kWp") ?
                            Number(value.replace(",", ".") * 1000) :
                            Number(value.replace(",", "."));

                        return a + totalGeneratorPower;
                    }, 0);

                return `Total em ${group}:
                    <span class="text-primary">
                        ${(sum / 1000).toString().replace(".", ",")} kWp
                    </span>`;
            },

            dataSrc: function (row) {
                const date = row[1].split("/");
                const month = monthMap.get(parseInt(date[1]));
                const year = date[2];

                return `<strong>${month} de ${year}</strong>`;
            }
        }
    });

    const today = Date.now();
    const protocolDates = document.querySelectorAll("input[id^='protocol-date']");

    protocolDates.forEach(date => date.setAttribute("max", toDateFormat(today, "en-us")));

    // mask
    $("input[id^='protocol-number']").mask("0#");
});

/** enable protocol data editing */
window.enableEditProtocolForm = function (el) {
    const elemType = el.id.split("-")[3];
    const elemId = el.id.split("-")[4];
    const elemItem = el.id.split("-")[5];
    const protocolForm = document.querySelector(`#protocol-form-${elemType}-${elemId}-${elemItem}`);
    const protocolManagement = document.querySelector(`#protocol-management-${elemType}-${elemId}-${elemItem}`);

    protocolForm.classList.remove("d-none");
    protocolManagement.classList.add("d-none");
}

/** cancel protocol edit */
window.cancelEditProtocol = function (el) {
    const elemType = el.id.split("-")[3];
    const elemId = el.id.split("-")[4];
    const elemItem = el.id.split("-")[5];
    const protocolForm = document.querySelector(`#protocol-form-${elemType}-${elemId}-${elemItem}`);
    const protocolManagement = document.querySelector(`#protocol-management-${elemType}-${elemId}-${elemItem}`);

    protocolForm.classList.add("d-none");
    protocolManagement.classList.remove("d-none");
}

/** formats date in milliseconds to "yyyy-mm-dd" or "dd/mm/yyyy" */
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

/** Create/update generator protocol and status */
window.formSaveProtocol = async function (el) {
    let submit = true;
    const elemType = el.split("-")[2];
    const elemId = el.split("-")[3];
    const elemItem = el.split("-")[4];

    // Protocol Modal
    const modalEditProtocol = document.querySelector(`#modal-edit-protocol-${elemId}-${elemItem} .modal-body`);
    const protocolEdit = document.querySelector(`#protocol-form-${elemType}-${elemId}-${elemItem}`);
    const protocolManagement = document.querySelector(`#protocol-management-${elemType}-${elemId}-${elemItem}`);
    const formSaveProtocol = document.querySelector(`#form-protocol-${elemType}-${elemId}-${elemItem}`);
    const editProtocolNumber = document.querySelector(`#protocol-number-${elemType}-${elemId}-${elemItem}`);
    const editProtocolDate = document.querySelector(`#protocol-date-${elemType}-${elemId}-${elemItem}`);
    const showProtocolNumber = document.querySelector(`#protocol-management-number-${elemType}-${elemId}-${elemItem}`);
    const showProtocolDate = document.querySelector(`#protocol-management-date-${elemType}-${elemId}-${elemItem}`);
    const showProtocolDeadline = document.querySelector(`#protocol-management-deadline-${elemType}-${elemId}-${elemItem}`);
    let isValidEditProtocolNumber;
    let isValidEditProtocolDate;

    // Protocol list
    const protocolBadge = document.querySelector(`#protocol-link-${elemId}-${elemItem} span`);
    const protocolBadgeBgColor = protocolBadge.className.split(/\s+/)[2];
    const protocolText = document.querySelector(`#${protocolBadge.id} span`);

    if (elemType !== "homologated") isValidEditProtocolNumber = window.validateInput(editProtocolNumber);

    isValidEditProtocolDate = window.validateProtocolDate(editProtocolDate);

    if (elemType !== "homologated" && !isValidEditProtocolNumber) submit = false;
    if (!isValidEditProtocolDate) submit = false;

    if (submit) {
        const generatorId = document.querySelector(`#${formSaveProtocol.id} #generator-id-${elemType}-${elemId}-${elemItem}`);
        const protocolType = document.querySelector(`#${formSaveProtocol.id} #protocol-type-${elemType}-${elemId}-${elemItem}`);
        const btnSaveProtocol = document.querySelector(`#btn-save-protocol-${elemType}-${elemId}-${elemItem}`);
        const btnSaveProtocolIcon = document.querySelector(`#btn-save-protocol-${elemType}-${elemId}-${elemItem} i`);
        const btnSaveProtocolLoading = document.querySelector(`#btn-save-protocol-loading-${elemType}-${elemId}-${elemItem}`);
        let body;

        btnSaveProtocol.setAttribute("disabled", true);
        btnSaveProtocolIcon.classList.add("d-none");
        btnSaveProtocolLoading.classList.remove("d-none");

        if (elemType === "homologated") {
            body = {
                "generator": generatorId.value,
                "type": protocolType.value,
                "protocol-date": editProtocolDate.value,
                "badge-bg-color": protocolBadgeBgColor
            }
        }

        else {
            body = {
                "generator": generatorId.value,
                "type": protocolType.value,
                "protocol-number": editProtocolNumber.value,
                "protocol-date": editProtocolDate.value,
                "badge-bg-color": protocolBadgeBgColor
            }
        }

        const response = await fetch(url_generator_save_protocol, {
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
            protocolBadge.classList.remove(result.badge);
            showProtocolDate.innerText = `${result.date.split("-")[2]}/${result.date.split("-")[1]}/${result.date.split("-")[0]}`;

            switch (result.status) {
                case "SUBMETIDO":
                    showProtocolNumber.innerText = result.number;
                    showProtocolDeadline.innerText = result.deadline;

                    if (result.pending) {
                        protocolBadge.classList.add("bg-danger");
                        showProtocolDeadline.classList.add("text-danger", "fw-bold");
                    }

                    else {
                        protocolBadge.classList.add("bg-brown");
                        showProtocolDeadline.classList.remove("text-danger", "fw-bold");
                    }

                    break;

                case "PROTOCOLADO":
                    showProtocolNumber.innerText = result.number;
                    showProtocolDeadline.innerText = result.deadline;

                    if (result.pending) {
                        protocolBadge.classList.add("bg-danger");
                        showProtocolDeadline.classList.add("text-danger", "fw-bold");
                    }

                    else {
                        protocolBadge.classList.add("bg-info");
                        showProtocolDeadline.classList.remove("text-danger", "fw-bold");
                    }

                    break;

                case "PARECER_EMITIDO":
                    showProtocolNumber.innerText = result.number;
                    protocolBadge.classList.add("bg-indigo");
                    break;

                case "VISTORIA_PROVISORIA":
                    showProtocolNumber.innerText = result.number;
                    showProtocolDeadline.innerText = result.deadline;

                    if (result.pending) {
                        protocolBadge.classList.add("bg-danger");
                        showProtocolDeadline.classList.add("text-danger", "fw-bold");
                    }

                    else {
                        protocolBadge.classList.add("bg-warning");
                        showProtocolDeadline.classList.remove("text-danger", "fw-bold");
                    }

                    break;

                case "VISTORIA":
                    showProtocolNumber.innerText = result.number;
                    showProtocolDeadline.innerText = result.deadline;

                    if (result.pending) {
                        protocolBadge.classList.add("bg-danger");
                        showProtocolDeadline.classList.add("text-danger", "fw-bold");
                    }

                    else {
                        protocolBadge.classList.add("bg-primary");
                        showProtocolDeadline.classList.remove("text-danger", "fw-bold");
                    }

                    break;

                case "HOMOLOGADO":
                    protocolBadge.classList.add("bg-teal");
                    break;
            }

            protocolEdit.classList.add("d-none");
            protocolManagement.classList.remove("d-none");
            btnSaveProtocol.removeAttribute("disabled");
            btnSaveProtocolIcon.classList.remove("d-none");
            btnSaveProtocolLoading.classList.add("d-none");
            protocolText.innerText = result.status.replace("_", " ");

            if (result.saved) {
                modalEditProtocol.insertAdjacentHTML("afterbegin", `
                    <div class="alert alert-success alert-dismissible show fade mt-0 mb-0 ms-auto me-auto"
                        style="max-width: 576px;" >
                        <strong>${result.message}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }

            else {
                modalEditProtocol.insertAdjacentHTML("afterbegin", `
                    <div class="alert alert-danger alert-dismissible show fade mt-0 mb-0 ms-auto me-auto"
                        style="max-width: 576px;">
                        <strong>${result.message}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }

            $("div.alert")
                .delay(2000)
                .fadeOut(350);
        }
    }
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

window.validateProtocolDate = function (el) {
    const elemType = el.id.split("-")[2];
    const elemId = el.id.split("-")[3];
    const elemItem = el.id.split("-")[4];
    const today = toDateFormat(Date.now(), "en-us");
    const todayDate = new Date(
        today.split("-")[0], today.split("-")[1] - 1, today.split("-")[2]
    );
    const protocolDate = new Date(
        el.value.split("-")[0], el.value.split("-")[1] - 1, el.value.split("-")[2]
    );

    const protocolDateFeedback = document.querySelector(`#protocol-date-feedback-${elemType}-${elemId}-${elemItem}`);
    const minDate = new Date(
        "01/01/2000".split("/")[2], "01/01/2000".split("/")[1] - 1, "01/01/2000".split("/")[0]
    );

    if (el.value.split("-").length < 3 || el.value.split("-")[0].length > 4) {
        protocolDateFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        return false;
    }

    else if (el.value.split("-").join("").length < 8) {
        protocolDateFeedback.innerText = "Data inválida.";
        validate(el, false);
        return false;
    }

    else if (protocolDate < minDate || protocolDate > todayDate) {
        protocolDateFeedback.innerText = `Digite uma data entre 01/01/2000 e ${toDateFormat(Date.now(), "pt-br")}.`;
        validate(el, false);
        validateFeedback(protocolDateFeedback, false);
        return false;
    }

    else {
        protocolDateFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(protocolDateFeedback, true);
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

/** REMOVER */
window.formSubmitMigrateDocument = async function (el) {
    const generator = el.split("-")[5];
    const project = el.split("-")[4];
    const type = el.split("-")[3];
    const modal = document.querySelectorAll(`#modal-migrate-documents-${project} li`)
    const generatorId = document.querySelector(`#generator-id-${project}-${generator}`);
    const documentType = document.querySelector(`#generator-document-${type}-${project}-${generator}`);
    const btnSubmit = document.querySelector(`#btn-migrate-document-${type}-${project}-${generator}`);
    const btnSubmitLoading = document.querySelector(`#btn-migrate-document-${type}-loading-${project}-${generator}`);
    const btnMigrateDocuments = document.querySelector(`#btn-migrate-documents-${project}`);

    btnSubmit.firstElementChild.classList.add("d-none");
    btnSubmitLoading.classList.remove("d-none");

    const body = {
        "generator": generatorId.value,
        "type": documentType.value
    }

    const response = await fetch(url_fetch_migrate_generator_document, {
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
        if (result.created) {
            btnSubmitLoading.classList.add("d-none");
            btnSubmit.setAttribute("disabled", true);
            btnSubmit.insertAdjacentHTML("afterbegin", "<i class='bi bi-check-circle-fill'></i>");

            btnSubmit.closest("li").setAttribute("data-created", true);

            const allHasCreated = [...modal].every(li => li.hasAttribute("data-created") ? true : false);

            if (allHasCreated) btnMigrateDocuments.classList.add("disabled");
        }
    }
}