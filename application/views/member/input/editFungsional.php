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
                <?php echo form_open_multipart('member/editFungsional'); ?>
                <input type="hidden" name="id" value="<?= $jabatan_f['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nama">Nama Jabatan</label></div>
                    <div class="col-md-8">
                        <select name="nama" id="nama" class="form-control">
                            <option value="<?= $jabatan_f['id'] . ',' . $jabatan_f['nama']; ?>">
                                <?php
                                $this->db->where('id', $jabatan_f['jabatan_id']);
                                $jbt = $this->db->get('m_jabatan')->row_array();
                                $this->db->where('id', $jbt['subbagian_id']);
                                $sb = $this->db->get('m_subbagian')->row_array();
                                ?>
                                <?= $jbt['nama'] . ' | ' . $sb['subbagian']; ?>
                            </option>
                            <?php foreach ($jabatan as $j) : ?>
                                <?php
                                $this->db->where('id', $j['subbagian_id']);
                                $bagian = $this->db->get('m_subbagian')->row_array();
                                ?>
                                <option value="<?= $j['id'] . ',' . $j['nama']; ?>"><?= $j['nama'] . ' | ' . $bagian['subbagian']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="skep">Skep</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="skep" id="skep" value="<?= $jabatan_f['skep']; ?>"></div>
                    <?= form_error('skep', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="tmt">TMT</label></div>
                    <div class="col-md-8"><input class="form-control" type="date" name="tmt" id="tmt" value="<?= $jabatan_f['tmt']; ?>"></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4 text-left"><label for="image">Upload Doc</label></div>
                    <div class="col-md-4">
                        <a href="<?= base_url('assets/img/dosier/') . $jabatan_f['doc']; ?>" target="_blank()">
                            <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" class="img img-thumbnail">
                        </a>
                    </div>
                    <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
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