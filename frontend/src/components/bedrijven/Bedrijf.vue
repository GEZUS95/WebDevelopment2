<template>
  <div class="bedrijf-item card" >
    <a  @click="this.$router.push('/bedrijven/single/' + this.bedrijf['id'])">
      <div class="card-header">
      </div>
      <div class="card-body">
        <h4>{{ this.bedrijf['name'] }}</h4>
        <p>{{ this.bedrijf['beschrijving'] }}</p>
        <div v-if="this.isSingle()">
          <p>email: {{ this.bedrijf['email'] }}</p>
          <p>telefoon: {{ this.bedrijf['phone'] }}</p>
        </div>
      </div>
    </a>
    <div class="card-footer">
      <a class="btn btn-primary" v-if="!this.isCompany()"
         @click="this.$router.push('/recenties/plaatsen/'+this.bedrijf['id'])" variant="primary">Recentie plaatsen</a>
    </div>
  </div>


</template>

<script>
// checks if the url you requested has this string in it
if (window.location.href.indexOf("single") > -1) {
  // do stuff
}

export default {
  name: "Bedrijf",
  props: {
    bedrijf: Object,
  },
  data() {
    return {
      currentUser: {}
    }
  },
  mounted() {
    this.currentUser = this.$store.getters.getUser
  },
  methods: {
    isCompany() {
      if (this.currentUser['role'] === "Bedrijf") {
        return this.currentUser['id'] === this.bedrijf['id'];
      } else return false
    },
    isSingle() {
      // checks if the url you requested has this string in it
      return window.location.href.indexOf("single") > -1
    }
  }
}
</script>

<style scoped>
.bedrijf-item {
  margin: 10px auto;
  padding: 10px;
  background-color: #262739;
  color: white;
  width: 75%;
}
</style>