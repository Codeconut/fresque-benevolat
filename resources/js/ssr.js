import { createSSRApp, h } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from 'ziggy-js'
import dayjsPlugin from './Plugins/dayjs'
import Filters from './Plugins/filters'
import Taxonomies from './Plugins/taxonomies'
import VueSocialSharing from 'vue-social-sharing'
import ScrollLock from './Plugins/scrollLock'
import InlineSvg from 'vue-inline-svg'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createServer((page) =>
  createInertiaApp({
    page,
    render: renderToString,
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
      resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ App, props, plugin }) {
      const app = createSSRApp({ render: () => h(App, props) })
        .use(plugin)
        .use(dayjsPlugin)
        .use(Filters)
        .use(Taxonomies)
        .use(ScrollLock)
        .use(ZiggyVue, {
          ...page.props.ziggy,
          location: new URL(page.props.ziggy.location),
        })

      app.component('ShareNetwork', VueSocialSharing.ShareNetwork)
      app.component('inline-svg', InlineSvg)

      return app
    },
  })
)
