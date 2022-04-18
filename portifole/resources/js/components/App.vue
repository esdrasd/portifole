<template>
  <router-link to='/'>Home</router-link> ||
  <router-link to='/add'>Add</router-link> ||
  <hr>
  <router-view></router-view>
</template>

<script>
export default {
  name: "App",
};
</script>
