<template>
  <input type="text" name="nome" id="nome" placeholder="nome"/>
  <input type="text" name="price" id="price" placeholder="price"/>
  <input type="file" name="img[]" id="img" multiple />
  <input type="submit" @click="add()" value="enviar" />
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
