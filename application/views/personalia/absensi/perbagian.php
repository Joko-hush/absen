     <section>
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
                                 <li class="breadcrumb-item"><a href="#">Home</a></li>
                                 <li class="breadcrumb-item active">Blank Page</li>
                             </ol>
                         </div>
                         <div class="mt-3">

                             <?= $this->session->flashdata('message'); ?>
                             <?php unset($_SESSION['message']); ?>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->

             </section>

             <!-- Main content -->
             <section class="content">

                 <!-- Default box -->
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title"><?= $judul; ?></h3>

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
                         <div class="table-responsive">
                             <table class="table table-sm table-bordered" id="myTable">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Unit</th>
                                         <th>JUMLAH ANGGOTA</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php $n = 1;
                                        foreach ($unit as $u) : ?>
                                         <tr>
                                             <td><?= $n++; ?></td>
                                             <td><?= $u['unit']; ?></td>
                                             <td><?= $u['jumlah']; ?></td>
                                         </tr>
                                     <?php endforeach; ?>
                                 </tbody>
                             </table>

                         </div>
                     </div>

                 </div>
                 <!-- /.card -->

             </section>
             <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->