<template>
  <div v-for="(dados, id) in info" :key="dados">
    <router-link
      :to="'/comprar/' + dados.nome"
      @click="add(dados.nome, dados.id)"
    >
      {{ id }}
      <div v-for="img in JSON.parse(dados.img)" :key="img">
        <img :src="'storage/' + img" alt="" width="200" height="200" />
      </div>
      {{ dados.nome }} //
      {{ dados.price }}
      <hr />
    </router-link>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Home",
  data() {
    return {
      info: "",
    };
  },
  mounted() {
    sessionStorage.setItem("cart", "[]");
    axios.get("show").then((response) => (this.info = response.data));
  },
  methods: {
    add(nome, id) {
      sessionStorage.setItem(nome, id);
    },
  },
};
</script>
