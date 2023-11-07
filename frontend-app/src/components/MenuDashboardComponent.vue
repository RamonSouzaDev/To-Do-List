<template>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Responsive Navbar</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
    </head>

    <body>
        <div class="nav">
            <input type="checkbox" id="nav-check">
            <div class="nav-header">
                <div class="nav-title">
                    <a v-if="user" class="nav-link">Bem-vindo, {{ user.name }}</a>
                </div>
            </div>
            <div class="nav-btn">
                <label for="nav-check">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
            <div class="nav-links">
                <a href="#" target="_blank">Home</a>
                <a href="#" target="_blank">About</a>
                <a href="#" target="_blank">Projects</a>
                <a href="#" target="_blank">Contact us</a>
                <button v-if="user" @click="logout" class="btn btn-danger">Sair</button>
            </div>
        </div>
    </body>
    </html>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
        };
    },
    created() {
        const token = localStorage.getItem('token');
        if (token) {
            axios.get('http://127.0.0.1:8000/api/user', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                },
            })
                .then((response) => {
                    this.user = response.data;
                })
                .catch((error) => {
                    console.error('Erro ao recuperar os dados do usuário:', error);
                });
        }
    },
    methods: {
        logout() {
            const token = localStorage.getItem('token');
            axios.post('http://127.0.0.1:8000/api/logout', null, {
                headers: {
                    'Authorization': 'Bearer ' + token,
                },
            })
                .then(() => {
                    localStorage.removeItem('token');
                    this.$router.push('/');
                })
                .catch((error) => {
                    console.error('Erro ao fazer logout:', error);
                });
        },
    },
};
</script>
  