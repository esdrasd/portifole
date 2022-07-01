<template>
<div class="add_base">
    <div class="add_local_hist">
        <div v-for="i in dados" :key="i">
            <div class="card add_hist_card">
                <img class="card card-img-top" :src="'storage/' + JSON.parse(i.img)[0]" style="height: 200px; width: 200px" />
                <div class="card-body">
                    <h5 style="card-title">{{ i.desc }}</h5>
                    <h5 style="card-title">{{ i.nome }}</h5>
                    <h6 style="card-title">R$ {{ i.price }}</h6>
                </div>
                <button type="submit" :value="i.id" name="id" @click="del">
                    Delete
                </button>
            </div>
        </div>
    </div>
    <div class="add_center">
        <div class="add_item card">
            <h5>Add SEUS PRODUTOS</h5>
            <br />
            <div class="card">
                <input class="border border-dark" type="text" name="desc" placeholder="nome do produto" />
            </div>
            <br />
            <div class="card btn btn-outline-dark">
                Categoria:
                <select name="nome" id="nome">
                    <option>Escolha a Categoria</option>
                    <option value="celular">celular</option>
                    <option value="game">game</option>
                    <option value="notebook">notebook</option>
                </select>
            </div>
            <br />
            <div class="card">
                <input class="border border-dark" type="text" name="price" placeholder="Price" />
            </div>
            <br />
            <div class="card">
                <input class="btn btn-outline-dark" type="file" id="file" name="img[]" multiple />
            </div>
            <br />
            <div class="card">
                <input class="btn btn-outline-dark" type="submit" @click="add()" value="enviar" />
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "Add",
    data() {
        return {
            dados: "",
        };
    },
    methods: {
        add() {
            document.getElementById("form").action = "add";
        },
        del() {
            document.getElementById("form").action = "addCardDel";
        },
    },
    mounted() {
        axios.get("add_show_img").then((res) => (this.dados = res.data));
    },
};
</script>
