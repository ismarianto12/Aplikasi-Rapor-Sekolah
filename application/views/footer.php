 </div>
 </div>
 </section>
 </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
 
    </div><p class="footer">Page rendered in <strong>{elapsed_time} </strong> seconds .
    Total Memori Terpakai {memory_usage}</p>
    <strong>Copyright &copy; <?= date("Y") ?> <a href=""><?= strip_tags(cari('nama_sekolah')) ?></a>.</strong> All rights
    reserved.
  </footer>
    <script src="<?= base_url('assets/home/') ?>/sweetalert.js"></script> 
  <script src="<?= base_url('assets/home/dist/') ?>/js/Lobibox.js"></script>
 
<script src="<?= base_url('assets/home') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?= base_url('assets/home') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/home') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url('assets/home') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/home') ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/home') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/home') ?>/dist/js/demo.js"></script>
<!-- page script -->
 
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
