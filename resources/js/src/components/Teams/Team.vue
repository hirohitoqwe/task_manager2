<script lang="ts">
import {defineComponent} from 'vue'
import {useRoute} from "vue-router";
import constants from "../../constants";
import Team from "../../entities/Team";
import api from "../../../api";

export default defineComponent({
    name: "Team",
    methods: {useRoute},
    data() {
        return {
            info: Array<Team>
        }
    },
    mounted() {
        api.get(constants.GET_TEAM + useRoute().params.id, {
            headers: {
                "Authorization": `Bearer ${localStorage.getItem('token')}`
            }
        }).then((r) => {
            this.info = r.data;
            console.log(r.data);
        });
    }
})
</script>

<template>
    <Header/>
    {{ useRoute().params.id }}
    <div v-for="task in info.tasks">
        {{ task.title }}
    </div>
</template>

<style scoped>

</style>
