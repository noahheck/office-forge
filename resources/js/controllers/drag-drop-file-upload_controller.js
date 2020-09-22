/**
 * js/controllers/drag-drop-file-upload_controller.js
 */

import { Controller } from "stimulus"

let $ = require('jquery');

export default class extends Controller {

    static get targets () {
        return [ "container", "form" ];
    }

    connect() {
        ['dragenter', 'dragover'].forEach(eventName => {
            this.containerTarget.addEventListener(eventName, (e) => {
                this.highlightDropArea();
                e.preventDefault();
            }, false)
        });

        ['dragleave'].forEach(eventName => {
            this.containerTarget.addEventListener(eventName, (e) => {
                this.unHighlightDropArea();
            }, false)
        });

        this.containerTarget.addEventListener("drop", (e) => {
            e.preventDefault();
            this.showUploadingIndicator();

            this.acceptFiles(e.dataTransfer.files);
        });
    }

    showUploadingIndicator() {
        $(this.containerTarget).addClass('files-are-uploading');
    }

    highlightDropArea() {
        $(this.containerTarget).addClass('is-being-dragged-over');
    }

    unHighlightDropArea() {
        $(this.containerTarget).removeClass('is-being-dragged-over');
    }


    acceptFiles(files) {

        let filesLength = files.length;

        if (filesLength < 0) {
            return;
        }

        let $formTarget = $(this.formTarget);

        let filesRead = 0;

        for (var x = 0; x < filesLength; x++) {

            let file = files[x];

            let reader = new FileReader();

            reader.onload = function () {

                let dt = new DataTransfer;
                dt.items.add(new File([reader.result], file.name, {type: file.type}));

                let newInput = $("<input type='file' class='d-none' name='files[]'>");
                newInput[0].files = dt.files;

                $formTarget.append(newInput);

                filesRead++;

                // all files have been read
                if (filesRead === filesLength) {
                    $formTarget.submit();
                }
            };

            reader.readAsArrayBuffer(file);
        }

    }

}
