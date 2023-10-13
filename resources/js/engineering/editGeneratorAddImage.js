window.editGeneratorAddImage = function (el) {
    el.setAttribute("disabled", true);

    const elemId = el.id.split("-")[4];
    const editGeneratorImage = document.querySelector(`#modal-edit-generator-images-${elemId}`);
    const totalGeneratorImages = document.querySelectorAll(`#${editGeneratorImage.id} [data-add-generator-image]`);
    const formAddGeneratorImage = document.querySelector(`#form-edit-generator-images-${elemId}`);
    let indexToInsertGeneratorImage = totalGeneratorImages.length + 1;
    const btnSubmitGeneratorImages = document.querySelector(`#btn-edit-generator-images-${elemId}`);

    if (!formAddGeneratorImage.closest(".card").classList.contains("border")) {
        formAddGeneratorImage.closest(".card").classList.add("border");
        formAddGeneratorImage.closest(".card").classList.add("ms-4");
        formAddGeneratorImage.closest(".card").classList.add("me-4");
    }

    btnSubmitGeneratorImages.setAttribute("disabled", true);

    formAddGeneratorImage.insertAdjacentHTML("beforeend",
        `
            <div class="row" id="edit-generator-images-${elemId}-${indexToInsertGeneratorImage}" 
                data-add-generator-image>
                <!-- Image Name -->
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-group">
                        <label for="edit-generator-image-name-${elemId}-${indexToInsertGeneratorImage}" 
                            class="form-label">
                            Nome da Imagem
                        </label>
                        <input class="form-control" type="text"
                            id="edit-generator-image-name-${elemId}-${indexToInsertGeneratorImage}"
                            name="generator-image[new-${indexToInsertGeneratorImage}][name]"
                            onchange="return window.validateImageName(this), window.handleBtnAddGeneratorImage(this)"
                            onblur="return window.validateImageName(this), window.handleBtnAddGeneratorImage(this)"
                            onkeyup="return window.validateImageName(this), window.handleBtnAddGeneratorImage(this)">
                        <div class="invalid-feedback" 
                            id="edit-image-name-feedback-${elemId}-${indexToInsertGeneratorImage}"></div>
                    </div>
                </div>

                <!-- Image Type -->
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <label for="edit-generator-image-type-${elemId}-${indexToInsertGeneratorImage}"
                            class="form-label">
                            Tipo da Imagem
                        </label>
                        <select class="form-select" 
                            aria-label="edit-generator-image-type-${elemId}-${indexToInsertGeneratorImage}"
                            id="edit-generator-image-type-${elemId}-${indexToInsertGeneratorImage}"
                            name="generator-image[new-${indexToInsertGeneratorImage}][type]"
                            onchange="return window.validateSelect(this), window.handleBtnAddGeneratorImage(this)"
                            onblur="return window.validateSelect(this), window.handleBtnAddGeneratorImage(this)">
                            <option value="" disabled selected>
                                Escolha o tipo da imagem
                            </option>
                            <option value="${generatorImageTypeIndex1}">
                                Vistoria Prévia
                            </option>
                            <option value="${generatorImageTypeIndex2}">
                                Imagens da Instalação
                            </option>
                            <option value="${generatorImageTypeIndex3}">
                                Vistoria Final
                            </option>
                            <option value="${generatorImageTypeIndex4}">
                                Outras Imagens
                            </option>
                        </select>
                        <div class="invalid-feedback"
                            id="edit-image-type-feedback-${elemId}-${indexToInsertGeneratorImage}"></div>
                    </div>
                </div>

                <!-- Generator Image -->
                <div class="col-12 col-md-5 mb-3">
                    <div class="form-group">
                        <label for="edit-generator-image-file-${elemId}-${indexToInsertGeneratorImage}" 
                            class="form-label">
                            Imagem
                        </label>
                        <div class="input-group">
                            <input class="form-control" type="file"
                                id="edit-generator-image-file-${elemId}-${indexToInsertGeneratorImage}"
                                name="generator-image[new-${indexToInsertGeneratorImage}][file]"
                                onchange="return window.validateCreateImage(this), window.handleBtnAddGeneratorImage(this)"
                                onblur="return window.validateCreateImage(this), window.handleBtnAddGeneratorImage(this)">
                            <button type="button"
                                class="input-group-text btn bg-danger btn-lg text-white rounded ms-4" 
                                id="edit-btn-cancel-add-image-${elemId}-${indexToInsertGeneratorImage}"
                                onclick="return window.removeGeneratorImageRow(this)">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" 
                            id="edit-image-file-feedback-${elemId}-${indexToInsertGeneratorImage}"></div>
                    </div>
                </div>
            </div>
        `
    );
}