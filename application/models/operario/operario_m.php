<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operario_m extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  function ingresarReferencia($ot,$articulo,$lote,$um,$referencia,$cantxcaja,$kilosxcaja){
    // $query = 'insert INTO referencias(ref_ot,ref_articulo,ref_lote,ref_um,ref_referencia,ref_cantidadEnvase,ref_cantidadxEnvase) values ('$ot','$articulo','$lote','$um','$referencia','$cantxcaja','$kilosxcaja')';
    // $query = "insert INTO referencias(ref_ot,ref_lote,ref_articulo,ref_um,ref_referencia,ref_cantidadEnvase,ref_umcantidadEnvase,ref_cantidadxEnvase,ref_umcantidadxEnvase,ref_total,ref_estado,ref_dominio,ref_fecha,ref_usuario,ref_tipo,ref_ubicacion)VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]','ACTIVA','$dominio','$datos[10]','$usuario','$tipo','PRODUCC')";
    if ($this->db->query("insert INTO referencias(ref_ot,ref_articulo,ref_lote,ref_um,ref_referencia,ref_cantidadEnvase,ref_cantidadxEnvase) values ('$ot','$articulo','$lote','$um','$referencia','$cantxcaja','$kilosxcaja')")) {
      return "ok";
    }else {
      return "nook";
    }

  }

  function listarReferencias(){
    return $this->db->query('select ref_id as ID,ref_ot as OT,ref_articulo as ARTICULO,ref_lote as LOTE,ref_um as UM,ref_referencia as REFERENCIA,ref_cantidadEnvase as CANTENVASE,ref_cantidadxEnvase as CANTXENVASE from referencias')->result_array();
  }

}
