require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
// import jInput from '@/Jetstream/Input.vue'
import Modal from '@/Jetstream/Modal.vue';
import Input from '@/Jetstream/Input.vue';
import Label from '@/Jetstream/Label.vue';
import InputError from '@/Jetstream/InputError.vue';
import ValidationErrors from '@/Jetstream/ValidationErrors.vue';
import Dropdown from '@/Jetstream/Dropdown.vue';
import DropdownLink from '@/Jetstream/DropdownLink.vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// Vue.component('iTextBox', iTextBox);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component('Modal', Modal)
            .component('JetInput', Input)
            .component('JetLabel', Label)
            .component('JetInputError', InputError)
            .component('JetValidationErrors', ValidationErrors)
            .component('JetDropdown', Dropdown)
            .component('JetDropdownLink', DropdownLink)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
