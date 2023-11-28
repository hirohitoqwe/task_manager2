<script lang="ts">
import {defineComponent} from 'vue'
import axios from "axios";
import constants from "../constants";
import router from "../../router";
import Me from "../entities/Me";
import {useRouter} from "vue-router";

export default defineComponent({
    name: "Header",
    data() {
        return {
            me: Me,
        }
    },
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
        },
    },
    mounted() {
        axios.post(constants.ME, {}, {
            headers: {
                "Authorization": `Bearer ${localStorage.getItem('token')}`
            }
        }).then((r) => {
            this.me = r.data;
        });
    },
})
</script>

<template>
    <header v-if="!$route.meta.hideNavigation">
        <router-link to="/home">
            <div class="logo">Т2Т</div>
        </router-link>
        <div class="user">{{ me.name }}</div>
        <div class="dropdown">
            <button class="dropbtn">Мои команды</button>
            <div class="dropdown-content">
                <div v-for="team in me.teams">
                    <router-link :to="`/team/${team.id}`">{{ team.name }}</router-link>
                </div>
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

a {
    text-decoration: none;
}

</style>
