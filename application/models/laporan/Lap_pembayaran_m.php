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
    tgh_list.ket,
    usr.nama_user as kolektor,
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->db->join('user as usr', 'usr.id_user = pby.id_user', 'left');
    $this->db->where('pby.tgl >=', date('Y-m-d', strtotime($get['awal'])))->where('pby.tgl <=', date('Y-m-d', strtotime($get['akhir'])));
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
    $this->db->join('user as usr', 'usr.id_user = pby.id_user', 'left');
    $this->db->where('pby.tgl >=', date('Y-m-d', strtotime($get['awal'])))->where('pby.tgl <=', date('Y-m-d', strtotime($get['akhir'])));
    if ($get['konsumen'] != null) {
      $this->db->where('tgh_list.id_konsumen', $get['konsumen']);
    }
    $query = $this->db->get();
    return $query;
  }
}
