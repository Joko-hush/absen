  <?php
    if (!$kartuKtp['doc']) {
        $namaFileKtp = '';
        $extKtp = '';
    } else {

        list($namaFileKtp, $extKtp) = explode('.', $kartuKtp['doc']);
    }
    if (!$npwp['doc']) {
        $namaFileNpwp = '';
        $extNpwp = '';
    } else {

        list($namaFileNpwp, $extNpwp) = explode('.', $npwp['doc']);
    }
    if (!$kartuBpjs['doc']) {
        $namaFileBpjs = '';
        $extBpjs = '';
    } else {

        list($namaFileBpjs, $extBpjs) = explode('.', $kartuBpjs['doc']);
    }
    if (!$kk['doc']) {
        $namaFilekk = '';
        $extkk = '';
    } else {
        list($namaFilekk, $extkk) = explode('.', $kk['doc']);
    }
    if (!$kartuKaris['doc']) {
        $namaFileKaris = '';
        $extKaris = '';
    } else {
        list($namaFileKaris, $extKaris) = explode('.', $kartuKaris['doc']);
    }
    ?>
  <section id="hero" class="d-flex align-items-center justify-content-center">
      <div class="container" data-aos="fade-up">

          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
              <div class="col-xl-6 col-lg-8">
                  <h1><span>Kartu Tersimpan</span></h1>
                  <div class="mt-3">
                      <?= $this->session->flashdata('message'); ?>
                      <?php unset($_SESSION['message']); ?>
                  </div>
              </div>
          </div>
          <div class="row gy-4 mt-3 justify-content-center" data-aos="zoom-in" data-aos-delay="250">

              <div class="col-xl-2 col-md-4">
                  <div class="icon-box rounded shadow">
                      <a type="button" href="<?= base_url('assets/img/dosier/') . $kartuKtp['doc']; ?>" target="_blank()">
                          <?php if ($extKtp == 'pdf') : ?>
                              <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="ktp" class="img img-thumbnail img-responsive">
                          <?php elseif ($extKtp == '') : ?>
                              <i class="fa-solid fa-triangle-exclamation"></i>
                          <?php else : ?>
                              <img src="<?= base_url('assets/img/dosier/') . $kartuKtp['doc']; ?>" alt="ktp" class="img img-thumbnail img-responsive">
                          <?php endif; ?>
                          <h3 class="text-white">
                              KTP
                          </h3>
                      </a>
                  </div>
              </div>
              <div class="col-xl-2 col-md-4">
                  <div class="icon-box rounded shadow">
                      <a type="button" href="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" target="_blank()">
                          <?php if ($extNpwp == 'pdf') : ?>
                              <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="npwp" class="img img-thumbnail img-responsive">
                          <?php elseif ($extNpwp == '') : ?>
                              <i class="fa-solid fa-triangle-exclamation"></i>
                          <?php else : ?>
                              <img src="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" alt="npwp" class="img img-thumbnail img-responsive">
                          <?php endif; ?>
                          <h3 class="text-white">
                              Kartu NPWP
                          </h3>
                      </a>
                  </div>
              </div>
              <div class="col-xl-2 col-md-4">
                  <div class="icon-box rounded shadow">
                      <a type="button" href="<?= base_url('assets/img/dosier/') . $kartuBpjs['doc']; ?>" target="_blank()">
                          <?php if ($extBpjs == 'pdf') : ?>
                              <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="bpjs" class="img img-thumbnail img-responsive">
                          <?php elseif ($extBpjs == '') : ?>
                              <i class="fa-solid fa-triangle-exclamation"></i>
                          <?php else : ?>
                              <img src="<?= base_url('assets/img/dosier/') . $kartuBpjs['doc']; ?>" alt="bpjs" class="img img-thumbnail img-responsive">
                          <?php endif; ?>
                          <h3 class="text-white">
                              Kartu BPJS
                          </h3>
                      </a>
                  </div>
              </div>
              <div class="col-xl-2 col-md-4">
                  <div class="icon-box rounded shadow">
                      <a type="button" href="<?= base_url('assets/img/dosier/') . $kk['doc']; ?>" target="_blank()">
                          <?php if ($extkk == 'pdf') : ?>
                              <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="Kartu Keluarga" class="img img-thumbnail img-responsive">
                          <?php elseif ($extkk == '') : ?>
                              <i class="fa-solid fa-triangle-exclamation"></i>
                          <?php else : ?>
                              <img src="<?= base_url('assets/img/dosier/') . $kk['doc']; ?>" alt="Kartu Keluarga" class="img img-thumbnail img-responsive">
                          <?php endif; ?>
                          <h3 class="text-white">
                              Kartu Keluarga
                          </h3>
                      </a>
                  </div>
              </div>
              <div class="col-xl-2 col-md-4">
                  <div class="icon-box rounded shadow">
                      <a type="button" href="<?= base_url('assets/img/dosier/') . $kartuKaris['doc']; ?>" target="_blank()">
                          <?php if ($extKaris == 'pdf') : ?>
                              <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="Anda belum Upload Kartu Karis/Karsu" class="img img-thumbnail img-responsive">
                          <?php elseif ($extKaris == '') : ?>
                              <i class="fa-solid fa-triangle-exclamation"></i>
                          <?php else : ?>
                              <img src="<?= base_url('assets/img/dosier/') . $kartuKaris['doc']; ?>" alt="Anda belum Upload Kartu Karis/Karsu" class="img img-thumbnail img-responsive">
                          <?php endif; ?>
                          <h3 class="text-white">
                              Kartu Karis/Karsu
                          </h3>
                      </a>
                  </div>
              </div>

          </div>
          <div class="icon-box rounded shadow mt-3 pb-5">

              <i class="ri-information-line"></i>
              <br>
              <h5 class="text-white">
                  <i class="fa-solid fa-triangle-exclamation"></i>
                  Artinya kartu belum tersimpan. Silahkan tambahkan dengan menekan tombol di bawah.
              </h5>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  TAMBAH/EDIT KARTU
              </button>
          </div>

      </div>
  </section>




  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="exampleModalLabel">FORM TAMBAH & EDIT KARTU</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row form-group mt-1 mb-3">
                      <div class="col text-left"><label for="pilihKartu">JENIS KARTU</label></div>
                      <div class="col-md-10">
                          <select name="pilihKartu" id="pilihKartu" class="form-control">
                              <option value="">SILAHKAN PILIH KARTU YANG INGIN DITAMBAHKAN</option>
                              <option value="KTP">KTP</option>
                              <option value="NPWP">NPWP</option>
                              <option value="BPJS">BPJS</option>
                              <option value="KARTU KELUARGA">KARTU KELUARGA</option>
                              <option value="KARIS">KARIS/KARSU</option>
                          </select>
                      </div>
                      <div class="mt-3">
                          <div class="col-md-12">
                              <div class="card card-success shadow-lg mb-3" id="ktp">
                                  <div class="card-header">
                                      <h3 class="card-title">Input KTP</h3>

                                      <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                          </button>
                                      </div>
                                      <!-- /.card-tools -->
                                  </div>

                                  <div class="card-body">
                                      <div class="text-center mb-2">
                                          <h5>Isi data KTP</h5>
                                      </div>
                                      <?php echo form_open_multipart('member/ktp'); ?>
                                      <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                                      <div class="row form-group mt-3">
                                          <div class="col text-left"><label for="no">No. KTP</label></div>
                                          <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no KTP" value="<?= $kartuKtp['noktp']; ?>"></div>
                                      </div>
                                      <div class="row form-group">
                                          <div class="col text-left"><label for="ktp">Upload Kartu</label></div>
                                          <?php
                                            if (!$kartuKtp['doc']) {
                                                $namaFileKtp = '';
                                                $extKtp = '';
                                            } else {

                                                list($namaFileKtp, $extKtp) = explode('.', $kartuKtp['doc']);
                                            }
                                            ?>
                                          <?php if ($extKtp == 'pdf') : ?>
                                              <div class="col-md-4 text-center">
                                                  <a href="<?= base_url('assets/img/dosier/') . $kartuKtp['doc']; ?>" target="_blank()">
                                                      <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="ktp" class="img img-thumbnail img-responsive">
                                                  </a>
                                              </div>
                                          <?php else : ?>
                                              <div class="col-md-4 text-center">
                                                  <a href="<?= base_url('assets/img/dosier/') . $kartuKtp['doc']; ?>" target="_blank()">
                                                      <img src="<?= base_url('assets/img/dosier/') . $kartuKtp['doc']; ?>" alt="ktp" class="img img-thumbnail img-responsive">
                                                  </a>
                                              </div>
                                          <?php endif; ?>
                                          <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                                      </div>
                                      <div class="row form-group">
                                          <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                      </div>

                                      </form>
                                  </div>
                              </div>
                              <!-- /.card-header -->

                              <!-- /.card-body -->
                          </div>
                          <div class="col-md-12">
                              <div class="card card-success shadow-lg mb-3" id="npwp">
                                  <div class="card-header">
                                      <h3 class="card-title">Input Kartu NPWP</h3>

                                      <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                          </button>
                                      </div>
                                      <!-- /.card-tools -->
                                  </div>

                                  <div class="card-body">
                                      <div class="text-center mb-2">
                                          <h5>Isi data NPWP</h5>
                                      </div>
                                      <?php echo form_open_multipart('member/npwp'); ?>
                                      <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                                      <div class="row form-group mt-3">
                                          <div class="col text-left"><label for="no">No. NPWP</label></div>
                                          <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no npwp" value="<?= $npwp['npwp']; ?>"></div>
                                      </div>
                                      <?php
                                        if (!$npwp['doc']) {
                                            $namaFileNpwp = '';
                                            $extNpwp = '';
                                        } else {

                                            list($namaFileNpwp, $extNpwp) = explode('.', $npwp['doc']);
                                        }
                                        ?>
                                      <div class="row form-group">
                                          <div class="col text-left"><label for="image">Upload Kartu</label></div>
                                          <?php if ($extNpwp == 'pdf') : ?>
                                              <a href="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" target="_blank()">
                                                  <div class="col-md-4 text-center">
                                                      <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" alt="npwp" class="img img-thumbnail img-responsive">
                                                  </div>
                                              </a>
                                          <?php else : ?>
                                              <div class="col-md-4 text-center">
                                                  <a href="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" target="_blank()">
                                                      <img src="<?= base_url('assets/img/dosier/') . $npwp['doc']; ?>" class="img img-thumbnail img-responsive">
                                                  </a>
                                              </div>
                                          <?php endif; ?>
                                          <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                                      </div>
                                      <div class="row form-group">
                                          <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                      </div>

                                      </form>
                                  </div>
                              </div>
                              <!-- /.card-header -->

                              <!-- /.card-body -->
                          </div>
                          <div class="col-md-12">
                              <div class="card card-success shadow-lg mb-3" id="bpjs">
                                  <div class="card-header">
                                      <h3 class="card-title">Input Kartu BPJS</h3>

                                      <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                          </button>
                                      </div>
                                      <!-- /.card-tools -->
                                  </div>
                                  <?php
                                    if (!$kartuBpjs['doc']) {
                                        $namaFileBpjs = '';
                                        $extBpjs = '';
                                    } else {

                                        list($namaFileBpjs, $extBpjs) = explode('.', $kartuBpjs['doc']);
                                    }
                                    ?>

                                  <div class="card-body">
                                      <div class="text-center mb-2">
                                          <h5>BPJS Kesehatan</h5>
                                      </div>
                                      <?php echo form_open_multipart('member/bpjs'); ?>
                                      <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                                      <div class="row form-group mt-3">
                                          <div class="col text-left"><label for="no">No. bpjs</label></div>
                                          <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no BPJS" value="<?= $kartuBpjs['bpjs']; ?>"></div>
                                      </div>
                                      <div class="row form-group mt-3">
                                          <div class="col text-left"><label for="fktp">FKTP</label></div>
                                          <div class="col-md-8"><input class="form-control" type="text" name="fktp" id="fktp" placeholder="KLINIK FKTP" value="<?= $kartuBpjs['fktp']; ?>"></div>
                                      </div>
                                      <div class="row form-group">
                                          <div class="col text-left"><label for="image">Upload Kartu</label></div>
                                          <?php if ($extBpjs == 'pdf') : ?>
                                              <div class="col-md-4 text-center">
                                                  <a href="<?= base_url('assets/img/dosier/') . $kartuBpjs['doc']; ?>" target="_blank()">
                                                      <img src="<?= base_url('assets/img/dosier/') . 'pdf_icon.png'; ?>" class="img img-thumbnail img-responsive" alt="dokumen">
                                                  </a>
                                              </div>
                                          <?php else : ?>
                                              <div class="col-md-4 text-center">
                                                  <a href="<?= base_url('assets/img/dosier/') . $kartuBpjs['doc']; ?>" target="_blank()">
                                                      <img src="<?= base_url('assets/img/dosier/') . $kartuBpjs['doc']; ?>" class="img img-thumbnail img-responsive" alt="dokumen">
                                                  </a>
                                              </div>
                                          <?php endif; ?>

                                          <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                                      </div>
                                      <div class="row form-group">
                                          <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                      </div>

                                      </form>
                                  </div>
                              </div>
                              <div class="card card-success shadow-lg mb-3" id="kk">
                                  <div class="card-header">
                                      <h3 class="card-title">Input Kartu Keluarga</h3>

                                      <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                          </button>
                                      </div>
                                      <!-- /.card-tools -->
                                  </div>

                                  <div class="card-body">
                                      <div class="text-center mb-2">
                                          <h5>Kartu Keluarga</h5>
                                      </div>
                                      <?php echo form_open_multipart('member/kk'); ?>
                                      <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                                      <div class="row form-group mt-3">
                                          <div class="col text-left"><label for="no">No. Kartu Keluarga</label></div>

                                          <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no kk" value="<?= $kk['no_kk']; ?>"></div>
                                      </div>
                                      <?php
                                        if (!$kk['doc']) {
                                            $namaFilekk = '';
                                            $extkk = '';
                                        } else {
                                            list($namaFilekk, $extkk) = explode('.', $kk['doc']);
                                        }

                                        ?>
                                      <div class="row form-group">
                                          <div class="col text-left"><label for="image">Upload Kartu</label></div>
                                          <?php if ($extkk == 'pdf') : ?>
                                              <div class="col-md-4 text-center">
                                                  <a href="<?= base_url('assets/img/dosier/') .  $kk['doc']; ?>" target="_blank()">
                                                      <img src="<?= base_url('assets/img/dosier/') .  'pdf_icon.png'; ?>" class="img img-thumbnail img-responsive">
                                                  </a>
                                              </div>
                                          <?php else : ?>
                                              <div class="col-md-4 text-center">
                                                  <a href="<?= base_url('assets/img/dosier/') .  $kk['doc']; ?>" target="_blank()">
                                                      <img src="<?= base_url('assets/img/dosier/') .  $kk['doc']; ?>" class="img img-thumbnail img-responsive">
                                                  </a>
                                              </div>
                                          <?php endif; ?>

                                          <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                                      </div>
                                      <div class="row form-group">
                                          <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                      </div>

                                      </form>
                                  </div>
                                  <?php if ($staff['pangkat'] !== ' KHL') : ?>
                                      <div class="card card-success shadow-lg mb-3" id="karis">
                                          <div class="card-header">
                                              <h3 class="card-title">Input Kartu Istri/Suami</h3>

                                              <div class="card-tools">
                                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                  </button>
                                              </div>
                                              <!-- /.card-tools -->
                                          </div>

                                          <div class="card-body">
                                              <div class="text-center mb-2">
                                                  <h5>KARIS/KARSU</h5>
                                              </div>
                                              <?php
                                                if (!$kartuKaris['doc']) {
                                                    $namaFileKaris = '';
                                                    $extKaris = '';
                                                } else {
                                                    list($namaFileKaris, $extKaris) = explode('.', $kartuKaris['doc']);
                                                }
                                                ?>
                                              <?php echo form_open_multipart('member/karis'); ?>
                                              <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                                              <div class="row form-group mt-3">
                                                  <div class="col text-left"><label for="no">No. Kartu Istri/Suami</label></div>
                                                  <div class="col-md-8"><input class="form-control" type="text" name="no" id="no" placeholder="Masukan no karis/karsu" value="<?= $kartuKaris['no']; ?>"></div>
                                              </div>
                                              <div class="row form-group">
                                                  <div class="col text-left"><label for="image">Upload Kartu</label></div>
                                                  <?php if ($extKaris == 'pdf') : ?>
                                                      <div class="col-md-4 text-center">
                                                          <a href="<?= base_url('assets/img/dosier/') .  $kartuKaris['doc']; ?>" target="_blank()">
                                                              <img src="<?= base_url('assets/img/dosier/') .  'pdf_icon.png'; ?>" class="img img-thumbnail img-responsive">
                                                          </a>
                                                      </div>
                                                  <?php else : ?>
                                                      <div class="col-md-4 text-center">
                                                          <a href="<?= base_url('assets/img/dosier/') .  $kartuKaris['doc']; ?>" target="_blank()">
                                                              <img src="<?= base_url('assets/img/dosier/') .  $kartuKaris['doc']; ?>" class="img img-thumbnail img-responsive">
                                                          </a>
                                                      </div>
                                                  <?php endif; ?>
                                                  <div class="col-md-4"><input class="form-control" type="file" name="image" id="image"></div>
                                              </div>
                                              <div class="row form-group">
                                                  <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                              </div>

                                              </form>
                                          </div>
                                      </div>
                                  <?php else : ?>
                                      <div></div>
                                  <?php endif; ?>
                                  <!-- /.card-header -->

                                  <!-- /.card-body -->
                              </div>



                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
      let kartu = document.getElementById('pilihKartu');
      let ktp = document.getElementById('ktp');
      let npwp = document.getElementById('npwp');
      let kk = document.getElementById('kk');
      let bpjs = document.getElementById('bpjs');
      let karis = document.getElementById('karis');

      window.addEventListener('load', () => {
          ktp.style.display = 'none';
          npwp.style.display = 'none';
          kk.style.display = 'none';
          bpjs.style.display = 'none';
          karis.style.display = 'none';
      })

      kartu.addEventListener('change', () => {
          a = kartu.value;
          if (a == 'KTP') {
              ktp.style.display = 'block';
              npwp.style.display = 'none';
              kk.style.display = 'none';
              bpjs.style.display = 'none';
              karis.style.display = 'none';
          } else if (a == 'NPWP') {
              ktp.style.display = 'none';
              npwp.style.display = 'block';
              kk.style.display = 'none';
              bpjs.style.display = 'none';
              karis.style.display = 'none';
          } else if (a == 'BPJS') {
              ktp.style.display = 'none';
              npwp.style.display = 'none';
              kk.style.display = 'none';
              bpjs.style.display = 'block';
              karis.style.display = 'none';
          } else if (a == 'KARTU KELUARGA') {
              ktp.style.display = 'none';
              npwp.style.display = 'none';
              kk.style.display = 'block';
              bpjs.style.display = 'none';
              karis.style.display = 'none';
          } else if (a == 'KARIS') {
              ktp.style.display = 'none';
              npwp.style.display = 'none';
              kk.style.display = 'none';
              bpjs.style.display = 'none';
              karis.style.display = 'block';
          } else {
              ktp.style.display = 'none';
              npwp.style.display = 'none';
              kk.style.display = 'none';
              bpjs.style.display = 'none';
              karis.style.display = 'none';
          }
      })
  </script>