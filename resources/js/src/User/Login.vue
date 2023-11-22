<script>
import {useRouter} from "vue-router";

export default {
    name: "Login",

    data() {
        return {
            email: null,
            password: null,
        }
    },
    methods: {
        login() {
            axios.post('/api/auth/login', {
                email: this.email,
                password: this.password
            }).then(r => {
                localStorage.setItem('token', r.data.access_token)
                useRouter().push({})
                console.log(r);
            })
        }
    }
}
</script>

<template>
    <div class="row w-25 p-5 mx-auto">
        <input type="email" v-model="email" placeholder="email" class="form-control m-2">
        <input type="password" v-model="password" placeholder="password" class="form-control m-2">
        <input type="submit" @click.prevent="login" value="login" class="form-control  m-2">
    </div>
</template>

<style scoped>

</style>
