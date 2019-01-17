<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('index_m');
  }

  function index(){
    session_start();
    if (empty($_SESSION['per_tipo'])) {
      $this->load->view('index');
    }
    $this->load->view('operario/index');
  }

  function login(){
    echo json_encode($this->index_m->login($this->input->post('u'),$this->input->post('p')));
  }

  function onSignIn(){
    echo json_encode($this->index_m->onSignIn($this->input->post('user')));
  }

}
