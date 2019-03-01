new Vue({
  el: '#app',
  data: {
    errors:[],
    u:'',
    p:'',
    ot: '',
    articulo:'',
    disabled: 1,
    lote:'',
    um:'',
    referencia:'',
    errorReferencia: '',
    cantxcaja:'',
    kilosxcaja:'',
    candidatos: [],
    select: [],
    dialog: false,
    drawer: null,
    btn_ingresar: false,
    items: [
      { heading: 'Referencias' },
      { icon: 'add', text: 'Crear Referencias', url: 'operario/operario_c/crear_referencia' },
      { icon: 'format_list_bulleted', text: 'Listar Referencias', url: 'operario/operario_c/listar_referencia'  },
      { divider: true },
      { heading: 'Transacciones' },
      { icon: 'add', text: 'Crear Transacción', url: 'operario/operario_c/crear_transaccion'  },
      { icon: 'format_list_bulleted', text: 'Listar Transacción', url: 'operario/operario_c/listar_transaccion' },
      { divider: true },
      { icon: 'exit_to_app', text: 'Cerrar Sesion', url:''  },
    ]
  },
  props: {
      source: String
  },
  computed: {
    isDisabled: function(){
    	return !this.btn_ingresar;
    }
  },
  created() {
    this.listaOt()
  },
  methods: {
    listaOt: function(){
      this.$http.post(base_url+'operario/operario_c/listaOt').then(response => {
        if (response.body.length > 0) {
          for (var i = 0; i < response.body.length; i++) {
            this.candidatos.push(response.body[i]['OT']);
          }
        }

      }, response => {
        console.log('error http post listaOt');
      });
    },
    ingresarReferencia: function(){
      let datos = {txt_ot:this.select,txt_articulo:this.articulo,txt_lote:this.lote,txt_um:this.um,txt_referencia:this.referencia,txt_cantxcaja:this.cantxcaja,txt_kilosxcaja:this.kilosxcaja}
      this.$http.post(base_url+'operario/operario_c/ingresarReferencia',datos, {emulateJSON: true}).then(response => {
        console.log(response.body);
      }, response => {
        console.log('error http post');
      });
    },
    redireccionar: function(i){
      if (i === '') {
        window.location.href = base_url
      } else {
        window.location.href = base_url+i
      }
    },
    referenciaPistoleada: function(){
      let datos = { referencia : this.referencia }
      this.$http.post(base_url+'operario/operario_c/referenciaPistoleada',datos, {emulateJSON: true}).then(response => {
        if (response.body.length > 0) {
          console.log("si");
          this.errorReferencia = true;
          this.btn_ingresar = false;
        }else{
          console.log("no");
          // this.disabled = (this.disabled + 1) % 2;
          // this.btn_ingresar = !this.btn_ingresar;
          this.btn_ingresar = true;
        }
      }, response => {
        console.log('error http post');
      });
    }
  }
})
