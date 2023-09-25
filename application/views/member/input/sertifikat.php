<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">

            <div class="mt-3">
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        </div>



        <div class="card card-success shadow-lg">
            <div class="card-header">
                <h3 class="card-title"><?= $judul; ?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="deskripsi text-center">
                    <p>Disini kumpulan sertifikat yang diperlukan dalam kegiatan dalam pekerjaan dibagian masing - masing. Terutama STR dan SIP.</p>
                </div>
                <div class="button text-left">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                    </button>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-sm table-bordered" id="myTable4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sertifikat</th>
                                <th>Tahun Perolehan</th>
                                <th>Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1;
                            foreach ($sertifikat as $s) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $s['sertifikat']; ?></td>
                                    <td><?= $s['tgl']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" onclick="return confirm('Anda akan melakukan edit data?')" href="<?= base_url('sertifikat/edit') . '?id=' . $s['id']; ?>">
                                            Edit
                                        </a> |
                                        <a class="btn btn-sm btn-danger" onclick="return confirm('Anda akan melakukan hapus data?')" href="<?= base_url('sertifikat/hapus') . '?id=' . $s['id']; ?>">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-left">
                <h5>Catatan:</h5><br>
                <ul>
                    <li>Sebaiknya dokumen sertifikat yang disimpan hasil scan dari yang asli, bukan fotokopi.</li>
                    <li>maksimal dokumen 5MB</li>
                    <li>Format dokumen sebaiknya PDF. Format lain yang masih didukung jpg, jpeg, png.</li>
                </ul>
            </div>
        </div>


    </div>
</section><!-- End Hero -->



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Sertifikat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('sertifikat/index'); ?>
                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Sertifikat</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama sertifikat">
                </div>
                <div class="mb-3">
                    <label for="tgl" class="form-label">Tanggal</label>
                    <input type="date" name="tgl" class="form-control" id="tgl" placeholder="tanggal Sertifikat">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload File</label>
                    <input class="form-control" name="image" type="file" id="image">
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