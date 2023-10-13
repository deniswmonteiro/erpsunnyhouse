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
});