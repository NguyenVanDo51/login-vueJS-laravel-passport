<template>
  <div class="card mt-5 mx-auto w-50">
    <div class="card-header">
      <h3>Confirm reset password</h3>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="email">Email</label>
          <input class="form-control" v-model="email" type="email" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                 v-model="password">
          <div class="invalid-feedback">
            {{ errors.password[0] }}
          </div>
        </div>
        <div class="text-danger">
          <span>{{ error }}</span>
        </div>
      </form>
      <button class="btn btn-primary" @click="sendResetPassword">Get reset password link</button>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import {mapGetters} from 'vuex'

export default {
  name: 'ForgetPassword',
  data: () => {
    return {
      email: localStorage.getItem('emailResetPassword'),
      password: null,
      error: null
    }
  },
  computed: {
    ...mapGetters(["errors"])
  }
  ,
  mounted() {
  },

  methods: {
    sendResetPassword() {
      this.$store.commit("setErrors", {})
      axios.put(process.env.VUE_APP_API_URL + 'confirm-reset-password', {
        token: localStorage.getItem('tokenResetPassword'),
        password: this.password
      }).then(response => {
        console.log(response.data)
        this.$router.push({name: 'Login'})
      }).catch(error => {
        if (error.response.status === 404) {
          this.error = "Token invalid"
        }else {
          this.error = error.data.errors
        }
      })
    }
  }
}
</script>