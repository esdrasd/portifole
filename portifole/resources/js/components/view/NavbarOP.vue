<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <router-link class="navbar-brand" to="/">Home</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbar-brand" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" to="/celular">Celular</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/game">Game</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/notebook">Notebook</router-link>
                </li>
            </ul>
        </div>
    </div>
    <div class="nav-item">
        <router-link class="nav-link navbar-brand" to="/cart" onclick="window.location.reload();">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
            </svg>
        </router-link>
    </div>
    <div v-if="cont === 0">
        <div class="nav-item">
            <div class="nav-link navbar-brand" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                Login
            </div>
        </div>
    </div>
    <div v-if="cont === 1">
        <div class="nav-item">
            <div class="nav-link navbar-brand" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                {{ nome }}
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </div>
        </div>
    </div>
</nav>

<div v-if="cont === 0">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Entre em sua Conta</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="LoginCss">
            <h5>Login</h5>
            <br />
            <div class="form-floating mb-3">
                
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" value="" />
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                
                <input type="password" class="form-control" id="floatingPassword" name="senha" placeholder="Password" value="" />
                <label for="floatingPassword">Password</label>
            </div>
            <br />
            <div class="card">
                <input type="submit" class="btn btn-outline-dark" value="login" @click="login()" />
            </div>
            <hr />
            <div>
                <div class="card">
                    <a href="registrar/" class="btn btn-outline-dark">Criar Conta</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div v-if="cont === 1">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{ nome }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="LoginCss">
            <div class="card">
                <router-link class="btn btn-outline-dark" to="/add">Adicionar Produtos</router-link>
            </div>
            <br>
            <div class="card">
                <a class="btn btn-outline-dark" href="edit">Editar Perfil</a>
            </div>
            <br>
            <div class="card">
                <a href="login_sair" class="btn btn-outline-dark">Sair</a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "NavbarOP",
    data() {
        return {
            cont: 0,
            nome: "",
        };
    },
    methods: {
        login() {
            document.getElementById("form").action = "login";
        },
    },
    mounted() {
        console.clear();
        axios
            .get("session")
            .then(
                (response) => (
                    (this.cont = response.data.key), (this.nome = response.data.nome)
                )
            );
    },
};
</script>
