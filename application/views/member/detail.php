<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1><span>Data Keluarga</span></h1>
                <h2><span id="typed"></span></h2>
            </div>
            <div class="mt-3">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>

        <div class="card card-success shadow-lg mt-3">
            <div class="card-header">
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
                <div class="card-footer bg-secondary">

                    <div class="row">
                        <div class="col">
                            <figure>
                                <a href="<?= base_url('assets/img/dosier/') . $kel['doc_aktalahir']; ?>">
                                    <i class="ri-file-paper-line ri-2x"></i>
                                    <figcaption>
                                        <h5>Akta Lahir</h5>
                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                        <div class="col">
                            <figure>
                                <a href="<?= base_url('assets/img/dosier/') . $kel['doc_ktp']; ?>">
                                    <i class="ri-profile-line ri-2x"></i>
                                    <figcaption>
                                        <h5>KTP</h5>
                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                        <div class="col">
                            <figure>
                                <a href="<?= base_url('assets/img/dosier/') . $kel['doc_bpjs']; ?>">
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
        <a class="btn btn-outline-warning mt-2 form-control" href="<?= base_url('keluarga/edit') . '?id=' . $kel['id']; ?>">EDIT DATA</a>

    </div>
</section><!-- End Hero -->