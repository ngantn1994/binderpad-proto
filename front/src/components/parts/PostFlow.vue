<template>
  <div class="post-flow">
    <div v-if="postList.length > 0" class="posts-container">
      <PublicPost v-for="(post, index) in postList"
        class="public-post" :key="index" :post="post"/>
    </div>
    <div class="post-empty" v-else>No post found.</div>
  </div>
</template>

<script>
import axios from 'axios';
import PublicPost from '@/components/PublicPost.vue';

export default {
  name: 'PostFlow',
  components: {
    PublicPost,
  },
  props: {
    id: {
      type: [Number, String],
      required: false,
    },
  },
  methods: {
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
    async getMyPostList() {
      try {
        this.setLoadingStatus(true);
        const getAllPostData = await axios.get('/api/getMyPost');

        this.postList = getAllPostData.data.postList;
        this.postList.sort((a, b) => ((a.id > b.id) ? -1 : 1));
        this.setLoadingStatus(false);
      } catch (err) {
        // Handle Error Here
        console.error(err);
        this.setLoadingStatus(false);
      }
    },
    async getPostListById() {
      try {
        this.setLoadingStatus(true);
        const info = {
          params: {
            userId: this.id,
          },
        };
        const getUserData = await axios.get('/api/getUserPost', info);

        this.postList = getUserData.data.postList;
        this.postList.sort((a, b) => ((a.id > b.id) ? -1 : 1));
        this.setLoadingStatus(false);
      } catch (err) {
        // Handle Error Here
        console.error(err);
        this.setLoadingStatus(false);
      }
    },
  },
  data() {
    return {
      postList: [],
    };
  },
  mounted() {
    if (this.id) {
      this.getPostListById();
    } else {
      this.getMyPostList();
    }
  },
};
</script>

<style scoped>
.post-flow {
  width: 100%;
  position: relative;
}
.posts-container {
  width: calc(100% - 20px);
  max-width: 900px;
  margin: auto;
  padding-top: 0px;
}
.public-post {
  margin-bottom: 20px;
}
.hide-on-mobile {
  display: none;
}
.post-empty {
  color: #b3b3b3;
}
@media only screen and (min-width: 900px) {
  .hide-on-mobile {
    display: block;
  }
}
</style>
