<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
	{
		parent::__construct();
		cek_sedang_login();
	}

	public function index()
	{
		$this->load->view('login');
  }
}
