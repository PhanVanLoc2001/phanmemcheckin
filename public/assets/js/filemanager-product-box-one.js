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

        function attachOnClickListenerToButton() {
            let elBtn = document.getElementById("btn-box");
            // Style button as ready to be pressed
            elBtn.style.opacity = 1;
            elBtn.style.cursor = "pointer";
            let elLoading = document.getElementById("loading-box");
            elLoading.parentElement.removeChild(elLoading);

            // Add a listener for selecting files
            elBtn.addEventListener("click", () => {
                selectFiles();
            });
        }

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
            let elImages = document.getElementById("images-box");
            elImages.innerHTML = "";

            let file = files[0];

            let el = document.createElement("div");
            el.className = "image";
            elImages.appendChild(el);

            let elImg = document.createElement("img");
            elImg.src = file.url;
            elImg.alt = "Image selected in Flmngr";
            el.appendChild(elImg);

            let elP = document.createElement("p");
            elP.textContent = file.url;
            el.appendChild(elP);

            // Create and update the hidden input element
            let elInput = document.createElement("input");
            elInput.className = "form-control";
            elInput.type = "hidden";
            elInput.name = "prod_library";
            elInput.value = file.url;
            el.appendChild(elInput);
        }
