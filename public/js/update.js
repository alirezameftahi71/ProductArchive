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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/addUpdate.js":
/*!***********************************!*\
  !*** ./resources/js/addUpdate.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Tag inputs functionalities
tagsManagerHandler('genre', '/api/genres');
tagsManagerHandler('platform', '/api/platforms');
tagsManagerHandler('publisher', '/api/publishers'); // Tagmanager working with typeahead general function

function tagsManagerHandler(id, url) {
  var el = $("#".concat(id));
  var tagMan = el.tagsManager();
  el.typeahead({
    source: function source(query, process) {
      el.addClass('input-loading');
      return $.ajax({
        url: url,
        type: 'GET',
        data: "search=".concat(query),
        dataType: 'JSON',
        cache: false,
        success: function success(e) {
          var newData = [];
          $.each(e, function (_i, item) {
            newData.push(item.name);
          });
          process(newData);
        },
        complete: function complete() {
          el.removeClass('input-loading');
        }
      });
    },
    afterSelect: function afterSelect(item) {
      tagMan.tagsManager('pushTag', item);
    }
  });
}

/***/ }),

/***/ "./resources/js/update.js":
/*!********************************!*\
  !*** ./resources/js/update.js ***!
  \********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _addUpdate_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./addUpdate.js */ "./resources/js/addUpdate.js");
/* harmony import */ var _addUpdate_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_addUpdate_js__WEBPACK_IMPORTED_MODULE_0__);
 // Fill Form with existing data

function fillUpdateForm(game) {
  $('#name').val(game.name);
  $('#released-date').val(game.released_date);
  $('#rate').val(game.rate);
  $('#isDone').val(game.completed || 0);
  game.genres.forEach(function (item) {
    pushIntoTagmanager("genre", item.name);
  });
  game.platforms.forEach(function (item) {
    pushIntoTagmanager("platform", item.name);
  });
  game.publishers.forEach(function (item) {
    pushIntoTagmanager("publisher", item.name);
  });
  $('#desc-box').val(game.description); // displaying the name of cover pic in browse element
  // const dT = new ClipboardEvent('').clipboardData || new DataTransfer(); 
  // dT.items.add(new File(['coverPic'], game.cover_pic.replace('uploads/','')));
  // document.querySelector('#cover-pic').files = dT.files;
} // Push value into tagmanager manually 


function pushIntoTagmanager(id, value) {
  $("#".concat(id)).tagsManager("pushTag", value);
}

fillUpdateForm(game);

/***/ }),

/***/ 2:
/*!**************************************!*\
  !*** multi ./resources/js/update.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Alireza\Documents\Projects\www\product-archive\resources\js\update.js */"./resources/js/update.js");


/***/ })

/******/ });