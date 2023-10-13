window.onload=function(){$("div.alert").delay(4e3).fadeOut(350),[].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']")).map((function(n){return new bootstrap.Tooltip(n,{html:!0})})),[].slice.call(document.querySelectorAll("[data-bs-toggle='popover']")).map((function(n){return new bootstrap.Popover(n,{})}))},window.SPMaskBehavior=function(n){return 11===n.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},spOptions={onKeyPress:function(n,t,e,a){e.mask(SPMaskBehavior.apply({},arguments),a)}},window.isInvalidText=function(n,t){var e=$(n).val(),a=!1;return null===e||e.length<t?(a=!0,$(n).addClass("is-invalid")):$(n).removeClass("is-invalid"),a},window.isInvalidNumber=function(n,t){var e=$(n).val(),a=!1;try{e=parseFloat(e)}catch(t){return a=!0,$(n).addClass("is-invalid"),a}return e<=t||isNaN(e)?(a=!0,$(n).addClass("is-invalid")):$(n).removeClass("is-invalid"),a},window.isValidInput=function(n,t){return $(n).val()&&$(n).val().length>=t?($(n).removeClass("is-invalid"),!0):($(n).addClass("is-invalid"),!1)},window.isValidCEP=function(n){return $(n).val()&&$(n).val().length==="00000-000".length?($(n).removeClass("is-invalid"),!0):($(n).addClass("is-invalid"),!1)},window.convertHex=function(n,t){var e=n.replace("#","");return 3===e.length&&(e=e[0]+e[0]+e[1]+e[1]+e[2]+e[2]),"rgba("+parseInt(e.substring(0,2),16)+","+parseInt(e.substring(2,4),16)+","+parseInt(e.substring(4,6),16)+","+t/100+")"},window.addRequestTransformerItem=function(n){var t=n.id.split("-")[3],e=n.id.split("-")[6],a=document.querySelector("#table-request-".concat(t,"-transformer-").concat(e)),o=document.querySelectorAll("#".concat(a.id," [data-request-").concat(t,"-transformer-item]")).length+1;a.insertAdjacentHTML("beforeend",'\n        <div class="accordion-item"\n            id="request-'.concat(t,"-transformer-item-").concat(e.toString(),"-").concat(o.toString(),'"\n            data-request-').concat(t,'-transformer-item>\n            <h2 class="accordion-header">\n                <button class="accordion-button fw-bold text-primary" type="button"\n                    data-bs-toggle="collapse"\n                    data-bs-target="#item-request-').concat(t,"-transformer-").concat(e.toString(),"-").concat(o.toString(),'"\n                    aria-expanded="true"\n                    aria-controls="item-request-').concat(t,"-transformer-").concat(e.toString(),"-").concat(o.toString(),'">\n                    Item ').concat(o.toString(),'\n                </button>\n            </h2>\n            <div id="item-request-').concat(t,"-transformer-").concat(e.toString(),"-").concat(o.toString(),'"\n                class="accordion-collapse collapse show"\n                data-bs-parent="#table-request-').concat(t,"-transformer-").concat(e.toString(),'">\n                <div class="accordion-body">\n                    <div class="row mt-3">\n                        \x3c!-- Rated Power --\x3e\n                        <div class="col-12 col-lg-4 mb-3">\n                            <div class="form-group">\n                                <label for="request-').concat(t,"-transformer-ratedpower-").concat(e.toString(),"-").concat(o.toString(),'" class="form-label">\n                                    Potência Nominal\n                                </label>\n                                <div class="input-group">\n                                    <input class="form-control" type="text"\n                                        id="request-').concat(t,"-transformer-ratedpower-").concat(e.toString(),"-").concat(o.toString(),'"\n                                        name="request-').concat(t,"[transformer][item--").concat(o.toString(),'][rated-power]"\n                                        onchange="return window.validateDouble(this), window.sumRequestTableField(this)"\n                                        onblur="return window.validateDouble(this), window.sumRequestTableField(this)"\n                                        onkeyup="return window.validateDouble(this), window.sumRequestTableField(this)"\n                                        data-request-').concat(t,'-transformer-sum>\n                                    <span class="input-group-text">\n                                        kVA\n                                    </span>\n                                </div>\n                                <div class="invalid-feedback"\n                                    id="').concat(t,"-transformer-ratedpower-feedback-request-").concat(e.toString(),"-").concat(o.toString(),'"></div>\n                            </div>\n                        </div>\n\n                        \x3c!-- Connection Type --\x3e\n                        <div class="col-12 col-lg-4 mb-3">\n                            <div class="form-group">\n                                <label for="request-').concat(t,"-transformer-connectiontype-").concat(e.toString(),"-").concat(o.toString(),'" class="form-label">\n                                    Tipo de Ligação\n                                </label>\n                                <input class="form-control" type="text"\n                                    id="request-').concat(t,"-transformer-connectiontype-").concat(e.toString(),"-").concat(o.toString(),'"\n                                    value="&Delta;-Y"\n                                    disabled>\n                            </div>\n                        </div>\n\n                        \x3c!-- Transformer Impedance --\x3e\n                        <div class="col-12 col-lg-4 mb-3">\n                            <div class="form-group">\n                                <label for="request-').concat(t,"-transformer-impedance-").concat(e.toString(),"-").concat(o.toString(),'" class="form-label">\n                                    Impedância do Trafo\n                                </label>\n                                <div class="input-group">\n                                    <input class="form-control" type="text"\n                                        id="request-').concat(t,"-transformer-impedance-").concat(e.toString(),"-").concat(o.toString(),'"\n                                        name="request-').concat(t,"[transformer][item-").concat(o.toString(),'][impedance]"\n                                        onchange="return window.validatePercentage(this)"\n                                        onblur="return window.validatePercentage(this)"\n                                        onkeyup="return window.validatePercentage(this)">\n                                    <span class="input-group-text">\n                                        %\n                                    </span>\n                                </div>\n                                <div class="invalid-feedback"\n                                    id="').concat(t,"-transformer-impedance-feedback-request-").concat(e.toString(),"-").concat(o.toString(),'"></div>\n                            </div>\n                        </div>\n                    </div>\n\n                    <div class="row">\n                        \x3c!-- Primary Voltage --\x3e\n                        <div class="col-12 col-lg-4 mb-3">\n                            <div class="form-group">\n                                <label for="request-').concat(t,"-transformer-primaryvoltage-").concat(e.toString(),"-").concat(o.toString(),'" class="form-label">\n                                    Tensão Primária\n                                </label>\n                                <div class="input-group">\n                                    <input class="form-control" type="text"\n                                        id="request-').concat(t,"-transformer-primaryvoltage-").concat(e.toString(),"-").concat(o.toString(),'"\n                                        name="request-').concat(t,"[transformer][item-").concat(o.toString(),'][primary-voltage]"\n                                        onchange="return window.validateDouble(this)"\n                                        onblur="return window.validateDouble(this)"\n                                        onkeyup="return window.validateDouble(this)">\n                                    <span class="input-group-text">\n                                        V\n                                    </span>\n                                </div>\n                                <div class="invalid-feedback"\n                                    id="').concat(t,"-transformer-primaryvoltage-feedback-request-").concat(e.toString(),"-").concat(o.toString(),'"></div>\n                            </div>\n                        </div>\n\n                        \x3c!-- Secondary Voltage --\x3e\n                        <div class="col-12 col-lg-4 mb-3">\n                            <div class="form-group">\n                                <label for="request-').concat(t,"-transformer-secondaryvoltage-").concat(e.toString(),"-").concat(o.toString(),'" class="form-label">\n                                    Tensão Secundária\n                                </label>\n                                <div class="input-group">\n                                    <input class="form-control" type="text"\n                                        id="request-').concat(t,"-transformer-secondaryvoltage-").concat(e.toString(),"-").concat(o.toString(),'"\n                                        name="request-').concat(t,"[transformer][item-").concat(o.toString(),'][secondary-voltage]"\n                                        onchange="return window.validateDouble(this)"\n                                        onblur="return window.validateDouble(this)"\n                                        onkeyup="return window.validateDouble(this)">\n                                    <span class="input-group-text">\n                                        V\n                                    </span>\n                                </div>\n                                <div class="invalid-feedback"\n                                    id="').concat(t,"-transformer-secondaryvoltage-feedback-request-").concat(e.toString(),"-").concat(o.toString(),'"></div>\n                            </div>\n                        </div>\n\n                        \x3c!-- Switch Range --\x3e\n                        <div class="col-12 col-lg-4 mb-3">\n                            <div class="form-group">\n                                <label for="request-').concat(t,"-transformer-switchrange-").concat(e.toString(),"-").concat(o.toString(),'" class="form-label">\n                                    Faixa de Comutador (+ ou - x%)\n                                </label>\n                                <div class="input-group">\n                                    <input class="form-control" type="text"\n                                        id="request-').concat(t,"-transformer-switchrange-").concat(e.toString(),"-").concat(o.toString(),'"\n                                        name="request-').concat(t,"[transformer][item-").concat(o.toString(),'][switch-range]"\n                                        onchange="return window.validatePercentage(this)"\n                                        onblur="return window.validatePercentage(this)"\n                                        onkeyup="return window.validatePercentage(this)">\n                                    <span class="input-group-text">\n                                        %\n                                    </span>\n                                </div>\n                                <div class="invalid-feedback"\n                                    id="').concat(t,"-transformer-switchrange-feedback-request-").concat(e.toString(),"-").concat(o.toString(),'"></div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    ')),$(["input[id^='request-aboveseventyfive-transformer-ratedpower']","input[id^='request-aboveseventyfive-transformer-primaryvoltage']","input[id^='request-aboveseventyfive-transformer-secondaryvoltage']"]).mask("####9V##",{translation:{V:{pattern:/[\,]/},"#":{pattern:/[0-9]/,optional:!0}}}),$(["input[id^='request-aboveseventyfive-transformer-impedance']","input[id^='request-aboveseventyfive-transformer-switchrange']"]).mask("##9V##",{translation:{V:{pattern:/[\,]/},"#":{pattern:/[0-9]/,optional:!0}}})};