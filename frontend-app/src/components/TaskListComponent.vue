<template>
  <div>
    <div class="container mt-4">
      <div class="card-table">
      <div class="task-list-container">
        <h2>Lista de Tarefas</h2>
        <img src="../assets/task-list-image.png" alt="Minha Foto" class="task-list" />
      </div>
      <br>
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
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in tasks" :key="task.id">
            <td>{{ task.title }}</td>
            <td>{{ task.completed ? 'Sim' : 'Não' }}</td>
            <td>{{ task.user.name }}</td>
            <td>
            <div class="btn-delete-container">
              <button :class="{ 'btn-complete': !task.completed, 'btn-incomplete': task.completed }"
                @click="task.completed ? markAsInclompeted(task) : markAsCompleted(task)">
                <span v-if="task.completed">Desmarcar como concluída</span>
                <span v-else>Marcar como concluída</span>
              </button>
              <button class="btn-delete" @click="deleteTask(task)">
                Excluir
              </button>
            </div>
          </td>
          </tr>
        </tbody>
      </table>

      <paginate v-model="currentPage" :pages="10" :range-size="1" active-color="#DCEDFF" @update:modelValue="fetchTasks(currentPage)" />
    </div>
  </div>
  </div>
  <page-footer></page-footer>
</template>
<script>
import axios from 'axios';
import PageFooterView from '@/components/PageFooterComponent.vue';

export default {
  components: {
    'page-footer': PageFooterView
  },
  data() {
    return {
      tasks: [],
      search: '',
      currentPage: 1,
    };
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
          console.log("AQUI A PAGINA MANO " + page);
          
          this.tasks = response.data.data;
          this.tasks.slice((this.currentPage - 1) * 10, this.currentPage * 10);
          this.tasks.forEach((task) => {
            console.log(task.id, task.title, task.completed);
          });
        })
        .catch((error) => {
          console.error('Erro ao buscar tarefas:', error);
        });
    },
    searchTasks() {
      this.currentPage = 1;
      this.fetchTasks(1);
    },
    markAsCompleted(task) {
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
    markAsInclompeted(task) {
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
          console.error('Erro ao marcar a tarefa como incompleta:', error);
        });
    },
    deleteTask(task) {
      const token = localStorage.getItem('token');

      axios
        .delete(`http://127.0.0.1:8000/api/tasks/${task.id}`, {
          headers: {
            Authorization: 'Bearer ' + token,
          },
        })
        .then((response) => {
          response.data.data;
          task.completed = false;
          const notification = document.getElementById('flash-notification');
          notification.textContent = 'A tarefa foi excluída sucesso!';
          notification.style.display = 'block';

          setTimeout(() => {
            notification.style.display = 'none';
          }, 4000);

          this.fetchTasks(1);
        })
        .catch((error) => {
          console.error('Erro ao excluir tarefa:', error);
        });
    },
  },
  created() {
    this.fetchTasks(1);
  },
};
</script>
