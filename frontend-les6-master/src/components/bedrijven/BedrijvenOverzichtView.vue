<template>
  <h1 class="container">Overzicht van Bedrijven</h1>
  <div class="container" v-for="item in this.bedrijven" :key="item.id">
    <Bedrijf :bedrijf="item"></Bedrijf>
  </div>
</template>

<script>

import Bedrijf from "@/components/bedrijven/Bedrijf";
import axios from "axios";

export default {
  name: "BedrijvenOverzichtView",
  components: {Bedrijf},
  methods:{
    getAllBedrijven(){
      axios
          .get('bedrijven')
          .then((res) => this.bedrijven = res.data)
    }
  },
  data() {
    return {
      bedrijven: {}
    }
  },
  mounted() {
    this.getAllBedrijven();
  }
}
</script>

<style scoped>

</style>