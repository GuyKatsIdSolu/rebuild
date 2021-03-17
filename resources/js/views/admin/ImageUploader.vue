<template>
  <div class="upload-images-page" v-if="creator">
    <a v-if="$root.isMobile" @click="$ma.trackEvent({action: 'image-upload',properties:{feature:'step 1',type:'help-button'}})" target="_blank" href="https://sell.support.artigram.me/article/321-how-to-set-up-account" class="howto">
      <svg class="icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 53.8c122.4 0 237.4 47.7 324 134.2s134.2 201.6 134.2 324S922.5 749.4 836 836c-86.5 86.5-201.6 134.2-324 134.2S274.6 922.5 188 836c-86.5-86.5-134.2-201.6-134.2-324S101.5 274.6 188 188C274.6 101.5 389.6 53.8 512 53.8M512 0c-136.8 0-265.3 53.3-362 150S0 375.3 0 512c0 136.8 53.3 265.3 150 362s225.3 150 362 150 265.3-53.3 362-150 150-225.3 150-362c0-136.8-53.3-265.3-150-362C777.3 53.2 648.8 0 512 0L512 0 512 0zM653.2 261.1c-33.9-30.2-78.1-45.3-132.6-45.3-61.9 0-110.8 18.2-146.8 54.6-35.9 36.4-53.9 85.9-53.9 148.7l0.1 0c0.9 19.7 17.2 35.4 37.2 35.4 19.9 0 36.2-15.7 37.2-35.4l0 0c0-0.5 0-0.9 0-1.4 0-0.1 0-0.3 0-0.4 0-0.1 0-0.2 0-0.2 0.6-93.1 41.5-139.6 122.7-139.6 31.4 0 57.3 9.1 77.7 27.3 20.4 18.2 30.6 41.5 30.6 69.9 0 33.1-18.9 66.7-56.8 100.7l-28.2 25.1c-27.6 24.6-45.3 46.1-53 64.2-7.8 18.2-11.6 47.5-11.6 88l0 0.1c-0.1 1-0.2 2.1-0.2 3.1 0 19.1 15.5 34.6 34.6 34.6 18.3 0 33.2-14.1 34.5-32l0.1-0.1 0.4-12.8c0-41.7 19.8-78.6 59.4-110.9C670.9 480.5 704 428.5 704 379 704.1 330.6 687.1 291.3 653.2 261.1L653.2 261.1zM465.2 776.3c0-12.3 5-24.4 13.7-33.1 8.7-8.7 20.8-13.7 33.1-13.7s24.4 5 33.1 13.7c8.7 8.7 13.7 20.8 13.7 33.1s-5 24.4-13.7 33.1c-8.7 8.7-20.8 13.7-33.1 13.7s-24.4-5-33.1-13.7C470.2 800.7 465.2 788.5 465.2 776.3L465.2 776.3z" /></svg>
    </a>
    <a v-else target="_blank" @click="$ma.trackEvent({action: 'image-upload',properties:{feature:'step '+$root.$refs.uploader.step,type:'help-button'}})" href="https://sell.support.artigram.me/article/321-how-to-set-up-account" class="howto">How to set up account?</a>
    <a v-if="!isEmpty" href="" @click.prevent="$router.push('/admin')" class="backto">Return to dashboard</a>
  <div class="uploader">
    <div class="shadow">
      <div style="" class="content">
        <img :src="$root.storageUrl+'/images/loading_gif4.gif'"/>
      </div>
    </div>
    <modal class="download-modal" width="860px" height="auto" name="downloadModal">
      <a class="close" @click.prevent="$modal.hide('downloadModal')">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 20px; height: 20px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1">
          <path
          d="M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z" />
        </svg>
      </a>
      <img :src="$root.storageUrl+'/images/artigram-logo.png'"/>
      <div class="title"><svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><title/><g data-name="Confetti" id="f3d8523b-b79d-41af-bbaa-11221b3a2a9b"><path d="M82.13,85.05c-.8.8-2.95.11-5.94-1.7-4.34-2.63-10.44-7.62-16.69-13.86S48.28,57.15,45.65,52.81c-1.8-3-2.5-5.14-1.7-5.94,2-2,12.08,5,22.63,15.56S84.09,83.1,82.13,85.05Z" fill="#fe852b"/><path d="M76.19,83.35c-4.34-2.63-10.44-7.62-16.69-13.86S48.28,57.15,45.65,52.81C50,55.44,56.09,60.42,62.33,66.67S73.56,79,76.19,83.35Z" fill="#d46f24"/><path d="M81.6,85.33l-8.73,4.54-7.3,3.8-4.82,2.51-7.11,3.7-4.82,2.52L41.91,106l-4.79,2.49L30.32,112l-4.75,2.47L18.9,118l-.69.36a6.13,6.13,0,0,1-3.74.62A6.09,6.09,0,0,1,10,110l.38-.72L14,102.68,16.51,98l3.64-6.77,2.55-4.74,3.71-6.92L29,74.78l3.8-7.07L35.31,63l3.9-7.25,4.47-8.33c-.73,2.81,6,12.28,15.83,22.12S78.76,86,81.6,85.33Z" fill="#fe9f59"/><path d="M60.76,96.18l-7.11,3.7a93.63,93.63,0,0,1-17-15.12,94,94,0,0,1-7.69-10l3.8-7.07a87,87,0,0,0,28,28.47Z" fill="#a54fe7"/><path d="M48.84,102.4,41.91,106A93.74,93.74,0,0,1,30.64,96a92.9,92.9,0,0,1-7.94-9.5l3.71-6.92a87.25,87.25,0,0,0,7.73,9.89A86.74,86.74,0,0,0,48.84,102.4Z" fill="#a54fe7"/><path d="M37.11,108.49,30.32,112q-2.91-2.4-5.61-5a93.65,93.65,0,0,1-8.19-9l3.64-6.77a87.89,87.89,0,0,0,17,17.3Z" fill="#a54fe7"/><path d="M25.57,114.51,18.9,118l-.06-.06a89.58,89.58,0,0,1-8.43-8.6L14,102.68a84.72,84.72,0,0,0,8.27,8.88C23.34,112.58,24.43,113.56,25.57,114.51Z" fill="#a54fe7"/><path d="M72.88,89.87l-7.3,3.8A94,94,0,0,1,42.73,73.45,94.36,94.36,0,0,1,35.31,63l3.9-7.25a87.37,87.37,0,0,0,7.13,11A87.13,87.13,0,0,0,72.88,89.87Z" fill="#a54fe7"/><path d="M22.26,111.56c1.07,1,2.17,2,3.3,2.95L18.9,118l-.06-.06.06-.11Z" fill="#9831e7"/><path d="M28.17,100.56a85,85,0,0,0,8.94,7.93L30.32,112q-2.91-2.4-5.61-5l.3-.55Z" fill="#9831e7"/><path d="M48.84,102.4,41.91,106A93.74,93.74,0,0,1,30.64,96l.54-1,2.95-5.51A86.74,86.74,0,0,0,48.84,102.4Z" fill="#9831e7"/><path d="M60.76,96.18l-7.11,3.7a93.63,93.63,0,0,1-17-15.12l.8-1.49,2.76-5.12A86.72,86.72,0,0,0,60.76,96.18Z" fill="#9831e7"/><path d="M72.88,89.87l-7.3,3.8A94,94,0,0,1,42.73,73.45l1.07-2,2.55-4.74A87.13,87.13,0,0,0,72.88,89.87Z" fill="#9831e7"/><path d="M76.5,64.5s13.45-25.56,28-18c13.86,7.2,5.32,18.7,5.32,18.7" fill="none" stroke="#9831e7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/><path d="M67.5,51.5S89.93,40.83,82.37,26.27C75.17,12.41,63.68,21,63.68,21" fill="none" stroke="#9831e7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/><path d="M64.5,65.5,100,29a12.73,12.73,0,0,0,0-18h0" fill="none" stroke="#9831e7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/><polygon fill="#fe9f59" points="49.5 27.6 50.58 29.79 53 30.14 51.25 31.85 51.66 34.26 49.5 33.12 47.34 34.26 47.75 31.85 46 30.14 48.42 29.79 49.5 27.6"/><polygon fill="#fe5959" points="92.48 7.25 92.05 9.66 93.78 11.38 91.36 11.71 90.26 13.89 89.19 11.69 86.78 11.32 88.55 9.63 88.16 7.21 90.31 8.37 92.48 7.25"/><polygon fill="#fe5959" points="100.48 58.26 100.05 60.66 101.78 62.38 99.36 62.71 98.26 64.89 97.19 62.69 94.78 62.32 96.55 60.63 96.16 58.21 98.31 59.37 100.48 58.26"/><path d="M81,72s17.5-3.5,18.5,8.5S89,91,89,91" fill="none" stroke="#9831e7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/><circle cx="72.5" cy="30.5" fill="#fe5959" r="2"/><circle cx="108" cy="41" fill="#fe5959" r="2"/><circle cx="111" cy="12" fill="#a54fe7" r="2"/></g></svg>
        <span v-if="!$root.$root.isMobile">Let us help you boost your first store</span>
        <span v-else>Special Gift</span>
        <svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><title/><g data-name="Confetti" id="f3d8523b-b79d-41af-bbaa-11221b3a2a9b"><path d="M82.13,85.05c-.8.8-2.95.11-5.94-1.7-4.34-2.63-10.44-7.62-16.69-13.86S48.28,57.15,45.65,52.81c-1.8-3-2.5-5.14-1.7-5.94,2-2,12.08,5,22.63,15.56S84.09,83.1,82.13,85.05Z" fill="#fe852b"/><path d="M76.19,83.35c-4.34-2.63-10.44-7.62-16.69-13.86S48.28,57.15,45.65,52.81C50,55.44,56.09,60.42,62.33,66.67S73.56,79,76.19,83.35Z" fill="#d46f24"/><path d="M81.6,85.33l-8.73,4.54-7.3,3.8-4.82,2.51-7.11,3.7-4.82,2.52L41.91,106l-4.79,2.49L30.32,112l-4.75,2.47L18.9,118l-.69.36a6.13,6.13,0,0,1-3.74.62A6.09,6.09,0,0,1,10,110l.38-.72L14,102.68,16.51,98l3.64-6.77,2.55-4.74,3.71-6.92L29,74.78l3.8-7.07L35.31,63l3.9-7.25,4.47-8.33c-.73,2.81,6,12.28,15.83,22.12S78.76,86,81.6,85.33Z" fill="#fe9f59"/><path d="M60.76,96.18l-7.11,3.7a93.63,93.63,0,0,1-17-15.12,94,94,0,0,1-7.69-10l3.8-7.07a87,87,0,0,0,28,28.47Z" fill="#a54fe7"/><path d="M48.84,102.4,41.91,106A93.74,93.74,0,0,1,30.64,96a92.9,92.9,0,0,1-7.94-9.5l3.71-6.92a87.25,87.25,0,0,0,7.73,9.89A86.74,86.74,0,0,0,48.84,102.4Z" fill="#a54fe7"/><path d="M37.11,108.49,30.32,112q-2.91-2.4-5.61-5a93.65,93.65,0,0,1-8.19-9l3.64-6.77a87.89,87.89,0,0,0,17,17.3Z" fill="#a54fe7"/><path d="M25.57,114.51,18.9,118l-.06-.06a89.58,89.58,0,0,1-8.43-8.6L14,102.68a84.72,84.72,0,0,0,8.27,8.88C23.34,112.58,24.43,113.56,25.57,114.51Z" fill="#a54fe7"/><path d="M72.88,89.87l-7.3,3.8A94,94,0,0,1,42.73,73.45,94.36,94.36,0,0,1,35.31,63l3.9-7.25a87.37,87.37,0,0,0,7.13,11A87.13,87.13,0,0,0,72.88,89.87Z" fill="#a54fe7"/><path d="M22.26,111.56c1.07,1,2.17,2,3.3,2.95L18.9,118l-.06-.06.06-.11Z" fill="#9831e7"/><path d="M28.17,100.56a85,85,0,0,0,8.94,7.93L30.32,112q-2.91-2.4-5.61-5l.3-.55Z" fill="#9831e7"/><path d="M48.84,102.4,41.91,106A93.74,93.74,0,0,1,30.64,96l.54-1,2.95-5.51A86.74,86.74,0,0,0,48.84,102.4Z" fill="#9831e7"/><path d="M60.76,96.18l-7.11,3.7a93.63,93.63,0,0,1-17-15.12l.8-1.49,2.76-5.12A86.72,86.72,0,0,0,60.76,96.18Z" fill="#9831e7"/><path d="M72.88,89.87l-7.3,3.8A94,94,0,0,1,42.73,73.45l1.07-2,2.55-4.74A87.13,87.13,0,0,0,72.88,89.87Z" fill="#9831e7"/><path d="M76.5,64.5s13.45-25.56,28-18c13.86,7.2,5.32,18.7,5.32,18.7" fill="none" stroke="#9831e7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/><path d="M67.5,51.5S89.93,40.83,82.37,26.27C75.17,12.41,63.68,21,63.68,21" fill="none" stroke="#9831e7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/><path d="M64.5,65.5,100,29a12.73,12.73,0,0,0,0-18h0" fill="none" stroke="#9831e7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/><polygon fill="#fe9f59" points="49.5 27.6 50.58 29.79 53 30.14 51.25 31.85 51.66 34.26 49.5 33.12 47.34 34.26 47.75 31.85 46 30.14 48.42 29.79 49.5 27.6"/><polygon fill="#fe5959" points="92.48 7.25 92.05 9.66 93.78 11.38 91.36 11.71 90.26 13.89 89.19 11.69 86.78 11.32 88.55 9.63 88.16 7.21 90.31 8.37 92.48 7.25"/><polygon fill="#fe5959" points="100.48 58.26 100.05 60.66 101.78 62.38 99.36 62.71 98.26 64.89 97.19 62.69 94.78 62.32 96.55 60.63 96.16 58.21 98.31 59.37 100.48 58.26"/><path d="M81,72s17.5-3.5,18.5,8.5S89,91,89,91" fill="none" stroke="#9831e7" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/><circle cx="72.5" cy="30.5" fill="#fe5959" r="2"/><circle cx="108" cy="41" fill="#fe5959" r="2"/><circle cx="111" cy="12" fill="#a54fe7" r="2"/></g></svg>
      </div>
      <div class="txt-content">Here is a little gift from us to help you earn money with Artigram!
      Click the attached link and download your gift $100 worth of photos licensed for commercial use in your Artigram store!</div>
      <div class="btn-box"><a class="btn purple" href="https://ondema.s3-eu-west-1.amazonaws.com/GIVEAWAY+IMAGES/Giveaway+content.zip">Download</a></div>
      <div class="btn-2-box"><a href="https://sell.support.artigram.me/article/326-artigram-gift-image-terms-of-use ">Gift terms of use</a></div>
    </modal>
    <div id="next" @click="step2()">
      <input class="img-ids" type="hidden" value="{}">
    </div>
      <div class="steps">
        <div>
          <img :src="$root.storageUrl+'/images/artigram-logo-square.png'" />
          <span v-if="step != Object.keys(steps).length">Step <span class="purple2">{{step}}</span> of {{Object.keys(steps).length-1}}</span>
          <span v-else>You’ve done it!</span>
        </div>
      </div>
      <div class="step-0" v-if="steps[step]===0">
        <div class="ah1 fly" v-if="$root.isMobile">
          Step {{step}}: Store Information
        </div>
        <div class="ah1" v-else>
          User Name
        </div>
        <div class="center">
          @<input maxlength="25" class="store-name" :placeholder="creator.username" v-model="creator.username" />
        </div>
        <div class="ah1">
          Add links to your Bio page
        </div>
        <div class="links" v-for="(link,index) in links" :key="index">
          <input  placeholder="Title" v-model="link.title"/>
          <input  placeholder="Https://www.url.com" v-model="link.url"/>
        </div>
        <a  v-if="Object.keys(this.links).length<5" class="add-link" href="" @click.prevent="addLink">+ Add</a>
        <div :class="$root.isMobile?'':'center'">
          <div class="ah2" :style="$root.isMobile?'font-size:18px;margin-top:50px;':'margin-top:50px;'">
            <b>Connect your store to your social media</b>
          </div>
          <div>Let your followers know for sure that your accounts are associated</div>
          <div class="social-box">
            <div class="social-element" v-for="(socailName ,i) in filledSocial" :key="socailName">
              <div class="form-group" style="display: inline-block;width: 143px;">
                <select class="form-control" v-model="filledSocial[i]" @change="changeSocial(socailName,$event)">
                  <option>{{socailName}}</option>
                  <option v-for="(optionName ,j) in emptySocial" :key="optionName">{{optionName}}</option>
                </select>
              </div>
              <span>&nbsp&nbsp-&nbsp&nbsp</span><input :name="filledSocial[i]" placeholder="Https://www.url.com" class="input" />
            </div>
            <div v-if="socialCount<9" class="add" @click="addSocial">+ Add</div>
          </div>
        </div>
        <div class="btns">
          <div @click="updateCreatorData" class="btn purple next">Next</div>
          <div @click="updateCreatorData" class="btn purple negative skip">Skip</div>
        </div>
      </div>
      <div class="step-1" v-if="steps[step]===1">
        <div class="ah1 fly" v-if="$root.isMobile">
          Step {{step}}: Image Upload
        </div>
        <div class="ah1" v-else>
          Now, select images you want to place on products
        </div>
        <div class="row margin-top-70 center" v-if="!$root.isMobile">
          <div class="col-md-4 ah2" style="margin-left: 33%;">
            Upload from device
          </div>
          <div v-if="false" class="col-md-4 ah2">
            Upload From
          </div>
        </div>
        <div class="row margin-top-84 center second-row">
          <div @click="uppy" class="upload-from col-md-4 box">
            <div class="img-1-box">
              <img src="https://admin.ondema-m.com/storage/images/artigram-site-assets/Group.png" />
            </div>
            <div class="browse">
              <label v-if="!$root.isMobile">Choose images</label>
              <label v-else> Upload from device</label>
            </div>
          </div>
        </div>
        <div class="third-row">
          <ol class="list">
            <li>Up to 20 images for a single upload</li>
            <li>JPG & PNG only</li>
            <li>Image color mode- RGB only</li>
            <li>Minimum images size: 1000*1000 pixels at 72 DPI</li>
            <li>Recommended image size: 16MP at 300 DPI</li>
            <li>Only upload images you own the rights to</li>
            <li>Read Artigram’s <a href="https://artigram.me/terms-of-use/"><u>User Agreement</u></a></li>
          </ol>
        </div>
      </div>
      <div class="step-2" v-if="steps[step]===2">
        <div class="ah1 fly"><span v-if="$root.isMobile"></span>Step {{step}}: set your image information</div>
        <div class="thumbnails">
          <hooper @slide="$ma.trackEvent({action: 'image-upload',properties: {feature: 'step '+step,type: 'slide-image'}});" v-if="!$root.isMobile" :wheelControl="false" group="group1" :itemsToShow="13" :centerMode="false" style="width:95%;margin:auto;">
            <slide v-for="(imgId,stam ,index) in imgIds" :key="imgId">
              <div class="thumbnail-wrapper" @click="slideTo(index)">
                <img class="thumbnail" :src="$root.storageUrl+'/creator_images/'+imgId+'/1000C.jpg'">
              </div>
            </slide>
          </hooper>
          <hooper v-else :wheelControl="false" group="group1" :itemsToShow="4.5" style="" :infiniteScroll="false" :centerMode="true">
            <slide v-for="(imgId,stam, index) in imgIds" :key="imgId">
              <div class="thumbnail-wrapper" @click="slideTo(index)" :style="{ width: $root.screenWidth/5-5 + 'px', height: $root.screenWidth/5-5 + 'px' }">
                <img class="thumbnail" :src="$root.storageUrl+'/creator_images/'+imgId+'/1000C.jpg'">
              </div>
            </slide>
          </hooper>
        </div>
        <div class="edit-details">
          <hooper :shortDrag="false" :keysControl="false" :mouseDrag="false" :wheelControl="false" ref="carousel"  group="group1" style="width:100%" :infiniteScroll="false">
            <slide v-for="(imgId,index) in imgIds" :key="imgId">
              <div :class="'row cur-box item'+index">
                <div class="col-md-6">
                  <div class="product-preview-box" :id="index ">
                    <slider animation="fade" :autoplay="false" :height="$root.isMobile?'250px':'500px'">
                      <slider-item v-for="(relevantCanvas , cid) in productsPreview[imgId]">
                        <div v-if="!$root.isMobile" class="hover"></div>
                        <img :src="relevantCanvas" />
                      </slider-item>
                    </slider>
                  </div>
                </div>
                <div class="col-md-6 details">
                  <div class="input">
                    <div class="margin-bottom-6"><b>Image Name</b> <span class="grey">(Optional)</span></div>
                    <input class="margin-bottom-6" name="image_name" maxlength="25" v-model="names[imgId]" />
                  </div>
                  <div class="input">
                    <div class="margin-bottom-6"><b>Image Description</b> <span class="grey">(Optional)</span> </div>
                    <textarea maxlength="140" class="margin-bottom-6" name="image_description" :placeholder="('This image is a great mixture of:'+getTags(imgId)).substring(0, 140)" />
                  </div>
                  <div class="input">
                    <div class="margin-bottom-6"><b>Tag Words</b> <span class="grey">(Auto Generated)</span></div>
                    <div class="col-md-12">
                      <div class="tags-box">
                        <label for="tags">Please add tags to your image (separated by Enter or Comma)</label>
                        <input class="tags-input" style="    width: 100px;" @keyup="addTag($event,imgId)" placeholder="Add tag" />
                        <transition-group name="fadeDown" tag="div">
                          <div class="tag" v-for="(imgTag, j) in tags[imgId]" :key="j">
                            <span @click="deleteTag($event,imgId)"><i class="fa fa-times"></i></span>
                            <span class="value">{{imgTag}}</span>
                          </div>
                        </transition-group>

                      </div>
                    </div>
                  </div>
                  <div class="trash" @click="deleteImg(imgId)"><i class="fas fa-trash"></i> Delete Image</div>
                  <br>
                  <br>
                </div>
              </div>
            </slide>
            <hooper-pagination slot="hooper-addons" mode="fraction"></hooper-pagination>
            <hooper-navigation slot="hooper-addons" v-if="!$root.$root.isMobile">
              <svg slot="hooper-next">
                <path class="cls-1" d="M35.49,25.33h0L8,.84a5.06,5.06,0,0,0-6.7,7.51L25.43,29.89l-24,26.93a4.53,4.53,0,1,0,6.73,6L35.5,32.14a4.79,4.79,0,0,0,0-6.77Z" transform="translate(0.03 0.11)" />
              </svg>
              <svg slot="hooper-prev">
                <path class="cls-1" d="M646.13,473.56h0l27.48,24.49a5.06,5.06,0,0,0,6.7-7.51L656.19,469l24-26.93a4.53,4.53,0,1,0-6.73-6l-27.34,30.68A4.79,4.79,0,0,0,646.13,473.56Z" transform="translate(-644.73 -434.32)" />
              </svg>
            </hooper-navigation>
          </hooper>
        </div>
        <div class="btns">
          <div @click="back" class="btn purple negative back">Back</div>
          <div @click="next" class="btn purple continue">Continue</div>
          <div @click="next" class="btn purple negative skip">Skip</div>
        </div>
      </div>
      <div class="step-3 center" v-if="steps[step]===3">
        <div class="ah1 fly"><span v-if="$root.isMobile"></span>Step {{step}}: set your store products</div>
        <store-management :creator="creator"></store-management>
      </div>
      <div class="step-4 center" v-if="steps[step]===4">
        <div class="ah1 fly"><span v-if="$root.isMobile"></span>Step {{step}}: set your payee information</div>
        <p class="second-title">*Optional, you can finish this later.</p>
        <div class="row">
          <div class="form-group col-md-6 offset-md-3">
            <img :src="$root.storageUrl+'/images/PayPal_logo.png'" />
              <input type="email" v-model="paypalAccount" name="paypal_account" class="form-control" aria-describedby="logoHelp" placeholder="Please enter the email address for your PayPal account" value="" required>
              <div style="margin-top:10px">
                  <p>
                      When you have a balance in your seller account, you can withdraw your founds.
                      <a href="https://support.ondema-m.com/article/47-withdrawing-earnings">Learn more</a>
                  </p>
              </div>
          </div>
        </div>
        <div class="btns">
          <div @click="back" class="btn purple negative back">Back</div>
          <div @click="next" class="btn purple continue">Continue</div>
          <div @click="next" class="btn purple negative skip">Skip</div>
        </div>
      </div>
      <div class="step-5 center" v-if="steps[step]===5">
        <div class="ah1 fly" v-if="$root.isMobile">
          You Have Done It!
        </div>
        <img class="img" src="https://admin.ondema-m.com/storage/images/artigram-site-assets/victory.png" />
        <div class="ah1 for-mobile">
          Artigram is Creating Your Profile Now!
        </div>
        <div class="copy-box">
          {{$root.currentUrl+'@'+creator.username}}
          <button @click="$root.copied" v-clipboard="() => $root.currentUrl+'@'+creator.username" href="" >
            copy
          </button>
        </div>
        <div class="ah3">
          Your images will soon appear on your profile page
        </div>
        <div v-if="$root.isMobile" class="dot-typing"></div>
        <div v-else class="full-width">
          <div style="margin:0 auto" class="dot-pulse"></div>
          <!-- <div class="loading-box">
          <vue-progress-bar></vue-progress-bar>
        </div> -->
      </div>
      <div v-if="!$root.isMobile" class="thumbnails">
        <div v-if="!$root.isMobile" v-for="(imgId, index) in imgIds" :key="imgId" class="thumbnail-wrapper">
          <div class="loading-shadow"></div>
          <img class="thumbnail" :src="$root.storageUrl+'/creator_images/'+imgId+'/1000C.jpg'">
        </div>
        <div v-if="$root.isMobile">
          <hooper :wheelControl="false" :itemsToShow="4.5" :style="{height: $root.screenWidth/5 + 'px' }">
            <slide v-for="(imgId, index) in imgIds" :key="imgId">
              <div class="thumbnail-wrapper" :style="{ width: $root.screenWidth/5-5 + 'px', height: $root.screenWidth/5-5 + 'px' }">
                <img class="thumbnail" :src="$root.storageUrl+'/creator_images/'+imgId+'/1000C.jpg'">
              </div>
            </slide>
            <hooper-navigation slot="hooper-addons"></hooper-navigation>
          </hooper>
        </div>
      </div>
    <!-- <div class="prices-page-box">
      <div>
        The prices of the item in your shop are set to default. To see and edit them visit<br>
        <a target="_blank" href="/store-settings">Prices Page</a>
      </div>
    </div> -->
  </div>
  </div>
