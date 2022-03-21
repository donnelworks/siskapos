<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/mobile/konsumen/login_m', 'mod');
    // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function proses_post()
  {
    $post = $this->post();
    if ($this->mod->cek_data($post) > 0) {
      $row = $this->mod->get_data($post)->row();
      $data = [
        'id' => $row->id,
        'kode' => $row->kode,
        'nama' => $row->nama,
        'alamat' => $row->alamat,
        'ket' => $row->detail_angsuran
      ];
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
    if ($this->mod->cek_login($post)->num_rows() > 0) {
      $data = $this->mod->cek_login($post)->row();
      $this->response($data, REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'Data tidak ada'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

}
