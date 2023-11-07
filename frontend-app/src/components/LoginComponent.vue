<template>
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
        <button type="submit" class="btn">Login</button>
        <span class="button-space"></span>
        <button @click.prevent="redirectToRegister" class="btn btn-register">Registrar</button>
      </div>
    </form>
  </div>
</template>


<script>
import axios from 'axios';

export default {
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
        console.error('Erro de autenticação:', error);
      }
    },
    redirectToRegister() {
      this.$router.push('/register');
    }
  },
};
</script>
