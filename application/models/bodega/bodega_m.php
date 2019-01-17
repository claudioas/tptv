<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bodega_m extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  function recibirReferencia($referencia){
    return $this->db->query("select * from referencias where ref_referencia = '".$referencia."' ")->result_array();
  }

  function listarReferencias(){
    return $this->db->query("select ref_id,ref_referencia,ref_ot,ref_articulo,ref_um,ref_lote,ref_cantidadEnvase,ref_cantidadxEnvase,ref_umcantidadxEnvase,ref_total,ref_ubicacion,ref_estado,ref_dominio,ref_tra,ref_tipo
                             from referencias
                             where ref_estado = 'ENVIADA'")->result_array();
  }


}
