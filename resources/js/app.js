require('./bootstrap');

import Vue from 'vue';
import VueMeta from 'vue-meta'
import { App, plugin } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(plugin);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VueSweetalert2);
Vue.use(VueMeta);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(App, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
