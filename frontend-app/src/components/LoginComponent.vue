<template>
  <div id="flash-notification" class="notification-error" style="display: none;"></div>
  <div>
    <div class="card card-login">
      <h1 class="card-header">Login</h1>
      <form @submit.prevent="login">
        <label for="email">Email:</label>
        <input type="email" id="email" class="input" v-model="formData.email" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" class="input" v-model="formData.password" required>
        <br>
        <br>
        <div class="button-container">
          <button type="submit" class="btn-register-task">Login</button>
          <span class="button-space"></span>
          <button @click.prevent="redirectToRegister" class="btn-add">Registrar</button>
        </div>
      </form>
    </div>
  </div>
  <page-footer></page-footer>
</template>


<script>
import axios from 'axios';
import PageFooterView from '@/components/PageFooterComponent.vue';

export default {
  components: {
    'page-footer': PageFooterView
  },
  data() {
    return {
      formData: {
        email: '',
        password: ''
      }
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', this.formData);
        console.log('Usuário autenticado:', response.data);
        localStorage.setItem('token', response.data.access_token);

        this.$emit('login-success');
        this.$router.push('/dashboard');
      } catch (error) {
        const notification = document.getElementById('flash-notification');
        notification.textContent = 'Dados de login inválidos !';
        notification.style.display = 'block';

        setTimeout(() => {
          notification.style.display = 'none';
        }, 4000);
        console.error('Erro de autenticação:', error);
      }
    },
    redirectToRegister() {
      this.$router.push('/register');
    }
  },
};
</script>
