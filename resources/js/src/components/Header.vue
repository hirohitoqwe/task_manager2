<script lang="ts">
import {defineComponent} from 'vue'
import constants from "../constants";
import router from "../../router";
import Me from "../entities/Me";
import api from "../../api";

export default defineComponent({
    name: "Header",
    data() {
        return {
            me: Me,
            isPopupOpen: false,
            teamName: "",
        }
    },
    methods: {
        logout: () => {
            api.post(constants.LOGOUT).finally(() => {
                localStorage.removeItem('token');
                router.push({name: "login"});
            });
        },
        openPopup() {
            this.isPopupOpen = true;
        },
        closePopup() {
            this.isPopupOpen = false;
        },
        saveTeam() {
            api.post(constants.CREATE_TEAM, {
                name: this.teamName
            }).then(() => {
                this.refreshMe()
            });
            this.closePopup();
        },
        leaveFromTeam(id: number) {
            api.post(constants.LEAVE_TEAM, {
                team_id: id
            }).then(() => {
                this.refreshMe()
            });
            console.log(`delete with ${id}`)
        },
        refreshMe() {
            api.post(constants.ME).then((r) => {
                this.me = r.data;
            })
        }
    },
    mounted() {
        api.post(constants.ME).then((r) => {
            this.me = r.data;
        });
    }
    ,
})
</script>

<template>
    <header>
        <router-link to="/home">
            <div class="logo">Т2Т</div>
        </router-link>
        <div class="user">{{ me.name }}</div>
        <div class="dropdown">
            <button class="dropbtn">Мои команды</button>
            <div class="dropdown-content">
                <div v-for="team in me.teams">
                    <router-link :to="`/team/${team.id}`">
                        <span style="display: inline-block">{{ team.name }}
                        <a v-on:click.prevent="leaveFromTeam(team.id)">x</a></span>
                    </router-link>
                </div>
                <a class="createTeam" v-on:click="openPopup">Создать команду</a>
            </div>
        </div>
        <teleport to="body">
            <div v-if="isPopupOpen" class="popup">
                <div class="popup-content">
                    <h2>Добавить команду</h2>

                    <label for="teamName">Название команды:</label>
                    <input v-model="teamName" type="text" id="teamName" placeholder="Введите название"/>

                    <div class="button-container">
                        <button class="save-button" @click="saveTeam">Сохранить</button>
                        <button class="close-button" @click="closePopup">Закрыть</button>
                    </div>
                </div>
            </div>
        </teleport>
        <button class="logout" v-on:click="logout">Выйти</button>
    </header>
</template>

<style scoped>
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f2f2f2;
}

.logo {
    font-size: 24px;
}

.user {
    font-size: 16px;
}

.logout {
    padding: 8px 16px;
    background-color: #6a2e2e;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 10px;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: #f2f2f2;
    color: #000;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    z-index: 1;
}

.dropdown-content a {
    color: #000;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown:hover .dropdown-content {
    display: block;
}

a {
    text-decoration: none;
    cursor: pointer;
}

.createTeam {
    color: #4CAF50;
}

.popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    z-index: 999;
    max-width: 400px;
    width: 100%;
    border-radius: 8px;
    text-align: center;
    animation: fadeIn 0.3s ease-out;
}

.popup-content {
    text-align: center;
}

h2 {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.button-container {
    display: flex;
    justify-content: space-around;
}

.save-button,
.close-button {
    padding: 10px;
    width: 100px;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.save-button {
    background-color: #4caf50;
}

.close-button {
    background-color: #e74c3c;
}

.save-button:hover,
.close-button:hover {
    background-color: #45a049;
}

/* Анимация появления попапа */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

span {
    display: inline-block; /* Добавим этот стиль, чтобы span не переходил на новую строку */
    margin-right: 5px; /* Регулируйте отступ по вашему желанию */
}

</style>
