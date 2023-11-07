<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto"> <!-- Use a classe ms-auto para alinhar os itens à direita -->
            <li class="nav-item">
              <p v-if="user" class="nav-link">Bem-vindo, {{ user.name }}</p>
            </li>
            <li class="nav-item">
              <button v-if="user" @click="logout" class="btn btn-danger">Sair</button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
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
        const token = localStorage.getItem('token');
        axios.post('http://127.0.0.1:8000/api/logout', null, {
          headers: {
            'Authorization': 'Bearer ' + token,
          },
        })
          .then(() => {
            localStorage.removeItem('token');
            this.$router.push('/');
          })
          .catch((error) => {
            console.error('Erro ao fazer logout:', error);
          });
      },
    },
  };
  </script>
  