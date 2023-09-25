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
                <?php echo form_open_multipart('member/edittkh'); ?>
                <input type="hidden" name="id" value="<?= $tkh['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nama">Jenis tanda kehormatan</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="nama" id="nama" value="<?= $tkh['nama']; ?>">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="thn">Tahun</label></div>
                    <div class="col-md-8"><input class="form-control" type="number" name="thn" id="thn" value="<?= $tkh['thn']; ?>">
                        <?= form_error('thn', '<small class="text-danger pl-3">', '</small>'); ?></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="prestasi">Prestasi</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="prestasi" id="prestasi" value="<?= $tkh['prestasi']; ?>">
                        <?= form_error('prestasi', '<small class="text-danger pl-3">', '</small>'); ?></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Upload Doc</label></div>
                    <div class="col-md-3">
                        <a href="<?= base_url('assets/img/dosier/') . $tkh['doc']; ?>" target="_blank()">
                            <img class="img img-responsive img-thumbnail" src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>">
                        </a>
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