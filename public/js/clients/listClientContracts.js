window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(e){return new bootstrap.Popover(e,{})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,a,n,t){n.mask(SPMaskBehavior.apply({},arguments),t)}},window.isInvalidText=function(e,a){var n=$(e).val(),t=!1;return null===n||n.length<a?(t=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),t},window.isInvalidNumber=function(e,a){var n=$(e).val(),t=!1;try{n=parseFloat(n)}catch(a){return t=!0,$(e).addClass("is-invalid"),t}return n<=a||isNaN(n)?(t=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),t},window.isValidInput=function(e,a){return $(e).val()&&$(e).val().length>=a?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,a){var n=e.replace("#","");return 3===n.length&&(n=n[0]+n[0]+n[1]+n[1]+n[2]+n[2]),"rgba("+parseInt(n.substring(0,2),16)+","+parseInt(n.substring(2,4),16)+","+parseInt(n.substring(4,6),16)+","+a/100+")"},$(document).ready((function(){moment.locale("pt-br"),window.moment.locale("pt-br"),$.fn.dataTable.moment("DD/MM/YYYY"),$.fn.dataTable.moment("DD/MM/YYYY");var e=new Map;e.set(1,"Janeiro"),e.set(2,"Fevereiro"),e.set(3,"Março"),e.set(4,"Abril"),e.set(5,"Maio"),e.set(6,"Junho"),e.set(7,"Julho"),e.set(8,"Agosto"),e.set(9,"Setembro"),e.set(10,"Outubro"),e.set(11,"Novembro"),e.set(12,"Dezembro"),$("#table_id").DataTable({bAutoWidth:!1,language:{lengthMenu:"Visualizar _MENU_ itens por página",zeroRecords:"Sem Informações",info:"Exibindo página _PAGE_ de _PAGES_",infoEmpty:"Sem Informações",infoFiltered:"",search:"Pesquisar",paginate:{first:"Primera",previous:"Anterior",next:"Próxima",last:"Última"}},lengthMenu:[[10,15,19],[10,15,20,"All"]],columnDefs:[{targets:2,searchable:!0,visible:!1}]})}));