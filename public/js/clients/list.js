window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(t){return new bootstrap.Tooltip(t,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(t){return new bootstrap.Popover(t,{})}))},window.SPMaskBehavior=function(t){return 11===t.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(t,e,n,a){n.mask(SPMaskBehavior.apply({},arguments),a)}},window.isInvalidText=function(t,e){var n=$(t).val(),a=!1;return null===n||n.length<e?(a=!0,$(t).addClass("is-invalid")):$(t).removeClass("is-invalid"),a},window.isInvalidNumber=function(t,e){var n=$(t).val(),a=!1;try{n=parseFloat(n)}catch(e){return a=!0,$(t).addClass("is-invalid"),a}return n<=e||isNaN(n)?(a=!0,$(t).addClass("is-invalid")):$(t).removeClass("is-invalid"),a},window.isValidInput=function(t,e){return $(t).val()&&$(t).val().length>=e?($(t).removeClass("is-invalid"),!0):($(t).addClass("is-invalid"),!1)},window.isValidCEP=function(t){return $(t).val()&&$(t).val().length==="00000-000".length?($(t).removeClass("is-invalid"),!0):($(t).addClass("is-invalid"),!1)},window.convertHex=function(t,e){var n=t.replace("#","");return 3===n.length&&(n=n[0]+n[0]+n[1]+n[1]+n[2]+n[2]),"rgba("+parseInt(n.substring(0,2),16)+","+parseInt(n.substring(2,4),16)+","+parseInt(n.substring(4,6),16)+","+e/100+")"},$(document).ready((function(){$("#table_id").DataTable({language:{lengthMenu:"Visualizar _MENU_ itens por página",zeroRecords:"Sem Informações",info:"Exibindo página _PAGE_ de _PAGES_",infoEmpty:"Sem Informações",infoFiltered:"",search:"Pesquisar",paginate:{first:"Primera",previous:"Anterior",next:"Próxima",last:"Última"}},lengthMenu:[[25,50,74],[25,50,75,"All"]]}),$('[data-toggle="tooltip"]').each((function(){$(this).tooltip({trigger:"hover",placement:"top"})}))})),window.getClientContractAccounts=function(t,e,n){var a=t.id.split("-")[4],s=document.querySelector("#loading-contract-accounts-".concat(a)),i=document.querySelector("#btn-text-".concat(a)),o={user:e,password:n};t.setAttribute("disabled",!0),t.classList.remove("btn-sm"),t.style.width="113.156px",s.classList.remove("d-none"),i.classList.add("d-none"),$.ajax({headers:{"X-CSRF-TOKEN":$("meta[name='csrf-token']").attr("content"),Accept:"application/json","Content-Type":"application/json"},url:"http://equatorial.sunnyhouse.com.br/listAccountContracts",type:"POST",dataType:"json",data:JSON.stringify(o),success:function(a){a.data.login=e,a.data.password=n,t.removeAttribute("disabled"),t.classList.add("btn-sm"),s.classList.add("d-none"),i.classList.remove("d-none"),function(t,e){var n=t.id.split("-")[4];document.querySelector("#client-contract-accounts-".concat(n)).value=JSON.stringify(e),document.querySelector("#form-client-contract-accounts-".concat(n)).submit()}(t,a.data)},error:function(e){var n=document.querySelector(".page-title");t.removeAttribute("disabled"),t.classList.add("btn-sm"),s.classList.add("d-none"),i.classList.remove("d-none"),500===e.status?n.insertAdjacentHTML("afterend",'\n                    <div class="alert alert-danger alert-dismissible show fade">\n                        <strong>Credenciais do cliente inválidas.</strong>\n                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n                    </div>\n                '):0===e.status&&n.insertAdjacentHTML("afterend",'\n                    <div class="alert alert-danger alert-dismissible show fade">\n                        <strong>Serviço indisponível no momento. Tente novamente mais tarde.</strong>\n                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n                    </div>\n                '),window.scrollTo(0,0),$("div.alert").delay(5e3).fadeOut(350)}})};