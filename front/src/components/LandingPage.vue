<template>
  <div class="landing-page-wrapper">
    <div class="landing-page">
      <div class="logo-container">
        <img src="../assets/logo.png"/>
      </div>
      <div class="page-description">
        Save your stories. Share them with people. Discover great things.
      </div>
      <div class="login-wrapper">
        <input type="text" id="email-input" class="login-input" placeholder="Email"/>
        <input type="password" id="password-input" class="login-input" placeholder="Password"/>
        <input type="submit" id="submit-btn" class="login-btn" value="Log In"
          @click="performLogin()"/>
        <div class="separated-line"></div>
        <input type="submit" id="register-btn" class="login-btn" value="Create new account"
          @click="performLogin()"/>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'LandingPage',
  props: {
    msg: String,
  },
  mounted() {
    axios.get('/api/test')
      .then((result) => console.log(result))
      .catch(console.error);
  },
  methods: {
    performLogin() {
      const email = document.getElementById('email-input').value;
      const password = document.getElementById('password-input').value;

      console.log(email);
      console.log(password);

      axios.post('/api/', {
        email,
        password,
      })
        .then((response) => console.log(response))
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style scoped>
.landing-page-wrapper {
  width: 100%;
  min-height: 100vh;
  position: absolute;
  top: 0px;
  left: 0px;
  background: url('../assets/pattern/1.png') repeat;
}
.landing-page {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0px;
  left: 0px;
  background-color: rgba(226, 232, 240, 0.95);
  color: #212121;
  display: flex;
  flex-flow: column nowrap;
  align-items: center;
  justify-content: center;
}
.logo-container {
  width: fit-content;
  height: fit-content;
}
.page-description {
  padding: 10px;
  font-weight: bold;
}
.login-wrapper {
  box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%),
    0px 1px 3px 0px rgb(0 0 0 / 12%);
  background-color: #FFF;
  padding: 20px;
  width: 400px;
}
/** items style */
.login-input {
  width: 100%;
  height: 50px;
  outline-color: #33b4d7;
  border: 0px solid #dddfe2;
  padding-left: 20px;
  display: block;
  margin-bottom: 20px;
  color: #666;
  box-sizing: border-box;
  background-color: #FFF;
  box-shadow: 0px 0px 2px 0px #666666 inset;
}
.login-btn {
  width: 100%;
  height: 50px;
  background: #33b4d7;
  color: #FFF;
  font-weight: bold;
  line-height: 50px;
  text-align: center;
  outline-color: #33b4d7;
  border: 0px solid #dddfe2;
  cursor: pointer;
}
.login-btn:hover {
  opacity: 0.9;
}
.separated-line {
  width: 100%;
  border-bottom: 2px solid #dddfe2;
  margin-top: 20px;
  margin-bottom: 20px;
}
</style>
