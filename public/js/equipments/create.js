window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(e){return new bootstrap.Popover(e,{})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,t,r,s){r.mask(SPMaskBehavior.apply({},arguments),s)}},window.isInvalidText=function(e,t){var r=$(e).val(),s=!1;return null===r||r.length<t?(s=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),s},window.isInvalidNumber=function(e,t){var r=$(e).val(),s=!1;try{r=parseFloat(r)}catch(t){return s=!0,$(e).addClass("is-invalid"),s}return r<=t||isNaN(r)?(s=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),s},window.isValidInput=function(e,t){return $(e).val()&&$(e).val().length>=t?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,t){var r=e.replace("#","");return 3===r.length&&(r=r[0]+r[0]+r[1]+r[1]+r[2]+r[2]),"rgba("+parseInt(r.substring(0,2),16)+","+parseInt(r.substring(2,4),16)+","+parseInt(r.substring(4,6),16)+","+t/100+")"},(()=>{function e(e){return function(e){if(Array.isArray(e))return t(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,r){if(e){if("string"==typeof e)return t(e,r);var s=Object.prototype.toString.call(e).slice(8,-1);return"Object"===s&&e.constructor&&(s=e.constructor.name),"Map"===s||"Set"===s?Array.from(e):"Arguments"===s||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(s)?t(e,r):void 0}}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function t(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,s=new Array(t);r<t;r++)s[r]=e[r];return s}function r(){return[document.querySelector("#create-equipment-type"),document.querySelector("#create-equipment-item"),document.querySelector("#create-equipment-module"),document.querySelector("#create-equipment-producer"),document.querySelector("#create-equipment-model"),document.querySelector("#create-equipment-generatorpower"),document.querySelector("#create-equipment-inverterpower"),document.querySelector("#create-equipment-mppt"),document.querySelector("#create-equipment-voltage"),document.querySelector("#create-equipment-technology"),document.querySelector("#create-equipment-guarantee"),document.querySelector("#create-equipment-datasheet")]}function s(t){e(t).forEach((function(e){var t=e.closest(".form-group").lastElementChild;e.value="",e.classList.remove("is-valid","is-invalid"),t.classList.remove("is-valid","is-invalid"),t.innerText=""}))}function o(e,t){t?(e.classList.add("is-valid"),e.classList.remove("is-invalid")):(e.classList.add("is-invalid"),e.classList.remove("is-valid"))}function n(e,t){t?(e.classList.add("valid-feedback"),e.classList.remove("invalid-feedback"),e.style.display="block"):(e.classList.add("invalid-feedback"),e.classList.remove("valid-feedback"),e.style.display="block")}$(document).ready((function(){$("#create-equipment-generatorpower").mask("#####9V##",{translation:{V:{pattern:/[\,]/},"#":{pattern:/[0-9]/,optional:!0}}}),$("#create-equipment-inverterpower").mask("#####9V##",{translation:{V:{pattern:/[\,]/},"#":{pattern:/[0-9]/,optional:!0}}}),$("#create-equipment-mppt").mask("#####9V##",{translation:{V:{pattern:/[\,]/},"#":{pattern:/[0-9]/,optional:!0}}}),$("#create-equipment-guarantee").mask("0#")})),window.changeEquipmentTypeToCreate=function(e){var t=e.selectedIndex,o=r();switch(s([o[1],o[2],o[3],o[4],o[5],o[6],o[7],o[8],o[9],o[10],o[11]]),t){case 0:window.validateSelect(e);break;case 1:o[1].closest(".row").classList.add("d-none"),o[1].removeAttribute("required"),o[2].closest(".row").classList.remove("d-none"),o[2].setAttribute("required",!0),o[3].closest(".row").classList.remove("d-none"),o[3].setAttribute("required",!0),o[4].closest(".row").classList.add("d-none"),o[4].removeAttribute("required"),o[5].closest(".row").classList.remove("d-none"),o[5].setAttribute("required",!0),o[6].closest(".row").classList.add("d-none"),o[6].removeAttribute("required"),o[7].closest(".row").classList.add("d-none"),o[7].removeAttribute("required"),o[8].closest(".row").classList.add("d-none"),o[8].removeAttribute("required"),o[9].closest(".row").classList.remove("d-none"),o[9].setAttribute("required",!0),o[10].closest(".row").classList.remove("d-none"),o[10].setAttribute("required",!0),o[11].closest(".row").classList.remove("d-none");break;case 2:o[1].closest(".row").classList.add("d-none"),o[1].removeAttribute("required"),o[2].closest(".row").classList.add("d-none"),o[2].removeAttribute("required"),o[3].closest(".row").classList.remove("d-none"),o[3].setAttribute("required",!0),o[4].closest(".row").classList.add("d-none"),o[4].removeAttribute("required"),o[5].closest(".row").classList.add("d-none"),o[5].removeAttribute("required"),o[6].closest(".row").classList.remove("d-none"),o[6].setAttribute("required",!0),o[7].closest(".row").classList.remove("d-none"),o[7].setAttribute("required",!0),o[8].closest(".row").classList.remove("d-none"),o[8].setAttribute("required",!0),o[9].closest(".row").classList.add("d-none"),o[9].removeAttribute("required"),o[10].closest(".row").classList.remove("d-none"),o[10].setAttribute("required",!0),o[11].closest(".row").classList.remove("d-none");break;case 3:o[1].closest(".row").classList.add("d-none"),o[1].removeAttribute("required"),o[2].closest(".row").classList.add("d-none"),o[2].removeAttribute("required"),o[3].closest(".row").classList.remove("d-none"),o[3].setAttribute("required",!0),o[4].closest(".row").classList.remove("d-none"),o[4].setAttribute("required",!0),o[5].closest(".row").classList.add("d-none"),o[5].removeAttribute("required"),o[6].closest(".row").classList.add("d-none"),o[6].removeAttribute("required"),o[7].closest(".row").classList.add("d-none"),o[7].removeAttribute("required"),o[8].closest(".row").classList.add("d-none"),o[8].removeAttribute("required"),o[9].closest(".row").classList.add("d-none"),o[9].removeAttribute("required"),o[10].closest(".row").classList.add("d-none"),o[10].removeAttribute("required"),o[11].closest(".row").classList.remove("d-none");break;default:o[1].closest(".row").classList.remove("d-none"),o[1].setAttribute("required",!0),o[2].closest(".row").classList.add("d-none"),o[2].removeAttribute("required"),o[3].closest(".row").classList.add("d-none"),o[3].removeAttribute("required"),o[4].closest(".row").classList.add("d-none"),o[4].removeAttribute("required"),o[5].closest(".row").classList.add("d-none"),o[5].removeAttribute("required"),o[6].closest(".row").classList.add("d-none"),o[6].removeAttribute("required"),o[7].closest(".row").classList.add("d-none"),o[7].removeAttribute("required"),o[8].closest(".row").classList.add("d-none"),o[8].removeAttribute("required"),o[9].closest(".row").classList.add("d-none"),o[9].removeAttribute("required"),o[10].closest(".row").classList.add("d-none"),o[10].removeAttribute("required"),o[11].closest(".row").classList.remove("d-none")}},window.clearFormCreateEquipment=function(){var e=r();s(e),e[1].closest(".row").classList.add("d-none"),e[2].closest(".row").classList.add("d-none"),e[3].closest(".row").classList.add("d-none"),e[4].closest(".row").classList.add("d-none"),e[5].closest(".row").classList.add("d-none"),e[6].closest(".row").classList.add("d-none"),e[7].closest(".row").classList.add("d-none"),e[8].closest(".row").classList.add("d-none"),e[9].closest(".row").classList.add("d-none"),e[10].closest(".row").classList.add("d-none"),e[11].closest(".row").classList.add("d-none")},window.validateInput=function(e,t){var r=e.closest(".form-group").lastElementChild;return null!==e.getAttribute("required")?0===e.value.length?(r.innerText="Preencha o campo.",o(e,!1),n(r,!1),!1):e.value.length<t?(r.innerText="Mínimo de ".concat(t,1===t?" caractere.":" caracteres."),o(e,!1),n(r,!1),!1):(r.innerText="Formato aceito.",o(e,!0),n(r,!0),!0):(r.innerText="Formato aceito.",o(e,!0),n(r,!0),!0)},window.validateSelect=function(e){var t=e.closest(".form-group").lastElementChild;return null!==e.getAttribute("required")&&0===e.selectedIndex?(t.innerText="Escolha uma opção.",o(e,!1),n(t,!1),!1):(t.innerText="Formato aceito.",o(e,!0),n(t,!0),!0)},window.validateFile=function(e){var t=e.closest(".form-group").lastElementChild;return void 0!==e.files[0]&&-1==["application/pdf"].indexOf(e.files[0].type)?(t.innerText="O arquivo ".concat(e.files[0].name," não é permitido."),o(e,!1),n(t,!1),!1):void 0!==e.files[0]&&e.files[0].size>10485760?(t.innerText="O arquivo ".concat(e.files[0].name," ultrapassou limite de 10 MB."),o(e,!1),n(t,!1),!1):(t.innerText="Formato aceito.",o(e,!0),n(t,!0),!0)},window.submitFormCreateEquipment=function(){var e=!0,t=document.querySelector("#form-create-equipment"),s=r();if(!!window.validateSelect(s[0])||(e=!1),!!window.validateInput(s[1],2)||(e=!1),!!window.validateInput(s[2],2)||(e=!1),!!window.validateInput(s[3],2)||(e=!1),!!window.validateInput(s[4],2)||(e=!1),!!window.validateInput(s[5],2)||(e=!1),!!window.validateInput(s[6],2)||(e=!1),!!window.validateInput(s[7],2)||(e=!1),!!window.validateSelect(s[8])||(e=!1),!!window.validateSelect(s[9])||(e=!1),!!window.validateInput(s[10],2)||(e=!1),!!window.validateFile(s[11])||(e=!1),null!==document.querySelector(".is-invalid")&&document.querySelector(".is-invalid").focus(),e){var o=document.querySelector("#btn-create-equipment"),n=document.querySelector("#btn-create-equipment-loading"),i=document.querySelector("#create-equipment-datasheet");o.setAttribute("disabled",!0),n.classList.remove("d-none"),0!==i.files.length&&(i.closest(".form-group").lastElementChild.innerHTML='<span class="fw-bold">Enviando:</span> '.concat(i.files[0].name,"...")),t.submit()}}})();