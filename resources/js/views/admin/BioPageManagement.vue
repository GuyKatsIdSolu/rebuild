<template>
  <div class="admin-bio-page" v-if="creator && refresh" >
    <modal class="bio-modal" name="bioModal" width="500px" height="350px" @opened="$refs.bio.focus()" @before-close="closeBioModal">
      <a class="close" @click.prevent="$modal.hide('bioModal')">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 20px; height: 20px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1">
          <path
          d="M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z" />
        </svg>
      </a>
      <textarea ref="bio" v-model="bio" maxlength="190" placeholder="Tell about yourself (up to 190 characters)"></textarea>
      <a href="#" @click.prevent="updateBio" class="update btn purple" >Update</a></modal>
      <div class="header-links" >
        <a href="" @click.prevent="$router.push('/'+creator.username+'-bio-page')">View as visitor</a>
        <a href="" @click.prevent="$router.push('/admin')" >Return to dashboard</a>
      </div>
      <div class="top">
        <a class="edit"  @click.prevent="$router.push('/admin/profile')">Edit</a>
        <div class="avatar-frame">
          <div class="avatar">
            <img  :src="$root.storageUrl+'/creator_images/'+ creator.id+'.jpg'" alt="Avatar of creator">
          </div>
        </div>
        <div class="name">{{creator.username}}</div>
        <div class="social">
          <ul>
            <li v-if="JSON.parse(creator.instagram).status">
              <a target="_blank" :href="JSON.parse(creator.instagram).url"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
            <li v-if="JSON.parse(creator.facebook).status!=''">
              <a target="_blank" :href="JSON.parse(creator.facebook).url">
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
            <li v-if="JSON.parse(creator.tiktok).status!=''">
              <a target="_blank" :href="JSON.parse(creator.tiktok).url">
                <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m256 0c-141.363 0-256 114.637-256 256s114.637 256 256 256 256-114.637 256-256-114.637-256-256-256zm128.43 195.873v34.663c-16.345.006-32.226-3.197-47.204-9.516-9.631-4.066-18.604-9.305-26.811-15.636l.246 106.693c-.103 24.025-9.608 46.598-26.811 63.601-14 13.84-31.74 22.641-50.968 25.49-4.518.669-9.116 1.012-13.766 1.012-20.583 0-40.124-6.668-56.109-18.97-3.008-2.316-5.885-4.827-8.624-7.532-18.644-18.427-28.258-43.401-26.639-69.674 1.235-19.999 9.242-39.072 22.59-54.021 17.66-19.782 42.366-30.762 68.782-30.762 4.65 0 9.248.349 13.766 1.018v12.816 35.652c-4.284-1.413-8.859-2.19-13.623-2.19-24.134 0-43.659 19.69-43.298 43.842.229 15.453 8.67 28.961 21.12 36.407 5.851 3.5 12.582 5.668 19.765 6.062 5.628.309 11.032-.475 16.036-2.127 17.243-5.696 29.682-21.892 29.682-40.994l.057-71.447v-130.44h47.736c.046 4.73.526 9.345 1.418 13.817 3.603 18.101 13.806 33.805 28.006 44.511 12.382 9.339 27.8 14.875 44.511 14.875.011 0 .149 0 .137-.011v12.861z"/></svg>
              </a>
            </li>
            <li v-if="JSON.parse(creator.twitter).status!=''">
              <a target="_blank" :href="JSON.parse(creator.twitter).url">
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
            <li v-if="JSON.parse(creator.youtube).status!=''">
              <a target="_blank" :href="JSON.parse(creator.twitter).url">
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
            <li v-if="JSON.parse(creator.twitch).status">
              <a target="_blank" :href="JSON.parse(creator.twitch).url">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <circle class="st0" cx="256" cy="255.7" r="247.9"/>
                <path class="st1" d="M437,75C388.7,26.6,324.4,0,256,0S123.3,26.6,75,75C26.6,123.3,0,187.6,0,256s26.6,132.7,75,181
                c48.4,48.4,112.6,75,181,75s132.7-26.6,181-75c48.4-48.4,75-112.6,75-181S485.4,123.3,437,75z M256,495.8
                C123.8,495.8,16.2,388.2,16.2,256S123.8,16.2,256,16.2S495.8,123.8,495.8,256S388.2,495.8,256,495.8z"/>
                <path class="st2" d="M103,162.2v228.8h78.8V434h43l43-42.9h64.5l86-85.8V105H124.5L103,162.2z M153.2,133.6h236.5v157.4L339.5,341
                h-78.8l-43,42.9V341h-64.5L153.2,133.6z"/>
                <path class="st2" d="M232,190.8h28.7v85.8H232V190.8z"/>
                <path class="st2" d="M310.8,190.8h28.7v85.8h-28.7V190.8z"/>
              </svg></a></li>
            <li v-if="JSON.parse(creator.patreon).status">
                <a target="_blank" :href="JSON.parse(creator.patreon).url">
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                  viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                  <circle class="st0" cx="256" cy="255.7" r="247.9"/>
                  <path class="st1" d="M437,75C388.7,26.6,324.4,0,256,0S123.3,26.6,75,75C26.6,123.3,0,187.6,0,256s26.6,132.7,75,181
                  c48.4,48.4,112.6,75,181,75s132.7-26.6,181-75c48.4-48.4,75-112.6,75-181S485.4,123.3,437,75z M256,495.8
                  C123.8,495.8,16.2,388.2,16.2,256S123.8,16.2,256,16.2S495.8,123.8,495.8,256S388.2,495.8,256,495.8z"/>
                  <path class="st2" d="M105,111.2h52.8V399H105V111.2z"/>
                  <path class="st2" d="M297.5,111.2c-59.6,0-108.2,48.5-108.2,108c0,59.4,48.5,107.7,108.2,107.7c59.5,0,107.8-48.4,107.8-107.7
                  C405.3,159.7,357,111.2,297.5,111.2z"/>
                </svg>
              </a>
            </li>
            <li v-if="JSON.parse(creator.pinterest).status!=''">
              <a target="_blank" :href="JSON.parse(creator.pinterest).url"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
            <li v-if="JSON.parse(creator.tumblr).status!=''">
              <a target="_blank" :href="JSON.parse(creator.tumblr).url">
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
            <li v-if="JSON.parse(creator.behance).status!=''">
              <a target="_blank" :href="JSON.parse(creator.behance).url">
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
          </ul></div>
        </div>
        <div class="bio">
          <span v-if="bio!=''" >{{bio}}</span>
          <span v-else >Tell about yourself (up to 190 characters)</span>
          <a class="edit" href=""  @click.prevent="$modal.show('bioModal')" >Edit</a>
        </div>
        <div class="links">
          <div :class="['link', isDisable(links['link_'+i])? 'disabled' : '']" v-for="(i,index) in [1,2,3,4,5]" :key="i">
            <input @keyup="setLink($event,i,'title')" @blur="updateLinks()" :value="links['link_'+i].title" placeholder="Title" />
            <input @keyup="setLink($event,i,'url')" @blur="updateLinks()" :value="links['link_'+i].url" placeholder="Https://www.url.com" />
            <div class="tune">
              <label class="switch-wrap" >
                <input v-if="refresh" @change="setLink($event,i,'status')" type="checkbox" :checked="links['link_'+i].status? true:false"  :disabled="isDisable(links['link_'+i])" />
                <div class="switch"></div>
              </label>
            </div>
            <a class="delete" href="" @click.prevent="deleteLink(i)">delete</a>
          </div>
        </div>
        <div class="gallery">
          <div class="item" v-for="(img, $index) in imgs" :key="$index">
            <div @click="$router.push('/catalog-'+img.id)" class="thumbnail">
              <v-lazy-image :class="img.ratio<1? 'portrait': ''" :src="$root.storageUrl+'/creator_images/' + img.id + '/500.jpg'" :src-placeholder="$root.storageUrl+'/creator_images/' + img.id + '/80.jpg'" />
            </div>
          </div>
        </div>

      </div>
    </template>

    <script>
    import Api from "../../apis/Api";
    
    export default {
      props:['creator','user'],
      data() {
        return {
          bio: '',
          oldBio: '',
          refresh: 0,
          links: {},
          imgs: {},
        };
      },
      watch: {
        creator(val) {
          this.init();
        },
        '$route': {
          handler: function() {
            // debugger;
            Api.get('/api/creator/'+this.user.id)
            .then(response => {
              this.creator=response.data;
            });
            this.init();
          },
          deep: true,
          immediate: true
        }
      },
      methods:{
        init() {
          this.bio=this.oldBio=this.creator.bio_page.bio;
          for (var i = 1; i <= 5; i++) {
            this.links['link_'+i]=(JSON.parse(this.creator.bio_page['link_'+i]));
          }

          this.refresh++;
          Api.get('/api/get-user-images', {
            params: {
              page: 1,
              status: 'approved',
              creatorId: this.creator.id,
              search: '',
              perPage: 100,
            },
          }).then(response => {
            this.imgs = response.data.data;
          });
        },
        isDisable(link){
          return link.title=='' || link.url=='';
        },
        updateLinks(){
          Api.post('/api/set-bio-page-links', {
            links:JSON.stringify(this.links),
            creatorId:this.creator.id,
          }).then(response => {
          });
        },
        deleteLink(i){
          this.links['link_'+i]['status']=0;
          this.links['link_'+i]['title']='';
          this.links['link_'+i]['url']='';
          this.updateLinks();
          this.refresh++;
        },
        setLink(event,i,what){
          if(what=='status'){
            this.links['link_'+i][what]=event.target.checked? 1:0;
            this.updateLinks();
          }else{
            this.links['link_'+i][what]=event.target.value;
          }
          this.refresh++;
        },
        closeBioModal() {
          this.bio = this.oldBio;
        },
        updateBio() {
          this.$ma.trackEvent({
            action: 'account-page',
            properties: {
              feature: 'edit bio',
              type: 'text-enterd',
            },
          });
          Api.post('/api/set-bio-page-bio', {
            'bio':this.bio,
            'creatorId':this.creator.id,
          })
          .then(response => {
            this.oldBio = this.bio;
            this.$modal.hide('bioModal');
          });
        },
      },
      created() {

      },
      mounted() {
      }
    };
    </script>
