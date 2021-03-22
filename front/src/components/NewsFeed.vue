<template>
  <div class="news-feed">
    <SiteHeader activeText="blobPost"/>
    Logged In!
  </div>
</template>

<script>
import SiteHeader from '@/components/SiteHeader.vue';

export default {
  name: 'NewsFeed',
  components: {
    SiteHeader,
  },
};
</script>

<style scoped>
.news-feed {
  width: 100vw;
  min-height: 100vh;
  position: absolute;
  top: 0px;
  left: 0px;
}
</style>
