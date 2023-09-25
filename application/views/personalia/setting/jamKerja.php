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
                    <i class="ri-add-circle-line"></i> Jam Kerja Baru
                </button>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover" id="myTable">
                        <thead class="text-center">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>JAM MASUK</th>
                                <th>JAM PULANG</th>
                                <th>TOTAL JAM KERJA</th>
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php $n = 1; ?>
                            <?php foreach ($jamKerja as $jk) : ?>
                                <?php
                                $jj = floor($jk['total_jam'] / 60);
                                $m = $jk['total_jam'] % 60;
                                if ($m > 0) {
                                    $tjam = $jj . ' jam ' . $m . ' menit';
                                } else {
                                    $tjam = $jj . ' jam';
                                }
                                if ($jk['isactive'] > 0) {
                                    $aktif = 'AKTIF';
                                } else {
                                    $aktif = 'NON AKTIF';
                                }
                                ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td>
                                        <?= $jk['nama']; ?>
                                    </td>
                                    <td>
                                        <?= substr($jk['jam_masuk'], 0, 8); ?>
                                    </td>
                                    <td>
                                        <?= substr($jk['jam_pulang'], 0, 8); ?>
                                    </td>
                                    <td>
                                        <?= $tjam; ?>
                                    </td>
                                    <td>
                                        <?php if ($jk['isactive'] == 1) : ?>
                                            <a class="btn btn-outline-success btn-sm" onclick="return confirm('Apakah yakin Akan di nonaktifkan?')" href="<?= base_url('setting/aktivasiJamKerja') . '?id=' . $jk['id'] . '&aktif=' . $jk['isactive']; ?>"> <?= $aktif; ?></a>
                                        <?php else : ?>
                                            <a class="btn btn-outline-warning btn-sm" onclick="return confirm('Apakah yakin Akan di aktifkan?')" href="<?= base_url('setting/aktivasiJamKerja') . '?id=' . $jk['id'] . '&aktif=' . $jk['isactive']; ?>"> <?= $aktif; ?></a>
                                        <?php endif; ?>
                                        |
                                        <a class="btn btn-outline-warning btn-sm" onclick="return confirm('Apakah Anda akan melakukan update pada jam kerja ini?')" href="<?= base_url('setting/editJamKerja') . '?id=' . $jk['id']; ?>"> EDIT</a>
                                        |
                                        <a class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah yakin Akan di hapus?')" href="<?= base_url('setting/hapusJamKerja') . '?id=' . $jk['id']; ?>"> DELETE</a>
                                    </td>
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

<div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addmodalLabel">Tambah Jam Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('setting/jamKerja'); ?>" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Jam Kerja</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Jam Kerja">
                    </div>
                    <label for="time" class="form-label">Jam Kerja</label>
                    <div class="input-group mb-3">
                        <input type="time" class="form-control" name="in" aria-label="masuk">
                        <span class="input-group-text">-</span>
                        <input type="time" class="form-control" name="out" aria-label="pulang">
                    </div>
                    <div class="mb-3">
                        <label for="ket" class="form-label">Keterangan</label>
                        <input type="text" name="ket" class="form-control" id="ket" placeholder="keterangan">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>