(()=>{var e={7757:(e,t,n)=>{e.exports=n(5666)},5666:e=>{var t=function(e){"use strict";var t,n=Object.prototype,r=n.hasOwnProperty,i="function"==typeof Symbol?Symbol:{},o=i.iterator||"@@iterator",a=i.asyncIterator||"@@asyncIterator",c=i.toStringTag||"@@toStringTag";function l(e,t,n){return Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}),e[t]}try{l({},"")}catch(e){l=function(e,t,n){return e[t]=n}}function s(e,t,n,r){var i=t&&t.prototype instanceof p?t:p,o=Object.create(i.prototype),a=new E(r||[]);return o._invoke=function(e,t,n){var r=d;return function(i,o){if(r===f)throw new Error("Generator is already running");if(r===h){if("throw"===i)throw o;return _()}for(n.method=i,n.arg=o;;){var a=n.delegate;if(a){var c=S(a,n);if(c){if(c===m)continue;return c}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if(r===d)throw r=h,n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r=f;var l=u(e,t,n);if("normal"===l.type){if(r=n.done?h:v,l.arg===m)continue;return{value:l.arg,done:n.done}}"throw"===l.type&&(r=h,n.method="throw",n.arg=l.arg)}}}(e,n,a),o}function u(e,t,n){try{return{type:"normal",arg:e.call(t,n)}}catch(e){return{type:"throw",arg:e}}}e.wrap=s;var d="suspendedStart",v="suspendedYield",f="executing",h="completed",m={};function p(){}function y(){}function g(){}var w={};l(w,o,(function(){return this}));var k=Object.getPrototypeOf,b=k&&k(k($([])));b&&b!==n&&r.call(b,o)&&(w=b);var x=g.prototype=p.prototype=Object.create(w);function L(e){["next","throw","return"].forEach((function(t){l(e,t,(function(e){return this._invoke(t,e)}))}))}function C(e,t){function n(i,o,a,c){var l=u(e[i],e,o);if("throw"!==l.type){var s=l.arg,d=s.value;return d&&"object"==typeof d&&r.call(d,"__await")?t.resolve(d.__await).then((function(e){n("next",e,a,c)}),(function(e){n("throw",e,a,c)})):t.resolve(d).then((function(e){s.value=e,a(s)}),(function(e){return n("throw",e,a,c)}))}c(l.arg)}var i;this._invoke=function(e,r){function o(){return new t((function(t,i){n(e,r,t,i)}))}return i=i?i.then(o,o):o()}}function S(e,n){var r=e.iterator[n.method];if(r===t){if(n.delegate=null,"throw"===n.method){if(e.iterator.return&&(n.method="return",n.arg=t,S(e,n),"throw"===n.method))return m;n.method="throw",n.arg=new TypeError("The iterator does not provide a 'throw' method")}return m}var i=u(r,e.iterator,n.arg);if("throw"===i.type)return n.method="throw",n.arg=i.arg,n.delegate=null,m;var o=i.arg;return o?o.done?(n[e.resultName]=o.value,n.next=e.nextLoc,"return"!==n.method&&(n.method="next",n.arg=t),n.delegate=null,m):o:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,m)}function q(e){var t={tryLoc:e[0]};1 in e&&(t.catchLoc=e[1]),2 in e&&(t.finallyLoc=e[2],t.afterLoc=e[3]),this.tryEntries.push(t)}function T(e){var t=e.completion||{};t.type="normal",delete t.arg,e.completion=t}function E(e){this.tryEntries=[{tryLoc:"root"}],e.forEach(q,this),this.reset(!0)}function $(e){if(e){var n=e[o];if(n)return n.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var i=-1,a=function n(){for(;++i<e.length;)if(r.call(e,i))return n.value=e[i],n.done=!1,n;return n.value=t,n.done=!0,n};return a.next=a}}return{next:_}}function _(){return{value:t,done:!0}}return y.prototype=g,l(x,"constructor",g),l(g,"constructor",y),y.displayName=l(g,c,"GeneratorFunction"),e.isGeneratorFunction=function(e){var t="function"==typeof e&&e.constructor;return!!t&&(t===y||"GeneratorFunction"===(t.displayName||t.name))},e.mark=function(e){return Object.setPrototypeOf?Object.setPrototypeOf(e,g):(e.__proto__=g,l(e,c,"GeneratorFunction")),e.prototype=Object.create(x),e},e.awrap=function(e){return{__await:e}},L(C.prototype),l(C.prototype,a,(function(){return this})),e.AsyncIterator=C,e.async=function(t,n,r,i,o){void 0===o&&(o=Promise);var a=new C(s(t,n,r,i),o);return e.isGeneratorFunction(n)?a:a.next().then((function(e){return e.done?e.value:a.next()}))},L(x),l(x,c,"Generator"),l(x,o,(function(){return this})),l(x,"toString",(function(){return"[object Generator]"})),e.keys=function(e){var t=[];for(var n in e)t.push(n);return t.reverse(),function n(){for(;t.length;){var r=t.pop();if(r in e)return n.value=r,n.done=!1,n}return n.done=!0,n}},e.values=$,E.prototype={constructor:E,reset:function(e){if(this.prev=0,this.next=0,this.sent=this._sent=t,this.done=!1,this.delegate=null,this.method="next",this.arg=t,this.tryEntries.forEach(T),!e)for(var n in this)"t"===n.charAt(0)&&r.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=t)},stop:function(){this.done=!0;var e=this.tryEntries[0].completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(e){if(this.done)throw e;var n=this;function i(r,i){return c.type="throw",c.arg=e,n.next=r,i&&(n.method="next",n.arg=t),!!i}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],c=a.completion;if("root"===a.tryLoc)return i("end");if(a.tryLoc<=this.prev){var l=r.call(a,"catchLoc"),s=r.call(a,"finallyLoc");if(l&&s){if(this.prev<a.catchLoc)return i(a.catchLoc,!0);if(this.prev<a.finallyLoc)return i(a.finallyLoc)}else if(l){if(this.prev<a.catchLoc)return i(a.catchLoc,!0)}else{if(!s)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return i(a.finallyLoc)}}}},abrupt:function(e,t){for(var n=this.tryEntries.length-1;n>=0;--n){var i=this.tryEntries[n];if(i.tryLoc<=this.prev&&r.call(i,"finallyLoc")&&this.prev<i.finallyLoc){var o=i;break}}o&&("break"===e||"continue"===e)&&o.tryLoc<=t&&t<=o.finallyLoc&&(o=null);var a=o?o.completion:{};return a.type=e,a.arg=t,o?(this.method="next",this.next=o.finallyLoc,m):this.complete(a)},complete:function(e,t){if("throw"===e.type)throw e.arg;return"break"===e.type||"continue"===e.type?this.next=e.arg:"return"===e.type?(this.rval=this.arg=e.arg,this.method="return",this.next="end"):"normal"===e.type&&t&&(this.next=t),m},finish:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var n=this.tryEntries[t];if(n.finallyLoc===e)return this.complete(n.completion,n.afterLoc),T(n),m}},catch:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var n=this.tryEntries[t];if(n.tryLoc===e){var r=n.completion;if("throw"===r.type){var i=r.arg;T(n)}return i}}throw new Error("illegal catch attempt")},delegateYield:function(e,n,r){return this.delegate={iterator:$(e),resultName:n,nextLoc:r},"next"===this.method&&(this.arg=t),m}},e}(e.exports);try{regeneratorRuntime=t}catch(e){"object"==typeof globalThis?globalThis.regeneratorRuntime=t:Function("r","regeneratorRuntime = r")(t)}}},t={};function n(r){var i=t[r];if(void 0!==i)return i.exports;var o=t[r]={exports:{}};return e[r](o,o.exports,n),o.exports}n.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},n.d=(e,t)=>{for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(e){return new bootstrap.Popover(e,{})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,t,n,r){n.mask(SPMaskBehavior.apply({},arguments),r)}},window.isInvalidText=function(e,t){var n=$(e).val(),r=!1;return null===n||n.length<t?(r=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),r},window.isInvalidNumber=function(e,t){var n=$(e).val(),r=!1;try{n=parseFloat(n)}catch(t){return r=!0,$(e).addClass("is-invalid"),r}return n<=t||isNaN(n)?(r=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),r},window.isValidInput=function(e,t){return $(e).val()&&$(e).val().length>=t?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,t){var n=e.replace("#","");return 3===n.length&&(n=n[0]+n[0]+n[1]+n[1]+n[2]+n[2]),"rgba("+parseInt(n.substring(0,2),16)+","+parseInt(n.substring(2,4),16)+","+parseInt(n.substring(4,6),16)+","+t/100+")"},(()=>{"use strict";var e=n(7757),t=n.n(e);function r(e,t,n,r,i,o,a){try{var c=e[o](a),l=c.value}catch(e){return void n(e)}c.done?t(l):Promise.resolve(l).then(r,i)}function i(e){return function(){var t=this,n=arguments;return new Promise((function(i,o){var a=e.apply(t,n);function c(e){r(a,i,o,c,l,"next",e)}function l(e){r(a,i,o,c,l,"throw",e)}c(void 0)}))}}function o(e,t){t?(e.classList.add("is-valid"),e.classList.remove("is-invalid")):(e.classList.add("is-invalid"),e.classList.remove("is-valid"))}function a(e,t){t?(e.classList.add("valid-feedback"),e.classList.remove("invalid-feedback"),e.style.display="block"):(e.classList.add("invalid-feedback"),e.classList.remove("valid-feedback"),e.style.display="block")}$(document).ready((function(){window.autocomplete(document.querySelector("#ticket-contract"),contracts),window.autocomplete(document.querySelector("#ticket-client"),clients)})),window.autocomplete=function(e,t){var n,r=!1,i=$("#".concat(e.id)).next(),o="contract"===e.id.split("-")[1]?"Contrato":"Cliente";function a(e){if(!e)return!1;!function(e){for(var t=0;t<e.length;t++)e[t].classList.remove("autocomplete-active")}(e),n>=e.length&&(n=0),n<0&&(n=e.length-1),e[n].classList.add("autocomplete-active")}function c(t){for(var n=document.getElementsByClassName("autocomplete-items"),r=0;r<n.length;r++)t!=n[r]&&t!=e&&n[r].parentNode.removeChild(n[r])}$("#".concat(e.id)).on("input",(function(a){var l,s,u,d=this.value;if(r=!1,c(),!d)return $("#new_".concat(e.id)).show(),$("#".concat(e.id)).removeClass("is-valid"),$("#".concat(e.id)).addClass("is-invalid"),i.text("Preencha o campo."),i.removeClass("valid-feedback"),i.addClass("invalid-feedback"),!1;$("#new_".concat(e.id)).hide(),$("#".concat(e.id)).removeClass("is-valid"),$("#".concat(e.id)).addClass("is-invalid"),i.text("".concat(o," não encontrado.")),i.removeClass("valid-feedback"),i.addClass("invalid-feedback"),n=-1,(l=document.createElement("DIV")).setAttribute("id","autocomplete-list-".concat(e.id)),l.setAttribute("class","autocomplete-items "),l.setAttribute("style","margin-left: 24px; margin-top: -23px; width: 705px"),this.parentNode.appendChild(l);var v=0;for(u=0;u<t.length;u++)if(t[u].client.toLowerCase().includes(d.toLowerCase())&&v<10){var f=void 0;r=!0,v++,s=document.createElement("DIV"),f="Contrato"===o?null===t[u].generator_power?"".concat(t[u].client):"".concat(t[u].client," (").concat(t[u].generator_power," kWp)"):"".concat(t[u].client);var h=new RegExp("(".concat(d,")"),"gi");s.innerHTML=f.replace(h,"<strong>$1</strong>"),s.innerHTML+='<input type="hidden" value="'.concat(t[u].client,'">'),s.addEventListener("click",(function(t){e.value=this.getElementsByTagName("input")[0].value,$("#".concat(e.id)).removeClass("is-invalid"),$("#".concat(e.id)).addClass("is-valid"),i.removeClass("invalid-feedback"),i.addClass(["valid-feedback","d-block"]),i.text("Formato aceito."),c()})),l.appendChild(s)}t.indexOf(this.value)>=0?$("#".concat(e.id)).removeClass("is-invalid"):(r&&$("#".concat(e.id)).val()?$("#new_".concat(e.id)).hide():$("#new_".concat(e.id)).show(),$("#".concat(e.id)).addClass("is-invalid"),i.text("".concat(o," não encontrado.")),i.removeClass("valid-feedback"),i.addClass(["invalid-feedback","d-block"]))})),e.addEventListener("keydown",(function(t){var r=document.getElementById("autocomplete-list-".concat(e.id));r&&(r=r.getElementsByTagName("div")),n=void 0===n?-1:n,40==t.keyCode?(n++,a(r)):38==t.keyCode?(n--,a(r)):13==t.keyCode&&(t.preventDefault(),n>-1&&r&&r[n].click())})),document.addEventListener("click",(function(e){return c(e.target)}))},window.changeToClientData=function(e){var t=document.querySelector("#ticket-contract"),n=document.querySelector("#ticket-feedback-contract-create"),r=document.querySelector("#ticket-client"),i=document.querySelector("#ticket-feedback-client-create");e.checked?(t.value="",t.closest(".row").classList.add("d-none"),r.closest(".row").classList.remove("d-none"),t.removeAttribute("required"),r.setAttribute("required",!0),t.classList.remove("is-valid","is-invalid"),n.classList.remove("is-valid","is-invalid"),n.innerText=""):(r.value="",r.closest(".row").classList.add("d-none"),t.closest(".row").classList.remove("d-none"),r.removeAttribute("required"),t.setAttribute("required",!0),r.classList.remove("is-valid","is-invalid"),i.classList.remove("is-valid","is-invalid"),i.innerText="")},window.clearFormCreateTicket=function(){var e=document.querySelector("#ticket-title"),t=document.querySelector("#ticket-feedback-title-create"),n=document.querySelector("#ticket-contract"),r=document.querySelector("#ticket-feedback-contract-create"),i=document.querySelector("#ticket-client"),o=document.querySelector("#ticket-feedback-client-create"),a=document.querySelector("#ticket-type"),c=document.querySelector("#ticket-feedback-type-create"),l=document.querySelector("#ticket-deadline"),s=document.querySelector("#ticket-feedback-deadline-create"),u=document.querySelector("#chk-use-client-data");e.value="",n.value="",i.value="",a.selectedIndex=0,l.value="",e.classList.remove("is-valid","is-invalid"),t.classList.remove("is-valid","is-invalid"),t.innerText="",n.classList.remove("is-valid","is-invalid"),r.classList.remove("is-valid","is-invalid"),r.innerText="",i.classList.remove("is-valid","is-invalid"),o.classList.remove("is-valid","is-invalid"),o.innerText="",a.classList.remove("is-valid","is-invalid"),c.classList.remove("is-valid","is-invalid"),c.innerText="",l.classList.remove("is-valid","is-invalid"),s.classList.remove("is-valid","is-invalid"),s.innerText="",u.checked=!1,window.changeToClientData(u)},window.validateInput=function(e,t){var n=e.closest(".form-group").lastElementChild;return 0===e.value.length?(n.innerText="Preencha o campo.",o(e,!1),a(n,!1),!1):e.value.length<t?(n.innerText="Mínimo de ".concat(t,1===t?" caractere.":" caracteres."),o(e,!1),a(n,!1),!1):(n.innerText="Formato aceito.",o(e,!0),a(n,!0),!0)},window.validateSelect=function(e){var t=e.closest(".form-group").lastElementChild;return 0===e.selectedIndex?(t.innerText="Escolha uma opção.",o(e,!1),a(t,!1),!1):(t.innerText="Formato aceito.",o(e,!0),a(t,!0),!0)},window.validateContract=function(e){var t=document.querySelector("#ticket-feedback-contract-create");return e.hasAttribute("required")?contracts.find((function(t){return t.client===e.value}))?(t.innerText="Formato aceito.",o(e,!0),a(t,!0),!0):(t.innerText="Contrato não encontrado.",o(e,!1),a(t,!1),!1):(o(e,!0),a(t,!0),!0)},window.validateClient=function(e){var t=document.querySelector("#ticket-feedback-client-create");return e.hasAttribute("required")?clients.find((function(t){return t.client===e.value}))?(t.innerText="Formato aceito.",o(e,!0),a(t,!0),!0):(t.innerText="Cliente não encontrado.",o(e,!1),a(t,!1),!1):(o(e,!0),a(t,!0),!0)},window.validateTicketDeadline=function(e){var t=document.querySelector("#ticket-feedback-deadline-create"),n=e.value,r=function(e,t){var n=1==(e=new Date(parseInt(e))).getDate().toString().length?"0"+e.getDate().toString():e.getDate().toString(),r=parseInt(e.getMonth())+1;r=1==r.toString().length?"0"+r.toString():r.toString();var i=e.getFullYear();e="en-us"===t?"".concat(i,"-").concat(r,"-").concat(n):"".concat(n,"/").concat(r,"/").concat(i);return e}(Date.now(),"en-us");return isNaN(n)?n.split("-").length<3?(t.innerText="Formato inválido.",o(e,!1),a(t,!1),!1):n.split("-")[0].length>4?(t.innerText="O ano deve ter no máximo 4 dígitos.",o(e,!1),a(t,!1),!1):n<r?(t.innerText="O Prazo deve ser igual ou maior a data de hoje.",o(e,!1),a(t,!1),!1):n.length<8?(t.innerText="Mínimo de ".concat(8," caracteres."),o(e,!1),a(t,!1),!1):(t.innerText="Formato aceito.",o(e,!0),a(t,!0),!0):(t.innerText="",o(e,!0),a(t,!0),!0)},window.submitFormCreateTicket=i(t().mark((function e(){var n,r,i,o,a,c,l,s,u,d,v,f,h,m,p,y,g,w;return t().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:n=!0,r=document.querySelector("#form-create-ticket"),i=document.querySelector("#ticket-title"),o=document.querySelector("#ticket-contract"),a=document.querySelector("#ticket-contract-id"),c=document.querySelector("#ticket-client"),l=document.querySelector("#ticket-client-id"),s=document.querySelector("#ticket-type"),u=document.querySelector("#ticket-deadline"),d=!!window.validateInput(i,2),v=!o.hasAttribute("required")||!!window.validateContract(o),f=!c.hasAttribute("required")||!!window.validateClient(c),h=!!window.validateSelect(s),m=!!window.validateTicketDeadline(u),d||(n=!1),v||(n=!1),f||(n=!1),h||(n=!1),m||(n=!1),null!==document.querySelector(".is-invalid")&&document.querySelector(".is-invalid").focus(),n&&(p=document.querySelector("#btn-create-ticket"),y=document.querySelector("#btn-create-ticket-loading"),p.setAttribute("disabled",!0),y.classList.remove("d-none"),o.hasAttribute("required")?(g=contracts.find((function(e){if(e.client===o.value)return e})),a.value=g.contract_id):(w=clients.find((function(e){if(e.client===c.value)return e})),l.value=w.client_id),r.submit());case 21:case"end":return e.stop()}}),e)})))})()})();