<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Produk extends REST_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/mobile/produk_m', 'mod');
    // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_get()
  {
    $key = $this->get('key');
    $data = $this->mod->get_data($key)->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }
}
