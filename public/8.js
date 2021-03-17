(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/EditModal.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/EditModal.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
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
  name: 'EditModal',
  props: ['creator'],
  components: {
    Hooper: hooper__WEBPACK_IMPORTED_MODULE_1__["Hooper"],
    Slide: hooper__WEBPACK_IMPORTED_MODULE_1__["Slide"],
    HooperNavigation: hooper__WEBPACK_IMPORTED_MODULE_1__["Navigation"]
  },
  data: function data() {
    return {
      img: 0,
      name: '',
      description: '',
      tags: [],
      categories: [],
      duration: 5000,
      store_id: 0,
      showProducts: false,
      originalDetails: [],
      products: {},
      templates: {},
      prices: {}
    };
  },
  methods: {
    slideTo: function slideTo(index) {
      this.$refs.carousel.slideTo(index);
    },
    isEmpty: function isEmpty(a, b) {
      return Object.keys(this.galleryObj.children_array[a][b]).length > 1;
    },
    update: function update() {
      var _this = this;

      this.$ma.trackEvent({
        action: 'account-page',
        properties: {
          feature: 'edit-image',
          type: 'update-button-clicked'
        }
      });

      if (this.originalDetails['name'] != this.name) {
        this.$ma.trackEvent({
          action: 'account-page',
          properties: {
            feature: 'edit-image',
            type: 'image-name-enterd'
          }
        });
      }

      if (this.originalDetails['description'] != this.description) {
        this.$ma.trackEvent({
          action: 'account-page',
          properties: {
            feature: 'edit-image',
            type: 'image-description-enterd'
          }
        });
      }

      var formData = new FormData();
      formData.append('img_id', this.img.id);
      formData.append('name', this.name);
      formData.append('description', this.description);
      formData.append('tags', '#' + this.tags.join("#"));
      var that = this;
      axios.post('/api/update-img', formData).then(function (response) {
        that.$toast.success({
          title: 'Saved successfully',
          message: "Image '" + that.img.id + "' been updated",
          position: _this.$root.toastPosition
        });
        that.$root.$refs.approvedGallery.getResults(that.$root.$refs.approvedGallery.page);
        that.$modal.hide('EditModal'); // window.location.href = this.$root.currentUrl + 'account';
      });
    },
    deleteImg: function deleteImg() {
      this.$ma.trackEvent({
        action: 'account-page',
        properties: {
          feature: 'edit-image',
          status: this.status,
          type: 'delete-button-clicked'
        }
      });
      var that = this;
      axios.get('/api/delete-img/' + this.img.id).then(function (response) {
        that.$root.renderGallery += 1;
        that.$modal.hide('EditModal');
      });
    },
    addTag: function addTag(event) {
      var element = event.target;
      var key = event.key;
      var inpt = $(element).val();
      inpt = inpt.replace('#', '');
      inpt = inpt.replace(',', '');
      inpt = inpt.replace(' ', '');
      inpt = inpt.replace('\n', '');

      if ((key == ',' || key == 'Enter') && inpt.length > 1) {
        if (this.tags.length > 14) {
          this.$toast.error({
            title: 'Exceed Limit',
            message: "You can add up to 15 tags per image",
            position: this.$root.toastPosition
          });
        } else {
          this.$ma.trackEvent({
            action: 'account-page',
            properties: {
              feature: 'edit-image',
              type: 'add-tags-enterd'
            }
          });
          this.tags.push(inpt);
          $(element).val('');
        }
      }
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
      this.originalDetails['description'] = this.description = img.description;
      this.originalDetails['name'] = this.name = img.name;
      this.$modal.show('EditModal');
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
      var that = this;
      axios.get('/api/image-products/' + this.img.id).then(function (response) {
        that.products = response.data;

        for (var index in that.products) {
          if (that.categories.includes(that.products[index].details.category_id)) {
            that.$delete(that.products, index);
          } else {
            that.categories.push(that.products[index].details.category_id);
          }
        }
      });
    },
    beforeOpen: function beforeOpen(event) {
      this.$root.clicked = true;
      this.products = {};
    },
    beforeClose: function beforeClose(event) {
      this.$root.clicked = false;
      this.showProducts = false;
    }
  },
  watch: {
    creator: function creator(newVal, oldVal) {
      if (this.creator && this.creator != '') {
        this.prices = JSON.parse(this.creator.products_price);
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/EditModal.vue?vue&type=template&id=1303bee8&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/EditModal.vue?vue&type=template&id=1303bee8& ***!
  \******************************************************************************************************************************************************************************************************************/
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
        name: "EditModal",
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
                return _vm.$modal.hide("EditModal")
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
                _vm._v("\n        Edit image "),
                _c("span", { staticClass: "id" }, [
                  _vm._v("ID (" + _vm._s(_vm.img.id) + ")")
                ])
              ])
            : _c("h2", { staticClass: "title" }, [
                _vm._v("\n        Image ID " + _vm._s(_vm.img.id) + "\n      ")
              ]),
          _vm._v(" "),
          !_vm.$root.isMobile
            ? _c(
                "div",
                {
                  staticClass: "trash",
                  on: {
                    click: function($event) {
                      return _vm.deleteImg()
                    }
                  }
                },
                [
                  _c("i", { staticClass: "fas fa-trash" }),
                  _vm._v("\n        Delete Image\n      ")
                ]
              )
            : _vm._e()
        ]),
        _vm._v(" "),
        _vm.showProducts
          ? _c("div", { staticClass: "products-box" }, [
              _c("div", { staticClass: "row-two" }, [
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
                        _vm._l(_vm.products, function(product, index) {
                          return _c("slide", { key: index }, [
                            _c(
                              "div",
                              {
                                staticClass: "row cur-box",
                                attrs: { "data-pid": index }
                              },
                              [
                                _c("div", { staticClass: "col-md-6" }, [
                                  _c(
                                    "div",
                                    {
                                      staticClass: "product-preview-box",
                                      attrs: { id: index }
                                    },
                                    [
                                      _c("v-lazy-image", {
                                        attrs: {
                                          src:
                                            _vm.$root.storageUrl +
                                            "/creator_images/" +
                                            _vm.img.id +
                                            "/previews/" +
                                            product.product_code +
                                            "/1000_1.jpg",
                                          "src-placeholder":
                                            _vm.$root.storageUrl +
                                            "/images/placeholder-white.png"
                                        }
                                      })
                                    ],
                                    1
                                  )
                                ]),
                                _vm._v(" "),
                                _c("div", { staticClass: "col-md-6 details" }, [
                                  _c("div", { staticClass: "title" }, [
                                    _vm._v(_vm._s(product.details.title))
                                  ]),
                                  _vm._v(" "),
                                  _c("div", {
                                    staticClass: "desc",
                                    domProps: {
                                      innerHTML: _vm._s(
                                        product.details.html_description
                                      )
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
                                          _vm._v(
                                            _vm._s(
                                              _vm.prices[product.product_code]
                                            )
                                          )
                                        ])
                                      ]),
                                      _vm._v(" "),
                                      _c("div", { staticClass: "dis-price" }, [
                                        _vm._v("$"),
                                        _c("span", { staticClass: "inpt" }, [
                                          _vm._v(
                                            _vm._s(
                                              (
                                                (_vm.prices[
                                                  product.product_code
                                                ] *
                                                  (100 -
                                                    _vm.creator.discount)) /
                                                100
                                              ).toFixed(2)
                                            )
                                          )
                                        ])
                                      ])
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    { staticClass: "prices-page-box" },
                                    [
                                      _vm._v(
                                        "\n                    To edit shop products and set products prices please visit "
                                      ),
                                      _c(
                                        "a",
                                        {
                                          staticStyle: { color: "#C000FF" },
                                          attrs: { href: "/store-settings" },
                                          on: {
                                            click: function($event) {
                                              return _vm.$ma.trackEvent({
                                                action: "account-page",
                                                properties: {
                                                  feature: "edit button",
                                                  type:
                                                    "store-settings-button-clicked"
                                                }
                                              })
                                            }
                                          }
                                        },
                                        [_vm._v("Store settings page")]
                                      )
                                    ]
                                  )
                                ])
                              ]
                            )
                          ])
                        }),
                        _vm._v(" "),
                        _vm.$root.isMobile
                          ? _c(
                              "hooper-navigation",
                              {
                                attrs: { slot: "hooper-addons" },
                                slot: "hooper-addons"
                              },
                              [
                                _c(
                                  "svg",
                                  {
                                    staticClass: "icon",
                                    attrs: {
                                      slot: "hooper-next",
                                      viewBox: "0 0 1024 1024",
                                      version: "1.1",
                                      xmlns: "http://www.w3.org/2000/svg"
                                    },
                                    slot: "hooper-next"
                                  },
                                  [
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M857.70558 495.009024 397.943314 27.513634c-7.132444-7.251148-18.794042-7.350408-26.048259-0.216941-7.253194 7.132444-7.350408 18.795065-0.216941 26.048259l446.952518 454.470749L365.856525 960.591855c-7.192819 7.192819-7.192819 18.85544 0 26.048259 3.596921 3.596921 8.311293 5.39487 13.024641 5.39487s9.42772-1.798972 13.024641-5.39487L857.596086 520.949836C864.747973 513.797949 864.796068 502.219239 857.70558 495.009024z"
                                      }
                                    })
                                  ]
                                ),
                                _vm._v(" "),
                                _c(
                                  "svg",
                                  {
                                    staticClass: "icon",
                                    attrs: {
                                      slot: "hooper-prev",
                                      viewBox: "0 0 1024 1024",
                                      version: "1.1",
                                      xmlns: "http://www.w3.org/2000/svg"
                                    },
                                    slot: "hooper-prev"
                                  },
                                  [
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M729.6 931.2l-416-425.6 416-416c9.6-9.6 9.6-25.6 0-35.2-9.6-9.6-25.6-9.6-35.2 0l-432 435.2c-9.6 9.6-9.6 25.6 0 35.2l432 441.6c9.6 9.6 25.6 9.6 35.2 0C739.2 956.8 739.2 940.8 729.6 931.2z"
                                      }
                                    })
                                  ]
                                )
                              ]
                            )
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
                            _vm._l(_vm.products, function(product, index) {
                              return _c("slide", { key: index }, [
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
                                          _vm.$root.storageUrl +
                                          "/creator_images/" +
                                          _vm.img.id +
                                          "/previews/" +
                                          product.product_code +
                                          "/1000_1.jpg"
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
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-md-12", staticStyle: { float: "right" } },
          [
            !_vm.$root.isMobile
              ? _c("ul", { staticClass: "tabs nav nav-tabs" }, [
                  _c("li", {}, [
                    _c(
                      "a",
                      {
                        staticClass: "active",
                        attrs: {
                          href: "#details",
                          "data-toggle": "tab",
                          "aria-expanded": "false"
                        },
                        on: {
                          click: function($event) {
                            _vm.showProducts = false
                          }
                        }
                      },
                      [_vm._v("\n            Details\n          ")]
                    )
                  ]),
                  _vm._v(" "),
                  _c("li", {}, [
                    _c(
                      "a",
                      {
                        attrs: {
                          href: "#products",
                          "data-toggle": "tab",
                          "aria-expanded": "false"
                        },
                        on: {
                          click: function($event) {
                            _vm.showProducts = true
                          }
                        }
                      },
                      [_vm._v("\n            Products\n          ")]
                    )
                  ])
                ])
              : _vm._e(),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass:
                  "tab-content tab-content--padded edit-photo__tab-content"
              },
              [
                _c(
                  "div",
                  { staticClass: "tab-pane active", attrs: { id: "details" } },
                  [
                    !_vm.$root.isMobile
                      ? _c("div", { staticClass: "col-md-6" }, [
                          _c(
                            "div",
                            {
                              staticStyle: {
                                background: "url(/storage/images/opacity.jpg)"
                              }
                            },
                            [
                              _c("v-lazy-image", {
                                staticClass: "img-prev",
                                attrs: {
                                  src:
                                    _vm.$root.storageUrl +
                                    "/creator_images/" +
                                    _vm.img.id +
                                    "/500.jpg",
                                  "src-placeholder":
                                    _vm.$root.storageUrl +
                                    "/creator_images/" +
                                    _vm.img.id +
                                    "/80.jpg"
                                }
                              })
                            ],
                            1
                          )
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-6 det" }, [
                      _c("div", { staticClass: "input" }, [
                        _c("div", { staticClass: "margin-bottom-6" }, [
                          _c("b", [_vm._v("Image Name")]),
                          _vm._v(" "),
                          _c("span", { staticClass: "grey" }, [
                            _vm._v(
                              "\n                  (Optional)\n                "
                            )
                          ])
                        ]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.name,
                              expression: "name"
                            }
                          ],
                          staticClass: "margin-bottom-6",
                          attrs: { maxlength: "25" },
                          domProps: { value: _vm.name },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.name = $event.target.value
                            }
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "input" }, [
                        _c("div", { staticClass: "margin-bottom-6" }, [
                          _c("b", [_vm._v("Image Description")]),
                          _c("span", { staticClass: "grey" }, [
                            _vm._v(" (Optional)")
                          ])
                        ]),
                        _vm._v(" "),
                        _c("textarea", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.description,
                              expression: "description"
                            }
                          ],
                          staticClass: "margin-bottom-6",
                          attrs: { maxlength: "140" },
                          domProps: { value: _vm.description },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.description = $event.target.value
                            }
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "input" }, [
                        _c("div", { staticClass: "margin-bottom-6" }, [
                          _c("b", [_vm._v("Tag Words")]),
                          _c("span", { staticClass: "grey" }, [
                            _vm._v(" (Auto Generated)")
                          ])
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-12" }, [
                          _c(
                            "div",
                            { staticClass: "tags-box" },
                            [
                              _c("label", { attrs: { for: "tags" } }, [
                                _vm._v(
                                  "Please add tags to your image (separated by Enter or Comma)"
                                )
                              ]),
                              _vm._v(" "),
                              _c("input", {
                                staticClass: "tags-input",
                                staticStyle: { width: "100px" },
                                attrs: { placeholder: "Add tag" },
                                on: {
                                  keyup: function($event) {
                                    return _vm.addTag($event)
                                  }
                                }
                              }),
                              _c("br"),
                              _vm._v(" "),
                              _vm._l(_vm.tags, function(imgTag, j) {
                                return _c(
                                  "div",
                                  { key: j, staticClass: "tag" },
                                  [
                                    _c(
                                      "span",
                                      {
                                        on: {
                                          click: function($event) {
                                            return _vm.deleteTag($event)
                                          }
                                        }
                                      },
                                      [_c("i", { staticClass: "fa fa-times" })]
                                    ),
                                    _vm._v(" "),
                                    _c("span", { staticClass: "value" }, [
                                      _vm._v(_vm._s(imgTag))
                                    ])
                                  ]
                                )
                              })
                            ],
                            2
                          )
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "a",
                      { staticClass: "update-btn", on: { click: _vm.update } },
                      [_vm._v("Update")]
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "tab-pane", attrs: { id: "share" } }, [
                  !_vm.$root.isMobile
                    ? _c("div", { staticClass: "col-md-6" }, [
                        _c("div", { staticClass: "socail-img-box" }, [
                          _c(
                            "svg",
                            {
                              staticStyle: {
                                "enable-background": "new 0 0 600 500"
                              },
                              attrs: {
                                version: "1.1",
                                id: "Layer_1",
                                xmlns: "http://www.w3.org/2000/svg",
                                "xmlns:xlink": "http://www.w3.org/1999/xlink",
                                x: "0px",
                                y: "0px",
                                viewBox: "0 0 600 500",
                                "xml:space": "preserve"
                              }
                            },
                            [
                              _c("path", {
                                staticClass: "st0",
                                attrs: {
                                  d:
                                    "M342.5,103.6c-36.4-1.3-71-13-104.1-25.9S172.5,50.7,137,43.9c-22.8-4.4-48.9-5-67.3,7.2\n                  c-17.7,11.8-23.4,32.1-26.5,51c-2.3,14.2-3.7,29.1,2.7,42.4c4.4,9.2,12.2,17,17.6,25.9c18.8,30.8,5.5,68.7-14.9,98.7\n                  c-9.6,14.1-20.7,27.5-28,42.5s-10.8,32.2-4.3,47.5c6.4,15.2,21.6,26.5,38.2,34.6c33.5,16.3,73.1,20.9,111.6,23.6\n                  c85.3,5.8,171.1,3.3,256.7,0.8c31.7-0.9,63.5-1.9,94.6-6.8c17.3-2.7,35.2-7,47.7-17.4c15.9-13.2,19.9-35.6,9.2-52.2\n                  c-17.9-27.8-67.4-34.7-80-64.6c-6.9-16.4,0.2-34.7,10.2-50c21.5-32.7,57.5-61.4,59.4-98.7c1.3-25.7-16-51.4-42.8-63.5\n                  c-28.1-12.7-67-11.1-87.7,9.9C412.1,96.4,374.6,104.7,342.5,103.6z"
                                }
                              }),
                              _vm._v(" "),
                              _c("g", { staticClass: "st1" }, [
                                _c("path", {
                                  staticClass: "st2",
                                  attrs: {
                                    d:
                                      "M381.2,180.8h2.4c0.7,0,1.3,0.6,1.3,1.3v38.5c0,0.7-0.6,1.3-1.3,1.3h-2.4c-0.7,0-1.3-0.6-1.3-1.3v-38.5\n                    C379.9,181.4,380.4,180.8,381.2,180.8z"
                                  }
                                }),
                                _vm._v(" "),
                                _c("path", {
                                  staticClass: "st2",
                                  attrs: {
                                    d:
                                      "M215.7,148.7h0.2c0.7,0,1.3,0.6,1.3,1.3v10.9c0,0.7-0.6,1.3-1.3,1.3h-0.2c-0.7,0-1.3-0.6-1.3-1.3V150\n                    C214.4,149.2,215,148.7,215.7,148.7z"
                                  }
                                }),
                                _vm._v(" "),
                                _c("path", {
                                  staticClass: "st2",
                                  attrs: {
                                    d:
                                      "M215.6,173.4h0.6c0.7,0,1.3,0.6,1.3,1.3v20.9c0,0.7-0.6,1.3-1.3,1.3h-0.6c-0.7,0-1.3-0.6-1.3-1.3v-20.9\n                    C214.3,174,214.9,173.4,215.6,173.4z"
                                  }
                                }),
                                _vm._v(" "),
                                _c("path", {
                                  staticClass: "st2",
                                  attrs: {
                                    d:
                                      "M215.6,205.1h0.4c0.7,0,1.3,0.6,1.3,1.3v21.1c0,0.7-0.6,1.3-1.3,1.3h-0.4c-0.7,0-1.3-0.6-1.3-1.3v-21.1\n                    C214.3,205.7,214.9,205.1,215.6,205.1z"
                                  }
                                }),
                                _vm._v(" "),
                                _c("path", {
                                  staticClass: "st2",
                                  attrs: {
                                    d:
                                      "M237.9,104h122.8c12.1,0,21.9,9.8,21.9,21.9v294.7c0,12.1-9.8,21.9-21.9,21.9H237.9\n                    c-12.1,0-21.9-9.8-21.9-21.9V125.9C216,113.8,225.8,104,237.9,104z"
                                  }
                                }),
                                _vm._v(" "),
                                _c("path", {
                                  staticClass: "st3",
                                  attrs: {
                                    d:
                                      "M285.4,114.1h18.9c1.2,0,2.2,1,2.2,2.2v0.4c0,1.2-1,2.2-2.2,2.2h-18.9c-1.2,0-2.2-1-2.2-2.2v-0.4\n                    C283.2,115.1,284.2,114.1,285.4,114.1z"
                                  }
                                }),
                                _vm._v(" "),
                                _c("circle", {
                                  staticClass: "st3",
                                  attrs: { cx: "312.7", cy: "116.5", r: "2.7" }
                                })
                              ]),
                              _vm._v(" "),
                              _c("ellipse", {
                                staticClass: "st0",
                                attrs: {
                                  cx: "115.6",
                                  cy: "450.4",
                                  rx: "112.4",
                                  ry: "11.5"
                                }
                              }),
                              _vm._v(" "),
                              _c("ellipse", {
                                staticClass: "st0",
                                attrs: {
                                  cx: "365.5",
                                  cy: "488.6",
                                  rx: "52.6",
                                  ry: "5.4"
                                }
                              }),
                              _vm._v(" "),
                              _c("ellipse", {
                                staticClass: "st0",
                                attrs: {
                                  cx: "545.4",
                                  cy: "461.6",
                                  rx: "52.6",
                                  ry: "5.4"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M359,112.8H340v2.3c0,6-4.9,10.9-10.9,10.9l0,0h-60.8c-6,0-10.9-4.9-10.9-10.9c0,0,0,0,0,0v-2.3h-17.9\n                  c-7.3,0-13.2,5.9-13.2,13.2c0,0,0,0,0,0v294.5c0,7.3,5.9,13.2,13.2,13.2c0,0,0,0,0,0H359c7.3,0,13.2-5.9,13.2-13.2V126.1\n                  C372.2,118.8,366.3,112.8,359,112.8z"
                                }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st5",
                                attrs: {
                                  x: "310.3",
                                  y: "315.2",
                                  width: "43.9",
                                  height: "43.9"
                                }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st5",
                                attrs: {
                                  x: "245.7",
                                  y: "257.3",
                                  width: "43.9",
                                  height: "43.9"
                                }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st5",
                                attrs: {
                                  x: "249.9",
                                  y: "372.1",
                                  width: "43.9",
                                  height: "43.9"
                                }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st6",
                                attrs: {
                                  x: "240.1",
                                  y: "149.6",
                                  width: "43.9",
                                  height: "43.9"
                                }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st6",
                                attrs: {
                                  x: "321.9",
                                  y: "308.4",
                                  transform:
                                    "matrix(0.7415 -0.6709 0.6709 0.7415 -132.7786 316.0672)",
                                  width: "43.9",
                                  height: "43.9"
                                }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st6",
                                attrs: {
                                  x: "309.6",
                                  y: "202.5",
                                  width: "43.9",
                                  height: "43.9"
                                }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st6",
                                attrs: {
                                  x: "254.1",
                                  y: "251.4",
                                  width: "43.9",
                                  height: "43.9"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st7",
                                attrs: { d: "M548,366.2" }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st8",
                                attrs: {
                                  x: "418.1",
                                  y: "152",
                                  width: "76.8",
                                  height: "76.8"
                                }
                              }),
                              _vm._v(" "),
                              _c("rect", {
                                staticClass: "st8",
                                attrs: {
                                  x: "93.6",
                                  y: "268.7",
                                  width: "81.6",
                                  height: "81.6"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M344.7,216.5c-0.9,0.4-1.9,0.7-2.9,0.8c1.1-0.6,1.9-1.6,2.2-2.8c-1,0.6-2.1,1-3.2,1.2c-1.9-2.1-5.1-2.2-7.2-0.3\n                  c-1,1-1.6,2.3-1.6,3.8c0,0.4,0,0.8,0.1,1.2c-4.1-0.2-7.9-2.1-10.5-5.4c-1.4,2.3-0.7,5.3,1.6,6.8c-0.8,0-1.6-0.2-2.3-0.6v0.1\n                  c0,2.4,1.7,4.5,4.1,5c-0.4,0.1-0.9,0.2-1.3,0.2c-0.3,0-0.6,0-1-0.1c0.7,2.1,2.6,3.5,4.8,3.6c-1.8,1.4-4,2.2-6.4,2.2\n                  c-0.4,0-0.8,0-1.2-0.1c2.3,1.5,5,2.3,7.8,2.3c9.4,0,14.6-7.8,14.6-14.6c0-0.2,0-0.4,0-0.7C343.2,218.4,344,217.5,344.7,216.5z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M326.1,326.5l1.7,4.2l11,11.7l3.7-3.5l2.3,2.5l2.5-2.3l0.1-4.8l3.1-2.9l0.2-8.4l-9.9-10.4L326.1,326.5z\n                  M348.3,324.2l-0.1,4.8l-3.7,3.5l-0.1,4.8l-2.3-2.5l-3.1,2.9l-9.9-10.4l11.7-11L348.3,324.2z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M339.4,322.1l1.8-1.7l4.7,5l-1.8,1.7L339.4,322.1z M335.1,326.2l1.8-1.7l4.7,5l-1.8,1.7L335.1,326.2z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M158.8,284.1h-44.5c-1.5,0-2.8,1.2-2.8,2.8v44.6c0,1.5,1.2,2.8,2.8,2.8h22.2v-19.8h-6v-7.3h6.1v-5.4\n                  c0-6.5,4.5-10,10.3-10c2.8,0,5.7,0.2,6.4,0.3v6.7h-4.6c-3.1,0-3.7,1.5-3.7,3.7v4.7h7.5l-1,7.3H145v19.8h13.9c1.5,0,2.8-1.2,2.8-2.8\n                  v-44.5C161.6,285.4,160.4,284.1,158.8,284.1z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M280,264.7c2.3,0,4.2,1.9,4.2,4.2v8.4c0,2.3-1.9,4.2-4.2,4.2h-8.4c-1.1,0-2.2-0.4-3-1.2c-0.8-0.8-1.2-1.9-1.2-3\n                  v-8.4c0-2.3,1.9-4.2,4.2-4.2H280 M280,263h-8.4c-3.3,0-5.9,2.7-5.9,5.9v8.4c0,3.3,2.7,5.9,5.9,5.9h8.4c3.3,0,5.9-2.6,5.9-5.9v-8.4\n                  C286,265.7,283.3,263,280,263z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M281.3,268.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3c0.7,0,1.3,0.6,1.3,1.3c0,0,0,0,0,0\n                  C282.6,268.3,282,268.9,281.3,268.9C281.3,268.9,281.3,268.9,281.3,268.9z M275.8,269.7c1.9,0,3.4,1.5,3.4,3.4s-1.5,3.4-3.4,3.4\n                  s-3.4-1.5-3.4-3.4S274,269.7,275.8,269.7 M275.8,268c-2.8,0-5.1,2.3-5.1,5.1c0,2.8,2.3,5.1,5.1,5.1s5.1-2.3,5.1-5.1\n                  C280.9,270.3,278.6,268,275.8,268z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M481.2,180.2c0-4.2-3.1-7.5-6.9-7.5c-5.1-0.2-10.3-0.3-15.7-0.3h-1.7c-5.3,0-10.6,0.1-15.7,0.3\n                  c-3.8,0-6.8,3.4-6.8,7.5c-0.2,3.3-0.3,6.6-0.3,9.8s0.1,6.6,0.3,9.8c0,4.2,3.1,7.5,6.8,7.5c5.4,0.2,10.9,0.4,16.5,0.4\n                  c5.6,0,11.1-0.1,16.5-0.4c3.8,0,6.9-3.4,6.9-7.5c0.2-3.3,0.3-6.6,0.3-9.9C481.5,186.7,481.4,183.4,481.2,180.2L481.2,180.2z\n                  M453.3,199.1V181l13.4,9.1L453.3,199.1z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st4",
                                attrs: {
                                  d:
                                    "M261.8,159.6c-6.5-0.1-11.8,5.2-11.9,11.7c0,4.8,2.8,9.1,7.2,11c-0.1-0.9,0-1.8,0.2-2.7c0.2-1,1.5-6.4,1.5-6.4\n                  c-0.3-0.6-0.4-1.2-0.4-1.9c0-1.8,1-3.1,2.3-3.1c1.1,0,1.6,0.8,1.6,1.8c0,1.1-0.7,2.7-1,4.2c-0.2,1,0.3,2,1.3,2.2\n                  c0.2,0,0.4,0.1,0.5,0.1c2.2,0,3.7-2.9,3.7-6.3c0-2.6-1.7-4.5-4.9-4.5c-3.1-0.1-5.7,2.3-5.8,5.4c0,0.1,0,0.2,0,0.2\n                  c0,0.8,0.2,1.7,0.8,2.3c0.2,0.2,0.3,0.4,0.2,0.7c-0.1,0.2-0.2,0.7-0.2,0.9c0,0.2-0.2,0.4-0.5,0.3c0,0-0.1,0-0.1,0\n                  c-1.7-0.7-2.4-2.5-2.4-4.5c0-3.4,2.8-7.4,8.4-7.4c4.5,0,7.5,3.3,7.5,6.8c0,4.6-2.6,8.1-6.4,8.1c-1.1,0-2.2-0.5-2.9-1.5\n                  c0,0-0.7,2.7-0.8,3.2c-0.3,0.9-0.7,1.8-1.2,2.5c1.1,0.3,2.2,0.5,3.4,0.5c6.5,0,11.8-5.3,11.8-11.8\n                  C273.6,164.9,268.3,159.6,261.8,159.6z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: {
                                  d:
                                    "M358.6,481.4c0.3,0.3,0.5,0.6,0.6,0.9l0,0l-8,0.9c0.4-0.6,0.6-1.2,0.6-1.9C351.8,481.4,357.1,479.8,358.6,481.4\n                  z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st10",
                                attrs: {
                                  d:
                                    "M367,438l8.9-1.2C375.9,436.8,370.9,442,367,438z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: {
                                  d:
                                    "M374.6,428.1c0,0,0.3,3.1-1.6,4.3C373,432.5,376.4,431.9,374.6,428.1z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: {
                                  d:
                                    "M356,440.9c0,0-5.6,1.3-5.8,3.6C350,446.7,356,440.9,356,440.9z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: {
                                  d:
                                    "M316.3,333.4l-4,2.1l-0.4-0.8c0.6-0.5,2.5-2.1,3.2-2c0.3,0,0.6,0,0.9,0C316.2,333.1,316.3,333.4,316.3,333.4z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: {
                                  d:
                                    "M330.9,347.3c-0.1,0.7-6.1,1.3-6.1,1.3l3-3.1l0,0l0.1,0l0,0C329,346,330,346.6,330.9,347.3z"
                                }
                              }),
                              _vm._v(" "),
                              _c("circle", {
                                staticClass: "st11",
                                attrs: { cx: "379.3", cy: "341.2", r: "0.4" }
                              }),
                              _vm._v(" "),
                              _c("circle", {
                                staticClass: "st11",
                                attrs: { cx: "379.4", cy: "342.2", r: "0.4" }
                              }),
                              _vm._v(" "),
                              _c("circle", {
                                staticClass: "st11",
                                attrs: { cx: "379.4", cy: "343.2", r: "0.4" }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: {
                                  d:
                                    "M335.4,350.9c0-0.1-1.4,5.2,5.1,8.1C340.5,359,337.8,358.1,335.4,350.9z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: {
                                  d:
                                    "M375.3,346.5c-0.1,0,3.2,2.1,4,3C379.3,349.5,377.2,346.3,375.3,346.5z"
                                }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: { d: "M353.2,346.8c0,0,10.1,1.3,11-0.2" }
                              }),
                              _vm._v(" "),
                              _c("path", {
                                staticClass: "st9",
                                attrs: { d: "M372.7,342.6c0,0,5.6,0,6.8,2.1" }
                              })
                            ]
                          )
                        ])
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-6 row-2" }, [
                    _c("div", { staticClass: "form-group" }, [
                      _c("div", {}, [
                        _c("label", [_vm._v("Image store link-")]),
                        _vm._v(" "),
                        _c("div", { staticClass: "cpy-lnk" }, [
                          _c("input", {
                            staticClass: "store-link",
                            attrs: { value: "" }
                          }),
                          _vm._v(" "),
                          _c("div", { attrs: { onclick: "copy(this)" } }, [
                            _c("i", { staticClass: "fas fa-link" }),
                            _vm._v("Copy\n                  ")
                          ])
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "socail-icons-box" }, [
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "24px",
                              viewBox: "0 0 24 24",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [
                              _vm._v("A8ECCCFC-043E-4C8E-B8E7-ACA635A18055")
                            ]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with sketchtool.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "aaa",
                                      transform:
                                        "translate(-236.000000, -407.000000)",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c(
                                      "g",
                                      {
                                        attrs: {
                                          id: "Group-5",
                                          transform:
                                            "translate(80.000000, 339.000000)"
                                        }
                                      },
                                      [
                                        _c(
                                          "g",
                                          {
                                            attrs: {
                                              id: "Stacked-Group-3",
                                              transform:
                                                "translate(124.000000, 68.000000)"
                                            }
                                          },
                                          [
                                            _c(
                                              "g",
                                              {
                                                attrs: {
                                                  id: "facebook",
                                                  transform:
                                                    "translate(32.000000, 0.000000)"
                                                }
                                              },
                                              [
                                                _c("circle", {
                                                  attrs: {
                                                    id: "Oval",
                                                    fill: "#000000",
                                                    cx: "11.9146195",
                                                    cy: "11.9146195",
                                                    r: "11.9146195"
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c("path", {
                                                  attrs: {
                                                    d:
                                                      "M14.9099469,12.3810265 L12.7839292,12.3810265 L12.7839292,20.1697699 L9.56283186,20.1697699 L9.56283186,12.3810265 L8.03086726,12.3810265 L8.03086726,9.64375221 L9.56283186,9.64375221 L9.56283186,7.87242478 C9.56283186,6.60573451 10.164531,4.62223009 12.8126018,4.62223009 L15.1985841,4.63221239 L15.1985841,7.28920354 L13.4673982,7.28920354 C13.1834336,7.28920354 12.7841416,7.43107965 12.7841416,8.03532743 L12.7841416,9.64630088 L15.1913628,9.64630088 L14.9099469,12.3810265 Z",
                                                    id: "Path",
                                                    fill: "#FFFFFF"
                                                  }
                                                })
                                              ]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("\n                Facebook\n              ")
                      ]),
                      _vm._v(" "),
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "24px",
                              viewBox: "0 0 24 24",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [
                              _vm._v("DC0455CB-8FE9-4E25-BB03-4685F2C9B120")
                            ]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with sketchtool.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "public-gallery",
                                      transform:
                                        "translate(-332.000000, -407.000000)",
                                      fill: "#000000",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c(
                                      "g",
                                      {
                                        attrs: {
                                          id: "Group-5",
                                          transform:
                                            "translate(80.000000, 339.000000)"
                                        }
                                      },
                                      [
                                        _c(
                                          "g",
                                          {
                                            attrs: {
                                              id: "Stacked-Group-3",
                                              transform:
                                                "translate(124.000000, 68.000000)"
                                            }
                                          },
                                          [
                                            _c(
                                              "g",
                                              {
                                                attrs: {
                                                  id: "instagram",
                                                  transform:
                                                    "translate(128.000000, 0.000000)"
                                                }
                                              },
                                              [
                                                _c("path", {
                                                  attrs: {
                                                    d:
                                                      "M15.5346667,6.368 L8.4008,6.368 C7.26213333,6.368 6.33573333,7.2944 6.33573333,8.43306667 L6.33573333,15.5669333 C6.33573333,16.7056 7.26213333,17.6322667 8.4008,17.6322667 L15.5346667,17.6322667 C16.6733333,17.6322667 17.6,16.7058667 17.6,15.5669333 L17.6,8.43306667 C17.6,7.2944 16.6736,6.368 15.5346667,6.368 Z M11.9677333,15.7082667 C9.9232,15.7082667 8.25973333,14.0448 8.25973333,12 C8.25973333,9.95546667 9.9232,8.292 11.9677333,8.292 C14.0125333,8.292 15.676,9.95546667 15.676,12 C15.676,14.0445333 14.0122667,15.7082667 11.9677333,15.7082667 Z M15.7952,9.05866667 C15.3112,9.05866667 14.9176,8.66506667 14.9176,8.18133333 C14.9176,7.6976 15.3112,7.304 15.7952,7.304 C16.2789333,7.304 16.6725333,7.6976 16.6725333,8.18133333 C16.6725333,8.66506667 16.2789333,9.05866667 15.7952,9.05866667 Z",
                                                    id: "Shape"
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c("path", {
                                                  attrs: {
                                                    d:
                                                      "M11.9677333,9.85893333 C10.7874667,9.85893333 9.8264,10.8194667 9.8264,11.9997333 C9.8264,13.1805333 10.7874667,14.1413333 11.9677333,14.1413333 C13.1485333,14.1413333 14.1088,13.1805333 14.1088,11.9997333 C14.1088,10.8197333 13.1482667,9.85893333 11.9677333,9.85893333 Z",
                                                    id: "Path"
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c("path", {
                                                  attrs: {
                                                    d:
                                                      "M11.9677333,0 C5.3584,0 0,5.3584 0,11.9677333 C0,18.5770667 5.3584,23.9354667 11.9677333,23.9354667 C18.5770667,23.9354667 23.9354667,18.5770667 23.9354667,11.9677333 C23.9354667,5.3584 18.5770667,0 11.9677333,0 Z M19.1666667,15.5669333 C19.1666667,17.5698667 17.5376,19.1989333 15.5346667,19.1989333 L8.4008,19.1989333 C6.39813333,19.1989333 4.7688,17.5698667 4.7688,15.5669333 L4.7688,8.43306667 C4.7688,6.4304 6.39813333,4.80106667 8.4008,4.80106667 L15.5346667,4.80106667 C17.5376,4.80106667 19.1666667,6.4304 19.1666667,8.43306667 L19.1666667,15.5669333 Z",
                                                    id: "Shape"
                                                  }
                                                })
                                              ]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("Instagram")
                      ]),
                      _vm._v(" "),
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "24px",
                              viewBox: "0 0 24 24",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [_vm._v("tumblr")]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with Sketch.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "tumblr",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c("circle", {
                                      attrs: {
                                        id: "Oval",
                                        fill: "#000000",
                                        cx: "12",
                                        cy: "12",
                                        r: "12"
                                      }
                                    }),
                                    _vm._v(" "),
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M12.5477269,8.15238315 L12.5477269,5 L10.4436059,5 C10.3962226,5.11508103 10.3728555,5.25547988 10.3728555,5.39566949 C10.3507865,5.46409039 10.3248231,5.51367985 10.3248231,5.58189151 C10.1091101,6.7509055 9.48122741,7.56630687 8.41780787,8.01177506 C8.10213562,8.15259239 7.81242682,8.17393469 7.5,8.15259239 L7.5,10.6939999 L9.0461233,10.6939999 C9.0712213,14.2702997 9.0712213,16.1138977 9.0712213,16.2076365 L9.0712213,16.4195948 C9.26529807,17.9798843 10.1088938,18.9149699 11.6063356,19.2664901 C12.2089039,19.428022 12.8599374,19.5 13.5133508,19.5 C14.3571629,19.4748914 15.1784732,19.334911 16,19.0800589 L16,16.0892076 C15.5201089,16.2293972 15.0824085,16.3474076 14.6962022,16.4629071 C13.9484549,16.6742377 13.3205722,16.5342573 12.8110396,16.0672376 C12.7630072,15.9958874 12.6918241,15.9019394 12.6667261,15.8084099 C12.5955429,15.4351289 12.5503233,15.0388317 12.5503233,14.66576 L12.5503233,10.6937907 L15.9032862,10.6937907 L15.9032862,8.15238315 L12.5477269,8.15238315 Z",
                                        id: "Path",
                                        fill: "#F1F2F2"
                                      }
                                    })
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("Tumblr")
                      ]),
                      _vm._v(" "),
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "24px",
                              viewBox: "0 0 24 24",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [_vm._v("twitter")]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with Sketch.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "twitter",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c("circle", {
                                      attrs: {
                                        id: "Oval",
                                        fill: "#000000",
                                        cx: "12",
                                        cy: "12",
                                        r: "12"
                                      }
                                    }),
                                    _vm._v(" "),
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M19.5,8.36142333 C18.9850516,8.59222442 18.4311178,8.7483291 17.8501943,8.81804575 C18.4433275,8.45885343 18.8985128,7.89051116 19.1133603,7.21218112 C18.5583555,7.54495905 17.9433734,7.7863692 17.289406,7.91649252 C16.765461,7.35248047 16.0189571,7 15.1923406,7 C13.606368,7 12.3200679,8.30015062 12.3200679,9.9032006 C12.3200679,10.130754 12.3455583,10.3522451 12.3948254,10.5648593 C10.0077267,10.4438294 7.89116864,9.28809188 6.47441782,7.53110233 C6.22722544,7.95979478 6.08542183,8.45885343 6.08542183,8.9908218 C6.08542183,9.99781606 6.5928731,10.8868116 7.36315371,11.4073049 C6.89254567,11.3923656 6.44935586,11.2618093 6.06228771,11.0437824 C6.0620735,11.0561235 6.0620735,11.0684647 6.0620735,11.0805893 C6.0620735,12.4872635 7.05255669,13.6605385 8.36627498,13.9270639 C8.12550874,13.9937494 7.87124759,14.0290408 7.60970348,14.0290408 C7.42420209,14.0290408 7.24448423,14.0110703 7.06926467,13.9772945 C7.43469812,15.130434 8.49522629,15.9698484 9.7523945,15.9934482 C8.76919428,16.7722395 7.5308761,17.2362233 6.18481288,17.2362233 C5.95347165,17.2362233 5.72427247,17.2225831 5.5,17.1955192 C6.77044891,18.0195613 8.28059304,18.5 9.9025521,18.5 C15.1857003,18.5 18.0748952,14.0762402 18.0748952,10.2394427 C18.0748952,10.1136496 18.0721105,9.98828956 18.0665412,9.86401205 C18.6281863,9.45480561 19.1150739,8.94362233 19.5,8.36142333 L19.5,8.36142333 Z",
                                        id: "Path",
                                        fill: "#F1F2F2"
                                      }
                                    })
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("Twitter")
                      ]),
                      _vm._v(" "),
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "24px",
                              viewBox: "0 0 24 24",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [_vm._v("youtube")]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with Sketch.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "youtube",
                                      fill: "#000000",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M12,0 C5.3735962,0 0,5.3735962 0,12 C0,18.6264038 5.3735962,24 12,24 C18.6264038,24 24,18.6264038 24,12 C24,5.3735962 18.6264038,0 12,0 Z M19.1867065,15.8745117 C19.1002807,16.0759277 18.711731,16.3621216 17.3527222,16.5719604 C17.241394,16.5889893 17.1983643,16.7338257 17.1320801,17.0372315 C17.1079102,17.147644 17.0835571,17.2562256 17.0500488,17.3703003 C17.0211182,17.4691772 16.9594116,17.5155029 16.8555908,17.5155029 L16.8387451,17.5155029 C16.7666016,17.5155029 16.6644287,17.5025025 16.5346069,17.4770508 C16.3044434,17.43219 16.0464478,17.3908081 15.7181396,17.3908081 C15.5264282,17.3908081 15.328125,17.4072876 15.1287232,17.4402466 C14.7209473,17.5083618 14.3746948,17.7526245 14.0081177,18.0119018 C13.4754638,18.3887329 12.9255982,18.7774658 12.0684815,18.7774658 C12.0311279,18.7774658 11.99469,18.7761841 11.9578857,18.7745362 C11.9344482,18.7765503 11.9100952,18.7774658 11.8857422,18.7774658 C11.0289917,18.7774658 10.479126,18.388916 9.94738772,18.0126343 C9.58026122,17.7533569 9.23364258,17.5083618 8.82531741,17.4402466 C8.62609866,17.4072876 8.42779542,17.3908081 8.23645022,17.3908081 C7.89093019,17.3908081 7.61883544,17.4440918 7.41979978,17.4829102 C7.29913331,17.5065307 7.19476317,17.5268555 7.11547852,17.5268555 C7.03271484,17.5268555 6.94317628,17.5089112 6.90417478,17.3757935 C6.87030028,17.2602539 6.84594727,17.1487427 6.82214353,17.0403442 C6.76135256,16.7623901 6.71832277,16.5913696 6.60186769,16.5734253 C5.24304197,16.3635864 4.85394286,16.0772095 4.76733398,15.8741455 C4.755249,15.8452148 4.74792478,15.815918 4.74645994,15.7873535 C4.74206541,15.7091675 4.79718019,15.6401367 4.87445067,15.6276855 C6.96313477,15.2838135 7.89990234,13.1486206 7.9389038,13.0579834 C7.93981931,13.0557862 7.94091797,13.0532227 7.94219972,13.0508423 C8.07000731,12.791748 8.09490966,12.5667114 8.01690675,12.3823242 C7.87353516,12.0446777 7.40588381,11.8961792 7.09643555,11.7980347 C7.020813,11.7738647 6.94903566,11.7513428 6.89227294,11.7288208 C6.2746582,11.4847412 6.22338867,11.2342529 6.24774169,11.1066284 C6.28912355,10.888916 6.57989503,10.7371216 6.81518555,10.7371216 C6.87945558,10.7371216 6.93621825,10.7486573 6.98400881,10.7709961 C7.26196289,10.901001 7.51226808,10.9671021 7.72851563,10.9671021 C8.02697756,10.9671021 8.15734866,10.8416748 8.1732788,10.8251953 C8.16540525,10.6838379 8.15606691,10.5360718 8.14654542,10.3835449 C8.08428956,9.39624023 8.00701903,8.16888427 8.31976317,7.46850586 C9.25616456,5.36901853 11.2417603,5.2056885 11.8282471,5.2056885 C11.8432617,5.2056885 12.0853271,5.203125 12.0853271,5.203125 L12.1199341,5.203125 C12.7075195,5.203125 14.697876,5.36645508 15.6346435,7.46722411 C15.9472046,8.16796875 15.8699341,9.39624023 15.8076782,10.3829956 L15.8049316,10.4260254 C15.7963257,10.5633545 15.7879028,10.6968384 15.7809448,10.8248291 C15.7959595,10.8402099 15.9158935,10.9553833 16.1863403,10.9658203 L16.1865234,10.9658203 C16.3925171,10.9579468 16.6287232,10.8922119 16.8881836,10.7709961 C16.9639893,10.7352905 17.048584,10.7277832 17.105896,10.7277832 C17.1939698,10.7277832 17.2827759,10.7449951 17.3565674,10.7755737 L17.3613281,10.7775879 C17.5709839,10.8519287 17.7084961,10.9987793 17.7114258,11.1525879 C17.7141724,11.2972412 17.6035767,11.5147705 17.0619507,11.7288208 C17.0057373,11.7509766 16.9339599,11.7736816 16.8577881,11.7978516 C16.5479737,11.8959961 16.0806885,12.0446777 15.9373169,12.3821411 C15.8591309,12.5667114 15.8840332,12.7913818 16.0120239,13.0504761 C16.0131225,13.0530396 16.0144043,13.0554199 16.0155029,13.0579834 C16.0543213,13.1486206 16.9899902,15.283081 19.079956,15.6275025 C19.1570435,15.6401367 19.2123413,15.7091675 19.2079468,15.7869873 C19.2062988,15.8162842 19.1991577,15.8457642 19.1867065,15.8745117 L19.1867065,15.8745117 Z",
                                        id: "Shape"
                                      }
                                    })
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("youtube")
                      ]),
                      _vm._v(" "),
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "24px",
                              viewBox: "0 0 24 24",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [
                              _vm._v("1661BD68-5C07-47BF-BF96-117C8D83D485")
                            ]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with sketchtool.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "hhh",
                                      transform:
                                        "translate(-268.000000, -407.000000)",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c(
                                      "g",
                                      {
                                        attrs: {
                                          id: "Group-5",
                                          transform:
                                            "translate(80.000000, 339.000000)"
                                        }
                                      },
                                      [
                                        _c(
                                          "g",
                                          {
                                            attrs: {
                                              id: "Stacked-Group-3",
                                              transform:
                                                "translate(124.000000, 68.000000)"
                                            }
                                          },
                                          [
                                            _c(
                                              "g",
                                              {
                                                attrs: {
                                                  id: "pinterest",
                                                  transform:
                                                    "translate(64.000000, 0.000000)"
                                                }
                                              },
                                              [
                                                _c("circle", {
                                                  attrs: {
                                                    id: "Oval",
                                                    fill: "#000000",
                                                    cx: "11.9148319",
                                                    cy: "11.9150442",
                                                    r: "11.9146195"
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c("path", {
                                                  attrs: {
                                                    d:
                                                      "M12.876531,15.955115 C11.9757876,15.8854513 11.5973097,15.4387965 10.8909027,15.0099823 C10.5026549,17.0470088 10.028177,18.9997168 8.62279646,20.019823 C8.18846018,16.9410265 9.25953982,14.628531 9.75695575,12.1739469 C8.90909735,10.7466903 9.85890265,7.8739115 11.6472212,8.58180531 C13.8482124,9.45217699 9.74166372,13.8887788 12.4984779,14.4429027 C15.3765664,15.0214513 16.5515044,9.44899115 14.7665841,7.63646018 C12.1877522,5.01961062 7.26010619,7.57699115 7.8660531,11.323115 C8.01366372,12.2389381 8.9600708,12.5169558 8.24410619,13.7806726 C6.59362832,13.4151504 6.10130973,12.1134159 6.16460177,10.3779823 C6.26676106,7.53727434 8.71709735,5.54824779 11.1748673,5.27299115 C14.2831858,4.92509735 17.2005664,6.41437168 17.6032566,9.33812389 C18.0562832,12.6380177 16.2,16.2116814 12.876531,15.955115 L12.876531,15.955115 Z",
                                                    id: "Path",
                                                    fill: "#F1F2F2"
                                                  }
                                                })
                                              ]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("Pinterest")
                      ]),
                      _vm._v(" "),
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "25px",
                              viewBox: "0 0 24 25",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [_vm._v("reddit")]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with Sketch.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "reddit",
                                      transform:
                                        "translate(0.000000, 0.000000)",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M14.5888244,16.7134289 C14.034619,17.1744577 12.8471169,17.3390212 12.0008966,17.3390212 C11.1522224,17.3390212 9.9671743,17.1744577 9.41296892,16.7134289 C9.28177928,16.6042956 9.07149838,16.6042956 8.94049749,16.7134289 C8.80930785,16.8225621 8.80930785,16.9974892 8.94049749,17.1064654 C9.8188073,17.8371082 11.5061513,17.8947368 12.0008966,17.8947368 C12.4956419,17.8947368 14.180532,17.8371082 15.0614845,17.1064654 C15.1900315,16.9973322 15.1900315,16.822405 15.0614845,16.7134289 C14.9302949,16.6042956 14.7200139,16.6042956 14.5888244,16.7134289 L14.5888244,16.7134289 Z",
                                        id: "Path",
                                        fill: "#000000"
                                      }
                                    }),
                                    _vm._v(" "),
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M10.5263158,13.6842105 C10.5263158,12.9883546 9.95901379,12.4210526 9.26315789,12.4210526 C8.56748691,12.4210526 8,12.9883546 8,13.6842105 C8,14.3798815 8.56748691,14.9473684 9.26315789,14.9473684 C9.95901379,14.9473684 10.5263158,14.3800665 10.5263158,13.6842105 L10.5263158,13.6842105 Z",
                                        id: "Path",
                                        fill: "#000000"
                                      }
                                    }),
                                    _vm._v(" "),
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M12,0.210526316 C5.3735962,0.210526316 0,5.58412252 0,12.2105263 C0,18.8369301 5.3735962,24.2105263 12,24.2105263 C18.6264038,24.2105263 24,18.8369301 24,12.2105263 C24,5.58412252 18.6264038,0.210526316 12,0.210526316 Z M18.9624023,13.8112343 C18.9887695,13.9840859 19.0032349,14.1593178 19.0032349,14.3369301 C19.0032349,17.0296792 15.8688354,19.2113808 12.0023804,19.2113808 C8.13592528,19.2113808 5.00152589,17.0296792 5.00152589,14.3369301 C5.00152589,14.1569375 5.01599119,13.9793251 5.04235838,13.8064736 C4.43280028,13.532914 4.00799559,12.9209755 4.00799559,12.2105263 C4.00799559,11.2457436 4.79040525,10.4609536 5.75756836,10.4609536 C6.2279663,10.4609536 6.65277098,10.645707 6.96716306,10.9481972 C8.18151853,10.0722206 9.86169431,9.51283346 11.7312012,9.4648598 C11.7312012,9.44087297 12.6047974,5.27925188 12.6047974,5.27925188 C12.6216431,5.19776996 12.6696167,5.12800678 12.7391968,5.08259663 C12.8087768,5.03700338 12.8928223,5.02253803 12.9744873,5.03938374 L15.8833008,5.65846332 C16.0872802,5.24574361 16.5071411,4.96009908 16.9991455,4.96009908 C17.6903686,4.96009908 18.2495728,5.51930316 18.2495728,6.21052632 C18.2495728,6.90174947 17.6903686,7.46095355 16.9991455,7.46095355 C16.3295288,7.46095355 15.7871704,6.93287738 15.7560425,6.27058491 L13.1519165,5.71614155 L12.3552246,9.4674233 C14.1912232,9.53205952 15.8400879,10.0888832 17.0352173,10.952958 C17.3496094,10.6482705 17.7767944,10.4609536 18.2495728,10.4609536 C19.216919,10.4609536 19.9991455,11.2433633 19.9991455,12.2105263 C19.9991455,12.9257363 19.5695801,13.5376748 18.9624023,13.8112343 L18.9624023,13.8112343 Z",
                                        id: "Shape",
                                        fill: "#000000"
                                      }
                                    }),
                                    _vm._v(" "),
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M14.7368421,12.4210526 C14.0409862,12.4210526 13.4736842,12.9883546 13.4736842,13.6842105 C13.4736842,14.3798815 14.0409862,14.9473684 14.7368421,14.9473684 C15.4325131,14.9473684 16,14.3798815 16,13.6842105 C16,12.9883546 15.432698,12.4210526 14.7368421,12.4210526 L14.7368421,12.4210526 Z",
                                        id: "Path",
                                        fill: "#000000"
                                      }
                                    })
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("Reddit")
                      ]),
                      _vm._v(" "),
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "24px",
                              viewBox: "0 0 24 24",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [
                              _vm._v("1B6A0323-CDEF-4A8B-A537-D933BF9F2BD6")
                            ]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with sketchtool.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "public-gallery",
                                      transform:
                                        "translate(-300.000000, -407.000000)",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c(
                                      "g",
                                      {
                                        attrs: {
                                          id: "Group-5",
                                          transform:
                                            "translate(80.000000, 339.000000)"
                                        }
                                      },
                                      [
                                        _c(
                                          "g",
                                          {
                                            attrs: {
                                              id: "Stacked-Group-3",
                                              transform:
                                                "translate(124.000000, 68.000000)"
                                            }
                                          },
                                          [
                                            _c(
                                              "g",
                                              {
                                                attrs: {
                                                  id: "flickr",
                                                  transform:
                                                    "translate(96.000000, 0.000000)"
                                                }
                                              },
                                              [
                                                _c("path", {
                                                  attrs: {
                                                    d:
                                                      "M11.9152566,23.8283894 C18.4942301,23.8283894 23.8292389,18.4942301 23.8292389,11.9141947 C23.8292389,5.33479646 18.4942301,0.000637168142 11.9152566,0.000637168142 C5.33437168,0.000637168142 0,5.33500885 0,11.9141947 C0,18.4942301 5.33437168,23.8283894 11.9152566,23.8283894",
                                                    id: "Path",
                                                    fill: "#000000"
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c(
                                                  "g",
                                                  {
                                                    attrs: {
                                                      id: "Group",
                                                      transform:
                                                        "translate(5.734513, 9.132743)",
                                                      fill: "#F1F2F2"
                                                    }
                                                  },
                                                  [
                                                    _c("path", {
                                                      attrs: {
                                                        d:
                                                          "M12.1584425,2.78145133 C12.1584425,4.23610619 10.9803186,5.41529204 9.52566372,5.41529204 C8.06888496,5.41529204 6.89076106,4.23589381 6.89076106,2.78145133 C6.89076106,1.32722124 8.06888496,0.147823009 9.52566372,0.147823009 C10.9803186,0.147823009 12.1584425,1.32743363 12.1584425,2.78145133 Z",
                                                        id: "Path"
                                                      }
                                                    }),
                                                    _vm._v(" "),
                                                    _c("path", {
                                                      attrs: {
                                                        d:
                                                          "M5.46881416,2.78145133 C5.46881416,4.23610619 4.29069027,5.41529204 2.8339115,5.41529204 C1.37968142,5.41529204 0.201557522,4.23589381 0.201557522,2.78145133 C0.201557522,1.32722124 1.37968142,0.147823009 2.8339115,0.147823009 C4.29069027,0.147823009 5.46881416,1.32743363 5.46881416,2.78145133 Z",
                                                        id: "Path"
                                                      }
                                                    })
                                                  ]
                                                )
                                              ]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("Flickr")
                      ]),
                      _vm._v(" "),
                      _c("a", { attrs: { href: "#" } }, [
                        _c(
                          "svg",
                          {
                            attrs: {
                              width: "24px",
                              height: "24px",
                              viewBox: "0 0 24 24",
                              version: "1.1",
                              xmlns: "http://www.w3.org/2000/svg",
                              "xmlns:xlink": "http://www.w3.org/1999/xlink"
                            }
                          },
                          [
                            _c("title", [
                              _vm._v("19DAE029-7878-46AD-AFAE-A2AC5EAF0AD7")
                            ]),
                            _vm._v(" "),
                            _c("desc", [_vm._v("Created with sketchtool.")]),
                            _vm._v(" "),
                            _c(
                              "g",
                              {
                                attrs: {
                                  id: "Page-3",
                                  stroke: "none",
                                  "stroke-width": "1",
                                  fill: "none",
                                  "fill-rule": "evenodd"
                                }
                              },
                              [
                                _c(
                                  "g",
                                  {
                                    attrs: {
                                      id: "public-gallery",
                                      transform:
                                        "translate(-204.000000, -407.000000)",
                                      "fill-rule": "nonzero"
                                    }
                                  },
                                  [
                                    _c(
                                      "g",
                                      {
                                        attrs: {
                                          id: "Group-5",
                                          transform:
                                            "translate(80.000000, 339.000000)"
                                        }
                                      },
                                      [
                                        _c(
                                          "g",
                                          {
                                            attrs: {
                                              id: "Stacked-Group-3",
                                              transform:
                                                "translate(124.000000, 68.000000)"
                                            }
                                          },
                                          [
                                            _c(
                                              "g",
                                              { attrs: { id: "behance" } },
                                              [
                                                _c("circle", {
                                                  attrs: {
                                                    id: "Oval",
                                                    fill: "#000000",
                                                    cx: "11.9146195",
                                                    cy: "11.9146195",
                                                    r: "11.9146195"
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c("path", {
                                                  attrs: {
                                                    d:
                                                      "M16.1859823,9.84233628 C12.7446372,9.84233628 12.740177,13.2707257 12.740177,13.288354 C12.740177,13.288354 12.5044248,16.7209912 16.1859823,16.7209912 C16.1859823,16.7209912 19.2562832,16.8955752 19.2562832,14.3320354 L17.6797168,14.3320354 C17.6797168,14.3320354 17.7319646,15.2971327 16.2384425,15.2971327 C16.2384425,15.2971327 14.6618761,15.4020531 14.6618761,13.7379823 L19.3087434,13.7379823 C19.3087434,13.7379823 19.8197522,9.84233628 16.1859823,9.84233628 Z M14.6442478,12.5369204 C14.6442478,12.5369204 14.8364602,11.1568142 16.2210265,11.1568142 C17.6098407,11.1568142 17.587985,12.5369204 17.587985,12.5369204 L14.6442478,12.5369204 Z M10.7052743,11.6548673 C10.7052743,11.6548673 12.0722124,11.5544071 12.0722124,9.94725664 C12.0722124,8.34456637 10.9541947,7.55830088 9.53479646,7.55830088 L4.86584071,7.55830088 L4.86584071,16.5330265 L9.53437168,16.5330265 C9.53437168,16.5330265 12.3863363,16.620531 12.3863363,13.8821947 C12.3865487,13.8821947 12.508885,11.6548673 10.7052743,11.6548673 Z M6.92304425,9.15228319 L9.53458407,9.15228319 C9.53458407,9.15228319 10.1679292,9.15228319 10.1679292,10.0867965 C10.1679292,11.0213097 9.79667257,11.1568142 9.37295575,11.1568142 L6.92304425,11.1568142 L6.92304425,9.15228319 Z M9.40375221,14.9390442 L6.92304425,14.9390442 L6.92304425,12.5369187 L9.53458407,12.5369187 C9.53458407,12.5369187 10.4824779,12.5282124 10.4780334,13.7728142 C10.4780334,14.8211681 9.77500885,14.9303363 9.40375221,14.9390442 Z M14.2555752,8.08672566 L14.2555752,9.19178761 L17.9592212,9.19178761 L17.9592212,8.08672566 L14.2555752,8.08672566 Z",
                                                    id: "Shape",
                                                    fill: "#F1F2F2"
                                                  }
                                                })
                                              ]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v("Behnce")
                      ])
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "tab-pane", attrs: { id: "visibility" } },
                  [
                    _c("label", { staticClass: "radio-checkbox-container" }, [
                      _vm._v(
                        "Public(Published on your public gallery page)\n            "
                      ),
                      _c("input", {
                        attrs: {
                          type: "radio",
                          id: "is_active",
                          name: "is_active"
                        }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "checkmark" })
                    ]),
                    _vm._v(" "),
                    _c(
                      "label",
                      {
                        staticClass: "radio-checkbox-container",
                        staticStyle: { "margin-top": "50px" }
                      },
                      [
                        _vm._v(
                          "Private(Not published on your public gallery page)\n            "
                        ),
                        _c("input", {
                          attrs: {
                            type: "radio",
                            id: "isnt_active",
                            name: "is_active"
                          }
                        }),
                        _vm._v(" "),
                        _c("span", { staticClass: "checkmark" })
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        staticClass: "artigram-btn blue-bg",
                        staticStyle: {
                          position: "absolute",
                          right: "0px",
                          top: "464px"
                        },
                        attrs: { onclick: "editImg('is_active')" }
                      },
                      [_vm._v("Update")]
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", {
                  staticClass: "tab-pane",
                  attrs: { id: "products" }
                }),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "tab-pane", attrs: { id: "settings" } },
                  [
                    _c("div", { staticClass: "form-group" }, [
                      _c("h6", { staticClass: "epsilon text-weight--bold" }, [
                        _vm._v("Danger zone")
                      ]),
                      _vm._v(" "),
                      _c("p", [
                        _vm._v(
                          "When a photo is deleted from Ondema, we will do everything we can to prevent its further distribution, including preventing it from being viewed and downloaded through Ondema. However, the\n              "
                        ),
                        _c(
                          "a",
                          {
                            attrs: {
                              href: "/image-usage-rights",
                              target: "_blank"
                            }
                          },
                          [_vm._v("Ondema License")]
                        ),
                        _vm._v(
                          " is irrevocable, so copies of the photo that were downloaded before deletion may still be used."
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          staticClass:
                            "btn-link text-danger _37zTg _1l4Hh _1CBrG _1zIyn xLon9 _9G5GK NDx0k _2Xklx",
                          attrs: {
                            "data-confirm":
                              "Are you sure you want to delete this photo?",
                            "data-disable-with": "···",
                            rel: "nofollow",
                            "data-method": "delete",
                            onclick: "deleteImg()"
                          }
                        },
                        [_vm._v("Delete\n              photo")]
                      )
                    ])
                  ]
                )
              ]
            )
          ]
        )
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/admin/EditModal.vue":
/*!*****************************************************!*\
  !*** ./resources/js/components/admin/EditModal.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _EditModal_vue_vue_type_template_id_1303bee8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EditModal.vue?vue&type=template&id=1303bee8& */ "./resources/js/components/admin/EditModal.vue?vue&type=template&id=1303bee8&");
/* harmony import */ var _EditModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EditModal.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/EditModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _EditModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _EditModal_vue_vue_type_template_id_1303bee8___WEBPACK_IMPORTED_MODULE_0__["render"],
  _EditModal_vue_vue_type_template_id_1303bee8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/EditModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/EditModal.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/admin/EditModal.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EditModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./EditModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/EditModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EditModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/EditModal.vue?vue&type=template&id=1303bee8&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/admin/EditModal.vue?vue&type=template&id=1303bee8& ***!
  \************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditModal_vue_vue_type_template_id_1303bee8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./EditModal.vue?vue&type=template&id=1303bee8& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/EditModal.vue?vue&type=template&id=1303bee8&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditModal_vue_vue_type_template_id_1303bee8___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditModal_vue_vue_type_template_id_1303bee8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);