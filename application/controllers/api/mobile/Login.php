<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/mobile/login_m');
    // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function proses_post()
  {
    $post = $this->post();
    if ($this->login_m->cek_data($post) > 0) {
      $data = $this->login_m->get_data($post)->row();
      $this->response($data, REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'Data tidak ada'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function cek_login_post()
  {
    $post = $this->post();
    if ($this->login_m->cek_login($post)->num_rows() > 0) {
      $data = $this->login_m->cek_login($post)->row();
      $this->response($data, REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'Data tidak ada'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

}
