import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'

import Home from './views/Home.vue';
import ProductList from './components/products/ProductList.vue';
import CreateProduct from './components/products/CreateProduct.vue';
import EditProduct from './components/products/EditProduct.vue';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'

import Bedrijven from './views/BedrijvenOverzichtView.vue'
import Login from "@/views/login";

const routes = [
    { path: '/', component: Home },
    { path: '/products', component: ProductList },
    { path: '/createproduct', component: CreateProduct },
    { path: '/editproduct/:id', component: EditProduct, props: true  },
    { path: '/bedrijven', component: Bedrijven },
    { path: '/login', component: Login }
];

const router = createRouter({
    "history": createWebHistory(),
    routes
})

const app = createApp(App);
app.use(router);
app.mount('#app');