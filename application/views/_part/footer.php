<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Footer -->
  <footer class="main-footer">
    <strong>
      Copyright &copy;
      <script>document.write(new Date().getFullYear())</script>
      <a href="https://siskasoftware.com">ASA</a>.
    </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1
    </div>
  </footer>
</div>
<!-- /Wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Sidebar -->
<script src="<?= base_url() ?>assets/dist/js/sidebar.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Bootstrap Datepicker -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Loading Overlay -->
<script src="<?=base_url()?>assets/plugins/loadingOverlay/dist/loadingoverlay.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- Croppie -->
<script src="<?= base_url() ?>assets/plugins/croppie/croppie.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- JS Cookie -->
<script src="<?= base_url() ?>assets/plugins/js-cookie/js.cookie.min.js"></script>

<!-- DataTables & Plugins -->
<?php if ($this->uri->segment('1') != "dashboard") { ?>
  <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js"></script>
<?php } ?>

<!-- Number -->
<script src="<?= base_url() ?>assets/plugins/jquery-number-master/jquery.number.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-number-master/number.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>

<!-- Custom js -->
<!-- App -->
<script src="<?= base_url() ?>assets/dist/js/app.js"></script>
<!-- Croppie -->
<script src="<?= base_url() ?>assets/dist/js/croppie.js"></script>
<!-- Suitchi -->
<script src="<?= base_url() ?>assets/dist/js/suitchi.js"></script>
<!-- Load Table Custom -->
<script src="<?= base_url() ?>assets/dist/js/table.js"></script>
</body>

</html>
