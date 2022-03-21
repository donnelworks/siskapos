<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_komisi_m extends CI_Model {

  public $table = 'pembayaran';

  function get_data($get)
  {
    $this->db->select('
    pby.id,
    pby.nomor,
    pby.tgl,
    ksm.nama,
    ksm.kode,
    ksm.komisi_sales,
    ksm.komisi_db,
    ksm.komisi_kurir,
    tgh_list.ket,
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    if ($get['level'] == 2) {
      $this->db->where('tgh_list.id_db', $get['user']);
    } else if ($get['level'] == 3) {
      $this->db->where('tgh_list.id_sales', $get['user']);
    } else if ($get['level'] == 5) {
      $this->db->where('tgh_list.id_kurir', $get['user']);
    }
    $this->db->where('tgh_list.angsuran', 1);
    $this->db->where('pby.tgl >=', date('Y-m-d', strtotime($get['awal'])));
    $this->db->where('pby.tgl <=', date('Y-m-d', strtotime($get['akhir'])));
    $this->db->order_by('pby.tgl', 'asc');
    $query = $this->db->get();
    return $query;
  }

  function total($get)
  {
    $this->db->select('
    pby.id,
    sum(ksm.komisi_sales) as total_sales,
    sum(ksm.komisi_db) as total_db,
    sum(ksm.komisi_kurir) as total_kurir,
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    if ($get['level'] == 2) {
      $this->db->where('tgh_list.id_db', $get['user']);
    } else if ($get['level'] == 3) {
      $this->db->where('tgh_list.id_sales', $get['user']);
    } else if ($get['level'] == 5) {
      $this->db->where('tgh_list.id_kurir', $get['user']);
    }
    $this->db->where('tgh_list.angsuran', 1);
    $this->db->where('pby.tgl >=', date('Y-m-d', strtotime($get['awal'])));
    $this->db->where('pby.tgl <=', date('Y-m-d', strtotime($get['akhir'])));
    $query = $this->db->get();
    return $query;
  }

  function get_user($level)
  {
    $this->db->from('user');
    $this->db->where('level_user', $level);
    $this->db->order_by('nama_user', 'asc');
    return $this->db->get();
  }


}
