import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";

const app = createApp(App);

app.use(router); // Use o roteador com a instância do aplicativo
app.mount('#app');

app.config.productionTip = false;
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/tasks';

app.component('paginate', VPagination);
