import { createApp } from 'vue'
import App from './App.vue'
import axios from "axios";
import { createRouter, createWebHistory } from 'vue-router'

import {BootstrapVue3} from "bootstrap-vue-3";
import Vuex from "vuex";

import store from '@/store';
import Home from './components/Home.vue';
import Login from '@/components/Login';
import Logout from "@/components/logout";
import SingleView from "@/components/Recenties/SingleView";
import BedrijvenSingleView from "@/components/bedrijven/SingleView";
import BedrijvenOverzichtView from "@/components/bedrijven/BedrijvenOverzichtView";
import Plaatsen from "@/components/Recenties/Plaatsen";
import newAccount from "@/components/gebruikers/newAccount";
import User from "@/components/gebruikers/user";
import AllUsers from "@/components/admin/AllUsers";
import LoginBedrijf from "@/components/LoginBedrijf";

axios.defaults.baseURL = 'http://localhost:8082/';
axios.defaults.headers.common['Authorization'] = `Bearer ${store.state.token}`;

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/bedrijven/login', component: LoginBedrijf },
    { path: '/logout', component: Logout },
    { path: '/recenties/single/:id', component: SingleView, props: true  },
    { path: '/recenties/plaatsen/:id', component: Plaatsen, props: true },
    { path: '/bedrijven', component: BedrijvenOverzichtView },
    { path: '/bedrijven/single/:id', component: BedrijvenSingleView, props: true },
    { path: '/create-account', component: newAccount },
    { path: '/users/:id', component: User, props: true },
    { path: '/admin/users', component: AllUsers },
    { path: '/admin/companys', component: AllUsers },

];

const router = createRouter({
    "history": createWebHistory(),
    routes
})

createApp(App)
    .use(store)
    .use(router)
    .use(Vuex)
    .use(BootstrapVue3)
    .mount('#app');