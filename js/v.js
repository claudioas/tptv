$(document).ready(function() {
  $('.txt_rut').Rut({
    on_error: function(){ swal({type:'error',html:`R.U.T incorrecto`}) },
    format_on: 'keyup'
  });
});
