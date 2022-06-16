<template>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <ul class="navbar-nav me-auto mr-auto  mb-2 mb-md-0">
        <li class="nav-item">
          <!-- Add a router link to the homepage (don't use the a tag!) -->
          <router-link to="/" class="nav-link" active-class="active">Home</router-link>
        </li>
        <li class="nav-item">
          <!-- add a router link to the products page (don't use the a tag!) -->
          <router-link to="/bedrijven" class="nav-link" active-class="active">Bedrijven</router-link>
        </li>
        <li v-if="this.user" class="nav-item">
          <!-- add a router link to the products page (don't use the a tag!) -->
          <router-link to="/login" class="nav-link" active-class="active">Login</router-link>
        </li>

        <li v-if="!this.user" class="nav-item">
          <!-- add a router link to the products page (don't use the a tag!) -->
          <router-link to="/users/{{this.user['id']}}" class="nav-link" active-class="active">{{ this.user['name'] }}</router-link>
        </li>

        <li v-if="!this.user" class="nav-item">
          <!-- add a router link to the products page (don't use the a tag!) -->
          <router-link to="/logout" class="nav-link" active-class="active">Logout</router-link>
        </li>
      </ul>

    </div>
  </nav>
</template>

<script>
export default {
  name: "Navigation",
  computed: {
    user() {
      return this.$store.getters.getUser
    }
  }
};
</script>

<style>
</style>