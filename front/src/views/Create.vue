<template>
  <div class="page-container create">
    <SiteHeader/>
    <div class="relative-content-box">
      <div class="create-wrapper">
        <router-link class="create-card" :to="{name: 'PostCreation'}">
          <img class="create-icon" src="../assets/icons/add-post.png"/>
          <div class="create-title hide-on-mobile">Create new post</div>
        </router-link>
        <router-link class="create-card" :to="{name: 'BinderCreation'}">
          <img class="create-icon" src="../assets/icons/add-binder.png"/>
            <div class="create-title hide-on-mobile">Create new binder</div>
        </router-link>
        <div class="create-card">
          <img class="create-icon" src="../assets/icons/link-binders.png"/>
          <div class="create-title hide-on-mobile">Attach to binder</div>
        </div>
      </div>
      <div class="create-form-box">
        <router-view class="form-content"></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import SiteHeader from '@/components/SiteHeader.vue';

export default {
  name: 'Create',
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
  mounted() {
    this.setLoadingStatus(false);
  },
};
</script>

<style scoped>
.create {
  background-color: #e2e8f0;
}
.create-wrapper {
  width: 100%;
  max-width: 720px;
  margin: auto;
  position: relative;
}
.create-card {
  background-color: #fff;
  box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%),
    0px 1px 3px 0px rgb(0 0 0 / 12%);
  width: calc(33% - 10px);
  max-width: 200px;
  color: #33b4d7;
  cursor: pointer;
  display: inline-block;
  margin: 5px;
  border-bottom: 2px solid transparent;
  text-decoration: none;
  position: relative;
}
.create-card:hover {
  background-color: #33b4d7;
  color: #FFF;
}
.create-icon {
  width: calc(100% - 20px);
  max-width: 100px;
  margin: auto;
}
.create-title {
  padding-top: 10px;
  width: 100%;
  font-weight: bold;
  text-transform: uppercase;
}
.create-form-box {
  width: calc(100% - 50px);
  max-width: 660px;
  background-color: #fff;
  padding: 20px;
  box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%),
    0px 1px 3px 0px rgb(0 0 0 / 12%);
  margin: auto;
  margin-top: 10px;
}
.router-link-active {
  border-color: #33b4d7;
}
.hide-on-mobile {
  display: none;
}
@media only screen and (min-width: 620px) {
  .hide-on-mobile {
    display: block;
  }
  .create-card {
    padding: 10px;
    margin: 10px;
    width: calc(33% - 40px);
  }
  .create-form-box {
    width: calc(100% - 60px);
  }
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
  height: 300px;
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
