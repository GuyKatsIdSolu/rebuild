<template>
  <div  :class="[creator? ' logged-in': '',isAdminPage? 'is-admin-page':'']">
    <navigation :creator="creator" :user="user" ref="nav"/>
    <router-view :creator="creator" :user="user" class="page-content" />
    <app-footer v-if="!isAdminPage"/>
  </div>
</template>

<script>
import User from "../../apis/User";
import Api from "../../apis/Api";
export default {
  data() {
    return {
      user:null,
      creator:null,
      authAttempt:false,
      isAdminPage: false,
    };
  },
  watch: {
    $route(val) {
      if(localStorage.auth && !this.authAttempt){
        this.authAttempt=true;
        var that=this;
        User.auth().then(response => {

          that.user = response.data;

          Api.get('/api/creator/'+that.user.id)
          .then(response => {
            that.creator=response.data;
          });
        });
      }
      if(this.$route.path.includes('/admin')){
        this.isAdminPage = true;
      }else{
        this.isAdminPage = false;
      }
    },
  },
  methods:{
  },
  created() {
    if(localStorage.auth && !this.authAttempt){
      this.authAttempt=true;
      var that=this;
      User.auth().then(response => {
        that.user = response.data;
        Api.get('/api/creator/'+that.user.id)
        .then(response => {
          that.creator=response.data;
        });
      });
    }
  },
  mounted() {
    if(this.$route.path.includes('/admin')){
      this.isAdminPage = true;
    }else{
      this.isAdminPage = false;
    }
  }
};
</script>

<style>
.h-screen {
  height: 100vh;
}
</style>
