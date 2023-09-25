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
                <?php echo form_open_multipart('member/editdikmila'); ?>
                <input type="hidden" name="id" value="<?= $dikmil['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="jenis">DIKMA/DIKTU/DIKBANGUM</label></div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="jenis" id="jenis" value="<?= $dikmil['nama'] ?>">
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="thn">Tahun</label></div>
                    <div class="col-md-8"><input class="form-control" type="date" name="thn" id="thn" value="<?= $dikmil['thn'] ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="kep">No. Kep</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="kep" id="kep" value="<?= $dikmil['kep'] ?>"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="prestasi">Prestasi</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="prestasi" id="prestasi" value="<?= $dikmil['prestasi'] ?>"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Upload Doc</label></div>
                    <div class="col-md-3">
                        <a href="<?= base_url('assets/img/dosier/') . $dikmil['doc']; ?>" target="_blank()">
                            <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" frameborder="0" class="img img-responsive img-thumbnail rounded">
                        </a>
                    </div>
                    <div class="col-md-5"><input class="form-control" type="file" name="image" id="image"></div>
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
</section>