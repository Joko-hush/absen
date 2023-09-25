<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="card card-success shadow-lg mb-3">
            <div class="card-header">
                <h3 class="card-title"><?= $judul; ?></h3>

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
                <?php echo form_open_multipart('member/editkepangkatan'); ?>
                <input type="hidden" name="id" value="<?= $pkt['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="pangkat">Pangkat</label></div>
                    <div class="col-md-8">
                        <input list="data_pangkat" name="pangkat" id="pangkat" class="form-control" value="<?= $pkt['pangkat']; ?>">
                        <datalist id="data_pangkat">
                            <option value="Jendral">
                            <option value="Mayjen">
                            <option value="Letjen">
                            <option value="Brigjen">
                            <option value="Kolonel">
                            <option value="Kolonel (k)">
                            <option value="Letkol">
                            <option value="Letkol (k)">
                            <option value="Mayor">
                            <option value="Mayor (k)">
                            <option value="Kapten">
                            <option value="Kapten (k)">
                            <option value="Lettu">
                            <option value="Lettu (k)">
                            <option value="Letda">
                            <option value="Letda (k)">
                            <option value="Peltu">
                            <option value="Pelda">
                            <option value="Pelda (k)">
                            <option value="Peltu (k)">
                            <option value="Serma">
                            <option value="Serma (k)">
                            <option value="Serka">
                            <option value="Serka (k)">
                            <option value="Sertu">
                            <option value="Sertu (k)">
                            <option value="Serda">
                            <option value="Serda (k)">
                            <option value="Kopka">
                            <option value="Koptu">
                            <option value="Kopda">
                            <option value="praka">
                            <option value="pratu">
                            <option value="prada">
                            <option value="PNS IV/D">
                            <option value="PNS IV/C">
                            <option value="PNS IV/B">
                            <option value="PNS IV/A">
                            <option value="PNS III/D">
                            <option value="PNS III/C">
                            <option value="PNS III/B">
                            <option value="PNS III/A">
                            <option value="PNS II/D">
                            <option value="PNS II/C">
                            <option value="PNS II/B">
                            <option value="PNS II/A">
                            <option value="PNS I/D">
                            <option value="PNS I/C">
                            <option value="PNS I/B">
                            <option value="PNS I/A">
                            <option value="KHL">
                        </datalist>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="tmt">TMT</label></div>
                    <div class="col-md-8"><input class="form-control" type="date" name="tmt" id="tmt" value="<?= $pkt['tmt']; ?>"></div>
                    <?= form_error('tmt', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="skep">No Skep</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="skep" id="skep" value="<?= $pkt['no_skep']; ?>"></div>
                    <?= form_error('skep', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="row form-group">
                    <div class="col text-left"><label for="ktp">Upload SKEP</label></div>
                    <div class="col-md-3">
                        <a href="<?= base_url('assets/img/dosier/') . $pkt['doc']; ?>" target="_blank()">

                            <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" frameborder="0" class="img img-responsive img-thumbnail">
                        </a>
                    </div>
                    <div class="col-md-5"><input class="form-control" type="file" name="image" id="image"></div>
                </div>

                <div class="row form-group">
                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                </div>
                <div class="row form-group">
                    <p>* upload skep menggunakan format pdf ukuran tidak boleh lebih dari 5MB.</p>
                </div>

                </form>
            </div>
        </div>

    </div>

</section>