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
        </div>
      </div>
    </nav>
  </header>

  <RouterView/>

</template>

<style scoped>
</style>
