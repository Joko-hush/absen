 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1><?= $judul; ?></h1>
                     <?= $this->session->flashdata('message'); ?>

                     <?php unset($_SESSION['message']); ?>

                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?= base_url('personalia'); ?>">Home</a></li>
                         <li class="breadcrumb-item"><a href="<?= base_url('setting'); ?>">Setting</a></li>
                         <li class="breadcrumb-item active"><?= $judul; ?></li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <section class="content p-3">
         <div class="card shadow-lg">

             <div class="card-body">
                 <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addmodal">
                     Tambah Jabatan
                 </button>
                 <div class="table-responsive">
                     <table class="table table-bordered table-sm table-hover" id="myTable">
                         <thead class="text-center">
                             <tr>
                                 <th>NO</th>
                                 <th>NAMA</th>
                                 <th>BAGIAN</th>
                                 <th>AKTIF</th>

                             </tr>
                         </thead>
                         <tbody class="text-center">
                             <?php $n = 1; ?>
                             <?php foreach ($jabatan as $j) : ?>
                                 <tr>
                                     <td><?= $n++; ?></td>
                                     <td>
                                         <?= $j['nama']; ?>
                                     </td>
                                     <td>
                                         <?php
                                            $this->db->where('id', $j['subbagian_id']);
                                            $bid = $this->db->get('m_subbagian')->row_array();
                                            $bi = $bid['subbagian'];
                                            ?>
                                         <?= $bi; ?>
                                     </td>
                                     <?php if ($j['isactive'] == 1) : ?>
                                         <td>
                                             <a class="btn btn-outline-success btn-sm" onclick="return confirm('Apakah yakin Akan di nonaktifkan?')" href="<?= base_url('setting/aktivasiJabatan') . '?id=' . $j['id'] . '&aktif=' . $j['isactive']; ?>"> YA</a>
                                         </td>
                                     <?php else : ?>
                                         <td>
                                             <a class="btn btn-outline-warning btn-sm" onclick="return confirm('Apakah yakin Akan di aktifkan?')" href="<?= base_url('setting/aktivasiJabatan') . '?id=' . $j['id'] . '&aktif=' . $j['isactive']; ?>"> Tidak</a>
                                         </td>
                                     <?php endif; ?>


                                 </tr>
                             <?php endforeach; ?>
                         </tbody>
                     </table>


                 </div>
             </div>

         </div>


     </section>
     <!-- /.content -->
 </div>

 <!-- Button trigger modal -->


 <!-- Modal -->
 <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addmodalLabel">Form Tambah Jabatan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="<?= base_url('setting/masterJabatan'); ?>" method="post">
                     <div class="mb-3">
                         <label for="nama" class="form-label">Nama Jabatan</label>
                         <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Jabatan">
                     </div>
                     <div class="mb-3">
                         <label for="sbagian" class="form-label">Nama Sub Bagian</label>
                         <select name="sbagian" id="sbagian" class="form-control">
                             <option value="">pilih sub bagian</option>
                             <?php foreach ($subbagian as $sb) : ?>
                                 <option value="<?= $sb['id']; ?>">
                                     <?php
                                        $this->db->where('id', $sb['bagian_id']);
                                        $bagian = $this->db->get('m_bagian')->row_array();
                                        ?>
                                     <?= $sb['subbagian'] . ' | ' . $bagian['bagian']; ?>
                                 </option>
                             <?php endforeach; ?>
                         </select>

                     </div>
                     <div class="mb-3">
                         <label for="no_urut" class="form-label">No. Urut</label>
                         <input type="number" name="no_urut" class="form-control" id="no_urut" placeholder="No urut Jabatan">
                     </div>
                     <div class="form-check">
                         <input name="lead" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                         <label class="form-check-label" for="flexCheckDefault">
                             Kepala / Pimpinan
                         </label>
                     </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save</button>
             </div>
             <div class="note">
                 <p>Catatan: Untuk unsur pimpinan seperti kepala bagian atau kaur kapol harap ceklis pada bagian pimpinan.</p>
             </div>
             </form>
         </div>
     </div>
 </div>