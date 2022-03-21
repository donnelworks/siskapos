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
        <div class="col-6 text-right suitchi-first">
          <!-- Tombol -->
          <button type="button" class="btn btn-primary btn-rounded d-none d-sm-inline btn-tambah">
            <i class="fas fa-plus"></i> Tambah Data
          </button>
          <!--  -->
          <button type="button" class="btn btn-rounded btn-primary d-inline d-sm-none dropdown-toggle" data-toggle="dropdown">
            <i class="fas fa-plus"></i>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item btn-tambah" href="javascript:void(0)">Tambah Data</a>
          </div>
          <!-- /.tombol -->
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 suitchi-first">
          <div class="card shadow">
            <!-- Filter -->
            <form id="formFilter">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control" name="nama_filter" placeholder="Nama User">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" name="level_filter">
                        <option value="">Level</option>
                        <option value="1">Admin</option>
                        <option value="2">DB</option>
                        <option value="3">Sales</option>
                        <option value="4">Kolektor</option>
                        <option value="5">Kurir</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button type="button" class="btn btn-rounded btn-primary filter-data" data-filter-table="#tblData"><i class="bx bx-filter-alt"></i> Filter</button>
                    <a href="javascript:void(0)" class="ml-2 reset-filter-data" data-filter-table="#tblData" data-filter-form="#formFilter"><strong>Reset</strong></a>
                  </div>
                </div>
              </div>
            </form>
            <!-- Table -->
            <div class="card-body p-0">
              <table id="tblData" class="table table-striped text-dark dt-responsive table-sm" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>No. Hp.</th>
                    <th>Level</th>
                    <th>Foto</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

        <!-- Form -->
        <div class="col-md-8 suitchi-second">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="card-title suitchi-title"></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool dismiss-suitchi" data-suitchi-table="#tblData">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <form id="formData" autocomplete="off">
              <div class="card-body">
                <div hidden>
                  <input type="text" name="id" class="form-control" id="id" readonly>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Nama User</label>
                      <input type="text" name="nama" class="form-control" id="nama">
                    </div>
                    <div class="form-group">
                      <label>No. Hp.</label>
                      <input type="text" name="no_hp" class="form-control" id="noHp">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="pass" class="form-control" id="pass">
                    </div>
                    <div class="form-group">
                      <label>Level</label>
                      <select class="form-control" name="level" id="level">
                        <option value="1">Admin</option>
                        <option value="2">DB</option>
                        <option value="3">Sales</option>
                        <option value="4">Kolektor</option>
                        <option value="5">Kurir</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label class="img-upload-label">Foto User</label>
                    <div class="img-upload">
                      <input type="text" name="foto" class="img-upload-crop">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer justify-content-between">
                <button type="submit" class="btn btn-primary" id="btnSimpanData">Simpan</button>
              </div>
            </form>
          </div>
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

    // Tambah Data
    $('.btn-tambah').click(function(){
      simpan = "tambah";
      imgCrop('reset');
      $('.suitchi-first').suitchi('.suitchi-second');
      $('.suitchi-title').text("Tambah Data");
      $('#formData').trigger('reset');
      $('#nama').focus();
    });

    // Ubah Data
    $('#tblData').on('click', '.ubah-data', function(){
      simpan = "ubah";
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var noHp = $(this).data('no-hp');
      var level = $(this).data('level');
      var foto = $(this).data('foto');

      $('#id').val(id);
      $('#nama').val(nama);
      $('#noHp').val(noHp);
      $('#level').val(level);

      imgCrop('load', foto, '../files/upload/img/user/');

      $('.suitchi-first').suitchi('.suitchi-second');
      $('.suitchi-title').text("Ubah Data");
      $('.form-control').removeClass('is-invalid');
      $('.invalid-message').remove();
      $('#nama').blur();
    });

    // Hapus Data
    $("#tblData").on('click', '.hapus-data', function(){
      var id = $(this).data('id');
      $('#idHapus').val(id);
      $('#mdlKonfirm').modal('show');
      $('#titleKonfirm').text('INGIN MENGHAPUS DATA?');
      $('#btnKonfirm').html('<button type="button" class="btn btn-danger" id="btnKonfirmHapus">Iya</button>');
    });
    $('#mdlKonfirm').on('click','#btnKonfirmHapus',function(){
      var id = $('#idHapus').val();
      $.ajax({
        url: "<?= site_url('utilitas/user/hapus') ?>",
        type: "post",
        data: {id},
        dataType: "json",
        beforeSend: function(){
          loadingBtnOn('#btnKonfirmHapus');
        },
        success: function(d){
          $('#mdlKonfirm').modal('hide');
          if (d.sukses == true) {
            loadingBtnOff('#btnKonfirmHapus');
            alertSukses("Berhasil Hapus Data");
            reloadTable('#tblData');
          } else {
            alertError("Data sedang digunakan");
          }
        },
        error: function(){
          loadingBtnOff('#btnKonfirmHapus');
          alertSukses("Gagal Hapus Data");
          $('#mdlKonfirm').modal('hide');
        }
      });
    });

    // Submit Data
    $('#formData').submit(function(e){
      e.preventDefault();

      var url;
      if (simpan == "tambah") {
        url = "<?= site_url('utilitas/user/tambah') ?>";
      } else {
        url = "<?= site_url('utilitas/user/ubah') ?>";
      }

      $.ajax({
        url: url,
        type: "post",
        data: $('#formData').serialize(),
        dataType: 'json',
        beforeSend: function(){
          loadingBtnOn('#btnSimpanData');
        },
        success: function(data){
          imgCrop('reset');
          loadingBtnOff('#btnSimpanData');
          if(data.sukses == true){
            alertSukses("Berhasil Simpan Data");
            reloadTable('#tblData');
            if(simpan == 'ubah'){
              $('.suitchi-second').suitchi('.suitchi-first');
            }
            $('#formData').trigger('reset');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-message').remove();
            $('#nama').focus();
          }else{
            alertError("Gagal Simpan Data");
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

  // Load Data
  function loadData()
  {
    $('#tblData').loadTable({
      url: "<?= site_url('utilitas/user/load_data') ?>",
      dataFilter: "#formFilter",
      pageLength: 25,
      order: [[5, 'desc']],
      columns: [
        {data: 'nama_user', className: 'text-truncate-dt'},
        {data: 'no_hp_user'},
        {data: 'level_user', render: function(data){
          return (data == 1 ? "Admin" : (data == 2 ? "DB" : (data == 3 ? "sales" : (data == 4 ? "Kolektor" : "Kurir"))));
        }},
        {data: 'foto_user', className: 'none', render: function(data) {
          return (data != null ? `<img src="../files/upload/img/user/`+data+`" class="rounded foto-produk">` : `<img src="../assets/dist/img/foto-default.jpg" class="rounded foto-produk">`);
        }},
        {data: "id_user", className: 'all', orderable: false, searchable: false, render: function(data, type, row) {
          return `<div class="text-center">
                    <button type="button" class="btn btn-rounded btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item ubah-data" href="javascript:void(0)"
                      data-id="`+row.id_user+`"
                      data-nama="`+row.nama_user+`"
                      data-no-hp="`+row.no_hp_user+`"
                      data-level="`+row.level_user+`"
                      data-foto="`+row.foto_user+`"
                      >
                      <i class="bx bx-edit"></i> Ubah</a>
                      <a class="dropdown-item hapus-data" href="javascript:void(0)" data-id="`+row.id_user+`"><i class="bx bx-trash"></i> Hapus</a>
                    </div>
                  </div>`;
        }},
        {data: 'dibuat_user', visible: false},
      ]
    });
  }



</script>
</body>
</html>
