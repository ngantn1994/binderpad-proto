<template>
  <div class="profile-settings">
    <div class="form-item-box">
      <div class="form-item-label">
        Display Name
      </div>
      <div class="form-item-input form-item-input-single-line" contenteditable="true"
        id="profile-display-name" v-html="userInfo.display_name"></div>
    </div>
    <div class="form-item-box">
      <div class="form-item-label">
        Short introduction about yourself
      </div>
      <div class="form-item-input form-item-input-area" id="profile-desc"
        contenteditable="true" v-html="userInfo.desc"></div>
    </div>
    <div class="form-item-box">
      <div class="form-item-label">
        Avatar
      </div>
      <div class="form-item-avatar-container">
        <div v-for="(avatar, index) in getAvatarList" :key="index" class="form-item-avatar">
          <img :src="getDefaultAvatarUrl(avatar)" :class="{'form-item-avatar-img': true,
            'form-item-avatar-current': avatar === chosenAvatar}"
            @click="chooseNewAvatar(avatar)"/>
        </div>
      </div>
    </div>
    <div class="form-item-box-last">
      <div class="form-submit" @click="updateProfile()">Update</div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: 'ProfileSettings',
  computed: {
    getAvatarList() {
      return [
        '1.png',
        '2.png',
        '3.png',
        '4.png',
        '5.png',
        '6.png',
        '7.png',
        '8.png',
        '9.png',
        '10.png',
      ];
    },
    userInfo() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    ...mapActions({
      submitProfileUpdate: 'auth/submitProfileUpdate',
    }),
    getDefaultAvatarUrl(filename) {
      return `${process.env.VUE_APP_PUBLIC_URL}/default_avatar/${filename}`;
    },
    chooseNewAvatar(avatar) {
      this.chosenAvatar = avatar;
    },
    async updateProfile() {
      /* eslint camelcase: 0 */
      const display_name = document.getElementById('profile-display-name').innerText;
      const desc = document.getElementById('profile-desc').innerText;
      const avatar = this.chosenAvatar;

      const userInfo = {
        display_name,
        desc,
        avatar,
      };
      await this.submitProfileUpdate(userInfo);
    },
  },
  data() {
    return {
      chosenAvatar: '',
    };
  },
  mounted() {
    this.chosenAvatar = this.userInfo.avatar;
  },
};
</script>

<style scoped>
.profile-settings {
  clear: both;
}
.form-item-avatar-container {
  width: 100%;
  display: flex;
  flex-flow: row wrap;
  justify-content: center;
}
.form-item-avatar {
  width: 100px;
  height: 100px;
  cursor: pointer;
  box-sizing: border-box;
  margin: 2px;
}
.form-item-avatar-img {
  max-width: 100%;
  border: 2px solid transparent;
}
.form-item-avatar-img:hover {
  border-color: #33b4d7;
}
.form-item-avatar-current {
  border-color: #b3b3b3;
}
</style>
