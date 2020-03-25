/**
 * js/services/html-encode.js
 */

let encoder = {};

encoder.encode = function(string) {
    return string.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
        return '&#'+i.charCodeAt(0)+';';
    });
};

module.exports = encoder;
