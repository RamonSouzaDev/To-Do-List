<template>
    <menu-dashboard></menu-dashboard>
    <task-list></task-list>
</template>

<script>
import MenuDashboardView from '@/components/MenuDashboardComponent.vue';
import TaskListView from '@/components/TaskListComponent.vue';

export default {
  components: {
    'menu-dashboard': MenuDashboardView,
    'task-list': TaskListView
  },
};
</script>
