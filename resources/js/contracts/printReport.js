window.onload = function () {
    $("#report-table").DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
        },

        "lengthMenu": [
            [14], [14]
        ],

        "ordering": false,
        "searching": false,
        "lengthChange": false,
        "paging": false,
        "info": false
    });
}