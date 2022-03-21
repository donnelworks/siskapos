<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_tagihan_m extends CI_Model {

  public $table = 'tagihan_list';

  function get_data($status)
  {
    $this->db->select('
    tgh_list.id,
    ksm.nama,
    ksm.kode,
    tgh_list.angsuran,
    tgh_list.nominal,
    usr1.nama_user as sales,
    usr2.nama_user as db,
    usr3.nama_user as kurir,
    tgh_list.ket,
    tgh_list.status
    ');
    $this->db->from("$this->table as tgh_list");
    $this->db->join('tagihan as tgh', 'tgh.id = tgh_list.id_tagihan', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->db->join('user as usr1', 'usr1.id_user = tgh_list.id_sales', 'left');
    $this->db->join('user as usr2', 'usr2.id_user = tgh_list.id_db', 'left');
    $this->db->join('user as usr3', 'usr3.id_user = tgh_list.id_kurir', 'left');
    $this->db->where('tgh.tgl', date('Y-m-d'));
    if ($status != 2) {
      $this->db->where('tgh_list.status', $status);
    }
    $this->db->order_by('tgh_list.nama_konsumen', 'asc');
    $this->db->order_by('tgh_list.angsuran', 'asc');
    $query = $this->db->get();
    return $query;
  }

}
