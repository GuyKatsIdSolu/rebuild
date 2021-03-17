<template>
  <div style="" class="shop-page" v-if="storeOwner">
    <share-modal ref="shareModal" :url="'/@'+storeOwner.username" title="View on Artigram" description="View my gallery page on Artigram and buy the content you like on merchandise" quote="" hashtags="" twitter-user="Artigramme"></share-modal>
    <shop-modal :creator="storeOwner" ref="shopModal"></shop-modal>
    <cart ref="cart" ></cart>
    <div>
      <div v-if="$root.isLoggedIn" class="view-ad-visitor">
        <div class="container no-padding">
          <span class="circle">!</span>Viewing as a visitor<a href="" @click="$router.push('/admin')"><span class="done">Done</span></a>
        </div>
      </div>
      <div class="banner" style="" >
        <img v-if="!list.length" :src="$root.storageUrl+'/creator_images/'+ lastImage.id + '/banner.jpg'" alt="">
        <img v-else :src="$root.storageUrl+'/images/banner-artigram-logo.png'" alt="">
      </div>
      <div class="container no-padding">
        <div class="row user-header-info">
          <div class="col-md-12">
            <div class="">
              <div class="user-big-thumb" style="">
                <v-lazy-image v-if="storeOwner" :src="$root.storageUrl+'/creator_images/' + storeOwner.id + '.jpg'" :src-placeholder="$root.storageUrl+'/images/profile_img_placeholder.jpg'" alt="Avatar of user"/>
              </div>
              <div class="user-big-thumb-right">
                <b>{{storeOwner.store_name==''? storeOwner.user.first_name+' Shop' : storeOwner.store_name}}</b>
                <div class="social">
                  <ul style="display: flex;margin-top: -5px;">
                    <li v-if="storeOwner.behance_username!=''">
                      <a target="_blank" :href="'https://www.behance.net/'+storeOwner.behance_username">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: sketchtool 59.1 (101010) - https://sketch.com -->
                          <title>Behance</title>
                          <desc>Created with sketchtool.</desc>
                          <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="public-gallery" transform="translate(-204.000000, -407.000000)" fill-rule="nonzero">
                              <g id="Group-5" transform="translate(80.000000, 339.000000)">
                                <g id="Stacked-Group-3" transform="translate(124.000000, 68.000000)">
                                  <g id="behance">
                                    <circle id="Oval" fill="#3B3B3B" cx="11.9146195" cy="11.9146195" r="11.9146195"></circle>
                                    <path d="M16.1859823,9.84233628 C12.7446372,9.84233628 12.740177,13.2707257 12.740177,13.288354 C12.740177,13.288354 12.5044248,16.7209912 16.1859823,16.7209912 C16.1859823,16.7209912 19.2562832,16.8955752 19.2562832,14.3320354 L17.6797168,14.3320354 C17.6797168,14.3320354 17.7319646,15.2971327 16.2384425,15.2971327 C16.2384425,15.2971327 14.6618761,15.4020531 14.6618761,13.7379823 L19.3087434,13.7379823 C19.3087434,13.7379823 19.8197522,9.84233628 16.1859823,9.84233628 Z M14.6442478,12.5369204 C14.6442478,12.5369204 14.8364602,11.1568142 16.2210265,11.1568142 C17.6098407,11.1568142 17.587985,12.5369204 17.587985,12.5369204 L14.6442478,12.5369204 Z M10.7052743,11.6548673 C10.7052743,11.6548673 12.0722124,11.5544071 12.0722124,9.94725664 C12.0722124,8.34456637 10.9541947,7.55830088 9.53479646,7.55830088 L4.86584071,7.55830088 L4.86584071,16.5330265 L9.53437168,16.5330265 C9.53437168,16.5330265 12.3863363,16.620531 12.3863363,13.8821947 C12.3865487,13.8821947 12.508885,11.6548673 10.7052743,11.6548673 Z M6.92304425,9.15228319 L9.53458407,9.15228319 C9.53458407,9.15228319 10.1679292,9.15228319 10.1679292,10.0867965 C10.1679292,11.0213097 9.79667257,11.1568142 9.37295575,11.1568142 L6.92304425,11.1568142 L6.92304425,9.15228319 Z M9.40375221,14.9390442 L6.92304425,14.9390442 L6.92304425,12.5369187 L9.53458407,12.5369187 C9.53458407,12.5369187 10.4824779,12.5282124 10.4780334,13.7728142 C10.4780334,14.8211681 9.77500885,14.9303363 9.40375221,14.9390442 Z M14.2555752,8.08672566 L14.2555752,9.19178761 L17.9592212,9.19178761 L17.9592212,8.08672566 L14.2555752,8.08672566 Z" id="Shape" fill="#F1F2F2"></path>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                    <li v-if="storeOwner.facebook_username!=''">
                      <a target="_blank" :href="'https://www.facebook.com/'+storeOwner.facebook_username">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: sketchtool 59.1 (101010) - https://sketch.com -->
                          <title>Facebook</title>
                          <desc>Created with sketchtool.</desc>
                          <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="public-gallery" transform="translate(-236.000000, -407.000000)" fill-rule="nonzero">
                              <g id="Group-5" transform="translate(80.000000, 339.000000)">
                                <g id="Stacked-Group-3" transform="translate(124.000000, 68.000000)">
                                  <g id="facebook" transform="translate(32.000000, 0.000000)">
                                    <circle id="Oval" fill="#3B3B3B" cx="11.9146195" cy="11.9146195" r="11.9146195"></circle>
                                    <path d="M14.9099469,12.3810265 L12.7839292,12.3810265 L12.7839292,20.1697699 L9.56283186,20.1697699 L9.56283186,12.3810265 L8.03086726,12.3810265 L8.03086726,9.64375221 L9.56283186,9.64375221 L9.56283186,7.87242478 C9.56283186,6.60573451 10.164531,4.62223009 12.8126018,4.62223009 L15.1985841,4.63221239 L15.1985841,7.28920354 L13.4673982,7.28920354 C13.1834336,7.28920354 12.7841416,7.43107965 12.7841416,8.03532743 L12.7841416,9.64630088 L15.1913628,9.64630088 L14.9099469,12.3810265 Z" id="Path" fill="#FFFFFF"></path>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                    <li v-if="storeOwner.pinterest_username!=''">
                      <a target="_blank" :href="'https://www.pinterest.com/'+storeOwner.pinterest_username"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: sketchtool 59.1 (101010) - https://sketch.com -->
                        <title>Pinterest</title>
                        <desc>Created with sketchtool.</desc>
                        <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="public-gallery" transform="translate(-268.000000, -407.000000)" fill-rule="nonzero">
                            <g id="Group-5" transform="translate(80.000000, 339.000000)">
                              <g id="Stacked-Group-3" transform="translate(124.000000, 68.000000)">
                                <g id="pinterest" transform="translate(64.000000, 0.000000)">
                                  <circle id="Oval" fill="#3B3B3B" cx="11.9148319" cy="11.9150442" r="11.9146195"></circle>
                                  <path d="M12.876531,15.955115 C11.9757876,15.8854513 11.5973097,15.4387965 10.8909027,15.0099823 C10.5026549,17.0470088 10.028177,18.9997168 8.62279646,20.019823 C8.18846018,16.9410265 9.25953982,14.628531 9.75695575,12.1739469 C8.90909735,10.7466903 9.85890265,7.8739115 11.6472212,8.58180531 C13.8482124,9.45217699 9.74166372,13.8887788 12.4984779,14.4429027 C15.3765664,15.0214513 16.5515044,9.44899115 14.7665841,7.63646018 C12.1877522,5.01961062 7.26010619,7.57699115 7.8660531,11.323115 C8.01366372,12.2389381 8.9600708,12.5169558 8.24410619,13.7806726 C6.59362832,13.4151504 6.10130973,12.1134159 6.16460177,10.3779823 C6.26676106,7.53727434 8.71709735,5.54824779 11.1748673,5.27299115 C14.2831858,4.92509735 17.2005664,6.41437168 17.6032566,9.33812389 C18.0562832,12.6380177 16.2,16.2116814 12.876531,15.955115 L12.876531,15.955115 Z" id="Path" fill="#F1F2F2"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg></a>
                    </li>
                    <li v-if="storeOwner.flickr_username!=''">
                      <a target="_blank" :href="'https://www.flickr.com/photos/'+storeOwner.flickr_username"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: sketchtool 59.1 (101010) - https://sketch.com -->
                        <title>Flickr</title>
                        <desc>Created with sketchtool.</desc>
                        <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="public-gallery" transform="translate(-300.000000, -407.000000)" fill-rule="nonzero">
                            <g id="Group-5" transform="translate(80.000000, 339.000000)">
                              <g id="Stacked-Group-3" transform="translate(124.000000, 68.000000)">
                                <g id="flickr" transform="translate(96.000000, 0.000000)">
                                  <path d="M11.9152566,23.8283894 C18.4942301,23.8283894 23.8292389,18.4942301 23.8292389,11.9141947 C23.8292389,5.33479646 18.4942301,0.000637168142 11.9152566,0.000637168142 C5.33437168,0.000637168142 0,5.33500885 0,11.9141947 C0,18.4942301 5.33437168,23.8283894 11.9152566,23.8283894" id="Path" fill="#3B3B3B"></path>
                                  <g id="Group" transform="translate(5.734513, 9.132743)" fill="#F1F2F2">
                                    <path d="M12.1584425,2.78145133 C12.1584425,4.23610619 10.9803186,5.41529204 9.52566372,5.41529204 C8.06888496,5.41529204 6.89076106,4.23589381 6.89076106,2.78145133 C6.89076106,1.32722124 8.06888496,0.147823009 9.52566372,0.147823009 C10.9803186,0.147823009 12.1584425,1.32743363 12.1584425,2.78145133 Z" id="Path"></path>
                                    <path d="M5.46881416,2.78145133 C5.46881416,4.23610619 4.29069027,5.41529204 2.8339115,5.41529204 C1.37968142,5.41529204 0.201557522,4.23589381 0.201557522,2.78145133 C0.201557522,1.32722124 1.37968142,0.147823009 2.8339115,0.147823009 C4.29069027,0.147823009 5.46881416,1.32743363 5.46881416,2.78145133 Z" id="Path"></path>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg></a>
                    </li>
                    <li v-if="storeOwner.instagram_username!=''">
                      <a target="_blank" :href="'https://www.instagram.com/'+storeOwner.instagram_username"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: sketchtool 59.1 (101010) - https://sketch.com -->
                        <title>Instagram</title>
                        <desc>Created with sketchtool.</desc>
                        <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="public-gallery" transform="translate(-332.000000, -407.000000)" fill="#3B3B3B" fill-rule="nonzero">
                            <g id="Group-5" transform="translate(80.000000, 339.000000)">
                              <g id="Stacked-Group-3" transform="translate(124.000000, 68.000000)">
                                <g id="instagram" transform="translate(128.000000, 0.000000)">
                                  <path d="M15.5346667,6.368 L8.4008,6.368 C7.26213333,6.368 6.33573333,7.2944 6.33573333,8.43306667 L6.33573333,15.5669333 C6.33573333,16.7056 7.26213333,17.6322667 8.4008,17.6322667 L15.5346667,17.6322667 C16.6733333,17.6322667 17.6,16.7058667 17.6,15.5669333 L17.6,8.43306667 C17.6,7.2944 16.6736,6.368 15.5346667,6.368 Z M11.9677333,15.7082667 C9.9232,15.7082667 8.25973333,14.0448 8.25973333,12 C8.25973333,9.95546667 9.9232,8.292 11.9677333,8.292 C14.0125333,8.292 15.676,9.95546667 15.676,12 C15.676,14.0445333 14.0122667,15.7082667 11.9677333,15.7082667 Z M15.7952,9.05866667 C15.3112,9.05866667 14.9176,8.66506667 14.9176,8.18133333 C14.9176,7.6976 15.3112,7.304 15.7952,7.304 C16.2789333,7.304 16.6725333,7.6976 16.6725333,8.18133333 C16.6725333,8.66506667 16.2789333,9.05866667 15.7952,9.05866667 Z" id="Shape"></path>
                                  <path d="M11.9677333,9.85893333 C10.7874667,9.85893333 9.8264,10.8194667 9.8264,11.9997333 C9.8264,13.1805333 10.7874667,14.1413333 11.9677333,14.1413333 C13.1485333,14.1413333 14.1088,13.1805333 14.1088,11.9997333 C14.1088,10.8197333 13.1482667,9.85893333 11.9677333,9.85893333 Z" id="Path"></path>
                                  <path d="M11.9677333,0 C5.3584,0 0,5.3584 0,11.9677333 C0,18.5770667 5.3584,23.9354667 11.9677333,23.9354667 C18.5770667,23.9354667 23.9354667,18.5770667 23.9354667,11.9677333 C23.9354667,5.3584 18.5770667,0 11.9677333,0 Z M19.1666667,15.5669333 C19.1666667,17.5698667 17.5376,19.1989333 15.5346667,19.1989333 L8.4008,19.1989333 C6.39813333,19.1989333 4.7688,17.5698667 4.7688,15.5669333 L4.7688,8.43306667 C4.7688,6.4304 6.39813333,4.80106667 8.4008,4.80106667 L15.5346667,4.80106667 C17.5376,4.80106667 19.1666667,6.4304 19.1666667,8.43306667 L19.1666667,15.5669333 Z" id="Shape"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg></a>
                    </li>
                    <li v-if="storeOwner.reddit_username!=''">
                      <a target="_blank" :href="'https://www.reddit.com/user/'+storeOwner.reddit_username">
                        <svg width="24px" height="25px" viewBox="0 0 24 25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: Sketch 59 (86127) - https://sketch.com -->
                          <title>Reddit</title>
                          <desc>Created with Sketch.</desc>
                          <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="reddit" transform="translate(0.000000, 0.000000)" fill-rule="nonzero">
                              <path d="M14.5888244,16.7134289 C14.034619,17.1744577 12.8471169,17.3390212 12.0008966,17.3390212 C11.1522224,17.3390212 9.9671743,17.1744577 9.41296892,16.7134289 C9.28177928,16.6042956 9.07149838,16.6042956 8.94049749,16.7134289 C8.80930785,16.8225621 8.80930785,16.9974892 8.94049749,17.1064654 C9.8188073,17.8371082 11.5061513,17.8947368 12.0008966,17.8947368 C12.4956419,17.8947368 14.180532,17.8371082 15.0614845,17.1064654 C15.1900315,16.9973322 15.1900315,16.822405 15.0614845,16.7134289 C14.9302949,16.6042956 14.7200139,16.6042956 14.5888244,16.7134289 L14.5888244,16.7134289 Z" id="Path" fill="#000000"></path>
                              <path d="M10.5263158,13.6842105 C10.5263158,12.9883546 9.95901379,12.4210526 9.26315789,12.4210526 C8.56748691,12.4210526 8,12.9883546 8,13.6842105 C8,14.3798815 8.56748691,14.9473684 9.26315789,14.9473684 C9.95901379,14.9473684 10.5263158,14.3800665 10.5263158,13.6842105 L10.5263158,13.6842105 Z" id="Path" fill="#000000"></path>
                              <path d="M12,0.210526316 C5.3735962,0.210526316 0,5.58412252 0,12.2105263 C0,18.8369301 5.3735962,24.2105263 12,24.2105263 C18.6264038,24.2105263 24,18.8369301 24,12.2105263 C24,5.58412252 18.6264038,0.210526316 12,0.210526316 Z M18.9624023,13.8112343 C18.9887695,13.9840859 19.0032349,14.1593178 19.0032349,14.3369301 C19.0032349,17.0296792 15.8688354,19.2113808 12.0023804,19.2113808 C8.13592528,19.2113808 5.00152589,17.0296792 5.00152589,14.3369301 C5.00152589,14.1569375 5.01599119,13.9793251 5.04235838,13.8064736 C4.43280028,13.532914 4.00799559,12.9209755 4.00799559,12.2105263 C4.00799559,11.2457436 4.79040525,10.4609536 5.75756836,10.4609536 C6.2279663,10.4609536 6.65277098,10.645707 6.96716306,10.9481972 C8.18151853,10.0722206 9.86169431,9.51283346 11.7312012,9.4648598 C11.7312012,9.44087297 12.6047974,5.27925188 12.6047974,5.27925188 C12.6216431,5.19776996 12.6696167,5.12800678 12.7391968,5.08259663 C12.8087768,5.03700338 12.8928223,5.02253803 12.9744873,5.03938374 L15.8833008,5.65846332 C16.0872802,5.24574361 16.5071411,4.96009908 16.9991455,4.96009908 C17.6903686,4.96009908 18.2495728,5.51930316 18.2495728,6.21052632 C18.2495728,6.90174947 17.6903686,7.46095355 16.9991455,7.46095355 C16.3295288,7.46095355 15.7871704,6.93287738 15.7560425,6.27058491 L13.1519165,5.71614155 L12.3552246,9.4674233 C14.1912232,9.53205952 15.8400879,10.0888832 17.0352173,10.952958 C17.3496094,10.6482705 17.7767944,10.4609536 18.2495728,10.4609536 C19.216919,10.4609536 19.9991455,11.2433633 19.9991455,12.2105263 C19.9991455,12.9257363 19.5695801,13.5376748 18.9624023,13.8112343 L18.9624023,13.8112343 Z" id="Shape" fill="#3B3B3B"></path>
                              <path d="M14.7368421,12.4210526 C14.0409862,12.4210526 13.4736842,12.9883546 13.4736842,13.6842105 C13.4736842,14.3798815 14.0409862,14.9473684 14.7368421,14.9473684 C15.4325131,14.9473684 16,14.3798815 16,13.6842105 C16,12.9883546 15.432698,12.4210526 14.7368421,12.4210526 L14.7368421,12.4210526 Z" id="Path" fill="#000000"></path>
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                    <li v-if="storeOwner.youtube_username!=''">
                      <a target="_blank" :href="'https://www.youtuebe.com/channel/'+storeOwner.youtube_username">
                        <svg version="1.1" style="width: 24px;height: 24px;" id="YouTube" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve">
                        <g>
                          <circle id="youtube-back" fill="#3B3B3B" cx="64" cy="64" r="64"/>
                          <path id="youtube-youtube" fill="#FFFFFF" d="M99.8398,78.3359c0,5.6309-4.6084,10.2403-10.2402,10.2403H38.3994
                          c-5.6318,0-10.2392-4.6094-10.2392-10.2403V49.6641c0-5.6328,4.6074-10.2403,10.2392-10.2403h51.2002
                          c5.6318,0,10.2402,4.6075,10.2402,10.2403V78.3359z M56.5967,72.793l19.3681-10.0352L56.5967,52.6523V72.793z"/>
                        </g>
                      </svg></a>
                    </li>
                    <li v-if="storeOwner.tumblr_username!=''">
                      <a target="_blank" :href="'https://www.tumblr.com/blog/'+storeOwner.tumblr_username">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: Sketch 59 (86127) - https://sketch.com -->
                          <title>Tumblr</title>
                          <desc>Created with Sketch.</desc>
                          <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="tumblr" fill-rule="nonzero">
                              <circle id="Oval" fill="#3B3B3B" cx="12" cy="12" r="12"></circle>
                              <path d="M12.5477269,8.15238315 L12.5477269,5 L10.4436059,5 C10.3962226,5.11508103 10.3728555,5.25547988 10.3728555,5.39566949 C10.3507865,5.46409039 10.3248231,5.51367985 10.3248231,5.58189151 C10.1091101,6.7509055 9.48122741,7.56630687 8.41780787,8.01177506 C8.10213562,8.15259239 7.81242682,8.17393469 7.5,8.15259239 L7.5,10.6939999 L9.0461233,10.6939999 C9.0712213,14.2702997 9.0712213,16.1138977 9.0712213,16.2076365 L9.0712213,16.4195948 C9.26529807,17.9798843 10.1088938,18.9149699 11.6063356,19.2664901 C12.2089039,19.428022 12.8599374,19.5 13.5133508,19.5 C14.3571629,19.4748914 15.1784732,19.334911 16,19.0800589 L16,16.0892076 C15.5201089,16.2293972 15.0824085,16.3474076 14.6962022,16.4629071 C13.9484549,16.6742377 13.3205722,16.5342573 12.8110396,16.0672376 C12.7630072,15.9958874 12.6918241,15.9019394 12.6667261,15.8084099 C12.5955429,15.4351289 12.5503233,15.0388317 12.5503233,14.66576 L12.5503233,10.6937907 L15.9032862,10.6937907 L15.9032862,8.15238315 L12.5477269,8.15238315 Z" id="Path" fill="#F1F2F2"></path>
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                    <li v-if="storeOwner.twitter_username!=''">
                      <a target="_blank" :href="'https://www.twitter.com/'+storeOwner.twitter_username">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: Sketch 59 (86127) - https://sketch.com -->
                          <title>Twitter</title>
                          <desc>Created with Sketch.</desc>
                          <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="twitter" fill-rule="nonzero">
                              <circle id="Oval" fill="#3B3B3B" cx="12" cy="12" r="12"></circle>
                              <path d="M19.5,8.36142333 C18.9850516,8.59222442 18.4311178,8.7483291 17.8501943,8.81804575 C18.4433275,8.45885343 18.8985128,7.89051116 19.1133603,7.21218112 C18.5583555,7.54495905 17.9433734,7.7863692 17.289406,7.91649252 C16.765461,7.35248047 16.0189571,7 15.1923406,7 C13.606368,7 12.3200679,8.30015062 12.3200679,9.9032006 C12.3200679,10.130754 12.3455583,10.3522451 12.3948254,10.5648593 C10.0077267,10.4438294 7.89116864,9.28809188 6.47441782,7.53110233 C6.22722544,7.95979478 6.08542183,8.45885343 6.08542183,8.9908218 C6.08542183,9.99781606 6.5928731,10.8868116 7.36315371,11.4073049 C6.89254567,11.3923656 6.44935586,11.2618093 6.06228771,11.0437824 C6.0620735,11.0561235 6.0620735,11.0684647 6.0620735,11.0805893 C6.0620735,12.4872635 7.05255669,13.6605385 8.36627498,13.9270639 C8.12550874,13.9937494 7.87124759,14.0290408 7.60970348,14.0290408 C7.42420209,14.0290408 7.24448423,14.0110703 7.06926467,13.9772945 C7.43469812,15.130434 8.49522629,15.9698484 9.7523945,15.9934482 C8.76919428,16.7722395 7.5308761,17.2362233 6.18481288,17.2362233 C5.95347165,17.2362233 5.72427247,17.2225831 5.5,17.1955192 C6.77044891,18.0195613 8.28059304,18.5 9.9025521,18.5 C15.1857003,18.5 18.0748952,14.0762402 18.0748952,10.2394427 C18.0748952,10.1136496 18.0721105,9.98828956 18.0665412,9.86401205 C18.6281863,9.45480561 19.1150739,8.94362233 19.5,8.36142333 L19.5,8.36142333 Z" id="Path" fill="#F1F2F2"></path>
                            </g>
                          </g>
                        </svg>
                      </a>
                    </li>
                  </ul>
                </div>
                <div ref="textToCopy" class="txt-to-cpy">{{$root.currentUrl+'@'+storeOwner.username}}</div>
                <div class="cpy-msg">
                  <div><i class="fas fa-check-circle"></i>Link copied to clipboard</div>
                  <div class="msg">{{$root.currentUrl+'@'+storeOwner.username}}</div>
                </div>
              </div>
            </div>
            <div class="bio">
              {{storeOwner.bio==''? 'Thanks for visiting our gallery page. Here you can find and buy content we published on tangible products. Appreciate your support!' : storeOwner.bio }}
              <!-- <div  v-if="!bioLess" @click.prevent="showLess" style="color:#B200FF;">Show Less</div>
              <div  v-if="bioLess" @click.prevent="showMore" style="color:#B200FF;">Show More</div> -->
            </div>
            <span v-if="storeOwner.site!='' && $root.isMobile">
              <a style="color:#B200FF;margin-right:15px;" :href="storeOwner.site">{{$root.trimString(storeOwner.site,25)}}</a>
            </span>
            <div style="display: inline-block !important;" class="share" @click.prevent="$modal.show('ShareModal')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="19px" viewBox="0 0 17 19" version="1.1">
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
          <span v-if="!$root.isMobile && storeOwner.site!=''"><a style="color:#B200FF;margin-left:15px;" :href="storeOwner.site">{{$root.trimString(storeOwner.site,25)}}</a></span>
          <div v-if="$root.isMobile" @click.prevent="$modal.show('tagModal')" class="tag-sign" style="display: inline-block !important;position:inherit;margin-left:15px;"><svg class="icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M972.069257 531.930935l-0.185218-0.192382L528.530488 88.973404C492.112044 52.55496 425.985997 25.092491 374.715287 25.092491H116.867708c-27.810393 0-54.099129 10.972912-74.022901 30.896684-19.924795 19.924795-30.896684 46.213531-30.896684 74.022901v257.848602c0 24.65247 6.500041 53.864792 18.302855 82.256423 11.859096 28.529777 28.066219 53.751205 45.647643 71.039963L519.005554 984.853421c19.346627 19.346627 46.279023 30.442336 73.888848 30.442336 27.191292 0 54.202483-10.963703 74.107834-30.081109l0.195452-0.188288L971.707007 679.92864c19.346627-19.346627 30.443359-46.279023 30.443359-73.88987 0-27.191292-10.964726-54.202483-30.081109-74.107835z m-36.541241 111.818715L631.387088 948.478979c-10.450003 9.950629-24.465205 15.651468-38.492686 15.651469-13.934361 0-28.031427-5.777587-37.697577-15.444761L112.019283 504.920768l-0.183172-0.181125c-26.411533-25.920346-48.723701-79.443353-48.723701-116.878965V130.013099c0-29.138644 24.616654-53.755298 53.755298-53.755298h257.847579c37.261649 0 91.13258 22.390963 117.64849 48.906873l442.967764 442.379363c9.951653 10.450003 15.654538 24.466228 15.654538 38.494733-0.001023 13.935384-5.77861 28.03245-15.458063 37.71088zM235.874125 144.098909c-28.111245 0-54.482869 10.890025-74.256214 30.66337-19.774369 19.773346-30.66337 46.14497-30.66337 74.256214s10.890025 54.482869 30.66337 74.256215 46.14497 30.66337 74.256214 30.66337 54.482869-10.890025 74.257238-30.66337c19.773346-19.773346 30.66337-46.14497 30.66337-74.256215s-10.890025-54.482869-30.66337-74.256214c-19.774369-19.773346-46.145993-30.66337-74.257238-30.66337z m0 158.675906c-29.641087 0-53.755298-24.114211-53.755298-53.755298s24.114211-53.755298 53.755298-53.755298c29.640064 0 53.755298 24.114211 53.755298 53.755298s-24.115234 53.755298-53.755298 53.755298z" /></svg>
            <span v-if="!$root.isMobile">
              Tags
            </span>
          </div>
        </div>
      </div>
      <div v-if="list.length" class="user-gallery-box gallery-box ">
        <div class="approved-mgs-count"><b>Images ({{count}})</b></div>
        <span class="search">
          <i class="fas fa-search"></i>
          <i @click="search=''" v-if="search!=''" class="far fa-times-circle"></i>
          <input type="search" v-model="search" placeholder="Search by words or image ID" /></span>
        </span>
        <tags :tags="tags"></tags>

        <masonry :cols="{default: 4, 1000: 3, 700: 2, 400: 1}" :gutter="{default: '20px', 700: '20px'}">
          <div v-lazy-container="{ selector: '.img-box' }" v-for="(img, $index) in list" :key="$index">
            <div class="img-box _1Nk0C">
              <div class="hover" @click="goCatalog(img.id)">
                <ShareNetwork
                @open="this.$root.clicked = true"
                @close="this.$root.clicked = false"
                network="pinterest"
                :url="$root.currentUrl+ '/gallery/' + img.id"
                :title="img.name + ' (ID '+img.id+')'+' '+img.description+ ' ' +$root.getPinterestContent(img)"
                :media="$root.currentUrl+$root.storageUrl+'/creator_images/' + img.id + '/500.jpg'"
              >
              <svg height="30px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><defs id="defs19"/><g id="g3031"><path d="m 511.672,255.92999 c 0,141.3849 -114.61511,256 -256,256 -141.3849,0 -256.00000293,-114.6151 -256.00000293,-256 C -0.32800293,114.5451 114.2871,-0.07000732 255.672,-0.07000732 c 141.38489,0 256,114.61510732 256,255.99999732 z" id="circle8" style="fill:#cb2027;fill-opacity:1"/><g id="g3000" transform="translate(-603.11865,-9.8474559)"><g id="g3142" transform="translate(221.28814,-27.9639)"><g id="Layer_14"><g id="g3121"><path d="m 645.85601,122.6817 c -93.402,0 -140.5,66.963 -140.5,122.815 0,33.812 12.796,63.89 40.25,75.089 4.505,1.858 8.54,0.065 9.849,-4.916 0.906,-3.438 3.055,-12.139 4.015,-15.777 1.31,-4.928 0.799,-6.646 -2.833,-10.957 -7.916,-9.332 -12.985,-21.416 -12.985,-38.551 0,-49.677 37.175,-94.154 96.794,-94.154 52.797,0 81.801,32.26 81.801,75.329 0,56.692 -25.089,104.534 -62.325,104.534 -20.563,0 -35.953,-16.999 -31.031,-37.865 5.908,-24.908 17.355,-51.777 17.355,-69.771 0,-16.087 -8.646,-29.507 -26.513,-29.507 -21.021,0 -37.913,21.752 -37.913,50.884 0,18.558 6.271,31.112 6.271,31.112 0,0 -21.518,91.16 -25.291,107.125 -7.506,31.798 -1.128,70.766 -0.584,74.692 0.315,2.343 3.317,2.907 4.68,1.142 1.927,-2.53 26.983,-33.441 35.482,-64.34 2.417,-8.739 13.831,-54.032 13.831,-54.032 6.835,13.038 26.794,24.491 48.024,24.491 63.19,0 106.072,-57.604 106.072,-134.719 0.006,-58.317 -49.387,-112.624 -124.449,-112.624 z" id="path3131" style="fill:#ffffff"/></g></g><g id="Layer_1_1_-8"/></g></g></g><g id="Layer_1_1_"/></svg>
            </ShareNetwork>
                <div class=" img-id" v-if="!$root.isMobile">Image ID - {{img.id}}</div>
                <div class=" img-name" v-if="!$root.isMobile">'{{img.name}}'</div>
                <div class="visibile">
                  <svg style="    margin: 10px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="39px" height="33px" viewBox="0 0 39 33" version="1.1">
                    <!-- Generator: sketchtool 59 (101010) - https://sketch.com -->
                    <title>579024FF-590D-4634-8A8E-D02BA1A63641</title>
                    <desc>Created with sketchtool.</desc>
                    <defs>
                      <path
                        d="M114.499859,346.968682 C111.062923,346.968682 108.28075,344.331347 108.024735,340.989194 L103.271478,337.347416 C102.646622,338.124556 102.07161,338.946169 101.607612,339.844597 C101.397396,340.25684 101.397396,340.743609 101.607612,341.155852 C104.064896,345.908986 108.929621,349.12491 114.499859,349.12491 C115.719212,349.12491 116.895518,348.945224 118.029231,348.655032 L115.677978,346.851437 C115.289662,346.925803 114.895336,346.965046 114.499859,346.968682 Z M128.719755,349.578616 L123.710483,345.740531 C125.232147,344.469213 126.483621,342.910615 127.392105,341.155403 C127.602321,340.74316 127.602321,340.256391 127.392105,339.844148 C124.934821,335.091014 120.070096,331.87509 114.499859,331.87509 C112.166956,331.877893 109.871943,332.460133 107.824455,333.568627 L102.059828,329.151506 C101.908011,329.034388 101.715467,328.981888 101.524589,329.005563 C101.33371,329.029238 101.160148,329.127147 101.042115,329.277735 L100.152635,330.412899 C99.9069282,330.726253 99.9639305,331.177735 100.279962,331.421384 L126.939889,351.848494 C127.091706,351.965612 127.284251,352.018112 127.475129,351.994437 C127.666007,351.970762 127.839569,351.872853 127.957602,351.722265 L128.847535,350.587101 C129.09314,350.273629 129.035933,349.822129 128.719755,349.578616 Z M120.394985,343.199776 L118.614213,341.835064 C118.76418,341.405376 118.843729,340.954642 118.849836,340.5 C118.867767,339.150197 118.238821,337.87197 117.154776,337.055075 C116.070731,336.23818 114.660098,335.979458 113.353005,336.357797 C113.626243,336.724851 113.774047,337.168846 113.774862,337.62503 C113.768102,337.776834 113.744704,337.927458 113.705081,338.074244 L110.369645,335.518666 C111.528272,334.558788 112.98993,334.032424 114.499859,334.031317 C116.230682,334.030364 117.890892,334.711577 119.11477,335.924897 C120.338647,337.138218 121.025788,338.784107 121.024826,340.5 C121.024826,341.47165 120.785123,342.377265 120.394985,343.200226 L120.394985,343.199776 Z"
                        id="path-1" />
                      <filter x="-27.6%" y="-30.4%" width="155.2%" height="169.6%" filterUnits="objectBoundingBox" id="filter-2">
                        <feOffset dx="0" dy="1" in="SourceAlpha" result="shadowOffsetOuter1" />
                        <feGaussianBlur stdDeviation="2.5" in="shadowOffsetOuter1" result="shadowBlurOuter1" />
                        <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.24 0" type="matrix" in="shadowBlurOuter1" result="shadowMatrixOuter1" />
                        <feMorphology radius="1" operator="erode" in="SourceAlpha" result="shadowSpreadOuter2" />
                        <feOffset dx="0" dy="3" in="shadowSpreadOuter2" result="shadowOffsetOuter2" />
                        <feGaussianBlur stdDeviation="0.5" in="shadowOffsetOuter2" result="shadowBlurOuter2" />
                        <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.18 0" type="matrix" in="shadowBlurOuter2" result="shadowMatrixOuter2" />
                        <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetOuter3" />
                        <feGaussianBlur stdDeviation="1" in="shadowOffsetOuter3" result="shadowBlurOuter3" />
                        <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.18 0" type="matrix" in="shadowBlurOuter3" result="shadowMatrixOuter3" />
                        <feMerge>
                          <feMergeNode in="shadowMatrixOuter1" />
                          <feMergeNode in="shadowMatrixOuter2" />
                          <feMergeNode in="shadowMatrixOuter3" />
                        </feMerge>
                      </filter>
                    </defs>
                    <g id="Page-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="link" transform="translate(-95.000000, -325.000000)">
                        <g id="Shape">
                          <use fill="black" fill-opacity="1" filter="url(#filter-2)" xlink:href="#path-1" />
                          <use fill="#FAFAFA" fill-rule="evenodd" xlink:href="#path-1" />
                        </g>
                      </g>
                    </g>
                  </svg>
                </div>
                <div class="view-store" v-if="!$root.isMobile">View Products</div>
                <div class="quick-view" v-if="!$root.isMobile" @click="openShopModal(img)">Quick View</div>
              </div>
              <v-lazy-image class="img" :src="$root.storageUrl+'/creator_images/' + img.id + '/500.jpg'" :src-placeholder="$root.storageUrl+'/creator_images/' + img.id + '/80.jpg'" />
              <hooper :wheelControl="false" :itemsToShow="2.5" :centerMode="true" :infiniteScroll="true" v-if="$root.isMobile">
                <slide v-for="(template,$j) in prevs[$index].templates_list" :key="$j">
                  <a :href="'/product-page/' + prevs[$index].products_list[$j].id">
                    <div class="thumbnail-wrapper">
                      <v-lazy-image class="thumbnail" :src="$root.storageUrl+'/temp/'+$j+'.jpg'" :src-placeholder="$root.storageUrl+'/images/placeholder-white.png'" />
                    </div>
                  </a>
                </slide>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
              </hooper>
              <div v-if="$root.isMobile" class="view-store-b" style="">
                <a :href="'/gallery/' + img.store_id"><img :src="$root.storageUrl+'/images/view_products_icon.png'" /> View all products</a>
              </div>
            </div>
          </div>
        </masonry>
      </div>
      <div v-else class="no-img"><img :src="$root.storageUrl+'/images/no-img.png'" /></div>
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
      storeOwner:null,
      page: 1,
      count: 0,
      list: [],
      tags: [],
      prevs: [],
      search: '',
      done: true,
      lastImage:0,
    };
  },
  watch: {
    $route(val) {
    },
    search: function(newVal, oldVal) { // watch it
      // debugger;
      this.page = 0;
      this.prevs = [];
      this.list = [];
      this.tags = [];
      this.initGetData(1);
    }
  },
  methods:{
    initGetData(first = 0) {
      var that = this;
      that.getImagesData(first);
      that.refreshIntervalId = setInterval(function() {
        that.getImagesData();
      }, 300);
    },
    getImagesData(first = 0) {
      // if(first) debugger;
      if (this.done || first) {
        var that = this;
        that.done = false;
        Api.get('/api/get-user-images', {
          params: {
            page: this.page,
            status: 'approved',
            search: this.search,
            creatorId: this.storeOwner.id,
            isMobile: this.$root.isMobile,
            perPage: 4,
          },
        }).then(({
          data
        }) => {
          if (data.imgs.current_page <= data.imgs.last_page || data.imgs.current_page == 1) {
            that.count = data.imgs.total;
            if (data.imgs.current_page == data.imgs.last_page) {
              clearInterval(that.refreshIntervalId);
            }
            if(!that.lastImage){
              that.lastImage=data.imgs.data[0];
            }
            that.page += 1;
            that.list.push(...data.imgs.data);
            that.tags.push(...data.tags);
            that.tags = [...new Set(that.tags)];
            // that.tags.filter(that.onlyUnique);
            that.done = true;
          }
        });
      }
    },
    goCatalog(img_id) {
      if (!this.$root.clicked) {
        this.$ma.trackEvent({
          action: 'gallery-page',
          properties: {
            feature: 'view-products',
            type: 'clicked',
          },
        });
        // fbq('track', 'ViewContent');
        window.location.href = '/gallery/' + img_id;
      }
    },
    openShopModal(img) {
      this.$ma.trackEvent({
        action: 'gallery-page',
        properties: {
          feature: 'quick-view',
          type: 'button-clicked',
        },
      });
      this.$refs.shopModal.openModal(img);
      // this.$refs.modal.openModal();
      // alert(img.id);
    },
  },
  created() {
    var that=this;
    Api.get('/api/store-owner/'+this.$route.params.username)
    .then(response => {
      that.storeOwner=response.data;
      that.initGetData();
    });
  },
  mounted() {
  }
};
</script>
