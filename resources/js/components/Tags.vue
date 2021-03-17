<template>
<div class="tags-template" style="display:inline-block">
  <modal name="tagModal" width="850px" top="250px" height="auto" :scrollable="true" :reset="true">
    <a class="close" @click="$modal.hide('tagModal')">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 20px; height: 20px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1">
        <path
          d="M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z" />
      </svg>
    </a>
    <div class="title">Tags</div>
    <div class="box inside">
      <div v-for="(tag, index) in tags" :key="index" class="tag" @click="search(tag)">
        {{tag}}
      </div>
    </div>
  </modal>
  <div class="box outside" v-if="$root.isMobile">
    <div v-for="(tag, index) in tags" :key="index" @click="search(tag)" v-if="index < 2" class="tag">
      {{tag}}
    </div>
    <span v-if="tags.length > 3" class="tags-see-all" @click="showModal();$ma.trackEvent({action: 'tags',properties: {feature: 'see-all',type: 'clicked'}})">See All</span>
  </div>
  <div class="box outside" v-else>
    <div v-for="(tag, index) in tags" :key="index" @click="search(tag)" v-if="index < 5" class="tag">
      {{tag}}
    </div>
    <span v-if="tags.length > 6" class="tags-see-all" @click="showModal();$ma.trackEvent({action: 'tags',properties: {feature: 'see-all',type: 'clicked'}})">See All</span>
  </div>
</div>
</template>

<script>
export default {
  props: ['tags'],
  data: () => ({}),
  methods: {
    search(tag) {
      // this.$root.searchInput=tag;
      if(this.$root.$refs.approvedGallery){
        this.$root.$refs.approvedGallery.search=tag;
      }
      if(this.$root.$refs.userGallery){
        this.$root.$refs.userGallery.search=tag;
      }
      this.$modal.hide('tagModal');
    },
    showModal() {
      this.$modal.show('tagModal');
    }
  },
  mounted() {}
}
</script>
