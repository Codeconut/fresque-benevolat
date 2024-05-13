import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'

export default defineConfig(({ mode }) => {
  return {
    base: mode === 'production' ? '/fresque-benevolat/build/' : '/',
    plugins: [
      vueJsx(),
      laravel({
        input: 'resources/js/app.js',
        ssr: 'resources/js/ssr.js',
        refresh: true,
      }),
      vue({
        template: {
          transformAssetUrls: {
            base:
              mode === 'production' ? 'https://www.jeveuxaider.gouv.fr/fresque-benevolat/' : null,
            includeAbsolute: false,
          },
        },
      }),
    ],
  }
})
