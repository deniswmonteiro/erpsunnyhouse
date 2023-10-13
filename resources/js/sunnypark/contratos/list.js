$(document).ready(function () {

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

        /*rowGroup: {
            dataSrc: function (row) {
                let date = row[5].split("/");
                let month = monthMap.get(parseInt(date[1]));
                let year = date[2];

                return "<strong>" + month + " de " + year + "</strong>";
            }
        },*/
    });
});

window.validateContractSignatureName = function (el) {
    const findKey = el.classList[1].split("_");
    const key = findKey[findKey.length - 1];
    const signatureNameFeedback = document.querySelector(".signature-name-feedback-contract_"+key);

    if (el.selectedIndex === 0) {
        signatureNameFeedback.innerText = "Escolha uma opção.";
        validate(el, false);
        validateFeedback(signatureNameFeedback, false);
        return false;
    }

    else {
        signatureNameFeedback.innerText = "Formato aceito.";
        validate(el, true);
        validateFeedback(signatureNameFeedback, true);
        return true;
    }
}

function errorFocus() {
    $('.is-invalid').first().focus();
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

window.formGenerateContractSubmit = function (el) {
    let submit = true;
    const findKey = el.split("_");
    const key = findKey[findKey.length - 1];

    if (!window.validateContractSignatureName(document.querySelector(".contract-signature-name_"+key))) submit = false;

    errorFocus();

    if (submit) document.querySelector(el).submit();
}