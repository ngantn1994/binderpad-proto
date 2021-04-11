<template>
  <div class="binder-flow">
    <div v-if="binderList.length > 0" class="binders-container">
      <PublicBinder v-for="(binder, index) in binderList"
        class="public-binder" :key="index" :binder="binder"/>
    </div>
    <div class="binders-container" v-else>No binder found.</div>
  </div>
</template>

<script>
import axios from 'axios';
import PublicBinder from '@/components/PublicBinder.vue';

export default {
  name: 'BinderFlow',
  components: {
    PublicBinder,
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
    async getMyBinderList() {
      try {
        this.setLoadingStatus(true);
        const getAllPostData = await axios.get('/api/getMyBinder');

        this.binderList = getAllPostData.data.binderList;
        this.binderList.sort((a, b) => ((a.id > b.id) ? -1 : 1));
        this.setLoadingStatus(false);
      } catch (err) {
        // Handle Error Here
        console.error(err);
        this.setLoadingStatus(false);
      }
    },
    async getBinderListById() {
      try {
        this.setLoadingStatus(true);
        const info = {
          params: {
            userId: this.id,
          },
        };
        const getUserData = await axios.get('/api/getUserBinder', info);

        this.binderList = getUserData.data.binderList;
        this.binderList.sort((a, b) => ((a.id > b.id) ? -1 : 1));
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
      binderList: [],
    };
  },
  mounted() {
    if (this.id) {
      this.getBinderListById();
    } else {
      this.getMyBinderList();
    }
  },
};
</script>

<style scoped>
.binder-flow {
  width: 100%;
}
.public-binder {
  margin-bottom: 10px;
}
</style>
