<div class="col-12 col-md-6 mb-3">
    <div class="form-group">
        <p class="fw-bold mb-2">
            {{$label}}:
        </p>
        <div class="d-flex align-items-center" 
            id="file-management-{{$id}}-{{$gen_key + 1}}">
            <!-- Show file -->
            @if ($generator_document != null && $generator_document_path != null && $generator_document_path != 'NULL')
                <form action="{{route('engineering_project_file_view', ['type' => encrypt($type), 'id' => encrypt($generator_document->id)])}}"
                    method="POST" enctype="multipart/form-data"
                    class="mb-0 me-3"
                    target="_blank">
                    @csrf
                    <button type="submit"
                        class="btn bg-primary text-white">
                        <i class="bi bi-file-earmark-post-fill"></i>
                    </button>
                </form>

                <!-- Edit file -->
                <button type="button"
                    class="btn bg-warning text-white me-3"
                    id="btn-edit-{{$id}}-{{$gen_key + 1}}"
                    onclick="return window.enableEditDocumentForm(this)">
                    <i class="bi bi-pencil-fill"></i>
                </button>

                <!-- Delete file -->
                <form action="{{route('engineering_generator_destroy_document', ['type' => encrypt($type), 'id' => encrypt($generator_document->id)])}}"
                    method="POST"
                    class="mb-0 me-3">
                    @csrf
                    <button type="submit"
                        class="btn bg-danger text-white">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            @endif
        </div>
        <div class="@if ($generator_document != null) d-none @endif" id="file-{{$id}}-{{$gen_key + 1}}">
            <!-- File upload -->
            <form action="{{route('engineering_generator_documents_update', ['type' => encrypt(Str::of($type)->substr(10)), 'id' => encrypt($generator->id)])}}"
                method="POST" enctype="multipart/form-data"
                class="mb-0"
                id="form-document-{{$id}}-{{$gen_key + 1}}">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control" type="file"
                            id="edit-generator-documents-{{$id}}-{{$gen_key + 1}}"
                            name="generator-documents-{{$id}}"
                            onchange="return window.validateEditFile(this)"
                            onblur="return window.validateEditFile(this)"
                            required>
                        <button type="submit"
                            class="input-group-text btn bg-success text-white @if ($generator_document == null)rounded-end @endif"
                            id="btn-update-{{$id}}-{{$gen_key + 1}}"
                            onclick="return window.submitFormUpdateGeneratorDocuments(this)">
                            <i class="bi bi-check-circle-fill"></i>

                            <div class="spinner-border spinner-border-sm text-white d-none"
                                id="btn-update-{{$id}}-loading-{{$gen_key + 1}}"
                                role="status">
                                <span class="visually-hidden">
                                    Loading...
                                </span>
                            </div>
                        </button>

                        <!-- Cancel file editing and hide input -->
                        @if ($generator_document != null)
                            <button type="button"
                                class="input-group-text btn bg-danger text-white" 
                                id="btn-cancel-edit-{{$id}}-{{$gen_key + 1}}"
                                onclick="return window.cancelDocumentEdit(this)">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        @endif
                    </div>

                    <!-- Show the file name if it exists -->
                    @if ($generator_document != null && $generator_document_path != null && $generator_document_path != 'NULL')
                        <div class="valid-feedback d-block" 
                            id="file-{{$id}}-name-{{$gen_key + 1}}">
                            <span class="fw-bold">Arquivo atual:</span>
                            {{$generator_document->$name}}
                        </div>
                    @endif

                    <div class="invalid-feedback" 
                        id="edit-documents-{{$id}}-feedback-{{$gen_key + 1}}"></div>
                </div>
            </form>
        </div>
    </div>
</div>