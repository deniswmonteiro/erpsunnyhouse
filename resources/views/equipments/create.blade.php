<!-- Modal add Product -->
<div class="modal fade w-100 text-black" id="modal-new-product"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Equipamento</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('equipments_store')}}" method="POST"
                    enctype="multipart/form-data"
                    id="form-create-equipment"
                    class="mb-0"
                    onsubmit="return false">
                    @csrf
                    
                    <div class="card">
                        <div class="card-body">
                            <!-- Equipment Type -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-type" class="form-label">
                                            Tipo de Produto
                                        </label>
                                        <select class="form-select" aria-label="create-equipment-type"
                                            id="create-equipment-type"
                                            name="create-equipment-type"
                                            onchange="return window.validateSelect(this), window.changeEquipmentTypeToCreate(this)"
                                            required>
                                            <option value="" disabled selected>
                                                Selecione o tipo de produto
                                            </option>
                                            <option value="{{encrypt('GENERATOR')}}">
                                                Módulo Solar
                                            </option>
                                            <option value="{{encrypt('SOLAR_INVERTER')}}">
                                                Inversor Solar
                                            </option>
                                            <option value="{{encrypt('STRING_BOX')}}">
                                                String Box
                                            </option>
                                            <option value="{{encrypt('CABLE')}}">
                                                Cabo
                                            </option>
                                            <option value="{{encrypt('CONNECTOR')}}">
                                                Conector
                                            </option>
                                            <option value="{{encrypt('OTHER')}}">
                                                Outro
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="equipment-feedback-type-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Item -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-item" class="form-label">
                                            Item
                                        </label>
                                        <input class="form-control" type="text"
                                            id="create-equipment-item"
                                            name="create-equipment-item"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                        <div class="invalid-feedback" id="equipment-feedback-item-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Module -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-module" class="form-label">
                                            Módulo
                                        </label>
                                        <input class="form-control" type="text"
                                            id="create-equipment-module"
                                            name="create-equipment-module"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                        <div class="invalid-feedback" id="equipment-feedback-module-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Producer -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-producer" class="form-label">
                                            Fabricante
                                        </label>
                                        <input class="form-control" type="text"
                                            id="create-equipment-producer"
                                            name="create-equipment-producer"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                        <div class="invalid-feedback" id="equipment-feedback-producer-create"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Model -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-model" class="form-label">
                                            Modelo
                                        </label>
                                        <input class="form-control" type="text"
                                            id="create-equipment-model"
                                            name="create-equipment-model"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                        <div class="invalid-feedback" id="equipment-feedback-model-create"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Generator Power -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-generatorpower" class="form-label">
                                            Potência (W)
                                        </label>
                                        <input class="form-control" type="text"
                                            id="create-equipment-generatorpower"
                                            name="create-equipment-generatorpower"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)">
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-generatorpower-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Inverter Power -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-inverterpower" class="form-label">
                                            Potência (kW)
                                        </label>
                                        <input class="form-control" type="text"
                                            id="create-equipment-inverterpower"
                                            name="create-equipment-inverterpower"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)">
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-inverterpower-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- MPPT -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-mppt" class="form-label">
                                            MPPT
                                        </label>
                                        <input class="form-control" type="text"
                                            id="create-equipment-mppt"
                                            name="create-equipment-mppt"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)">
                                        <div class="invalid-feedback" id="equipment-feedback-mppt-create"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Voltage -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-voltage" class="form-label">
                                            Tensão
                                        </label>
                                        <select class="form-select" aria-label="create-equipment-voltage"
                                            id="create-equipment-voltage"
                                            name="create-equipment-voltage"
                                            onchange="return window.validateSelect(this)"
                                            onblur="return window.validateSelect(this)"
                                            onkeyup="return window.validateSelect(this)">
                                            <option value="" disabled selected>
                                                Selecione a tensão
                                            </option>
                                            <option value="{{encrypt('127')}}">
                                                127 V
                                            </option>
                                            <option value="{{encrypt('220')}}">
                                                220 V
                                            </option>
                                            <option value="{{encrypt('380')}}">
                                                380 V
                                            </option>
                                            <option value="{{encrypt('600')}}">
                                                600 V
                                            </option>
                                            <option value="{{encrypt('800')}}">
                                                800 V
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="equipment-feedback-voltage-create"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Technology -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-technology" class="form-label">
                                            Tecnologia
                                        </label>
                                        <select class="form-select" aria-label="create-equipment-technology"
                                            id="create-equipment-technology"
                                            name="create-equipment-technology"
                                            onchange="return window.validateSelect(this)"
                                            onblur="return window.validateSelect(this)"
                                            onkeyup="return window.validateSelect(this)">
                                            <option value="" disabled selected>
                                                Selecione a tecnologia
                                            </option>
                                            <option value="{{encrypt('MONOCRISTALINO')}}">
                                                Monocristalino
                                            </option>
                                            <option value="{{encrypt('POLICRISTALINO')}}">
                                                Policristalino
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="equipment-feedback-technology-create"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Guarantee -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-guarantee" class="form-label">
                                            Garantia (anos)
                                        </label>
                                        <input class="form-control" type="text"
                                            id="create-equipment-guarantee"
                                            name="create-equipment-guarantee"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)">
                                        <div class="invalid-feedback" id="equipment-feedback-guarantee-create"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Datasheet Upload -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-equipment-datasheet" class="form-label">
                                            Datasheet
                                        </label>
                                        <input class="form-control" type="file"
                                            id="create-equipment-datasheet" 
                                            name="equipment-datasheet"
                                            onchange="return window.validateFile(this)"
                                            onblur="return window.validateFile(this)">
                                        <div class="invalid-feedback" id="equipment-feedback-datasheet-create"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    onclick="return window.clearFormCreateEquipment()">
                    Voltar
                </button>
                <button type="submit" class="btn bg-success text-white d-inline-flex align-items-center"
                    id="btn-create-equipment"
                    onclick="return window.submitFormCreateEquipment(this)">
                    Cadastrar Equipamento

                    <div class="spinner-border spinner-border-sm text-white ms-2 d-none"
                        id="btn-create-equipment-loading"
                        role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>