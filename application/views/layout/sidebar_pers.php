<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link" style="text-decoration: none;">
        <img src="<?= base_url('assets/img/Sipetir.png'); ?>" alt="logo doel si petir" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DOEL SI PETIR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/dosier/') . $user['image']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a style="text-decoration: none;" href="<?= base_url('pers/profil'); ?>" class="d-block"><?= $user['name']; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <?php if ($judul == 'Dashboard') : ?>
                        <a href="<?= base_url('personalia/index'); ?>" class="nav-link active">
                        <?php else : ?>
                            <a href="<?= base_url('personalia/index'); ?>" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                            </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('personalia/absensi'); ?>" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>
                            Absensi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <?php if ($judul == 'Absensi') : ?>
                                <a href="<?= base_url('personalia/absensi'); ?>" class="nav-link active" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan semua akun personil yang terdaftar di aplikasi doel si petir">
                                <?php else : ?>
                                    <a href="<?= base_url('personalia/absensi'); ?>" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan semua akun personil yang terdaftar di aplikasi doel si petir">
                                    <?php endif; ?>
                                    <i class="ri-user-heart-line nav-icon"></i>
                                    <p>Daftar Absensi</p>
                                    </a>
                        </li>
                        <li class="nav-item">
                            <?php if ($judul == 'Absensi Perorangan') : ?>
                                <a href="<?= base_url('personalia/absenPerorangan'); ?>" class="nav-link active" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan semua akun personil yang terdaftar di aplikasi doel si petir">
                                <?php else : ?>
                                    <a href="<?= base_url('personalia/absenPerorangan'); ?>" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan semua akun personil yang terdaftar di aplikasi doel si petir">
                                    <?php endif; ?>
                                    <i class="ri-user-heart-line nav-icon"></i>
                                    <p>Absen Perorangan</p>
                                    </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="ri-user-settings-fill nav-icon"></i>
                        <p>
                            Master Personil
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">

                            <a href="<?= base_url('utility/aktifasiEmail'); ?>" class="nav-link active" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan semua akun personil yang terdaftar di aplikasi doel si petir tapi belum konfirmasi email">

                                <i class="fa-solid fa-user-plus"></i>
                                <p>Konfirmasi Email User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php if ($judul == 'Daftar User') : ?>
                                <a href="<?= base_url('personalia/user'); ?>" class="nav-link active" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan semua akun personil yang terdaftar di aplikasi doel si petir">
                                <?php else : ?>
                                    <a href="<?= base_url('personalia/user'); ?>" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan semua akun personil yang terdaftar di aplikasi doel si petir">
                                    <?php endif; ?>
                                    <i class="ri-user-heart-line nav-icon"></i>
                                    <p>Daftar User</p>
                                    </a>
                        </li>
                        <li class="nav-item">
                            <?php if ($judul == 'Personil Dustira') : ?>
                                <a href="<?= base_url('personalia/masterStaff'); ?>" class="nav-link active" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan Daftar personil dari database dasar. Bisa di gunakan untuk membantu user dalam pembuatan akun">
                                <?php else : ?>
                                    <a href="<?= base_url('personalia/masterStaff'); ?>" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan Daftar personil dari database dasar. Bisa di gunakan untuk membantu user dalam pembuatan akun">
                                    <?php endif; ?>
                                    <i class="ri-database-2-fill nav-icon"></i>
                                    <p>Master Personil</p>
                                    </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('personalia/approval'); ?>" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan User yang sudah daftar dan verifikasi email. Memerlukan persetujuan untuk pembuatan akun di aplikasi doel si petir">
                                <i class="ri-checkbox-line nav-icon"></i>
                                <p>Validasi User</p>
                                <span class="right badge badge-warning"><?= $ja; ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('utility/unregistered'); ?>" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Menampilkan User yang sudah daftar dan verifikasi email. Memerlukan persetujuan untuk pembuatan akun di aplikasi doel si petir">
                                <i class="ri-checkbox-line nav-icon"></i>
                                <p>Belum Daftar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon ri-shield-user-line"></i>
                        <p>
                            Setting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ri-user-2-fill nav-icon"></i>
                                <p>Setting Jabatan</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="<?= base_url('setting/masterEselon'); ?>" class="nav-link">
                                        <i class="ri-user-2-fill nav-icon"></i>
                                        <p>Setting Eselon</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('setting/masterBidang'); ?>" class="nav-link">
                                        <i class="ri-user-2-fill nav-icon"></i>
                                        <p>Setting Bidang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('setting/masterBagian'); ?>" class="nav-link">
                                        <i class="ri-user-2-fill nav-icon"></i>
                                        <p>Setting Bagian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('setting/masterSubBagian'); ?>" class="nav-link">
                                        <i class="ri-home-3-line nav-icon"></i>
                                        <p>Setting Sub Bagian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('setting/masterJabatan'); ?>" class="nav-link">
                                        <i class="ri-file-list-line nav-icon"></i>
                                        <p>Setting Jabatan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= base_url('setting/jamKerja'); ?>" class="nav-link">
                                <i class="ri-time-line nav-icon"></i>
                                <p>Setting Jam Kerja</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('setting/ubahPassword'); ?>" class="nav-link">
                                <i class="ri-key-2-line nav-icon"></i>
                                <p>Ubah Password User</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon ri-shield-user-line"></i>
                        <p>
                            User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="<?= base_url('pers/profil'); ?>" class="nav-link">
                                <i class="ri-user-2-fill nav-icon"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('pers/changepassword'); ?>" class="nav-link">
                                <i class="ri-key-2-line nav-icon"></i>
                                <p>Ubah Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                                <i class="ri-logout-circle-r-line nav-icon"></i>
                                <p>Sign Out</p>
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>