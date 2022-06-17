<template>
  <div v-for="user in this.users" :key="user.id">
    <user :id="user['id']"></user>
  </div>
</template>

<script>
import axios from "axios";
import user from "@/components/gebruikers/user";

export default {
  name: "AllUsers",
  components: {user},
  methods: {
    getAll() {
      axios
          .get('users')
          .then((res) => this.users = res.data)
    }
  },
  data() {
    return {
      users: {}
    }
  },
  mounted() {
    this.getAll();
  }
}
</script>

<style scoped>

</style>