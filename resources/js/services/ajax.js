/**
 * js/services/ajax.js
 */

let $       = require('jquery');
let meta    = require('Services/meta');
let notify  = require('Services/notify');

let routing = require('Services/routing');

let ajax = {};


function ajaxRequest(method, route, data, multipart, additionalProperties) {

    additionalProperties = (typeof additionalProperties === "undefined") ? {} : additionalProperties;

    return new Promise((resolve, reject) => {

        url = routing.getUrl(route);

        let ajaxData = {
            url     : url,
            dataType: 'json',
            data    : data,
            type    : method,
            success : function(response) {
                if (!response.success) {

                    if (response.errors.length > 0) {
                        notify.error(response.errors.join("\n"));
                    }

                    reject(response);
                }

                resolve(response);
            },
            error   : function(obj, error, exc) {
                // Probably want to do something more than this
                reject();
            },
            complete: function() {

            }
        };

        if (multipart) {
            ajaxData.processData = false;
            ajaxData.contentType = false;
        }

        ajaxData = Object.assign(ajaxData, additionalProperties);

        $.ajax(ajaxData);

    });
}

let csrf_token;

ajax.post = function(route, data, multipart, additionalProperties) {

    csrf_token = (csrf_token) ? csrf_token : meta.get('csrf-token');

    data = (data) ? data : {};

    /**
     * Ensure the csrf token is sent back with POST requests
     */
    if (data instanceof FormData) {

        if (!data.get('_token')) {
            data.append('_token', csrf_token);
        }

    } else {
        data._token = csrf_token;
    }

    return ajaxRequest('POST', route, data, multipart, additionalProperties);
};

ajax.delete = function(route) {
    let data = {
        _method: 'DELETE'
    };

    return ajax.post(route, data);
};

ajax.get = function(route, data) {
    return ajaxRequest('GET', route, data);
};

window.ajax = ajax;

module.exports = ajax;
