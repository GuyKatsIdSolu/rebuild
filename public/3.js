(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[3],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Navigation.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/layout/Navigation.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _apis_User__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../apis/User */ "./resources/js/apis/User.js");
/* harmony import */ var _apis_Api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../apis/Api */ "./resources/js/apis/Api.js");
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
  props: ['creator', 'user'],
  watch: {
    $route: function $route(newVal, oldVal) {
      // watch it
      if (this.$route.meta.authOnly) {
        this.isAdminPage = true;
      } else {
        this.isAdminPage = false;
      }
    }
  },
  data: function data() {
    return {
      isLoggedIn: false,
      isAdminPage: false
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$root.$on("login", function () {
      _this.isLoggedIn = true;
    });

    if (this.$route.meta.authOnly) {
      this.isAdminPage = true;
    }

    this.isLoggedIn = !!localStorage.getItem("auth");
    this.$root.isLoggedIn = this.isLoggedIn;

    if (this.isLoggedIn) {
      _apis_Api__WEBPACK_IMPORTED_MODULE_1__["default"].get("/api/user").then(function (response) {})["catch"](function (res) {
        localStorage.removeItem("auth");
        _this.isLoggedIn = false;

        _this.$router.push({
          name: "Home"
        });
      });
    }
  },
  methods: {
    logout: function logout() {
      var _this2 = this;

      _apis_User__WEBPACK_IMPORTED_MODULE_0__["default"].logout().then(function () {
        localStorage.removeItem("auth");
        _this2.isLoggedIn = false;

        _this2.$router.push({
          name: "Home"
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.router-link-exact-active {\n  color: #ffffff !important;\n  transition: all 0.25s;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./Navigation.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Navigation.vue?vue&type=template&id=5dc3b6fe&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/layout/Navigation.vue?vue&type=template&id=5dc3b6fe& ***!
  \********************************************************************************************************************************************************************************************************************/
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
    "div",
    [
      _vm.isAdminPage
        ? _c("sidebar", { attrs: { creator: _vm.creator, user: _vm.user } })
        : _vm._e(),
      _vm._v(" "),
      _c("div", { staticClass: "header" }, [
        _vm.isLoggedIn && !_vm.isAdminPage
          ? _c("div", { staticClass: "view-as-visitor" }, [
              _c("i", { staticClass: "fas fa-info-circle" }),
              _vm._v("Viewing as a visitor"),
              _c(
                "a",
                {
                  attrs: { href: "" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      return _vm.$router.push("/admin")
                    }
                  }
                },
                [_c("span", { staticClass: "done" }, [_vm._v("Done")])]
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        !_vm.isAdminPage
          ? _c("div", { staticClass: "top-header" }, [
              _c("div", { staticClass: "left" }, [
                _c(
                  "a",
                  {
                    attrs: { href: "" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        return _vm.$router.push("/about-me")
                      }
                    }
                  },
                  [_vm._v("About me")]
                ),
                _vm._v(" "),
                _c("span", [_vm._v("|")]),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    attrs: { href: "" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        return _vm.$router.push("/track-order")
                      }
                    }
                  },
                  [_vm._v("Track Order")]
                ),
                _vm._v(" "),
                _c("span", [_vm._v("|")]),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    attrs: {
                      target: "_blank",
                      href: "https://buy.support.artigram.me/"
                    }
                  },
                  [_vm._v("Help")]
                )
              ]),
              _vm._v(" "),
              _c("span", [
                _vm._v("\n          Free Domestic Shipping\n        ")
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _c(
          "nav",
          {
            staticClass: "navbar navbar-expand no-padding",
            class: [_vm.isAdminPage ? "admin" : ""]
          },
          [
            _c(
              "div",
              { staticClass: "container no-padding" },
              [
                !_vm.isAdminPage
                  ? _c(
                      "div",
                      { staticClass: "navbar-header" },
                      [
                        _vm.$route.name != "ImageUploader"
                          ? _c(
                              "router-link",
                              {
                                staticClass: "navbar-brand",
                                attrs: { to: "/" }
                              },
                              [
                                _vm.isAdminPage
                                  ? _c("img", {
                                      attrs: {
                                        src:
                                          _vm.$root.storageUrl +
                                          "/images/artigram-logo.png"
                                      }
                                    })
                                  : _c("img", {
                                      attrs: {
                                        src:
                                          _vm.$root.storageUrl +
                                          "/images/artigram-logo-square.png"
                                      }
                                    })
                              ]
                            )
                          : _vm._e()
                      ],
                      1
                    )
                  : _vm._e(),
                _vm._v(" "),
                !_vm.isAdminPage
                  ? _c("div", { staticClass: "dropdown show" }, [
                      _c(
                        "a",
                        {
                          staticClass: "dropdown-toggle",
                          attrs: {
                            href: "#",
                            id: "aboutDropdown",
                            role: "button",
                            "data-toggle": "dropdown"
                          }
                        },
                        [_vm._v("\n            About\n          ")]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass: "dropdown-menu",
                          attrs: { "aria-labelledby": "aboutDropdown" }
                        },
                        [
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: {
                                target: "_blank",
                                href: "/image-usage-rights"
                              }
                            },
                            [_vm._v("Usage rights")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: {
                                target: "_blank",
                                href: "https://artigram.me/about-us"
                              }
                            },
                            [_vm._v("About")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: {
                                target: "_blank",
                                href:
                                  "https://sell.support.artigram.me/article/242-shipping-terms"
                              }
                            },
                            [_vm._v("Shipping info")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: {
                                target: "_blank",
                                href: "https://artigram.me/contact-us-today/"
                              }
                            },
                            [_vm._v("Contact")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: { target: "_blank", href: "/disclaimer" }
                            },
                            [_vm._v("Disclaimer")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: {
                                target: "_blank",
                                href: "https://artigram.me/privacy-policy-2"
                              },
                              on: {
                                click: function($event) {
                                  return _vm.$ma.trackEvent({
                                    action: "account-page",
                                    properties: {
                                      feature: "privacy",
                                      type: "clicked"
                                    }
                                  })
                                }
                              }
                            },
                            [_vm._v("Privacy Policy")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: {
                                target: "_blank",
                                href: "https://artigram.me/terms-of-use"
                              },
                              on: {
                                click: function($event) {
                                  return _vm.$ma.trackEvent({
                                    action: "account-page",
                                    properties: {
                                      feature: "terms-of-use",
                                      type: "clicked"
                                    }
                                  })
                                }
                              }
                            },
                            [_vm._v("Terms of use")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: {
                                target: "_blank",
                                href: "https://buy.support.artigram.me/"
                              }
                            },
                            [_vm._v("Support")]
                          )
                        ]
                      )
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.isLoggedIn && _vm.user
                  ? _c("div", { staticClass: "avatar-box" }, [
                      _c(
                        "a",
                        {
                          staticClass: "dropdown-toggle",
                          attrs: {
                            id: "avatarDropdown",
                            role: "button",
                            "data-hover": "dropdown"
                          }
                        },
                        [
                          _c("div", { staticClass: "avatar" }, [
                            _vm._v(
                              _vm._s(
                                _vm.user.first_name.charAt(0) +
                                  _vm.user.last_name.charAt(0)
                              )
                            )
                          ])
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass: "dropdown-menu",
                          attrs: { "aria-labelledby": "avatarDropdown" }
                        },
                        [
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: { href: "" },
                              on: {
                                click: function($event) {
                                  $event.preventDefault()
                                  return _vm.$router.push("/admin/edit")
                                }
                              }
                            },
                            [_vm._v("Edit profile")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: { target: "_blank" }
                            },
                            [_vm._v("Store Settings")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: { target: "_blank" }
                            },
                            [_vm._v("Orders")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: { target: "_blank" }
                            },
                            [_vm._v("Earnings")]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-item",
                              attrs: {
                                target: "_blank",
                                href: "https://artigram.me/support"
                              },
                              on: {
                                click: function($event) {
                                  return _vm.$ma.trackEvent({
                                    action: "header",
                                    properties: {
                                      feature: "support",
                                      type: "clicked"
                                    }
                                  })
                                }
                              }
                            },
                            [_vm._v("Support")]
                          ),
                          _vm._v(" "),
                          _vm.isLoggedIn
                            ? _c(
                                "a",
                                {
                                  staticClass: "dropdown-item",
                                  attrs: { href: "#" },
                                  on: {
                                    click: function($event) {
                                      $event.preventDefault()
                                      return _vm.logout($event)
                                    }
                                  }
                                },
                                [_vm._v("Logout")]
                              )
                            : _vm._e()
                        ]
                      )
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _c("cart", { ref: "cart" })
              ],
              1
            )
          ]
        )
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/layout/Navigation.vue":
/*!*******************************************************!*\
  !*** ./resources/js/components/layout/Navigation.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Navigation_vue_vue_type_template_id_5dc3b6fe___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Navigation.vue?vue&type=template&id=5dc3b6fe& */ "./resources/js/components/layout/Navigation.vue?vue&type=template&id=5dc3b6fe&");
/* harmony import */ var _Navigation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Navigation.vue?vue&type=script&lang=js& */ "./resources/js/components/layout/Navigation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Navigation_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Navigation.vue?vue&type=style&index=0&lang=css& */ "./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Navigation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Navigation_vue_vue_type_template_id_5dc3b6fe___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Navigation_vue_vue_type_template_id_5dc3b6fe___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/layout/Navigation.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/layout/Navigation.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/layout/Navigation.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Navigation.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Navigation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css& ***!
  \****************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./Navigation.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Navigation.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/layout/Navigation.vue?vue&type=template&id=5dc3b6fe&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/layout/Navigation.vue?vue&type=template&id=5dc3b6fe& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_template_id_5dc3b6fe___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Navigation.vue?vue&type=template&id=5dc3b6fe& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Navigation.vue?vue&type=template&id=5dc3b6fe&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_template_id_5dc3b6fe___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Navigation_vue_vue_type_template_id_5dc3b6fe___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);