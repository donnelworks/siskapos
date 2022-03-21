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
                    <label>Periode</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right periode" id="periode" readonly>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Level</label>
                    <select class="form-control select" id="level" style="width: 100%">
                      <option value="2">DB</option>
                      <option value="3">Sales</option>
                      <option value="5">Kurir</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>User</label>
                    <select class="form-control select" id="user" style="width: 100%">
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
              <h1 class="card-title">Laporan Komisi</h1>
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
  // Init
  getUser();
  setPeriode('.periode', true);

  // Pilih Level
  $('#level').change(function() {
    getUser();
  });

  // Lihat
  $('#btnLihat').click(function(e){
    e.preventDefault();
    var periode = $('#periode').val().split(" s/d ");
    var periodeAwal = periode[0];
    var periodeAkhir = periode[1];
    var level = $('#level').val();
    var user = $('#user').val();

    var params = [
      "awal=" + periodeAwal,
      "akhir=" + periodeAkhir,
      "level=" + level,
      "user=" + user
    ];

    if (user != "") {
      $('#user').removeClass('is-invalid');
      $('.invalid-message').remove();
      loadingElementOn('#tampilLaporan');
      $('#lapKosong').remove();
      $('#tampilLaporan').html('<iframe class="iframe-rounded" id="laporanPdf" src="<?= site_url("laporan/lap_komisi/filter_laporan") ?>?'+ params.join("&") +'" frameborder="0" style="width: 100%; height: calc(100vh - 200px)"></iframe>');

      $('#laporanPdf').on("load", function() {
        loadingElementOff('#tampilLaporan');
      });
    } else {
      $('#user').addClass('is-invalid');
      $('#user').parents('.form-group').append('<span class="text-danger invalid-message">User belum dipilih</span>');
      // alertError("User belum dipilih");
    }

  });

});

function getUser()
{
  var level = $('#level').val();
  $.ajax({
      url : "<?= site_url('laporan/lap_komisi/get_user') ?>",
      method : "get",
      data : {level},
      async : false,
      dataType : 'json',
      success: function(data){
        var html = '<option selected="selected" value="">Pilih User</option>';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].id_user+'">'+data[i].nama_user+'</option>'
        }
        $('#user').html(html);
      }
  });
}



</script>
</body>
</html>
