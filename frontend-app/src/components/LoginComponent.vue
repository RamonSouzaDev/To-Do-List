<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <label for="email">Email:</label>
      <input type="email" id="email" v-model="formData.email" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" v-model="formData.password" required>
      <br>
      <button type="submit">Login</button>
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
        this.$router.push('/dashboard');
      } catch (error) {
        console.error('Erro de autenticação:', error);
      }
    }
  }
};
</script>
