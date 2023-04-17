<template>
  <div class="item">
    <h2>Nieuw account aanmaken</h2>
    <b-form @submit="onSubmit" @reset="onReset">
      <b-form-group
          id="input-group-1"
          label="Gebruikers naam:"
          label-for="input-1"
      >
        <b-form-input
            id="input-1"
            v-model="form.name"
            placeholder="gebruikers naam"
            type="text"
            autocomplete="false"
        ></b-form-input>
      </b-form-group>

      <b-form-group
          id="input-group-2"
          label="Wachtwoord:"
          label-for="input-2"
      >
        <b-form-input
            id="input-2"
            v-model="form.password"
            placeholder="Wachtwoord"
            type="password"
            autocomplete="false"
        ></b-form-input>
      </b-form-group>

      <b-form-group
          id="input-group-3"
          label="Email:"
          label-for="input-3"
      >
        <b-form-input
            id="input-3"
            v-model="form.email"
            placeholder="example@example.com"
            type="email"
        ></b-form-input>
      </b-form-group>

      <b-form-group
          id="input-group-4"
          label="Telefoon:"
          label-for="input-4"
      >
        <b-form-input
            id="input-4"
            v-model="form.phone"
            placeholder="00-00000000"
            type="tel"
        ></b-form-input>
      </b-form-group>

      <b-button type="reset" variant="danger">Reset</b-button>
      <b-button type="submit" variant="primary">Maak Account aan</b-button>
    </b-form>
  </div>

</template>

<script>
import {BButton, BForm, BFormGroup, BFormInput} from "bootstrap-vue-3";
import axios from "axios";

export default {
  name: "newAccount",
  components: {BForm, BButton, BFormInput, BFormGroup},
  data() {
    return {
      form: {
        password: '',
        name: '',
        email: '',
        phone:'',
      },
    }
  },
  methods:{
    onSubmit(){
      let json = {
        'password': this.form.password,
        'phone': this.form.phone,
        'email': this.form.email,
        'name': this.form.name,
      }
      axios
          .post('users', json)
          .then(this.$router.push('/login'))
    },
    onReset(){
      this.form.password = ''
      this.form.phone = ''
      this.form.email = ''
      this.form.name = ''
    }
  }
}
</script>

<style scoped>
</style>