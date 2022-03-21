<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model('transaksi/pembayaran_m', 'mod');
	}

	public function index()
	{
		$data['judul'] = 'Pembayaran';
		$this->load->view('transaksi/pembayaran', $data);
	}

	public function load_data()
  {
		$post = $this->input->post();
    header('Content-Type: application/json');
    echo $this->mod->load_data($post);
  }

	public function hapus()
  {
    $id = $this->input->post('id');
    $this->mod->ubah_status_tagihan($id);
    $this->mod->hapus($id);
  }


}
