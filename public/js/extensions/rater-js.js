(()=>{var t={7757:(t,e,n)=>{t.exports=n(5666)},5666:t=>{var e=function(t){"use strict";var e,n=Object.prototype,r=n.hasOwnProperty,o="function"==typeof Symbol?Symbol:{},i=o.iterator||"@@iterator",a=o.asyncIterator||"@@asyncIterator",c=o.toStringTag||"@@toStringTag";function s(t,e,n){return Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{s({},"")}catch(t){s=function(t,e,n){return t[e]=n}}function u(t,e,n,r){var o=e&&e.prototype instanceof m?e:m,i=Object.create(o.prototype),a=new B(r||[]);return i._invoke=function(t,e,n){var r=f;return function(o,i){if(r===h)throw new Error("Generator is already running");if(r===p){if("throw"===o)throw i;return O()}for(n.method=o,n.arg=i;;){var a=n.delegate;if(a){var c=S(a,n);if(c){if(c===y)continue;return c}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if(r===f)throw r=p,n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r=h;var s=l(t,e,n);if("normal"===s.type){if(r=n.done?p:d,s.arg===y)continue;return{value:s.arg,done:n.done}}"throw"===s.type&&(r=p,n.method="throw",n.arg=s.arg)}}}(t,n,a),i}function l(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(t){return{type:"throw",arg:t}}}t.wrap=u;var f="suspendedStart",d="suspendedYield",h="executing",p="completed",y={};function m(){}function v(){}function g(){}var w={};s(w,i,(function(){return this}));var E=Object.getPrototypeOf,b=E&&E(E(P([])));b&&b!==n&&r.call(b,i)&&(w=b);var x=g.prototype=m.prototype=Object.create(w);function L(t){["next","throw","return"].forEach((function(e){s(t,e,(function(t){return this._invoke(e,t)}))}))}function k(t,e){function n(o,i,a,c){var s=l(t[o],t,i);if("throw"!==s.type){var u=s.arg,f=u.value;return f&&"object"==typeof f&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,a,c)}),(function(t){n("throw",t,a,c)})):e.resolve(f).then((function(t){u.value=t,a(u)}),(function(t){return n("throw",t,a,c)}))}c(s.arg)}var o;this._invoke=function(t,r){function i(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(i,i):i()}}function S(t,n){var r=t.iterator[n.method];if(r===e){if(n.delegate=null,"throw"===n.method){if(t.iterator.return&&(n.method="return",n.arg=e,S(t,n),"throw"===n.method))return y;n.method="throw",n.arg=new TypeError("The iterator does not provide a 'throw' method")}return y}var o=l(r,t.iterator,n.arg);if("throw"===o.type)return n.method="throw",n.arg=o.arg,n.delegate=null,y;var i=o.arg;return i?i.done?(n[t.resultName]=i.value,n.next=t.nextLoc,"return"!==n.method&&(n.method="next",n.arg=e),n.delegate=null,y):i:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,y)}function T(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function I(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function B(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(T,this),this.reset(!0)}function P(t){if(t){var n=t[i];if(n)return n.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,a=function n(){for(;++o<t.length;)if(r.call(t,o))return n.value=t[o],n.done=!1,n;return n.value=e,n.done=!0,n};return a.next=a}}return{next:O}}function O(){return{value:e,done:!0}}return v.prototype=g,s(x,"constructor",g),s(g,"constructor",v),v.displayName=s(g,c,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,g):(t.__proto__=g,s(t,c,"GeneratorFunction")),t.prototype=Object.create(x),t},t.awrap=function(t){return{__await:t}},L(k.prototype),s(k.prototype,a,(function(){return this})),t.AsyncIterator=k,t.async=function(e,n,r,o,i){void 0===i&&(i=Promise);var a=new k(u(e,n,r,o),i);return t.isGeneratorFunction(n)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},L(x),s(x,c,"Generator"),s(x,i,(function(){return this})),s(x,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var n in t)e.push(n);return e.reverse(),function n(){for(;e.length;){var r=e.pop();if(r in t)return n.value=r,n.done=!1,n}return n.done=!0,n}},t.values=P,B.prototype={constructor:B,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(I),!t)for(var n in this)"t"===n.charAt(0)&&r.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var n=this;function o(r,o){return c.type="throw",c.arg=t,n.next=r,o&&(n.method="next",n.arg=e),!!o}for(var i=this.tryEntries.length-1;i>=0;--i){var a=this.tryEntries[i],c=a.completion;if("root"===a.tryLoc)return o("end");if(a.tryLoc<=this.prev){var s=r.call(a,"catchLoc"),u=r.call(a,"finallyLoc");if(s&&u){if(this.prev<a.catchLoc)return o(a.catchLoc,!0);if(this.prev<a.finallyLoc)return o(a.finallyLoc)}else if(s){if(this.prev<a.catchLoc)return o(a.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return o(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,y):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),y},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),I(n),y}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var o=r.arg;I(n)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,n,r){return this.delegate={iterator:P(t),resultName:n,nextLoc:r},"next"===this.method&&(this.arg=e),y}},t}(t.exports);try{regeneratorRuntime=e}catch(t){"object"==typeof globalThis?globalThis.regeneratorRuntime=e:Function("r","regeneratorRuntime = r")(e)}}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var i=e[r]={exports:{}};return t[r](i,i.exports,n),i.exports}n.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return n.d(e,{a:e}),e},n.d=(t,e)=>{for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),window.raterJs({element:document.querySelector("#basic"),starSize:32,rateCallback:function(t,e){this.setRating(t),e()}}),window.raterJs({element:document.querySelector("#step"),rateCallback:function(t,e){this.setRating(t),e()},starSize:32,step:.5}),window.raterJs({element:document.querySelector("#unli1"),rateCallback:function(t,e){this.setRating(t),e()},starSize:32,max:10,step:.5}),window.raterJs({element:document.querySelector("#unli2"),rateCallback:function(t,e){this.setRating(t),e()},starSize:32,max:16,step:.5}),(()=>{"use strict";var t=n(7757),e=n.n(t);function r(t,e,n,r,o,i,a){try{var c=t[i](a),s=c.value}catch(t){return void n(t)}c.done?e(s):Promise.resolve(s).then(r,o)}function o(t){return function(){var e=this,n=arguments;return new Promise((function(o,i){var a=t.apply(e,n);function c(t){r(a,o,i,c,s,"next",t)}function s(t){r(a,o,i,c,s,"throw",t)}c(void 0)}))}}document.getElementById("basic").addEventListener("click",(function(t){Swal.fire("Any fool can use a computer")})),document.getElementById("footer").addEventListener("click",(function(t){Swal.fire({icon:"error",title:"Oops...",text:"Something went wrong!",footer:"<a href>Why do I have this issue?</a>"})})),document.getElementById("title").addEventListener("click",(function(t){Swal.fire("The Internet?","That thing is still around?","question")})),document.getElementById("success").addEventListener("click",(function(t){Swal.fire({icon:"success",title:"Success"})})),document.getElementById("error").addEventListener("click",(function(t){Swal.fire({icon:"error",title:"Error"})})),document.getElementById("warning").addEventListener("click",(function(t){Swal.fire({icon:"warning",title:"Warning"})})),document.getElementById("info").addEventListener("click",(function(t){Swal.fire({icon:"info",title:"Info"})})),document.getElementById("question").addEventListener("click",(function(t){Swal.fire({icon:"question",title:"Question"})})),document.getElementById("text").addEventListener("click",(function(t){Swal.fire({title:"Enter your IP address",input:"text",inputLabel:"Your IP address",showCancelButton:!0})})),document.getElementById("email").addEventListener("click",function(){var t=o(e().mark((function t(n){var r,o;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Swal.fire({title:"Input email address",input:"email",inputLabel:"Your email address",inputPlaceholder:"Enter your email address"});case 2:r=t.sent,(o=r.value)&&Swal.fire("Entered email: ".concat(o));case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()),document.getElementById("url").addEventListener("click",function(){var t=o(e().mark((function t(n){var r,o;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Swal.fire({input:"url",inputLabel:"URL address",inputPlaceholder:"Enter the URL"});case 2:r=t.sent,(o=r.value)&&Swal.fire("Entered URL: ".concat(o));case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()),document.getElementById("password").addEventListener("click",function(){var t=o(e().mark((function t(n){var r,o;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Swal.fire({title:"Enter your password",input:"password",inputLabel:"Password",inputPlaceholder:"Enter your password",inputAttributes:{maxlength:10,autocapitalize:"off",autocorrect:"off"}});case 2:r=t.sent,(o=r.value)&&Swal.fire("Entered password: ".concat(o));case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()),document.getElementById("textarea").addEventListener("click",function(){var t=o(e().mark((function t(n){var r,o;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Swal.fire({input:"textarea",inputLabel:"Message",inputPlaceholder:"Type your message here...",inputAttributes:{"aria-label":"Type your message here"},showCancelButton:!0});case 2:r=t.sent,(o=r.value)&&Swal.fire(o);case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()),document.getElementById("select").addEventListener("click",function(){var t=o(e().mark((function t(n){var r,o;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Swal.fire({title:"Select field validation",input:"select",inputOptions:{Fruits:{apples:"Apples",bananas:"Bananas",grapes:"Grapes",oranges:"Oranges"},Vegetables:{potato:"Potato",broccoli:"Broccoli",carrot:"Carrot"},icecream:"Ice cream"},inputPlaceholder:"Select a fruit",showCancelButton:!0,inputValidator:function(t){return new Promise((function(e){"oranges"===t?e():e("You need to select oranges :)")}))}});case 2:r=t.sent,(o=r.value)&&Swal.fire("You selected: ".concat(o));case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}())})(),document.getElementById("basic").addEventListener("click",(function(){Toastify({text:"This is a toast",duration:3e3}).showToast()})),document.getElementById("background").addEventListener("click",(function(){Toastify({text:"This is a toast",duration:3e3,backgroundColor:"linear-gradient(to right, #00b09b, #96c93d)"}).showToast()})),document.getElementById("close").addEventListener("click",(function(){Toastify({text:"Click close button",duration:3e3,close:!0,backgroundColor:"#4fbe87"}).showToast()})),document.getElementById("top-left").addEventListener("click",(function(){Toastify({text:"This is toast in top left",duration:3e3,close:!0,gravity:"top",position:"left",backgroundColor:"#4fbe87"}).showToast()})),document.getElementById("top-center").addEventListener("click",(function(){Toastify({text:"This is toast in top center",duration:3e3,close:!0,gravity:"top",position:"center",backgroundColor:"#4fbe87"}).showToast()})),document.getElementById("top-right").addEventListener("click",(function(){Toastify({text:"This is toast in top right",duration:3e3,close:!0,gravity:"top",position:"right",backgroundColor:"#4fbe87"}).showToast()})),document.getElementById("bottom-right").addEventListener("click",(function(){Toastify({text:"This is toast in bottom right",duration:3e3,close:!0,gravity:"bottom",position:"right",backgroundColor:"#4fbe87"}).showToast()})),document.getElementById("bottom-center").addEventListener("click",(function(){Toastify({text:"This is toast in bottom center",duration:3e3,close:!0,gravity:"bottom",position:"center",backgroundColor:"#4fbe87"}).showToast()})),document.getElementById("bottom-left").addEventListener("click",(function(){Toastify({text:"This is toast in bottom left",duration:3e3,close:!0,gravity:"bottom",position:"left",backgroundColor:"#4fbe87"}).showToast()}))})();