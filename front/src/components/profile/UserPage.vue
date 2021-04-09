<template>
  <div class="page-container profile-page">
    <SiteHeader/>
    <div class="relative-content-box">
      <div v-if="userInfo" class="profile-intro">
        <div class="avatar-box">
          <div class="avatar-icon">
            <img class="avatar-big" :src="`${getDefaultAvatarPath}/${userInfo.avatar}`"/>
          </div>
          <div class="display-name-box">{{userInfo.display_name}}</div>
        </div>
        <div class="desc-box">
          {{userInfo.desc}}
          <div class="desc-arrow hide-on-mobile"></div>
        </div>
      </div>
      <div v-if="postList.length > 0" class="posts-container">
        <PublicPost v-for="(post, index) in postList"
          class="public-post" :key="index" :post="post"/>
      </div>
      <div class="posts-container" v-else>You don't have any post yet.</div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import SiteHeader from '@/components/SiteHeader.vue';
import PublicPost from '@/components/PublicPost.vue';

export default {
  name: 'UserPage',
  components: {
    SiteHeader,
    PublicPost,
  },
  props: {
    id: {
      type: [Number, String],
      required: true,
    },
  },
  methods: {
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
    async updatePostList() {
      try {
        this.setLoadingStatus(true);
        const info = {
          params: {
            userId: this.id,
          },
        };
        const getUserData = await axios.get('/api/getUserPost', info);

        this.postList = getUserData.data.postList;
        this.userInfo = getUserData.data.userInfo;
        this.postList.sort((a, b) => ((a.id > b.id) ? -1 : 1));
        this.setLoadingStatus(false);
      } catch (err) {
        // Handle Error Here
        console.error(err);
        this.setLoadingStatus(false);
      }
    },
  },
  computed: {
    getDefaultAvatarPath() {
      return `${process.env.VUE_APP_PUBLIC_URL}/default_avatar`;
    },
  },
  data() {
    return {
      postList: [],
      userInfo: {},
    };
  },
  mounted() {
    this.setLoadingStatus(false);
    this.updatePostList();
  },
};
</script>

<style scoped>
.profile-page {
  background-color: #e2e8f0;
}
.profile-intro {
  width: 100%;
  max-width: 900px;
  margin: auto;
  margin-top: 0px;
  display: flex;
  flex-flow: column nowrap;
  justify-content: space-between;
  align-items: center;
}
.avatar-box {
  width: calc(100% - 30px);
  max-width: 210px;
}
.avatar-icon {
  position: relative;
  width: 100%;
  max-width: 200px;
  max-height: 200px;
  border-radius: 200px;
  border: 5px solid #fff;
  overflow: hidden;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  cursor: pointer;
  margin-top: 5px;
}
.avatar-big {
  max-width: 100%;
}
.display-name-box {
  width: 100%;
  margin-top: 5px;
  margin-bottom: 5px;
  text-align: center;
  color: #33b4d7;
  font-weight: bold;
  font-size: 150%;
  text-shadow: 0 2px 1px rgb(0 0 0 / 20%);
}
.desc-box {
  width: calc(100% - 40px);
  max-width: 600px;
  background-color: #FFF;
  padding: 10px;
  text-align: justify;
  position: relative;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  min-height: 50px;
}
.desc-arrow {
  border: 30px solid #fff;
  border-color: transparent #fff transparent transparent;
  position: absolute;
  top: 50%;
  left: -60px;
  transform: translate(0%, -50%);
}
.posts-container {
  width: calc(100% - 20px);
  max-width: 900px;
  margin: auto;
  padding-top: 0px;
}
.public-post {
  margin-top: 20px;
  margin-bottom: 20px;
}
.hide-on-mobile {
  display: none;
}
@media only screen and (min-width: 900px) {
  .hide-on-mobile {
    display: block;
  }
  .profile-intro {
    width: 900px;
    flex-flow: row nowrap;
    margin-top: 20px;
  }
  .posts-container {
    padding-top: 50px;
  }
  .desc-box {
    width: calc(100% - 60px);
    padding: 20px;
  }
}
</style>
