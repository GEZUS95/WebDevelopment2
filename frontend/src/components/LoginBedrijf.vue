<template>
  <section>
    <div class="container item">
      <h2>Inloggen Bedrijven</h2>
      <div class="row">
        <div class="">
          <form>
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
            <a @click="this.$router.push('/bedrijven/aanmaken')">Maak een nieuw bedrijf aan</a> <br>
            <button type="button" @click="login()" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <br>
      <a @click="this.$router.push('/login')">Bent u een Gebruiker log dan hier in</a>
    </div>
  </section>
</template>

<script>
import axios from "axios";

export default {
  name: "LoginBedrijf",
  data() {
    return {
      username: "",
      password: "",
      errorMessage: null,
    };
  },
  methods: {
    // login through a store action
    async login() {
      await axios
          .post('bedrijf/login', {username: this.username, password: this.password})
          .then((res) => {
            const resdata = res.data.token
            this.$store.commit('SET_TOKEN', resdata)
            localStorage.setItem('token', JSON.stringify(resdata))
            console.log("TOKEN:")
            console.log(this.$store.getters.isLoggedIn)

          })
      await axios
          .get('bedrijven/current')
          .then((res) => {
                const resdata = res.data.user
                this.$store.commit('SET_USER', resdata)
                localStorage.setItem('user', this.$store.getters.getUser)
                console.log("USER:")
                console.log(this.$store.getters.getUser)
              }
          );
      this.$router.push('/')
    },
  },
};
</script>

<style>
.item {
  margin: 10px auto;
  padding: 10px;
  background-color: #262739;
  color: white;
  width: 30%;
  text-align: center;
  border-radius: 10px;
}
</style>