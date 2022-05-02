<template>
<h1>price:</h1>
<input type="hidden" id="produto" name="produto" />
<input type="text" id="price" name="price" :value="price" />
<br>
<input type="radio" id="boleto" value="boleto" v-model="modo" />
<label for="boleto"><h1>Boleto</h1></label>
<p><!-- token --><input type="hidden" id="id_boleto" name="id_boleto" /></p>
<input type="hidden" id="id_comprador_boleto" name="id_comprador_boleto" />
<input type="radio" id="creditcard" value="creditcard" v-model="modo" />
<label for="creditcard"><h1>creditcard</h1></label>
<input type="hidden" id="id_creditCard" name="id_creditCard" />
<input type="hidden" id="id_comprador_creditCard" name="id_comprador_creditCard" />
<input type="hidden" id="id_card" name="id_card" />
<p></p>
<input type="text" id="n_card" name="n_card" placeholder="n_card" value="4111111111111111" />
<p></p>
<input type="text" id='cvv' name='cvv' placeholder="cvv" value="013">
<p></p>
<input type="text" id='mes' name='mes' placeholder="mes" value="12">
<p></p>
<input type="text" id='ano' name='ano' placeholder="ano" value="2026">
<div id="n_bandeira"></div>
<div id="bandeira"></div>
<p></p>
<select id="parcelas" name="parcelas">
<option>parcelas</option>
</select>
<p></p>
<input type="text" id="v_parcela" name="v_parcela" placeholder="valor da parcela" />
<input type="text" id="t_parcela" name="t_parcela" placeholder="total da parcela" />
<input type="submit" @click="pagamento()" value="pagamento" />
<div id="meios_pagamentos"></div>
<hr />
<div v-for="(i, key) in dados" :key="i">
    <h1>{{ i.nome }}</h1>
    <h1>{{ i.price }}</h1>
    <p><img :src="'storage/' + i.img" style="height: 200px; width: 200px" /></p>
    <input type="button" value="delete" @click="del(key)" />
    <hr />
</div>
</template>

<script>
export default {
    data() {
        return {
            dados: [],
            price: 0,
            modo: "",
        };
    },
    mounted() {
        var obj = JSON.parse(sessionStorage.getItem("cart"));
        var y = [];
        var reescrever = [];

        for (let i = 0; i < obj.length; i++) {
            y.push(JSON.stringify(obj[i]));
        }
        var w = [...new Set(y)];
        for (let i of w) {
            this.dados.push(JSON.parse(i));
            reescrever.push(JSON.parse(i));
        }
        //reescrever
        sessionStorage.setItem("cart", JSON.stringify(reescrever));

        for (var i of this.dados) {
            var price = JSON.parse(i.price);
            this.price += price;
        }
    },
    methods: {
        del(key) {
            this.price -= JSON.parse(this.dados[key].price);
            this.dados.splice(key, 1);
            var x = JSON.stringify(this.dados);
            sessionStorage.setItem("cart", x);
        },
        pagamento() {
            if (this.modo == "boleto") {
                document.getElementById("produto").value = JSON.stringify(this.dados);
                document.getElementById("form").action = "boleto";
            } else if (this.modo == "creditcard") {
                document.getElementById("produto").value = JSON.stringify(this.dados);
                document.getElementById("form").action = "credito";
            }
        },
    },
};
</script>

<style>
</style>
