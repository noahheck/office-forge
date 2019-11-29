/**
 * js/component/trix.js
 */


let $    = require('jquery');
let trix = require('./../../../node_modules/trix/dist/trix.js');

// let ajax = require('Services/ajax');
// let notify = require('Services/notify');


// Make top-level heading an h2 element
trix.config.blockAttributes.heading1.tagName = 'h2';

// Add sub-heading as h3 element
let heading2 = $.extend(true, {}, trix.config.blockAttributes.heading1);
heading2.tagName = 'h3';
trix.config.blockAttributes.heading2 = heading2;

// Add underline as inline element
let underline = $.extend(true, {}, trix.config.textAttributes.strike);
underline.tagName = 'u';
trix.config.textAttributes.underline = underline;

// Prevent Trix from injecting it's default toolbar content into our toolbar containers
//   (happens in Chrome sometimes; probably a race condition of some sort)
trix.config.toolbar.getDefaultHTML = function() {
    return "";
};


// Allow adding hr elements
/*addEventListener("trix-action-invoke", event => {
    if (event.actionName === "x-horizontal-rule") {
        const { editor } = event.target;
        const attachment = new trix.Attachment({ content: "<hr>", contentType: "application/vnd.trix.horizontal-rule.html" });
        editor.insertAttachment(attachment);
    }
});*/


$(function() {
    $('trix-editor').on('dragover dragenter', function() {
        $(this).addClass('is-being-dragged-over');
    }).on('dragleave dragend drop', function() {
        $(this).removeClass('is-being-dragged-over');
    });
});

addEventListener("trix-file-accept", function(event) {

    let editor   = event.target;
    let fileType = event.file.type;

    let isImage = fileType.substring(0, 5) === "image";

    if (!isImage) {
        event.preventDefault();
        notify.error("Sorry, this editor can't accept that file");

        return false;
    }


    let acceptsImages = $(editor).data("acceptImages");

    if (!acceptsImages) {
        event.preventDefault();
        notify.error("Sorry, this editor can't accept images");

        return false;
    }
});

addEventListener("trix-attachment-add", async function(event) {

    if (!event.attachment.file) {
        // console.log("Is this re-adding a deleted image?");
    }


    if (event.attachment.file) {

        let attachment = event.attachment;

        let file    = attachment.file;
        let $editor = $(event.target);

        let data = new FormData();

        data.append('Content-Type', file.type);
        data.append('file', file);
        data.append('resource_type', $editor.data('resourceType'));
        data.append('resource_id', $editor.data('resourceId'));
        data.append('resource_temp_id', $editor.data('resourceTempId'));

        let route = {name: 'organization.editor-images.upload'};

        try {
            let progressActions = {
                uploadProgress: function(e) {
                    if (e.lengthComputable) {
                        let completedPercentage = Math.round((e.loaded * 100) / e.total);
                        attachment.setUploadProgress(completedPercentage);
                    }
                }
            };

            let response = await ajax.post(route, data, true, progressActions);

            if (!response.success) {
                attachment.remove();

                return;
            }

            attachment.setAttributes({
                url: response.data.url,
                href: response.data.url
            });
        } catch (e) {

            attachment.remove();
        }
    }
});


addEventListener("trix-attachment-remove", async function(event) {
    /*console.log(event.attachment.getAttributes().url);//.attributes.values.url);
    try {
        let route = {url: event.attachment.getAttributes().url};
        let response = await ajax.delete(route);
        console.log(response);
    }
    catch (Exception) {
        console.log(Exception);
    }*/
});
