<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </section>

    <section class="content p-3">
        <div class="container" data-aos="fade-up">


            <div class="card card-dark shadow-lg mt-3">
                <div class="card-header text-center">
                    <div class="row">
                        <div class="col">
                            <h5><?= $judul; ?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="mailto:<?= $kel['email']; ?>"><i class="ri-mail-send-fill"></i> <?= $kel['email']; ?></a>
                        </div>
                        <div class="col">
                            <a href="tel:<?= $kel['tlp']; ?>"><i class="ri-phone-line"></i> <?= $kel['tlp']; ?></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table text-left table-bordered">
                            <tr>
                                <th>Hub. Keluarga</th>
                                <td><?= $kel['hub']; ?></td>
                            </tr>
                            <tr>
                                <th>Tempat/Tanggal lahir</th>
                                <td><?= $kel['tempat_lahir'] . ' / ' . $kel['tanggal_lahir']; ?></td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td><?= $kel['agama']; ?></td>
                            </tr>
                            <tr>
                                <th>No. KTP</th>
                                <td><?= $kel['ktp']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?= $kel['alamat']; ?></td>
                            </tr>
                            <tr>
                                <th>No. BPJS</th>
                                <td><?= $kel['bpjs']; ?></td>
                            </tr>
                            <tr>
                                <th>Klinik FKTP</th>
                                <td><?= $kel['fktp']; ?></td>
                            </tr>
                            <tr>
                                <th>Gol Darah</th>
                                <td><?= $kel['gol_darah']; ?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="card-footer bg-secondary text-center">
                        <div class="text-white">Silahkan klik untuk download dokumen.</div>
                        <div class="row">
                            <div class="col">
                                <figure>
                                    <a class="text-warning gallery" href="<?= base_url('assets/img/dosier/') . $kel['doc_aktalahir']; ?>">
                                        <i class="ri-file-paper-line ri-2x"></i>
                                        <figcaption>
                                            <h5>Akta Lahir</h5>
                                        </figcaption>
                                    </a>
                                </figure>
                            </div>
                            <div class="col">
                                <figure>
                                    <a class="text-warning gallery" href="<?= base_url('assets/img/dosier/') . $kel['doc_ktp']; ?>">
                                        <i class="ri-profile-line ri-2x"></i>
                                        <figcaption>
                                            <h5>KTP</h5>
                                        </figcaption>
                                    </a>
                                </figure>
                            </div>
                            <div class="col">
                                <figure>
                                    <a class="text-warning gallery" href="<?= base_url('assets/img/dosier/') . $kel['doc_bpjs']; ?>">
                                        <i class="ri-bank-card-2-line ri-2x"></i>
                                        <figcaption>
                                            <h5>BPJS</h5>
                                        </figcaption>
                                    </a>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>