<section id="dosier" class="d-flex align-items-center justify-content-center">
    <div class="container align-middle" data-aos="fade-up">

        <div class="card card-primary mt-5 text-center">
            <div class="card-header">
                <h3>Absensi</h3>
            </div>
            <div class="card-body">
                <div class="mt-3">
                    <?= $this->session->flashdata('message'); ?>
                    <?php unset($_SESSION['message']); ?>
                </div>

                <div class="absen">
                    <form action="<?= base_url('absensi/gantiShift'); ?>" method="post">
                        <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                        <div class="mb-3 animate__animated animate__tada animate__delay-1s">
                            <label for="shift" class="form-label">
                                <h3>
                                    SHIFT KERJA
                                </h3>
                            </label>
                            <div id="text-info" class="form-text">Silahkan pilih sesuai dengan shift kerja Anda saat ini.</div>
                            <select name="shift" class="form-select mt-2" id="shift" aria-describedby="shift">
                                <option value="<?= $staff['jam_kerja_id']; ?>">
                                    <?php
                                    $this->db->where('id', $staff['jam_kerja_id']);
                                    $jam = $this->db->get('jam_kerja')->row_array();
                                    $defaultwaktushift= $jam['nama'] . '( ' . substr($jam['jam_masuk'], 0, 8) . ' - ' . substr($jam['jam_pulang'], 0, 8) . ' )';
                                    echo $defaultwaktushift;
                                    ?>

                                </option>
                                <?php foreach ($shift as $s) : ?>
                                    <option value="<?= $s['id']; ?>"><?= $s['nama'] . ' ( ' . substr($s['jam_masuk'], 0, 8) . ' - ' . substr($s['jam_pulang'], 0, 8) . ' )'; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </form>
                    <div class="row animate__animated animate__backInUp animate__delay-3s">
                        <div class="col-sm-3 mb-2">
                            <!-- <span class="latitude d-none" id="latitude"></span> -->
                            <a href="#" class="btn btn-outline-success shadow-md" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-placement="top" title="Absen Masuk">
                                MASUK
                            </a>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <a href="<?= base_url('absensi/pulang'); ?>" class="btn btn-outline-danger shadow-md" data-bs-toggle="tooltip" data-bs-placement="top" title="absen pulang.">
                                PULANG
                            </a>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <a href="<?= base_url('absensi/ijin'); ?>" class="btn btn-outline-info shadow-md" data-bs-toggle="tooltip" data-bs-placement="top" title="absen jika tidak dapat hadir hari ini.">
                                IJIN/SAKIT
                            </a>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <a href="<?= base_url('absensi/dinasLuar'); ?>" class="btn btn-outline-warning shadow-md" data-bs-toggle="tooltip" data-bs-placement="top" title="absen jika tidak dapat hadir hari ini.">
                                DINAS LUAR
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="riwayat mt-3">
                    <div class="row align-middle">
                        <div class="col-sm-6 text-left">
                            <h5 class="mb-2">Riwayat Absen</h5>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <form action="<?= base_url('absensi/index'); ?>" method="post">
                                <div class="input-group mb-2">
                                    <input type="date" name="date1" class="form-control" aria-describedby="button-addon2" value="<?= $date1; ?>">
                                    <input type="date" name="date2" class="form-control" aria-describedby="button-addon2" value="<?= $date2; ?>">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                                </div>
                            </form>
                        </div><!-- /.col -->
                    </div>

                    <div class="table-responsive">
                        <table id="riwayat_absen" class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam masuk</th>
                                    <th>Jam pulang</th>
                                    <!-- <th>Ket.</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($absen as $a) : ?>
                                    <tr>
                                        <td><?= $a['TGL_MASUK']; ?></td>
                                        <td><?= substr($a['TIME_IN'], 10, 10); ?></td>
                                        <td><?= substr($a['TIME_OUT'], 10, 10); ?></td>
                                        <!-- <td><?= $a['INFO']; ?></td> -->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <h5>Catatan :</h5>
                <p>Jika ada kendala pada saat absen seperti Oops. Itu terjadi karena GPS kurang akurat. Untuk mengatasinya silahkan update aplikasi google maps di perangkat anda. Jika masih belum berhasil, silahkan nyalakan wifi.</p>
            </div>

        </div>


    </div>
</section><!-- End Hero -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Waktu Shift</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('absensi/masuk'); ?>
                <div class="mb-3">
                    <label for="category" class="form-label">Saya yakin waktu shift saya : </label>
                    <div id="waktushiftkonfirmasi"><?php echo $defaultwaktushift; ?></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Yakin</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ganti Waktu Shift</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script> -->
<script>
    var shift = document.getElementById('shift');

    shift.addEventListener('change', () => {
        let a = document.getElementById('shift').value;
        var sel = document.getElementById("shift");
        var text= sel.options[sel.selectedIndex].text;
        document.getElementById('waktushiftkonfirmasi').innerHTML= text;
        // alert(a);
        $.ajax({
            url: "<?= base_url('absensi/gantiShift'); ?>",
            type: 'post',
            data: {
                shift: a
            },
            success: function() {
                alert('Berhasil merubah shift kerja');
            }
        });

    })
</script>