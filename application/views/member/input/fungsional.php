<section id="dosier" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <?= $this->session->flashdata('message'); ?>
        <?php unset($_SESSION['message']); ?>


        <div class="card card-success shadow-lg mb-3">
            <div class="card-header">
                <h3 class="card-title">Riwayat Jabatan Fungsional</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>

            <div class="card-body">
                <div class="text-left">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#fungsional" class="btn btn-primary">Tambahkan</a>
                </div>
                <div class="table-responsive mt-2">
                    <table id="myTable8" class="table table-bordered mt-3">
                        <thead class="text-center">
                            <tr>
                                <th>Nama Jabatan</th>
                                <th>Skep</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jabatan_f as $jf) : ?>
                                <tr>
                                    <td><?= $jf['nama']; ?></td>
                                    <td><?= $jf['skep']; ?></td>
                                    <td>
                                        <a href="<?= base_url('member/editFungsional') . '?id=' . $jf['id']; ?>" class="btn btn-outline-warning" onclick="return confirm('Apakah Anda akan mengubah data jabatan ini?')">
                                            Edit
                                        </a>
                                        |
                                        <a href="<?= base_url('member/hapusFungsional') . '?id=' . $jf['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda akan menghapus data jabatan ini?')">
                                            Hapus
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
        <div class="text-center">
            <a href="<?= base_url('member/jabatan'); ?>" class="btn btn-sm btn-outline-warning">
                Kembali
            </a>
        </div>

    </div>
</section>

<div class="modal fade" id="fungsional" tabindex="-1" aria-labelledby="fungsionalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fungsionalLabel">Riwayat Jabatan Fungsional</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="card card-success shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Jabatan Fungsional</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">

                            <div class="container-fluid p-5">
                                <div class="text-center mb-2">
                                    <h5>Tambahkan Riwayat Jabatan Fungsional.</h5>
                                </div>
                                <?php echo form_open_multipart('member/fungsional'); ?>
                                <input type="hidden" name="id" value="<?= $staff['nik']; ?>">
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="nama">Nama Jabatan</label></div>
                                    <div class="col-md-8">
                                        <input type="text" name="nama" id="nama" class="form-control">

                                    </div>
                                </div>
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="skep">Skep</label></div>
                                    <div class="col-md-8"><input class="form-control" type="text" name="skep" id="skep" placeholder="No Skep/Sprint"></div>
                                    <?= form_error('skep', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="tmt">TMT</label></div>
                                    <div class="col-md-8"><input class="form-control" type="date" name="tmt" id="tmt"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col text-left"><label for="image">Upload Doc</label></div>
                                    <div class="col-md-8"><input class="form-control" type="file" name="image" id="image"></div>
                                </div>
                                <div class="row form-group">
                                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                </div>

                                </form>

                                <div class="card-footer">
                                    <p>Catatan :</p>
                                    <ol>
                                        <li>Semua kolom harus di isi.</li>
                                        <li>Format file untuk upload (pdf, jpg, png, jpeg) tidak lebih dari 5Mb.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- /.card-body -->
                </div>



            </div>
        </div>
    </div>
</div>