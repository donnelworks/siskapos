<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Histori extends REST_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/mobile/konsumen/histori_m', 'mod');
    // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_get()
  {
    $get = $this->get();
    $data['list'] = $this->mod->get_data($get)->result();
    $data['total'] = $this->mod->total($get)->row();
    $this->response($data, REST_Controller::HTTP_OK);
  }

}
