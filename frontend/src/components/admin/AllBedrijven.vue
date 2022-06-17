<template>
  <div v-for="bedrijf in this.bedrijven" :key="bedrijf.id">
    <Bedrijf :bedrijf="bedrijf"></Bedrijf>
  </div>
</template>

<script>
import axios from "axios";
import Bedrijf from "@/components/bedrijven/Bedrijf";

export default {
  name: "AllBedrijven",
  components: {Bedrijf},
  methods: {
    getAll() {
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
    this.getAll()
  }
}
</script>

<style scoped>

</style>