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
                     <p class="m-0">Data berdasarkan <?= $month; ?></p>
                 </div>
                 <div class="col-sm-6">
                     <form action="<?= base_url('personalia/rincianAbsen'); ?>" method="post">
                         <input type="hidden" name="id" value="<?= $id; ?>">
                         <div class="input-group mb-3 float-sm-right">
                             <input type="month" name="month" class="form-control" aria-label="Tanggal awal" value="<?= $month; ?>">
                             <button type="submit" class="btn btn-outline-warning">Proses</button>
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
                         <table class="table table-bordered table-sm text-center table-hover" id="absenTable">
                             <thead>
                                 <tr>
                                     <th>TANGGAL</th>
                                     <th>ABSEN</th>
                                     <th>KET</th>
                                     <th>JAM MASUK</th>
                                     <th>JAM PULANG</th>
                                     <th>INFO</th>
                                     <th>DISETUJUI OLEH</th>
                                     <th class="lihat">Lihat</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($tgl as $t) : ?>
                                     <?php
                                        list($y, $b, $d) = explode('-', $t);
                                        $this->db->where('TGL_MASUK', $t);
                                        $this->db->where('NIP', $id);
                                        $ab = $this->db->get('abs_kehadiran')->row_array();
                                        // var_dump($ab);
                                        if (!$ab) {
                                            $ket = '-';
                                            $absen = 'Tidak hadir';
                                            $ab['TIME_IN'] = '-';
                                            $ab['TIME_OUT'] = '-';
                                            $ab['INFO'] = '-';
                                            $ab['DISETUJUI_OLEH'] = '-';
                                            $ab['ID'] = '#';
                                        } else {
                                            $this->db->where('id', $ab['STAT_ABSEN']);
                                            $sa = $this->db->get('abs_stat_absen')->row_array();
                                            $absen = $sa['STATUS'];
                                            $this->db->where('id', $ab['STAT_KERJA']);
                                            $sk = $this->db->get('stat_kerja')->row_array();
                                            $ket = $sk['KET'];
                                        }
                                        ?>
                                     <?php if (date("l", mktime(0, 0, 0, $b, $d, $y)) == "Sunday") : ?>
                                         <tr class="bg-danger">
                                             <td><?= $t; ?></td>
                                             <td><?= $absen; ?></td>
                                             <td><?= $ket; ?></td>
                                             <td><?= substr($ab['TIME_IN'], 10, 9); ?></td>
                                             <td><?= substr($ab['TIME_OUT'], 10, 9); ?></td>
                                             <?php if ($ab['INFO'] == '-') : ?>
                                                 <td>Libur</td>
                                             <?php else : ?>
                                                 <td><?= $ab['INFO']; ?></td>
                                             <?php endif; ?>
                                             <td><?= $ab['DISETUJUI_OLEH']; ?></td>
                                             <td> <a class="btn btn-outline-warning" href="<?= base_url('personalia/detailAbsen') . '?id=' . $ab['ID']; ?>">
                                                     Lihat
                                                 </a></td>

                                         </tr>
                                     <?php elseif (date("l", mktime(0, 0, 0, $b, $d, $y)) == "Saturday") : ?>
                                         <tr class="bg-danger">
                                             <td><?= $t; ?></td>
                                             <td><?= $absen; ?></td>
                                             <td><?= $ket; ?></td>
                                             <td><?= substr($ab['TIME_IN'], 10, 9); ?></td>
                                             <td><?= substr($ab['TIME_OUT'], 10, 9); ?></td>
                                             <?php if ($ab['INFO'] == '-') : ?>
                                                 <td>Libur</td>
                                             <?php else : ?>
                                                 <td><?= $ab['INFO']; ?></td>
                                             <?php endif; ?>
                                             <td><?= $ab['DISETUJUI_OLEH']; ?></td>
                                             <td> <a class="btn btn-outline-warning" href="<?= base_url('personalia/detailAbsen') . '?id=' . $ab['ID']; ?>">
                                                     Lihat
                                                 </a></td>
                                         </tr>
                                     <?php else : ?>
                                         <tr>
                                             <td><?= $t; ?></td>
                                             <td><?= $absen; ?></td>
                                             <td><?= $ket; ?></td>
                                             <td><?= substr($ab['TIME_IN'], 10, 9); ?></td>
                                             <td><?= substr($ab['TIME_OUT'], 10, 9); ?></td>
                                             <td><?= $ab['INFO']; ?></td>
                                             <td><?= $ab['DISETUJUI_OLEH']; ?></td>
                                             <td class="lihat">
                                                 <a class="btn btn-outline-warning" href="<?= base_url('personalia/detailAbsen') . '?id=' . $ab['ID']; ?>">
                                                     Lihat
                                                 </a>
                                             </td>
                                         </tr>
                                     <?php endif; ?>
                                 <?php endforeach; ?>
                             </tbody>

                         </table>
                     </div>
                 </div>
                 <!-- /.card-body -->
                 <div class="card-footer">
                     Catatan :
                     <ol>
                         <li>Untuk melihat detail absen klik pada tanggal.</li>
                     </ol>
                 </div>
                 <!-- /.card-footer-->
             </div>
             <!-- /.card -->

         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->