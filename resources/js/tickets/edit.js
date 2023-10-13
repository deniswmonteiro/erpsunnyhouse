/** FUNCTIONS */
/** Clear comment inputs when a comment is sent */
window.clearCommentSection = function () {
    const commentsResponsibles = document.querySelector("#ticket-comments-responsibles");
    const commentsResponsiblesFeedback = document.querySelector("#ticket-feedback-comments-responsibles-edit");
    const commentsText = document.querySelector("#ticket-comments-text");
    const commentsTextFeedback = document.querySelector("#ticket-feedback-comments-text-edit");

    commentsResponsibles.selectedIndex = 0;
    commentsText.value = "";

    commentsResponsibles.classList.remove("is-valid", "is-invalid");
    commentsResponsiblesFeedback.classList.remove("is-valid", "is-invalid");
    commentsResponsiblesFeedback.innerText = "";

    commentsText.classList.remove("is-valid", "is-invalid");
    commentsTextFeedback.classList.remove("is-valid", "is-invalid");
    commentsTextFeedback.innerText = "";
}

/** Clear attachment input when a attachment is sent */
window.clearAttachmentSection = function () {
    const attachment = document.querySelector("#ticket-attachment");
    const attachmentFeedback = document.querySelector("#ticket-feedback-attachment-edit");
    const btnSubmitAttachment = document.querySelector("#btn-update-ticket-attachment");

    attachment.value = "";
    attachment.classList.remove("is-valid", "is-invalid");
    attachmentFeedback.classList.remove("is-valid", "is-invalid");
    attachmentFeedback.innerText = "";
    btnSubmitAttachment.setAttribute("disabled", true);
}

/** Enable field to edit */
window.enableEditTicketField = function (el) {
    const type = el.id.split("-")[3];
    const field = document.querySelector(`#ticket-${type}`);
    const btnCancel = document.querySelector(`#btn-cancel-ticket-${type}`);
    const btnSubmit = document.querySelector(`#btn-update-ticket-${type}`);

    field.removeAttribute("disabled");
    el.classList.add("d-none");
    btnCancel.classList.remove("d-none");
    btnSubmit.classList.remove("d-none");
}

/** Cancel a field edition  */
window.cancelEditTicketField = function (el) {
    const type = el.id.split("-")[3];
    const field = document.querySelector(`#ticket-${type}`);
    const feedback = document.querySelector(`#ticket-feedback-${type}-edit`);
    const btnEdit = document.querySelector(`#btn-edit-ticket-${type}`);
    const btnSubmit = document.querySelector(`#btn-update-ticket-${type}`);

    if (type === "title") field.value = ticketTitle;
    else if (type === "description") field.value = ticketDescription;
    else field.value = "";

    field.classList.remove("is-valid", "is-invalid");
    feedback.style.display = "none";
    field.setAttribute("disabled", true);
    el.classList.add("d-none");
    btnEdit.classList.remove("d-none");
    btnSubmit.classList.add("d-none");
}

