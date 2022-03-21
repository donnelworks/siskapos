<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_pembayaran_m extends CI_Model {

  public $table = 'pembayaran';

  function get_data($get)
  {
    $this->db->select('
    pby.id,
    pby.nomor,
    pby.tgl,
    ksm.nama,
    ksm.kode,
    tgh_list.angsuran,
    pby.nominal,
    ksm.detail_angsuran as ket,
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->db->where('pby.id_user', $get['user'])->where('pby.tgl >=', date('Y-m-d', strtotime($get['awal'])))->where('pby.tgl <=', date('Y-m-d', strtotime($get['akhir'])));
    $this->db->order_by('pby.dibuat', 'asc');
    $query = $this->db->get();
    return $query;
  }

}
