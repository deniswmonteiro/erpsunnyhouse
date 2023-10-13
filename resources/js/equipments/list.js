$(document).ready(function () {
    $("#table_id").DataTable({
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
        }
    });
});

window.submit_form_equipment_edit = function () {
    let value = $('#edit-product-type').val();
    let submit = true;
    const datasheet = document.querySelector("#edit-product-datasheet");
    const feedbackDatasheet = document.querySelector("#edit-product-datasheet-feedback");

    let datasheetValidation = validateDatasheet(datasheet);
    submit = datasheetValidation ? true : false;

    switch (value) {
        case 'GENERATOR':
            if (window.isInvalidText('#edit-product-module', 2)) submit = false;
            if (window.isInvalidText('#edit-product-producer', 2)) submit = false;
            if (window.isInvalidNumber('#edit-product-power-generator', 1)) submit = false;
            if (!/(?:\,|[0-9])*/.test($("#edit-product-power-generator").val())) submit = false;
            if (window.isInvalidText('#edit-product-technology', 2)) submit = false;
            if (window.isInvalidNumber('#edit-product-guarantee', 1)) submit = false;
            break;

        case 'SOLAR_INVERTER':
            if (window.isInvalidText('#edit-product-producer', 2)) submit = false;
            if (window.isInvalidNumber('#edit-product-mppt', 0)) submit = false;
            // if (window.isInvalidNumber('#edit-product-power-inverter', 1)) submit = false;
            if (!/(?:\,|[0-9])*/.test($("#edit-product-power-inverter").val())) submit = false;
            if (window.isInvalidNumber('#edit-product-voltage', 1)) submit = false;
            if (window.isInvalidNumber('#edit-product-guarantee', 1)) submit = false;
            break;

        case 'STRING_BOX':
            if (window.isInvalidText('#edit-product-producer', 2)) submit = false;
            if (window.isInvalidText('#edit-product-model', 2)) submit = false;
            break;

        case 'CABLE':
            if (window.isInvalidText('#edit-product-item', 2)) submit = false;
            break;

        case 'CONNECTOR':
            if (window.isInvalidText('#edit-product-item', 2)) submit = false;
            break;

        case 'OTHER':
            if (window.isInvalidText('#edit-product-item', 2)) submit = false;
            break;

        default:
            submit = false;
            break;
    }

    if (submit) {
        $("#btn-edit-product").prop("disabled", true);
        $(feedbackDatasheet).css("display", "block");
        $(feedbackDatasheet).removeClass("invalid-feedback");
        $(feedbackDatasheet).addClass("valid-feedback");

        if (datasheet.files[0] !== undefined) {
            $(feedbackDatasheet).text("Enviando \"" + datasheet.files[0].name + "\"...");
        }
    }

    else $("#btn-edit-product").prop("disabled", false);

    return submit;
};

