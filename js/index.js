new Vue({
  el: '#app',
  data: {
    errors:[],
    u:'',
    p:'',
    dialog: false,
    model: 'tab-2',
    text: 'Lorem ip',
    drawer: null,
    candidatos: [{ name:'OT123' }, { name:'OT456' }],
    items: [
      { icon: 'lightbulb_outline', text: 'Notes' },
      { icon: 'touch_app', text: 'Reminders' },
      { divider: true },
      { heading: 'Labels' },
      { icon: 'add', text: 'Create new label' },
      { divider: true },
      { icon: 'archive', text: 'Archive' },
      { icon: 'delete', text: 'Trash' },
      { divider: true },
      { icon: 'settings', text: 'Settings' },
      { icon: 'chat_bubble', text: 'Trash' },
      { icon: 'help', text: 'Help' },
      { icon: 'phonelink', text: 'App downloads' },
      { icon: 'keyboard', text: 'Keyboard shortcuts' }
    ]
  },
  props: {
      source: String
  },
  methods: {
    login: function(e){
        let datos = {u:this.u,p:this.p};
        this.$http.post(base_url+'index/login', datos, {emulateJSON: true}).then(function (response) {
          let c = response.data.replace('"', "");
          c = c.replace('"', "");
          let s = c.substring(0,c.length-2)
          if (c.substring(c.length-2) == '_c') {
            window.location.href = base_url+s+"/"+c;
          }else{
            this.dialog = true;
          }
      },function (response) {
          console.log(response)
      });
    },
    loginGoogle: function(e){
      console.log("google");
    }
  }
})
