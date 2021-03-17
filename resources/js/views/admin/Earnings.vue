<template>
  <div class="earnings-page container" v-if="creator" >
    <div class="title">
      Account <span>#{{creator.id}}</span> - Earnings
    </div>
</div>
</template>

<script>
import Api from "../../apis/Api";

import moment from 'moment'

export default {
  props:['creator','user'],
  components: {
  },
  data() {
    return {
    };
  },
  watch: {
    creator(val) {
      this.init();
    },
    '$route': {
      handler: function() {
        if(this.creator){
          this.init();
        }
      },
      deep: true,
      immediate: true
    }
  },
  methods:{
    init() {
      Api.get('/api/orders/'+this.creator.id)
      .then(response => {
        this.isEmpty=response.data;
      });
      // this.refresh++;
    },
  },
  created() {

  },
  mounted() {
  }
};
</script>
