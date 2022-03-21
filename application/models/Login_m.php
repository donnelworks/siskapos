<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {

  public $table = 'user';

  function login($post)
  {
    $this->db->from($this->table);
    $this->db->where('no_hp', $post['no_hp'])->where('pass', md5($post['pass']));
    $query = $this->db->get();
    return $query;
  }

  function get($id)
  {
    $this->db->from($this->table);
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query;
  }

  function get_identitas($id)
  {
    $this->db->from('identitas');
    $this->db->where('id_identitas', $id);
    $query = $this->db->get();
    return $query;
  }

  function cek_data($where)
  {
    $query = $this->db->get_where($this->table, $where);
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }

}
