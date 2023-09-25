<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="card card-success shadow-lg mt-3">
            <div class="card-header">
                <h5>Daftar Kinerja</h5>
                <p><?= $staff['name']; ?></p>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <a class="btn btn-primary btn-sm mb-3" type="button" data-bs-toggle="modal" data-bs-target="#card">
                            <i class="ri-user-add-line"></i> Tambah
                        </a>
                    </div>
                    <div class="col-md-6 flex-end">
                        <form action="<?= base_url('member/kinerja'); ?>" method="post">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" placeholder="Dari Tanggal" aria-label="dariTanggal" id="date1" name="date1" value="<?= set_value('date1'); ?>">
                                <span class="input-group-text">s.d</span>
                                <input type="date" class="form-control" placeholder="Sampai Tanggal" aria-label="sampaiTanggal" id="date2" name="date2" value="<?= set_value('date2'); ?>">
                                <button class="btn btn-outline-success" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center table-sm table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sasaran Kegiatan</th>
                                <th>Output</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                                <th>Keterangan</th>
                                <th>Dokumen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($kinerja as $k) : ?>
                                <tr>
                                    <td>

                                        <?= $n++; ?>
                                    </td>
                                    <?php
                                    $db2 = $this->load->database('staff', true);
                                    $db2->where('KDITEMPENCAPAIN', $k['KDITEMPENCAPAIN']);
                                    $kegiatan = $db2->get('M_ITEMPENCAPAIAN')->row_array();
                                    $keg = $kegiatan['KEGIATAN'];

                                    ?>
                                    <td><?= $keg; ?></td>
                                    <td><?= $k['OUTPUT'] ?></td>
                                    <td><?= $k['VOLUME'] ?></td>
                                    <td><?= $k['SATUAN'] ?></td>
                                    <td><?= $k['KETERANGAN'] ?></td>
                                    <td>
                                        <a class="btn btn-outline-success btn-sm" href="<?= base_url('assets/dosier/') . $k['UPLOADDOKUMEN']; ?>">
                                            Unduh
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-warning btn-sm" href="<?= base_url('member/editkinerja') . '?id=' . $k['KDKINERJAPENCAPAIN']; ?>">Edit</a>
                                        <a class="btn btn-outline-danger btn-sm" href="<?= base_url('member/hapuskinerja') . '?id=' . $k['KDKINERJAPENCAPAIN']; ?>" onclick="return confirm('Apakah Anda Yakin Akan menghapus?');">Hapus</a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Jumlah Volume</td>
                                <td>

                                    <?= $sum["sum(VOLUME)"]; ?>
                                </td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </div>



    </div>
</section><!-- End Hero -->

</main><!-- End #main -->

<div class="modal fade" id="card" tabindex="-1" aria-labelledby="cardLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardLabel">Kinerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2">
                    <h5>Silahkan isi data.</h5>
                </div>
                <?php echo form_open_multipart('member/tambahKinerja'); ?>
                <input type="hidden" name="id" value="<?= $staff['KDSTAFF']; ?>">
                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="date">Tanggal</label></div>
                    <div class="col-md-8"><input class="form-control" type="date" name="date" id="date" value="<?= date('Y-m-d'); ?>"></div>
                </div>

                <div class="row form-group mt-3">
                    <div class="col text-left"><label for="kegiatan">Kegiatan</label></div>
                    <div class="col-md-8">
                        <select name="kegiatan" id="kegiatan" onchange="check(this)" class="form-control">
                            <option value="">-</option>
                            <?php foreach ($item as $i) : ?>

                                <option value="<?= $i['KDITEMPENCAPAIN'] . '"' . 'data-satuan="' . $i['SATUAN'] . '" data-volume="' . $i['VOLUME']; ?>"><?= $i['KEGIATAN']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="row form-group mt-3">
                        <div class="col text-left"><label for="output">Output</label></div>
                        <div class="col-md-8"><textarea class="form-control" type="text" name="output" id="output"></textarea></div>
                    </div>
                    <div class="row form-group mt-3">
                        <div class="col text-left"><label for="volume">Volume</label></div>
                        <div class="col-md-8">
                            <input onchange="checkvolume(this)" class="form-control" type="text" name="volume" id="volume">
                            <input class="form-control" type="hidden" name="volume2" id="volume2">
                        </div>
                    </div>
                    <div class="row form-group mt-3">
                        <div class="col text-left"><label for="satuan">Satuan</label></div>
                        <div class="col-md-8"><input class="form-control" type="text" name="satuan" id="satuan" readonly></div>
                    </div>
                    <div class="row form-group mt-3">
                        <div class="col text-left"><label for="ket">Keterangan</label></div>
                        <div class="col-md-8"><input class="form-control" type="text" name="ket" id="ket"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col text-left"><label for="image">Upload Dokumen</label></div>
                        <div class="col-md-8"><input class="form-control" type="file" name="image" id="image"></div>
                    </div>
                    <div class="row form-group">
                        <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>