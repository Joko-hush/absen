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
                                <th>PANGKAT</th>
                                <th>JABATAN</th>
                                <th>GOL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1;
                            foreach ($client as $c) : ?>
                                <tr>
                                    <td><?= $a++; ?></td>
                                    <td class="text-left"><?= $c['nama']; ?></td>
                                    <td><?= $c['nip']; ?></td>
                                    <td><?= $c['pangkat']; ?></td>
                                    <td><?= $c['jabatan']; ?></td>
                                    <td><?= $c['gol']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p>Catatan:</p>
                    <ul>
                        <li>Daftar Personil belum terdaftar.</li>
                    </ul>

                </div>
            </div>

        </div>


    </section>
    <!-- /.content -->
</div>