/** Enable submit button */
window.enableSubmitButton = function (el) {
    const field = el.id.split("-")[1];
    const btnSubmit = document.querySelector(`#btn-update-ticket-${field}`);

    if (field === "deadline") {
        const isValidDeadline = window.validateTicketDeadline(el);

        if (isValidDeadline) btnSubmit.removeAttribute("disabled");
        else btnSubmit.setAttribute("disabled", true);
    }

    else if (field === "attachment") {
        const isValidAttachment = window.validateFile(el);

        if (isValidAttachment) btnSubmit.removeAttribute("disabled");
        else btnSubmit.setAttribute("disabled", true);
    }

    else btnSubmit.removeAttribute("disabled");
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

window.validateTextarea = function (el, min, max) {
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

    else if (el.value.length > max) {
        feedback.innerText = `Máximo de ${max} caracteres.`;
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

    if (el.hasAttribute("required")) {
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

    else {
        feedback.innerText = "Formato aceito";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateTicketDeadline = function (el) {
    const feedback = document.querySelector("#ticket-feedback-deadline-edit");
    const min = 8;
    const deadlineDate = el.value;
    const todayDate = toDateFormat(Date.now(), "en-us");

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

window.validateFile = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;
    const mime_types = ["application/pdf", "image/jpeg", "image/png"];

    if (el.files[0] !== undefined && mime_types.indexOf(el.files[0].type) == -1) {
        feedback.innerHTML = `O arquivo <span class="fw-bold">"${el.files[0].name}"</span> não é permitido.`;
        validate(el, false);
        validateFeedback(feedback, false);
        return false;
    }

    else if (el.files[0] !== undefined && el.files[0].size > 10 * 1024 * 1024) {
        feedback.innerHTML = `O arquivo <span class="fw-bold">"${el.files[0].name}"</span> ultrapassa o limite de 10 MB.`;
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
/** Update ticket data */
window.updateTicket = async function (el) {
    let submit = true;
    const type = el.id.split("-")[3];
    const ticket = document.querySelector("#ticket-id");
    const field = document.querySelector(`#ticket-${type}`);
    const feedback = document.querySelector(`#ticket-feedback-${type}-edit`);
    const btnEdit = document.querySelector(`#btn-edit-ticket-${type}`);
    const btnCancelEdit = document.querySelector(`#btn-cancel-ticket-${type}`);
    const textUpdated = document.querySelector(`#btn-ticket-${type}-updated`);
    const btnSubmitIcon = document.querySelector(`#${el.id} i`);
    const btnSubmitLoading = document.querySelector(`#btn-update-ticket-${type}-loading`);
    const ticketLogCard = document.querySelector(`#ticket-log-card`);
    const ticketLog = document.querySelector(`#ticket-log`);
    const ticketLogEmpty = document.querySelector("#ticket-log-empty");
    let isValidField;

    switch (type) {
        case "title":
            isValidField = window.validateInput(field, 2) ? true : false;
            break;

        case "status":
            isValidField = window.validateSelect(field) ? true : false;
            break;

        case "description":
            isValidField = window.validateInput(field, 2) ? true : false;
            break;

        case "deadline":
            isValidField = window.validateTicketDeadline(field) ? true : false;
            break;

        case "responsibles":
            isValidField = window.validateSelect(field) ? true : false;
            break;
    }

    if (!isValidField) submit = false;

    errorFocus();

    if (submit) {
        el.setAttribute("disabled", true);

        if (type === "title" || type === "description") btnCancelEdit.setAttribute("disabled", true);

        btnSubmitIcon.classList.add("d-none");
        btnSubmitLoading.classList.remove("d-none");
        ticketLogEmpty && ticketLogEmpty.classList.add("d-none");

        // If type is "responsibles"
        const items = [];
        let fieldValue;
        let url;

        if (type === "responsibles") {
            // Send the responsible selected
            for (let i = 0; i < field.options.length; i++) {
                if (field.options[i].selected) items.push(field.options[i].value);
            }

            fieldValue = items;

            // Current URL
            const currentUrl = window.location.href;
            const urlLength = currentUrl.split("/").length - 1;
            const urlId = currentUrl.split("/")[urlLength];
            url = `http://erp.sunnyhouse.com.br/tickets/edit/${urlId}`;
        }

        else {
            url = null;
            fieldValue = field.value;
        }

        const body = {
            "ticket": ticket.value,
            "type": type,
            "field": fieldValue,
            "url": url
        };

        const response = await fetch(url_tickets_update, {
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
            textUpdated.style.display = "inline-block";

            if (type === "title" || type === "description") {
                el.removeAttribute("disabled");
                el.classList.add("d-none");
                btnCancelEdit.classList.add("d-none");
                btnCancelEdit.removeAttribute("disabled");
                btnEdit.classList.remove("d-none");
                field.setAttribute("disabled", true);
            }

            btnSubmitIcon.classList.remove("d-none");
            btnSubmitLoading.classList.add("d-none");
            field.classList.remove("is-valid", "is-invalid");
            feedback.style.display = "none";

            if (result.status) {
                textUpdated.innerText = result.ticket_log.message;
                textUpdated.classList.remove("bg-danger");
                textUpdated.classList.add("bg-success");

                // Ticket log
                const totalLog = document.querySelectorAll(`#${ticketLog.id} [data-log-item]`);
                let logId = 0;

                if (totalLog.length === 0) logId = 1;

                else {
                    logId = totalLog.length + 1;
                    ticketLogCard.classList.add("overflow-y-scroll");
                }

                // Log message
                let logMessage;

                if (result.type === "deadline") {
                    const newDeadline = `${result.ticket_log.new_value.split("-")[2]}/${result.ticket_log.new_value.split("-")[1]}/${result.ticket_log.new_value.split("-")[0]}`

                    if (result.ticket_log.old_value === null) {
                        logMessage = `&ndash; Atualizado para <span class="text-warning">${newDeadline}</span>`;
                    }

                    else {
                        const oldDeadline = `${result.ticket_log.old_value.split("-")[2]}/${result.ticket_log.old_value.split("-")[1]}/${result.ticket_log.old_value.split("-")[0]}`

                        logMessage = `&ndash; Modificado de <span class="text-warning">${oldDeadline}</span> para <span class="text-warning">${newDeadline}</span>`;
                    }
                }

                else if (result.type === "responsibles") {
                    const ticketResponsiblesBadge = document.querySelector("#ticket-responsibles-badge");

                    [...ticketResponsiblesBadge.children].forEach(responsibleBadge => responsibleBadge.remove());

                    for (let i = 0; i <= result.responsible_data.length - 1; i++) {
                        if (result.responsible_data[i]['cellphone'] != null) {
                            ticketResponsiblesBadge.insertAdjacentHTML("beforeend", `
                                <span class="badge bg-brown fw-bold">
                                    <a href="https://wa.me/55${result.responsible_data[i]['cellphone']}/?text=Olá, ${result.responsible_data[i]['name']}! Você foi atribuído(a) a uma OS. Mais informações em ${url}" target="_blank"
                                        class="text-white">
                                        ${result.responsible_data[i]['name']}
                                        <i class="bi bi-whatsapp ms-1"
                                            role="img" aria-label="WhatsApp"></i>
                                    </a>
                                </span>
                            `);
                        }

                        else {
                            ticketResponsiblesBadge.insertAdjacentHTML("beforeend", `
                                <span class="badge bg-brown fw-bold">
                                    ${result.responsible_data[i]['name']}
                                </span>
                            `);
                        }
                    }

                    // Log
                    if (result.ticket_log.old_value.length === 0) {
                        let createNewResponsibles = "";

                        for (let i = 0; i < result.ticket_log.new_value.length; i++) {
                            createNewResponsibles += `[${result.ticket_log.new_value[i]}] `;
                        }

                        logMessage = `&ndash; Atualizado para <span class="text-warning">${createNewResponsibles}</span>`;
                    }

                    else {
                        let updateOldResponsibles = "";
                        let updateNewResponsibles = "";

                        for (let i = 0; i < result.ticket_log.old_value.length; i++) {
                            updateOldResponsibles += `[${result.ticket_log.old_value[i]}] `;
                        }

                        for (let i = 0; i < result.ticket_log.new_value.length; i++) {
                            updateNewResponsibles += `[${result.ticket_log.new_value[i]}] `;
                        }

                        logMessage = `&ndash; Modificado de <span class="text-warning">${updateOldResponsibles}</span> para <span class="text-warning">${updateNewResponsibles}</span>`;
                    }
                }

                else {
                    if (result.ticket_log.old_value === null) {
                        logMessage = `&ndash; Atualizado para <span class="text-warning">${result.ticket_log.new_value}</span>`;
                    }

                    else {
                        logMessage = `&ndash; Modificado de <span class="text-warning">${result.ticket_log.old_value}</span> para <span class="text-warning">${result.ticket_log.new_value}</span>`;
                    }
                }

                ticketLog.insertAdjacentHTML("beforeend", `
                    <li class="rounded mb-3" id="log-new-${logId}"
                        data-log-item>
                        <div class="d-flex w-100 justify-content-between rounded-top bg-light bg-gradient border border-gray p-3 pt-2 pb-2"
                            id="log-header-${logId}">
                            <small class="text-primary fw-bold"
                                id="log-author-${logId}">
                                ${result.ticket_log.message}
                            </small>
                            <small id="log-data-${logId}">
                                ${result.ticket_log.created_at}
                            </small>
                        </div>
                        <div class="border border-gray border-top-0 rounded-bottom p-3"
                            id="log-text-${logId}">
                            <p class="mb-0">
                                <span class="fw-bold">Realizado por:</span> ${result.ticket_log.user}
                            </p>
                            <p class="mb-0">
                                ${logMessage}
                            </p>
                        </div>
                    </li>
                `);
            }

            else {
                textUpdated.innerText = result.message;
                textUpdated.classList.remove("bg-success");
                textUpdated.classList.add("bg-danger");
                field.value = ticketTitle;
            }

            $(textUpdated)
                .delay(2000)
                .fadeOut(350);
        }
    }
}

/** Create a ticket comment */
window.submitTicketComment = async function () {
    let submit = true;
    const ticket = document.querySelector("#ticket-id");
    const commentResponsibles = document.querySelector("#ticket-comments-responsibles");
    const commentText = document.querySelector("#ticket-comments-text");
    const commentResponsiblesItems = [];
    const comments = document.querySelector(`#comments-ticket`);
    const commentsCard = document.querySelector("#ticket-comments-card");
    const commentTicketLoading = document.querySelector("#ticket-comments-loading");
    const commentsEmpty = document.querySelector("#ticket-comments-empty");
    const textCommentAdded = document.querySelector("#btn-ticket-comment-added");

    const isValidCommentResponsibles = window.validateSelect(commentResponsibles) ? true : false;
    const isValidCommentText = window.validateTextarea(commentText, 5, 250) ? true : false;

    if (!isValidCommentResponsibles) submit = false;
    if (!isValidCommentText) submit = false;

    errorFocus();

    if (submit) {
        comments.classList.add("d-none");
        commentTicketLoading.classList.remove("d-none");
        commentTicketLoading.closest(".card-body").classList.remove("d-none");

        commentsEmpty != null && commentsEmpty.classList.add("d-none");

        // Comment responsible if it exists
        for (let i = 0; i < commentResponsibles.length; i++) {
            if (commentResponsibles.options[i].selected) {
                commentResponsiblesItems.push(commentResponsibles.options[i].value);
            }
        }

        const commentResponsible = (commentResponsiblesItems[0] !== '') ? commentResponsiblesItems : null;

        const body = {
            "ticket": ticket.value,
            "comment-responsible": commentResponsible,
            "comment-text": commentText.value,
        };

        const response = await fetch(url_post_ticket_comment, {
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
            textCommentAdded.style.display = "inline-block";

            if (result.status) {
                comments.classList.remove("d-none");
                commentTicketLoading.classList.add("d-none");
                textCommentAdded.innerText = result.message;

                const totalComments = document.querySelectorAll(`#${comments.id} [data-comment-item]`);
                let commentId = 0;
                const date = result.comment_data.date.split(" ")[0];
                const hour = result.comment_data.date.split(" ")[1];
                const commentDate = `${date.split("-")[2]}/${date.split("-")[1]}/${date.split("-")[0]}`;

                if (totalComments.length === 0) commentId = 1;

                else {
                    commentId = totalComments.length + 1;
                    commentsCard.classList.add("overflow-y-scroll");
                }

                comments.insertAdjacentHTML("beforeend", `
                    <li class="rounded mb-3" id="comment-new-${commentId}"
                        data-comment-item>
                        <div class="d-flex w-100 justify-content-between rounded-top bg-light bg-gradient border border-gray p-3 pt-2 pb-2"
                            id="comment-header-${commentId}">
                            <small class="text-primary fw-bold"
                                id="comment-author-${commentId}">
                                ${result.comment_data.author}
                            </small>
                            <small id="comment-data-${commentId}">
                                ${commentDate} - ${hour}
                            </small>
                        </div>
                        <p class="border border-gray border-top-0 rounded-bottom p-3 mb-0"
                            id="comment-text-${commentId}">
                            <span style="margin-right: 3px" class="text-warning"
                                id="comment-text-responsibles-${commentId}"></span>
                            ${result.comment_data.comment}
                        </p>
                    </li>
                `);

                // Comments panel
                const commentText = document.querySelector(`#comment-text-responsibles-${commentId}`);
                const currentUrl = window.location.href;
                const urlLength = currentUrl.split("/").length - 1;
                const urlId = currentUrl.split("/")[urlLength];
                const url = `http://erp.sunnyhouse.com.br/tickets/edit/${urlId}`;

                if (result.comment_data.responsibles_data != null) {
                    for (let i = 0; i <= result.comment_data.responsibles_data.length - 1; i++) {
                        if (result.comment_data.responsibles_data[i]['cellphone'] != null) {
                            commentText.insertAdjacentHTML("afterbegin", `
                                <a href="https://wa.me/55${result.comment_data.responsibles_data[i]['cellphone']}/?text=Olá, ${result.comment_data.responsibles_data[i]['name']}! Você foi atribuído(a) a uma OS. Mais informações em ${url}"
                                    target="_blank"
                                    class="text-success">
                                    [${result.comment_data.responsibles_data[i]['name']}
                                    <i class="bi bi-whatsapp ms-1"
                                        role="img" aria-label="WhatsApp"></i>]
                                </a>
                            `);
                        }

                        else {
                            commentText.insertAdjacentHTML("afterbegin", `
                                [${result.comment_data.responsibles_data[i]['name']}]
                            `);
                        }
                    }
                }
            }

            else {
                commentTicketLoading.classList.add("d-none");

                // Alert error
                commentTicketLoading.insertAdjacentHTML("afterend", `
                    <div class="d-flex position-relative justify-content-center">
                        <span class="position-absolute alert alert-danger alert-dismissible show fade mb-0"
                            id="alert-ticket">
                            <strong>${result.message}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                style="top: -1 !important;" 
                                aria-label="Close"></button>
                        </span>
                    </div>
                `);

                alert = document.querySelector(`#alert-ticket`);
                alert.style.width = "350px";
                alert.style.zIndex = "1000";

                $("span.alert")
                    .delay(2000)
                    .fadeOut(350);
            }

            $(textCommentAdded)
                .delay(2000)
                .fadeOut(350);
        }

        window.clearCommentSection();
    }
}

// Create a ticket attachment
window.submitTicketAttachment = async function () {
    let submit = true;
    const ticketPanel = document.querySelector("#ticket-attachment-panel");
    const ticket = document.querySelector("#ticket-id");
    const ticketAttachment = document.querySelector("#ticket-attachment");
    const attachments = document.querySelector(`#attachment-ticket`);
    const ticketAttachmentLoading = document.querySelector("#ticket-attachment-loading");
    const textAttachmentAdd = document.querySelector("#btn-ticket-attachment-added");
    const formData = new FormData();

    const isValidTicketAttachment = window.validateFile(ticketAttachment) ? true : false;

    if (!isValidTicketAttachment) submit = false;

    errorFocus();

    if (submit) {
        attachments.classList.add("d-none");
        ticketAttachmentLoading.classList.remove("d-none");
        ticketAttachmentLoading.closest(".card-body").classList.remove("d-none");

        formData.append("ticket", ticket.value);
        formData.append("ticket-attachment", ticketAttachment.files[0]);

        const response = await fetch(url_post_ticket_attachment, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            },
            body: formData
        });

        const result = await response.json();

        if (response.ok) {
            textAttachmentAdd.style.display = "inline-block";

            if (result.status) {
                attachments.classList.remove("d-none");
                ticketAttachmentLoading.classList.add("d-none");
                textAttachmentAdd.innerText = result.message;

                const totalAttachments = document.querySelectorAll(`#${attachments.id} [data-attachment-item]`);
                let attachmentId = 0;

                if (totalAttachments.length === 0) attachmentId = 1;
                else attachmentId = totalAttachments.length + 1;

                attachments.insertAdjacentHTML("beforeend", `
                    <li class="rounded mb-3" id="comment-new-${attachmentId}"
                        data-attachment-item>
                        <div class="d-flex w-100 justify-content-between rounded-top bg-light bg-gradient border border-gray p-3 pt-2 pb-2"
                            id="attachment-header-${attachmentId}">
                            <small class="text-primary fw-bold"
                                id="attachment-author-${attachmentId}">
                                ${result.attachment_data.author}
                            </small>
                            <small id="attachment-data-${attachmentId}">
                                ${result.attachment_data.created_at}
                            </small>
                        </div>

                        <p class="border border-gray border-top-0 rounded-bottom p-3 mb-0"
                            id="attachment-text-${attachmentId}">
                            <a href="${result.attachment_data.attachment_url}" target="_blank">
                                ${result.attachment_data.attachment_name}
                            </a>
                        </p>
                    </li>
                `);
            }

            else {
                ticketAttachmentLoading.classList.add("d-none");

                // Alert error
                ticketPanel.insertAdjacentHTML("afterbegin", `
                    <div class="d-flex position-relative justify-content-center">
                        <span class="position-absolute alert alert-danger alert-dismissible show fade mb-0"
                            id="alert-ticket">
                            <strong>${result.message}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                style="top: -1 !important;" 
                                aria-label="Close"></button>
                        </span>
                    </div>
                `);

                alert = document.querySelector(`#alert-ticket`);
                alert.style.width = "350px";
                alert.style.zIndex = "1000";

                $("span.alert")
                    .delay(2000)
                    .fadeOut(350);
            }

            $(textAttachmentAdd)
                .delay(2000)
                .fadeOut(350);
        }

        window.clearAttachmentSection();
    }
}