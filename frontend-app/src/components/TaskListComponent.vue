<template>
  <div>
    <div class="container mt-4">
      <div class="card-table">
        <div class="task-list-container">
          <h2>Lista de Tarefas</h2>
          <img src="../assets/task-list-image.png" alt="Minha Foto" class="task-list" />
        </div>
        <br>
        <confirm-delete-modal :show="showModal" :task-to-delete="taskToDelete" @confirm-delete="confirmDelete"
          @cancel-delete="cancelDelete" />
        <div id="flash-notification" class="notification" style="display: none;"></div>


        <div class="form-group">
          <input type="text" class="form-control custom-search" v-model="search" placeholder="Pesquisar Tarefas"
            @input="searchTasks" />
        </div>
        <div class="button-container-actions">
          <button class="btn-add custom-export" @click="exportExcel">
            Bônus: Exportar Excel
          </button>
          <button class="btn-add custom-button" @click="addNewTask">
            Adicionar Tarefa
          </button>
          <button class="btn-add custom-mark-all-as-complete" @click="markAllAsCompleted">Marcar Todas como Concluído</button>

          <button class="btn-add custom-mark-all-as-incompleted" @click="markAllAsIncompleted">Marcar Todas como Incompleto</button>
        </div>
        <br>
        <confirm-delete-modal :show="showModal" :task-to-delete="taskToDelete" @confirm-delete="confirmDelete"
          @cancel-delete="cancelDelete" />
        <div class="table-container">
        <table class="table custom-table">
          <thead>
            <tr>
              <th class="table-th-customize">Selecione</th>
              <th>Título</th>
              <th>Concluída</th>
              <th>Usuário</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="task in tasks" :key="task.id">
              <td class="table-th-customize">
                <input class="input-checkbox" type="checkbox" v-model="task.id" @change="checkBox(task)">
              </td>
              <td>{{ task.title }}</td>
              <td>{{ task.completed ? 'Sim' : 'Não' }}</td>
              <td>{{ task.user.name }}</td>
              <td>
                <div class="btn-delete-container">
                  <button :class="{ 'btn-complete': !task.completed, 'btn-incomplete': task.completed }"
                    @click="task.completed ? markAsInclompeted(task) : markAsCompleted(task)">
                    <span v-if="task.completed">Marcar como incompleta</span>
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
      </div>
        <br>
        <paginate class="v-pagination" v-model="currentPage" :pages="10" :range-size="1" active-color="#DCEDFF"
          @update:modelValue="fetchTasks(currentPage)" />
      </div>
    </div>
    
  </div>
  <page-footer></page-footer>
</template>
<script>
import axios from 'axios';
import PageFooterView from '@/components/PageFooterComponent.vue';
import ConfirmDeleteModalView from '@/components/ConfirmDeleteModalComponent.vue';

export default {
  components: {
    'page-footer': PageFooterView,
    'confirm-delete-modal': ConfirmDeleteModalView
  },
  data() {
    return {
      tasks: [],
      search: '',
      currentPage: 1,
      showModal: false,
      taskToDelete: null,
    };
  },
  methods: {
    notify(message) {
      const notification = document.getElementById('flash-notification');
      notification.textContent = message;
      notification.style.display = 'block';

      setTimeout(() => {
        notification.style.display = 'none';
      }, 4000);
    },
    makeRequest(method, url, successMessage, errorMessage, data = null) {
      const token = localStorage.getItem('token');

      axios({
        method: method,
        url: axios.defaults.baseURL + url,
        headers: {
          Authorization: 'Bearer ' + token,
        },
        responseType: url === '/export-excel' ? 'blob' : 'json',
        data: data,
        
      })
        .then((response) => {
          response.data.data;
          this.notify(successMessage);
          if (url === '/mark-all-as-incompleted') {
            this.tasks.forEach(task => task.completed = false);
          }
          if (url === '/mark-all-as-completed') {
            this.tasks.forEach(task => task.completed = true);
          }
          if (url === '/export-excel') {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'tarefas.xlsx');
            document.body.appendChild(link);
            link.click();

            const notification = document.getElementById('flash-notification');
            notification.textContent = 'Download de relatório realizado com sucesso!';
            notification.style.display = 'block';

            setTimeout(() => {
              notification.style.display = 'none';
            }, 4000);
            }
        })
        .catch((error) => {
          console.error(errorMessage, error);
        });
    },
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
          this.tasks.slice((this.currentPage - 1) * 10, this.currentPage * 10);
        })
        .catch((error) => {
          console.error('Erro ao buscar tarefas:', error);
        });
    },
    checkBox() {

    },
    searchTasks() {
      this.currentPage = 1;
      this.fetchTasks(1);
    },
    markAsCompleted(task) {
      this.makeRequest('put', `/${task.id}/complete`, 'A tarefa foi marcada como concluída com sucesso!', 'Erro ao marcar a tarefa como concluída');
      task.completed = true;
    },
    addNewTask() {
      this.$router.push('/register-task');
    },
    markAllAsIncompleted() {
      this.makeRequest('post', '/mark-all-as-incompleted', 'Todas as tarefas foram marcadas como incompletas!', 'Erro ao marcar as tarefas como incompletas');
    },
    markAllAsCompleted() {
      this.makeRequest('post', '/mark-all-as-completed', 'Todas as tarefas foram marcadas como concluídas!', 'Erro ao marcar as tarefas como concluídas');
    },
    markAsInclompeted(task) {
      this.makeRequest('put', `/${task.id}/incompleted`, 'A tarefa foi marcada como incompleta com sucesso!', 'Erro ao marcar a tarefa como incompleta');
      task.completed = false;
    },
    deleteTask(task) {
      this.taskToDelete = task;
      this.showModal = true;
    },
    confirmDelete(taskToDelete) {
      this.makeRequest('delete', `/${taskToDelete.id}`, 'A tarefa foi excluída com sucesso!', 'Erro ao excluir tarefa');
      this.showModal = false;
      this.fetchTasks(1);
    },
    cancelDelete() {
      this.taskToDelete = null;
      this.showModal = false;
    },
    exportExcel() {
      this.makeRequest('post', '/export-excel', 'Download de relatório realizado com sucesso!', 'Erro ao realizar o download do relatório');
    },
  },
  created() {
    this.fetchTasks(1);
  },
};
</script>