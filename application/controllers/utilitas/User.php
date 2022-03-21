<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		cek_level('1');
		$this->load->model([
			'utilitas/user_m' => 'mod',
			'konsumen_m' => 'mod_ksm',
			'transaksi/proses_tagihan_m' => 'mod_tgh',
			'transaksi/pembayaran_m' => 'mod_pby'
		]);
	}

	public function index()
	{
		$data['judul'] = 'Pengguna';
		$this->load->view('utilitas/user', $data);
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

		$this->form_validation->set_rules('nama', 'Nama Pengguna', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No. Hp.', 'trim|required|callback_no_hp');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
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

		$this->form_validation->set_rules('nama', 'Nama Pengguna', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No. Hp.', 'trim|required|callback_ubah_no_hp');
		$this->form_validation->set_error_delimiters('<span class="text-danger invalid-message">', '</span>');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi!');
		$this->form_validation->set_message('numeric', 'Kolom {field} diisi dengan angka!');

		if ($this->form_validation->run()) {
			if ($post['foto'] != null) {
				$row = $this->mod->load_foto($post['id'])->row();
				if ($post['foto'] != $row->foto_user) {
					// Replace
					if ($row->foto_user != null) {
						$targetfile = './files/upload/img/user/'.$row->foto_user;
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
				if ($row->foto_user != null) {
					$targetfile = './files/upload/img/user/'.$row->foto_user;
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
		if (
			$this->mod_ksm->cek_rows(array('id_sales' => $id))->num_rows() == 0 &&
			$this->mod_ksm->cek_rows(array('id_db' => $id))->num_rows() == 0 &&
			$this->mod_ksm->cek_rows(array('id_kurir' => $id))->num_rows() == 0 &&
			$this->mod_tgh->cek_rows_tgh(array('id_user' => $id))->num_rows() == 0 &&
			$this->mod_pby->cek_rows(array('id_user' => $id))->num_rows() == 0
		) {
			$row = $this->mod->load_foto($id)->row();
			if ($row->foto_user != null) {
				$targetfile = './files/upload/img/user/'.$row->foto_user;
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

	public function no_hp($no_hp)
	{
		$where = array('no_hp_user' => $no_hp);
		$cek = $this->mod->cek_data($where, 1);
	  if ($cek){
		  $this->form_validation->set_message('no_hp', '{field} sudah terdaftar!');
		  return FALSE;
	  }else{
		  return TRUE;
	  }
  }

	public function ubah_no_hp($no_hp)
	{
		$id = $this->input->post('id');
		$where = array('no_hp_user' => $no_hp, 'id_user !=' => $id);
		$cek = $this->mod->cek_data($where, 1);
	  if ($cek){
		  $this->form_validation->set_message('ubah_no_hp', '{field} sudah terdaftar!');
		  return FALSE;
	  }else{
		  return TRUE;
	  }
  }


}
