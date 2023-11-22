<script>

export default {
    name: "App",
}
</script>

<template>
    <div>
        <router-link :to="{name:'home'}">List</router-link>
        <router-link :to="{name:'registration'}">Registration</router-link>
        <router-link :to="{name:'login'}">Login</router-link>

        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
