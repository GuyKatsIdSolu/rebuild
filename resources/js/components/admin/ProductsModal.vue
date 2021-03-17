<template>
<modal class="edit-modal" name="ProductsModal" width="860px" height="710px" :scrollable="true" :reset="true" @before-open="beforeOpen" @opened="afterOpen" @before-close="beforeClose">
  <div class="container edit-image-popup">
    <a class="close" @click="$modal.hide('ProductsModal')">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 16px; height: 16px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1">
        <path
          d="M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z" />
      </svg>
    </a>
    <div class="col-md-12 row-1">
      <h2 v-if="$root.isMobile" class="title">
        Products <span class="id">ID ({{img.id}})</span>
      </h2>
      <h2 v-else class="title">
        Image ID {{img.id}}
      </h2>
    </div>
    <div class="products-box">
      <div class="row-two" style="margin-top: -18px;">
        <div class="" style="    margin-bottom: -20px;">
          <hooper ref="carousel" :wheelControl="false" style="height:390px;" :infiniteScroll="true">
            <slide v-for="(template, key,index) in galleryObj.templates_list" :key="key">
              <div class="row cur-box" :data-pid="galleryObj.products_list[key].id">
                <div class="col-md-6">
                  <div class="product-preview-box" :id="index" style="width: 80%;    min-height: 250px;">
                    <img class="" :src="galleryObj.products_list[key].preview_url">
                  </div>
                </div>
                <div class="col-md-6 details">
                  <div class="title">{{template.title}}</div>
                  <div class="desc" v-html="template.html_description"></div>
                  <div class="col-xs-12 prices" style="margin-top: 10px;">
                    <div class="price">$<span class="inpt">{{template.price}}</span></div>
                    <div class="dis-price">$<span class="inpt">{{(template.price*(100-galleryObj.campaign.discount_percent)/100).toFixed(2)}}</span></div>
                  </div>
                  <div class="prices-page-box">
                    To edit shop products and set products prices please visit <a :href="tokenUrl" style="    color: #C000FF;">Store settings page</a>
                  </div>
                </div>
              </div>
            </slide>
            <hooper-pagination v-if="$root.isMobile" slot="hooper-addons">
            </hooper-pagination>
          </hooper>
        </div>
        <div class="" v-if="!$root.isMobile">
          <hooper :wheelControl="false" style="width:90%;" :itemsToShow="4" :infiniteScroll="true">
            <slide v-for="(template,key, index) in galleryObj.templates_list" :key="key">
              <div class="thumbnail-wrapper" @click="slideTo(index)">
                <img class="thumbnail" :src="galleryObj.products_list[key].preview_url">
              </div>
            </slide>
            <hooper-navigation slot="hooper-addons"></hooper-navigation>
          </hooper>
        </div>
      </div>
    </div>
  </div>
</modal>
</template>
<script>
import Api from "../../apis/Api";

import {
  Hooper,
  Slide,
  Navigation as HooperNavigation,
  Pagination as HooperPagination

} from 'hooper';
import 'hooper/dist/hooper.css';

export default {
  props: ['authUser', 'tokenUrl'],
  components: {
    Hooper,
    Slide,
    HooperNavigation,
    HooperPagination
  },
  data() {
    return {
      img: 0,
      tags: [],
      duration: 5000,
      store_id: 0,
      showProducts: false,
      galleryObj: {},
    }
  },
  methods: {
    slideTo(index) {
      this.$refs.carousel.slideTo(index);
    },
    isEmpty(a, b) {
      return Object.keys(this.galleryObj.children_array[a][b]).length > 1;
    },
    deleteTag: function(event) {
      var element = event.target;
      var val = $(element).closest('.tag').find('.value').html();
      var index = this.tags.indexOf(val);
      this.tags.splice(index, 1);
    },
    closeEditModal() {
      this.$modal.hide('EditModal');
    },
    openModal(img) {
      this.img = img;
      this.$modal.show('ProductsModal');
    },
    afterOpen(event) {
      if (this.$root.isMobile) {
        $('html body .body .edit-modal .v--modal-box.v--modal').height(window.innerHeight);
      }
      var tags = this.img.tags.split("#");
      tags.shift();
      this.tags = tags;
      $.each(tags, function(key, value) {
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
    beforeOpen(event) {
      this.$root.clicked = true;
      this.galleryObj = {};
    },
    beforeClose(event) {
      this.$root.clicked = false;
      this.showProducts = false;
    },
    getProductPreviews(storeId) {
      var vm = this;
      axios.get('/api/get-product-previews/' + storeId)
        .then(response => {
          vm.galleryObj = response.data;
        });
    }
  }
}
</script>
