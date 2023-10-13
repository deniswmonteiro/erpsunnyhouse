window.createGeneratorAddImage = function (el) {
    el.setAttribute("disabled", true);

    const elemId = el.id.split("-")[4];
    const cardCreateGeneratorImages = document.querySelector(`#generator-create-images-${elemId}`);
    const totalImagesFiles = document.querySelectorAll(`#${cardCreateGeneratorImages.id} input[id^="create-generator-image-file-${elemId}"]`);
    let indexToInsertNewImage = totalImagesFiles.length + 1;
    const btnSubmitGeneratorImages = document.querySelector(`#btn-create-generator-images-${elemId}`);

    btnSubmitGeneratorImages.setAttribute("disabled", true);

    cardCreateGeneratorImages.insertAdjacentHTML("beforeend",
        `
            <div class="row" id="create-generator-images-${elemId}-${indexToInsertNewImage}">
                <!-- Image Name -->
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-group">
                        <label for="create-generator-image-name-${elemId}-${indexToInsertNewImage}" 
                            class="form-label">
                            Nome da Imagem
                        </label>
                        <input class="form-control" type="text"
                            id="create-generator-image-name-${elemId}-${indexToInsertNewImage}"
                            name="generator-image[new-${indexToInsertNewImage}][name]"
                            onchange="return window.validateImageName(this), window.handleBtnAddGeneratorImage(this)"
                            onblur="return window.validateImageName(this), window.handleBtnAddGeneratorImage(this)"
                            onkeyup="return window.validateImageName(this), window.handleBtnAddGeneratorImage(this)">
                        <div class="invalid-feedback" 
                            id="create-image-name-feedback-${elemId}-${indexToInsertNewImage}"></div>
                    </div>
                </div>

                <!-- Image Type -->
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <label for="create-generator-image-type-${elemId}-${indexToInsertNewImage}"
                            class="form-label">
                            Tipo da Imagem
                        </label>
                        <select class="form-select" 
                            aria-label="create-generator-image-type-${elemId}-${indexToInsertNewImage}"
                            id="create-generator-image-type-${elemId}-${indexToInsertNewImage}"
                            name="generator-image[new-${indexToInsertNewImage}][type]"
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
                            id="create-image-type-feedback-${elemId}-${indexToInsertNewImage}"></div>
                    </div>
                </div>

                <!-- Generator Image -->
                <div class="col-12 col-md-5 mb-3">
                    <div class="form-group">
                        <label for="create-generator-image-file-${elemId}-${indexToInsertNewImage}" 
                            class="form-label">
                            Imagem
                        </label>
                        <div class="input-group">
                            <input class="form-control" type="file"
                                id="create-generator-image-file-${elemId}-${indexToInsertNewImage}"
                                name="generator-image[new-${indexToInsertNewImage}][file]"
                                onchange="return window.validateCreateImage(this), window.handleBtnAddGeneratorImage(this)"
                                onblur="return window.validateCreateImage(this), window.handleBtnAddGeneratorImage(this)">
                            <button type="button"
                                class="input-group-text btn bg-danger btn-lg text-white rounded ms-4" 
                                id="create-btn-cancel-add-image-${elemId}-${indexToInsertNewImage}"
                                onclick="return window.removeGeneratorImageRow(this)">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" 
                            id="create-image-file-feedback-${elemId}-${indexToInsertNewImage}"></div>
                    </div>
                </div>
            </div>
        `
    );
}