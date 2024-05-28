import './bootstrap'
import '../css/app.css'

import { createSSRApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from 'ziggy-js'
import dayjsPlugin from './Plugins/dayjs'
import VueSocialSharing from 'vue-social-sharing'
import ScrollLock from './Plugins/scrollLock'
import Filters from './Plugins/filters'
import Taxonomies from './Plugins/taxonomies'
import InlineSvg from 'vue-inline-svg'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    const app = createSSRApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(dayjsPlugin)
      .use(VueSocialSharing)
      .use(ScrollLock)
      .use(Filters)
      .use(Taxonomies)

    app.component('inline-svg', InlineSvg)

    return app.mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})
