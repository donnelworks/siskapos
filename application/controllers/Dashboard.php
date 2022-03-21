<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model('dashboard_m', 'mod');
	}

	public function index()
	{
		$data['judul'] = 'Dashboard';
		$data['jumlah_produk'] = $this->mod->jumlah_produk()->num_rows();
		$data['jumlah_konsumen'] = $this->mod->jumlah_konsumen()->num_rows();
		$data['jumlah_angsuran'] = $this->mod->jumlah_angsuran()->num_rows();
		$data['total_penjualan'] = $this->mod->total_penjualan()->row();
		$data['tahun_transaksi'] = $this->mod->tahun_transaksi()->result();
		$this->load->view('dashboard', $data);
	}

	public function produk_laku()
	{
		$data = $this->mod->produk_laku()->result();
		echo json_encode($data);
	}

	public function chart_transaksi()
	{
		$tahun = $this->input->get('tahun');
		$data['sukses'] = true;
		if ($tahun != "") {
			$data['list'] = $this->mod->chart_transaksi($tahun)->result();
    } else {
			$data['sukses'] = false;
    }
		echo json_encode($data);
	}

}
