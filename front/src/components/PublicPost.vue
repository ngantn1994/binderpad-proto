<template>
  <div class="public-post">
    <div class="post-owner-box">
      <div class="owner-avatar">
        <img class="avatar-tiny" :src="`${getDefaultAvatarPath}/${post.owner.avatar}`"/>
      </div>
      <div class="owner-display-name">
        {{post.owner.display_name}}
      </div>
      <div class="post-created-date">
        {{post.created_date}}
      </div>
      <div class="clear-both"></div>
    </div>
    <div class="post-title" v-html="post.title"></div>
    <div class="post-content" v-html="post.content"></div>
  </div>
</template>

<script>
export default {
  name: 'PublicPost',
  props: {
    post: {
      type: Object,
      required: true,
      validator(value) {
        return 'title' in value && 'content' in value
          && 'owner' in value;
      },
    },
  },
  computed: {
    getDefaultAvatarPath() {
      return `${process.env.VUE_APP_PUBLIC_URL}/default_avatar`;
    },
  },
};
</script>

<style scoped>
.public-post {
  width: 100%;
  padding: 20px;
  background-color: #FFF;
  box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%),
    0px 1px 3px 0px rgb(0 0 0 / 12%);
}
.post-owner-box {
  width: 100%;
  padding-bottom: 10px;
  border-bottom: 1px solid #33b4d7;
}
.owner-avatar {
  float: left;
  width: 60px;
  height: 60px;
  border-radius: 60px;
  border: 2px solid #33b4d7;
  overflow: hidden;
}
.avatar-tiny {
  width: 60px;
  height: 60px;
}
.owner-display-name {
  height: 40px;
  line-height: 40px;
  font-weight: bold;
  float: left;
  padding-left: 20px;
  color: #33b4d7;
  width: calc(100% - 100px);
  text-align: left;
}
.post-created-date {
  height: 20px;
  line-height: 20px;
  float: left;
  padding-left: 20px;
  font-style: italic;
}

.clear-both {
  clear: both;
}

.post-title {
  width: 100%;
  text-align: left;
  border-bottom: 1px solid #b3b3b3;
  font-weight: bold;
  height: 50px;
  line-height: 50px;
}
.post-content {
  width: 100%;
  text-align: justify;
  padding-top: 10px;
}
</style>
