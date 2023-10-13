/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./resources/js/functions.js ***!
  \***********************************/
window.onload = function () {
  $("div.alert").delay(4000).fadeOut(350);
};

window.SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
}, spOptions = {
  onKeyPress: function onKeyPress(val, e, field, options) {
    field.mask(SPMaskBehavior.apply({}, arguments), options);
  }
};

window.isInvalidText = function (el, min) {
  var value = $(el).val();
  var response = false;

  if (value === null || value.length < min) {
    response = true;
    $(el).addClass('is-invalid');
  } else {
    $(el).removeClass('is-invalid');
  }

  return response;
};

window.isInvalidNumber = function (el, min) {
  var value = $(el).val();
  var response = false;

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
};

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
/******/ })()
;