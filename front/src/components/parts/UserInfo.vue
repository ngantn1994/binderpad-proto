<template>
  <div v-if="userInfo" class="user-info">
    <div class="avatar-box">
      <div class="avatar-icon">
        <img class="avatar-big" :src="`${getDefaultAvatarPath}/${userInfo.avatar}`"/>
      </div>
      <div class="display-name-box">{{userInfo.display_name}}</div>
    </div>
    <div class="desc-box">
      {{userInfo.desc}}
      <div class="desc-arrow hide-on-mobile"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserInfo',
  props: {
    userInfo: {
      type: Object,
      required: true,
    },
  },
  methods: {
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
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
.user-info {
  width: 100%;
  position: relative;
  max-width: 900px;
  margin: auto;
  margin-top: 0px;
  display: flex;
  flex-flow: column nowrap;
  justify-content: space-between;
  align-items: center;
}
.avatar-box {
  width: calc(100% - 30px);
  max-width: 210px;
}
.avatar-icon {
  position: relative;
  width: 100%;
  max-width: 200px;
  max-height: 200px;
  border-radius: 200px;
  border: 5px solid #fff;
  overflow: hidden;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  cursor: pointer;
  margin-top: 5px;
}
.avatar-big {
  max-width: 100%;
}
.display-name-box {
  width: 100%;
  margin-top: 5px;
  margin-bottom: 5px;
  text-align: center;
  color: #33b4d7;
  font-weight: bold;
  font-size: 150%;
  text-shadow: 0 2px 1px rgb(0 0 0 / 20%);
}
.desc-box {
  width: calc(100% - 40px);
  max-width: 600px;
  background-color: #FFF;
  padding: 10px;
  text-align: justify;
  position: relative;
  box-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);
  min-height: 50px;
}
.desc-arrow {
  border: 30px solid #fff;
  border-color: transparent #fff transparent transparent;
  position: absolute;
  top: 50%;
  left: -60px;
  transform: translate(0%, -50%);
}
.hide-on-mobile {
  display: none;
}
@media only screen and (min-width: 900px) {
  .hide-on-mobile {
    display: block;
  }
  .user-info {
    width: 900px;
    flex-flow: row nowrap;
    margin-top: 20px;
  }
  .desc-box {
    width: calc(100% - 60px);
    padding: 20px;
  }
}
</style>
