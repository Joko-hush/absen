     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1><?= $judul; ?></h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('personalia'); ?>">Home</a></li>
                             <li class="breadcrumb-item active"><?= $judul; ?></li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">

             <!-- Default box -->
             <div class="card">
                 <div class="card-header">
                     <h3 class="card-title">
                         <nav class="nav navbar-expand">
                             <a class="nav-link" type="button" id="tombol_gol">Golongan</a>
                             <a class="nav-link" type="button" id="tombol_pkt">Pangkat</a>
                         </nav>
                     </h3>


                     <div class="card-tools">
                         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                             <i class="fas fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                             <i class="fas fa-times"></i>
                         </button>
                     </div>
                 </div>
                 <div class="card-body">
                     <div id="gol">
                         <table class="table table-sm table-bordered text-center">
                             <tr>
                                 <th colspan="3">
                                     <h3>Jumlah Anggota Berdasarkan Kategori Golongan</h3>
                                 </th>
                             </tr>
                             <tr>
                                 <th>TNI</th>
                                 <th>PNS</th>
                                 <th>KHL</th>
                             </tr>
                             <tr>
                                 <td><?= $gol['tni']; ?></td>
                                 <td><?= $gol['pns']; ?></td>
                                 <td><?= $gol['khl']; ?></td>
                             </tr>
                         </table>
                     </div>
                     <hr>
                     <div id="pangkat">
                         <h3>Jumlah Personil Berdasarkan Pangkat</h3>
                         <table class="table table-sm table-bordered" id="myTable">
                             <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Pangkat</th>
                                     <th>Jumlah</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $n = 1;
                                    foreach ($jmlPangkat as $j) : ?>
                                     <tr>
                                         <td><?= $n++; ?></td>
                                         <td><?= $j['pangkat']; ?></td>
                                         <td><?= $j['jumlah']; ?></td>
                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
                     </div>

                 </div>
                 <!-- /.card-body -->
                 <div class="card-footer">
                     Footer
                 </div>
                 <!-- /.card-footer-->
             </div>
             <!-- /.card -->

         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->

     <!-- Button trigger modal -->
     <script>
         let gol = document.getElementById('gol');
         let pangkat = document.getElementById('pangkat');
         let tp = document.getElementById('tombol_pkt');
         let tg = document.getElementById('tombol_gol');
         window.addEventListener("load", () => {
             pangkat.style.display = "none";
         });
         tp.addEventListener('click', () => {
             pangkat.style.display = "block";
             gol.style.display = "none";
         })
         tg.addEventListener('click', () => {
             pangkat.style.display = "none";
             gol.style.display = "block";
         })
     </script>