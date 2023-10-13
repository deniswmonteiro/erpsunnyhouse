window.editDocumentAddNewFile = function (el) {
    el.setAttribute("disabled", true);

    const elemId = el.id.split("-")[5];
    const editDocuments = document.querySelector(`#modal-edit-generator-documents-${elemId}`);
    const totalNewFile = document.querySelectorAll(`#${editDocuments.id} [data-add-new-file]`);
    const formCreateNewFile = document.querySelector(`#form-add-new-file-${elemId}`);
    let indexToInsertNewFile = totalNewFile.length + 1;
    const btnSubmitNewFile = document.querySelector(`#btn-submit-new-file-${elemId}`);

    if (!formCreateNewFile.closest(".card").classList.contains("border")) {
        formCreateNewFile.closest(".card").classList.add("border");
        formCreateNewFile.closest(".card").classList.add("ms-3");
        formCreateNewFile.closest(".card").classList.add("me-3");
    }

    btnSubmitNewFile.setAttribute("disabled", true);

    formCreateNewFile.insertAdjacentHTML("beforeend",
        `
            <div class="row" id="documents-edit-new-${elemId}-${indexToInsertNewFile}" data-add-new-file>
                <!-- New File Name -->
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="edit-generator-documents-newfilename-${elemId}-${indexToInsertNewFile}" 
                            class="form-label">
                            Nome do Novo Arquivo
                        </label>
                        <input class="form-control" type="text"
                            id="edit-generator-documents-newfilename-${elemId}-${indexToInsertNewFile}"
                            name="generator-documents-new[new-${indexToInsertNewFile}][name]"
                            onchange="return window.validateNewFileName(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)"
                            onblur="return window.validateNewFileName(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)"
                            onkeyup="return window.validateNewFileName(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)">
                        <div class="invalid-feedback" 
                            id="edit-documents-newfile-name-feedback-${elemId}-${indexToInsertNewFile}"></div>
                    </div>
                </div>

                <!-- New File -->
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="edit-generator-documents-new-${elemId}-${indexToInsertNewFile}" 
                            class="form-label">
                            Novo Arquivo
                        </label>
                        <div class="input-group">
                            <input class="form-control rounded" type="file"
                                id="edit-generator-documents-new-${elemId}-${indexToInsertNewFile}"
                                name="generator-documents-new[new-${indexToInsertNewFile}][file]"
                                onchange="return window.validateCreateFile(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)"
                                onblur="return window.validateCreateFile(this), window.handleBtnAddNewFile(this), window.handleBtnSubmitNewFile(this)">
                            <button type="button"
                                class="input-group-text btn bg-danger btn-lg text-white rounded ms-4" 
                                id="edit-btn-cancel-new-${elemId}-${indexToInsertNewFile}"
                                onclick="return window.removeNewFileRow(this)">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" 
                            id="edit-documents-new-feedback-${elemId}-${indexToInsertNewFile}"></div>
                    </div>
                </div>
            </div>
        `
    );
}