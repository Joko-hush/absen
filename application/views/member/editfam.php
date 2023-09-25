<section id="dosier" class="latar">
    <div class="container">
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
                <?php echo form_open_multipart('keluarga/edit'); ?>
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <input type="hidden" name="famid" value="<?= $fam['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nama">Nama</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="nama" id="nama" placeholder="nama" value="<?= $fam['nama']; ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="tl">Tempat Lahir</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="tl" id="tl" placeholder="tempat lahir" value="<?= $fam['tempat_lahir']; ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="ttl">Tanggal Lahir</label></div>
                    <div class="col-md-8"><input class="form-control" type="date" name="ttl" id="ttl" placeholder="tempat lahir" value="<?= $fam['tanggal_lahir']; ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="hub">Hubungan Keluarga</label></div>
                    <div class="col-md-8"><input class="form-control" list="daftar-keluarga" name="hub" id="hub" placeholder="Hubungan Keluarga" value="<?= $fam['hub']; ?>"></div>
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
                    <div class="col-md-8"><input class="form-control" type="text" name="ktp" id="ktp" placeholder="No KIA untuk Anak" value="<?= $fam['ktp']; ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="bpjs">No BPJS</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="bpjs" id="bpjs" placeholder="no bpjs" value="<?= $fam['bpjs']; ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="fktp">Alamat FKTP</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="fktp" id="fktp" placeholder="Nama klinik FKTP" value="<?= $fam['fktp']; ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="email">Email</label></div>
                    <div class="col-md-8"><input class="form-control" type="email" name="email" id="email" value="<?= $fam['email']; ?>"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="phone">No Telepon</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="phone" id="phone" value="<?= $fam['tlp']; ?>"></div>
                </div>

                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="agama">Agama</label></div>
                    <div class="col-md-8"><input class="form-control" list="daftar-agama" name="agama" id="agama" value="<?= $fam['agama']; ?>"></div>
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
                    <div class="col-md-8"><textarea class="form-control" type="text" name="alamat" id="alamat"><?= $fam['alamat']; ?></textarea></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="status">Status Hidup</label></div>
                    <div class="col-md-8"><input class="form-control" list="daftar-status" name="status" id="status" value="<?= $fam['stat_hidup']; ?>"></div>
                    <datalist id="daftar-status">
                        <option value="Hidup">
                        <option value="Meninggal">
                    </datalist>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="gol">Golongan Darah</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="gol" id="gol" value="<?= $fam['gol_darah']; ?>"></div>
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
            <div class="card-footer p-2 mb-3">

            </div>
        </div>

    </div>
</section>