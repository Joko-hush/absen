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
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content p-3">
        <div class="card shadow-lg">
            <div class="card-header text-center">
                <h3>Daftar Personil dari database Manual</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah <i class="fas fa-person-circle-plus"></i>
                    </button>
                    <table class="table table-bordered table-sm" id="myTable">
                        <thead class="text-center">
                            <tr>
                                <th>NO</th>
                                <th>NOMOR NRP/NIP/NIK</th>
                                <th>NAMA</th>
                                <th>PANGKAT</th>
                                <th>JABATAN</th>
                                <th>KET</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($staff as $s) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td data-bs-toggle="tooltip" data-bs-placement="top" title="Jika no Nrp/Nip/Nik ini kosong silahkan di lengkapi. Karena jika kosong tidak dapat membuat akun di aplikasi Doel si petir"><?= $s['nip']; ?></td>
                                    <td><?= $s['nama']; ?></td>
                                    <td><?= $s['pangkat']; ?></td>
                                    <td><?= $s['jabatan']; ?></td>
                                    <td><?= $s['ket']; ?></td>

                                    <td>
                                        <a href="<?= base_url('personalia/detailStaff') . '?id=' . $s['id']; ?>" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Untuk melihat detail dan mengubah data">Lihat/Ubah</a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card-footer">
                <p><strong>*</strong> Untuk menambahkan Personil Silahkan gunakan Aplikasi Simrs.<br><strong>*</strong> Disini dapat melakukan edit data personil untuk melengkapi data pokok.</p>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Personil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('personalia/masterStaff'); ?>" method="post">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="nip">No Nrp/Nip/Nik</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="nip" id="nip">
                            </div>
                        </div>
                        <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="nama">Nama Lengkap</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="nama" id="nama">
                            </div>
                        </div>
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="gol">Golongan</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="gol" id="gol">
                                    <option value=""></option>
                                    <option value="KHL Medis">TNI</option>
                                    <option value="KHL Paramedis">PNS</option>
                                    <option value="KHL Non Paramedis">KHL</option>
                                </select>

                            </div>
                        </div>
                        <?= form_error('gol', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="pangkat">Pangkat</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="pangkat" id="pangkat">
                            </div>
                        </div>
                        <?= form_error('pangkat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="jabatan">Jabatan</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="jabatan" id="jabatan">
                            </div>
                        </div>
                        <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="ket">Ket.</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="ket" id="ket">
                            </div>
                        </div>
                        <?= form_error('ket', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Silahkan pilih</option>

                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>

                            </div>
                        </div>
                        <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="pendidikan">Pendidikan</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="pendidikan" id="pendidikan">
                            </div>
                        </div>
                        <?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="ttl">Tanggal Lahir</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="date" name="tanggallahir" aria-label="Tanggal lahir" class="form-control" placeholder="Silahkan input tanggal lahir">
                                </div>
                            </div>
                        </div>

                        <?= form_error('tanggallahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="kualifikasi">Kualifikasi</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="kualifikasi" id="kualifikasi">
                                    <option value=""></option>
                                    <option value="KHL Medis">KHL Medis</option>
                                    <option value="KHL Paramedis">KHL Paramedis</option>
                                    <option value="KHL Non Paramedis">KHL Non Paramedis</option>
                                </select>

                            </div>
                        </div>
                        <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="tmt">TMT</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="date" name="tmt" aria-label="Tanggal lahir" class="form-control" placeholder="Silahkan input tmt">
                                </div>
                            </div>
                        </div>

                        <?= form_error('tmt', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4 text-end">
                            </div>
                            <div class="col-sm-8 p-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="aktif" checked>
                                    <label class="form-check-label" for="flexCheckDefault" data-bs-toggle="tooltip" data-bs-placement="top" title="Jangan di checklist jika ingin menonaktifkan">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button onclick="return confirm('Apakah Anda yakin untuk menyimpan perubahan data ini?');" class="btn btn-warning" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>