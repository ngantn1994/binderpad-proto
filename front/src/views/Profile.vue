<template>
  <div class="profile">
    <div v-if="userInfo">
      <UserPage v-if="id && id != userInfo.id" :id="id"/>
      <ProfilePage v-else/>
    </div>
  </div>
</template>

<script>
import ProfilePage from '@/components/profile/ProfilePage.vue';
import UserPage from '@/components/profile/UserPage.vue';

export default {
  name: 'Profile',
  components: {
    ProfilePage,
    UserPage,
  },
  props: {
    id: {
      type: [Number, String],
      required: false,
    },
  },
  computed: {
    userInfo() {
      return this.$store.getters['auth/user'];
    },
  },
};
</script>

<style scoped>
.profile {
  clear: both;
}
</style>
