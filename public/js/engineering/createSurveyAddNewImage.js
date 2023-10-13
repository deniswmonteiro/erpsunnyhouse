/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
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

window.isValidInput = function (id, min) {
  if ($(id).val() && $(id).val().length >= min) {
    $(id).removeClass("is-invalid");
    return true;
  } else {
    $(id).addClass("is-invalid");
    return false;
  }
};

window.isValidCEP = function (id) {
  if ($(id).val() && $(id).val().length === "00000-000".length) {
    $(id).removeClass("is-invalid");
    return true;
  } else {
    $(id).addClass("is-invalid");
    return false;
  }
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
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************************************!*\
  !*** ./resources/js/engineering/createSurveyAddNewImage.js ***!
  \*************************************************************/
window.createSurveyAddImage = function (el) {
  // el.setAttribute("disabled", true);
  var elemId = el.id.split("-")[4];
  var cardCreateSurvey = document.querySelector("#generator-create-survey-".concat(elemId));
  var totalImages = document.querySelectorAll("#".concat(cardCreateSurvey.id, " input[id^=\"create-generator-survey-image-").concat(elemId, "\"]"));
  var indexToInsertNewFile = totalImages.length + 1;
  cardCreateSurvey.insertAdjacentHTML("beforeend", "\n            <div class=\"row\" id=\"create-survey-image-".concat(elemId, "-").concat(indexToInsertNewFile, "\">\n                <!-- Image Name -->\n                <div class=\"col-12 col-md-6 mb-3\">\n                    <div class=\"form-group\">\n                        <label for=\"create-generator-survey-name-").concat(elemId, "-").concat(indexToInsertNewFile, "\" \n                            class=\"form-label\">\n                            Nome da Imagem\n                        </label>\n                        <input class=\"form-control\" type=\"text\"\n                            id=\"create-generator-survey-name-").concat(elemId, "-").concat(indexToInsertNewFile, "\"\n                            name=\"generator-survey-name[new-").concat(indexToInsertNewFile, "][name]\"\n                            onchange=\"return window.validateSurveyName(this), window.handleBtnAddSurveyImage(this)\"\n                            onblur=\"return window.validateSurveyName(this), window.handleBtnAddSurveyImage(this)\"\n                            onkeyup=\"return window.validateSurveyName(this), window.handleBtnAddSurveyImage(this)\">\n                        <div class=\"invalid-feedback\" \n                            id=\"create-survey-name-feedback-").concat(elemId, "-").concat(indexToInsertNewFile, "\"></div>\n                    </div>\n                </div>\n\n                <!-- Survey Image -->\n                <div class=\"col-12 col-md-6 mb-3\">\n                    <div class=\"form-group\">\n                        <label for=\"create-generator-survey-image-").concat(elemId, "-").concat(indexToInsertNewFile, "\" \n                            class=\"form-label\">\n                            Imagem da Vistoria\n                        </label>\n                        <div class=\"input-group\">\n                            <input class=\"form-control\" type=\"file\"\n                                id=\"create-generator-survey-image-").concat(elemId, "-").concat(indexToInsertNewFile, "\"\n                                name=\"generator-survey-image[new-").concat(indexToInsertNewFile, "][file]\"\n                                onchange=\"return window.validateCreateImage(this), window.handleBtnAddSurveyImage(this)\"\n                                onblur=\"return window.validateCreateImage(this), window.handleBtnAddSurveyImage(this)\">\n                            <button type=\"button\"\n                                class=\"input-group-text btn bg-danger btn-lg text-white rounded ms-4\" \n                                id=\"create-btn-cancel-add-image-").concat(elemId, "-").concat(indexToInsertNewFile, "\"\n                                onclick=\"return window.removeSurveyImageRow(this)\">\n                                <i class=\"bi bi-x-circle-fill\"></i>\n                            </button>\n                        </div>\n                        <div class=\"invalid-feedback\" \n                            id=\"create-survey-image-feedback-").concat(elemId, "-").concat(indexToInsertNewFile, "\"></div>\n                    </div>\n                </div>\n            </div>\n        "));
};
})();

/******/ })()
;