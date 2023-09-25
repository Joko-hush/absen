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
                        <li class="breadcrumb-item"><a href="<?= base_url('setting'); ?>">Setting</a></li>
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
                    <table class="table table-bordered table-sm table-hover" id="myTable">
                        <thead class="text-center">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($staff as $p) : ?>
                                <tr>
                                    <td class="text-center"><?= $n++; ?></td>
                                    <td>
                                        <?= $p['name']; ?>
                                    </td>
                                    <td>
                                        <?= $p['email']; ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-warning btn-sm" onclick="return confirm('Anda Akan merubah password?')" href="<?= base_url('setting/editPassword') . '?id=' . $p['id']; ?>">EDIT PASSWORD</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>
            </div>

        </div>


    </section>
    <!-- /.content -->
</div>