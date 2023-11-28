<script lang="ts">

import {defineComponent} from "vue";
import Header from "./Header.vue";

export default defineComponent({
    name: "App",
    components: {Header},
});
</script>

<template>
    <div>
        <Header/>
        <router-view></router-view>
    </div>
</template>

<style scoped>
body {
    margin: 0;
}
</style>
