<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <style type="text/css">
      body {
        font-size: 11pt;
        font-family: "calibri", sans-serif;
      }

      table {
        border-collapse: collapse;
        width: 100%;
      }

      .tbl-data td, .tbl-data th {
        border: 1px solid #000;
        text-align: left;
      }

      .tbl-data th, .tbl-data td {
        padding: 5px;
      }
    </style>

  </head>

  <body>

    <table class="tbl-data">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nomor</th>
          <th>Tanggal</th>
          <th>Kode</th>
          <th>Nama</th>
          <th>Angsuran</th>
          <th>Keterangan</th>
          <th>Sales</th>
          <th>DB</th>
          <th>Kurir</th>
          <th style="text-align: right;">Nominal</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($list != null) { ?>
          <?php $no = 1; ?>
          <?php foreach ($list as $data) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data->nomor ?></td>
              <td><?= tgl_cetak($data->tgl) ?></td>
              <td><?= $data->kode ?></td>
              <td><?= $data->nama ?></td>
              <td><?= $data->angsuran ?></td>
              <td><?= $data->ket ?></td>
              <td><?= $data->sales ?></td>
              <td><?= $data->db ?></td>
              <td><?= $data->kurir ?></td>
              <td style="text-align: right;">Rp <?= angka($data->nominal) ?></td>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="10" style="text-align: center;"><strong>Total</strong></td>
            <td style="text-align: right;"><strong>Rp <?= angka($total->nominal) ?></strong></td>
          </tr>
        <?php } else { ?>
          <tr>
            <td colspan="11" style="text-align: center;">Tidak ada laporan</td>
          </tr>
        <?php } ?>

      </tbody>
    </table>

  </body>

</html>
