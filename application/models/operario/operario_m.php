<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operario_m extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  function ingresarReferencia($ot,$articulo,$lote,$um,$referencia,$cantxcaja,$kilosxcaja){
    session_start();
    if ($this->db->query("insert INTO referencias(ref_ot,ref_articulo,ref_lote,ref_um,ref_referencia,ref_cantidadEnvase,ref_cantidadxEnvase,ref_dominio,ref_estado) values ('$ot','$articulo','$lote','$um','$referencia','$cantxcaja','$kilosxcaja','".$_SESSION['per_dominio']."','ACTIVA')")) {
      return "ok";
    }else {
      return "nook";
    }
  }

  function listarReferencias(){
    return $this->db->query('select ref_id as ID,ref_ot as OT,ref_articulo as ARTICULO,ref_lote as LOTE,ref_um as UM,ref_referencia as REFERENCIA,ref_cantidadEnvase as CANTENVASE,ref_cantidadxEnvase as CANTXENVASE from referencias')->result_array();
  }

  function validaReferencia($referencia){
    $resultado = $this->db->query("select ref_id as ID, ref_referencia as Referencia, ref_lote as Lote, ref_cantidadEnvase as CantEnvase, ref_cantidadxEnvase as CantxEnvase, ref_total as Total, ref_articulo as Articulo, ref_tipo as Tipo from referencias where ref_referencia = '".$referencia."'")->result_array();
    // print_r("select ref_id as ID, ref_referencia as Referencia, ref_lote as Lote, ref_cantidadEnvase as CantEnvase, ref_cantidadxEnvase as CantxEnvase, ref_total as Total, ref_articulo as Articulo, ref_tipo as Tipo from referencias where ref_referencia = '".$referencia."'");
    return $resultado;
  }

  function ingresarTransaccion($referenciasTransaccion){
    session_start();
    date_default_timezone_set('Chile/Continental');
    $hoy = date('Y-m-d h:i:s');
    for ($j=1; $j < count($referenciasTransaccion); $j++) {
      $query = "update referencias set ref_tra = '".$referenciasTransaccion[0]."', ref_estado = 'ENVIADA' where ref_referencia = '".$referenciasTransaccion[$j]['Referencia']."' and ref_estado = 'ACTIVA' ";
      $this->db->query($query);
      if (!$this->db->query($query)) {
        break;
        return "error update referencias";
      }
    }
    $this->db->query("insert into transacciones(tra_id,tra_tipo,tra_estado,tra_fecha,tra_usuario,tra_dominio) values('".$referenciasTransaccion[0]."','".$_SESSION['per_tipo']."','ENVIADA','".$hoy."','usuarios','".$_SESSION['per_dominio']."')");
    return true;
  }

  function consultaTransaccion(){
    $query = "select tra_id from transacciones order by id desc";
    $resultado = $this->db->query($query)->row_array();
    if (!empty($resultado)) {
      $tra = implode(',',$resultado);
      $largo = strlen($tra);
      $id = substr($tra, -($largo-3), $largo);
      return 'TRA'.($id+1);
    }else{
      return 'TRA1';
    }
  }

  function referenciaPistoleada($referencia){
    session_start();
    $query = "select * from referencias where ref_referencia = '".$referencia."' and ref_dominio = '".$_SESSION['per_dominio']."' ";
    return $this->db->query($query)->result_array();
    // return $query;
  }

  function listaOt(){
    session_start();
    $query = "select ot_ot as OT, ot_articulo as Articulo, ot_lote as Lote, ot_tipo as Tipo, ot_dominio as Dominio from ot where ot_dominio = '".$_SESSION['per_dominio']."' and ot_tipo = '".$_SESSION['per_tipo']."' and ot_estado = 'ACTIVADA' ";
    return $this->db->query($query)->result_array();
  }



}
