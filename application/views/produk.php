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
                      <input type="text" class="form-control" name="kode_filter" placeholder="Kode Produk">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control" name="nama_filter" placeholder="Nama Produk">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" name="status_filter">
                        <option value="">Semua</option>
                        <option value="0" selected>Aktif</option>
                        <option value="1">Tidak Aktif</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
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
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Detail Angsuran</th>
                    <th>Foto</th>
                    <th>Status</th>
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
                  <input type="text" name="id" class="form-control" id="idProduk" readonly>
                </div>
                <div class="row">
                  <div class="col-lg-8">
                    <div class="form-group">
                      <label>Kode Produk</label>
                      <input type="text" name="kode" class="form-control" id="kodeProduk">
                    </div>
                    <div class="form-group">
                      <label>Nama Produk</label>
                      <input type="text" name="nama" class="form-control" id="namaProduk">
                    </div>
                    <div class="form-group">
                      <label>Deskripsi Produk</label>
                      <textarea name="deskripsi" class="form-control textarea" rows="3" id="deskripsiProduk"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Detail Angsuran</label>
                      <textarea name="detail_angsuran" class="form-control textarea" rows="3" id="detailAngsuran"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <label class="img-upload-label">Foto Produk</label>
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

    // Init
    var simpan;
    loadData();

    // Tambah Data
    $('.btn-tambah').click(function(){
      simpan = "tambah";
      imgCrop('reset');
      $('.suitchi-first').suitchi('.suitchi-second');
      $('#kodeProduk').focus();
      $('.suitchi-title').text("Tambah Data");
      $('#formData').trigger('reset');
      $('.number').val(0);
      $('.textarea').text("");
    });

    // Ubah Data
    $('#tblData').on('click', '.ubah-data', function(){
      simpan = "ubah";
      var id = $(this).data('id');
      var kode = $(this).data('kode');
      var nama = $(this).data('nama');
      var deskripsi = $(this).data('deskripsi');
      var detail = $(this).data('detail');
      var foto = $(this).data('foto');

      $('#idProduk').val(id);
      $('#kodeProduk').val(kode);
      $('#namaProduk').val(nama);
      $('#deskripsiProduk').text(deskripsi);
      $('#detailAngsuran').text(detail);

      imgCrop('load', foto, '../files/upload/img/produk/');

      $('.suitchi-first').suitchi('.suitchi-second');
      $('.suitchi-title').text("Ubah Data");
      $('.form-control').removeClass('is-invalid');
      $('.invalid-message').remove();
      $('#kodeProduk').blur();
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
        url: "<?= site_url('produk/hapus') ?>",
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

    // Ubah Status Data
    $('#tblData').on('click','.status-data',function(){
      var id = $(this).data('id');
      var status = $(this).data('status');
      $.ajax({
        url: "<?= site_url('produk/ubah_status') ?>",
        type: "post",
        data: {id, status},
        success: function(){
          alertSukses("Berhasil Ubah Status");
          reloadTable('#tblData');
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
        url = "<?= site_url('produk/tambah') ?>";
      } else {
        url = "<?= site_url('produk/ubah') ?>";
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
            $('.number').val(0);
            $('.textarea').text("");
            $('.form-control').removeClass('is-invalid');
            $('.invalid-message').remove();
            $('#kode').focus();
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
      url: "<?= site_url('produk/load_data') ?>",
      dataFilter: "#formFilter",
      pageLength: 25,
      order: [[7, 'desc']],
      columns: [
        {data: 'kode', className: 'text-truncate-dt'},
        {data: 'nama', className: 'text-truncate-dt'},
        {data: 'deskripsi', className: 'none', render: function(data) {
          return data != null ? data : "-";
        }},
        {data: 'detail_angsuran', render: function(data) {
          return data != null ? data : "-";
        }},
        {data: 'foto', className: 'none', render: function(data) {
          return (data != null ? `<img src="../files/upload/img/produk/`+data+`" class="rounded foto-produk">` : `<img src="../assets/dist/img/foto-default.jpg" class="rounded foto-produk">`);
        }},
        {data: 'status', render: function(data) {
          return (data == 0 ? '<span class="badge badge-primary">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>');
        }},
        {data: "id", className: 'all', orderable: false, searchable: false, render: function(data, type, row) {
          return `<div class="text-center">
                    <button type="button" class="btn btn-rounded btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item ubah-data" href="javascript:void(0)"
                      data-id="`+data+`"
                      data-kode="`+row.kode+`"
                      data-nama="`+row.nama+`"
                      data-deskripsi="`+row.deskripsi+`"
                      data-detail="`+row.detail_angsuran+`"
                      data-foto="`+row.foto+`"
                      >
                      <i class="bx bx-edit"></i> Ubah</a>
                      <a class="dropdown-item hapus-data" href="javascript:void(0)" data-id="`+row.id+`"><i class="bx bx-trash"></i> Hapus</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item status-data" href="javascript:void(0)" data-id="`+row.id+`" data-status="`+row.status+`">${row.status == 0 ? '<i class="bx bx-x-circle"></i> Non-aktifkan' : '<i class="bx bx-check-circle"></i> Aktifkan'}</a>
                    </div>
                  </div>`;
        }},
        {data: 'dibuat', visible: false},
      ]
    });
  }



</script>
</body>
</html>
