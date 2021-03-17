import Vue from "vue";
// import App from "./components/App.vue";
// import $ from 'jquery'
global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;
import Axios from 'axios';
window.axios = require('axios');

import router from "./router";
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";


import VueMultianalytics from 'vue-multianalytics'//https://github.com/Glovo/vue-multianalytics
let mixpanelConfig = {
  token: '40e70b1a38cf389a57f5983a7d3bfdd5',
  config: {},
  debug: true
}
Vue.use(require('vue-moment'));
Vue.use(VueMultianalytics, {
  modules: {
    // ga: gaConfig,
    mixpanel: mixpanelConfig
  }
})
import VueSocialSharing from 'vue-social-sharing'
Vue.use(VueSocialSharing);
import { VLazyImagePlugin } from "v-lazy-image";
Vue.use(VLazyImagePlugin);

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

import VuePusher from 'vue-pusher'
Vue.use(VuePusher, {
  api_key: '077407cb7b613f5fc323',
  options: {
    cluster: 'eu'
  //   encrypted: true,
  //   authEndpoint: `${process.env.VUE_APP_API_URL}/api/broadcasting/auth`,
  //   auth: {
  //     headers: {
  //       Authorization: `Bearer ${store.state.auth.token}`
  //     }
  //   }
  }
})

import CxltToastr from 'cxlt-vue2-toastr';
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css';
var toastrConfigs = {
  position: 'top right',
  timeOut: 100000,
}
Vue.use(CxltToastr, toastrConfigs)

import Clipboard from 'v-clipboard'
Vue.use(Clipboard)

import VueMasonry from 'vue-masonry-css'
Vue.use(VueMasonry)

// import EnlargeableImage from '@diracleo/vue-enlargeable-image';
// Vue.use(EnlargeableImage);

import VModal from 'vue-js-modal';
Vue.use(VModal, {
  dynamic: true,
  dynamicDefaults: {
    clickToClose: true
  },
  injectModalsContainer: true
});

Vue.config.productionTip = false;

Vue.component('dropdown-menu', () => import('@innologica/vue-dropdown-menu'));
Vue.component('enlargeable-image', () => import('@diracleo/vue-enlargeable-image'));
Vue.component('app', () => import('./components/layout/App.vue'));
Vue.component('navigation', () => import('./components/layout/Navigation.vue'));
Vue.component('app-footer', () => import('./components/layout/Footer.vue'));
Vue.component('sidebar', () => import('./components/admin/Sidebar.vue'));

Vue.component('edit-modal', () => import('./components/admin/EditModal'));
Vue.component('media-modal', () => import('./components/admin/MediaModal'));
Vue.component('products-modal', () => import('./components/admin/ProductsModal'));
Vue.component('video-modal', () => import('./components/admin/VideoModal'));
Vue.component('account-gallery', () => import('./components/admin/Gallery'));
Vue.component('store-management', () => import('./components/admin/StoreManagement'));

Vue.component('cart', () => import('./components/Cart'));
Vue.component('tags', () => import('./components/Tags'));
Vue.component('share-modal', () => import('./components/ShareModal'));
Vue.component('shop-modal', () => import('./components/ShopModal'));




import User from "./apis/User";
import Api from "./apis/Api";

const app=new Vue({
  router,
  el: '#app',
  components: {},
  data() {
    return {
      isLoggedIn:false,
      messages: [],
      isDev: false,
      toastPosition: 'top right',
      searchInput: '',
      clicked: false,
      bio: '',
      screenWidth: 0,
      isMobile: 0,
      currentUrl: null,
      apiUrl: 'https://rebuild.dev.artigram.me',
      storageUrl: 'https://rebuild.dev.artigram.me/storage',
    };
  },
  watch: {
    $route(val) {
      if(localStorage.auth ){

      }
    },
  },
  methods: {
    copied() {
      this.$toast.success({
        title:'Copied',
        message:"Copied to clipboard",
        position: this.toastPosition,
        duration: 2000
      });
    },
    elementAt(obj,index){
      // debugger;
      if(!obj) return 0;
      return obj[Object.keys(obj)[index]];
    },
    getPinterestContent(img){
      return '#Artigram #wallart #walldecor #homedecor #roomdecor #decor #art #cooldesign #coolphotos #images #phonecasess #apparel #pillows #tshirts'+ img.tags.replace("/#/g", " #");
    },
    trimString(string,length){
      var trimmedString = string.length > length ?
      string.substring(0, length - 3) + "..." :
      string;
      return trimmedString;
    }
  },
  created() {
    this.isDev=window.location.origin.includes("dev.");
    this.currentUrl = window.location.origin + '/';
    this.screenWidth = window.innerWidth;
    this.isMobile = 0;
    if(window.innerWidth<700){
      this.isMobile = 1;
    }
    if (this.isMobile) {
      this.toastPosition = 'top full width';
    }
  },
  mounted() {
    this.isLoggedIn=localStorage.getItem("auth");
  },
});
