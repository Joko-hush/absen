<section id="dosier" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1><span>Keterampilan Bahasa</span></h1>
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
                        <h3 class="card-title">Bahasa Daerah</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="text-left mt-3">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#daerahModal">
                                Tambah Data
                            </button>

                        </div>
                        <div class="table-responsive mt-2">
                            <table id="myTable6" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Bahasa</th>
                                        <th>Aktif/Pasif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bahasa as $bhs) : ?>
                                        <tr>
                                            <td><?= $bhs['nama']; ?></td>
                                            <td><?= $bhs['isactive']; ?></td>
                                            <td>

                                                <a class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda Yakin?');" href="<?= base_url('member/hapus_bahasa_daerah') . '?id=' . $bhs['id']; ?>">HAPUS</a>
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
                        <h3 class="card-title">Bahasa Asing</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">
                        <div class="text-left mt-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah Data
                            </button>

                        </div>
                        <div class="table-responsive mt-2">
                            <table id="myTable7" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Bahasa</th>
                                        <th>Aktif/Pasif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bhsasing as $ba) : ?>
                                        <tr>
                                            <td><?= $ba['nama']; ?></td>
                                            <td><?= $ba['isactive']; ?></td>
                                            <td>

                                                <a class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda Yakin?');" href="<?= base_url('member/hapus_bahasa_asing') . '?id=' . $ba['id']; ?>">HAPUS</a>
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



<div class="modal fade" id="daerahModal" tabindex="-1" aria-labelledby="daerahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="daerahModalLabel">Bahasa Daerah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2">
                    <h5>Silahkan isi data.</h5>
                </div>
                <?php echo form_open_multipart('member/bhs_d'); ?>
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="bahasa">Bahasa Daerah</label></div>
                    <div class="col-md-8"><input class="form-control" list="daftar-bahasa" name="bahasa" id="bahasa" placeholder="Bahasa daerah"></div>
                    <datalist id="daftar-bahasa">
                        <option value="Bahasa Aceh">
                        <option value="Bahasa Bali">
                        <option value="Bahasa Batak">
                        <option value="Bahasa Betawi">
                        <option value="Bahasa Bugis">
                        <option value="Bahasa Gorontalo">
                        <option value="Bahasa Lampung">
                        <option value="Bahasa Madura">
                        <option value="Bahasa Makassar">
                        <option value="Bahasa Melayu">
                        <option value="Bahasa Minangkabau">
                        <option value="Bahasa Sasak">
                        <option value="Bahasa Sunda">
                    </datalist>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="isactive">Penggunaan Bahasa</label></div>
                    <div class="col-md-8"><input class="form-control" list="daftar-aktif" name="isactive" id="isactive" placeholder="Penggunaan Bahasa"></div>
                    <datalist id="daftar-aktif">
                        <option value="Aktif">
                        <option value="Pasif">

                    </datalist>
                </div>
                <div class="row form-group">
                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="bahasaAsing">Bahasa Asing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2">
                    <h5>Silahkan isi data.</h5>
                </div>
                <?php echo form_open_multipart('member/bhs_asing'); ?>
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="bahasa">Bahasa Asing</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="bahasa" id="bahasa" placeholder="Bahasa Asing"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="isactive">Penggunaan Bahasa</label></div>
                    <div class="col-md-8"><input class="form-control" list="daftar-aktif" name="isactive" id="isactive" placeholder="Penggunaan Bahasa"></div>
                    <datalist id="daftar-aktif">
                        <option value="Aktif">
                        <option value="Pasif">
                    </datalist>
                </div>
                <div class="row form-group">
                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>