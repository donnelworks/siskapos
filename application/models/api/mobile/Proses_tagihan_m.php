<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_tagihan_m extends CI_Model {

  public $table_1 = 'tagihan';
  public $table_2 = 'tagihan_list';

  function get_data()
  {
    // $tgh = $this->db->get_where($this->table_1, ['tgl'=>date('Y-m-d')])->row();

    $this->db->select('
    sum(nominal) as nominal,
    tgh_list.id,
    tgh_list.id_tagihan as tagihan,
    tgh_list.id_konsumen as konsumen,
    tgh_list.nama_konsumen as nama,
    tgh_list.kode_konsumen as kode
    ')
    ->from("$this->table_2 as tgh_list")
    ->join('tagihan as tgh', 'tgh.id = tgh_list.id_tagihan', 'left')
    ->where('tgh.tgl', date('Y-m-d'))
    ->where('tgh_list.status', 0)
    ->group_by('tgh_list.kode_konsumen')
    ->order_by('tgh_list.nama_konsumen', 'asc');
    $query = $this->db->get();
    return $query;
  }

  function jmlh_data()
  {
    $this->db->from("$this->table_2 as tgh_list")
    ->join('tagihan as tgh', 'tgh.id = tgh_list.id_tagihan', 'left')
    ->where('tgh.tgl', date('Y-m-d'))
    ->where('tgh_list.status', 0);
    $query = $this->db->get();
    return $query;
  }

}
