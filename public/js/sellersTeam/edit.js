window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(e){return new bootstrap.Popover(e,{})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,a,i,n){i.mask(SPMaskBehavior.apply({},arguments),n)}},window.isInvalidText=function(e,a){var i=$(e).val(),n=!1;return null===i||i.length<a?(n=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),n},window.isInvalidNumber=function(e,a){var i=$(e).val(),n=!1;try{i=parseFloat(i)}catch(a){return n=!0,$(e).addClass("is-invalid"),n}return i<=a||isNaN(i)?(n=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),n},window.isValidInput=function(e,a){return $(e).val()&&$(e).val().length>=a?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,a){var i=e.replace("#","");return 3===i.length&&(i=i[0]+i[0]+i[1]+i[1]+i[2]+i[2]),"rgba("+parseInt(i.substring(0,2),16)+","+parseInt(i.substring(2,4),16)+","+parseInt(i.substring(4,6),16)+","+a/100+")"},(()=>{var e=!0;function a(){var a=$("#email").val(),i=$("#name").val();$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},url:url_ajax_email,type:"GET",dataType:"json",data:{email:a,seller,name:i},success:function(a){var i;(i=a).exist_email?($("#email_feedback").text("Email Inválido - Endereço já utilizado no sistema"),$("#email").addClass("is-invalid")):i.validated_fail?($("#email_feedback").text("Email Inválido."),$("#email").addClass("is-invalid")):$("#email").removeClass("is-invalid"),i.exist_name?($("#name_feedback").text("Nome Inválido - Já utilizado no sistema"),$("#name").addClass("is-invalid")):$("#name").removeClass("is-invalid"),$("#name").val().length<5&&($("#name_feedback").text("Mínimo 5 caracteres."),$("#name").addClass("is-invalid")),e=!(i.exist_email||i.exist_name||i.validated_fail)},error:function(e){}})}function i(e,a){var i,n=!1;function t(e){if(!e)return!1;!function(e){for(var a=0;a<e.length;a++)e[a].classList.remove("autocomplete-active")}(e),i>=e.length&&(i=0),i<0&&(i=e.length-1),e[i].classList.add("autocomplete-active")}function s(a){for(var i=document.getElementsByClassName("autocomplete-items"),n=0;n<i.length;n++)a!=i[n]&&a!=e&&i[n].parentNode.removeChild(i[n])}$("#"+e.id).on("input",(function(t){n=!1;var l,o,d,r=this.value;if(s(),!r)return $("#new_"+e.id).show(),$("#"+e.id).addClass("is-invalid"),!1;$("#new_"+e.id).hide(),i=-1,(l=document.createElement("DIV")).setAttribute("id","autocomplete-list-"+e.id),l.setAttribute("class","autocomplete-items "),l.setAttribute("style","margin-left: 25px; width:"+$("#"+e.id).parent().width()+"px"),this.parentNode.appendChild(l);var m=0;for(d=0;d<a.length;d++)if(a[d].toLowerCase().includes(r.toLowerCase())&&m<10){n=!0,m++,o=document.createElement("DIV");var v=a[d],u=new RegExp("("+r+")","gi");o.innerHTML=v.replace(u,"<strong>$1</strong>"),o.innerHTML+="<input type='hidden' value='"+a[d]+"'>",o.addEventListener("click",(function(i){e.value=this.getElementsByTagName("input")[0].value,a.indexOf(e.value)>=0?$("#"+e.id).removeClass("is-invalid"):$("#"+e.id).addClass("is-invalid"),s()})),l.appendChild(o)}a.indexOf(this.value)>=0?$("#"+e.id).removeClass("is-invalid"):(n&&$("#"+e.id).val()?$("#new_"+e.id).hide():$("#new_"+e.id).show(),$("#"+e.id).addClass("is-invalid"))})),e.addEventListener("keydown",(function(a){var n=document.getElementById("autocomplete-list-"+e.id);n&&(n=n.getElementsByTagName("div")),40==a.keyCode?(i++,t(n)):38==a.keyCode?(i--,t(n)):13==a.keyCode&&(a.preventDefault(),i>-1&&n&&n[i].click())})),document.addEventListener("click",(function(e){s(e.target)}))}$(document).ready((function(){i(document.getElementById("team"),teams),$("#new_team").hide(),$("#phone").mask(window.SPMaskBehavior,spOptions),$("#cep").mask("00000-000"),$("#name").removeClass("is-invalid"),$("#email").removeClass("is-invalid"),$("#team").removeClass("is-invalid"),$("#cep").removeClass("is-invalid"),$("#phone").removeClass("is-invalid"),$("#address").removeClass("is-invalid"),$("#number").removeClass("is-invalid"),$("#complement").removeClass("is-invalid"),function(){var e;$("#name").on("change paste keyup input create",(function(e){this.value.length>=5?$("#name").removeClass("is-invalid"):$("#name").addClass("is-invalid")}));var n=1e3;$("#email").on("change paste keyup input create focus",(function(i){clearTimeout(e),e=setTimeout(a,n)})),$("#phone").on("change paste keyup input create focus",(function(e){this.value.length>="(00) 0000-0000".length?$("#phone").removeClass("is-invalid"):$("#phone").addClass("is-invalid")})),$("#cep").on("change paste keyup input create focus",(function(e){this.value.length==="00000-000".length&&$.ajax({url:"https://viacep.com.br/ws/"+$(this).val().replace("-","")+"/json/unicode/",dataType:"json",success:function(e){void 0===e.erro&&$("#address").val(e.logradouro+" - "+e.bairro+" - "+e.localidade+" - "+e.uf)}})})),$("#btn-create-team").on("click",(function(){var e=$("#team-name").val();e.length>=5?($("#team-name").removeClass("is-invalid"),function(e,a){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},url:a,type:"GET",dataType:"json",data:e,success:function(e){!function(e){e.saved&&(i(document.getElementById("team"),e.items),$("#team").val(e.name),$("#team").removeClass("is-invalid"),$("#modal_new_team").modal("hide"))}(e)},error:function(e){}})}({"team-name":e},url_ajax_store_team)):$("#team-name").addClass("is-invalid")}))}()})),window.submit_form_seller_update=function(){var a=!0;return $("#name").val().length<5&&(a=!1),/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($("#email").val())||(a=!1),$("#phone").val().length<"(00) 0000-0000".length&&(a=!1),e||(a=!1),$("#team").hasClass("is-invalid")&&(a=!1),a}})();