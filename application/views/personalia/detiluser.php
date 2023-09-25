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
                     <h3 class="card-title">Detail User</h3>


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
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="table-responsive">
                                     <h5>Input User</h5>
                                     <table class="table">
                                         <tr>
                                             <th>Nama</th>
                                             <td><?= $una['name']; ?></td>
                                         </tr>
                                         <tr>
                                             <th>Email</th>
                                             <td><?= $una['email']; ?></td>
                                         </tr>
                                     </table>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="table-responsive">
                                     <h5>Data Master Staff</h5>
                                     <table class="table">

                                         <tr>
                                             <th>Nama</th>
                                             <td><?= $banding['nama']; ?></td>
                                         </tr>
                                         <tr>
                                             <th>Jabatan</th>
                                             <td><?= $banding['pangkat']; ?></td>
                                         </tr>
                                         <tr>
                                             <th>Jabatan</th>
                                             <td><?= $banding['jabatan']; ?></td>
                                         </tr>

                                     </table>
                                 </div>

                             </div>
                             <div class="button">
                                 <div class="row text-center">
                                     <div class="col-sm-6">
                                         <a class="btn btn-outline-danger mx-auto" onclick="return confirm('Apakah Anda Yakin??')" href="<?= base_url('personalia/action1') . '?id=' . $una['id'] . '&stat=tolak'; ?>">Tolak</a>
                                     </div>
                                     <div class="col-sm-6">
                                         <a class="btn btn-outline-success mx-auto" onclick="return confirm('Apakah Anda Yakin??')" href="<?= base_url('personalia/action1') . '?id=' . $una['id'] . '&stat=setuju'; ?>">Setujui</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
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