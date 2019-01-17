<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operario_m extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  function ingresarReferencia($ot,$articulo,$lote,$um,$referencia,$cantxcaja,$kilosxcaja){
    if ($this->db->query("insert INTO referencias(ref_ot,ref_articulo,ref_lote,ref_um,ref_referencia,ref_cantidadEnvase,ref_cantidadxEnvase) values ('$ot','$articulo','$lote','$um','$referencia','$cantxcaja','$kilosxcaja')")) {
      return "ok";
    }else {
      return "nook";
    }
  }

  function listarReferencias(){
    return $this->db->query('select ref_id as ID,ref_ot as OT,ref_articulo as ARTICULO,ref_lote as LOTE,ref_um as UM,ref_referencia as REFERENCIA,ref_cantidadEnvase as CANTENVASE,ref_cantidadxEnvase as CANTXENVASE from referencias')->result_array();
  }

  function validaReferencia($referencia){
    $resultado = $this->db->query("select ref_id as ID, ref_referencia as Referencia, ref_lote as Lote, ref_cantidadEnvase as CantEnvase, ref_cantidadxEnvase as CantxEnvase, ref_total as Total, ref_articulo as Articulo from referencias where ref_referencia = '".$referencia."'")->result_array();
    return $resultado;
  }



}
