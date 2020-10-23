import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const guest = (to, from, next) => {
  if(!localStorage.getItem('authToken')) {
    return next();
  } else {
    return next('/')
  }
}

const auth = (to, from, next) => {
  if(localStorage.getItem('authToken')) {
    return next();
  } else {
    return next('/login')
  }
}

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "Home" */ '../views/Home')
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/login',
    name: "Login",
    beforeEnter: guest,
    component: () => import(/* webpackChunkName: "Login" */ '../views/Auth/Login')
  },
  {
    path: '/register',
    name: 'Register',
    beforeEnter: guest,
    component: () => import(/* webpackChunkName: "register" */ '../views/Auth/Register')
  },
  {
    path: '/verify/:hash',
    name: 'Verify',
    beforeEnter: auth,
    props: true,
    component: () => import(/* webpackChunkName: "verify" */ '../views/Auth/Verify')
  },
  {
    path: '/forget-password',
    name: 'ForgetPassword',
    beforeEnter: guest,
    component: () => import(/* webpackChunkName: "forgotPassword" */'../views/Auth/ForgotPassword')
  },
  {
    path: '/confirm-forgot-password/',
    name: 'ConfirmForgotPassword',
    beforeEnter: guest,
    component: () => import(/* webpackChunkName: "confirmResetPassword" */ '../views/Auth/ConfirmResetPassword')
  },
  {
    path: '/posts',
    name: 'Posts',
    beforeEnter: auth,
    component: () => import('../views/Post/Posts')
  },
  {
    path: '/posts/:id',
    name: 'Post',
    beforeEnter: auth,
    component: () => import('../views/Post/Post')
  },
  {
    path: '/403',
    name: '403',
    component: () => import('../views/Errors/403')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
