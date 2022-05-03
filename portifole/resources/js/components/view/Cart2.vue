<template>
<div v-for="(i, key) in dados" :key="i">
    <p><img :src="'storage/' + i.img" style="height: 200px; width: 200px" /></p>
    <h1>{{ i.nome }}</h1>
    <h1>{{ i.price }}</h1>
    <input type="button" value="delete" @click="del(key)" />
    <hr />
</div>
<h1>price:</h1>
<input type="hidden" id="produto" name="produto" />
<div id="price_div"></div>
<p></p>
<label for="boleto"><h1>Boleto</h1></label>
<input type="radio" id="boleto" value="boleto" v-model="modo" />
<input type="hidden" id="id_boleto" name="id_boleto" />
<input type="hidden" id="id_comprador_boleto" name="id_comprador_boleto" />
<p></p>
<label for="creditcard"><h1>creditcard</h1></label>
<input type="radio" id="creditcard" value="creditcard" v-model="modo" />
<p></p>
<input type="hidden" id="id_creditCard" name="id_creditCard" />
<p></p>
<input type="hidden" id="id_comprador_creditCard" name="id_comprador_creditCard" />
<p></p>
<input type="hidden" id="id_card" name="id_card" />
<p></p>
<input type="text" id="n_card" name="n_card" placeholder="n_card" value="4111111111111111" />
<p></p>
<input type="text" id='cvv' name='cvv' placeholder="cvv" value="013">
<p></p>
<input type="text" id='mes' name='mes' placeholder="mes" value="12">
<p></p>
<input type="text" id='ano' name='ano' placeholder="ano" value="2026">
<p></p>
<div id="n_bandeira"></div>
<div id="bandeira"></div>
<p></p>
<select id="parcelas" name="parcelas">
<option>parcelas</option>
</select>
<p></p>
Valor da Parcelas R$: <div id="v_parcela" name="v_parcela"></div>
Total da Parcelas R$: <div id="t_parcela" name="t_parcela"></div>
<p></p>
<p><input type="submit" @click="pagamento()" value="pagamento" /></p>
<p></p>
<div id="meios_pagamentos"></div>
<hr />
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
            document.getElementById('price_div').innerHTML = this.price;
    },
    methods: {
        del(key) {
            this.price -= JSON.parse(this.dados[key].price);
            document.getElementById('price_div').innerHTML = this.price;
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
