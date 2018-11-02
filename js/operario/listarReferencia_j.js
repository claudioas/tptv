new Vue({
  el: '#app',
  data: ({
    errors:[],
    u:'',
    p:'',
    search: '',
    // dialog: false,
    drawer: null,
    pagination: {
        sortBy: 'name'
      },
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
    ],
    dialog_crud: false,
    headers: [
      { text: '#', align: 'left', sortable: true, value: 'ID' },
      { text: 'OT', align: 'center', value: 'OT' },
      { text: 'REFERENCIA', align: 'center', value: 'REFERENCIA' },
      { text: 'ARTICULO', align: 'center', value: 'ARTICULO' },
      { text: 'LOTE', align: 'center', value: 'LOTE' },
      { text: 'UM', align: 'center', value: 'UM' },
      { text: 'Acciones', align: 'center', value: 'name', sortable: false }
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    },
    defaultItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    }
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Nuevo' : 'Editar item'
    }
  },

  watch: {
    dialog_crud (val) {
      val || this.close()
    }
  },

  created () {
    this.initialize()
  },

  methods: {
    ingresarReferencia: function(){
      console.log("click ingresarReferencia");
    },
    redireccionar: function(i){
      // console.log(base_url+i);
      window.location.href = base_url+i
    },
    initialize () {
      this.$http.post(base_url+'operario/operario_c/listarReferencias').then(response => {
        this.desserts = response.body;
      }, response => {
        console.log('error http post listarReferencia');
      });
    },

    editItem (item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog_crud = true
    },

    deleteItem (item) {
      const index = this.desserts.indexOf(item)
      confirm('¿Seguro que lo quieres eliminar?') && this.desserts.splice(index, 1)
    },

    close () {
      this.dialog_crud = false
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
    }
  }
})
