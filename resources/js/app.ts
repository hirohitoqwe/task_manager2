import './bootstrap';

import {createApp} from 'vue';
import App from "./src/components/App.vue";
import router from "./router";

const app = createApp(App).use(router)
app.mount('#app')

