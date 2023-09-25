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
             <div class="row align-middle p-3">
                 <div class="col-sm-6">
                     <p class="m-0">Data berdasarkan <?= $date1 . ' hingga ' . $date2; ?></p>
                 </div>
                 <div class="col-sm-6">
                     <form action="<?= base_url('personalia/ijin'); ?>" method="post">
                         <div class="input-group mb-3 float-sm-right">
                             <input type="date" name="date1" class="form-control" aria-label="Tanggal awal" value="<?= $date1; ?>">
                             <span class="input-group-text">-</span>
                             <input type="date" name="date2" class="form-control" aria-label="Tanggal Akhir" value="<?= $date2; ?>">
                             <button type="submit" name="date2" class="btn btn-outline-warning" aria-label="Tanggal Akhir" value="<?= $date2; ?>">Proses</button>
                         </div>

                     </form>
                 </div>
             </div>
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
                         <table class="table table-bordered table-sm text-center" id="myTable">
                             <thead>
                                 <tr>
                                     <th>NO</th>
                                     <th>NAMA</th>
                                     <th>JABATAN</th>
                                     <th>ABSEN</th>
                                     <th>KET</th>
                                     <th>WAKTU MASUK</th>
                                     <th>WAKTU PULANG</th>
                                     <th>INFO</th>
                                     <th>DISETUJUI OLEH</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $n = 1; ?>
                                 <?php foreach ($absen as $a) : ?>
                                     <?php
                                        $this->db->where('nik', $a['NIP']);
                                        $personil = $this->db->get('jb_personil')->row_array();
                                        $this->db->where('nama', $personil['jabatan']);
                                        $jab = $this->db->get('m_jabatan')->row_array();
                                        $this->db->where('ID', $a['STAT_ABSEN']);
                                        $stat = $this->db->get('abs_stat_absen')->row_array();
                                        $this->db->where('ID', $a['STAT_KERJA']);
                                        $sk = $this->db->get('stat_kerja')->row_array();
                                        ?>
                                     <tr>
                                         <td><?= $n++; ?></td>
                                         <td>
                                             <a href="<?= base_url('personalia/detailAbsen') . '?id=' . $a['ID']; ?>">
                                                 <?= $personil['name']; ?>
                                             </a>
                                         </td>
                                         <!-- <td><?= $jab['nama']; ?></td> -->
                                         <td><?= $personil['jabatan']; ?></td>
                                         <td><?= $stat['STATUS']; ?></td>
                                         <td><?= $sk['KET']; ?></td>
                                         <td><?= substr($ab['TIME_IN'], 10, 9); ?></td>
                                         <td><?= substr($ab['TIME_OUT'], 10, 9); ?></td>
                                         <td><?= $a['INFO']; ?></td>
                                         <td><?= $a['DISETUJUI_OLEH']; ?></td>
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
                     </ol>
                 </div>
                 <!-- /.card-footer-->
             </div>
             <!-- /.card -->

         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->