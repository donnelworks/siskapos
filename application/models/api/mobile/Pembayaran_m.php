<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_m extends CI_Model {

  public $table = 'pembayaran';

  public function no_transaksi()
  {
    date_default_timezone_set('Asia/Jakarta');
    $query = $this->db->query("SELECT MAX(RIGHT(nomor, 4)) AS max FROM pembayaran WHERE DATE(dibuat)=CURDATE()");
    $nomor = "";
    if($query->num_rows() > 0){
      foreach($query->result() as $no){
        $tmp = ((int)$no->max) + 1;
        $nomor = sprintf("%04s", $tmp);
      }
    }else{
      $nomor = "0001";
    }
    return $nomor;
  }

  function get_data($id)
  {
    $this->db->select('
      pby.nomor,
      pby.tgl,
      ksm.kode,
      ksm.nama,
      tgh.angsuran,
      tgh.nominal,
      ksm.detail_angsuran as ket,
      usr.nama_user
    ')
    ->from("$this->table as pby")
    ->join('user as usr', 'usr.id_user = pby.id_user', 'left')
    ->join('tagihan_list as tgh', 'tgh.id = pby.id_tagihan_list', 'left')
    ->join('konsumen as ksm', 'ksm.id = tgh.id_konsumen', 'left')
    ->where('pby.id_tagihan_list', $id);
    $query = $this->db->get();
    return $query;
  }

  function post_data($post)
  {
    $col = [
      'nomor' => 'PBY-'.date('Ymd').$this->no_transaksi(),
      'tgl' => date('Y-m-d'),
      'id_tagihan_list' => $post['id'],
      'nominal' => $post['jumlah'],
      'id_user' => $post['user'],
    ];
    $this->db->insert($this->table, $col);
  }

  function ubah_status_tagihan($post)
  {
    $col = [
      'status' => 1,
    ];
    $this->db->where('id', $post['id']);
    $this->db->update('tagihan_list', $col);
  }

  function get_data_print($key = null, $user)
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
    usr.nama_user as user
    ');
    $this->db->from("$this->table as pby");
    $this->db->join('user as usr', 'usr.id_user = pby.id_user', 'left');
    $this->db->join('tagihan_list as tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->db->join('konsumen as ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->db->where('pby.id_user', $user);
    if ($key != null) {
      $this->db->like('ksm.nama', $key)->or_like('ksm.kode', $key);
    }
    $this->db->order_by('pby.dibuat', 'asc');
    $query = $this->db->get();
    return $query;
  }

}
