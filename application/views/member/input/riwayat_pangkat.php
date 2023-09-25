<section id="dosier" class="d-flex align-items-center justify-content-center">
    <div class="container mt-3" data-aos="fade-up">
        <div class="title">
            <h1><?= $judul; ?></h1>
        </div>

        <?= $this->session->flashdata('message'); ?>
        <?php unset($_SESSION['message']); ?>


        <div class="card card-success shadow-lg mb-5 mt-5">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pangkat</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>

            <div class="card-body">
                <div class="text-left">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#fungsional" class="btn btn-primary mb-2">Tambahkan</a>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Pangkat</th>
                                <th>TMT</th>
                                <th>No. Skep</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kepangkatan as $pkt) : ?>
                                <tr>
                                    <td><?= $pkt['pangkat']; ?></td>
                                    <td><?= $pkt['tmt']; ?></td>
                                    <td><?= $pkt['no_skep']; ?></td>
                                    <td>
                                        <a href="<?= base_url('member/Editkepangkatan/') . '?id=' . $pkt['id']; ?>" class="btn btn-outline-warning">EDIT</a>
                                        <a onclick="return confirm('Apakah Anda Yakin?');" href="<?= base_url('member/hapuskepangkatan/') . '?id=' . $pkt['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin?');">HAPUS</a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="fungsional" tabindex="-1" aria-labelledby="fungsionalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fungsionalLabel">Riwayat Pangkat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="card card-success shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Pangkat</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">

                            <div class="container-fluid p-5">
                                <div class="text-center mb-2">
                                    <h5>Tambahkan Riwayat Pangkat.</h5>
                                </div>
                                <?php echo form_open_multipart('member/pangkat'); ?>
                                <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="pangkat">Pangkat</label></div>
                                    <div class="col-md-8">
                                        <input list="data_pangkat" name="pangkat" id="pangkat" class="form-control">
                                        <datalist id="data_pangkat">
                                            <option value="Jendral">
                                            <option value="Mayjen">
                                            <option value="Letjen">
                                            <option value="Brigjen">
                                            <option value="Kolonel">
                                            <option value="Kolonel (k)">
                                            <option value="Letkol">
                                            <option value="Letkol (k)">
                                            <option value="Mayor">
                                            <option value="Mayor (k)">
                                            <option value="Kapten">
                                            <option value="Kapten (k)">
                                            <option value="Lettu">
                                            <option value="Lettu (k)">
                                            <option value="Letda">
                                            <option value="Letda (k)">
                                            <option value="Peltu">
                                            <option value="Pelda">
                                            <option value="Pelda (k)">
                                            <option value="Peltu (k)">
                                            <option value="Serma">
                                            <option value="Serma (k)">
                                            <option value="Serka">
                                            <option value="Serka (k)">
                                            <option value="Sertu">
                                            <option value="Sertu (k)">
                                            <option value="Serda">
                                            <option value="Serda (k)">
                                            <option value="Kopka">
                                            <option value="Koptu">
                                            <option value="Kopda">
                                            <option value="praka">
                                            <option value="pratu">
                                            <option value="prada">
                                            <option value="PNS IV/D">
                                            <option value="PNS IV/C">
                                            <option value="PNS IV/B">
                                            <option value="PNS IV/A">
                                            <option value="PNS III/D">
                                            <option value="PNS III/C">
                                            <option value="PNS III/B">
                                            <option value="PNS III/A">
                                            <option value="PNS II/D">
                                            <option value="PNS II/C">
                                            <option value="PNS II/B">
                                            <option value="PNS II/A">
                                            <option value="PNS I/D">
                                            <option value="PNS I/C">
                                            <option value="PNS I/B">
                                            <option value="PNS I/A">
                                            <option value="KHL">
                                        </datalist>
                                    </div>
                                </div>
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="tmt">TMT</label></div>
                                    <div class="col-md-8"><input class="form-control" type="date" name="tmt" id="tmt" placeholder="TMT Pangkat"></div>
                                </div>
                                <div class="row form-group mt-3">
                                    <div class="col text-left"><label for="skep">No Skep</label></div>
                                    <div class="col-md-8"><input class="form-control" type="text" name="skep" id="skep" placeholder="Skep Pangkat"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col text-left"><label for="ktp">Upload SKEP</label></div>
                                    <div class="col-md-8"><input class="form-control" type="file" name="image" id="image"></div>
                                </div>

                                <div class="row form-group">
                                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                </div>
                                <div class="row form-group">
                                    <p>* upload skep menggunakan format pdf ukuran tidak boleh lebih dari 5MB.</p>
                                </div>

                                </form>


                            </div>
                        </div>
                    </div>


                    <!-- /.card-body -->
                </div>



            </div>
        </div>
    </div>
</div>