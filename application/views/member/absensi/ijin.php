<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">
        <div class="card card-success">
            <div class="card-header text-center p-3">
                <h3>Pengajuan Ijin/Sakit</h3>
                <p>Silahkan klik tambah untuk mengajukan ijin maupun sakit.</p>
            </div>
            <div class="card-body">
                <div class="text-left">
                    <a href="#" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>

                <div class="table-responsive mt-2">
                    <h5>Riwayat Ijin/Sakit</h5>
                    <table class="table table-bordered stripped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dari tanggal</th>
                                <th>Hingga tanggal</th>
                                <th>Ket.</th>
                                <th>Alasan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($ijin as $i) : ?>
                                <?php switch ($i['kategori']) {
                                    case '3':
                                        $i['kategori'] = 'Ijin';
                                        break;

                                    default:
                                        $i['kategori'] = 'Sakit';
                                        break;
                                }
                                ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $i['tgl_masuk']; ?></td>
                                    <td><?= $i['tgl_masuk2']; ?></td>
                                    <td><?= $i['kategori']; ?></td>
                                    <td><?= $i['alasan']; ?></td>
                                    <td><?= $i['status']; ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>



    </div>
</section><!-- End Hero -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengajuan Ijin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('absensi/ijin'); ?>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select name="category" id="category" class="form-control">
                        <option value="3">IJIN</option>
                        <option value="4">SAKIT</option>
                        <option value="5">CUTI</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="tgl" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tgl" name="tgl" value="<?= date('Y-m-d'); ?>">
                </div>
                <div class="mb-6">
                    <label for="tgl2" class="form-label">Hingga tanggal</label>
                    <input type="date" class="form-control" id="tgl2" name="tgl2" value="<?= date('Y-m-d'); ?>">
                </div>
                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan</label>
                    <textarea class="form-control" id="alasan" name="alasan" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Dokumen</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>