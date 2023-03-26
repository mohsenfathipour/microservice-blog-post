<script>
import {reactive, ref} from "vue";
import axios from "axios";
import router from "@/router";
import {config} from "@/env";

export default {
  setup() {
    const user = reactive({
      email: "",
      password: "",
    });
    const error = reactive({
      message: null
    });
    const loading = ref(false);

    function login() {
      loading.value = true;
      axios.post(config.gateway + '/auth/login', {
        email: user.email,
        password: user.password,
      })
          .then(function (response) {
            loading.value = false;
            if(!response.data.success){
              error.message = response.data.message;
              return;
            }

            let token = response.data.data.token;
            localStorage.setItem('token',token);
            axios.defaults.headers.common = {'Authorization': `Bearer ${token}`};
            window.location.href = '/';
          });
    }

    return {user, error, login, loading};
  }
};
</script>

<template>
  <main class="container py-3">
    <div class="row">

      <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="error.message">
        <strong>Error!</strong> {{error.message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <form class="col-md-4" @submit.prevent="login">
        <div class="mb-3">
          <label for="inputEmail" class="form-label">Email address</label>
          <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp"
                 v-model.lazy.trim="user.email">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="inputPassword" class="form-label">Password</label>
          <input name="password" type="password" class="form-control" id="inputPassword" v-model.lazy.trim="user.password">
        </div>
        <button type="submit" class="btn btn-dark" :disabled="loading">
          <div v-if="loading" class="spinner-border spinner-border-sm text-light me-2" role="status"></div>
          Login
        </button>
      </form>
    </div>
  </main>
</template>

<style scoped>

</style>