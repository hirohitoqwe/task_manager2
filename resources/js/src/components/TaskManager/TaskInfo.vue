<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "TaskInfo",
    props: ['fullTask'],
    methods: {
        closeFullDescription() {
            this.$emit('close');
        }
    }
})
</script>

<template>
    <button class="close-button" @click.stop="closeFullDescription">x</button>
    <div class="task-container">
        <h1>{{ this.$props.fullTask.title }}</h1>
        <p>{{this.$props.fullTask.description}}</p>
    </div>
</template>

<style scoped>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.task-container {
    max-width: 800px;
    height: 80%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    justify-content: center;
}

h1 {
    color: #333;
}

p {
    color: #555;
}
</style>
