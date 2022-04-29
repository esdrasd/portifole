<template>
<div class="HomeCards">
    <div v-for="i in dados" :key="i">
        <div class="HomeCardMargin card" style="width: 300px">

            <router-link :to="'/comprar/' + i.nome">
                <div class="HomeCardIMG">
                    <img class="card-img-top" :src="'storage/' + JSON.parse(i.img)[0]" style="height: 200px; width: 200px" @click="produto(i.nome, i.id)" />
                </div>
            </router-link>

            <div class="card-body">
                <h5 style="card-title">{{ i.nome }}</h5>
                <h6 style="card-title">R$ {{ i.price }}</h6>
            </div>

        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "Home",
    data() {
        return {
            dados: [],
        };
    },
    mounted() {
        if (!sessionStorage.getItem("cart")) {
            sessionStorage.setItem("cart", "[]");
        }
        axios.get("show").then((res) => (this.dados = res.data));
    },
    methods: {
        produto(nome, id) {
            sessionStorage.setItem(nome, id);
        },
    },
};
</script>
