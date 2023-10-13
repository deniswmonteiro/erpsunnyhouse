$(document).ready(function () {
    $("#table_id").DataTable({
        "bPaginate": false,
        "info": false,
        "language": {
            "lengthMenu": "Visualizar _MENU_ itens por página",
            "zeroRecords": "Sem Informações",
            "infoEmpty": "Sem Informações",
            "infoFiltered": "",
            "search": "Pesquisar",
        }
    });

    /** handle button that open the Client Bills modal */
    const btnOpenModalClientBills = document.querySelector("#open-modal-client-bills");

    if (arrContractAccounts.length === 0) btnOpenModalClientBills.setAttribute("disabled", true);
    else btnOpenModalClientBills.removeAttribute("disabled");

    /** min and max date */
    const today = Date.now();
    const billsDate = document.querySelectorAll("input[id^='contract-account-date']");

    billsDate.forEach(bill => {
        const tenYearsAgo = today - (10 * 365 * 24 * 60 * 60 * 1000);
        const dateTenYearsAgo = toDateFormatMonthYear(tenYearsAgo, "en-us");
        bill.setAttribute("min", dateTenYearsAgo);

        const nextMonth = today + (30 * 24 * 60 * 60 * 1000);
        const dateNextMonth = toDateFormatMonthYear(nextMonth, "en-us");
        bill.setAttribute("max", dateNextMonth);
    });
});

window.deleteClientContractAccountBill = function (el, login, password) {
    const elemId = el.id.split("-")[4];
    const loadingContractAccounts = document.querySelector(`#btn-client-delete-bill-loading-${elemId}`);
    const btnText = document.querySelector(`#btn-icon-${elemId}`);
    const url = "http://equatorial.sunnyhouse.com.br/listAccountContracts";
    let data = {
        user: login,
        password: password
    }

    el.setAttribute("disabled", true);
    loadingContractAccounts.classList.remove("d-none");
    btnText.classList.add("d-none");

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
            resp.data['login'] = login;
            resp.data['password'] = password;
            el.removeAttribute("disabled");
            loadingContractAccounts.classList.add("d-none");
            btnText.classList.remove("d-none");
            formSubmitContractAccounts(el, resp.data);
        },
        error: function (resp) {
            const pageTitle = document.querySelector("#modal-show-client-bills .modal-body");

            el.removeAttribute("disabled");
            loadingContractAccounts.classList.add("d-none");
            btnText.classList.remove("d-none");

            if (resp.status === 500) {
                pageTitle.insertAdjacentHTML("afterbegin", `
                    <div class="alert alert-danger alert-dismissible show fade mt-0 mb-0 ms-auto me-auto" 
                        style="max-width: 576px;">
                        <strong>Credenciais do cliente inválidas.</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }

            else if (resp.status === 0) {
                pageTitle.insertAdjacentHTML("afterbegin", `
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

window.validateBillDate = function (el) {
    const elemId = el.id.split("-")[3];
    const btnBillDownload = document.querySelector(`#btn-account-${elemId}`);

    el.value !== "" ?
        btnBillDownload.removeAttribute("disabled") :
        btnBillDownload.setAttribute("disabled", true);
}

window.getContractAccount = function (el, login, password, account) {
    const elemId = el.id.split("-")[2];
    const loadingContractAccount = document.querySelector(`#loading-contract-account-${elemId}`);
    const iconFileDownload = document.querySelector(`#icon-file-download-${elemId}`);
    const billDate = document.querySelector(`#contract-account-date-${elemId}`).value;
    const month = billDate.split("-")[1];
    const year = billDate.split("-")[0];
    const tableContractAccountNumber = document.querySelector(`#contract-account-info-${elemId} td:nth-child(2)`).innerText;

    const arrContractNumber = billContractAccounts.filter(billMonth => {
        const contractNumber = billMonth.split("_")[0];
        const accountMonth = billMonth.split("_")[1];

        if (tableContractAccountNumber.includes(contractNumber) && billDate === accountMonth) return true;
    });

    if (arrContractNumber.length === 1) {
        const contractAccountInfos = document.querySelectorAll(`#contract-account-info-${elemId} td`);
        const resp = { data: { 0: {} } };

        resp.data[0]['fileName'] = `${login}_${arrContractNumber[0].split("_")[0]}_${month}_${year}.pdf`;
        resp.data[0]['contract_account_number'] = contractAccountInfos[1].innerText;
        resp.data[0]['address'] = contractAccountInfos[2].innerText;
        resp.data[0]['neighborhood'] = contractAccountInfos[3].innerText;
        resp.data[0]['city'] = contractAccountInfos[4].innerText;
        resp.data[0]['installation_number'] = contractAccountInfos[5].innerText;
        resp.data[0]['account_month'] = billDate;

        el.removeAttribute("disabled");
        loadingContractAccount.classList.add("d-none");
        iconFileDownload.classList.remove("d-none");

        formSubmitBill(el, resp.data);
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
                const pageTitle = document.querySelector(".page-title");

                el.removeAttribute("disabled");
                loadingContractAccount.classList.add("d-none");
                iconFileDownload.classList.remove("d-none");

                if (resp.data.length === 0) {
                    pageTitle.insertAdjacentHTML("afterend", `
                        <div class="alert alert-danger alert-dismissible show fade">
                            <strong>Não há fatura para o mês selecionado.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);

                    window.scrollTo(0, 0);
                    $("div.alert")
                        .delay(5000)
                        .fadeOut(350);
                }

                else {
                    const contractAccountInfos = document.querySelectorAll(`#contract-account-info-${elemId} td`);

                    resp.data[0]['contract_account_number'] = contractAccountInfos[1].innerText;
                    resp.data[0]['address'] = contractAccountInfos[2].innerText;
                    resp.data[0]['neighborhood'] = contractAccountInfos[3].innerText;
                    resp.data[0]['city'] = contractAccountInfos[4].innerText;
                    resp.data[0]['installation_number'] = contractAccountInfos[5].innerText;
                    resp.data[0]['account_month'] = billDate;

                    formSubmitBill(el, resp.data);
                }
            },
            error: function (resp) {
                const pageTitle = document.querySelector(".page-title");

                el.removeAttribute("disabled");
                loadingContractAccount.classList.add("d-none");
                iconFileDownload.classList.remove("d-none");

                if (resp.status === 500) {
                    pageTitle.insertAdjacentHTML("afterend", `
                        <div class="alert alert-danger alert-dismissible show fade">
                            <strong>Credenciais inválidas.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                }

                else if (resp.status === 0) {
                    pageTitle.insertAdjacentHTML("afterend", `
                        <div class="alert alert-danger alert-dismissible show fade">
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

// formats date in milliseconds to "yyyy-mm" or "mm/yyyy"
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

function formSubmitContractAccounts(el, data) {
    const elemId = el.id.split("-")[4];
    document.querySelector(`#client-contract-accounts-${elemId}`).value = JSON.stringify(data);
    document.querySelector(`#form-client-delete-bill-${elemId}`).submit();
}

function formSubmitBill(el, data) {
    const elemId = el.id.split("-")[2];
    document.querySelector(`#contract-account-${elemId}`).value = JSON.stringify(data);
    document.querySelector(`#contract-account-bill-${elemId}`).submit();
}
