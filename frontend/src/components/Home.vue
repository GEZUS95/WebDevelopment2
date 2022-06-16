<template>
  <section>
    <div class="container">
      <h2 class="mt-3 mt-lg-5">Welcome to the homepage</h2>
    </div>
    <div class="container" v-for="item in this.recenties" :key="item.id">
      <Recentie :recentie="item"></Recentie>
    </div>
  </section>
</template>

<script>
import Recentie from '@/components/Recenties/Recentie'
import axios from "axios";

export default {
  name: "Home",
  components: {Recentie},
  methods: {
    getAllRecenties() {
      axios
          .get('recenties')
          .then((res) => {
            this.recenties = res.data;
          })
    }
  },
  data() {
    return {
      recenties: {}
    }
  },
  mounted() {
    this.getAllRecenties();
  }
};
</script>

<style>
</style>