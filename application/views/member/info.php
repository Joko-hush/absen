<section id="hero" class="d-flex align-items-center justify-content-center p-3">
    <div class="container mt-5" data-aos="fade-up">


        <div class="mt-3 justify-content-center" data-aos="zoom-in" data-aos-delay="250">

            <div class="icon-box rounded shadow">

                <div class="card shadow rounded">
                    <div class="card-header bg-dark text-warning">
                        <h5>Data Pokok</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <figure class="img-responsive">
                                    <a href="<?= base_url('assets/img/dosier/') . $staff['image']; ?>"><img src="<?= base_url('assets/img/dosier/') . $staff['image']; ?>" alt="foto profil <?= $staff['name']; ?>" class="img rounded" width="214px" height="214px"></a>
                                    <figcaption class="text-center">
                                        <h3><?= $staff['name']; ?></h3>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-md-4 table-responsive">
                                <table class="table text-left table-bordered rounded">
                                    <tr>
                                        <th>Nama</th>
                                        <td><?= $staff['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>NRP/NIP</th>
                                        <td><?= $staff['nik']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pangkat/Gol</th>
                                        <td><?= $staff['pangkat']; ?></td>
                                    </tr>
                                    <?php
                                    $this->db->where('nama', $staff['jabatan']);
                                    $jabStaff = $this->db->get('m_jabatan')->row_array();
                                    $this->db->where('id', $jabStaff['id']);
                                    $jabatan = $this->db->get('m_jabatan')->row_array();

                                    ?>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td><?= $jabatan['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>TMT Jabatan</th>
                                        <?php if ($staff['tmt_jabatan'] == '1900-01-01') : ?>
                                            <td></td>
                                        <?php else : ?>
                                            <td><?= $staff['tmt_jabatan']; ?></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td><?= $staff['kategori']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>TMT Kerja</th>
                                        <td><?= $staff['tmt_kerja']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 table-responsive">
                                <table class="table text-left table-bordered rounded">
                                    <tr>
                                        <th>Agama</th>
                                        <td><?= $staff['agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gol Darah</th>
                                        <td><?= $staff['gol_darah']; ?></td>
                                    </tr>
                                    <?php
                                    list($y, $m, $d) = explode('-', $staff['tgl_lahir']);
                                    $ttl = $d . '-' . $m . '-' . $y;
                                    ?>
                                    <tr>
                                        <th>Tempat/Tgl Lahir</th>
                                        <td><?= $staff['tempat_lahir'] . ', ' . $ttl; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Telp</th>
                                        <td><?= $staff['tlp']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $staff['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. KTP</th>
                                        <?php
                                        $ktp = $this->db->get_where('jb_ktp', ['personil_id' => $staff['id']])->row_array();

                                        ?>
                                        <?php if (!$ktp) : ?>
                                            <td>
                                                <a class="text-dark" href="#">
                                                    -
                                                </a>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <a class="text-dark" href="<?= base_url('assets/img/dosier/') . $ktp['doc']; ?>">
                                                    <?= $staff['ktp']; ?>
                                                </a>
                                            </td>

                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <th>No. BPJS</th>
                                        <?php
                                        $bpjs = $this->db->get_where('jb_bpjs', ['personil_id' => $staff['id']])->row_array();
                                        ?>
                                        <?php if ($bpjs) : ?>
                                            <td>
                                                <a class="text-dark" href="<?= base_url('assets/img/dosier/') . $bpjs['doc']; ?>">
                                                    <?= $staff['bpjs']; ?>
                                                </a>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <a class="text-dark" href="#">
                                                    -
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td><?= $staff['alamat']; ?></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>


            </div>


        </div>

    </div>
</section>