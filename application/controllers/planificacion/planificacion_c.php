<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class planificacion_c extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('planificacion/planificacion_m');
  }

  function index(){
    $this->load->view('planificacion/index');
  }

  function listarReferencias_v(){
    $this->load->view('planificacion/listarReferencias_v');
  }

  function listarOt(){
    echo json_encode($this->planificacion_m->listarOt());
  }

  function actualizarEstado(){
    echo json_encode($this->planificacion_m->actualizarEstado($this->input->post('ot'),$this->input->post('ahora'),$this->input->post('despues'),$this->input->post('ot_articulo'),$this->input->post('ot_dominio'),$this->input->post('ot_estado'),$this->input->post('ot_id'),$this->input->post('ot_lote'),$this->input->post('ot_ot'),$this->input->post('ot_registro'),$this->input->post('ot_tipo'),$this->input->post('ot_usuario')));
  }

  function listarReferencias(){
    echo json_encode($this->planificacion_m->listarReferencias());
  }

  function actualizarReferencia(){
    echo json_encode($this->planificacion_m->actualizarReferencia($this->input->post('ref_tra'),$this->input->post('ref_referencia'),$this->input->post('ref_articulo'),$this->input->post('ref_lote'),$this->input->post('ref_ot'),$this->input->post('ref_cantidadEnvase'),$this->input->post('ref_cantidadxEnvase')));
  }

}
