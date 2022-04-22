<template>
  <h1>price:</h1>
  <input type="hidden" id="produto" name="produto" />
  <input type="text" name="price" :value="price" />
  <input type="submit" @click="pagamento()" value="pagamento" />
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
      modo:''
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
      document.getElementById("produto").value = JSON.stringify(this.dados);
      document.getElementById("form").action = "boleto";
    },

  },
};
</script>

<style>
</style>
