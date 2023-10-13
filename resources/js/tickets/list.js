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

    $("table[id^='table-tickets']").DataTable({
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
            targets: 3,
            searchable: true,
            visible: false
        }],
        rowGroup: {
            dataSrc: function (row) {
                const date = row[7].split("/");
                const month = monthMap.get(parseInt(date[1]));
                const year = date[2];

                return `<strong>${month} de ${year}</strong>`;
            }
        }
    });

    /** Select tickets to be shown */
    const ticketListSelection = document.querySelector("#ticket-list-selection");

    if (window.matchMedia("(max-width: 991px)").matches) {
        ticketListSelection.firstElementChild.classList.remove("btn-group");
        ticketListSelection.firstElementChild.classList.add("btn-group-vertical");
    }

    else {
        ticketListSelection.firstElementChild.classList.add("btn-group");
        ticketListSelection.firstElementChild.classList.remove("btn-group-vertical");
    }
});

/** Select tickets table to be shown */
window.showTicketsTable = function (el) {
    const type = el.id.split("-")[3];
    const selectedTableTicket = document.querySelector(`#ticket-selection-${type}`);
    const tablesTicket = document.querySelectorAll("div[id^='ticket-selection']");

    [...tablesTicket].forEach(table => {
        table.classList.remove("d-block");
        table.classList.add("d-none");
    });

    selectedTableTicket.classList.remove("d-none");
    selectedTableTicket.classList.add("d-block");
}