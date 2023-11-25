<script>
import Header from "./Header.vue";
import Task from "./Task.vue";

export default {
    name: "Home",
    components: {Task, Header},
    methods: {
    }
}
</script>

<template>
    <Header/>
    <Task />
</template>

<style scoped>

</style>
