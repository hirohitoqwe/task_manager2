<script lang="ts">

import {defineComponent} from "vue";

export default defineComponent({
    name: "App",
});
</script>

<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<style scoped>
body{
    margin: 0;
}
</style>
