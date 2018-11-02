new Vue({
  el: '#app',
  data: {
    errors:[],
    u:'',
    p:'',
    ot: '',
    articulo:'',
    lote:'',
    um:'',
    referencia:'',
    cantxcaja:'',
    kilosxcaja:'',
    dialog: false,
    drawer: null,
    friends: [ { name:'Sandra Adams' }, { name:'cladio Adams' }],
    candidatos: [{ name:'OT123' }, { name:'OT456' }],
    select: [],
    items: [
      { heading: 'Referencias' },
      { icon: 'add', text: 'Crear Referencias', url: 'operario/operario_c/crear_referencia' },
      { icon: 'format_list_bulleted', text: 'Listar Referencias', url: 'operario/operario_c/listar_referencia'  },
      { divider: true },
      { heading: 'Transacciones' },
      { icon: 'add', text: 'Crear Transacción',url: 'operario/operario_c/crear_transaccion'  },
      { icon: 'format_list_bulleted', text: 'Listar Transacción', url: 'operario/operario_c/listar_transaccion' },
      { divider: true },
      { icon: 'exit_to_app', text: 'Cerrar Sesion' },
    ]
  },
  props: {
      source: String
  },
  methods: {
    ingresarReferencia: function(){
      let datos = {txt_ot:this.select,txt_articulo:this.articulo,txt_lote:this.lote,txt_um:this.um,txt_referencia:this.referencia,txt_cantxcaja:this.cantxcaja,txt_kilosxcaja:this.kilosxcaja}
      console.log(datos);
      this.$http.post(base_url+'operario/operario_c/ingresarReferencia',datos, {emulateJSON: true}).then(response => {
        console.log(response.body);
      }, response => {
        console.log('error http post');
      });
    },
    redireccionar: function(i){
      // console.log(base_url+i);
      window.location.href = base_url+i
    }
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
