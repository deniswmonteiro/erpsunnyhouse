$(document).ready(function () {
	// ATIVANDO A TABELA
	$('#table_id').DataTable({
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
        "lengthMenu": [[100, 125, 150 - 1], [100, 125, 150, "All"]],
        columnDefs: [{
            targets: 2,
            searchable: true,
            // visible: false
        }],
    });
});