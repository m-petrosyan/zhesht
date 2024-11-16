import '../css/app.css';
import '@splidejs/vue-splide/css/sea-green';
import './bootstrap';
import '../css/main.scss';
// import "@splidejs/vue-splide/css";
// import '@splidejs/vue-splide/css/skyblue';
// import '@vueup/vue-quill/dist/vue-quill.bubble.css';
// import '@vueup/vue-quill/dist/vue-quill.core.css';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createApp, h} from 'vue';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import VueSplide from '@splidejs/vue-splide';


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title ? title + ' - ' + appName : appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .use(VueSplide)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
