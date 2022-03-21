<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

  function load_data($post)
  {
    $id = $this->fungsi->user()->id_user;
    $this->datatables->from('user');
    $this->datatables->where('id_user !=', $id)->where('id_user !=', 1);
    // Filter
    if ($post['nama_filter'] != null) {
      $this->datatables->like('nama_user', $post['nama_filter']);
    }
    if ($post['level_filter'] != null) {
      $this->datatables->where('level_user', $post['level_filter']);
    }

    return $this->datatables->generate();
  }

  function detail_data($id = null)
  {
    $this->db->from('user');
    if ($id != null) {
      $this->db->where('id_user', $id);
    }
    $this->db->order_by('nama_user', 'asc');
    return $this->db->get();
  }

  function load_foto($id)
  {
    $this->db->from('user');
    $this->db->where('id_user', $id);
    $query = $this->db->get();
    return $query;
  }

  function upload($crop)
  {
    $arr = explode(";", $crop);
    $arr_foto = explode(",", $arr[1]);
    $foto = base64_decode($arr_foto[1]);

    $nama_foto = 'user-'.date('Ymd').'-'.substr(md5(rand()),0,10) . '.jpg';
    $path = './files/upload/img/user/' . $nama_foto;
    file_put_contents($path, $foto);

    return $nama_foto;
  }

  function tambah($post, $foto)
  {
    $col = [
      'nama_user' => $post['nama'],
      'no_hp_user' => $post['no_hp'],
      'pass_user' => md5($post['pass']),
      'level_user' => $post['level'],
      'foto_user' => $foto != null ? $foto : null,
    ];
    $this->db->insert('user', $col);
  }

  function ubah($post, $foto)
  {
    $col = [
      'nama_user' => $post['nama'],
      'no_hp_user' => $post['no_hp'],
      'level_user' => $post['level'],
    ];
    if ($post['pass'] != null) {
      $col['pass_user'] = md5($post['pass']);
    }

    if ($foto != null) {
      $col['foto_user'] = $foto;
    } else {
      $col['foto_user'] = null;
    }
    $this->db->where('id_user', $post['id']);
    $this->db->update('user', $col);
  }

  function hapus($id)
  {
    $this->db->where('id_user', $id);
    $this->db->delete('user');
  }

  function cek_data($where, $limit)
  {
    $query = $this->db->get_where('user', $where, $limit);
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }

}
