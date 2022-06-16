import axios from '@/axios-auth';

export default {
    getAll() {
        return axios
            .get('bedrijven')
            .then(response => response.data)
    },
    getOne(id){
        return axios
            .get('bedrijven/'+ id)
            .then(response => response.data)
    },
    updateOne(bedrijf){
        return axios
            .put("bedrijven/" + bedrijf['id'] + "/update")
            .then(response => response.data)
    },
    deleteOne(id){
        return axios
            .delete("bedrijven/" + id)
            .then(response => response.data)
    }
}