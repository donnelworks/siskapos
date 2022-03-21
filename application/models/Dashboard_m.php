<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

  function jumlah_produk()
  {
    $this->db->from('produk');
    $this->db->where('status', 0);
    $query = $this->db->get();
    return $query;
  }

  function jumlah_konsumen()
  {
    $this->db->from('konsumen');
    $this->db->where('status', 0);
    $query = $this->db->get();
    return $query;
  }

  function jumlah_angsuran()
  {
    $tgh = $this->db->get_where('tagihan', ['tgl'=>date('Y-m-d')])->row();
    $this->db->from('tagihan_list')
    ->where('id_tagihan', $tgh->id ?? null)
    ->where('status', 0);
    $query = $this->db->get();
    return $query;
  }

  function total_penjualan()
  {
    $this->db->select('
    sum(pby.nominal) as nominal
    ');
    $this->db->from("pembayaran as pby");
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->db->where('tgh_list.angsuran', 1);
    $this->db->where('month(pby.tgl)', date('m'))->where('year(pby.tgl)', date('Y'));
    $query = $this->db->get();
    return $query;
  }

  function produk_laku()
  {
    $this->db->select('
    pdk.nama,
    pdk.kode,
    count(ksm.id_produk) produk
    ');
    $this->db->from('pembayaran as pby');
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->db->join('produk as pdk', 'pdk.id = ksm.id_produk', 'left');
    $this->db->where('tgh_list.angsuran', 1);
    $this->db->group_by('ksm.id_produk');
    $this->db->limit(5);
    return $this->db->get();
  }

  function tahun_transaksi()
  {
    $this->db->select('Year(pby.tgl) tahun');
    $this->db->from('pembayaran as pby');
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->where('tgh_list.angsuran', 1);
    $this->db->group_by('Year(pby.tgl)');
    $this->db->order_by('Year(pby.tgl)', 'desc');
    $query = $this->db->get();
    return $query;
  }

  function chart_transaksi($tahun)
  {
    $this->db->select('Month(pby.tgl) bulan, sum(pby.nominal) total');
    $this->db->from('pembayaran as pby');
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->where('tgh_list.angsuran', 1);
    $this->db->where('Year(pby.tgl)', $tahun);
    $this->db->order_by('Month(pby.tgl)', 'asc');
    $query = $this->db->get();
    return $query;
  }

}
