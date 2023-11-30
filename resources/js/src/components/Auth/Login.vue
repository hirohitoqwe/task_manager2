<script lang="ts">
import {defineComponent} from "vue";
import router from "../../../router.ts";
import api from "../../../api";

export default defineComponent({
    name: "Login",
    data() {
        return {
            email: null,
            password: null
        }
    },
    methods: {
        login: function () {
            api.post('/api/auth/login', {
                email: this.email,
                password: this.password
            }).then(r => {
                localStorage.setItem('token', r.data.access_token)
                router.push({name: 'home', reload: true});
            }).catch(() => {
                router.go({name: 'login'});
            });
        }
    }
});
</script>

<template>
    <div class="login-form">
        <form>
            <div class="form-field">
                <label for="email">Email:</label>
                <input type="text" v-model="this.email" id="email" name="email">
            </div>
            <div class="form-field">
                <label for="password">Password:</label>
                <input v-model="this.password" type="password" id="password" name="password">
            </div>
            <button v-on:click.prevent="login" class="login-button">Войти</button>
        </form>
        <a class="register-link" href="/user/registration">Регистрация</a>
    </div>
</template>

<style scoped>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: Arial, sans-serif;
}

.login-form {
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.form-field {
    margin-bottom: 10px;
}

.form-field label {
    display: block;
}

.form-field input[type="text"],
.form-field input[type="password"] {
    width: 200px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.login-button {
    padding: 10px 20px;
    background-color: #4CAF50;
    border: none;
    color: white;
    border-radius: 3px;
    cursor: pointer;
}

.register-link {
    margin-top: 10px;
    color: #4CAF50;
    text-decoration: none;
}

</style>
