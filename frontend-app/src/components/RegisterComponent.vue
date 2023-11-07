<template>
  <div class="card">
    <div class="card-header">Registrar</div>
    <div class="card-body">
      <form @submit.prevent="saveData">
        <label for="name">Nome completo </label>
        <input type="text" v-model="student.name" name="name" id="name" class="input" />

        <label for="email">E-mail</label>
        <input type="email" v-model="student.email" name="email" id="email" class="input" />

        <label for="password">Senha</label>
        <input type="password" v-model="student.password" name="password" id="password" class="input" />
        <br>
        <br>
        <div class="button-container">
          <input type="submit" value="Cadastrar" class="btn btn-success">
          <span class="button-space"></span>
          <button @click.prevent="redirectToLogin" class="btn btn-register">Login</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import '../assets/custom.css'; // Importe o arquivo CSS

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
    saveData() {
      axios.post("http://127.0.0.1:8000/api/register", this.student)
        .then(({ data }) => {
          console.log(data);
          try {
            alert("Registro salvo com sucesso!");
          } catch (err) {
            alert("failed");
          }
        });
    },
    redirectToLogin() {
      this.$router.push('/');
    }
  },
  
};
</script>
