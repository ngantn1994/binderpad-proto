<template>
  <div class="create-post">
    <div class="form-item-box">
      <div class="form-item-label">
        Post title
      </div>
      <div class="form-item-input form-item-input-single-line" contenteditable="true"
        id="post-title"></div>
    </div>
    <div class="form-item-box">
      <div class="form-item-label">
        Content
      </div>
      <div class="form-item-input form-item-input-area" id="post-content"
        contenteditable="true"></div>
    </div>
    <div class="form-item-box-last">
      <div class="form-submit" @click="createNewPost()">Post</div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'CreatePost',
  methods: {
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
    async createNewPost() {
      this.setLoadingStatus(true);
      const title = document.getElementById('post-title').innerText;
      const content = document.getElementById('post-content').innerText;

      const post = {
        title,
        content,
      };
      try {
        await axios.post('/api/createNewPost', post);
        this.$router.push({
          name: 'Profile',
        });
      } catch (err) {
        // Handle Error Here
        console.error(err);
        this.setLoadingStatus(false);
      }
    },
  },
};
</script>

<style scoped>
.create-post {
  clear: both;
}
</style>
