<template>
  <div class="site-header">
    <img class="site-logo" src="../assets/logo_white.png"/>
    <div class="avatar-box">
      <div class="avatar-icon" @click="toggleMenu()">
        <img class="avatar-small" src="../assets/default_avatar.png"/>
      </div>
    </div>
    <p class="clear-both"></p>
    <div :class="{'menu-wrapper': true, 'show': isMenuOpen, 'hidden': !isMenuOpen}">
      <div @click="toggleMenu()" class="menu-toggle"></div>
      <div class="menu-arrow"></div>
      <div class="menu-box" @click="toggleMenuItem()">
        <div class="menu-item">
          Profile
        </div>
        <div class="menu-item">
          Settings
        </div>
        <div class="menu-item last-item" @click="performSignOut()">
          Log Out
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SiteHeader',
  data() {
    return {
      isMenuOpen: false,
    };
  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    },
    toggleMenuItem() {
      console.log('test');
    },
    async performSignOut() {
      await this.$store.dispatch('auth/signOut');
    },
  },
};
</script>

<style scoped>
.site-header {
  background-color: #33B4D7;
  height: 50px;
  line-height: 60px;
  width: 100%;
  position: fixed;
  top: 0px;
  left: 0px;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  z-index: 999;
}
.site-logo {
  float: left;
  padding-left: 10px;
}
.avatar-box {
  height: 50px;
  float: right;
  padding-right: 10px;
  position: relative;
}
.avatar-icon {
  position: relative;
  width: 36px;
  height: 36px;
  border-radius: 40px;
  border: 2px solid #e2e8f0;
  overflow: hidden;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  cursor: pointer;
  margin-top: 5px;
}
.avatar-small {
  max-width: 100%;
}
.clear-both {
  clear: both;
}
.menu-wrapper {
  z-index: 9999;
  width: 100vw;
  height: 100vh;
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
  top: 55px;
  right: 10px;
  width: 200px;
  background-color: #e2e8f0;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  z-index: 10000;
}
.menu-arrow {
  border: 10px solid #e2e8f0;
  border-color: transparent transparent #e2e8f0 transparent;
  position: absolute;
  top: 35px;
  right: 20px;
  z-index: 10001;
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
  background-color: #33b4d7;
  color: #fff;
}
.last-item {
  border-top: 1px solid #b3b3b3;
}
.hidden {
  display: none;
}
.show {
  display: block;
}
</style>
