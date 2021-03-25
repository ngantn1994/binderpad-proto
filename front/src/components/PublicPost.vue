<template>
  <div class="public-post-wrapper">
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
    <div class="reaction-box">
      <div v-if="ownReaction === 0" class="love-box" @click="reactToPost()">
        <img class="love-icon" src="../assets/icons/heart_before.png"/>
        <div class="love-text">
          {{ reactionMsg }}
        </div>
      </div>
      <div v-else class="love-box" @click="reactToPost()">
        <img class="love-icon" src="../assets/icons/heart_after.png"/>
        <div class="love-text">
          {{ reactionMsg }}
        </div>
      </div>
      <div class="clear-both"></div>
    </div>
    <div v-if="userInfo && userInfo.user_id === post.owner_id"
      class="option" @click="toggleMenu()">
      ☰
    </div>
    <div :class="{'menu-wrapper': true, 'show': isMenuOpen, 'hidden': !isMenuOpen}">
      <div @click="toggleMenu()" class="menu-toggle"></div>
      <div class="menu-box">
        <div class="menu-item" @click="togglePopup()">
          Delete post
        </div>
      </div>
    </div>
    <div v-show="isPopupOpen" class="popup-wrapper">
      <div class="popup-box">
        <div class="popup-text">
          Are you sure you want to delete this post?<br>
          Title: {{post.title}}
        </div>
        <div class="popup-btn yes-btn" @click="deletePost()">Yes</div>
        <div class="popup-btn no-btn" @click="togglePopup()">No</div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

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
    userInfo() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    },
    togglePopup() {
      this.isMenuOpen = false;
      this.isPopupOpen = !this.isPopupOpen;
    },
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
    async reactToPost() {
      this.setLoadingStatus(true);
      /* eslint camelcase: 0 */
      const subject_id = this.post.id;
      const postReaction = {
        subject_id,
      };

      try {
        const resultReactionData = await axios.post('/api/reactToPost', postReaction);

        this.ownReaction = resultReactionData.data.ownReaction;
        this.reactionList = resultReactionData.data.reactionList;
        this.applyPostReaction();
        this.setLoadingStatus(false);
      } catch (err) {
        // Handle Error Here
        console.error(err);
        this.setLoadingStatus(false);
      }
    },
    applyPostReaction() {
      this.setLoadingStatus(true);
      this.reactionMsg = 'Love this post';
      let numberOfOthersLove = 0;

      if (this.ownReaction === 0) {
        numberOfOthersLove = this.reactionList.length;
        if (numberOfOthersLove > 0) {
          this.reactionMsg = `${numberOfOthersLove} user${numberOfOthersLove > 1 ? 's' : ''} loved this post`;
        }
      } else {
        numberOfOthersLove = this.reactionList.length - 1;
        if (numberOfOthersLove > 0) {
          this.reactionMsg = `You and ${numberOfOthersLove} user${numberOfOthersLove > 1 ? 's' : ''} loved this post`;
        } else {
          this.reactionMsg = 'You loved this post';
        }
      }
      this.setLoadingStatus(false);
    },
    async deletePost() {
      this.setLoadingStatus(true);
      const post = {
        id: this.post.id,
      };

      try {
        await axios.post('/api/deletePost', post);

        this.$router.go();
      } catch (err) {
        // Handle Error Here
        console.error(err);
        this.setLoadingStatus(false);
      }
    },
  },
  mounted() {
    this.applyPostReaction();
  },
  data() {
    return {
      ownReaction: this.post.ownReaction,
      reactionMsg: 'Love this post',
      reactionList: this.post.reaction,
      isMenuOpen: false,
      isPopupOpen: false,
    };
  },
};
</script>

<style scoped>
.public-post-wrapper {
  width: 100%;
  padding: 20px;
  padding-bottom: 0px;
  background-color: #FFF;
  box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%),
    0px 1px 3px 0px rgb(0 0 0 / 12%);
  box-sizing: border-box;
  position: relative;
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
  font-weight: bold;
  height: 50px;
  line-height: 50px;
  font-size: 120%;
}
.post-content {
  width: 100%;
  text-align: justify;
  padding-bottom: 10px;
  border-bottom: 1px solid #b3b3b3;
}
.reaction-box {
  width: 100%;
}
.love-box {
  float: left;
  cursor: pointer;
  padding-top: 10px;
  padding-bottom: 10px;
  border-bottom: 2px solid #fff;
}
.love-box:hover {
  border-bottom: 2px solid #33b4d7;
}
.love-icon {
  width: 20px;
  height: 20px;
  float: left;
}
.love-text {
  height: 20px;
  line-height: 20px;
  font-weight: bold;
  float: left;
  color: #33b4d7;
  padding-left: 5px;
}
.option {
  width: 20px;
  height: 20px;
  cursor: pointer;
  padding: 5px;
  position: absolute;
  top: 10px;
  right: 10px;
  color: #33b4d7;
}
.option:hover {
  background-color: #e7e4e4;
}
.menu-wrapper {
  z-index: 9999;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0px;
  left: 0px;
}
.menu-toggle {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0px;
  left: 0px;
}
.menu-box {
  position: absolute;
  top: 40px;
  right: 20px;
  width: 200px;
  background-color: #fff;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  z-index: 10000;
}
.menu-item {
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding-left: 20px;
  box-sizing: border-box;
  text-align: left;
  cursor: pointer;
}
.menu-item:hover {
  background-color: #e7e4e4;
}
.popup-wrapper {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0px;
  left: 0px;
  background: rgba(255, 255, 255, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
}
.popup-box {
  padding: 20px;
  width: fit-content;
  height: fit-content;
  background-color: #FFF;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  text-align: center;
}
.popup-text {
  font-weight: bold;
}
.popup-btn {
  padding: 5px;
  margin: 5px;
  display: inline-block;
  cursor: pointer;
}
.popup-btn:hover {
  opacity: 0.8;
}
.yes-btn {
  background-color: #5cb85c;
}
.no-btn {
  background-color: #d9534f;
}
.hidden {
  display: none;
}
.show {
  display: block;
}
</style>
