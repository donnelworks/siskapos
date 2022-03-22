<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsumen_m extends CI_Model {

  public $table = 'konsumen';

  function load_data($post)
  {
    $this->datatables->select('
    ksm.id,
    ksm.kode,
    ksm.nama,
    ksm.pin,
    ksm.no_hp,
    ksm.no_pesanan,
    ksm.kota,
    ksm.alamat,
    ksm.detail_angsuran,
    ksm.ctt,
    ksm.nominal,
    ksm.komisi_sales,
    ksm.komisi_db,
    ksm.komisi_kurir,
    ksm.dibuat,
    ksm.status,

    pdk.nama produk,
    usr1.nama sales,
    usr2.nama db,
    usr3.nama kurir,
    ')
    ->from("$this->table ksm")
    ->join('produk pdk', 'ksm.id_produk = pdk.id', 'left')
    ->join('user usr1', 'ksm.id_sales = usr1.id', 'left')
    ->join('user usr2', 'ksm.id_db = usr2.id', 'left')
    ->join('user usr3', 'ksm.id_kurir = usr3.id', 'left');
    // Filter
    if ($post['nama_filter'] != null) {
      $this->datatables->like('ksm.nama', $post['nama_filter']);
    }
    if ($post['kode_filter'] != null) {
      $this->datatables->like('ksm.kode', $post['kode_filter']);
    }
    if ($post['no_hp_filter'] != null) {
      $this->datatables->like('ksm.no_hp', $post['no_hp_filter']);
    }
    if ($post['no_pesanan_filter'] != null) {
      $this->datatables->like('ksm.no_pesanan', $post['no_pesanan_filter']);
    }
    if ($post['status_filter'] != null) {
      $this->datatables->like('ksm.status', $post['status_filter']);
    }

    return $this->datatables->generate();
  }

  function detail_data($id = null)
  {
    $this->db->from($this->table);
    if ($id != null) {
      $this->db->where('id', $id);
    }
    $this->db->order_by('nama', 'asc');
    return $this->db->get();
  }

  function load_produk()
  {
    $this->db->from('produk')
    ->where('status', 0);
    return $this->db->get();
  }

  function load_sales()
  {
    $this->db->from('user')
    ->where('role', 3);
    return $this->db->get();
  }

  function load_db()
  {
    $this->db->from('user')
    ->where('role', 2);
    return $this->db->get();
  }

  function load_kurir()
  {
    $this->db->from('user')
    ->where('role', 5);
    return $this->db->get();
  }

  function tambah($post)
  {
    $col = [
      'kode' => $post['kode'],
      'pin' => $post['pin'],
      'nama' => $post['nama'],
      'kota' => $post['kota'],
      'alamat' => $post['alamat'],
      'no_hp' => $post['no_hp'],
      'no_pesanan' => $post['no_pesanan'],
      'detail_angsuran' => empty($post['detail_angsuran']) ? null : $post['detail_angsuran'],
      'ctt' => empty($post['ctt']) ? null : $post['ctt'],
      'id_produk' => $post['produk'],
      'nominal' => $post['nominal'],
      'id_sales' => $post['sales'],
      'komisi_sales' => $post['komisi_sales'],
      'id_db' => $post['db'],
      'komisi_db' => $post['komisi_db'],
      'id_kurir' => $post['kurir'],
      'komisi_kurir' => $post['komisi_kurir'],
    ];
    $this->db->insert($this->table, $col);
  }

  function ubah($post)
  {
    $col = [
      'kode' => $post['kode'],
      'pin' => $post['pin'],
      'nama' => $post['nama'],
      'kota' => $post['kota'],
      'alamat' => $post['alamat'],
      'no_hp' => $post['no_hp'],
      'no_pesanan' => $post['no_pesanan'],
      'detail_angsuran' => empty($post['detail_angsuran']) ? null : $post['detail_angsuran'],
      'ctt' => empty($post['ctt']) ? null : $post['ctt'],
      'id_produk' => $post['produk'],
      'nominal' => $post['nominal'],
      'id_sales' => $post['sales'],
      'komisi_sales' => $post['komisi_sales'],
      'id_db' => $post['db'],
      'komisi_db' => $post['komisi_db'],
      'id_kurir' => $post['kurir'],
      'komisi_kurir' => $post['komisi_kurir'],
    ];
    $this->db->where('id', $post['id']);
    $this->db->update($this->table, $col);
  }

  function hapus($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->table);
  }

  function ubah_status($post)
  {
    if ($post['status'] == 0) {
      $col['status'] = 1;
    } else {
      $col['status'] = 0;
    }
    $this->db->where('id', $post['id']);
    $this->db->update($this->table, $col);
  }

  function cek_data($where, $limit)
  {
    $query = $this->db->get_where($this->table, $where, $limit);
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }

  function get_id_produk($kode)
  {
    $arr = explode("-",$kode);
    $produk = $this->db->get_where('produk', ['kode' => $arr[0]])->row();
    return $produk->id;
  }

  function cek_rows($where)
  {
    return $this->db->get_where($this->table, $where);
  }

}
