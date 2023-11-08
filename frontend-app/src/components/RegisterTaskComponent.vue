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
              <label for="description">Descrição:</label>
              <textarea id="description" v-model="newTask.description" class="custom-textarea" rows="4"></textarea>
            </div>
            <div class="button-container">
              <button type="submit" class="btn-register-task">Adicionar Tarefa</button>
              <span class="button-space"></span>
              <button @click="dashboard" class="btn-add">Voltar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <page-footer></page-footer>
</template>
  
<script>
import axios from 'axios';
import MenuDashboardView from '@/components/MenuDashboardComponent.vue';
import PageFooterView from '@/components/PageFooterComponent.vue';

export default {
  components: {
    'menu-dashboard': MenuDashboardView,
    'page-footer': PageFooterView
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

