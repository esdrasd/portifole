<template>
<div class="comprarCenter">
    <div v-for="img in dados" :key="img">
        <div v-if="img.id == id">
            <div class="comprarCard">
                <div class="comprarImg">
                    <div v-for="(fotos, ii) in JSON.parse(img.img)" :key="fotos">
                        <div v-if="ii == corx">
                            <img :src="'storage/' + fotos" style="height: 200px; width: 200px" />
                        </div>
                    </div>
                </div>
                <div class="comprarStatus">
                    <h5 class="card-title">Nome: {{ img.desc }}</h5>
                    <h5 class="card-title">Categoria: {{ img.nome }}</h5>
                    <h5 class="card-title">Quantidade: {{ count }}</h5>
                    <h5 class="card-title">Valores unitarios R$: {{ (img.price) }}</h5>
                    <h5 class="card-title">Valores Somados R$: {{ (price_qtd = img.price * count) }}</h5>
                    <div class="card" v-if="count > 0">
                        <input class="btn btn-outline-dark" type="button" v-on:click="count++" value="( + )" />
                        <br />
                        <input class="btn btn-outline-dark" type="button" v-on:click="count--" value="( - )" />
                    </div>
                </div>
            </div>
            <div v-for="(prod, ii) in JSON.parse(img.img)" :key="prod">
                <div class="comprarOp card">
                    <input class="btn btn-outline-dark" type="button" @click="cor(ii)" :value="'cor - ' + ii" />
                </div>
            </div>
            <div v-if="count > 0">
                <div class="comprarAdd card">
                    <input class="btn btn-outline-dark" type="button" @click="
                  add_cart(
                    img.id,
                    img.desc,
                    img.nome,
                    img.price,
                    count,
                    price_qtd,
                    JSON.parse(img.img)[corx]
                  )
                " value="add carrinho" />
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "Comprar",
    data() {
        return {
            dados: [],
            id: 0,
            corx: 0,
            vetor: [],
            count: 1,
            price_qtd: 0,
        };
    },
    props: {
        produtos: String,
    },
    mounted() {
        axios.get("show").then((res) => (this.dados = res.data));
        this.id = sessionStorage.getItem(this.produtos);
    },
    methods: {
        cor(ii) {
            this.corx = ii;
        },
        add_cart(id, desc, nome, price, count, price_qtd, img) {
            this.vetor.splice(0);
            var json = {
                id,
                desc,
                nome,
                price,
                count,
                price_qtd,
                img,
            };
            if (typeof sessionStorage.getItem("cart") === "string") {
                var x = JSON.parse(sessionStorage.getItem("cart"));
                for (let i = 0; i < x.length; i++) {
                    this.vetor.push(x[i]);
                }
            }
            this.vetor.push(json);
            sessionStorage.setItem("cart", JSON.stringify(this.vetor));
        },
    },
};
</script>
