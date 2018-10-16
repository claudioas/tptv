new Vue({
  el: '#app',
  data: {
    errors:[],
    u:'',
    p:'',
    dialog: false,
    drawer: null,
      items: [
        { heading: 'Referencias' },
        { icon: 'add', text: 'Crear Referencias' },
        { icon: 'format_list_bulleted', text: 'Listar Referencias' },
        { divider: true },
        { heading: 'Transacciones' },
        { icon: 'add', text: 'Crear Transacción' },
        { icon: 'format_list_bulleted', text: 'Listar Transacción' },
        { divider: true },
        { icon: 'exit_to_app', text: 'Cerrar Sesion' },
      ]
  },
  props: {
      source: String
  },
  methods: {

  }
})

Vue.use(Vuetify, {
  theme: {
  primary: "#0091EA",
  secondary: "#00B0FF",
  accent: "#69F0AE",
  error: "#f44336",
  warning: "#ffeb3b",
  info: "#2196f3",
  success: "#4caf50"
}
})
