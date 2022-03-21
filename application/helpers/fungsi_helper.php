<?php

function cek_sedang_login()
{
  $ci =& get_instance();
  $user_session = $ci->session->userdata('id');
  if($user_session) {
    redirect('dashboard');
  }
}

function cek_tidak_login()
{
  $ci =& get_instance();
  $user_session = $ci->session->userdata('id');
  if(!$user_session) {
    redirect('login');
  }
}

function cek_level($level)
{
  $ci =& get_instance();
  $ci->load->library('fungsi');
  $arr = explode(",", $level);
  $levelUser = $ci->fungsi->user()->level_user;
  if (!in_array($levelUser, $arr)) {
    redirect('dashboard');
  }
}

function random_host($length)
{
  $str_result = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  return substr(str_shuffle($str_result),0, $length);
}

function angka($angka){
  $hasil_angka = number_format($angka,0, '', '.');
  return $hasil_angka;
}

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka, 2);
  return $hasil_rupiah;
}

function tgl($tanggal){
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2].'-'.$pecahkan[1].'-'.$pecahkan[0];
}

function tgl_cetak($tanggal){
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2].'/'.$pecahkan[1].'/'.$pecahkan[0];
}

function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function bln_indo($bln){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  return $bulan[(int)$bln];
}

function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " ". $huruf[$nilai];
  } else if ($nilai <20) {
    $temp = penyebut($nilai - 10). " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
  }
  return $temp;
}

function terbilang($nilai) {
  if($nilai<0) {
    $hasil = "minus ". trim(penyebut($nilai)) . " rupiah";
  } else {
    $hasil = trim(penyebut($nilai)) . " rupiah";
  }
  return $hasil;
}

function to_float($num) {
  $dotPos = strrpos($num, '.');
  $commaPos = strrpos($num, ',');
  $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
  ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

  if (!$sep) {
    return floatval(preg_replace("/[^0-9]/", "", $num));
  }

  return floatval(
    preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
    preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
  );
}
