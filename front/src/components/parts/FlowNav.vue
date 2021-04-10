<template>
  <div class="flow-nav">
    <div class="top-line"></div>
    <div class="items-container">
      <router-link v-for="(navItem, index) in navList"
        class="nav-item" :key="index" :to="{name: navItem.name}">
        {{navItem.displayText}}
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FlowNav',
  props: {
    navList: {
      type: Array,
      required: true,
    },
  },
};
</script>

<style scoped>
.flow-nav {
  width: 100%;
  height: 30px;
  position: relative;
  padding-top: 20px;
  padding-bottom: 20px;
}
.top-line {
  width: 100%;
  max-width: 900px;
  border-top: 1px solid #b3b3b3;
  position: absolute;
  top: 20px;
  left: max(0px, calc(50% - 450px));
}
.items-container {
  width: 100%;
  max-width: 900px;
  position: absolute;
  top: 20px;
  left: max(0px, calc(50% - 450px));
  display: flex;
  flex-flow: row nowrap;
  justify-content: center;
}
.nav-item {
  width: 100px;
  padding-top: 10px;
  border-top: 1px solid #b3b3b3;
  color: #b3b3b3;
  text-decoration: none;
  font-weight: bold;
}
.router-link-exact-active {
  border-top: 1px solid #33b4d7;
  color: #33b4d7;
}
</style>
