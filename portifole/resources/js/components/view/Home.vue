<template>
  <!-- {{ Object.assign(JSON.parse(info[0].img))[0] }} -->
  {{ Object.assign(JSON.parse(info[0].img))[0] }}
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
    axios.get("show").then((res) => (this.info = res.data));
  },
};
</script>
