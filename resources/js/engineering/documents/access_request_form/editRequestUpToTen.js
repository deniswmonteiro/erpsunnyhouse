/** INIT FUNCTIONS */
$(document).ready(function () {
    // Mask
    $("#edit-request-first-clientrg").mask("0#");
    $(["#edit-request-first-clientcellphone", "#edit-request-first-clientphone", "#edit-request-first-responsiblephone"]).mask(window.SPMaskBehavior, spOptions);
    $(["#edit-request-first-ucpower", "#edit-request-first-ucload", "#edit-request-first-ucbreaker", "#edit-request-first-ucpd", "#edit-request-first-coordinatesx", "#edit-request-first-coordinatesy", "#edit-request-first-generationpower"]).mask("########9V##", {
        translation: {
            "V": {
                pattern: /[\,]/
            },
            "#": {
                pattern: /[0-9]/,
                optional: true
            }
        }
    });
});

/** FUNCTIONS */
/** Get engineer informations */
window.getEngineerData = async function (el) {
    const title = document.querySelector("#edit-request-first-managertitle");
    const registration = document.querySelector("#edit-request-first-managerregistration");
    const registrationState = document.querySelector("#edit-request-first-managerregistrationstate");
    const email = document.querySelector("#edit-request-first-manageremail");
    const phone = document.querySelector("#edit-request-first-managerphone");
    const cellphone = document.querySelector("#edit-request-first-managercellphone");
    const cep = document.querySelector("#edit-request-first-managercep");
    const address = document.querySelector("#edit-request-first-manageraddress");
    const number = document.querySelector("#edit-request-first-managernumber");
    const neighborhood = document.querySelector("#edit-request-first-managerneighborhood");
    const city = document.querySelector("#edit-request-first-managercity");
    const state = document.querySelector("#edit-request-first-managerstate");
    const arrManagerInfo = [
        title, registration, registrationState, email, phone, cellphone, cep, address, number, neighborhood, city, state
    ]

    const body = {
        "name": el.value
    };

    const response = await fetch(url_get_engineer_data, {
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
        return {
            result: result,
            manager: {
                title: arrManagerInfo[0],
                registration: arrManagerInfo[1],
                registrationState: arrManagerInfo[2],
                email: arrManagerInfo[3],
                phone: arrManagerInfo[4],
                cellphone: arrManagerInfo[5],
                cep: arrManagerInfo[6],
                address: arrManagerInfo[7],
                number: arrManagerInfo[8],
                neighborhood: arrManagerInfo[9],
                city: arrManagerInfo[10],
                state: arrManagerInfo[11]
            }
        };
    }
}

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** VALIDATIONS */
window.validateRGShippingDate = function (el) {
    const dateFeedback = document.querySelector("#edit-first-clientrgshipping-feedback-request");
    const min = 8;
    const year = 2000;

    if (isNaN(el.value)) {
        if (el.value.split("-").length < 3) {
            dateFeedback.innerText = "Formato inválido.";
            validate(el, false);
            validateFeedback(dateFeedback, false);
            return false;
        }

        else if (el.value.split("-")[0] < year) {
            dateFeedback.innerText = `Preencha com o ano a partir de ${year}.`;
            validate(el, false);
            validateFeedback(dateFeedback, false);
            return false;
        }

        else if (el.value.length < 8) {
            dateFeedback.innerText = `Mínimo de ${min} caracteres.`;
            validate(el, false);
            validateFeedback(dateFeedback, false);
            return false;
        }

        else {
            dateFeedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(dateFeedback, true);
            return true;
        }
    }

    else {
        dateFeedback.innerText = "";
        validate(el, true);
        validateFeedback(dateFeedback, true);
        return true;
    }
}

window.validatePhone = function (el, digits = 10) {
    const elemId = el.id.split("-")[3];
    let phoneFeedback = document.querySelector(`#edit-first-${elemId}-feedback-request`);

    if (el.value.length !== 0) {
        if (el.value.length === 0) {
            phoneFeedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(phoneFeedback, false);
            return false;
        }

        else if (el.value.replace(/[^0-9]/g, "").length !== digits) {
            phoneFeedback.innerText = `O telefone deve conter ${digits} dígitos.`;
            validate(el, false);
            validateFeedback(phoneFeedback, false);
            return false;
        }

        else {
            phoneFeedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(phoneFeedback, true);
            return true;
        }
    }

    else {
        phoneFeedback.innerText = "";
        validate(el, true);
        validateFeedback(phoneFeedback, true);
        return true;
    }
}

window.validateDouble = function (el) {
    const elemId = el.id.split("-")[3];
    const feedback = document.querySelector(`#edit-first-${elemId}-feedback-request`);

    if (el.value.length !== 0 || el.hasAttribute("required")) {
        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (Number(el.value) === 0) {
            feedback.innerText = "Digite um valor maior que zero.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.substr(-1) === ",") {
            feedback.innerText = "Digite um valor válido.";
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

window.validateResponsibleEmail = function (el) {
    const emailFeedback = document.querySelector("#edit-first-responsibleemail-feedback-request");

    if (el.value.length !== 0) {
        if (el.value.length === 0) {
            emailFeedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(emailFeedback, false);
            return false;
        }

        else if (!/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/.test(el.value)) {
            emailFeedback.innerText = "Formato inválido.";
            validate(el, false);
            validateFeedback(emailFeedback, false);
            return false;
        }

        else {
            emailFeedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(emailFeedback, true);
            return true;
        }
    }

    else {
        emailFeedback.innerText = "";
        validate(el, true);
        validateFeedback(emailFeedback, true);
        return true;
    }
}

window.validateInput = function (el, min) {
    const elFeedback = el.closest(".form-group").lastElementChild;

    if (el.value.length !== 0 || el.hasAttribute("required")) {
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

    else {
        elFeedback.innerText = "";
        validate(el, true);
        validateFeedback(elFeedback, true);
        return true;
    }
}

window.validateSelect = async function (el) {
    const selectFeedback = el.closest(".form-group").lastElementChild;

    if (el.selectedIndex === 0) {
        selectFeedback.innerText = "Escolha uma opção.";
        validate(el, false);
        validateFeedback(selectFeedback, false);
        return false;
    }

    else {
        if (el.id.split("-")[3] === "managername") {
            el.setAttribute("disabled", true);

            const info = await getEngineerData(el);

            if (info.result.user_status) {
                info.manager.title.value = info.result.engineer_data.title;
                info.manager.registration.value = info.result.engineer_data.registration;
                info.manager.registrationState.value = info.result.engineer_data.registration_state;
                info.manager.email.value = info.result.engineer_data.email;
                info.manager.phone.value = info.result.engineer_data.phone;
                info.manager.cellphone.value = info.result.engineer_data.cellphone;
                info.manager.cep.value = info.result.engineer_data.cep;
                info.manager.address.value = info.result.engineer_data.address;
                info.manager.number.value = info.result.engineer_data.number;
                info.manager.neighborhood.value = info.result.engineer_data.neighborhood;
                info.manager.city.value = info.result.engineer_data.city;
                info.manager.state.value = info.result.engineer_data.state;

                el.removeAttribute("disabled");

                selectFeedback.innerText = "Formato aceito.";
                validate(el, true);
                validateFeedback(selectFeedback, true);
                return true;
            }

            else {
                info.manager.title.value = "";
                info.manager.registration.value = "";
                info.manager.registrationState.value = "";
                info.manager.email.value = "";
                info.manager.phone.value = "";
                info.manager.cellphone.value = "";
                info.manager.cep.value = "";
                info.manager.address.value = "";
                info.manager.number.value = "";
                info.manager.neighborhood.value = "";
                info.manager.city.value = "";
                info.manager.state.value = "";

                el.removeAttribute("disabled");

                if (info.result.status) {
                    selectFeedback.innerText = "O(a) usuário(a) está bloqueado(a) no sistema.";
                    validate(el, false);
                    validateFeedback(selectFeedback, false);
                    return false;
                }

                else {
                    selectFeedback.innerText = "O(a) usuário(a) não encontrado(a) no sistema.";
                    validate(el, false);
                    validateFeedback(selectFeedback, false);
                    return false;
                }
            }
        }

        else {
            selectFeedback.innerText = "Formato aceito.";
            validate(el, true);
            validateFeedback(selectFeedback, true);
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

window.submitFormEditRequestTypeFirst = async function () {
    let submit;
    const formEditRequestTypeFirst = document.querySelector("#form-edit-request-type-first");
    const clientRG = document.querySelector("#edit-request-first-clientrg");
    const clientRGShippingDate = document.querySelector("#edit-request-first-clientrgshipping");
    const clientCellphone = document.querySelector("#edit-request-first-clientcellphone");
    const clientPhone = document.querySelector("#edit-request-first-clientphone");
    const branchOfActivity = document.querySelector("#edit-request-first-activity");
    const specialLoads = document.querySelector("#edit-request-first-loads");
    const specialLoadsDetails = document.querySelector("#edit-request-first-loadsdetails");
    const subgroup = document.querySelector("#edit-request-first-subgroup");
    const consumptionClass = document.querySelector("#edit-request-first-class");
    const connType = document.querySelector("#edit-request-first-conntype");
    const ucPower = document.querySelector("#edit-request-first-ucpower");
    const ucLoad = document.querySelector("#edit-request-first-ucload");
    const ucBreaker = document.querySelector("#edit-request-first-ucbreaker");
    const ucPD = document.querySelector("#edit-request-first-ucpd");
    const extensionType = document.querySelector("#edit-request-first-extension");
    const transformerId = document.querySelector("#edit-request-first-transformerid");
    const coordinateX = document.querySelector("#edit-request-first-coordinatesx");
    const coordinateY = document.querySelector("#edit-request-first-coordinatesy");
    const responsibleName = document.querySelector("#edit-request-first-responsiblename");
    const responsiblePhone = document.querySelector("#edit-request-first-responsiblephone");
    const responsibleEmail = document.querySelector("#edit-request-first-responsibleemail");
    const managerName = document.querySelector("#edit-request-first-managername");
    const generationType = document.querySelector("#edit-request-first-generationtype");
    const generationDetails = document.querySelector("#edit-request-first-generationdetails");
    const generationFramework = document.querySelector("#edit-request-first-generationframework");
    const generationPower = document.querySelector("#edit-request-first-generationpower");
    const generationOK = document.querySelector("#edit-request-first-generationok");
    const generationVoltage = document.querySelector("#edit-request-first-generationvoltage");
    const art = document.querySelector("#edit-request-first-art");
    const diagram = document.querySelector("#edit-request-first-diagram");
    const memo = document.querySelector("#edit-request-first-memo");
    const compliance = document.querySelector("#edit-request-first-compliance");
    const participants = document.querySelector("#edit-request-first-participants");
    const instrument = document.querySelector("#edit-request-first-instrument");
    const aneel = document.querySelector("#edit-request-first-aneel");
    const link = document.querySelector("#edit-request-first-link");
    const pattern = document.querySelector("#edit-request-first-pattern");
    const rent = document.querySelector("#edit-request-first-rent");
    const procuration = document.querySelector("#edit-request-first-procuration");
    const condominium = document.querySelector("#edit-request-first-condominium");

    const isValidClientRG = (clientRG.value.length !== 0) ? window.validateInput(clientRG, 7) : true;

    const isValidClientRGShippingDate = (clientRGShippingDate.value.length !== 0) ?
        window.validateRGShippingDate(clientRGShippingDate) :
        true;

    const isValidClientCellphone = (!clientCellphone.hasAttribute("disabled") && clientCellphone.value.length !== 0) ?
        window.validatePhone(clientCellphone, 11) :
        true;

    const isValidClientPhone = (!clientPhone.hasAttribute("disabled") && clientPhone.value.length !== 0) ?
        window.validatePhone(clientPhone, 10) :
        true;

    const isValidBranchOfActivity = (branchOfActivity.value.length !== 0) ?
        window.validateSelect(branchOfActivity) :
        true;

    const isValidSpecialLoads = (specialLoads.value.length !== 0) ? window.validateSelect(specialLoads) : true;

    const isValidSpecialLoadsDetails = (specialLoadsDetails.value.length !== 0) ?
        window.validateInput(specialLoadsDetails, 2) :
        true;

    const isValidSubgroup = window.validateInput(subgroup, 1);
    const isValidConsumptionClass = window.validateSelect(consumptionClass);
    const isValidConnType = window.validateSelect(connType);
    const isValidUCPower = (ucPower.value.length !== 0) ? window.validateDouble(ucPower) : true;
    const isValidUCLoad = (ucLoad.value.length !== 0) ? window.validateDouble(ucLoad) : true;
    const isValidUCBreaker = window.validateDouble(ucBreaker);
    const isValidUCPD = (ucPD.value.length !== 0) ? window.validateDouble(ucPD) : true;
    const isValidExtensionType = window.validateInput(extensionType, 2);
    const isValidTransformerId = (transformerId.value.length !== 0) ? window.validateInput(transformerId, 2) : true;
    const isValidCoordinateX = (coordinateX.value.length !== 0) ? window.validateDouble(coordinateX) : true;
    const isValidCoordinateY = (coordinateY.value.length !== 0) ? window.validateDouble(coordinateY) : true;

    const isValidResponsibleName = (responsibleName.value.length !== 0) ?
        window.validateInput(responsibleName, 2) :
        true;

    const isValidResponsiblePhone = (responsiblePhone.value.length !== 0) ?
        window.validatePhone(responsiblePhone, 11) :
        true;

    const isValidResponsibleEmail = (responsibleEmail.value.length !== 0) ?
        window.validateResponsibleEmail(responsibleEmail) :
        true;

    const isValidManagerName = await window.validateSelect(managerName);
    const isValidGenerationtype = window.validateInput(generationType, 2);

    const isValidGenerationDetails = (generationDetails.value.length !== 0) ?
        window.validateInput(generationDetails, 2) :
        true;

    const isValidGenerationFramework = window.validateInput(generationFramework, 2);
    const isValidGenerationPower = (generationPower.value.length !== 0) ? window.validateDouble(generationPower) : true;
    const isValidGenerationOK = (generationOK.value.length !== 0) ? window.validateInput(generationOK, 2) : true;

    const isValidGenerationVoltage = (generationVoltage.value.length !== 0) ?
        window.validateInput(generationVoltage, 2) :
        true;

    const isValidArt = (art.value.length !== 0) ? window.validateInput(art, 2) : true;
    const isValidDiagram = (diagram.value.length !== 0) ? window.validateInput(diagram, 2) : true;
    const isValidMemo = (memo.value.length !== 0) ? window.validateInput(memo, 2) : true;
    const isValidCompliance = (compliance.value.length !== 0) ? window.validateInput(compliance, 2) : true;
    const isValidParticipants = (participants.value.length !== 0) ? window.validateInput(participants, 2) : true;
    const isValidInstrument = (instrument.value.length !== 0) ? window.validateInput(instrument, 2) : true;
    const isValidAneel = (aneel.value.length !== 0) ? window.validateInput(aneel, 2) : true;
    const isValidLink = (link.value.length !== 0) ? window.validateInput(link, 2) : true;
    const isValidPattern = (pattern.value.length !== 0) ? window.validateInput(pattern, 2) : true;
    const isValidRent = (rent.value.length !== 0) ? window.validateInput(rent, 2) : true;
    const isValidProcuration = (procuration.value.length !== 0) ? window.validateInput(procuration, 2) : true;
    const isValidCondominium = (condominium.value.length !== 0) ? window.validateInput(condominium, 2) : true;

    if (!isValidClientRG) submit = false;
    else if (!isValidClientRGShippingDate) submit = false;
    else if (!isValidClientCellphone) submit = false;
    else if (!isValidClientPhone) submit = false;
    else if (!isValidBranchOfActivity) submit = false;
    else if (!isValidSpecialLoads) submit = false;
    else if (!isValidSpecialLoadsDetails) submit = false;
    else if (!isValidSubgroup) submit = false;
    else if (!isValidConsumptionClass) submit = false;
    else if (!isValidConnType) submit = false;
    else if (!isValidUCPower) submit = false;
    else if (!isValidUCLoad) submit = false;
    else if (!isValidUCBreaker) submit = false;
    else if (!isValidUCPD) submit = false;
    else if (!isValidExtensionType) submit = false;
    else if (!isValidTransformerId) submit = false;
    else if (!isValidCoordinateX) submit = false;
    else if (!isValidCoordinateY) submit = false;
    else if (!isValidResponsibleName) submit = false;
    else if (!isValidResponsiblePhone) submit = false;
    else if (!isValidResponsibleEmail) submit = false;
    else if (!isValidManagerName) submit = false;
    else if (!isValidGenerationtype) submit = false;
    else if (!isValidGenerationDetails) submit = false;
    else if (!isValidGenerationFramework) submit = false;
    else if (!isValidGenerationPower) submit = false;
    else if (!isValidGenerationOK) submit = false;
    else if (!isValidGenerationVoltage) submit = false;
    else if (!isValidArt) submit = false;
    else if (!isValidDiagram) submit = false;
    else if (!isValidMemo) submit = false;
    else if (!isValidCompliance) submit = false;
    else if (!isValidParticipants) submit = false;
    else if (!isValidInstrument) submit = false;
    else if (!isValidAneel) submit = false;
    else if (!isValidLink) submit = false;
    else if (!isValidPattern) submit = false;
    else if (!isValidRent) submit = false;
    else if (!isValidProcuration) submit = false;
    else if (!isValidCondominium) submit = false;
    else submit = true;

    errorFocus();

    if (submit) formEditRequestTypeFirst.submit();
}