</div>
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
import {
  Slider,
  SliderItem
} from 'vue-easy-slider'
export default {
  props: ['user','creator'],
  components: {
    Hooper,
    Slide,
    HooperNavigation,
    HooperPagination,
    Slider,
    SliderItem
  },
  data: () => ({
    isEmpty: 0,
    steps:{
      1:1,
      2:2,
      3:5,
    },
    links:{
      1:{
        title:'',
        url:'',
        status:0
      }
    },
    paypalAccount: '',
    reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
    emptySocial: [
      'Instagram',
      'Twitch',
      'Patreon',
      'TikTok',
      'Pinterest',
      'Twitter',
      'Tumblr',
      'YouTube',
      'Behance',
      'Mail Box',
    ],
    filledSocial: [
      'Facebook',
    ],
    step: 1,
    socialCount: 1,
    is_first_time: 0,
    fileIndex: 0,
    tags: {},
    names: {},
    imgIds: {},
    descriptions: {},
    productsPreview: {},
    step1Inprocces: 0,
    imgId:0,
    error:0,
    readyToPublish:false,
    transloaditInProcess:false,
    transloaditIntervalId:'',
  }),
  watch: {
    step1Inprocces(val) {
      if(val>0){
        $('.shadow').show();
      }else{
        $('.shadow').hide();
      }
    },
    readyToPublish(val) {
      var that=this;
      if(val){
        setInterval(function(){
          that.$toast.info({
            title: 'Image uploading is taking more than usual',
            message: "That can be due to slow internet connection or heavy uploads traffic. Please allow couple more minutes to finish process",
            position: that.$root.toastPosition,
          });
        },30000);
      }
    },
    transloaditInProcess(val) {
      var that=this;
      if(val){
        this.transloaditIntervalId=setInterval(function(){
          if($('#transloadit').length){
            that.$toast.info({
              title: 'Image uploading is taking more than usual',
              message: "That can be due to slow internet connection or heavy uploads traffic. Please allow couple more minutes to finish process",
              position: that.$root.toastPosition,
              timeOut: 29000,
            });
          }
        },30000);
      }else{
        if(this.transloaditIntervalId!=''){
        clearInterval(this.transloaditIntervalId);
      }
      }
    },
    fileIndex(val) {
      var that=this;
      if(val==0 && this.step==Object.keys(this.steps).length){
        setTimeout(function(){
          that.$router.push('/admin');
        },4000);
      }
      if(val==0 && this.step<3){
        this.step=1;
      }
    },
    step(newVal,oldVal){
      switch (this.steps[oldVal]) {
        case 1:
        this.transloaditInProcess=false;
        break;
        case 2:
        for (var imgId in this.imgIds) {
          // this.$set(this.names, i, $('.item' + i + ' [name=image_name]').val());
          if (!this.names[imgId].includes($('.item' + imgId + ' [name=image_name]').val())){
            this.$ma.trackEvent({
              action: 'image-upload',
              properties: {
                feature: 'step '+this.step,
                type: 'change-name',
              },
            });
          }
          if ($('.item' + imgId + ' [name=image_description]').val() != ''){
            this.$set(this.descriptions, imgId, $('.item' + imgId + ' [name=image_description]').val());
            this.$ma.trackEvent({
              action: 'image-upload',
              properties: {
                feature: 'step '+this.step,
                type: 'change-description',
              },
            });
          }else{
            this.$set(this.descriptions, imgId, ('This image is a great mixture of: ' + this.getTags(imgId)).substring(0, 140));
          }
        }
        break;
        case 4:
        if(this.paypalAccount == '')
        {
          // this.$toast.error({
          //   title: 'Email adress error',
          //   message: 'Please Enter Email',
          //   position: this.$root.toastPosition,
          // });
          // this.step=4;
        }
        else if(!this.reg.test(this.paypalAccount))
        {
          this.$toast.error({
            title: 'Email adress error',
            message: 'Please Enter Correct Email',
            position: this.$root.toastPosition,
          });
          this.step=4;
        }
        break;
        // case 3:
        // if (!this.isEmpty) {
        //   this.publish();
        // }
        // break;
        default:
      }
      if(this.steps[newVal]==5){
        this.publish();
      }
    },
    isEmpty(){
      if(this.isEmpty){
        this.steps={
          1:0,
          2:1,
          3:2,
          4:3,
          5:4,
          6:5,
        }
      }
    },
    '$route': {
      handler: function() {
        if(this.creator) this.init();
      },
      deep: true,
      immediate: true
    },
    creator(){
      this.init();
    }
  },
  mounted() {

  },
  created: function() {
    // debugger;
  },
  methods: {
    addLink(){
      this.$set(this.links,Object.keys(this.links).length+1,{
        title: '',
        url: '',
        status: 0,
      });
    },
    init(){
      var that=this;
      Api.get('/api/is-empty/'+that.creator.id)
      .then(response => {
        that.isEmpty=response.data;
      });
      if (this.isEmpty) {
        $('.burger .empty-hide').hide();
      }
      $('.nav-1 a').remove();
      if ($('.upload-images-page').data('signedup') == '1') {
        fbq('track', 'CompleteRegistration');
        ga('send', 'event', 'signup', 'register-complete');
      }
      if (this.isEmpty) {
        $('.nav-1 a').remove();
        $('.backto').remove();
        $('.avatar-box .dropdown-menu a:not(:last-child)').remove();
        $('.avatar-box .dropdown-toggle').removeAttr('href');
      }
      if(this.is_first_time){
        this.$modal.show('UploadPageVideoModal');
        // this.$modal.show('downloadModal');
        Api.get('/api/is-first-time/'+this.creator.id)
        .then(response => {
          this.is_first_time=0;
        });
      }
    },
    async step2(){
      this.next();
      var imgIds=JSON.parse($('.img-ids').val());
      for (var name in imgIds) {
        if(!imgIds[name]){
          this.$toast.error({
            title: 'Image upload error',
            message: name + " did not meet the minimum size, Please upload images over 1000*1000",
            position: this.$root.toastPosition,
          });
          continue
        }
        this.$set(this.names, imgIds[name], name.substring(0, 25));
        this.$set(this.descriptions, imgIds[name], '');
        this.$set(this.imgIds, imgIds[name], imgIds[name]);
        this.resizeImg(window.location.origin+$root.storageUrl+'/creator_images/'+imgIds[name]+'/1000C.jpg', imgIds[name]);
        let response = await Api.get($root.storageUrl+'/creator_images/'+imgIds[name]+'/tags.json');
        this.$set(this.tags, imgIds[name], response.data);
        this.fileIndex++;
      }
      if(!this.fileIndex){
        this.step=1;
      }
    },
    uppy(){
        var uppy = window.Robodog.pick({
          providers: [ 'instagram', 'url', 'webcam', 'dropbox', 'google-drive', 'facebook', 'onedrive' ],
          restrictions:{
            maxNumberOfFiles:20,
            allowedFileTypes:['image/*', '.jpg', '.jpeg', '.png'],
          },
          waitForEncoding: true,
          params: {
            auth: { key: "83304bd5a09d4978a31cf3c4267a06c6" },
            "steps": {
              // "optimized": {
              //   "robot": "/image/optimize",
              //   "use": ':original',
              //   "progressive": true
              // },
              "1000C": {
                "robot": "/image/resize",
                "use": ":original",
                "width": 1000
              },
              "described": {
                "use": "1000C",
                "robot": "/image/describe",
                "provider": "aws",
                // "format": "meta",
                "granularity": "list",
                "result": true
              },
              "exported": {
                "use": [
                  ":original",
                  "1000C",
                  "described",
                ],
                "robot": "/s3/store",
                "credentials": "s3_storage",
                "path": (this.$root.isDev?'dev':'live')+"/test/${file.id}.${file.ext}"
              }
            }
          },
        }).then(function (assembly) {
          Api.post('/api/original-move',{results:assembly.results})
          .then(response => {
            // if(response.data.isOriginal){
            var temp=JSON.parse($('.img-ids').val());
            temp={...temp,...response.data};
            $('.img-ids').val(JSON.stringify(temp));
            $('#next').click();
          });
        }).catch(console.error)
    },
    updateCreatorData() {
      var social={};
      var that=this;
      this.filledSocial.forEach((item, i) => {
        var inpt=$('[name='+item+']').val();
        if(inpt!=''){
          that.$ma.trackEvent({
            action: 'image-upload',
            properties: {
              feature: 'step 0',
              type: 'social-media',
              which: inpt,
            },
          });
          that.$set(social,item.toLowerCase(),inpt);
        }
      });
      if(this.creator.store_name!='' && this.creator.store_name!=this.creator.username + ' Shop'){
        this.$ma.trackEvent({
          action: 'image-upload',
          properties: {
            feature: 'step 0',
            type: 'set-store-name',
          },
        });
      }
      Api.post('/api/creator-details', {
        'creator_id':this.creator.id,
        'username':this.creator.username,
        'store_name':this.creator.store_name==''? this.creator.username + ' Shop' : this.creator.store_name,
        'social':JSON.stringify(social),
        'links':JSON.stringify(this.links),
      })
      .then(response => {
        console.log(response.data);
        // this.$toastr.s('All images uplaoded successfully');
      });
      this.next();
    },
    debug() {
      debugger;
    },
    getTags(imgId) {
      if (this.tags[imgId] != undefined) {
        var tags='';
        this.tags[imgId].forEach((item, i) => {
          tags+=' '+item;
        });
        return tags;
      }
      return '';
    },
    changeSocial(old,event) {
      this.emptySocial.push(old);
      this.emptySocial=this.emptySocial.filter(e => e !== event.target.value);
      this.filledSocial=this.filledSocial.filter(e => e !== old);
    },
    addSocial() {
      this.socialCount++;
      this.filledSocial.push(this.emptySocial[0]);
      for (var i = 0; i < this.filledSocial.length; i++) {
        this.emptySocial=this.emptySocial.filter(e => e !== this.filledSocial[i]);
      }
    },
    saveClicked() {
      var img = this.$refs.vueavatar.getImageScaled();
      this.$refs.image.src = img.toDataURL();
    },
    deleteTag: function(event, index) {
      var element = event.target;
      var val = $(element).closest('.tag').find('.value').html();
      var i = this.tags[index].indexOf(val);
      this.tags[index].splice(i, 1);
    },
    addTag: function(event, index) {
      var element = event.target;
      var key = event.key;
      var inpt = $(element).val();
      inpt = inpt.replace('#', '');
      inpt = inpt.replace(',', '');
      inpt = inpt.replace(' ', '');
      inpt = inpt.replace('\n', '');
      if ((key == ',' || key == 'Enter') && inpt.length > 1) {
        if(this.tags[index].length>14){
          this.$toast.error({
            title: 'Exceed Limit',
            message: "You can add up to 15 tags per image",
            position: this.$root.toastPosition,
          });
        }else{
          this.$ma.trackEvent({
            action: 'image-upload',
            properties: {
              feature: 'step '+this.step,
              type: 'add-tag',
            },
          });
          this.tags[index].push(inpt);
          $(element).val('');
        }
      }
    },
    slideTo(index) {
      this.$refs.carousel.slideTo(index);
    },
    deleteImg(index) {
      this.$ma.trackEvent({
        action: 'image-upload',
        properties: {
          feature: 'step '+this.step,
          type: 'delete-image',
        },
      });
      this.$delete(this.tags, index);
      this.$delete(this.names, index);
      this.$delete(this.descriptions, index);
      this.$delete(this.productsPreview, index);
      this.$delete(this.imgIds, index);
      this.fileIndex--;
    },
    next() {
      this.step++;
      if (this.steps[this.step] == 4) {
        $('.bm-burger-button').hide();
      }
    },
    back() {
      this.step--;
    },
    publish() {
      var vm = this;
      this.$ma.trackEvent({
        action: 'image-upload',
        properties: {
          feature: this.steps[this.step-1],
          type: 'finish-button',
        },
      });
      var i;
      this.$ma.trackEvent({
        action: 'image-upload',
        properties: {
          feature: 'step '+this.steps[this.step],
          type: 'total-images-count',
          count: this.fileIndex,
        },
      });
      for (var imgId in this.imgIds) {
        const formData = new FormData();
        formData.append('tags', this.tags[imgId]);
        formData.append('name', this.names[imgId]);
        formData.append('description', this.descriptions[imgId]);
        formData.append('imgId', imgId);
        formData.append('index', imgId);
        formData.append('creator_id', this.creator.id);
        Api.post('/api/image-upload', formData)
        .then(response => {
          // this.deleteImg(response.data.index);
          this.fileIndex--;
          // fbq('trackCustom', 'ImageUpload');
          // ga('send', 'event', 'Artigram', 'image-upload');
        }).catch(res => {
          this.$toast.error({
            title: 'Image upload failed',
            message: "We had trouble uploading " + this.names[i]+". Please try again",
            position: this.$root.toastPosition,
          });
          this.deleteImg(imgId);
        });
      }
    },
    resizeImg(src, index) {
         let img = new Image()
         img.src = src
         img.onload = () => {
           let canvas = document.createElement('canvas')
           let ctx = canvas.getContext('2d')

           let scale = img.width/300
           let width = img.width * scale
           let height = img.height * scale
           canvas.setAttribute('width', width)
           canvas.setAttribute('height', height)
           ctx.drawImage(img, 0, 0, width, height)
           let quality = 0.7
           let base64 = canvas.toDataURL('image/jpeg', quality)
           this.$set(this.productsPreview, index, {});
           this.showProductsPreview(index, width / height, base64);
         }
    },
    showProductsPreview(index, ratio, src) {
      switch (true) {
        case ratio < 0.9: //portrait
        this.putOverlay(index, src, {
          cid_ratio: "25-portrait",
          width: "4500",
          height: "5700",
          n: '1',
        });
        this.putOverlay(index, src, {
          cid_ratio: "30-portrait",
          width: "4500",
          height: "5700",
          n: '2',
        });
        this.putOverlay(index, src, {
          cid_ratio: "32-portrait",
          width: "4500",
          height: "5700",
          n: '3',
        });
        this.putOverlay(index, src, {
          cid_ratio: "31-portrait",
          width: "4500",
          height: "5700",
          n: '4',
        });
        this.putOverlay(index, src, {
          cid_ratio: "26-portrait",
          width: "4500",
          height: "5700",
          n: '5',
        });
        this.putOverlay(index, src, {
          cid_ratio: "42-portrait",
          width: "3300",
          height: "4200",
          n: '6',
        });
        this.putOverlay(index, src, {
          cid_ratio: "114-portrait",
          width: "1074",
          height: "1932",
          n: '7',
        });
        this.putOverlay(index, src, {
          cid_ratio: "25-portrait",
          width: "4500",
          height: "5700",
          n: '8',
        });
        break;
        case ratio > 1.1: //landscape
        this.putOverlay(index, src, {
          cid_ratio: "25-landscape",
          width: "4500",
          height: "5700",
          n: '1',
        });
        this.putOverlay(index, src, {
          cid_ratio: "30-landscape",
          width: "4500",
          height: "5700",
          n: '2',
        });
        this.putOverlay(index, src, {
          cid_ratio: "31-landscape",
          width: "4500",
          height: "5700",
          n: '3',
        });
        this.putOverlay(index, src, {
          cid_ratio: "32-landscape",
          width: "4500",
          height: "5700",
          n: '4',
        });
        this.putOverlay(index, src, {
          cid_ratio: "26-landscape",
          width: "4500",
          height: "5700",
          n: '5',
        });
        this.putOverlay(index, src, {
          cid_ratio: "42-landscape",
          width: "3000",
          height: "2400",
          n: '6',
        });
        this.putOverlay(index, src, {
          cid_ratio: "11-landscape",
          width: "2100",
          height: "1425",
          n: '7',
        });
        this.putOverlay(index, src, {
          cid_ratio: "72-landscape",
          width: "4300",
          height: "3100",
          n: '8',
        });
        break;
        default: //square
        this.putOverlay(index, src, {
          cid_ratio: "25-square",
          width: "4500",
          height: "5700",
          n: '1',
        });
        this.putOverlay(index, src, {
          cid_ratio: "30-square",
          width: "4500",
          height: "5700",
          n: '2',
        });
        this.putOverlay(index, src, {
          cid_ratio: "31-square",
          width: "4500",
          height: "5700",
          n: '3',
        });
        this.putOverlay(index, src, {
          cid_ratio: "32-square",
          width: "4500",
          height: "5700",
          n: '4',
        });
        this.putOverlay(index, src, {
          cid_ratio: "26-square",
          width: "4500",
          height: "5700",
          n: '5',
        });
        this.putOverlay(index, src, {
          cid_ratio: "42-square",
          width: "2400",
          height: "2400",
          n: '6',
        });
        this.putOverlay(index, src, {
          cid_ratio: "22-square",
          width: "2175",
          height: "2175",
          n: '7',
        });
        this.putOverlay(index, src, {
          cid_ratio: "72-square",
          width: "3900",
          height: "3900",
          n: '8',
        });
        break;

      }

    },
    putOverlay(index, base, data) {
      var vm = this;
      this.step1Inprocces++;
      // console.log('putOverlay: '+this.step1Inprocces);

      var extension = '.png';
      if (['31-landscape', '31-portrait', '31-square', '32-landscape', '32-portrait', '32-square', '30-landscape', '30-portrait', '30-square', '26-landscape', '26-portrait', '26-square'].includes(data.cid_ratio))
      extension = '.jpg';
      let overlay = this.$root.storageUrl+'/overlays/600/' + data.cid_ratio + extension;
      var counter = 0;
      var onloadCallback;
      var canvas = document.createElement('canvas');
      // var canvas = $('#' + index + ".product-preview-box .product-preview-" + data.n)[0];
      // var canvas_obj = $('#' + index + ".product-preview-box .product-preview-" + data.n);
      var size = 500;
      if (this.$root.isMobile) {
        size = 500;
      }
      canvas.width = size;
      canvas.height = size;
      var ctx = canvas.getContext("2d");
      ctx.ImageSmoothingEnabled = false;
      ctx.webkitImageSmoothingEnabled = false;
      ctx.mozImageSmoothingEnabled = false;
      var ratio = data.width / size;
      var img1 = new Image();
      var img2 = new Image();
      img1.crossOrigin = "Anonymous";
      img2.crossOrigin = "Anonymous";
      var img_tmp_for_removing_bg = new Image();
      img_tmp_for_removing_bg.crossOrigin = "Anonymous";
      img_tmp_for_removing_bg.onload = function() {
        var tmpCanvas = document.createElement('canvas');
        tmpCanvas.width = size;
        tmpCanvas.height = size;
        var tmpCtx = tmpCanvas.getContext("2d");
        tmpCtx.drawImage(img_tmp_for_removing_bg, 0, 0, size, size);
        var imgd = tmpCtx.getImageData(0, 0, size, size),
        pix = imgd.data,
        newColor = {
          r: 193,
          g: 22,
          b: 22,
          a: 1
        };
        for (var i = 0, n = pix.length; i < n; i += 4) {
          var r = pix[i],
          g = pix[i + 1],
          b = pix[i + 2];
          if (r == 255 && g == 255 && b == 255) {
            // Change the white to the new color.
            pix[i] = newColor.r;
            pix[i + 1] = newColor.g;
            pix[i + 2] = newColor.b;
            pix[i + 3] = newColor.a;
          }
        }
        tmpCtx.putImageData(imgd, 0, 0);
        img1.src = tmpCanvas.toDataURL();
        $(tmpCanvas).remove();
      };
      img_tmp_for_removing_bg.src = base;
      switch (data.cid_ratio) {
        case "25-square": //tshirt-anvil-980
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.6;
          var x = data.width / ratio / 2.95;
          var y = size / 4.5;
          var w = size / 3;
          var h = w;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;


        };
        break;
        case "25-landscape": //tshirt-anvil-980
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 3.7;
          var w = size / 3;
          var h = size / 5;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "25-portrait": //tshirt-anvil-980
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          ctx.drawImage(img1, size / 2.95, size / 5.14 + ((5700 / ratio / 3.1 - data.height / ratio / 3.1) / 2), data.width / ratio / 3.1, data.height / ratio / 3.1);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "26-square": //hoodie
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.6;
          var x = data.width / ratio / 2.95;
          var y = size / 2.2;
          var w = size / 3;
          var h = w;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "26-landscape": //hoodie
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 2.1;
          var w = size / 3;
          var h = size / 5;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "26-portrait": //hoodie
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 2.3;
          var w = size / 3;
          var h = size / 2.3;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "30-square": //sweatshirt
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.6;
          var x = data.width / ratio / 2.95;
          var y = size / 3;
          var w = size / 3;
          var h = w;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "30-landscape": //sweatshirt
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 2.9;
          var w = size / 3;
          var h = size / 5;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "30-portrait": //sweatshirt
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 3.1;
          var w = size / 3;
          var h = size / 2.3;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "31-square": //longsleeve
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.6;
          var x = data.width / ratio / 2.95;
          var y = size / 3.5;
          var w = size / 3;
          var h = w;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "31-landscape": //longsleeve
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 3.4;
          var w = size / 3;
          var h = size / 5;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "31-portrait": //longsleeve
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 3.6;
          var w = size / 3;
          var h = size / 2.3;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "32-square": //toptank
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.6;
          var x = data.width / ratio / 2.95;
          var y = size / 3;
          var w = size / 3;
          var h = w;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "32-landscape": //toptank
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 2.9;
          var w = size / 3;
          var h = size / 5;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "32-portrait": //toptank
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img2, 0, 0, size, size);
          ctx.globalAlpha = 0.7;
          var x = data.width / ratio / 2.95;
          var y = size / 3.1;
          var w = size / 3;
          var h = size / 2.3;
          ctx.drawImage(img1, x, y, w, h);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;

        case "42-landscape":
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          var x = data.width / ratio / 11;
          var y = size / 5.9;
          var w = size / 1.2;
          var h = size / 1.53;
          ctx.drawImage(img1, x, y, w, h);
          //                ctx.globalAlpha = 0.5;
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "42-portrait":
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          var x = size / 5.7;
          var y = data.width / ratio / 11;
          var w = size / 1.53;
          var h = size / 1.2;
          ctx.drawImage(img1, x, y, w, h);
          //                ctx.globalAlpha = 0.3;
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "42-square":
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          var x = size / 6.5;
          var y = data.width / ratio / 6.4;
          var w = size / 1.44;
          var h = w;
          ctx.drawImage(img1, x, y, w, h);
          //                ctx.globalAlpha = 0.3;
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "11-landscape":
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          var x = data.width / ratio / 9.9;
          var y = size / 5.5;
          var w = size / 1.2;
          var h = size / 1.65;
          ctx.drawImage(img1, x, y, w, h);
          //                ctx.globalAlpha = 0.5;
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "22-square":
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          var x = data.width / ratio / 12.5;
          var y = size / 11;
          var w = size / 1.2;
          var h = w;
          ctx.drawImage(img1, x, y, w, h);
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "72-landscape":
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          var x = data.width / ratio / 20;
          var y = size / 5.5;
          var w = size / 1.1;
          var h = size / 1.53;
          ctx.drawImage(img1, x, y, w, h);
          //                ctx.globalAlpha = 0.5;
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "72-square":
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          var x = size / 15.2;
          var y = data.width / ratio / 17;
          var w = size / 1.1;
          var h = w;
          ctx.drawImage(img1, x, y, w, h);
          //                ctx.globalAlpha = 0.5;
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        case "114-portrait":
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          var x = size / 3.5;
          var y = data.width / ratio / 10;
          var w = size / 2.3;
          var h = size / 1.22;
          ctx.drawImage(img1, x, y, w, h);
          //                ctx.globalAlpha = 0.5;
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
        default:
        var ratio = 1852 / 1307;
        var new_size = size * 0.9;
        var onloadCallback = function() {
          if (++counter < 2)
          return;
          ctx.drawImage(img1, size * 0.05, ((size - size / ratio) / 2) + size * 0.035, new_size, new_size / ratio);
          ctx.drawImage(img2, 0, 0, size, size);
          vm.$set(vm.productsPreview[index], data.cid_ratio, canvas.toDataURL("image/png"));
          vm.step1Inprocces--;
        };
        break;
      }
      img1.onload = onloadCallback;
      img2.onload = onloadCallback;
      //    img1.src = base;
      img2.src = overlay;
    }

  }
}


</script>
