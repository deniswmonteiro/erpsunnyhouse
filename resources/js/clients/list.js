$(document).ready(function () {
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
    });

    $('[data-toggle="tooltip"]').each(function () {
        $(this).tooltip({
            trigger: 'hover',
            'placement': 'top'
        })
    });
});

window.getClientContractAccounts = function (el, login, password) {
    const elemId = el.id.split("-")[4];
    const loadingContractAccounts = document.querySelector(`#loading-contract-accounts-${elemId}`);
    const btnText = document.querySelector(`#btn-text-${elemId}`);
    const url = "http://equatorial.sunnyhouse.com.br/listAccountContracts";
    let data = {
        user: login,
        password: password
    }

    el.setAttribute("disabled", true);
    el.classList.remove("btn-sm");
    el.style.width = "113.156px";
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
            el.classList.add("btn-sm");
            loadingContractAccounts.classList.add("d-none");
            btnText.classList.remove("d-none");
            formSubmit(el, resp.data);
        },
        error: function (resp) {
            const pageTitle = document.querySelector(".page-title");

            el.removeAttribute("disabled");
            el.classList.add("btn-sm");
            loadingContractAccounts.classList.add("d-none");
            btnText.classList.remove("d-none");

            if (resp.status === 500) {
                pageTitle.insertAdjacentHTML("afterend", `
                    <div class="alert alert-danger alert-dismissible show fade">
                        <strong>Credenciais do cliente inválidas.</strong>
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

function formSubmit(el, data) {
    const elemId = el.id.split("-")[4];
    document.querySelector(`#client-contract-accounts-${elemId}`).value = JSON.stringify(data);
    document.querySelector(`#form-client-contract-accounts-${elemId}`).submit();
}
