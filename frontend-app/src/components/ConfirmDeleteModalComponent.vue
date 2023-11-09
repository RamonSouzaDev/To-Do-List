<template>
    <div v-if="show" class="modal fade show" tabindex="-1" role="dialog">
      <div class="modal-dialog position-absolute" role="document">
        <div class="modal-content bg-white">
          <div class="modal-header bg-secondary text-white">
            <h5 class="modal-title w-100 text-center">Confirmar Exclusão</h5>
          </div>
          <div class="modal-body">
            <p class="mb-0">Deseja realmente excluir a tarefa "{{ taskToDelete.title }}"?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-cancel" @click="cancelDelete">Cancelar</button>
            <button type="button" class="btn-delete" @click="confirmDelete">Excluir</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  
<script>
export default {
    props: {
        show: Boolean,
        taskToDelete: Object,
    },
    methods: {
        confirmDelete() {
            this.$emit('confirm-delete', this.taskToDelete);
        },
        cancelDelete() {
            this.$emit('cancel-delete');
        },
    },
};
</script>
