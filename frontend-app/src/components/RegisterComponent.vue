<template>
  <div id="flash-notification-error" class="notification-error" style="display: none;"></div>
  <div id="flash-notification" class="notification" style="display: none;"></div>
  <div class="card card-login">
    <div class="card-header">Registrar</div>
    <div class="card-body">
      <form @submit.prevent="saveData">
        <label for="name">Nome completo</label>
        <input type="text" v-model="student.name" name="name" id="name" class="input" />

        <label for="email">E-mail</label>
        <input type="email" v-model="student.email" name="email" id="email" class="input" />

        <label for="password">Senha</label>
        <input type="password" v-model="student.password" name="password" id="password" class="input" />
        <br>
        <br>
        <div class="button-container">
          <input type="submit" value="Cadastrar" class="btn btn-register-task">
          <span class="button-space"></span>
          <button @click.prevent="redirectToLogin" class="btn-add">Login</button>
        </div>
      </form>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import '../assets/custom.css';

export default {
  name: 'RegisterComponent',
  data() {
    return {
      result: {},
      student: {
        name: '',
        email: '',
        password: ''
      }
    };
  },
  methods: {
    async saveData() {
      try {
        await axios.post("http://127.0.0.1:8000/api/register", this.student);
      const notification = document.getElementById('flash-notification');
      notification.textContent = 'Usuário cadastrado com sucesso !';
      notification.style.display = 'block';

      setTimeout(() => {
        notification.style.display = 'none';
      }, 4000);

  } catch (error) {
    if (error.response && error.response.status === 500) {
      const notification = document.getElementById('flash-notification-error');
      notification.textContent = 'Você deve preencher todos os campos!';
      notification.style.display = 'block';

      setTimeout(() => {
        notification.style.display = 'none';
      }, 4000);
    } else {
      console.error('Erro na requisição HTTP:', error);
    }
  }
    },
    redirectToLogin() {
      this.$router.push('/');
    }

  },

};
</script>
