<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <?= $this->session->flashdata('message'); ?>
        <?php unset($_SESSION['message']); ?>
        <div class="row gy-4 mt-3 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
            <div class="col-xl-2 col-md-4 mx-auto">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('member/fungsional'); ?>">
                        <i class="ri-organization-chart"></i>
                        <h3 class="text-white">
                            Jabatan Fungsional
                        </h3>
                    </a>
                    <br>

                </div>
            </div>
            <div class="col-xl-2 col-md-4 mx-auto">
                <div class="icon-box rounded shadow">
                    <a type="button" href="<?= base_url('member/struktural'); ?>">
                        <i class="ri-node-tree"></i>
                        <h3 class="text-white">
                            Jabatan Struktural
                        </h3>
                    </a>
                    <br>
                </div>
            </div>
            <div class="text-center p-3">
                <a href="<?= base_url('member/inputdata'); ?>" class="btn btn-sm btn-outline-warning mr-3">
                    Kembali ke edit data
                </a>
                <a href="<?= base_url('member/index'); ?>" class="btn btn-sm btn-outline-warning">
                    Kembali ke home
                </a>
            </div>

        </div>
        <div class="icon-box rounded shadow mt-3 pb-5">

            <i class="ri-information-line"></i>
            <h5 class="text-white text-left mt-3">
                <ul>
                    <li>
                        Jabatan Fungsional diisi dengan jabatan di RS DUSTIRA
                    </li>
                    <li>
                        Jabatan Struktural diisi dengan jabatan sesuai Jabatan di Kemhan.
                    </li>
                    <li>
                        KHL tidak perlu mengisi jabatan Struktural.
                    </li>
                </ul>
                </h3>

                <br>
        </div>

    </div>
</section>