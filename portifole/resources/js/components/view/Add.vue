<template>
  <input type="file" name="img" multiple accept="image/*" />
  <input type="submit" @click="add()" />
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
