new Vue({
  el: '#app',
  data: {
    machines: [
      	{
        	name: "H1",
          id: 1,
          jobs: [
          	{
            	jobNumber: "14037-12"
            },
            {
            	jobNumber: "14038-13"
            },
            {
            	jobNumber: "14048-15"
            }
          ]
        }
      ],
    dialog: false,
    drawer: null,
    list: [{ot:"OT1",articulo:"ART0001",referencia:"referencia",estado:'activado',items:[{descripcion:"descripción 1",descripcion2:"descripción 2"}]},
           {ot:"OT2",articulo:"ART0002",referencia:"referencia",estado:'desactivado',items:[{descripcion:"descripción 4",descripcion2:"descripción 4"}]}],
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
    },
    handleChange() {
      console.log('changed');
    },
    inputChanged(value) {
      this.activeNames = value;
    },
    getComponentData() {
      return {
        on: {
          change: this.handleChange,
          input: this.inputChanged
        },
        props: {
          value: this.activeNames
        }
      };
    }
  }
})
