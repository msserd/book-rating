import { createInertiaApp, Link, Head } from '@inertiajs/vue3';
import { createApp, h } from 'vue';

import * as filters from './filters.js';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import './font-awesome.js';

import 'startup-ui/dist/index.css' 

import Admin from '../views/layouts/Admin.vue';
import '../css/app.scss';

const appName = 'Book rating';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => {
        const pages = import.meta.glob('../../resources/views/pages/**/*.vue', { eager: true })
        const page = pages[`../views/pages/${name}.vue`]
        page.default.layout ??= Admin;
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Link', Link)
            .component('Head', Head)
            .component('font-awesome-icon', FontAwesomeIcon);

        // Глобальные фильтры, которые будут полезны в любых Vue-файлах
        app.provide('$filters', filters);

        app.mount(el);
    },
});