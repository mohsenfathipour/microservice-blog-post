<script>
import {reactive, ref} from "vue";
import axios from "axios";
import router from "@/router";
import {config} from "@/env";

export default {
  setup() {

    localStorage.removeItem('token');
    axios.defaults.headers.common = {'Authorization': ``}
    router.push('/auth/login');

  }
};
</script>

<template></template>

<style scoped>

</style>