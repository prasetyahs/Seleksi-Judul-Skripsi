<footer class="main-footer">
    <strong>Copyright &copy; 2021-2022 <a href="http://unsada.ac.id">Universitas Darma Persada</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.3
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= $BASE_URL?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?= $BASE_URL ?>assets/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="<?= $BASE_URL ?>assets/js/tables/jquery-datatable.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= $BASE_URL?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= $BASE_URL?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= $BASE_URL?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="<?= $BASE_URL?>assets/plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
  <!-- <script src="<?= $BASE_URL?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= $BASE_URL?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="<?= $BASE_URL?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= $BASE_URL?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= $BASE_URL?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= $BASE_URL?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= $BASE_URL?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $BASE_URL?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $BASE_URL?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $BASE_URL?>assets/dist/js/demo.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= $BASE_URL?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= $BASE_URL?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= $BASE_URL; ?>assets/bs-custom-file-input/bs-custom-file-input.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    bsCustomFileInput.init();
  });
</script>

<!-- Page specific script -->
<script>
 
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    let message = document.getElementById('message');
    if (message != null) {
      let title = document.getElementById('title').innerHTML;
      let type = document.getElementById('type').innerHTML;
      swal({
        title: title,
        text: message.innerHTML,
        icon: type,
      });
    }
 </script>
 <script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
</body>
</html>
