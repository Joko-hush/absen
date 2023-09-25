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
                             <li class="breadcrumb-item active"><?= $judul; ?></li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">
             <div class="container-fluid">
                 <div class="row gx-2">
                     <a class="col-sm-4" style="text-decoration: none;" href="<?= base_url('personalia/user'); ?>">
                         <div>
                             <div class="info-box shadow">
                                 <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                                 <div class="info-box-content">
                                     <span class="info-box-text">Pengguna</span>
                                     <span class="info-box-number">
                                         <?= $pengguna; ?>
                                         <small>Orang</small>
                                     </span>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                     </a>
                     <!-- /.col -->
                     <a class="col-sm-4" style="text-decoration: none;" href="<?= base_url('personalia/masterStaff'); ?>">
                         <div>
                             <div class="info-box shadow mb-3">
                                 <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>

                                 <div class="info-box-content">
                                     <span class="info-box-text">Anggota</span>
                                     <span class="info-box-number"><?= $anggota; ?></span>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                     </a>
                     <!-- /.col -->

                     <!-- fix for small devices only -->
                     <!-- <div class="clearfix hidden-md-up"></div> -->
                     <a class="col-sm-4" style="text-decoration: none;" href="#">
                         <div>
                             <div class="info-box shadow mb-3">
                                 <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>

                                 <div class="info-box-content">
                                     <span class="info-box-text">Persentase</span>
                                     <span class="info-box-number">
                                         <?= $persentase; ?>
                                         <small>%</small>
                                     </span>
                                 </div>
                                 <!-- /.info-box-content -->
                             </div>
                             <!-- /.info-box -->
                         </div>
                         <!-- /.col -->
                     </a>
                 </div>



                 <!-- Default box -->
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title">Absensi</h3>

                         <div class="card-tools">
                             <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                             <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div>
                     </div>
                     <div class="card-body bg-secondary">
                         <div class="row">
                             <a class="col-md-3" href="<?= base_url('personalia/masuk'); ?>" style="text-decoration: none;">
                                 <div class="info-box shadow">
                                     <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Masuk</span>
                                         <span class="info-box-number">
                                             <?= $masuk; ?>
                                             <small>Orang</small>
                                         </span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </a>
                             <!-- /.col -->
                             <a class="col-md-3" href="<?= base_url('personalia/ijin'); ?>" style="text-decoration: none;">
                                 <div class="info-box mb-3 shadow">
                                     <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Ijin</span>
                                         <span class="info-box-number">
                                             <?= $ijin; ?>
                                             <small>Orang</small>
                                         </span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </a>
                             <!-- /.col -->

                             <!-- fix for small devices only -->
                             <!-- <div class="clearfix hidden-md-up"></div> -->

                             <a class="col-md-3" href="<?= base_url('personalia/sakit'); ?>" style="text-decoration: none;">
                                 <div class="info-box mb-3 shadow">
                                     <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bed"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Sakit</span>
                                         <span class="info-box-number">
                                             <?= $sakit; ?>
                                             <small>Orang</small>
                                         </span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </a>
                             <a class="col-md-3" href="<?= base_url('personalia/unknown'); ?>" style="text-decoration: none;">
                                 <div class="info-box mb-3 shadow">
                                     <span class="info-box-icon bg-success elevation-1"><i class="fas fa-eye-slash"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Tanpa Keterangan</span>
                                         <span class="info-box-number">
                                             <?= $unknown; ?>
                                             <small>Orang</small>
                                         </span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </a>
                             <!-- /.col -->
                         </div>
                     </div>
                     <!-- /.card-body -->
                     <!-- <div class="card-footer">
                         Footer
                     </div> -->
                     <!-- /.card-footer-->
                 </div>
                 <!-- /.card -->
             </div>
         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->