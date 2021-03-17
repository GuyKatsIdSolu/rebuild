(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/Gallery.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/Gallery.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _apis_Api__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../apis/Api */ "./resources/js/apis/Api.js");
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'Gallery',
  props: ['user', 'creator', 'status', 'limit', 'pagination', 'perPage', 'forceSearch', 'isFirstTime'],
  data: function data() {
    return {
      page: 1,
      delay: 5000,
      update: 0,
      imgs: [],
      tags: [],
      search: '',
      timer: '',
      total: 0,
      curData: null,
      newData: null
    };
  },
  watch: {
    creator: function creator(newVal, oldVal) {
      this.getResults();
      var that = this; // setInterval(function(){
      //   that.checkNewResults();
      // },60000);
    },
    '$route': {
      handler: function handler() {
        if (this.creator) {
          this.getResults();
        }
      },
      deep: true,
      immediate: true
    },
    update: function update(newVal, oldVal) {
      // watch it
      this.getResults();
    },
    search: function search(newVal, oldVal) {
      // watch it
      this.getResults(1, newVal);
    },
    total: function total(newVal, oldVal) {
      // watch it
      // if(!newVal){
      //   if(window.location.pathname!="/account"){
      //     window.location.href="/account";
      //   }
      // }
      if (this.status == 'approved') {
        if (!newVal) {
          this.$toast.error({
            position: this.$root.toastPosition,
            title: 'Store Disabled',
            message: "Please upload photos to reactivate the store."
          });
        }
      }
    }
  },
  created: function created() {},
  mounted: function mounted() {
    var that = this;
    var channel = this.$pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
      // app.messages.push(JSON.stringify(data));
      // app.messages.push(JSON.stringify(data));
      that.update++;
    });
  },
  methods: {
    goLearnMore: function goLearnMore() {
      this.$ma.trackEvent({
        action: 'account-page',
        properties: {
          feature: 'image-buttons',
          status: this.status,
          type: 'learn-button-clicked'
        }
      });

      if (this.status == 'pending') {
        window.open('https://sell.support.artigram.me/article/318-uploading-status-approved-pending-not-approved', '_blank');
      } else {
        window.open('https://sell.support.artigram.me/article/320-content-submission-guidelines', '_blank');
      }
    },
    isNotApproved: function isNotApproved(img) {
      // debugger;
      if (img.status == 'approved' && !img.is_approved) {
        // this.$toast.info({
        //   title:'Pay Attention!',
        //   message:"Image "+img.name+' is wait for menual approved.',
        // });
        return 'not-approved';
      }

      return '';
    },
    getPurchasesNumber: function getPurchasesNumber(store_id) {
      // axios.get('/api/get-purchases-number', {
      //   params: {
      //     store_id: store_id,
      //   },
      // }).then(response => {
      //   // debugger;
      //   $('.purchases-num span[data-store=' + response.data.store + ']').html(response.data.num)
      // });
      return 0;
    },
    openShare: function openShare() {
      this.$root.clicked = true;
    },
    closeShare: function closeShare() {
      this.$root.clicked = false;
    },
    goToShop: function goToShop(img_id) {
      var that = this;
      setTimeout(function () {
        if (that.status == 'approved') {
          if (!that.$root.clicked) {// window.location.href = window.location.origin.replace('https://my.', 'https://shop.') + 'gallery/' + store_id;
            // window.location.href = '/gallery/' + img_id;
          }
        }
      }, 100);
    },
    openProductsPopup: function openProductsPopup(img) {
      if (this.$root.isMobile) {
        this.$modal.hide('edit-delete-' + img.id);
      }

      this.$parent.$refs.productsModal.openModal(img);
    },
    openMediaPopup: function openMediaPopup(img) {
      this.$ma.trackEvent({
        action: 'account-page',
        properties: {
          feature: 'image-buttons',
          status: this.status,
          type: 'media-button-clicked'
        }
      });

      if (this.$root.isMobile) {
        this.$modal.hide('edit-delete-' + img.id);
      }

      this.$parent.$refs.mediaModal.openModal(img);
    },
    getPinterestContent: function getPinterestContent(img) {
      return '#Artigram #wallart #walldecor #homedecor #roomdecor #decor #art #cooldesign #coolphotos #images #phonecasess #apparel #pillows #tshirts' + img.tags.replace("/#/g", " #");
    },
    openEditPopup: function openEditPopup(img) {
      this.$ma.trackEvent({
        action: 'account-page',
        properties: {
          feature: 'image-buttons',
          status: this.status,
          type: 'edit-button-clicked'
        }
      });

      if (this.$root.isMobile) {
        this.$modal.hide('edit-delete-' + img.id);
      }

      this.$parent.$refs.editModal.openModal(img);
      var tags = img.tags.split("#");
      tags.shift();
      $.each(tags, function (key, value) {
        $('.edit-image-popup .tags').append('<div class="tag"><span class="value">#' + tags[key] + '</span><span onclick="deleteTag(this)"><i class="fa fa-times"></i></span></div>');
      });
      $('.edit-image-popup').show();
      $('.edit-image-popup .gl_popup').animate({
        top: "0"
      }, 600);
      $('.edit-image-popup').attr('imgID', img.id);
      $('.edit-image-popup .store-link').val('https://shop.' + this.$root.dev + 'artigram.me/' + img.store_id);
      $('.edit-image-popup .delete_url').attr('href', '/account/delete/' + img.id);
      $('.edit-image-popup textarea[name=description]').val(img.description);
      $('.edit-image-popup .img-name').val(img.name);
      $('.edit-image-popup .img-prev').attr('src', this.$root.storageUrl + '/creator_images/' + img.id + '/500.jpg');
      $('.edit-image-popup #is_active').prop('checked', true);
      $('.edit-image-popup #isnt_active').prop('checked', false);
    },
    deleteImg: function deleteImg(index, imgId) {
      var _this = this;

      this.$ma.trackEvent({
        action: 'account-page',
        properties: {
          feature: 'image-buttons',
          status: this.status,
          type: 'delete-button-clicked'
        }
      });
      this.$root.clicked = true;
      var that = this;
      axios.get('/api/delete-img/' + imgId).then(function (response) {
        _this.getResults(_this.page);

        _this.$root.clicked = false;

        if (_this.$root.isMobile) {
          _this.$modal.hide('edit-delete-' + imgId);
        }
      });
    },
    getResults: function getResults() {
      var _this2 = this;

      var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      var search = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      this.page = page;
      var that = this;
      axios.get('/api/get-user-images', {
        params: {
          page: page,
          status: this.status,
          creatorId: this.creator.id,
          search: this.search,
          perPage: this.perPage
        }
      }).then(function (response) {
        var _that$tags;

        _this2.imgs = response.data.data;
        _this2.total = response.data.total;
        var tags = [];
        response.data.data.forEach(function (img, i) {
          tags = tags.concat(img.tags.split('#').filter(function (e) {
            return e !== '';
          }));
        });

        (_that$tags = that.tags).push.apply(_that$tags, _toConsumableArray(tags));

        that.tags = _toConsumableArray(new Set(that.tags));
        that.tags = that.tags.filter(function (v, i, a) {
          return a.indexOf(v) === i;
        });

        if (parseInt(_this2.isFirstTime)) {// this.$modal.show('VideoModal');
          // axios.get('/api/is-first-time/'+this.uid)
          // .then(response => {
          //   this.isFirstTime=0;
          // });
        }

        if (_this2.page == 1 && !_this2.curData) {
          _this2.curData = response.data.imgs;
        }
      });
    },
    checkNewResults: function checkNewResults() {
      var _this3 = this;

      axios.get('/api/get-user-images', {
        params: {
          page: 1,
          status: this.status,
          creatorId: this.creator.id,
          perPage: this.perPage,
          search: ''
        }
      }).then(function (response) {
        _this3.newData = response.data.imgs;

        if (_this3.search == '') {
          _this3.tags = response.data.tags;
          _this3.total = response.data.imgs.total;
        }

        if (!_this3.isEquivalent(_this3.newData.data, _this3.curData.data)) {
          if (_this3.delay < 5000 && _this3.status == 'pending') {
            $('.upload-loading').hide(300);
            _this3.delay = 5000;
          }

          _this3.getResults();
        }
      });
    },
    isEquivalent: function isEquivalent(a, b) {
      if (a.length != b.length) {
        return false;
      }

      for (var i = 0; i < a.length; i++) {
        if (a[i].id !== b[i].id) {
          return false;
        }
      }

      return true;
    },
    getSrc: function getSrc(img) {
      return window.location.origin + this.$root.storageUrl + '/creator_images/' + img.id + '/500.jpg';
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/Gallery.vue?vue&type=template&id=62d9e337&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/Gallery.vue?vue&type=template&id=62d9e337& ***!
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
  return _c("div", [
    _vm.creator
      ? _c(
          "div",
          { staticClass: "gallery-box" },
          [
            _c("div", { staticClass: "approved-mgs-count" }, [
              _c("b", [
                _vm._v(
                  "\n      " +
                    _vm._s(_vm.status) +
                    " Images (" +
                    _vm._s(_vm.total) +
                    ")\n    "
                )
              ])
            ]),
            _vm._v(" "),
            _vm.status == "approved" || _vm.forceSearch
              ? _c(
                  "div",
                  {
                    staticStyle: {
                      "margin-bottom": "15px",
                      display: "inline-block"
                    }
                  },
                  [
                    _c("span", { staticClass: "search" }, [
                      _c("i", { staticClass: "fas fa-search" }),
                      _vm._v(" "),
                      _vm.search != ""
                        ? _c("i", {
                            staticClass: "far fa-times-circle",
                            on: {
                              click: function($event) {
                                _vm.search = ""
                              }
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.search,
                            expression: "search"
                          }
                        ],
                        attrs: {
                          type: "search",
                          placeholder: "Search by words or image ID"
                        },
                        domProps: { value: _vm.search },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.search = $event.target.value
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("tags", { attrs: { tags: _vm.tags } })
                  ],
                  1
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.$root.isMobile
              ? _c(
                  "a",
                  {
                    staticClass: "upload-logo",
                    attrs: { id: _vm.$root.isMobile, href: "/upload-images" }
                  },
                  [_vm._m(0)]
                )
              : _vm._e(),
            _vm._v(" "),
            _c(
              "masonry",
              {
                attrs: {
                  cols: { default: 4, 1000: 3, 700: 2, 400: 2 },
                  gutter: { default: "20px", 400: "40px" }
                }
              },
              [
                _vm.status == "approved" && _vm.imgs && _vm.imgs.length == 0
                  ? _c("div", { staticClass: "img-box _1Nk0C placeholder" }, [
                      _c("div", { staticClass: "pos-abs" }, [
                        _c("img", {
                          attrs: {
                            src:
                              _vm.$root.storageUrl +
                              "/images/approved-images-icon.png"
                          }
                        }),
                        _vm._v(" "),
                        _c("div", { staticClass: "text" }, [
                          _vm._v("\n              No Approved Images"),
                          _c("br"),
                          _vm._v("\n              Upload Now!\n            ")
                        ])
                      ])
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.status == "pending"
                  ? _c(
                      "div",
                      {
                        class:
                          "img-box _1Nk0C placeholder " +
                          (_vm.imgs && _vm.imgs.length ? "purple-bg" : "")
                      },
                      [
                        _c("div", { staticClass: "pos-abs" }, [
                          _c("img", {
                            attrs: {
                              src:
                                _vm.$root.storageUrl +
                                "/images/pending-image-icon.png"
                            }
                          }),
                          _vm._v(" "),
                          _vm.imgs && _vm.imgs.length == 0
                            ? _c("div", { staticClass: "text" }, [
                                _vm._v(
                                  "\n              No Pending Images\n            "
                                )
                              ])
                            : _c("div", { staticClass: "text" }, [
                                _vm._v("\n              Images are being"),
                                _c("br"),
                                _vm._v(
                                  "\n              processed\n              "
                                ),
                                _c("div", { staticClass: "dots-box" }, [
                                  _c("div", { staticClass: "dot-typing" })
                                ])
                              ])
                        ])
                      ]
                    )
                  : _vm._e(),
                _vm._v(" "),
                _vm.status == "not approved" && _vm.imgs && _vm.imgs.length == 0
                  ? _c("div", { staticClass: "img-box _1Nk0C placeholder" }, [
                      _c("div", { staticClass: "pos-abs" }, [
                        _c("img", {
                          attrs: {
                            src:
                              _vm.$root.storageUrl +
                              "/images/not-approved-images-icon.png"
                          }
                        }),
                        _vm._v(" "),
                        _c("div", { staticClass: "text" }, [
                          _vm._v("\n              Good Job"),
                          _c("br"),
                          _vm._v(
                            "\n              No Unapproved Images\n            "
                          )
                        ])
                      ])
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm._l(_vm.imgs, function(img, $index) {
                  return $index < _vm.limit
                    ? _c(
                        "div",
                        {
                          key: $index,
                          class: "img-box _1Nk0C " + _vm.isNotApproved(img),
                          style:
                            _vm.status == "approved" ||
                            _vm.status == "not approved"
                              ? ""
                              : "padding: 0 0 30px 0;"
                        },
                        [
                          _c(
                            "div",
                            {
                              staticClass: "hover",
                              style:
                                _vm.status == "approved" ||
                                _vm.status == "not approved"
                                  ? ""
                                  : "height: calc(100% - 30px)",
                              on: {
                                click: function($event) {
                                  _vm.$root.isMobile ? "" : _vm.goToShop(img.id)
                                }
                              }
                            },
                            [
                              _vm.status == "approved"
                                ? _c("div", { staticClass: "view-store" }, [
                                    _vm._v("View Products")
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              _vm.status == "approved"
                                ? _c("div", { staticClass: "img-name" }, [
                                    _vm._v("'" + _vm._s(img.name) + "'")
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              !img.is_approved && _vm.status == "not approved"
                                ? _c("div", { staticClass: "status" }, [
                                    _vm._v(
                                      "Upload status- " +
                                        _vm._s(
                                          img.status != "not approved"
                                            ? '"Submitted for manual review"'
                                            : '"Not Approved"'
                                        )
                                    )
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              _vm.status == "approved"
                                ? _c("div", { staticClass: "purchases-num" }, [
                                    _c(
                                      "span",
                                      { attrs: { "data-store": img.store_id } },
                                      [
                                        _vm._v(
                                          _vm._s(
                                            _vm.getPurchasesNumber(img.store_id)
                                          )
                                        )
                                      ]
                                    ),
                                    _vm._v(" Purchases")
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              _c("div", { staticClass: "visibile" }, [
                                _c(
                                  "svg",
                                  {
                                    staticStyle: { margin: "10px" },
                                    attrs: {
                                      xmlns: "http://www.w3.org/2000/svg",
                                      "xmlns:xlink":
                                        "http://www.w3.org/1999/xlink",
                                      width: "39px",
                                      height: "33px",
                                      viewBox: "0 0 39 33",
                                      version: "1.1"
                                    }
                                  },
                                  [
                                    _c("title", [
                                      _vm._v(
                                        "579024FF-590D-4634-8A8E-D02BA1A63641"
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _c("desc", [
                                      _vm._v("Created with sketchtool.")
                                    ]),
                                    _vm._v(" "),
                                    _c("defs", [
                                      _c("path", {
                                        attrs: {
                                          d:
                                            "M114.499859,346.968682 C111.062923,346.968682 108.28075,344.331347 108.024735,340.989194 L103.271478,337.347416 C102.646622,338.124556 102.07161,338.946169 101.607612,339.844597 C101.397396,340.25684 101.397396,340.743609 101.607612,341.155852 C104.064896,345.908986 108.929621,349.12491 114.499859,349.12491 C115.719212,349.12491 116.895518,348.945224 118.029231,348.655032 L115.677978,346.851437 C115.289662,346.925803 114.895336,346.965046 114.499859,346.968682 Z M128.719755,349.578616 L123.710483,345.740531 C125.232147,344.469213 126.483621,342.910615 127.392105,341.155403 C127.602321,340.74316 127.602321,340.256391 127.392105,339.844148 C124.934821,335.091014 120.070096,331.87509 114.499859,331.87509 C112.166956,331.877893 109.871943,332.460133 107.824455,333.568627 L102.059828,329.151506 C101.908011,329.034388 101.715467,328.981888 101.524589,329.005563 C101.33371,329.029238 101.160148,329.127147 101.042115,329.277735 L100.152635,330.412899 C99.9069282,330.726253 99.9639305,331.177735 100.279962,331.421384 L126.939889,351.848494 C127.091706,351.965612 127.284251,352.018112 127.475129,351.994437 C127.666007,351.970762 127.839569,351.872853 127.957602,351.722265 L128.847535,350.587101 C129.09314,350.273629 129.035933,349.822129 128.719755,349.578616 Z M120.394985,343.199776 L118.614213,341.835064 C118.76418,341.405376 118.843729,340.954642 118.849836,340.5 C118.867767,339.150197 118.238821,337.87197 117.154776,337.055075 C116.070731,336.23818 114.660098,335.979458 113.353005,336.357797 C113.626243,336.724851 113.774047,337.168846 113.774862,337.62503 C113.768102,337.776834 113.744704,337.927458 113.705081,338.074244 L110.369645,335.518666 C111.528272,334.558788 112.98993,334.032424 114.499859,334.031317 C116.230682,334.030364 117.890892,334.711577 119.11477,335.924897 C120.338647,337.138218 121.025788,338.784107 121.024826,340.5 C121.024826,341.47165 120.785123,342.377265 120.394985,343.200226 L120.394985,343.199776 Z",
                                          id: "path-1"
                                        }
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "filter",
                                        {
                                          attrs: {
                                            x: "-27.6%",
                                            y: "-30.4%",
                                            width: "155.2%",
                                            height: "169.6%",
                                            filterUnits: "objectBoundingBox",
                                            id: "filter-2"
                                          }
                                        },
                                        [
                                          _c("feOffset", {
                                            attrs: {
                                              dx: "0",
                                              dy: "1",
                                              in: "SourceAlpha",
                                              result: "shadowOffsetOuter1"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feGaussianBlur", {
                                            attrs: {
                                              stdDeviation: "2.5",
                                              in: "shadowOffsetOuter1",
                                              result: "shadowBlurOuter1"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feColorMatrix", {
                                            attrs: {
                                              values:
                                                "0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.24 0",
                                              type: "matrix",
                                              in: "shadowBlurOuter1",
                                              result: "shadowMatrixOuter1"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feMorphology", {
                                            attrs: {
                                              radius: "1",
                                              operator: "erode",
                                              in: "SourceAlpha",
                                              result: "shadowSpreadOuter2"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feOffset", {
                                            attrs: {
                                              dx: "0",
                                              dy: "3",
                                              in: "shadowSpreadOuter2",
                                              result: "shadowOffsetOuter2"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feGaussianBlur", {
                                            attrs: {
                                              stdDeviation: "0.5",
                                              in: "shadowOffsetOuter2",
                                              result: "shadowBlurOuter2"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feColorMatrix", {
                                            attrs: {
                                              values:
                                                "0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.18 0",
                                              type: "matrix",
                                              in: "shadowBlurOuter2",
                                              result: "shadowMatrixOuter2"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feOffset", {
                                            attrs: {
                                              dx: "0",
                                              dy: "2",
                                              in: "SourceAlpha",
                                              result: "shadowOffsetOuter3"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feGaussianBlur", {
                                            attrs: {
                                              stdDeviation: "1",
                                              in: "shadowOffsetOuter3",
                                              result: "shadowBlurOuter3"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("feColorMatrix", {
                                            attrs: {
                                              values:
                                                "0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.18 0",
                                              type: "matrix",
                                              in: "shadowBlurOuter3",
                                              result: "shadowMatrixOuter3"
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c(
                                            "feMerge",
                                            [
                                              _c("feMergeNode", {
                                                attrs: {
                                                  in: "shadowMatrixOuter1"
                                                }
                                              }),
                                              _vm._v(" "),
                                              _c("feMergeNode", {
                                                attrs: {
                                                  in: "shadowMatrixOuter2"
                                                }
                                              }),
                                              _vm._v(" "),
                                              _c("feMergeNode", {
                                                attrs: {
                                                  in: "shadowMatrixOuter3"
                                                }
                                              })
                                            ],
                                            1
                                          )
                                        ],
                                        1
                                      )
                                    ]),
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
                                              id: "link",
                                              transform:
                                                "translate(-95.000000, -325.000000)"
                                            }
                                          },
                                          [
                                            _c(
                                              "g",
                                              { attrs: { id: "Shape" } },
                                              [
                                                _c("use", {
                                                  attrs: {
                                                    fill: "black",
                                                    "fill-opacity": "1",
                                                    filter: "url(#filter-2)",
                                                    "xlink:href": "#path-1"
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c("use", {
                                                  attrs: {
                                                    fill: "#FAFAFA",
                                                    "fill-rule": "evenodd",
                                                    "xlink:href": "#path-1"
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
                              _vm.status == "approved"
                                ? _c(
                                    "ShareNetwork",
                                    {
                                      attrs: {
                                        network: "pinterest",
                                        url:
                                          _vm.$root.currentUrl +
                                          "/gallery/" +
                                          img.id,
                                        title:
                                          img.name +
                                          " (ID " +
                                          img.id +
                                          ")" +
                                          " " +
                                          img.description +
                                          " " +
                                          _vm.getPinterestContent(img),
                                        media: _vm.getSrc(img)
                                      },
                                      on: {
                                        open: function($event) {
                                          return _vm.openShare()
                                        },
                                        close: _vm.closeShare
                                      }
                                    },
                                    [
                                      _c(
                                        "svg",
                                        {
                                          staticStyle: {
                                            "enable-background":
                                              "new 0 0 512 512"
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
                                          _c("defs", {
                                            attrs: { id: "defs19" }
                                          }),
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
                                                      {
                                                        attrs: {
                                                          id: "Layer_14"
                                                        }
                                                      },
                                                      [
                                                        _c(
                                                          "g",
                                                          {
                                                            attrs: {
                                                              id: "g3121"
                                                            }
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
                                                      attrs: {
                                                        id: "Layer_1_1_-8"
                                                      }
                                                    })
                                                  ]
                                                )
                                              ]
                                            )
                                          ]),
                                          _c("g", {
                                            attrs: { id: "Layer_1_1_" }
                                          })
                                        ]
                                      )
                                    ]
                                  )
                                : _vm._e(),
                              _vm._v(" "),
                              !_vm.$root.isMobile && _vm.status == "approved"
                                ? _c(
                                    "div",
                                    {
                                      staticClass: "edit-btn",
                                      on: {
                                        click: function($event) {
                                          return _vm.openEditPopup(img)
                                        }
                                      }
                                    },
                                    [
                                      _c(
                                        "svg",
                                        {
                                          attrs: {
                                            xmlns: "http://www.w3.org/2000/svg",
                                            "xmlns:xlink":
                                              "http://www.w3.org/1999/xlink",
                                            width: "16px",
                                            height: "16px",
                                            viewBox: "0 0 16 16",
                                            version: "1.1"
                                          }
                                        },
                                        [
                                          _c("title", [
                                            _vm._v(
                                              "042AEF5D-DC94-45B9-A336-07C92D1A2DB0"
                                            )
                                          ]),
                                          _vm._v(" "),
                                          _c("desc", [
                                            _vm._v("Created with sketchtool.")
                                          ]),
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
                                                    id: "link",
                                                    transform:
                                                      "translate(-112.000000, -746.000000)",
                                                    fill: "#434343",
                                                    "fill-rule": "nonzero"
                                                  }
                                                },
                                                [
                                                  _c(
                                                    "g",
                                                    {
                                                      attrs: {
                                                        id: "Group",
                                                        transform:
                                                          "translate(96.000000, 733.000000)"
                                                      }
                                                    },
                                                    [
                                                      _c(
                                                        "g",
                                                        {
                                                          attrs: {
                                                            id: "edit-(1)",
                                                            transform:
                                                              "translate(16.000000, 13.000000)"
                                                          }
                                                        },
                                                        [
                                                          _c("path", {
                                                            attrs: {
                                                              d:
                                                                "M14.642118,0.718880678 C13.6835253,-0.239626893 12.1294077,-0.239626893 11.170815,0.718880678 L1.43957581,10.4492562 C1.37288556,10.5159406 1.32473217,10.5986036 1.29959018,10.6893625 L0.0199041308,15.3089048 C-0.0327236653,15.4983053 0.0207563481,15.701128 0.159676703,15.840249 C0.298810058,15.979157 0.501650742,16.0326323 0.691068132,15.9802222 L5.31102041,14.7004367 C5.40178732,14.6752969 5.48445769,14.6271478 5.551148,14.5604635 L15.2821741,4.82987487 C16.2392753,3.87072814 16.2392753,2.31802677 15.2821741,1.35887998 L14.642118,0.718880678 Z M2.11500122,11.8332228 L4.16705862,13.8853111 L1.32856742,14.6716751 L2.11500122,11.8332228 Z M14.5108681,4.05863736 L13.9323887,4.63706551 L11.3636415,2.06854633 L11.942334,1.49011819 C12.4747908,0.957708633 13.3381422,0.957708633 13.870599,1.49011819 L14.5108681,2.13011749 C15.0424727,2.6631662 15.0424727,3.52580174 14.5108681,4.05863736 L14.5108681,4.05863736 Z",
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
                                      ),
                                      _vm._v("Edit\n          ")
                                    ]
                                  )
                                : _vm._e(),
                              _vm._v(" "),
                              !_vm.$root.isMobile && _vm.status == "approved"
                                ? _c(
                                    "div",
                                    {
                                      staticClass: "media-btn",
                                      on: {
                                        click: function($event) {
                                          return _vm.openMediaPopup(img)
                                        }
                                      }
                                    },
                                    [
                                      _c(
                                        "svg",
                                        {
                                          staticClass: "icon",
                                          staticStyle: {
                                            width: "18px",
                                            height: "16px",
                                            "vertical-align": "middle",
                                            fill: "currentColor",
                                            overflow: "hidden"
                                          },
                                          attrs: {
                                            viewBox: "0 0 1152 1024",
                                            version: "1.1",
                                            xmlns: "http://www.w3.org/2000/svg"
                                          }
                                        },
                                        [
                                          _c("path", {
                                            attrs: {
                                              d:
                                                "M1088 128l-64 0 0-64c0-35.2-28.8-64-64-64l-896 0c-35.2 0-64 28.8-64 64l0 768c0 35.2 28.8 64 64 64l64 0 0 64c0 35.2 28.8 64 64 64l896 0c35.2 0 64-28.8 64-64l0-768c0-35.2-28.8-64-64-64zM128 192l0 640-63.872 0c-0.032-0.032-0.096-0.064-0.128-0.128l0-767.776c0.032-0.032 0.064-0.096 0.128-0.128l895.776 0c0.032 0.032 0.096 0.064 0.128 0.128l0 63.872-768 0c-35.2 0-64 28.8-64 64l0 0zM1088 959.872c-0.032 0.032-0.064 0.096-0.128 0.128l-895.776 0c-0.032-0.032-0.096-0.064-0.128-0.128l0-767.776c0.032-0.032 0.064-0.096 0.128-0.128l895.776 0c0.032 0.032 0.096 0.064 0.128 0.128l0 767.776zM960 352c0 53.024-42.976 96-96 96s-96-42.976-96-96 42.976-96 96-96 96 42.976 96 96zM1024 896l-768 0 0-128 224-384 256 320 64 0 224-192z"
                                            }
                                          })
                                        ]
                                      ),
                                      _vm._v("Media\n          ")
                                    ]
                                  )
                                : _vm._e(),
                              _vm._v(" "),
                              !_vm.$root.isMobile && _vm.status != "approved"
                                ? _c(
                                    "div",
                                    {
                                      staticClass: "learn-btn",
                                      on: { click: _vm.goLearnMore }
                                    },
                                    [
                                      _vm._v(
                                        "\n            Learn More\n          "
                                      )
                                    ]
                                  )
                                : _vm._e(),
                              _vm._v(" "),
                              !_vm.$root.isMobile
                                ? _c(
                                    "div",
                                    {
                                      staticClass: "trash",
                                      on: {
                                        click: function($event) {
                                          return _vm.deleteImg($index, img.id)
                                        }
                                      }
                                    },
                                    [
                                      _c(
                                        "svg",
                                        {
                                          attrs: {
                                            xmlns: "http://www.w3.org/2000/svg",
                                            "xmlns:xlink":
                                              "http://www.w3.org/1999/xlink",
                                            width: "18px",
                                            height: "19px",
                                            viewBox: "0 0 18 19",
                                            version: "1.1"
                                          }
                                        },
                                        [
                                          _c("title", [
                                            _vm._v(
                                              "BA01F6BC-C889-45F5-94BB-D847D8C37D1D"
                                            )
                                          ]),
                                          _vm._v(" "),
                                          _c("desc", [
                                            _vm._v("Created with sketchtool.")
                                          ]),
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
                                                    id: "link",
                                                    transform:
                                                      "translate(-455.000000, -743.000000)",
                                                    fill: "#3B3B3B",
                                                    "fill-rule": "nonzero"
                                                  }
                                                },
                                                [
                                                  _c(
                                                    "g",
                                                    {
                                                      attrs: {
                                                        id: "Group-Copy",
                                                        transform:
                                                          "translate(442.000000, 731.000000)"
                                                      }
                                                    },
                                                    [
                                                      _c(
                                                        "g",
                                                        {
                                                          attrs: {
                                                            id: "Group-2"
                                                          }
                                                        },
                                                        [
                                                          _c("path", {
                                                            attrs: {
                                                              d:
                                                                "M30.1445529,15.8337603 C30.0743234,15.7640992 29.9844329,15.7290851 29.8751687,15.7290851 L26.2539353,15.7290851 L25.433633,13.7857463 C25.316488,13.4986232 25.1055121,13.2542181 24.8009926,13.0524901 C24.4961857,12.8508029 24.1874385,12.75 23.8750382,12.75 L20.1249617,12.75 C19.8125614,12.75 19.5038962,12.8508029 19.1992125,13.0524901 C18.8944877,13.2542181 18.6835529,13.4985825 18.5663258,13.7857463 L17.7460235,15.7290851 L14.1249543,15.7290851 C14.0154849,15.7290851 13.9257585,15.7640992 13.8554059,15.8337603 C13.7852584,15.9035845 13.75,15.9928519 13.75,16.1014402 L13.75,16.8463134 C13.75,16.9549017 13.7850942,17.0441691 13.8554059,17.113871 C13.9257585,17.1836545 14.0156491,17.2185462 14.1249543,17.2185462 L15.2498582,17.2185462 L15.2498582,28.2974853 C15.2498582,28.9416371 15.4334565,29.4904074 15.8006121,29.9441629 C16.1678497,30.3982038 16.6092573,30.625 17.1249169,30.625 L26.8750419,30.625 C27.3908246,30.625 27.8321912,30.3903776 28.1993878,29.9211327 C28.5665434,29.4515618 28.7500185,28.8950061 28.7500185,28.2510988 L28.7500185,17.2185462 L29.8751277,17.2185462 C29.9843918,17.2185462 30.0743234,17.1836545 30.1445119,17.113871 C30.2146183,17.0442098 30.25,16.9549017 30.25,16.8463134 L30.25,16.1014402 C30.25,15.9928519 30.2146593,15.9035845 30.1445529,15.8337603 Z M19.9492442,14.3673295 C20.0038763,14.297546 20.0703296,14.2547466 20.14844,14.2393388 L23.863258,14.2393388 C23.9413683,14.2548688 24.0079448,14.2976275 24.0624948,14.3673295 L24.625193,15.7289221 L19.3750121,15.7289221 L19.9492442,14.3673295 Z",
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
                                : _vm._e()
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _vm.status == "approved"
                            ? _c("v-lazy-image", {
                                class: "img " + "img-" + img.id,
                                attrs: {
                                  src:
                                    _vm.$root.storageUrl +
                                    "/creator_images/" +
                                    img.id +
                                    "/500.jpg",
                                  "src-placeholder":
                                    _vm.$root.storageUrl +
                                    "/creator_images/" +
                                    img.id +
                                    "/80.jpg"
                                }
                              })
                            : _c("v-lazy-image", {
                                class: "img " + "img-" + img.id,
                                attrs: {
                                  src:
                                    _vm.$root.storageUrl +
                                    "/creator_images/" +
                                    img.id +
                                    "/1000C.jpg",
                                  "src-placeholder":
                                    _vm.$root.storageUrl +
                                    "/creator_images/" +
                                    img.id +
                                    "/80.jpg"
                                }
                              }),
                          _vm._v(" "),
                          _vm.$root.isMobile
                            ? _c(
                                "div",
                                { staticClass: "edit-modal-delete-box" },
                                [
                                  _c(
                                    "a",
                                    {
                                      staticClass: "more-link",
                                      attrs: { href: "#" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          return _vm.$modal.show(
                                            "edit-delete-" + img.id
                                          )
                                        }
                                      }
                                    },
                                    [
                                      _c(
                                        "svg",
                                        {
                                          staticClass: "icon",
                                          staticStyle: {
                                            width: "35px",
                                            height: "35px",
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
                                                "M116.362876 512m-116.362876 0a69.545 69.545 0 1 0 232.725752 0 69.545 69.545 0 1 0-232.725752 0ZM512 512m-116.362876 0a69.545 69.545 0 1 0 232.725752 0 69.545 69.545 0 1 0-232.725752 0ZM907.637124 512m-116.362876 0a69.545 69.545 0 1 0 232.725752 0 69.545 69.545 0 1 0-232.725752 0Z"
                                            }
                                          })
                                        ]
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "modal",
                                    {
                                      staticClass: "edit-delete-modal",
                                      attrs: { name: "edit-delete-" + img.id }
                                    },
                                    [
                                      _vm.status == "approved"
                                        ? _c(
                                            "a",
                                            {
                                              on: {
                                                click: function($event) {
                                                  $event.preventDefault()
                                                  return _vm.openEditPopup(img)
                                                }
                                              }
                                            },
                                            [
                                              _c(
                                                "div",
                                                { staticClass: "link" },
                                                [_vm._v("Edit")]
                                              )
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.status == "approved"
                                        ? _c(
                                            "a",
                                            {
                                              on: {
                                                click: function($event) {
                                                  $event.preventDefault()
                                                  return _vm.openProductsPopup(
                                                    img
                                                  )
                                                }
                                              }
                                            },
                                            [
                                              _c(
                                                "div",
                                                { staticClass: "link" },
                                                [_vm._v("View Products")]
                                              )
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.status == "approved"
                                        ? _c(
                                            "a",
                                            {
                                              on: {
                                                click: function($event) {
                                                  $event.preventDefault()
                                                  return _vm.openMediaPopup(img)
                                                }
                                              }
                                            },
                                            [
                                              _c(
                                                "div",
                                                { staticClass: "link" },
                                                [_vm._v("Media")]
                                              )
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.status == "approved"
                                        ? _c(
                                            "a",
                                            {
                                              on: {
                                                click: function($event) {
                                                  $event.preventDefault()
                                                  return _vm.goToShop(img.id)
                                                }
                                              }
                                            },
                                            [
                                              _c(
                                                "div",
                                                { staticClass: "link" },
                                                [_vm._v("View Shop")]
                                              )
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.status != "approved"
                                        ? _c(
                                            "a",
                                            {
                                              on: {
                                                click: function($event) {
                                                  $event.preventDefault()
                                                  return _vm.goLearnMore($event)
                                                }
                                              }
                                            },
                                            [
                                              _c(
                                                "div",
                                                { staticClass: "link" },
                                                [_vm._v("Learn More")]
                                              )
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _c(
                                        "a",
                                        {
                                          on: {
                                            click: function($event) {
                                              $event.preventDefault()
                                              return _vm.deleteImg(
                                                $index,
                                                img.id
                                              )
                                            }
                                          }
                                        },
                                        [
                                          _c(
                                            "div",
                                            {
                                              staticClass: "link",
                                              staticStyle: { color: "#e91e63" }
                                            },
                                            [_vm._v("DELETE")]
                                          )
                                        ]
                                      )
                                    ]
                                  )
                                ],
                                1
                              )
                            : _vm._e()
                        ],
                        1
                      )
                    : _vm._e()
                })
              ],
              2
            ),
            _vm._v(" "),
            _vm.pagination
              ? _c("div", { staticClass: "center" }, [
                  _c(
                    "div",
                    { staticClass: "relative-pagination" },
                    [
                      _c(
                        "pagination",
                        {
                          attrs: { data: _vm.imgs },
                          on: { "pagination-change-page": _vm.getResults }
                        },
                        [
                          _c(
                            "span",
                            {
                              staticClass: "prev",
                              attrs: { slot: "prev-nav" },
                              slot: "prev-nav"
                            },
                            [_vm._v("Previous")]
                          ),
                          _vm._v(" "),
                          _c(
                            "span",
                            {
                              staticClass: "next",
                              attrs: { slot: "next-nav" },
                              slot: "next-nav"
                            },
                            [_vm._v("Next")]
                          )
                        ]
                      )
                    ],
                    1
                  )
                ])
              : _vm._e(),
            _vm._v(" "),
            !_vm.pagination && _vm.imgs && _vm.imgs.length > _vm.limit - 1
              ? _c("div", { staticClass: "see-all-box" }, [
                  _c(
                    "a",
                    {
                      staticClass: "see-all btn purple2 negative",
                      attrs: { href: "account/" + _vm.status }
                    },
                    [_vm._v("See All")]
                  )
                ])
              : _vm._e()
          ],
          1
        )
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "img" }, [
      _c("img", {
        attrs: {
          src:
            "https://admin.ondema-m.com/storage/images/artigram-site-assets/Group.png"
        }
      })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/admin/Gallery.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/admin/Gallery.vue ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Gallery_vue_vue_type_template_id_62d9e337___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Gallery.vue?vue&type=template&id=62d9e337& */ "./resources/js/components/admin/Gallery.vue?vue&type=template&id=62d9e337&");
/* harmony import */ var _Gallery_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Gallery.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/Gallery.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Gallery_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Gallery_vue_vue_type_template_id_62d9e337___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Gallery_vue_vue_type_template_id_62d9e337___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/Gallery.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/Gallery.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/admin/Gallery.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Gallery_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Gallery.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/Gallery.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Gallery_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/Gallery.vue?vue&type=template&id=62d9e337&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/admin/Gallery.vue?vue&type=template&id=62d9e337& ***!
  \**********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Gallery_vue_vue_type_template_id_62d9e337___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Gallery.vue?vue&type=template&id=62d9e337& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/Gallery.vue?vue&type=template&id=62d9e337&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Gallery_vue_vue_type_template_id_62d9e337___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Gallery_vue_vue_type_template_id_62d9e337___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);