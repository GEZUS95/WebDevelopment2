<template>
  <div class="recentie-item card">
    <div class="card-header">
      <h2>{{ this.bedrijf['name'] }}</h2>
      <p>{{ this.recentie['title'] }}</p>
    </div>
    <div class="card-body">
      {{this.recentie['beschrijving']}}
      {{this.recentie['rating']}}
    </div>
    <div class="card-footer">
      <p>geschreven door: {{this.user['name']}}</p>
    </div>
  </div>
</template>

<script>
import bedrijvenService from "@/services/BedrijvenService";
import userService from "@/services/UserService";
export default {
  name: "Recentie",
  props: {
    recentie: Object,
  },
  data() {
    return {
      bedrijf: {},
      user: {},
    }
  },
  mounted() {
    this.getBedrijf();
    this.getUser();
  },
  methods:{
    getBedrijf(){
      this.bedrijf = bedrijvenService.getOne(this.recentie['bedrijfsId'])
    },
    getUser(){
      this.user = userService.getOne(this.recentie['userId'])
    }
  }
}
</script>

<style scoped>

</style>