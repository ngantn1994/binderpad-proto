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
        <div class="form-box"
          :class="{ 'current-content': !isRegister, 'hiding-content': isRegister }">
          <input type="email" id="email-input" class="login-input" placeholder="Email"/>
          <input type="password" id="password-input" class="login-input" placeholder="Password"/>
          <input type="submit" id="submit-btn" class="login-btn" value="Log In"
            @click="performLogin()"/>
          <div class="separated-line"></div>
          <input type="submit" id="register-btn" class="login-btn" value="Create new account"
            @click="openRegister()"/>
        </div>
        <div class="form-box"
          :class="{ 'current-content': isRegister, 'hiding-content': !isRegister }">
          <input type="text" id="username-register-input"
            class="login-input" placeholder="Username"/>
          <input type="email" id="email-register-input" class="login-input" placeholder="Email"/>
          <input type="password" id="password-register-input"
            class="login-input" placeholder="Password"/>
          <input type="password" id="repassword-register-input"
            class="login-input" placeholder="Retype password"/>
          <input type="submit" id="submit-btn" class="login-btn focus-btn" value="Register!"
            @click="performRegister()"/>
          <div class="separated-line"></div>
          <input type="submit" id="register-btn" class="login-btn" value="Back to login"
            @click="openLogin()"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { mapActions } from 'vuex';

const apiUrl = process.env.VUE_APP_API_URL;

export default {
  name: 'LandingPage',
  props: {
    msg: String,
  },
  mounted() {
    console.log(apiUrl);
    axios.get('/api/test')
      .then((result) => console.log(result))
      .catch(console.error);
  },
  methods: {
    ...mapActions({
      signIn: 'auth/signIn',
      register: 'auth/register',
    }),
    async performLogin() {
      const email = document.getElementById('email-input').value;
      const password = document.getElementById('password-input').value;

      const credentials = {
        email,
        password,
      };
      await this.signIn(credentials);
    },
    async performRegister() {
      const name = document.getElementById('username-register-input').value;
      const email = document.getElementById('email-register-input').value;
      const password = document.getElementById('password-register-input').value;
      /* eslint camelcase: 0 */
      const password_confirmation = document.getElementById('repassword-register-input').value;

      const credentials = {
        name,
        email,
        password,
        password_confirmation,
      };
      await this.register(credentials);
    },
    openRegister() {
      this.isRegister = true;
    },
    openLogin() {
      this.isRegister = false;
    },
  },
  data() {
    return {
      isRegister: false,
    };
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
  width: 400px;
  height: 500px;
  position: relative;
}
.form-box {
  box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%),
    0px 1px 3px 0px rgb(0 0 0 / 12%);
  background-color: #FFF;
  padding: 20px;
  transition: 500ms opacity ease-in-out;
  overflow: hidden;
  height: fit-content;
  width: 400px;
  max-width: 100%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.current-content {
  opacity: 1;
  visibility: visible;
}
.hiding-content {
  opacity: 0;
  visibility: hidden;
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
.focus-btn {
  background-color: #33d4b7;
  outline-color: #33d4b7;
}
.separated-line {
  width: 100%;
  border-bottom: 2px solid #dddfe2;
  margin-top: 20px;
  margin-bottom: 20px;
}
</style>
