<template>
  <div class="item card">
    <div class="card-body">
      <h2>{{ this.gebruiker['name'] }}</h2>
      <p>email: {{ this.gebruiker['email'] }}</p>
      <p>role: {{ this.gebruiker['role'] }}</p>
      <p>tel: {{ this.gebruiker['phone'] }}</p>
      <div class="bedrijf" v-if="gebruiker['role'] === 'Bedrijf'">
        <p>beschrijving: {{ this.gebruiker['beschrijving'] }}</p>
      </div>
      <a class="btn btn-warning" v-if="this.gebruiker" @click="this.$router.push('/users/'+this.id+'/update/')" >Update user</a>
      <a class="btn btn-danger" v-if="this.$store.getters.getUser.role === 'Admin'" @click="this.delete()" >Delete user</a>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "user",
  props: {
    id: String
  },
  data() {
    return {
      gebruiker: {}
    }
  },
  methods: {
    getUser() {
      axios
          .get('users/' + this.id)
          .then((res) => this.gebruiker = res.data)
    },
    delete(){
      axios
          .delete('/users/'+this.id)
          .then(this.$router.go)
    }
  },
  beforeMount() {
    this.getUser()
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