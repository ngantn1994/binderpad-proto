<template>
  <div class="page-container profile-page">
    <SiteHeader/>
    <div class="relative-content-box">
      profile
    </div>
  </div>
</template>

<script>
import SiteHeader from '@/components/SiteHeader.vue';

export default {
  name: 'ProfilePage',
  components: {
    SiteHeader,
  },
};
</script>

<style scoped>
.profile-page {
  background-color: #e2e8f0;
}
</style>
