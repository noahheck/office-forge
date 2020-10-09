/**
 * js/controllers/form-doc-display_controller.js
 */

import { Controller } from "stimulus"

let $ = require('jquery');

let ajax = require('Services/ajax');

export default class extends Controller {

    static get targets () {
        return [ "displayContainer" ];
    }

    connect() {

    }

    async load(event) {

        event.preventDefault();

        let route = {
            url: event.currentTarget.getAttribute('href')
        };

        let response = await ajax.get(route)

        $(this.displayContainerTarget).html(response.data.content);
        console.log(response);
    }

}
