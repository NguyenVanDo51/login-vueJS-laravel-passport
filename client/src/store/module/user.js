import axios from 'axios'

export default {
    namespaced: true,

    state: {
        users: null
    },

    getters: {
        users: state => state.users
    },

    mutations: {
        setDataUsers(state, users) {
            state.data = users
        }
    },

    actions: {
        getUsers({commit}) {
            axios.get(process.env.VUE_APP_API_URL + 'users')
                .then(response => {
                    commit("setDataUsers", response.data)
                    console.log(response.data)
                })
        }
    }
}