<template>
  <div class="profile-page container" v-if="creator && refresh" >
    <div class="header-links" >
      <a href="" @click.prevent="$router.push('/'+creator.username+'-bio-page')">View as visitor</a>
      <a href="" @click.prevent="$router.push('/admin')" >Return to dashboard</a>
    </div>
    <div class="top">
        <div class="avatar" >
          <img is-changed="0" :src="'/storage/creator_images/'+ creator.id+'.jpg'" alt="Avatar of creator">
          <p @click="uppy" class="">Change profile image</p>
        </div>
    </div>
    <div class="details row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="name">First name</label>
          <input class="form-control"  type="text" v-model="user.first_name"  >
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="name">Last name</label>
          <input class="form-control"  type="text" v-model="user.last_name" name="last_name">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="store_name">
            Shop name
          </label>
          <input class="form-control"  maxlength="25" v-model="creator.store_name" name="store_name" :placeholder="user.first_name + ' Shop'">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="store_name">
            Email address
          </label>
          <input class="form-control" disabled  :value="user.email"  >
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="name">Username</label>
          <input class="form-control"  type="text" v-model="creator.username">
          <div class="help-block text-secondary" style="float: left;">
            <a href="" @click.prevent="$router.push('/@'+creator.username)">https://artigram.me/@<strong>{{creator.username}}</strong></a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <a href="" @click.prevent="$router.push('/admin/reset-password')" class="reset">
          <i class="fas fa-key"></i> Reset Password
        </a>
      </div>

    </div>
    <div class="links">
      <div :class="['link', isDisable(links[name])? 'disabled' : '']" v-for="(social,name,index) in links" :key="index">
        <span class="name">{{name}} {{name!="Mail Box"? 'Link':''}}</span>
        <input @keyup="setLink($event,name,'url')" :value="links[name].url" placeholder="Https://www.url.com" />
        <div class="tune">
          <label class="switch-wrap" >
            <input v-if="refresh" @change="setLink($event,name,'status')" type="checkbox" :checked="links[name].status? true:false"  :disabled="isDisable(links[name])" />
            <div class="switch"></div>
          </label>
        </div>
        <a class="delete" href="" @click.prevent="deleteLink(name)">delete</a>
      </div>
    </div>
    <a href="#" @click.prevent="update" class="update btn purple" >Update</a></modal>

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
            links: {
                 'Instagram':{},
                 'Twitch':{},
                 'Facebook':{},
                 'Patreon':{},
                 'TikTok':{},
                 'Pinterest':{},
                 'Twitter':{},
                 'Tumblr':{},
                 'YouTube':{},
                 'Behance':{},
                 'Mail Box':{},
            },
            imgs: {},
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
          var $this=this;
          Object.keys(this.links).forEach(function(name) {
            $this.links[name]=(JSON.parse($this.creator[name.toLowerCase()]));
            if(!$this.links[name].url){
              $this.links[name].url='';
            }
          });
          this.refresh++;
        },
        uppy(){
            var uppy = window.Robodog.pick({
              providers: [ 'instagram', 'url', 'webcam', 'dropbox', 'google-drive', 'facebook', 'onedrive' ],
              restrictions:{
                maxNumberOfFiles:1,
                allowedFileTypes:['image/*', '.jpg', '.jpeg', '.png'],
              },
              waitForEncoding: true,
              params: {
                auth: { key: "83304bd5a09d4978a31cf3c4267a06c6" },
                "steps": {
                  "avatar": {
                    "robot": "/image/resize",
                    "use": ":original",
                    "format": "jpg",
                    "width": 300,
                    "height": 300,
                    "resize_strategy": "fillcrop"
                  },
                  "exported": {
                    "use": [
                      "avatar",
                    ],
                    "robot": "/s3/store",
                    "credentials": "s3_storage",
                    "path": (this.$root.isDev?'dev':'live')+"/test/"+this.creator.id+".jpg"
                  }
                }
              },
            }).then(function (assembly) {
              $('.avatar img').attr('src',assembly.results[0].ssl_url);
              $('.avatar img').attr('is-changed', 1);
            }).catch(console.error)
        },
        isDisable(link){
          return link.url=='';
        },
        deleteLink(name){
          this.links[name]['status']=0;
          this.links[name]['url']='';
          this.refresh++;
        },
        setLink(event,name,what){
          if(what=='status'){
            this.links[name][what]=event.target.checked? 1:0;
          }else{
            this.links[name][what]=event.target.value;
          }
          this.refresh++;
        },
        closeBioModal() {
          this.bio = this.oldBio;
        },
        update() {
          this.$ma.trackEvent({
            action: 'edit-profile',
            properties: {
              feature: 'edit profile',
              type: 'text-enterd',
            },
          });
          if(this.user.first_name==''){
            this.$toast.error({
              title: 'Missing field',
              message: 'Please Enter first name',
              position: this.$root.toastPosition,
            });
            return;
          }
          if(this.user.last_name==''){
            this.$toast.error({
              title: 'Missing field',
              message: 'Please Enter last name',
              position: this.$root.toastPosition,
            });
            return;
          }
          if(this.creator.store_name==''){
            this.$toast.error({
              title: 'Missing field',
              message: 'Please Enter shop name',
              position: this.$root.toastPosition,
            });
            return;
          }
          if(this.creator.username==''){
            this.$toast.error({
              title: 'Missing field',
              message: 'Please Enter username',
              position: this.$root.toastPosition,
            });
            return;
          }
          Api.post('/api/set-profile', {
            'creatorId': this.creator.id,
            'first_name':this.user.first_name,
            'last_name':this.user.last_name,
            'store_name':this.creator.store_name,
            'username':this.creator.username,
            'links':this.links,
            'imgChanged':$('.avatar img').attr('is-changed'),
          })
          .then(response => {
            this.$toast.success({
              title: 'Update succeeded',
              message: 'Profile was updated',
              position: this.$root.toastPosition,
            });
          });
        },
      },
      created() {

      },
      mounted() {
      }
    };
    </script>
