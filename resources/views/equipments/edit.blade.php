<!-- Modal Edit Product -->
<div class="modal fade w-100 text-black" id="modal-edit-equipment-{{$key}}"
    tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="modal">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atualizar Equipamento</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('equipments_update', ['id' => $equipment['id']])}}" method="POST"
                    enctype="multipart/form-data"
                    id="form-edit-equipment-{{$key}}"
                    class="mb-0"
                    onsubmit="return false">
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <!-- Product Type -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-type-{{$key}}" class="form-label">
                                            Tipo de Produto
                                        </label>
                                        <select class="form-select" aria-label="edit-equipment-type-{{$key}}"
                                            id="edit-equipment-type-{{$key}}"
                                            name="edit-equipment-type"
                                            onchange="return window.validateSelect(this), window.changeEquipmentTypeToEdit(this)"
                                            required>
                                            <option value="" disabled selected>
                                                Selecione o tipo de produto
                                            </option>
                                            <option value="{{encrypt('GENERATOR')}}" @if ($equipment['type'] == 'GENERATOR') selected @endif>
                                                Módulo Solar
                                            </option>
                                            <option value="{{encrypt('SOLAR_INVERTER')}}" @if ($equipment['type'] == 'SOLAR_INVERTER') selected @endif>
                                                Inversor Solar
                                            </option>
                                            <option value="{{encrypt('STRING_BOX')}}" @if ($equipment['type'] == 'STRING_BOX') selected @endif>
                                                String Box
                                            </option>
                                            <option value="{{encrypt('CABLE')}}" @if ($equipment['type'] == 'CABLE') selected @endif>
                                                Cabo
                                            </option>
                                            <option value="{{encrypt('CONNECTOR')}}" @if ($equipment['type'] == 'CONNECTOR') selected @endif>
                                                Conector
                                            </option>
                                            <option value="{{encrypt('OTHER')}}" @if ($equipment['type'] == 'OTHER') selected @endif>
                                                Outro
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="equipment-feedback-type-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Item -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-item-{{$key}}" class="form-label">
                                            Item
                                        </label>
                                        <input class="form-control" type="text"
                                            id="edit-equipment-item-{{$key}}"
                                            name="edit-equipment-item"
                                            value="{{$equipment['text']}}"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                        <div class="invalid-feedback" id="equipment-feedback-item-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Module -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-module-{{$key}}" class="form-label">
                                            Módulo
                                        </label>
                                        <input class="form-control" type="text"
                                            id="edit-equipment-module-{{$key}}"
                                            name="edit-equipment-module"
                                            value="{{$equipment['module']}}"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-module-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Producer -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-producer-{{$key}}" class="form-label">
                                            Fabricante
                                        </label>
                                        <input class="form-control" type="text"
                                            id="edit-equipment-producer-{{$key}}"
                                            name="edit-equipment-producer"
                                            value="{{$equipment['producer']}}"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-producer-edit--{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Model -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-model-{{$key}}" class="form-label">
                                            Modelo
                                        </label>
                                        <input class="form-control" type="text"
                                            id="edit-equipment-model-{{$key}}"
                                            name="edit-equipment-model"
                                            value="{{$equipment['model']}}"
                                            onchange="return window.validateInput(this, 2)"
                                            onblur="return window.validateInput(this, 2)"
                                            onkeyup="return window.validateInput(this, 2)">
                                        <div class="invalid-feedback" id="equipment-feedback-model-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Generator Power -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-generatorpower-{{$key}}" class="form-label">
                                            Potência (W)
                                        </label>
                                        <input class="form-control" type="text"
                                            id="edit-equipment-generatorpower-{{$key}}"
                                            name="edit-equipment-generatorpower"
                                            value="{{$equipment['power']}}"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)">
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-generatorpower-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Inverter Power -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-inverterpower-{{$key}}" class="form-label">
                                            Potência (kW)
                                        </label>
                                        <input class="form-control" type="text"
                                            id="edit-equipment-inverterpower-{{$key}}"
                                            name="edit-equipment-inverterpower"
                                            value="{{$equipment['power']}}"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)">
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-inverterpower-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- MPPT -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-mppt-{{$key}}" class="form-label">
                                            MPPT
                                        </label>
                                        <input class="form-control" type="text"
                                            id="edit-equipment-mppt-{{$key}}"
                                            name="edit-equipment-mppt"
                                            value="{{$equipment['mppt']}}"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)">
                                        <div class="invalid-feedback" id="equipment-feedback-mppt-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Voltage -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-voltage-{{$key}}" class="form-label">
                                            Tensão
                                        </label>
                                        <select class="form-select" aria-label="edit-equipment-voltage-{{$key}}"
                                            id="edit-equipment-voltage-{{$key}}"
                                            name="edit-equipment-voltage"
                                            value="{{$equipment['voltage']}}"
                                            onchange="return window.validateSelect(this)"
                                            onblur="return window.validateSelect(this)"
                                            onkeyup="return window.validateSelect(this)">
                                            <option value="" disabled selected>
                                                Selecione a tensão
                                            </option>
                                            <option value="{{encrypt('127')}}" @if ($equipment['voltage'] == '127') selected @endif>
                                                127 V
                                            </option>
                                            <option value="{{encrypt('220')}}" @if ($equipment['voltage'] == '220') selected @endif>
                                                220 V
                                            </option>
                                            <option value="{{encrypt('380')}}" @if ($equipment['voltage'] == '380') selected @endif>
                                                380 V
                                            </option>
                                            <option value="{{encrypt('600')}}" @if ($equipment['voltage'] == '600') selected @endif>
                                                600 V
                                            </option>
                                            <option value="{{encrypt('800')}}" @if ($equipment['voltage'] == '800') selected @endif>
                                                800 V
                                            </option>
                                        </select>
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-voltage-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technology -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-technology-{{$key}}" class="form-label">
                                            Tecnologia
                                        </label>
                                        <select class="form-select" aria-label="edit-equipment-technology-{{$key}}"
                                            id="edit-equipment-technology-{{$key}}"
                                            name="edit-equipment-technology"
                                            value="{{$equipment['technology']}}"
                                            onchange="return window.validateSelect(this)"
                                            onblur="return window.validateSelect(this)"
                                            onkeyup="return window.validateSelect(this)">
                                            <option value="" disabled selected>
                                                Selecione a tecnologia
                                            </option>
                                            <option value="{{encrypt('MONOCRISTALINO')}}" @if ($equipment['technology'] == 'Monocristalino') selected @endif>
                                                Monocristalino
                                            </option>
                                            <option value="{{encrypt('POLICRISTALINO')}}" @if ($equipment['technology'] == 'Policristalino') selected @endif>
                                                Policristalino
                                            </option>
                                        </select>
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-technology-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Guarantee -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-guarantee-{{$key}}" class="form-label">
                                            Garantia (anos)
                                        </label>
                                        <input class="form-control" type="text"
                                            id="edit-equipment-guarantee-{{$key}}"
                                            name="edit-equipment-guarantee"
                                            value="{{$equipment['guarantee']}}"
                                            onchange="return window.validateInput(this, 1)"
                                            onblur="return window.validateInput(this, 1)"
                                            onkeyup="return window.validateInput(this, 1)">
                                        <div class="invalid-feedback"
                                            id="equipment-feedback-guarantee-edit-{{$key}}"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Datasheet Upload -->
                            <div class="row d-none">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="edit-equipment-datasheet-{{$key}}" class="form-label">
                                            Datasheet
                                        </label>
                                        <input class="form-control" type="file"
                                            id="edit-equipment-datasheet-{{$key}}" 
                                            name="equipment-datasheet"
                                            onchange="return window.validateFile(this)"
                                            onblur="return window.validateFile(this)">
                                        
                                        @if ($equipment['datasheet_path'] != null)
                                            <div class="valid-feedback d-block" id="equipment-datasheet-name-{{$key}}">
                                                <span class="fw-bold">Arquivo atual:</span> {{$equipment['datasheet_name']}}
                                            </div>
                                        @endif
                                        <div class="invalid-feedback" id="equipment-feedback-datasheet-edit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn bg-success text-white d-inline-flex align-items-center"
                    id="btn-edit-equipment-{{$key}}"
                    onclick="return window.submitFormEditEquipment(this)">
                    Atualizar Equipamento

                    <div class="spinner-border spinner-border-sm text-white ms-2 d-none"
                        id="btn-edit-equipment-loading-{{$key}}"
                        role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>