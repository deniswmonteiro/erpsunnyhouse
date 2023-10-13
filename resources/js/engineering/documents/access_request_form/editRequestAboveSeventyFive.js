/** INIT FUNCTIONS */
$(document).ready(function () {
    // Mask
    $("#edit-request-third-clientrg").mask("0#");
    $(["#edit-request-third-clientcellphone",
        "#edit-request-third-clientphone"
    ]).mask(window.SPMaskBehavior, spOptions);
    $(["#edit-request-third-ucinstalledloadkw",
        "#edit-request-third-ucinstalledloadkva",
        "#edit-request-third-ucdemandkw",
        "#edit-request-third-ucpower",
        "#edit-request-third-contracteddemandfp",
        "#edit-request-third-contracteddemandp",
        "#edit-request-third-coordinatesx",
        "#edit-request-third-coordinatesy",
        "#edit-request-third-generationpower",
        "#create-request-third-generationpd"
    ]).mask("#######9V##", {
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
    const title = document.querySelector("#edit-request-third-managertitle");
    const registration = document.querySelector("#edit-request-third-managerregistration");
    const registrationState = document.querySelector("#edit-request-third-managerregistrationstate");
    const email = document.querySelector("#edit-request-third-manageremail");
    const phone = document.querySelector("#edit-request-third-managerphone");
    const cellphone = document.querySelector("#edit-request-third-managercellphone");
    const cep = document.querySelector("#edit-request-third-managercep");
    const address = document.querySelector("#edit-request-third-manageraddress");
    const number = document.querySelector("#edit-request-third-managernumber");
    const neighborhood = document.querySelector("#edit-request-third-managerneighborhood");
    const city = document.querySelector("#edit-request-third-managercity");
    const state = document.querySelector("#edit-request-third-managerstate");
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
    const dateFeedback = document.querySelector("#edit-third-clientrgshipping-feedback-request");
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
    let phoneFeedback = document.querySelector(`#edit-third-${elemId}-feedback-request`);

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
    const feedback = document.querySelector(`#edit-third-${elemId}-feedback-request`);

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

window.submitFormEditRequestTypeThird = async function () {
    let submit;
    const formEditRequestTypeThird = document.querySelector("#form-edit-request-type-third");
    const clientRG = document.querySelector("#edit-request-third-clientrg");
    const clientRGShippingDate = document.querySelector("#edit-request-third-clientrgshipping");
    const clientCellphone = document.querySelector("#edit-request-third-clientcellphone");
    const clientPhone = document.querySelector("#edit-request-third-clientphone");
    const branchOfActivity = document.querySelector("#edit-request-third-activity");
    const specialLoads = document.querySelector("#edit-request-third-loads");
    const specialLoadsDetails = document.querySelector("#edit-request-third-loadsdetails");
    const subgroup = document.querySelector("#edit-request-third-subgroup");
    const consumptionClass = document.querySelector("#edit-request-third-class");
    const connType = document.querySelector("#edit-request-third-conntype");
    const ucConn = document.querySelector("#edit-request-third-ucconn");
    const ucInstalledLoadKw = document.querySelector("#edit-request-third-ucinstalledloadkw");
    const ucInstalledLoadKva = document.querySelector("#edit-request-third-ucinstalledloadkva");
    const ucDemandKw = document.querySelector("#edit-request-third-ucdemandkw");
    const ucDemandKva = document.querySelector("#edit-request-third-ucdemandkva");
    const ucInputPattern = document.querySelector("#edit-request-third-ucinputpattern");
    const ucPower = document.querySelector("#edit-request-third-ucpower");
    const tariffGroup = document.querySelector("#edit-request-third-tariffgroup");
    const contractedDemandFP = document.querySelector("#edit-request-third-contracteddemandfp");
    const contractedDemandP = document.querySelector("#edit-request-third-contracteddemandp");
    const extensionType = document.querySelector("#edit-request-third-extension");
    const transformerId = document.querySelector("#edit-request-third-transformerid");
    const coordinateX = document.querySelector("#edit-request-third-coordinatesx");
    const coordinateY = document.querySelector("#edit-request-third-coordinatesy");
    const managerName = document.querySelector("#edit-request-third-managername");
    const generationType = document.querySelector("#edit-request-third-generationtype");
    const generationDetails = document.querySelector("#edit-request-third-generationdetails");
    const generationFramework = document.querySelector("#edit-request-third-generationframework");
    const generationPower = document.querySelector("#edit-request-third-generationpower");
    const generationOK = document.querySelector("#edit-request-third-generationok");
    const generationPD = document.querySelector("#edit-request-third-generationpd");
    const generationVoltage = document.querySelector("#edit-request-third-generationvoltage");
    const art = document.querySelector("#edit-request-third-art");
    const diagram = document.querySelector("#edit-request-third-diagram");
    const memo = document.querySelector("#edit-request-third-memo");
    const electrical = document.querySelector("#edit-request-third-electrical");
    const stage = document.querySelector("#edit-request-third-stage");
    const compliance = document.querySelector("#edit-request-third-compliance");
    const participants = document.querySelector("#edit-request-third-participants");
    const instrument = document.querySelector("#edit-request-third-instrument");
    const aneel = document.querySelector("#edit-request-third-aneel");
    const viability = document.querySelector("#edit-request-third-viability");
    const substationAir = document.querySelector("#edit-request-third-chartair");
    const substationSheltered = document.querySelector("#edit-request-third-chartsheltered");
    const rent = document.querySelector("#edit-request-third-rent");
    const procuration = document.querySelector("#edit-request-third-procuration");
    const condominium = document.querySelector("#edit-request-third-condominium");

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
    const isValidUCConn = (ucConn.value.length !== 0) ? window.validateInput(ucConn, 1) : true;

    const isValidUCInstalledLoadKw = (ucInstalledLoadKw.value.length !== 0) ?
        window.validateDouble(ucInstalledLoadKw) :
        true;

    const isValidUCInstalledLoadKva = (ucInstalledLoadKva.value.length !== 0) ?
        window.validateDouble(ucInstalledLoadKva) :
        true;

    const isValidUCDemandKw = (ucDemandKw.value.length !== 0) ? window.validateDouble(ucDemandKw) : true;
    const isValidUCDemanKva = (ucDemandKva.value.length !== 0) ? window.validateDouble(ucDemandKva) : true;
    const isValidUCInputPattern = window.validateInput(ucInputPattern, 2);
    const isValidUCPower = (ucPower.value.length !== 0) ? window.validateDouble(ucPower) : true;
    const isValidTariffGroup = window.validateInput(tariffGroup, 2);

    const isValidContractedDemandFP = (contractedDemandFP.value.length !== 0) ?
        window.validateDouble(contractedDemandFP) :
        true;

    const isValidContractedDemandP = (contractedDemandP.value.length !== 0) ?
        window.validateDouble(contractedDemandP) :
        true;

    const isValidExtensionType = window.validateInput(extensionType, 2);
    const isValidTransformerId = (transformerId.value.length !== 0) ? window.validateInput(transformerId, 2) : true;
    const isValidCoordinateX = (coordinateX.value.length !== 0) ? window.validateDouble(coordinateX) : true;
    const isValidCoordinateY = (coordinateY.value.length !== 0) ? window.validateDouble(coordinateY) : true;
    const isValidManagerName = await window.validateSelect(managerName);
    const isValidGenerationtype = window.validateInput(generationType, 2);

    const isValidGenerationDetails = (generationDetails.value.length !== 0) ?
        window.validateInput(generationDetails, 2) :
        true;

    const isValidGenerationFramework = window.validateInput(generationFramework, 2);
    const isValidGenerationPower = (generationPower.value.length !== 0) ? window.validateDouble(generationPower) : true;
    const isValidGenerationOK = (generationOK.value.length !== 0) ? window.validateInput(generationOK, 2) : true;
    const isValidGenerationPD = (generationPD.value.length !== 0) ? window.validateDouble(generationPD) : true;

    const isValidGenerationVoltage = (generationVoltage.value.length !== 0) ?
        window.validateInput(generationVoltage, 2) :
        true;

    const isValidArt = (art.value.length !== 0) ? window.validateInput(art, 2) : true;
    const isValidDiagram = (diagram.value.length !== 0) ? window.validateInput(diagram, 2) : true;
    const isValidMemo = (memo.value.length !== 0) ? window.validateInput(memo, 2) : true;
    const isValidElectrical = (electrical.value.length !== 0) ? window.validateInput(electrical, 2) : true;
    const isValidStage = (stage.value.length !== 0) ? window.validateInput(stage, 2) : true;
    const isValidCompliance = (compliance.value.length !== 0) ? window.validateInput(compliance, 2) : true;
    const isValidParticipants = (participants.value.length !== 0) ? window.validateInput(participants, 2) : true;
    const isValidInstrument = (instrument.value.length !== 0) ? window.validateInput(instrument, 2) : true;
    const isValidAneel = (aneel.value.length !== 0) ? window.validateInput(aneel, 2) : true;
    const isValidViability = (viability.value.length !== 0) ? window.validateInput(viability, 2) : true;
    const isValidSubstationAir = (substationAir.value.length !== 0) ? window.validateInput(substationAir, 2) : true;

    const isValidSubstationSheltered = (substationSheltered.value.length !== 0) ?
        window.validateInput(substationSheltered, 2) :
        true;

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
    else if (!isValidUCConn) submit = false;
    else if (!isValidUCInstalledLoadKw) submit = false;
    else if (!isValidUCInstalledLoadKva) submit = false;
    else if (!isValidUCDemandKw) submit = false;
    else if (!isValidUCDemanKva) submit = false;
    else if (!isValidUCInputPattern) submit = false;
    else if (!isValidUCPower) submit = false;
    else if (!isValidTariffGroup) submit = false;
    else if (!isValidContractedDemandFP) submit = false;
    else if (!isValidContractedDemandP) submit = false;
    else if (!isValidExtensionType) submit = false;
    else if (!isValidTransformerId) submit = false;
    else if (!isValidCoordinateX) submit = false;
    else if (!isValidCoordinateY) submit = false;
    else if (!isValidManagerName) submit = false;
    else if (!isValidGenerationtype) submit = false;
    else if (!isValidGenerationDetails) submit = false;
    else if (!isValidGenerationFramework) submit = false;
    else if (!isValidGenerationPower) submit = false;
    else if (!isValidGenerationOK) submit = false;
    else if (!isValidGenerationPD) submit = false;
    else if (!isValidGenerationVoltage) submit = false;
    else if (!isValidArt) submit = false;
    else if (!isValidDiagram) submit = false;
    else if (!isValidMemo) submit = false;
    else if (!isValidElectrical) submit = false;
    else if (!isValidStage) submit = false;
    else if (!isValidCompliance) submit = false;
    else if (!isValidParticipants) submit = false;
    else if (!isValidInstrument) submit = false;
    else if (!isValidAneel) submit = false;
    else if (!isValidViability) submit = false;
    else if (!isValidSubstationAir) submit = false;
    else if (!isValidSubstationSheltered) submit = false;
    else if (!isValidRent) submit = false;
    else if (!isValidProcuration) submit = false;
    else if (!isValidCondominium) submit = false;
    else submit = true;

    errorFocus();

    if (submit) formEditRequestTypeThird.submit();
}