<template>
  <navigation />
  <router-view />
  <!-- Add a router view -->
</template>

<script>
import Navigation from './components/Navigation.vue'

export default {
  name: "App",
  components: {
    Navigation
  },
  created() {
    this.$store.dispatch('autoLogin');
  }
};
</script>

<style>
</style>
