<template>
  <div class="container store-management-page" v-if="creator">
  <div class="top-banner">
    <img :src="$root.storageUrl+'/images/pricing diagram.png'"/>
  </div>
    <store-management :creator="creator"/>
  </div>
</template>

    <script>
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
            // Api.get('/api/creator/'+this.user.id)
            // .then(response => {
            //   this.creator=response.data;
            // });
            // this.init();
          },
          deep: true,
          immediate: true
        }
      },
      methods:{
        init() {
        },
      },
      created() {

      },
      mounted() {
      }
    };
    </script>
