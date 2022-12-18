<script>
import axios from "axios";
import {ref} from "vue";

export default {
  setup() {
    const loading = ref(true);
    const posts = ref([]);

    /* Load Posts */
    axios.get('http://gateway.microservice.local/api/post')
        .then(function (response) {
          posts.value = response.data.data;
          loading.value = false;
        });


    return { posts, loading}
  }
}
</script>

<template>
  <main class="container py-3">
    <div class="mb-3 d-flex justify-content-end">
      <RouterLink :to="{ name: 'post.create' }" class="btn btn-dark">Create Post</RouterLink>
    </div>
    <div v-if="loading" class="spinner-border text-primary text-center" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>

    <div class="card mb-3"  v-for="post of posts" :key="post.id">
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text">{{ post.content }}</p>
        <p class="text-muted">{{ post.user.name }} [ {{ post.user.email }} ]</p>
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