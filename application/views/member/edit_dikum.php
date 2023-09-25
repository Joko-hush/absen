<section id="hero">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <?= $judul; ?>

            </div>
            <div class="card-body">
                <?php echo form_open_multipart('member/editdikum'); ?>
                <input type="hidden" name="id" value="<?= $dikum['id']; ?>">
                <input type="hidden" name="pers_id" value="<?= $dikum['personil_id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="jenis">Jenis Pendidikan</label></div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="jenis" id="jenis" value="<?= $dikum['jenis_didik']; ?>">
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="thn">Tahun Lulus</label></div>
                    <div class="col-md-8"><input class="form-control" type="year" name="thn" id="thn" placeholder="Tahun Lulus" value="<?= $dikum['thn']; ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nama">Nama Sekolah</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Sekolah" value="<?= $dikum['nama']; ?>"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="prestasi">Prestasi</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="prestasi" id="prestasi" value="<?= $dikum['prestasi']; ?>"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Upload ijazah</label></div>
                    <div class="col-md-4">
                        <iframe src="<?= base_url('assets/img/ijazah/') . $dikum['doc']; ?>" frameborder="0" class="img img-responsive"></iframe>
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