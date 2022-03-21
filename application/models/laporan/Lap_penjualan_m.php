<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_penjualan_m extends CI_Model {

  public $table = 'pembayaran';

  function get_data($get)
  {
    $this->db->select('
    pby.id,
    pby.nomor,
    pby.tgl,
    ksm.kode,
    ksm.nama,
    tgh_list.angsuran,
    pby.nominal,
    tgh_list.ket,
    usr1.nama_user as sales,
    usr2.nama_user as db,
    usr3.nama_user as kurir,
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->db->join('user as usr1', 'usr1.id_user = tgh_list.id_sales', 'left');
    $this->db->join('user as usr2', 'usr2.id_user = tgh_list.id_db', 'left');
    $this->db->join('user as usr3', 'usr3.id_user = tgh_list.id_kurir', 'left');
    $this->db->where('tgh_list.angsuran', 1);
    $this->db->where('pby.tgl >=', date('Y-m-d', strtotime($get['awal'])));
    $this->db->where('pby.tgl <=', date('Y-m-d', strtotime($get['akhir'])));
    if ($get['konsumen'] != null) {
      $this->db->where('tgh_list.id_konsumen', $get['konsumen']);
    }
    $this->db->order_by('pby.tgl', 'asc');
    $query = $this->db->get();
    return $query;
  }

  function total($get)
  {
    $this->db->select('
    sum(pby.nominal) as nominal
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->db->join('user as usr1', 'usr1.id_user = tgh_list.id_sales', 'left');
    $this->db->join('user as usr2', 'usr2.id_user = tgh_list.id_db', 'left');
    $this->db->join('user as usr3', 'usr3.id_user = tgh_list.id_kurir', 'left');
    $this->db->where('tgh_list.angsuran', 1);
    $this->db->where('pby.tgl >=', date('Y-m-d', strtotime($get['awal'])));
    $this->db->where('pby.tgl <=', date('Y-m-d', strtotime($get['akhir'])));
    if ($get['konsumen'] != null) {
      $this->db->where('tgh_list.id_konsumen', $get['konsumen']);
    }
    $this->db->order_by('pby.tgl', 'asc');
    $query = $this->db->get();
    return $query;
  }
}
