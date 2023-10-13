window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,a,i,t){i.mask(SPMaskBehavior.apply({},arguments),t)}},window.isInvalidText=function(e,a){var i=$(e).val(),t=!1;return null===i||i.length<a?(t=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),t},window.isInvalidNumber=function(e,a){var i=$(e).val(),t=!1;try{i=parseFloat(i)}catch(a){return t=!0,$(e).addClass("is-invalid"),t}return i<=a||isNaN(i)?(t=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),t},window.isValidInput=function(e,a){return $(e).val()&&$(e).val().length>=a?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,a){var i=e.replace("#","");return 3===i.length&&(i=i[0]+i[0]+i[1]+i[1]+i[2]+i[2]),"rgba("+parseInt(i.substring(0,2),16)+","+parseInt(i.substring(2,4),16)+","+parseInt(i.substring(4,6),16)+","+a/100+")"},(()=>{function e(e,a){var i=document.querySelector(e),t=i.nextElementSibling;if(value=parseInt(i.value.split(".").join("").split(",").join("")),0!==i.value.length)return value<a||isNaN(value)?(i.classList.add("is-invalid"),i.classList.remove("is-valid"),t.innerText="Minimo de R$ 1.",!1):(i.classList.add("is-valid"),i.classList.remove("is-invalid"),!0);i.classList.add("is-invalid"),i.classList.remove("is-valid"),t.innerText="Preencha o campo."}function a(e,a){var i=document.querySelector(e),t=i.nextElementSibling;if(0!==i.value.length)return i.value&&i.value.trim().length<a?(i.classList.add("is-invalid"),i.classList.remove("is-valid"),t.innerText="Mínimo de ".concat(a," caracteres."),!1):(i.classList.add("is-valid"),i.classList.remove("is-invalid"),!0);i.classList.add("is-invalid"),i.classList.remove("is-valid"),t.innerText="Preencha o campo."}function i(){$(".is-invalid").first().focus()}function t(e,a){a?(e.classList.add("is-valid"),e.classList.remove("is-invalid")):(e.classList.add("is-invalid"),e.classList.remove("is-valid"))}function n(e,a){a?(e.classList.add("valid-feedback"),e.classList.remove("invalid-feedback"),e.style.display="block"):(e.classList.add("invalid-feedback"),e.classList.remove("valid-feedback"),e.style.display="block")}$(document).ready((function(){window.adjustLabelPayment(),$("#contract-signature-cpf").mask("000.000.000-00",{reverse:!0}),$(".money").mask("#.##0,00",{reverse:!0}),$("#receipt-description").val("")})),window.validateContractSignatureName=function(e){var a=document.querySelector("#signature-name-feedback-contract");return 0===e.selectedIndex?(a.innerText="Escolha uma opção.",t(e,!1),n(a,!1),!1):(a.innerText="Formato aceito.",t(e,!0),n(a,!0),!0)},window.validateReceiptAmount=function(a){a.value&&a.value.length<3&&(a.value+=",00"),e("#".concat(a.id),1)},window.validateReceiptDescription=function(e){a("#".concat(e.id),10)},window.adjustLabelPayment=function(){var e=0,a=0,i=0;switch($("#payment_type").val()){case"À VISTA":case"PERSONALIZADO":a=$("#payment_cash").val(),e=parseFloat(a.split(".").join("").split(",").join("."));break;case"FINANCIAMENTO PARCIAL":case"PARCELAMENTO EMPRESA":a=$("#payment_cash").val(),e=(a=parseFloat(a.split(".").join("").split(",").join(".")))+0*i;break;case"FINANCIAMENTO TOTAL":a=$("#payment_cash").val(),a=parseFloat(a.split(".").join("").split(",").join(".")),i=$("#payment_quantity").val(),e=0*(i=parseFloat(i.split(".").join("").split(",").join(".")))}e>0?(e=e.toLocaleString("pt-br",{style:"currency",currency:"BRL"}),$("#label_payment").html("Forma de Pagamento<br><small>(valor: R$ "+e+")</small>")):$("#label_payment").html("Forma de Pagamento")},window.formGenerateContractSubmit=function(e){var a=!0;window.validateContractSignatureName(document.querySelector("#contract-signature-name"))||(a=!1),i(),a&&document.querySelector(e).submit()},window.formGenerateReceiptPaymentSubmit=function(t){var n=!0;e("#receipt-amount",1)||(n=!1),a("#receipt-description",10)||(n=!1),i(),n&&document.querySelector(t).submit()}})();