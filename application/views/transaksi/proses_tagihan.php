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
        <div class="col-6">
          <!-- Tab -->
          <ul class="nav nav-pills float-right home-view d-none">
            <li class="nav-item">
              <a class="nav-link active" href="#tab-start" data-toggle="tab">
                <span class="d-block d-sm-none"><i class="fas fa-shopping-cart"></i></span>
                <span class="d-none d-sm-block">Transaksi</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab-histori" data-toggle="tab" id="btnHistori">
                <span class="d-block d-sm-none"><i class="fas fa-history"></i></span>
                <span class="d-none d-sm-block">Histori</span>
              </a>
            </li>
          </ul>
          <!-- /.Tab -->
        </div>
      </div>
    </div>
  </div>
  <!-- /.Content Header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="tab-content">
        <div class="tab-pane active" id="tab-start">
          <!-- Start View -->
          <div class="d-none home-view">
            <div class="row">
              <div class="col-12">
                <div class="text-center">
                  <img src="<?= base_url() ?>assets/dist/img/illust/tagihan.svg" class="img-fluid img-responsive" style="width: 50vh;">
                </div>
              </div>
              <div class="col-12">
                <div class="text-center">
                  <h5 class="mb-3">Oops, sedang tidak ada transaksi</h5>
                  <button type="button" class="btn btn-lg btn-primary" id="btnBuat">Buat Transaksi</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.Start View -->
        </div>
        <div class="tab-pane" id="tab-histori">
          <!-- Histori View -->
          <div class="home-view">
            <div class="row">
              <div class="col-12">
                <div class="card shadow">
                  <!-- Filter -->
                  <form id="formFilterHistori">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <input type="text" class="form-control" name="nomor_filter" placeholder="Nomor">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="far fa-calendar-alt"></i>
                                </span>
                              </div>
                              <input type="text" class="form-control float-right periode-filter" name="periode_filter"placeholder="Pilih periode transaksi" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <button type="button" class="btn btn-rounded btn-primary filter-data" data-filter-table="#tblHistori"><i class="bx bx-filter-alt"></i> Filter</button>
                          <a href="javascript:void(0)" class="ml-2 reset-filter-data" data-filter-table="#tblHistori" data-filter-form="#formFilterHistori" data-periode-form=".periode-filter"><strong>Reset</strong></a>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!-- Table -->
                  <div class="card-body p-0">
                    <table id="tblHistori" class="table table-striped text-dark dt-responsive table-sm" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Nomor</th>
                          <th>Tanggal</th>
                          <th>Keterangan</th>
                          <th></th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.Histori View -->
        </div>
      </div>

      <!-- Transaksi View -->
      <div class="d-none transaksi-view">
        <div class="row">
          <div class="col-12">
            <div class="alert alert-warning bg-soft-warning d-none">
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Bagian Kiri -->
          <div class="col-md-8">
            <div class="card shadow">
              <!-- Filter -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-rounded mb-3" id="btnCariKonsumen">
                      <i class="bx bx-search"></i> Cari Konsumen
                    </button>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" id="listFilter" placeholder="Cari Nama/Kode">
                      <span class="input-group-append">
                        <button type="button" class="btn btn-primary" id="btnListFilter"><i class="bx bx-search"></i></button>
                        <button type="button" class="btn btn-rounded btn-soft-primary" id="btnResetListFilter">Reset</button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- List -->
              <div class="card-body table-responsive table-striped p-0 scrollbar" id="bodyListTagihan">
                <table class="table table-head-fixed table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Kode</th>
                      <th>Nama</th>
                      <th>Angsuran Ke</th>
                      <th>Nominal</th>
                      <th>Keterangan</th>
                      <th>Sales</th>
                      <th>DB</th>
                      <th>Kurir</th>
                    </tr>
                  </thead>
                  <tbody id="tampilList">
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <p class="mb-0" id="totalList"></p>
              </div>
            </div>
          </div>
          <!-- /.Bagian Kiri -->

          <!-- Bagian Kanan -->
          <div class="col-md-4">
            <div class="card p-2 shadow">
              <div class="card-body border-bottom">
                <div class="media">
                  <div class="mr-3 align-self-center">
                    <i class="bx bx-receipt bx-md text-primary"></i>
                  </div>
                  <div class="media-body">
                    <p class="text-muted mb-0">No. Tagihan</p>
                    <h5><strong class="no-transaksi"></strong></h5>
                  </div>
                </div>
              </div>
              <div class="card-body border-bottom">
                <form id="formData" autocomplete="off">
                  <div class="form-group" hidden>
                    <input type="text" class="form-control" name="id" id="id" readonly>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control tgl" name="tgl" id="tglTransaksi" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="ket" rows="3" placeholder="Keterangan" id="ket"></textarea>
                  </div>
                </form>
              </div>
              <div class="card-body">
                <button type="button" class="btn btn-block btn-lg btn-primary" id="btnProses"></button>
                <button type="button" class="btn btn-block btn-lg btn-soft-primary border-0" id="btnBatal">Batal</button>
              </div>
            </div>
          </div>
          <!-- /.Bagian Kanan -->
        </div>
      </div>
      <!-- /.Transaksi View -->
    </div>

    <!-- Modal Konsumen -->
    <div class="modal fade" id="mdlKonsumen">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-muted"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Filter Konsumen -->
            <form id="formFilterKosumen">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control filter" name="kode_filter" placeholder="Kode Konsumen">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control filter" name="nama_filter" placeholder="Nama Konsumen">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control filter" name="no_hp_filter" placeholder="No. Hp.">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control filter" name="no_pesanan_filter" placeholder="No. Pesanan">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control filter" placeholder="Aktif" readonly>
                      <input type="hidden" class="form-control filter" name="status_filter" value="0" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-rounded btn-primary filter-data" data-filter-table="#tblKonsumen"><i class="bx bx-filter-alt"></i> Filter</button>
                    <a href="javascript:void(0)" class="ml-2 reset-filter-data" data-filter-table="#tblKonsumen" data-filter-form="#formFilterKosumen"><strong>Reset</strong></a>
                  </div>
                </div>
              </div>
            </form>
            <!-- /.Filter Konsumen -->
            <!-- Table Konsumen -->
            <div class="card-body p-0">
              <table id="tblKonsumen" class="table table-striped text-dark dt-responsive" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Kode</th>
                    <th>No. Hp.</th>
                    <th>No. Pesanan</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                    <th>Detail Angsuran</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
            <!-- /.Table Konsumen -->
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal Konsumen -->

    <!-- Modal Detail -->
    <div class="modal fade" id="mdlDetail">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-muted"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body table-responsive p-0 scrollbar">
            <!-- Table Detail -->
            <table id="tblDetail" class="table table-striped text-nowrap">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Kode</th>
                  <th>Angsuran Ke</th>
                  <th>Nominal</th>
                  <th>Keterangan</th>
                  <th>Sales</th>
                  <th>DB</th>
                  <th>Kurir</th>
                </tr>
              </thead>
              <tbody id="tampilDetail">
              </tbody>
            </table>
            <!-- /.Table Detail -->
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal Detail -->

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
    <!-- /.Modal Konfirmasi -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('_part/footer'); ?>
