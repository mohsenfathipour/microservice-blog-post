<script>
import axios from '@/axios';
import {ref} from "vue";
import {config} from "@/env";

export default {
  setup() {
    const loading = ref(true);
    const posts = ref([]);

    /* Load Posts */
    axios.get(config.gateway + '/post')
        .then(function (response) {
          posts.value = response.data.data;
          loading.value = false;
        });


    return {posts, loading}
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



    <div class="card mb-3" v-for="post of posts" :key="post.id">
      <div class="card-body">
        <router-link :to="{ name: 'post.show', params: { id: post.id } }">
          <h5 class="card-title">{{ post.title }}</h5>
        </router-link>
        <p class="card-text">{{ post.content }}</p>
      </div>
      <div class="card-footer d-flex justify-content-between">
        <small>Date: <b>{{ post.user.created_at.substring(0,10) }}</b></small>
        <small>Author: <b>{{ post.user.name }}</b></small>
        <small>Comments: <b>{{ post.comments_count}}</b></small>
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