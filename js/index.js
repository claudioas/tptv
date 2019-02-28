
new Vue({
  el: '#app',
  data: {
    errors:[],
    txt_rut:"txt_rut",
    u:'',
    p:'',
    dialog: false,
    model: 'tab-2',
    text: 'Lorem ip',
    drawer: null,
  },
  props: {
      source: String
  },
  methods: {
    login: function(e){
      console.log("asd");
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
    valida_rut: function(e){
      // VALIDA RUT
      // $('.v-text-field__slot').children().Rut({
      //   on_error: function(){ alert("RUT Incorrecto") },
      //   format_on: 'keyup'
      // });
      // VALIDA RUT
    }

  }
})

// SIGN-IN GOOGLE USUARIOS PLANIFICACIÓN
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  let user = profile.getEmail();
  if (user != '') {
    $.ajax({
      url: base_url+'index/onSignIn',
      type: 'POST',
      dataType: 'json',
      data: {user:user}
    })
    .done(function(data) {
      console.log(data);
      console.log("success onSignIn");
      let c = data.replace('"', "");
      c = c.replace('"', "");
      let s = c.substring(0,c.length-2)
      if (c.substring(c.length-2) == '_c') {
        // window.location.href = base_url+s+"/"+c;
      }else{
        // this.dialog = true;
        console.log("erro");
      }
    })
    .fail(function(data) {
      console.log(data);
      console.log("error onSignIn");
    });

  } else {

  }

}
// SIGN-IN GOOGLE USUARIOS PLANIFICACIÓN