window.editEquipmente = function (el) {
    console.log(el)
    $('#edit-equipment-type').val(el.type);
    $('#edit-equipment-id').val(el.id);

    switch (el.type) {
        case 'GENERATOR':
            $('#edit-product-item').parent().addClass('d-none');
            $('#edit-product-module').parent().removeClass('d-none');
            $('#edit-product-module').val(el.module);
            $('#edit-product-producer').parent().removeClass('d-none');
            $('#edit-product-producer').val(el.producer);
            $('#edit-product-model').parent().addClass('d-none');
            $('#edit-product-mppt').parent().addClass('d-none');
            $('#edit-product-power-generator').parent().removeClass('d-none');
            $('#edit-product-power-generator').val(el.power);
            $('#edit-product-power-inverter').parent().addClass('d-none');
            $('#edit-product-voltage').parent().addClass('d-none');
            $('#edit-product-technology').parent().removeClass('d-none');
            $('#edit-product-technology').val(el.technology);
            $('#edit-product-guarantee').parent().removeClass('d-none');
            $('#edit-product-guarantee').val(el.guarantee);
            $('#edit-product-datasheet').parent().removeClass('d-none');
            break;

        case 'SOLAR_INVERTER':
            $('#edit-product-item').parent().addClass('d-none');
            $('#edit-product-module').parent().addClass('d-none');
            $('#edit-product-producer').parent().removeClass('d-none');
            $('#edit-product-producer').val(el.producer);
            $('#edit-product-model').parent().addClass('d-none');
            $('#edit-product-mppt').parent().removeClass('d-none');
            $('#edit-product-mppt').val(el.mppt);
            $('#edit-product-power-generator').parent().addClass('d-none');
            $('#edit-product-power-inverter').parent().removeClass('d-none');
            $('#edit-product-power-inverter').val(el.power);
            $('#edit-product-voltage').parent().removeClass('d-none');
            $('#edit-product-voltage').val(el.voltage);
            $('#edit-product-technology').parent().addClass('d-none');
            $('#edit-product-guarantee').parent().removeClass('d-none');
            $('#edit-product-guarantee').val(el.guarantee);
            $('#edit-product-datasheet').parent().removeClass('d-none');
            break;

        case 'STRING_BOX':
            $('#edit-product-item').parent().addClass('d-none');
            $('#edit-product-module').parent().addClass('d-none');
            $('#edit-product-producer').parent().removeClass('d-none');
            $('#edit-product-producer').val(el.producer);
            $('#edit-product-model').parent().removeClass('d-none');
            $('#edit-product-model').val(el.model);
            $('#edit-product-mppt').parent().addClass('d-none');
            $('#edit-product-power-inverter').parent().addClass('d-none');
            $('#edit-product-power-generator').parent().addClass('d-none');
            $('#edit-product-voltage').parent().addClass('d-none');
            $('#edit-product-technology').parent().addClass('d-none');
            $('#edit-product-guarantee').parent().addClass('d-none');
            $('#edit-product-guarantee').val('');
            $('#edit-product-datasheet').parent().removeClass('d-none');
            break;

        case 'CABLE':
            $('#edit-product-item').parent().removeClass('d-none');
            $('#edit-product-item').val(el.text);
            $('#edit-product-module').parent().addClass('d-none');
            $('#edit-product-producer').parent().addClass('d-none');
            $('#edit-product-model').parent().addClass('d-none');
            $('#edit-product-mppt').parent().addClass('d-none');
            $('#edit-product-power-inverter').parent().addClass('d-none');
            $('#edit-product-power-generator').parent().addClass('d-none');
            $('#edit-product-voltage').parent().addClass('d-none');
            $('#edit-product-technology').parent().addClass('d-none');
            $('#edit-product-guarantee').parent().addClass('d-none');
            $('#edit-product-datasheet').parent().removeClass('d-none');
            break;

        case 'CONNECTOR':
            $('#edit-product-item').parent().removeClass('d-none');
            $('#edit-product-item').val(el.text);
            $('#edit-product-module').parent().addClass('d-none');
            $('#edit-product-producer').parent().addClass('d-none');
            $('#edit-product-model').parent().addClass('d-none');
            $('#edit-product-mppt').parent().addClass('d-none');
            $('#edit-product-power-inverter').parent().addClass('d-none');
            $('#edit-product-power-generator').parent().addClass('d-none');
            $('#edit-product-voltage').parent().addClass('d-none');
            $('#edit-product-technology').parent().addClass('d-none');
            $('#edit-product-guarantee').parent().addClass('d-none');
            $('#edit-product-datasheet').parent().removeClass('d-none');
            break;

        default:
            $('#edit-product-item').parent().removeClass('d-none');
            $('#edit-product-item').val(el.text);
            $('#edit-product-module').parent().addClass('d-none');
            $('#edit-product-producer').parent().addClass('d-none');
            $('#edit-product-model').parent().addClass('d-none');
            $('#edit-product-mppt').parent().addClass('d-none');
            $('#edit-product-power-inverter').parent().addClass('d-none');
            $('#edit-product-power-generator').parent().addClass('d-none');
            $('#edit-product-voltage').parent().addClass('d-none');
            $('#edit-product-technology').parent().addClass('d-none');
            $('#edit-product-guarantee').parent().addClass('d-none');
            $('#edit-product-datasheet').parent().removeClass('d-none');
            break;
    }

    var modalEdit = new bootstrap.Modal(document.getElementById('modal-edit-equipment'));
    modalEdit.show()
};
