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
                        <li class="breadcrumb-item"><a href="<?= base_url('personalia/masterstaff'); ?>">User</a></li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content p-3">
        <div class="card shadow-lg">

            <div class="card-body">
                <div class="row" style="max-width: 540px;">
                    <div class="col-md-4">
                        <figure>
                            <img class="img img-thumbnail img-responsive" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="foto profil">
                        </figure>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nama">Nama</label>
                            </div>
                            <div class="col-sm-8"><?= $user['name']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nama">Email</label>
                            </div>
                            <div class="col-sm-8"><?= $user['email']; ?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
    <!-- /.content -->
</div>