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
    <h1>{{ this.$props.fullTask.title }}</h1>
    <textarea class="description" :value="this.$props.fullTask.description"></textarea>
    <button>Update</button>
</template>

<style scoped>
.description{
    resize: none;
}

.close-button {
    position: absolute;
    top: 10px;
    left: 10px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #333;
}
</style>
