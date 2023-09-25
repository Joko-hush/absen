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
                         <div class="mt-3">
                             <?= $this->session->flashdata('message'); ?>
                             <?php unset($_SESSION['message']); ?>
                         </div>
                         <table class="table table-bordered table-sm text-center" id="myTable">
                             <thead>
                                 <tr>
                                     <th>NO</th>
                                     <th>NIP</th>
                                     <th>NAMA</th>
                                     <th>DARI</th>
                                     <th>SAMPAI</th>
                                     <th>KATEGORI</th>
                                     <th>ALASAN</th>
                                     <th>DOK</th>
                                     <th>ACTION</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $n = 1; ?>
                                 <?php foreach ($absen as $a) : ?>
                                     <tr>
                                         <td><?= $n++; ?></td>
                                         <td><?= $a['nip']; ?></td>
                                         <?php
                                            $this->db->where('nik', $a['nip']);
                                            $p = $this->db->get('jb_personil')->row_array();
                                            if ($a['kategori'] = 3) {
                                                $kat = 'Ijin';
                                            } else {
                                                $kat = 'Sakit';
                                            }
                                            ?>
                                         <td><?= $p['name']; ?></td>
                                         <td><?= $a['tgl_masuk']; ?></td>
                                         <td><?= $a['tgl_masuk2']; ?></td>
                                         <td><?= $kat; ?></td>
                                         <td><?= $a['alasan']; ?></td>
                                         <td>
                                             <a href="<?= base_url('assets/img/absen/') . $a['doc']; ?>">
                                                 <?= $a['doc']; ?>
                                             </a>
                                         </td>
                                         <td>
                                             <a href="<?= base_url('approval/tolak') . '?id=' . $a['id']; ?>" class="btn btn-outline-warning btn-sm" onclick="return confirm('Apakah Anda yakin untuk menolak permohonan ini?')">
                                                 Tolak
                                             </a>
                                             |
                                             <a href="<?= base_url('approval/setuju') . '?id=' . $a['id']; ?>" class="btn btn-outline-success btn-sm" onclick="return confirm('Apakah Anda yakin untuk menyetujui permohonan ini?')">
                                                 Setujui
                                             </a>
                                         </td>

                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>

                         </table>
                     </div>
                 </div>
                 <!-- /.card-body -->
                 <div class="card-footer">
                     Catatan :
                     <ol>
                         <li>Untuk melihat detail absen klik pada nama.</li>
                         <li>Klik tombol excel untuk mencetak ke excel</li>
                         <li>Klik kolom dok untuk melihat dokumen yang dikirim.</li>
                     </ol>
                 </div>
                 <!-- /.card-footer-->
             </div>
             <!-- /.card -->

         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->