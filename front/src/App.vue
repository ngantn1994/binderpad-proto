<template>
  <div id="app">
    <router-view/>
    <div v-show="isLoading" class="loading">
      <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="freepik">Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
  </div>
</template>

<script>
export default {
  name: 'App',
  methods: {
    setLoadingStatus(value) {
      this.$store.dispatch({
        type: 'setLoadingStatus',
        value,
      });
    },
  },
  computed: {
    isLoading() {
      return this.$store.getters.isLoading;
    },
  },
  async created() {
    this.setLoadingStatus(true);

    await this.$store.dispatch('auth/checkAuthentication');

    const authenticationStatus = this.$store.getters['auth/authenticated'];
    if (!authenticationStatus) {
      if (this.$route.path !== '/') {
        this.$router.push({
          name: 'Home',
        });
      }
    }

    this.setLoadingStatus(false);
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
.loading {
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0px;
  left: 0px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(255, 255, 255, 0.7);
  z-index: 99999;
}
/* CSS loader by loading.io */
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ellipsis div {
  position: absolute;
  top: 33px;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #33B4D7;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
}
.freepik {
  display: none;
}
.page-container {
  width: 100vw;
  min-height: 100vh;
  position: absolute;
  top: 0px;
  left: 0px;
}
.relative-content-box {
  width: 100%;
  padding-top: 70px;
}
</style>
