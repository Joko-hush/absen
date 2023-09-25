<!-- <section id="topper"></section> -->
<section id="dosier" class="latar">
    <div class="container">



        <div class="card card-success shadow-lg mt-3">
            <div class="card-header">
                <h5 id="card_title">Dosier <?= $staff['name']; ?></h5>
            </div>
            <div class="card-body scrollable">
                <div class="table-responsive">

                    <div class="box p-3 shadow m-2">
                        <h5>Kartu</h5>
                        <div class="table-responsive">
                            <table class="table table-sm bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Nama Dokumen</th>
                                        <th>No</th>
                                        <th>Lihat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>KTP</td>
                                        <td><?= $ktp['noktp']; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $ktp['doc']; ?>" target="_blank()">Lihat</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>BPJS</td>
                                        <td><?= $bpjs['bpjs']; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $bpjs['doc']; ?>" target="_blank()">Lihat</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kartu Keluarga</td>
                                        <td><?= $kk['no_kk']; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $kk['doc']; ?>" target="_blank()">Lihat</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NPWP</td>
                                        <td><?= $npwp['npwp']; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" target="_blank()">Lihat</a>
                                        </td>
                                    </tr>
                                    <?php if ($personil['pangkat'] = 'KHL') : ?>
                                        <tr></tr>
                                    <?php elseif ($personil['sex'] == 'L') : ?>
                                        <tr>
                                            <td>Karis</td>
                                            <td><?= $karis['no']; ?></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $karis['doc']; ?>" target="_blank()">Lihat</a>
                                            </td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td>Karsu</td>
                                            <td><?= $karis['no']; ?></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $karis['doc']; ?>" target="_blank()">Lihat</a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end kartu -->

                    <div class="box p-3 shadow m-2">
                        <h5>Sertifikat</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center" id="myTable">
                                <thead>
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
                                                    <i class="fa-solid fa-display-arrow-down"></i> Lihat
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
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $pkt['doc']; ?>" target="_blank()">
                                                    Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end pangkat -->

                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Jabatan Fungsional
                        </h5>
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $jf['doc']; ?>" target="_blank()">
                                                    Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Jabatan Struktural
                        </h5>
                        <div class="table-responsive">
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
                                            <td><?= $js['nama']; ?></td>
                                            <td><?= $js['tmt']; ?></td>
                                            <td><?= $js['skep']; ?></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $js['doc']; ?>" target="_blank()">
                                                    Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Pendidikan Umum</h5>
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $du['doc']; ?>" target="_blank()">
                                                    Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end pendidikan umum  -->

                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Pendidikan MiliterDIKMA/DIKTU/DIKBANGUM
                        </h5>
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $da['doc']; ?>" target="_blank()">
                                                    <?= $da['kep']; ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end dikmil a -->

                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Pendidikan Militer DIKBANGSPES/DIKJAB/DIKILPENGTEK
                        </h5>
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $dmb['doc']; ?>" target="_blank()">
                                                    <?= $dmb['kep']; ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end dikmil -->

                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Tugas Operasi</h5>
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $to['doc']; ?>" target="_blank()">
                                                    Lihat Dok.
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end tugas Operasi -->

                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Tugas Luar Negeri</h5>
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $tln['doc']; ?>" target="_blank()">
                                                    Lihat SKEP
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end Tugas luar negeri -->

                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Tanda Kehormatan</h5>
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $tkh['doc']; ?>" target="_blank()">
                                                    Lihat Dok/Skep.
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end TKH -->

                    <div class="box p-3 shadow m-2">
                        <h5>Riwayat Prestasi</h5>
                        <div class="table-responsive">
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
                                                <a class="btn btn-success btn-sm" href="<?= base_url('assets/img/dosier/') . $pst['doc']; ?>" target="_blank()">
                                                    <?= $pst['kep']; ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end prestasi -->
                </div>

            </div>
        </div>

    </div>
</section><!-- End Hero -->