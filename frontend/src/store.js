import Vuex from 'vuex';
import Axios from 'axios';
import createPersistedState from 'vuex-persistedstate';

const token = localStorage.getItem('token');
const user = localStorage.getItem('user');

const getDefaultState = () => {
    Axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    return {
        token: token ? token: null,
        user: user ? user: null,

    };
};

export default new Vuex.Store({
    strict: true,
    plugins: [createPersistedState()],
    state: getDefaultState(),
    getters: {
        isLoggedIn: state => {
            return state.token;
        },
        getUser: state => {
            return state.user;
        },
    },
    mutations: {
        SET_TOKEN: (state, token) => {
            state.token = token;
            Axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        },
        SET_USER: (state, user) => {
            state.user = user;
        },
        RESET: state => {
            Object.assign(state, getDefaultState());
            state.user = {};
            state.token = '';
            Axios.defaults.headers.common['Authorization'] = '';
        }
    },
    actions: {
        setToken: ({ commit}, { token }) => {
            commit('SET_TOKEN', token);
            // set auth header

        },
        setUser: ({ commit}, { user }) => {
            commit('SET_USER', user);
        },
        logout: ({ commit }) => {
            commit('RESET');
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            localStorage.clear();
        },
}

});