<template>
  <h3>You are beeing logedout</h3>
</template>

<script>
export default {

  name: "logout",
  methods: {
    logout() {
      this.$store.dispatch("logout")
      this.$router.push('/')
    },
  },
  mounted() {
    this.logout()
  },
}
</script>

<style scoped>

</style>