(()=>{var e={7757:(e,t,r)=>{e.exports=r(5666)},5666:e=>{var t=function(e){"use strict";var t,r=Object.prototype,n=r.hasOwnProperty,i="function"==typeof Symbol?Symbol:{},a=i.iterator||"@@iterator",o=i.asyncIterator||"@@asyncIterator",u=i.toStringTag||"@@toStringTag";function l(e,t,r){return Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}),e[t]}try{l({},"")}catch(e){l=function(e,t,r){return e[t]=r}}function s(e,t,r,n){var i=t&&t.prototype instanceof m?t:m,a=Object.create(i.prototype),o=new I(n||[]);return a._invoke=function(e,t,r){var n=d;return function(i,a){if(n===f)throw new Error("Generator is already running");if(n===h){if("throw"===i)throw a;return P()}for(r.method=i,r.arg=a;;){var o=r.delegate;if(o){var u=T(o,r);if(u){if(u===p)continue;return u}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===d)throw n=h,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=f;var l=c(e,t,r);if("normal"===l.type){if(n=r.done?h:v,l.arg===p)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n=h,r.method="throw",r.arg=l.arg)}}}(e,r,o),a}function c(e,t,r){try{return{type:"normal",arg:e.call(t,r)}}catch(e){return{type:"throw",arg:e}}}e.wrap=s;var d="suspendedStart",v="suspendedYield",f="executing",h="completed",p={};function m(){}function g(){}function y(){}var w={};l(w,a,(function(){return this}));var q=Object.getPrototypeOf,b=q&&q(q(E([])));b&&b!==r&&n.call(b,a)&&(w=b);var S=y.prototype=m.prototype=Object.create(w);function x(e){["next","throw","return"].forEach((function(t){l(e,t,(function(e){return this._invoke(t,e)}))}))}function k(e,t){function r(i,a,o,u){var l=c(e[i],e,a);if("throw"!==l.type){var s=l.arg,d=s.value;return d&&"object"==typeof d&&n.call(d,"__await")?t.resolve(d.__await).then((function(e){r("next",e,o,u)}),(function(e){r("throw",e,o,u)})):t.resolve(d).then((function(e){s.value=e,o(s)}),(function(e){return r("throw",e,o,u)}))}u(l.arg)}var i;this._invoke=function(e,n){function a(){return new t((function(t,i){r(e,n,t,i)}))}return i=i?i.then(a,a):a()}}function T(e,r){var n=e.iterator[r.method];if(n===t){if(r.delegate=null,"throw"===r.method){if(e.iterator.return&&(r.method="return",r.arg=t,T(e,r),"throw"===r.method))return p;r.method="throw",r.arg=new TypeError("The iterator does not provide a 'throw' method")}return p}var i=c(n,e.iterator,r.arg);if("throw"===i.type)return r.method="throw",r.arg=i.arg,r.delegate=null,p;var a=i.arg;return a?a.done?(r[e.resultName]=a.value,r.next=e.nextLoc,"return"!==r.method&&(r.method="next",r.arg=t),r.delegate=null,p):a:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,p)}function L(e){var t={tryLoc:e[0]};1 in e&&(t.catchLoc=e[1]),2 in e&&(t.finallyLoc=e[2],t.afterLoc=e[3]),this.tryEntries.push(t)}function _(e){var t=e.completion||{};t.type="normal",delete t.arg,e.completion=t}function I(e){this.tryEntries=[{tryLoc:"root"}],e.forEach(L,this),this.reset(!0)}function E(e){if(e){var r=e[a];if(r)return r.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var i=-1,o=function r(){for(;++i<e.length;)if(n.call(e,i))return r.value=e[i],r.done=!1,r;return r.value=t,r.done=!0,r};return o.next=o}}return{next:P}}function P(){return{value:t,done:!0}}return g.prototype=y,l(S,"constructor",y),l(y,"constructor",g),g.displayName=l(y,u,"GeneratorFunction"),e.isGeneratorFunction=function(e){var t="function"==typeof e&&e.constructor;return!!t&&(t===g||"GeneratorFunction"===(t.displayName||t.name))},e.mark=function(e){return Object.setPrototypeOf?Object.setPrototypeOf(e,y):(e.__proto__=y,l(e,u,"GeneratorFunction")),e.prototype=Object.create(S),e},e.awrap=function(e){return{__await:e}},x(k.prototype),l(k.prototype,o,(function(){return this})),e.AsyncIterator=k,e.async=function(t,r,n,i,a){void 0===a&&(a=Promise);var o=new k(s(t,r,n,i),a);return e.isGeneratorFunction(r)?o:o.next().then((function(e){return e.done?e.value:o.next()}))},x(S),l(S,u,"Generator"),l(S,a,(function(){return this})),l(S,"toString",(function(){return"[object Generator]"})),e.keys=function(e){var t=[];for(var r in e)t.push(r);return t.reverse(),function r(){for(;t.length;){var n=t.pop();if(n in e)return r.value=n,r.done=!1,r}return r.done=!0,r}},e.values=E,I.prototype={constructor:I,reset:function(e){if(this.prev=0,this.next=0,this.sent=this._sent=t,this.done=!1,this.delegate=null,this.method="next",this.arg=t,this.tryEntries.forEach(_),!e)for(var r in this)"t"===r.charAt(0)&&n.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=t)},stop:function(){this.done=!0;var e=this.tryEntries[0].completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(e){if(this.done)throw e;var r=this;function i(n,i){return u.type="throw",u.arg=e,r.next=n,i&&(r.method="next",r.arg=t),!!i}for(var a=this.tryEntries.length-1;a>=0;--a){var o=this.tryEntries[a],u=o.completion;if("root"===o.tryLoc)return i("end");if(o.tryLoc<=this.prev){var l=n.call(o,"catchLoc"),s=n.call(o,"finallyLoc");if(l&&s){if(this.prev<o.catchLoc)return i(o.catchLoc,!0);if(this.prev<o.finallyLoc)return i(o.finallyLoc)}else if(l){if(this.prev<o.catchLoc)return i(o.catchLoc,!0)}else{if(!s)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return i(o.finallyLoc)}}}},abrupt:function(e,t){for(var r=this.tryEntries.length-1;r>=0;--r){var i=this.tryEntries[r];if(i.tryLoc<=this.prev&&n.call(i,"finallyLoc")&&this.prev<i.finallyLoc){var a=i;break}}a&&("break"===e||"continue"===e)&&a.tryLoc<=t&&t<=a.finallyLoc&&(a=null);var o=a?a.completion:{};return o.type=e,o.arg=t,a?(this.method="next",this.next=a.finallyLoc,p):this.complete(o)},complete:function(e,t){if("throw"===e.type)throw e.arg;return"break"===e.type||"continue"===e.type?this.next=e.arg:"return"===e.type?(this.rval=this.arg=e.arg,this.method="return",this.next="end"):"normal"===e.type&&t&&(this.next=t),p},finish:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var r=this.tryEntries[t];if(r.finallyLoc===e)return this.complete(r.completion,r.afterLoc),_(r),p}},catch:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var r=this.tryEntries[t];if(r.tryLoc===e){var n=r.completion;if("throw"===n.type){var i=n.arg;_(r)}return i}}throw new Error("illegal catch attempt")},delegateYield:function(e,r,n){return this.delegate={iterator:E(e),resultName:r,nextLoc:n},"next"===this.method&&(this.arg=t),p}},e}(e.exports);try{regeneratorRuntime=t}catch(e){"object"==typeof globalThis?globalThis.regeneratorRuntime=t:Function("r","regeneratorRuntime = r")(t)}}},t={};function r(n){var i=t[n];if(void 0!==i)return i.exports;var a=t[n]={exports:{}};return e[n](a,a.exports,r),a.exports}r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(e){return new bootstrap.Popover(e,{})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,t,r,n){r.mask(SPMaskBehavior.apply({},arguments),n)}},window.isInvalidText=function(e,t){var r=$(e).val(),n=!1;return null===r||r.length<t?(n=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),n},window.isInvalidNumber=function(e,t){var r=$(e).val(),n=!1;try{r=parseFloat(r)}catch(t){return n=!0,$(e).addClass("is-invalid"),n}return r<=t||isNaN(r)?(n=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),n},window.isValidInput=function(e,t){return $(e).val()&&$(e).val().length>=t?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,t){var r=e.replace("#","");return 3===r.length&&(r=r[0]+r[0]+r[1]+r[1]+r[2]+r[2]),"rgba("+parseInt(r.substring(0,2),16)+","+parseInt(r.substring(2,4),16)+","+parseInt(r.substring(4,6),16)+","+t/100+")"},(()=>{"use strict";var e=r(7757),t=r.n(e);function n(e,t,r,n,i,a,o){try{var u=e[a](o),l=u.value}catch(e){return void r(e)}u.done?t(l):Promise.resolve(l).then(n,i)}function i(e){return function(){var t=this,r=arguments;return new Promise((function(i,a){var o=e.apply(t,r);function u(e){n(o,i,a,u,l,"next",e)}function l(e){n(o,i,a,u,l,"throw",e)}u(void 0)}))}}function a(e,t){t?(e.classList.add("is-valid"),e.classList.remove("is-invalid")):(e.classList.add("is-invalid"),e.classList.remove("is-valid"))}function o(e,t){t?(e.classList.add("valid-feedback"),e.classList.remove("invalid-feedback"),e.style.display="block"):(e.classList.add("invalid-feedback"),e.classList.remove("valid-feedback"),e.style.display="block")}$(document).ready((function(){$("#edit-request-first-clientrg").mask("0#"),$(["#edit-request-first-clientcellphone","#edit-request-first-clientphone","#edit-request-first-responsiblephone"]).mask(window.SPMaskBehavior,spOptions),$(["#edit-request-first-ucpower","#edit-request-first-ucload","#edit-request-first-ucbreaker","#edit-request-first-ucpd","#edit-request-first-coordinatesx","#edit-request-first-coordinatesy","#edit-request-first-generationpower"]).mask("########9V##",{translation:{V:{pattern:/[\,]/},"#":{pattern:/[0-9]/,optional:!0}}})})),window.getEngineerData=function(){var e=i(t().mark((function e(r){var n,i,a,o,u,l,s,c,d,v,f,h,p,m,g,y;return t().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=document.querySelector("#edit-request-first-managertitle"),i=document.querySelector("#edit-request-first-managerregistration"),a=document.querySelector("#edit-request-first-managerregistrationstate"),o=document.querySelector("#edit-request-first-manageremail"),u=document.querySelector("#edit-request-first-managerphone"),l=document.querySelector("#edit-request-first-managercellphone"),s=document.querySelector("#edit-request-first-managercep"),c=document.querySelector("#edit-request-first-manageraddress"),d=document.querySelector("#edit-request-first-managernumber"),v=document.querySelector("#edit-request-first-managerneighborhood"),f=document.querySelector("#edit-request-first-managercity"),h=document.querySelector("#edit-request-first-managerstate"),p=[n,i,a,o,u,l,s,c,d,v,f,h],m={name:r.value},e.next=16,fetch(url_get_engineer_data,{method:"POST",headers:{"X-CSRF-TOKEN":$("meta[name='csrf-token']").attr("content"),"Content-Type":"application/json",Accept:"application/json"},body:JSON.stringify(m)});case 16:return g=e.sent,e.next=19,g.json();case 19:if(y=e.sent,!g.ok){e.next=22;break}return e.abrupt("return",{result:y,manager:{title:p[0],registration:p[1],registrationState:p[2],email:p[3],phone:p[4],cellphone:p[5],cep:p[6],address:p[7],number:p[8],neighborhood:p[9],city:p[10],state:p[11]}});case 22:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),window.validateRGShippingDate=function(e){var t=document.querySelector("#edit-first-clientrgshipping-feedback-request");return isNaN(e.value)?e.value.split("-").length<3?(t.innerText="Formato inválido.",a(e,!1),o(t,!1),!1):e.value.split("-")[0]<2e3?(t.innerText="Preencha com o ano a partir de ".concat(2e3,"."),a(e,!1),o(t,!1),!1):e.value.length<8?(t.innerText="Mínimo de ".concat(8," caracteres."),a(e,!1),o(t,!1),!1):(t.innerText="Formato aceito.",a(e,!0),o(t,!0),!0):(t.innerText="",a(e,!0),o(t,!0),!0)},window.validatePhone=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:10,r=e.id.split("-")[3],n=document.querySelector("#edit-first-".concat(r,"-feedback-request"));return 0!==e.value.length?0===e.value.length?(n.innerText="Preencha o campo.",a(e,!1),o(n,!1),!1):e.value.replace(/[^0-9]/g,"").length!==t?(n.innerText="O telefone deve conter ".concat(t," dígitos."),a(e,!1),o(n,!1),!1):(n.innerText="Formato aceito.",a(e,!0),o(n,!0),!0):(n.innerText="",a(e,!0),o(n,!0),!0)},window.validateDouble=function(e){var t=e.id.split("-")[3],r=document.querySelector("#edit-first-".concat(t,"-feedback-request"));return 0!==e.value.length||e.hasAttribute("required")?0===e.value.length?(r.innerText="Preencha o campo.",a(e,!1),o(r,!1),!1):0===Number(e.value)?(r.innerText="Digite um valor maior que zero.",a(e,!1),o(r,!1),!1):","===e.value.substr(-1)?(r.innerText="Digite um valor válido.",a(e,!1),o(r,!1),!1):(r.innerText="Formato aceito.",a(e,!0),o(r,!0),!0):(r.innerText="",a(e,!0),o(r,!0),!0)},window.validateResponsibleEmail=function(e){var t=document.querySelector("#edit-first-responsibleemail-feedback-request");return 0!==e.value.length?0===e.value.length?(t.innerText="Preencha o campo.",a(e,!1),o(t,!1),!1):/^[a-z0-9._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/.test(e.value)?(t.innerText="Formato aceito.",a(e,!0),o(t,!0),!0):(t.innerText="Formato inválido.",a(e,!1),o(t,!1),!1):(t.innerText="",a(e,!0),o(t,!0),!0)},window.validateInput=function(e,t){var r=e.closest(".form-group").lastElementChild;return 0!==e.value.length||e.hasAttribute("required")?0===e.value.length?(r.innerText="Preencha o campo.",a(e,!1),o(r,!1),!1):e.value.length<t?(r.innerText="Mínimo de ".concat(t,1===t?" caractere.":" caracteres."),a(e,!1),o(r,!1),!1):(r.innerText="Formato aceito.",a(e,!0),o(r,!0),!0):(r.innerText="",a(e,!0),o(r,!0),!0)},window.validateSelect=function(){var e=i(t().mark((function e(r){var n,i;return t().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(n=r.closest(".form-group").lastElementChild,0!==r.selectedIndex){e.next=8;break}return n.innerText="Escolha uma opção.",a(r,!1),o(n,!1),e.abrupt("return",!1);case 8:if("managername"!==r.id.split("-")[3]){e.next=59;break}return r.setAttribute("disabled",!0),e.next=12,getEngineerData(r);case 12:if(!(i=e.sent).result.user_status){e.next=33;break}return i.manager.title.value=i.result.engineer_data.title,i.manager.registration.value=i.result.engineer_data.registration,i.manager.registrationState.value=i.result.engineer_data.registration_state,i.manager.email.value=i.result.engineer_data.email,i.manager.phone.value=i.result.engineer_data.phone,i.manager.cellphone.value=i.result.engineer_data.cellphone,i.manager.cep.value=i.result.engineer_data.cep,i.manager.address.value=i.result.engineer_data.address,i.manager.number.value=i.result.engineer_data.number,i.manager.neighborhood.value=i.result.engineer_data.neighborhood,i.manager.city.value=i.result.engineer_data.city,i.manager.state.value=i.result.engineer_data.state,r.removeAttribute("disabled"),n.innerText="Formato aceito.",a(r,!0),o(n,!0),e.abrupt("return",!0);case 33:if(i.manager.title.value="",i.manager.registration.value="",i.manager.registrationState.value="",i.manager.email.value="",i.manager.phone.value="",i.manager.cellphone.value="",i.manager.cep.value="",i.manager.address.value="",i.manager.number.value="",i.manager.neighborhood.value="",i.manager.city.value="",i.manager.state.value="",r.removeAttribute("disabled"),!i.result.status){e.next=53;break}return n.innerText="O(a) usuário(a) está bloqueado(a) no sistema.",a(r,!1),o(n,!1),e.abrupt("return",!1);case 53:return n.innerText="O(a) usuário(a) não encontrado(a) no sistema.",a(r,!1),o(n,!1),e.abrupt("return",!1);case 57:e.next=63;break;case 59:return n.innerText="Formato aceito.",a(r,!0),o(n,!0),e.abrupt("return",!0);case 63:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),window.submitFormEditRequestTypeFirst=i(t().mark((function e(){var r,n,i,a,o,u,l,s,c,d,v,f,h,p,m,g,y,w,q,b,S,x,k,T,L,_,I,E,P,O,$,F,j,N,D,C,A,G,R,M,z,V,B,K,Y,H,J,X,Q,U,W,Z,ee,te,re,ne,ie,ae,oe,ue,le,se,ce,de,ve,fe,he,pe,me,ge,ye,we,qe,be,Se,xe,ke,Te,Le,_e,Ie,Ee;return t().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=document.querySelector("#form-edit-request-type-first"),i=document.querySelector("#edit-request-first-clientrg"),a=document.querySelector("#edit-request-first-clientrgshipping"),o=document.querySelector("#edit-request-first-clientcellphone"),u=document.querySelector("#edit-request-first-clientphone"),l=document.querySelector("#edit-request-first-activity"),s=document.querySelector("#edit-request-first-loads"),c=document.querySelector("#edit-request-first-loadsdetails"),d=document.querySelector("#edit-request-first-subgroup"),v=document.querySelector("#edit-request-first-class"),f=document.querySelector("#edit-request-first-conntype"),h=document.querySelector("#edit-request-first-ucpower"),p=document.querySelector("#edit-request-first-ucload"),m=document.querySelector("#edit-request-first-ucbreaker"),g=document.querySelector("#edit-request-first-ucpd"),y=document.querySelector("#edit-request-first-extension"),w=document.querySelector("#edit-request-first-transformerid"),q=document.querySelector("#edit-request-first-coordinatesx"),b=document.querySelector("#edit-request-first-coordinatesy"),S=document.querySelector("#edit-request-first-responsiblename"),x=document.querySelector("#edit-request-first-responsiblephone"),k=document.querySelector("#edit-request-first-responsibleemail"),T=document.querySelector("#edit-request-first-managername"),L=document.querySelector("#edit-request-first-generationtype"),_=document.querySelector("#edit-request-first-generationdetails"),I=document.querySelector("#edit-request-first-generationframework"),E=document.querySelector("#edit-request-first-generationpower"),P=document.querySelector("#edit-request-first-generationok"),O=document.querySelector("#edit-request-first-generationvoltage"),$=document.querySelector("#edit-request-first-art"),F=document.querySelector("#edit-request-first-diagram"),j=document.querySelector("#edit-request-first-memo"),N=document.querySelector("#edit-request-first-compliance"),D=document.querySelector("#edit-request-first-participants"),C=document.querySelector("#edit-request-first-instrument"),A=document.querySelector("#edit-request-first-aneel"),G=document.querySelector("#edit-request-first-link"),R=document.querySelector("#edit-request-first-pattern"),M=document.querySelector("#edit-request-first-rent"),z=document.querySelector("#edit-request-first-procuration"),V=document.querySelector("#edit-request-first-condominium"),B=0===i.value.length||window.validateInput(i,7),K=0===a.value.length||window.validateRGShippingDate(a),Y=!(!o.hasAttribute("disabled")&&0!==o.value.length)||window.validatePhone(o,11),H=!(!u.hasAttribute("disabled")&&0!==u.value.length)||window.validatePhone(u,10),J=0===l.value.length||window.validateSelect(l),X=0===s.value.length||window.validateSelect(s),Q=0===c.value.length||window.validateInput(c,2),U=window.validateInput(d,1),W=window.validateSelect(v),Z=window.validateSelect(f),ee=0===h.value.length||window.validateDouble(h),te=0===p.value.length||window.validateDouble(p),re=window.validateDouble(m),ne=0===g.value.length||window.validateDouble(g),ie=window.validateInput(y,2),ae=0===w.value.length||window.validateInput(w,2),oe=0===q.value.length||window.validateDouble(q),ue=0===b.value.length||window.validateDouble(b),le=0===S.value.length||window.validateInput(S,2),se=0===x.value.length||window.validatePhone(x,11),ce=0===k.value.length||window.validateResponsibleEmail(k),e.next=64,window.validateSelect(T);case 64:de=e.sent,ve=window.validateInput(L,2),fe=0===_.value.length||window.validateInput(_,2),he=window.validateInput(I,2),pe=0===E.value.length||window.validateDouble(E),me=0===P.value.length||window.validateInput(P,2),ge=0===O.value.length||window.validateInput(O,2),ye=0===$.value.length||window.validateInput($,2),we=0===F.value.length||window.validateInput(F,2),qe=0===j.value.length||window.validateInput(j,2),be=0===N.value.length||window.validateInput(N,2),Se=0===D.value.length||window.validateInput(D,2),xe=0===C.value.length||window.validateInput(C,2),ke=0===A.value.length||window.validateInput(A,2),Te=0===G.value.length||window.validateInput(G,2),Le=0===R.value.length||window.validateInput(R,2),_e=0===M.value.length||window.validateInput(M,2),Ie=0===z.value.length||window.validateInput(z,2),Ee=0===V.value.length||window.validateInput(V,2),r=!!B&&(!!K&&(!!Y&&(!!H&&(!!J&&(!!X&&(!!Q&&(!!U&&(!!W&&(!!Z&&(!!ee&&(!!te&&(!!re&&(!!ne&&(!!ie&&(!!ae&&(!!oe&&(!!ue&&(!!le&&(!!se&&(!!ce&&(!!de&&(!!ve&&(!!fe&&(!!he&&(!!pe&&(!!me&&(!!ge&&(!!ye&&(!!we&&(!!qe&&(!!be&&(!!Se&&(!!xe&&(!!ke&&(!!Te&&(!!Le&&(!!_e&&(!!Ie&&!!Ee)))))))))))))))))))))))))))))))))))))),null!==document.querySelector(".is-invalid")&&document.querySelector(".is-invalid").focus(),r&&n.submit();case 86:case"end":return e.stop()}}),e)})))})()})();