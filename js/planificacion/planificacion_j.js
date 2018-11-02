new Vue({
  el: '#app',
  data: {
    dialog: false,
    drawer: null,
    items: [
      // { heading: 'Referencias' },
      // { icon: 'add', text: 'Crear Referencias', url: 'operario/operario_c/crear_referencia' },
      { icon: 'format_list_bulleted', text: 'Referencias', url: 'operario/operario_c/listar_referencia'  },
      // { divider: true },
      // { heading: 'Transacciones' },
      // { icon: 'add', text: 'Crear Transacción',url: 'operario/operario_c/crear_transaccion'  },
      { icon: 'format_list_bulleted', text: 'Transacción', url: 'operario/operario_c/listar_transaccion' },
      { divider: true },
      { icon: 'exit_to_app', text: 'Cerrar Sesion' },
    ]
  },
  props: {
      source: String
  },
  methods: {
    redireccionar: function(i){
      // console.log(base_url+i);
      window.location.href = base_url
    }
  }
})
