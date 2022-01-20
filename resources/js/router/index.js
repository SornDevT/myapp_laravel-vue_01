import { createWebHistory, createRouter } from "vue-router";

import Store from "../pages/Store.vue";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import Report from "../pages/Report.vue";
import Transection from "../pages/Transection.vue";
import Pos from "../pages/Pos.vue";
import Notfound from "../pages/Notfound.vue"

export const routes = [
    {
        name: "store",
        path: "/store",
        component: Store,
    },
    {
        name: "transection",
        path:"/transection",
        component: Transection,
    },
    {
        name: "report",
        path:"/report",
        component: Report,
    },
    {
        name: "login2",
        path:"/",
        component: Login,
    },
    {
        name: "login",
        path:"/login",
        component: Login,
    },
    {
        name: "register",
        path:"/register",
        component: Register,
    },
    {
        name: "pos",
        path:"/pos",
        component: Pos,
    },
    {
        path: "/:catchAll(.*)",
        component: Notfound,
      },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior() {
        window.scrollTo(0, 0);
    }
});

export default router;
