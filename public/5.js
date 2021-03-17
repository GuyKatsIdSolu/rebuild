(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ShareModal.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ShareModal.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'ShareModal',
  props: ['url', 'title', 'description', 'quote', 'hashtags', 'twitterUser'],
  components: {},
  data: function data() {
    return {
      fhashtags: '',
      media: '',
      networks: [{
        network: 'email',
        name: 'Mail',
        icon: 'far fah fa-lg fa-envelope',
        color: '#b200ff'
      }, {
        network: 'facebook',
        name: 'Facebook',
        icon: 'fab fah fa-lg fa-facebook-f',
        color: '#1877f2'
      }, {
        network: 'pinterest',
        name: 'Pinterest',
        icon: 'fab fah fa-lg fa-pinterest',
        color: '#bd081c'
      }, {
        network: 'twitter',
        name: 'Twitter',
        icon: 'fab fah fa-lg fa-twitter',
        color: '#1da1f2'
      }, {
        network: 'whatsapp',
        name: 'Whatsapp',
        icon: 'fab fah fa-lg fa-whatsapp',
        color: '#25d366'
      } // { network: 'reddit', name: 'Reddit', icon: 'fab fah fa-lg fa-reddit-alien', color: '#ff4500' },
      // { network: 'tumblr', name: 'Tumblr', icon: 'fab fah fa-lg fa-tumblr', color: '#35465c' },
      // { network: 'baidu', name: 'Baidu', icon: 'fas fah fa-lg fa-paw', color: '#2529d8' },
      // { network: 'buffer', name: 'Buffer', icon: 'fab fah fa-lg fa-buffer', color: '#323b43' },
      // { network: 'evernote', name: 'Evernote', icon: 'fab fah fa-lg fa-evernote', color: '#2dbe60' },
      // { network: 'flipboard', name: 'Flipboard', icon: 'fab fah fa-lg fa-flipboard', color: '#e12828' },
      // { network: 'hackernews', name: 'HackerNews', icon: 'fab fah fa-lg fa-hacker-news', color: '#ff4000' },
      // { network: 'instapaper', name: 'Instapaper', icon: 'fas fah fa-lg fa-italic', color: '#428bca' },
      // { network: 'line', name: 'Line', icon: 'fab fah fa-lg fa-line', color: '#00c300' },
      // { network: 'linkedin', name: 'LinkedIn', icon: 'fab fah fa-lg fa-linkedin', color: '#007bb5' },
      // { network: 'odnoklassniki', name: 'Odnoklassniki', icon: 'fab fah fa-lg fa-odnoklassniki', color: '#ed812b' },
      // { network: 'pocket', name: 'Pocket', icon: 'fab fah fa-lg fa-get-pocket', color: '#ef4056' },
      // { network: 'quora', name: 'Quora', icon: 'fab fah fa-lg fa-quora', color: '#a82400' },
      // { network: 'skype', name: 'Skype', icon: 'fab fah fa-lg fa-skype', color: '#00aff0' },
      // { network: 'sms', name: 'SMS', icon: 'far fah fa-lg fa-comment-dots', color: '#333333' },
      // { network: 'stumbleupon', name: 'StumbleUpon', icon: 'fab fah fa-lg fa-stumbleupon', color: '#eb4924' },
      // { network: 'telegram', name: 'Telegram', icon: 'fab fah fa-lg fa-telegram-plane', color: '#0088cc' },
      // { network: 'viber', name: 'Viber', icon: 'fab fah fa-lg fa-viber', color: '#59267c' },
      // { network: 'vk', name: 'Vk', icon: 'fab fah fa-lg fa-vk', color: '#4a76a8' },
      // { network: 'weibo', name: 'Weibo', icon: 'fab fah fa-lg fa-weibo', color: '#e9152d' },
      // { network: 'wordpress', name: 'Wordpress', icon: 'fab fah fa-lg fa-wordpress', color: '#21759b' },
      // { network: 'xing', name: 'Xing', icon: 'fab fah fa-lg fa-xing', color: '#026466' },
      // { network: 'yammer', name: 'Yammer', icon: 'fab fah fa-lg fa-yammer', color: '#0072c6' },
      // { network: 'fakeblock', name: 'Custom Network', icon: 'fab fah fa-lg fa-vuejs', color: '#41b883' }
      ]
    };
  },
  created: function created() {},
  methods: {
    copied: function copied() {
      this.$toast.success({
        title: 'Copied',
        message: "Copied to clipboard",
        position: this.$root.toastPosition,
        duration: 2000
      });
    },
    openModal: function openModal(img) {
      this.$modal.show('ShareModal');
      this.title = img.name;
      this.description = img.description;
      this.url = this.$root.currentUrl + '/gallery/' + img.id;
      this.media = this.$root.storageUrl + '/creators_images/' + img.id + '/500.jpg';
      this.hashtags = 'Artigram' + img.tags.replace("/#/g", ",");
    },
    beforeOpen: function beforeOpen(event) {
      this.$root.clicked = true;
      this.hashtags = 'Artigram,' + this.$root.$refs.userGallery.tags.slice(0, 29).join(',');
      this.fhashtags = this.hashtags.substring(0, 135 - this.title.length - this.twitterUser.length);
    },
    beforeClose: function beforeClose(event) {
      this.$root.clicked = false;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ShareModal.vue?vue&type=template&id=7965c3b9&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ShareModal.vue?vue&type=template&id=7965c3b9& ***!
  \*************************************************************************************************************************************************************************************************************/
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
      staticClass: "share-modal",
      attrs: {
        name: "ShareModal",
        width: "860px",
        height: "auto",
        scrollable: true,
        reset: true
      },
      on: { "before-open": _vm.beforeOpen, "before-close": _vm.beforeClose }
    },
    [
      _c(
        "div",
        { staticClass: "share-network-list" },
        [
          _c("div", { staticClass: "title" }, [
            _vm._v("Share with your friends")
          ]),
          _vm._v(" "),
          _vm._l(_vm.networks, function(network) {
            return _c(
              "ShareNetwork",
              {
                key: network.network,
                style: { backgroundColor: network.color },
                attrs: {
                  network: network.network,
                  url: _vm.url,
                  title: _vm.title,
                  description: _vm.description,
                  quote: _vm.quote,
                  hashtags:
                    network.name == "facebook" ? _vm.fhashtags : _vm.hashtags,
                  twitterUser: _vm.twitterUser
                }
              },
              [
                _c("i", { class: network.icon }),
                _vm._v(" "),
                _c("span", [_vm._v(_vm._s(network.name))])
              ]
            )
          }),
          _vm._v(" "),
          _c("div", { staticClass: "copy" }, [
            _c("input", {
              attrs: { disabled: "" },
              domProps: { value: _vm.url }
            }),
            _vm._v(" "),
            _c(
              "button",
              {
                directives: [
                  {
                    name: "clipboard",
                    rawName: "v-clipboard",
                    value: function() {
                      return _vm.url
                    },
                    expression: "() => url"
                  }
                ],
                staticClass: "btn purple",
                on: { click: _vm.copied }
              },
              [_vm._v("\n          Copy\n        ")]
            )
          ])
        ],
        2
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/ShareModal.vue":
/*!************************************************!*\
  !*** ./resources/js/components/ShareModal.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ShareModal_vue_vue_type_template_id_7965c3b9___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ShareModal.vue?vue&type=template&id=7965c3b9& */ "./resources/js/components/ShareModal.vue?vue&type=template&id=7965c3b9&");
/* harmony import */ var _ShareModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ShareModal.vue?vue&type=script&lang=js& */ "./resources/js/components/ShareModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ShareModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ShareModal_vue_vue_type_template_id_7965c3b9___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ShareModal_vue_vue_type_template_id_7965c3b9___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ShareModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ShareModal.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/ShareModal.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShareModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ShareModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ShareModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShareModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ShareModal.vue?vue&type=template&id=7965c3b9&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/ShareModal.vue?vue&type=template&id=7965c3b9& ***!
  \*******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShareModal_vue_vue_type_template_id_7965c3b9___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ShareModal.vue?vue&type=template&id=7965c3b9& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ShareModal.vue?vue&type=template&id=7965c3b9&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShareModal_vue_vue_type_template_id_7965c3b9___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ShareModal_vue_vue_type_template_id_7965c3b9___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);