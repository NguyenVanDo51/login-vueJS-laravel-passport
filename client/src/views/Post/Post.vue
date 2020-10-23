<template>
  <div class="card mt-5">
    <div class="card-header">
      Post page
    </div>
    <div class="card-body" v-if="post">
      <p>ID: {{ post.id }}</p>
      <p>Description: {{ post.description }}</p>
      <p>Title: {{ post.title }}</p>
      <p>Created at: {{ post.created_at }}</p>
    </div>
    <div class="card-body" v-else>
      <p class="text-danger">{{ errors.error }}</p>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'Post',

  computed: {
    ...mapGetters('post', ['post']),
    ...mapGetters(["errors"])
  },

  methods: {
    ...mapActions('post', ['getPost'])
  },
  mounted() {
    this.getPost(this.$route.params.id)
  }
}
</script>
