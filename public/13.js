(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[13],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Footer.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/layout/Footer.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  props: [],
  watch: {
    $route: function $route(newVal, oldVal) {
      // watch it
      if (this.$route.meta.authOnly) {} else {}
    }
  },
  data: function data() {
    return {};
  },
  mounted: function mounted() {},
  methods: {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Footer.vue?vue&type=template&id=e4df7ff6&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/layout/Footer.vue?vue&type=template&id=e4df7ff6& ***!
  \****************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "footer" }, [
    _c("div", { staticClass: "footer-copyq" }, [
      _c("div", { staticClass: "row-1" }, [
        _c("img", {
          staticClass: "logo",
          attrs: { src: _vm.$root.storageUrl + "/images/artigram-logo.png" }
        }),
        _vm._v(" "),
        _c("div", { staticClass: "footer-ul" }, [
          _c("div", [
            _c(
              "a",
              {
                attrs: {
                  target: "_blank",
                  href: "https://artigram.me/about-us/"
                }
              },
              [_vm._v("About")]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                attrs: {
                  target: "_blank",
                  href: "https://artigram.me/contact-us-today/"
                }
              },
              [_vm._v("Contact Us")]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass: "shop-only",
                attrs: {
                  target: "_blank",
                  href: "https://buy.support.artigram.me/"
                },
                on: {
                  click: function($event) {
                    return _vm.$ma.trackEvent({
                      action: "footer",
                      properties: {
                        feature: "help-center-button",
                        type: "clicked"
                      }
                    })
                  }
                }
              },
              [_vm._v("Help Center")]
            )
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "social" }, [
          _c("span", [_vm._v("Follow us on")]),
          _vm._v(" "),
          _c("ul", {}, [
            _c("li", [
              _c(
                "a",
                {
                  attrs: {
                    target: "_blank",
                    href: "https://www.instagram.com/artigram_me"
                  },
                  on: {
                    click: function($event) {
                      return _vm.$ma.trackEvent({
                        action: "footer",
                        properties: {
                          feature: "social-media-button",
                          type: "instegram-clicked"
                        }
                      })
                    }
                  }
                },
                [
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
                      _c("title", [_vm._v("Instagram")]),
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
                                fill: "#3B3B3B",
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
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("li", [
              _c(
                "a",
                {
                  attrs: {
                    target: "_blank",
                    href: "https://www.facebook.com/artigram"
                  },
                  on: {
                    click: function($event) {
                      return _vm.$ma.trackEvent({
                        action: "footer",
                        properties: {
                          feature: "social-media-button",
                          type: "facebook-clicked"
                        }
                      })
                    }
                  }
                },
                [
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
                      _c("title", [_vm._v("Facebook")]),
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
                                              fill: "#3B3B3B",
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
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("li", [
              _c(
                "a",
                {
                  attrs: {
                    target: "_blank",
                    href: "https://artigram.tumblr.com/"
                  },
                  on: {
                    click: function($event) {
                      return _vm.$ma.trackEvent({
                        action: "footer",
                        properties: {
                          feature: "social-media-button",
                          type: "tumbler-clicked"
                        }
                      })
                    }
                  }
                },
                [
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
                      _c("title", [_vm._v("Tumblr")]),
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
                            { attrs: { id: "tumblr", "fill-rule": "nonzero" } },
                            [
                              _c("circle", {
                                attrs: {
                                  id: "Oval",
                                  fill: "#3B3B3B",
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
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("li", [
              _c(
                "a",
                {
                  attrs: {
                    target: "_blank",
                    href: "https://www.pinterest.com/artigramme"
                  },
                  on: {
                    click: function($event) {
                      return _vm.$ma.trackEvent({
                        action: "footer",
                        properties: {
                          feature: "social-media-button",
                          type: "pinterest-clicked"
                        }
                      })
                    }
                  }
                },
                [
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
                      _c("title", [_vm._v("Pinterest")]),
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
                                              fill: "#3B3B3B",
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
                  )
                ]
              )
            ]),
            _vm._v(" "),
            _c("li", [
              _c(
                "a",
                {
                  attrs: {
                    target: "_blank",
                    href: "https://twitter.com/Artigramme"
                  },
                  on: {
                    click: function($event) {
                      return _vm.$ma.trackEvent({
                        action: "footer",
                        properties: {
                          feature: "social-media-button",
                          type: "twitter-clicked"
                        }
                      })
                    }
                  }
                },
                [
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
                      _c("title", [_vm._v("Twitter")]),
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
                              attrs: { id: "twitter", "fill-rule": "nonzero" }
                            },
                            [
                              _c("circle", {
                                attrs: {
                                  id: "Oval",
                                  fill: "#3B3B3B",
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
                  )
                ]
              )
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "row-2" }, [
        _c("div", { staticClass: "all-right" }, [
          _vm._v("© All rights reserved ID W2P Advanced Solutions 2020")
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "ul" }, [
          _c("div", [
            _c(
              "a",
              {
                staticClass: "shop-only",
                attrs: {
                  target: "_blank",
                  href:
                    "https://buy.support.artigram.me/article/233-return-refund-terms"
                },
                on: {
                  click: function($event) {
                    return _vm.$ma.trackEvent({
                      action: "footer",
                      properties: { feature: "returns-policy", type: "clicked" }
                    })
                  }
                }
              },
              [
                _vm._v("Returns "),
                _c("span", { staticClass: "remove-from-mobile" }, [
                  _vm._v("Policy")
                ])
              ]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass: "shop-only",
                attrs: {
                  target: "_blank",
                  href:
                    "https://buy.support.artigram.me/article/231-shipping-terms"
                },
                on: {
                  click: function($event) {
                    return _vm.$ma.trackEvent({
                      action: "footer",
                      properties: {
                        feature: "shipping-policy",
                        type: "clicked"
                      }
                    })
                  }
                }
              },
              [
                _vm._v("Shipping "),
                _c("span", { staticClass: "remove-from-mobile" }, [
                  _vm._v("Policy")
                ])
              ]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                attrs: {
                  target: "_blank",
                  href: "https://artigram.me/privacy-policy-2"
                },
                on: {
                  click: function($event) {
                    return _vm.$ma.trackEvent({
                      action: "footer",
                      properties: { feature: "privacy", type: "clicked" }
                    })
                  }
                }
              },
              [_vm._v("Privacy")]
            ),
            _vm._v(" "),
            _c(
              "a",
              {
                attrs: {
                  target: "_blank",
                  href: "https://artigram.me/terms-of-use"
                },
                on: {
                  click: function($event) {
                    return _vm.$ma.trackEvent({
                      action: "footer",
                      properties: { feature: "terms-of-use", type: "clicked" }
                    })
                  }
                }
              },
              [_vm._v("Terms Of Use")]
            )
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "paypal shop-only" }, [
          _c("span", [_vm._v("We Accept ")]),
          _c(
            "svg",
            {
              staticClass: "icon",
              staticStyle: {
                width: "1.2861328125em",
                height: "1em",
                "vertical-align": "middle",
                fill: "currentColor",
                overflow: "hidden"
              },
              attrs: {
                viewBox: "0 0 1317 1024",
                version: "1.1",
                xmlns: "http://www.w3.org/2000/svg"
              }
            },
            [
              _c("path", {
                attrs: {
                  d:
                    "M425.714286 517.714286q0 21.142857-14.571429 35.142857t-35.714286 14q-16.571429 0-26.571429-9.142857t-10-25.142857q0-21.142857 14.285714-35.714286t35.428571-14.571429q16 0 26.571429 9.428571t10.571429 26zm448.571429-85.142857q0 24-12.571429 32.571429t-37.714286 8.571429l-18.285714 0.571429 9.714286-61.142857q1.142857-6.285714 7.428571-6.285714l10.285714 0q12.571429 0 20 1.142857t14.285714 7.142857 6.857143 17.428571zm200.571429 85.142857q0 20.571429-14.571429 34.857143t-35.142857 14.285714q-16.571429 0-26.857143-9.142857t-10.285714-25.142857q0-21.142857 14.285714-35.714286t35.428571-14.571429q16 0 26.571429 9.428571t10.571429 26zm-781.714286-97.714286q0-33.714286-22-48.857143t-57.428571-15.142857l-91.428571 0q-10.857143 0-12 10.857143l-37.142857 233.142857q-0.571429 3.428571 1.714286 6.285714t5.714286 2.857143l43.428571 0q11.428571 0 12.571429-10.857143l10.285714-62.857143q0.571429-4.571429 4-7.428571t8.571429-3.714286 9.714286-0.857143 10.857143 0.571429 8 0.571429q49.142857 0 77.142857-27.714286t28-76.857143zm176.571429 178.285714l23.428571-149.142857q0.571429-3.428571-1.714286-6.285714t-5.714286-2.857143l-43.428571 0q-8 0-9.714286 18.857143-15.428571-22.857143-54.285714-22.857143-41.142857 0-70 30.857143t-28.857143 72.571429q0 33.714286 19.714286 53.714286t52.857143 20q16 0 33.142857-6.857143t27.428571-18.285714q-2.285714 6.857143-2.285714 12 0 9.142857 7.428571 9.142857l39.428571 0q10.857143 0 12.571429-10.857143zm255.428571-150.285714q0-2.857143-2.285714-5.428571t-5.142857-2.571429l-44 0q-6.285714 0-10.285714 5.714286l-60.571429 89.142857-25.142857-85.714286q-2.857143-9.142857-12.571429-9.142857l-42.857143 0q-2.857143 0-5.142857 2.571429t-2.285714 5.428571q0 1.142857 11.142857 33.714286t24 70.285714 13.428571 40q-46.857143 64-46.857143 68.571429 0 7.428571 7.428571 7.428571l44 0q6.285714 0 10.285714-5.714286l145.714286-210.285714q1.142857-1.142857 1.142857-4zm217.142857-28q0-33.714286-22-48.857143t-57.428571-15.142857l-90.857143 0q-11.428571 0-12.571429 10.857143l-37.142857 233.142857q-0.571429 3.428571 1.714286 6.285714t5.714286 2.857143l46.857143 0q6.857143 0 9.142857-7.428571l10.285714-66.285714q0.571429-4.571429 4-7.428571t8.571429-3.714286 9.714286-0.857143 10.857143 0.571429 8 0.571429q49.142857 0 77.142857-27.714286t28-76.857143zm176.571429 178.285714l23.428571-149.142857q0.571429-3.428571-1.714286-6.285714t-5.714286-2.857143l-43.428571 0q-8 0-9.714286 18.857143-14.857143-22.857143-54.285714-22.857143-41.142857 0-70 30.857143t-28.857143 72.571429q0 33.714286 19.714286 53.714286t52.857143 20q16.571429 0 33.714286-6.857143t26.857143-18.285714q0 0.571429-1.142857 5.142857t-1.142857 6.857143q0 9.142857 7.428571 9.142857l39.428571 0q10.857143 0 12.571429-10.857143zm124.571429-233.714286l0-0.571429q0-8-7.428571-8l-42.285714 0q-6.285714 0-7.428571 6.285714l-37.142857 237.714286-0.571429 1.142857q0 2.857143 2.285714 5.428571t5.714286 2.571429l37.714286 0q10.857143 0 12-10.857143zm-1019.428571 76.571429q-2.857143 20-14.857143 26.285714t-34.285714 6.285714l-18.857143 0.571429 9.714286-61.142857q1.142857-6.285714 7.428571-6.285714l10.857143 0q22.857143 0 33.142857 6.571429t6.857143 27.714286zm1092.571429-294.857143l0 731.428571q0 29.714286-21.714286 51.428571t-51.428571 21.714286l-1170.285714 0q-29.714286 0-51.428571-21.714286t-21.714286-51.428571l0-731.428571q0-29.714286 21.714286-51.428571t51.428571-21.714286l1170.285714 0q29.714286 0 51.428571 21.714286t21.714286 51.428571z"
                }
              })
            ]
          ),
          _vm._v(" "),
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
                    "M868.957 192.158H155.043c-49.958 0-90.604 40.645-90.604 90.604v458.477c0 49.958 40.645 90.604 90.604 90.604h713.914c49.958 0 90.604-40.646 90.604-90.604V282.762c0-49.959-40.646-90.604-90.604-90.604z m27.29 549.08c0 15.048-12.242 27.29-27.29 27.29H155.043c-15.048 0-27.29-12.242-27.29-27.29V282.762c0-15.048 12.242-27.29 27.29-27.29h713.914c15.048 0 27.29 12.242 27.29 27.29v458.476zM298.044 519.641l-24.015-120.077H153.952s96.061 24.015 144.092 120.077zM359.174 399.564l-54.581 157.192-4.366-21.832s-21.832-58.947-78.596-93.879l45.848 181.207h63.313l89.512-222.689c0.001 0.001-60.038 0.001-61.13 0.001zM409.389 620.069h58.947l34.931-220.505H444.32zM595.024 477.766c-4.384-2.305-10.743-5.113-11.867-6.985-0.14-0.233-0.236-0.859-0.356-1.942-1.425-12.88 2.373-16.016 3.625-17.046 12.566-10.355 53.048-5.324 77.43 2.292l15.071-47.901c-14.01-4.418-85.854-24.855-124.373 6.806-11.905 9.786-25.327 28.38-21.66 61.392 3.239 29.149 22.935 39.507 38.759 47.828 11.948 6.281 25.476 13.396 42.183 29.981 1.588 2.512 4.622 11.552 1.087 16.922-5.238 7.963-32.126 17.442-99.659 2.431l-10.895 49.02c27.363 6.078 51.38 9.115 72.002 9.115 41.616 0 69.405-12.362 82.933-37.004 15.27-27.815 4.309-61.723-9.473-75.505-22.323-22.322-41.872-32.603-54.807-39.404zM763.071 399.564L668.1 621.161h56.764l12.008-31.657h74.23l6.55 30.565h52.397l-43.664-220.505h-63.314z m-9.825 147.368l32.748-85.146c0.819-0.819 17.466 85.146 17.466 85.146h-50.214z"
                }
              })
            ]
          ),
          _vm._v(" "),
          _c(
            "svg",
            {
              staticClass: "icon",
              staticStyle: {
                width: "1.2861328125em",
                height: "1em",
                "vertical-align": "middle",
                fill: "currentColor",
                overflow: "hidden"
              },
              attrs: {
                viewBox: "0 0 1317 1024",
                version: "1.1",
                xmlns: "http://www.w3.org/2000/svg"
              }
            },
            [
              _c("path", {
                attrs: {
                  d:
                    "M383.414857 533.138286l-7.460571 0q-26.843429 0-26.843429 18.285714 0 12.580571 11.410286 12.580571 9.728 0 16.018286-8.557714t6.875429-22.308571zM609.133714 512.585143l35.401143 0 0-1.682286q0.585143-2.267429 0.292571-3.730286t-0.585143-4.022857-1.170286-4.534857-2.56-3.730286-4.315429-2.852571-6.582857-1.170286q-16.018286 0-20.553143 21.723429zM917.723429 533.138286l-6.875429 0q-27.428571 0-27.428571 18.285714 0 12.580571 11.410286 12.580571 9.728 0 16.018286-8.557714t6.875429-22.308571zM1099.995429 518.290286q0-23.405714-17.115429-23.405714-10.825143 0-17.700571 11.410286t-6.875429 29.110857q0 23.990857 16.018286 23.990857 11.410286 0 18.578286-11.410286t7.168-29.696zM274.285714 437.686857l49.737143 0-25.161143 149.723429-32.036571 0 18.285714-114.834286-40.594286 114.834286-22.308571 0-2.267429-114.322286-19.456 114.322286-30.281143 0 25.161143-149.723429 46.299429 0 1.170286 93.110857zM418.889143 498.834286q0 3.437714-2.267429 23.990857-9.142857 57.709714-9.728 64.585143l-26.843429 0 0.585143-12.580571q-11.410286 14.848-33.133714 14.848-13.165714 0-21.430857-9.142857t-8.265143-23.990857q0-22.308571 14.848-34.596571t41.691429-12.288q7.972571 0 13.165714 0.585143 0-1.682286 0.292571-3.145143t0.585143-2.56 0.292571-1.682286q0-11.410286-20.553143-11.410286-16.603429 0-33.718857 5.705143 0-2.267429 4.022857-27.428571 21.723429-6.290286 38.253714-6.290286 42.276571 0 42.276571 35.401143zM507.977143 465.700571l-4.534857 28.013714q-12.580571-1.682286-23.405714-1.682286-15.433143 0-15.433143 9.728 0 4.534857 2.56 6.875429t12.288 6.290286q22.820571 10.825143 22.820571 34.304 0 41.179429-49.737143 40.594286-19.456 0-33.133714-3.437714 0-1.170286 4.022857-28.013714 16.603429 4.534857 29.110857 4.534857 18.285714 0 18.285714-10.825143 0-4.022857-2.56-6.582857t-12.288-7.168q-24.576-11.410286-24.576-33.718857 0-41.179429 47.981714-41.179429 17.115429 0 28.598857 2.267429zM558.299429 465.700571l16.018286 0-4.022857 29.696-16.603429 0q-1.170286 9.728-3.730286 23.113143t-4.022857 22.016-1.462857 10.313143q0 9.142857 10.825143 9.142857 4.534857 0 9.142857-1.170286l-4.534857 26.843429q-11.995429 4.022857-22.820571 4.022857-24.576 0-25.746286-26.843429 0-6.875429 4.534857-32.036571 1.682286-11.410286 14.262857-83.456l31.451429 0zM674.304 507.465143q0 13.165714-4.022857 29.696l-63.414857 0q-1.682286 12.580571 5.705143 18.870857t21.723429 6.290286q17.115429 0 33.133714-7.972571l-5.12 30.866286q-17.115429 4.534857-32.548571 4.534857-54.272 0-54.272-54.272 0-31.451429 15.725714-51.712t39.716571-20.260571q19.968 0 31.744 11.995429t11.702857 32.036571zM753.737143 465.115429q-7.460571 13.165714-12.580571 35.401143-12.580571-1.170286-17.700571 13.677714t-14.262857 73.142857l-32.036571 0 1.682286-7.972571q12.580571-74.313143 16.603429-113.737143l29.110857 0-1.682286 18.870857q7.972571-11.995429 14.555429-16.822857t16.310857-2.56zM860.598857 441.709714l-5.12 32.548571q-16.018286-7.972571-28.598857-7.972571-17.700571 0-29.110857 15.725714t-11.410286 40.301714q0 17.115429 7.68 26.843429t22.016 9.728q11.995429 0 27.428571-7.460571l-5.705143 33.718857q-16.018286 4.534857-28.598857 4.534857-25.746286 0-40.886857-17.408t-15.140571-47.177143q0-40.009143 20.260571-65.462857t52.297143-25.453714q14.848 0 34.889143 7.460571zM953.124571 498.834286q0 10.313143-2.267429 23.990857-7.460571 45.129143-9.728 64.585143l-26.258286 0 0.585143-12.580571q-11.410286 14.848-33.718857 14.848-13.165714 0-21.138286-9.142857t-7.972571-23.990857q0-22.308571 14.555429-34.596571t41.398857-12.288q8.557714 0 13.165714 0.585143 1.170286-4.022857 1.170286-7.460571 0-11.410286-20.553143-11.410286-16.603429 0-33.718857 5.705143 0-2.267429 4.534857-27.428571 21.723429-6.290286 38.253714-6.290286 41.691429 0 41.691429 35.401143zM1033.728 465.115429q-7.972571 13.677714-11.995429 35.401143-13.165714-1.170286-17.993143 13.165714t-14.555429 73.728l-32.036571 0 1.682286-7.972571q10.825143-59.465143 16.603429-113.737143l29.696 0q0 6.290286-2.267429 18.870857 8.557714-11.995429 15.140571-16.822857t15.725714-2.56zM1114.258286 437.686857l32.036571 0-24.576 149.723429-30.281143 0 1.682286-10.825143q-13.165714 13.165714-29.696 13.165714-17.700571 0-28.306286-13.677714t-10.605714-36.571429q0-30.281143 15.725714-52.589714t36.864-22.308571q17.700571 0 30.281143 16.603429zM1177.746286 512q0-84.553143-41.398857-156.013714t-113.152-113.152-156.306286-41.691429q-103.424 0-187.465143 62.829714 72.557714 66.267429 97.718857 162.304l-28.598857 0q-25.161143-85.723429-90.258286-144.603429-65.170286 58.88-90.258286 144.603429l-28.598857 0q25.161143-96.036571 97.718857-162.304-83.968-62.829714-187.465143-62.829714-84.553143 0-156.306286 41.691429t-113.152 113.152-41.398857 156.013714 41.398857 156.013714 113.152 113.152 156.306286 41.691429q103.424 0 187.465143-62.829714-68.534857-63.414857-94.281143-150.820571l28.598857 0q26.258286 78.848 86.820571 133.12 60.562286-54.272 86.820571-133.12l28.598857 0q-25.746286 87.405714-94.281143 150.820571 83.968 62.829714 187.465143 62.829714 84.553143 0 156.306286-41.691429t113.152-113.152 41.398857-156.013714zM1316.571429 146.285714l0 731.428571q0 29.696-21.723429 51.419429t-51.419429 21.723429l-1170.285714 0q-29.696 0-51.419429-21.723429t-21.723429-51.419429l0-731.428571q0-29.696 21.723429-51.419429t51.419429-21.723429l1170.285714 0q29.696 0 51.419429 21.723429t21.723429 51.419429z"
                }
              })
            ]
          ),
          _vm._v(" "),
          _c(
            "svg",
            {
              attrs: {
                "enable-background": "new 0 0 24 24",
                id: "Layer_1",
                version: "1.1",
                viewBox: "0 0 24 24",
                "xml:space": "preserve",
                xmlns: "http://www.w3.org/2000/svg",
                "xmlns:xlink": "http://www.w3.org/1999/xlink"
              }
            },
            [
              _c("g", [
                _c("path", {
                  attrs: {
                    d:
                      "M20.0538273,8h-0.5478306c-0.2045898,0-0.3707809,0.1939201-0.3707809,0.4327803v0.2705994   l-0.2546997-0.4938297c-0.0668087-0.1299295-0.1866398-0.2090597-0.3164997-0.2090597h-0.8154697   c-0.2045994,0-0.3703594,0.1939201-0.3703594,0.4327698v0.3678102l-0.1966705-0.5382805   c-0.0588703-0.1587496-0.19207-0.2622995-0.33988-0.2622995h-0.8021011c-0.0818386,0-0.1590891,0.0312595-0.2212992,0.0859699   c-0.0613794-0.0542202-0.1386299-0.0859699-0.22089-0.0859699h-0.5181694c-0.4392605,0-0.7657804,0.1250496-1.0054502,0.3678102   c-0.0271406-0.2066202-0.1741199-0.3678102-0.3590899-0.3678102H13.168066c-0.1457195,0-0.2693195,0.1011095-0.3294392,0.2437401   c-0.0229702-0.0195398-0.0413408-0.0425005-0.0668106-0.0605707c-0.2517796-0.1699791-0.5152502-0.1831694-0.8338394-0.1831694   h-1.23176c-0.0693102,0-0.1302805,0.0283298-0.1858101,0.0669203c-0.0546999-0.0385904-0.1160803-0.0669203-0.1853905-0.0669203   H8.5462465c-0.0755701,0-0.1411304,0.0327301-0.1995802,0.0776596C8.2877865,8.0332203,8.2222366,8.0004902,8.1470766,8.0004902   H7.2543564c-0.14781,0-0.2822599,0.1040401-0.33988,0.2642593L6.5963063,9.1420202L6.2459865,8.2520504   C6.1850266,8.0991602,6.0534964,8.0004902,5.9098663,8.0004902H5.0351067c-0.2046003,0-0.3699503,0.1939201-0.3699503,0.4327698   v0.3766098l-0.20084-0.5480499C4.4054465,8.1030703,4.2722464,8,4.1240163,8H3.3290064   C3.1807764,8,3.0467465,8.10355,2.9887066,8.2622995l-0.9586802,2.6215706   c-0.0492699,0.1333494-0.0371599,0.2867298,0.0309,0.4088402c0.06847,0.1211395,0.18455,0.1944094,0.30898,0.1944094h0.5820601   c0.1486499,0,0.2839301-0.1055098,0.3407199-0.2666998l0.1131501-0.3184795h0.62047l0.1114898,0.3165293   c0.0572,0.1621704,0.19207,0.2681608,0.3423901,0.2681608h1.0893798c0.2041802,0,0.3699403-0.1939201,0.3699403-0.4327803   v-0.0102501l0.0701499,0.1861c0.0588698,0.15728,0.1916499,0.2583895,0.33779,0.2583895h0.4705801   c0.1469698,0,0.2789197-0.1011095,0.3382101-0.2578993L7.2272162,11.04457v0.0107498   c0,0.2388601,0.1653504,0.4322901,0.3699503,0.4322901h0.5490699c0.07516,0,0.1407204-0.0332203,0.1995897-0.0776701   c0.0584602,0.0444498,0.1240101,0.0776701,0.1995907,0.0776701h1.7887592c0.0693207,0,0.1307001-0.0283403,0.1853905-0.0669203   c0.0559597,0.0385904,0.1164999,0.0669203,0.1858101,0.0669203h0.53613c0.2041798,0,0.3699503-0.1939201,0.3699503-0.4327803   v-0.5206995h0.2041798c0.0463495,0,0.0793295,0.0014696,0.1039696,0.0034199   c0.0025005,0.0444498,0.0016699,0.0972004,0.0016699,0.13237L11.9204369,10.72756l0.0020895,0.3306904   c0.0016699,0.2373896,0.1670198,0.4293594,0.3703604,0.4293594h0.5403099c0.0609598,0,0.1156597-0.0214996,0.1661797-0.0522699   c0.0513601,0.0307703,0.1068897,0.0522699,0.1674404,0.0522699h0.5469799c0.1791296,0,0.3211002-0.1514301,0.3557501-0.3487701   c0.30439,0.2984505,0.7311296,0.3487701,0.9695396,0.3487701h0.6271601c0.1499004,0,0.2860203-0.1074696,0.3415508-0.2711   l0.1093998-0.3140802h0.6171303l0.1131592,0.3184805c0.0584507,0.16119,0.1924801,0.2662096,0.3415508,0.2662096h1.09021   c0.2037582,0,0.3699493-0.1939201,0.3699493-0.4327793v-0.4137201l0.3286095,0.6374397   c0.0672207,0.1299305,0.1870613,0.2090597,0.3177509,0.2090597h0.7582703c0.2037582,0,0.3699398-0.1939201,0.3699398-0.4327793   V8.4327803C20.4237671,8.1939201,20.2584171,8,20.0538273,8L20.0538273,8z M10.7053766,11.0548296V8.43326h1.23176   c0.2734995,0,0.4751701,0.0083103,0.6488695,0.1255398c0.1686907,0.1172304,0.2705708,0.2881899,0.2705708,0.58078   c0,0.4176302-0.2380009,0.6340199-0.3774605,0.6984901c0.1173296,0.0522699,0.2175398,0.1445904,0.2651396,0.2207899   c0.0759907,0.1304197,0.0889406,0.2466698,0.0889406,0.4806404v0.5153294h-0.5403099l-0.0025005-0.3306894   c0-0.1577702,0.0129404-0.3844204-0.0843496-0.5104399C12.1279564,10.12187,12.0085363,10.10184,11.8156366,10.10184h-0.5741301   v0.9529896H10.7053766L10.7053766,11.0548296z M8.5449963,11.0548296V8.43326h1.7887707v0.5460997H9.080286v0.4723406h1.2238302   v0.5373096H9.080286V10.51264h1.2534809v0.5421896H8.5449963L8.5449963,11.0548296z M19.5059967,10.2596197V8.4337502h0.5478306   v2.6215696H19.295557L18.2792473,9.0878v1.9675198h-1.09021l-0.2087708-0.5846901h-1.1123505l-0.2012501,0.5846901h-0.6271591   c-0.2609701-0.0004902-0.5904102-0.0678997-0.7766304-0.2901497c-0.1887398-0.2227402-0.2872801-0.5246-0.2872801-1.0008497   c0-0.3888206,0.0588799-0.7444201,0.2885303-1.02528c0.1724396-0.2090607,0.4442701-0.3052902,0.8133793-0.3052902h0.5181704   v0.5617294H15.088356c-0.1966591,0-0.3064795,0.0341902-0.4125299,0.1553307   C14.5843868,9.2612,14.5221663,9.4692898,14.5221663,9.7447796c0,0.2803802,0.0467701,0.4830904,0.1473999,0.6149702   c0.0822506,0.1040401,0.2334003,0.1353006,0.3732805,0.1353006h0.2400894l0.7565994-2.0613003h0.8021011l0.9069099,2.4794302   V8.4337502h0.8154697L19.5059967,10.2596197L19.5059967,10.2596197z M13.1668167,11.0553198V8.4337502h0.5465698v2.6215696   H13.1668167L13.1668167,11.0553198z M6.6105065,10.2122402l0.6434398-1.7784901H8.146656v2.6215696H7.5975866l-0.00209-2.0529995   l-0.7766404,2.0529995l-0.4714098-0.0004902L5.5695662,9.00037v2.0549498H4.4797664l-0.2058501-0.5846901H3.1590664   l-0.2079399,0.5846901h-0.58164l0.9591098-2.6215696h0.7950003l0.91151,2.4823599V8.4337502h0.8743396L6.6105065,10.2122402   L6.6105065,10.2122402z M15.0403461,10.0627699c-0.0517797,0-0.0864401-0.0068398-0.1052294-0.0127001   c-0.0179501-0.0390797-0.0425901-0.1255398-0.0425901-0.3052902c0-0.1817093,0.0375795-0.27598,0.0425901-0.2842798   c0.015214-0.016839,0.0279865-0.0322514,0.1487894-0.0322514c0.0018711,0,0.0037861,0.0000038,0.0057106,0.0000114h0.1828794   L15.0403461,10.0627699L15.0403461,10.0627699z M16.4274273,8.8792295L16.059576,9.9240398h0.7390499L16.4274273,8.8792295   L16.4274273,8.8792295z M3.7139864,8.8792295l-0.3641,1.0448103h0.7302899L3.7139864,8.8792295L3.7139864,8.8792295z    M11.9008169,8.9798498h-0.6597204l-0.0004196,0.5817604h0.6509495c0.1039705,0,0.1908197-0.0014706,0.2651405-0.05373   c0.0688992-0.0425005,0.1102295-0.13482,0.1102295-0.2491198c0-0.1123505-0.0430002-0.1934309-0.1123095-0.2315302   C12.0912161,8.98522,11.9935064,8.9798498,11.9008169,8.9798498L11.9008169,8.9798498z M21.5214958,12.5119104H20.447567   c-0.3344612,0-0.5853996,0.1147795-0.7691212,0.2891598c-0.0513592-0.1675406-0.1841393-0.2891598-0.3457298-0.2891598h-1.0730896   c-0.2947903,0-0.5286198,0.0859699-0.7048206,0.2256699c-0.0634689-0.1323805-0.1803799-0.2256699-0.3190098-0.2256699h-1.7870893   c-0.1444798,0-0.2651501,0.09867-0.3261099,0.2388496c-0.0258904-0.0205097-0.0438404-0.0454197-0.0718203-0.0644703   c-0.25846-0.1616802-0.5340405-0.1743793-0.8188-0.1743793h-1.2367697c-0.1448908,0-0.26682,0.0991497-0.3273602,0.2408094   c-0.18748-0.14361-0.4513702-0.2408094-0.8263206-0.2408094h-1.7111092c-0.1031303,0-0.2012606,0.0498199-0.2714005,0.1382294   l-0.4054403,0.5119104l-0.3891497-0.5065403c-0.0697298-0.0918303-0.1695299-0.1435995-0.2751703-0.1435995H6.6355567   c-0.2041802,0-0.3699403,0.1934299-0.3699403,0.43326V15.56674C6.2656164,15.8055897,6.4309564,16,6.6355567,16h2.1215501   c0.1031399,0,0.2012596-0.0508003,0.27141-0.1392097l0.4087801-0.5177698l0.3878994,0.5109291   c0.0701399,0.0923204,0.1711903,0.1450701,0.2768307,0.1450701h1.0409393c0.2046003,0,0.3703604-0.1934299,0.3703604-0.4327698   v-0.4469395h0.29772c0.3615894,0,0.6238098-0.0869503,0.8137903-0.2193203v0.6662598   c0,0.2388506,0.16535,0.4327698,0.3703699,0.4327698h0.5382099c0.2041798,0,0.3699493-0.1934299,0.3699493-0.4327698v-0.5250998   h0.2020903c0.0492697,0,0.08393,0.0019598,0.1085606,0.0039101c0.0025091,0.0464001,0.0025091,0.1030598,0.0016699,0.1401901   v0.38099c0,0.2388601,0.16535,0.4327793,0.3703699,0.4327793h0.5373802c0.0592899,0,0.1131496-0.02003,0.1628399-0.0488501   c0.0492697,0.0298004,0.1039696,0.0488501,0.1636801,0.0488501h1.7870903c0.0584583,0,0.1114883-0.0190496,0.1603394-0.0468893   c0.0492706,0.0278397,0.1018791,0.0468893,0.160759,0.0468893h1.0430317c0.3327789,0,0.6016788-0.0947599,0.8050289-0.2632799   c0.0567799,0.1543503,0.1874695,0.2632799,0.3402996,0.2632799h1.0430298   c0.000742,0.000001,0.0016193,0.0000019,0.0023594,0.0000019c0.7569237,0,1.2081013-0.4711523,1.2081013-1.2592516   c0-0.3663397-0.0835094-0.6388998-0.2672291-0.8596897c-0.0037498-0.0043898-0.0079308-0.00879-0.0108509-0.0127001   c0.1023006-0.0771704,0.1690998-0.2115002,0.1690998-0.3643904v-0.5578194   C21.891016,12.7058201,21.7256756,12.5119104,21.5214958,12.5119104L21.5214958,12.5119104z M19.7481766,15.5657597V15.00354   h1.0384407c0.1010399,0,0.1732788-0.0151396,0.2187901-0.06497c0.0359097-0.0400496,0.0622101-0.0996399,0.0622101-0.1709604   c0-0.0766792-0.0279713-0.1362801-0.0647106-0.1733999c-0.0417595-0.0400496-0.09729-0.0581293-0.1908207-0.0581293   c-0.500639-0.0190506-1.1286297,0.0180798-1.1286297-0.8108406c0-0.3809996,0.2045994-0.7805595,0.7657795-0.7805595h1.0739307   v0.5578194h-0.9824905c-0.0977001,0-0.1611691,0.0048904-0.2150288,0.0473804   c-0.0588818,0.0429897-0.0805912,0.1059999-0.0805912,0.1890402c0,0.0991497,0.0501003,0.1655798,0.1164894,0.1953802   c0.0576305,0.0229597,0.1181717,0.0297995,0.2087803,0.0297995l0.2881012,0.0097704   c0.2906189,0.0082998,0.4906197,0.0664301,0.6129704,0.2090597c0.1052189,0.1260204,0.1607494,0.2862301,0.1607494,0.5553799   c0,0.5641699-0.3010502,0.8274498-0.8409405,0.8274498H19.7481766L19.7481766,15.5657597z M17.5593967,15.5657597V15.00354   h1.0388603c0.1010399,0,0.1732788-0.0151396,0.2183685-0.06497c0.0367508-0.0400496,0.0626411-0.0996399,0.0626411-0.1709604   c0-0.0766792-0.0275612-0.1362801-0.0651398-0.1733999c-0.0409203-0.0400496-0.0968704-0.0581293-0.1908207-0.0581293   c-0.5002193-0.0190506-1.1277905,0.0180798-1.1277905-0.8108406c0-0.3809996,0.2037601-0.7805595,0.7657814-0.7805595h1.0730896   v0.5578194h-0.9820709c-0.0981197,0-0.1611691,0.0048904-0.2146187,0.0473804   c-0.0592899,0.0429897-0.0810013,0.1059999-0.0810013,0.1890402c0,0.0991497,0.0496902,0.1655798,0.1169109,0.1953802   c0.057209,0.0229597,0.1173306,0.0297995,0.2087688,0.0297995l0.2876911,0.0097704   c0.2906189,0.0082998,0.4902,0.0664301,0.6133804,0.2090597c0.1043892,0.1260204,0.160759,0.2862301,0.160759,0.5553799   c0,0.5641699-0.3018894,0.8274498-0.8417797,0.8274498H17.5593967L17.5593967,15.5657597z M15.4495363,15.56674v-2.6215696   h1.7871008v0.5416994h-1.2543106v0.4772301h1.2234097v0.5348597h-1.2234097v0.5211906l1.2543106,0.0029297V15.56674H15.4495363   L15.4495363,15.56674z M12.9968767,15.56674v-2.6215696h1.2363501c0.2709894,0,0.46807,0.0131893,0.6451101,0.1230898   c0.1682692,0.1191902,0.2747393,0.2833099,0.2747393,0.5822496c-0.0008297,0.4195805-0.2400894,0.6330404-0.3803797,0.6980104   c0.1185799,0.0507994,0.2167101,0.1440897,0.2617998,0.2202902c0.0764103,0.1279793,0.0872698,0.24716,0.0889406,0.4782V15.56674   h-0.5373802v-0.3277597c0-0.1577806,0.0129395-0.3912601-0.0864401-0.5133705   c-0.0784903-0.0937901-0.1975002-0.1162596-0.39291-0.1162596h-0.5720301V15.56674H12.9968767L12.9968767,15.56674z    M9.4489861,13.8043699l0.6814308-0.8587103h1.7110996c0.0007267,0,0.0015192-0.000001,0.0022459-0.000001   c0.4245205-0.0000143,0.900074,0.1389818,0.900074,0.8636017c0,0.7282896-0.4643097,0.8787394-0.9323797,0.8787394h-0.6680698   v0.87922h-1.0409403l-0.65973-0.8679895l-0.6856098,0.8679895H6.6355567v-2.6215601h2.1536994L9.4489861,13.8043699   L9.4489861,13.8043699z M10.6097565,13.2265196l-0.8225603,1.0335903l0.8225603,1.0687504V13.2265196L10.6097565,13.2265196z    M11.8415165,13.48736h-0.6981297v0.6677303h0.6914492c0.0004034,0.000001,0.0008335,0.000001,0.001236,0.000001   c0.2055607,0,0.3328047-0.1196337,0.3328047-0.3458309C12.1688766,13.5796804,12.0352669,13.48736,11.8415165,13.48736   L11.8415165,13.48736z M14.1935568,13.4878502h-0.6597204V14.07693h0.6509504c0.1043901,0,0.1933298-0.0043898,0.2651396-0.0542202   c0.0684805-0.0488396,0.1098204-0.1396999,0.1098204-0.2515497c0-0.1118603-0.0413399-0.1934299-0.1106501-0.2359304   C14.3839569,13.4902897,14.2879267,13.4878502,14.1935568,13.4878502L14.1935568,13.4878502z M8.5124264,13.4878502H7.1700163   v0.4767399h1.1753902v0.5353498H7.1700163v0.5216799h1.3161001l0.6121302-0.7703094L8.5124264,13.4878502L8.5124264,13.4878502z",
                    fill: "#303C42"
                  }
                })
              ]),
              _c("path", {
                attrs: {
                  d:
                    "  M22,20.5H2c-0.8284271,0-1.5-0.6715736-1.5-1.5V5c0-0.8284273,0.6715729-1.5,1.5-1.5h20c0.8284264,0,1.5,0.6715727,1.5,1.5v14  C23.5,19.8284264,22.8284264,20.5,22,20.5z",
                  fill: "none",
                  id: "XMLID_1435_",
                  stroke: "#303C42",
                  "stroke-linecap": "round",
                  "stroke-linejoin": "round",
                  "stroke-miterlimit": "10"
                }
              }),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g"),
              _c("g")
            ]
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/layout/Footer.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/layout/Footer.vue ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Footer_vue_vue_type_template_id_e4df7ff6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Footer.vue?vue&type=template&id=e4df7ff6& */ "./resources/js/components/layout/Footer.vue?vue&type=template&id=e4df7ff6&");
/* harmony import */ var _Footer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Footer.vue?vue&type=script&lang=js& */ "./resources/js/components/layout/Footer.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Footer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Footer_vue_vue_type_template_id_e4df7ff6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Footer_vue_vue_type_template_id_e4df7ff6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/layout/Footer.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/layout/Footer.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/layout/Footer.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Footer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Footer.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Footer.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Footer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/layout/Footer.vue?vue&type=template&id=e4df7ff6&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/layout/Footer.vue?vue&type=template&id=e4df7ff6& ***!
  \**********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Footer_vue_vue_type_template_id_e4df7ff6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Footer.vue?vue&type=template&id=e4df7ff6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/layout/Footer.vue?vue&type=template&id=e4df7ff6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Footer_vue_vue_type_template_id_e4df7ff6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Footer_vue_vue_type_template_id_e4df7ff6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);