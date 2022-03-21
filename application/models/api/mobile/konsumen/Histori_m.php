<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Histori_m extends CI_Model {

  public $table = 'pembayaran';

  function get_data($get)
  {
    $this->db->select('
    pby.id,
    pby.nomor,
    pby.tgl,
    pby.nominal,
    tgh_list.angsuran,
    tgh_list.ket,
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->where('tgh_list.id_konsumen', $get['id']);
    $this->db->order_by('pby.tgl', 'asc');
    $query = $this->db->get();
    return $query;
  }

  function total($get)
  {
    $this->db->select('
    pby.id,
    sum(pby.nominal) as total_bayar,
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->where('tgh_list.id_konsumen', $get['id']);
    $query = $this->db->get();
    return $query;
  }


}
