  <!-- Main Footer -->
  <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
          <b>Version</b> 0.3
      </div>
      <strong>Copyright &copy; 2021-
          <?= date('Y'); ?> <a href="https://rsdustira.com">RS. DUSTIRA</a>.
      </strong> All rights reserved.
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>dist/js/adminlte.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>plugins/raphael/raphael.min.js"></script>
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('vendor/AdminLTE-3.1.0/'); ?>plugins/chart.js/Chart.min.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('assets/js/script.js'); ?>"></script>

  <script>
      $(document).ready(function() {
          $('#myTable').DataTable({
              iDisplayLength: 31,
              aLengthMenu: [
                  [31, 50, 100, -1],
                  [31, 50, 100, "All"]
              ],
              dom: 'Bfrtip',
              buttons: [{
                      extend: 'excel',
                      text: 'Save to Excel',
                      className: 'btn-success'
                  },
                  {
                      extend: 'print',
                      text: 'Print',
                      className: 'btn-warning'
                  }
              ],
              stateSave: true
          });
      });
  </script>
  <script>
      $(document).ready(function() {
          $('#absenTable').DataTable({

              paging: false,
              dom: 'Bfrtip',
              buttons: [{
                      extend: 'excel',
                      text: 'Save to Excel',
                      className: 'btn-success'
                  },
                  {
                      extend: 'print',
                      text: 'Print',
                      className: 'btn-warning'
                  }
              ],
              stateSave: true
          });
      });
  </script>
  <script>
      if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
      }
  </script>
  <script>
      if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
      }

      function showdapok() {
          let x = document.getElementById("dapok");
          let y = document.getElementById("dakel");
          let z = document.getElementById("showCetak");
          if (x.style.display === "none") {
              x.style.display = "block";
              y.style.display = "none";
              Z.style.display = "none";
          } else {
              x.style.display = "none";
          }
      }

      function showdakel() {
          let x = document.getElementById("dapok");
          let y = document.getElementById("dakel");
          let z = document.getElementById("showCetak");
          if (y.style.display === "none") {
              y.style.display = "block";
              x.style.display = "none";
              z.style.display = "none";
          } else {
              y.style.display = "none";
          }
      }

      function showCetak() {
          let x = document.getElementById("dapok");
          let y = document.getElementById("dakel");
          let z = document.getElementById("showCetak");
          if (z.style.display === "none") {
              z.style.display = "block";
              x.style.display = "none";
              y.style.display = "none";
          } else {
              z.style.display = "none";
          }
      }
  </script>


  </body>

  </html>