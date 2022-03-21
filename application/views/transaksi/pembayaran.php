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
        <div class="col-6 text-right">
          <!-- Tombol -->

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

        <div class="col-12">
          <div class="card shadow">
            <!-- Filter -->
            <form id="formFilter">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text" class="form-control" name="nomor_filter" placeholder="Nomor transaksi">
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
                    <button type="button" class="btn btn-rounded btn-primary filter-data" data-filter-table="#tblData"><i class="bx bx-filter-alt"></i> Filter</button>
                    <a href="javascript:void(0)" class="ml-2 reset-filter-data" data-filter-table="#tblData" data-filter-form="#formFilter" data-periode-form=".periode-filter"><strong>Reset</strong></a>
                  </div>
                </div>
              </div>
            </form>
            <!-- Table -->
            <div class="card-body p-0">
              <table id="tblData" class="table table-striped text-dark dt-responsive table-sm" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Angsuran</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Kolektor</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
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
    loadData();
    setPeriode('.periode-filter', false);

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
        url: "<?= site_url('transaksi/pembayaran/hapus') ?>",
        type: "post",
        data: {id},
        beforeSend: function(){
          loadingBtnOn('#btnKonfirmHapus');
        },
        success: function(){
          $('#mdlKonfirm').modal('hide');
          loadingBtnOff('#btnKonfirmHapus');
          alertSukses("Berhasil Hapus Data");
          reloadTable('#tblData');
        },
        error: function(){
          loadingBtnOff('#btnKonfirmHapus');
          alertSukses("Gagal Hapus Data");
          $('#mdlKonfirm').modal('hide');
        }
      });
    });

  });

  // Load Data
  function loadData()
  {
    $('#tblData').loadTable({
      url: "<?= site_url('transaksi/pembayaran/load_data') ?>",
      dataFilter: "#formFilter",
      pageLength: 25,
      order: [[9, 'desc']],
      columns: [
        {data: 'nomor', className: 'text-truncate-dt'},
        {data: 'tgl', render: function(data) {
          return tglIndo(data);
        }},
        {data: 'kode', className: 'text-truncate-dt'},
        {data: 'nama', className: 'text-truncate-dt'},
        {data: 'angsuran'},
        {data: 'nominal', render: function(data) {
          return 'Rp ' + $.number(data, 2, ',', '.');
        }},
        {data: 'ket', className: 'none', render: function(data) {
          return (data == null ? '-' : data);
        }},
        {data: 'kolektor'},
        {data: "id", className: 'all', orderable: false, searchable: false, render: function(data, type, row) {
          return `<div class="text-center">
                    <button type="button" class="btn btn-rounded btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item hapus-data" href="javascript:void(0)" data-id="`+data+`"><i class="bx bx-trash"></i> Hapus</a>
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
