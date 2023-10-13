window.onload = function () {
    $("div.alert")
        .delay(4000)
        .fadeOut(350);

    // Bootstrap Tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']"));
    tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl, {
        html: true
    }));

    // Bootstrap Popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll("[data-bs-toggle='popover']"));
    popoverTriggerList.map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {}));
}

window.SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
    spOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

window.isInvalidText = function (el, min) {
    let value = $(el).val();
    let response = false;
    if (value === null || value.length < min) {
        response = true;
        $(el).addClass('is-invalid');
    } else {
        $(el).removeClass('is-invalid');
    }
    return response;
};

window.isInvalidNumber = function (el, min) {
    let value = $(el).val();
    let response = false;

    try {
        value = parseFloat(value);
    } catch (e) {
        response = true;
        $(el).addClass('is-invalid');
        return response;
    }

    if (value <= min || isNaN(value)) {
        response = true;
        $(el).addClass('is-invalid');
    } else {
        $(el).removeClass('is-invalid');
    }
    return response;
}

window.isValidInput = function (id, min) {
    if ($(id).val() && $(id).val().length >= min) {
        $(id).removeClass("is-invalid");
        return true;
    }

    else {
        $(id).addClass("is-invalid");
        return false;
    }
}

window.isValidCEP = function (id) {
    if ($(id).val() && $(id).val().length === "00000-000".length) {
        $(id).removeClass("is-invalid");
        return true;
    }

    else {
        $(id).addClass("is-invalid");
        return false;
    }
}

window.convertHex = function (hexCode, opacity) {
    var hex = hexCode.replace('#', '');

    if (hex.length === 3) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }

    var r = parseInt(hex.substring(0, 2), 16),
        g = parseInt(hex.substring(2, 4), 16),
        b = parseInt(hex.substring(4, 6), 16);

    return 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
};