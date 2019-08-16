/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/home.js":
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Searchbox filter
$('#searchBox').on('keyup change search', function (e) {
  var value = $(e.currentTarget).val().toLowerCase();
  $('#list-items a').toArray().filter(function (x) {
    return $(x).toggle($(x).text().toLowerCase().indexOf(value) > -1);
  });
}); // Bind to click event of each item in list-items

$('#list-items').on('click', 'a', function (e) {
  $('#list-items').children().removeClass('active');
  $(e.currentTarget).addClass('active'); // Fill the info table and place the photo if exists

  $.ajax({
    url: "/api/games/".concat(e.currentTarget.id),
    type: 'GET',
    data: null,
    dataType: 'JSON',
    cache: false,
    success: function success(e) {
      fillInfoTable(e);
    },
    fail: function fail() {}
  });
}); // Delete a single item

$('#item-delete').on('click', function () {
  $.ajax({
    url: "/api/games/".concat($('#list-items .active').attr('id')),
    type: 'DELETE',
    data: null,
    dataType: 'JSON',
    cache: false,
    success: function success() {
      var _deleteItem = $('#list-items .active');

      var _preItem = _deleteItem.prev();

      var _preItemId = _preItem.attr('id');

      _preItem.addClass('active');

      _deleteItem.remove();

      if (_preItemId != undefined) getProductById(_preItemId, fillInfoTable);else clearInfoTable();
    },
    fail: function fail() {}
  });
});
$('#item-edit').on('click', function () {
  window.location.replace("/edit/".concat(getCurrentProductId()));
}); // Mark first entry on list-items as active on first load

$('#list-items > a:first').addClass('active'); // Fills the info table with the passed data

function fillInfoTable(dataItem) {
  $('#info-table #name').html(dataItem.name);
  $('#info-table #releasedDate').html(dataItem.released_date);
  $('#info-table #rate').html("".concat(dataItem.rate, "/5"));
  $('#info-table #genre').html(joinJsonNames(dataItem.genres));
  $('#info-table #platform').html(joinJsonNames(dataItem.platforms));
  $('#info-table #publisher').html(joinJsonNames(dataItem.publishers));
  $('#cover-pic').attr('src', "/storage/".concat(dataItem.cover_pic));
  $('#description').html(dataItem.description);
} // Clears the info table 


function clearInfoTable() {
  $('#info-table #name').html('Example Product Name');
  $('#info-table #releasedDate').html('YYYY-MM-DD');
  $('#info-table #rate').html('#/5');
  $('#info-table #genre').html('Example Genre(s)');
  $('#info-table #platform').html('Example Platform(s)');
  $('#info-table #publisher').html('Example Company(s)');
  $('#cover-pic').attr('src', '/storage/uploads/default.png');
  $('#description').html('Full Description goes here in multiple lines providing more and detailed information about the product, like story line or history.');
} // Joins each item's name in a list with a separator


function joinJsonNames(arr, separator) {
  var joinedNames = '';
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = arr[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var item = _step.value;
      joinedNames += "".concat(item.name).concat(separator || ', ');
    }
  } catch (err) {
    _didIteratorError = true;
    _iteratorError = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion && _iterator["return"] != null) {
        _iterator["return"]();
      }
    } finally {
      if (_didIteratorError) {
        throw _iteratorError;
      }
    }
  }

  joinedNames = joinedNames.endsWith(', ') ? joinedNames.substr(0, joinedNames.length - 2) : joinedNames;
  return joinedNames;
} // Read the data by passed id


function getProductById(id, successFunc) {
  $.ajax({
    url: "/api/games/".concat(id),
    type: 'GET',
    data: null,
    dataType: 'JSON',
    cache: false,
    success: function success(e) {
      successFunc(e);
    },
    fail: function fail() {}
  });
} // Find the selected product's id


function getCurrentProductId() {
  return $('#list-items .active').attr('id');
}

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/home.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Alireza\Documents\Projects\www\ProductArchive\resources\js\home.js */"./resources/js/home.js");


/***/ })

/******/ });