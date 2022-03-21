<?php

Class Fungsi {

    protected $ci;

    function __construct() {
        $this->ci =& get_instance();
    }

    function user() {
        $this->ci->load->model('login_m');
        $id = $this->ci->session->userdata('id');
        $user_data = $this->ci->login_m->get($id)->row();
        return $user_data;
    }

    function role() {
        $this->ci->load->model('login_m');
        $id = $this->ci->session->userdata('id');
        $role_data = $this->ci->login_m->get($id)->row();
        $role = ($role_data->role == 1 ? "Admin" : ($role_data->role == 2 ? "DB" : ($role_data->role == 3 ? "Sales" : "Kolektor")));
        return $role;
    }

    function identitas() {
        $this->ci->load->model('utilitas/identitas_m');
        $id = 1;
        $identitas = $this->ci->identitas_m->load($id)->row();
        return $identitas;
    }

}
