<section id="dosier" class="latar">
    <div class="container">
        <div class="card card-success mt-3">
            <div class="card-header">
                <h5>Edit Sertifikat</h5>
            </div>
            <div class="card-body">

                <?php echo form_open_multipart('sertifikat/edit'); ?>
                <input type="hidden" name="personil_id" value="<?= $staff['id']; ?>">
                <input type="hidden" name="id" value="<?= $cert['id']; ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Sertifikat</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $cert['sertifikat']; ?>">
                </div>
                <div class="mb-3">
                    <label for="tgl" class="form-label">Tanggal</label>
                    <input type="date" name="tgl" class="form-control" id="tgl" value="<?= $cert['tgl']; ?>">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload File</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            list($nama, $ext) = explode('.', $cert['doc']);
                            $ext = trim($ext);
                            if ($ext == 'pdf') {
                                $doc = 'pdf_icon.png';
                            } else {
                                $doc = $cert['doc'];
                            }
                            ?>
                            <figure>
                                <a href="<?= base_url('assets/img/dosier/') . $cert['doc']; ?>" target="_blank()">
                                    <img class="img img-thumbnail img-responsive" src="<?= base_url('assets/img/dosier/') . $doc; ?>" alt="Sertifikat">
                                    <figcaption class="text-center text-dark">Sertifikat tersimpan</figcaption>
                                </a>
                            </figure>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" name="image" type="file" id="image">
                        </div>

                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="<?= base_url('sertifikat'); ?>" class="btn btn-secondary">Close</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</section>