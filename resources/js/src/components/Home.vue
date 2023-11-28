<script lang="ts">
import Task from "./TaskManager/Task.vue";
import {defineComponent} from "vue";

export default defineComponent({
    name: "Home",
    components: {Task},
    data() {
    },
});
</script>

<template>
    <Task/>
</template>

<style scoped>

</style>
