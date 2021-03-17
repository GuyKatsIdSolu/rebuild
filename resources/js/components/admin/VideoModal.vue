<template>
  <modal class="video-modal" name="VideoModal" width="860px" height="710px" :scrollable="true" :reset="true" @before-open="beforeOpen" @opened="afterOpen" @before-close="beforeClose">
    <div class="container">
      <a class="close" @click="$modal.hide('VideoModal')">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 16px; height: 16px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1">
          <path
          d="M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z" />
        </svg>
      </a>
      <div class="col-md-12">
        <h2 class="title">
          Tutorial
        </h2>
        <video controls>
          <source src="https://ondema.s3-eu-west-1.amazonaws.com/artigram+video/how+to+work+artigram+account+v3-115-desktop.mp4" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
              Your browser does not support the video tag.
            </video>
            <div style="width:100%;text-align:center;">
              <button @click="playPause">
                <svg class="icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M122.112664 953.98846l816.371172-407.954319c0.723477-0.342808 1.411139-0.689708 2.099824-1.051959l1.107217-0.550539 0-0.077771c11.644201-6.757914 19.488867-19.377326 19.488867-33.827433 0-14.452153-7.844665-27.070542-19.488867-33.828456l0-0.228197L120.241037 65.955154c-1.14508-0.649799-2.310625-1.24127-3.51301-1.77646l-2.481518-1.240247-0.230244 0.170892c-4.047176-1.431605-8.41874-2.196015-12.96222-2.196015-21.589714 0-39.096437 17.506722-39.096437 39.096437 0 0.192382 0 0.382717 0 0.593518l0 821.276902 0.01842 0c0.438998 21.210068 17.754363 38.255279 39.078017 38.255279C108.80559 960.13546 116.040365 957.887256 122.112664 953.98846z" /></svg> PLAY
              </button>
            </div>
          </div>
        </div>
      </modal>
    </template>
    <script>

    export default {
      name: 'VideoModal',
      props: [],
      components: {
      },
      data() {
        return {
        }
      },
      methods: {
        playPause(){
          var myVideo = $("video")[0]; // or document.getElementById("video1");
          if (myVideo.paused) {
            myVideo.play();
          } else {
            myVideo.pause();
          }
        },
        afterOpen(event) {
        },
        beforeOpen(event) {
          $('html body.bm-overlay .burger .cross-style').click();
        },
        beforeClose(event) {
        },
      }
    }
    </script>
