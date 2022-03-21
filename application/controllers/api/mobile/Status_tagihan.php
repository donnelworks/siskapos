<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Status_tagihan extends REST_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/mobile/status_tagihan_m', 'mod');
    // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_get()
  {
    $status = $this->get('status');
    $data = $this->mod->get_data($status)->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }
}