<script type="text/javascript">
  $(document).ready(function(){

    // Init
    var proses;
    setPeriode('.periode-filter', false);
    loadData();
    loadKonsumen();
    loadHistori();
    $('.tgl').datepicker({
      autoclose: true,
      orientation: 'bottom auto',
      format: 'dd-mm-yyyy',
      language: 'id',
      templates:
      {
        leftArrow: '<i class="bx bx-chevron-left"></i>',
        rightArrow: '<i class="bx bx-chevron-right"></i>',
      }
    }).datepicker('setDate',new Date());

    // Buat Transaksi
    $('#btnBuat').click(function(){
      proses = 'buat';
      $('#ket').text("");
      $('#tglTransaksi').datepicker('setDate',new Date());
      $('#btnCariKonsumen').removeClass('d-none');
      buatTransaksi();
    });

    // Histori Transaksi
    $('#btnHistori').click(function(){
      reloadTable('#tblHistori');
    });

    // Batal Transaksi
    $('#btnBatal').click(function(){
      $('#mdlKonfirm').modal('show');
      $('#titleKonfirm').text('INGIN MEMBATALKAN TRANSAKSI?');
      $('#btnKonfirm').html('<button type="button" class="btn btn-danger" id="btnKonfirmBatal">Iya</button>');
    });
    $('#mdlKonfirm').on('click','#btnKonfirmBatal',function(){
      $('#mdlKonfirm').modal('hide');
      if (proses == 'ubah') {
        loadData();
      } else {
        batalTransaksi();
      }
    });

    // Cari Konsumen
    $('#btnCariKonsumen').click(function(){
      $('#mdlKonsumen').modal();
      $('.modal-title').text("Cari Konsumen");
      $('#mdlKonsumen').on('shown.bs.modal', function() {
        reloadTable('#tblKonsumen');
      });
    });

    // Pilih Konsumen
    $("#tblKonsumen").on('click', '.pilih-konsumen', function(){
      var id = $(this).data('id');
      // var idTgh = $('#id').val();
      $.ajax({
        url: "<?= site_url('transaksi/proses_tagihan/pilih_konsumen') ?>",
        type: "post",
        data: {id},
        beforeSend: function() {
          loadingBtnOn('#pilihKonsumen' + id);
        },
        success: function() {
          setTimeout(function() {
            loadingBtnOff('#pilihKonsumen' + id);
          }, 800);
          tampilList();
        }
      });

      // if (proses == 'buat') {
      //
      // } else {
      //   $.ajax({
      //     url: "<?= site_url('transaksi/proses_tagihan/pilih_konsumen_ubah') ?>",
      //     type: "post",
      //     data: {id, idTgh},
      //     dataType: "json",
      //     beforeSend: function() {
      //       loadingBtnOn('#pilihKonsumen' + id);
      //     },
      //     success: function(d) {
      //       setTimeout(function() {
      //         loadingBtnOff('#pilihKonsumen' + id);
      //       }, 800);
      //       var list = JSON.parse(localStorage.getItem('proses-tagihan'));
      //       // if (list == null) list = [];
      //       list.push(d.list);
      //       localStorage.setItem("proses-tagihan", JSON.stringify(list));
      //       tampilListUbah();
      //     }
      //   });
      // }
    });

    // Cari List
    $('#btnListFilter').click(function(){
      if (proses == 'buat') {
        tampilList();
      } else {
        tampilListUbah();
      }
    });

    // Reset List
    $('#btnResetListFilter').click(function(){
      $('#listFilter').val("");
      if (proses == 'buat') {
        tampilList();
      } else {
        tampilListUbah();
      }
    });

    // Ubah Daftar
    $("#tampilList").on('focus', '.ubah-list', function(){
      $('#btnProses').prop('disabled', true);
    });
    $("#tampilList").on('blur', '.ubah-list', function(){
      $('#btnProses').prop('disabled', false);
    });
    $("#tampilList").on('change', '.ubah-list', function(){
      var id = $(this).data('id');
      var ubah = $(this).data('ubah');
      var val = $(this).val();

      if (proses == 'ubah') {
        var data = JSON.parse(localStorage.getItem('proses-tagihan'));
        for (var i = 0; i < data.length; i++) {
          if (data[i].id == id) {
            if (ubah === "angsuran") {
              data[i].angsuran = val;
            } else if (ubah === "nominal") {
              data[i].nominal = val;
            } else if (ubah === "ket") {
              data[i].ket = val;
            } else {
              data[i].id_kurir = val == "" ? "" : val;
            }
            break;
          }
        }
        localStorage.setItem('proses-tagihan', JSON.stringify(data));
        tampilListUbah();
      } else {
        $.ajax({
          url: "<?= site_url('transaksi/proses_tagihan/ubah_list') ?>",
          type: "post",
          data: {id, ubah, val},
          success: function() {
            tampilList();
          }
        })
      }
    });

    // Hapus Daftar
    $("#tampilList").on('click', '.hapus-list', function(){
      var id = $(this).data('id');
      if (proses == 'ubah') {
        var data = JSON.parse(localStorage.getItem('proses-tagihan'));
        for (var i = 0; i < data.length; i++) {
          if (data[i].id == id) {
            data.splice(i, 1);
            break;
          }
        }
        localStorage.setItem('proses-tagihan', JSON.stringify(data));
        tampilListUbah();
      } else {
        $.ajax({
          url: "<?= site_url('transaksi/proses_tagihan/hapus_list') ?>",
          type: "post",
          data: {id},
          success: function() {
            tampilList();
          }
        })
      }
    });

    // Detail Data
    $('#tblHistori').on('click', '.detail-data', function(){
      var id = $(this).data('id');
      var nomor = $(this).data('nomor');
      $('#mdlDetail').modal();
      $('.modal-title').text(`Detail ${nomor}`);
      $('#mdlDetail').on('shown.bs.modal', function() {
        tampilDetail(id);
      });
    });

    // Ubah Data
    $('#tblHistori').on('click', '.ubah-data', function(){
      proses = 'ubah';
      $('#btnProses').text("Update");
      var id = $(this).data('id');

      $.ajax({
        url: "<?= site_url('transaksi/proses_tagihan/detail_data') ?>",
        type: "get",
        data: {id},
        dataType: "json",
        beforeSend: function() {
          loadingLinkOn('#ubahData'+id, 'bx bx-edit');
          loadingElementOn('.content-wrapper');
        },
        success: function(d) {
          loadingLinkOff('#ubahData'+id, 'bx bx-edit');
          loadingElementOff('.content-wrapper');
          $('.home-view').addClass('d-none');
          $('.transaksi-view').removeClass('d-none');
          $('#btnCariKonsumen').addClass('d-none');
          $('.alert').removeClass('d-none').html('Ubah transaksi <strong>'+d.tgh.nomor+'</strong> tanggal <strong>'+tglIndo(d.tgh.tgl)+'</strong>');

          localStorage.setItem("proses-tagihan", JSON.stringify(d.detail));
          tampilListUbah();
          $('#id').val(d.tgh.id);
          $('.no-transaksi').text(d.tgh.nomor);
          $('#tglTransaksi').val(tgl(d.tgh.tgl));
          $('#ket').text(d.tgh.ket);
        }
      });
    });

    // Hapus Data
    $("#tblHistori").on('click', '.hapus-data', function(){
      var id = $(this).data('id');
      $('#idHapus').val(id);
      $('#mdlKonfirm').modal('show');
      $('#titleKonfirm').text('INGIN MENGHAPUS TRASAKSI?');
      $('#btnKonfirm').html('<button type="button" class="btn btn-danger" id="btnKonfirmHapus">Iya</button>');
    });
    $('#mdlKonfirm').on('click','#btnKonfirmHapus',function(){
      var id = $('#idHapus').val();
      $.ajax({
        url: "<?= site_url('transaksi/proses_tagihan/hapus') ?>",
        type: "post",
        data: {id},
        dataType: "json",
        success: function(d){
          if (d.sukses == true) {
            alertSukses("Berhasil Hapus Data");
            reloadTable('#tblHistori');
            $('#mdlKonfirm').modal('hide');
          } else {
            alertError("Gagal Hapus Data, Terdapat Angsuran Sudah Diproses");
            $('#mdlKonfirm').modal('hide');
          }
        },
        error: function(){
          alertError("Gagal Hapus Data");
          $('#mdlKonfirm').modal('hide');
        }
      });
    });

    // Proses Data
    $('#btnProses').click(function(){
      $('#mdlKonfirm').modal('show');
      $('#titleKonfirm').text('INGIN PROSES DATA?');
      $('#btnKonfirm').html('<button type="button" class="btn btn-primary" id="btnKonfirmProses">Iya</button>');
    });
    $('#mdlKonfirm').on('click','#btnKonfirmProses',function(){
      loadingBtnOn('#btnKonfirmProses');
      $('.kurir-list').removeClass('is-invalid');

      if ($('.kurir-list option[value=""]:selected').length > 0) {
        $('.kurir-list').each(function(){
          if ($(this).val() == "") {
            var id = $(this).data('id');
            $('#kurirList'+id).addClass('is-invalid');
          }
        });
        alertError("Ada Kurir Konsumen Belum Dipilih");
        $('#mdlKonfirm').modal('hide');
        // loadingBtnOff('#btnKonfirmProses');
      } else {
        $.ajax({
          url: "<?= site_url('transaksi/proses_tagihan/simpan_data') ?>",
          type: "post",
          data: $('#formData').serialize(),
          success: function(){
            reloadTable('#tblHistori');
            // loadingBtnOff('#btnKonfirmProses');
            alertSukses("Berhasil Proses Transaksi");
            $('#mdlKonfirm').modal('hide');
            if (proses == 'ubah') {
              updateList();
            } else {
              loadData();
            }
          }
        });
      }
    });

  });

  // Load Data
  function loadData()
  {
    $.ajax({
      url: "<?= site_url('transaksi/proses_tagihan/load_data') ?>",
      dataType: "json",
      beforeSend: function() {
        loadingElementOn('.content-wrapper');
      },
      success: function(d) {
        loadingElementOff('.content-wrapper');
        localStorage.removeItem("proses-tagihan");
        tampilList();
        if (d != null) {
          $('#id').val(d.id);
          $('.home-view').addClass('d-none');
          $('.transaksi-view').removeClass('d-none');
          $('.no-transaksi').text(d.nomor);
          $('#btnProses').text("Proses");
          $('.alert').addClass('d-none').html('');
          // $('#tglTransaksi').val(d.tgl != null ? tgl(d.tgl) : 'setDate',new Date());
        } else {
          $('#id').val("");
          $('.transaksi-view').addClass('d-none');
          $('.home-view').removeClass('d-none');
          $('.no-transaksi').text("-");
        }
      }
    });
  }

  // Buat Transaksi
  function buatTransaksi()
  {
    $.ajax({
      url: "<?= site_url('transaksi/proses_tagihan/buat_transaksi') ?>",
      beforeSend: function() {
        loadingBtnOn('#btnBuat');
      },
      success: function() {
        setTimeout(function() {
          loadingBtnOff('#btnBuat');
        }, 1000);
        loadData();
      }
    });
  }

  // Batal Transaksi
  function batalTransaksi()
  {
    $.ajax({
      url: "<?= site_url('transaksi/proses_tagihan/batal_transaksi') ?>",
      success: function() {
        loadData();
      }
    });
  }

  // Update List
  function updateList()
  {
    var id = $('#id').val();
    var data = JSON.parse(localStorage.getItem('proses-tagihan'));
    $.ajax({
      url: "<?= site_url('transaksi/proses_tagihan/update_list') ?>",
      type: "post",
      data: {id, data},
      success: function(){
        loadData();
      }
    });
  }

  // Load Data Konsumen
  function loadKonsumen()
  {
    $('#tblKonsumen').loadTable({
      url: "<?= site_url('konsumen/load_data') ?>",
      dataFilter: "#formFilterKosumen",
      pageLength: 25,
      order: [[8, 'desc']],
      columns: [
        {data: 'nama', className: 'text-truncate-dt'},
        {data: 'kode'},
        {data: 'no_hp'},
        {data: 'no_pesanan'},
        {data: 'alamat', className: 'none'},
        {data: 'ctt', className: 'none', render: function(data) {
          return data != null ? data : "-";
        }},
        {data: 'detail_angsuran', className: 'none', render: function(data) {
          return data != null ? data : "-";
        }},
        {data: "id", className: 'all', orderable: false, searchable: false, render: function(data, type, row) {
          return `<div class="text-center">
          <button type="button" class="btn btn-rounded btn-primary btn-sm pilih-konsumen" id="pilihKonsumen${data}" data-id="${data}">
          <i class="fas fa-check"></i> Pilih
          </button>
          </div>`;
        }},
        {data: 'dibuat', visible: false},
      ]
    });
  }

  // Load Data Histori
  function loadHistori()
  {
    $('#tblHistori').loadTable({
      url: "<?= site_url('transaksi/proses_tagihan/load_histori') ?>",
      dataFilter: "#formFilterHistori",
      pageLength: 25,
      order: [[4, 'desc']],
      columns: [
        {data: 'nomor', className: 'text-truncate-dt'},
        {data: 'tgl', render: function(data) {
          return tglIndo(data);
        }},
        {data: 'ket', className: 'text-truncate-dt', render: function(data) {
          return data != null ? data : "-";
        }},
        {data: "id", className: 'all', orderable: false, searchable: false, render: function(data, type, row) {
          return `<div class="text-center">
          <button type="button" class="btn btn-rounded btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
          <i class="fas fa-cog"></i>
          </button>
          <div class="dropdown-menu">
          <a class="dropdown-item detail-data" href="javascript:void(0)" data-id="${data}" data-nomor="${row.nomor}">
          <i class="bx bx-search"></i> Detail</a>
          <a class="dropdown-item ubah-data" href="javascript:void(0)" data-id="${data}" id="ubahData${data}">
          <i class="bx bx-edit"></i> Ubah</a>
          <a class="dropdown-item hapus-data" href="javascript:void(0)" data-id="${data}">
          <i class="bx bx-trash"></i> Hapus</a>
          </div>
          </div>`;
        }},
        {data: 'dibuat', visible: false},
      ]
    });
  }

  // Tampil List Tagihan
  function tampilList()
  {
    var key = $('#listFilter').val();
    $.ajax({
      url: "<?= site_url('transaksi/proses_tagihan/tampil_list') ?>",
      type: "get",
      async: false,
      data: {key},
      dataType: "json",
      success: function(d){
        var list = '';
        var i;
        var j;

        var kurir = '<option selected value="">Pilih Kurir</option>';
        if (d.list.length != 0) {
          if (d.list.length > 5) {
            $('#bodyListTagihan').css('height', '300px');
          } else {
            $('#bodyListTagihan').css('height', 'auto');
          }

          for (j = 0; j < d.kurir.length; j++){
            kurir += `<option value="${d.kurir[j].id_user}">${d.kurir[j].nama_user}</option>`
          }

          for (i = 0; i < d.list.length; i++) {
            list += `<tr>
            <td><a data-id="${d.list[i].id}" href="javascript:void(0)" class="hapus-list" title="Hapus List"><i class="bx bx-x-circle bx-sm"></i></a></td>
            <td>${d.list[i].kode_konsumen}</td>
            <td>${d.list[i].nama_konsumen}</td>
            <td><input value="${d.list[i].angsuran}" data-id="${d.list[i].id}" data-ubah="angsuran" type="number" class="form-control form-control-sm ubah-list" placeholder="Angsuran" style="width: 120px" readonly></td>
            <td><input value="${d.list[i].nominal}" data-id="${d.list[i].id}" data-ubah="nominal" type="text" class="form-control form-control-sm number ubah-list" placeholder="Nominal" style="width: 120px"></td>
            <td><input value="${d.list[i].ket == null ? "" : d.list[i].ket}" data-ubah="ket" data-id="${d.list[i].id}" type="text" class="form-control form-control-sm ubah-list" placeholder="Keterangan" style="width: 200px"></td>
            <td>${d.list[i].sales}</td>
            <td>${d.list[i].db}</td>
            <td>
            <select class="form-control form-control-sm ubah-list select kurir-list" id="kurirList${d.list[i].id}" data-id="${d.list[i].id}" data-ubah="kurir" style="width: 150px">
            `+ kurir +`
            </select>
            </td>
            </tr>`;
          }
          $('#tampilList').html(list);
          $('#btnProses').prop('disabled', false);
        } else {
          list = `<tr>
          <td colspan="9" class="text-center">Tidak ada data</td>
          </tr>`;
          $('#btnProses').prop('disabled', true);
          $('#tampilList').html(list);
        }

        for (i = 0; i < d.list.length; i++) {
          if (d.list[i].id_kurir != null) {
            $('#kurirList'+d.list[i].id).val(d.list[i].id_kurir).trigger('change.select2');
          } else {
            $('#kurirList'+d.list[i].id).val("").trigger('change.select2');
          }
        }

        loadNumber();
        $('.select').select2();
        $('#totalList').text(`${d.list.length} Konsumen`);
      }
    });
  }

  // Tampil List Ubah Tagihan
  function tampilListUbah()
  {
    var key = $('#listFilter').val();
    $.ajax({
      url: "<?= site_url('transaksi/proses_tagihan/tampil_list') ?>",
      type: "get",
      async: false,
      data: {key},
      dataType: "json",
      success: function(d) {
        var data = JSON.parse(localStorage.getItem("proses-tagihan"));
        if (key != "") {
          data = data.filter(obj => obj.nama_konsumen.toLowerCase() === key.toLowerCase());
        } else {
          data = JSON.parse(localStorage.getItem("proses-tagihan"));
        }
        var list = '';
        var i;
        var j;

        var kurir = '<option selected value="">Pilih Kurir</option>';
        if (data.length != 0) {
          if (data.length > 5) {
            $('#bodyListTagihan').css('height', '300px');
          } else {
            $('#bodyListTagihan').css('height', 'auto');
          }

          for (j = 0; j < d.kurir.length; j++){
            kurir += `<option value="${d.kurir[j].id_user}">${d.kurir[j].nama_user}</option>`
          }

          for (i = 0; i < data.length; i++) {
            list += `<tr>`
            + (data[i].status == 0 ? `<td><a data-id="${data[i].id}" href="javascript:void(0)" class="hapus-list" title="Hapus List"><i class="bx bx-x-circle bx-sm"></i></a></td>` : `<td>-</td>`) +
            `<td>${data[i].kode_konsumen}</td>
            <td>${data[i].nama_konsumen}</td>
            <td><input value="${data[i].angsuran}" data-id="${data[i].id}" data-ubah="angsuran" type="number" class="form-control form-control-sm ubah-list" placeholder="Angsuran" style="width: 120px" ` + (data[i].status == 1 ? 'disabled' : 'readonly') + `></td>
            <td><input value="${data[i].nominal}" data-id="${data[i].id}" data-ubah="nominal" type="text" class="form-control form-control-sm number ubah-list" placeholder="Nominal" style="width: 120px" ` + (data[i].status == 1 && 'disabled') + `></td>
            <td><input value="${data[i].ket == null ? "" : data[i].ket}" data-ubah="ket" data-id="${data[i].id}" type="text" class="form-control form-control-sm ubah-list" placeholder="Keterangan" style="width: 200px" ` + (data[i].status == 1 && 'disabled') + `></td>
            <td>${data[i].sales}</td>
            <td>${data[i].db}</td>
            <td>
            <select class="form-control form-control-sm ubah-list select kurir-list" id="kurirList${data[i].id}" data-id="${data[i].id}" data-ubah="kurir" style="width: 150px" ` + (data[i].status == 1 && 'disabled') + `>
            `+ kurir +`
            </select>
            </td>
            </tr>`;
          }
          $('#tampilList').html(list);
          $('#btnProses').prop('disabled', false);
        } else {
          list = `<tr>
          <td colspan="9" class="text-center">Tidak ada data</td>
          </tr>`;
          $('#btnProses').prop('disabled', true);
          $('#tampilList').html(list);
        }

        for (i = 0; i < data.length; i++) {
          if (data[i].id_kurir != null) {
            $('#kurirList'+data[i].id).val(data[i].id_kurir).trigger('change.select2');
          } else {
            $('#kurirList'+data[i].id).val("").trigger('change.select2');
          }
        }

        loadNumber();
        $('.select').select2();
        $('#totalList').text(`${data.length} Konsumen`);
      }
    });
  }

  // Tampil Detail
  function tampilDetail(id)
  {
    $.ajax({
      url: "<?= site_url('transaksi/proses_tagihan/tampil_detail') ?>",
      type: "get",
      async: false,
      data: {id},
      dataType: "json",
      success: function(d){
        var html = "";
        var i;

        if (d.length != 0) {
          for (var i = 0; i < d.length; i++) {
            html += `<tr>
            <td>${d[i].nama_konsumen}</td>
            <td>${d[i].kode_konsumen}</td>
            <td>${d[i].angsuran}</td>
            <td>${$.number(d[i].nominal, 2, ',', '.')}</td>
            <td>${d[i].ket == null ? "-" : d[i].ket}</td>
            <td>${d[i].sales}</td>
            <td>${d[i].db}</td>
            <td>${d[i].kurir}</td>
            </tr>`;
          }
          $('#tampilDetail').html(html);
        } else {
          html = `<tr>
          <td colspan="8" class="text-center">Tidak ada data</td>
          </tr>`;
          $('#tampilDetail').html(html);
        }
      }
    });
  }




</script>
</body>
</html>
