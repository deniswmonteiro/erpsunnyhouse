window.createDocumentAddNewFile = function (el) {
    el.setAttribute("disabled", true);

    const elemId = el.id.split("-")[5];
    const formCreateDocuments = document.querySelector(`#generator-create-documents-${elemId}`);
    const totalNewFile = document.querySelectorAll(`#${formCreateDocuments.id} div[id^="documents-create-new"]`);
    let indexToInsertNewFile = totalNewFile.length + 1;

    formCreateDocuments.insertAdjacentHTML("beforeend",
        `
            <div class="row" id="documents-create-new-${elemId}-${indexToInsertNewFile}">
                <!-- New File Name -->
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="create-generator-documents-newfilename-${elemId}-${indexToInsertNewFile}" 
                            class="form-label">
                            Nome do Novo Arquivo
                        </label>
                        <input class="form-control" type="text"
                            id="create-generator-documents-newfilename-${elemId}-${indexToInsertNewFile}"
                            name="generator-documents-new[new-${indexToInsertNewFile}][name]"
                            onchange="return window.validateNewFileName(this), window.handleBtnAddNewFile(this)"
                            onblur="return window.validateNewFileName(this), window.handleBtnAddNewFile(this)"
                            onkeyup="return window.validateNewFileName(this), window.handleBtnAddNewFile(this)">
                        <div class="invalid-feedback" 
                            id="create-documents-newfile-name-feedback-${elemId}-${indexToInsertNewFile}"></div>
                    </div>
                </div>

                <!-- New File -->
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="create-generator-documents-new-${elemId}-${indexToInsertNewFile}" 
                            class="form-label">
                            Novo Arquivo
                        </label>
                        <div class="input-group">
                            <input class="form-control" type="file"
                                id="create-generator-documents-new-${elemId}-${indexToInsertNewFile}"
                                name="generator-documents-new[new-${indexToInsertNewFile}][file]"
                                onchange="return window.validateCreateFile(this), window.handleBtnAddNewFile(this)"
                                onblur="return window.validateCreateFile(this), window.handleBtnAddNewFile(this)">
                            <button type="button"
                                class="input-group-text btn bg-danger btn-lg text-white rounded ms-4" 
                                id="create-btn-cancel-new-${elemId}-${indexToInsertNewFile}"
                                onclick="return window.removeNewFileRow(this)">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" 
                            id="create-documents-new-feedback-${elemId}-${indexToInsertNewFile}"></div>
                    </div>
                </div>
            </div>
        `
    );
}