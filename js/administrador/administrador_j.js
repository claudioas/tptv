// // Initialize Firebase
// var config = {
//   apiKey: "AIzaSyBpYBIrc57TbzEn7RbDR6IIX4fOPissbKo",
//   authDomain: "tptvue.firebaseapp.com",
//   databaseURL: "https://tptvue.firebaseio.com",
//   projectId: "tptvue",
//   storageBucket: "tptvue.appspot.com",
//   messagingSenderId: "510087164727"
// };
// firebase.initializeApp(config);
//
// var provider = new firebase.auth.GoogleAuthProvider();
//
// firebase.auth().signInWithPopup(provider).then(function(result) {
//   // This gives you a Google Access Token. You can use it to access the Google API.
//   var token = result.credential.accessToken;
//   // The signed-in user info.
//   var user = result.user;
//   // ...
// }).catch(function(error) {
//   // Handle Errors here.
//   var errorCode = error.code;
//   var errorMessage = error.message;
//   // The email of the user's account used.
//   var email = error.email;
//   // The firebase.auth.AuthCredential type that was used.
//   var credential = error.credential;
//   // ...
// });

Vue.use(Vuetify, {
  theme: {
  primary: "#0091EA",
  secondary: "#00B0FF",
  accent: "#69F0AE",
  error: "#f44336",
  warning: "#ffeb3b",
  info: "#2196f3",
  success: "#4caf50"
}
})

new Vue({
  el: '#app',
  data: {
    errors:[],
    u:'',
    p:'',
    dialog: false,
    drawer: null,
      items: [
        { icon: 'lightbulb_outline', text: 'Recibir Referencias' },
        { icon: 'touch_app', text: 'Listar Referencias' },
        { icon: 'touch_app', text: 'Ubicar Referencias' },
        { divider: true },
        { icon: 'touch_app', text: 'Cerrar Sesión' },
        { heading: 'Labels' },
        // { icon: 'add', text: 'Create new label' },
        // { divider: true },
        // { icon: 'archive', text: 'Archive' },
        // { icon: 'delete', text: 'Trash' },
        // { divider: true },
        // { icon: 'settings', text: 'Settings' },
        // { icon: 'chat_bubble', text: 'Trash' },
        // { icon: 'help', text: 'Help' },
        // { icon: 'phonelink', text: 'App downloads' },
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
  }
})
