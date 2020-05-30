(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.admin.file-types.panels.show"],{

/***/ "./resources/js/app/file-type/panel.js":
/*!*********************************************!*\
  !*** ./resources/js/app/file-type/panel.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/app/file-type/form.js
 */
var ajax = __webpack_require__(/*! Services/ajax */ "./resources/js/services/ajax.js");

var panel = {};

panel.updateFieldsOrder = function (fileTypeId, panelId, fieldsOrder) {
  var route = {
    name: 'admin.file-types.panels.update-field-order',
    params: {
      fileType: fileTypeId,
      panel: panelId
    }
  };
  var data = {
    orderedFields: fieldsOrder
  };
  return ajax.post(route, data);
};

module.exports = panel;

/***/ }),

/***/ "./resources/js/page/admin/file-types/panels/show.js":
/*!***********************************************************!*\
  !*** ./resources/js/page/admin/file-types/panels/show.js ***!
  \***********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var sortablejs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! sortablejs */ "./node_modules/sortablejs/modular/sortable.esm.js");
/**
 * js/page/admin/file-types/forms/show.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");



var meta = __webpack_require__(/*! Services/meta */ "./resources/js/services/meta.js");

var notify = __webpack_require__(/*! Services/notify */ "./resources/js/services/notify.js");

var encoder = __webpack_require__(/*! Services/html-encode */ "./resources/js/services/html-encode.js");

var panel = __webpack_require__(/*! App/file-type/panel */ "./resources/js/app/file-type/panel.js");

function loadFieldOptions(formId) {
  var formFields = meta.get('form_' + formId, []);
  var options = "<option value=''>--</option>";
  formFields.forEach(function (field) {
    options += "<option value='" + field.id + "'>" + encoder.encode(field.label) + "</option>";
  });
  $('#field_id').html(options);
}

$(function () {
  var fileTypeId = meta.get('fileTypeId');
  var panelId = meta.get('panelId');
  var formSelect = $('#form_id');
  formSelect.change(function () {
    loadFieldOptions(formSelect.val());
  });
  loadFieldOptions(formSelect.val());
  var $form = $('#addFieldForm');
  $form.submit(function (event) {
    var fieldSelect = $('#field_id');
    var fieldId = fieldSelect.val();

    if (!fieldId) {
      fieldSelect.attr('required', true);
      event.preventDefault();
      return false;
    }
  });
  var sortable = sortablejs__WEBPACK_IMPORTED_MODULE_0__["default"].create(document.getElementById('panelFields'), {
    handle: '.sort-handle',
    animation: 150,
    direction: 'vertical',
    onEnd: function onEnd(evt) {
      panel.updateFieldsOrder(fileTypeId, panelId, sortable.toArray()).then(function (response) {
        notify.success(response.data.successMessage);
      });
    }
  });
});

/***/ }),

/***/ "./resources/js/services/ajax.js":
/*!***************************************!*\
  !*** ./resources/js/services/ajax.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/services/ajax.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var meta = __webpack_require__(/*! Services/meta */ "./resources/js/services/meta.js");

var notify = __webpack_require__(/*! Services/notify */ "./resources/js/services/notify.js");

var routing = __webpack_require__(/*! Services/routing */ "./resources/js/services/routing.js");

var ajax = {};

function ajaxRequest(method, route, data, multipart, additionalProperties) {
  additionalProperties = typeof additionalProperties === "undefined" ? {} : additionalProperties;
  return new Promise(function (resolve, reject) {
    url = routing.getUrl(route);
    var ajaxData = {
      url: url,
      dataType: 'json',
      data: data,
      type: method,
      success: function success(response) {
        if (!response.success) {
          if (response.errors.length > 0) {
            notify.error(response.errors.join("\n"));
          }

          reject(response);
        }

        resolve(response);
      },
      error: function error(obj, _error, exc) {
        // Probably want to do something more than this
        reject();
      },
      complete: function complete() {}
    };

    if (multipart) {
      ajaxData.processData = false;
      ajaxData.contentType = false;
    }

    ajaxData = Object.assign(ajaxData, additionalProperties);
    $.ajax(ajaxData);
  });
}

var csrf_token;

