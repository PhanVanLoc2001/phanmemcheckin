@extends('layouts.app')
@section('style')
    <script type="module">
        import Flmngr from "https://cdn.skypack.dev/flmngr";

        let fileManagerOpened = false;

        Flmngr.load({
            apiKey: "pbALgPEI",
            urlFileManager: '/fileManager',
            urlFiles: '/files'
        }, {
            onFlmngrLoaded: () => {
                attachFileManager();
                attachOnClickListenerToButton();
            }
        });

        function attachOnClickListenerToButton() {
            let elBtn = document.getElementById("btn");

            // Style button as ready to be pressed
            elBtn.style.opacity = 1;
            elBtn.style.cursor = "pointer";

            elBtn.addEventListener("click", () => {
                attachFileManager();
            });
        }

        function attachFileManager() {
            let elLoading = document.getElementsByClassName("loading-full-screen")[0];

            // Check if the element exists before removing it
            if (elLoading) {
                elLoading.parentElement.removeChild(elLoading);
            }

            Flmngr.open({
                isMultiple: null,
                isMaximized: true,
                showCloseButton: true,
                showMaximizeButton: true,
                hideFiles: [
                    "index.php",
                    ".htaccess",
                    ".htpasswd"
                ],
                hideDirs: [
                    "vendor"
                ],
            });

            fileManagerOpened = true;
        }
    </script>
@endsection
@section('content')
    <style>
        .loading-full-screen {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

        }
    </style>
    <div class="container-p-x flex-grow-1 container-p-y">
        <div class="loading-full-screen">
            <div id="loading">Loading folder listing...</div>
        </div>
        <div id="btn" class="btn btn-primary" style="opacity:0.2;cursor:default">Thư viện</div>
    </div>
@endsection
