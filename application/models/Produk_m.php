<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_m extends CI_Model {

  function load_data($post)
  {
    $this->datatables->from('produk');
    // Filter
    if ($post['kode_filter'] != null) {
      $this->datatables->like('kode', $post['kode_filter']);
    }
    if ($post['nama_filter'] != null) {
      $this->datatables->like('nama', $post['nama_filter']);
    }
    if ($post['status_filter'] != null) {
      $this->datatables->where('status', $post['status_filter']);
    }

    return $this->datatables->generate();
  }

  function load_foto($id)
  {
    $this->db->from('produk');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query;
  }

  function upload($crop)
  {
    $arr = explode(";", $crop);
    $arr_foto = explode(",", $arr[1]);
    $foto = base64_decode($arr_foto[1]);

    $nama_foto = 'produk-'.date('Ymd').'-'.substr(md5(rand()),0,10) . '.jpg';
    $path = './files/upload/img/produk/' . $nama_foto;
    file_put_contents($path, $foto);

    return $nama_foto;
  }

  function tambah($post, $foto)
  {
    $col = [
      'nama' => $post['nama'],
      'kode' => $post['kode'],
      'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi'],
      'detail_angsuran' => empty($post['detail_angsuran']) ? null : $post['detail_angsuran'],
      'foto' => $foto != null ? $foto : null,
    ];
    $this->db->insert('produk', $col);
  }

  function ubah($post, $foto)
  {
    $col = [
      'nama' => $post['nama'],
      'kode' => $post['kode'],
      'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi'],
      'detail_angsuran' => empty($post['detail_angsuran']) ? null : $post['detail_angsuran'],
    ];
    if ($foto != null) {
      $col['foto'] = $foto;
    } else {
      $col['foto'] = null;
    }
    $this->db->where('id', $post['id']);
    $this->db->update('produk', $col);
  }

  function hapus($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('produk');
  }

  function cek_data($where, $limit)
  {
    $query = $this->db->get_where('produk', $where, $limit);
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }

  function ubah_status($post)
  {
    if ($post['status'] == 0) {
      $col['status'] = 1;
    } else {
      $col['status'] = 0;
    }
    $this->db->where('id', $post['id']);
    $this->db->update('produk', $col);
  }

  function cek_rows($where)
  {
    return $this->db->get_where('produk', $where);
  }

}
