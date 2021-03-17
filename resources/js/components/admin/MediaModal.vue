<template>
<modal class="media-modal" name="MediaModal" width="860px" height="710px" :scrollable="true" :reset="true" @before-open="beforeOpen" @opened="afterOpen" @before-close="beforeClose">
  <div v-if="cur" class="container media-image-popup">
    <a class="close" @click="$modal.hide('MediaModal')">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 16px; height: 16px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1">
        <path
          d="M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z" />
      </svg>
    </a>
    <div class="col-md-12 row-1">
      <h2 class="title" v-if="!$root.isMobile">
        Social media templates <span class="id">ID ({{img.id}})</span>
      </h2>
      <h2 class="title" v-else>
        Social media center <span class="id">(ID {{img.id}})</span>
      </h2>
      <a target="_blank" href="https://artigram.me/how-to-sell-with-instagram/" class="how-to">How to use it?</a>
    </div>
    <div class="col-md-12" style="float: right;">
      <ul class="tabs nav nav-tabs">
        <li class="">
          <a class="active" href="#posts" data-toggle="tab" aria-expanded="false">
            Posts
          </a>
        </li>
        <li class="">
          <a class="" href="#stories" data-toggle="tab" aria-expanded="false">
            Stories
          </a>
        </li>
      </ul>
      <div v-if="!$root.isMobile" class="tab-content tab-content--padded edit-photo__tab-content">
        <div class="tab-pane active" id="posts">
          <div class="row col-md-12">
            <div class="col-md-6">
              <transition name="fade">
                <v-lazy-image :key="cur" class="prev-gallery-img" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/categories/'+cur+'/post/700.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
              </transition>
            </div>
            <div class="col-md-6 right-side">
              <div class="title">Image {{img.id}} on {{categories[cur]}}</div>
              <div class="margin-10">Link to product page -</div>
              <div class="link"><a target="_blank" :href="$root.currentUrl+'product-'+curPid">{{$root.currentUrl}}product-{{curPid}}</a></div>
              <a class="copy margin-10" href="" @click.prevent="copyToClipboard($root.currentUrl+'product-'+curPid)"><i class="fas fa-link"></i> Copy Link</a>
              <div class="tags-box">
                <label for="tags">Suggested captions</label>
                <div class="tag" v-for="(imgTag, j) in tags" :key="j">
                  <span class="value">#{{imgTag}}</span>
                </div>
              </div>
              <a href="" @click.prevent="downloadImage($root.storageUrl+'/temp/'+img.id+'_'+cur+'_post.jpg', categories[cur]+' '+img.id)" class="download-btn btn purple">Download Image</a>
            </div>
          </div>
          <div class="carusel-box">
            <hooper :wheelControl="false" :itemsToShow="4" :infiniteScroll="true">
              <slide v-for="(product, $index) in products" :key="$index">
                <div class="thumbnail-wrapper">
                  <a href="" @click.prevent="cur=product.details.category_id">
                    <v-lazy-image class="thumbnail" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/categories/'+product.details.category_id+'/post/700.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
                  </a>
                </div>
              </slide>
              <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>
          </div>
        </div>
        <div class="tab-pane" id="stories">
          <div class="row col-md-12">
            <div class="col-md-6">
              <transition name="fade">
                <v-lazy-image :key="cur" class="prev-gallery-img" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/categories/'+cur+'/story/700.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
              </transition>
            </div>
            <div class="col-md-6 right-side">
              <div class="title">Image {{img.id}} on {{categories[cur]}}</div>
              <div class="margin-10">Link to product page -</div>
              <div class="link"><a target="_blank" :href="'/product-'+curPid">{{$root.currentUrl}}product-{{curPid}}</a></div>
              <a class="copy margin-10" href="" @click.prevent="copyToClipboard($root.currentUrl+'product-'+curPid)"><i class="fas fa-link"></i> Copy Link</a>
              <div class="tags-box">
                <label for="tags">Suggested captions</label>
                <div class="tag" v-for="(imgTag, j) in tags" :key="j">
                  <span class="value">#{{imgTag}}</span>
                </div>
              </div>
              <a href="" @click.prevent="downloadImage($root.storageUrl+'/creator_images/'+img.id+'/previews/categories/'+cur+'/story/700.jpg', categories[cur]+' '+img.id)" class="download-btn btn purple">Download Image</a>
            </div>
          </div>
          <div class="carusel-box">
            <hooper :wheelControl="false" :itemsToShow="4" :infiniteScroll="true">
              <slide v-for="(product, $index) in products" :key="$index">
                <div class="thumbnail-wrapper">
                  <a href="" @click.prevent="cur=product.details.category_id">
                    <v-lazy-image class="thumbnail" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/categories/'+product.details.category_id+'/story/700.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
                  </a>
                </div>
              </slide>
              <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>
          </div>
        </div>
      </div>
      <div v-else class="tab-content tab-content--padded edit-photo__tab-content">
        <div class="tab-pane active" id="posts">
          <div v-for="(template, pid) in galleryObj.templates_list" :key="pid" class="item">
            <div class="img-frame">
              <v-lazy-image :key="cur" class="prev-gallery-img" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/categories/'+cur+'/post/700.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
            </div>
            <div class="title">Image {{img.id}} on {{categories[template.our_category_id]}}</div>
            <a class="copy margin-10" href="" @click.prevent="copyToClipboard($root.currentUrl+'@'+username)"><i class="fas fa-link"></i> Store link</a>
            <a href="" @click.prevent="downloadImage($root.storageUrl+'/temp/'+img.id+'_'+cur+'_post.jpg', categories[cur]+' '+img.id)" class="download-btn btn purple">Download Image</a>
          </div>
        </div>
        <div class="tab-pane" id="stories">
          <div v-for="(template, pid) in galleryObj.templates_list" :key="pid" class="item">
            <v-lazy-image :key="cur" class="prev-gallery-img" :src="$root.storageUrl+'/temp/'+img.id+'_'+template.our_category_id+'_story.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
            <div class="title">Image {{img.id}} on {{categories[template.our_category_id]}}</div>
            <a class="copy margin-10" href="" @click.prevent="copyToClipboard($root.currentUrl+'@'+username)"><i class="fas fa-link"></i> Store link</a>
            <a href="" @click.prevent="downloadImage($root.storageUrl+'/temp/'+img.id+'_'+cur+'_story.jpg', categories[cur]+' '+img.id)" class="download-btn btn purple">Download Image</a>
          </div>
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
  Navigation as HooperNavigation
} from 'hooper';
import 'hooper/dist/hooper.css';

