new Vue({
  el: '#app',
  data: () => ({
    dialog: false,
    drawer: null,
    items: [
      { heading: 'Menú' },
      { icon: 'format_list_bulleted', text: 'Maestro OT', url: 'planificacion/planificacion_c'  },
      { icon: 'format_list_bulleted', text: 'Referencias', url: 'planificacion/planificacion_c/listarReferencias_v' },
      { divider: true },
      { icon: 'exit_to_app', text: 'Cerrar Sesion', url: '' },
    ],
    headers: [
      { text: '#TRA', align: 'left', sortable: false, value: 'name' },
      { text: 'Ref.', value: 'calories' },
      { text: 'Articulo', value: 'fat' },
      { text: 'Lote', value: 'carbs' },
      { text: 'OT', value: 'protein' },
      { text: 'Cant. Env.', value: 'name', sortable: false },
      { text: 'Cant. x Env.', value: 'name', sortable: false },
      { text: 'Acciones', value: 'name', sortable: false }
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      ref_tra:"",
      ref_referencia:"",
      ref_articulo:"",
      ref_lote:"",
      ref_ot:"",
      ref_cantidadEnvase:"",
      ref_cantidadxEnvase:"",
    },
    defaultItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    },
    snackbar: false,
    color: 'success',
    mode: '',
    timeout: 3000,
    text: 'Actualizado'
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Agregar item' : 'Editar Referencia'
    }
  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },

  created () {
    this.initialize()
  },

  methods: {
    redireccionar: function(i){
      if (i === '') {
        window.location.href = base_url
      } else {
        window.location.href = base_url+i
      }
    },
    initialize () {
      this.$http.post(base_url+'planificacion/planificacion_c/listarReferencias', {emulateJSON: true}).then(response => {
        console.log(response.body);
        this.desserts = response.body;
      }, response => {
        console.log('error http post planificacion_c/listarReferencias');
      });
    },
    editItem (item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },
    deleteItem (item) {
      const index = this.desserts.indexOf(item)
      // confirm('Estas seguro que quieres eliminar el item?') && this.desserts.splice(index, 1)
    },
    close () {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },
    save () {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
        this.desserts.push(this.editedItem)
      }
      this.close()
    },
    actualizarReferencia: function(){
      let datos = {ref_tra:this.editedItem.ref_tra,ref_referencia:this.editedItem.ref_referencia,ref_articulo:this.editedItem.ref_articulo,ref_lote:this.editedItem.ref_lote,ref_ot:this.editedItem.ref_ot,ref_cantidadEnvase:this.editedItem.ref_cantidadEnvase,ref_cantidadxEnvase:this.editedItem.ref_cantidadxEnvase}
      this.$http.post(base_url+'planificacion/planificacion_c/actualizarReferencia',datos, {emulateJSON: true}).then(response => {
        if(response.body){
          this.snackbar = true
          this.dialog = false
          this.initialize();
        }else{
          this.color = "red"
          this.text = "Error al actualizar"
          this.snackbar = true
          this.dialog = false
          this.initialize()
        }
      }, response => {
        console.log('error http post planificacion_c/actualizarReferencia');
      });
    }
  }
})
