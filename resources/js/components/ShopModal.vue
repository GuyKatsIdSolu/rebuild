<template>
  <modal class="top" name="ShopModal" width="860px" height="auto" :scrollable="true" :reset="true" @before-open="beforeOpen" @before-close="beforeClose">
    <div class="shop-modal">
      <a class="close" @click.prevent="$modal.hide('ShopModal')">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 20px; height: 20px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1">
          <path
          d="M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z" />
        </svg>
      </a>
      <div class="">
        <div class="user-big-thumb">
          <img :src="$root.storageUrl+'/creator_images/'+creator.id+'.jpg'" alt="Avatar of user" style="">
        </div>
        <div class="row-one">
          <div class="title">{{img.name}}<span> (ID {{img.id}})</span></div>
          <div class="desc">{{img.description}}</div>
        </div>
      </div>
      <div class="row-two">
        <div class="" style="    margin-bottom: 20px;position: relative;">
          <transition name="fade">
            <div class="row cur-box" v-if="curProduct" :key="curProduct">
              <div class="col-md-6">
                <div class="product-preview-box" >
                  <ShareNetwork
                  @open="$root.clicked = true"
                  @close="$root.clicked = false"
                  network="pinterest"
                  :url="$root.currentUrl+ '/product-' + curProduct.id"
                  :title="img.name"
                  :description="img.description"
                  :media="$root.currentUrl + $root.storageUrl+'/creator_images/'+img.id+'/previews/'+curProduct.product_code+'/1000_1.jpg'"
                  >
                  <svg height="30px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><defs id="defs19"/><g id="g3031"><path d="m 511.672,255.92999 c 0,141.3849 -114.61511,256 -256,256 -141.3849,0 -256.00000293,-114.6151 -256.00000293,-256 C -0.32800293,114.5451 114.2871,-0.07000732 255.672,-0.07000732 c 141.38489,0 256,114.61510732 256,255.99999732 z" id="circle8" style="fill:#cb2027;fill-opacity:1"/><g id="g3000" transform="translate(-603.11865,-9.8474559)"><g id="g3142" transform="translate(221.28814,-27.9639)"><g id="Layer_14"><g id="g3121"><path d="m 645.85601,122.6817 c -93.402,0 -140.5,66.963 -140.5,122.815 0,33.812 12.796,63.89 40.25,75.089 4.505,1.858 8.54,0.065 9.849,-4.916 0.906,-3.438 3.055,-12.139 4.015,-15.777 1.31,-4.928 0.799,-6.646 -2.833,-10.957 -7.916,-9.332 -12.985,-21.416 -12.985,-38.551 0,-49.677 37.175,-94.154 96.794,-94.154 52.797,0 81.801,32.26 81.801,75.329 0,56.692 -25.089,104.534 -62.325,104.534 -20.563,0 -35.953,-16.999 -31.031,-37.865 5.908,-24.908 17.355,-51.777 17.355,-69.771 0,-16.087 -8.646,-29.507 -26.513,-29.507 -21.021,0 -37.913,21.752 -37.913,50.884 0,18.558 6.271,31.112 6.271,31.112 0,0 -21.518,91.16 -25.291,107.125 -7.506,31.798 -1.128,70.766 -0.584,74.692 0.315,2.343 3.317,2.907 4.68,1.142 1.927,-2.53 26.983,-33.441 35.482,-64.34 2.417,-8.739 13.831,-54.032 13.831,-54.032 6.835,13.038 26.794,24.491 48.024,24.491 63.19,0 106.072,-57.604 106.072,-134.719 0.006,-58.317 -49.387,-112.624 -124.449,-112.624 z" id="path3131" style="fill:#ffffff"/></g></g><g id="Layer_1_1_-8"/></g></g></g><g id="Layer_1_1_"/></svg>
                </ShareNetwork>
                <div class="likes">
                  <svg v-if="!$parent.imgLikeClicked.includes(img.id)" @click="like(img)" class="heart" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150"><defs></defs><g class="cls-1"><circle class="cls-2" cx="75" cy="75" r="74.88"/><path class="cls-3" d="M150,68.25A74.75,74.75,0,1,1,75.25,143,74.83,74.83,0,0,1,150,68.25m0-.25a75,75,0,1,0,75,75,75,75,0,0,0-75-75Z" transform="translate(-75 -68)"/></g><path class="cls-4" d="M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z" transform="translate(-75 -68)"/><path class="cls-5" d="M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z" transform="translate(-75 -68)"/>
                  </svg>
                  <svg v-else @click="like(img)" class="heart2" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150"><defs></defs><g class="cls-1"><circle class="cls-2" cx="75" cy="75" r="74.88"/><path class="cls-3" d="M150,68.25A74.75,74.75,0,1,1,75.25,143,74.83,74.83,0,0,1,150,68.25m0-.25a75,75,0,1,0,75,75,75,75,0,0,0-75-75Z" transform="translate(-75 -68)"/></g><path class="cls-4" d="M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z" transform="translate(-75 -68)"/></svg>
                </div>
                <v-lazy-image :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/'+curProduct.product_code+'/1000_1.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
              </div>
            </div>
            <div class="col-md-6 details" >
              <div class="title">{{curProduct.details.category.name}}</div>
              <div class="price">
                <transition name="fade" mode="out-in">
                  <span class="before">${{prices[curProduct.product_code]}}</span>
                </transition>
                <transition name="fade" mode="out-in">
                  <span class="after">${{(prices[curProduct.product_code]*(100 - creator.discount)/100).toFixed(2)}}</span>
                </transition>
              </div>
              <div class="product" v-if=" Object.keys(productsByCategory[curProduct.details.category_id]).length>1">
                <div class="label">TYPE</div>
                <div class="dropdown show" >
                  <a class="button dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{curProduct.details.title}}
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="" @click.prevent="product=otherModel"  v-for="(otherModel, pid) in productsByCategory[curProduct.details.category_id]">{{otherModel.details.title}}</a>
                  </div>
                </div>
              </div>
              <div class="properties" v-if="JSON.parse(curProduct.details.production_details.other) && JSON.parse(curProduct.details.production_details.other).hasOwnProperty('requireProperties')">
                <div class="property" :class="property.name" v-for="(property ,index) in JSON.parse(curProduct.details.production_details.other).requireProperties" :key="index">
                  <label>{{property.name}} &nbsp</label>
                  <br>
                  <select v-if="property.name!='color'" v-model="selectedProperties[property.name]" >
                    <option disabled selected value="none">-</option>
                    <option v-for="(option ,optionName) in property.options"  :value="optionName">{{optionName}}</option>
                  </select>
                  <div v-else>
                    <span :class="selectedProperties[property.name]==optionName? 'active':''" @click="chooseColor(optionName)" :style="'background:'+optionName" v-for="(option ,optionName) in property.options"></span>
                  </div>
                </div>
              </div>
              <div class="bottom">
                <a @click.prevent="addToCart()" class="add-to-cart btn purple negative">Add To Cart</a>
                <a @click.prevent="addToCart(true)" class="checkout btn purple">Express Checkout</a>
                <a class="view" href="" @click.prevent="$router.push('/product-' + curProduct.id)">View product</a>
                <div class="likes-counter">
                  <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 294.89 284"><defs></defs><path class="cls-1" d="M217.25,10c44.2.25,80,42.33,80.21,94.37C297.46,199.64,150,294,150,294S2.57,198.25,2.57,104.37C2.57,52.33,38.48,10,82.78,10h0c27.13-.27,52.46,15.79,67.23,42.54C164.9,25.93,190.29,9.9,217.25,10Z" transform="translate(-2.57 -10)"/></svg>
                  <div class="number">{{img.likes}}</div>
                </div>
              </div>

            </div>
          </div>
        </transition>
      </div>
      <div class="">
        <hooper :wheelControl="false" :itemsToShow="4" :infiniteScroll="true">
          <slide v-for="(product ,index) in products" :key="index">
            <div class="thumbnail-wrapper" @click.prevent="curProduct=product">
              <v-lazy-image class="thumbnail" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/'+curProduct.product_code+'/1000_1.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
            </div>
          </slide>
          <hooper-navigation slot="hooper-addons"></hooper-navigation>
        </hooper>
      </div>
      <div class="view-full-shop" @click.prevent="goToShop(img.id)"><img :src="$root.storageUrl+'/images/view_products_icon.png'" /> View all products</div>
    </div>

  </div>
