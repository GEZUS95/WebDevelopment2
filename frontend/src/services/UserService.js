import axios from '@/axios-auth';

export default {
    getAll() {
        return axios
            .get('users')
            .then(response => response.data)
    },
    getOne(id){
        return axios
            .get('users/'+ id)
            .then(response => response.data)
    },
    updateOne(user){
        return axios
            .put("users/" + user['id'] + "/update")
            .then(response => response.data)
    },
    deleteOne(id){
        return axios
            .delete("users/" + id)
            .then(response => response.data)
    }
}