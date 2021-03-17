(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[12],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/VideoModal.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/VideoModal.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'VideoModal',
  props: [],
  components: {},
  data: function data() {
    return {};
  },
  methods: {
    playPause: function playPause() {
      var myVideo = $("video")[0]; // or document.getElementById("video1");

      if (myVideo.paused) {
        myVideo.play();
      } else {
        myVideo.pause();
      }
    },
    afterOpen: function afterOpen(event) {},
    beforeOpen: function beforeOpen(event) {
      $('html body.bm-overlay .burger .cross-style').click();
    },
    beforeClose: function beforeClose(event) {}
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/VideoModal.vue?vue&type=template&id=4726f9c6&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/VideoModal.vue?vue&type=template&id=4726f9c6& ***!
  \*******************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "modal",
    {
      staticClass: "video-modal",
      attrs: {
        name: "VideoModal",
        width: "860px",
        height: "710px",
        scrollable: true,
        reset: true
      },
      on: {
        "before-open": _vm.beforeOpen,
        opened: _vm.afterOpen,
        "before-close": _vm.beforeClose
      }
    },
    [
      _c("div", { staticClass: "container" }, [
        _c(
          "a",
          {
            staticClass: "close",
            on: {
              click: function($event) {
                return _vm.$modal.hide("VideoModal")
              }
            }
          },
          [
            _c(
              "svg",
              {
                staticClass: "icon",
                staticStyle: {
                  width: "16px",
                  height: "16px",
                  "vertical-align": "middle",
                  fill: "currentColor",
                  overflow: "hidden"
                },
                attrs: {
                  xmlns: "http://www.w3.org/2000/svg",
                  viewBox: "0 0 1024 1024",
                  version: "1.1"
                }
              },
              [
                _c("path", {
                  attrs: {
                    d:
                      "M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z"
                  }
                })
              ]
            )
          ]
        ),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-12" }, [
          _c("h2", { staticClass: "title" }, [
            _vm._v("\n        Tutorial\n      ")
          ]),
          _vm._v(" "),
          _c("video", { attrs: { controls: "" } }, [
            _c("source", {
              attrs: {
                src:
                  "https://ondema.s3-eu-west-1.amazonaws.com/artigram+video/how+to+work+artigram+account+v3-115-desktop.mp4",
                type: "video/mp4"
              }
            }),
            _vm._v(" "),
            _c("source", { attrs: { src: "movie.ogg", type: "video/ogg" } }),
            _vm._v(
              "\n            Your browser does not support the video tag.\n          "
            )
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticStyle: { width: "100%", "text-align": "center" } },
            [
              _c("button", { on: { click: _vm.playPause } }, [
                _c(
                  "svg",
                  {
                    staticClass: "icon",
                    staticStyle: {
                      width: "1em",
                      height: "1em",
                      "vertical-align": "middle",
                      fill: "currentColor",
                      overflow: "hidden"
                    },
                    attrs: {
                      viewBox: "0 0 1024 1024",
                      version: "1.1",
                      xmlns: "http://www.w3.org/2000/svg"
                    }
                  },
                  [
                    _c("path", {
                      attrs: {
                        d:
                          "M122.112664 953.98846l816.371172-407.954319c0.723477-0.342808 1.411139-0.689708 2.099824-1.051959l1.107217-0.550539 0-0.077771c11.644201-6.757914 19.488867-19.377326 19.488867-33.827433 0-14.452153-7.844665-27.070542-19.488867-33.828456l0-0.228197L120.241037 65.955154c-1.14508-0.649799-2.310625-1.24127-3.51301-1.77646l-2.481518-1.240247-0.230244 0.170892c-4.047176-1.431605-8.41874-2.196015-12.96222-2.196015-21.589714 0-39.096437 17.506722-39.096437 39.096437 0 0.192382 0 0.382717 0 0.593518l0 821.276902 0.01842 0c0.438998 21.210068 17.754363 38.255279 39.078017 38.255279C108.80559 960.13546 116.040365 957.887256 122.112664 953.98846z"
                      }
                    })
                  ]
                ),
                _vm._v(" PLAY\n            ")
              ])
            ]
          )
        ])
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/admin/VideoModal.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/admin/VideoModal.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _VideoModal_vue_vue_type_template_id_4726f9c6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./VideoModal.vue?vue&type=template&id=4726f9c6& */ "./resources/js/components/admin/VideoModal.vue?vue&type=template&id=4726f9c6&");
/* harmony import */ var _VideoModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./VideoModal.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/VideoModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _VideoModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _VideoModal_vue_vue_type_template_id_4726f9c6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _VideoModal_vue_vue_type_template_id_4726f9c6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/VideoModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/VideoModal.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/admin/VideoModal.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_VideoModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./VideoModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/VideoModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_VideoModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/VideoModal.vue?vue&type=template&id=4726f9c6&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/admin/VideoModal.vue?vue&type=template&id=4726f9c6& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VideoModal_vue_vue_type_template_id_4726f9c6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./VideoModal.vue?vue&type=template&id=4726f9c6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/VideoModal.vue?vue&type=template&id=4726f9c6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VideoModal_vue_vue_type_template_id_4726f9c6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VideoModal_vue_vue_type_template_id_4726f9c6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);