window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(a){return new bootstrap.Tooltip(a,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(a){return new bootstrap.Popover(a,{})}))},window.SPMaskBehavior=function(a){return 11===a.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(a,i,n,e){n.mask(SPMaskBehavior.apply({},arguments),e)}},window.isInvalidText=function(a,i){var n=$(a).val(),e=!1;return null===n||n.length<i?(e=!0,$(a).addClass("is-invalid")):$(a).removeClass("is-invalid"),e},window.isInvalidNumber=function(a,i){var n=$(a).val(),e=!1;try{n=parseFloat(n)}catch(i){return e=!0,$(a).addClass("is-invalid"),e}return n<=i||isNaN(n)?(e=!0,$(a).addClass("is-invalid")):$(a).removeClass("is-invalid"),e},window.isValidInput=function(a,i){return $(a).val()&&$(a).val().length>=i?($(a).removeClass("is-invalid"),!0):($(a).addClass("is-invalid"),!1)},window.isValidCEP=function(a){return $(a).val()&&$(a).val().length==="00000-000".length?($(a).removeClass("is-invalid"),!0):($(a).addClass("is-invalid"),!1)},window.convertHex=function(a,i){var n=a.replace("#","");return 3===n.length&&(n=n[0]+n[0]+n[1]+n[1]+n[2]+n[2]),"rgba("+parseInt(n.substring(0,2),16)+","+parseInt(n.substring(2,4),16)+","+parseInt(n.substring(4,6),16)+","+i/100+")"},(()=>{function a(a,i){return $(a).val()&&$(a).val().length>=i?($(a).removeClass("is-invalid"),!0):($(a).addClass("is-invalid"),!1)}function i(a,i){var n=parseInt($(a).val());return void 0===n||isNaN(n)||n<=i?($(a).addClass("is-invalid"),!1):($(a).removeClass("is-invalid"),!0)}$(document).ready((function(){$("#new_client").hide(),$("#documento").mask("##################0"),$("#producaoMeta").mask("###0,00",{reverse:!0}),$("#diaLeitura").mask("#0"),$("#ciclo").mask("#0"),$(".money").mask("#.##0,00",{reverse:!0})})),window.submit_form_contract_create=function(){$("#login").val(),url_ajax_usinas_validate_login_senha,function(){var n,e,s,l=!0;a("#nome",3)||(l=!1),a("#apelido",3)||(l=!1),a("#documento",3)||(l=!1),a("#login",3)||(l=!1),a("#senha",3)||(l=!1),a("#producaoMeta",3)||(l=!1),i("#diaLeitura",0)||(l=!1),i("#ciclo",0)||(l=!1),n="#investimento",e=1,s=$(n).val(),((s=parseInt(s.split(".").join("").split(",").join("")))<=e||isNaN(s)?($(n).addClass("is-invalid"),0):($(n).removeClass("is-invalid"),1))||(l=!1),$(".is-invalid").first().focus(),l&&$("#form-update-usina").submit()}()}})();