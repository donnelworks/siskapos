<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model('utilitas/profile_m', 'mod');
	}

	public function index()
	{
		$data['judul'] = 'Profile';
		$this->load->view('utilitas/profile', $data);
	}

	public function load_data()
  {
    $data = $this->mod->load_data()->row();
		echo json_encode($data);
  }

	public function simpan_data()
  {
    $post = $this->input->post();
		$data = ['sukses' => false, 'error' => []];

		$this->form_validation->set_rules('nama', 'Nama Pengguna', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No. Hp.', 'trim|required|callback_no_hp');
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
					$this->mod->simpan_data($post, $foto_upload);
					$data['sukses'] = true;
				} else {
					$this->mod->simpan_data($post, $post['foto']);
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
				$this->mod->simpan_data($post, null);
				$data['sukses'] = true;
	    }
		} else {
			foreach ($post as $key => $value) {
			 	$data['error'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
  }

  public function simpan_pass()
  {
    $post = $this->input->post();
		$data = ['sukses' => false, 'error' => []];

    $this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required');
		$this->form_validation->set_rules('konfirm_pass_baru', 'Konfirmasi Password Baru', 'trim|required|matches[pass_baru]');
		$this->form_validation->set_error_delimiters('<span class="text-danger invalid-message">', '</span>');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi!');
		$this->form_validation->set_message('numeric', 'Kolom {field} diisi dengan angka!');
		$this->form_validation->set_message('matches', '{field} tidak sesuai!');

		if ($this->form_validation->run()) {
      $this->mod->simpan_pass($post);
      $data['sukses'] = true;
		} else {
			foreach ($post as $key => $value) {
			 	$data['error'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
  }

	public function no_hp($no_hp)
	{
		$id = $this->input->post('id');
		$where = array ('no_hp_user' => $no_hp, 'id_user !=' => $id);
		$cek = $this->mod->cek_data($where, 1);
	  if ($cek){
		  $this->form_validation->set_message('no_hp', '{field} sudah terdaftar!');
		  return FALSE;
	  }else{
		  return TRUE;
	  }
  }

}
