<template>
  <h1>Home</h1>
</template>

<script>
export default {
  name: "Home",
  mounted() {
    axios
      .get("https://api.coindesk.com/v1/bpi/currentprice.json")
      .then((response) => (this.info = response));
  },
};
</script>
