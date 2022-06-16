<template>
  <section>
    <div class="container">
      <h2 class="mt-3 mt-lg-5">Products</h2>
      <button
        type="button"
        class="btn btn-primary mt-3"
        @click="this.$router.push('/createproduct')"
      >
        Add product
      </button>
      <div class="row mt-3">
        <product-list-item
          v-for="product in products"
          :key="product.id"
          :product="product"
          @update="loadProducts"
        />
      </div>
    </div>
  </section>
</template>

<script>
import axios from "../../axios-auth";
import ProductListItem from "./ProductListItem.vue";

export default {
  name: "ProductList",
  components: {
    ProductListItem,
  },
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    this.loadProducts();console.log(this.$store.getters.getUser)
  },
  methods: {
    loadProducts() {
      axios.get("/products").then((result) => {
        this.products = result.data;

      });
    },
  },
};
</script>

<style>
</style>