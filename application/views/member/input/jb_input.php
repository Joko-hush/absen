<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h2><span>Dokumen Elektronik Absensi Personil Dustira</span></h2>
                <h2><span id="typed"></span></h2>
                <div class="mt-3">
                    <?= $this->session->flashdata('message'); ?>
                    <?php unset($_SESSION['message']); ?>
                </div>
            </div>
        </div>
        <div class="row gy-4 mt-3 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#dapok">
                        <i class="ri-shield-user-fill"></i>
                        <h3 class="text-white">
                            Lengkapi Data Pribadi
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('card'); ?>">
                        <i class="ri-bank-card-line"></i>
                        <h3 class="text-white">
                            Tambahkan Kartu identitas
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('member/pangkat'); ?>">
                        <i class="ri-vuejs-line"></i>
                        <h3 class="text-white">
                            Riwayat Pangkat
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a href="<?= base_url('member/jabatan'); ?>">
                        <i class="ri-user-star-line"></i>
                        <h3 class="text-white">
                            Riwayat Jabatan
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('member/pendidikan'); ?>">
                        <i class="ri-building-2-fill"></i>
                        <h3 class="text-white">
                            Pendidikan Umum
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('dikmil'); ?>">
                        <i class="ri-government-line"></i>
                        <h3 class="text-white">
                            Pendidikan Militer
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('bahasa'); ?>">
                        <i class="ri-chat-smile-3-line"></i>
                        <h3 class="text-white">
                            Kemampuan Bahasa
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('TugasOperasi'); ?>">
                        <i class="ri-gps-fill"></i>
                        <h3 class="text-white">
                            Riwayat Penugasan Operasi
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('TugasLuarNegeri'); ?>">
                        <i class="ri-earth-line"></i>
                        <h3 class="text-white">
                            Riwayat Penugasan Luar Negeri
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('Kehormatan'); ?>">
                        <i class="ri-shield-star-line"></i>
                        <h3 class="text-white">
                            Tanda Kehormatan
                        </h3>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('member/prestasi'); ?>">
                        <i class="ri-star-smile-line"></i>
                        <h3 class="text-white">
                            Prestasi
                        </h3>
                    </a>
                </div>
            </div>



        </div>


    </div>
</section>

