<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1><span>Dokumen Elektronik Absensi Personil Dustira<br>
                        (DOELSIPETIR)</span></h1>

                <h2><span id="typed"></span></h2>
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>

            </div>
        </div>

        <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
            <div class="col-xl-2 col-md-4">
                <a href="<?= base_url('absensi'); ?>">
                    <div class="icon-box rounded shadow">
                        <i class="ri-map-pin-user-fill"></i>
                        <h3>Absensi
                        </h3>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-md-4">
                <a href="<?= base_url('member/personal_info'); ?>">
                    <div class="icon-box rounded shadow">
                        <i class="ri-shield-user-fill"></i>
                        <h3>Personal Information
                        </h3>
                    </div>
                </a>
            </div>
            <!-- <div class="col-xl-2 col-md-4">
                <a href="<?= base_url('member/kinerja'); ?>">
                    <div class="icon-box rounded shadow">
                        <i class="ri-shield-user-fill"></i>
                        <h3>
                            Pencapaian Kinerja
                        </h3>
                    </div>
                </a>
            </div> -->


            <div class="col-xl-2 col-md-4">
                <a href="<?= base_url('member/inputdata'); ?>">
                    <div class="icon-box rounded shadow">
                        <i class="ri-edit-box-fill"></i>
                        <h3>
                            Edit Data
                        </h3>
                    </div>
                </a>
            </div>

            <div class="col-xl-2 col-md-4">
                <a href="<?= base_url('sertifikat'); ?>">
                    <div class="icon-box rounded shadow">
                        <i class="ri-article-fill"></i>
                        <h3>
                            Sertifikat
                        </h3>
                    </div>
                </a>
            </div>

        </div>
        <input type="hidden" id="ijin" value="<?= $ijin; ?>">
    </div>
</section><!-- End Hero -->

</main><!-- End #main -->