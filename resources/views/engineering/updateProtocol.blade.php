<!-- Protocol Create/Update -->
<div class="d-none" id="protocol-form-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}">
    <form action="#" method="POST" id="form-protocol-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}">
        <input type="hidden" id="generator-id-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}" 
            name="generator-id"
            value="{{encrypt($generator->id)}}">
        <input type="hidden" id="protocol-type-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}" 
            name="protocol-type"
            value="{{encrypt($type)}}">
        <!-- Protocol Number -->
        @if ($type != "homologated")
            <div class="row">
                <div class="col-12 mb-1">
                    <div class="form-group">
                        <label for="protocol-number-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}" class="form-label mb-1">
                            Número do Protocolo
                        </label>
                        <input class="form-control" type="text"
                            id="protocol-number-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"
                            name="protocol-number-{{$type}}"
                            @if ($generator->$type != null) value="{{$generator->$type->protocol_number}}" @endif
                            onchange="return window.validateInput(this, 1)"
                            onblur="return window.validateInput(this, 1)"
                            onkeyup="return window.validateInput(this, 1)">
                        <div class="invalid-feedback" 
                            id="protocol-number-feedback-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"></div>
                    </div>
                </div>
            </div>
        @endif
    
        <!-- Protocol Date -->
        <div class="row">
            <div class="col-12 mb-1">
                <div class="form-group">
                    <label for="protocol-date-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"
                        class="form-label mb-1">
                        Data do Protocolo
                    </label>
                    <div class="input-group">
                        <input class="form-control date" type="date"
                            id="protocol-date-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"
                            name="protocol-date-{{$type}}"
                            @if ($generator->$type != null) value="{{$generator->$type->protocol_date}}" @endif
                            min="2000-01-01"
                            onchange="return window.validateProtocolDate(this)"
                            onblur="return window.validateProtocolDate(this)"
                            onkeyup="return window.validateProtocolDate(this)">
                        <div class="invalid-feedback"
                            id="protocol-date-feedback-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Button to cancel protocol edit -->
                <button type="button"
                    class="btn bg-secondary text-white float-end"
                    id="btn-cancel-protocol-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"
                    onclick="return window.cancelEditProtocol(this)">
                    <i class="bi bi-x-circle-fill"></i>
                </button>

                <!-- Button to submit protocol info -->
                <button type="button" 
                    class="btn bg-success text-white float-end"
                    id="btn-save-protocol-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"
                    onclick="return window.formSaveProtocol('form-protocol-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}')">
                    <i class="bi bi-check-circle-fill"></i>

                    <div class="spinner-border spinner-border-sm text-white d-none"
                        id="btn-save-protocol-loading-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"
                        role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Protocol View -->
<div id="protocol-management-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}">
    <!-- Protocol Number -->
    <div class="row">
        <div class="col-12 mb-1">
            <div class="form-group">
                <label class="form-label mb-1">Número do Protocolo</label>
                <p id="protocol-management-number-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}">
                    @if ($generator->$type != null && $type != 'homologated') {{$generator->$type->protocol_number}}
                    @else &mdash;
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Protocol Date -->
    <div class="row">
        <div class="col-12 mb-1">
            <div class="form-group">
                <label class="form-label mb-1">Data do Protocolo</label>
                <p id="protocol-management-date-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}">
                    @if ($generator->$type != null) {{date('d/m/Y', strtotime($generator->$type->protocol_date))}}
                    @else &mdash;
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Deadline -->
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="form-label mb-1">Prazo:</label>
                <p id="protocol-management-deadline-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}">
                    @if ($generator->$type != null && $type != 'issued' && $type != 'homologated')
                        @switch ($type)
                            @case ('submission')
                                @if (strtotime(date('Y-m-d', strtotime('+3 days', strtotime($generator->$type->protocol_date)))) < strtotime(date('Y-m-d')))
                                    <span class="text-danger fw-bold">
                                        {{date('d/m/Y', strtotime('+3 days', strtotime($generator->$type->protocol_date)))}}
                                    </span>
                                @else
                                    <span>
                                        {{date('d/m/Y', strtotime('+3 days', strtotime($generator->$type->protocol_date)))}}
                                    </span>
                                @endif
                                @break;
                            
                            @case ('feedback')
                                @if (strtotime(date('Y-m-d', strtotime('+15 days', strtotime($generator->$type->protocol_date)))) < strtotime(date('Y-m-d')))
                                    <span class="text-danger fw-bold">
                                        {{date('d/m/Y', strtotime('+15 days', strtotime($generator->$type->protocol_date)))}}
                                    </span>
                                @else
                                    <span>
                                        {{date('d/m/Y', strtotime('+15 days', strtotime($generator->$type->protocol_date)))}}
                                    </span>
                                @endif
                                @break;
                            
                            @case ('provisional')
                                @if (strtotime(date('Y-m-d', strtotime('+3 days', strtotime($generator->$type->protocol_date)))) < strtotime(date('Y-m-d')))
                                    <span class="text-danger fw-bold">
                                        {{date('d/m/Y', strtotime('+3 days', strtotime($generator->$type->protocol_date)))}}
                                    </span>
                                @else
                                    <span>
                                        {{date('d/m/Y', strtotime('+3 days', strtotime($generator->$type->protocol_date)))}}
                                    </span>
                                @endif
                                @break;

                            @case ('survey')
                                @if (strtotime(date('Y-m-d', strtotime('+7 days', strtotime($generator->$type->protocol_date)))) < strtotime(date('Y-m-d')))
                                    <span class="text-danger fw-bold">
                                        {{date('d/m/Y', strtotime('+7 days', strtotime($generator->$type->protocol_date)))}}
                                    </span>
                                @else
                                    <span>
                                        {{date('d/m/Y', strtotime('+7 days', strtotime($generator->$type->protocol_date)))}}
                                    </span>
                                @endif
                                @break;
                        @endswitch
                    @else 
                        &mdash;
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- Button to delete a protocol -->
            @if ($generator->$type != null)
                <a href="{{route('engineering_project_destroy_protocol', ['id' => encrypt($generator->$type->id), 'type' => encrypt($type)])}}"
                    class="btn bg-danger text-white float-end"
                    id="btn-delete-protocol-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}">
                    <i class="bi bi-trash-fill"></i>
                </a>
            @endif

            <!-- Button to edit a protocol -->
            <button type="button"
                class="btn bg-warning text-white float-end"
                id="btn-edit-protocol-{{$type}}-{{$key + 1}}-{{$gen_key + 1}}"
                onclick="return window.enableEditProtocolForm(this)">
                <i class="bi bi-pencil-fill"></i>
            </button>
        </div>
    </div>
</div>