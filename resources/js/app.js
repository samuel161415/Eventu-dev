import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { createPinia } from 'pinia';
import { useDarkModeStore } from '@/Stores/darkMode.js';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faMapMarkerAlt, faUsers, faDollarSign, faRing, faSearch, faHeart, faCheck, faPencil, faTimes, faEyeSlash } from '@fortawesome/free-solid-svg-icons';
import Toast, { POSITION } from 'vue-toastification';
import 'vue-toastification/dist/index.css';

library.add(faMapMarkerAlt, faUsers, faDollarSign, faRing, faSearch, faHeart, faCheck, faPencil, faTimes, faEyeSlash);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const pinia = createPinia();

const toastOptions = {
    position: POSITION.TOP_RIGHT,
    timeout: 5000,
    hideProgressBar: false,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideCloseButton: false,
    closeButton: 'button',
    icon: true,
    rtl: false,
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        if (name.startsWith('Admin/')) {
            return resolvePageComponent(`./Pages/Admin/${name.split('/')[1]}.vue`, import.meta.glob('./Pages/Admin/**/*.vue'));
        } else if (name.startsWith('Frontend/')) {
            return resolvePageComponent(`./frontend/pages/${name.split('/')[1]}.vue`, import.meta.glob('./frontend/pages/**/*.vue'));
        }
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.component('font-awesome-icon', FontAwesomeIcon);
        app.use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(pinia)
            .use(Toast, toastOptions)
            .mount(el);
    },
    progress: {
        color: '#0076ff',
    },
});

const darkModeStore = useDarkModeStore(pinia);

if (
    (!localStorage['darkMode'] && window.matchMedia('(prefers-color-scheme: dark)').matches) ||
    localStorage['darkMode'] === '1'
) {
    darkModeStore.set(true);
}
