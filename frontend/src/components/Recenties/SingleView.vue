<template>
  <Recentie :recentie=this.recentie></Recentie>
</template>

<script>
import Recentie from "@/components/Recenties/Recentie";
import axios from "axios";

export default {
  name: "SingleView",
  created(){
    this.getRecentie()
  },
  components: {Recentie},
  props: {
    id: Number,
  },
  data(){
    return {
      recentie: {}
    }
  },
  methods: {
    async getRecentie() {
      await axios
          .get("recenties/" + this.id)
          .then((res) => { // eslint-disable-next-line vue/no-mutating-props
            this.recentie = res.data;
          })
    },
  },

}
</script>

<style scoped>

</style>