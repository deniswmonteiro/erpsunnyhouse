window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(e){return new bootstrap.Popover(e,{})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,n,i,t){i.mask(SPMaskBehavior.apply({},arguments),t)}},window.isInvalidText=function(e,n){var i=$(e).val(),t=!1;return null===i||i.length<n?(t=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),t},window.isInvalidNumber=function(e,n){var i=$(e).val(),t=!1;try{i=parseFloat(i)}catch(n){return t=!0,$(e).addClass("is-invalid"),t}return i<=n||isNaN(i)?(t=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),t},window.isValidInput=function(e,n){return $(e).val()&&$(e).val().length>=n?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,n){var i=e.replace("#","");return 3===i.length&&(i=i[0]+i[0]+i[1]+i[1]+i[2]+i[2]),"rgba("+parseInt(i.substring(0,2),16)+","+parseInt(i.substring(2,4),16)+","+parseInt(i.substring(4,6),16)+","+n/100+")"},(()=>{function e(e,n){n?(e.classList.add("is-valid"),e.classList.remove("is-invalid")):(e.classList.add("is-invalid"),e.classList.remove("is-valid"))}function n(e,n){n?(e.classList.add("valid-feedback"),e.classList.remove("invalid-feedback"),e.style.display="block"):(e.classList.add("invalid-feedback"),e.classList.remove("valid-feedback"),e.style.display="block")}function i(e,n){var i,t=!1;function a(e){if(!e)return!1;!function(e){for(var n=0;n<e.length;n++)e[n].classList.remove("autocomplete-active")}(e),i>=e.length&&(i=0),i<0&&(i=e.length-1),e[i].classList.add("autocomplete-active")}function l(n){for(var i=document.getElementsByClassName("autocomplete-items"),t=0;t<i.length;t++)n!=i[t]&&n!=e&&i[t].parentNode.removeChild(i[t])}$("#"+e.id).on("input",(function(a){t=!1;var c,s,o,d=this.value;if(l(),!d)return $("#new_"+e.id).show(),$("#"+e.id).addClass("is-invalid"),!1;$("#new_"+e.id).hide(),i=-1,(c=document.createElement("DIV")).setAttribute("id","autocomplete-list-"+e.id),c.setAttribute("class","autocomplete-items "),c.setAttribute("style","margin-left: 25px; width:"+$("#"+e.id).parent().width()+"px"),this.parentNode.appendChild(c);var r=0;for(o=0;o<n.length;o++)if(n[o].toLowerCase().includes(d.toLowerCase())&&r<10){t=!0,r++,s=document.createElement("DIV");var v=n[o],u=new RegExp("("+d+")","gi");s.innerHTML=v.replace(u,"<strong>$1</strong>"),s.innerHTML+="<input type='hidden' value='"+n[o]+"'>",s.addEventListener("click",(function(i){e.value=this.getElementsByTagName("input")[0].value,n.indexOf(e.value)>=0?$("#"+e.id).removeClass("is-invalid"):$("#"+e.id).addClass("is-invalid"),l()})),c.appendChild(s)}n.indexOf(this.value)>=0?$("#"+e.id).removeClass("is-invalid"):(t&&$("#"+e.id).val()?$("#new_"+e.id).hide():$("#new_"+e.id).show(),$("#"+e.id).addClass("is-invalid"))})),e.addEventListener("keydown",(function(n){var t=document.getElementById("autocomplete-list-"+e.id);t&&(t=t.getElementsByTagName("div")),i=void 0===i?-1:i,40==n.keyCode?(i++,a(t)):38==n.keyCode?(i--,a(t)):13==n.keyCode&&(n.preventDefault(),i>-1&&t&&t[i].click())})),document.addEventListener("click",(function(e){l(e.target)}))}function t(e,n){return $(e).val()&&$(e).val().length>=n?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)}function a(e,n){var i=parseInt($(e).val());return void 0===i||isNaN(i)||i<=n?($(e).addClass("is-invalid"),!1):($(e).removeClass("is-invalid"),!0)}function l(e,n){var i=$(e).val();return(i=parseInt(i.split(".").join("").split(",").join("")))<=n||isNaN(i)?($(e).addClass("is-invalid"),!1):($(e).removeClass("is-invalid"),!0)}function c(){$(".is-invalid").first().focus()}$(document).ready((function(){var e;i(document.getElementById("client"),clients),e=function(e,n){var i=1==(e=new Date(parseInt(e))).getDate().toString().length?"0"+e.getDate().toString():e.getDate().toString(),t=parseInt(e.getMonth())+1;t=1==t.toString().length?"0"+t.toString():t.toString();var a=e.getFullYear();return e="en-us"===n?"".concat(a,"-").concat(t,"-").concat(i):"".concat(i,"/").concat(t,"/").concat(a)}(Date.now(),"en-us"),$("#new_client").hide(),$("#client-password").attr("max",e),$("#client-phone").mask(window.SPMaskBehavior,spOptions),$("#client-cep").mask("00000-000"),$("#client-cpf").mask("000.000.000-00",{reverse:!0}),$("#client-cnpj").mask("00.000.000/0000-00",{reverse:!0}),$("#client-login").mask("000.000.000-00",{reverse:!0}),$("#contract-vigencia").mask("#0"),$("#quantidade").mask("###0,00",{reverse:!0}),$("#potencia").mask("###0,00",{reverse:!0}),$(".money").mask("#.##0,00",{reverse:!0}),$("#desconto").mask("#0"),$("#tarifa_base").mask("###0,00",{reverse:!0}),$("#meta_gestao").mask("###0,00",{reverse:!0}),$("#client-name").on("change paste keyup input focus",(function(e){$("#client-name").val().length<5?($("#name-feedback-client").text("Nome Inválido - Mínimo 5 Caracteres."),$("#client-name").addClass("is-invalid")):$("#client-name").removeClass("is-invalid")})),$("#client-email").on("change paste keyup input focus",(function(e){var n=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;$("#client-email").val().match(n)?$("#client-email").removeClass("is-invalid"):($("#client-email").addClass("is-invalid"),$("#client-email-feedback").text("E-Mail Inválido - Formato incorreto."))})),$("#client-phone").on("change paste keyup input create focus",(function(e){this.value.length==="(00) 00000-0000".length||this.value.length==="(00) 0000-0000".length?$("#client-phone").removeClass("is-invalid"):$("#client-phone").addClass("is-invalid")})),$("#client-cep").on("change paste keyup input create focus",(function(e){this.value.length==="00000-000".length&&$.ajax({url:"https://viacep.com.br/ws/"+$(this).val().replace("-","")+"/json/unicode/",dataType:"json",success:function(e){void 0===e.erro&&($("#client-address").val(e.logradouro),$("#client-state").val(e.uf),$("#client-city").val(e.localidade),$("#client-neighborhood").val(e.bairro),t("#client-address",2),t("#client-state",2),t("#client-city",2),t("#client-neighborhood",2))}})})),$("#client-cpf").on("change paste keyup input create focus",(function(e){$("#client-cpf").val().length==="000.000.000-00".length?$("#client-cpf").removeClass("is-invalid"):($("#client-cpf").addClass("is-invalid"),$("#client-cpf-feedback").text("CPF Inválido - Formato incorreto."))})),$("#client-cnpj").on("change paste keyup input create focus",(function(e){this.value.length==="00.000.000/0000-00".length?$("#client-cnpj").removeClass("is-invalid"):$("#client-cnpj").addClass("is-invalid")})),$("#client-checkbox-type").on("change",(function(){var e=$("#client-checkbox-type").is(":checked"),n=document.querySelector("#client-login"),i=document.querySelector("#client-password");e?($("#client-cnpj").closest(".form-group").removeClass("d-none"),$("#client-corporate-name").closest(".form-group").removeClass("d-none"),$("#login").mask("00.000.000/0000-00",{reverse:!0}),i.setAttribute("type","text"),i.classList.remove("date"),window.validateLogin(n)):($("#client-cnpj").closest(".form-group").addClass("d-none"),$("#client-corporate-name").closest(".form-group").addClass("d-none"),$("#login").mask("000.000.000-00",{reverse:!0}),i.setAttribute("type","date"),i.classList.add("date"),window.validateLogin(n),window.validatePassword(i))})),$("#modal_new_client").on("hidden.bs.modal",(function(e){$("#client-name").val(""),$("#client-name").removeClass("is-invalid"),$("#client-phone").val(""),$("#client-phone").removeClass("is-invalid"),$("#client-address").val(""),$("#client-address").removeClass("is-invalid"),$("#client-cep").val(""),$("#client-cep").removeClass("is-invalid"),$("#client-number").val(""),$("#client-number").removeClass("is-invalid"),$("#client-email").val(""),$("#client-email").removeClass("is-invalid"),$("#client-complement").val(""),$("#client-complement").removeClass("is-invalid"),$("#client-cpf").removeClass("is-invalid"),$("#client-cpf").val(""),$("#client-cnpj").removeClass("is-invalid"),$("#client-cnpj").val(""),$("#client-corporate-name").removeClass("is-invalid"),$("#client-corporate-name").val("")})),$("#btn-create-client").on("click",(function(){!function(e,n){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},url:n,type:"GET",dataType:"json",data:e,success:function(e){!function(e){e.saved?(i(document.getElementById("client"),e.items),e.hasOwnProperty("corporateName")?$("#client").val(e.corporateName):$("#client").val(e.name),$("#client").removeClass("is-invalid"),$("#modal_new_client").modal("hide")):(e.corporate_name_invalid&&($("#client-corporate-name").focus(),$("#client-corporate-name").addClass("is-invalid")),e.cnpj_invalid&&($("#client-cnpj").focus(),$("#client-cnpj").addClass("is-invalid")),e.name_invalid&&($("#client-name").focus(),$("#client-name").addClass("is-invalid")),e.cpf_invalid&&($("#client-cpf").focus(),$("#client-cpf").addClass("is-invalid")),e.email_invalid&&($("#client-email").focus(),$("#client-email").addClass("is-invalid")),e.invalid_email&&($("#client-email").focus(),$("#client-email").addClass("is-invalid")),e.invalid_phone&&($("#client-phone").focus(),$("#client-phone").addClass("is-invalid")),e.cep_invalid&&($("#client-cep").focus(),$("#client-cep").addClass("is-invalid")),e.address_invalid&&($("#client-corporate-name").focus(),$("#client-address").addClass("is-invalid")),e.number_invalid&&($("#client-number").focus(),$("#client-number").addClass("is-invalid")),e.state_invalid&&($("#client-state").focus(),$("#client-state").addClass("is-invalid")),e.city_invalid&&($("#client-city").focus(),$("#client-city").addClass("is-invalid")),e.neighborhood_invalid&&($("#client-neighborhood").focus(),$("#client-neighborhood").addClass("is-invalid")),e.login_invalid&&($("#client-login").focus(),$("#client-login").addClass("is-invalid")),e.password_invalid&&($("#client-password").focus(),$("#client-password").addClass("is-invalid")))}(e)},error:function(e){}})}({"client-name":$("#client-name").val(),"client-cpf":$("#client-cpf").val(),"checkbox-is-pj":$("#client-checkbox-type").is(":checked")?"on":"off","client-cnpj":$("#client-cnpj").val(),"client-corporate-name":$("#client-corporate-name").val(),"client-email":$("#client-email").val(),"client-phone":$("#client-phone").val(),"client-cep":$("#client-cep").val(),"client-address":$("#client-address").val(),"client-number":$("#client-number").val(),"client-state":$("#client-state").val(),"client-city":$("#client-city").val(),"client-neighborhood":$("#client-neighborhood").val(),"client-complement":$("#client-complement").val(),"checkbox-add-credentials":$("#chk-add-credentials").is(":checked")?"on":"off","client-login":$("#client-login").val(),"client-password":$("#client-password").val()},url_ajax_store_client)})),$("#client-cep").on("input change paste keyup focus",(function(){var e;e="#"+this.id,$(e).val()&&$(e).val().length==="00000-000".length?$(e).removeClass("is-invalid"):$(e).addClass("is-invalid")})),$("#client-address, #client-state, #client-city, #client-neighborhood").on("change paste keyup input create focus",(function(){t("#"+this.id,2)})),$("#client-number").on("change paste keyup input create focus",(function(){t("#"+this.id,1)}))})),window.checkIfAddCredentials=function(e){var n=document.querySelector("#credentials");e.checked?n.classList.remove("d-none"):n.classList.add("d-none")},window.validateLogin=function(i){var t=document.querySelector("#login-feedback-create-client");return document.querySelector("#client-checkbox-type").checked?0===i.value.length?(t.innerText="Preencha o campo.",e(i,!1),n(t,!1),!1):i.value.length<14?(t.innerText="Mínimo de 14 dígitos.",e(i,!1),n(t,!1),!1):(t.innerText="Formato aceito.",e(i,!0),n(t,!0),!0):0===i.value.length?(t.innerText="Preencha o campo.",e(i,!1),n(t,!1),!1):i.value.length<14?(t.innerText="Mínimo de 11 dígitos.",e(i,!1),n(t,!1),!1):(t.innerText="Formato aceito.",e(i,!0),n(t,!0),!0)},window.validatePassword=function(i){var t=document.querySelector("#password-feedback-create-client");return document.querySelector("#client-checkbox-type").checked?(i.removeAttribute("maxlength"),0===i.value.length?(t.innerText="Preencha o campo.",e(i,!1),n(t,!1),!1):i.value.length<5?(t.innerText="Mínimo de 5 dígitos.",e(i,!1),n(t,!1),!1):/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/.test(i.value)?(t.innerText="Formato aceito.",e(i,!0),n(t,!0),!0):(t.innerText="Digite um email válido.",e(i,!1),n(t,!1),!1)):(i.setAttribute("maxlength","10"),0===i.value.length?(t.innerText="Preencha o campo.",e(i,!1),n(t,!1),!1):i.value.split("-").length<3?(t.innerText="Digite uma data válida.",e(i,!1),n(t,!1),!1):i.value.split("-")[0]<1900?(t.innerText="Digite um ano de nascimento válido.",e(i,!1),n(t,!1),!1):i.value.length<10?(t.innerText="Mínimo de 8 dígitos.",e(i,!1),n(t,!1),!1):i.value.length>10?(t.innerText="Máximo de 8 dígitos.",e(i,!1),n(t,!1),!1):(t.innerText="Formato aceito.",e(i,!0),n(t,!0),!0))},window.handleClientNameOnNewClientModal=function(){var e=document.querySelector("#client").value;document.querySelector("#client-name").value=e},window.calculateQuota=function(e){var n=(parseFloat(e.value.replace(".","").replace(",","."))/116).toFixed(2).replace(".",",");$("#potencia").val(n)},window.submit_form_contract_create=function(){!function(e,n){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},url:n,type:"GET",dataType:"json",data:e,success:function(e){e.status?function(){var e=!0;null==$("#type").val()&&(e=!1,$("#type").addClass("is-invalid")),$("#status").val("minuta"),t("#client",3)||(e=!1),t("#potencia",1)||(e=!1),t("#quantidade",3)||(e=!1),a("#contract-vigencia",0)||(e=!1),l("#payment_value",1)||(e=!1),a("#desconto",0)||(e=!1),l("#tarifa_base",1)||(e=!1),l("#meta_gestao",1)||(e=!1),c(),e&&$("#form-create-contract").submit()}():($("#client").addClass("is-invalid"),c())},error:function(e){$("#client").addClass("is-invalid")}})}({name:$("#client").val()},url_ajax_client_validate_name)}})();