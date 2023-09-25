<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </section>

    <section class="content p-3">
        <div class="card shadow-lg">
            <div class="card-header">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav justify-content-center mx-auto">
                            <li class="nav-item"><a class="nav-link" href="#" role="button" onclick="showdapok()">Data Pokok</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" role="button" onclick="showdakel()">Data Keluarga</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" role="button" onclick="showCetak()">Dosier</a></li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="container" id="dapok" style="display: block;">
                        <div class="card card-warning shadow-lg">
                            <div class="card-header">
                                <h5>Data Pokok</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 p-2 text-center">
                                        <figure class="img-responsive mx-auto">
                                            <a href="<?= base_url('assets/img/dosier/') . $personil['image']; ?>">
                                                <img src="<?= base_url('assets/img/dosier/') . $personil['image']; ?>" alt="foto profil <?= $personil['name']; ?>" class="img img-responsive img-thumbnail rounded figure-img mx-auto" width="214px" height="214px">
                                            </a>
                                            <figcaption class="figure-caption">
                                                <h3><?= $personil['name']; ?></h3>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-4 table-responsive">
                                        <table class="table text-left table-bordered rounded">
                                            <tr>
                                                <th>Nama</th>
                                                <td><?= $personil['name']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>NRP/NIP</th>
                                                <td><?= $personil['nik']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Pangkat/Gol</th>
                                                <td><?= $personil['pangkat']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jabatan</th>
                                                <?php
                                                if ($personil['jabatan'] == '') {
                                                    $jab = '';
                                                } else {
                                                    $this->db->select('m_jabatan.nama as nama');
                                                    $this->db->select('m_subbagian.subbagian as sub');
                                                    $this->db->from('m_jabatan');
                                                    $this->db->join('m_subbagian', 'm_subbagian.id = m_jabatan.subbagian_id', 'left');
                                                    $this->db->where('m_jabatan.nama', $personil['jabatan']);
                                                    $jbt = $this->db->get()->row_array();
                                                    $jab = $jbt['nama'] . ' | ' . $jbt['sub'];
                                                }
                                                ?>
                                                <td><?= $jab; ?></td>
                                            </tr>
                                            <tr>
                                                <th>TMT Jabatan</th>
                                                <td><?= $personil['tmt_jabatan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kategori</th>
                                                <td><?= $personil['kategori']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>TMT Kerja</th>
                                                <td><?= $personil['tmt_kerja']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4 table-responsive">
                                        <table class="table text-left table-bordered rounded">
                                            <tr>
                                                <th>Agama</th>
                                                <td><?= $personil['agama']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Gol Darah</th>
                                                <td><?= $personil['gol_darah']; ?></td>
                                            </tr>
                                            <?php
                                            list($y, $m, $d) = explode('-', $personil['tgl_lahir']);
                                            $ttl = $d . '-' . $m . '-' . $y;
                                            ?>
                                            <tr>
                                                <th>Tempat/Tgl Lahir</th>
                                                <td><?= $personil['tempat_lahir'] . ', ' . $ttl; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Telp</th>
                                                <td><?= $personil['tlp']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td><?= $personil['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. KTP</th>
                                                <?php
                                                $ktp = $this->db->get_where('jb_ktp', ['personil_id' => $personil['id']])->row_array();

                                                ?>
                                                <?php if (!$ktp) : ?>
                                                    <td>
                                                        <a class="link-text" href="#">
                                                            -
                                                        </a>
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <a class="link-text" href="<?= base_url('assets/img/dosier/') . $ktp['doc']; ?>">
                                                            <?= $personil['ktp']; ?>
                                                        </a>
                                                    </td>

                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No. BPJS</th>
                                                <?php
                                                $bpjs = $this->db->get_where('jb_bpjs', ['personil_id' => $personil['id']])->row_array();
                                                ?>
                                                <?php if ($bpjs) : ?>
                                                    <td>
                                                        <a class="link-text" href="<?= base_url('assets/img/dosier/') . $bpjs['doc']; ?>">
                                                            <?= $personil['bpjs']; ?>
                                                        </a>
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <a class="link-text" href="#">
                                                            -
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td><?= $personil['alamat']; ?></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-center">Apakah data perlu perbaikan?
                                <a href="<?= base_url('utility/editdapokpersonil') . '?id=' . $personil['id']; ?>" class="btn btn-primary" onclick="return confirm('Apakah Anda akan memperbaiki data user ini?');">
                                    Perbaiki
                                </a>
                                Atau
                                <a href="<?= base_url('utility/nonaktifkanPersonil') . '?id=' . $personil['id']; ?>">Non Aktifkan?</a>
                            </div>

                        </div>
                    </div>
                    <div class="container" id="dakel" style="display: none;">

                        <div class="card card-warning shadow-lg mt-3">
                            <div class="card-header">
                                <h5>Daftar anggota keluarga</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table bordered text-center table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Hubungan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $n = 1; ?>
                                            <?php foreach ($keluarga as $k) : ?>
                                                <tr>
                                                    <td><?= $n++; ?></td>
                                                    <td>
                                                        <a class="text-light" href="<?= base_url('personalia/detailkeluarga') . '?id=' . $k['id']; ?>">
                                                            <?= $k['nama']; ?>
                                                        </a>
                                                    </td>
                                                    <td><?= $k['hub']; ?></td>
                                                    <td>
                                                        <a class="badge badge-warning" href="<?= base_url('keluarga/edit') . '?id=' . $k['id']; ?>">
                                                            Edit
                                                        </a>
                                                        <a class="badge badge-danger" onclick="return confirm('Apakah Anda Yakin??');" href="<?= base_url('keluarga/hapus') . '?id=' . $k['id']; ?>">
                                                            Hapus
                                                        </a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="container" id="showCetak" style="display: none;">
                        <?php
                        if (!$ktp) {
                            $ktp['noktp'] = 'belum upload';
                            $ktp['doc'] = '-';
                        }
                        if (!$bpjs) {
                            $bpjs['bpjs'] = 'belum upload';
                            $bpjs['doc'] = '-';
                        }
                        if (!$npwp) {
                            $npwp['npwp'] = 'belum upload';
                            $npwp['doc'] = '-';
                        }
                        if (!$kk) {
                            $kk['no_kk'] = 'belum upload';
                            $kk['doc'] = '-';
                        }
                        ?>

                        <div class="card card-warning shadow-lg mt-3">
                            <div class="card-header">
                                <h5>Daftar Dosier</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="box p-3 shadow m-2">
                                        <h5>Kartu</h5>
                                        <table class="table table-sm bordered text-center" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>Nama Dok</th>
                                                    <th>No</th>
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>KTP</td>
                                                    <td><?= $ktp['noktp']; ?></td>
                                                    <td>
                                                        <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $ktp['doc']; ?>" target="_blank()">Lihat</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>BPJS</td>
                                                    <td><?= $bpjs['bpjs']; ?></td>
                                                    <td>
                                                        <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $bpjs['doc']; ?>" target="_blank()">Lihat</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kartu Keluarga</td>
                                                    <td><?= $kk['no_kk']; ?></td>
                                                    <td>
                                                        <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $kk['doc']; ?>" target="_blank()">Lihat</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>NPWP</td>
                                                    <td><?= $npwp['npwp']; ?></td>
                                                    <td>
                                                        <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" target="_blank()">Lihat</a>
                                                    </td>
                                                </tr>
                                                <?php if ($personil['pangkat'] = 'KHL') : ?>
                                                    <tr></tr>
                                                <?php elseif ($personil['sex'] == 'L') : ?>
                                                    <tr>
                                                        <td>Karis</td>
                                                        <td><?= $karis['no']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $karis['doc']; ?>" target="_blank()">Lihat</a>
                                                        </td>
                                                    </tr>
                                                <?php else : ?>
                                                    <tr>
                                                        <td>Karsu</td>
                                                        <td><?= $karis['no']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $karis['doc']; ?>" target="_blank()">Lihat</a>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end kartu -->
                                    <div class="box p-3 shadow m-2">
                                        <h5>Sertifikat</h5>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered" id="myTable">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Tahun</th>
                                                        <th>Dokumen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($sertifikat as $se) : ?>
                                                        <tr>
                                                            <td><?= $se['sertifikat']; ?></td>
                                                            <td><?= $se['tgl']; ?></td>
                                                            <td>
                                                                <a href="<?= base_url('asset/img/dosier/') . $se['doc']; ?>" target="_blank()">
                                                                    <i class="fa-solid fa-display-arrow-down"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Pangkat</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Pangkat</th>
                                                    <th>TMT</th>
                                                    <th>No Skep</th>
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rPangkat as $pkt) : ?>
                                                    <tr>
                                                        <td><?= $pkt['pangkat']; ?></td>
                                                        <td><?= $pkt['tmt']; ?></td>
                                                        <td><?= $pkt['no_skep']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $pkt['doc']; ?>" target="_blank()">
                                                                Lihat
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end pangkat -->
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Jabatan Fungsional</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Jabatan</th>
                                                    <th>TMT</th>
                                                    <th>No Skep</th>
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($fungsional as $jf) : ?>
                                                    <tr>
                                                        <td><?= $jf['nama']; ?></td>
                                                        <td><?= $jf['tmt']; ?></td>
                                                        <td><?= $jf['skep']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $jf['doc']; ?>" target="_blank()">
                                                                Lihat
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Jabatan Struktural</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Jabatan</th>
                                                    <th>TMT</th>
                                                    <th>No Skep</th>
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($struktural as $js) : ?>
                                                    <tr>
                                                        <td><?= $jf['nama']; ?></td>
                                                        <td><?= $jf['tmt']; ?></td>
                                                        <td><?= $jf['skep']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $jf['doc']; ?>" target="_blank()">
                                                                Lihat
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Pendidikan Umum</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Jenis Pendidikan</th>
                                                    <th>Nama Sekolah</th>
                                                    <th>Tahun</th>
                                                    <th>Ijazah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dikum as $du) : ?>
                                                    <tr>
                                                        <td><?= $du['jenis_didik']; ?></td>
                                                        <td><?= $du['nama']; ?></td>
                                                        <td><?= $du['thn']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $du['doc']; ?>" target="_blank()">
                                                                Lihat
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end pendidikan umum  -->
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Pendidikan Militer DIKMA/DIKTU/DIKBANGUM</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Jenis Pendidikan</th>
                                                    <th>Tahun</th>
                                                    <th>Prestasi</th>
                                                    <th>Kep.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dikmila as $da) : ?>
                                                    <tr>
                                                        <td><?= $da['nama']; ?></td>
                                                        <td><?= $da['thn']; ?></td>
                                                        <td><?= $da['prestasi']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $da['doc']; ?>" target="_blank()">
                                                                <?= $da['kep']; ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end dikmil a -->
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Pendidikan Militer DIKBANGSPES/DIKJAB/DIKILPENGTEK</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Jenis Pendidikan</th>
                                                    <th>Tahun</th>
                                                    <th>Prestasi</th>
                                                    <th>Kep.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dikmilb as $dmb) : ?>
                                                    <tr>
                                                        <td><?= $dmb['nama']; ?></td>
                                                        <td><?= $dmb['thn']; ?></td>
                                                        <td><?= $dmb['prestasi']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $dmb['doc']; ?>" target="_blank()">
                                                                <?= $dmb['kep']; ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end dikmil -->
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Tugas Operasi</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Nama Operasi</th>
                                                    <th>Tahun</th>
                                                    <th>Prestasi</th>
                                                    <th>Kep.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tugasOperasi as $to) : ?>
                                                    <tr>
                                                        <td><?= $to['nama']; ?></td>
                                                        <td><?= $to['thn']; ?></td>
                                                        <td><?= $to['prestasi']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $to['doc']; ?>" target="_blank()">
                                                                Lihat Dok.
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end tugas Operasi -->
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Tugas Luar Negeri</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Nama Tugas</th>
                                                    <th>Tahun</th>
                                                    <th>Negara</th>
                                                    <th>Prestasi</th>
                                                    <th>Kep.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tugasLn as $tln) : ?>
                                                    <tr>
                                                        <td><?= $tln['nama']; ?></td>
                                                        <td><?= $tln['thn']; ?></td>
                                                        <td><?= $tln['negara']; ?></td>
                                                        <td><?= $tln['prestasi']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $tln['doc']; ?>" target="_blank()">
                                                                Lihat SKEP
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end Tugas luar negeri -->
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Tanda Kehormatan</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Nama Kehormatan</th>
                                                    <th>Tahun</th>
                                                    <th>Prestasi</th>
                                                    <th>Kep.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($TandaKh as $tkh) : ?>
                                                    <tr>
                                                        <td><?= $tkh['nama']; ?></td>
                                                        <td><?= $tkh['thn']; ?></td>
                                                        <td><?= $tkh['prestasi']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $tkh['doc']; ?>" target="_blank()">
                                                                Lihat Dok/Skep.
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end TKH -->
                                    <div class="box p-3 shadow m-2">
                                        <h5>Riwayat Prestasi</h5>
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Nama Kegiatan</th>
                                                    <th>Tahun</th>
                                                    <th>Tempat</th>
                                                    <th>Deskripsi</th>
                                                    <th>Kep.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($prestasi as $pst) : ?>
                                                    <tr>
                                                        <td><?= $pst['kegiatan']; ?></td>
                                                        <td><?= $pst['thn']; ?></td>
                                                        <td><?= $pst['tempat']; ?></td>
                                                        <td><?= $pst['deskripsi']; ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="<?= base_url('assets/img/dosier/') . $pst['doc']; ?>" target="_blank()">
                                                                <?= $pst['kep']; ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end prestasi -->
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- end Dosier -->

                </div>
            </div>

        </div>


    </section>
    <!-- /.content -->
</div>