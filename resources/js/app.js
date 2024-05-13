import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from 'ziggy-js'
import dayjsPlugin from './Plugins/dayjs'
import VueSocialSharing from 'vue-social-sharing'
import ScrollLock from './Plugins/scrollLock'
import Filters from './Plugins/filters'
import Taxonomies from './Plugins/taxonomies'
import VueSvgInlinePlugin from 'vue-svg-inline-plugin'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

alert('Hello from Vite!')

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
      .use(ScrollLock)
      .use(Filters)
      .use(Taxonomies)
      .use(VueSvgInlinePlugin, {
        attributes: {
          data: ['src'],
          remove: ['alt'],
        },
        cache: {
          persistent: false,
        },
      })
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})

alert('Hello from Vite! after InertiaApp')
