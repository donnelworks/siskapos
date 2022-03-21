<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_m extends CI_Model {

  public $table = 'produk';

  function get_data($key = null)
  {
    $this->db->from($this->table);
    $this->db->where('status', 0);
    if ($key != null) {
      $this->db->like('nama', $key)->or_like('kode', $key);
    }
    $this->db->order_by('nama', 'asc');
    $query = $this->db->get();
    return $query;
  }

}
