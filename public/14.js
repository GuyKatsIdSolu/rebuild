(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[14],{

/***/ "./node_modules/@diracleo/vue-enlargeable-image/dist/vue-enlargeable-image.esm.js":
/*!****************************************************************************************!*\
  !*** ./node_modules/@diracleo/vue-enlargeable-image/dist/vue-enlargeable-image.esm.js ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
var script = {
  name: 'EnlargeableImage',
  props: {
    src: {
      type: String
    },
    src_large: {
      type: String
    },
    animation_duration: {
      type: String,
      default: "700"
    },
    trigger: {
      type: String,
      default: "click"
    }
  },

  data() {
    return {
      state: this.state,
      styles: this.styles
    };
  },

  methods: {
    init() {
      var self = this;
      self.state = "delarged";
      self.delay = 50;
      self.adjust_top = 0;
      self.wait = false;
      var transition_seconds = parseInt(self.$props.animation_duration) / 1000;

      if (transition_seconds == 0) {
        self.delay = 0;
      }

      transition_seconds = transition_seconds.toFixed(2);
      self.transition_value = "width " + transition_seconds + "s, height " + transition_seconds + "s, top " + transition_seconds + "s, left " + transition_seconds + "s, background-color " + transition_seconds + "s";
      self.styles = {
        transition: self.transition_value
      };

      if (self.$props.trigger == "hover") {
        self.styles.pointerEvents = "none";
      }
    },

    enlarge() {
      var self = this;
      var rect = self.$refs.slot.getBoundingClientRect();
      self.styles = {
        position: "fixed",
        left: Math.round(rect.left) + "px",
        top: Math.round(rect.top + self.adjust_top) + "px",
        width: Math.round(rect.right - rect.left) + "px",
        height: Math.round(rect.bottom - rect.top) + "px",
        backgroundImage: "url(" + self.$props.src + ")",
        transition: self.transition_value
      };

      if (self.$props.trigger == "hover") {
        self.styles.pointerEvents = "none";
      }

      self.state = "enlarging";

      if (typeof self.timer != 'undefined') {
        clearTimeout(self.timer);
      }

      self.timer = setTimeout(function () {
        self.$emit('enlarging');
        self.styles = {
          backgroundImage: "url(" + self.$props.src + ")",
          transition: self.transition_value
        };

        if (self.$props.trigger == "hover") {
          self.styles.pointerEvents = "none";
        }

        if (typeof self.timer != 'undefined') {
          clearTimeout(self.timer);
        }

        self.timer = setTimeout(function () {
          self.state = "enlarged";
          self.$emit('enlarged');
        }, self.$props.animation_duration);
      }, self.delay);
    },

    reset() {
      var self = this;

      if (self.state != "delarging") {
        var rect = self.$refs.slot.getBoundingClientRect();

        if (typeof self.timer != 'undefined') {
          clearTimeout(self.timer);
        }

        self.timer = setTimeout(function () {
          self.state = "delarging";
          self.$emit('delarging');
          self.styles = {
            backgroundImage: "url(" + self.$props.src + ")",
            position: "fixed",
            left: Math.round(rect.left) + "px",
            top: Math.round(rect.top + self.adjust_top) + "px",
            width: Math.round(rect.right - rect.left) + "px",
            height: Math.round(rect.bottom - rect.top) + "px",
            transition: self.transition_value
          };

          if (self.$props.trigger == "hover") {
            self.styles.pointerEvents = "none";
          }

          if (typeof self.timer != 'undefined') {
            clearTimeout(self.timer);
          }

          self.timer = setTimeout(function () {
            self.state = "delarged";
            self.$emit('delarged');
          }, self.$props.animation_duration);
        }, 0);
      } else {
        self.enlarge();
      }
    }

  },
  mounted: function () {
    var self = this;
    self.init();
  }
};

function normalizeComponent(template, style, script, scopeId, isFunctionalTemplate, moduleIdentifier /* server only */, shadowMode, createInjector, createInjectorSSR, createInjectorShadow) {
    if (typeof shadowMode !== 'boolean') {
        createInjectorSSR = createInjector;
        createInjector = shadowMode;
        shadowMode = false;
    }
    // Vue.extend constructor export interop.
    const options = typeof script === 'function' ? script.options : script;
    // render functions
    if (template && template.render) {
        options.render = template.render;
        options.staticRenderFns = template.staticRenderFns;
        options._compiled = true;
        // functional template
        if (isFunctionalTemplate) {
            options.functional = true;
        }
    }
    // scopedId
    if (scopeId) {
        options._scopeId = scopeId;
    }
    let hook;
    if (moduleIdentifier) {
        // server build
        hook = function (context) {
            // 2.3 injection
            context =
                context || // cached call
                    (this.$vnode && this.$vnode.ssrContext) || // stateful
                    (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext); // functional
            // 2.2 with runInNewContext: true
            if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
                context = __VUE_SSR_CONTEXT__;
            }
            // inject component styles
            if (style) {
                style.call(this, createInjectorSSR(context));
            }
            // register component module identifier for async chunk inference
            if (context && context._registeredComponents) {
                context._registeredComponents.add(moduleIdentifier);
            }
        };
        // used by ssr in case component is cached and beforeCreate
        // never gets called
        options._ssrRegister = hook;
    }
    else if (style) {
        hook = shadowMode
            ? function (context) {
                style.call(this, createInjectorShadow(context, this.$root.$options.shadowRoot));
            }
            : function (context) {
                style.call(this, createInjector(context));
            };
    }
    if (hook) {
        if (options.functional) {
            // register for functional component in vue file
            const originalRender = options.render;
            options.render = function renderWithStyleInjection(h, context) {
                hook.call(context);
                return originalRender(h, context);
            };
        }
        else {
            // inject component registration as beforeCreate hook
            const existing = options.beforeCreate;
            options.beforeCreate = existing ? [].concat(existing, hook) : [hook];
        }
    }
    return script;
}

