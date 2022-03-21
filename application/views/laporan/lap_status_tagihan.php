<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_part/header');
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul ?></h1>
        </div>
      </div>
    </div>
  </section>
  <!-- /Content Header -->

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <!-- Input -->
      <div class="row">
        <div class="col-md-3">
          <div class="card shadow">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select" id="status" style="width: 100%">
                      <option value="2">Semua</option>
                      <option value="0">Belum Bayar</option>
                      <option value="1">Bayar</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <button class="btn btn-primary mb-0" id="btnLihat"><i class="fas fa-search"></i> Lihat Laporan</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-9">
          <div class="card shadow">
            <div class="card-header border-0">
              <h1 class="card-title">Laporan Status Tagihan</h1>
            </div>
            <div class="card-body">
              <div id="tampilLaporan">
                <div class="text-center" id="lapKosong">
                  <img src="<?= base_url() ?>assets/dist/img/illust/search.svg" class="img-fluid img-responsive" style="width: 20vh;">
                  <h6 class="text-muted mt-2">Klik <strong>Lihat Laporan</strong> untuk menampilkan laporan</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Input -->
    </div>

  </section>
  <!-- /Main content -->

</div>
<!-- /content-wrapper -->

<?php $this->load->view('_part/footer'); ?>
<script type="text/javascript">
$(document).ready(function(){

  // Lihat
  $('#btnLihat').click(function(e){
    e.preventDefault();
    var status = $('#status').val();

    var params = [
      "status=" + status
    ];

    loadingElementOn('#tampilLaporan');
    $('#lapKosong').remove();
    $('#tampilLaporan').html('<iframe class="iframe-rounded" id="laporanPdf" src="<?= site_url("laporan/lap_status_tagihan/filter_laporan") ?>?'+ params.join("&") +'" frameborder="0" style="width: 100%; height: calc(100vh - 200px)"></iframe>');

    $('#laporanPdf').on("load", function() {
      loadingElementOff('#tampilLaporan');
    });
  });

});



</script>
</body>
</html>
