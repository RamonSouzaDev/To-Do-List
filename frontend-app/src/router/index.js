import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../components/LoginComponent.vue';
import RegisterView from '../components/RegisterComponent.vue';

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: LoginView
  },
  {
    path: '/register',
    name: 'Register',
    component: RegisterView
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
