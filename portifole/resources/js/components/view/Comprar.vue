<template>
  <div v-for="img in dados" :key="img">
    <div v-if="img.id == id">
      <h1>{{ img.nome }}</h1>
      <h1>{{ img.price }}</h1>
      <div v-for="(fotos, ii) in JSON.parse(img.img)" :key="fotos">
        <div v-if="ii == corx">
          <img :src="'storage/' + fotos" style="height: 200px; width: 200px" />
        </div>
      </div>
      <div v-for="(fotos, ii) in JSON.parse(img.img)" :key="fotos">
        <input type="button" @click="cor(ii)" :value="'cor ' + ii" />
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
  },
};
</script>
