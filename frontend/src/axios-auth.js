import axios from 'axios';
import store from "@/store";

const instance = axios.create( {
    baseURL: 'http://localhost:8082/'
});

axios.defaults.headers.common['Authorization'] = `Bearer ${store.state.token}`;

export default instance;