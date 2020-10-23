import axios from "axios";
import router from "@/router";

export default {
    namespaced: true,

    state: {
        userData: null
    },

    getters: {
        user: state => state.userData
    },

    mutations: {
        setUserData(state, user) {
            state.userData = user;
        }
    },

    actions: {
        getUserData({commit}) {
            axios
                .get(process.env.VUE_APP_API_URL + "user")
                .then(response => {
                    // Neu lay duoc thong tin user thi set state
                    commit("setUserData", response.data)
                })
                .catch(() => {
                    // neu co loi thi xoa du lieu authToken trong localStorage
                    localStorage.removeItem("authToken")
                });
        },
        sendLoginRequest({commit}, data) {
            // Ban dau dat loi bang {}, {root: true} de co the commit mutations o state cha
            commit("setErrors", {}, {root: true});

            return axios
                .post(process.env.VUE_APP_API_URL + "login", data)
                .then(response => {
                    commit("setUserData", response.data.user);
                    localStorage.setItem("authToken", response.data.token);
                    router.push({name: 'Home'})
                })
        },

        // Gui request dang ky, commit la 1 function commit mac dinh, data la du lieu nguoi dung nhap vao
        sendRegisterRequest({commit}, data) {
            commit("setErrors", {}, {root: true});
            return axios
                .post(process.env.VUE_APP_API_URL + "register", data)
                .then(response => {
                    commit("setUserData", response.data.user);
                    localStorage.setItem("authToken", response.data.token);
                });
        },

        sendLogoutRequest({commit}) {
            axios.post(process.env.VUE_APP_API_URL + "logout").then(() => {
                commit("setUserData", null);
                localStorage.removeItem("authToken");
            }).catch(error => {
                console.log("error", error)
            })
        },

        sendVerifyResendRequest() {
            return axios.get(process.env.VUE_APP_API_URL + "email/resend");
        },

        sendVerifyRequest({dispatch}, hash) {
            return axios
                .get(process.env.VUE_APP_API_URL + "email/verify/" + hash)
                .then(() => {
                    dispatch("getUserData");
                });
        }
    }
};
