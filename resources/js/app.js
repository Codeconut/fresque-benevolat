import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import dayjsPlugin from './Plugins/dayjs'
import VueSocialSharing from 'vue-social-sharing'
import ScrollLock from './Plugins/scrollLock'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) })

    app.config.globalProperties.$filters = {
      pluralize(amount, singular, plural = `${singular}s`) {
        let string = amount === 1 ? singular : plural
        return `${amount} ${string}`
      },
    }

    return app
      .use(plugin)
      .use(ZiggyVue)
      .use(dayjsPlugin)
      .use(VueSocialSharing)
      .use(ScrollLock)
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})
