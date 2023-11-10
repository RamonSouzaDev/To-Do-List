<h1 align="center">Olá 👋, Eu sou Ramon Mendes</h1>
<h3 align="center">Um desenvolvedor back-end apaixonado por tecnologia</h3>

- 🔭 Atualmente estou trabalhando em [Desenvolvimento de projeto Back-end](https://github.com/RamonSouzaDev/To-Do-List-)

- 🌱 Atualmente estou aprendendo **Arquitetura e Engenharia de Software**

- 📫 Como chegar até mim **dwmom@hotmail.com**

<h3 align="left">Vamos fazer networking:</h3>
<p align="left">
<a href="https://linkedin.com/in/https://www.linkedin.com/in/ramon-mendes-b44456164/" target="blank"><img align="center" src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/linked-in-alt.svg" alt="https://www.linkedin.com/in/ramon-mendes-b44456164/" height="30" width="40" /></a>
</p>

<h3 align="left">Linguagens e ferramentas:</h3>
 <a href="https://hadoop.apache.org/" target="_blank" rel="noreferrer"> <img src="https://www.vectorlogo.zone/logos/apache_hadoop/apache_hadoop-icon.svg" alt="hadoop" width="40" height="40"/> </a> <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="javascript" width="40" height="40"/> </a> <a href="https://laravel.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-plain-wordmark.svg" alt="laravel" width="40" height="40"/> </a> <a href="https://www.linux.org/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/linux/linux-original.svg" alt="linux" width="40" height="40"/> </a> <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a> <a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a> </p>


- **Instalando Projeto**

# Vídeo de configuração do ambiente no Youtube

Clique aqui : https://youtu.be/458Q5dpcMrc

[![Watch the video](https://i.stack.imgur.com/Vp2cE.png)](https://youtu.be/458Q5dpcMrc)


1. Clone o repositório :
git clone git@github.com:RamonSouzaDev/To-Do-List-.git

2. Entre na pasta do projeto
cd "nome do projeto"

**Executando pelo docker** <p align="left"> <a href="https://www.docker.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/docker/docker-original-wordmark.svg" alt="docker" width="40" height="40"/> </a>

3.  Execute os comandos para subir o ambiente de backend
./run-docker-backend.sh up --build
./run-docker-backend.sh down

4. Execute os comandos para subir o ambiente de frontend
./run-docker-frontend.sh up --build
./run-docker-frontend.sh down

5. Abra uma terceira guia no seu terminal e execute o comando
./start-backend.sh

**Testes Unitários** 💡

1. Execute o comando  ./vendor/bin/phpunit

**Seeders**
Execute os comandos abaixo para gerar dados

1. php artisan db:seed --class=TaskSeeder


- **URL** 🏁🏁🏁
http://192.168.144.2:8080/

- **Rotas**

Obs: Lembre de adicionar o Bearer Token do usuário logado na requisição, caso esteja usando Postman. 👍

## Métodos 🔥🔥🔥
Requisições para a API devem seguir os padrões:
| Método | Rota | Descrição |
|---|---|---|
| `POST` | /api/register | Rota para registrar um usuário |
```json
{
  "name": "Nome do usuário",
  "email": "emaildousuario@hotmail.com",
  "password": "developer"
}
```
| Método | Rota | Descrição |
|---|---|---|
| `POST` | /api/login | Rota para fazer login |
```json
{
  "email": "emaildousuario@hotmail.com",
  "password": "developer"
}
```
| Método | Rota | Descrição |
|---|---|---|
| `POST` | /api/logout | Rota para fazer logout |
```json
{
  "email": "emaildousuario@hotmail.com",
  "password": "developer"
}

```
| Método | Rota | Descrição |
|---|---|---|
| `POST` | /api/task | Rota para cadastrar uma Tarefa |
```json
{
    "title" : "Nova tarefa",
    "completed" : "false"
}
```
| Método | Rota | Descrição |
|---|---|---|
| `GET` | /api/task | Rota para listar todas as Tarefas |

| Método | Rota | Descrição |
|---|---|---|
| `PUT` | /api/tasks/{task}/complete | Rota para marcar tarefa como concluída |

| Método | Rota | Descrição |
|---|---|---|
| `PUT` | /api/tasks/{task}/incompleted | Rota marcar tarefa como incompleta|

| Método | Rota | Descrição |
|---|---|---|
| `DELETE` | /api/tasks/{task} | Rota para deletar uma Tarefa |


## Rota Bônus Métodos 🔥🔥🔥 📊 ⬆️ ⬆️

| Método | Rota | Descrição |
|---|---|---|
| `POST` | /api/tasks/export-excel | Rota para fazer o download do relatório |
