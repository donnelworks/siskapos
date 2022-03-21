<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_m extends CI_Model {

  public $table = 'pembayaran';

  function load_data($post)
  {
    $this->datatables->select('
    pby.id,
    pby.nomor,
    pby.tgl,
    pby.id_tagihan_list,
    pby.dibuat,
    ksm.kode,
    ksm.nama,
    tgh_list.angsuran,
    pby.nominal,
    tgh_list.ket,
    usr.nama_user kolektor,
    ');
    $this->datatables->from("$this->table pby");
    $this->datatables->join('tagihan_list tgh_list', 'tgh_list.id = pby.id_tagihan_list', 'left');
    $this->datatables->join('konsumen ksm', 'ksm.id = tgh_list.id_konsumen', 'left');
    $this->datatables->join('user usr', 'usr.id_user = pby.id_user', 'left');
    // Filter
    if ($post['nomor_filter'] != null) {
      $this->datatables->like('pby.nomor', $post['nomor_filter']);
    }
    if ($post['periode_filter'] != null) {
      $periode = explode(" s/d ", $post['periode_filter']);
      $this->datatables->where('pby.tgl >=', date('Y-m-d', strtotime($periode[0])))->where('pby.tgl <=', date('Y-m-d', strtotime($periode[1])));
    }
    return $this->datatables->generate();
  }

  function ubah_status_tagihan($id)
  {
    $tgh = $this->db->get_where($this->table, ['id' => $id])->row();
    $col = [
      'status' => 0,
    ];
    $this->db->where('id', $tgh->id_tagihan_list);
    $this->db->update('tagihan_list', $col);
  }

  function hapus($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->table);
  }

  function cek_rows($where)
  {
    return $this->db->get_where($this->table, $where);
  }


}
