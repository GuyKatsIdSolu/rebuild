<template>
  <div class="" v-if="img">
    <share-modal ref="shareModal" :url="$root.currentUrl+'product-'+$route.params.productId" title="View on Artigram" description="View my gallery page on Artigram and buy the content you like on merchandise" quote="" hashtags="" twitter-user="Artigramme"></share-modal>
    <div class="product-page shop">
      <div class="categories-filter">
        <a href="" @click.prevent="$router.push('/@'+img.creator.username)" >
          Gallery
        </a>
        <a v-for="(categoryId,index) in categories" :key="categoryId" href="" @click.prevent="$router.push('/product-'+productsBycategory[categoryId][Object.keys(productsBycategory[categoryId])[0]].id)">
          {{productsBycategory[categoryId][Object.keys(productsBycategory[categoryId])[0]].details.category.name}}
        </a>
      </div>
      <div class="container main-page row">
        <transition-group v-if="!$root.isMobile" name="fade" tag="div" class="thumbnails">
          <a v-for="(n, i) in product.details.dynamic_previews_number" @click.prevent="curMainPrev=$root.storageUrl+'/creator_images/'+img.id+'/previews/'+product.product_code+'/1000_'+(i+1)+color+'.jpg'" :key="i">
            <v-lazy-image :class="curMainPrev==$root.storageUrl+'/creator_images/'+img.id+'/previews/'+product.product_code+'/1000_'+(i+1)+color+'.jpg'? 'active' : ''" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/'+product.product_code+'/500_'+(i+1)+color+'.jpg'" :src-placeholder="$root.storageUrl+'/creator_images/'+img.id+'/previews/'+product.product_code+'/80_'+(i+1)+color+'.jpg'" />
          </a>
          <a v-for="(n, i) in (4-product.details.dynamic_previews_number)" @click.prevent="curMainPrev=$root.storageUrl+'/gallery_static_images/'+product.product_code+'_'+(i+1)+'.jpg'" :key="i+product.details.dynamic_previews_number">
            <v-lazy-image :class="curMainPrev==$root.storageUrl+'/gallery_static_images/'+product.product_code+'_'+(i+1)+'.jpg'? 'active' : ''" :src="$root.storageUrl+'/gallery_static_images/'+product.product_code+'_'+(i+1)+'.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
          </a>
        </transition-group>
        <div class="big-img" v-if="!$root.isMobile">
          <enlargeable-image trigger="click" animation_duration="100" class="enlarge-my" :src="$root.currentUrl + $root.storageUrl+'/creator_images/'+img.id+'/previews/'+product.product_code+'/80_1.jpg'" :src_large="$root.currentUrl + $root.storageUrl+'/creator_images/'+img.id+'/previews/'+product.product_code+'/1000_1.jpg'">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 146 146"><defs></defs><path class="cls-1" d="M147.55,74.36a73,73,0,1,1-73-73A73,73,0,0,1,147.55,74.36Z" transform="translate(-1.55 -1.36)"/><path d="M121.28,35c0-.14,0-.28,0-.42l0-.2a1.7,1.7,0,0,0,0-.22,1.42,1.42,0,0,0,0-.22c0-.07,0-.14,0-.2l-.07-.21-.08-.2a1.63,1.63,0,0,0-.09-.19l-.09-.2a1.74,1.74,0,0,0-.11-.18,1.74,1.74,0,0,0-.11-.18,2.43,2.43,0,0,1-.14-.2l-.12-.15a4.4,4.4,0,0,0-.61-.61l-.16-.12a1.33,1.33,0,0,0-.19-.14l-.19-.12-.17-.1-.21-.1-.18-.09-.2-.07-.21-.07-.2-.05-.22-.05-.24,0-.18,0-.44,0H91a4.4,4.4,0,1,0,0,8.79h15.28L79.71,66a4.39,4.39,0,1,0,6.22,6.21l26.56-26.56V60.91a4.4,4.4,0,1,0,8.79,0V35Z" transform="translate(-1.55 -1.36)"/><path d="M65.16,80.53,38.6,107.09V91.82a4.4,4.4,0,1,0-8.79,0V117.7h0c0,.15,0,.28,0,.42l0,.2a1.85,1.85,0,0,0,0,.23,1.74,1.74,0,0,0,.05.22c0,.07,0,.13.05.2a1.8,1.8,0,0,0,.08.21,1.46,1.46,0,0,0,.07.19,1.76,1.76,0,0,0,.09.2l.09.19a1.08,1.08,0,0,0,.11.18l.11.19a2.43,2.43,0,0,1,.14.2l.12.15a4.4,4.4,0,0,0,.61.61l.16.12.19.14.19.11.18.11.2.09.18.09.2.07.21.08.2,0,.22.05.23,0,.19,0a3.25,3.25,0,0,0,.44,0H60.09a4.4,4.4,0,1,0,0-8.79H44.82L71.38,86.75a4.4,4.4,0,0,0-6.22-6.22Z" transform="translate(-1.55 -1.36)"/>
            </svg>
          </enlargeable-image>
          <div class="likes">
            <div class="number">{{img.likes}}</div>
            <svg v-if="!imgLikeClicked.includes(img.id)" @click="like(img)" class="heart" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150"><defs></defs><g class="cls-1"><circle class="cls-2" cx="75" cy="75" r="74.88"/><path class="cls-3" d="M150,68.25A74.75,74.75,0,1,1,75.25,143,74.83,74.83,0,0,1,150,68.25m0-.25a75,75,0,1,0,75,75,75,75,0,0,0-75-75Z" transform="translate(-75 -68)"/></g><path class="cls-4" d="M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z" transform="translate(-75 -68)"/><path class="cls-5" d="M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z" transform="translate(-75 -68)"/>
            </svg>
            <svg v-else @click="like(img)" class="heart2" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150"><defs></defs><g class="cls-1"><circle class="cls-2" cx="75" cy="75" r="74.88"/><path class="cls-3" d="M150,68.25A74.75,74.75,0,1,1,75.25,143,74.83,74.83,0,0,1,150,68.25m0-.25a75,75,0,1,0,75,75,75,75,0,0,0-75-75Z" transform="translate(-75 -68)"/></g><path class="cls-4" d="M169.77,109.72c12.74.07,23.06,12.2,23.12,27.2,0,27.46-42.5,54.66-42.5,54.66s-42.5-27.6-42.5-54.66c0-15,10.35-27.2,23.12-27.2h0c7.82-.08,15.12,4.55,19.38,12.26C154.68,114.31,162,109.69,169.77,109.72Z" transform="translate(-75 -68)"/></svg>
          </div>
          <ShareNetwork
          @open="$root.clicked = true"
          @close="$root.clicked = false"
          network="pinterest"
          :url="$root.currentUrl+ '/product-' + product.id"
          :title="img.name + ' (ID '+img.id+')'+' '+img.description+ ' ' +$root.getPinterestContent(img)"
          :media="$root.currentUrl + $root.storageUrl+'/creator_images/'+img.id+'/previews/'+product.product_code+'/1000_1.jpg'">
          <svg height="30px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><defs id="defs19"/><g id="g3031"><path d="m 511.672,255.92999 c 0,141.3849 -114.61511,256 -256,256 -141.3849,0 -256.00000293,-114.6151 -256.00000293,-256 C -0.32800293,114.5451 114.2871,-0.07000732 255.672,-0.07000732 c 141.38489,0 256,114.61510732 256,255.99999732 z" id="circle8" style="fill:#cb2027;fill-opacity:1"/><g id="g3000" transform="translate(-603.11865,-9.8474559)"><g id="g3142" transform="translate(221.28814,-27.9639)"><g id="Layer_14"><g id="g3121"><path d="m 645.85601,122.6817 c -93.402,0 -140.5,66.963 -140.5,122.815 0,33.812 12.796,63.89 40.25,75.089 4.505,1.858 8.54,0.065 9.849,-4.916 0.906,-3.438 3.055,-12.139 4.015,-15.777 1.31,-4.928 0.799,-6.646 -2.833,-10.957 -7.916,-9.332 -12.985,-21.416 -12.985,-38.551 0,-49.677 37.175,-94.154 96.794,-94.154 52.797,0 81.801,32.26 81.801,75.329 0,56.692 -25.089,104.534 -62.325,104.534 -20.563,0 -35.953,-16.999 -31.031,-37.865 5.908,-24.908 17.355,-51.777 17.355,-69.771 0,-16.087 -8.646,-29.507 -26.513,-29.507 -21.021,0 -37.913,21.752 -37.913,50.884 0,18.558 6.271,31.112 6.271,31.112 0,0 -21.518,91.16 -25.291,107.125 -7.506,31.798 -1.128,70.766 -0.584,74.692 0.315,2.343 3.317,2.907 4.68,1.142 1.927,-2.53 26.983,-33.441 35.482,-64.34 2.417,-8.739 13.831,-54.032 13.831,-54.032 6.835,13.038 26.794,24.491 48.024,24.491 63.19,0 106.072,-57.604 106.072,-134.719 0.006,-58.317 -49.387,-112.624 -124.449,-112.624 z" id="path3131" style="fill:#ffffff"/></g></g><g id="Layer_1_1_-8"/></g></g></g><g id="Layer_1_1_"/></svg>
        </ShareNetwork>
        <div class="discount-tag">{{img.creator.discount}}% OFF</div>

        <transition name="fade" mode="out-in" :duration="{ enter: 300, leave: 100 }">
          <v-lazy-image :key="curMainPrev" :src="curMainPrev" :src-placeholder="curMainPrev.replace('/1000_','/80_')" />
        </transition>
      </div>
      <div class="details" v-if="!$root.isMobile">
        <a href="" @click.prevent="$router.push('/@'+img.creator.username)" >
          <div class="creator-name">{{img.creator.user.first_name+' '+img.creator.user.last_name}}</div>
        </a>
        <div class="images-number">{{img.creator.images.length}} Images</div>
        <transition name="fade" mode="out-in">
          <div class="title">{{img.name +' '+ product.details.category.name}}</div>
        </transition>
        <div class="price">
          <transition name="fade" mode="out-in">
            <span class="before">${{prices[product.product_code]}}</span>
          </transition>
          <transition name="fade" mode="out-in">
            <span class="after">${{(prices[product.product_code]*(100 - img.creator.discount)/100).toFixed(2)}}</span>
          </transition>
        </div>
        <div class="delivery">
          <img :src="$root.storageUrl+'/images/car-ic.png'" alt="">
          <span>Estimated delivery {{ $moment().add(7, 'days').format('MMM Do') }}</span>
        </div>

        <div class="product" v-if=" Object.keys(productsBycategory[product.details.category_id]).length>1">
          <div class="label">TYPE</div>
          <div class="dropdown show" >
            <a class="button dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{product.details.title}}
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="" @click.prevent="product=otherModel;scrollToTop()"  v-for="(otherModel, pid) in productsBycategory[product.details.category_id]">{{otherModel.details.title}}</a>
            </div>
          </div>
        </div>
        <div class="properties" v-if="JSON.parse(product.details.production_details.other) && JSON.parse(product.details.production_details.other).hasOwnProperty('requireProperties')">
          <div class="property" :class="property.name" v-for="(property ,index) in JSON.parse(product.details.production_details.other).requireProperties" :key="index">
            <label>{{property.name}} &nbsp</label>
            <select v-if="property.name!='color'" v-model="selectedProperties[property.name]" >
              <option disabled selected value="none">-</option>
              <option v-for="(option ,optionName) in property.options"  :value="optionName">{{optionName}}</option>
            </select>
            <div v-else>
              <span :class="selectedProperties[property.name]==optionName? 'active':''" @click="chooseColor(optionName)" :style="'background:'+optionName" v-for="(option ,optionName) in property.options"></span>
            </div>
          </div>
        </div>
        <a @click.prevent="addToCart(true)" class="checkout btn purple">Express Checkout</a>
        <a @click.prevent="addToCart()" class="add-to-cart btn purple negative">Add To Cart</a>
        <div class="share" @click.prevent="$modal.show('ShareModal')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="19px" viewBox="0 0 17 19" version="1.1">
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
        </svg>
        <span v-if="!$root.isMobile">
          Share
        </span>
      </div>
      <div class="likes-counter">
        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 294.89 284"><defs></defs><path class="cls-1" d="M217.25,10c44.2.25,80,42.33,80.21,94.37C297.46,199.64,150,294,150,294S2.57,198.25,2.57,104.37C2.57,52.33,38.48,10,82.78,10h0c27.13-.27,52.46,15.79,67.23,42.54C164.9,25.93,190.29,9.9,217.25,10Z" transform="translate(-2.57 -10)"/></svg>
        <div class="number">{{img.likes}}</div>
      </div>
    </div>
    <div class="details" v-else>
      <transition name="fade" mode="out-in">
        <div class="title" v-if="changeProductStatus">{{product.details.title}}</div>
      </transition>
      <div class="price">
        <transition name="fade" mode="out-in">
          <span v-if="changeProductStatus" class="before">${{prices[product.product_code]}}</span>
        </transition>
        <transition name="fade" mode="out-in">
          <span v-if="changeProductStatus" class="after">${{(prices[product.product_code]*(100 - img.creator.discount)/100).toFixed(2)}}</span>
        </transition>

      </div>
      <div class="delivery">
        <img src="/assets/minishop/img/car-ic.png" alt="">
        <span>Estimated delivery {{estDel}}</span>
      </div>
      <div class="product" v-if=" Object.keys(productsBycategory[product.details.category_id]).length>1">
        <div class="label">PRODUCT</div>
        <div class="dropdown show" >
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{product.details.title}}
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="" @click.prevent="product=otherModel;scrollToTop()"  v-for="(otherModel, pid) in productsBycategory[product.details.category_id]">{{otherModel.details.title}}</a>
          </div>
        </div>
        <div class="properties" v-if="JSON.parse(product.details.production_details.other) && JSON.parse(product.details.production_details.other).hasOwnProperty('requireProperties')">
          <div class="property" :class="property.name"  v-for="(property ,index) in JSON.parse(product.details.production_details.other).requireProperties" :key="index">
            <label>{{property.name}} &nbsp</label>
            <select v-model="selectedProperties[property.name]" >
              <option disabled selected value="none">-</option>
              <option v-for="(option ,optionName) in property.options"  :value="option">{{optionName}}</option>
            </select>
          </div>
        </div>
        <div class="quantity ">
          <label>QTY &nbsp</label>
          <select name="quantity" v-model="quantity" class="" style="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
        <a @click.prevent="addToCart(true)" class="checkout btn purple">Express Checkout</a>
        <a @click.prevent="addToCart()" class="add-to-cart btn purple negative">Add To Cart</a>
      </div>
    </div>
    <div class="desc-box col-md-8">
      <div class="title">
        <span @click.prevent="extraDetails='desc'" :class="extraDetails=='desc'? 'active':''">description</span>
        <span @click.prevent="extraDetails='ship'" :class="extraDetails=='ship'? 'active':''">shipping</span>
        <span @click.prevent="extraDetails='size'" :class="extraDetails=='size'? 'active':''">sizes</span>
      </div>
      <transition name="fade" :duration="{ enter: 500, leave: 150 }">
        <div v-if="extraDetails=='desc'" class="content" v-html="product.details.html_description"></div>
      </transition>
      <transition name="fade" :duration="{ enter: 500, leave: 150 }">
        <div v-if="extraDetails=='ship'" class="content" v-html="product.details.html_shipping"></div>
      </transition>
      <transition name="fade" :duration="{ enter: 500, leave: 150 }">
        <div v-if="extraDetails=='size'" class="content" v-html="product.details.html_sizes"></div>
      </transition>
    </div>
  </div>
  <div class="page-footer">
    <div class="you-may container ">
      <div class="title row col-md-12">
        <div class="line"></div>
        <div class="text">you may also like</div>
        <div class="line"></div>
        <div class="col-md-12"><span></span></div>
      </div>
      <div class="row full-width">
        <h3><span>{{img.name}}</span> also available on</h3>
        <hooper :wheelControl="false" :itemsToShow="$root.isMobile? 1.5 : 4" :infiniteScroll="$root.isMobile? false : true" >
          <slide v-if="upsaleProduct.details.category_id!=product.details.category_id" v-for="(upsaleProduct,index) in products" :key="index" class="gallery-item " style="  ">
            <div>
              <a href="" @click.prevent="product=upsaleProduct;refreshImgsListForSlider();scrollToTop()" >
                <div class="gallery-item-frame">
                  <v-lazy-image class="prev-gallery-img" :src="$root.storageUrl+'/creator_images/'+img.id+'/previews/'+upsaleProduct.product_code+'/500_1.jpg'" :src-placeholder="$root.storageUrl+'/creator_images/'+img.id+'/previews/'+upsaleProduct.product_code+'/80_1.jpg'"/>
                </div>
                <div class="gallery-item-desc">
                  <div class="gallery-item-title" >{{upsaleProduct.details.category.name}}</div>
                  <div class="  gallery-item-price">
                    <div>
                      <span class="discount-price" style="font-size: 20">
                        <span style=""class="old-price">${{prices[upsaleProduct.product_code]}}</span>
                        ${{(prices[upsaleProduct.product_code]*(100 - img.creator.discount)/100).toFixed(2)}}
                      </span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </slide>
          <hooper-navigation slot="hooper-addons" >
          </hooper-navigation>
        </hooper>
      </div>
      <div class="row full-width more">
        <h3>More <span><span>{{product.details.category.name}}</span> by {{img.creator.user.first_name+' '+img.creator.user.last_name}}</span></h3>
        <hooper :wheelControl="false" :itemsToShow="$root.isMobile? 1.5 : 4" :infiniteScroll="$root.isMobile? false : true" >
          <slide v-for="(product,imgIdName,index) in imgsListForSlider" :key="index" class="gallery-item ">
            <div>
              <a href="" @click.prevent="$router.push('/product-' + product.id);scrollToTop()" >
                <div class="gallery-item-frame">
                  <v-lazy-image class="prev-gallery-img" :src="$root.storageUrl+'/creator_images/' + imgIdName.split('-')[0] + '/previews/'+product.details.product_code+'/500_1.jpg'" :src-placeholder="$root.storageUrl+'/creator_images/' + imgIdName.split('-')[0] + '/previews/'+product.details.product_code+'/80_1.jpg'" />
                </div>
                <div class="gallery-item-desc">
                  <div class="gallery-item-title" >{{imgIdName.split('-')[1]}}</div>
                  <div class="  gallery-item-price">
                    <div>
                      <span class="discount-price" style="font-size: 20">
                        <span style=""class="old-price">${{prices[product.details.product_code]}}</span>
                        ${{(prices[product.details.product_code]*(100 - img.creator.discount)/100).toFixed(2)}}
                      </span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </slide>
          <hooper-navigation slot="hooper-addons" ></hooper-navigation>
        </hooper>
      </div>
    </div>
    <div class="images-slider container no-padding">
      <div class="title row">
        <div class="line"></div>
        <div class="text">More by <a href="" @click.prevent="$router.push('/@'+img.creator.username)">{{img.creator.user.first_name+' '+img.creator.user.last_name}}</a></div>
        <div class="line"></div>
        <div class="col-md-12"><span></span></div>
      </div>
      <hooper style="height:200zpx" :wheelControl="false" :centerMode="true" :itemsToShow="5.5" :infiniteScroll="true" >
        <slide  v-for="(image,index) in img.creator.images" :key="index" class="item" style="  ">
          <a href="" @click.prevent="$router.push('/catalog-'+image.id)">
            <div class="frame">
              <v-lazy-image :src="$root.storageUrl+'/creator_images/'+image.id+'/500.jpg'" :src-placeholder="$root.storageUrl+'/creator_images/'+image.id+'/80.jpg'" />
            </div>
          </a>
        </slide>
        <hooper-navigation slot="hooper-addons" ></hooper-navigation>
      </hooper>
      <tags :tags="tags"></tags>
    </div>
    <div class="why-you container">
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
</template>