<div class="modal fade" id="dapok" tabindex="-1" aria-labelledby="dapokLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dapokLabel">Data Pribadi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
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
                                    $this->db->where('nama', $staff['jabatan']);
                                    $jabStaff = $this->db->get('m_jabatan')->row_array();
                                    $this->db->where('id', $jabStaff['id']);
                                    $jbtn = $this->db->get('m_jabatan')->row_array();

                                    $this->db->where('id', $jbtn['subbagian_id']);
                                    $subbagian = $this->db->get('m_subbagian')->row_array();
                                    $sb = $subbagian['subbagian'];
                                    $j = $jbtn['nama'];
                                    $jab =  $jabStaff['id'] . ' | ' . $j . ' | ' . $sb;
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
                    <!-- /.card-header -->

                    <!-- /.card-body -->
                </div>



            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="cardkartu" tabindex="-1" aria-labelledby="cardLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardLabel">Input Kartu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="card card-success shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Input KTP</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="text-center mb-2">
                                <h5>Isi data KTP</h5>
                            </div>
                            <?php echo form_open_multipart('member/ktp'); ?>
                            <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="no">No. KTP</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no KTP" value="<?= $kartuKtp['noktp']; ?>"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col text-left"><label for="ktp">Upload Kartu</label></div>
                                <?php
                                if (!$kartuKtp['doc']) {
                                    $namaFileKtp = '';
                                    $extKtp = '';
                                } else {

                                    list($namaFileKtp, $extKtp) = explode('.', $kartuKtp['doc']);
                                }
                                ?>
                                <?php if ($extKtp == 'pdf') : ?>
                                    <div class="col-md-4 text-center">
                                        <a href="<?= base_url('assets/img/dosier/') . $kartuKtp['doc']; ?>" target="_blank()">
                                            <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="ktp" class="img img-thumbnail img-responsive">
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="col-md-4 text-center">
                                        <a href="<?= base_url('assets/img/dosier/') . $kartuKtp['doc']; ?>" target="_blank()">
                                            <img src="<?= base_url('assets/img/dosier/') . $kartuKtp['doc']; ?>" alt="ktp" class="img img-thumbnail img-responsive">
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                            </div>
                            <div class="row form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                            </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <!-- /.card-body -->
                </div>
                <div class="col-md-12">
                    <div class="card card-success shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Input Kartu NPWP</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="text-center mb-2">
                                <h5>Isi data NPWP</h5>
                            </div>
                            <?php echo form_open_multipart('member/npwp'); ?>
                            <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="no">No. NPWP</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no npwp" value="<?= $npwp['npwp']; ?>"></div>
                            </div>
                            <?php
                            if (!$npwp['doc']) {
                                $namaFileNpwp = '';
                                $extNpwp = '';
                            } else {

                                list($namaFileNpwp, $extNpwp) = explode('.', $npwp['doc']);
                            }
                            ?>
                            <div class="row form-group">
                                <div class="col text-left"><label for="image">Upload Kartu</label></div>
                                <?php if ($extNpwp == 'pdf') : ?>
                                    <a href="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" target="_blank()">
                                        <div class="col-md-4 text-center">
                                            <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="npwp" class="img img-thumbnail img-responsive">
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="col-md-4 text-center">
                                        <a href="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" target="_blank()">
                                            <img src="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" class="img img-thumbnail img-responsive">
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                            </div>
                            <div class="row form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                            </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <!-- /.card-body -->
                </div>
                <div class="col-md-12">
                    <div class="card card-success shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Input Kartu BPJS</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <?php
                        if (!$kartuBpjs['doc']) {
                            $namaFileBpjs = '';
                            $extBpjs = '';
                        } else {

                            list($namaFileBpjs, $extBpjs) = explode('.', $kartuBpjs['doc']);
                        }
                        ?>

                        <div class="card-body">
                            <div class="text-center mb-2">
                                <h5>BPJS Kesehatan</h5>
                            </div>
                            <?php echo form_open_multipart('member/bpjs'); ?>
                            <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="no">No. bpjs</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no BPJS" value="<?= $kartuBpjs['bpjs']; ?>"></div>
                            </div>
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="fktp">FKTP</label></div>
                                <div class="col-md-8"><input class="form-control" type="text" name="fktp" id="fktp" placeholder="KLINIK FKTP" value="<?= $kartuBpjs['fktp']; ?>"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col text-left"><label for="image">Upload Kartu</label></div>
                                <?php if ($extBpjs == 'pdf') : ?>
                                    <div class="col-md-4 text-center">
                                        <a href="<?= base_url('assets/img/dosier/') . $kartuBpjs['doc']; ?>" target="_blank()">
                                            <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" class="img img-thumbnail img-responsive" alt="dokumen">
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="col-md-4 text-center">
                                        <a href="<?= base_url('assets/img/dosier/') . $kartuBpjs['doc']; ?>" target="_blank()">
                                            <img src="<?= base_url('assets/img/dosier/') . $kartuBpjs['doc']; ?>" class="img img-thumbnail img-responsive" alt="dokumen">
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                            </div>
                            <div class="row form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                            </div>

                            </form>
                        </div>
                    </div>
                    <div class="card card-success shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Input Kartu Keluarga</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="text-center mb-2">
                                <h5>Kartu Keluarga</h5>
                            </div>
                            <?php echo form_open_multipart('member/kk'); ?>
                            <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                            <div class="row form-group mt-3">
                                <div class="col text-left"><label for="no">No. Kartu Keluarga</label></div>

                                <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no kk" value="<?= $kk['no_kk']; ?>"></div>
                            </div>
                            <?php
                            if (!$kk['doc']) {
                                $namaFilekk = '';
                                $extkk = '';
                            } else {
                                list($namaFilekk, $extkk) = explode('.', $kk['doc']);
                            }

                            ?>
                            <div class="row form-group">
                                <div class="col text-left"><label for="image">Upload Kartu</label></div>
                                <?php if ($extkk == 'pdf') : ?>
                                    <div class="col-md-4 text-center">
                                        <a href="<?= base_url('assets/img/dosier/') .  $kk['doc']; ?>" target="_blank()">
                                            <img src="<?= base_url('assets/img/dosier/') .  'pdf_icon.png'; ?>" class="img img-thumbnail img-responsive">
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="col-md-4 text-center">
                                        <a href="<?= base_url('assets/img/dosier/') .  $kk['doc']; ?>" target="_blank()">
                                            <img src="<?= base_url('assets/img/dosier/') .  $kk['doc']; ?>" class="img img-thumbnail img-responsive">
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                            </div>
                            <div class="row form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                            </div>

                            </form>
                        </div>
                        <?php if ($staff['pangkat'] !== ' KHL') : ?>
                            <div class="card card-success shadow-lg mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">Input Kartu Istri/Suami</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>

                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <h5>KARIS/KARSU</h5>
                                    </div>
                                    <?php
                                    if (!$kartuKaris['doc']) {
                                        $namaFileKaris = '';
                                        $extKaris = '';
                                    } else {
                                        list($namaFileKaris, $extKaris) = explode('.', $kartuKaris['doc']);
                                    }
                                    ?>
                                    <?php echo form_open_multipart('member/karis'); ?>
                                    <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                                    <div class="row form-group mt-3">
                                        <div class="col text-left"><label for="no">No. Kartu Istri/Suami</label></div>
                                        <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no karis/karsu" value="<?= $kartuKaris['no']; ?>"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col text-left"><label for="image">Upload Kartu</label></div>
                                        <?php if ($extKaris == 'pdf') : ?>
                                            <div class="col-md-4 text-center">
                                                <a href="<?= base_url('assets/img/dosier/') .  $kartuKaris['doc']; ?>" target="_blank()">
                                                    <img src="<?= base_url('assets/img/dosier/') .  'pdf_icon.png'; ?>" class="img img-thumbnail img-responsive">
                                                </a>
                                            </div>
                                        <?php else : ?>
                                            <div class="col-md-4 text-center">
                                                <a href="<?= base_url('assets/img/dosier/') .  $kartuKaris['doc']; ?>" target="_blank()">
                                                    <img src="<?= base_url('assets/img/dosier/') .  $kartuKaris['doc']; ?>" class="img img-thumbnail img-responsive">
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                                    </div>
                                    <div class="row form-group">
                                        <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        <?php else : ?>
                            <div></div>
                        <?php endif; ?>
                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>