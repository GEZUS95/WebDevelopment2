import Vuex from 'vuex';
import Axios from 'axios';
//import createPersistedState from 'vuex-persistedstate';

const getDefaultState = () => {
    return {
        token: '',
        user: Object
    };
};

export default new Vuex.Store({
    strict: true,
    //plugins: [createPersistedState()],
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
        },
        SET_USER: (state, user) => {
            state.user = user;
        },
        RESET: state => {
            Object.assign(state, getDefaultState());
        }
    },
    actions: {
        setToken: ({ commit}, { token }) => {
            commit('SET_TOKEN', token);
            // set auth header
            Axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
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
        autoLogin: ({ commit }) => {
            const token = localStorage.getItem('token');
            const user = localStorage.getItem('user');
            if (token && user) {
                Axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                commit('SET_TOKEN', token);
                commit('SET_USER', user);
            }
}
    }
});