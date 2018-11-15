<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class planificacion_m extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  function listarOt(){
    $activadas = array();
    $desactivadas = array();
    $retorno = array();
    $valor = $this->db->query("select * from ot")->result_array();
    if (!empty($valor)) {
      for ($i=0; $i < count($valor); $i++) {
        if ($valor[$i]['ot_estado'] == 'ACTIVADA') {
          array_push($activadas,$valor[$i]);
        }else{
          array_push($desactivadas,$valor[$i]);
        }
      }
      array_push($retorno,$activadas);
      array_push($retorno,$desactivadas);
      return $retorno;
    }else{
      return "otvacio";
    }
  }

  function actualizarEstado($ot,$ahora,$despues,$ot_articulo,$ot_dominio,$ot_estado,$ot_id,$ot_lote,$ot_ot,$ot_registro,$ot_tipo,$ot_usuario){
    return $this->db->query("update ot set ot_estado = '".strtoupper($despues)."' where ot_ot = '$ot_ot' ");
  }

}
