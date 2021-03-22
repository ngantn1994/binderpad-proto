<template>
  <div class="home">
    <NewsFeed v-if="authenticated" msg="Welcome to Your Vue.js App"/>
    <LandingPage v-else msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
// @ is an alias to /src
import LandingPage from '@/components/LandingPage.vue';
import NewsFeed from '@/components/NewsFeed.vue';

export default {
  name: 'Home',
  components: {
    LandingPage,
    NewsFeed,
  },
  computed: {
    authenticated() {
      return this.$store.getters['auth/authenticated'];
    },
  },
};
</script>
