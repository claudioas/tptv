<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index_m extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  function login($u,$p){
    $query = "select * from personas inner join perfiles on personas.perf_id = perfiles.perf_id where per_nombre = '".$u."' ";
    $resultado = $this->db->query($query)->result_array();
    if (!empty($resultado)) {
      if (count($resultado) == 1) {
        return $resultado[0]['perf_nombre'];
      }
    }else {
      return "noRegistrado";
    }

  }

}
