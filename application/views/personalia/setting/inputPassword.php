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
        <div class="card shadow-lg" style="max-width: 600px;">

            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-3">NAMA</div>
                    <div class="col-sm-8"><?= $staff['name']; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-3">EMAIL</div>
                    <div class="col-sm-8"><?= $staff['email']; ?></div>
                </div>
                <form action="<?= base_url('setting/editPassword'); ?>" method="post">
                    <div class="row mb-2">
                        <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                        <div class="col-sm-3">Password Baru</div>
                        <div class="col-sm-7">
                            <input type="text" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-outline-warning">Ubah</button>
                        </div>
                </form>
            </div>

        </div>

</div>


</section>
<!-- /.content -->
</div>