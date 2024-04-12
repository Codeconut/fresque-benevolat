import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import dayjsPlugin from './Plugins/dayjs'
import VueSocialSharing from 'vue-social-sharing'
import VScrollLock from 'v-scroll-lock'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(dayjsPlugin)
      .use(VueSocialSharing)
      .use(VScrollLock)
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})
