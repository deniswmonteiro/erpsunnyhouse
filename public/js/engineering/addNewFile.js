/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/engineering/addNewFile.js":
/*!************************************************!*\
  !*** ./resources/js/engineering/addNewFile.js ***!
  \************************************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: /Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/resources/js/engineering/addNewFile.js: 'Const declarations' require an initialization value. (4:14)\n\n\u001b[0m \u001b[90m 2 |\u001b[39m     el\u001b[33m.\u001b[39msetAttribute(\u001b[32m\"disabled\"\u001b[39m\u001b[33m,\u001b[39m \u001b[36mtrue\u001b[39m)\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 3 |\u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 4 |\u001b[39m     \u001b[36mconst\u001b[39m form\u001b[0m\n\u001b[0m \u001b[90m   |\u001b[39m               \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 5 |\u001b[39m }\u001b[0m\n    at Parser._raise (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:541:17)\n    at Parser.raiseWithData (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:534:17)\n    at Parser.raise (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:495:17)\n    at Parser.parseVar (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:13813:18)\n    at Parser.parseVarStatement (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:13623:10)\n    at Parser.parseStatementContent (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:13208:21)\n    at Parser.parseStatement (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:13139:17)\n    at Parser.parseBlockOrModuleBlockBody (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:13728:25)\n    at Parser.parseBlockBody (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:13719:10)\n    at Parser.parseBlock (/Applications/XAMPP/xamppfiles/htdocs/erpsunyhouse/node_modules/@babel/parser/lib/index.js:13703:10)");

/***/ }),

/***/ "./resources/js/functions.js":
/*!***********************************!*\
  !*** ./resources/js/functions.js ***!
  \***********************************/
/***/ (() => {

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

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	__webpack_modules__["./resources/js/functions.js"]();
/******/ 	// This entry module doesn't tell about it's top-level declarations so it can't be inlined
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/engineering/addNewFile.js"]();
/******/ 	
/******/ })()
;