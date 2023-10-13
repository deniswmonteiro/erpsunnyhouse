/** INIT */
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

    $("#contract-table").DataTable({
        "bAutoWidth": false,

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

        "lengthMenu": [
            [100, 125, 150 - 1],
            [100, 125, 150, "All"]
        ],

        columnDefs: [{
            targets: 2,
            searchable: true,
            visible: false
        }],

        rowGroup: {
            endRender: function (rows, group) {
                const sumNotStatusBadge = rows
                    .data()
                    .filter(el => !el[3].match(/ORÇANDO/))
                    .pluck(5)
                    .reduce((a, b) => a + parseFloat(b.replace(/[^\d]/g, "")) / 100, 0);

                const sum = rows
                    .data()
                    .pluck(5)
                    .reduce((a, b) => a + parseFloat(b.replace(/[^\d]/g, "")) / 100, 0);

                return `Total em ${group}: 
                    <span class='text-primary'>
                    ${(sum.toLocaleString("pt-BR", {
                    minimumFractionDigits: 2,
                    style: "currency",
                    currency: "BRL"
                }))}</span> | Total ativo: 
                    <span class='text-primary fw-bold'>
                    ${(sumNotStatusBadge.toLocaleString("pt-BR", {
                    minimumFractionDigits: 2,
                    style: "currency",
                    currency: "BRL"
                }))}</span>`;
            },

            dataSrc: function (row) {
                const date = row[4].split("/");
                const month = monthMap.get(parseInt(date[1]));
                const year = date[2];

                return `<strong>${month} de ${year}</strong>`;
            }
        },
    });
});