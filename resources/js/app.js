import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h } from 'vue';


import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import './font-awesome.js';

import 'startup-ui/dist/index.css' 

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => {
        const pages = import.meta.glob('../../resources/views/pages/**/*.vue', { eager: true })
        const page = pages[`../views/pages/${name}.vue`]
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('FontAwesomeIcon', FontAwesomeIcon)
            .mount(el);
    },
});