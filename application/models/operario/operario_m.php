<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operario_m extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  function ingresarReferencia($ot,$articulo,$um,$referencia,$cantxcaja,$kilosxcaja){
    var_dump($ot,$articulo,$um,$referencia,$cantxcaja,$kilosxcaja);
  }

}
