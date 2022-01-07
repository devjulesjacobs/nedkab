import axios from "axios";

import router from "../router";

let self = this;

export default {
    namespaced: true,

    state: {
        authenticated: false,
        user: null,
        notifications: []
    },

    getters: {
        authenticated(state) {
            return state.authenticated;
        },

        user(state) {
            return state.user;
        },

        getNotifications(state) {
            return state.notifications
        }
    },

    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value;
        },

        SET_USER(state, value) {
            state.user = value;
        },

        PUSH_NOTIFICATION(state, notification) {
            state.notifications.push({
                ...notification,
                id: (Math.random().toString(36)+Date.now().toString(36)).substr(2)
            })
        },

        REMOVE_NOTIFICATION(state, notificationToRemove) {
            state.notifications = state.notifications.filter(notification => {
                return notification.id != notificationToRemove.id;
            })
        }
    },

    actions: {
        async login({ dispatch }, credentials) {
            await axios.get("/sanctum/csrf-cookie");
            try {
                await axios.post("/api/app/login", credentials)
                return dispatch("setValues");
            } catch {
                dispatch('addNotification', {
                    type: 'error',
                    title: 'Fout bij inloggen',
                    message: 'Emailadres en/of wachtwoord is onjuist.',
                    timer: 3000
                })
            }
        },
        async logout({ dispatch }) {
            await axios.post("/logout");

            return dispatch("setValues");
        },

        setValuesUser({ commit }) {
            return axios
                .get("/api/user")
                .then((response) => {
                    if(response.data.type === "app") {
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
        addNotification({ commit }, notification) {
            commit('PUSH_NOTIFICATION', notification);
        },
        removeNotification({ commit }, notification) {
            commit('REMOVE_NOTIFICATION', notification);
        }
    },
};
