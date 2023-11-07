import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../components/LoginComponent.vue';
import RegisterView from '../components/RegisterComponent.vue';
import DashboardView from '../components/DashboardComponent.vue';

const routes = [
  {
    path: '/',
    name: 'Login',
    component: LoginView
  },
  {
    path: '/register',
    name: 'Register',
    component: RegisterView
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardView,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
