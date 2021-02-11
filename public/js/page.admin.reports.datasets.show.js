(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/page.admin.reports.datasets.show"],{

/***/ "./resources/js/app/report/dataset.js":
/*!********************************************!*\
  !*** ./resources/js/app/report/dataset.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * js/app/report/dataset.js
 */
var dataset = {};

dataset.updateFieldsOrder = function (reportId, datasetId, orderedFields) {
  var route = {
    name: "admin.reports.datasets.fields.update-order",
    params: {
      report: reportId,
      dataset: datasetId
    }
  };
  var data = {
    orderedFields: orderedFields
  };
  return ajax.post(route, data);
};

dataset.updateFiltersOrder = function (reportId, datasetId, orderedFilters) {
  var route = {
    name: "admin.reports.datasets.filters.update-order",
    params: {
      report: reportId,
      dataset: datasetId
    }
  };
  var data = {
    orderedFilters: orderedFilters
  };
  return ajax.post(route, data);
};

dataset.updateVisualizationsOrder = function (reportId, datasetId, orderedVisualizations) {
  var route = {
    name: "admin.reports.datasets.visualizations.update-order",
    params: {
      report: reportId,
      dataset: datasetId
    }
  };
  var data = {
    orderedVisualizations: orderedVisualizations
  };
  return ajax.post(route, data);
};

module.exports = dataset;

/***/ }),

/***/ "./resources/js/page/admin/reports/datasets/show.js":
/*!**********************************************************!*\
  !*** ./resources/js/page/admin/reports/datasets/show.js ***!
  \**********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var sortablejs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! sortablejs */ "./node_modules/sortablejs/modular/sortable.esm.js");
/**
 * js/page/admin/reports/datasets/show.js
 */
var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");



var meta = __webpack_require__(/*! Services/meta */ "./resources/js/services/meta.js");

var notify = __webpack_require__(/*! Services/notify */ "./resources/js/services/notify.js");

var dataset = __webpack_require__(/*! App/report/dataset */ "./resources/js/app/report/dataset.js");

$(function () {
  var reportId = meta.get('reportId');
  var datasetId = meta.get('datasetId');
  var fields = document.getElementById('datasetFields');

  if (fields) {
    var fieldSortable = sortablejs__WEBPACK_IMPORTED_MODULE_0__["default"].create(fields, {
      handle: '.sort-handle',
      animation: 150,
      direction: 'vertical',
      onEnd: function onEnd(evt) {
        dataset.updateFieldsOrder(reportId, datasetId, fieldSortable.toArray()).then(function (response) {
          notify.success(response.data.successMessage);
        })["catch"](function (error) {});
      }
    });
  }

  var filters = document.getElementById('datasetFilters');

  if (filters) {
    var filterSortable = sortablejs__WEBPACK_IMPORTED_MODULE_0__["default"].create(filters, {
      handle: '.sort-handle',
      animation: 150,
      direction: 'vertical',
      onEnd: function onEnd(evt) {
        dataset.updateFiltersOrder(reportId, datasetId, filterSortable.toArray()).then(function (response) {
          notify.success(response.data.successMessage);
        })["catch"](function (error) {});
      }
    });
  }

  var visualizations = document.getElementById('datasetVisualizations');

  if (visualizations) {
    var visualizationSortable = sortablejs__WEBPACK_IMPORTED_MODULE_0__["default"].create(visualizations, {
      handle: '.sort-handle',
      animation: 150,
      direction: 'vertical',
      onEnd: function onEnd(evt) {
        dataset.updateVisualizationsOrder(reportId, datasetId, visualizationSortable.toArray()).then(function (response) {
          notify.success(response.data.successMessage);
        })["catch"](function (error) {});
      }
    });
  }
});

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

/***/ 24:
/*!****************************************************************!*\
  !*** multi ./resources/js/page/admin/reports/datasets/show.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/noah/Source/noahheck/office-forge/resources/js/page/admin/reports/datasets/show.js */"./resources/js/page/admin/reports/datasets/show.js");


/***/ })

},[[24,"/js/manifest","/js/vendor"]]]);