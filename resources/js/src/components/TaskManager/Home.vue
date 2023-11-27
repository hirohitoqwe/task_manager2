<script lang="ts">
import Header from "../Header.vue";
import Task from "./Task.vue";
import Me from "../../entities/Me.js";
import {defineComponent} from "vue";

import axios from "axios";
import constants from "../../constants";

export default defineComponent({
    name: "Home",
    components: {Task, Header},
    data() {
        return {
            me: Me
        }
    },
    mounted() {
        axios.post(constants.ME, {}, {
            headers: {
                "Authorization": `Bearer ${localStorage.getItem('token')}`
            }
        }).then((r) => {
            this.me = r.data;
        });
    }
});
</script>

<template>
    <div>
        <Header v-bind:me="me"/>
        <Task/>
    </div>
</template>

<style scoped>

</style>
