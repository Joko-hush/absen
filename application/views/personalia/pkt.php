     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1><?= $judul; ?></h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('personalia'); ?>">Home</a></li>
                             <li class="breadcrumb-item active">Pangkat</li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">

             <!-- Default box -->
             <div class="card rounded shadow">
                 <div class="card-header bg-dark">
                     <h3 class="card-title"><?= $judul; ?></h3>
                     <div class="card-tools">

                         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                             <i class="fas fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                             <i class="fas fa-times"></i>
                         </button>
                     </div>
                 </div>
                 <div class="card-body">
                     <?= $this->session->flashdata('message'); ?>
                     <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                         Tambah
                     </button>
                     <table id="example" class="table table-bordered mt-3 table-hover text-center">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Pangkat</th>
                                 <th>Option</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $n = 1; ?>
                             <?php foreach ($pangkat as $pkt) : ?>
                                 <tr>
                                     <td><?= $n++; ?></td>
                                     <td><?= $pkt['nama']; ?></td>
                                     <td>
                                         <a href="<?= base_url('personalia/editpangkat') . '?id=' . $pkt['id']; ?>" class="btn btn-warning shadow">Edit</a>
                                         <a href="<?= base_url('personalia/hapuspangkat') . '?id=' . $pkt['id']; ?>" class="btn btn-danger shadow" onclick="return confirm('Are you sure?');">Delete</a>
                                     </td>
                                 </tr>
                             <?php endforeach; ?>
                         </tbody>
                     </table>
                 </div>
                 <!-- /.card-body -->
                 <div class="card-footer bg-info">
                     Footer
                 </div>
                 <!-- /.card-footer-->
             </div>
             <!-- /.card -->

         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->


     <!-- modals -->
     <!-- Button trigger modal -->


     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Tambah Pangkat</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <form action="<?= base_url('personalia/pangkat'); ?>" method="post">
                         <div class="form-group">
                             <label for="pkt">Nama Pangkat</label>
                             <input type="text" id="pkt" name="pkt" autofocus class="form-control">
                             <?= form_error('pkt', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                         <div class="form-group">
                             <label for="ket">Jenjang</label>
                             <input list="nama-jenjang" id="ket" name="ket" class="form-control">
                             <datalist id="nama-jenjang">
                                 <option value="PAMEN">
                                 <option value="PAMA">
                                 <option value="BINTARA">
                                 <option value="TAM TAMA">
                                 <option value="PNS">
                                 <option value="KHL">
                             </datalist>
                             <?= form_error('ket', '<small class="text-danger pl-3">', '</small>'); ?>
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