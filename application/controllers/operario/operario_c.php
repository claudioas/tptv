<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operario_c extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('operario/operario_m');
  }

  function index(){
    $this->load->view('operario/index');
  }

}
