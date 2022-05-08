<template>
<div class="cartBase">
    <div class="cartCenter card">
        <div v-for="(i, key) in dados" :key="i">
            <div class="cardCardStatus card">
                <div class="cartCard">
                    <img :src="'storage/' + i.img" style="height: 200px; width: 200px" />
                    <div class="cartStatus">
                        <h5 class="card-title">Nome: {{ i.desc }}</h5>
                        <h5 class="card-title">Produto: {{ i.nome }}</h5>
                        <h5 class="card-title">Quantidade: {{ i.count }}</h5>
                        <h5 class="card-title">R$: {{ i.price }}</h5>
                    </div>
                </div>
                <input class="btn btn-outline-dark" type="button" value="delete" @click="del(key)" />
            </div>
        </div>
    </div>

    <div class="cartPagamento">
        <div class="card">
            <h1>Total dos Price:</h1>
            <input type="hidden" id="produto" name="produto" />
            <input type="hidden" id="price" name="price" :value="price" />
            <div id="price" name="price">R$: {{ price }}</div>
        </div>
        <div class="card">
            <label for="boleto">
                <h1>Boleto</h1>
            </label>
            <input type="radio" id="boleto" value="boleto" v-model="modo" />
            <p><input type="hidden" id="id_boleto" name="id_boleto" /></p>
            <input type="hidden" id="id_comprador_boleto" name="id_comprador_boleto" />
        </div>
        <div class="card">
            <label for="creditcard">
                <h1>Cartao de Credito</h1>
            </label>
            <input type="radio" id="creditcard" value="creditcard" v-model="modo" />
            <input type="hidden" id="id_creditCard" name="id_creditCard" />
            <input type="hidden" id="id_comprador_creditCard" name="id_comprador_creditCard" />
            <input type="hidden" id="id_card" name="id_card" />
            <br />
            <input class="border" type="text" id="n_card" name="n_card" placeholder="n_card" value="4111111111111111" />
            <br />
            <input class="border" type="text" id="cvv" name="cvv" placeholder="cvv" value="013" />
            <br />
            <input class="border" type="text" id="mes" name="mes" placeholder="mes" value="12" />
            <br />
            <input class="border" type="text" id="ano" name="ano" placeholder="ano" value="2026" />
        </div>
        <br />
        <div class="card">
            <h1>
                <div id="n_bandeira"></div>
            </h1>
            <div id="bandeira"></div>
        </div>
        <br />
        <div class="card">
            <select id="parcelas" name="parcelas" class="border-dark">
                <option>parcelas</option>
            </select>
        </div>
        <br />
        <div class="card">
            Valor da Parcelas R$:
            <input type="hidden" id="v_parcela" name="v_parcela">
            <div id="v_parcela_div"></div>
            <hr>
            Total da Parcelas R$:
            <input type="hidden" id="t_parcela" name="t_parcela">
            <div id="t_parcela_div"></div>
        </div>
        <br />
        <div class="card">
            <div id="meios_pagamentos"></div>
            <br />
            <input class="btn btn-outline-dark" type="submit" @click="pagamento()" value="pagamento" />
        </div>
    </div>
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
