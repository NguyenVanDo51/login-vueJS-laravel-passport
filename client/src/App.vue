<template>
  <div id="app">
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <router-link class="navbar-brand" to="/">Logo</router-link>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link class="nav-link" :to="{name: 'Home'}">Home</router-link>
            </li>
            <li class="nav-item" v-show="!user">
              <router-link class="nav-link" :to="{name: 'Login'}">Login</router-link>
            </li>
            <li class="nav-item" v-show="!user">
              <router-link class="nav-link" :to="{name: 'Register'}">Register</router-link>
            </li>
            <li class="nav-item" v-show="user">
              <a class="nav-link" @click="logout" style="cursor: pointer;">Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <main role="main" class="container">
      <router-view/>
    </main>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  computed: {
    // Lay ra cac gia tri auth(module), user(du lieu user)
    ...mapGetters('auth', ['user'])
  },

  // Bat cu khi nao load trang thi lay thong tin nguoi dung xe da dang nhap chua
  mounted() {
    if(localStorage.getItem("authToken")) {
      // Neu da co token thi lay du lieu nguoi dung
      this.getUserData()
    }
  },

  methods: {
    ...mapActions('auth', ['sendLogoutRequest', 'getUserData']),
    logout() {
      this.sendLogoutRequest()
      // gui request logout sau do quay ve '/'
      this.$router.push({name: 'Home'})
    }
  }
}
</script>
<style>
body > div > .container {
  padding: 60px 15px 0;
}
</style>
