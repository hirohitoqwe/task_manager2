<script lang="ts">
import {defineComponent} from 'vue'
import {useRoute} from "vue-router";

export default defineComponent({
    name: "Team",
    methods: {useRoute}
})
</script>

<template>
    {{useRoute().params.id}}
</template>

<style scoped>

</style>
