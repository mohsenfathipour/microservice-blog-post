<script>


import {reactive, ref} from "vue";
import axios from '@/axios';
import router from "@/router";
import {config} from "@/env";

export default {
  setup() {
    const users = ref([]);
    const post = reactive({
      title: "",
      content: ""
    });
    const loading = ref(false);

    /* Load Users */
    axios.get(config.gateway + '/user')
        .then(function (response) {
          users.value = response.data.data;
        });


    function create() {
      loading.value = true;
      axios.post(config.gateway + '/post', {
        title: post.name,
        content: post.content
      })
          .then(function (response) {
            if(!response.data.success){
              alert(response.data.message);
              return;
            }

            loading.value = false;
            router.push('/post');
          });
    }


    return {post, create, loading, users};

  }
}
</script>

<template>
  <main class="container py-3">
    <form class="w-50" @submit.prevent="create">
      <h3>Create New Post</h3>
      <div class="my-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" v-model.lazy.trim="post.name">
      </div>
      <div class="my-3">
        <label class="form-label">Content</label>
        <textarea v-model.lazy.trim="post.content" class="form-control" rows="4"></textarea>
      </div>
      <button type="submit" class="btn btn-dark" :disabled="loading">
        <div v-if="loading" class="spinner-border spinner-border-sm text-light me-2" role="status"></div>
        Submit
      </button>
    </form>
  </main>
</template>
