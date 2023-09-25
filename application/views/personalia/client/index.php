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
                                <th>TGL DAFTAR</th>
                                <th>EMAIL</th>
                                <th>STATUS</th>
                                <th>HAPUS</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1;
                            foreach ($client as $c) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $c['name']; ?></td>
                                    <td><?= $c['nik']; ?></td>
                                    <td><?= date('Y-m-d', $c['date_created']); ?></td>
                                    <td><?= $c['email']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('utility/aktivasi') . '?id=' . $c['id']; ?>" id="aktifasi" onclick="return confirm('Anda akan mengaktifkan akun tersebut?');">
                                            <span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-toggle-off"></i> AKTIFKAN?</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('utility/delete') . '?id=' . $c['id']; ?>" id="aktifasi" onclick="return confirm('Anda akan menghapus akun tersebut?');">
                                            <span class="badge rounded-pill text-bg-danger"><i class="fa-regular fa-trash-can"></i> HAPUS</span>
                                        </a>
                                    </td>


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