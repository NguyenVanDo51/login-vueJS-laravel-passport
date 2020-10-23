<template>
  <div class="about">
    <h1>This is an post page</h1>
    <div v-if="errors.error" class="text-danger">
      {{ errors.error }}
    </div>
    <div class="mt-3" v-else>
      <table class="table-light table table-sm table-striped">
        <thead>
          <th>ID</th>
          <th>Description</th>
          <th>Title</th>
          <th>Action</th>
        </thead>
        <tbody>
          <tr v-for="post in posts" v-bind:key="post.id">
            <td>{{ post.id }}</td>
            <td>{{ post.description }}</td>
            <td>{{ post.title }}</td>
            <td><button class="btn btn-primary btn-sm" @click="viewPost(post.id)">Details</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import {mapGetters, mapActions} from 'vuex'

export default {
  name: 'Posts',

  computed: {
    ...mapGetters("post", ["posts"]),
    ...mapGetters(["errors"])
  },
  mounted() {
    this.getPostsData()
  },
  methods: {
    ...mapActions('post', ['getPostsData']),
    viewPost(id) {
      this.$router.push({name: 'Post', params: {id: id}}, )
    }
  }
}
</script>
