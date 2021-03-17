<template>
  <modal class="share-modal" name="ShareModal" width="860px" height="auto" :scrollable="true" :reset="true" @before-open="beforeOpen" @before-close="beforeClose">
      <div class="share-network-list">
        <div class="title">Share with your friends</div>
        <ShareNetwork
        v-for="network in networks"
        :network="network.network"
        :key="network.network"
        :style="{backgroundColor: network.color}"
        :url="url"
        :title="title"
        :description="description"
        :quote="quote"
        :hashtags=" network.name=='facebook'? fhashtags : hashtags"
        :twitterUser="twitterUser"
        >
        <i :class="network.icon"></i>
        <span>{{ network.name }}</span>
      </ShareNetwork>
      <div class="copy">
        <input :value="url" disabled>
        <button class="btn purple" @click="copied" v-clipboard="() => url">
          Copy
        </button>
      </div>
  </div>
</modal>
</template>
<script>
export default {
  name: 'ShareModal',
  props: ['url','title','description','quote','hashtags','twitterUser'],
  components: {
  },
  data() {
    return {
      fhashtags:'',
      media:'',
      networks: [
        { network: 'email', name: 'Mail', icon: 'far fah fa-lg fa-envelope', color: '#b200ff' },
        { network: 'facebook', name: 'Facebook', icon: 'fab fah fa-lg fa-facebook-f', color: '#1877f2' },
        { network: 'pinterest', name: 'Pinterest', icon: 'fab fah fa-lg fa-pinterest', color: '#bd081c' },
        { network: 'twitter', name: 'Twitter', icon: 'fab fah fa-lg fa-twitter', color: '#1da1f2' },
        { network: 'whatsapp', name: 'Whatsapp', icon: 'fab fah fa-lg fa-whatsapp', color: '#25d366' },
        // { network: 'reddit', name: 'Reddit', icon: 'fab fah fa-lg fa-reddit-alien', color: '#ff4500' },
        // { network: 'tumblr', name: 'Tumblr', icon: 'fab fah fa-lg fa-tumblr', color: '#35465c' },
        // { network: 'baidu', name: 'Baidu', icon: 'fas fah fa-lg fa-paw', color: '#2529d8' },
        // { network: 'buffer', name: 'Buffer', icon: 'fab fah fa-lg fa-buffer', color: '#323b43' },
        // { network: 'evernote', name: 'Evernote', icon: 'fab fah fa-lg fa-evernote', color: '#2dbe60' },
        // { network: 'flipboard', name: 'Flipboard', icon: 'fab fah fa-lg fa-flipboard', color: '#e12828' },
        // { network: 'hackernews', name: 'HackerNews', icon: 'fab fah fa-lg fa-hacker-news', color: '#ff4000' },
        // { network: 'instapaper', name: 'Instapaper', icon: 'fas fah fa-lg fa-italic', color: '#428bca' },
        // { network: 'line', name: 'Line', icon: 'fab fah fa-lg fa-line', color: '#00c300' },
        // { network: 'linkedin', name: 'LinkedIn', icon: 'fab fah fa-lg fa-linkedin', color: '#007bb5' },
        // { network: 'odnoklassniki', name: 'Odnoklassniki', icon: 'fab fah fa-lg fa-odnoklassniki', color: '#ed812b' },
        // { network: 'pocket', name: 'Pocket', icon: 'fab fah fa-lg fa-get-pocket', color: '#ef4056' },
        // { network: 'quora', name: 'Quora', icon: 'fab fah fa-lg fa-quora', color: '#a82400' },
        // { network: 'skype', name: 'Skype', icon: 'fab fah fa-lg fa-skype', color: '#00aff0' },
        // { network: 'sms', name: 'SMS', icon: 'far fah fa-lg fa-comment-dots', color: '#333333' },
        // { network: 'stumbleupon', name: 'StumbleUpon', icon: 'fab fah fa-lg fa-stumbleupon', color: '#eb4924' },
        // { network: 'telegram', name: 'Telegram', icon: 'fab fah fa-lg fa-telegram-plane', color: '#0088cc' },
        // { network: 'viber', name: 'Viber', icon: 'fab fah fa-lg fa-viber', color: '#59267c' },
        // { network: 'vk', name: 'Vk', icon: 'fab fah fa-lg fa-vk', color: '#4a76a8' },
        // { network: 'weibo', name: 'Weibo', icon: 'fab fah fa-lg fa-weibo', color: '#e9152d' },
        // { network: 'wordpress', name: 'Wordpress', icon: 'fab fah fa-lg fa-wordpress', color: '#21759b' },
        // { network: 'xing', name: 'Xing', icon: 'fab fah fa-lg fa-xing', color: '#026466' },
        // { network: 'yammer', name: 'Yammer', icon: 'fab fah fa-lg fa-yammer', color: '#0072c6' },
        // { network: 'fakeblock', name: 'Custom Network', icon: 'fab fah fa-lg fa-vuejs', color: '#41b883' }
      ]
    }
  },
  created() {
  },
  methods: {
    copied() {
      this.$toast.success({
        title:'Copied',
        message:"Copied to clipboard",
        position: this.$root.toastPosition,
        duration: 2000
      });
    },
    openModal(img) {
      this.$modal.show('ShareModal');
      this.title=img.name;
      this.description=img.description;
      this.url=this.$root.currentUrl+ '/gallery/' + img.id;
      this.media=this.$root.storageUrl + '/creators_images/' + img.id + '/500.jpg';
      this.hashtags='Artigram'+ img.tags.replace("/#/g", ",");
    },
    beforeOpen(event) {
      this.$root.clicked = true;
      this.hashtags='Artigram,'+this.$root.$refs.userGallery.tags.slice(0, 29).join(',');
      this.fhashtags=this.hashtags.substring(0,(135-this.title.length-this.twitterUser.length));
    },
    beforeClose(event) {
      this.$root.clicked = false;
    }
  }
}
</script>
