<section id="dosier" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1><span>Riwayat Prestasi</span></h1>
            </div>
            <div class="mt-3">
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        </div>


        <div class="card card-success shadow-lg">
            <div class="card-header">
                <h3 class="card-title">Data Riwayat Prestasi</h3>
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
                    <table id="myTable11" class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Kegiatan</th>
                                <th>Tahun</th>
                                <th>Tempat</th>
                                <th>Deskripsi</th>
                                <th>Kep/Piagam</th>
                                <th>Doc</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prestasi as $star) : ?>
                                <tr>
                                    <td><?= $star['kegiatan']; ?></td>
                                    <td><?= $star['thn']; ?></td>
                                    <td><?= $star['tempat']; ?></td>
                                    <td><?= $star['deskripsi']; ?></td>
                                    <td><?= $star['kep']; ?></td>
                                    <td><?= $star['doc']; ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-warning  btn-sm" href="<?= base_url('member/editprestasi') . '?id=' . $star['id']; ?>">EDIT</a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin akan menghapus?');" href="<?= base_url('member/hpsstar') . '?id=' . $star['id']; ?>">HAPUS</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Prestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2">
                    <h5>Silahkan isi data.</h5>
                </div>
                <?php echo form_open_multipart('member/prestasi'); ?>
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nama">Kegiatan</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="nama" id="nama" placeholder="Jenis tanda kehormatan"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="thn">Tahun</label></div>
                    <div class="col-md-8"><input class="form-control" type="number" name="thn" id="thn" placeholder="Tahun"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="tempat">Tempat</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="tempat" id="tempat" placeholder="tempat kegiatan"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="deskripsi">Deskripsi</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="deskripsi" id="deskripsi" placeholder="deskripsi kegiatan"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="kep">Kep/Piagam</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="kep" id="kep" placeholder="kep kegiatan"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Upload kep/Piagam</label></div>
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