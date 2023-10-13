$(document).ready(function () {
    eventsHandler();
});

function eventsHandler() {
    $("#check_sellers, #check_sellers_team").on('change', function () {
        $(".form-check-input").prop('checked', $(this).prop('checked'));
    });
}

window.submit_form_update_dashboard = function (table_id, form_id, field) {

    let names = [];
    $('#' + table_id + " > tbody > tr").has('input[type=checkbox]:checked').each(function (key, val) {
        let value = $(this).find("td:eq(1)").text();
        names.push(value);
    });

    if (names.length > 0) {
        $("<input type='hidden' value='" + names + "' />")
            .attr("name", field)
            .appendTo("#" + form_id);
        $('#' + form_id).submit();
    }
};

window.change_type_update_dashboard = function (table_id, form_id, field) {

    let isChecked = $('#flexSwitchCheck').is(':checked');

    let names = [];

    $('#' + table_id + " > tbody > tr").has('input[type=checkbox]:checked').each(function (key, val) {

        let value = $(this).find("td:eq(1)").text();
        names.push(value);

    });

    if (names.length > 0) {
        $("<input type='hidden' value='" + names + "' />")
            .attr("name", field)
            .appendTo("#" + form_id);
        if (isChecked) {
            $("<input type='hidden' value='" + true + "' />")
                .attr("name", 'type')
                .appendTo("#" + form_id);
        }
        $('#' + form_id).submit();
    }

};
