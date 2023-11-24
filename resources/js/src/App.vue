<script lang="ts">

import axios from "axios";
import {defineComponent} from "vue";

export default defineComponent({
    name: "App",
    methods: {
        logout: () => {
            axios.post('/api/auth/logout', {}, {
                headers: {
                    "Authorization": `Bearer ${localStorage.getItem('token')}`
                }
            }).then((r: Response) => {
                localStorage.removeItem('token');
            });
        }
    }
});
</script>

<template>
    <div>
        <router-link :to="{name:'home'}">List</router-link>
        <router-link :to="{name:'registration'}">Registration</router-link>
        <router-link :to="{name:'login'}">Login</router-link>
        <button v-on:click="logout">Logout</button>
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
