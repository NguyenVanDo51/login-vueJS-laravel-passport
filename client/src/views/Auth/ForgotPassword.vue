<template>
  <div class="card mt-5 w-50 mx-auto">
    <div class="card-header">
      <h3>Forget password</h3>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" id="email" name="email" placeholder="Email" v-model="email">
        </div>
      </form>
      <button class="btn btn-primary" @click="sendMail">Get reset password link</button>
    </div>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  name: 'ForgetPassword',
  data: () => {
    return {
      email: ''
    }
  },

  methods: {
    sendMail() {
      axios.post(process.env.VUE_APP_API_URL + 'reset-password', {
        email: this.email,
        redirect: 'http://localhost:8080/confirm-forgot-password/'
       }).then(response => {
          console.log(response.data)
          localStorage.setItem('emailResetPassword', response.data.email)
          localStorage.setItem('tokenResetPassword', response.data.token)
      })
    }
  }
}
</script>
