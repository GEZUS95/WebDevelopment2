import axios from '@/axios-auth';

export default {
    loginUser(credentials) {
        return axios
            .post('login', credentials)
            .then(response => response);
    },
    loginBedrijf(credentials) {
        return axios
            .post('bedrijf/login', credentials)
            .then(response => response);
    },
    signUpUser(credentials) {
        return axios
            .post('users/signup', credentials)
            .then(response => response.data);
    },
    signUpBedrijf(credentials) {
        return axios
            .post('bedrijf/signup', credentials)
            .then(response => response.data);
    }
}