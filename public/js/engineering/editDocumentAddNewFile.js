window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(e){return new bootstrap.Tooltip(e,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(e){return new bootstrap.Popover(e,{})}))},window.SPMaskBehavior=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(e,n,t,i){t.mask(SPMaskBehavior.apply({},arguments),i)}},window.isInvalidText=function(e,n){var t=$(e).val(),i=!1;return null===t||t.length<n?(i=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),i},window.isInvalidNumber=function(e,n){var t=$(e).val(),i=!1;try{t=parseFloat(t)}catch(n){return i=!0,$(e).addClass("is-invalid"),i}return t<=n||isNaN(t)?(i=!0,$(e).addClass("is-invalid")):$(e).removeClass("is-invalid"),i},window.isValidInput=function(e,n){return $(e).val()&&$(e).val().length>=n?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.isValidCEP=function(e){return $(e).val()&&$(e).val().length==="00000-000".length?($(e).removeClass("is-invalid"),!0):($(e).addClass("is-invalid"),!1)},window.convertHex=function(e,n){var t=e.replace("#","");return 3===t.length&&(t=t[0]+t[0]+t[1]+t[1]+t[2]+t[2]),"rgba("+parseInt(t.substring(0,2),16)+","+parseInt(t.substring(2,4),16)+","+parseInt(t.substring(4,6),16)+","+n/100+")"},window.editDocumentAddNewFile=function(e){e.setAttribute("disabled",!0);var n=e.id.split("-")[5],t=document.querySelector("#modal-edit-generator-documents-".concat(n)),i=document.querySelectorAll("#".concat(t.id," [data-add-new-file]")),a=document.querySelector("#form-add-new-file-".concat(n)),d=i.length+1,o=document.querySelector("#btn-submit-new-file-".concat(n));a.closest(".card").classList.contains("border")||(a.closest(".card").classList.add("border"),a.closest(".card").classList.add("ms-3"),a.closest(".card").classList.add("me-3")),o.setAttribute("disabled",!0),a.insertAdjacentHTML("beforeend",'\n            <div class="row" id="documents-edit-new-'.concat(n,"-").concat(d,'" data-add-new-file>\n                \x3c!-- New File Name --\x3e\n                <div class="col-12 col-md-6 mb-3">\n                    <div class="form-group">\n                        <label for="edit-generator-documents-newfilename-').concat(n,"-").concat(d,'" \n                            class="form-label">\n                            Nome do Novo Arquivo\n                        </label>\n                        <input class="form-control" type="text"\n                            id="edit-generator-documents-newfilename-').concat(n,"-").concat(d,'"\n                            name="generator-documents-new[new-').concat(d,'][name]"\n                            onchange="return window.validateNewFileName(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)"\n                            onblur="return window.validateNewFileName(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)"\n                            onkeyup="return window.validateNewFileName(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)">\n                        <div class="invalid-feedback" \n                            id="edit-documents-newfile-name-feedback-').concat(n,"-").concat(d,'"></div>\n                    </div>\n                </div>\n\n                \x3c!-- New File --\x3e\n                <div class="col-12 col-md-6 mb-3">\n                    <div class="form-group">\n                        <label for="edit-generator-documents-new-').concat(n,"-").concat(d,'" \n                            class="form-label">\n                            Novo Arquivo\n                        </label>\n                        <div class="input-group">\n                            <input class="form-control rounded" type="file"\n                                id="edit-generator-documents-new-').concat(n,"-").concat(d,'"\n                                name="generator-documents-new[new-').concat(d,'][file]"\n                                onchange="return window.validateCreateFile(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)"\n                                onblur="return window.validateCreateFile(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)">\n                            <button type="button"\n                                class="input-group-text btn bg-danger btn-lg text-white rounded ms-4" \n                                id="edit-btn-cancel-new-').concat(n,"-").concat(d,'"\n                                onclick="return window.removeNewFileRow(this)">\n                                <i class="bi bi-x-circle-fill"></i>\n                            </button>\n                        </div>\n                        <div class="invalid-feedback" \n                            id="edit-documents-new-feedback-').concat(n,"-").concat(d,'"></div>\n                    </div>\n                </div>\n            </div>\n        '))};