<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angsuran_m extends CI_Model {

  public $table = 'tagihan_list';

  function get_data($get)
  {
    $this->db->select('
      tgh_list.id,
      tgh_list.angsuran,
      tgh_list.nominal,
      tgh_list.ket as ket_tagihan,
      tgh_list.id_sales,
      tgh_list.id_db,
      tgh_list.id_kurir,
      tgh_list.dibuat,
      ksm.kode,
      ksm.nama,
      ksm.detail_angsuran as ket_angsuran
    ')
    ->from("$this->table as tgh_list")
    ->join('tagihan as tgh', 'tgh.id = tgh_list.id_tagihan', 'left')
    ->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left')
    ->where('tgh.tgl', date('Y-m-d'))
    ->where('tgh_list.id_konsumen', $get['konsumen'])
    ->where('tgh_list.status', 0)
    ->order_by('tgh_list.angsuran', 'asc');
    $query = $this->db->get();
    return $query;
  }

}
