<template>
  <a class="recentie-item card" @click="this.$router.push('/recenties/single/' + this.recentie['id'])">
    <div class="card-header">
      <h2>{{ this.bedrijf['name'] }}</h2>
      <h3>{{ this.recentie['title'] }}</h3>
    </div>
    <div v-if="this.isSingle()" class="card-body">
      {{ this.recentie['description'] }}
      <p>Sterren: {{ this.recentie['rating'] }}</p>
    </div>
    <div class="card-footer">
      <p>geschreven door: {{ this.user['name'] }}</p>
    </div>
  </a>
  <div class="container recentie-item" v-if="this.isCompany()">

<!--    modal-->
    <h2>Reageer op deze recentie</h2>
      <b-form @submit="onSubmit" @reset="onReset" >
        <b-form-group
            id="input-group-1"
            label="Reactie:"
            label-for="input-1"
        >
          <b-form-textarea
              id="input-1"
              v-model="form.reaction"
              placeholder="Reageer"
              type="text"
          ></b-form-textarea>
        </b-form-group>

        <b-button type="reset" variant="danger">Reset</b-button>
        <b-button type="submit" variant="primary">Reageren</b-button>
      </b-form>
  </div>
</template>

<script>
import axios from "axios";
import {BForm, BButton, BFormGroup} from "bootstrap-vue-3";

export default {
  name: "Recentie",
  components: {BForm, BButton, BFormGroup},
  props: {
    recentie: Object,
  },
  data() {
    return {
      form:{
        reaction: ''
      },
      bedrijf: {},
      user: {},
      currentUser: {},
      show: false
    }
  },
  mounted() {
    this.getBedrijf();
    this.getUser();
    this.currentUser = this.$store.getters.getUser
  },
  methods: {
    getBedrijf() {
      axios
          .get('bedrijven/' + this.recentie['companyId'])
          .then((response) => this.bedrijf = response.data)
    },
    getUser() {
      axios
          .get('users/' + this.recentie['userId'])
          .then((res) => this.user = res.data)
    },
    isCompany() {
      if (this.currentUser['role'] === "Bedrijf") {
        return this.currentUser['id'] === this.bedrijf['id'];
      } else return false
    },
    onSubmit(event) {
      event.preventDefault()
      try {
        axios().post('recenties/' + this.recentie['id'], this.form.reaction)
      } catch (error) {
        this.error = error;
      }
    },
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.reaction = ''
      // Trick to reset/clear native browser form validation state
      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    },
    isSingle(){
      // checks if the url you requested has this string in it
      return window.location.href.indexOf("single") > -1
    },
  },
}
</script>

<style scoped>
.recentie-item {
  margin: 10px auto;
  padding: 10px;
  background-color: #262739;
  color: white;
  width: 75%;
}
</style>