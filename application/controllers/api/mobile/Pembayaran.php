<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pembayaran extends REST_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/mobile/pembayaran_m', 'mod');
    // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function bayar_post()
  {
    $post = $this->post();
    $this->mod->post_data($post);
    $this->mod->ubah_status_tagihan($post);
    $pesan = "Berhasil Bayar";
    $this->set_response($pesan, REST_Controller::HTTP_CREATED);
  }

  public function berhasil_get()
  {
    $id = $this->get('id');
    $data = $this->mod->get_data($id)->row();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  public function print_ulang_get()
  {
    $get = $this->get();
    $data = $this->mod->get_data_print($get['key'], $get['user'])->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }
}
