import { createRouter, createWebHistory } from 'vue-router'

import Home from "@/components/home.vue";
import PostIndex from "@/components/post/index.vue";
import PostCreate from "@/components/post/create.vue";
import UserIndex from "@/components/user/index.vue";
import UserCreate from "@/components/user/create.vue";

import AuthLogin from "@/components/auth/login.vue";
import AuthLogout from "@/components/auth/logout.vue";
import AuthSignup from "@/components/auth/signup.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/post',
      name: 'post.index',
      component: PostIndex
    },
    {
      path: '/post/create',
      name: 'post.create',
      component: PostCreate
    },
    {
      path: '/user',
      name: 'user.index',
      component: UserIndex
    },
    {
      path: '/user/create',
      name: 'user.create',
      component: UserCreate
    },
    {
      path: '/auth/login',
      name: 'auth.login',
      component: AuthLogin
    },
    {
      path: '/auth/logout',
      name: 'auth.logout',
      component: AuthLogout
    },
    {
      path: '/auth/signup',
      name: 'auth.signup',
      component: AuthSignup
    }
  ]
})

export default router