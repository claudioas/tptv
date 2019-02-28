<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index_m extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  function login($u,$p){
    $query = "select * from personas inner join perfiles on personas.perf_id = perfiles.perf_id where per_usuario = '".$u."' ";
    $resultado = $this->db->query($query)->result_array();
    if (!empty($resultado)) {
      if (count($resultado) == 1) {
        session_start();
        $_SESSION['per_tipo'] = $resultado[0]['per_tipo'];
        $_SESSION['perf_nombre'] = $resultado[0]['perf_nombre'];
        $_SESSION['per_dominio'] = $resultado[0]['per_dominio'];
        return $resultado[0]['perf_nombre'];
      }
    }else {
      return "noRegistrado";
    }

  }

  function onSignIn($user){
    $resultado = $this->db->query("select per_id, per_dominio, per_usuario, per_tipo, perf_nombre from personas inner join perfiles on personas.perf_id = perfiles.perf_id where per_usuario = '".$user."' ")->result_array();
    if (count($resultado) == 1) {
      session_start();
      $_SESSION['per_tipo'] = $resultado[0]['per_tipo'];
      $_SESSION['perf_nombre'] = $resultado[0]['perf_nombre'];
      return $resultado[0]['perf_nombre'];
      // return array('per_id' => $resultado[0]['per_id'], 'per_dominio' => $resultado[0]['per_dominio'], 'per_usuario' => $resultado[0]['per_usuario'], 'per_tipo' => $resultado[0]['per_tipo'], 'perf_nombre' => $resultado[0]['perf_nombre']);
    }else{
      return false;
    }
  }

}
