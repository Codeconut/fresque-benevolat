import dayjs from 'dayjs'
import 'dayjs/locale/fr'

dayjs.locale('fr')

export default {
  install: (app) => {
    app.config.globalProperties.$dayjs = dayjs
  },
}
