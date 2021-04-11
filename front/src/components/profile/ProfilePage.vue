<template>
  <div class="page-container profile-page">
    <SiteHeader/>
    <div class="relative-content-box">
      <div v-if="userInfo">
        <UserInfo :userInfo="userInfo"/>
      </div>
      <FlowNav :navList="navList"/>
      <router-view class="flow-container"></router-view>
    </div>
  </div>
</template>

<script>
// import axios from 'axios';
import profileNavs from '@/data/profileNavs';
import SiteHeader from '@/components/SiteHeader.vue';
import UserInfo from '@/components/parts/UserInfo.vue';
import FlowNav from '@/components/parts/FlowNav.vue';

export default {
  name: 'ProfilePage',
  components: {
    SiteHeader,
    UserInfo,
    FlowNav,
  },
  methods: {
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
  },
  computed: {
    userInfo() {
      return this.$store.getters['auth/user'];
    },
  },
  data() {
    return {
      navList: profileNavs,
    };
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
