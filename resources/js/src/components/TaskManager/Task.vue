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
        }
    },
    mounted: function () {
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
            <h4>{{ task.title }}</h4>
            <div class="label" v-for="label in task.labels">
                <div class="label_{{label.id}}">
                    {{ label.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

.task-item {
    display: block; /* каждый элемент как блок */
}
.label_*{
    border: 1px solid;
}
</style>
