<template>
  <div class="page-container news-feed">
    <SiteHeader/>
    <div class="posts-container">
      <PublicPost v-for="(post, index) in postList"
        class="public-post" :key="index" :post="post"/>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import SiteHeader from '@/components/SiteHeader.vue';
import PublicPost from '@/components/PublicPost.vue';

export default {
  name: 'NewsFeed',
  components: {
    SiteHeader,
    PublicPost,
  },
  data() {
    return {
      postList: [],
    };
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
        const getAllPostData = await axios.get('/api/getAllPost');

        this.postList = getAllPostData.data.postList;
        this.postList.sort((a, b) => ((a.id > b.id) ? -1 : 1));
        this.setLoadingStatus(false);
      } catch (err) {
        // Handle Error Here
        console.error(err);
        this.setLoadingStatus(false);
      }
    },
  },
  mounted() {
    this.updatePostList();
  },
};
</script>

<style scoped>
.news-feed {
  background-color: #e2e8f0;
}
.posts-container {
  width: calc(100% - 40px);
  max-width: 900px;
  margin: auto;
  padding-top: 50px;
}
.public-post {
  margin-top: 20px;
  margin-bottom: 20px;
}
@media only screen and (min-width: 600px) {
/** for responsive content */
}
</style>
