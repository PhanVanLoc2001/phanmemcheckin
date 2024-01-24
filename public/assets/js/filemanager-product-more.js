 // In real app replace with:
        // import Flmngr from "flmngr";
        import Flmngr from "https://cdn.skypack.dev/flmngr";

        Flmngr.load({
            apiKey: "pbALgPEI",
            urlFileManager: '/fileManager',
            urlFiles: '/files',
        }, {
            onFlmngrLoaded: () => {
                attachOnClickListenerToButton();
            }
        });

        function selectFiles() {
            Flmngr.open({
                isMultiple: false,
                acceptExtensions: ["png", "jpeg", "jpg", "webp", "gif"],
                onFinish: (files) => {
                    showSelectedImage(files);
                }
            });
        }

        function showSelectedImage(files) {
            let elImages = document.getElementById("images-banner");
            let file = files[0];

            // Create the outer div with the class "row"
            let elOuterDiv = document.createElement("div");
            elOuterDiv.className = "row";
            elImages.appendChild(elOuterDiv);

            // Create the col-11 div and append it to the outer div
            let elCol11Div = document.createElement("div");
            elCol11Div.className = "col-11";
            elOuterDiv.appendChild(elCol11Div);

            // Create the image div with the class "image" and append it to the col-11 div
            let elImageDiv = document.createElement("div");
            elImageDiv.className = "image";
            elCol11Div.appendChild(elImageDiv);

            // Create the image element and append it to the image div
            let elImg = document.createElement("img");
            elImg.src = file.url;
            elImg.alt = "ảnh đại diện";
            elImageDiv.appendChild(elImg);

            // Create the paragraph element and append it to the image div
            let elP = document.createElement("p");
            elP.textContent = file.url;
            elImageDiv.appendChild(elP);

            // Create and update the hidden input element
            let elInput = document.createElement("input");
            elInput.className = "form-control";
            elInput.type = "hidden";
            elInput.name = "prod_feature[]";
            elInput.value = file.url;
            elImageDiv.appendChild(elInput);

            // Create the col div and append it to the outer div
            let elColDiv = document.createElement("div");
            elColDiv.className = "col d-flex align-items-center";
            elOuterDiv.appendChild(elColDiv);

            // Create the delete button and append it to the col div
            let deleteButton = document.createElement("button");
            deleteButton.className = "btn btn-danger delete-image";
            deleteButton.textContent = "-";
            elColDiv.appendChild(deleteButton);
        }

        attachOnClickListenerToButton();

        function attachOnClickListenerToButton() {
            let elBtn = document.getElementById("btn-banner");
            // Style button as ready to be pressed
            elBtn.style.opacity = 1;
            elBtn.style.cursor = "pointer";

            let elLoading = document.getElementById("loading-banner");
            if (elLoading) {
                elLoading.parentElement.removeChild(elLoading);
            }

            // Add a listener for selecting files
            elBtn.addEventListener("click", () => {
                selectFiles();
            });

}
