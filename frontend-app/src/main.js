import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';

const app = createApp(App);

app.config.productionTip = false;

axios.defaults.baseURL = 'http://localhost:8000/api';

app.use(router); // Use o roteador com a instância do aplicativo

app.mount('#app');
