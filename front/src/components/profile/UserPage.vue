<template>
  <div class="page-container profile-page">
    <SiteHeader/>
    <div class="relative-content-box">
      <div v-if="userInfo">
        <UserInfo :userInfo="userInfo"/>
      </div>
      <FlowNav :navList="navList"/>
      <router-view class="flow-container" :id="id"></router-view>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import userNavs from '@/data/userNavs';
import SiteHeader from '@/components/SiteHeader.vue';
import UserInfo from '@/components/parts/UserInfo.vue';
import FlowNav from '@/components/parts/FlowNav.vue';

export default {
  name: 'UserPage',
  components: {
    SiteHeader,
    UserInfo,
    FlowNav,
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
    async updateUserInfo() {
      try {
        this.setLoadingStatus(true);
        const info = {
          params: {
            userId: this.id,
          },
        };
        const getUserData = await axios.get('/api/userprofile', info);

        // this.postList = getUserData.data.postList;
        this.userInfo = getUserData.data.userInfo;
        // this.postList.sort((a, b) => ((a.id > b.id) ? -1 : 1));
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
      navList: userNavs,
      postList: [],
      userInfo: {},
    };
  },
  mounted() {
    this.updateUserInfo();
  },
};
</script>

<style scoped>
.profile-page {
  background-color: #e2e8f0;
}
.flow-container {
  width: 100%;
  max-width: 900px;
  margin: auto;
  position: relative;
}
</style>
