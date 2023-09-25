<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url(); ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('MANUAL_BOOK_PERSONALIA.pdf'); ?>" class="nav-link" target:"_blank">Download Petunjuk</a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="badge badge-warning navbar-badge">
                    <i class="far fa-bell"></i>
                    <?= $ja + $ket_absen; ?>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('personalia/approval'); ?>" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> <?= $ja; ?> Persetujuan user
                    <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
                </a>
                <div class="dropdown-divider"></div>
                <span class="dropdown-item dropdown-header">Absensi</span>
                <a href="<?= base_url('approval/ijin'); ?>" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i>Ijin/Sakit
                    <span class="float-right text-muted text-sm"><?= $ket_absen; ?> ket.</span>
                </a>

            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-info btn-sm" href="<?= base_url('sendInformasiAbsensi/reminderAbsenMasuk'); ?>">
                Ingatkan Absen
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
</nav>
<!-- /.navbar -->