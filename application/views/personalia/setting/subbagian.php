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
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addmodal">
                    Tambah Sub Bagian
                </button>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover" id="myTable">
                        <thead class="text-center">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>BAGIAN</th>
                                <th>BIDANG</th>
                                <th>ESELON</th>
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php $n = 1; ?>
                            <?php foreach ($subbagian as $b) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td>
                                        <?= $b['subbagian']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $b['bagian_id']);
                                        $bid = $this->db->get('m_bagian')->row_array();
                                        $ba = $bid['bagian'];
                                        ?>
                                        <?= $ba; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $b['bidang_id']);
                                        $bid = $this->db->get('m_bidang')->row_array();
                                        $bi = $bid['bidang'];
                                        $this->db->where('id', $b['eselon_id']);
                                        $es = $this->db->get('m_eselon')->row_array();
                                        $e = $es['eselon'];
                                        ?>
                                        <?= $bi; ?>
                                    </td>
                                    <td>
                                        <?= $e; ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin Hapus?')" href="<?= base_url('setting/hapusSubBagian') . '?id=' . $b['id']; ?>">Hapus</a>
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

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addmodalLabel">Form Tambah Bidang Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('setting/masterSubBagian'); ?>" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Sub Bagian</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Sub Bagian" autocomplete="false">
                    </div>
                    <div class="mb-3">
                        <label for="bagian" class="form-label">Nama Bagian</label>
                        <select name="bagian" id="bagian" class="form-control">
                            <option value="">pilih bagian</option>
                            <?php foreach ($bagian as $ba) : ?>
                                <option value="<?= $ba['id'] . ', ' . $ba['bidang_id'] . ', ' . $ba['eselon_id']; ?>"><?= $ba['bagian']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>