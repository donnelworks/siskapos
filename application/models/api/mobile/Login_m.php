<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {

  public $table = 'user';

  function get_data($post)
  {
    $this->db->from($this->table);
    $this->db->where('no_hp_user', $post['noHp'])->where('pass_user', md5($post['pass']));
    $query = $this->db->get();
    return $query;
  }

  function cek_data($post)
  {
    $this->db->from($this->table);
    $this->db->where('no_hp_user', $post['noHp'])->where('pass_user', md5($post['pass']))->where('level_user !=', 1);
    $query = $this->db->get()->num_rows();
    return $query;
  }

  function cek_login($post)
  {
    $this->db->from($this->table);
    $this->db->where('id_user', $post['id_user'])->where('no_hp_user', $post['no_hp_user']);
    $query = $this->db->get();
    return $query;
  }


}
