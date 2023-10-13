/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./resources/js/functions.js ***!
  \***********************************/
var SPMaskBehavior = function SPMaskBehavior(val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
    spOptions = {
  onKeyPress: function onKeyPress(val, e, field, options) {
    field.mask(SPMaskBehavior.apply({}, arguments), options);
  }
};
/******/ })()
;