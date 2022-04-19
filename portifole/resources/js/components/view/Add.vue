<template>
  <input type="text" name="nome" placeholder="Nome" />
  <input type="text" name="price" placeholder="Price" />
  <label for="file">selecione as imagens</label>
  <input type="submit" @click="add()" value="enviar" />
  <input
    type="file"
    id="file"
    style="visibility: hidden"
    name="img[]"
    multiple
  />
</template>

<script>
export default {
  name: "Add",
  methods: {
    add() {
      document.getElementById("form").action = "add";
    },
  },
};
</script>
