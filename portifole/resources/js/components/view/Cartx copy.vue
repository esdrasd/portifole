<template>
  <h1>PRICE</h1>
  <input type="text" name="price" :value="price1" />
  <hr />
  <div v-for="(i, id) in dados" :key="i">
    <div v-for="x in dados" :key="x">
      <div v-if="i.id !== x.id">
        <h1>{{ i.id }}</h1>
        <h1>{{ i.nome }}</h1>
        <h1>{{ i.price }}</h1>
        <p>
          <img :src="'storage/' + i.img" style="height: 200px; width: 200px" />
        </p>
        <input type="button" @click="del(id)" value="click" />
        <hr />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Cart",
  data() {
    return {
      dados: "",
      price1: 0,
    };
  },
  mounted() {
    this.dados = JSON.parse(sessionStorage.getItem("cart"));
    for (let i = 0; i < this.dados.length; i++) {
      this.price1 += JSON.parse(this.dados[i].price);
    }
  },
  methods: {
    del(id) {
      this.price1 -= JSON.parse(this.dados[id].price);
      this.dados.splice(id, 1);
      var x = JSON.stringify(this.dados);
      sessionStorage.setItem("cart", x);
    },
  },
};
</script>
