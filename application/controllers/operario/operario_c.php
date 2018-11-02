<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operario_c extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('operario/operario_m');
  }

  function index(){
    session_start();
    // if ($_SESSION['per_tipo'] == 'DESHIDRATADO') {
    if (empty($_SESSION['per_tipo'])) {
      $this->load->view('index');
    }
    $this->load->view('operario/index');
  }

  function crear_referencia(){
    session_start();
    if (empty($_SESSION['per_tipo'])) {
      $this->load->view('index');
    }
    $this->load->view('operario/crearReferencia_v');
  }

  function listar_referencia(){
    session_start();
    // if ($_SESSION['per_tipo'] == 'DESHIDRATADO') {
    if (empty($_SESSION['per_tipo'])) {
      $this->load->view('index');
    }
    $this->load->view('operario/listarReferencia_v');
  }

  function ingresarReferencia(){
    // session_start();
    // echo json_encode($_SESSION['per_tipo']);
    echo json_encode($this->operario_m->ingresarReferencia($this->input->post('txt_ot'),$this->input->post('txt_articulo'),$this->input->post('txt_lote'),$this->input->post('txt_um'),$this->input->post('txt_referencia'),$this->input->post('txt_cantxcaja'),$this->input->post('txt_kilosxcaja')));
  }

}
