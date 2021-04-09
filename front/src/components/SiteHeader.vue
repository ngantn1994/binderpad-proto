<template>
  <div class="site-header">
    <picture>
      <source srcset="../assets/logo_white_small.png" media="(max-width: 400px)">
      <source srcset="../assets/logo_white.png">
      <img class="site-logo" src="../assets/logo_white.png" @click="toHomePage()"/>
    </picture>
    <div class="header-nav-box" @click="toCreatePage()">
      <img class="nav-icon" src="../assets/icons/add.png"/>
      <div class="nav-title hide-on-mobile">
        Create
      </div>
    </div>
    <div v-if="userInfo" class="avatar-box">
      <div class="avatar-icon" @click="toggleMenu()">
        <img class="avatar-small" :src="`${getDefaultAvatarPath}/${userInfo.avatar}`"/>
      </div>
    </div>
    <p class="clear-both"></p>
    <div :class="{'menu-wrapper': true, 'show': isMenuOpen, 'hidden': !isMenuOpen}">
      <div @click="toggleMenu()" class="menu-toggle"></div>
      <div class="menu-arrow"></div>
      <div class="menu-box">
        <div class="menu-item" @click="toProfilePage()">
          Profile
        </div>
        <div class="menu-item" @click="toSettingsPage()">
          Settings
        </div>
        <div class="menu-item" @click="performSignOut()">
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
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    },
    async performSignOut() {
      this.setLoadingStatus(true);
      await this.$store.dispatch('auth/signOut');
      this.setLoadingStatus(false);
      this.toHomePage();
    },
    toHomePage() {
      if (this.$route.path !== '/') {
        this.setLoadingStatus(true);
        this.$router.push({
          name: 'Home',
        });
      }
    },
    toProfilePage() {
      if (this.$route.path !== '/profile') {
        this.setLoadingStatus(true);
        this.$router.push({
          name: 'Profile',
        });
      }
    },
    toSettingsPage() {
      if (this.$route.path.includes('/settings')) {
        this.setLoadingStatus(true);
        this.$router.push({
          name: 'ProfileSettings',
        });
      }
    },
    toCreatePage() {
      if (!this.$route.path.includes('/create')) {
        this.setLoadingStatus(true);
        this.$router.push({
          name: 'PostCreation',
        });
      }
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
  cursor: pointer;
}
.header-nav-box {
  height: 50px;
  width: fit-content;
  float: left;
  margin-left: 0px;
  line-height: 30px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  padding-left: 10px;
  padding-right: 10px;
  color: #FFF;
}
.header-nav-box:hover {
  background-color: #FFF;
  color: #33b4d7;
}
.nav-icon {
  height: 30px;
}
.nav-title {
  height: 30px;
  line-height: 30px;
  font-weight: bold;
  padding-left: 5px;
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
  border: 2px solid #fff;
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
  width: 100%;
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
  background-color: #fff;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  z-index: 10000;
}
.menu-arrow {
  border: 10px solid #fff;
  border-color: transparent transparent #fff transparent;
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
.menu-item:last-child {
  border-top: 1px solid #b3b3b3;
}
.hidden {
  display: none;
}
.show {
  display: block;
}
.hide-on-mobile {
  display: none;
}
@media only screen and (min-width: 600px) {
  .hide-on-mobile {
    display: block;
  }
  .header-nav-box {
    margin-left: 20px;
  }
}
</style>
