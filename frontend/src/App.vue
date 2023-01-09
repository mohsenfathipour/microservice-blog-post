<script setup>
import {RouterLink, RouterView} from 'vue-router'
</script>

<template>

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">MicroService</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink :to="{ name:'home'}" class="nav-link active" aria-current="page" href="#">Home</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink :to="{ name:'post.index'}" class="nav-link" aria-current="page" href="#">Post</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink :to="{ name:'user.index'}" class="nav-link" aria-current="page" href="#">User</RouterLink>
            </li>
          </ul>
          <div class="d-flex">
            <a class="btn btn-outline-secondary">Login</a>
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
