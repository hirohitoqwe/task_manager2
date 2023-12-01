import axios from "axios";
import router from "./router";

const api = axios.create();
api.interceptors.request.use(config => {
    console.log("We are in interceptors");
    if (localStorage.getItem('token')) {
        console.log("We have token");
        config.headers = {
            "Authorization": `Bearer ${localStorage.getItem('token')}`,
            "Accept": "application/json"
        }
    }
    return config;
}, () => {
});

api.interceptors.response.use(config => {
    if (localStorage.getItem('token')) {
        config.headers = {
            "Authorization": `Bearer ${localStorage.getItem('token')}`,
            "Accept": "application/json"
        }
    }
    return config;
}, (error) => {
    if (error.response.status === 401) {
        localStorage.removeItem('token');
        router.push({name: 'login'});
    }
});


export default api;
