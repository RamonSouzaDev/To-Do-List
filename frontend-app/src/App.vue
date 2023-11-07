<template>
    <router-view @login-success="handleLoginSuccess"></router-view>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      isLoggedIn: false,
    };
  },
  created() {
    const token = localStorage.getItem('token');
    if (token) {
      this.isLoggedIn = true;
    }
  },
  methods: {
    handleLoginSuccess() {
      this.isLoggedIn = true;
    },
  },
};
</script>
