import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle';
import 'bootstrap/dist/js/bootstrap.js';


const app = createApp(App);

app.config.productionTip = false;

axios.defaults.baseURL = 'http://localhost:8000/api';

app.use(router); // Use o roteador com a instância do aplicativo

app.mount('#app');
