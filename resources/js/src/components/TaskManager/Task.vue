<script lang="ts">
import {defineComponent} from 'vue'
import Task from "../../entities/Task";
import constants from "../../constants"
import Header from "../Header.vue";
import api from "../../../api";
import TaskInfo from "./TaskInfo.vue";

export default defineComponent({
    name: "Task",
    components: {TaskInfo, Header},
    data() {
        return {
            tasks: Array<Task>,
            showFull: false,
            fullTask: null,
            newTask: new Task()
        }
    },
    methods: {
        createTask() {
            api.post(constants.CREATE_TASK, {
                title: this.newTask.title,
                description: this.newTask.description,
                user_id: this.$refs.Header.me.id,
            }).then((r) => {
                console.log(r.data);
                this.updateTasksList();
            })
        },
        updateTasksList() {
            api.get(constants.GET_TASK, {
                headers: {
                    "Authorization": `Bearer ${localStorage.getItem('token')}`
                }
            }).then(r => {
                this.newTask = new Task();
                this.tasks = r.data;
            })
        },
        deleteTask(id: number) {
            api.delete(constants.DELETE_TASK + id).then(() => {
                this.updateTasksList()
            })
        },
        getFullDescription(task) {
            this.fullTask = task;
            console.log(this.fullTask);
            this.showFull = true;
        },

        closeFullDescription() {
            this.showFull = false;
        },
    },
    mounted() {
        this.updateTasksList();
    }
})
</script>

<template>
    <Header ref="Header"/>
    <div class="content" :class="{ 'show-full': showFull }">
        <div><h1>Список задач</h1></div>
        <div class="task-item" v-for="task in this.tasks">
            <a href="#" v-on:click.prevent="getFullDescription(task)">{{ task.title }}</a>
            <a href="#" class="delete-task" v-on:click.prevent="deleteTask(task.id)">x</a>
            <div class="label" v-for="label in task.labels">
                <div class="label_{{label.id}}">
                    <h5>{{ label.name }}</h5>
                </div>
            </div>
            <div class="task-full" v-if="showFull">
                <TaskInfo v-bind:full-task="fullTask" @close="closeFullDescription">
                </TaskInfo>
            </div>
        </div>
    </div>
    <div class="create">
        <div class="form-group">
            <label for="taskName">Название задачи:</label>
            <input type="text" id="taskName" v-model="newTask.title" required>
            <textarea class="description" rows="10" cols="45" v-model="newTask.description"></textarea>
        </div>
        <button type="submit" v-on:click.prevent="createTask()">Создать задачу</button>
    </div>
</template>

<style scoped>

.content {
    max-width: 800px;
    margin-top: 20px;
    text-align: left;
    transition: margin-right 0.3s;
}

.show-full {
    margin-right: 300px; /* Измените значение под свои нужды, чтобы окно сдвигалось вправо */
}

.task-full {
    position: fixed;
    top: 0;
    right: -100%; /* Изначально окно находится за пределами экрана */
    width: 700px; /* Ширина окна занимает всю доступную ширину */
    height: 100%;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    padding: 20px;
    overflow-y: auto;
    transition: right 0.3s;
}

.show-full .task-full {
    right: 0; /* Показываем окно справа при активации класса show-full */
}

h1 {
    font-size: 28px;
    color: #333;
}

.task-item {
    margin: 10px 0;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: box-shadow 0.3s;
    position: relative;
}

.task-item:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.task-item a {
    text-decoration: none;
    color: #333;
    font-size: 18px;
}

.task-item a:hover {
    color: #4caf50;
}

.delete-task {
    color: #999;
    font-size: 16px;
    margin-left: 10px;
    background-color: transparent;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 10px;
}

.delete-task:hover {
    color: #f44336;
}

.label {
    margin-top: 10px;
}

.label h5 {
    font-size: 14px;
    background-color: #4caf50;
    color: #fff;
    padding: 4px 8px;
    margin: 0;
    display: inline-block;
    border-radius: 4px;
}

.task-full h1 {
    font-size: 24px;
    color: #333;
}

/*
CREATE BUTTON
 */
.create {
    max-width: 400px;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.description {
    margin-top: 5px;
    resize: none;
}

label {
    display: block;
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 8px;
    color: #333;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}
</style>
