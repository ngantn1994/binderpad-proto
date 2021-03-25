<template>
  <div class="page-container settings-container">
    <SiteHeader/>
    <div class="settings-nav">
      <router-link class="settings-link" :to="{name: 'ProfileSettings'}">
        <div class="settings-nav-item">
          Profile Settings
        </div>
      </router-link>
      <router-link class="settings-link" :to="{name: 'AccountSettings'}">
        <div class="settings-nav-item">
          Account Settings
        </div>
      </router-link>
    </div>
    <router-view class="settings-box"></router-view>
  </div>
</template>

<script>
import SiteHeader from '@/components/SiteHeader.vue';

export default {
  name: 'Settings',
  components: {
    SiteHeader,
  },
  methods: {
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
  },
};
</script>

<style scoped>
.settings-container {
  background-color: #e2e8f0;
}
.settings-nav {
  position: absolute;
  top: 70px;
  left: 20px;
  background-color: #fff;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  width: 200px;
}
.settings-nav-item {
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding-left: 20px;
  box-sizing: border-box;
  text-align: left;
  cursor: pointer;
}
.settings-nav-item:hover {
  background-color: #33b4d7;
  color: #fff;
}
.settings-nav .settings-nav-item:not(:first-child) {
  border-top: 1px solid #b3b3b3;
}
.settings-link {
  color: #000;
  text-decoration: none;
}
.router-link-active {
  font-weight: bold;
}
.settings-box {
  position: absolute;
  top: 70px;
  right: 20px;
  width: calc(100% - 260px);
  background-color: #fff;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  box-sizing: border-box;
  padding: 20px;
}
</style>

<style>
.form-item-box {
  width: 100%;
  padding-top: 5px;
  padding-bottom: 5px;
}
.form-item-box-last {
  width: 100%;
  padding-top: 10px;
  padding-bottom: 0px;
}
.form-item-label {
  width: 100%;
  font-weight: bold;
  text-align: left;
  padding-bottom: 5px;
  text-align: left;
}
.form-item-input {
  width: 100%;
  outline-color: #33b4d7;
  border: 0px solid #dddfe2;
  display: block;
  color: #666;
  box-sizing: border-box;
  background-color: #FFF;
  box-shadow: 0px 0px 2px 0px #666666 inset;
  text-align: left;
}
.form-item-input-single-line {
  height: 30px;
  line-height: 30px;
  padding-left: 5px;
  text-overflow: ellipsis;
  overflow: hidden;
}
.form-item-input-single-line * {
  display: inline;
}
.form-item-input-area {
  height: 100px;
  padding: 5px;
  overflow: auto;
}
.form-submit {
  width: 100%;
  height: 50px;
  line-height: 50px;
  text-align: center;
  color: #FFF;
  background-color: #33b4d7;
  cursor: pointer;
  opacity: 1;
}
.form-submit:hover {
  opacity: 0.9;
}
</style>
