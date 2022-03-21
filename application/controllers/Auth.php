<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
    $this->load->model('login_m', 'mod');
	}

	public function proses()
	{
		$post = $this->input->post();
		$data = array ('sukses' => false, 'error' => array());

		$this->form_validation->set_rules('no_hp', 'No. Hp.', 'trim|required|callback_cek_no_hp');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|callback_cek_pass');
		$this->form_validation->set_error_delimiters('<span class="text-danger invalid-message">', '</span>');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi!');

		if($this->form_validation->run()) {
			$row = $this->mod->login($post)->row();
			$col = array(
				'id' => $row->id,
				'role' => $row->role
			);
			$this->session->set_userdata($col);
			$data['sukses'] = true;
		}else{
			foreach ($post as $key => $value) {
			 	$data['error'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

	public function cek_no_hp($no_hp)
	{
		$where = array('no_hp' => $no_hp, 'role' => 1);
		if ($no_hp != null) {
			$cek = $this->mod->cek_data($where);
		  if ($cek){
				return TRUE;
		  }else{
				$this->form_validation->set_message('cek_no_hp', '{field} salah! Silahkan coba lagi!');
				return FALSE;
		  }
		} else {
			return TRUE;
		}
  }

	public function cek_pass($pass)
	{
		$where = array('pass' => md5($pass), 'role' => 1);
		if ($pass != null) {
			$cek = $this->mod->cek_data($where);
		  if ($cek){
				return TRUE;
		  }else{
				$this->form_validation->set_message('cek_pass', '{field} salah! Silahkan coba lagi!');
				return FALSE;
		  }
		} else {
			return TRUE;
		}
  }

	public function logout()
	{
		$col = array('id', 'role');
		$this->session->unset_userdata($col);
		redirect('login');
	}
}
