<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1><span>Riwayat Hidup</span></h1>
            </div>
        </div>

        <div class="mt-3 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
            <div class="card shadow rounded">
                <div class="card-header bg-dark text-warning">
                    <h5>I. Data Pokok</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <figure class="img-responsive">
                                <a href="<?= base_url('assets/img/dosier/') . $staff['image']; ?>"><img src="<?= base_url('assets/img/dosier/') . $staff['image']; ?>" alt="foto profil <?= $staff['name']; ?>" class="img rounded" width="214px" height="214px"></a>
                                <figcaption class="text-center">
                                    <h3><?= $staff['name']; ?></h3>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-4 table-responsive">
                            <table class="table text-left table-bordered rounded">
                                <tr>
                                    <th>Nama</th>
                                    <td><?= $staff['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Pangkat/Gol</th>
                                    <td><?= $staff['pangkat']; ?></td>
                                </tr>
                                <tr>
                                    <th>NRP/NIP</th>
                                    <td><?= $staff['nik']; ?></td>
                                </tr>
                                <tr>
                                    <th>TMT</th>
                                    <td><?= $tmtkhl; ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?= $staff['kategori']; ?></td>
                                </tr>
                                <?php if ($staff['pangkat'] == 'PNS%') : ?>
                                    <tr>
                                        <th>TMT PNS</th>
                                        <td><?= $tmtpns; ?></td>
                                    </tr>

                                <?php endif; ?>
                                <tr>
                                    <th>Suku bangsa</th>
                                    <td><?= $staff['suku_bangsa']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4 table-responsive">
                            <table class="table text-left table-bordered rounded">
                                <tr>
                                    <th>Agama</th>
                                    <td><?= $staff['agama']; ?></td>
                                </tr>
                                <tr>
                                    <th>Gol Darah</th>
                                    <td><?= $staff['gol_darah']; ?></td>
                                </tr>
                                <tr>
                                    <th>Sumber PA</th>
                                    <td>-</td>
                                </tr>
                                <!-- <tr>
                                    <th>TMT</th>
                                    <td>-</td>
                                </tr> -->
                                <?php if ($staff['pangkat'] = 'KHL') : ?>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td><?= $jf; ?></td>
                                    </tr>
                                    <tr>
                                        <th>TMT Jab</th>
                                        <td><?= $jft; ?></td>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td><?= $js; ?></td>
                                    </tr>
                                    <tr>
                                        <th>TMT Jab</th>
                                        <td><?= $jst; ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th>Satuan</th>
                                    <td><?= $staff['satuan']; ?></td>
                                </tr>
                            </table>
                        </div>

                    </div>

                </div>
            </div>


        </div>

    </div>
</section>
<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">


            <div class="text-center">
                <h5><span>II. Riwayat Pendidikan</span></h5>
            </div>

            <div data-bs-aos="fade-left" data-aos-delay="100">
                <img src="assets/img/about.jpg" class="img-fluid" alt="">
            </div>
            <div data-aos="fade-right" data-aos-delay="100">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="card-title">Pendidikan Umum</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pendidikan</th>
                                        <th>Tahun</th>
                                        <th>Nama Pendidikan/Fakultas/ Prodi/Jurusan</th>
                                        <th>Prestasi</th>
                                        <th>ijazah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1; ?>
                                    <?php foreach ($dikum as $dik) : ?>
                                        <tr>
                                            <td><?= $n++; ?></td>
                                            <td><?= $dik['jenis_didik']; ?></td>
                                            <td><?= $dik['thn']; ?></td>
                                            <td><?= $dik['nama']; ?></td>
                                            <td><?= $dik['prestasi']; ?></td>
                                            <td>
                                                <a href="<?= base_url('assets/img/dosier/') . $dik['doc']; ?>">
                                                    <h5><i class="ri-folder-download-fill"></i></h5>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div data-aos="fade-right" data-aos-delay="100">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="card-title">Pendidikan Militer</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>DIKMA/DIKTU/DIKBANGUM</th>
                                                <th>Tahun</th>
                                                <th>Prestasi</th>
                                                <th>Kep</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($dikmila as $da) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $da['nama']; ?></td>
                                                    <td><?= $da['thn']; ?></td>
                                                    <td><?= $da['prestasi']; ?></td>
                                                    <td><?= $da['kep']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>DIKBANGSPES/DIKJAB/DIKILPENGTEK</th>
                                                <th>Tahun</th>
                                                <th>Prestasi</th>
                                                <th>Kep</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $x = 1; ?>
                                            <?php foreach ($dikmilb as $dmb) : ?>
                                                <tr>
                                                    <td><?= $x++; ?></td>
                                                    <td><?= $dmb['nama']; ?></td>
                                                    <td><?= $dmb['thn']; ?></td>
                                                    <td><?= $dmb['prestasi']; ?></td>
                                                    <td><?= $dmb['kep']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- end pendidikan -->
            <hr>
            <div class="row">
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">

                    <div class="card card-success">
                        <div class="card-header">
                            <h5 class="card-title">III. Riwayat Penugasan Operasi</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Operasi</th>
                                            <th>Tahun</th>
                                            <th>Prestasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $y = 1; ?>
                                        <?php foreach ($tugasOperasi as $to) : ?>
                                            <tr>
                                                <td><?= $y++; ?></td>
                                                <td><?= $to['nama']; ?></td>
                                                <td><?= $to['thn']; ?></td>
                                                <td><?= $to['prestasi']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">

                    <div class="card card-success">
                        <div class="card-header">
                            <h5 class="card-title">IV. Tanda Kehormatan</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Tanda Kehormatan</th>
                                            <th>Tahun</th>
                                            <th>Prestasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $z = 1; ?>
                                        <?php foreach ($tandaKh as $tkh) : ?>
                                            <tr>
                                                <td><?= $z++; ?></td>
                                                <td><?= $tkh['nama']; ?></td>
                                                <td><?= $tkh['thn']; ?></td>
                                                <td><?= $tkh['prestasi']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- endcol -->
            </div>
            <!-- end penugasan -->



            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">V. Kemampuan Bahasa</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th colspan="2">Daerah</th>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Aktif/Pasif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $b = 1; ?>
                                    <?php foreach ($bhsDaerah as $bd) : ?>
                                        <tr>
                                            <td class="text-center"><?= $b++; ?></td>
                                            <td><?= $bd['nama']; ?></td>
                                            <td><?= $bd['isactive']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="col table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th colspan="2">Asing</th>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Aktif/Pasif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $c = 1; ?>
                                    <?php foreach ($bhsAsing as $bsa) : ?>
                                        <tr>
                                            <td class="text-center"><?= $c++; ?></td>
                                            <td><?= $bsa['nama']; ?></td>
                                            <td><?= $bsa['isactive']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">VI. Riwayat Penugasan Luar Negeri</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Macam Tugas</th>
                                    <th>Tahun</th>
                                    <th>Negara</th>
                                    <th>Prestasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $d = 1;
                                foreach ($tugasLn as $tln) : ?>
                                    <tr>
                                        <td class="text-center"><?= $d++; ?></td>
                                        <td><?= $tln['nama']; ?></td>
                                        <td><?= $tln['thn']; ?></td>
                                        <td><?= $tln['negara']; ?></td>
                                        <td><?= $tln['prestasi']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- end riwayat penugasan -->
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">VII. Kepangkatan</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Pangkat</th>
                                    <th>TMT</th>
                                    <th>Nomor Kep/Skep</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php $n = 1; ?>
                                <?php foreach ($rPangkat as $p) : ?>
                                    <tr>
                                        <td><?= $n++; ?></td>
                                        <td class="text-left"><?= $p['pangkat']; ?></td>
                                        <td><?= $p['tmt']; ?></td>
                                        <td>
                                            <a href="<?= base_url('assets/img/dosier/') . $p['doc']; ?>" class="text-dark">

                                                <?= $p['no_skep']; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- end kepangkatan -->

            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">VIII. Jabatan</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Jabatan</th>
                                    <th>TMT</th>
                                    <th>Nomor Kep/Skep</th>
                                </tr>
                            </thead>
                            <?php if ($staff['pangkat'] = 'khl') : ?>
                                <tbody>
                                    <?php $n = 1;
                                    // var_dump($fungsional);
                                    // die;
                                    foreach ($fungsional as $js) : ?>
                                        <tr>
                                            <td><?= $n++; ?></td>
                                            <td><?= $js['nama']; ?></td>
                                            <td><?= $js['tmt']; ?></td>
                                            <td><?= $js['skep']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            <?php else : ?>
                                <tbody>
                                    <?php $n = 1;

                                    foreach ($struktural as $jf) : ?>
                                        <tr>
                                            <td><?= $n++; ?></td>
                                            <td><?= $jf['nama']; ?></td>
                                            <td><?= $jf['tmt']; ?></td>
                                            <td><?= $jf['skep']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            <?php endif; ?>
                        </table>

                    </div>

                </div>
            </div>
            <!-- end jabatan -->
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">IX. Keluarga</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 table-responsive">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th class="text-end">Status :</th>
                                    <td><?= $kel['status']; ?></td>
                                </tr>
                                <tr>
                                    <?php if ($staff['sex'] == 'P') : ?>
                                        <th class="text-end">Nama Suami :</th>
                                    <?php else : ?>
                                        <th class="text-end">Nama Istri :</th>
                                    <?php endif; ?>
                                    <td><?= $kel['pasangan']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-end">Jumlah Anak :</th>
                                    <td><?= $kel['anak']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-end">Alamat Tinggal :</th>
                                    <td><?= $staff['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-end"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-end">No. Hp</th>
                                    <td><?= $kel['no_hp']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-end">Nama Ayah</th>
                                    <td><?= $kel['ayah']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-end">Nama Ibu</th>
                                    <td><?= $kel['ibu']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-end">Alamat Orang Tua</th>
                                    <td><?= $kel['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-end"></th>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 table-responsive">
                            <table class="table table-bordered table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anak</th>
                                        <th>Tgl Lahir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1; ?>
                                    <?php foreach ($anak as $an) : ?>
                                        <tr>
                                            <td><?= $n++; ?></td>
                                            <td><?= $an['nama']; ?></td>
                                            <td><?= $an['tanggal_lahir']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end keluarga -->
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">X. Prestasi</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kegiatan</th>
                                    <th>Tahun</th>
                                    <th>Tempat</th>
                                    <th>Deskripsi</th>
                                    <th>Kep/Piagam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1;
                                foreach ($prestasi as $ps) : ?>
                                    <tr>
                                        <td class="text-center"><?= $n++; ?></td>
                                        <td><?= $ps['kegiatan']; ?></td>
                                        <td><?= $ps['thn']; ?></td>
                                        <td><?= $ps['tempat']; ?></td>
                                        <td><?= $ps['deskripsi']; ?></td>
                                        <td><?= $ps['kep']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>


        </div>
    </section><!-- End About Section -->

</main><!-- End #main -->