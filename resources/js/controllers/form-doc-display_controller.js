/**
 * js/controllers/form-doc-display_controller.js
 */

import { Controller } from "stimulus"

let $ = require('jquery');

let ajax = require('Services/ajax');

export default class extends Controller {



    static get targets () {
        return [ "displayContainer", "link" ];
    }

    connect() {

    }

    async load(event) {

        event.preventDefault();

        let $target = $(event.currentTarget);

        let formDocId = $target.data('formDocId');

        // FormDoc is currently displayed
        if (formDocId.toString() === this.data.get("currentFormDocId")) {

            return;
        }

        this.data.set("currentFormDocId", formDocId);

        $(this.linkTargets).removeClass('current-item');
        $target.addClass('current-item');

        let route = {
            url: event.currentTarget.getAttribute('href')
        };

        let response = await ajax.get(route)

        $(this.displayContainerTarget).html(response.data.content);

        // I want to revisit this after getting the rest of the mobile-friendly behavior completed
        // Right now, scrolling to the top only looks good when the filter container is always visible. Otherwise, this
        // causes the screen to scroll to the top with the container in view again on the smaller screens and doesn't
        // look or feel right.
        // $(window).scrollTop(0);
    }

}
