(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[10],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/MediaModal.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/MediaModal.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
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



/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'MediaModal',
  props: [],
  components: {
    Hooper: hooper__WEBPACK_IMPORTED_MODULE_1__["Hooper"],
    Slide: hooper__WEBPACK_IMPORTED_MODULE_1__["Slide"],
    HooperNavigation: hooper__WEBPACK_IMPORTED_MODULE_1__["Navigation"]
  },
  data: function data() {
    return {
      img: 0,
      cur: 0,
      curPid: '',
      tags: [],
      duration: 5000,
      store_id: 0,
      showStories: false,
      categories: {},
      products: {}
    };
  },
  watch: {
    cur: function cur(val) {
      for (var index in this.products) {
        if (this.products[index].details.category_id == val) {
          this.curPid = this.products[index].id;
          break;
        }
      }
    }
  },
  methods: {
    copyToClipboard: function copyToClipboard(str) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(str).select();
      document.execCommand("copy");
      $temp.remove();
      this.$toast.info({
        title: 'Link copied to clipboard',
        message: str,
        position: this.$root.toastPosition,
        timeOut: 2000
      });
    },
    downloadImage: function downloadImage(url, title) {
      var a = document.createElement('a');
      a.href = url;
      a.download = title + '.jpg';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    },
    isEmpty: function isEmpty(a, b) {
      return Object.keys(this.galleryObj.children_array[a][b]).length > 1;
    },
    openModal: function openModal(img) {
      this.img = img;
      this.$modal.show('MediaModal');
      var tags = this.img.tags.split("#");
      tags.shift();
      this.tags = tags;
    },
    afterOpen: function afterOpen(event) {},
    beforeOpen: function beforeOpen(event) {
      this.$root.clicked = true;
      this.galleryObj = {};
      this.getProductPreviews(this.img.store_id);
    },
    beforeClose: function beforeClose(event) {
      this.$root.clicked = false;
      this.showStories = false;
    },
    getProductPreviews: function getProductPreviews(storeId) {
      var vm = this;
      var that = this;
      axios.get('/api/image-products/' + this.img.id).then(function (response) {
        that.products = response.data;

        for (var index in that.products) {
          if (that.categories.hasOwnProperty(that.products[index].details.category_id)) {
            that.$delete(that.products, index);
          } else {
            that.categories[that.products[index].details.category_id] = that.products[index].details.category.name;
          }
        }

        that.cur = that.products[0].details.category_id;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/MediaModal.vue?vue&type=template&id=2922edd4&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/MediaModal.vue?vue&type=template&id=2922edd4& ***!
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
      staticClass: "media-modal",
      attrs: {
        name: "MediaModal",
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
      _vm.cur
        ? _c("div", { staticClass: "container media-image-popup" }, [
            _c(
              "a",
              {
                staticClass: "close",
                on: {
                  click: function($event) {
                    return _vm.$modal.hide("MediaModal")
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
              !_vm.$root.isMobile
                ? _c("h2", { staticClass: "title" }, [
                    _vm._v("\n        Social media templates "),
                    _c("span", { staticClass: "id" }, [
                      _vm._v("ID (" + _vm._s(_vm.img.id) + ")")
                    ])
                  ])
                : _c("h2", { staticClass: "title" }, [
                    _vm._v("\n        Social media center "),
                    _c("span", { staticClass: "id" }, [
                      _vm._v("(ID " + _vm._s(_vm.img.id) + ")")
                    ])
                  ]),
              _vm._v(" "),
              _c(
                "a",
                {
                  staticClass: "how-to",
                  attrs: {
                    target: "_blank",
                    href: "https://artigram.me/how-to-sell-with-instagram/"
                  }
                },
                [_vm._v("How to use it?")]
              )
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-md-12", staticStyle: { float: "right" } },
              [
                _c("ul", { staticClass: "tabs nav nav-tabs" }, [
                  _c("li", {}, [
                    _c(
                      "a",
                      {
                        staticClass: "active",
                        attrs: {
                          href: "#posts",
                          "data-toggle": "tab",
                          "aria-expanded": "false"
                        }
                      },
                      [_vm._v("\n            Posts\n          ")]
                    )
                  ]),
                  _vm._v(" "),
                  _c("li", {}, [
                    _c(
                      "a",
                      {
                        attrs: {
                          href: "#stories",
                          "data-toggle": "tab",
                          "aria-expanded": "false"
                        }
                      },
                      [_vm._v("\n            Stories\n          ")]
                    )
                  ])
                ]),
                _vm._v(" "),
                !_vm.$root.isMobile
                  ? _c(
                      "div",
                      {
                        staticClass:
                          "tab-content tab-content--padded edit-photo__tab-content"
                      },
                      [
                        _c(
                          "div",
                          {
                            staticClass: "tab-pane active",
                            attrs: { id: "posts" }
                          },
                          [
                            _c("div", { staticClass: "row col-md-12" }, [
                              _c(
                                "div",
                                { staticClass: "col-md-6" },
                                [
                                  _c(
                                    "transition",
                                    { attrs: { name: "fade" } },
                                    [
                                      _c("v-lazy-image", {
                                        key: _vm.cur,
                                        staticClass: "prev-gallery-img",
                                        attrs: {
                                          src:
                                            _vm.$root.storageUrl +
                                            "/creator_images/" +
                                            _vm.img.id +
                                            "/previews/categories/" +
                                            _vm.cur +
                                            "/post/700.jpg",
                                          "src-placeholder":
                                            _vm.$root.storageUrl +
                                            "/images/placeholder-white.png"
                                        }
                                      })
                                    ],
                                    1
                                  )
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "div",
                                { staticClass: "col-md-6 right-side" },
                                [
                                  _c("div", { staticClass: "title" }, [
                                    _vm._v(
                                      "Image " +
                                        _vm._s(_vm.img.id) +
                                        " on " +
                                        _vm._s(_vm.categories[_vm.cur])
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "margin-10" }, [
                                    _vm._v("Link to product page -")
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "link" }, [
                                    _c(
                                      "a",
                                      {
                                        attrs: {
                                          target: "_blank",
                                          href:
                                            _vm.$root.currentUrl +
                                            "product-" +
                                            _vm.curPid
                                        }
                                      },
                                      [
                                        _vm._v(
                                          _vm._s(_vm.$root.currentUrl) +
                                            "product-" +
                                            _vm._s(_vm.curPid)
                                        )
                                      ]
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "a",
                                    {
                                      staticClass: "copy margin-10",
                                      attrs: { href: "" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          return _vm.copyToClipboard(
                                            _vm.$root.currentUrl +
                                              "product-" +
                                              _vm.curPid
                                          )
                                        }
                                      }
                                    },
                                    [
                                      _c("i", { staticClass: "fas fa-link" }),
                                      _vm._v(" Copy Link")
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    { staticClass: "tags-box" },
                                    [
                                      _c("label", { attrs: { for: "tags" } }, [
                                        _vm._v("Suggested captions")
                                      ]),
                                      _vm._v(" "),
                                      _vm._l(_vm.tags, function(imgTag, j) {
                                        return _c(
                                          "div",
                                          { key: j, staticClass: "tag" },
                                          [
                                            _c(
                                              "span",
                                              { staticClass: "value" },
                                              [_vm._v("#" + _vm._s(imgTag))]
                                            )
                                          ]
                                        )
                                      })
                                    ],
                                    2
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "a",
                                    {
                                      staticClass: "download-btn btn purple",
                                      attrs: { href: "" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          return _vm.downloadImage(
                                            _vm.$root.storageUrl +
                                              "/temp/" +
                                              _vm.img.id +
                                              "_" +
                                              _vm.cur +
                                              "_post.jpg",
                                            _vm.categories[_vm.cur] +
                                              " " +
                                              _vm.img.id
                                          )
                                        }
                                      }
                                    },
                                    [_vm._v("Download Image")]
                                  )
                                ]
                              )
                            ]),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "carusel-box" },
                              [
                                _c(
                                  "hooper",
                                  {
                                    attrs: {
                                      wheelControl: false,
                                      itemsToShow: 4,
                                      infiniteScroll: true
                                    }
                                  },
                                  [
                                    _vm._l(_vm.products, function(
                                      product,
                                      $index
                                    ) {
                                      return _c("slide", { key: $index }, [
                                        _c(
                                          "div",
                                          { staticClass: "thumbnail-wrapper" },
                                          [
                                            _c(
                                              "a",
                                              {
                                                attrs: { href: "" },
                                                on: {
                                                  click: function($event) {
                                                    $event.preventDefault()
                                                    _vm.cur =
                                                      product.details.category_id
                                                  }
                                                }
                                              },
                                              [
                                                _c("v-lazy-image", {
                                                  staticClass: "thumbnail",
                                                  attrs: {
                                                    src:
                                                      _vm.$root.storageUrl +
                                                      "/creator_images/" +
                                                      _vm.img.id +
                                                      "/previews/categories/" +
                                                      product.details
                                                        .category_id +
                                                      "/post/700.jpg",
                                                    "src-placeholder":
                                                      _vm.$root.storageUrl +
                                                      "/images/placeholder-white.png"
                                                  }
                                                })
                                              ],
                                              1
                                            )
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
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "tab-pane", attrs: { id: "stories" } },
                          [
                            _c("div", { staticClass: "row col-md-12" }, [
                              _c(
                                "div",
                                { staticClass: "col-md-6" },
                                [
                                  _c(
                                    "transition",
                                    { attrs: { name: "fade" } },
                                    [
                                      _c("v-lazy-image", {
                                        key: _vm.cur,
                                        staticClass: "prev-gallery-img",
                                        attrs: {
                                          src:
                                            _vm.$root.storageUrl +
                                            "/creator_images/" +
                                            _vm.img.id +
                                            "/previews/categories/" +
                                            _vm.cur +
                                            "/story/700.jpg",
                                          "src-placeholder":
                                            _vm.$root.storageUrl +
                                            "/images/placeholder-white.png"
                                        }
                                      })
                                    ],
                                    1
                                  )
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "div",
                                { staticClass: "col-md-6 right-side" },
                                [
                                  _c("div", { staticClass: "title" }, [
                                    _vm._v(
                                      "Image " +
                                        _vm._s(_vm.img.id) +
                                        " on " +
                                        _vm._s(_vm.categories[_vm.cur])
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "margin-10" }, [
                                    _vm._v("Link to product page -")
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "link" }, [
                                    _c(
                                      "a",
                                      {
                                        attrs: {
                                          target: "_blank",
                                          href: "/product-" + _vm.curPid
                                        }
                                      },
                                      [
                                        _vm._v(
                                          _vm._s(_vm.$root.currentUrl) +
                                            "product-" +
                                            _vm._s(_vm.curPid)
                                        )
                                      ]
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "a",
                                    {
                                      staticClass: "copy margin-10",
                                      attrs: { href: "" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          return _vm.copyToClipboard(
                                            _vm.$root.currentUrl +
                                              "product-" +
                                              _vm.curPid
                                          )
                                        }
                                      }
                                    },
                                    [
                                      _c("i", { staticClass: "fas fa-link" }),
                                      _vm._v(" Copy Link")
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    { staticClass: "tags-box" },
                                    [
                                      _c("label", { attrs: { for: "tags" } }, [
                                        _vm._v("Suggested captions")
                                      ]),
                                      _vm._v(" "),
                                      _vm._l(_vm.tags, function(imgTag, j) {
                                        return _c(
                                          "div",
                                          { key: j, staticClass: "tag" },
                                          [
                                            _c(
                                              "span",
                                              { staticClass: "value" },
                                              [_vm._v("#" + _vm._s(imgTag))]
                                            )
                                          ]
                                        )
                                      })
                                    ],
                                    2
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "a",
                                    {
                                      staticClass: "download-btn btn purple",
                                      attrs: { href: "" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          return _vm.downloadImage(
                                            _vm.$root.storageUrl +
                                              "/creator_images/" +
                                              _vm.img.id +
                                              "/previews/categories/" +
                                              _vm.cur +
                                              "/story/700.jpg",
                                            _vm.categories[_vm.cur] +
                                              " " +
                                              _vm.img.id
                                          )
                                        }
                                      }
                                    },
                                    [_vm._v("Download Image")]
                                  )
                                ]
                              )
                            ]),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "carusel-box" },
                              [
                                _c(
                                  "hooper",
                                  {
                                    attrs: {
                                      wheelControl: false,
                                      itemsToShow: 4,
                                      infiniteScroll: true
                                    }
                                  },
                                  [
                                    _vm._l(_vm.products, function(
                                      product,
                                      $index
                                    ) {
                                      return _c("slide", { key: $index }, [
                                        _c(
                                          "div",
                                          { staticClass: "thumbnail-wrapper" },
                                          [
                                            _c(
                                              "a",
                                              {
                                                attrs: { href: "" },
                                                on: {
                                                  click: function($event) {
                                                    $event.preventDefault()
                                                    _vm.cur =
                                                      product.details.category_id
                                                  }
                                                }
                                              },
                                              [
                                                _c("v-lazy-image", {
                                                  staticClass: "thumbnail",
                                                  attrs: {
                                                    src:
                                                      _vm.$root.storageUrl +
                                                      "/creator_images/" +
                                                      _vm.img.id +
                                                      "/previews/categories/" +
                                                      product.details
                                                        .category_id +
                                                      "/story/700.jpg",
                                                    "src-placeholder":
                                                      _vm.$root.storageUrl +
                                                      "/images/placeholder-white.png"
                                                  }
                                                })
                                              ],
                                              1
                                            )
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
                          ]
                        )
                      ]
                    )
                  : _c(
                      "div",
                      {
                        staticClass:
                          "tab-content tab-content--padded edit-photo__tab-content"
                      },
                      [
                        _c(
                          "div",
                          {
                            staticClass: "tab-pane active",
                            attrs: { id: "posts" }
                          },
                          _vm._l(_vm.galleryObj.templates_list, function(
                            template,
                            pid
                          ) {
                            return _c(
                              "div",
                              { key: pid, staticClass: "item" },
                              [
                                _c(
                                  "div",
                                  { staticClass: "img-frame" },
                                  [
                                    _c("v-lazy-image", {
                                      key: _vm.cur,
                                      staticClass: "prev-gallery-img",
                                      attrs: {
                                        src:
                                          _vm.$root.storageUrl +
                                          "/creator_images/" +
                                          _vm.img.id +
                                          "/previews/categories/" +
                                          _vm.cur +
                                          "/post/700.jpg",
                                        "src-placeholder":
                                          _vm.$root.storageUrl +
                                          "/images/placeholder-white.png"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c("div", { staticClass: "title" }, [
                                  _vm._v(
                                    "Image " +
                                      _vm._s(_vm.img.id) +
                                      " on " +
                                      _vm._s(
                                        _vm.categories[template.our_category_id]
                                      )
                                  )
                                ]),
                                _vm._v(" "),
                                _c(
                                  "a",
                                  {
                                    staticClass: "copy margin-10",
                                    attrs: { href: "" },
                                    on: {
                                      click: function($event) {
                                        $event.preventDefault()
                                        return _vm.copyToClipboard(
                                          _vm.$root.currentUrl +
                                            "@" +
                                            _vm.username
                                        )
                                      }
                                    }
                                  },
                                  [
                                    _c("i", { staticClass: "fas fa-link" }),
                                    _vm._v(" Store link")
                                  ]
                                ),
                                _vm._v(" "),
                                _c(
                                  "a",
                                  {
                                    staticClass: "download-btn btn purple",
                                    attrs: { href: "" },
                                    on: {
                                      click: function($event) {
                                        $event.preventDefault()
                                        return _vm.downloadImage(
                                          _vm.$root.storageUrl +
                                            "/temp/" +
                                            _vm.img.id +
                                            "_" +
                                            _vm.cur +
                                            "_post.jpg",
                                          _vm.categories[_vm.cur] +
                                            " " +
                                            _vm.img.id
                                        )
                                      }
                                    }
                                  },
                                  [_vm._v("Download Image")]
                                )
                              ]
                            )
                          }),
                          0
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "tab-pane", attrs: { id: "stories" } },
                          _vm._l(_vm.galleryObj.templates_list, function(
                            template,
                            pid
                          ) {
                            return _c(
                              "div",
                              { key: pid, staticClass: "item" },
                              [
                                _c("v-lazy-image", {
                                  key: _vm.cur,
                                  staticClass: "prev-gallery-img",
                                  attrs: {
                                    src:
                                      _vm.$root.storageUrl +
                                      "/temp/" +
                                      _vm.img.id +
                                      "_" +
                                      template.our_category_id +
                                      "_story.jpg",
                                    "src-placeholder":
                                      _vm.$root.storageUrl +
                                      "/images/placeholder-white.png"
                                  }
                                }),
                                _vm._v(" "),
                                _c("div", { staticClass: "title" }, [
                                  _vm._v(
                                    "Image " +
                                      _vm._s(_vm.img.id) +
                                      " on " +
                                      _vm._s(
                                        _vm.categories[template.our_category_id]
                                      )
                                  )
                                ]),
                                _vm._v(" "),
                                _c(
                                  "a",
                                  {
                                    staticClass: "copy margin-10",
                                    attrs: { href: "" },
                                    on: {
                                      click: function($event) {
                                        $event.preventDefault()
                                        return _vm.copyToClipboard(
                                          _vm.$root.currentUrl +
                                            "@" +
                                            _vm.username
                                        )
                                      }
                                    }
                                  },
                                  [
                                    _c("i", { staticClass: "fas fa-link" }),
                                    _vm._v(" Store link")
                                  ]
                                ),
                                _vm._v(" "),
                                _c(
                                  "a",
                                  {
                                    staticClass: "download-btn btn purple",
                                    attrs: { href: "" },
                                    on: {
                                      click: function($event) {
                                        $event.preventDefault()
                                        return _vm.downloadImage(
                                          _vm.$root.storageUrl +
                                            "/temp/" +
                                            _vm.img.id +
                                            "_" +
                                            _vm.cur +
                                            "_story.jpg",
                                          _vm.categories[_vm.cur] +
                                            " " +
                                            _vm.img.id
                                        )
                                      }
                                    }
                                  },
                                  [_vm._v("Download Image")]
                                )
                              ],
                              1
                            )
                          }),
                          0
                        )
                      ]
                    )
              ]
            )
          ])
        : _vm._e()
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/admin/MediaModal.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/admin/MediaModal.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MediaModal_vue_vue_type_template_id_2922edd4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MediaModal.vue?vue&type=template&id=2922edd4& */ "./resources/js/components/admin/MediaModal.vue?vue&type=template&id=2922edd4&");
/* harmony import */ var _MediaModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MediaModal.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/MediaModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _MediaModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _MediaModal_vue_vue_type_template_id_2922edd4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _MediaModal_vue_vue_type_template_id_2922edd4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/MediaModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/MediaModal.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/admin/MediaModal.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MediaModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./MediaModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/MediaModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MediaModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/MediaModal.vue?vue&type=template&id=2922edd4&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/admin/MediaModal.vue?vue&type=template&id=2922edd4& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MediaModal_vue_vue_type_template_id_2922edd4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./MediaModal.vue?vue&type=template&id=2922edd4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/MediaModal.vue?vue&type=template&id=2922edd4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MediaModal_vue_vue_type_template_id_2922edd4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MediaModal_vue_vue_type_template_id_2922edd4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);