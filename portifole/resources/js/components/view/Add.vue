<template>
  <input type="file" name="img[]" multiple/>
  <input type="submit" @click="add()" value='enviar'/>
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
