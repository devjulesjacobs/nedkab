require("../bootstrap");
import Vue from "vue";
import router from "./router";
import store from "./store";
import 'animate.css';

Vue.component("App", require("./App.vue").default);

Vue.use(require('vue-moment'));

store.dispatch("auth/setValuesUser").then(() => {

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
