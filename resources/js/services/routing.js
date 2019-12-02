/**
 * js/services/routing.js
 */

let routing = {};

routing.getUrl = function(route, params) {
    if (typeof route === 'object') {

        if (route.url) {
            return route.url;
        }

        params = (route.params) ? route.params : params;
        route = route.name;
    }

    params = (params) ? params : {};

    return window.route(route, params);
};

module.exports = routing;
