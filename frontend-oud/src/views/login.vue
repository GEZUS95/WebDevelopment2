<template>
  <main class="form-login">
    <section>
      <div class="container">
        <div class="row">
            <b-form>
              <h1 class="h3 mb-3 fw-normal">Please Login</h1>
              <div class="mb-3">
                <label for="inputUsername" class="form-label">Username</label>
                <input
                    id="inputUsername"
                    type="text"
                    class="form-control"
                    v-model="username"
                />
              </div>
              <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="inputPassword"
                    v-model="password"
                />
              </div>
              <button type='button' @click="login()" class="btn btn-primary">Submit</button>
            </b-form>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import {BForm} from "bootstrap-vue-3";
import AuthService from "@/services/AuthService";
import axios from "@/axios-auth";

export default {
  name: "Login",
  components: {BForm},
  data() {
    return {
      username: "",
      password: "",
    };
  },
  methods: {
    async login() {
      try {
        const credentials = {
          username: this.username,
          password: this.password
        };
        const res = await AuthService.loginUser(credentials);
        axios.defaults.headers.common['Authorization'] = "Bearer" + res.data.token

        await this.$router.push('/home');
      } catch (error) {
        this.error = error.response.data
      }
    },
  },

};
</script>

<style scoped>

.form-login {
  width: 100%;
  max-width: 370px;
  padding: 15px;
  margin: auto;
}

.form-login .checkbox {
  font-weight: 400;
}

.form-login .form-floating:focus-within {
  z-index: 2;
}

html{
  background-color: #262739;
}

.form-login input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-login input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>