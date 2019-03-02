<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bodega_c extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('bodega/bodega_m');
  }

  function index(){
    session_start();
    // if ($_SESSION['per_tipo'] == 'DESHIDRATADO') {
    if (empty($_SESSION['per_tipo'])) {
      $this->load->view('index');
    }
    $this->load->view('bodega/index');
  }

  function listar_transacciones(){
    $this->load->view('bodega/listarTransacciones_v');
  }

  function ubicar_referencia(){
    $this->load->view('bodega/ubicar_referencia_v');
  }

  function recibirReferencia(){
    echo json_encode($this->bodega_m->recibirReferencia($this->input->post('txt_referencia')));
  }

  function listarReferencias(){
    echo json_encode($this->bodega_m->listarReferencias());
  }

}
