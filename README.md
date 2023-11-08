<h1 align="center">Olá 👋, Eu sou Ramon Mendes</h1>
<h3 align="center">Um desenvolvedor back-end apaixonado por tecnologia</h3>

- 🔭 Atualmente estou trabalhando em [Desenvolvimento de projeto Back-end](https://github.com/RamonSouzaDev/To-Do-List-)

- 🌱 Atualmente estou aprendendo **Laravel e MYSQL**

- 📫 Como chegar até mim **dwmom@hotmail.com**

<h3 align="left">Vamos fazer networking:</h3>
<p align="left">
<a href="https://linkedin.com/in/https://www.linkedin.com/in/ramon-mendes-b44456164/" target="blank"><img align="center" src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/linked-in-alt.svg" alt="https://www.linkedin.com/in/ramon-mendes-b44456164/" height="30" width="40" /></a>
</p>

<h3 align="left">Linguagens e ferramentas:</h3>
 <a href="https://hadoop.apache.org/" target="_blank" rel="noreferrer"> <img src="https://www.vectorlogo.zone/logos/apache_hadoop/apache_hadoop-icon.svg" alt="hadoop" width="40" height="40"/> </a> <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="javascript" width="40" height="40"/> </a> <a href="https://laravel.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-plain-wordmark.svg" alt="laravel" width="40" height="40"/> </a> <a href="https://www.linux.org/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/linux/linux-original.svg" alt="linux" width="40" height="40"/> </a> <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a> <a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a> </p>


- **Instalando Projeto**

1. Clone o repositório :
git clone git@github.com:RamonSouzaDev/To-Do-List-.git

2. Entre na pasta do projeto
cd "nome do projeto"

3. Faça uma cópia do env.
cp .env.example .env

4. Instale as dependências
composer install

5. Gerando a chave
php artisan key:generate

6. Execute a migrate para gerar as tabelas do banco de dados
php artisan migrate

7. Execute o projeto
php artisan serve

**Testes Unitários** 💡

1. Execute o comando  ./vendor/bin/phpunit

**Seeders**
Execute os comandos abaixo para gerar dados

1. php artisan db:seed --class=TaskSeeder

**Executando pelo docker** <p align="left"> <a href="https://www.docker.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/docker/docker-original-wordmark.svg" alt="docker" width="40" height="40"/> </a>

1. Execute o comando docker-compose up -d --build

- **Rotas**

Obs: Lembre de adicionar o Bearer Token do usuário logado na requisição.
Obs: Para efetuar o disparo do email descomente a linha de 27 na classe UserService

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