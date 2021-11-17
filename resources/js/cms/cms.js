require("../bootstrap");
import Vue from "vue";
import router from "./router";
import store from "./store";

Vue.component("Cms", require("./Cms.vue").default);

store.dispatch("cms/setValuesAdmin").then(() => {

    router.beforeEach((to, from, next) => {
        if (to.matched.some((record) => record.meta.requiresAdmin)) {

            if (!store.getters['cms/authenticated']) {
                next({ name: 'CmsSignin' });
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
