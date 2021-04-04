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

/***/ "./resources/js/likes.js":
/*!*******************************!*\
  !*** ./resources/js/likes.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  //投稿毎に設定された.hideクラスが付与されたいいね済、未いいねアイコンどちらかを非表示
  $('.hide').each(function () {
    $(this).hide();
  }); //全投稿のクリックイベントを監視する

  $('.likes_btn').each(function () {
    $(this).on('click', function () {
      //いいねされた投稿ID、ユーザID取得
      var post_id = $(this).children('#post_id').val();
      var user_id = $(this).children('#user_id').val(); //いいねアイコン取得

      var notLiked_icon = $(this).children('.far.fa-heart');
      var liked_icon = $(this).children('.fas.fa-heart');
      $.ajax({
        type: 'GET',
        url: '/likes',
        //web.phpのURLと同じ形にする
        data: {
          'post_id': post_id,
          //ここはサーバーに贈りたい情報。
          'user_id': user_id
        },
        dataType: 'json',
        //json形式で受け取る
        timeout: 900000,
        beforeSend: function beforeSend() {}
      }).done(function (data) {
        //いいねの更新後、いいね済なのか未いいねなのかで処理が以下のように変わる
        //いいね済ならいいね済アイコンを表示、いいね数表示、未いいねアイコン非表示
        if (data['isLiked'] === true) {
          //いいね数表示
          liked_icon.text(data['liked_count']); //いいね済アイコン表示

          liked_icon.show(); //未いいねアイコン非表示

          notLiked_icon.hide();
        } //未いいねなら未いいねアイコンを表示、いいね数表示、いいね済アイコン非表示
        else {
            //いいね数表示
            notLiked_icon.text(data['liked_count']); //未いいねアイコン表示

            notLiked_icon.show(); //いいね済アイコン非表示

            liked_icon.hide();
          }
      }).fail(function () {
        alert("通信に失敗しました");
      });
    });
  });
});

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/likes.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laradocks\work\app\laravel_app\resources\js\likes.js */"./resources/js/likes.js");


/***/ })

/******/ });