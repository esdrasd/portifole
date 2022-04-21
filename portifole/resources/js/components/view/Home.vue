<template>
  <div v-for="i in dados" :key="i">
    <router-link :to="'/comprar/' + i.nome">
      <h1>{{ i.nome }} <br> R$ {{ i.price }}</h1>
      <img
        :src="'storage/' + JSON.parse(i.img)[0]"
        style="height: 200px; width: 200px"
        @click="produto(i.nome,i.id)"
      />
    </router-link>
    <hr />
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Home",
  data() {
    return {
      dados: [],
    };
  },
  mounted() {
    axios.get("show").then((res) => (this.dados = res.data));
  },
  methods:{
    produto(nome,id){
      sessionStorage.setItem(nome,id)
    }
  }
};
</script>
