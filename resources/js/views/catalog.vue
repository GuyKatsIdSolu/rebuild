<template>
  <div class="" v-if="img">
    <share-modal ref="shareModal" :url="$root.currentUrl+'@'+img.creator.username" :title="'View'+ img.creator.store_name+ 'on Artigram'" description="View my gallery page on Artigram and buy the content you like on merchandise" quote="" hashtags="" twitter-user="Artigramme"></share-modal>
    <div class="shop-gallery-page shop">
      <div class="categories-filter">
        <a href="" @click.prevent="$router.push('/@'+img.creator.username)" >
          <div class="item">
            <img :src="$root.storageUrl+'/images/nav_icons/Gallery.png'"/>
            <div>Gallery</div>
          </div>
        </a>
        <a v-for="(categoryId,index) in categories" :key="categoryId" href="" @click.prevent="$router.push('/@'+img.creator.username+'-'+categoryId)">
          <div class="item">
            <img :src="$root.storageUrl+'/images/nav_icons/'+productsBycategory[categoryId][Object.keys(productsBycategory[categoryId])[0]].details.category.name+'.png'"/>
            <div>
              {{productsBycategory[categoryId][Object.keys(productsBycategory[categoryId])[0]].details.category.name}}
            </div>
          </div>
        </a>
      </div>
      <div class="slogen">
        get {{img.creator.discount}}% off on everything
      </div>
      <div class="container no-padding">
        <div class="">
          <div class="row user-header-info">
            <div class="avatar">
              <img  :src="$root.storageUrl+'/creator_images/'+ img.creator_id+'.jpg'" alt="Avatar of creator">
            </div>
            <div class="right">
              <div class="image-name-id"><b>{{img.name}}</b> (ID {{img.id}})</div>
              <div class="by">By <a href="" @click.prevent="$router.push('/@'+img.creator.username)"><span>{{img.creator.user.first_name+' '+img.creator.user.last_name}}</span></a></div>
              <div class="bio">{{img.description}}</div>
              <div class="share"  @click.prevent="$modal.show('ShareModal')" ><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="19px" viewBox="0 0 17 19" version="1.1">
                <!-- Generator: sketchtool 59.1 (101010) - https://sketch.com -->
                <title>Share</title>
                <desc>Created with sketchtool.</desc>
                <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="public-gallery" transform="translate(-81.000000, -533.000000)" fill="#B200FF" fill-rule="nonzero">
                    <g id="Group-2" transform="translate(81.000000, 529.000000)">
                      <g id="share-(2)" transform="translate(0.000000, 4.000000)">
                        <path d="M13.7722467,11.9432638 C12.735022,11.9432638 11.8101322,12.4366193 11.2185022,13.1990778 L6.26453744,10.4370346 C6.38061674,10.1043934 6.44427313,9.74558941 6.44427313,9.3755728 C6.44427313,9.00181865 6.38061674,8.64675221 6.26079295,8.31037347 L11.2110132,5.55206782 C11.7988987,6.31826383 12.727533,6.81535686 13.7685022,6.81535686 C15.5433921,6.81535686 16.992511,5.37266583 16.992511,3.5973336 C16.992511,1.82200137 15.5471366,0.379310345 13.7685022,0.379310345 C11.9898678,0.379310345 10.5444934,1.82200137 10.5444934,3.5973336 C10.5444934,3.97108775 10.6081498,4.32989174 10.7279736,4.66253294 L5.7814978,7.42083858 C5.19361233,6.65090503 4.26497797,6.15754955 3.22400881,6.15754955 C1.44911894,6.15754955 0,7.60024058 0,9.3755728 C0,11.150905 1.44911894,12.5935961 3.2277533,12.5935961 C4.26872247,12.5935961 5.19735683,12.096503 5.78898678,11.3265695 L10.739207,14.0886127 C10.6193833,14.4249914 10.5519824,14.7875329 10.5519824,15.1612871 C10.5519824,16.9328818 11.9973568,18.3793103 13.7759912,18.3793103 C15.5546256,18.3793103 17,16.9366193 17,15.1612871 C17,13.3859549 15.5508811,11.9432638 13.7722467,11.9432638 Z M13.7722467,1.3921841 C14.9929515,1.3921841 15.9852423,2.3826326 15.9852423,3.60107114 C15.9852423,4.81950968 14.9929515,5.80995819 13.7722467,5.80995819 C12.5515419,5.80995819 11.5592511,4.81950968 11.5592511,3.60107114 C11.5592511,2.3826326 12.5552863,1.3921841 13.7722467,1.3921841 Z M13.7722467,12.9486625 C14.9929515,12.9486625 15.9852423,13.939111 15.9852423,15.1575495 C15.9852423,16.3759881 14.9929515,17.3664366 13.7722467,17.3664366 C12.5515419,17.3664366 11.5592511,16.3759881 11.5592511,15.1575495 C11.5592511,13.939111 12.5515419,12.9486625 13.7722467,12.9486625 Z M3.22413793,7.34705228 C4.35588424,7.34705228 5.27586207,8.25830167 5.27586207,9.37931034 C5.27586207,10.500319 4.35241263,11.4115684 3.22413793,11.4115684 C2.09239162,11.4115684 1.17241379,10.500319 1.17241379,9.37931034 C1.17241379,8.25830167 2.09239162,7.34705228 3.22413793,7.34705228 Z" id="Shape"/>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>Share</div>
              <div class="likes-counter">
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 294.89 284"><defs></defs><path class="cls-1" d="M217.25,10c44.2.25,80,42.33,80.21,94.37C297.46,199.64,150,294,150,294S2.57,198.25,2.57,104.37C2.57,52.33,38.48,10,82.78,10h0c27.13-.27,52.46,15.79,67.23,42.54C164.9,25.93,190.29,9.9,217.25,10Z" transform="translate(-2.57 -10)"/></svg>
                <div class="number">{{img.likes}}</div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 gallery-comp">
              <transition-group name="fade" tag="div" class="gallery-items-container">
                <div v-for="(product,index) in products" :key="index" class="col-xs-6 col-md-3 gallery-item " style="  ">
                  <div class="item-box">
                    <ShareNetwork
                    @open="this.$root.clicked = true"
                    @close="this.$root.clicked = false"
                    network="pinterest"
                    :url="$root.currentUrl+ 'product-' + product.id"
                    :title="img.name + ' (ID '+img.id+')'+' '+img.description+ ' ' +$root.getPinterestContent(img)"
                    :media="$root.storageUrl + '/creator_images/'+img.id+'/previews/'+product.product_code+'/1000_1.jpg'"
                    >
                    <svg height="30px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><defs id="defs19"/><g id="g3031"><path d="m 511.672,255.92999 c 0,141.3849 -114.61511,256 -256,256 -141.3849,0 -256.00000293,-114.6151 -256.00000293,-256 C -0.32800293,114.5451 114.2871,-0.07000732 255.672,-0.07000732 c 141.38489,0 256,114.61510732 256,255.99999732 z" id="circle8" style="fill:#cb2027;fill-opacity:1"/><g id="g3000" transform="translate(-603.11865,-9.8474559)"><g id="g3142" transform="translate(221.28814,-27.9639)"><g id="Layer_14"><g id="g3121"><path d="m 645.85601,122.6817 c -93.402,0 -140.5,66.963 -140.5,122.815 0,33.812 12.796,63.89 40.25,75.089 4.505,1.858 8.54,0.065 9.849,-4.916 0.906,-3.438 3.055,-12.139 4.015,-15.777 1.31,-4.928 0.799,-6.646 -2.833,-10.957 -7.916,-9.332 -12.985,-21.416 -12.985,-38.551 0,-49.677 37.175,-94.154 96.794,-94.154 52.797,0 81.801,32.26 81.801,75.329 0,56.692 -25.089,104.534 -62.325,104.534 -20.563,0 -35.953,-16.999 -31.031,-37.865 5.908,-24.908 17.355,-51.777 17.355,-69.771 0,-16.087 -8.646,-29.507 -26.513,-29.507 -21.021,0 -37.913,21.752 -37.913,50.884 0,18.558 6.271,31.112 6.271,31.112 0,0 -21.518,91.16 -25.291,107.125 -7.506,31.798 -1.128,70.766 -0.584,74.692 0.315,2.343 3.317,2.907 4.68,1.142 1.927,-2.53 26.983,-33.441 35.482,-64.34 2.417,-8.739 13.831,-54.032 13.831,-54.032 6.835,13.038 26.794,24.491 48.024,24.491 63.19,0 106.072,-57.604 106.072,-134.719 0.006,-58.317 -49.387,-112.624 -124.449,-112.624 z" id="path3131" style="fill:#ffffff"/></g></g><g id="Layer_1_1_-8"/></g></g></g><g id="Layer_1_1_"/></svg>
                  </ShareNetwork>
                  <a href="" @click.prevent="$router.push('/product-' + product.id)" >
                    <div class="gallery-item-frame">
                      <div class="discount-tag">{{img.creator.discount}}% OFF</div>
                      <v-lazy-image class="prev-gallery-img" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/'+product.product_code+'/1000_1.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
                    </div>
                    <div class="gallery-item-desc">
                      <div class="gallery-item-title">{{productsBycategory[product.details.category_id][Object.keys(productsBycategory[product.details.category_id])[0]].details.category.name}}</div>
                      <div class="  gallery-item-price">
                        <div>
                          <span class="discount-price" style="font-size: 20">
                            <span style="" class="old-price">{{startAt[product.details.category_id]}}</span>
                            ${{(startAt[product.details.category_id]*(1 - parseFloat(img.creator.discount) / 100)).toFixed(2)}}
                          </span>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </transition-group>
          </div>
        </div>
      </div>
      <div class="images-slider">
        <div class="title row">
          <div class="line"></div>
          <div class="text">More by <a href="" @click.prevent="$router.push('/@'+img.creator.username)">{{img.creator.user.first_name+' '+img.creator.user.last_name}}</a></div>
          <div class="line"></div>
          <div class="col-md-12"><span></span></div>
        </div>
        <hooper style="height:200px" :wheelControl="false" :centerMode="true" :itemsToShow="5.5" :infiniteScroll="true" >
          <slide  v-for="(image,index) in img.creator.images" :key="index" class="item" style="  ">
            <a href="" @click.prevent="$router.push('/catalog-'+image.id)">
              <div class="frame">
                <v-lazy-image :src="$root.storageUrl+'/creator_images/'+image.id+'/500.jpg'" :src-placeholder="$root.storageUrl+'/creator_images/'+image.id+'/80.jpg'" />
              </div>
            </a>
          </slide>
          <hooper-navigation slot="hooper-addons" ></hooper-navigation>
        </hooper>
        <tags v-if="tags.length>0" :tags="tags"></tags>
      </div>
      <div class="row page-footer">
        <div class="why-you container no-padding">
          <div class="title row">
            <div class="line"></div>
            <div class="text">why you will love shopping with us</div>
            <div class="line"></div>
            <div class="col-md-12"><span></span></div>
          </div>
          <div class="shp-box">
            <span>FAST SHIPPING</span>
          </div>
          <div class="shp-box">
            <span>100% SATISFIED</span>
          </div>
          <div class="shp-box">
            <span>SECURE PAYMENT</span>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
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
  props:['creator','user'],
  components: {
    Hooper,
    Slide,
    HooperNavigation
  },
  data() {
    return {
      img:null,
      categories: [],
      products: [],
      startAt: [],
      tags: [],
      productsBycategory: {},
      prices: {},
    };
  },
  watch:{
    $route() {
      this.selectedProperties={};
      this.getProductPreviews();
    },
  },
  created() {
    this.selectedProperties={};
    this.getProductPreviews();
  },
  mounted() {
  },
  methods:{
    getProductPreviews() {
      var that = this;
      Api.get('/api/image/' + this.$route.params.imgId)
      .then(response => {
        that.img=response.data;
        that.img.products.forEach((product, i) => {
          if(that.categories.includes(product.details.category_id)){
            that.$set(that.productsBycategory[product.details.category_id], product.id, product);
          }else{
            that.$set(that.productsBycategory, product.details.category_id, {});
            that.$set(that.productsBycategory[product.details.category_id], product.id, product);
            // that.$set(that.products, index, {});
            that.products.push(product);
            that.categories.push(product.details.category_id);
          }
        });
        that.prices=JSON.parse(that.img.creator.products_price);
        for (var i in that.productsBycategory) {
          var minPrice=1000;
          for (var j in that.productsBycategory[i]) {
            if(that.prices[that.productsBycategory[i][j].details.product_code]<minPrice){
              minPrice=that.prices[that.productsBycategory[i][j].details.product_code];
            }
          }
          that.$set(that.startAt,i,minPrice);
        }
        var tags=[];
        that.img.creator.images.forEach((img, i) => {
          tags=tags.concat(img.tags.split('#').filter(e => e !== ''));
        });
        that.tags.push(...tags);
        that.tags = [...new Set(that.tags)];
        that.tags=that.tags.filter((v, i, a) => a.indexOf(v) === i);
      });
    },
  }
};
</script>
