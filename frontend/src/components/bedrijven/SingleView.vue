<template>
  <Bedrijf :bedrijf=this.bedrijf></Bedrijf>
</template>

<script>
import axios from "axios";
import Bedrijf from "@/components/bedrijven/Bedrijf";

export default {
  name: "SingleView",
  created(){
    this.getRecentie()
  },
  components: {Bedrijf},
  props: {
    id: Number,
  },
  data(){
    return {
      bedrijf: {}
    }
  },
  methods: {
    async getRecentie() {
      await axios
          .get("bedrijven/" + this.id)

          .then((res) => { // eslint-disable-next-line vue/no-mutating-props
            this.bedrijf = res.data;
            console.log(res)
          })
    }
  },
}
</script>

<style scoped>

</style>