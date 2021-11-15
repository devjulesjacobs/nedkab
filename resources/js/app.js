require("./bootstrap");
import Vue from "vue";
import router from "./router";
import store from "./store/index";

Vue.component("App", require("./App.vue").default);

store.dispatch("auth/me").then(() => {

    router.beforeEach((to, from, next) => {
        if (to.matched.some((record) => record.meta.requiresAuth)) {

            if (!store.getters['auth/authenticated']) {
                next({ name: 'Signin' });
            } else {
                next();
            }

        } else {
            next();
        }
    });

    new Vue({
        el: "#app",
        router,
        store,
    });
});
