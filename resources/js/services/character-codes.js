/**
 * js/services/character-codes.js
 */

let charCodes = {};

charCodes.isControlCode = function(code) {
    let controlCodes = [
        8, 9, 13, 16, 17, 18, 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 91, 92,
        112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 144, 145
    ];

    return controlCodes.indexOf(code) !== -1;
};







module.exports = charCodes;
