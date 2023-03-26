<template>
  <div class="comment-form my-3">
    <form @submit.prevent="submitComment">
      <div class="mb-3">
        <label for="content" class="form-label">text:</label>
        <textarea id="content" class="form-control" v-model="commentContent" required></textarea>
      </div>
      <button type="submit" class="btn btn-dark" :disabled="loading">
        <div v-if="loading" class="spinner-border spinner-border-sm text-light me-2" role="status"></div>
        Submit
      </button>
    </form>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import axios from 'axios';
import {config} from "@/env";
import router from "@/router";
import Swal from "sweetalert2";

export default defineComponent({
  props: {
    postId: {
      type: Number,
      required: true
    }
  },
  setup(props) {
    const commentContent = ref('');
    const loading = ref(false);

    function submitComment() {
      loading.value = true;
      const commentData = {
        post_id: props.postId,
        content: commentContent.value
      };
      axios.post(config.gateway + '/post/' + props.postId + '/comment', commentData)
          .then(response => {
            loading.value = false;
            // handle successful response
            console.log(response.data);
            // clear the form field
            commentContent.value = '';

            Swal.fire({
              title: 'Comment Created',
              text: 'Comment created successfully',
              icon: 'success'
            }).then(() => {
              window.location.href = '/post/show/' + props.postId;
              });

          })
          .catch(error => {
            // handle error
            console.log(error);
          });
    }

    return {
      commentContent,
      submitComment,
      loading
    };
  }
});
</script>

<style scoped>
/* add any custom styles for the comment form component */
</style>
