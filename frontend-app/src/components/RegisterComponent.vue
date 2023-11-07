<template>
  <div class="card">
    <div class="card-header">Register Form</div>
    <div class="card-body">
      <form @submit.prevent="saveData">
        <label for="name">First Name</label>
        <input type="text" v-model="student.name" name="name" id="name" class="input" />

        <label for="email">Email</label>
        <input type="email" v-model="student.email" name="email" id="email" class="input" />

        <label for="password">Password</label>
        <input type="password" v-model="student.password" name="password" id="password" class="input" />

        <input type="submit" value="Save" class="btn btn-success">
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
    }
  }
};
</script>
