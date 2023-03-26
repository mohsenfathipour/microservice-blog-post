<script>


import {ref} from "vue";
import axios from "axios";

export default {
  setup() {
    const is_logged = ref(false);
    let token = localStorage.getItem('token');

    if (token) {
      axios.defaults.headers.common = {'Authorization': `Bearer ${token}`};
      is_logged.value = true;
    }

    return {is_logged, token};
  }
}
</script>

<template>

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">MicroService</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink :to="{ name:'home'}" class="nav-link active" aria-current="page" href="#">Home</RouterLink>
            </li>
            <li class="nav-item" v-if="is_logged">
              <RouterLink :to="{ name:'post.index'}" class="nav-link" aria-current="page" href="#">Post</RouterLink>
            </li>
            <li class="nav-item" v-if="is_logged">
              <RouterLink :to="{ name:'user.index'}" class="nav-link" aria-current="page" href="#">User</RouterLink>
            </li>
          </ul>
          <div class="d-flex" v-if="!is_logged">
            <RouterLink :to="{ name:'auth.login'}" class="btn btn-outline-secondary" aria-current="page" href="#">
              Login
            </RouterLink>
          </div>
          <div class="d-flex" v-if="is_logged">
            <RouterLink :to="{ name:'auth.logout'}" class="btn btn-outline-danger" aria-current="page" href="#">Logout
            </RouterLink>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <RouterView/>

  <div class="container">
    <footer class="py-3 my-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
      </ul>
      <p class="text-center text-muted">© 2023 Microservice</p>
    </footer>
  </div>

</template>

<style scoped>
</style>
