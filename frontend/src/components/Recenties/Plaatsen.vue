<template>
  <div class="container item">
    <h2>Plaats een recentie</h2>
    <b-form @submit="onSubmit" @reset="onReset">
      <b-form-group
          id="input-group-1"
          label="Naam van bedrijf:"
          label-for="input-1"
      >
        <b-form-input
            id="input-1"
            v-model="this.bedrijf['name']"
            placeholder="Bedrijf niet gevonden"
            type="text"
            disabled
        ></b-form-input>

      </b-form-group>

      <b-form-group
          id="input-group-2"
          label="Titel:"
          label-for="input-2"
      >
        <b-form-input
            id="input-2"
            v-model="form.title"
            placeholder="Titel van Recentie"
            type="text"
        ></b-form-input>

      </b-form-group>

      <b-form-group
          id="input-group-3"
          label="Beschrijving:"
          label-for="input-3"
      >
        <b-form-input
            id="input-3"
            v-model="form.beschrijving"
            placeholder="Wat is uw mening over dit bedrijf"
            type="text"
        ></b-form-input>
      </b-form-group>

      <b-form-group
          id="input-group-4"
          label="Sterren:"
          label-for="input-4"
      >
        <b-form-input
            id="input-4"
            v-model="form.rating"
            placeholder="Hoveel sterren geeft u dit bedrijf"
            type="number"
            min="1"
            max="5"
        ></b-form-input>
      </b-form-group>

      <b-button type="reset" variant="danger">Reset</b-button>
      <b-button v-if="this.bedrijf['name']" type="submit" variant="primary">Plaatsen</b-button>
    </b-form>
  </div>
</template>

<script>
import axios from "axios";
import {BButton, BForm, BFormGroup, BFormInput} from "bootstrap-vue-3";

export default {
  name: "Plaatsen",
  components: {BForm, BButton, BFormInput, BFormGroup},
  props: {
    id: String,
  },
  data() {
    return {
      form: {
        beschrijving: '',
        rating: ''
      },
      bedrijf: {},
      currentUser: {},
    }
  },
  mounted() {
    this.getBedrijf();
    this.currentUser = this.$store.getters.getUser
    console.log( this.currentUser.id)
  },
  methods: {
    getBedrijf() {
      axios
          .get('bedrijven/' + this.id)
          .then((response) => {this.bedrijf = response.data })
    },
    onSubmit(){
      let json = {
        'bedrijfsId': this.bedrijf['id'],
        'userId': this.currentUser.id,
        'title': this.form.title,
        'beschrijving': this.form.beschrijving,
        'rating': this.form.rating
      }
      axios
          .post('recenties/create', json)
    },
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.bedrijf = this.bedrijf['name']
      // Trick to reset/clear native browser form validation state
      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    },
  }
}
</script>

<style scoped>
.item {
  margin: 10px auto;
  padding: 10px;
  background-color: #262739;
  color: white;
  width: 75%;
}
</style>