require("./bootstrap");
import Vue from "vue";
import router from "./router";
import store from "./store/app";

Vue.component("App", require("./views/app/App.vue").default);

store.dispatch("auth/setValues").then(() => {

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
