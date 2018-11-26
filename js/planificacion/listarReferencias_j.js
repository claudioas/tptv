
new Vue({
  el: '#app',
  data: () => ({
    dialog: false,
    drawer: null,
    items: [
      { icon: 'format_list_bulleted', text: 'Maestro OT', url: 'planificacion/planificacion_c'  },
      { icon: 'format_list_bulleted', text: 'Referencias', url: 'planificacion/planificacion_c/listarReferencias_v' },
      { divider: true },
      { icon: 'exit_to_app', text: 'Cerrar Sesion' },
    ],
    headers: [
      { text: 'Dessert (100g serving)', align: 'left', sortable: false, value: 'name' },
      { text: 'Calories', value: 'calories' },
      { text: 'Fat (g)', value: 'fat' },
      { text: 'Carbs (g)', value: 'carbs' },
      { text: 'Protein (g)', value: 'protein' },
      { text: 'Actions', value: 'name', sortable: false }
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
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
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
      window.location.href = base_url+i
    },
    initialize () {
      this.$http.post(base_url+'planificacion/planificacion_c/listarReferencias', {emulateJSON: true}).then(response => {
        console.log(response.body);
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
      confirm('Estas seguro que quieres eliminar el item?') && this.desserts.splice(index, 1)
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
    }
  }
})
