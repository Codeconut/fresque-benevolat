const taxonomies = {
  application_states: [
    { key: 'registered', label: 'Inscrite' },
    { key: 'confirmed_presence', label: 'Présence confirmé' },
    { key: 'validated', label: 'Réalisée' },
    { key: 'canceled', label: 'Annulée' },
    { key: 'missing', label: 'Absent(e)' },
  ],
}

export default {
  install: (app, options) => {
    app.config.globalProperties.$taxonomies = {
      getAll: (vocabulary) => {
        return taxonomies[vocabulary]
      },
      getLabel: (key, vocabulary) => {
        if (key === null || key === undefined) return null
        return taxonomies[vocabulary].find((term) => term.key === key)?.label
      },
    }
  },
}
