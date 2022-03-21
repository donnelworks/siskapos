<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {

  public $table = 'konsumen';

  function get_data($post)
  {
    $this->db->from($this->table);
    $this->db->where('kode', $post['kode'])->where('pin', $post['pin'])->where('status', 0);
    $query = $this->db->get();
    return $query;
  }

  function cek_data($post)
  {
    $this->db->from($this->table);
    $this->db->where('kode', $post['kode'])->where('pin', $post['pin'])->where('status', 0);
    $query = $this->db->get()->num_rows();
    return $query;
  }

  function cek_login($post)
  {
    $this->db->from($this->table);
    $this->db->where('id', $post['id'])->where('kode', $post['kode']);
    $query = $this->db->get();
    return $query;
  }


}
