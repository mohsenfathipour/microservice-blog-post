<script>
import axios from '@/axios';
import {ref} from "vue";
import {config} from "@/env";

export default {
  setup() {
    const loading = ref(true);
    const users = ref([]);

    /* Load Users */
    axios.get(config.gateway + '/user')
        .then(function (response) {
          users.value = response.data.data;
          loading.value = false;
        });


    return { users, loading}
  }
}
</script>

<template>

  <main class="container py-3">

    <div class="mb-3 d-flex justify-content-end">
      <RouterLink :to="{ name: 'user.create' }" class="btn btn-dark">Create User</RouterLink>
    </div>

    <div v-if="loading" class="spinner-border text-primary text-center" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>

    <div class="card mb-3"  v-for="user of users" :key="user.id">
      <div class="card-body">
        <h5 class="card-title">{{ user.name }}</h5>
        <p class="card-text">{{ user.email }}</p>
      </div>
    </div>

  </main>

</template>


<style scoped>
.spinner-border {
  display: block;
  margin: 3rem auto;
}
</style>