ajax.post = function (route, data, multipart, additionalProperties) {
  csrf_token = csrf_token ? csrf_token : meta.get('csrf-token');
  data = data ? data : {};
  /**
   * Ensure the csrf token is sent back with POST requests
   */

  if (data instanceof FormData) {
    if (!data.get('_token')) {
      data.append('_token', csrf_token);
    }
  } else {
    data._token = csrf_token;
  } // console.log('Ajax POST');
  // console.log(route);
  // console.log(data);
  // console.log(multipart);


  return ajaxRequest('POST', route, data, multipart, additionalProperties);
};

ajax["delete"] = function (route) {
  var data = {
    _method: 'DELETE'
  };
  return ajax.post(route, data);
};

ajax.get = function (route, data) {
  return ajaxRequest('GET', route, data);
};

window.ajax = ajax;
module.exports = ajax;

/***/ }),

/***/ "./resources/js/services/html-encode.js":
/*!**********************************************!*\
  !*** ./resources/js/services/html-encode.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * js/services/html-encode.js
 */
var encoder = {};

encoder.encode = function (string) {
  return string.replace(/[\u00A0-\u9999<>\&]/gim, function (i) {
    return '&#' + i.charCodeAt(0) + ';';
  });
};

module.exports = encoder;

/***/ }),

/***/ "./resources/js/services/meta.js":
/*!***************************************!*\
  !*** ./resources/js/services/meta.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * js/services/meta.js
 *
 * Loads content from html meta tags with the data-piglet attribute (i.e. those created with the Blade directive)
 * - loads all tags into memory on page load and wraps in the closure to prevent modification
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var metaData = {};
var meta = {};

meta.get = function (name, fallback) {
  return metaData[name] ? metaData[name] : fallback;
};

$(function () {
  $("meta").each(function () {
    var $this = $(this);
    var name = $this.attr('name');
    var content = $this.attr('content');

    if ($this.data('json')) {
      content = JSON.parse(content);
    }

    metaData[name] = content;
  });
});
window.meta = meta;
module.exports = meta;

/***/ }),

/***/ "./resources/js/services/notify.js":
/*!*****************************************!*\
  !*** ./resources/js/services/notify.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * services/notify.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var notify = {};
var $notificationsContainer = '';
$(function () {
  $notificationsContainer = $('#notifications');
});

function addNotification(theme, icon, message, header, timeout, assertive) {
  var attrs = assertive ? 'role="alert" aria-live="assertive"' : 'role="status" aria-live="polite"';
  var toastMarkup = '<div class="toast ' + theme + '" ' + attrs + ' aria-atomic="true">' + '  <div class="toast-body">' + '    <strong class="mr-auto">' + icon + ' ' + header + '</strong>' + '    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">' + '      <span aria-hidden="true">&times;</span>' + '    </button>' + message + '  </div>' + '</div>';
  var $toast = $(toastMarkup);
  $notificationsContainer.append($toast);
  $toast.toast({
    autohide: timeout ? true : false,
    delay: timeout ? timeout : 0
  }).toast('show').on('hidden.bs.toast', function () {
    $toast.remove();
  });
}

notify.success = function (message) {
  var icon = "<span class='toast-icon fas fa-check-circle'></span>";
  addNotification('success', icon, message, '', 3000);
};

notify.info = function (message) {
  var icon = "<span class='toast-icon fas fa-info-circle'></span>";
  addNotification('info', icon, message, '', 10000);
};

notify.warning = function (message) {
  var icon = "<span class='toast-icon fas fa-exclamation-circle'></span>";
  addNotification('warning', icon, message, '', 12000);
};

notify.error = function (message) {
  var icon = "<span class='fas fa-exclamation-triangle'></span>";
  addNotification('error', icon, message, 'Error: ', 0);
};

window.notify = notify;
module.exports = notify;

/***/ }),

/***/ "./resources/js/services/routing.js":
/*!******************************************!*\
  !*** ./resources/js/services/routing.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/**
 * js/services/routing.js
 */
var routing = {};

routing.getUrl = function (route, params) {
  if (_typeof(route) === 'object') {
    if (route.url) {
      return route.url;
    }

    params = route.params ? route.params : params;
    route = route.name;
  }

  params = params ? params : {};
  return window.route(route, params);
};

module.exports = routing;

/***/ }),

/***/ 19:
/*!*****************************************************************!*\
  !*** multi ./resources/js/page/admin/file-types/panels/show.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/admin/file-types/panels/show.js */"./resources/js/page/admin/file-types/panels/show.js");


/***/ })

},[[19,"/js/manifest","/js/vendor"]]]);