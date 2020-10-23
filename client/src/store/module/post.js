import axios from "axios"

export default {
    namespaced: true,

    state: {
        posts: null, // posts.index
        post: null,  // posts.show
    },

    getters: {
        posts: state => state.posts,
        post: state => state.post
    },

    mutations: {
      setPostsData(state, posts) {
          state.posts = posts
      },
        setPost(state, post) {
          state.post = post
        }
    },

    actions: {
        getPostsData({commit}) {
            commit("setErrors", {}, {root: true})
            axios.get(process.env.VUE_APP_API_URL + "posts")
                .then(response => {
                    commit("setPostsData", response.data)
                })
                .catch(error => {
                    if(error.response.status === 403) {
                        console.log("unauthorize")
                        commit("setErrors", {"error": "unauthorize!"}, {root: true})
                    }
                })
        },
        getPost({commit}, id) {
            axios.get(process.env.VUE_APP_API_URL + "posts/" + id)
                .then(response => {
                    commit("setPost", response.data)
                })
                .catch(error => {
                    if(error.response.status === 403) {
                        console.log("unauthorize")
                        commit("setErrors", {"error": "unauthorize!"}, {root: true})
                    }
                })
        }
    },
}
