<template>
  <div>
    <div class="container mt-4">
      <h2>Lista de Tarefas</h2>

      <div class="form-group">
        <input type="text" class="form-control custom-search" v-model="search" placeholder="Pesquisar Tarefas" @input="searchTasks" />
      </div>
      <button class="btn-add custom-button" @click="addNewTask">
        Adicionar Tarefa
      </button>

      <table class="table custom-table">
        <thead>
          <tr>
            <th>Título</th>
            <th>Concluída</th>
            <th>Usuário</th>
            <th>Ações</th> <!-- Adicione a nova coluna "Ações" aqui -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in paginatedTasks" :key="task.id">
            <td>{{ task.title }}</td>
            <td>{{ task.completed ? 'Sim' : 'Não' }}</td>
            <td>{{ task.user.name }}</td>
            <td>
              <button class="btn-complete" @click="marcarComoConcluida(task)">Marcar como concluída</button>
            </td>
          </tr>
        </tbody>
      </table>

      <paginate
        :list="tasks"
        :per="10"
        :page="currentPage"
        @change="fetchTasks"
      ></paginate>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import '../assets/custom.css';

export default {
  data() {
    return {
      tasks: [],
      search: '',
      currentPage: 1,
    };
  },
  computed: {
    paginatedTasks() {
      return this.tasks.slice((this.currentPage - 1) * 10, this.currentPage * 10);
    },
  },
  methods: {
    fetchTasks(page) {
      this.currentPage = page;
      const token = localStorage.getItem('token');
      axios
        .get(`http://127.0.0.1:8000/api/tasks?page=${page}`, {
          headers: {
            Authorization: 'Bearer ' + token,
          },
        })
        .then((response) => {
          this.tasks = response.data.data;
        })
        .catch((error) => {
          console.error('Erro ao buscar tarefas:', error);
        });
    },
    searchTasks() {
      this.currentPage =  1;
      this.fetchTasks(1);
    },
    marcarComoConcluida(task) {
    const token = localStorage.getItem('token');

    axios
      .post(`http://127.0.0.1:8000/api/tasks/${task.id}/complete`, null, {
        headers: {
          Authorization: 'Bearer ' + token,
        },
      })
      .then((response) => {
        response.data.data;
        task.completed = true;
      })
      .catch((error) => {
        console.error('Erro ao marcar a tarefa como concluída:', error);
      });
    },
    addNewTask() {
      this.$router.push('/register-task');
    },
  },
  created() {
    this.fetchTasks(1);
  },
};
</script>
