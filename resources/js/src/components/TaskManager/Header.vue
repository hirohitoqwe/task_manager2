<script lang="ts">
import {defineComponent} from 'vue'
import axios from "axios";
import constants from "../../constants";
import router from "../../../router";

export default defineComponent({
    name: "Header",
    props:['me'],
    methods: {
        logout: () => {
            axios.post(constants.LOGOUT, {}, {
                headers: {
                    "Authorization": `Bearer ${localStorage.getItem('token')}`
                }
            }).finally(() => {
                localStorage.removeItem('token');
                router.push({name: "login"});
            });
        }
    },
})
</script>

<template>
    <header>
        <div class="user">{{ me.name }}</div>
        <div class="logo">Т2Т</div>
        <div class="dropdown">
            <button class="dropbtn">Мои команды</button>
            <div class="dropdown-content">
                <a href="#">Команда 1</a>
                <a href="#">Команда 2</a>
            </div>
        </div>
        <button class="logout" v-on:click="logout">Выйти</button>
    </header>
</template>

<style scoped>
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f2f2f2;
}

.logo {
    font-size: 24px;
}

.user {
    font-size: 16px;
}

.logout {
    padding: 8px 16px;
    background-color: #6a2e2e;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 10px;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: #f2f2f2;
    color: #000;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    z-index: 1;
}

.dropdown-content a {
    color: #000;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown:hover .dropdown-content {
    display: block;
}


</style>
