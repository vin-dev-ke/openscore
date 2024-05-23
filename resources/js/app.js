// import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import VueChartkick from 'vue-chartkick';
import 'chartkick/chart.js';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'OpenScore | Scam Reports Forum';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        // Dynamically add Chartkick CSS to the document head
        const link = document.createElement('link');
        link.href = "https://cdn.jsdelivr.net/npm/chartkick@3/dist/chartkick.min.css";
        link.rel = "stylesheet";
        document.head.appendChild(link);

        return createApp({ render: () => h(App, props) })
           .use(plugin)
           .use(ZiggyVue, Ziggy)
           .mount(el);
    },
    progress: {
        color: '#00ff00',
    },
});
