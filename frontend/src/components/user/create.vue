<script>
import {reactive, ref} from "vue";
import axios from '@/axios';
import router from "@/router";
import {config} from "@/env";
import Swal from "sweetalert2";

export default {
  setup() {
    const user = reactive({
      name: "",
      email: "",
      password: "",
    });
    const loading = ref(false);

    function createUser() {
      loading.value = true;
      axios.post(config.gateway + '/user', {
        name: user.name,
        email: user.email,
        password: user.password,
      })
          .then(function (response) {
            loading.value = false;

            if (!response.data.success) {

              Swal.fire({
                title: 'User Create Error',
                text: response.data.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
              return;

            }

            Swal.fire({
              title: 'User Created',
              text: 'User created successfully',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              router.push('/user');
            });
          });
    }

    return {user, createUser, loading};
  },
};
</script>

<template>
  <main class="container py-3">
    <form class="w-50" @submit.prevent="createUser">
      <h3>Create New User</h3>
      <div class="my-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" v-model.lazy.trim="user.name">
      </div>
      <div class="my-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" v-model.lazy.trim="user.email">
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" v-model.lazy.trim="user.password">
      </div>
      <button type="submit" class="btn btn-dark" :disabled="loading">
        <div v-if="loading" class="spinner-border spinner-border-sm text-light me-2" role="status"></div>
        Submit
      </button>
    </form>
  </main>
</template>
