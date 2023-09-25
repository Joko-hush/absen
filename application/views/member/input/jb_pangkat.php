<div class="card card-success shadow-lg mb-3">
    <div class="card-header">
        <h3 class="card-title">Input Data Pokok</h3>

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
        <?php echo form_open_multipart('member/inputdata'); ?>
        <input type="hidden" name="id" value="<?= $staff['id']; ?>">
        <div class="row form-group mt-3">
            <div class="col text-left"><label for="nik">No. Kepegawaian</label></div>
            <div class="col-md-8"><input class="form-control" type="text" name="nik" id="nik" placeholder="NRP / NIP / NIK" value="<?= $staff['nik']; ?>"></div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="name">Nama Lengkap</label></div>
            <div class="col-md-8"><input class="form-control" type="text" name="name" id="name" value="<?= $staff['name']; ?>"></div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="tl">Tempat Lahir</label></div>
            <div class="col-md-8"><input class="form-control" type="text" name="tl" id="tl" value="<?= $staff['tempat_lahir']; ?>"></div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="ttl">Tanggal Lahir</label></div>
            <div class="col-md-8">
                <input class="form-control bg-light" type="date" name="ttl" id="ttl" value="<?= $staff['tgl_lahir']; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="gender">Jenis kelamin</label></div>
            <div class="col-md-8">
                <select name="gender" id="gender" class="form-select">

                    <?php if ($staff['tgl_lahir'] == 'L') : ?>
                        <option value="L">Laki - laki</option>
                        <option value="P">Perempuan</option>
                    <?php else : ?>
                        <option value="P">Perempuan</option>
                        <option value="L">Laki - laki</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="darah">Gol. Darah</label></div>
            <div class="col-md-8">
                <select name="darah" id="darah" class="form-select">
                    <option value="<?= $staff['gol_darah']; ?>"><?= $staff['gol_darah']; ?></option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="tlp">No. Hp</label></div>
            <div class="col-md-8"><input class="form-control" type="tel" name="tlp" id="tlp" value="<?= $staff['tlp']; ?>"></div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="email">Email</label></div>
            <div class="col-md-8"><input class="form-control" type="email" name="email" id="email" value="<?= $staff['email']; ?>"></div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="image">Foto</label></div>
            <div class="col-md-1"><img class="img img-thumbnail rounded-circle" width="96" src="<?= base_url('assets/img/profile/') . $staff['image']; ?>" alt="avatar personil"></div>
            <div class="col-md-7"><input class="form-control" type="file" name="image" id="image"></div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="agama">Agama</label></div>
            <div class="col-md-8"><input class="form-control" type="text" name="agama" id="agama" value="<?= $staff['agama']; ?>"></div>
        </div>
        <div class="row form-group">
            <div class="col text-left"><label for="alamat">Alamat</label></div>
            <div class="col-md-8">
                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"><?= $staff['alamat']; ?></textarea>
            </div>
        </div>
        <div class="row form-group">
            <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
        </div>



        </form>
    </div>
</div>