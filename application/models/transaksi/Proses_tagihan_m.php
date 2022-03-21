<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_tagihan_m extends CI_Model {

  public $table_1 = 'tagihan';
  public $table_2 = 'tagihan_list';

  public function no_transaksi()
  {
    date_default_timezone_set('Asia/Jakarta');
    $query = $this->db->query("SELECT MAX(RIGHT(nomor, 4)) AS max FROM tagihan WHERE DATE(dibuat)=CURDATE()");
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

  public function angsuran($id_konsumen)
  {
    $query = $this->db->query("SELECT MAX(angsuran) AS max FROM tagihan_list WHERE id_konsumen='$id_konsumen'");
    $nomor = "";
    if($query->num_rows() > 0){
      foreach($query->result() as $no){
        $nomor = ((int)$no->max) + 1;
      }
    }else{
      $nomor = "1";
    }
    return $nomor;
  }

  function load_kurir()
  {
    $this->db->from('user')
    ->where('level_user', 5);
    return $this->db->get();
  }

  function load_histori($post)
  {
    $user = $this->fungsi->user()->id_user;
    $this->datatables->from($this->table_1);
    // Filter
    if ($post['nomor_filter'] != null) {
      $this->datatables->like('nomor', $post['nomor_filter']);
    }
    if ($post['periode_filter'] != null) {
      $periode = explode(" s/d ", $post['periode_filter']);
      $this->db->where('tgl >=', date('Y-m-d', strtotime($periode[0])))->where('tgl <=', date('Y-m-d', strtotime($periode[1])));
    }
    $this->datatables->where('id_user', $user)->where('status', 1);
    return $this->datatables->generate();
  }

  function load_data($id = null)
  {
    $user = $this->fungsi->user()->id_user;
    $this->db->from($this->table_1)
    ->where('id_user', $user);
    if ($id != null) {
      $this->db->where('id', $id);
    } else {
      $this->db->where('status', 0);
    }
    return $this->db->get();
  }

  function buat_transaksi()
  {
    $user = $this->fungsi->user()->id_user;
    $col = [
      'nomor' => 'TGH-'.date('Ymd').$this->no_transaksi(),
      'id_user' => $user,
    ];
    $this->db->insert($this->table_1, $col);
  }

  function hapus_transaksi($id = null)
  {
    $user = $this->fungsi->user()->id_user;
    $tgh = $this->db->get_where($this->table_1, ['status' => 0, 'id_user' => $user])->row_array();
    if ($id != null) {
      $this->db->where('id', $id);
    } else {
      $this->db->where('id', $tgh['id']);
    }
    $this->db->delete($this->table_1);
  }

  function hapus_semua_list($id = null, $opsi = null)
  {
    $user = $this->fungsi->user()->id_user;
    $tgh = $this->db->get_where($this->table_1, ['status' => 0, 'id_user' => $user])->row_array();
    if ($id != null && $opsi !== null) {
      if ($opsi === "update") {
        $this->db->where('id_tagihan', $id)->where('status', 0);
      } else {
        $this->db->where('id_tagihan', $id);
      }
    } else {
      $this->db->where('id_tagihan', $tgh['id']);
    }
    $this->db->delete($this->table_2);
  }

  function cek_konsumen($id_konsumen)
  {
    $user = $this->fungsi->user()->id_user;
    $tgh = $this->db->get_where($this->table_1, ['status' => 0, 'id_user' => $user])->row_array();
    return $this->db->get_where($this->table_2, ['id_tagihan' => $tgh['id'], 'id_konsumen' => $id_konsumen]);
  }

  function pilih_konsumen($id_konsumen)
  {
    $user = $this->fungsi->user()->id_user;
    $tgh = $this->db->get_where($this->table_1, ['status' => 0, 'id_user' => $user])->row_array();
    $ksmn = $this->db->get_where('konsumen', ['id' => $id_konsumen])->row_array();
    $col = [
      'id_tagihan' => $tgh['id'],
      'id_konsumen' => $id_konsumen,
      'kode_konsumen' => $ksmn['kode'],
      'nama_konsumen' => $ksmn['nama'],
      'angsuran' => $this->angsuran($id_konsumen),
      'nominal' => $ksmn['nominal'],
      'id_sales' => $ksmn['id_sales'],
      'id_db' => $ksmn['id_db'],
      'id_kurir' => $ksmn['id_kurir'],
    ];
    $this->db->insert($this->table_2, $col);
  }

  function pilih_konsumen_ubah($id_konsumen, $id_tagihan)
  {
    $ksmn = $this->db->get_where('konsumen', ['id' => $id_konsumen])->row_array();
    $col = [
      'id_tagihan' => $id_tagihan,
      'id_konsumen' => $id_konsumen,
      'kode_konsumen' => $ksmn['kode'],
      'nama_konsumen' => $ksmn['nama'],
      'angsuran' => $this->angsuran($id_konsumen),
      'nominal' => $ksmn['nominal'],
      'id_sales' => $ksmn['id_sales'],
      'id_db' => $ksmn['id_db'],
      'id_kurir' => null,
    ];
    return $col;
  }

  function tampil_list($key = null)
  {
    $user = $this->fungsi->user()->id_user;
    $tgh = $this->db->get_where($this->table_1, ['status' => 0, 'id_user' => $user])->row_array();
    $this->db->select('
    tghlist.*,
    usr1.nama_user sales,
    usr2.nama_user db,
    ')
    ->from("$this->table_2 tghlist")
    ->join('user usr1', 'tghlist.id_sales = usr1.id_user', 'left')
    ->join('user usr2', 'tghlist.id_db = usr2.id_user', 'left');
    if ($key != null) {
      $this->db->like('tghlist.kode_konsumen', $key)->or_like('tghlist.nama_konsumen', $key);
    }
    $this->db->where('tghlist.id_tagihan', $tgh['id']);
    $this->db->order_by('tghlist.dibuat', 'asc');
    return $this->db->get();
  }

  function ubah_list($post)
  {
    if ($post['ubah'] === "angsuran") {
      $col['angsuran'] = $post['val'];
    } else if ($post['ubah'] === "nominal") {
      $col['nominal'] = $post['val'];
    } else if ($post['ubah'] === "ket") {
      $col['ket'] = empty($post['val']) ? null : $post['val'];
    } else {
      $col['id_kurir'] = empty($post['val']) ? null : $post['val'];
    }
    $this->db->where('id', $post['id']);
    $this->db->update($this->table_2, $col);
  }

  function hapus_list($id_list)
  {
    $this->db->where('id', $id_list)
    ->delete($this->table_2);
  }

  function simpan_data($post)
  {
    $col = [
      'tgl' => date('Y-m-d', strtotime($post['tgl'])),
      'ket' => empty($post['ket']) ? null : $post['ket'],
      'status' => 1,
    ];
    $this->db->where('id', $post['id']);
    $this->db->update($this->table_1, $col);
  }

  function tampil_detail($id)
  {
    $this->db->select('
    tghlist.*,
    usr1.nama_user sales,
    usr2.nama_user db,
    usr3.nama_user kurir,
    ')
    ->from("$this->table_2 tghlist")
    ->join('user usr1', 'tghlist.id_sales = usr1.id_user', 'left')
    ->join('user usr2', 'tghlist.id_db = usr2.id_user', 'left')
    ->join('user usr3', 'tghlist.id_kurir = usr3.id_user', 'left')
    ->where('id_tagihan', $id)
    ->order_by('dibuat', 'asc');
    return $this->db->get();
  }

  function ubah_data($id)
  {
    $col = [
      'status' => 0,
    ];
    $this->db->where('id', $id);
    $this->db->update($this->table_1, $col);
  }

  function update_list($list)
  {
    foreach ($list as $li) {
      if ((int)$li['status'] == 0) {
        // var_dump($li['nama_konsumen']. '-' .$li['status']);
        $col = [
          'id_tagihan' => $li['id_tagihan'],
          'id_konsumen' => $li['id_konsumen'],
          'kode_konsumen' => $li['kode_konsumen'],
          'nama_konsumen' => $li['nama_konsumen'],
          'angsuran' => $li['angsuran'],
          'nominal' => $li['nominal'],
          'ket' => empty($li['ket']) ? null : $li['ket'],
          'id_sales' => $li['id_sales'],
          'id_db' => $li['id_db'],
          'id_kurir' => $li['id_kurir'],
          'status' => $li['status'],
        ];
        $this->db->insert($this->table_2, $col);
      }
    }
  }

  function cek_bayar($id)
  {
    $this->db->from($this->table_2)
    ->where('id_tagihan', $id)->where('status', 1);
    return $this->db->get();
  }

  function cek_rows_tgh($where)
  {
    return $this->db->get_where($this->table_1, $where);
  }

  function cek_rows_tgh_list($where)
  {
    return $this->db->get_where($this->table_2, $where);
  }


}
