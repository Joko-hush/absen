<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="card card-success shadow-lg mt-3">
            <div class="card-header">
                <h5>Edit Kinerja</h5>
                <p><?= $staff['name']; ?></p>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('member/editkinerja'); ?>
                <input type="hidden" name="idi" value="<?= $kinerja['KDKINERJAPENCAPAIN']; ?>">
                <input type="hidden" name="id" value="<?= $staff['KDSTAFF']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="date">Tanggal</label></div>
                    <div class="col-md-8"><input class="form-control" type="date" name="date" id="date" value="<?= substr($kinerja['DATE'], 0, 10); ?>"></div>
                </div>

                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="kegiatan">Kegiatan</label></div>
                    <div class="col-md-8">
                        <select name="kegiatan" id="kegiatan" onchange="check(this)" class="form-control">
                            <option value="<?= $kinerja['KDITEMPENCAPAIN']; ?>">
                                <?= $k; ?>
                            </option>
                            <?php foreach ($item as $i) : ?>
                                <option value="<?= $i['KDITEMPENCAPAIN'] . '"' . 'data-satuan="' . $i['SATUAN'] . '" data-volume="' . $i['VOLUME']; ?>"><?= $i['KEGIATAN']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row form-group mt-3">
                        <div class="col text-left"><label for="output">Output</label></div>
                        <div class="col-md-8"><textarea class="form-control" type="text" name="output" id="output"><?= $kinerja['OUTPUT']; ?></textarea></div>
                    </div>

                    <div class="row form-group mt-3">
                        <div class="col text-left"><label for="volume">Volume</label></div>
                        <div class="col-md-8">
                            <input onchange="checkvolume(this)" class="form-control" type="text" name="volume" id="volume" value="<?= $kinerja['VOLUME']; ?>">
                            <input class="form-control" type="hidden" name="volume2" id="volume2">
                        </div>
                    </div>

                    <div class="row form-group mt-3">
                        <div class="col text-left"><label for="satuan">Satuan</label></div>
                        <div class="col-md-8"><input class="form-control" type="text" name="satuan" id="satuan" value="<?= $kinerja['SATUAN']; ?>" readonly></div>
                    </div>

                    <div class="row form-group mt-3">
                        <div class="col text-left"><label for="ket">Keterangan</label></div>
                        <div class="col-md-8"><input class="form-control" type="text" name="ket" id="ket" value="<?= $kinerja['KETERANGAN']; ?>"></div>
                    </div>

                    <div class="row form-group">
                        <div class="col text-left"><label for="image">Upload Dokumen</label></div>
                        <div class="col-md-4">

                            <iframe src="<?= base_url('assets/dokumen/') . $kinerja['UPLOADDOKUMEN']; ?>" frameborder="0" width="300"></iframe>

                        </div>
                        <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                    </div>

                    <div class="row form-group">
                        <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                    </div>

                    </form>

                </div>
            </div>

        </div>
        <div id="footer"></div>
</section><!-- End Hero -->