const isOldIE = typeof navigator !== 'undefined' &&
    /msie [6-9]\\b/.test(navigator.userAgent.toLowerCase());
function createInjector(context) {
    return (id, style) => addStyle(id, style);
}
let HEAD;
const styles = {};
function addStyle(id, css) {
    const group = isOldIE ? css.media || 'default' : id;
    const style = styles[group] || (styles[group] = { ids: new Set(), styles: [] });
    if (!style.ids.has(id)) {
        style.ids.add(id);
        let code = css.source;
        if (css.map) {
            // https://developer.chrome.com/devtools/docs/javascript-debugging
            // this makes source maps inside style tags work properly in Chrome
            code += '\n/*# sourceURL=' + css.map.sources[0] + ' */';
            // http://stackoverflow.com/a/26603875
            code +=
                '\n/*# sourceMappingURL=data:application/json;base64,' +
                    btoa(unescape(encodeURIComponent(JSON.stringify(css.map)))) +
                    ' */';
        }
        if (!style.element) {
            style.element = document.createElement('style');
            style.element.type = 'text/css';
            if (css.media)
                style.element.setAttribute('media', css.media);
            if (HEAD === undefined) {
                HEAD = document.head || document.getElementsByTagName('head')[0];
            }
            HEAD.appendChild(style.element);
        }
        if ('styleSheet' in style.element) {
            style.styles.push(code);
            style.element.styleSheet.cssText = style.styles
                .filter(Boolean)
                .join('\n');
        }
        else {
            const index = style.ids.size - 1;
            const textNode = document.createTextNode(code);
            const nodes = style.element.childNodes;
            if (nodes[index])
                style.element.removeChild(nodes[index]);
            if (nodes.length)
                style.element.insertBefore(textNode, nodes[index]);
            else
                style.element.appendChild(textNode);
        }
    }
}

