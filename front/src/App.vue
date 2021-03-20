<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App',
  components: {
  },
};
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Raleway&display=swap');

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  font-family: 'Raleway', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #212121;
  background-color: #e2e8f0;
}
</style>
