(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[11],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/ProductsModal.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/ProductsModal.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _apis_Api__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../apis/Api */ "./resources/js/apis/Api.js");
/* harmony import */ var hooper__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! hooper */ "./node_modules/hooper/dist/hooper.esm.js");
/* harmony import */ var hooper_dist_hooper_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! hooper/dist/hooper.css */ "./node_modules/hooper/dist/hooper.css");
/* harmony import */ var hooper_dist_hooper_css__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(hooper_dist_hooper_css__WEBPACK_IMPORTED_MODULE_2__);
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
  props: ['authUser', 'tokenUrl'],
  components: {
    Hooper: hooper__WEBPACK_IMPORTED_MODULE_1__["Hooper"],
    Slide: hooper__WEBPACK_IMPORTED_MODULE_1__["Slide"],
    HooperNavigation: hooper__WEBPACK_IMPORTED_MODULE_1__["Navigation"],
    HooperPagination: hooper__WEBPACK_IMPORTED_MODULE_1__["Pagination"]
  },
  data: function data() {
    return {
      img: 0,
      tags: [],
      duration: 5000,
      store_id: 0,
      showProducts: false,
      galleryObj: {}
    };
  },
  methods: {
    slideTo: function slideTo(index) {
      this.$refs.carousel.slideTo(index);
    },
    isEmpty: function isEmpty(a, b) {
      return Object.keys(this.galleryObj.children_array[a][b]).length > 1;
    },
    deleteTag: function deleteTag(event) {
      var element = event.target;
      var val = $(element).closest('.tag').find('.value').html();
      var index = this.tags.indexOf(val);
      this.tags.splice(index, 1);
    },
    closeEditModal: function closeEditModal() {
      this.$modal.hide('EditModal');
    },
    openModal: function openModal(img) {
      this.img = img;
      this.$modal.show('ProductsModal');
    },
    afterOpen: function afterOpen(event) {
      if (this.$root.isMobile) {
        $('html body .body .edit-modal .v--modal-box.v--modal').height(window.innerHeight);
      }

      var tags = this.img.tags.split("#");
      tags.shift();
      this.tags = tags;
      $.each(tags, function (key, value) {
        $('.edit-image-popup .tags').append('<div class="tag"><span class="value">#' + tags[key] + '</span><span onclick="deleteTag(this)"><i class="fa fa-times"></i></span></div>');
      });
      $('.edit-image-popup').attr('imgID', this.img.id);
      $('.edit-image-popup .store-link').val('https://shop.' + this.$root.dev + 'artigram.me/' + this.img.store_id);
      $('.edit-image-popup .delete_url').attr('href', '/account/delete/' + this.img.id);
      $('.edit-image-popup textarea[name=description]').val(this.img.description);
      $('.edit-image-popup .img-name').val(this.img.name);
      $('.edit-image-popup .img-prev').attr('src', 'https://my.' + this.$root.storageUrl + '/creators_images/' + this.img.id + '/500.jpg');
      $('.edit-image-popup #is_active').prop('checked', true);
      $('.edit-image-popup #isnt_active').prop('checked', false);
      this.getProductPreviews(this.img.store_id);
    },
    beforeOpen: function beforeOpen(event) {
      this.$root.clicked = true;
      this.galleryObj = {};
    },
    beforeClose: function beforeClose(event) {
      this.$root.clicked = false;
      this.showProducts = false;
    },
    getProductPreviews: function getProductPreviews(storeId) {
      var vm = this;
      axios.get('/api/get-product-previews/' + storeId).then(function (response) {
        vm.galleryObj = response.data;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/ProductsModal.vue?vue&type=template&id=1bee324e&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/ProductsModal.vue?vue&type=template&id=1bee324e& ***!
  \**********************************************************************************************************************************************************************************************************************/
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
      staticClass: "edit-modal",
      attrs: {
        name: "ProductsModal",
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
      _c("div", { staticClass: "container edit-image-popup" }, [
        _c(
          "a",
          {
            staticClass: "close",
            on: {
              click: function($event) {
                return _vm.$modal.hide("ProductsModal")
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
        _c("div", { staticClass: "col-md-12 row-1" }, [
          _vm.$root.isMobile
            ? _c("h2", { staticClass: "title" }, [
                _vm._v("\n        Products "),
                _c("span", { staticClass: "id" }, [
                  _vm._v("ID (" + _vm._s(_vm.img.id) + ")")
                ])
              ])
            : _c("h2", { staticClass: "title" }, [
                _vm._v("\n        Image ID " + _vm._s(_vm.img.id) + "\n      ")
              ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "products-box" }, [
          _c(
            "div",
            { staticClass: "row-two", staticStyle: { "margin-top": "-18px" } },
            [
              _c(
                "div",
                { staticStyle: { "margin-bottom": "-20px" } },
                [
                  _c(
                    "hooper",
                    {
                      ref: "carousel",
                      staticStyle: { height: "390px" },
                      attrs: { wheelControl: false, infiniteScroll: true }
                    },
                    [
                      _vm._l(_vm.galleryObj.templates_list, function(
                        template,
                        key,
                        index
                      ) {
                        return _c("slide", { key: key }, [
                          _c(
                            "div",
                            {
                              staticClass: "row cur-box",
                              attrs: {
                                "data-pid": _vm.galleryObj.products_list[key].id
                              }
                            },
                            [
                              _c("div", { staticClass: "col-md-6" }, [
                                _c(
                                  "div",
                                  {
                                    staticClass: "product-preview-box",
                                    staticStyle: {
                                      width: "80%",
                                      "min-height": "250px"
                                    },
                                    attrs: { id: index }
                                  },
                                  [
                                    _c("img", {
                                      attrs: {
                                        src:
                                          _vm.galleryObj.products_list[key]
                                            .preview_url
                                      }
                                    })
                                  ]
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "col-md-6 details" }, [
                                _c("div", { staticClass: "title" }, [
                                  _vm._v(_vm._s(template.title))
                                ]),
                                _vm._v(" "),
                                _c("div", {
                                  staticClass: "desc",
                                  domProps: {
                                    innerHTML: _vm._s(template.html_description)
                                  }
                                }),
                                _vm._v(" "),
                                _c(
                                  "div",
                                  {
                                    staticClass: "col-xs-12 prices",
                                    staticStyle: { "margin-top": "10px" }
                                  },
                                  [
                                    _c("div", { staticClass: "price" }, [
                                      _vm._v("$"),
                                      _c("span", { staticClass: "inpt" }, [
                                        _vm._v(_vm._s(template.price))
                                      ])
                                    ]),
                                    _vm._v(" "),
                                    _c("div", { staticClass: "dis-price" }, [
                                      _vm._v("$"),
                                      _c("span", { staticClass: "inpt" }, [
                                        _vm._v(
                                          _vm._s(
                                            (
                                              (template.price *
                                                (100 -
                                                  _vm.galleryObj.campaign
                                                    .discount_percent)) /
                                              100
                                            ).toFixed(2)
                                          )
                                        )
                                      ])
                                    ])
                                  ]
                                ),
                                _vm._v(" "),
                                _c("div", { staticClass: "prices-page-box" }, [
                                  _vm._v(
                                    "\n                    To edit shop products and set products prices please visit "
                                  ),
                                  _c(
                                    "a",
                                    {
                                      staticStyle: { color: "#C000FF" },
                                      attrs: { href: _vm.tokenUrl }
                                    },
                                    [_vm._v("Store settings page")]
                                  )
                                ])
                              ])
                            ]
                          )
                        ])
                      }),
                      _vm._v(" "),
                      _vm.$root.isMobile
                        ? _c("hooper-pagination", {
                            attrs: { slot: "hooper-addons" },
                            slot: "hooper-addons"
                          })
                        : _vm._e()
                    ],
                    2
                  )
                ],
                1
              ),
              _vm._v(" "),
              !_vm.$root.isMobile
                ? _c(
                    "div",
                    {},
                    [
                      _c(
                        "hooper",
                        {
                          staticStyle: { width: "90%" },
                          attrs: {
                            wheelControl: false,
                            itemsToShow: 4,
                            infiniteScroll: true
                          }
                        },
                        [
                          _vm._l(_vm.galleryObj.templates_list, function(
                            template,
                            key,
                            index
                          ) {
                            return _c("slide", { key: key }, [
                              _c(
                                "div",
                                {
                                  staticClass: "thumbnail-wrapper",
                                  on: {
                                    click: function($event) {
                                      return _vm.slideTo(index)
                                    }
                                  }
                                },
                                [
                                  _c("img", {
                                    staticClass: "thumbnail",
                                    attrs: {
                                      src:
                                        _vm.galleryObj.products_list[key]
                                          .preview_url
                                    }
                                  })
                                ]
                              )
                            ])
                          }),
                          _vm._v(" "),
                          _c("hooper-navigation", {
                            attrs: { slot: "hooper-addons" },
                            slot: "hooper-addons"
                          })
                        ],
                        2
                      )
                    ],
                    1
                  )
                : _vm._e()
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

/***/ "./resources/js/components/admin/ProductsModal.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/admin/ProductsModal.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductsModal_vue_vue_type_template_id_1bee324e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductsModal.vue?vue&type=template&id=1bee324e& */ "./resources/js/components/admin/ProductsModal.vue?vue&type=template&id=1bee324e&");
/* harmony import */ var _ProductsModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductsModal.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/ProductsModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProductsModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductsModal_vue_vue_type_template_id_1bee324e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductsModal_vue_vue_type_template_id_1bee324e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/ProductsModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/ProductsModal.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/admin/ProductsModal.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductsModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductsModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/ProductsModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductsModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/ProductsModal.vue?vue&type=template&id=1bee324e&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/admin/ProductsModal.vue?vue&type=template&id=1bee324e& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductsModal_vue_vue_type_template_id_1bee324e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductsModal.vue?vue&type=template&id=1bee324e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/ProductsModal.vue?vue&type=template&id=1bee324e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductsModal_vue_vue_type_template_id_1bee324e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductsModal_vue_vue_type_template_id_1bee324e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);