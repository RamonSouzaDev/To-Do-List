<template>
  <div>
    <div class="container mt-4">
      <h2>Lista de Tarefas</h2>
      <div id="flash-notification" class="notification" style="display: none;"></div>


      <div class="form-group">
        <input type="text" class="form-control custom-search" v-model="search" placeholder="Pesquisar Tarefas"
          @input="searchTasks" />
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
            <button :class="{ 'btn-complete': !task.completed, 'btn-incomplete': task.completed }"
              @click="task.completed ? marcarComoIncompleta(task) : marcarComoConcluida(task)">
              <span v-if="task.completed">Desmarcar como concluída</span>
              <span v-else>Marcar como concluída</span>
            </button>
          </tr>
        </tbody>
      </table>

      <paginate :list="tasks" :per="10" :page="currentPage" @change="fetchTasks"></paginate>
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
      showFlash: false
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
        .get(`http://127.0.0.1:8000/api/tasks?page=${page}&search=${this.search}`, {
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
    marcarComoConcluida(task) {
      const token = localStorage.getItem('token');

      axios
        .put(`http://127.0.0.1:8000/api/tasks/${task.id}/complete`, null, {
          headers: {
            Authorization: 'Bearer ' + token,
          },
        })
        .then((response) => {
          response.data.data;
          task.completed = true;
          const notification = document.getElementById('flash-notification');
          notification.textContent = 'A tarefa foi marcada como concluída com sucesso!';
          notification.style.display = 'block';

          setTimeout(() => {
            notification.style.display = 'none';
          }, 4000);
        })
        .catch((error) => {
          console.error('Erro ao marcar a tarefa como concluída:', error);
        });
    },
    addNewTask() {
      this.$router.push('/register-task');
    },
    marcarComoIncompleta(task) {
      const token = localStorage.getItem('token');

      axios
        .put(`http://127.0.0.1:8000/api/tasks/${task.id}/incompleted`, null, {
          headers: {
            Authorization: 'Bearer ' + token,
          },
        })
        .then((response) => {
          response.data.data;
          task.completed = false;
          const notification = document.getElementById('flash-notification');
          notification.textContent = 'A tarefa foi marcada como incompleta com sucesso!';
          notification.style.display = 'block';

          setTimeout(() => {
            notification.style.display = 'none';
          }, 4000);
        })
        .catch((error) => {
          console.error('Erro ao marcar a tarefa como concluída:', error);
        });
    }
  },
  created() {
    this.fetchTasks(1);
  },
};
</script>
