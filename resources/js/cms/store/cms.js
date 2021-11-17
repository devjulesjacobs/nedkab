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

            return dispatch("setValuesAdmin");
        },

        async logout({ dispatch }) {
            await axios.post("/logout");

            return dispatch("setValuesAdmin");
        },

        setValuesAdmin({ commit }) {
            return axios
                .get("/api/user")
                .then((response) => {
                    if(response.data.type === "admin") {
                        commit("SET_AUTHENTICATED", true);
                        commit("SET_USER", response.data);
                    } else {
                        commit("SET_AUTHENTICATED", false);
                        commit("SET_USER", null);
                    }
                })
                .catch(() => {
                    commit("SET_AUTHENTICATED", false);
                    commit("SET_USER", null);
                });
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
