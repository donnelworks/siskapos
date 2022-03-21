<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_m extends CI_Model {

  public $table = 'user';

  function load_data()
  {
    $id = $this->fungsi->user()->id_user;
    $this->db->from($this->table);
    $this->db->where('id_user', $id);
    $query = $this->db->get();
    return $query;
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

  function simpan_pass($post)
  {
    $id = $this->fungsi->user()->id_user;
    $col = [
      'pass_user' => md5($post['pass_baru']),
    ];
    $this->db->where('id_user', $id);
    $this->db->update($this->table, $col);
  }

  function simpan_data($post, $foto)
  {
    $col = [
      'nama_user' => $post['nama'],
      'no_hp_user' => $post['no_hp'],
    ];

    if ($foto != null) {
      $col['foto_user'] = $foto;
    } else {
      $col['foto_user'] = null;
    }

    $this->db->where('id_user', $post['id']);
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

}
