<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class planificacion_c extends CI_Controller{

  public function __construct(){
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('planificacion/planificacion_m');
  }

  function index(){
    $this->load->view('planificacion/index');
  }

}
