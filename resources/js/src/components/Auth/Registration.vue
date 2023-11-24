<script lang="ts">

import router from "../../../router.ts";
import axios from "axios";
import {defineComponent} from "vue";

export default defineComponent({
    name: "Registration",
    data() {
        return {
            name: "test",
            email: "test",
            password: "test",
            password_confirmation: "test"
        }
    },

    methods: {
        registration: function () {
            axios.post('/api/user/registration', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            }).then(r => {
                console.log('success register', r)
                router.push({name: 'login'});
            })
        }
    }
});
</script>

<template>
    <div class="register-form">
        <form>
            <div class="form-field">
                <label for="username">Имя пользователя:</label>
                <input type="text" id="username" v-on="name" name="username">
            </div>
            <div class="form-field">
                <label for="email">Email:</label>
                <input type="email" v-on="email" id="email" name="email">
            </div>
            <div class="form-field">
                <label for="password">Пароль:</label>
                <input type="password" v-on="password" id="password" name="password">
            </div>
            <div class="form-field">
                <label for="confirm-password">Подтверждение пароля:</label>
                <input type="password" v-on="password_confirmation" id="confirm-password" name="confirm-password">
            </div>
            <button v-on:click.prevent="registration" class="register-button">Зарегистрироваться</button>
        </form>
        <a class="login-link" href="/login">Войти</a>
    </div>
</template>

<style scoped>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.register-form {
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
.form-field input[type="email"],
.form-field input[type="password"] {
    width: 200px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.register-button {
    padding: 10px 20px;
    background-color: #4CAF50;
    border: none;
    color: white;
    border-radius: 3px;
    cursor: pointer;
}

.login-link {
    margin-top: 10px;
    color: #4CAF50;
    text-decoration: none;
}
</style>
