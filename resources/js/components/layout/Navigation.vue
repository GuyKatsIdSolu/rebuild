<template>
  <div>
    <sidebar v-if="isAdminPage" :creator="creator" :user="user"/>
    <div class="header">

      <div v-if="isLoggedIn && !isAdminPage" class="view-as-visitor">
        <i class="fas fa-info-circle"></i>Viewing as a visitor<a href="" @click.prevent="$router.push('/admin')"><span class="done">Done</span></a>
      </div>
      <div v-if="!isAdminPage" class="top-header">
        <div  class="left">
          <a href="" @click.prevent="$router.push('/about-me')">About me</a>
          <span>|</span>
          <a href="" @click.prevent="$router.push('/track-order')">Track Order</a>
          <span>|</span>
          <a target="_blank" href="https://buy.support.artigram.me/">Help</a>
        </div>
        <span>
          Free Domestic Shipping
        </span>
      </div>
      <nav class="navbar navbar-expand no-padding" :class="[isAdminPage? 'admin':'']">
        <div class="container no-padding">
          <div class="navbar-header" v-if="!isAdminPage">
            <router-link v-if="$route.name!='ImageUploader'" class="navbar-brand" to="/">
              <img v-if="isAdminPage" :src="$root.storageUrl+'/images/artigram-logo.png'"/>
              <img v-else :src="$root.storageUrl+'/images/artigram-logo-square.png'"/>
            </router-link>
          </div>

          <!-- <div class="" style="position: fixed;right: 95px;font-size: 16px;top: 17px;z-index: 6;">
          <a target="_blank" @click="$ma.trackEvent({action: 'account-page',properties: {feature: 'dashboard',type: 'dasboard-button-clicked'}});" href="{{str_replace('https://my','https://admin',url('/token/'.Auth::user()->api_token))}}" >Dashboard</a>
          <a @click="$ma.trackEvent({action: 'account-page',properties: {feature: 'upload image',type: 'upload-image-button-clicked'}});" href="/upload-images" style="margin-left: 10px;font-size: 16px;width: 158px;height: 48px;line-height: 48px;" class="btn purple">Upload Images</a>
        </div> -->
        <div v-if="!isAdminPage" class="dropdown show">
          <a  class="dropdown-toggle" href="#" id="aboutDropdown" role="button" data-toggle="dropdown">
            About
          </a>
          <div class="dropdown-menu" aria-labelledby="aboutDropdown">
            <a class="dropdown-item" target="_blank" href="/image-usage-rights">Usage rights</a>
            <a class="dropdown-item" target="_blank" href="https://artigram.me/about-us">About</a>
            <a class="dropdown-item" target="_blank" href="https://sell.support.artigram.me/article/242-shipping-terms">Shipping info</a>
            <a class="dropdown-item" target="_blank" href="https://artigram.me/contact-us-today/">Contact</a>
            <a class="dropdown-item" target="_blank" href="/disclaimer" >Disclaimer</a>
            <a class="dropdown-item" target="_blank" @click="$ma.trackEvent({action: 'account-page',properties: {feature: 'privacy',type: 'clicked'}});"  href="https://artigram.me/privacy-policy-2" >Privacy Policy</a>
            <a class="dropdown-item" target="_blank" @click="$ma.trackEvent({action: 'account-page',properties: {feature: 'terms-of-use',type: 'clicked'}});" href="https://artigram.me/terms-of-use" >Terms of use</a>
            <a class="dropdown-item" target="_blank" href="https://buy.support.artigram.me/" >Support</a>
          </div>
        </div>
        <div class="avatar-box" v-if="isLoggedIn && user">
          <a class="dropdown-toggle" id="avatarDropdown" role="button" data-hover="dropdown">
            <div class="avatar">{{user.first_name.charAt(0)+user.last_name.charAt(0)}}</div>
          </a>
          <div class="dropdown-menu" aria-labelledby="avatarDropdown">
            <a class="dropdown-item" href="" @click.prevent="$router.push('/admin/edit')">Edit profile</a>
            <a class="dropdown-item" target="_blank">Store Settings</a>
            <a class="dropdown-item" target="_blank">Orders</a>
            <a class="dropdown-item" target="_blank">Earnings</a>
            <a class="dropdown-item" @click="$ma.trackEvent({action: 'header',properties: {feature: 'support',type: 'clicked'}});" target="_blank" href="https://artigram.me/support">Support</a>
            <a class="dropdown-item" v-if="isLoggedIn" @click.prevent="logout" href="#">Logout</a>
          </div>
        </div>
      </ul>
      <cart ref="cart" ></cart>
    </div>
  </nav>
</div>
</div>
</template>

<script>
import User from "../../apis/User";
import Api from "../../apis/Api";

export default {
  props:['creator','user'],
  watch:{
    $route: function(newVal, oldVal) { // watch it
      if(this.$route.meta.authOnly){
        this.isAdminPage = true;
      }else{
        this.isAdminPage = false;
      }
    },
  },
  data() {
    return {
      isLoggedIn: false,
      isAdminPage: false,
    };
  },

  mounted() {
    this.$root.$on("login", () => {
      this.isLoggedIn = true;
    });
    if(this.$route.meta.authOnly){
      this.isAdminPage = true;
    }
    this.isLoggedIn = !!localStorage.getItem("auth");
    this.$root.isLoggedIn=this.isLoggedIn;
    if(this.isLoggedIn){
      Api.get("/api/user").then(response => {
      }).catch(res => {
        localStorage.removeItem("auth");
        this.isLoggedIn = false;
        this.$router.push({ name: "Home" });
      });
    }
  },

  methods: {
    logout() {
      User.logout().then(() => {
        localStorage.removeItem("auth");
        this.isLoggedIn = false;
        this.$router.push({ name: "Home" });
      });
    }
  }
};
</script>

<style>
.router-link-exact-active {
  color: #ffffff !important;
  transition: all 0.25s;
}
</style>
