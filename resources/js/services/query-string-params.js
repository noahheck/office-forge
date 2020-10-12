/**
 * js/services/query-string-params.js
 */

let stringParams = {};

stringParams.setParam = function(parameterName, value) {
    if (history.pushState) {
        let params = new URLSearchParams(window.location.search);
        params.set(parameterName, value);

        let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + params.toString();
        window.history.pushState({path:newUrl},'',newUrl);
    }
}

stringParams.getParam = function(parameterName, defaultValue) {
    let params = new URLSearchParams(window.location.search);

    if (!params.has(parameterName)) {

        return defaultValue;
    }

    return params.get(parameterName);
}

stringParams.getParams = function(parameterName, defaultValue) {
    let params = new URLSearchParams(window.location.search);

    if (!params.has(parameterName)) {

        return defaultValue;
    }

    return params.getAll(parameterName);
}

module.exports = stringParams;
