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
            console.log(res)
          })
    },
    showModal() {
      this.$refs['modal-1'].show()
    },
    hideModal() {
      this.$refs['modal-1'].hide()
    },
    toggleModal() {
      // We pass the ID of the button that we want to return focus to
      // when the modal has hidden
      this.$refs['modal-1'].toggle('#toggle-btn')
    }
  },

}
</script>

<style scoped>

</style>