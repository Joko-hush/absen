<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="card card-success shadow-lg mb-3">
            <div class="card-header">
                <h3 class="card-title">Edit Prestasi</h3>

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
                <?php echo form_open_multipart('member/editprestasi'); ?>
                <input type="hidden" name="id" value="<?= $prestasi['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nama">Kegiatan</label></div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="nama" id="nama" value="<?= $prestasi['kegiatan']; ?>">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="thn">Tahun</label></div>
                    <div class="col-md-8"><input class="form-control" type="number" name="thn" id="thn" value="<?= $prestasi['thn']; ?>">
                        <?= form_error('thn', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="tempat">Tempat</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="tempat" id="tempat" value="<?= $prestasi['tempat']; ?>">
                        <?= form_error('tempat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="deskripsi">Deskripsi</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="deskripsi" id="deskripsi" value="<?= $prestasi['deskripsi']; ?>">
                        <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="kep">Kep/Piagam</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="kep" id="kep" value="<?= $prestasi['kep']; ?>">
                        <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Upload kep/Piagam</label></div>
                    <div class="col-md-3">
                        <?php
                        if (!$prestasi['doc']) {
                            $namaFiledoc = '';
                            $extdoc = '';
                        }
                        list($namaFiledoc, $extdoc) = explode('.', $prestasi['doc']);
                        ?>
                        <figure>
                            <?php if ($extdoc == 'pdf') : ?>
                                <a href="<?= base_url('assets/img/dosier/') . $prestasi['doc']; ?>" target="_blank()">
                                    <iframe src="<?= base_url('assets/img/dosier/') . $prestasi['doc']; ?>" class="img img-thumbnail img-responsive"></iframe>
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('assets/img/dosier/') . $prestasi['doc']; ?>" target="_blank()">
                                    <img src="<?= base_url('assets/img/dosier/') . $prestasi['doc']; ?>" alt="Doc Kep / Piagam" class="img img-thumbnail img-responsive">
                                </a>
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div class="col-md-5"><input class="form-control" type="file" name="image" id="image"></div>
                </div>

                <div class="row form-group">
                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                </div>
                </form>

            </div>
        </div>


    </div>
</section>