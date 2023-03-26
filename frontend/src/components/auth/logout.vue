<script>
import axios from "axios";

export default {
  setup() {

    localStorage.removeItem('token');
    axios.defaults.headers.common = {'Authorization': ``}
    window.location.href = '/auth/login';
  }
};
</script>

<template></template>

<style scoped>

</style>