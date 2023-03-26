<script>
import axios from '@/axios';
import {ref} from "vue";
import {config} from "@/env";
import CommentForm from './comment-form.vue';

export default {
  components: {
    CommentForm
  },
  props: {
    id: Number
  },
  setup(props) {
    const loading = ref(true);
    const post = ref([]);

    /* Load Posts */
    axios.get(config.gateway + '/post/' + props.id )
        .then(function (response) {
          post.value = response.data.data;
          loading.value = false;
        });
    return {post, loading}
  }
}
</script>

<template>

  <main class="container py-3">
    <div class="mb-3 d-flex justify-content-start">
      <RouterLink :to="{ name: 'post.index' }" class="btn btn-outline-dark"> « Back</RouterLink>
    </div>
    <div v-if="loading" class="spinner-border text-primary text-center" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>



    <div class="card border-0 bg-light mb-3" v-if="!loading">
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text my-4">{{ post.content }}</p>
      </div>
      <div class="card-footer border-0 d-flex justify-content-between">
        <small>Author: <b>{{ post.user.name }}</b></small>
        <small>Comments: <b>{{ post.comments.length }}</b></small>
      </div>
    </div>

    <div v-if="!loading">
      <h6 >Comments:</h6>

      <!-- display the comment form component -->
      <comment-form :postId="post.id"></comment-form>

      <div class="card mb-3" v-for="comment of post.comments" :key="comment.id">
        <div class="card-body">
          <router-link :to="{ name: 'post.show', params: { id: post.id } }">
            <h5 class="card-title">{{ comment.title }}</h5>
          </router-link>
          <p class="card-text">{{ comment.content }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
          <small>Date: <b>{{ comment.user.created_at.substring(0,10) }}</b></small>
          <small>Author: <b>{{ comment.user.name }}</b></small>
        </div>
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