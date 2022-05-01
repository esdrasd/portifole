<template>
  <NavbarOP />
  <router-view />
</template>

<script>
import NavbarOP from "./view/NavbarOP.vue";
export default {
  name: "App",
  components: {
    NavbarOP,
  },
};
</script>
