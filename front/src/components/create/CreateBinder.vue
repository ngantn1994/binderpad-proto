<template>
  <div class="create-binder">
    <div class="form-item-box">
      <div class="form-item-label">
        Binder title
      </div>
      <div class="form-item-input form-item-input-single-line" contenteditable="true"
        id="binder-title"></div>
    </div>
    <div class="form-item-box">
      <div class="form-item-label">
        Binder Description
      </div>
      <div class="form-item-input form-item-input-area" id="binder-desc"
        contenteditable="true"></div>
    </div>
    <div class="form-item-box-last">
      <div class="form-submit" @click="createNewBinder()">Create Binder</div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'CreateBinder',
  methods: {
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
    async createNewBinder() {
      this.setLoadingStatus(true);
      const title = document.getElementById('binder-title').innerText;
      const desc = document.getElementById('binder-desc').innerText;

      const post = {
        title,
        desc,
      };
      try {
        await axios.post('/api/createNewBinder', post);
        this.$router.push({
          name: 'ProfileBinders',
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
.create-binder {
  clear: both;
}
</style>
