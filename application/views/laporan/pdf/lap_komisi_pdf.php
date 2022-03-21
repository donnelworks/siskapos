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
          <th>Keterangan</th>
          <th style="text-align: right;">Komisi</th>
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
              <td><?= $data->ket ?></td>
              <?php if ($level == 2) { ?>
                <td style="text-align: right;">Rp <?= angka($data->komisi_db) ?></td>
              <?php } else if ($level == 3) { ?>
                <td style="text-align: right;">Rp <?= angka($data->komisi_sales) ?></td>
              <?php } else if ($level == 5) { ?>
                <td style="text-align: right;">Rp <?= angka($data->komisi_kurir) ?></td>
              <?php } ?>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="6" style="text-align: center;"><strong>Total</strong></td>
            <?php if ($level == 2) { ?>
              <td style="text-align: right;"><strong>Rp <?= angka($total->total_db) ?></strong></td>
            <?php } else if ($level == 3) { ?>
              <td style="text-align: right;"><strong>Rp <?= angka($total->total_sales) ?></strong></td>
            <?php } else if ($level == 5) { ?>
              <td style="text-align: right;"><strong>Rp <?= angka($total->total_kurir) ?></strong></td>
            <?php } ?>
          </tr>
        <?php } else { ?>
          <tr>
            <td colspan="7" style="text-align: center;">Tidak ada laporan</td>
          </tr>
        <?php } ?>

      </tbody>
    </table>

  </body>

</html>
