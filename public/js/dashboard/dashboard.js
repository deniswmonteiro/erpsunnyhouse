window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(e){return new bootstrap.Popover(e,{})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,n,t,a){t.mask(SPMaskBehavior.apply({},arguments),a)}},window.isInvalidText=function(e,n){var t=$(e).val(),a=!1;return null===t||t.length<n?(a=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),a},window.isInvalidNumber=function(e,n){var t=$(e).val(),a=!1;try{t=parseFloat(t)}catch(n){return a=!0,$(e).addClass("is-invalid"),a}return t<=n||isNaN(t)?(a=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),a},window.isValidInput=function(e,n){return $(e).val()&&$(e).val().length>=n?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,n){var t=e.replace("#","");return 3===t.length&&(t=t[0]+t[0]+t[1]+t[1]+t[2]+t[2]),"rgba("+parseInt(t.substring(0,2),16)+","+parseInt(t.substring(2,4),16)+","+parseInt(t.substring(4,6),16)+","+n/100+")"},$(document).ready((function(){$("#check_sellers, #check_sellers_team").on("change",(function(){$(".form-check-input").prop("checked",$(this).prop("checked"))}))})),window.submit_form_update_dashboard=function(e,n,t){var a=[];$("#"+e+" > tbody > tr").has("input[type=checkbox]:checked").each((function(e,n){var t=$(this).find("td:eq(1)").text();a.push(t)})),a.length>0&&($("<input type='hidden' value='"+a+"' />").attr("name",t).appendTo("#"+n),$("#"+n).submit())},window.change_type_update_dashboard=function(e,n,t){var a=$("#flexSwitchCheck").is(":checked"),i=[];$("#"+e+" > tbody > tr").has("input[type=checkbox]:checked").each((function(e,n){var t=$(this).find("td:eq(1)").text();i.push(t)})),i.length>0&&($("<input type='hidden' value='"+i+"' />").attr("name",t).appendTo("#"+n),a&&$("<input type='hidden' value='true' />").attr("name","type").appendTo("#"+n),$("#"+n).submit())};