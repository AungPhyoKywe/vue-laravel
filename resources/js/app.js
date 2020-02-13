import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from "vue-resource"
Vue.use(VueResource);
Vue.use(VueRouter);

import App from './components/App'
import Hello from './components/Hello'
import Home from './components/Home'
import Edit from './components/EditComponent'
import articles from "./components/articles";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path: '/create',
            name: 'create',
            component: articles,
        },
        {
            path: '/posts/create',
            component: articles,
        },
        {
            path: '/edit/:id',
            name: 'edit',
            component: Edit
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