/* script */
const __vue_script__ = script;
/* template */

var __vue_render__ = function () {
  var _vm = this;

  var _h = _vm.$createElement;

  var _c = _vm._self._c || _h;

  return _c('div', {
    class: {
      'enlargeable-image': true,
      active: _vm.state != 'delarged'
    }
  }, [_c('div', _vm._g({
    ref: "slot",
    staticClass: "slot"
  }, this.$props.trigger == 'click' ? {
    click: _vm.enlarge
  } : {
    mouseenter: _vm.enlarge,
    mouseleave: _vm.reset
  }), [_vm._t("default", [_c('img', {
    staticClass: "default",
    attrs: {
      "src": this.$props.src
    }
  })])], 2), _vm._v(" "), _c('div', _vm._g({
    staticClass: "full",
    class: _vm.state,
    style: _vm.styles
  }, this.$props.trigger == 'click' ? {
    click: _vm.reset
  } : {}), [_vm.state != 'enlarged' ? _c('img', {
    attrs: {
      "src": this.$props.src
    }
  }) : _vm._e(), _vm._v(" "), _vm.state == 'enlarged' ? _c('img', {
    attrs: {
      "src": this.$props.src_large
    }
  }) : _vm._e()])]);
};

var __vue_staticRenderFns__ = [];
/* style */

const __vue_inject_styles__ = function (inject) {
  if (!inject) return;
  inject("data-v-74c9692d_0", {
    source: ".enlargeable-image>.slot[data-v-74c9692d]{display:inline-block;max-width:100%;max-height:100%;cursor:zoom-in}.enlargeable-image>.slot>img.default[data-v-74c9692d]{max-width:100%;vertical-align:middle}.enlargeable-image.active>.slot[data-v-74c9692d]{opacity:.3;filter:grayscale(100%)}.enlargeable-image .full[data-v-74c9692d]{cursor:zoom-out;background-color:transparent;align-items:center;justify-content:center;background-position:center center;background-repeat:no-repeat;background-size:contain;display:none}.enlargeable-image .full>img[data-v-74c9692d]{object-fit:contain;width:100%;height:100%}.enlargeable-image .full.enlarging[data-v-74c9692d]{display:flex;position:fixed;left:0;top:0;width:100%;height:100%;background-color:transparent;cursor:zoom-out;z-index:3}.enlargeable-image .full.enlarged[data-v-74c9692d]{display:flex;position:fixed;left:0;top:0;width:100%;height:100%;background-color:transparent;cursor:zoom-out;z-index:2}.enlargeable-image .full.delarging[data-v-74c9692d]{display:flex;position:fixed;left:0;top:0;width:100%;height:100%;background-color:transparent;cursor:zoom-in;z-index:1}",
    map: undefined,
    media: undefined
  });
};
/* scoped */


const __vue_scope_id__ = "data-v-74c9692d";
/* module identifier */

const __vue_module_identifier__ = undefined;
/* functional template */

const __vue_is_functional_template__ = false;
/* style inject SSR */

/* style inject shadow dom */

const __vue_component__ = /*#__PURE__*/normalizeComponent({
  render: __vue_render__,
  staticRenderFns: __vue_staticRenderFns__
}, __vue_inject_styles__, __vue_script__, __vue_scope_id__, __vue_is_functional_template__, __vue_module_identifier__, false, createInjector, undefined, undefined);

// Import vue component

const install = function installVueEnlargeableImage(Vue) {
  if (install.installed) return;
  install.installed = true;
  Vue.component('VueEnlargeableImage', __vue_component__);
}; // Create module definition for Vue.use()
// to be registered via Vue.use() as well as Vue.component()


__vue_component__.install = install; // Export component by default
// also be used as directives, etc. - eg. import { RollupDemoDirective } from 'rollup-demo';
// export const RollupDemoDirective = component;

/* harmony default export */ __webpack_exports__["default"] = (__vue_component__);


/***/ })

}]);