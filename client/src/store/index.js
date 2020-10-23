import Vue from 'vue'
import Vuex from 'vuex'
import auth from "@/store/module/auth"
import api from '@/store/module/user'
import post from "@/store/module/post";

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        errors: []
    },
    getters: {
        errors: state => state.errors
    },
    mutations: {
        setErrors(state, errors) {
            state.errors = errors
        }
    },
    actions: {},
    modules: {
        auth,
        api,
        post,
    }
})
