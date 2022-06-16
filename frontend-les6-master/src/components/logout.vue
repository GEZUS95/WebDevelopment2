<template>
<Logout></Logout>
</template>

<script>
export default {
  name: "logout",
  methods: {
    // logout through a store action
    logout() {
      this.$store.dispatch('logout')
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>

</style>