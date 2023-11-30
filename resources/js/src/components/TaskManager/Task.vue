<script lang="ts">
import {defineComponent} from 'vue'
import Task from "../../entities/Task";
import constants from "../../constants"
import Header from "../Header.vue";
import api from "../../../api";

export default defineComponent({
    name: "Task",
    components: {Header},
    data() {
        return {
            tasks: Array<Task>,
            showFull: Task as null,
            newTask: new Task()
        }
    },
    methods: {
        getFullDescription(task: Task) {
            this.showFull = task;
        },
        createTask() {
            api.post(constants.CREATE_TASK, {
                title: this.newTask.title
            }).then((r) => {
                console.log(r.data);
            })
        }
    },
    mounted() {
        api.get(constants.GET_TASK, {
            headers: {
                "Authorization": `Bearer ${localStorage.getItem('token')}`
            }
        }).then(r => {
            this.tasks = r.data;
        })
    }
})
</script>

<template>
    <Header/>
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
    <div class="create">
        <div class="form-group">
            <label for="taskName">Название задачи:</label>
            <input type="text" id="taskName" v-model="newTask.title" required>
        </div>
        <button type="submit" v-on:click.prevent="createTask()">Создать задачу</button>
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
