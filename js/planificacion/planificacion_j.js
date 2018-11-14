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
      // console.log(ot);
      this.$http.post(base_url+'planificacion/planificacion_c/actualizarEstado',ot, {emulateJSON: true}).then(response => {
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
