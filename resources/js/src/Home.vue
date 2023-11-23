<script>
export default {
    name: "Home",
    methods: {
        test() {
            axios.post('/api/auth/me', {},{
                headers: {
                    "Authorization": `Bearer ${localStorage.getItem('token')}`
                }
            }).then(r => {
                console.log(r);
            });
        }
    }
}
</script>

<template>
    <h1>HomeComponent</h1>
    <button v-on:click="test">Click</button>
</template>

<style scoped>

</style>
