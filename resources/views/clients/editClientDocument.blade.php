<div class="col-12 col-md-6 mb-3">
    <label class="form-label" style="font-weight: 600">{{$label}}</label>
    <div class="d-flex align-items-center mb-3" 
        id="client-management-document-{{$type}}">
        <!-- Show the file -->
        <form action="@if ($type == 'socialcontract') {{route('clients_file_view', ['type' => encrypt('social_contract'), 'id' => encrypt($client->id)])}} @else {{route('clients_file_view', ['type' => encrypt($type), 'id' => encrypt($client->id)])}} @endif" 
            method="POST" enctype="multipart/form-data"
            class="mb-0 me-3"
            target="_blank">
            @csrf

            <button type="submit"
                class="btn bg-primary text-white"
                @if ($client->$path == null) disabled @endif>
                <i class="bi bi-file-earmark-image"></i>
            </button>
        </form>

        <!-- Edit the file -->
        <button type="button"
            class="btn bg-warning text-white"
            id="btn-edit-document-{{$type}}"
            onclick="return window.enableEditClientDocumentForm(this)">
            <i class="bi bi-pencil-fill"></i>
        </button>
    </div>

    <div class="d-none" id="edit-client-document-{{$type}}">
        <!-- Update file -->
        <form action="{{route('clients_documents_update', ['type' => encrypt($type), 'id' => encrypt($client->id)])}}"
            method="POST" enctype="multipart/form-data"
            class="mb-0"
            id="form-client-document-{{$type}}"
            onsubmit="return false">
            @csrf

            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" type="file"
                        id="file-{{$type}}" 
                        name="file-{{$type}}"
                        onchange="return window.validateFile(this)"
                        onblur="return window.validateFile(this)">
                    <button type="submit"
                        class="input-group-text btn bg-success text-white @if ($client->$path == null) rounded-end @endif"
                        id="btn-update-document-{{$type}}"
                        onclick="return window.submitFormEditClientDocument(this)"
                        disabled>
                        <i class="bi bi-check-circle-fill"></i>

                        <div class="spinner-border spinner-border-sm text-white d-none"
                            id="btn-update-document-loading-{{$type}}"
                            role="status">
                            <span class="visually-hidden">
                                Loading...
                            </span>
                        </div>
                    </button>

                    <!-- Cancel file editing and hide input -->
                    <button type="button"
                        class="input-group-text btn bg-danger text-white" 
                        id="btn-cancel-edit-{{$type}}"
                        onclick="return window.cancelClientDocumentEdit(this)">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>

                @if ($client->$path != null)
                    <div class="valid-feedback d-block" id="file-{{$type}}-name">
                        <span class="fw-bold">Arquivo atual:</span> {{$client->$name}}
                    </div>
                @endif

                <div class="invalid-feedback" id="file-{{$type}}-feedback"></div>
            </div>
        </form>
    </div>
</div>