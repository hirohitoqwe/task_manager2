<script lang="ts">
import {defineComponent} from 'vue'
import Task from "../../entities/Task";
import axios from "axios";
import constants from "../../constants"

export default defineComponent({
    name: "Task",
    data() {
        return {
            tasks: [] as Task[],
            showFull: Task as null
        }
    },
    methods: {
        getFullDescription(task: Task) {
            this.showFull = task;
        }
    },
    mounted() {
        axios.get(constants.GET_TASK, {
            headers: {
                "Authorization": `Bearer ${localStorage.getItem('token')}`
            }
        }).then(r => {
            this.tasks = r.data;
            console.log(this.tasks);
        })
    }
})
</script>

<template>
    <div class="content">
        <div><h1>Список задач</h1></div>
        <div class="task-item" v-for="task in this.tasks">
            <a href="#" v-on:click.prevent="getFullDescription(task)">{{ task.title }}</a>
            <div class="label" v-for="label in task.labels">
                <div class="label_{{label.id}}">
                    <h5>{{ label.name }}</h5>
                </div>
            </div>
        </div>
        <div class="task-full" v-if="this.showFull">
            <h1>{{ showFull.description }}</h1>
        </div>
    </div>
</template>

<style scoped>

a {
    text-decoration: none;
    color: #1a202c;
}

.task-item {
    display: block;
}

.label_ * {
    border: 1px solid;
}
</style>
