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
                         <li class="breadcrumb-item"><a href="<?= base_url('personalia/masterstaff'); ?>">Personil Dustira</a></li>
                         <li class="breadcrumb-item active"><?= $judul; ?></li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <section class="content p-3">
         <div class="card shadow-lg">
             <div class="card-header text-center">
                 <h3><?= $staff['nama']; ?></h3>
             </div>
             <div class="card-body">
                 <form action="<?= base_url('personalia/detailStaff'); ?>" method="post">
                     <input type="hidden" name="id" value="<?= $staff['id']; ?>">
                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-4">
                                 <label class="form-label" for="nip">No Nrp/Nip/Nik</label>
                             </div>
                             <div class="col-md-8">
                                 <input class="form-control" type="text" name="nip" id="nip" value="<?= $staff['nip']; ?>">
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
                                 <input class="form-control" type="text" name="nama" id="nama" value="<?= $staff['nama']; ?>">
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
                                     <option value="<?= $staff['gol']; ?>"><?= $staff['gol']; ?></option>
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
                                 <input class="form-control" type="text" name="pangkat" id="pangkat" value="<?= $staff['pangkat']; ?>">
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
                                 <input class="form-control" type="text" name="jabatan" id="jabatan" value="<?= $staff['jabatan']; ?>">
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
                                 <input class="form-control" type="text" name="ket" id="ket" value="<?= $staff['ket']; ?>">
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
                                     <?php if ($staff['gender'] == 'L') : ?>
                                         <option value="<?= $staff['gender']; ?>">Laki-laki</option>
                                     <?php elseif ($staff['gender'] == 'P') : ?>
                                         <option value="<?= $staff['gender']; ?>">Perempuan</option>
                                     <?php else : ?>
                                         <option value="">Silahkan pilih</option>
                                     <?php endif; ?>
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
                                 <input class="form-control" type="text" name="pendidikan" id="pendidikan" value="<?= $staff['pendidikan']; ?>">
                             </div>
                         </div>
                         <?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>

                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-4">
                                 <label class="form-label" for="ttl">TMT</label>
                             </div>
                             <div class="col-md-8">
                                 <div class="input-group">
                                     <?php if ($staff['tgl_lahir'] == '1977-01-01') : ?>
                                         <input type="date" name="tanggallahir" aria-label="Tanggal lahir" class="form-control" placeholder="Silahkan input tanggal lahir">
                                     <?php else : ?>
                                         <input type="date" name="tanggallahir" aria-label="Tanggal lahir" class="form-control" value="<?= substr($staff['tgl_lahir'], 0, 10); ?>">
                                     <?php endif; ?>
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
                                     <?php if (!$staff['kualifikasi']) : ?>
                                         <option value=""></option>
                                     <?php else : ?>
                                         <option value="<?= $staff['kualifikasi']; ?>"><?= $staff['kualifikasi']; ?></option>
                                     <?php endif; ?>
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
                                     <?php if ($staff['tmt'] == '1977-01-01') : ?>
                                         <input type="date" name="tmt" aria-label="Tanggal lahir" class="form-control" placeholder="Silahkan input tmt">
                                     <?php else : ?>
                                         <input type="date" name="tmt" aria-label="Tanggal lahir" class="form-control" value="<?= substr($staff['tmt'], 0, 10); ?>">
                                     <?php endif; ?>
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
                                     <?php if ($staff['isactive'] == 1) : ?>
                                         <input class="form-check-input" type="checkbox" value="<?= $staff['isactive']; ?>" id="flexCheckDefault" name="aktif" checked>
                                     <?php else : ?>
                                         <input class="form-check-input" type="checkbox" value="0" id="flexCheckDefault" name="aktif">
                                     <?php endif; ?>
                                     <label class="form-check-label" for="flexCheckDefault" data-bs-toggle="tooltip" data-bs-placement="top" title="Jangan di checklist jika ingin menonaktifkan">
                                         Aktif
                                     </label>
                                 </div>
                             </div>
                         </div>

                         <div class="form-group">

                             <div class="row">
                                 <div class="col-sm-4 text-end">
                                 </div>
                                 <div class="col-sm-8">
                                     <a href="#" onclick="history.back();" class="btn btn-success mr-3">Kembali</a>
                                     <button onclick="return confirm('Apakah Anda yakin untuk menyimpan perubahan data ini?');" class="btn btn-warning" type="submit">Simpan Perubahan</button>
                                 </div>
                             </div>
                         </div>


                 </form>
             </div>
             <div class="card-footer">
                 <p><strong>*</strong> Untuk menambahkan Personil Silahkan gunakan Aplikasi Simrs.<br><strong>*</strong> Disini dapat melakukan edit data personil untuk melengkapi data pokok.</p>
             </div>
         </div>


     </section>
     <!-- /.content -->
 </div>