<template>
  <menu-dashboard></menu-dashboard>
  <div class="container mt-4">
    <div class="center-card">
      <div class="card">
        <div class="card-header">
          <h2>Cadastrar Nova Tarefa</h2>
        </div>
        <div class="card-body">
          <form @submit.prevent="addTask">
            <div class="form-group">
              <label for="title">Título:</label>
              <input type="text" id="title" v-model="newTask.title" class="custom-input" required>
            </div>
            <div class="form-group">
              <label for="completed">Concluída:</label>
              <div class="form-check">
                <input type="checkbox" id="completed" v-model="newTask.completed" class="form-check-input">
              </div>
            </div>
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea id="description" v-model="newTask.description" class="custom-textarea" rows="4"></textarea>
            </div>
            <br>
            <div class="button-container">
              <button type="submit" class="btn-add custom-button">Adicionar Tarefa</button>
              <span class="button-space"></span>
              <button @click="dashboard" class="btn-add custom-button">Voltar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import axios from 'axios';
import MenuDashboardView from '@/components/MenuDashboardComponent.vue';

export default {
  components: {
    'menu-dashboard': MenuDashboardView,
  },
  data() {
    return {
      newTask: {
        title: '',
        completed: false,
        description: '',
      },
    };
  },
  methods: {
    addTask() {
      const taskData = {
        title: this.newTask.title,
        completed: this.newTask.completed,
        description: this.newTask.description,
      };
      const token = localStorage.getItem('token');
      axios.post('http://127.0.0.1:8000/api/tasks', taskData, {
        headers: {
          'Authorization': 'Bearer ' + token,
        },
      })
        .then((response) => {
          console.log('Nova Tarefa registrada:', response.data);

          this.newTask = {
            title: '',
            completed: false,
            description: '',
          };
          this.$router.push('/dashboard');
        })
        .catch((error) => {
          console.error('Erro ao registrar a tarefa:', error);
        });
    },
    dashboard() {
      this.$router.push('/dashboard');
    },
  },
};
</script>

