(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ShopModal.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ShopModal.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _apis_Api__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../apis/Api */ "./resources/js/apis/Api.js");
/* harmony import */ var hooper__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! hooper */ "./node_modules/hooper/dist/hooper.esm.js");
/* harmony import */ var hooper_dist_hooper_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! hooper/dist/hooper.css */ "./node_modules/hooper/dist/hooper.css");
/* harmony import */ var hooper_dist_hooper_css__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(hooper_dist_hooper_css__WEBPACK_IMPORTED_MODULE_2__);
var _methods;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'ShopModal',
  props: ['creator'],
  components: {
    Hooper: hooper__WEBPACK_IMPORTED_MODULE_1__["Hooper"],
    Slide: hooper__WEBPACK_IMPORTED_MODULE_1__["Slide"],
    HooperNavigation: hooper__WEBPACK_IMPORTED_MODULE_1__["Navigation"]
  },
  data: function data() {
    return {
      img: 0,
      quantity: 1,
      curProduct: null,
      selectedProperties: {},
      categories: [],
      products: [],
      productsByCategory: {},
      prices: {}
    };
  },
  watch: {
    creator: function creator(newVal, oldVal) {// this.prices=JSON.parse(this.creator.products_price);
    },
    curProduct: function curProduct(newVal, oldVal) {
      this.selectedProperties = {};

      if (JSON.parse(this.curProduct.details.production_details.other).hasOwnProperty('requireProperties')) {
        var properties = JSON.parse(this.curProduct.details.production_details.other).requireProperties;

        for (var name in properties) {
          this.$set(this.selectedProperties, properties[name].name, 'none');
        }
      }
    }
  },
  created: function created() {
    this.prices = JSON.parse(this.creator.products_price);
    this.selectedProperties = {};
  },
  methods: (_methods = {
    like: function like(img) {
      var _this = this;

      this.$root.clicked = true;
      this.$parent.imgLikeClicked.push(img.id);
      img.likes++;
      _apis_Api__WEBPACK_IMPORTED_MODULE_0__["default"].get('/api/image-like/' + img.id).then(function (response) {
        _this.$root.clicked = false;
      });
    },
    showMore: function showMore() {
      $ma.trackEvent({
        action: 'quick-view-popup',
        properties: {
          feature: 'show-more-button',
          type: 'button-clicked'
        }
      });
      this.$router.push('/product-' + this.curProduct.id);
    },
    goShopUrl: function goShopUrl() {
      return this.$root.currentUrl.replace('https://my.', 'https://shop.');
    }
  }, _defineProperty(_methods, "showMore", function showMore(event) {
    var element = $(event.target).closest('.details');

    if ($(event.target).html() == 'Show More...') {
      element.find('.desc').css('height', 'auto'); // element.closest('.hooper').css('height','auto');

      $(event.target).html('Show Less...');
      setTimeout(function () {
        $(event.target).click();
      }, 3000);
    } else {
      element.find('.desc').css('height', '75px'); // element.closest('.hooper').css('height','390px');

      $(event.target).html('Show More...');
    }
  }), _defineProperty(_methods, "goToShop", function goToShop(imgId) {
    this.$ma.trackEvent({
      action: 'quick-view-popup',
      properties: {
        feature: 'view-all-products-button',
        type: 'clicked'
      }
    });
    window.location.href = '/gallery/' + imgId;
  }), _defineProperty(_methods, "addToCart", function addToCart() {
    var _this2 = this;

    var goCheckoutPage = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

    if (JSON.parse(this.curProduct.details.production_details.other).hasOwnProperty('requireProperties')) {
      var properties = JSON.parse(this.curProduct.details.production_details.other).requireProperties;

      for (var name in properties) {
        if (this.selectedProperties[properties[name].name] == 'none') {
          this.$toast.error({
            title: 'Please choose a ' + properties[name].name,
            message: "It will look better on you",
            position: this.$root.toastPosition
          });
          return;
        }
      }
    }

    this.$ma.trackEvent({
      action: 'quick-view-popup',
      properties: {
        feature: 'add-to-cart-button',
        type: 'clicked'
      }
    });
    _apis_Api__WEBPACK_IMPORTED_MODULE_0__["default"].post('/api/add-item-to-cart', {
      'productId': this.curProduct.id,
      'properties': this.selectedProperties,
      'quantity': this.quantity,
      'previewUrl': this.$root.currentUrl + $root.storageUrl + '/creator_images/' + this.img.id + '/previews/' + this.curProduct.product_code + '/1000_1.jpg',
      'price': (this.prices[this.curProduct.product_code] * (100 - this.creator.discount) / 100).toFixed(2)
    }).then(function (response) {
      _this2.$root.$refs.app.$refs.nav.$refs.cart.cartContent = _this2.img.products;
      if (goCheckoutPage) _this2.$router.push({
        name: "Checkout"
      });
    }); // ga('send', 'event', 'EnhancedEcommerce', 'Added Product', window.location.pathname);
    // fbq('track', 'AddToCart', {
    //   content_ids: element.data('pid'),
    //   content_name: element.find('.details .title').html(),
    //   content_type: 'product',
    //   value: element.find('.details .dis-price .inpt').html(),
    //   content_category: element.find('.details .dis-price').data('cat_name'),
    //   currency: 'USD',
    // });
  }), _defineProperty(_methods, "slideTo", function slideTo(index) {
    this.$refs.carousel.slideTo(index);
  }), _defineProperty(_methods, "getProductPreviews", function getProductPreviews() {
    var that = this; // Api.get('/api/image-products/' + this.img.id)
    // .then(response => {

    for (var index in this.img.products) {
      if (that.categories.includes(this.img.products[index].details.category_id)) {
        that.$set(that.productsByCategory[this.img.products[index].details.category_id], this.img.products[index].id, this.img.products[index]);
      } else {
        that.$set(that.productsByCategory, this.img.products[index].details.category_id, {});
        that.$set(that.productsByCategory[this.img.products[index].details.category_id], this.img.products[index].id, this.img.products[index]); // that.$set(that.products, index, {});

        that.products.push(this.img.products[index]);
        that.categories.push(this.img.products[index].details.category_id);
      }

      if (index == 0) that.curProduct = this.img.products[index];
    } // });

  }), _defineProperty(_methods, "isEmpty", function isEmpty(a, b) {// return Object.keys(this.galleryObj.children_array[a][b]).length > 1;
  }), _defineProperty(_methods, "openModal", function openModal(img) {
    this.img = img;
    this.getProductPreviews();
    this.$modal.show('ShopModal');
  }), _defineProperty(_methods, "beforeOpen", function beforeOpen(event) {
    this.$root.clicked = true;
  }), _defineProperty(_methods, "beforeClose", function beforeClose(event) {
    this.$root.clicked = false;
  }), _methods)
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ShopModal.vue?vue&type=template&id=4a588008&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ShopModal.vue?vue&type=template&id=4a588008& ***!
  \************************************************************************************************************************************************************************************************************/
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
      staticClass: "top",
      attrs: {
        name: "ShopModal",
        width: "860px",
        height: "auto",
        scrollable: true,
        reset: true
      },
      on: { "before-open": _vm.beforeOpen, "before-close": _vm.beforeClose }
    },
    [
      _c("div", { staticClass: "shop-modal" }, [
        _c(
          "a",
          {
            staticClass: "close",
            on: {
              click: function($event) {
                $event.preventDefault()
                return _vm.$modal.hide("ShopModal")
              }
            }
          },
          [
            _c(
              "svg",
              {
                staticClass: "icon",
                staticStyle: {
                  width: "20px",
                  height: "20px",
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
        _c("div", {}, [
          _c("div", { staticClass: "user-big-thumb" }, [
            _c("img", {
              attrs: {
                src:
                  _vm.$root.storageUrl +
                  "/creator_images/" +
                  _vm.creator.id +
                  ".jpg",
                alt: "Avatar of user"
              }
            })
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "row-one" }, [
            _c("div", { staticClass: "title" }, [
              _vm._v(_vm._s(_vm.img.name)),
              _c("span", [_vm._v(" (ID " + _vm._s(_vm.img.id) + ")")])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "desc" }, [
              _vm._v(_vm._s(_vm.img.description))
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "row-two" }, [
          _c(
            "div",
            { staticStyle: { "margin-bottom": "20px", position: "relative" } },
            [
              _c("transition", { attrs: { name: "fade" } }, [
                _vm.curProduct
                  ? _c(
                      "div",
                      { key: _vm.curProduct, staticClass: "row cur-box" },
                      [
                        _c("div", { staticClass: "col-md-6" }, [
                          _c(
                            "div",
                            { staticClass: "product-preview-box" },
                            [
                              _c(
                                "ShareNetwork",
                                {
                                  attrs: {
                                    network: "pinterest",
                                    url:
                                      _vm.$root.currentUrl +
                                      "/product-" +
                                      _vm.curProduct.id,
                                    title: _vm.img.name,
                                    description: _vm.img.description,
                                    media:
                                      _vm.$root.currentUrl +
                                      _vm.$root.storageUrl +
                                      "/creator_images/" +
                                      _vm.img.id +
                                      "/previews/" +
                                      _vm.curProduct.product_code +
                                      "/1000_1.jpg"
                                  },
                                  on: {
                                    open: function($event) {
                                      _vm.$root.clicked = true
                                    },
                                    close: function($event) {
                                      _vm.$root.clicked = false
                                    }
                                  }
                                },
                                [
                                  _c(
                                    "svg",
                                    {
                                      staticStyle: {
                                        "enable-background": "new 0 0 512 512"
                                      },
                                      attrs: {
                                        height: "30px",
                                        id: "Layer_1",
                                        version: "1.1",
                                        viewBox: "0 0 512 512",
                                        width: "30px",
                                        "xml:space": "preserve",
                                        xmlns: "http://www.w3.org/2000/svg",
                                        "xmlns:cc":
                                          "http://creativecommons.org/ns#",
                                        "xmlns:dc":
                                          "http://purl.org/dc/elements/1.1/",
                                        "xmlns:inkscape":
                                          "http://www.inkscape.org/namespaces/inkscape",
                                        "xmlns:rdf":
                                          "http://www.w3.org/1999/02/22-rdf-syntax-ns#",
                                        "xmlns:sodipodi":
                                          "http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd",
                                        "xmlns:svg":
                                          "http://www.w3.org/2000/svg"
                                      }
                                    },
                                    [
                                      _c("defs", { attrs: { id: "defs19" } }),
                                      _c("g", { attrs: { id: "g3031" } }, [
                                        _c("path", {
                                          staticStyle: {
                                            fill: "#cb2027",
                                            "fill-opacity": "1"
                                          },
                                          attrs: {
                                            d:
                                              "m 511.672,255.92999 c 0,141.3849 -114.61511,256 -256,256 -141.3849,0 -256.00000293,-114.6151 -256.00000293,-256 C -0.32800293,114.5451 114.2871,-0.07000732 255.672,-0.07000732 c 141.38489,0 256,114.61510732 256,255.99999732 z",
                                            id: "circle8"
                                          }
                                        }),
                                        _c(
                                          "g",
                                          {
                                            attrs: {
                                              id: "g3000",
                                              transform:
                                                "translate(-603.11865,-9.8474559)"
                                            }
                                          },
                                          [
                                            _c(
                                              "g",
                                              {
                                                attrs: {
                                                  id: "g3142",
                                                  transform:
                                                    "translate(221.28814,-27.9639)"
                                                }
                                              },
                                              [
                                                _c(
                                                  "g",
                                                  { attrs: { id: "Layer_14" } },
                                                  [
                                                    _c(
                                                      "g",
                                                      {
                                                        attrs: { id: "g3121" }
                                                      },
                                                      [
                                                        _c("path", {
                                                          staticStyle: {
                                                            fill: "#ffffff"
                                                          },
                                                          attrs: {
                                                            d:
                                                              "m 645.85601,122.6817 c -93.402,0 -140.5,66.963 -140.5,122.815 0,33.812 12.796,63.89 40.25,75.089 4.505,1.858 8.54,0.065 9.849,-4.916 0.906,-3.438 3.055,-12.139 4.015,-15.777 1.31,-4.928 0.799,-6.646 -2.833,-10.957 -7.916,-9.332 -12.985,-21.416 -12.985,-38.551 0,-49.677 37.175,-94.154 96.794,-94.154 52.797,0 81.801,32.26 81.801,75.329 0,56.692 -25.089,104.534 -62.325,104.534 -20.563,0 -35.953,-16.999 -31.031,-37.865 5.908,-24.908 17.355,-51.777 17.355,-69.771 0,-16.087 -8.646,-29.507 -26.513,-29.507 -21.021,0 -37.913,21.752 -37.913,50.884 0,18.558 6.271,31.112 6.271,31.112 0,0 -21.518,91.16 -25.291,107.125 -7.506,31.798 -1.128,70.766 -0.584,74.692 0.315,2.343 3.317,2.907 4.68,1.142 1.927,-2.53 26.983,-33.441 35.482,-64.34 2.417,-8.739 13.831,-54.032 13.831,-54.032 6.835,13.038 26.794,24.491 48.024,24.491 63.19,0 106.072,-57.604 106.072,-134.719 0.006,-58.317 -49.387,-112.624 -124.449,-112.624 z",
                                                            id: "path3131"
                                                          }
                                                        })
                                                      ]
                                                    )
                                                  ]
                                                ),
                                                _c("g", {
                                                  attrs: { id: "Layer_1_1_-8" }
                                                })
                                              ]
                                            )
                                          ]
                                        )
                                      ]),
                                      _c("g", { attrs: { id: "Layer_1_1_" } })
                                    ]
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("div", { staticClass: "likes" }, [
                                !_vm.$parent.imgLikeClicked.includes(_vm.img.id)
                                  ? _c(
                                      "svg",
                                      {
                                        staticClass: "heart",
                                        attrs: {
                                          id: "Layer_1",
                                          "data-name": "Layer 1",
                                          xmlns: "http://www.w3.org/2000/svg",
                                          viewBox: "0 0 150 150"
                                        },
                                        on: {
                                          click: function($event) {
                                            return _vm.like(_vm.img)
                                          }
                                        }
                                      },
                                      [
                                        _c("defs"),
                                        _c("g", { staticClass: "cls-1" }, [
                                          _c("circle", {
                                            staticClass: "cls-2",
                                            attrs: {
                                              cx: "75",
                                              cy: "75",
                                              r: "74.88"
                                            }
                                          }),
                                          _c("path", {
                                            staticClass: "cls-3",
                                            attrs: {
                                              d:
                                                "M150,68.25A74.75,74.75,0,1,1,75.25,143,74.83,74.83,0,0,1,150,68.25m0-.25a75,75,0,1,0,75,75,75,75,0,0,0-75-75Z",
                                              transform: "translate(-75 -68)"
                                            }
                                          })
                                        ]),
                                        _c("path", {
                                          staticClass: "cls-4",
                                          attrs: {
                                            d:
                                              "M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z",
                                            transform: "translate(-75 -68)"
                                          }
                                        }),
                                        _c("path", {
                                          staticClass: "cls-5",
                                          attrs: {
                                            d:
                                              "M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z",
                                            transform: "translate(-75 -68)"
                                          }
                                        })
                                      ]
                                    )
                                  : _c(
                                      "svg",
                                      {
                                        staticClass: "heart2",
                                        attrs: {
                                          id: "Layer_1",
                                          "data-name": "Layer 1",
                                          xmlns: "http://www.w3.org/2000/svg",
                                          viewBox: "0 0 150 150"
                                        },
                                        on: {
                                          click: function($event) {
                                            return _vm.like(_vm.img)
                                          }
                                        }
                                      },
                                      [
                                        _c("defs"),
                                        _c("g", { staticClass: "cls-1" }, [
                                          _c("circle", {
                                            staticClass: "cls-2",
                                            attrs: {
                                              cx: "75",
                                              cy: "75",
                                              r: "74.88"
                                            }
                                          }),
                                          _c("path", {
                                            staticClass: "cls-3",
                                            attrs: {
                                              d:
                                                "M150,68.25A74.75,74.75,0,1,1,75.25,143,74.83,74.83,0,0,1,150,68.25m0-.25a75,75,0,1,0,75,75,75,75,0,0,0-75-75Z",
                                              transform: "translate(-75 -68)"
                                            }
                                          })
                                        ]),
                                        _c("path", {
                                          staticClass: "cls-4",
                                          attrs: {
                                            d:
                                              "M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z",
                                            transform: "translate(-75 -68)"
                                          }
                                        })
                                      ]
                                    )
                              ]),
                              _vm._v(" "),
                              _c("v-lazy-image", {
                                attrs: {
                                  src:
                                    _vm.$root.storageUrl +
                                    "/creator_images/" +
                                    _vm.img.id +
                                    "/previews/" +
                                    _vm.curProduct.product_code +
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
                            _vm._v(_vm._s(_vm.curProduct.details.category.name))
                          ]),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "price" },
                            [
                              _c(
                                "transition",
                                { attrs: { name: "fade", mode: "out-in" } },
                                [
                                  _c("span", { staticClass: "before" }, [
                                    _vm._v(
                                      "$" +
                                        _vm._s(
                                          _vm.prices[
                                            _vm.curProduct.product_code
                                          ]
                                        )
                                    )
                                  ])
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "transition",
                                { attrs: { name: "fade", mode: "out-in" } },
                                [
                                  _c("span", { staticClass: "after" }, [
                                    _vm._v(
                                      "$" +
                                        _vm._s(
                                          (
                                            (_vm.prices[
                                              _vm.curProduct.product_code
                                            ] *
                                              (100 - _vm.creator.discount)) /
                                            100
                                          ).toFixed(2)
                                        )
                                    )
                                  ])
                                ]
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          Object.keys(
                            _vm.productsByCategory[
                              _vm.curProduct.details.category_id
                            ]
                          ).length > 1
                            ? _c("div", { staticClass: "product" }, [
                                _c("div", { staticClass: "label" }, [
                                  _vm._v("TYPE")
                                ]),
                                _vm._v(" "),
                                _c("div", { staticClass: "dropdown show" }, [
                                  _c(
                                    "a",
                                    {
                                      staticClass: "button dropdown-toggle",
                                      attrs: {
                                        href: "#",
                                        role: "button",
                                        id: "dropdownMenuLink",
                                        "data-toggle": "dropdown",
                                        "aria-haspopup": "true",
                                        "aria-expanded": "false"
                                      }
                                    },
                                    [
                                      _vm._v(
                                        "\n                    " +
                                          _vm._s(_vm.curProduct.details.title) +
                                          "\n                  "
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    {
                                      staticClass: "dropdown-menu",
                                      attrs: {
                                        "aria-labelledby": "dropdownMenuLink"
                                      }
                                    },
                                    _vm._l(
                                      _vm.productsByCategory[
                                        _vm.curProduct.details.category_id
                                      ],
                                      function(otherModel, pid) {
                                        return _c(
                                          "a",
                                          {
                                            staticClass: "dropdown-item",
                                            attrs: { href: "" },
                                            on: {
                                              click: function($event) {
                                                $event.preventDefault()
                                                _vm.product = otherModel
                                              }
                                            }
                                          },
                                          [
                                            _vm._v(
                                              _vm._s(otherModel.details.title)
                                            )
                                          ]
                                        )
                                      }
                                    ),
                                    0
                                  )
                                ])
                              ])
                            : _vm._e(),
                          _vm._v(" "),
                          JSON.parse(
                            _vm.curProduct.details.production_details.other
                          ) &&
                          JSON.parse(
                            _vm.curProduct.details.production_details.other
                          ).hasOwnProperty("requireProperties")
                            ? _c(
                                "div",
                                { staticClass: "properties" },
                                _vm._l(
                                  JSON.parse(
                                    _vm.curProduct.details.production_details
                                      .other
                                  ).requireProperties,
                                  function(property, index) {
                                    return _c(
                                      "div",
                                      {
                                        key: index,
                                        staticClass: "property",
                                        class: property.name
                                      },
                                      [
                                        _c("label", [
                                          _vm._v(_vm._s(property.name) + "  ")
                                        ]),
                                        _vm._v(" "),
                                        _c("br"),
                                        _vm._v(" "),
                                        property.name != "color"
                                          ? _c(
                                              "select",
                                              {
                                                directives: [
                                                  {
                                                    name: "model",
                                                    rawName: "v-model",
                                                    value:
                                                      _vm.selectedProperties[
                                                        property.name
                                                      ],
                                                    expression:
                                                      "selectedProperties[property.name]"
                                                  }
                                                ],
                                                on: {
                                                  change: function($event) {
                                                    var $$selectedVal = Array.prototype.filter
                                                      .call(
                                                        $event.target.options,
                                                        function(o) {
                                                          return o.selected
                                                        }
                                                      )
                                                      .map(function(o) {
                                                        var val =
                                                          "_value" in o
                                                            ? o._value
                                                            : o.value
                                                        return val
                                                      })
                                                    _vm.$set(
                                                      _vm.selectedProperties,
                                                      property.name,
                                                      $event.target.multiple
                                                        ? $$selectedVal
                                                        : $$selectedVal[0]
                                                    )
                                                  }
                                                }
                                              },
                                              [
                                                _c(
                                                  "option",
                                                  {
                                                    attrs: {
                                                      disabled: "",
                                                      selected: "",
                                                      value: "none"
                                                    }
                                                  },
                                                  [_vm._v("-")]
                                                ),
                                                _vm._v(" "),
                                                _vm._l(
                                                  property.options,
                                                  function(option, optionName) {
                                                    return _c(
                                                      "option",
                                                      {
                                                        domProps: {
                                                          value: optionName
                                                        }
                                                      },
                                                      [
                                                        _vm._v(
                                                          _vm._s(optionName)
                                                        )
                                                      ]
                                                    )
                                                  }
                                                )
                                              ],
                                              2
                                            )
                                          : _c(
                                              "div",
                                              _vm._l(property.options, function(
                                                option,
                                                optionName
                                              ) {
                                                return _c("span", {
                                                  class:
                                                    _vm.selectedProperties[
                                                      property.name
                                                    ] == optionName
                                                      ? "active"
                                                      : "",
                                                  style:
                                                    "background:" + optionName,
                                                  on: {
                                                    click: function($event) {
                                                      return _vm.chooseColor(
                                                        optionName
                                                      )
                                                    }
                                                  }
                                                })
                                              }),
                                              0
                                            )
                                      ]
                                    )
                                  }
                                ),
                                0
                              )
                            : _vm._e(),
                          _vm._v(" "),
                          _c("div", { staticClass: "bottom" }, [
                            _c(
                              "a",
                              {
                                staticClass: "add-to-cart btn purple negative",
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    return _vm.addToCart()
                                  }
                                }
                              },
                              [_vm._v("Add To Cart")]
                            ),
                            _vm._v(" "),
                            _c(
                              "a",
                              {
                                staticClass: "checkout btn purple",
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    return _vm.addToCart(true)
                                  }
                                }
                              },
                              [_vm._v("Express Checkout")]
                            ),
                            _vm._v(" "),
                            _c(
                              "a",
                              {
                                staticClass: "view",
                                attrs: { href: "" },
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    return _vm.$router.push(
                                      "/product-" + _vm.curProduct.id
                                    )
                                  }
                                }
                              },
                              [_vm._v("View product")]
                            ),
                            _vm._v(" "),
                            _c("div", { staticClass: "likes-counter" }, [
                              _c(
                                "svg",
                                {
                                  attrs: {
                                    id: "Layer_1",
                                    "data-name": "Layer 1",
                                    xmlns: "http://www.w3.org/2000/svg",
                                    viewBox: "0 0 294.89 284"
                                  }
                                },
                                [
                                  _c("defs"),
                                  _c("path", {
                                    staticClass: "cls-1",
                                    attrs: {
                                      d:
                                        "M217.25,10c44.2.25,80,42.33,80.21,94.37C297.46,199.64,150,294,150,294S2.57,198.25,2.57,104.37C2.57,52.33,38.48,10,82.78,10h0c27.13-.27,52.46,15.79,67.23,42.54C164.9,25.93,190.29,9.9,217.25,10Z",
                                      transform: "translate(-2.57 -10)"
                                    }
                                  })
                                ]
                              ),
                              _vm._v(" "),
                              _c("div", { staticClass: "number" }, [
                                _vm._v(_vm._s(_vm.img.likes))
                              ])
                            ])
                          ])
                        ])
                      ]
                    )
                  : _vm._e()
              ])
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            {},
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
                  _vm._l(_vm.products, function(product, index) {
                    return _c("slide", { key: index }, [
                      _c(
                        "div",
                        {
                          staticClass: "thumbnail-wrapper",
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.curProduct = product
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
                                "/previews/" +
                                _vm.curProduct.product_code +
                                "/1000_1.jpg",
                              "src-placeholder":
                                _vm.$root.storageUrl +
                                "/images/placeholder-white.png"
                            }
                          })
                        ],
                        1
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
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "view-full-shop",
              on: {
                click: function($event) {
                  $event.preventDefault()
                  return _vm.goToShop(_vm.img.id)
                }
              }
            },
            [
              _c("img", {
                attrs: {
                  src: _vm.$root.storageUrl + "/images/view_products_icon.png"
                }
              }),
              _vm._v(" View all products")
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

/***/ "./resources/js/components/ShopModal.vue":
/*!***********************************************!*\
  !*** ./resources/js/components/ShopModal.vue ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ShopModal_vue_vue_type_template_id_4a588008___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ShopModal.vue?vue&type=template&id=4a588008& */ "./resources/js/components/ShopModal.vue?vue&type=template&id=4a588008&");
/* harmony import */ var _ShopModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ShopModal.vue?vue&type=script&lang=js& */ "./resources/js/components/ShopModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ShopModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ShopModal_vue_vue_type_template_id_4a588008___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ShopModal_vue_vue_type_template_id_4a588008___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ShopModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ShopModal.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/components/ShopModal.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ShopModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ShopModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ShopModal.vue?vue&type=template&id=4a588008&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/ShopModal.vue?vue&type=template&id=4a588008& ***!
  \******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopModal_vue_vue_type_template_id_4a588008___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ShopModal.vue?vue&type=template&id=4a588008& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ShopModal.vue?vue&type=template&id=4a588008&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopModal_vue_vue_type_template_id_4a588008___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShopModal_vue_vue_type_template_id_4a588008___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);