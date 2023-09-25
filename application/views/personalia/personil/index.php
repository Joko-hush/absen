<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul; ?></h1>
                    <?= $this->session->flashdata('message'); ?>

                    <?php unset($_SESSION['message']); ?>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('personalia'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('personalia/user'); ?>">Daftar Personil</a></li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content p-3">
        <div class="card shadow-lg">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover text-center" id="myTable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>NRP/NIP/NIK</th>
                                <th>EMAIL</th>
                                <th>TGL DAFTAR</th>
                                <th>KUALIFIKASI SDM</th>
                                <th>STATUS</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($personil as $p) : ?>
                                <tr>
                                    <td class="text-center"><?= $n++; ?></td>
                                    <td class="text-left">
                                        <a class="text-white" href="<?= base_url('personalia/detailUser') . '?id=' . $p['id']; ?>">
                                            <?= $p['name']; ?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?= $p['nik']; ?></td>
                                    <td class="text-center"><?= $p['email']; ?></td>
                                    <td class="text-center"><?= date('d-m-Y h:i', $p['created_at']); ?></td>
                                    <td class="text-center"><?= $p['kualifikasi_sdm']; ?></td>
                                    <?php if ($p['online'] == 1) : ?>
                                        <td class="text-center"><span class="badge rounded-pill text-bg-success"><i class="fa-solid fa-toggle-on"></i> ONLINE</span></td>
                                    <?php else : ?>
                                        <td class="text-center"><span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-toggle-off"></i> OFFLINE</span></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p>Catatan:</p>
                    <ul>
                        <li>Daftar Personil yang sudah menggunakan aplikasi ini.</li>
                        <li>Klik pada nama untuk melihat detail.</li>
                    </ul>

                </div>
            </div>

        </div>


    </section>
    <!-- /.content -->
</div>