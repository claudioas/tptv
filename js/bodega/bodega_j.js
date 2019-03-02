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
    recibirReferencia: function(){
      let datos = {txt_referencia:this.txt_referencia}
      this.$http.post(base_url+'bodega/bodega_c/recibirReferencia',datos, {emulateJSON: true}).then(response => {
        // let a = {avatar: '',ref_referencia:response.body[0]['ref_referencia'], contenido: `${response.body[0]['ref_tra']} &mdash; ${response.body[0]['ref_ot']} &mdash; ${response.body[0]['ref_articulo']}`}
        // this.lista.push(a);

        if (response.body.length == 1) {
          this.dialog_crud = true;
          console.log(response.body);
        } else {
          console.log('no existe');
        }

      }, response => {
        console.log('error http post recibirReferencia');
      });
    }
  }
})
