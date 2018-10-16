<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class administrador_c extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('');
  }

  function index(){
    $this->load->view('administrador/index');
  }

}