export default {
  name: 'MediaModal',
  props: [],
  components: {
    Hooper,
    Slide,
    HooperNavigation,
  },
  data() {
    return {
      img: 0,
      cur: 0,
      curPid: '',
      tags: [],
      duration: 5000,
      store_id: 0,
      showStories: false,
      categories: {},
      products: {},
    }
  },
  watch: {
    cur(val) {
      for (var index in this.products) {
        if(this.products[index].details.category_id==val){
          this.curPid = this.products[index].id;
          break;
        }
      }
    },
  },
  methods: {
    copyToClipboard(str) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(str).select();
      document.execCommand("copy");
      $temp.remove();
      this.$toast.info({
        title: 'Link copied to clipboard',
        message: str,
        position: this.$root.toastPosition,
        timeOut: 2000,
      });
    },
    downloadImage(url, title) {
      var a = document.createElement('a');
      a.href = url;
      a.download = title + '.jpg';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    },
    isEmpty(a, b) {
      return Object.keys(this.galleryObj.children_array[a][b]).length > 1;
    },
    openModal(img) {
      this.img = img;
      this.$modal.show('MediaModal');
      var tags = this.img.tags.split("#");
      tags.shift();
      this.tags = tags;
    },
    afterOpen(event) {},
    beforeOpen(event) {
      this.$root.clicked = true;
      this.galleryObj = {};
      this.getProductPreviews(this.img.store_id);
    },
    beforeClose(event) {
      this.$root.clicked = false;
      this.showStories = false;
    },
    getProductPreviews(storeId) {
      var vm = this;
      var that = this;
      axios.get('/api/image-products/' + this.img.id)
        .then(response => {
          that.products = response.data;
          for (var index in that.products) {

              if(that.categories.hasOwnProperty(that.products[index].details.category_id)){
                that.$delete(that.products, index);
              }else{
                that.categories[that.products[index].details.category_id]=that.products[index].details.category.name;
              }
          }
          that.cur=that.products[0].details.category_id;
        });
    }
  }
}
</script>
