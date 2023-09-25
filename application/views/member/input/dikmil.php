<section id="dosier" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1><span>Riwayat Pendidikan Militer</span></h1>
            </div>
            <div class="mt-3">
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="card card-success shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Pendidikan militer DIKMA/DIKTU/DIKBANGUM</h3>
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
                            <table id="myTable4" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <th>Tahun</th>
                                        <th>Prestasi</th>
                                        <th>Kep</th>
                                        <th>Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dik_a as $da) : ?>
                                        <tr>
                                            <td><?= $da['nama']; ?></td>
                                            <td><?= $da['thn']; ?></td>
                                            <td><?= $da['prestasi']; ?></td>
                                            <td><?= $da['kep']; ?></td>
                                            <td><?= $da['doc']; ?></td>


                                            <td>
                                                <a class="btn btn-warning btn-sm" href="<?= base_url('member/editdikmila') . '?id=' . $da['id']; ?>">EDIT</a>
                                                <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin??')" href="<?= base_url('member/hpsdikmila') . '?id=' . $da['id']; ?>">HAPUS</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success shadow-lg mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Pendidikan militer DIKBANGSPES/DIKJAB/DIKILPENGTEK</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">
                        <div class="text-left mt-3">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                Tambah Data
                            </button>

                        </div>
                        <div class="table-responsive mt-2">
                            <table id="myTable5" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <th>Tahun</th>
                                        <th>Prestasi</th>
                                        <th>Kep</th>
                                        <th>Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dik_b as $db) : ?>
                                        <tr>
                                            <td><?= $db['nama']; ?></td>
                                            <td><?= $db['thn']; ?></td>
                                            <td><?= $db['prestasi']; ?></td>
                                            <td><?= $db['kep']; ?></td>
                                            <td><?= $db['doc']; ?></td>


                                            <td>
                                                <a class="btn btn-warning btn-sm" href="<?= base_url('member/editdikmilB') . '?id=' . $db['id']; ?>">EDIT</a>
                                                <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin??')" href="<?= base_url('member/hpsdikmilB') . '?id=' . $db['id']; ?>">HAPUS</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Pendidikan militer DIKMA/DIKTU/DIKBANGUM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2">
                    <h5>Silahkan isi data.</h5>
                </div>
                <?php echo form_open_multipart('member/dik_a'); ?>
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="jenis">DIKMA/DIKTU/DIKBANGUM</label></div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="jenis" id="jenis">
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="thn">Tahun</label></div>
                    <div class="col-md-8"><input class="form-control" type="date" name="thn" id="thn" placeholder="Tahun"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="kep">No. Kep</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="kep" id="kep" placeholder="No. Kep"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="prestasi">Prestasi</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="prestasi" id="prestasi"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Upload Doc</label></div>
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
</div>
<!-- Modal DIKMIL B -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Pendidikan militer DIKBANGSPES/DIKJAB/DIKILPENGTEK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2">
                    <h5>Silahkan isi data.</h5>
                </div>
                <?php echo form_open_multipart('member/dik_b'); ?>
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="jenis">DIKBANGSPES/DIKJAB/DIKILPENGTEK</label></div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="jenis" id="jenis">
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="thn">Tahun</label></div>
                    <div class="col-md-8"><input class="form-control" type="number" name="thn" id="thn" placeholder="Tahun"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nama">No. Kep</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="nama" id="nama" placeholder="No Kep"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="prestasi">Prestasi</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="prestasi" id="prestasi"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Upload Doc</label></div>
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
</div>