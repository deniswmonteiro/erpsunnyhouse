window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(n){return new bootstrap.Tooltip(n,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(n){return new bootstrap.Popover(n,{})}))},window.SPMaskBehavior=function(n){return 11===n.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(n,t,e,i){e.mask(SPMaskBehavior.apply({},arguments),i)}},window.isInvalidText=function(n,t){var e=$(n).val(),i=!1;return null===e||e.length<t?(i=!0,$(n).addClass("is-invalid")):$(n).removeClass("is-invalid"),i},window.isInvalidNumber=function(n,t){var e=$(n).val(),i=!1;try{e=parseFloat(e)}catch(t){return i=!0,$(n).addClass("is-invalid"),i}return e<=t||isNaN(e)?(i=!0,$(n).addClass("is-invalid")):$(n).removeClass("is-invalid"),i},window.isValidInput=function(n,t){return $(n).val()&&$(n).val().length>=t?($(n).removeClass("is-invalid"),!0):($(n).addClass("is-invalid"),!1)},window.isValidCEP=function(n){return $(n).val()&&$(n).val().length==="00000-000".length?($(n).removeClass("is-invalid"),!0):($(n).addClass("is-invalid"),!1)},window.convertHex=function(n,t){var e=n.replace("#","");return 3===e.length&&(e=e[0]+e[0]+e[1]+e[1]+e[2]+e[2]),"rgba("+parseInt(e.substring(0,2),16)+","+parseInt(e.substring(2,4),16)+","+parseInt(e.substring(4,6),16)+","+t/100+")"},window.addCCBeneficiary=function(n){n.setAttribute("disabled",!0);var t=n.id.split("-")[3],e=document.querySelector("#address-".concat(t," #cc-beneficiaries-").concat(t)),i=document.querySelectorAll("#".concat(e.id," [data-beneficiary-item]")),c=Number(i[i.length-1].id.split("-")[2])+1;e.insertAdjacentHTML("beforeend",'\n            <div class="accordion-item"\n                id="beneficiary-'.concat(t.toString(),"-").concat(c.toString(),'"\n                data-beneficiary-item>\n                <h2 class="accordion-header d-flex"\n                    id="beneficiary-heading-').concat(t.toString(),"-").concat(c.toString(),'">\n                    <button type="button"\n                        class="accordion-button fw-bold bg-light bg-gradient text-primary rounded-0 rounded-start" \n                        data-bs-toggle="collapse"\n                        data-bs-target="#beneficiary-collapse-').concat(t.toString(),"-").concat(c.toString(),'"\n                        aria-expanded="true"\n                        aria-controls="beneficiary-collapse-').concat(t.toString(),"-").concat(c.toString(),'">\n                        Beneficiária ').concat(c.toString(),'\n                    </button>\n                    <button type="button" class="btn btn-danger rounded-0 rounded-end"\n                        onclick="return window.removeBeneficiaryItem(this)">\n                        <i class="bi bi-trash-fill"></i>\n                    </button>\n                </h2>\n                <div id="beneficiary-collapse-').concat(t.toString(),"-").concat(c.toString(),'"\n                    class="accordion-collapse collapse show" \n                    aria-labelledby="beneficiary-heading-').concat(t.toString(),"-").concat(c.toString(),'"\n                    data-bs-parent="#cc-beneficiaries-').concat(t.toString(),'">\n                    <div class="accordion-body">\n                        <div class="row mt-3 d-none" id="beneficiary-client-').concat(t.toString(),"-").concat(c.toString(),'">\n                            <div class="col-12 mb-4">\n                                <div class="form-check">\n                                    <input class="form-check-input" type="checkbox"\n                                        id="chk-add-beneficiary-client-').concat(t.toString(),"-").concat(c.toString(),'"\n                                        onchange="return window.checkIfAddClientBeneficiary(this)">\n                                    <label class="form-check-label" \n                                        for="chk-add-beneficiary-client-').concat(t.toString(),"-").concat(c.toString(),'">\n                                        Cliente diferente da Geradora?\n                                    </label>\n                                </div>\n                            </div>\n                            <div class="row">\n                                \x3c!-- Beneficiary Client --\x3e\n                                <div class="col-12 col-md-6 mb-3 d-none"\n                                    id="client-beneficiary-').concat(t.toString(),"-").concat(c.toString(),'">\n                                    <div class="form-group">\n                                        <label for="project-beneficiary-client-').concat(t.toString(),"-").concat(c.toString(),'" class="form-label">\n                                            Cliente\n                                        </label>\n                                        <input class="form-control" type="text"\n                                            id="project-beneficiary-client-').concat(t.toString(),"-").concat(c.toString(),'" \n                                            name="project[generator-').concat(t.toString(),"][beneficiaries][address-").concat(c.toString(),'][beneficiary-client]"\n                                            onfocus="return window.autocomplete(this, clients)">\n                                        <div class="invalid-feedback"\n                                            id="client-beneficiary-').concat(t.toString(),"-").concat(c.toString(),'-feedback-project"></div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                        <div class="row">\n                            \x3c!-- Beneficiary Contract Account --\x3e\n                            <div class="col-12 col-md-6 mb-3">\n                                <div id="beneficiary-contract-account-input-').concat(t.toString(),"-").concat(c.toString(),'">\n                                    <div class="form-group">\n                                        <label for="project-cc-beneficiary-input-').concat(t.toString(),"-").concat(c.toString(),'" class="form-label">\n                                            Conta Contrato Beneficiária\n                                        </label>\n                                        <input class="form-control" type="text" \n                                            id="project-cc-beneficiary-input-').concat(t.toString(),"-").concat(c.toString(),'"\n                                            name="project[generator-').concat(t.toString(),"][beneficiaries][address-").concat(c.toString(),'][beneficiary-contract-account]"\n                                            onchange="return window.validateInput(this, 1), window.enableBtnAddBeneficiary(this)"\n                                            onblur="return window.validateInput(this, 1)"\n                                            onkeyup="return window.validateInput(this, 1)"\n                                            maxlength="12"\n                                            data-beneficiary>\n                                        <div class="invalid-feedback" \n                                            id="cc-beneficiary-input-').concat(t.toString(),"-").concat(c.toString(),'-feedback-project"></div>\n                                    </div>\n                                </div>\n                                <div id="beneficiary-contract-account-select-').concat(t.toString(),"-").concat(c.toString(),'">\n                                    <div class="form-group">\n                                        <label for="project-cc-beneficiary-select-').concat(t.toString(),"-").concat(c.toString(),'" class="form-label">\n                                            Conta Contrato Beneficiária\n                                        </label>\n                                        <select class="form-select" \n                                            aria-label="project-cc-beneficiary-select-').concat(t.toString(),"-").concat(c.toString(),'"\n                                            id="project-cc-beneficiary-select-').concat(t.toString(),"-").concat(c.toString(),'"\n                                            name="project[generator-').concat(t.toString(),"][beneficiaries][address-").concat(c.toString(),'][beneficiary-contract-account]"\n                                            onchange="return window.validateSelect(this, 1), window.enableBtnAddBeneficiary(this), window.setDifferentBeneficiaryContractAccount(this)"\n                                            onblur="return window.validateSelect(this, 1), window.setDifferentBeneficiaryContractAccount(this)">\n                                            <option value="" disabled selected>\n                                                Selecione a conta contrato\n                                            </option>\n                                        </select>\n                                        <div class="invalid-feedback"\n                                            id="cc-beneficiary-select-').concat(t.toString(),"-").concat(c.toString(),'-feedback-project"></div>\n                                    </div>\n                                </div>\n                            </div>\n\n                            \x3c!-- Other beneficiary contract account --\x3e\n                            <div class="col-12 col-md-6 mb-3 d-none"\n                                id="other-beneficiary-contract-account-').concat(t.toString(),"-").concat(c.toString(),'">\n                                <div class="form-group">\n                                    <label for="project-other-cc-beneficiary-').concat(t.toString(),"-").concat(c.toString(),'" class="form-label">\n                                        Outra Conta Contrato Beneficiária\n                                    </label>\n                                    <input class="form-control" type="text" \n                                        id="project-other-cc-beneficiary-').concat(t.toString(),"-").concat(c.toString(),'"\n                                        name="project[generator-').concat(t.toString(),"][beneficiaries][address-").concat(c.toString(),'][beneficiary-other-contract-account]"\n                                        onchange="return window.validateInput(this, 1)"\n                                        onblur="return window.validateInput(this, 1)"\n                                        onkeyup="return window.validateInput(this, 1)"\n                                        maxlength="12">\n                                    <div class="invalid-feedback" \n                                        id="cc-other-beneficiary-').concat(t.toString(),"-").concat(c.toString(),'-feedback-project">\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                        <div class="row">\n                            \x3c!-- Consumption Class --\x3e\n                            <div class="col-12 col-md-6 mb-3">\n                                <div class="form-group">\n                                    <label for="project-beneficiary-consumption-class-').concat(t.toString(),"-").concat(c.toString(),'" class="form-label">\n                                        Classe de Consumo\n                                    </label>\n                                    <select class="form-select"\n                                        aria-label="project-beneficiary-consumption-class-').concat(t.toString(),"-").concat(c.toString(),'"\n                                        id="project-beneficiary-consumption-class-').concat(t.toString(),"-").concat(c.toString(),'"\n                                        name="project[generator-').concat(t.toString(),"][beneficiaries][address-").concat(c.toString(),'][beneficiary-consumption-class]"\n                                        onchange="return window.validateSelect(this), window.enableBtnAddBeneficiary(this)"\n                                        onblur="return window.validateSelect(this)"\n                                        data-beneficiary>\n                                        <option value="" disabled selected>\n                                            Escolha a classe de consumo\n                                        </option>\n                                        <option value="').concat(beneficiaryConsumptionClassIndex1,'">\n                                            Residencial\n                                        </option>\n                                        <option value="').concat(beneficiaryConsumptionClassIndex2,'">\n                                            Industrial\n                                        </option>\n                                        <option value="').concat(beneficiaryConsumptionClassIndex3,'">\n                                            Comércio, Serviço e outras atividades\n                                        </option>\n                                        <option value="').concat(beneficiaryConsumptionClassIndex4,'">\n                                            Rural\n                                        </option>\n                                        <option value="').concat(beneficiaryConsumptionClassIndex5,'">\n                                            Poder Público\n                                        </option>\n                                        <option value="').concat(beneficiaryConsumptionClassIndex6,'">\n                                            Iluminação Pública\n                                        </option>\n                                        <option value="').concat(beneficiaryConsumptionClassIndex7,'">\n                                            Serviço Público\n                                        </option>\n                                        <option value="').concat(beneficiaryConsumptionClassIndex8,'">\n                                            Consumo Próprio\n                                        </option>\n                                    </select>\n                                    <div class="invalid-feedback" \n                                        id="beneficiary-consumption-class-').concat(t.toString(),"-").concat(c.toString(),'-feedback-project">\n                                    </div>\n                                </div>\n                            </div>\n\n                            \x3c!-- Rate --\x3e\n                            <div class="col-12 col-md-6 mb-3">\n                                <div class="form-group">\n                                    <label for="project-beneficiary-rate-').concat(t.toString(),"-").concat(c.toString(),'" class="form-label">\n                                        Rateio\n                                    </label>\n                                    <div class="input-group">\n                                        <input class="form-control" type="text"\n                                            id="project-beneficiary-rate-').concat(t.toString(),"-").concat(c.toString(),'"\n                                            name="project[generator-').concat(t.toString(),"][beneficiaries][address-").concat(c.toString(),'][beneficiary-rate]"\n                                            onchange="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this), window.enableBtnAddBeneficiary(this)"\n                                            onblur="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"\n                                            onkeyup="return window.handleBeneficiaryRate(this), window.validateInput(this, 1), window.validateBeneficiaryRate(this)"\n                                            data-beneficiary>\n                                        <span class="input-group-text rounded-end">\n                                            %\n                                        </span>\n                                        <span class="input-group-text bg-secondary text-white ms-4 rounded" \n                                            id="rate-monthly-avg-generation-').concat(t.toString(),"-").concat(c.toString(),'">\n                                        </span>\n                                    </div>\n                                    <div class="invalid-feedback" \n                                        id="beneficiary-rate-').concat(t.toString(),"-").concat(c.toString(),'-feedback-project">\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                        <div class="row">\n                            \x3c!-- Address --\x3e\n                            <div class="col-12 mb-3">\n                                <div class="form-group">\n                                    <label for="project-beneficiary-address-').concat(t.toString(),"-").concat(c.toString(),'" class="form-label">\n                                        Endereço\n                                    </label>\n                                    <input class="form-control" type="text"\n                                        id="project-beneficiary-address-').concat(t.toString(),"-").concat(c.toString(),'"\n                                        name="project[generator-').concat(t.toString(),"][beneficiaries][address-").concat(c.toString(),'][beneficiary-address]"\n                                        onchange="return window.validateInput(this, 2), window.enableBtnAddBeneficiary(this)"\n                                        onblur="return window.validateInput(this, 2)"\n                                        onkeyup="return window.validateInput(this, 2)"\n                                        data-beneficiary>\n                                    <div class="invalid-feedback" \n                                        id="beneficiary-address-').concat(t.toString(),"-").concat(c.toString(),'-feedback-project"></div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        ')),$("#project-cc-beneficiary-input-".concat(t.toString(),"-").concat(c.toString())).mask("0#"),$("#project-other-cc-beneficiary-".concat(t.toString(),"-").concat(c.toString())).mask("0#"),$("#project-beneficiary-rate-".concat(t.toString(),"-").concat(c.toString())).mask("##9V##",{translation:{V:{pattern:/[\,]/},"#":{pattern:/[0-9]/,optional:!0}}});var o=document.querySelector("#address-".concat(t.toString(),' select[id^="project-type"]')),a=document.querySelector("#address-".concat(t.toString(),' div[id^="generator-contract-account-select"]')),r=document.querySelector("#address-".concat(t.toString(),' input[id^="chk-add-generator-client"]')),d=document.querySelector("#address-".concat(t.toString(),' input[id^="project-generator-client"]')),s=document.querySelector("#beneficiary-contract-account-input-".concat(t.toString(),"-").concat(c.toString())),l=document.querySelector("#beneficiary-contract-account-select-".concat(t.toString(),"-").concat(c.toString())),u=document.querySelector("#".concat(e.id," #project-beneficiary-rate-").concat(t.toString(),"-").concat(c.toString())),b=document.querySelectorAll("#".concat(e.id,' input[id^="project-beneficiary-rate"]')),g=Array.from(b).reduce((function(n,t){return n+Number(t.value.replace(",","."))}),0);if(a.classList.contains("d-none"))l.classList.add("d-none"),s.classList.remove("d-none");else{var f=document.querySelector("#project-cc-beneficiary-select-".concat(t.toString(),"-").concat(c.toString()));l.classList.remove("d-none"),s.classList.add("d-none"),r.checked?window.getBeneficiaryClientCredentials(d,c.toString()):window.getBeneficiaryClientContractAccounts(f,contractClientLogin,contractClientPassword)}u.value=(100-g).toLocaleString("pt-br",{maximumFractionDigits:2}),window.validateBeneficiaryRate(u),window.handleBeneficiaryRate(u),window.changeProjectType(o,!0,c.toString())};