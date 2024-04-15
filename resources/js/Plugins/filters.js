export default {
  install: (app, options) => {
    app.config.globalProperties.$filters = {
      pluralize(amount, singular, plural = `${singular}s`) {
        let string = amount === 1 ? singular : plural
        return `${amount} ${string}`
      },
    }
  },
}
