/**
 * js/component/file-input-field.js
 */

let $ = require('jquery');
let routing = require('Services/routing');


$(() => {

    let fileSearchUrl = routing.getUrl('files.search');

    $('.file-search').selectpicker({
        liveSearch: true
    }).each(function() {

        let $this = $(this);

        let fileTypeId = $this.data('fileTypeId');
        let isRequired = $this[0].hasAttribute('required');

        $this.ajaxSelectPicker({

            ajax: {
                url: fileSearchUrl,
                method: 'GET',
                data: function() {

                    return {
                        search: '{{{q}}}',
                        fileTypeId: fileTypeId
                    };
                }
            },

            preprocessData: function(response) {
                let files = [];

                if (!isRequired) {
                    files.push({
                        value: '',
                        text: ''
                    });
                }

                if (!response.success) {

                    return files;
                }

                for (let file of response.data.files) {

                    files.push({
                        value: file.id,
                        text: file.name,
                        data: {
                            subtext: file.fileType,
                            content: '<div><div class="d-inline-block text-center w-35p">' + file.icon + '</div>' + file.name + '<small class="text-muted">' + file.fileType + '</small></div>'
                        }
                    });
                }

                return files;
            },

            preserveSelectedPosition: 'before'
        });

    });
});
