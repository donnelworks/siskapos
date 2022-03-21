<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_tagihan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model('transaksi/proses_tagihan_m', 'mod');
	}

	public function index()
	{
		$data['judul'] = 'Proses Tagihan';
		$this->load->view('transaksi/proses_tagihan', $data);
	}

	public function load_histori()
  {
		$post = $this->input->post();
    header('Content-Type: application/json');
    echo $this->mod->load_histori($post);
  }

	public function load_data()
  {
    $data = $this->mod->load_data()->row();
    echo json_encode($data);
  }

	public function buat_transaksi()
  {
    $this->mod->buat_transaksi();
  }

	public function batal_transaksi()
  {
    $this->mod->hapus_semua_list();
    $this->mod->hapus_transaksi();
  }

	public function pilih_konsumen()
  {
		$id_konsumen = $this->input->post('id');
		$this->mod->pilih_konsumen($id_konsumen);
  }

	public function pilih_konsumen_ubah()
  {
		$post = $this->input->post();
		$data['list'] = $this->mod->pilih_konsumen_ubah($post['id'], $post['idTgh']);
		echo json_encode($data);
  }

	public function tampil_list()
  {
		$key = $this->input->get('key');
		$data['list'] = $this->mod->tampil_list($key)->result();
		$data['kurir'] = $this->mod->load_kurir()->result();
    echo json_encode($data);
  }

	public function ubah_list()
  {
		$post = $this->input->post();
		$this->mod->ubah_list($post);
  }

	public function hapus_list()
  {
		$id_list = $this->input->post('id');
		$this->mod->hapus_list($id_list);
  }

	public function simpan_data()
  {
		$post = $this->input->post();
		$this->mod->simpan_data($post);
  }

	public function update_list()
  {
		$post = $this->input->post();
		$this->mod->hapus_semua_list($post['id'], "update");
		$this->mod->update_list($post['data']);
  }

	public function tampil_detail()
  {
		$id = $this->input->get('id');
		$data = $this->mod->tampil_detail($id)->result();
    echo json_encode($data);
  }

	public function detail_data()
  {
		$id = $this->input->get('id');
		$data['tgh'] = $this->mod->load_data($id)->row();
		$data['detail'] = $this->mod->tampil_detail($id)->result();
    echo json_encode($data);
  }

	public function hapus()
  {
		$id = $this->input->post('id');
		$data['sukses'] = true;
		if ($this->mod->cek_bayar($id)->num_rows() == 0) {
			$this->mod->hapus_semua_list($id, "hapus");
			$this->mod->hapus_transaksi($id);
		} else {
			$data['sukses'] = false;
		}
		echo json_encode($data);
  }

}
