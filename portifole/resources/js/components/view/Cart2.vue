<template>

<div v-for="(i, key) in dados" :key="i">
<img :src="'storage/' + i.img" style="height: 200px; width: 200px" />
<h5 class="card-title">Produto: {{ i.nome }}</h5>
<h5 class="card-title">R$: {{ i.price }}</h5>
<input class="btn btn-outline-dark" type="button" value="delete" @click="del(key)" />
</div>

<h1>Total dos Price:</h1>
<input type="hidden" id="produto" name="produto" />
<input type="hidden" id="price" name="price" :value="price" />
<div id="price" name="price">R$: {{price}}</div>
<label for="boleto">
<h1>Boleto</h1>
</label>
<input type="radio" id="boleto" value="boleto" v-model="modo" />
<p><input type="hidden" id="id_boleto" name="id_boleto" /></p>
<input type="hidden" id="id_comprador_boleto" name="id_comprador_boleto" />

<label for="creditcard">
<h1>Parcelamento</h1>Cartao de Credito
</label>
<input type="radio" id="creditcard" value="creditcard" v-model="modo" />
<input type="hidden" id="id_creditCard" name="id_creditCard" />
<input type="hidden" id="id_comprador_creditCard" name="id_comprador_creditCard" />
<input type="hidden" id="id_card" name="id_card" />
<input class="border" type="text" id="n_card" name="n_card" placeholder="n_card" value="4111111111111111" />
<input class="border" type="text" id='cvv' name='cvv' placeholder="cvv" value="013">
<input class="border" type="text" id='mes' name='mes' placeholder="mes" value="12">
<input class="border" type="text" id='ano' name='ano' placeholder="ano" value="2026">
<h1>
<div id="n_bandeira"></div>
</h1>
<div id="bandeira"></div>
<select id="parcelas" name="parcelas" class="border">
<option>parcelas</option>
</select>
Valor da Parcelas R$: <div id="v_parcela" name="v_parcela"></div>
Total da Parcelas R$:
<div id="t_parcela" name="t_parcela"></div>
<div id="meios_pagamentos"></div>
<input class="btn btn-outline-dark" type="submit" @click="pagamento()" value="pagamento" />
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
