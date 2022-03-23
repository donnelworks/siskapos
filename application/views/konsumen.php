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
          <div class="d-none d-sm-inline">
            <div class="btn-group">
              <button type="button" class="btn btn-primary btn-rounded btn-tambah"><i class="fas fa-plus"></i> Tambah Data</button>
              <button type="button" class="btn btn-primary btn-rounded dropdown-toggle" data-toggle="dropdown">
                <span class="sr-only"></span>
              </button>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item btn-import" href="javascript:void(0)">Import Excel</a>
              </div>
            </div>
          </div>
          <!--  -->
          <div class="d-inline d-sm-none">
            <button type="button" class="btn btn-rounded btn-primary dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-plus"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item btn-tambah" href="javascript:void(0)">Tambah Data</a>
              <a class="dropdown-item btn-import" href="javascript:void(0)">Import Excel</a>
            </div>
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
                      <input type="text" class="form-control" name="kode_filter" placeholder="Kode Konsumen">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control" name="nama_filter" placeholder="Nama Konsumen">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control" name="no_hp_filter" placeholder="No. Hp.">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control" name="no_pesanan_filter" placeholder="No. Pesanan">
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
              <table id="tblData" class="table table-striped text-secondary nowrap" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>PIN</th>
                    <th>No. Hp.</th>
                    <th>No. Pesanan</th>
                    <th>Kota</th>
                    <th>Alamat</th>
                    <th>Detail Angsuran</th>
                    <th>Catatan</th>
                    <th>Produk</th>
                    <th>Nominal@Bulan</th>
                    <th>Sales</th>
                    <th>Komisi Sales</th>
                    <th>DB</th>
                    <th>Komisi DB</th>
                    <th>Kurir</th>
                    <th>Komisi Kurir</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

        <!-- Form -->
        <div class="col-md-6 suitchi-second">
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
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kode Konsumen</label>
                      <input type="text" name="kode" class="form-control" id="kode">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>PIN (4 Digit)</label>
                      <input type="text" name="pin" class="form-control" maxlength="4" id="pin">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Konsumen</label>
                      <input type="text" name="nama" class="form-control" id="nama">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>No. Pesanan</label>
                      <input type="text" name="no_pesanan" class="form-control" id="noPesanan">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kota</label>
                      <input type="text" name="kota" class="form-control" id="kota">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>No. Hp.</label>
                      <input type="text" name="no_hp" class="form-control" id="noHp">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Alamat Konsumen</label>
                      <textarea name="alamat" class="form-control textarea" rows="3" id="alamat"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Detail Angsuran</label>
                      <textarea name="detail_angsuran" class="form-control textarea" rows="3" id="detailAngsuran"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Catatan</label>
                      <textarea name="ctt" class="form-control textarea" rows="3" id="ctt"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Produk</label>
                      <select class="form-control select" name="produk" id="produk" style="width: 100%;">
                        <option value="">Pilih Produk</option>
                        <?php foreach ($produk as $data) { ?>
                          <option value="<?= $data->id ?>"><?= "$data->kode - $data->nama" ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nominal</label>
                      <input type="text" name="nominal" class="form-control number" value="0" id="nominal">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Sales</label>
                      <select class="form-control select" name="sales" id="sales" style="width: 100%;">
                        <option value="">Pilih Sales</option>
                        <?php foreach ($sales as $data) { ?>
                          <option value="<?= $data->id_user ?>"><?= $data->nama_user ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Komisi Sales</label>
                      <input type="text" name="komisi_sales" class="form-control number" value="0" id="komisiSales">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama DB</label>
                      <select class="form-control select" name="db" id="db" style="width: 100%;">
                        <option value="">Pilih DB</option>
                        <?php foreach ($db as $data) { ?>
                          <option value="<?= $data->id_user ?>"><?= $data->nama_user ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Komisi DB</label>
                      <input type="text" name="komisi_db" class="form-control number" value="0" id="komisiDb">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kurir</label>
                      <select class="form-control select" name="kurir" id="kurir" style="width: 100%; border: 1px solid #000;">
                        <option value="">Pilih Kurir</option>
                        <?php foreach ($kurir as $data) { ?>
                          <option value="<?= $data->id_user ?>"><?= $data->nama_user ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Komisi Kurir</label>
                      <input type="text" name="komisi_kurir" class="form-control number" value="0" id="komisiKurir">
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

    <!-- Modal Import -->
    <div class="modal fade" id="mdlImport">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-muted"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body border-bottom">
            <a href="javascript:void(0)" id="exportExcel">
              <div class="info-box mb-3 bg-gradient-primary">
                <span class="info-box-icon"><i class="far fa-file-excel"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text h5 mb-0">Download Template Excel</span>
                </div>
                <span class="info-box-icon"><i class="bx bx-download"></i></span>
              </div>
            </a>
          </div>
          <div class="modal-body">
            <h6>Upload Template</h6>
            <form id="formImport" enctype="multipart/form-data">
              <div class="form-group">
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="file_xls" class="custom-file-input" id="fileImport">
                    <label class="custom-file-label" id="lbImport" for="fileImport">Cari File Excel</label>
                  </div>
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" id="btnSubmitXls"><i class="flaticon-upload"></i> Import</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal Import -->

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

    // Select
    $('.select').select2();

    // Tambah Data
    $('.btn-tambah').click(function(){
      simpan = "tambah";
      $('.suitchi-first').suitchi('.suitchi-second');
      $('#kode').focus();
      $('.suitchi-title').text("Tambah Data");
      $('#formData').trigger('reset');
      $('.textarea').text("");
      $('.number').val(0);
    });

    // Ubah Data
    $(document).on('click', '.ubah-data', function(){
      var id = $(this).data('id');
      simpan = "ubah";
      $.ajax({
        url: "<?= site_url('konsumen/detail_data') ?>",
        type: "get",
        data: {id},
        dataType: "json",
        success: function(d) {
          $('#id').val(id);
          $('#kode').val(d.kode);
          $('#nama').val(d.nama);
          $('#pin').val(d.pin);
          $('#noHp').val(d.no_hp);
          $('#noPesanan').val(d.no_pesanan);
          $('#kota').val(d.kota);
          $('#alamat').text(d.alamat);
          $('#detailAngsuran').text(d.detail_angsuran);
          $('#ctt').text(d.ctt);
          $('#produk').val(d.id_produk).trigger('change');
          $('#nominal').val(d.nominal);
          $('#sales').val(d.id_sales).trigger('change');
          $('#komisiSales').val(d.komisi_sales);
          $('#db').val(d.id_db).trigger('change');
          $('#komisiDb').val(d.komisi_db);
          $('#kurir').val(d.id_kurir).trigger('change');
          $('#komisiKurir').val(d.komisi_kurir);

          $('.suitchi-first').suitchi('.suitchi-second');
          $('.suitchi-title').text("Ubah Data");
          $('.form-control').removeClass('is-invalid');
          $('.invalid-message').remove();
          $('#kode').blur();
        }
      });
    });

    // Hapus Data
    $(document).on('click', '.hapus-data', function(){
      var id = $(this).data('id');
      $('#idHapus').val(id);
      $('#mdlKonfirm').modal('show');
      $('#titleKonfirm').text('INGIN MENGHAPUS DATA?');
      $('#btnKonfirm').html('<button type="button" class="btn btn-danger" id="btnKonfirmHapus">Iya</button>');
    });
    $('#mdlKonfirm').on('click','#btnKonfirmHapus',function(){
      var id = $('#idHapus').val();
      $.ajax({
        url: "<?= site_url('konsumen/hapus') ?>",
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
    $(document).on('click','.status-data',function(){
      var id = $(this).data('id');
      var status = $(this).data('status');
      $.ajax({
        url: "<?= site_url('konsumen/ubah_status') ?>",
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
        url = "<?= site_url('konsumen/tambah') ?>";
      } else {
        url = "<?= site_url('konsumen/ubah') ?>";
      }

      $.ajax({
        url: url,
        type: "post",
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function(){
          loadingBtnOn('#btnSimpanData');
        },
        success: function(data){
          loadingBtnOff('#btnSimpanData');
          if(data.sukses == true){
            alertSukses("Berhasil Simpan Data");
            if(simpan == 'ubah'){
              $('.suitchi-second').suitchi('.suitchi-first');
              reloadTable('#tblData');
            }
            $('#formData').trigger('reset');
            $('.textarea').text("");
            $('.select').val("").trigger('change');
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

    // Export Data
    $('#exportExcel').click(function(e){
      e.preventDefault();
      window.location.href="<?= site_url('konsumen/export') ?>";
    });

    // Import Data
    $('.btn-import').click(function(){
      $('#mdlImport').modal();
      $('.modal-title').text("Import Data");
      $('#fileImport').val(null);
      $('#lbImport').text('Cari File Excel');
      $('.invalid-message').remove();
    });
    $('#btnSubmitXls').click(function(e){
      e.preventDefault();
      var form = $('#formImport')[0];
      var data = new FormData(form);
      $.ajax({
        url: "<?= site_url('konsumen/import') ?>",
        type: "post",
        data: data,
        cache: false,
        processData: false,
        contentType: false,
				dataType: "json",
        beforeSend: function(){
          loadingScreenOn();
        },
				success: function(d){
					loadingScreenOff();
          if (d.sukses == true) {
            reloadTable('#tblData');
						alertSukses("Berhasil Import Data");
            $('.invalid-message').remove();
            $('#fileImport').val(null);
            $('#lbImport').text('Cari File Excel');
            $('#mdlImport').modal('hide');
					} else {
            alertError("Gagal Import Data");
            $('#fileImport').val(null);
            $('#lbImport').text('Cari File Excel');
						$('#formImport').append('<span class="text-danger invalid-message">The contents of the data in the file is not valid. Please check again!</span>')
					}
        }
      });
    });

  });

  // Load Data
  function loadData()
  {
    $('#tblData').loadTable({
      url: "<?= site_url('konsumen/load_data') ?>",
      dataFilter: "#formFilter",
      pageLength: 25,
      responsive: false,
      scrollX: true,
      fixedColumns: {
        leftColumns: 2,
        rightColumns: 2
      },
      order: [[18, 'desc']],
      columns: [
        {data: 'kode'},
        {data: 'nama', className: 'text-truncate-dt'},
        {data: 'pin'},
        {data: 'no_hp'},
        {data: 'no_pesanan'},
        {data: 'kota', className: 'none'},
        {data: 'alamat', className: 'none'},
        {data: 'detail_angsuran', className: 'none', render: function(data) {
          return data != null ? data : "-";
        }},
        {data: 'ctt', className: 'none', render: function(data) {
          return data != null ? data : "-";
        }},
        {data: 'produk'},
        {data: 'nominal', className: 'none', render: function(data) {
          return 'Rp ' + $.number(data, 2, ',', '.');
        }},
        {data: 'sales'},
        {data: 'komisi_sales', className: 'none', render: function(data) {
          return 'Rp ' + $.number(data, 2, ',', '.');
        }},
        {data: 'db'},
        {data: 'komisi_db', className: 'none', render: function(data) {
          return 'Rp ' + $.number(data, 2, ',', '.');
        }},
        {data: 'kurir'},
        {data: 'komisi_kurir', className: 'none', render: function(data) {
          return 'Rp ' + $.number(data, 2, ',', '.');
        }},
        {data: "id", className: 'all', orderable: false, searchable: false, render: function(data, type, row) {
          return `<div class="text-center menu-table">
                    <a href="javascript:void(0)" class="btn-menu-table" data-toggle="dropdown">
                      <i class="bx bx-dots-horizontal-rounded bx-sm"></i>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item ubah-data" href="javascript:void(0)" data-id="${data}">
                      <i class="bx bx-edit"></i> Ubah</a>
                      <a class="dropdown-item hapus-data" href="javascript:void(0)" data-id="${data}">
                      <i class="bx bx-trash"></i> Hapus</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item status-data" href="javascript:void(0)" data-id="${data}" data-status="`+row.status+`">${row.status == 0 ? '<i class="bx bx-x-circle"></i> Non-aktifkan' : '<i class="bx bx-check-circle"></i> Aktifkan'}</a>
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
