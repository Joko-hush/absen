<section id="dosier" class="d-flex align-items-center justify-content-center">
    <div class="container mt-3" data-aos="fade-up">
        <div class="title">
            <h1><?= $judul; ?></h1>
        </div>

        <?= $this->session->flashdata('message'); ?>
        <?php unset($_SESSION['message']); ?>


        <div class="card card-success shadow-lg mb-5 mt-5">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pendidikan</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>

            <div class="card-body">
                <div class="text-left">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#fungsional" class="btn btn-primary  mb-2">Tambahkan</a>
                </div>
                <div class="table-responsive">
                    <table id="myTable3" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pendidikan</th>
                                <th>Tahun Lulus</th>
                                <th>Nama Sekolah</th>
                                <th>Prestasi</th>
                                <th>Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dikum as $du) : ?>
                                <tr>
                                    <td><?= $du['jenis_didik']; ?></td>
                                    <td><?= $du['thn']; ?></td>
                                    <td><?= $du['nama']; ?></td>
                                    <td><?= $du['prestasi']; ?></td>
                                    <td><?= $du['doc']; ?></td>


                                    <td>
                                        <a class="btn btn-warning btn-sm" href="<?= base_url('member/editdikum') . '?id=' . $du['id']; ?>">EDIT</a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('member/hpsdikum') . '?id=' . $du['id']; ?>" onclick="return confirm('Apakah Anda Yakin??');">HAPUS</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="fungsional" tabindex="-1" aria-labelledby="fungsionalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fungsionalLabel">Pendidikan Umum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="card card-success shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Pendidikan Umum</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">

                            <div class="container-fluid p-5">
                                <div class="text-center mb-2">
                                    <h5>Tambahkan Pendidikan Umum.</h5>
                                </div>
                                <?php echo form_open_multipart('member/pendidikan'); ?>
                                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="jenis">Jenis Pendidikan</label></div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="jenis" id="jenis">
                                    </div>
                                </div>
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="thn">Tahun Lulus</label></div>
                                    <div class="col-md-8"><input class="form-control" type="year" name="thn" id="thn" placeholder="Tahun Lulus"></div>
                                </div>
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="nama">Nama Sekolah</label></div>
                                    <div class="col-md-8"><input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Sekolah"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col text-left"><label for="prestasi">Prestasi</label></div>
                                    <div class="col-md-8"><input class="form-control" type="text" name="prestasi" id="prestasi"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col text-left"><label for="image">Upload ijazah</label></div>
                                    <div class="col-md-8"><input class="form-control" type="file" name="image" id="image"></div>
                                </div>

                                <div class="row form-group">
                                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                </div>
                                <div class="row form-group">
                                    <p>* upload dokumen menggunakan format pdf ukuran tidak boleh lebih dari 5MB.</p>
                                </div>
                                </form>


                            </div>
                        </div>
                    </div>


                    <!-- /.card-body -->
                </div>



            </div>
        </div>
    </div>
</div>