<template>
  <div class="login mt-5 w-50 mx-auto">
    <div class="card">
      <div class="card-header">
        Login
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="email">Email address</label>
            <input
                type="email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                id="email"
                v-model="details.email"
                placeholder="Enter email"
            />
            <div class="invalid-feedback" v-if="errors.email">
              {{ errors.email[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                id="password"
                v-model="details.password"
                placeholder="Password"
            />
            <div class="invalid-feedback" v-if="errors.password">
              {{ errors.password[0] }}
            </div>
          </div>
          <div v-if="errors.error" class="my-2">
            {{ errors.error }}
          </div>

          <button type="button" @click="login" class="btn btn-primary">
            Login
          </button>
          <div class="mt-2">
            <router-link :to="{name: 'ForgetPassword'}">Forget password?</router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import {mapGetters, mapActions} from 'vuex'

export default {
  name: 'Home',

  data: () => {
    return {
      details: {
        email: null,
        password: null
      },
      invalid: null
    }
  },

  computed: {
    ...mapGetters(['errors'])
  },

  methods: {
    ...mapActions('auth', ['sendLoginRequest']),

    login: function () {
      this.sendLoginRequest(this.details)
          .catch(error => {
            if (error.response.status === 403) {
              this.$store.commit('setErrors', {"error": 'invalid-credentials!'}, {root: true})
            }
          })
    }
  }
}
</script>
