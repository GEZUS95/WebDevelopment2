import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'

import store from '@/store';
import Home from './components/Home.vue';
import ProductList from './components/products/ProductList.vue';
import Login from '@/components/Login';
import EditProduct from './components/products/EditProduct.vue';
import axios from "axios";
import Logout from "@/components/logout";
import SingleView from "@/components/Recenties/SingleView";
import BedrijvenSingleView from "@/components/bedrijven/SingleView";
import BedrijvenOverzichtView from "@/components/bedrijven/BedrijvenOverzichtView";
import Plaatsen from "@/components/Recenties/Plaatsen";
import newAccount from "@/components/newAccount";

axios.defaults.baseURL = 'http://localhost:8082/';
axios.defaults.headers.common['Authorization'] = `Bearer ${store.state.token}`;

const routes = [
    { path: '/products', component: ProductList },
    { path: '/editproduct/:id', component: EditProduct, props: true  },
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/logout', component: Logout },
    { path: '/recenties/single/:id', component: SingleView, props: true  },
    { path: '/recenties/plaatsen/:id', component: Plaatsen, props: true },
    { path: '/bedrijven', component: BedrijvenOverzichtView },
    { path: '/bedrijven/single/:id', component: BedrijvenSingleView, props: true },
    { path: '/create-account', component: newAccount },

];

const router = createRouter({
    "history": createWebHistory(),
    routes
})

const app = createApp(App);
app.use(store);
app.use(router);
app.mount('#app');