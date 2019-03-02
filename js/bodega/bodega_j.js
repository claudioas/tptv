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
    candidatos: [ { name:'OT123' }, { name:'OT456' }],
    select: [],
    txt_referencia: "",
    dialog: false,
    drawer: null,
    dialog_crud: false,
    editedItem: {},
    ref_dominio: '',
    ref_ot: '',
    ref_lote: '',
    ref_articulo: '',
    ref_referencia: '',
    ref_cantidadEnvase: '',
    ref_cantidadxEnvase: '',
    items: [
      { heading: 'Menú' },
      { icon: 'add', text: 'Recibir Referencias', url: 'bodega/bodega_c' },
      { icon: 'format_list_bulleted', text: 'Listar Transacciones', url: 'bodega/bodega_c/listar_transacciones'  },
      { icon: 'format_list_bulleted', text: 'Ubicar Referencias', url: 'bodega/bodega_c/ubicar_referencia'  },
      { divider: true },
      { icon: 'exit_to_app', text: 'Cerrar Sesion', url:'' },
    ],
    lista: []
  },
  props: {
      source: String
  },
  created () {
    this.listarReferencias()
  },
  methods: {
    listarReferencias () {
      this.$http.post(base_url+'bodega/bodega_c/listarReferencias').then(response => {
        this.lista = response.body;
      }, response => {
        console.log('error http post listarReferencia');
      });
    },
    closes: function(){
      this.dialog_crud = false;
    },
    redireccionar: function(i){
      if(i === ''){
        window.location.href = base_url
      }else{
        window.location.href = base_url+i
      }
    },
    consultarReferencia: function(){
      let datos = {txt_referencia:this.txt_referencia}
      this.$http.post(base_url+'bodega/bodega_c/consultarReferencia',datos, {emulateJSON: true}).then(response => {
        // let a = {avatar: '',ref_referencia:response.body[0]['ref_referencia'], contenido: `${response.body[0]['ref_tra']} &mdash; ${response.body[0]['ref_ot']} &mdash; ${response.body[0]['ref_articulo']}`}
        // this.lista.push(a);
        if (response.body.length == 1) {
          for (var i = 0; i < this.lista.length; i++) {
            if (this.lista[i]['ref_referencia'] == this.txt_referencia) {
              this.ref_dominio = this.lista[i]['ref_dominio']
              this.ref_ot = this.lista[i]['ref_ot']
              this.ref_lote = this.lista[i]['ref_lote']
              this.ref_articulo = this.lista[i]['ref_articulo']
              this.ref_referencia = this.lista[i]['ref_referencia']
              this.ref_cantidadEnvase = this.lista[i]['ref_cantidadEnvase']
              this.ref_cantidadxEnvase = this.lista[i]['ref_cantidadxEnvase']
            }else{
              console.log("Referencia pistoleada no esta en la lista.");
            }
          }
          this.dialog_crud = true;
          // console.log(response.body);
        } else {
          console.log('no existe');
        }
      }, response => {
        console.log('error http post consultarReferencia');
      });
    },
    recibirReferencia: function(){
      // let datos = {txt_referencia:this.txt_referencia

    }
  }
})
