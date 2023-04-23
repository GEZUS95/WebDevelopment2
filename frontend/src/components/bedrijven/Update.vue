<template>
    <div class="item">
        <h2>Bedrijf updaten</h2>
        <b-form @submit="onSubmit" @reset="onReset">
            <b-form-group
                    id="input-group-1"
                    label="Naam:"
                    label-for="input-1"
            >
                <b-form-input
                        id="input-1"
                        v-model="form.name"
                        placeholder="gebruikers naam"
                        type="text"
                        autocomplete="false"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                    id="input-group-2"
                    label="Wachtwoord:"
                    label-for="input-2"
            >
                <b-form-input
                        id="input-2"
                        v-model="form.password"
                        placeholder="Wachtwoord"
                        type="password"
                        autocomplete="false"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                    id="input-group-3"
                    label="Email:"
                    label-for="input-3"
            >
                <b-form-input
                        id="input-3"
                        v-model="form.email"
                        placeholder="example@example.com"
                        type="email"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                    id="input-group-4"
                    label="Telefoon:"
                    label-for="input-4"
            >
                <b-form-input
                        id="input-4"
                        v-model="form.phone"
                        placeholder="00-00000000"
                        type="tel"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                    id="input-group-5"
                    label="Beschrijving:"
                    label-for="input-5"
            >
                <b-form-textarea
                        id="input-5"
                        v-model="form.description"
                        placeholder="Informatie over uw bedrijf"
                        type="text"
                ></b-form-textarea>
            </b-form-group>

            <b-button type="reset" variant="danger">Reset</b-button>
            <b-button type="submit" variant="primary">update bedrijf</b-button>
        </b-form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "update",
    props: {
        id: String
    },
    data() {
        return {
            form:
                {
                    id: '',
                    password: '',
                    name: '',
                    email: '',
                    phone: '',
                    description: '',
                }
        }
    },
    methods: {
        getCompany() {
            axios.get('bedrijven/' + this.id)
                .then((res) => {
                    this.form.id = res.data.id
                    this.form.name = res.data.name
                    this.form.email = res.data.email
                    this.form.phone = res.data.phone
                    this.form.description = res.data.beschrijving
                })
        },
        onSubmit() {
            console.log('submitting data')
            let json = {
                'id': this.form.id,
                'name': this.form.name,
                'password': this.form.password,
                'email': this.form.email,
                'phone': this.form.phone,
                'beschrijving': this.form.description,

            }
            axios.put('bedrijven/' + this.form.id, json)
                .then((res) => {
                    console.log(res.data)
                    this.$router.push('/bedrijven')
                })
        },
        onReset() {
            this.getCompany()
        }
    },
    mounted() {
        this.getCompany()
    }
}
</script>

<style scoped>

</style>