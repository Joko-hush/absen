<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

        <h1 class="logo me-auto me-lg-0"><a href="<?= base_url('member'); ?>">DOEL SI PETIR<span>.</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="<?= base_url('assets') ?>/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul class="rounded">
                <li><a class=" nav-link scrollto active" href="<?= base_url(); ?>"><i class="ri-home-heart-fill"></i> Home</a></li>
                <!-- <li><a class="nav-link scrollto" href="#about"><i class="ri-information-fill"></i> About</a></li> -->
                <!-- <li><a class="nav-link scrollto " href="#portfolio"><i class="ri-user-2-fill"></i> Portfolio</a></li> -->
                <!-- <li><a class="nav-link scrollto" href="#services"><i class="ri-phone-fill"></i> Contact</a></li> -->
                <li class="dropdown"><a href="#"><i class="ri-shield-user-fill"></i> </i><span>Personal</span> <i class="bi bi-chevron-down"></i></a>
                    <ul class="rounded shadow">
                        <li><a href="<?= base_url('member/rh'); ?>"><i class="ri-file-history-line"></i> Riwayat Hidup</a></li>
                        <li><a href="<?= base_url('member/dosier'); ?>"><i class="ri-folder-shield-line"></i> Dosier</a></li>
                        <li><a href="<?= base_url('keluarga'); ?>"> <i class="ri-parent-fill"></i> Informasi Keluarga</a></li>
                        <!-- <li><a href="#"><i class="ri-profile-line"></i> Kartu Identitas</a></li> -->
                        <!-- <li><a href="<?= base_url('finance'); ?>"><i class="ri-hand-coin-line"></i> Finansial</a> -->
                        </li>

                        <!-- <li><a href="<?= base_url('finance'); ?>"><i class="ri-hand-coin-line"></i> Finansial</a></li> -->

                        <li><a href="<?= base_url('member/inputdata'); ?>"><i class="ri-edit-box-fill"></i> Edit data</a></li>
                        <li><a href="<?= base_url('user/changepassword'); ?>"><i class="ri-key-2-fill"></i> Ubah Password</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">
                        <!-- <img class="img img-thumbnail rounded-circle" width="32" src="<?= base_url('assets/img/dosier/') . $staff['image']; ?>" alt="user"> -->
                        <span><?= $staff['name']; ?></span>
                    </a>


                    <ul class="rounded shadow">
                        <li><a class="nav-link scrollto" href="<?= base_url('logmember'); ?>"><i class="ri-history-line"></i> Log</a></li>
                        <li><a class="nav-link scrollto" href="<?= base_url('auth/logout'); ?>"><i class="ri-logout-circle-r-line"></i> Sign Out</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="<?= base_url('manual_book.pdf'); ?>" target="_blank()" data-bs-toggle="tooltip" title="Download Manual Book">
                        <i class="ri-information-line ri-3x"></i>
                        Manual Book</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <!-- <a href="https://mastersite.my.id/absensi_rsd" class="btn btn-success btn-sm shadow mr-2 text-white">Absen</a> -->

    </div>
</header><!-- End Header -->