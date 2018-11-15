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
    ot_activada: [],
    ot_desactivada: [],
    items: [
      // { heading: 'Referencias' },
      // { icon: 'add', text: 'Crear Referencias', url: 'operario/operario_c/crear_referencia' },
      { icon: 'format_list_bulleted', text: 'Maestro OT', url: 'planificacion/planificacion_c'  },
      // { divider: true },
      // { heading: 'Transacciones' },
      // { icon: 'add', text: 'Crear Transacción',url: 'operario/operario_c/crear_transaccion'  },
      { icon: 'format_list_bulleted', text: 'Referencias', url: 'planificacion/planificacion_c' },
      { divider: true },
      { icon: 'exit_to_app', text: 'Cerrar Sesion' },
    ],
    snackbar: false,
    color: '',
    mode: '',
    timeout: 2000,
    text: ''
  },
  props: {
      source: String
  },
  created(){
    this.listarOt()
  },
  methods: {
    redireccionar: function(i){
      window.location.href = base_url+i
    },
    checkMove: function(evt,originalEvent){
      let ot = evt.draggedContext.element;
      let ahora = evt.from.getAttribute('class');
      let despues = evt.to.getAttribute('class');
      let ot_articulo = ot['ot_articulo'];
      let ot_dominio = ot['ot_dominio'];
      let ot_estado = ot['ot_estado'];
      let ot_id = ot['ot_id'];
      let ot_lote = ot['ot_lote'];
      let ot_ot = ot['ot_ot'];
      let ot_registro = ot['ot_registro'];
      let ot_tipo = ot['ot_tipo'];
      let ot_usuario = ot['ot_usuario'];
      let datos = {ot:ot,ahora:ahora,despues:despues,ot_articulo:ot_articulo,ot_dominio:ot_dominio,ot_estado:ot_estado,ot_id:ot_id,ot_lote:ot_lote,ot_ot:ot_ot,ot_registro:ot_registro,ot_tipo:ot_tipo,ot_usuario:ot_usuario}
      this.$http.post(base_url+'planificacion/planificacion_c/actualizarEstado',datos, {emulateJSON: true}).then(response => {
        console.log(response.body);
        this.color = 'success';
        this.snackbar = true;
        this.text = despues.toUpperCase();
      }, response => {
        this.color = 'error';
        this.snackbar = true;
        this.text = "error al actualizar".toUpperCase();
        console.log('error http post planificacion_c/actualizarEstado');
      });
    },
    listarOt (){
          this.$http.post(base_url+'planificacion/planificacion_c/listarOt',{emulateJSON: true}).then(response => {
            if (response.body == "otvacio") {
              console.log("otvacio",response.body);
            } else {
              this.ot_activada = response.body[0];
              this.ot_desactivada = response.body[1];
            }
      }, response => {
        console.log('error http post planificacion_c/listarOt');
      });
    }
  }
})
