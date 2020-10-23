<template>
  <div class="card mt-5">
    <div class="card-header">
      Home page
    </div>
    <div class="card-body">
      <h2 v-if="!user">Welcome, please log in or register</h2>
      <h2 v-else>Hello, {{ user.name }}! You're in.</h2>
      <div>
        <router-link :to="{name: 'Posts'}">Posts </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  name: "Home",

  data: () => {
    return {
      success: null,
      error: null
    }
  },
  computed: {
    ...mapGetters('auth', ['user'])
  },

  methods: {
    ...mapActions('auth', ['sendVerifyResendRequest']),

      verifyResend() {
      this.success = this.error = null
      this.sendVerifyResendRequest()
        .then(() => {
          this.success = "A fresh verification link has been sent to your email address.";
        })
        .catch(error => {
          this.error = "Error sending verification link"
          console.log(error.response)
        })
    }
  }
}
</script>
