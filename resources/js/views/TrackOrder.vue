<template>
  <div class="track-order-page">
    <div class="h1">Where is my order</div>
    <div class="h2">On this page you can check the status of your order and where it is located</div>
    <div><input type="email" class="" v-model="email" placeholder="Email address associated with the order"/></div>
    <div><input type="number" class="" v-model="itemId" placeholder="Item ID"/></div>
    <div class="btn purple" @click="track">Track Order</div>
    <br>
    <transition name="fade" mode="out-in" :duration="{ enter: 300, leave: 100 }">
      <div v-if="item" class="details">
        <span> Status: {{item.status}}</span>
      </div>
    </transition>
    <div @click="$router.back()" class="btn purple negative">Back</div>
  </div>
</template>

<script>
import Api from "../apis/Api";
export default {
  props:['creator','user'],
  components: {
  },
  data() {
    return {
      email:'',
      itemId:'',
      item:null,
    };
  },
  watch:{
  },
  created() {
  },
  mounted() {
  },
  methods:{
    track() {
      this.item=null;
      if(this.email==''){
        this.$toast.error({
          title:'Missing field',
          message:"Please put email",
          position: this.$root.toastPosition,
        });
        return;
      }
      if(this.itemId==''){
        this.$toast.error({
          title:'Missing field',
          message:"Please put item id",
          position: this.$root.toastPosition,
        });
        return;
      }
      Api.post('/api/track-order', {
        'email':this.email,
        'itemId':this.itemId
      })
      .then(response => {
        if(response.data.hasOwnProperty('error')){
          this.$toast.error({
            title:'Error',
            message:response.data.error,
            position: this.$root.toastPosition,
          });
          return;
        }
        this.item=response.data;
      });
    },
  }
};
</script>
