<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_part/header');
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row align-items-center mb-2">
        <div class="col-6">
          <h1 class="m-0"><?= $judul ?></h1>
          <div class="test-fungsi">

          </div>
        </div>
        <div class="col-6 text-right">

        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <!-- Data Profile -->
          <div class="card shadow">
            <form id="formData" autocomplete="off" enctype="multipart/form-data">
              <div class="card-body">
                <input type="hidden" name="id" class="form-control" id="id" readonly>

                <div class="row text-center">
                  <div class="col-md-12">
                    <div class="img-upload">
                      <input type="text" name="foto" class="img-upload-crop">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" name="nama" class="form-control" id="nama">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>No. Tlp.</label>
                      <input type="text" name="no_hp" class="form-control" id="noHp">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary" id="btnSimpanData">Simpan</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <!-- Password -->
          <div class="card card-warning card-outline shadow">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h5><i class="bx bx-lock"></i> Password</h5>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                  <p class="mb-0">Mohon diingat password baru anda</p>
                </div>
                <div class="col-md-6 text-right">
                  <button type="button" class="btn btn-warning" id="btnUbahPass">Ubah Password</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Password -->
    <div class="modal fade" id="mdlPass">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-muted"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="formPass">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="pass_baru" class="form-control" id="passBaru">
                  </div>
                  <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="konfirm_pass_baru" class="form-control" id="konfirmPassBaru">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <a href="javascript:void(0)" data-dismiss="modal"><strong>Batal</strong></a>
              <button type="submit" class="btn btn-primary" id="btnSimpanPass">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="mdlKonfirm">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-body">
            <p class="margin lead text-center" id="titleKonfirm"></p>
            <div hidden>
              <input type="text" class="form-control" id="idHapus" readonly>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            <span id="btnKonfirm"></span>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('_part/footer'); ?>
<script type="text/javascript">
  $(document).ready(function(){

    var simpan;
    loadData();

    // Hapus Foto
    $("#btnImgDelete").click(function(e){
      e.preventDefault();
      $('#crop').val("");
      $('#imgPreview').attr('src', '../assets/dist/img/foto-default.jpg');
    });

    // Ubah Password
    $('#btnUbahPass').click(function(){
      $('#mdlPass').modal();
      $('.modal-title').text("Ubah password");
      $('#formPass').trigger('reset');
      $('.form-control').removeClass('is-invalid');
      $('.invalid-message').remove();
      $('#mdlPass').on('shown.bs.modal', function(){
        $('#ubahPass').focus();
      });
    });

    // Simpan Data
    $("#btnSimpanData").click(function(e){
      e.preventDefault();
      $('#mdlKonfirm').modal({backdrop: 'static'});
      $('#titleKonfirm').text('INGIN MENYIMPAN DATA?');
      $('#btnKonfirm').html('<button type="button" class="btn btn-primary" id="btnKonfirmSimpan">Iya</button>');
    });
    $('#mdlKonfirm').on('click','#btnKonfirmSimpan',function(){
      var form = $('#formData')[0];
      var data = new FormData(form);
      $.ajax({
        url: "<?= site_url('utilitas/profile/simpan_data') ?>",
        type: "post",
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(data){
          if (data.sukses == true) {
            loadData();
            alertSukses("Berhasil Simpan Data");
            $('#mdlKonfirm').modal('hide');
          } else {
            loadData();
            alertError("Gagal Simpan Data");
            $('#mdlKonfirm').modal('hide');
          }
        }
      });
    });

    // Simpan Password
    $('#formPass').submit(function(e){
      e.preventDefault();
      $.ajax({
        url: "<?= site_url('utilitas/profile/simpan_pass') ?>",
        type: "post",
        data: $(this).serialize(),
        dataType: "json",
        success: function(data){
          if (data.sukses == true) {
            alertSukses("Berhasil Ubah Password");
            $('#mdlPass').modal('hide');
          } else {
            alertError("Gagal Ubah Password");
            $.each(data.error,function(key, value){
              var el = $('[name="'+key+'"]');
              el.closest('.form-control')
              .removeClass('is-invalid')
              .addClass(value.length > 0 ? 'is-invalid' : '');
              el.closest('.form-group')
              .find('.invalid-message')
              .remove();
              el.parents(".form-group")
              .append(value);
            });
          }
        }
      });
    });

  });

  function loadData()
  {
    $.ajax({
      url: "<?= site_url('utilitas/profile/load_data') ?>",
      dataType: "json",
      success: function(data){
        $('#id').val(data.id_user);
        $('#nama').val(data.nama_user);
        $('#noHp').val(data.no_hp_user);
        imgCrop('load', data.foto_user, '../files/upload/img/user/');
      }
    });
  }



</script>
</body>
</html>
