<template>
<div class="ComprarCss">
    <div v-for="img in dados" :key="img">
        <div v-if="img.id == id">

            <div class="card">
                <div class="ComprarTamanho">
                    <div class="ComprarTamanho">

                        <div v-for="(fotos, ii) in JSON.parse(img.img)" :key="fotos">
                            <div v-if="ii == corx">
                                <img :src="'storage/' + fotos" style="height: 200px; width: 200px" />
                            </div>
                        </div>

                    </div>

                    <div class="ComprarTamanhoitem card">
                        <div class="">

                            <div class="">
                                <h5 class="card-title">Produto: {{ img.nome }}</h5>
                                <h5 class="card-title">Price: R$ {{ img.price }}</h5>
                            </div>

                            <h5 class="card-title">Op: </h5>
                            <div class="ComprarTamanhoitem">
                                <div v-for="(prod, ii) in JSON.parse(img.img)" :key="prod">
                                    <input type="button" @click="cor(ii)" :value="'cor ' + ii" />
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <input type="button" @click="add_cart(img.id, img.nome, img.price, JSON.parse(img.img)[corx])" value="add carrinho" />
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
        add_cart(id, nome, price, img) {
            this.vetor.splice(0);
            var json = {
                id,
                nome,
                price,
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
