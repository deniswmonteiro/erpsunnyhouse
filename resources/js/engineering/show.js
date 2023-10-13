import SlideNav from "./slide.js";

/** INIT FUNCTIONS */
$(document).ready(function () {
    moment.locale("pt-br");
    window.moment.locale("pt-br");

    $.fn.dataTable.moment("DD/MM/YYYY");
    $.fn.dataTable.moment("DD/MM/YYYY");

    let monthMap = new Map();
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

    const effectiveDateTables = document.querySelectorAll("table[id^='table-effective-date']");

    effectiveDateTables.forEach((effectiveDate, index) => {
        $(effectiveDate).DataTable({
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
                targets: [0, 1, 2, 3],
                searchable: false,
                visible: false,
            }],
            order: [[0, "desc"]],
            rowGroup: {
                startRender: function (rows, group) {
                    const status = rows.data().pluck(1)[0];
                    let effectiveDateStatus;
                    let effectiveDateList;
                    let effectiveDateListDelete;
                    let showDeleteButton;

                    effectiveDateStatus = (status !== "ATIVO") ? "d-none" : "";
                    showDeleteButton = (status === "ATIVO") ? "d-none" : "";

                    effectiveDateList = rows.data().pluck(2)[0];
                    effectiveDateListDelete = rows.data().pluck(3)[0];

                    return $("<tr class='table-secondary'/>")
                        .append(`
                            <td colspan="6">
                                <span><strong>Data de Vigência:</strong> ${group}</span>
                                <span class="badge bg-warning fw-bold ms-3 ${effectiveDateStatus}"
                                    id="effective-date-status-${index + 1}">ATIVO</span>
                            </td>
                        `)
                        .append(
                            `<td class="text-center align-item-center">
                                <a href="${effectiveDateList}" target="_blank"
                                    class="btn bg-primary text-white btn-sm">
                                    Lista de Rateio
                                    <i class="bi bi-file-earmark-pdf-fill ms-1"></i>
                                </a>
                                <a href="${effectiveDateListDelete}" 
                                    class="btn bg-danger text-white ms-2 ${showDeleteButton}">
                                    <i class="bi bi-trash-fill" style="font-size: 17px"></i>
                                </a>
                            </td>
                        `);
                },
                endRender: function (rows) {
                    const rateSum = rows
                        .data()
                        .pluck(8)
                        .reduce((a, b) => a + Number(b.split(" ")[0].replace(",", ".")), 0);

                    const energySum = rows
                        .data()
                        .pluck(8)
                        .reduce((a, b) => {
                            return a + Number(b.match(/\(.*\)/)[0].split(" ")[0].substr(1).replace(".", "").replace(",", "."));
                        }, 0);

                    return $("<tr/>")
                        .append(`
                            <td colspan="4" class="border-top border-secondary">
                                <span><strong>Qtde. de Beneficiárias: </strong> ${rows.count()}</span>
                            </td>
                        `)
                        .append(`
                            <td colspan="3" class="border-top border-secondary">
                                <span>
                                    <strong>Total: </strong>
                                    ${rateSum} (${energySum.toLocaleString("pt-br", { maximumFractionDigits: 2 })} kWh)
                                </span>
                            </td>
                        `);
                },
                dataSrc: 0
            }
        });
    });

    // Change the view of the Project Images
    const generatorSelection = document.querySelector("#generator-pills-tab");

    if (window.matchMedia("(max-width: 991px)").matches) generatorSelection.classList.add("flex-column");
    else generatorSelection.classList.remove("flex-column");

    // Enable preview images button
    imagesPreview.forEach(preview => {
        const imageTabButtonPrevious = document.querySelector(`#pills-image-tab-previous-${preview.generator_id}`);

        imageTabButtonPrevious.classList.remove("disabled");
    });

    // Enable installation images button
    imagesInstallation.forEach(installation => {
        const imageTabButtonInstallation = document.querySelector(`#pills-image-tab-installation-${installation.generator_id}`);

        imageTabButtonInstallation.classList.remove("disabled");
    });

    // Enable final images button
    imagesFinal.forEach(final => {
        const imageTabButtonFinal = document.querySelector(`#pills-image-tab-final-${final.generator_id}`);

        imageTabButtonFinal.classList.remove("disabled");
    });

    // Enable others images button
    imagesOther.forEach(other => {
        const imageTabButtonOther = document.querySelector(`#pills-image-tab-others-${other.generator_id}`);

        imageTabButtonOther.classList.remove("disabled");
    });

    // Change the view of the protocol tab
    const imageTabs = document.querySelectorAll("ul[id^='image-pills-tab']");

    [...imageTabs].forEach(imageTab => {
        if (window.matchMedia("(max-width: 991px)").matches) imageTab.classList.add("flex-column");
        else imageTab.classList.remove("flex-column");
    });

    const generatorsClient = document.querySelectorAll("input[id*='apportionment-list-generator-client']");
    const beneficiariesClientsInput = document.querySelectorAll("div[id^='new-apportionment-list'] input[id*='project-beneficiary-client']");
    const rates = document.querySelectorAll("div[id^='new-apportionment-list'] input[id*='project-beneficiary-rate']");
    const today = Date.now();
    const protocolDates = document.querySelectorAll("input[id^='protocol-date']");
    const equipmentOversizingInfos = document.querySelectorAll("h6[id^='equipment-oversizing-info']");

    generatorsClient.forEach(generatorClient => window.getBeneficiaryClientCredentials(generatorClient, 1, "create"));
    beneficiariesClientsInput.forEach(input => window.autocomplete(input, clients));

    rates.forEach(rate => {
        window.validateBeneficiaryRate(rate);
        window.handleBeneficiaryRate(rate);
    });

    // Change the view of the protocol tab
    const protocolTabs = document.querySelectorAll("div[id^='protocol-tab']");
    const protocolPillsTab = document.querySelectorAll("div[id^='protocol-pills-tab']");
    const protocolPillsContent = document.querySelectorAll("div[id^='protocol-pills-content']");

    [...protocolTabs].forEach(protocolTab => {
        if (window.matchMedia("(max-width: 991px)").matches) {
            protocolTab.classList.remove("d-flex", "align-items-start");

            [...protocolPillsTab].forEach(tab => {
                tab.classList.remove("col-5");
                tab.setAttribute("aria-orientation", "horizontal");
            });

            [...protocolPillsContent].forEach(content => {
                content.classList.remove("col-7", "ps-5");
                content.classList.add("mt-5");
            });
        }

        else {
            protocolTab.classList.add("d-flex", "align-items-start");

            [...protocolPillsTab].forEach(tab => {
                tab.classList.add("col-5");
                tab.setAttribute("aria-orientation", "vertical");
            });

            [...protocolPillsContent].forEach(content => {
                content.classList.add("col-7", "ps-5");
                content.classList.remove("mt-5");
            });
        }
    });

    // Protocol maximum date
    protocolDates.forEach(date => date.setAttribute("max", toDateFormat(today, "en-us")));

    // Minimum and maximum dates
    const billsDate = document.querySelectorAll("input[type^='month']");

    billsDate.forEach(bill => {
        const tenYearsAgo = today - (10 * 365 * 24 * 60 * 60 * 1000);
        const dateTenYearsAgo = toDateFormatMonthYear(tenYearsAgo, "en-us");
        bill.setAttribute("min", dateTenYearsAgo);

        const nextMonth = today + (30 * 24 * 60 * 60 * 1000);
        const dateNextMonth = toDateFormatMonthYear(nextMonth, "en-us");
        bill.setAttribute("max", dateNextMonth);
    });

    equipmentOversizingInfos.forEach(oversizingInfo => window.getOversizingInfo(oversizingInfo));

    // Project observation
    const observation = document.querySelector("#project-observation");
    const arrObservation = observations.split("<br>");

    [...arrObservation].forEach(observationItem => {
        observation.insertAdjacentHTML("beforeend", `
            <span class="d-block">
                ${observationItem}
            </span>
        `);
    });

    // Mask
    $(["input[id*='cc-beneficiary-input']",
        "input[id*='other-cc-beneficiary']",
        "input[id^='protocol-number']",
        "input[id^='request-uptoten-solar-quantity']",
        "input[id^='request-abovetenuptoseventyfive-solar-quantity']"
    ]).mask("0#");
    $(["input[id^='request-uptoten-solar-modulepower']",
        "input[id^='request-abovetenuptoseventyfive-solar-modulepower']",
        "input[id^='request-uptoten-solar-peakpower']",
        "input[id^='request-abovetenuptoseventyfive-solar-peakpower']",
        "input[id^='request-uptoten-solar-arrangementarea']",
        "input[id^='request-abovetenuptoseventyfive-solar-arrangementarea']",
        "input[id^='request-uptoten-inverter-ratedpower']",
        "input[id^='request-abovetenuptoseventyfive-inverter-ratedpower']",
        "input[id^='request-uptoten-inverter-initialvoltage']",
        "input[id^='request-abovetenuptoseventyfive-inverter-initialvoltage']",
        "input[id^='request-uptoten-inverter-finalvoltage']",
        "input[id^='request-abovetenuptoseventyfive-inverter-finalvoltage']",
        "input[id^='request-uptoten-inverter-ratedcurrent']",
        "input[id^='request-abovetenuptoseventyfive-inverter-ratedcurrent']",
        "input[id^='request-aboveseventyfive-transformer-ratedpower']",
        "input[id^='request-aboveseventyfive-transformer-primaryvoltage']",
        "input[id^='request-aboveseventyfive-transformer-secondaryvoltage']",
    ]).mask("####9V##", {
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
    $(["input[id*='project-beneficiary-rate']",
        "input[id^='request-uptoten-inverter-yield']",
        "input[id^='request-abovetenuptoseventyfive-inverter-yield']",
        "input[id^='request-uptoten-inverter-currentdht']",
        "input[id^='request-abovetenuptoseventyfive-inverter-currentdht']",
        "input[id^='request-aboveseventyfive-transformer-impedance']",
        "input[id^='request-aboveseventyfive-transformer-switchrange']",
    ]).mask("##9V##", {
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
/** Autocomplete  */
window.autocomplete = function (inp, arr) {
    let has_items = false;
    let currentFocus;

    $(`#${inp.id}`).on("input", function (e) {
        let a, b, i, val = this.value;
        has_items = false;

        closeAllLists();

        if (!val) {
            $(`#new_${inp.id}`).show();
            $(`#${inp.id}`).addClass("is-invalid");
            $(`#${inp.id}`).next().text("Preencha o campo.");
            $(`#${inp.id}`).next().addClass("is-invalid");
            return false;
        }

        else {
            $(`#new_${inp.id}`).hide();
            $(`#${inp.id}`).next().text("");
            $(`#${inp.id}`).next().removeClass("is-invalid");
        }

        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", `autocomplete-list-${inp.id}`);
        a.setAttribute("class", "autocomplete-items ");
        a.setAttribute("style", "margin-top:-4px; margin-left: 45px; width:" + $(`#${inp.id}`).parent().width() + "px");

        this.parentNode.appendChild(a);
        const limit = 10;
        let size = 0;

        for (i = 0; i < arr.length; i++) {
            if (arr[i].toLowerCase().includes(val.toLowerCase()) && size < limit) {
                has_items = true;
                size++;

                b = document.createElement("DIV");

                let text = arr[i];
                const reg = new RegExp(`(${val})`, "gi");

                b.innerHTML = text.replace(reg, "<strong>$1</strong>");
                b.innerHTML += `<input type="hidden" value="${arr[i]}">`;

                b.addEventListener("click", function (e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    $(`#${inp.id}`).removeClass("is-invalid");

                    const elemId = inp.id.split("-")[5];
                    const type = inp.id.split("-")[0];
                    window.getBeneficiaryClientCredentials(inp, elemId, type);

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

window.getContractAccount = function (el, login, password, account) {
    const elemId = el.id.split("-")[3];
    const elemItem = el.id.split("-")[0];
    const loadingContractAccount = document.querySelector(`#${elemItem}-loading-contract-account-${elemId}`);
    const iconFileDownload = document.querySelector(`#${elemItem}-icon-file-download-${elemId}`);
    const billDate = document.querySelector(`#${elemItem}-contract-account-date-${elemId}`).value;
    const month = billDate.split("-")[1];
    const year = billDate.split("-")[0];
    const tableContractAccountNumber = document.querySelector(`#${elemItem}-contract-account-info-${elemId} td:nth-child(2)`).innerText;

    const arrContractNumber = billContractAccounts.filter(billMonth => {
        const contractNumber = billMonth.split("_")[0];
        const accountMonth = billMonth.split("_")[1];

        if (tableContractAccountNumber.includes(contractNumber) && billDate === accountMonth) return true;
    });

    if (arrContractNumber.length === 1) {
        const contractAccountInfos = document.querySelectorAll(`#${elemItem}-contract-account-info-${elemId} td`);
        const resp = {
            data: {
                0: {}
            }
        };

        resp.data[0]["fileName"] = `${login}_${arrContractNumber[0].split("_")[0]}_${month}_${year}.pdf`;
        resp.data[0]["contract_account_number"] = contractAccountInfos[1].innerText;
        resp.data[0]["address"] = contractAccountInfos[2].innerText;
        resp.data[0]["neighborhood"] = contractAccountInfos[3].innerText;
        resp.data[0]["city"] = contractAccountInfos[4].innerText;
        resp.data[0]["account_month"] = billDate;

        el.removeAttribute("disabled");
        loadingContractAccount.classList.add("d-none");
        iconFileDownload.classList.remove("d-none");

        formSubmit(el, resp.data);
    }

    else {
        const url = `http://equatorial.sunnyhouse.com.br/extractBills?accountContract=${account}&month=${month}&year=${year}`;
        let data = {
            user: login,
            password: password
        }

        el.setAttribute("disabled", true);
        loadingContractAccount.classList.remove("d-none");
        iconFileDownload.classList.add("d-none");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
                "Accept": "application/json",
                "Content-Type": "application/json",
            },
            url: url,
            type: "POST",
            dataType: "json",
            data: JSON.stringify(data),
            success: function (resp) {
                const pageTitle = document.querySelector(`#modal-${elemItem}-client-documents-${elemId} .modal-header`);

                el.removeAttribute("disabled");
                loadingContractAccount.classList.add("d-none");
                iconFileDownload.classList.remove("d-none");

                if (resp.data.length === 0) {
                    pageTitle.insertAdjacentHTML("afterend", `
                        <div class="alert alert-danger alert-dismissible show fade mt-0 mb-0 ms-auto me-auto" 
                            style="max-width: 576px;">
                            <strong>Não há fatura para o mês selecionado.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);

                    $("div.alert")
                        .delay(5000)
                        .fadeOut(350);
                }

                else {
                    const contractAccountInfos = document.querySelectorAll(`#${elemItem}-contract-account-info-${elemId} td`);

                    resp.data[0]["contract_account_number"] = contractAccountInfos[1].innerText;
                    resp.data[0]["address"] = contractAccountInfos[2].innerText;
                    resp.data[0]["neighborhood"] = contractAccountInfos[3].innerText;
                    resp.data[0]["city"] = contractAccountInfos[4].innerText;
                    resp.data[0]["account_month"] = billDate;

                    formSubmit(el, resp.data);
                }
            },
            error: function (resp) {
                const pageTitle = document.querySelector(`#modal-${elemItem}-client-documents-${elemId} .modal-header`);

                el.removeAttribute("disabled");
                loadingContractAccount.classList.add("d-none");
                iconFileDownload.classList.remove("d-none");

                if (resp.status === 500) {
                    pageTitle.insertAdjacentHTML("afterend", `
                        <div class="alert alert-danger alert-dismissible show fade mt-0 mb-0 ms-auto me-auto" 
                            style="max-width: 576px;">
                            <strong>Credenciais inválidas.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                }

                else if (resp.status === 0) {
                    pageTitle.insertAdjacentHTML("afterend", `
                        <div class="alert alert-danger alert-dismissible show fade mt-0 mb-0 ms-auto me-auto" 
                            style="max-width: 576px;">
                            <strong>Serviço indisponível no momento. Tente novamente mais tarde.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                }

                window.scrollTo(0, 0);
                $("div.alert")
                    .delay(5000)
                    .fadeOut(350);
            }
        });
    }
}

/** Sum all fields of the table and show the total  */
window.sumRequestTableField = function (el) {
    const generator = el.id.split("-")[4];
    const item = el.id.split("-")[2];
    const field = el.id.split("-")[3];
    const category = el.id.split("-")[1];
    const tableFields = document.querySelectorAll(`input[id^="request-${category}-${item}-${field}-${generator}"]`)
    const fieldSum = [...tableFields].reduce((acc, curr) => acc + Number(curr.value.replace(",", ".")), 0);
    const totalItem = document.querySelector(`#request-${category}-${item}-total-${field}-${generator} .form-group p`);

    totalItem.innerText = fieldSum.toLocaleString("pt-BR", { maximumFractionDigits: 2 });
}

/** Enable button to add a table item only if all field are valids */
window.enableBtnRequestAddTableItem = function (el) {
    const generator = el.id.split("-")[4];
    const item = el.id.split("-")[2];
    const category = el.id.split("-")[1];
    const table = el.closest(`[data-request-${category}-${item}-item]`);
    const tableFields = document.querySelectorAll(`#${table.id} [data-request-${category}-${item}-field]`);
    const btnAddItem = document.querySelector(`#btn-add-request-${category}-${item}-item-${generator}`);
    let areAllRequestTableFieldsValids;

    areAllRequestTableFieldsValids = [...tableFields]
        .map(field => field.classList.contains("is-valid") ? true : false)
        .every(field => field === true);

    !areAllRequestTableFieldsValids ?
        btnAddItem.setAttribute("disabled", true) :
        btnAddItem.removeAttribute("disabled");
}

/** Remove a item from form */
window.removeRequestItem = function (el) {
    const item = el.id.split("-")[4]
    const category = el.id.split("-")[3]
    const requestTable = el.closest(`[data-request-${category}-${item}-table]`).id;
    el.parentNode.parentNode.remove();
    const requestItem = document.querySelectorAll(`#${requestTable} [data-request-${category}-${item}-item]`);
    const fieldsToValidate = document.querySelectorAll(`#${requestTable} [data-request-${category}-${item}-field]`);
    const fieldsToSum = document.querySelectorAll(`#${requestTable} [data-request-${category}-${item}-sum]`);

    // Sum all fields and show the new total
    fieldsToSum.forEach(field => window.sumRequestTableField(field));

    if (requestItem.length >= 1) {
        // Validate all fields from the item
        fieldsToValidate.forEach(field => window.enableBtnRequestAddTableItem(field));
    }
}

/** Enable/disable button to add new file */
window.handleBtnAddNewFile = function (el) {
    const elemId = el.id.split("-")[4];
    const elemAction = el.id.split("-")[0];
    const sectionNewFile = el.closest(`div[id^="documents-${elemAction}-new-${elemId}"]`);
    const inputsNewFile = document.querySelectorAll(`#${sectionNewFile.id} input`);
    const btnAddNewFile = document.querySelector(`#btn-${elemAction}-add-new-file-${elemId}`);
    const isValidFile = window.validateCreateFile(inputsNewFile[1]);

    if (inputsNewFile[0].value.length !== 0 && inputsNewFile[1].files.length !== 0 && isValidFile) {
        btnAddNewFile.removeAttribute("disabled");
    }

    else btnAddNewFile.setAttribute("disabled", true);
}

/** Enable/disable button to submit new file from Edit modal */
window.handleBtnSubmitNewFile = function (el) {
    const elemId = el.id.split("-")[4];
    const elemAction = el.id.split("-")[0];
    const sectionNewFile = el.closest(`div[id^="documents-${elemAction}-new-${elemId}"]`);
    const inputsNewFile = document.querySelectorAll(`#${sectionNewFile.id} input`);
    const btnSubmitNewFile = document.querySelector(`#btn-submit-new-file-${elemId}`);
    const isValidFile = window.validateCreateFile(inputsNewFile[1]);

    if (inputsNewFile[0].value.length !== 0 && inputsNewFile[1].files.length !== 0 && isValidFile) {
        btnSubmitNewFile.removeAttribute("disabled");
    }

    else btnSubmitNewFile.setAttribute("disabled", true);
}

// Enable file editing
window.enableEditDocumentForm = function (el) {
    const elemId = el.id.split("-")[3];
    const elemType = el.id.split("-")[2];
    let fileEdit;
    let fileManagement;

    if (elemType === "new") {
        const elemItem = el.id.split("-")[4];

        fileEdit = document.querySelector(`#file-${elemType}-${elemId}-${elemItem}`);
        fileManagement = document.querySelector(`#file-management-${elemType}-${elemId}-${elemItem}`);
    }

    else {
        fileEdit = document.querySelector(`#file-${elemType}-${elemId}`);
        fileManagement = document.querySelector(`#file-management-${elemType}-${elemId}`);
    }

    fileEdit.classList.remove("d-none");
    fileManagement.classList.add("d-none");
}

// Cancel file editing
window.cancelDocumentEdit = function (el) {
    const elemId = el.id.split("-")[4];
    const elemType = el.id.split("-")[3];
    let fileEdit;
    let fileManagement;

    if (elemType === "new") {
        const elemItem = el.id.split("-")[5];

        fileEdit = document.querySelector(`#file-${elemType}-${elemId}-${elemItem}`);
        fileManagement = document.querySelector(`#file-management-${elemType}-${elemId}-${elemItem}`);
    }

    else {
        fileEdit = document.querySelector(`#file-${elemType}-${elemId}`);
        fileManagement = document.querySelector(`#file-management-${elemType}-${elemId}`);
    }

    fileEdit.classList.add("d-none");
    fileManagement.classList.remove("d-none");
}

/** Remove a row with inputs to add new file */
window.removeNewFileRow = function (el) {
    const elemId = el.id.split("-")[4];
    const elemItem = el.id.split("-")[5];
    const elemAction = el.id.split("-")[0];
    const formCreateNewFile = document.querySelector(`#form-add-new-file-${elemId}`);
    const newFileItem = document.querySelector(`#documents-${elemAction}-new-${elemId}-${elemItem}`);
    const allNewFileItems = document.querySelectorAll(`div[id^="documents-${elemAction}-new-${elemId}"]`);
    const btnAddNewFile = document.querySelector(`#btn-${elemAction}-add-new-file-${elemId}`);
    const btnSubmitNewFile = document.querySelector(`#btn-submit-new-file-${elemId}`);

    el.closest(`#${newFileItem.id}`).remove();

    const itemNewFileInputs = document.querySelectorAll(`div[id^="documents-${elemAction}-new-${elemId}"] input`);

    // If inputs aren't valid the submit button will be disabled
    let isValidNewFileName;
    let isValidNewFile;
    const arrInputFileName = [];
    const arrInputFile = [];

    itemNewFileInputs.forEach((input, index) => {
        if (index % 2 === 0) {
            arrInputFileName.push(input)
            isValidNewFileName = arrInputFileName.every(name => window.validateNewFileName(name) ? true : false);
        }

        else {
            arrInputFile.push(input);
            isValidNewFile = arrInputFile.every(file => window.validateCreateFile(file) ? true : false);
        }
    });

    if (elemAction === "edit" && allNewFileItems.length === 1 && !isValidNewFileName && !isValidNewFile) {
        formCreateNewFile.closest(".card").classList.remove("border");
        formCreateNewFile.closest(".card").classList.remove("ms-3");
        formCreateNewFile.closest(".card").classList.remove("me-3");
        btnSubmitNewFile.setAttribute("disabled", true);
    }

    if (elemAction === "edit" && allNewFileItems.length > 1 && isValidNewFileName && isValidNewFile) {
        btnSubmitNewFile.removeAttribute("disabled");
    }

    btnAddNewFile.removeAttribute("disabled");
}

/** Starts slides when modal open */
window.initSlides = function (el) {
    const elemId = el.id.split("-")[4];
    const modal = document.querySelector(`#modal-generator-image-${elemId}`).id;
    const slide = new SlideNav(`#${modal} .slide`, `#${modal} .slide-wrapper`);

    setTimeout(() => {
        slide.init();
        slide.addControl(`#${modal} .custom-control`);
    }, 200);
}

/** Starts slides when generator image type button is clicked */
window.initSlidesFromModal = function (el) {
    const elemId = el.id.split("-")[4];
    const elemType = el.id.split("-")[3];
    const modal = document.querySelector(`#modal-generator-image-${elemId}`).id;
    const modalBody = document.querySelector(`#${modal} #card-${elemType}-${elemId}`).id;
    const slide = new SlideNav(`#${modalBody} .slide`, `#${modalBody} .slide-wrapper`);

    setTimeout(() => {
        slide.init();
        slide.addControl(`#${modalBody} .custom-control`);
    }, 200);
}

/** Submit form with generator image */
window.submitFormAddGeneratorImage = async function (el) {
    let submit = true;
    const elemId = el.split("-")[3];
    const modalGeneratorImages = document.querySelector(`#modal-generator-image-${elemId} .modal-header`);
    const generatorId = document.querySelector(`#generator-id-${elemId}`);
    const imageName = document.querySelector(`#generator-create-image-name-${elemId}`);
    const imageType = document.querySelector(`#generator-create-image-type-${elemId}`);
    const imageFile = document.querySelector(`#generator-create-image-file-${elemId}`);
    const imageNameFeedback = document.querySelector(`#create-image-name-feedback-${elemId}`);
    const imageTypeFeedback = document.querySelector(`#create-image-type-feedback-${elemId}`);
    const imageFileFeedback = document.querySelector(`#create-image-file-feedback-${elemId}`);
    const formData = new FormData();

    const isValidImageName = window.validateImageName(imageName) ? true : false;
    const isValidImageType = window.validateSelect(imageType) ? true : false;
    const isValidImageFile = window.validateCreateImage(imageFile) ? true : false;

    if (!isValidImageName) submit = false;
    if (!isValidImageType) submit = false;
    if (!isValidImageFile) submit = false;

    errorFocus();

    if (submit) {
        const btnCreateGeneratorImage = document.querySelector(`#btn-create-image-${elemId}`);
        const btnCreateGeneratorImageIcon = document.querySelector(`#${btnCreateGeneratorImage.id} i`);
        const btnCreateGeneratorImageLoading = document.querySelector(`#btn-create-image-loading-${elemId}`);

        btnCreateGeneratorImage.setAttribute("disabled", true);
        btnCreateGeneratorImageIcon.classList.add("d-none");
        btnCreateGeneratorImageLoading.classList.remove("d-none");

        formData.append("generator", generatorId.value);
        formData.append("generator-image-name", imageName.value);
        formData.append("generator-image-type", imageType.options[imageType.selectedIndex].value);
        formData.append("generator-image-file", imageFile.files[0]);

        const response = await fetch(url_generator_store_image, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            },
            body: formData
        });

        const result = await response.json();

        if (response.ok) {
            btnCreateGeneratorImage.removeAttribute("disabled");
            btnCreateGeneratorImageIcon.classList.remove("d-none");
            btnCreateGeneratorImageLoading.classList.add("d-none");
            imageName.classList.remove("is-valid");
            imageType.classList.remove("is-valid");
            imageFile.classList.remove("is-valid");
            imageNameFeedback.style.display = "none";
            imageTypeFeedback.style.display = "none";
            imageFileFeedback.style.display = "none";
            imageName.value = "";
            imageType.selectedIndex = 0;
            imageFile.value = "";

            updateGeneratorImagesSlide(result.type, elemId);

            if (result.saved) {
                modalGeneratorImages.insertAdjacentHTML("afterend", `
                    <div class="alert alert-success alert-dismissible show fade mt-0 mb-0 ms-auto me-auto"
                        style="max-width: 576px;">
                        <strong>${result.message}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }

            else {
                modalGeneratorImages.insertAdjacentHTML("afterend", `
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

/** Updates the slide with project images */
async function updateGeneratorImagesSlide(type, generator) {
    const generatorImages = document.querySelectorAll(`#modal-generator-image-${generator} li[id^="generator-image"]`);

    const body = {
        "type": type
    }

    const response = await fetch(url_generator_show_image, {
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
        let type;

        switch (result.type) {
            case "VISTORIA_PREVIA":
                type = "previous";
                break;

            case "INSTALACAO":
                type = "installation";
                break;

            case "VISTORIA_FINAL":
                type = "final";
                break;

            case "OUTRAS":
                type = "others";
                break;
        }

        const thumbs = document.querySelector(`#card-${type}-${generator} .custom-control`);
        const slides = document.querySelector(`#card-${type}-${generator} .slide`);
        let index;

        if (generatorImages.length === 0) index = 0;

        else {
            const arrImageIndex = [...generatorImages].map(image => image.id.split("-")[3]);
            index = Math.max.apply(null, arrImageIndex);
        }

        // Enable previous images button
        if (type === "previous") {
            const imageTabButtonPrevious = document.querySelector(`#pills-image-tab-previous-${generator}`);

            if (imageTabButtonPrevious.classList.contains("disabled")) {
                imageTabButtonPrevious.classList.remove("disabled");
            }
        }

        // Enable installation images button
        if (type === "installation") {
            const imageTabButtonInstallation = document.querySelector(`#pills-image-tab-installation-${generator}`);

            if (imageTabButtonInstallation.classList.contains("disabled")) {
                imageTabButtonInstallation.classList.remove("disabled");
            }
        }

        // Enable final images button
        if (type === "final") {
            const imageTabButtonFinal = document.querySelector(`#pills-image-tab-final-${generator}`);

            if (imageTabButtonFinal.classList.contains("disabled")) imageTabButtonFinal.classList.remove("disabled");
        }

        // Enable others images button
        if (type === "others") {
            const imageTabButtonOther = document.querySelector(`#pills-image-tab-others-${generator}`);

            if (imageTabButtonOther.classList.contains("disabled")) imageTabButtonOther.classList.remove("disabled");
        }

        thumbs.insertAdjacentHTML("beforeend", `
            <li id="generator-thumbnail-${generator}-${index + 1}">
                <img src="${assetProjectImage}/${result.path.substr(13)}" 
                    alt="${result.name}">
            </li>
        `);

        slides.insertAdjacentHTML("beforeend", `
            <li id="generator-image-${generator}-${index + 1}">
                <img src="${assetProjectImage}/${result.path.substr(13)}" 
                    alt="${result.name}">
                <h6 class="mt-3">${result.name}</h6>
                <button type="button" class="btn bg-danger text-white mt-3"
                    id="btn-delete-generator-image-${generator}-${index + 1}"
                    value=${result.id}
                    onclick="return window.removeGeneratorImage(this)"
                    onmousedown="return event.stopPropagation()"
                    onmouseup="return event.stopPropagation()">
                    <i class="bi bi-trash-fill"></i>

                    <div class="spinner-border spinner-border-sm text-white d-none"
                        id="btn-delete-generator-image-loading-${generator}-${index + 1}"
                        role="status">
                        <span class="visually-hidden">
                            Loading...
                        </span>
                    </div>
                </button>
            </li>
        `);

        window.initSlidesFromModal(document.querySelector(`#pills-image-tab-${type}-${generator}`));
    }
}

/** Remove a generator image from slide */
window.removeGeneratorImage = async function (el) {
    const elemId = el.id.split("-")[5];
    const generator = el.id.split("-")[4];
    const modalGeneratorImages = document.querySelector(`#modal-generator-image-${generator} .modal-header`);
    const btnRemoveGeneratorImage = document.querySelector(`#btn-delete-generator-image-${generator}-${elemId}`);
    const btnRemoveGeneratorImageIcon = document.querySelector(`#${btnRemoveGeneratorImage.id} i`);
    const btnRemoveGeneratorImageLoading = document.querySelector(`#btn-delete-generator-image-loading-${generator}-${elemId}`);

    btnRemoveGeneratorImage.setAttribute("disabled", true);
    btnRemoveGeneratorImageIcon.classList.add("d-none");
    btnRemoveGeneratorImageLoading.classList.remove("d-none");

    const body = {
        "image": el.value
    }

    const response = await fetch(url_generator_destroy_image, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(body),
    });

    const result = await response.json();

    if (response.ok) {
        const thumbs = document.querySelector(`#card-${result.type}-${generator} .custom-control`);
        const slides = document.querySelector(`#card-${result.type}-${generator} .slide`);
        const generatorThumbnail = document.querySelector(`.${thumbs.className} #generator-thumbnail-${generator}-${elemId}`);
        const generatorImage = document.querySelector(`.${slides.className} #generator-image-${generator}-${elemId}`);

        generatorThumbnail.remove();
        generatorImage.remove();
        btnRemoveGeneratorImage.setAttribute("disabled", true);
        btnRemoveGeneratorImageIcon.classList.add("d-none");
        btnRemoveGeneratorImageLoading.classList.remove("d-none");

        // Disable preview images button
        if (result.type === "previous" && result.qty_images_type_previous === 0) {
            const imageTabButtonPrevious = document.querySelector(`#pills-image-tab-previous-${generator}`);

            imageTabButtonPrevious.classList.add("disabled");
        }

        // Disable installation images button
        if (result.type === "installation" && result.qty_images_type_installation === 0) {
            const imageTabButtonInstallation = document.querySelector(`#pills-image-tab-installation-${generator}`);

            imageTabButtonInstallation.classList.add("disabled");
        }

        // Disable final images button
        if (result.type === "final" && result.qty_images_type_final === 0) {
            const imageTabButtonFinal = document.querySelector(`#pills-image-tab-final-${generator}`);

            imageTabButtonFinal.classList.add("disabled");
        }

        // Disable others images button
        if (result.type === "others" && result.qty_images_type_others === 0) {
            const imageTabButtonOther = document.querySelector(`#pills-image-tab-others-${generator}`);

            imageTabButtonOther.classList.add("disabled");
        }

        modalGeneratorImages.insertAdjacentHTML("afterend", `
            <div class="alert alert-success alert-dismissible show fade mt-0 mb-0 ms-auto me-auto"
                style="max-width: 576px;" >
                <strong>${result.message}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);

        window.initSlidesFromModal(document.querySelector(`#pills-image-tab-${result.type}-${generator}`));
    }

    else {
        btnRemoveGeneratorImage.setAttribute("disabled", true);
        btnRemoveGeneratorImageIcon.classList.add("d-none");
        btnRemoveGeneratorImageLoading.classList.remove("d-none");

        modalGeneratorImages.insertAdjacentHTML("afterend", `
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

/** Show client input if generator project type is Geração Compartilhada */
window.handleGeneratorProjectType = function (el) {
    const generatorId = el.id.split("-")[3];
    const projectType = document.querySelector(`#generator-project-type-${generatorId}`);

    if (projectType.innerText.trim() === "Geração Compartilhada") el.classList.remove("d-none");
}

/** Show input to add beneficiary client */
window.checkIfAddClientBeneficiary = function (el) {
    const elemId = el.id.split("-")[6];
    const generatorId = el.id.split("-")[5];
    const type = el.id.split("-")[0];
    const generatorClient = document.querySelector(`#apportionment-list-generator-client-${generatorId}`);
    const newApportionmentList = document.querySelector(`#new-apportionment-list-${generatorId}`);
    const beneficiaryClient = document.querySelector(`#${newApportionmentList.id} #${type}-client-beneficiary-${generatorId}-${elemId}`);
    const beneficiaryClientInput = document.querySelector(`#${beneficiaryClient.id} input`);

    if (el.checked) {
        beneficiaryClient.classList.remove("d-none");
        window.getBeneficiaryClientCredentials(generatorClient, elemId, type);
    }

    else {
        beneficiaryClient.classList.add("d-none");
        beneficiaryClientInput.value = "";
        window.getBeneficiaryClientCredentials(generatorClient, elemId, type);
    }
}

/** Set a different beneficiary contract account */
window.setDifferentBeneficiaryContractAccount = function (el) {
    const elemId = el.id.split("-")[5];
    const generatorId = el.id.split("-")[4];
    const type = el.id.split("-")[0];
    const otherBeneficiaryContractAccount = document.querySelector(`#${type}-other-beneficiary-contract-account-${generatorId}-${elemId}`);

    if (el.selectedIndex === (el.length - 1)) otherBeneficiaryContractAccount.classList.remove("d-none");

    else {
        otherBeneficiaryContractAccount.classList.add("d-none");
        otherBeneficiaryContractAccount.value = "";
    }
}

/** Get client beneficiary credentials */
window.getBeneficiaryClientCredentials = async function (el, beneficiaryId, type = null, value = null, differentContractAccount = null) {
    const addressItem = el.closest("[data-generator]").id;
    const generatorId = addressItem.split("-")[4];
    const beneficiaryContractAccountSelect = document.querySelector(`#${type}-beneficiary-contract-account-select-${generatorId}-${beneficiaryId}`);
    const beneficiaryContractAccountInput = document.querySelector(`#${type}-beneficiary-contract-account-input-${generatorId}-${beneficiaryId}`);
    const beneficiaryContractAccount = document.querySelector(`#${type}-cc-beneficiary-select-${generatorId}-${beneficiaryId}`);
    const otherBeneficiaryContractAccount = document.querySelector(`#${type}-other-beneficiary-contract-account-${generatorId}-${beneficiaryId}`);

    const body = {
        "name": el.value.trim()
    };

    const response = await fetch(url_ajax_get_client_credentials, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(body)
    });

    const result = await response.json();

    otherBeneficiaryContractAccount.classList.add("d-none");

    if (response.ok) {
        const login = result.client["login"];
        const password = result.client["password"];

        if (login !== null && password !== null) {
            beneficiaryContractAccountSelect.classList.remove("d-none");
            beneficiaryContractAccountInput.classList.add("d-none");

            // Remove all select options
            while (beneficiaryContractAccount.options.length > 0) {
                beneficiaryContractAccount.remove(0);
            }

            // Set the first select option
            const selectBeneficiaryContractAccount = beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Selecione a conta contrato", "", true, true);
            selectBeneficiaryContractAccount.setAttribute("disabled", true);

            window.getBeneficiaryClientContractAccounts(beneficiaryContractAccount, login, password, value, differentContractAccount);
        }

        else {
            beneficiaryContractAccountSelect.classList.add("d-none");
            beneficiaryContractAccountInput.classList.remove("d-none");
        }
    }

    else {
        beneficiaryContractAccountSelect.classList.add("d-none");
        beneficiaryContractAccountInput.classList.remove("d-none");
    }
}

/** Get client beneficiary contract accounts */
window.getBeneficiaryClientContractAccounts = async function (el, login, password, value = null, differentContractAccount = null) {
    const elemId = el.id.split("-")[5];
    const generatorId = el.id.split("-")[4];
    const type = el.id.split("-")[0];
    const beneficiaryContractAccountSelect = document.querySelector(`#${type}-beneficiary-contract-account-select-${generatorId}-${elemId}`);
    const beneficiaryContractAccountInput = document.querySelector(`#${type}-beneficiary-contract-account-input-${generatorId}-${elemId}`);
    const beneficiaryContractAccount = document.querySelector(`#${type}-cc-beneficiary-select-${generatorId}-${elemId}`);

    const url = "http://equatorial.sunnyhouse.com.br/listAccountContracts";
    let body = {
        user: login,
        password: password
    }

    beneficiaryContractAccountSelect.classList.remove("d-none");
    beneficiaryContractAccountInput.classList.add("d-none");

    // Remove all select options
    while (beneficiaryContractAccount.options.length > 0) {
        beneficiaryContractAccount.remove(0);
    }

    // Set the first select option
    const beneficiaryLoading = beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Carregando...", "", true, true);
    beneficiaryLoading.setAttribute("disabled", true);

    const response = await fetch(url, {
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
        result.data["login"] = login;
        result.data["password"] = password;

        beneficiaryContractAccountSelect.classList.remove("d-none");
        beneficiaryContractAccountInput.classList.add("d-none");

        // Remove all select options
        while (beneficiaryContractAccount.options.length > 0) {
            beneficiaryContractAccount.remove(0);
        }

        // Set the first select option
        const selectBeneficiaryContractAccount = beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Selecione a conta contrato", "", true, true);
        selectBeneficiaryContractAccount.setAttribute("disabled", true);

        for (let i = 0; i < result.data["accountContractsCount"]; i++) {
            const address = result.data["accountContracts"][i]["Endereco"];
            const neighborhood = result.data["accountContracts"][i]["Bairro"];
            let selected = false;

            if (Number(value) === Number(result.data["accountContracts"][i]["Numero"])) selected = true;

            beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option(`${Number(result.data["accountContracts"][i]["Numero"])} - ${address.toLowerCase().replace(/(?:^|\s)\S/g, (a) => a.toUpperCase())}, ${neighborhood.toLowerCase().replace(/(?:^|\s)\S/g, (a) => a.toUpperCase())}`, Number(result.data["accountContracts"][i]["Numero"]), selected, selected);
        }

        if (differentContractAccount) {
            beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Outra conta contrato", "", true, true);
        }

        else {
            beneficiaryContractAccount.options[beneficiaryContractAccount.options.length] = new Option("Outra conta contrato", "", false, false);
        }

        window.validateSelect(beneficiaryContractAccount);
    }

    else {
        // If client Equatorial credentials are invalid
        const beneficiaryClient = document.querySelector(`#${type}-project-beneficiary-client-${generatorId}-${elemId}`);

        if (beneficiaryClient.value !== "") {
            beneficiaryClient.previousElementSibling.classList.add("d-flex", "align-items-center");
            beneficiaryClient.previousElementSibling.insertAdjacentHTML("beforeend", `
                <span class="badge bg-danger ms-2" style="font-size: 0.75rem !important">
                    Verificar credenciais inválidas.
                </span>
            `);
        }

        beneficiaryContractAccountSelect.classList.add("d-none");
        beneficiaryContractAccountInput.classList.remove("d-none");
    }
}

/** Handle the change in the rate value of the beneficiary */
window.handleBeneficiaryRate = function (el) {
    const elemId = el.id.split("-")[5];
    const generatorId = el.id.split("-")[4];
    const type = el.id.split("-")[0];
    const projectType = document.querySelector(`#generator-project-type-${generatorId}`);
    let generatorContractedGenerationProduction;
    const generatorConsumption = document.querySelector(`#apportionment-list-generator-consumption-${generatorId}`);
    const rateMonthlyAvgGeneration = document.querySelector(`#${type}-rate-monthly-avg-generation-${generatorId}-${elemId}`);

    if (projectType.innerText === "Autoconsumo Remoto") {
        const consumption = generatorConsumption.value.replace(".", "").replace(",", ".");

        // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
        generatorContractedGenerationProduction = Number(document.querySelector(`#apportionment-list-generator-contracted-generation-production-${generatorId}`).value.replace(".", "").replace(",", "."));

        rateMonthlyAvgGeneration.innerText = `${Number(((generatorContractedGenerationProduction - consumption) * el.value.replace(",", ".")) / 100).toLocaleString("pt-BR", { maximumFractionDigits: 2 })} kWh`;
    }

    else {
        // Contracted kWp generation ((avgMonthlyGeneration / totalGeneratorPower) * generatorPower)
        generatorContractedGenerationProduction = Number(document.querySelector(`#apportionment-list-generator-contracted-generation-production-${generatorId}`).value.replace(".", "").replace(",", "."));

        rateMonthlyAvgGeneration.innerText = `${Number((generatorContractedGenerationProduction * el.value.replace(",", ".")) / 100).toLocaleString("pt-BR", { maximumFractionDigits: 2 })} kWh`;
    }
}

/** Enable button only if all field are filled */
window.enableBtnAddBeneficiary = function (el) {
    const generatorId = el.id.split("-")[4];
    const type = el.id.split("-")[0];
    const beneficiaryItem = el.closest(`[data-${type}-beneficiary-item]`).id;
    const btnAddBeneficiary = document.querySelector(`#btn-${type}-add-beneficiary-${generatorId}`);
    const beneficiaryFields = document.querySelectorAll(`#${beneficiaryItem} [data-beneficiary]`);
    let areAllBeneficiaryFieldsFilledIn;
    const contractAccountInput = document.querySelector(`#${beneficiaryItem} div[id^="${type}-beneficiary-contract-account-input"]`);
    const beneficiaryContractAccountInput = document.querySelector(`#${beneficiaryItem} input[id^="${type}-cc-beneficiary-input"]`);

    if (!contractAccountInput.classList.contains("d-none")) {
        beneficiaryContractAccountInput.setAttribute("data-beneficiary", true);
    }

    else beneficiaryContractAccountInput.removeAttribute("data-beneficiary");

    areAllBeneficiaryFieldsFilledIn = [...beneficiaryFields]
        .map(field => field.value === "" ? true : false)
        .every(field => field === false);

    if (!areAllBeneficiaryFieldsFilledIn) btnAddBeneficiary.setAttribute("disabled", true);
    else btnAddBeneficiary.removeAttribute("disabled");
}

/** Remove a item from beneficiaries */
window.removeBeneficiaryItem = function (el) {
    const type = el.id.split("-")[1];
    const generator = el.id.split("-")[5];

    el.parentNode.parentNode.remove();

    const btnAddBeneficiary = document.querySelector(`#new-apportionment-list-${generator} #btn-${type}-add-beneficiary-${generator}`);
    const beneficiaryItem = document.querySelectorAll(`#new-apportionment-list-${generator} [data-${type}-beneficiary-item]`);
    const ccBeneficiary = document.querySelector(`#new-apportionment-list-${generator} [data-${type}-beneficiary-item]:first-of-type`);
    const rate = document.querySelector(`#${ccBeneficiary.id} input[id*="project-beneficiary-rate"]:first-of-type`);

    if (beneficiaryItem.length >= 1) btnAddBeneficiary.removeAttribute("disabled");
    if (beneficiaryItem.length === 1) rate.value = 100;

    window.validateBeneficiaryRate(rate);
    window.handleBeneficiaryRate(rate);
}

/** Enable protocol data editing */
window.enableEditProtocolForm = function (el) {
    const elemType = el.id.split("-")[3];
    const elemId = el.id.split("-")[4];
    const elemItem = el.id.split("-")[5];
    const protocolForm = document.querySelector(`#protocol-form-${elemType}-${elemId}-${elemItem}`);
    const protocolManagement = document.querySelector(`#protocol-management-${elemType}-${elemId}-${elemItem}`);

    protocolForm.classList.remove("d-none");
    protocolManagement.classList.add("d-none");
}

/** Cancel protocol edit */
window.cancelEditProtocol = function (el) {
    const elemType = el.id.split("-")[3];
    const elemId = el.id.split("-")[4];
    const elemItem = el.id.split("-")[5];
    const protocolForm = document.querySelector(`#protocol-form-${elemType}-${elemId}-${elemItem}`);
    const protocolManagement = document.querySelector(`#protocol-management-${elemType}-${elemId}-${elemItem}`);

    protocolForm.classList.add("d-none");
    protocolManagement.classList.remove("d-none");
}

/** Show generator power and oversizing percentage if exists */
window.getOversizingInfo = function (el) {
    const generatorId = el.id.split("-")[3];
    const moduleQuantity = document.querySelectorAll(`#pills-${generatorId} [data-equipment-generator]`);
    const inverterQuantity = document.querySelectorAll(`#pills-${generatorId} [data-equipment-inverter]`);
    const equipmentOversizingPercentage = document.querySelector(`#equipment-oversizing-percentage-${generatorId}`);

    // Modules
    const arrModules = [...equipments].map((equipment) => {
        if (equipment.category === "generator") return equipment.power;
    }).filter(elem => elem !== undefined);

    const power = [...moduleQuantity]
        .map((item, index) => Number(item.innerText) * arrModules[index])
        .reduce((acc, curr) => acc + curr, 0);

    // Inverters
    const arrInverters = [...equipments].map((equipment) => {
        if (equipment.category === "inverter") return equipment.power;
    }).filter(elem => elem !== undefined);

    const oversizing = [...inverterQuantity]
        .map((item, index) => Number(item.innerText) * arrInverters[index] * 1000)
        .reduce((acc, curr) => acc + curr, 0);

    // Oversizing
    if (oversizing > 0) {
        equipmentOversizingPercentage.innerHTML = `<small>(sobredimensionamento de inversor: ${Math.round((power / oversizing) * 100)}%)</small>`;
        equipmentOversizingPercentage.classList.remove("d-none");
    }
}

/** Give the option to set the same data from active apportionment list when create a apportionment list */
window.setSameActiveApportinmentListData = async function (el) {
    const generator = el.id.split("-")[6];
    const generatorId = document.querySelector(`#active-generator-apportionment-list-${generator}`);
    const activeApportionmentList = document.querySelector(`#active-apportionment-list-${generator}`);
    const createApportionmentList = document.querySelector(`#create-apportionment-list-${generator}`);

    if (el.checked) {
        const body = {
            "generator": generatorId.value,
        }

        const response = await fetch(url_fetch_get_active_apportionment_list, {
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
            createApportionmentList.parentElement.classList.add("d-none");
            activeApportionmentList.parentElement.classList.remove("d-none");

            // Show client input if Generator project type is "Geração Compartilhada"
            const showClient = result.generator[0]["generator_project_type"] === "GERACAO_COMPARTILHADA" ?
                "d-block" :
                "d-none";

            // Show contract account input if contract client has credentials
            const contractClientHasCredentials = result.generator[0]["contract_client_has_credentials"] ?
                "d-block" :
                "d-none";

            // Show contract account input if contract client hasn't credentials
            const contractClientHasNotCredentials = result.generator[0]["contract_client_has_not_credentials"] ?
                "d-block" :
                "d-none";

            for (let beneficiary = 0; beneficiary < result.generator[0]["beneficiaries"].length; beneficiary++) {
                const beneficiaryClientHasCredentials = result.generator[0]["beneficiaries"][beneficiary]["beneficiary_client_has_credentials"];
                const beneficiaryContractAcount = result.generator[0]["beneficiaries"][beneficiary]["beneficiary_contract_account"];
                const beneficiaryDifferentContractAccount = result.generator[0]["beneficiaries"][beneficiary]["different_beneficiary_contract_account"];
                const beneficiaryRate = result.generator[0]["beneficiaries"][beneficiary]["beneficiary_rate"]
                    .toString()
                    .replace(".", ",");

                activeApportionmentList.insertAdjacentHTML("beforeend", `
                    <div class="accordion-item"
                        id="active-beneficiary-${generator}-${beneficiary + 1}"
                        data-active-beneficiary-item>
                        <h2 class="accordion-header d-flex"
                            id="active-beneficiary-heading-${generator}-${beneficiary + 1}">
                            <button type="button" class="accordion-button fw-bold bg-light bg-gradient text-primary rounded-0 rounded-start"
                                data-bs-toggle="collapse"
                                data-bs-target="#active-beneficiary-collapse-${generator}-${beneficiary + 1}"
                                aria-expanded="true"
                                aria-controls="active-beneficiary-collapse-${generator}-${beneficiary + 1}">
                                Beneficiária ${beneficiary + 1}
                            </button>
                            <button type="button" class="btn btn-danger rounded-0 rounded-end"
                                id="btn-active-remove-beneficiary-item-${generator}-${beneficiary + 1}"
                                onclick="return window.removeBeneficiaryItem(this)">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </h2>
                        <div id="active-beneficiary-collapse-${generator}-${beneficiary + 1}"
                            class="accordion-collapse collapse show"
                            aria-labelledby="active-beneficiary-heading-${generator}-${beneficiary + 1}"
                            data-bs-parent="#cc-beneficiaries-${generator}-${beneficiary + 1}">
                            <div class="accordion-body">
                                <div class="${showClient}"
                                    id="active-beneficiary-client-${generator}-${beneficiary + 1}">
                                    <div class="row mt-3">
                                        <div class="col-12 mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="active-chk-add-beneficiary-client-${generator}-${beneficiary + 1}"
                                                    name="chk-add-beneficiary-client"
                                                    onchange="return window.checkIfAddClientBeneficiary(this)">
                                                <label for="active-chk-add-beneficiary-client-${generator}-${beneficiary + 1}" class="form-check-label">
                                                    Cliente diferente da Geradora?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Beneficiary Client -->
                                        <div class="col-12 col-md-6 mb-3 d-none" 
                                            id="active-client-beneficiary-${generator}-${beneficiary + 1}">
                                            <div class="form-group">
                                                <label for="active-project-beneficiary-client-${generator}-${beneficiary + 1}" class="form-label">
                                                    Cliente
                                                </label>
                                                <input class="form-control" type="text"
                                                    id="active-project-beneficiary-client-${generator}-${beneficiary + 1}"
                                                    name="beneficiaries[address-${beneficiary + 1}][beneficiary-client]"
                                                    value="${result.generator[0]["beneficiaries"][beneficiary]["beneficiary_client"]}">
                                                <div class="invalid-feedback"
                                                    id="active-client-beneficiary-${generator}-${beneficiary + 1}-feedback-project"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Beneficiary Contract Account -->
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="${contractClientHasNotCredentials}"   
                                            id="active-beneficiary-contract-account-input-${generator}-${beneficiary + 1}">
                                            <div class="form-group">
                                                <label for="active-cc-beneficiary-input-${generator}-${beneficiary + 1}"
                                                    class="form-label">
                                                    Conta Contrato Beneficiária
                                                </label>
                                                <input class="form-control" type="text"
                                                    id="active-cc-beneficiary-input-${generator}-${beneficiary + 1}"
                                                    name="beneficiaries[address-${beneficiary + 1}][beneficiary-contract-account]"
                                                    onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"
                                                    onblur="return window.validateInput(this, 1)"
                                                    onkeyup="return window.validateInput(this, 1)"
                                                    maxlength="12"
                                                    data-beneficiary
                                                    required>
                                                <div class="invalid-feedback"
                                                    id="active-cc-beneficiary-input-${generator}-${beneficiary + 1}-feedback-project"></div>
                                            </div>
                                        </div>
                                        <div class="${contractClientHasCredentials}"
                                            id="active-beneficiary-contract-account-select-${generator}-${beneficiary + 1}">
                                            <div class="form-group">
                                                <label for="active-cc-beneficiary-select-${generator}-${beneficiary + 1}" class="form-label">
                                                    Conta Contrato Beneficiária
                                                </label>
                                                <select class="form-select" 
                                                    aria-label="active-cc-beneficiary-select-${generator}-${beneficiary + 1}"
                                                    id="active-cc-beneficiary-select-${generator}-${beneficiary + 1}"
                                                    name="beneficiaries[address-${beneficiary + 1}][beneficiary-contract-account]"
                                                    onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"
                                                    onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)"
                                                    required>
                                                    <option value="" disabled selected>
                                                        Selecione a conta contrato
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback"
                                                    id="active-cc-beneficiary-select-${generator}-${beneficiary + 1}-feedback-project"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Other beneficiary contract account -->
                                    <div class="col-12 col-md-6 mb-3 d-none"
                                        id="active-other-beneficiary-contract-account-${generator}-${beneficiary + 1}">
                                        <div class="form-group">
                                            <label for="active-other-cc-beneficiary-${generator}-${beneficiary + 1}"
                                                class="form-label">
                                                Outra Conta Contrato Beneficiária
                                            </label>
                                            <input class="form-control" type="text"
                                                id="active-other-cc-beneficiary-${generator}-${beneficiary + 1}"
                                                name="beneficiaries[address-${beneficiary + 1}][beneficiary-other-contract-account]"
                                                onchange="return window.validateInput(this, 1)"
                                                onblur="return window.validateInput(this, 1)"
                                                onkeyup="return window.validateInput(this, 1)"
                                                maxlength="12">
                                            <div class="invalid-feedback" 
                                                id="active-cc-other-beneficiary-${generator}-${beneficiary + 1}-feedback-project">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Consumption Class -->
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="active-beneficiary-consumption-class-${generator}-${beneficiary + 1}" class="form-label">
                                                Classe de Consumo
                                            </label>
                                            <select class="form-select"
                                                aria-label="active-beneficiary-consumption-class"
                                                id="active-beneficiary-consumption-class-${generator}-${beneficiary + 1}"
                                                name="beneficiaries[address-${beneficiary + 1}][beneficiary-consumption-class]"
                                                onchange="return window.validateSelect(this), window.enableBtnAddBeneficiary(this)"
                                                onblur="return window.validateSelect(this)"
                                                data-beneficiary
                                                required>
                                                <option value="" disabled selected>
                                                    Escolha a classe de consumo
                                                </option>
                                                <option value="${beneficiaryConsumptionClassIndex1}">
                                                    Residencial
                                                </option>
                                                <option value="${beneficiaryConsumptionClassIndex2}">
                                                    Industrial
                                                </option>
                                                <option value="${beneficiaryConsumptionClassIndex3}">
                                                    Comércio, Serviço e outras atividades
                                                </option>
                                                <option value="${beneficiaryConsumptionClassIndex4}">
                                                    Rural
                                                </option>
                                                <option value="${beneficiaryConsumptionClassIndex5}">
                                                    Poder Público
                                                </option>
                                                <option value="${beneficiaryConsumptionClassIndex6}">
                                                    Iluminação Pública
                                                </option>
                                                <option value="${beneficiaryConsumptionClassIndex7}">
                                                    Serviço Público
                                                </option>
                                                <option value="${beneficiaryConsumptionClassIndex8}">
                                                    Consumo Próprio
                                                </option>
                                            </select>
                                            <div class="invalid-feedback" 
                                                id="active-beneficiary-consumption-class-${generator}-${beneficiary + 1}-feedback-project">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rate -->
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="active-project-beneficiary-rate-${generator}-${beneficiary + 1}"
                                                class="form-label">
                                                Rateio
                                            </label>
                                            <div class="input-group">
                                                <input class="form-control" type="text"
                                                    id="active-project-beneficiary-rate-${generator}-${beneficiary + 1}"
                                                    name="beneficiaries[address-${beneficiary + 1}][beneficiary-rate]"
                                                    value="${beneficiaryRate}"
                                                    onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"
                                                    onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                    onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"
                                                    data-beneficiary
                                                    required>
                                                <span class="input-group-text rounded-end">
                                                    %
                                                </span>
                                                <span class="input-group-text bg-secondary text-white ms-4 rounded" 
                                                    id="active-rate-monthly-avg-generation-${generator}-${beneficiary + 1}" data-rate-monthly>
                                                </span>
                                            </div>
                                            <div class="invalid-feedback" 
                                                id="active-beneficiary-rate-${generator}-${beneficiary + 1}-feedback-project">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Address -->
                                    <div class="col-12 mb-3">
                                        <div class="form-group">
                                            <label for="active-project-beneficiary-address-${generator}-${beneficiary + 1}" class="form-label">
                                                Endereço
                                            </label>
                                            <input class="form-control" type="text"
                                                id="active-project-beneficiary-address-${generator}-${beneficiary + 1}"
                                                name="beneficiaries[address-${beneficiary + 1}][beneficiary-address]"
                                                value="${result.generator[0]["beneficiaries"][beneficiary]["beneficiary_address"]}"
                                                onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"
                                                onblur="return window.validateInput(this, 2)"
                                                onkeyup="return window.validateInput(this, 2)"
                                                data-beneficiary
                                                required>
                                            <div class="invalid-feedback" 
                                                id="active-beneficiary-address-${generator}-${beneficiary + 1}-feedback-project">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                // Don't show the button to remove the first Beneficiary Item
                const btnRemoveBeneficiaryItem = document.querySelector(`#btn-active-remove-beneficiary-item-${generator}-1`);

                btnRemoveBeneficiaryItem.classList.add("d-none");

                // Check if Beneficiary client is different from Generator client
                const chkAddBeneficiaryClient = document.querySelector(`#active-chk-add-beneficiary-client-${generator}-${beneficiary + 1}`);

                chkAddBeneficiaryClient.checked = result.generator[0]["beneficiaries"][beneficiary]["different_generator_beneficiary_client"];

                // Beneficiary client
                const beneficiaryClient = document.querySelector(`#active-project-beneficiary-client-${generator}-${beneficiary + 1}`);

                window.autocomplete(beneficiaryClient, clients);
                window.getBeneficiaryClientCredentials(beneficiaryClient, beneficiary + 1, "active", beneficiaryContractAcount, beneficiaryDifferentContractAccount);

                // Show beneficiary client input if Beneficiary client is different from Generator client
                chkAddBeneficiaryClient.checked ?
                    beneficiaryClient.closest(`#active-client-beneficiary-${generator}-${beneficiary + 1}`).classList.remove("d-none") :
                    beneficiaryClient.closest(`#active-client-beneficiary-${generator}-${beneficiary + 1}`).classList.add("d-none");

                // Beneficiary contract account
                const beneficiaryContractAccountInput = document.querySelector(`#active-cc-beneficiary-input-${generator}-${beneficiary + 1}`);
                const beneficiaryOtherContractAccount = document.querySelector(`#active-other-beneficiary-contract-account-${generator}-${beneficiary + 1}`);
                const beneficiaryOtherContractAccountInput = document.querySelector(`#active-other-beneficiary-contract-account-${generator}-${beneficiary + 1} input`);

                if (beneficiaryDifferentContractAccount) {
                    setTimeout(() => {
                        beneficiaryOtherContractAccount.classList.remove("d-none");
                        beneficiaryOtherContractAccountInput.value = beneficiaryContractAcount;
                    }, 200);
                }

                else beneficiaryContractAccountInput.value = beneficiaryContractAcount;

                // Beneficiary consumption class
                const selectConsumptionClass = document.querySelector(`#active-beneficiary-consumption-class-${generator}-${beneficiary + 1}`);
                const beneficiaryConsumptionClass = result.generator[0]['beneficiaries'][beneficiary]['beneficiary_consumption_class'];

                switch (beneficiaryConsumptionClass) {
                    case "RESIDENCIAL":
                        selectConsumptionClass.selectedIndex = 1;
                        break;

                    case "INDUSTRIAL":
                        selectConsumptionClass.selectedIndex = 2;
                        break;

                    case "COMERCIO_SERVICOS_OUTROS":
                        selectConsumptionClass.selectedIndex = 3;
                        break;

                    case "RURAL":
                        selectConsumptionClass.selectedIndex = 4;
                        break;

                    case "PODER_PUBLICO":
                        selectConsumptionClass.selectedIndex = 5;
                        break;

                    case "ILUMINACAO_PUBLICA":
                        selectConsumptionClass.selectedIndex = 6;
                        break;

                    case "SERVICO_PUBLICO":
                        selectConsumptionClass.selectedIndex = 7;
                        break;

                    case "CONSUMO_PROPRIO":
                        selectConsumptionClass.selectedIndex = 8;
                        break;

                    default:
                        selectConsumptionClass.selectedIndex = 0;
                        break;
                }

                // Beneficiary rate
                const rate = document.querySelector(`#active-project-beneficiary-rate-${generator}-${beneficiary + 1}`);
                window.validateBeneficiaryRate(rate);
                window.handleBeneficiaryRate(rate);
            }

            // Button to add Beneficiary
            const generatorActiveApportionmentList = document.querySelectorAll(`div[id^="active-beneficiary-${generator}"]`);
            const lastBeneficiaryItemFromActiveApportionmentList = document.querySelector(`#active-beneficiary-${generator}-${generatorActiveApportionmentList.length}`);

            lastBeneficiaryItemFromActiveApportionmentList.insertAdjacentHTML("afterend", `
                <!-- Button Add Beneficiary -->
                <div class="row justify-content-end mt-4 mb-4">
                    <div class="col-12 col-md-4 d-flex justify-content-end">
                        <div class="form-group"> 
                            <button class="btn btn-warning d-flex justify-content-center align-items-center btn-add-beneficiary"
                                type="button"
                                id="btn-active-add-beneficiary-${generator}"
                                onclick="return window.addApportionmentListBeneficiary(this)">
                                <i class="bi bi-plus-circle-fill me-2"></i>
                                Adicionar Beneficiária
                            </button>
                        </div>
                    </div>
                </div>
            `);
        }
    }

    else {
        // Remove beneficiaries from active apportionment list
        [...activeApportionmentList.children].forEach(beneficiary => beneficiary.remove());

        // Show form to create apportionment list and hide form with active apportionment list
        activeApportionmentList.parentElement.classList.add("d-none");
        createApportionmentList.parentElement.classList.remove("d-none");
    }
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

/** Formats date in milliseconds to "yyyy-mm" or "mm/yyyy" */
function toDateFormatMonthYear(date, format) {
    date = new Date((parseInt(date)));

    let month = parseInt(date.getMonth()) + 1;

    month = ((month.toString().length == 1) ?
        "0" + month.toString() :
        month.toString());

    let year = date.getFullYear();

    switch (format) {
        case "pt-br":
            date = `${month}/${year}`;
            break;

        case "en-us":
            date = `${year}-${month}`;
            break;

        default:
            date = `${month}/${year}`;
            break;
    }

    return date;
}

/** Show the input with error on submit */
function errorFocus() {
    if (document.querySelector(".is-invalid") !== null) document.querySelector(".is-invalid").focus();
}

/** VALIDATIONS **/
window.validateBillDate = function (el) {
    const elemId = el.id.split("-")[4];
    const elemType = el.id.split("-")[0];
    const btnBillDownload = document.querySelector(`#${elemType}-btn-account-${elemId}`);

    el.value !== "" ?
        btnBillDownload.removeAttribute("disabled") :
        btnBillDownload.setAttribute("disabled", true);
}

window.validateCreateFile = function (file) {
    const elemId = file.id.split("-")[4];
    const fileType = file.id.split("-")[3];
    const elemAction = file.id.split("-")[0];
    let fileCreateFeedback;
    const mime_types = ["application/pdf", "image/jpeg", "image/png"];

    if (fileType === "new") {
        const newFileItem = file.id.split("-")[5];
        const newFileName = document.querySelector(`#${elemAction}-generator-documents-newfilename-${elemId}-${newFileItem}`);

        fileCreateFeedback = document.querySelector(`#${elemAction}-documents-${fileType}-feedback-${elemId}-${newFileItem}`);
        window.validateNewFileName(newFileName);
    }

    else fileCreateFeedback = document.querySelector(`#${elemAction}-documents-${fileType}-feedback-${elemId}`);

    if (file.files.length === 0) {
        fileCreateFeedback.innerText = "Preencha o campo.";
        validate(file, false);
        validateFeedback(fileCreateFeedback, false);
        return false;
    }

    else if (file.files[0] !== undefined && mime_types.indexOf(file.files[0].type) == -1) {
        fileCreateFeedback.innerText = `O arquivo ${file.files[0].name} não é permitido.`;
        validate(file, false);
        validateFeedback(fileCreateFeedback, false);
        return false;
    }

    else if (file.files[0] !== undefined && file.files[0].size > 20 * 1024 * 1024) {
        fileCreateFeedback.innerText = `O arquivo ${file.files[0].name} ultrapassou limite de 20 MB.`;
        validate(file, false);
        validateFeedback(fileCreateFeedback, false);
        return false;
    }

    else {
        fileCreateFeedback.innerText = "Formato aceito.";
        validate(file, true);
        validateFeedback(fileCreateFeedback, true);
        return true;
    }
}

window.validateEditFile = function (file) {
    const elemId = file.id.split("-")[4];
    const fileType = file.id.split("-")[3];
    let filename;
    let fileEditFeedback;
    const mime_types = ["application/pdf", "image/jpeg", "image/png"];

    if (fileType === "new") {
        const elemItem = file.id.split("-")[5];

        filename = document.querySelector(`#file-${fileType}-name-${elemId}-${elemItem}`);
        fileEditFeedback = document.querySelector(`#edit-documents-${fileType}-feedback-${elemId}-${elemItem}`);
    }

    else {
        filename = document.querySelector(`#file-${fileType}-name-${elemId}`);
        fileEditFeedback = document.querySelector(`#edit-documents-${fileType}-feedback-${elemId}`);
    }

    if (file.files.length === 0) {
        if (filename !== null) {
            filename.classList.remove("d-none");
            filename.classList.add("d-block");
        }

        fileEditFeedback.classList.remove("d-block");
        fileEditFeedback.classList.add("d-none");
        validate(file, true);
        return true;
    }

    else {
        if (filename !== null) {
            filename.classList.remove("d-block");
            filename.classList.add("d-none");
        }

        fileEditFeedback.classList.remove("d-none");
        fileEditFeedback.classList.add("d-block");

        if (file.files[0] !== undefined && mime_types.indexOf(file.files[0].type) == -1) {
            fileEditFeedback.innerText = `O arquivo ${file.files[0].name} não é permitido.`;
            validate(file, false);
            validateFeedback(fileEditFeedback, false);
            return false;
        }

        else if (file.files[0] !== undefined && file.files[0].size > 20 * 1024 * 1024) {
            fileEditFeedback.innerText = `O arquivo ${file.files[0].name} ultrapassou limite de 20 MB.`;
            validate(file, false);
            validateFeedback(fileEditFeedback, false);
            return false;
        }

        else {
            fileEditFeedback.innerText = "Formato aceito.";
            validate(file, true);
            validateFeedback(fileEditFeedback, true);
            return true;
        }
    }
}

window.validateCreateImage = function (el) {
    const elemId = el.id.split("-")[4];
    const imageFileFeedback = document.querySelector(`#create-image-file-feedback-${elemId}`);
    const mime_types = ["image/jpeg", "image/png"];

    if (el.files.length === 0) {
        imageFileFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(imageFileFeedback, false);
        return false;
    }

    else if (el.files[0] !== undefined && mime_types.indexOf(el.files[0].type) == -1) {
        imageFileFeedback.innerText = `O arquivo ${el.files[0].name} não é permitido.`;
        validate(el, false);
        validateFeedback(imageFileFeedback, false);
        return false;
    }

    else if (el.files[0] !== undefined && el.files[0].size > 20 * 1024 * 1024) {
        imageFileFeedback.innerText = `O arquivo ${el.files[0].name} ultrapassou limite de 20 MB.`;
        validate(el, false);
        validateFeedback(imageFileFeedback, false);
        return false;
    }

    else {
        imageFileFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(imageFileFeedback, true);
        return true;
    }
}

window.validateNewFileName = function (el) {
    const elemId = el.id.split("-")[4];
    const elemItem = el.id.split("-")[5];
    const elemAction = el.id.split("-")[0];
    const newFileName = document.querySelector(`#${elemAction}-generator-documents-newfilename-${elemId}-${elemItem}`);
    const newFileNameFeedback = document.querySelector(`#${elemAction}-documents-newfile-name-feedback-${elemId}-${elemItem}`);
    const fileInput = document.querySelector(`#${elemAction}-generator-documents-new-${elemId}-${elemItem}`);

    if (fileInput.files.length > 0) {
        if (newFileName.value.length === 0) {
            newFileNameFeedback.innerText = "Preencha o campo.";
            validate(newFileName, false);
            validateFeedback(newFileNameFeedback, false);
            return false;
        }

        else {
            newFileNameFeedback.innerText = "Formato aceito.";
            validate(newFileName, true);
            validateFeedback(newFileNameFeedback, true);
            return true;
        }
    }

    else {
        newFileNameFeedback.innerText = "";
        newFileName.classList.remove("is-valid");
        newFileNameFeedback.classList.remove("is-valid");
        newFileName.classList.remove("is-invalid");
        newFileNameFeedback.classList.remove("is-invalid");
        return true;
    }
}

window.validateImageName = function (el) {
    const elemId = el.id.split("-")[4];
    const elemAction = el.id.split("-")[1];
    const imageNameFeedback = document.querySelector(`#${elemAction}-image-name-feedback-${elemId}`);

    if (el.value.length === 0) {
        imageNameFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(imageNameFeedback, false);
        return false;
    }

    else {
        imageNameFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(imageNameFeedback, true);
        return true;
    }
}

window.validateBeneficiaryClient = function (el) {
    const elemId = el.id.split("-")[4];
    const generatorId = el.id.split("-")[5];
    const type = el.id.split("-")[0];
    const clientFeedback = document.querySelector(`#${type}-client-beneficiary-${elemId}-${generatorId}-feedback-project`);

    if (clients.find(elem => elem === el.value)) {
        clientFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(clientFeedback, true);
        return true;
    }

    else {
        clientFeedback.innerText = "Cliente não cadastrado no sistema.";
        validate(el, false);
        validateFeedback(clientFeedback, false);
        return false;
    }
}

window.validateBeneficiaryRate = function (el) {
    const elemId = el.id.split("-")[5];
    const generatorId = el.id.split("-")[4];
    const type = el.id.split("-")[0];
    const rateFeedback = document.querySelector(`#${type}-beneficiary-rate-${generatorId}-${elemId}-feedback-project`);
    const beneficiariesRateInput = document.querySelectorAll(`#new-apportionment-list-${generatorId} input[id*="${type}-project-beneficiary-rate"]`);

    const sumBeneficiariesRateInput = Array.from(beneficiariesRateInput).reduce((acc, curr) => {
        return acc + Number(curr.value.replace(",", "."))
    }, 0);

    if (sumBeneficiariesRateInput !== 100) {
        beneficiariesRateInput.forEach(rate => {
            rate.parentNode.nextElementSibling.innerHTML = "A soma das taxas deve ser igual à <span class='fw-bold'>100%</span>.";
            validate(rate, false);
            validateFeedback(rate.parentNode.nextElementSibling, false);
        });

        return false;
    }

    else if (el.value.length === 0) {
        rateFeedback.innerText = "Preencha o campo.";
        validate(el, false);
        validateFeedback(rateFeedback, false);
        return false;
    }

    else if (el.value > 100) {
        rateFeedback.innerText = "Digite um valor menor ou igual a 100%";
        validate(el, false);
        validateFeedback(rateFeedback, false);
        return false;
    }

    else if (Number(el.value) === 0) {
        rateFeedback.innerText = "Digite um valor maior que zero.";
        validate(el, false);
        validateFeedback(rateFeedback, false);
        return false;
    }

    else if (el.value.substr(-1) === ",") {
        rateFeedback.innerText = "Digite um valor válido.";
        validate(el, false);
        validateFeedback(rateFeedback, false);
        return false;
    }

    else {
        beneficiariesRateInput.forEach(rate => {
            rate.parentNode.nextElementSibling.innerText = "Formato aceito.";
            validate(rate, true);
            validateFeedback(rate.parentNode.nextElementSibling, true);
        });

        rateFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(rateFeedback, true);
        return true;
    }
}

window.validateProtocolDate = function (el) {
    const elemType = el.id.split("-")[2];
    const elemId = el.id.split("-")[3];
    const elemItem = el.id.split("-")[4];
    const today = toDateFormat(Date.now(), "en-us");
    const todayDate = new Date(today.split("-")[0], today.split("-")[1] - 1, today.split("-")[2]);
    const protocolDate = new Date(el.value.split("-")[0], el.value.split("-")[1] - 1, el.value.split("-")[2]);
    const protocolDateFeedback = document.querySelector(`#protocol-date-feedback-${elemType}-${elemId}-${elemItem}`);
    const minDate = new Date("01/01/2000".split("/")[2], "01/01/2000".split("/")[1] - 1, "01/01/2000".split("/")[0]);

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

window.validateDouble = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

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

window.validatePercentage = function (el) {
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.value.length !== 0 || el.hasAttribute("required")) {
        if (el.value.length === 0) {
            feedback.innerText = "Preencha o campo.";
            validate(el, false);
            validateFeedback(feedback, false);
            return false;
        }

        else if (el.value.replace(",", ".") > 100) {
            feedback.innerText = "Digite um valor menor ou igual a 100%";
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
    const feedback = el.closest(".form-group").lastElementChild;

    if (el.value.length !== 0 || el.hasAttribute("required")) {
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
        feedback.innerText = "";
        validate(el, true);
        validateFeedback(feedback, true);
        return true;
    }
}

window.validateSelect = function (el) {
    const selectFeedback = el.closest(".form-group").lastElementChild;

    if (el.selectedIndex === 0) {
        selectFeedback.innerText = "Escolha uma opção.";
        validate(el, false);
        validateFeedback(selectFeedback, false);
        return false;
    }

    else {
        selectFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(selectFeedback, true);
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

function formSubmit(el, data) {
    const elemId = el.id.split("-")[3];
    const elemItem = el.id.split("-")[0];

    document.querySelector(`#${elemItem}-contract-account-${elemId}`).value = JSON.stringify(data);
    document.querySelector(`#${elemItem}-contract-account-bill-${elemId}`).submit();
}

window.submitFormRequest = function (el) {
    const type = el.id.split("-")[4];
    const generator = el.id.split("-")[5];
    let submit;
    const formRequest = document.querySelector(`#form-request-${type}-${generator}`);
    const modulePowers = document.querySelectorAll(`input[id^="request-${type}-solar-modulepower-${generator}"]`);
    const quantities = document.querySelectorAll(`input[id^="request-${type}-solar-quantity-${generator}"]`);
    const peakPowers = document.querySelectorAll(`input[id^="request-${type}-solar-peakpower-${generator}"]`);
    const arrangementAreas = document.querySelectorAll(`input[id^="request-${type}-solar-arrangementarea-${generator}"]`);
    const moduleManufacturers = document.querySelectorAll(`input[id^="request-${type}-solar-modulemanufacturers-${generator}"]`);
    const moduleModels = document.querySelectorAll(`input[id^="request-${type}-solar-modulemodel-${generator}"]`);
    const manufacturers = document.querySelectorAll(`input[id^="request-${type}-inverter-manufacturer-${generator}"]`);
    const models = document.querySelectorAll(`input[id^="request-${type}-inverter-model-${generator}"]`);
    const ratedPowers = document.querySelectorAll(`input[id^="request-${type}-inverter-ratedpower-${generator}"]`);
    const initialVoltages = document.querySelectorAll(`input[id^="request-${type}-inverter-initialvoltage-${generator}"]`);
    const finalVoltages = document.querySelectorAll(`input[id^="request-${type}-inverter-finalvoltage-${generator}"]`);
    const ratedCurrents = document.querySelectorAll(`input[id^="request-${type}-inverter-ratedcurrent-${generator}"]`);
    const powerFactors = document.querySelectorAll(`input[id^="request-${type}-inverter-powerfactor-${generator}"]`);
    const yields = document.querySelectorAll(`input[id^="request-${type}-inverter-yield-${generator}"]`);
    const dhtCurrents = document.querySelectorAll(`input[id^="request-${type}-inverter-currentdht-${generator}"]`);
    const transformerRatedPowers = document.querySelectorAll(`input[id^="request-${type}-transformer-ratedpower-${generator}"]`);
    const transformerTransformerImpedances = document.querySelectorAll(`input[id^="request-${type}-transformer-impedance-${generator}"]`);
    const transformerPrimaryVoltages = document.querySelectorAll(`input[id^="request-${type}-transformer-primaryvoltage-${generator}"]`);
    const transformerSecondaryVoltage = document.querySelectorAll(`input[id^="request-${type}-transformer-secondaryvoltage-${generator}"]`);
    const transformerSwitchRange = document.querySelectorAll(`input[id^="request-${type}-transformer-switchrange-${generator}"]`);

    const isValidModulePower = [...modulePowers].every(module => window.validateDouble(module) ? true : false);
    const isValidQuantity = [...quantities].every(quantity => window.validateInput(quantity, 1) ? true : false);
    const isValidPeakPower = [...peakPowers].every(peak => window.validateDouble(peak) ? true : false);

    const isValidArrangementArea = [...arrangementAreas]
        .every(arrangement => window.validateDouble(arrangement) ? true : false);

    const isValidModuleManufacturer = [...moduleManufacturers]
        .every(module => window.validateInput(module, 2) ? true : false);

    const isValidModuleModel = [...moduleModels].every(module => window.validateInput(module, 2) ? true : false);

    const isValidManufacturer = [...manufacturers]
        .every(manufacturer => window.validateInput(manufacturer, 2) ? true : false);

    const isValidModel = [...models].every(model => window.validateInput(model, 2) ? true : false);
    const isValidRatedPower = [...ratedPowers].every(power => window.validateDouble(power) ? true : false);
    const isValidInitialVoltage = [...initialVoltages].every(initial => window.validateDouble(initial) ? true : false);
    const isValidFinalVoltage = [...finalVoltages].every(final => window.validateDouble(final) ? true : false);
    const isValidRatedCurrent = [...ratedCurrents].every(current => window.validateDouble(current) ? true : false);
    const isValidPowerFactor = [...powerFactors].every(factor => window.validateInput(factor, 2) ? true : false);
    const isValidYield = [...yields].every(yieldPercent => window.validatePercentage(yieldPercent) ? true : false);
    const isValidDHTCurrent = [...dhtCurrents].every(dht => window.validatePercentage(dht) ? true : false);

    // Transformer
    const arrTransformerRatedPowers = [];
    const arrTransformerImpedances = [];
    const arrTransformerPrimaryVoltages = [];
    const arrTransformerSecondaryVoltages = [];
    const arrTransformerSwitchRange = [];

    transformerRatedPowers.forEach(ratedPower => {
        if (ratedPower.value.length !== 0) arrTransformerRatedPowers.push(ratedPower);
    });

    transformerTransformerImpedances.forEach(impedance => {
        if (impedance.value.length !== 0) arrTransformerImpedances.push(impedance);
    });

    transformerPrimaryVoltages.forEach(primaryVoltages => {
        if (primaryVoltages.value.length !== 0) arrTransformerPrimaryVoltages.push(primaryVoltages);
    });

    transformerSecondaryVoltage.forEach(secondaryVoltage => {
        if (secondaryVoltage.value.length !== 0) arrTransformerSecondaryVoltages.push(secondaryVoltage);
    });

    transformerSwitchRange.forEach(switchRange => {
        if (switchRange.value.length !== 0) arrTransformerSwitchRange.push(switchRange);
    });

    const isValidTransformerRatedPower = arrTransformerRatedPowers
        .every(ratedPower => window.validateDouble(ratedPower) ? true : false);

    const isValidTransformerImpedance = arrTransformerImpedances
        .every(impedance => window.validatePercentage(impedance) ? true : false);

    const isValidTransformerPrimaryVoltage = arrTransformerPrimaryVoltages
        .every(primaryVoltage => window.validateDouble(primaryVoltage) ? true : false);

    const isValidTransformerSecondaryVoltage = arrTransformerSecondaryVoltages
        .every(secondaryVoltage => window.validateDouble(secondaryVoltage) ? true : false);

    const isValidTransformerSwitchRange = arrTransformerSwitchRange
        .every(switchRange => window.validatePercentage(switchRange) ? true : false);

    if (!isValidModulePower) submit = false;
    else if (!isValidQuantity) submit = false;
    else if (!isValidPeakPower) submit = false;
    else if (!isValidArrangementArea) submit = false;
    else if (!isValidModuleManufacturer) submit = false;
    else if (!isValidModuleModel) submit = false;
    else if (!isValidManufacturer) submit = false;
    else if (!isValidModel) submit = false;
    else if (!isValidRatedPower) submit = false;
    else if (!isValidInitialVoltage) submit = false;
    else if (!isValidFinalVoltage) submit = false;
    else if (!isValidRatedCurrent) submit = false;
    else if (!isValidPowerFactor) submit = false;
    else if (!isValidYield) submit = false;
    else if (!isValidDHTCurrent) submit = false;
    else if (!isValidTransformerRatedPower) submit = false;
    else if (!isValidTransformerImpedance) submit = false;
    else if (!isValidTransformerPrimaryVoltage) submit = false;
    else if (!isValidTransformerSecondaryVoltage) submit = false;
    else if (!isValidTransformerSwitchRange) submit = false;
    else submit = true;

    errorFocus();

    if (submit) formRequest.submit();
}

window.submitFormCreateGeneratorDocuments = function (el) {
    let submit = true;
    const elemId = el.id.split("-")[4];
    const formCreateGeneratorDocuments = document.querySelector(`#form-create-generator-documents-${elemId}`);
    const artFile = document.querySelector(`#create-generator-documents-art-${elemId}`);
    const aneelFormFile = document.querySelector(`#create-generator-documents-aneel-${elemId}`);
    const dataSheetCertificatesFile = document.querySelector(`#create-generator-documents-certificates-${elemId}`);
    const descriptiveMemorialFile = document.querySelector(`#create-generator-documents-memorial-${elemId}`);
    const electricalProjectFile = document.querySelector(`#create-generator-documents-electrical-${elemId}`);
    const newFileNames = document.querySelectorAll(`input[id^="create-generator-documents-newfilename-${elemId}"]`);
    const newFiles = document.querySelectorAll(`input[id^="create-generator-documents-new-${elemId}"]`);

    const isValidArtFile = window.validateCreateFile(artFile);
    let isValidAneelFormFile;

    if (aneelFormFile.files.length > 0) isValidAneelFormFile = window.validateCreateFile(aneelFormFile);

    const isValidDataSheetCertificatesFile = window.validateCreateFile(dataSheetCertificatesFile);
    const isValidDescriptiveMemorialFile = window.validateCreateFile(descriptiveMemorialFile);
    const isValidElectricalProjectFile = window.validateCreateFile(electricalProjectFile);

    const isValidNewFileName = Array.from(newFileNames)
        .every(newFileName => window.validateNewFileName(newFileName) ? true : false);

    const isValidNewFile = Array.from(newFiles).every(newFile => window.validateCreateFile(newFile) ? true : false);

    if (!isValidArtFile) submit = false;
    if (aneelFormFile.files.length > 0 && !isValidAneelFormFile) submit = false;
    if (!isValidDataSheetCertificatesFile) submit = false;
    if (!isValidDescriptiveMemorialFile) submit = false;
    if (!isValidElectricalProjectFile) submit = false;
    if (!isValidNewFileName) submit = false;
    if (!isValidNewFile) submit = false;

    errorFocus();

    if (submit) {
        const allInputsFile = document.querySelectorAll("input[type='file']");
        const btnCreateGeneratorDocuments = document.querySelector(`#btn-create-generator-documents-${elemId}`);
        const btnCreateGeneratorDocumentsLoading = document.querySelector(`#btn-create-generator-documents-loading-${elemId}`);

        btnCreateGeneratorDocuments.setAttribute("disabled", true);
        btnCreateGeneratorDocumentsLoading.classList.remove("d-none");

        allInputsFile.forEach(input => {
            if (input.files[0] !== undefined) {
                input.closest(".form-group").lastElementChild.innerHTML = `<span class="fw-bold">Enviando</span> ${input.files[0].name}...`;
            }
        });

        formCreateGeneratorDocuments.submit();
    }

    return submit;
}

window.submitFormUpdateGeneratorDocuments = function (el) {
    let submit = true;
    const elemId = el.id.split("-")[3];
    const elemType = el.id.split("-")[2];
    let elemItem;
    let formUpdateDocument;
    let generatorDocument;

    if (elemType === "new") {
        elemItem = el.id.split("-")[4];
        formUpdateDocument = document.querySelector(`#form-document-${elemType}-${elemId}-${elemItem}`);
        generatorDocument = document.querySelector(`#edit-generator-documents-${elemType}-${elemId}-${elemItem}`);
    }

    else {
        formUpdateDocument = document.querySelector(`#form-document-${elemType}-${elemId}`);
        generatorDocument = document.querySelector(`#edit-generator-documents-${elemType}-${elemId}`);
    }

    const isValidGeneratorDocument = window.validateEditFile(generatorDocument);

    if (generatorDocument.files.length === 0) submit = false;
    if (!isValidGeneratorDocument) submit = false;

    errorFocus();

    if (submit) {
        let documentFeedback;
        let btnUpdateGeneratorDocumentsLoading;
        const btnSubmitIcon = document.querySelector(`#${el.id} i`);

        if (elemType === "new") {
            elemItem = el.id.split("-")[4];
            documentFeedback = document.querySelector(`#edit-documents-${elemType}-feedback-${elemId}-${elemItem}`);
            btnUpdateGeneratorDocumentsLoading = document.querySelector(`#btn-update-${elemType}-loading-${elemId}-${elemItem}`);
        }

        else {
            documentFeedback = document.querySelector(`#edit-documents-${elemType}-feedback-${elemId}`);
            btnUpdateGeneratorDocumentsLoading = document.querySelector(`#btn-update-${elemType}-loading-${elemId}`);
        }

        el.setAttribute("disabled", true);
        btnSubmitIcon.classList.add("d-none");
        btnUpdateGeneratorDocumentsLoading.classList.remove("d-none");

        if (generatorDocument.files[0] !== undefined) {
            documentFeedback.innerHTML = `<span class="fw-bold">Enviando</span> ${generatorDocument.files[0].name}...`;
        }

        formUpdateDocument.submit();
    }

    return submit;
}

/** Submit form of new files from project documents edit modal */
window.submitFormAddNewFile = function (el) {
    let submit = true;
    const elemId = el.id.split("-")[4];
    const formAddNewFile = document.querySelector(`#form-add-new-file-${elemId}`);
    const newFiles = document.querySelectorAll(`#${formAddNewFile.id} input[id^="edit-generator-documents-new-${elemId}"]`);

    const isValidNewFile = Array.from(newFiles).every(newFile => window.validateCreateFile(newFile) ? true : false);

    if (!isValidNewFile) submit = false;

    errorFocus();

    if (submit) {
        const btnCreateGeneratorDocuments = document.querySelector(`#btn-submit-new-file-${elemId}`);
        const btnCreateGeneratorDocumentsLoading = document.querySelector(`#btn-submit-new-file-loading-${elemId}`);

        btnCreateGeneratorDocuments.setAttribute("disabled", true);
        btnCreateGeneratorDocumentsLoading.classList.remove("d-none");

        newFiles.forEach(input => {
            if (input.files[0] !== undefined) {
                input.closest(".form-group").lastElementChild.innerHTML = `<span class="fw-bold">Enviando</span> ${input.files[0].name}...`;
            }
        });

        formAddNewFile.submit();
    }

    return submit;
}

/** Submit data from new apportionment list */
window.submitFormNewApportionmentList = function (el) {
    let submit = true;
    const elemId = el.id.split("-")[4];
    const generatorProjectType = document.querySelector(`#generator-project-type-${elemId}`);
    const chkSameActiveApportionmentList = document.querySelector(`#chk-same-generator-active-apportionment-list-${elemId}`);
    const type = chkSameActiveApportionmentList.checked ? "active" : "create";
    const formNewApportionmentList = document.querySelector(`#form-${type}-apportionment-list-${elemId}`);
    const chksAddBeneficiaryClient = document.querySelectorAll(`#${formNewApportionmentList.id} input[id^="${type}-chk-add-beneficiary-client"]`);
    let installationCCBeneficiaryInput;
    let installationCCBeneficiarySelect;
    let beneficiaryOtherContractAccountInput;

    if (generatorProjectType.innerText.trim() === "Geração Compartilhada") {
        // Beneficiary Client
        const arrBeneficiariesClients = [];
        let beneficiaryClient;

        chksAddBeneficiaryClient.forEach(chk => {
            if (chk.checked) {
                beneficiaryClient = document.querySelector(`#${type}-project-beneficiary-client-${elemId}-${chk.id.split("-")[6]}`);
                arrBeneficiariesClients.push(beneficiaryClient);
            }
        });

        const isValidBeneficiaryClient = arrBeneficiariesClients.every(client => {
            return window.validateBeneficiaryClient(client) ? true : false
        });

        errorFocus();

        if (!isValidBeneficiaryClient) submit = false;
    }

    if (generatorProjectType.innerText.trim() === "Autoconsumo Remoto" || generatorProjectType.innerText.trim() === "Geração Compartilhada") {
        // Beneficiary contract account via input
        const beneficiaryContractAccountInput = document.querySelectorAll(`#${formNewApportionmentList.id} div[id^="${type}-beneficiary-contract-account-input"]`);
        let isValidCCBeneficiaryInput;

        beneficiaryContractAccountInput.forEach(input => {
            if (!input.classList.contains("d-none")) {
                installationCCBeneficiaryInput = document.querySelectorAll(`#${input.id} input[id^="${type}-cc-beneficiary-input"]`);

                isValidCCBeneficiaryInput = [...installationCCBeneficiaryInput].every(ccBeneficiaryInput => {
                    return window.validateInput(ccBeneficiaryInput) ? true : false
                });

                errorFocus();

                if (!isValidCCBeneficiaryInput) submit = false;
            }
        });

        // Beneficiary contract account via select
        const beneficiaryContractAccountSelect = document.querySelectorAll(`#${formNewApportionmentList.id} div[id^="${type}-beneficiary-contract-account-select"]`);
        let isValidCCBeneficiarySelect;

        beneficiaryContractAccountSelect.forEach(select => {
            if (!select.classList.contains("d-none")) {
                installationCCBeneficiarySelect = document.querySelectorAll(`#${select.id} select[id^="${type}-cc-beneficiary-select"]`);

                isValidCCBeneficiarySelect = [...installationCCBeneficiarySelect].every(ccBeneficiarySelect => {
                    return window.validateSelect(ccBeneficiarySelect) ? true : false
                });

                errorFocus();

                if (!isValidCCBeneficiarySelect) submit = false;
            }
        });

        // Other beneficiary contract account
        const beneficiaryOtherContractAccount = document.querySelectorAll(`#${formNewApportionmentList.id} div[id^="${type}-other-beneficiary-contract-account"]`);
        let isValidOtherBeneficiaryCA;

        beneficiaryOtherContractAccount.forEach(div => {
            if (!div.classList.contains("d-none")) {
                beneficiaryOtherContractAccountInput = document.querySelectorAll(`#${div.id} input[id^="${type}-other-cc-beneficiary"]`);

                isValidOtherBeneficiaryCA = [...beneficiaryOtherContractAccountInput].every(otherBeneficiaryCA => {
                    return window.validateInput(otherBeneficiaryCA) ? true : false
                });

                errorFocus();

                if (!isValidOtherBeneficiaryCA) submit = false;
            }
        });

        const beneficiariesConsumptionClass = document.querySelectorAll(`#${formNewApportionmentList.id} select[id^="${type}-beneficiary-consumption-class"]`);
        const beneficiariesRate = document.querySelectorAll(`#${formNewApportionmentList.id} input[id^="${type}-beneficiary-rate"]`);
        const beneficiariesAddress = document.querySelectorAll(`#${formNewApportionmentList.id} input[id^="${type}-beneficiary-address"]`);

        const isBeneficiaryConsumptionClass = [...beneficiariesConsumptionClass].every(comsumptionClass => {
            return window.validateSelect(comsumptionClass) ? true : false;
        });

        const isBeneficiaryRate = [...beneficiariesRate].every(beneficiaryRate => {
            return window.validateBeneficiaryRate(beneficiaryRate) ? true : false;
        });

        const isBeneficiaryAddress = [...beneficiariesAddress].every(beneficiaryAddress => {
            return window.validateInput(beneficiaryAddress) ? true : false;
        });

        errorFocus();

        if (!isBeneficiaryConsumptionClass) submit = false;
        else if (!isBeneficiaryRate) submit = false;
        else if (!isBeneficiaryAddress) submit = false;
    }

    if (submit) formNewApportionmentList.submit();
}

window.submitFormProtocol = function (el) {
    const elemType = el.id.split("-")[2];
    const elemId = el.id.split("-")[3];
    const elemItem = el.id.split("-")[3];
    let submit = true;
    const protocolNumber = document.querySelector(`#protocol-number-${elemType}-${elemId}-${elemItem}`);
    const protocolDate = document.querySelector(`#protocol-date-${elemType}-${elemId}-${elemItem}`);

    let isValidProtocolNumber;
    let isValidProtocolDate;

    if (elemType !== "homologated") isValidProtocolNumber = window.validateInput(protocolNumber);

    isValidProtocolDate = window.validateProtocolDate(protocolDate);

    if (elemType !== "homologated" && !isValidProtocolNumber) return false;
    if (!isValidProtocolDate) return false;

    return submit;
}