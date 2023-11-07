<template>
  <div>
    <h1>Dashboard</h1>
    <p v-if="user">Bem-vindo, {{ user.name }}</p>
    <button @click="logout">Sair</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: null,
    };
  },
  created() {
  const token = localStorage.getItem('token');
  console.log('Token JWT:', token);
  if (token) {
    axios.get('http://127.0.0.1:8000/api/user', {
      headers: {
        'Authorization': 'Bearer ' + token,
      },
    })
    .then((response) => {
      this.user = response.data;
    })
    .catch((error) => {
      console.error('Erro ao recuperar os dados do usuário:', error);
    });
  }
},
  methods: {
    logout() {
      localStorage.removeItem('token');
      this.$router.push({ name: 'login' });
    },
  },
};
</script>
