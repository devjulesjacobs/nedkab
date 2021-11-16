import axios from "axios";

export default {
    namespaced: true,

    state: {
        adminsAuthenticated: false,
        admin: null,
    },

    getters: {
        authenticated(state) {
            return state.adminsAuthenticated;
        },

        admin(state) {
            return state.admin;
        }
    },

    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.adminsAuthenticated = value;
        },

        SET_USER(state, value) {
            state.admin = value;
        },
    },

    actions: {
        async login({ dispatch }, credentials) {
            await axios.get("/sanctum/csrf-cookie");
            await axios.post("/api/cms/login", credentials);

            return dispatch("setValues");
        },

        async logout({ dispatch }) {
            await axios.post("/logout");

            return dispatch("setValues");
        },

        setValues({ commit }) {
            return axios
                .get("/api/user")
                .then((response) => {
                    commit("SET_AUTHENTICATED", true);
                    commit("SET_USER", response.data);
                })
                .catch(() => {
                    commit("SET_AUTHENTICATED", false);
                    commit("SET_USER", null);
                });
        },
    },
};
