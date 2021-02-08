/**
 * js/controllers/drag-drop-file-upload_controller.js
 */

import { Controller } from "stimulus"

let $ = require('jquery');


/**
 * We use this to determine if the drag event is being initiated by dragging an element present on the HTML page. Files
 * dragged in from the OS don't fire the 'dragstart' or 'dragend' events, so we know if these events are fired, they
 * originate from within the page and aren't a file being dragged in for upload
 * @type {boolean}
 */
let browserDrag = false

window.addEventListener('dragstart', (e) => {
    browserDrag = true;
}, false);

window.addEventListener('dragend', (e) => {
    browserDrag = false;
}, false);

window.addEventListener('drop', (e) => {
    browserDrag = false;
}, false);


export default class extends Controller {

    static get targets () {
        return [ "container", "form", "input" ];
    }

    connect() {

        // We use dragTimer to remove the dropzone highlight on a timer because dragleave seems to fire continuously in
        // chromium
        let dragTimer;

        ['dragenter', 'dragover'].forEach(eventName => {
            this.containerTarget.addEventListener(eventName, (e) => {

                if (browserDrag) {

                    return;
                }

                this.highlightDropArea();
                e.preventDefault();

                window.clearTimeout(dragTimer);
            }, false)
        });

        ['dragleave'].forEach(eventName => {
            this.containerTarget.addEventListener(eventName, (e) => {

                dragTimer = setTimeout((e) => {
                    this.unHighlightDropArea();

                }, 25);
            }, false)
        });

        this.containerTarget.addEventListener("drop", (e) => {
            e.preventDefault();

            if (!e.dataTransfer.files.length) {
                this.unHighlightDropArea();

                return;
            }

            this.showUploadingIndicator();

            this.acceptFiles(e.dataTransfer.files);
        });

        let $formTarget = $(this.formTarget);

        this.inputTarget.addEventListener("change", (e) => {
            $formTarget.submit();
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
