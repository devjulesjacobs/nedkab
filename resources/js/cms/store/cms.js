import axios from "axios";

export default {
    namespaced: true,

    state: {
        authenticated: false,
        admin: null,
        notifications: []
    },

    getters: {
        authenticated(state) {
            return state.authenticated;
        },

        admin(state) {
            return state.admin;
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
            state.admin = value;
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
        addNotification({ commit }, notification) {
            commit('PUSH_NOTIFICATION', notification);
        },
        removeNotification({ commit }, notification) {
            commit('REMOVE_NOTIFICATION', notification);
        }
    },
};
