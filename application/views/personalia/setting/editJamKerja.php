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
                <form action="<?= base_url('setting/EditJamKerja'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $jamKerja['id']; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Jam Kerja</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $jamKerja['nama']; ?>">
                    </div>
                    <label for="time" class="form-label">Jam Kerja</label>
                    <div class="input-group mb-3">
                        <input type="time" class="form-control" name="in" aria-label="masuk" value="<?= substr($jamKerja['jam_masuk'], 0, 5); ?>">
                        <span class="input-group-text">-</span>
                        <input type="time" class="form-control" name="out" aria-label="pulang" value="<?= substr($jamKerja['jam_pulang'], 0, 5); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ket" class="form-label">Keterangan</label>
                        <input type="text" name="ket" class="form-control" id="ket" placeholder="keterangan" value="<?= $jamKerja['ket']; ?>">
                    </div>

            </div>
            <div class="card-footer">
                <a class="btn btn-secondary" href="<?= base_url('setting/jamKerja'); ?>">Close</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>



        </div>

    </section>
    <!-- /.content -->
</div>