<script>
import Api from "../apis/Api";
import {
  Hooper,
  Slide,
  Navigation as HooperNavigation,
  Pagination as HooperPagination
} from 'hooper';
import 'hooper/dist/hooper.css';
export default {
  props:['creator','user'],
  components: {
    Hooper,
    Slide,
    HooperNavigation,
    HooperPagination,
  },
  data() {
    return {
      img:null,
      product:null,
      quantity:1,
      extraDetails: 'desc',
      color: '',
      imgsListForSlider:{},
      selectedProperties:{},
      curMainPrev: '',
      imgLikeClicked:[],
      categories: [],
      products: [],
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
    product: function(newVal, oldVal) {
      this.extraDetails='desc';
      this.quantity=1;
      this.curMainPrev=this.$root.storageUrl+'/creator_images/'+this.product.image_id+'/previews/'+this.product.product_code+'/1000_1.jpg';
      this.selectedProperties={};
      if(JSON.parse(this.product.details.production_details.other) && JSON.parse(this.product.details.production_details.other).hasOwnProperty('requireProperties')){
        var properties=JSON.parse(this.product.details.production_details.other).requireProperties;
        for (var name in properties) {
          this.$set(this.selectedProperties,properties[name].name,'none');
          if(properties[name].name=='color'){
            this.$set(this.selectedProperties,properties[name].name,'white');
          }
        }
      }
    },
  },
  created() {
    this.selectedProperties={};
    this.getProductPreviews();
  },
  mounted() {
  },
  methods:{
    scrollToTop() {
      window.scrollTo(0,0);
    },
    chooseColor(optionName){
      this.selectedProperties['color']=optionName;
      this.color=optionName;
      this.curMainPrev=this.$root.storageUrl+'/creator_images/'+this.product.image_id+'/previews/'+this.product.product_code+'/1000_1'+optionName+'.jpg';

    },
    like(img){
      this.$root.clicked = true
      this.imgLikeClicked.push(img.id);
      img.likes++;
      Api.get('/api/image-like/'+img.id)
      .then(response => {
        this.$root.clicked = false;
      });
    },
    addToCart(goCheckoutPage=false) {
      if(JSON.parse(this.product.details.production_details.other) && JSON.parse(this.product.details.production_details.other).hasOwnProperty('requireProperties')){
        var properties=JSON.parse(this.product.details.production_details.other).requireProperties;
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
        'productId': this.product.id,
        'properties': this.selectedProperties,
        'quantity': this.quantity,
        'previewUrl': this.$root.storageUrl+'/creator_images/'+this.img.id+'/previews/'+this.product.product_code+'/1000_1.jpg',
        'price': (this.prices[this.product.product_code]*(100-this.img.creator.discount)/100).toFixed(2),
      })
      .then(response => {
        this.$root.$refs.app.$refs.nav.$refs.cart.cartContent = response.data;
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
    refreshImgsListForSlider() {
      var that = this;
      var tags=[];
      that.img.creator.images.forEach((img, i) => {
        tags=tags.concat(img.tags.split('#').filter(e => e !== ''));
        img.products.forEach((product, j) => {
          if(product.details.product_code==that.product.details.product_code){
            that.$set(that.imgsListForSlider,img.id+'-'+img.name,product);
          }
        });
      });
      that.tags.push(...tags);
      that.tags = [...new Set(that.tags)];
      that.tags=that.tags.filter((v, i, a) => a.indexOf(v) === i);
    },
    getProductPreviews() {
      var that = this;
      Api.get('/api/image-by-product-id/' + this.$route.params.productId)
      .then(response => {
        that.img=response.data;
        that.prices=JSON.parse(that.img.creator.products_price);
        that.img.products.forEach((product, i) => {
          if(that.$route.params.productId==product.id){
            that.product = product;
            that.curMainPrev = this.$root.storageUrl+'/creator_images/'+that.product.image_id+'/previews/'+that.product.product_code+'/1000_1.jpg';
          }
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
        that.refreshImgsListForSlider();
      });
    }
  }
};
</script>
