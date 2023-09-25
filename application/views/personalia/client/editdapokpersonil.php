<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul; ?></h1>
                    <?= $this->session->flashdata('message'); ?>

                    <?php unset($_SESSION['message']); ?>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('personalia'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('personalia/user'); ?>">Daftar Personil</a></li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content p-3">
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
                <?php echo form_open_multipart('utility/editdapokpersonil'); ?>

                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="nik">No. Kepegawaian</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="nik" id="nik" placeholder="NRP / NIP / NIK" value="<?= $staff['nik']; ?>"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="sdm">Kualifikasi SDM</label></div>
                    <div class="col-md-4"> <select name="sdm" id="sdm" class="form-select">
                            <?php if (!$staff['kualifikasi_sdm']) : ?>
                                <option value="<?= set_value('sdm'); ?>"><?= set_value('sdm'); ?></option>
                            <?php else : ?>
                                <option value="<?= $staff['kualifikasi_sdm']; ?>"><?= $staff['kualifikasi_sdm']; ?></option>
                            <?php endif; ?>
                            <option value="TENAGA PERAWAT">TENAGA PERAWAT</option>
                            <option value="TENAGA BIDAN">TENAGA BIDAN</option>
                            <option value="PENATA LABORATORIUM">PENATA LABORATORIUM</option>
                            <option value="RADIOGRAPHER">RADIOGRAPHER</option>
                            <option value="NUTRITIONIST">NUTRITIONIST</option>
                            <option value="FISIOTERAFIS">FISIOTERAFIS</option>
                            <option value="PHARMACIST">PHARMACIST</option>
                            <option value="TENAGA PROFESIONAL LAINNYA">TENAGA PROFESIONAL LAINNYA</option>
                            <option value="TENAGA NON MEDIS">TENAGA NON MEDIS</option>
                            <option value="SANITARIAN">SANITARIAN</option>
                            <option value="TENAGA NON-MEDIS ADMINISTRASI">TENAGA NON-MEDIS ADMINISTRASI</option>
                            <option value="DOKTER SPESIALIS">DOKTER SPESIALIS</option>
                            <option value="DOKTER GIGI">DOKTER GIGI</option>
                            <option value="DOKTER UMUM">DOKTER UMUM</option>
                        </select>
                        <?= form_error('sdm', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-md-4">
                        <select name="gp" id="gp" class="form-select">
                            <?php if (!$staff['gol_pkt']) : ?>
                                <option value="<?= set_value('gp'); ?>"><?= set_value('gp'); ?></option>
                            <?php else : ?>
                                <option value="<?= $staff['gol_pkt']; ?>"><?= $staff['gol_pkt']; ?></option>
                            <?php endif; ?>
                            <option value="ANGGOTA (TNI)">ANGGOTA (TNI)</option>
                            <option value="PNS">PNS</option>
                            <option value="PPPK">PPPK</option>
                            <option value="NON PNS TETAP">NON PNS TETAP</option>
                            <option value="KONTRAK (KHL)">KONTRAK (KHL)</option>
                        </select>
                        <?= form_error('gp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="jamKerja">Jam Kerja</label></div>
                    <div class="col-md-8">
                        <select name="jamKerja" id="jamKerja" class="form-control">
                            <?php if (!$staff['jam_kerja_id']) : ?>
                                <option value="-">Pilih jam kerja</option>
                            <?php else : ?>
                                <?php
                                $this->db->where('id', $staff['jam_kerja_id']);
                                $jker = $this->db->get('jam_kerja')->row_array();
                                $jkname = $jker['nama'];
                                ?>
                                <option value="<?= $staff['jam_kerja_id']; ?>"><?= $jkname; ?></option>
                            <?php endif; ?>
                            <?php foreach ($jamKerja as $jK) : ?>
                                <option value="<?= $jK['id']; ?>"><?= $jK['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="name">Nama Lengkap</label></div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="name" id="name" value="<?= $staff['name']; ?>">
                    </div>
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
                            <?php if (trim($staff['sex']) == 'L') : ?>
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
                            <option value="-">Belum Tahu</option>
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
                    <div class="col text-left"><label for="jabatan">Jabatan</label></div>
                    <div class="col-md-8">
                        <?php
                        if ($staff['jabatan'] == '') {
                            $jab =  '';
                        } else {
                            $this->db->where('nama', $staff['jabatan']);
                            $jabStaff = $this->db->get('m_jabatan')->row_array();
                            $this->db->where('id', $jabStaff['id']);
                            $jbtn = $this->db->get('m_jabatan')->row_array();

                            $this->db->where('id', $jbtn['subbagian_id']);
                            $subbagian = $this->db->get('m_subbagian')->row_array();
                            $sb = $subbagian['subbagian'];
                            $j = $jbtn['nama'];
                            $jab =  $jabStaff['id'] . ' | ' . $j . ' | ' . $sb;
                        }
                        ?>
                        <input list="data_jabatan" class="form-control" type="jabatan" name="jabatan" id="jabatan" value="<?= $jab; ?>">
                        <datalist id="data_jabatan">
                            <?php foreach ($jabatan as $j) : ?>
                                <?php
                                $this->db->where('id', $j['subbagian_id']);
                                $subbagian = $this->db->get('m_subbagian')->row_array();
                                $sb = $subbagian['subbagian'];
                                ?>
                                <option value="<?= $j['id'] . ' | ' . $j['nama'] . ' | ' . $sb; ?>"><?= $j['nama'] . ' | ' . $sb; ?></option>
                            <?php endforeach; ?>
                        </datalist>


                    </div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="image">Foto</label></div>
                    <div class="col-md-1"><img class="img img-thumbnail rounded-circle" width="96" src="<?= base_url('assets/img/dosier/') . $staff['image']; ?>" alt="avatar personil"></div>
                    <div class="col-md-7"><input class="form-control" type="file" name="image" id="image"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="agama">Agama</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="agama" id="agama" value="<?= $staff['agama']; ?>"></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="status">Status</label></div>
                    <div class="col-md-8"> <select name="status" id="status" class="form-select">
                            <option value="<?= $staff['status']; ?>"><?= $staff['status']; ?></option>
                            <option value="Kawin">Kawin</option>
                            <option value="Tidak Kawin">Tidak Kawin</option>
                            <option value="Janda">Janda</option>
                            <option value="Duda">Duda</option>
                        </select></div>
                </div>
                <div class="row form-group">
                    <div class="col text-left"><label for="suku">Suku Bangsa</label></div>
                    <div class="col-md-8"><input class="form-control" type="text" name="suku" id="suku" value="<?= $staff['suku_bangsa']; ?>"></div>
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


    </section>
    <!-- /.content -->
</div>