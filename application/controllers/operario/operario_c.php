<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operario_c extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('operario/operario_m');
  }

  function index(){
    session_start();
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

  function crear_transaccion(){
    session_start();
    if (empty($_SESSION['per_tipo'])) {
      $this->load->view('index');
    }
    $this->load->view('operario/crearTransaccion_v');
  }

  function listar_referencia(){
    session_start();
    if (empty($_SESSION['per_tipo'])) {
      $this->load->view('index');
    }
    $this->load->view('operario/listarReferencia_v');
  }

  function listar_transaccion(){
    session_start();
    if (empty($_SESSION['per_tipo'])) {
      $this->load->view('index');
    }
    $this->load->view('operario/listarTransacciones_v');
  }

  function ingresarReferencia(){
    echo json_encode($this->operario_m->ingresarReferencia($this->input->post('txt_ot'),$this->input->post('txt_articulo'),$this->input->post('txt_lote'),$this->input->post('txt_um'),$this->input->post('txt_referencia'),$this->input->post('txt_cantxcaja'),$this->input->post('txt_kilosxcaja')));
  }

  function listarReferencias(){
    echo json_encode($this->operario_m->listarReferencias());
  }

  function validaReferencia(){
    echo json_encode($this->operario_m->validaReferencia($this->input->post('referenciaPistoleada')));
  }

  function ingresarTransaccion(){
    echo json_encode($this->operario_m->ingresarTransaccion($this->input->post('referenciasTransaccion')));
  }

  function consultaTransaccion(){
    echo $this->operario_m->consultaTransaccion();
  }

}
