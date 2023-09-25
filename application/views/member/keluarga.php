<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1><span>Data Keluarga</span></h1>
                <h2><span id="typed"></span></h2>
            </div>
            <div class="mt-3">
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        </div>

        <div class="card card-success shadow-lg mt-3">
            <div class="card-header">
                <h5>Daftar anggota keluarga</h5>
            </div>
            <div class="card-body">
                <div class="text-left">
                    <a class="btn btn-primary btn-sm mb-3" type="button" data-bs-toggle="modal" data-bs-target="#card">
                        <i class="ri-user-add-line"></i> Keluarga
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table bordered text-center table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Hubungan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($keluarga as $k) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td>
                                        <a class="text-dark" href="<?= base_url('keluarga/detail') . '?id=' . $k['id']; ?>">
                                            <?= $k['nama']; ?>
                                        </a>
                                    </td>
                                    <td><?= $k['hub']; ?></td>
                                    <td>
                                        <a class="badge badge-warning" href="<?= base_url('keluarga/edit') . '?id=' . $k['id']; ?>">
                                            Edit
                                        </a>
                                        <a class="badge badge-danger" onclick="return confirm('Apakah Anda Yakin??');" href="<?= base_url('keluarga/hapus') . '?id=' . $k['id']; ?>">
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

    </div>
</section><!-- End Hero -->

<div class="modal fade" id="card" tabindex="-1" aria-labelledby="cardLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardLabel">Data Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="card card-success shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Input Data Anggota Keluarga</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="text-center mb-2">
                                <h5>Silahkan isi data.</h5>
                            </div>
                            <?php echo form_open_multipart('keluarga/add'); ?>
                            <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="nama">Nama</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="nama" id="nama" placeholder="nama"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="tl">Tempat Lahir</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="tl" id="tl" placeholder="tempat lahir"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="ttl">Tanggal Lahir</label></div>
                                <div class="col-md-8"><input class="form-control" type="date" name="ttl" id="ttl" placeholder="tempat lahir"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="hub">Hubungan Keluarga</label></div>
                                <div class="col-md-8"><input class="form-control" list="daftar-keluarga" name="hub" id="hub" placeholder="Hubungan Keluarga"></div>
                                <datalist id="daftar-keluarga">
                                    <option value="Suami">
                                    <option value="Istri">
                                    <option value="Anak">
                                    <option value="Orang Tua / ayah">
                                    <option value="Orang Tua / ibu">
                                    <option value="Adik">
                                    <option value="Kakak">
                                    <option value="Anak Tiri">
                                    <option value="Anak pungut">
                                </datalist>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="ktp">No KTP</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="ktp" id="ktp" placeholder="No KIA untuk Anak"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="bpjs">No BPJS</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="bpjs" id="bpjs" placeholder="no bpjs"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="fktp">Alamat FKTP</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="fktp" id="fktp" placeholder="Nama klinik FKTP"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="email">Email</label></div>
                                <div class="col-md-8"><input class="form-control" type="email" name="email" id="email"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="tlp">No Hp</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="tlp" id="tlp"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="agama">Agama</label></div>
                                <div class="col-md-8"><input class="form-control" list="daftar-agama" name="agama" id="agama"></div>
                                <datalist id="daftar-agama">
                                    <option value="Islam">
                                    <option value="Protestan">
                                    <option value="Katolik">
                                    <option value="Budha">
                                    <option value="Hindu">
                                    <option value="Konghucu">
                                </datalist>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="alamat">Alamat</label></div>
                                <div class="col-md-8"><textarea class="form-control" type="text" name="alamat" id="alamat"></textarea></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="status">Status Hidup</label></div>
                                <div class="col-md-8"><input class="form-control" list="daftar-status" name="status" id="status"></div>
                                <datalist id="daftar-status">
                                    <option value="Hidup">
                                    <option value="Meninggal">
                                </datalist>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="gol">Golongan Darah</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="gol" id="gol"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col text-left"><label for="image">Upload Akta Lahir</label></div>
                                <div class="col-md-8"><input class="form-control" type="file" name="image" id="image"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col text-left"><label for="image1">Upload KTP</label></div>
                                <div class="col-md-8"><input class="form-control" type="file" name="image1" id="image1"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col text-left"><label for="image2">Upload BPJS</label></div>
                                <div class="col-md-8"><input class="form-control" type="file" name="image2" id="image2"></div>
                            </div>
                            <div class="karsu" id="karsu" style="display: none;">
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="tlp">No Karis/Karsu</label></div>
                                    <div class="col-md-8"><input class="form-control" type="text" name="tlp" id="tlp"></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col text-left"><label for="image3">Upload Karis/Karsu</label></div>
                                    <div class="col-md-8"><input class="form-control" type="file" name="image3" id="image3"></div>
                                </div>
                            </div>


                            <div class="row form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                            </div>



                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <!-- /.card-body -->
                </div>



            </div>
        </div>
    </div>
</div>