<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model([
			'produk_m' => 'mod',
			'konsumen_m' => 'mod_ksm'
		]);
	}

	public function index()
	{
		$data['judul'] = 'Produk';
		$this->load->view('produk', $data);
	}

	public function load_data()
  {
		$post = $this->input->post();
    header('Content-Type: application/json');
    echo $this->mod->load_data($post);
  }

	public function tambah()
  {
    $post = $this->input->post();
		$data = ['sukses' => false, 'error' => []];

		$this->form_validation->set_rules('kode', 'Kode Produk', 'trim|required|callback_kode');
		$this->form_validation->set_rules('nama', 'Nama Produk', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger invalid-message">', '</span>');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi!');
		$this->form_validation->set_message('numeric', 'Kolom {field} diisi dengan angka!');

		if ($this->form_validation->run()) {
			if ($post['foto'] != null) {
				$foto_upload = $this->mod->upload($post['foto']);
				$this->mod->tambah($post, $foto_upload);
				$data['sukses'] = true;
	    } else {
				$this->mod->tambah($post, null);
  			$data['sukses'] = true;
	    }
		} else {
			foreach ($post as $key => $value) {
			 	$data['error'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
  }

	public function ubah()
  {
    $post = $this->input->post();
		$data = ['sukses' => false, 'error' => []];

		$this->form_validation->set_rules('kode', 'Kode Produk', 'trim|required|callback_ubah_kode');
		$this->form_validation->set_rules('nama', 'Nama Produk', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger invalid-message">', '</span>');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi!');
		$this->form_validation->set_message('numeric', 'Kolom {field} diisi dengan angka!');

		if ($this->form_validation->run()) {
			if ($post['foto'] != null) {
				$row = $this->mod->load_foto($post['id'])->row();
				if ($post['foto'] != $row->foto) {
					// Replace
					if ($row->foto != null) {
						$targetfile = './files/upload/img/produk/'.$row->foto;
						if (file_exists($targetfile)) {
							unlink($targetfile);
						}
					}
					// ===
					$foto_upload = $this->mod->upload($post['foto']);
					$this->mod->ubah($post, $foto_upload);
					$data['sukses'] = true;
				} else {
					$this->mod->ubah($post, $post['foto']);
					$data['sukses'] = true;
				}
	    } else {
				// Hapus
				$row = $this->mod->load_foto($post['id'])->row();
				if ($row->foto != null) {
					$targetfile = './files/upload/img/produk/'.$row->foto;
					if (file_exists($targetfile)) {
						unlink($targetfile);
					}
				}
				// ===
				$this->mod->ubah($post, null);
				$data['sukses'] = true;
	    }
		} else {
			foreach ($post as $key => $value) {
			 	$data['error'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
  }

	public function hapus()
  {
    $id = $this->input->post('id');
		$data['sukses'] = true;
		if ($this->mod_ksm->cek_rows(array('id_produk' => $id))->num_rows() == 0) {
			$row = $this->mod->load_foto($id)->row();
			if ($row->foto != null) {
				$targetfile = './files/upload/img/produk/'.$row->foto;
				if (file_exists($targetfile)) {
					unlink($targetfile);
				}
			}
			$this->mod->hapus($id);
		} else {
			$data['sukses'] = false;
		}
		echo json_encode($data);
  }

	public function ubah_status()
	{
		$post = $this->input->post();
		$this->mod->ubah_status($post);
	}

	public function kode($kode)
	{
		$where = array('kode' => $kode);
		$cek = $this->mod->cek_data($where, 1);
	  if ($cek){
		  $this->form_validation->set_message('kode', '{field} sudah terdaftar!');
		  return FALSE;
	  }else{
		  return TRUE;
	  }
  }

	public function ubah_kode($kode)
	{
		$id = $this->input->post('id');
		$where = array('kode' => $kode, 'id !=' => $id);
		$cek = $this->mod->cek_data($where, 1);
	  if ($cek){
		  $this->form_validation->set_message('ubah_kode', '{field} sudah terdaftar!');
		  return FALSE;
	  }else{
		  return TRUE;
	  }
  }


}