</modal>
</template>
<script>
import Api from "../apis/Api";

import {
  Hooper,
  Slide,
  Navigation as HooperNavigation
} from 'hooper';
import 'hooper/dist/hooper.css';

export default {
  name: 'ShopModal',
  props: ['creator'],
  components: {
    Hooper,
    Slide,
    HooperNavigation
  },
  data() {
    return {
      img: 0,
      quantity: 1,
      curProduct:null,
      selectedProperties: {},
      categories: [],
      products: [],
      productsByCategory: {},
      prices: {},
    }
  },
  watch:{
    creator: function(newVal, oldVal) {
      // this.prices=JSON.parse(this.creator.products_price);
    },
    curProduct: function(newVal, oldVal) {
      this.selectedProperties={};
      if(JSON.parse(this.curProduct.details.production_details.other).hasOwnProperty('requireProperties')){
        var properties=JSON.parse(this.curProduct.details.production_details.other).requireProperties;
        for (var name in properties) {
          this.$set(this.selectedProperties,properties[name].name,'none');
        }
      }
    },
  },
  created() {
    this.prices=JSON.parse(this.creator.products_price);
    this.selectedProperties={};
  },
  methods: {
    like(img){
      this.$root.clicked = true;
      this.$parent.imgLikeClicked.push(img.id);
      img.likes++;
      Api.get('/api/image-like/'+img.id)
      .then(response => {
        this.$root.clicked = false;
      });
    },
    showMore(){
      $ma.trackEvent({
        action: 'quick-view-popup',
        properties: {
          feature: 'show-more-button',
          type: 'button-clicked'
        }
      });
      this.$router.push('/product-' + this.curProduct.id);
    },
    goShopUrl() {
      return this.$root.currentUrl.replace('https://my.', 'https://shop.');
    },
    showMore(event) {
      var element = $(event.target).closest('.details');
      if ($(event.target).html() == 'Show More...') {
        element.find('.desc').css('height', 'auto');
        // element.closest('.hooper').css('height','auto');
        $(event.target).html('Show Less...');
        setTimeout(function() {
          $(event.target).click();
        }, 3000);
      } else {
        element.find('.desc').css('height', '75px');
        // element.closest('.hooper').css('height','390px');
        $(event.target).html('Show More...');
      }
    },
    goToShop(imgId) {
      this.$ma.trackEvent({
        action: 'quick-view-popup',
        properties: {
          feature: 'view-all-products-button',
          type: 'clicked'
        }
      });
      window.location.href = '/gallery/' + imgId;
    },
    addToCart(goCheckoutPage=false) {
      if(JSON.parse(this.curProduct.details.production_details.other).hasOwnProperty('requireProperties')){
        var properties=JSON.parse(this.curProduct.details.production_details.other).requireProperties;
        for (var name in properties) {
          if(this.selectedProperties[properties[name].name]=='none'){
            this.$toast.error({
              title:'Please choose a '+properties[name].name,
              message:"It will look better on you",
              position: this.$root.toastPosition,
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
      Api.post('/api/add-item-to-cart', {
        'productId': this.curProduct.id,
        'properties': this.selectedProperties,
        'quantity': this.quantity,
        'previewUrl': this.$root.currentUrl + $root.storageUrl+'/creator_images/'+this.img.id+'/previews/'+this.curProduct.product_code+'/1000_1.jpg',
        'price': (this.prices[this.curProduct.product_code]*(100-this.creator.discount)/100).toFixed(2),
      })
      .then(response => {
        this.$root.$refs.app.$refs.nav.$refs.cart.cartContent = this.img.products;
        if(goCheckoutPage) this.$router.push({ name: "Checkout" });
      });
      // ga('send', 'event', 'EnhancedEcommerce', 'Added Product', window.location.pathname);
      // fbq('track', 'AddToCart', {
      //   content_ids: element.data('pid'),
      //   content_name: element.find('.details .title').html(),
      //   content_type: 'product',
      //   value: element.find('.details .dis-price .inpt').html(),
      //   content_category: element.find('.details .dis-price').data('cat_name'),
      //   currency: 'USD',
      // });
    },
    slideTo(index) {
      this.$refs.carousel.slideTo(index);
    },
    getProductPreviews() {
      var that = this;
      // Api.get('/api/image-products/' + this.img.id)
      // .then(response => {
        for (var index in this.img.products) {
          if(that.categories.includes(this.img.products[index].details.category_id)){
            that.$set(that.productsByCategory[this.img.products[index].details.category_id], this.img.products[index].id, this.img.products[index]);
          }else{
            that.$set(that.productsByCategory, this.img.products[index].details.category_id, {});
            that.$set(that.productsByCategory[this.img.products[index].details.category_id], this.img.products[index].id, this.img.products[index]);
            // that.$set(that.products, index, {});
            that.products.push(this.img.products[index]);
            that.categories.push(this.img.products[index].details.category_id);
          }
          if(index==0) that.curProduct=this.img.products[index];
        }
      // });
    },
    isEmpty(a, b) {
      // return Object.keys(this.galleryObj.children_array[a][b]).length > 1;
    },
    openModal(img) {
      this.img = img;
      this.getProductPreviews();
      this.$modal.show('ShopModal');
    },
    beforeOpen(event) {
      this.$root.clicked = true;
    },
    beforeClose(event) {
      this.$root.clicked = false;
    }
  }
}
</script>
