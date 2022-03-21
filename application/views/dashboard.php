<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_part/header');
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0"><?= $judul ?></h1> -->
        </div>
        <div class="col-sm-6">

        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- JUMLAH DATA -->
      <div class="row">
        <div class="col-xl-3 col-md-6 col-sm-12">
          <div class="info-box mb-3 bg-white shadow text-primary">
            <span class="info-box-icon"><i class="bx bx-package"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Produk Aktif</span>
              <h5><span class="info-box-number"><?= angka($jumlah_produk) ?></span></h5>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12">
          <div class="info-box mb-3 bg-primary">
            <span class="info-box-icon"><i class="bx bx-user-circle"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Konsumen Aktif</span>
              <h5><span class="info-box-number"><?= angka($jumlah_konsumen) ?></span></h5>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12">
          <div class="info-box mb-3 bg-primary">
            <span class="info-box-icon"><i class="bx bx-receipt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Angsuran Hari Ini</span>
              <h5><span class="info-box-number"><?= angka($jumlah_angsuran) ?></span></h5>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12">
          <div class="info-box mb-3 bg-primary">
            <span class="info-box-icon"><i class="bx bx-dollar-circle"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Penjualan <?= bln_indo(date('m')) ?></span>
              <h5><span class="info-box-number"><?= rupiah($total_penjualan->nominal) ?></span></h5>
            </div>
          </div>
        </div>

      </div>
      <!-- /JUMLAH DATA -->

      <!-- GRAFIK PRODUK LAKU -->
      <div class="row">
        <div class="col-md-4">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="card-title">Produk Terlaku</h3>
            </div>
            <div class="card-body">
              <div class="text-center" id="chartProdukKosong"></div>
              <canvas id="chartProduk" style="min-height: 281px; height: 281px; max-height: 281px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="card-title">Transaksi Per Tahun</h3>
            </div>
            <div class="card-body" id="chartTransaksiContainer">
              <div class="float-right">
                <select class="form-control form-control-sm" id="tahunTransaksi" style="width: 80px;">
                  <?php foreach ($tahun_transaksi as $key => $data) { ?>
                    <option value="<?= $data->tahun ?>"><?= $data->tahun ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="text-center" id="chartTransaksiKosong"></div>
              <canvas id="chartTransaksi" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- /GRAFIK PRODUK LAKU -->

    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('_part/footer'); ?>
<script type="text/javascript">
  $(document).ready(function(){

    chartProdukLaku();
    chartTransaksi();

  });

  // LOAD CHART PRODUK LAKU
  function chartProdukLaku()
  {
    $.ajax({
      url: "<?= site_url('dashboard/produk_laku') ?>",
      type: "get",
      dataType: "json",
      success: function(data){
        if (data != false) {
          var label = [];
          var jumlah = [];
          for (var i in data) {
            label.push(data[i].nama+'-'+data[i].kode);
            jumlah.push(data[i].produk);
          }
          // CHART
          var donutChartCanvas = $('#chartProduk').get(0).getContext('2d');
          var donutData = {
            labels: label,
            datasets: [
              {
                data: jumlah,
                backgroundColor : ['#f1b44c', '#227C7A', '#67A5A4', '#ABCECD', '#F0F7F7', '#F0F7F7'],
              }
            ]
          }
          var donutOptions = {
            maintainAspectRatio : false,
            responsive : true,
          }
          var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
          });
          // /CHART
          $('#chartProdukKosong').html('');
          $('#chartProduk').prop('hidden', false);
        } else {
          $('#chartProdukKosong').html('<p>Belum ada transaksi</p>');
          $('#chartProduk').prop('hidden', true);
          // return false;
        }
      }
    });
  }

  // LOAD CHART TRANSAKSI
  function chartTransaksi()
  {
    var tahun = $('#tahunTransaksi').val();
    $.ajax({
      url: "<?= site_url('dashboard/chart_transaksi') ?>",
      type: "get",
      data: {tahun:tahun},
      dataType: "json",
      success: function(data){
        if (data.sukses == true) {
          var label = [];
          var total = [];
          for (var i in data.list) {
            label.push(blnIndo(data.list[i].bulan));
            total.push(data.list[i].total);
          }
          // CHART
          var areaChartData = {
            labels  : label,
            datasets: [
              {
                label               : 'Total Transaksi Tahun '+tahun,
                backgroundColor     : 'rgba(34, 124, 122, 0.5)',
                borderColor         : 'rgba(34, 124, 122, 1)',
                borderWidth         : 1,
                data                : total
              },
            ]
          }

          var barChartCanvas = $('#chartTransaksi').get(0).getContext('2d');
          var barChartData = jQuery.extend(true, {}, areaChartData);

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  var value = data.datasets[0].data[tooltipItem.index];
                  if(parseInt(value) >= 1000){
                    return 'Rp '+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  } else {
                    return 'Rp '+value;
                  }
                }
              }
            },
            scales: {
              yAxes : [{
                ticks : {
                  beginAtZero: true,
                  userCallback: function (value, index, values) {
                    value = value.toString();
                    value = value.split(/(?=(?:...)*$)/);
                    value = value.join(',');
                    return 'Rp '+value;
                  }
                }
              }]
            }
          }

          var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
          // /CHART
          $('#chartTransaksiKosong').html('');
          $('#tahunTransaksi').prop('hidden', false);
          $('#chartTransaksi').prop('hidden', false);
        } else {
          $('#chartTransaksiKosong').html('<p>Belum ada transaksi</p>');
          $('#tahunTransaksi').prop('hidden', true);
          $('#chartTransaksi').prop('hidden', true);
        }
      }
    });
  }

</script>
</body>
</html>
