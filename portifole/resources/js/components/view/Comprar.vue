<template>
  <div v-for="i in array" :key="i">
    <div v-if="i.nome == nome_produto">
      <div v-if="i.id == id_produto">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-4">
              <div v-for="img in JSON.parse(i.img)" :key="img">
                <img :src="'storage/' + img" alt="" width="200" height="200" />
              </div>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h1 class="card-title">{{ i.nome }}</h1>
                <h1 class="card-text">{{ i.price }}</h1>
                <h1>Descricao</h1>
              </div>
            </div>
            <input
              type="button"
              class="form-control btn btn-outline-dark"
              value="add ao carrinho"
              @click="add(i)"
            />
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
      array: [],
      id_produto: 0,
      vetor: [],
      vetor2: "",
    };
  },
  props: {
    nome_produto: String,
  },
  mounted() {
    axios.get("show").then((res) => (this.array = res.data));
    this.id_produto = JSON.parse(sessionStorage.getItem(this.nome_produto));
  },
  methods: {
    add(i) {
      if (typeof sessionStorage.getItem("cart") === "string") {
        this.vetor2 = JSON.parse(sessionStorage.getItem("cart"));
        for (let index = 0; index < this.vetor2.length; index++) {
          this.vetor.push(this.vetor2[index]);
        }
        this.vetor.push(i);
        sessionStorage.setItem("cart", JSON.stringify(this.vetor));
        this.vetor.splice(0);
      } else {
        this.vetor.push(i);
        sessionStorage.setItem("cart", JSON.stringify(this.vetor));
      }
    },
  },
};
</script>
