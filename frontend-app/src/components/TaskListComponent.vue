<template>
  <div>
    <div class="container mt-4">
      <h2>Lista de Tarefas</h2>

      <div class="form-group">
        <input type="text" class="form-control" v-model="search" placeholder="Pesquisar Tarefas" @input="searchTasks" />
      </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Completed</th>
            <th>User ID</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in paginatedTasks" :key="task.id">
            <td>{{ task.title }}</td>
            <td>{{ task.completed ? 'Sim' : 'Não' }}</td>
            <td>{{ task.user_id }}</td>
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
      this.currentPage = 1;
      this.fetchTasks(1);
    },
  },
  created() {
    this.fetchTasks(1);
  },
};
</script>
