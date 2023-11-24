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
    <h1>Список задач</h1>
    <div class="task-item" v-for="task in this.tasks">
        <h1>{{ task.title }}</h1>
        <div class="labels" v-for="label in task.labels">
            {{ label.name }}
        </div>
    </div>
</template>

<style scoped>

.task-item {
    margin-bottom: 10px;
}

.add-label input[type="text"] {
    padding: 5px;
    width: 150px;
}

.add-label input[type="submit"] {
    padding: 5px 10px;
}
</style>
