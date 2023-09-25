<section id="dosier" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1><span>Data Riwayat Kehormatan</span></h1>
            </div>
            <div class="mt-3">
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        </div>


        <div class="card card-success shadow-lg">
            <div class="card-header">
                <h3 class="card-title">Data Riwayat Kehormatan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="text-left mt-3">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Data
                    </button>

                </div>
                <div class="table-responsive mt-2">
                    <table id="myTable10" class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Jenis Tanda Kehormatan</th>
                                <th>Tahun</th>
                                <th>Prestasi</th>
                                <th>Doc</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tandakehormatan as $tkh) : ?>
                                <tr>
                                    <td><?= $tkh['nama']; ?></td>
                                    <td><?= $tkh['thn']; ?></td>
                                    <td><?= $tkh['prestasi']; ?></td>
                                    <td><?= $tkh['doc']; ?></td>
                                    <td>
                                        <a class="btn btn-warning  btn-sm" href="<?= base_url('member/edittkh') . '?id=' . $tkh['id']; ?>">EDIT</a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('member/hpstkh') . '?id=' . $tkh['id']; ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">HAPUS</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>



        </div>
</section><!-- End Hero -->



<!-- Button trigger modal -->


<!-- Modal DIKMIL A -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Data Riwayat Kehormatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2">
                    <h5>Silahkan isi data.</h5>
                </div>
                <?php echo form_open_multipart('member/tkh'); ?>
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nama">Jenis tanda kehormatan</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="nama" id="nama" placeholder="Jenis tanda kehormatan">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="thn">Tahun</label></div>
                    <div class="col-md-8"><input class="form-control" type="number" name="thn" id="thn" placeholder="Tahun">
                        <?= form_error('thn', '<small class="text-danger pl-3">', '</small>'); ?></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="prestasi">Prestasi</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="prestasi" id="prestasi" placeholder="prestasi">
                        <?= form_error('prestasi', '<small class="text-danger pl-3">', '</small>'); ?></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Upload Doc</label></div>
                    <div class="col-md-8"><input class="form-control" type="file" name="image" id="image"></div>
                </div>

                <div class="row form-group">
                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>