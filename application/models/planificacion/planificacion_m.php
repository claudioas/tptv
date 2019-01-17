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

  function listarReferencias(){
    return $this->db->query("select ref_id,ref_referencia,ref_ot,ref_articulo,ref_um,ref_lote,ref_cantidadEnvase,ref_umcantidadEnvase,ref_cantidadxEnvase,ref_umcantidadxEnvase,ref_total,ref_ubicacion,ref_estado,ref_dominio,ref_tra,ref_fecha,ref_usuario,ref_tipo from referencias")->result_array();
  }

  function actualizarReferencia($ref_tra,$ref_referencia,$ref_articulo,$ref_lote,$ref_ot,$ref_cantidadEnvase,$ref_cantidadxEnvase){
    return $this->db->query("update referencias set ref_tra = '".$ref_tra."', ref_referencia = '".$ref_referencia."', ref_articulo = '".$ref_articulo."', ref_lote = '".$ref_lote."', ref_ot = '".$ref_ot."', ref_cantidadEnvase = '".$ref_cantidadEnvase."', ref_cantidadxEnvase = '".$ref_cantidadxEnvase."' where ref_referencia = '".$ref_referencia."' and ref_ot = '".$ref_ot."' ");
  }

}
