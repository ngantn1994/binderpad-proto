<template>
  <div class="profile">
    <ProfilePage/>
  </div>
</template>

<script>
import ProfilePage from '@/components/profile/ProfilePage.vue';

export default {
  name: 'Profile',
  components: {
    ProfilePage,
  },
};
</script>

<style scoped>
.profile {
  clear: both;
}
</style>
